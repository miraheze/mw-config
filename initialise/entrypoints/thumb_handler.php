<?php

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';

$currentDatabase = MirahezeFunctions::getCurrentDatabase( true );

$primaryDomain = MirahezeFunctions::getPrimaryDomain( $currentDatabase );
$defaultServer = MirahezeFunctions::getDefaultServer( $currentDatabase );

if (
	$primaryDomain !== $defaultServer &&
	str_contains( strtoupper( $_SERVER['HTTP_HOST'] ), strtoupper( $defaultServer ) )
) {
	header( 'Location: ' . str_replace(
		$defaultServer, $primaryDomain,
		'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
	), true, 301 );
	exit();
}

require MirahezeFunctions::getMediaWiki( 'thumb_handler.php' );
