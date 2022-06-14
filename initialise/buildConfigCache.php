<?php
require_once __DIR__ . '/StaticSiteConfiguration.php';
require_once __DIR__ . '/MirahezeFunctions.php';

global $wi;
$wi = new MirahezeFunctions( new StaticSiteConfiguration() );

require_once __DIR__ . '/../ManageWikiExtensions.php';

foreach ( MirahezeFunctions::getLocalDatabases() as $wiki ) {
	$conf = new StaticSiteConfiguration();
	MirahezeFunctions::getConfigGlobals( $wiki, $conf );
}
