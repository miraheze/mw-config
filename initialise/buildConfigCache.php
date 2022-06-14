<?php

require_once __DIR__ . '/MirahezeFunctions.php';

global $wi;
$wi = new MirahezeFunctions();

require_once __DIR__ . '/../ManageWikiExtensions.php';
require_once __DIR__ . '/StaticSiteConfiguration.php';

foreach ( MirahezeFunctions::getLocalDatabases() as $wiki ) {
	$conf = new StaticSiteConfiguration();
	MirahezeFunctions::getConfigGlobals( $wiki, $conf );
}
