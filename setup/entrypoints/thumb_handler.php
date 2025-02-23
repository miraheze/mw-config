<?php

use Miraheze\Config\ConfigurationSetup;

require_once '/srv/mediawiki/config/setup/ConfigurationSetup.php';

$currentDatabase = ConfigurationSetup::getCurrentDatabase( true );

$primaryDomain = ConfigurationSetup::getPrimaryDomain( $currentDatabase );
$defaultServer = ConfigurationSetup::getDefaultServer( $currentDatabase );

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

require ConfigurationSetup::getMediaWiki( 'thumb_handler.php' );
