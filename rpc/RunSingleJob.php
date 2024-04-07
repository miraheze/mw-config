<?php

use MediaWiki\Extension\EventBus\JobExecutor;
use MediaWiki\MediaWikiServices;

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
	http_response_code( 405 );
	header( 'Allow: POST' );
	die( "Request must use POST.\n" );
}

// get the info contained in the POST body
$input = file_get_contents( "php://input" );
if ( $input === '' ) {
	// Allow for ease of testing
	http_response_code( 422 );
	die( 'No event received.' );
}

$event = json_decode( $input, true );
// check that we have the needed components of the event
if ( !isset( $event['database'] ) ) {
	throw new Exception( 'Invalid event received! ' . json_encode( $event ) );
}

define( 'MEDIAWIKI_JOB_RUNNER', 1 );
define( 'MW_DB', $event['database'] );

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
	$executor = new JobExecutor();
	// execute the job
	$response = $executor->execute( $event );
	if ( $response['status'] === true ) {
		http_response_code( 200 );
	} else {
		if ( $response['readonly'] ) {
			// if we detect that the DB is in read-only mode, we delay the return of the
			// response by at most 45 seconds in order to minimize the number of requests
			// made by change-prop; this will keep the request rate at a reasonably low
			// level without causing request time outs
			sleep( rand( 40, 45 ) );
			// END TODO
			header( 'X-Readonly: true' );
		}
		http_response_code( 500 );
	}
	$mediawiki->restInPeace();
} catch ( Exception $e ) {
	http_response_code( 500 );
	MWExceptionHandler::rollbackPrimaryChangesAndLog( $e );
}
