<?php

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );

use MediaWiki\MediaWikiServices;
use MediaWiki\Title\Title;

$uri = strtok( $_SERVER['REQUEST_URI'] ?? '', '?' );
$queryString = $_SERVER['QUERY_STRING'] ?? '';

// Decode and normalize the URI
$decodedUri = urldecode( $uri );
$decodedUri = str_replace( [ '/w/index.php', '/index.php' ], '', $decodedUri );

$articlePath = str_replace( '/$1', '', $wgArticlePath ?? '' );
$redirectUrl = ( $articlePath !== '' ? $articlePath : '/' ) . $decodedUri;

// T13127: $decodedUri can be empty (e.g. /w/index.php?any=query), so append /
// if that is the case in order to prevent a redirect at best, and the query
// parameters being ignored in the redirect if worse.
if ( $decodedUri === '' ) {
	$redirectUrl .= '/';
}

if ( $decodedUri !== '' && !str_contains( $queryString, 'title' ) ) {
	$path = parse_url( $decodedUri, PHP_URL_PATH );
	$segments = explode( '/', $path );
	$title = end( $segments ) ?: '';

	$decodedQueryString = urldecode( $queryString );
	parse_str( $decodedQueryString, $queryParameters );

	$queryParameters['title'] = $title;
}

// If using /wiki/$1 format and diff/oldid present, preserve them in the redirect
if ( $wgArticlePath === '/wiki/$1' && ( isset( $_GET['diff'] ) || isset( $_GET['oldid'] ) ) ) {
	$queryParameters ??= [];
	if ( isset( $_GET['diff'] ) ) {
		$queryParameters['diff'] = $_GET['diff'];
	}

	if ( isset( $_GET['oldid'] ) ) {
		$queryParameters['oldid'] = $_GET['oldid'];
	}

	if ( isset( $_GET['rcid'] ) ) {
		$queryParameters['rcid'] = $_GET['rcid'];
	}

	if ( isset( $_GET['title'] ) ) {
		$queryParameters['title'] = $_GET['title'];
	}
}

// Handle weirdly encoded query strings and title capitalization logic
if ( $queryString !== '' || isset( $queryParameters ) ) {
	if ( !isset( $queryParameters ) ) {
		// We don't want to decode %26 into & or %2B into + or it breaks things such as search functionality

		// Replace %26 and %2B with temporary placeholders
		$queryString = str_replace( [ '%26', '%2B' ], [ '##TEMP1##', '##TEMP2##' ], $queryString );

		// Decode the query string safely
		$decodedQueryString = urldecode( $queryString );

		// Restore the original encoded values
		$decodedQueryString = str_replace( [ '##TEMP1##', '##TEMP2##' ], [ '%26', '%2B' ], $decodedQueryString );

		parse_str( $decodedQueryString, $queryParameters );
	}

	if ( isset( $queryParameters['useformat'] ) ) {
		$_GET['useformat'] = $queryParameters['useformat'];
		unset( $queryParameters['useformat'] );
	}

	if ( isset( $queryParameters['title'] ) ) {
		$title = $queryParameters['title'];
		unset( $queryParameters['title'] );

		// Capitalize the title if needed
		if ( mb_strtolower( mb_substr( $title, 0, 1 ) ) === mb_substr( $title, 0, 1 ) ) {
			$currentTitle = Title::newFromText( $title );
			if ( $currentTitle ) {
				$namespaceInfo = MediaWikiServices::getInstance()->getNamespaceInfo();
				if ( $namespaceInfo->isCapitalized( $currentTitle->getNamespace() ) ) {
					$title = ucfirst( $title );
				}
			}
		}

		// If using domain root for main page, don't append title
		if ( ( $wgMainPageIsDomainRoot ?? false ) && $title === wfMessage( 'mainpage' )->text() ) {
			$articlePath = '';
			$title = '';
		}

		// These cause issues if they aren't encoded.
		// There is still an issue with & becoming ?
		// and the first ?action= becoming &action=
		// which breaks it.
		$title = str_replace( [ '%', '&', '?' ], [ '%25', '%26', '%3F' ], $title );
		$redirectUrl = $articlePath . '/' . $title;
	}

	// Append query string if any remains
	if ( !empty( $queryParameters ) ) {
		if ( isset( $queryParameters['token'] ) ) {
			// This can not be decoded or it breaks the edit token for
			// things such as the Moderation extension
			$queryParameters['token'] = urlencode( $queryParameters['token'] );
			$queryParameters['token'] = str_replace( '%5C', '\\', $queryParameters['token'] );
		}

		$redirectUrl .= '?' . http_build_query( $queryParameters );
	}
}

// Final cleanup of the redirect URL
$redirectUrl = str_replace( ' ', '_', $redirectUrl );
$redirectUrl = str_replace( '\\', '%5C', $redirectUrl );

// Issue the redirect
header( 'Location: ' . $redirectUrl, true, 301 );
exit();
