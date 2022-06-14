<?php

require_once __DIR__ . '/../ManageWikiExtensions.php';
require_once __DIR__ . '/MirahezeFunctions.php';
require_once __DIR__ . '/StaticSiteConfiguration.php';

$wi = new MirahezeFunctions();

foreach ( MirahezeFunctions::getLocalDatabases() as $wiki ) {
	$conf = new StaticSiteConfiguration();
	MirahezeFunctions::getConfigGlobals( $wiki, $conf );
}
