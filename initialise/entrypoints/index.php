<?php

use MediaWiki\Actions\ActionEntryPoint;
use MediaWiki\Context\RequestContext;
use MediaWiki\EntryPointEnvironment;
use MediaWiki\MediaWikiServices;
use MediaWiki\Title\Title;

define( 'MW_ENTRY_POINT', 'index' );

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );

if ( $wgArticlePath === '/$1' && str_contains( strtoupper( $_SERVER['REQUEST_URI'] ), strtoupper( '/wiki/' ) ) ) {
	// Redirect to the same page maintaining the path
	header( 'Location: ' . str_replace( '/wiki/', '/', $_SERVER['REQUEST_URI'] ), true, 301 );
	exit();
} elseif ( $wgArticlePath === '/wiki/$1' && !str_contains( $_SERVER['REQUEST_URI'], '/wiki/' ) && !str_contains( $_SERVER['REQUEST_URI'], '/w/' ) && !( $wgMainPageIsDomainRoot && $_SERVER['REQUEST_URI'] === '/' ) ) {
	// Redirect to the same page maintaining the path
	header( 'Location: /wiki' . $_SERVER['REQUEST_URI'], true, 301 );
	exit();
}

// $wgArticlePath === '/$1' ||
// T12263: Avoid redirecting main page to domain root if a POST is being done.
// This is because the POST is likely an action to be done (such as editing the
// page), and a 301 redirect would cause the HTTP client to potentially switch to
// a GET request and discard the request body.
// We could switch to a 308, which is guaranteed to continue using POST, but that
// just adds an extra, unnecessary redirect.
if ( ( $wgMainPageIsDomainRoot && $_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_METHOD'] !== 'POST' ) ) {
	// Try to redirect the main page to domain root if using $wgMainPageIsDomainRoot
	$title = '';
	if ( isset( $_SERVER['REQUEST_URI'] ) ) {
		$path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
		$segments = explode( '/', $path );
		$title = end( $segments );

		$title = str_replace( '%20', '_', $title );
	}

	// Check if the title matches the main page title
	if ( $wgMainPageIsDomainRoot && $_SERVER['REQUEST_URI'] !== '/' && $title === str_replace( ' ', '_', wfMessage( 'mainpage' )->text() ) && !str_contains( $_SERVER['REQUEST_URI'], '/wiki/' ) ) {
		$currentTitle = Title::newFromText( $segments[1] ?? $title );
		if ( $currentTitle && $currentTitle->getNamespace() !== NS_SPECIAL ) {
			// Redirect to the domain root
			$redirectUrl = str_replace( $title, '', $_SERVER['REQUEST_URI'] );
			$redirectUrl = str_replace( '?useformat=mobile', '', $redirectUrl );
			$redirectUrl = str_replace( '&useformat=mobile', '', $redirectUrl );

			header( 'Location: ' . $redirectUrl, true, 301 );
			exit();
		}

		// Don't need a global here
		unset( $currentTitle );
	}

	/* if ( mb_strtolower( mb_substr( $title, 0, 1 ) ) === mb_substr( $title, 0, 1 ) ) {
		$currentTitle = Title::newFromText( $title );
		if ( $currentTitle ) {
			$namespaceInfo = MediaWikiServices::getInstance()->getNamespaceInfo();
			if ( $namespaceInfo->isCapitalized( $currentTitle->getNamespace() ) ) {
				$decodedQueryString = urldecode( $_SERVER['QUERY_STRING'] ?? '' );
				parse_str( $decodedQueryString, $queryParameters );
				if ( isset( $queryParameters['useformat'] ) ) {
					$_GET['useformat'] = $queryParameters['useformat'];
					unset( $queryParameters['useformat'] );
				}

				$uri = strtok( str_replace( $title, ucfirst( $title ), $_SERVER['REQUEST_URI'] ), '?' );
				$decodedUri = urldecode( $uri );
				$redirectUrl = $decodedUri . '?' . http_build_query( $queryParameters );

				header( 'Location: ' . $redirectUrl, true, 301 );
				exit();
			}

			// Don't need a global here
			unset( $namespaceInfo );
		}

		// Don't need a global here
		unset( $currentTitle );
	} */

	// Don't need a global here
	unset( $title );
}

require_once MirahezeFunctions::getMediaWiki( 'includes/PHPVersionCheck.php' );
wfEntryPointCheck( 'html', dirname( $_SERVER['SCRIPT_NAME'] ) );

( new ActionEntryPoint(
	RequestContext::getMain(),
	new EntryPointEnvironment(),
	MediaWikiServices::getInstance()
) )->run();
