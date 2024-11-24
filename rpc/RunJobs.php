<?php

// This is for beta, DO NOT USE for production. Use RunSingleJob instead.

use MediaWiki\MediaWikiServices;

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
	http_response_code( 405 );
	header( 'Allow: POST' );
	die( "Request must use POST.\n" );
}

define( 'MEDIAWIKI_JOB_RUNNER', 1 );
define( 'MW_DB', isset( $_GET['wiki'] ) ? $_GET['wiki'] : '' );

require_once __DIR__ . '/../initialise/MirahezeFunctions.php';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );

// fatals but not random I/O warnings
error_reporting( E_ERROR );
ini_set( 'display_errors', 1 );
$wgShowExceptionDetails = true;

// Session consistency is not helpful here and will slow things down in some cases
$lbFactory = MediaWikiServices::getInstance()->getDBLoadBalancerFactory();
$lbFactory->disableChronologyProtection();

try {
	$mediawiki = new MediaWiki();
	$runner = new JobRunner();
	$response = $runner->run( [
		'type'     => isset( $_GET['type'] ) ? $_GET['type'] : false,
		'maxJobs'  => isset( $_GET['maxjobs'] ) ? $_GET['maxjobs'] : 5000,
		'maxTime'  => isset( $_GET['maxtime'] ) ? $_GET['maxtime'] : 30
	] );

	print json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

	$mediawiki->restInPeace();
} catch ( Exception $e ) {
	http_response_code( 500 );
	MWExceptionHandler::rollbackPrimaryChangesAndLog( $e );
}
