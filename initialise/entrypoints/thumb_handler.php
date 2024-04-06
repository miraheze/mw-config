<?php

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';

if (
	MirahezeFunctions::getPrimaryDomain( MirahezeFunctions::getCurrentDatabase( true ) ) !== MirahezeFunctions::getDefaultServer( MirahezeFunctions::getCurrentDatabase( true ) ) &&
	str_contains( strtoupper( $_SERVER['REQUEST_URI'] ), strtoupper( MirahezeFunctions::getDefaultServer( MirahezeFunctions::getCurrentDatabase( true ) ) ) )
) {
	header( 'Location: ' . str_replace(
		MirahezeFunctions::getDefaultServer( MirahezeFunctions::getCurrentDatabase( true ) ),
		MirahezeFunctions::getPrimaryDomain( MirahezeFunctions::getCurrentDatabase( true ) ),
		$_SERVER['REQUEST_URI']
	), true, 301 );
	exit();
}

require MirahezeFunctions::getMediaWiki( 'thumb_handler.php' );
