<?php

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );

use MediaWiki\MediaWikiServices;
use MediaWiki\Title\Title;

$uri = strtok( $_SERVER['REQUEST_URI'], '?' );
$queryString = $_SERVER['QUERY_STRING'] ?? '';

$decodedUri = urldecode( $uri );
$decodedUri = str_replace( '/w/index.php', '', $decodedUri );
$decodedUri = str_replace( '/index.php', '', $decodedUri );

$articlePath = str_replace( '/$1', '', $wgArticlePath );
$redirectUrl = ( $articlePath ?: '/' ) . $decodedUri;
// T13127: $decodedUri can be empty (e.g. /w/index.php?any=query), so append /
// if that is the case in order to prevent a redirect at best, and the query
// parameters being ignored in the redirect if worse.
if ( $decodedUri === '' ) {
	$redirectUrl .= '/';
}

if ( $decodedUri && !str_contains( $queryString, 'title' ) ) {
	$path = parse_url( $decodedUri, PHP_URL_PATH );
	$segments = explode( '/', $path );
	$title = end( $segments );

	$decodedQueryString = urldecode( $queryString );
	parse_str( $decodedQueryString, $queryParameters );

	$queryParameters['title'] = $title;
}

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

if ( $queryString || isset( $queryParameters ) ) {
	if ( !isset( $queryParameters ) ) {
		// We don't want to decode %26 into & or %2B into + or it breaks things such as search functionality

		// Replace %26 with a temporary placeholder
		$queryString = str_replace( '%26', '##TEMP1##', $queryString );
		$queryString = str_replace( '%2B', '##TEMP2##', $queryString );

		// Decode the URL
		$decodedQueryString = urldecode( $queryString );

		// Restore the original %26
		$decodedQueryString = str_replace( '##TEMP1##', '%26', $decodedQueryString );
		$decodedQueryString = str_replace( '##TEMP2##', '%2B', $decodedQueryString );

		parse_str( $decodedQueryString, $queryParameters );
	}

	if ( isset( $queryParameters['useformat'] ) ) {
		$_GET['useformat'] = $queryParameters['useformat'];
		unset( $queryParameters['useformat'] );
	}

	if ( isset( $queryParameters['title'] ) ) {
		$title = $queryParameters['title'];
		unset( $queryParameters['title'] );

		if ( mb_strtolower( mb_substr( $title, 0, 1 ) ) === mb_substr( $title, 0, 1 ) ) {
			$currentTitle = Title::newFromText( $title );
			if ( $currentTitle ) {
				$namespaceInfo = MediaWikiServices::getInstance()->getNamespaceInfo();
				if ( $namespaceInfo->isCapitalized( $currentTitle->getNamespace() ) ) {
					$title = ucfirst( $title );
				}
			}
		}

		if ( $wgMainPageIsDomainRoot && $title === wfMessage( 'mainpage' )->text() ) {
			$articlePath = '';
			$title = '';
		}

		// These cause issues if they aren't encoded.
		// There is still an issue with & becoming ?
		// and the first ?action= becoming &action=
		// which breaks it.
		$title = str_replace( '%', '%25', $title );
		$title = str_replace( '&', '%26', $title );
		$title = str_replace( '?', '%3F', $title );

		$redirectUrl = $articlePath . '/' . $title;
	}

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

$redirectUrl = str_replace( ' ', '_', $redirectUrl );
$redirectUrl = str_replace( '\\', '%5C', $redirectUrl );
header( 'Location: ' . $redirectUrl, true, 301 );

exit();
