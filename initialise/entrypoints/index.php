<?php

use MediaWiki\Actions\ActionEntryPoint;
use MediaWiki\Context\RequestContext;
use MediaWiki\EntryPointEnvironment;
use MediaWiki\MediaWikiServices;

define( 'MW_ENTRY_POINT', 'index' );

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );
/*
// Normalize request URI
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';
$articlePath = $wgArticlePath ?? '';
$mainPageRoot = $wgMainPageIsDomainRoot ?? false;

// Normalize for comparisons
$lowerUri = strtolower( $requestUri );

if ( $articlePath === '/$1' && str_contains( $lowerUri, '/wiki/' ) ) {
	header( 'Location: ' . str_replace( '/wiki/', '/', $requestUri ), true, 301 );
	exit();
}

if (
	$articlePath === '/wiki/$1'
	&& !str_contains( $requestUri, '/wiki/' )
	&& !str_contains( $requestUri, '/w/' )
	&& !( $mainPageRoot && $requestUri === '/' )
) {
	header( 'Location: /wiki' . $requestUri, true, 301 );
	exit();
}

if ( $mainPageRoot && $requestUri !== '/' && $requestMethod !== 'POST' ) {
	$path = parse_url( $requestUri, PHP_URL_PATH ) ?? '';
	$segments = explode( '/', $path );
	$title = str_replace( '%20', '_', end( $segments ) ?: '' );

	$mainPageTitle = str_replace( ' ', '_', wfMessage( 'mainpage' )->text() );
	if ( $title === $mainPageTitle && !str_contains( $requestUri, '/wiki/' ) ) {
		$currentTitle = Title::newFromText( $segments[1] ?? $title );
		if ( $currentTitle && $currentTitle->getNamespace() !== NS_SPECIAL ) {
			$redirectUrl = str_replace(
				[ $title, '?useformat=mobile', '&useformat=mobile' ],
				'', $requestUri
			);

			header( 'Location: ' . $redirectUrl, true, 301 );
			exit();
		}

		// Don't need a global here
		unset( $currentTitle );
	}

	// Don't need a global here
	unset( $title );
}*/

require_once MirahezeFunctions::getMediaWiki( 'includes/PHPVersionCheck.php' );
wfEntryPointCheck( 'html', dirname( $_SERVER['SCRIPT_NAME'] ?? '' ) );

( new ActionEntryPoint(
	RequestContext::getMain(),
	new EntryPointEnvironment(),
	MediaWikiServices::getInstance()
) )->run();
