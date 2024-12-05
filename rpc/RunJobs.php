<?php

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @author Aaron Schulz
 */

// This is for beta, DO NOT USE for production. Use RunSingleJob instead.

use MediaWiki\MediaWikiServices;

if ( !in_array( $_SERVER['REMOTE_ADDR'], [ '127.0.0.1', '0:0:0:0:0:0:0:1', '::1' ], true ) ) {
	http_response_code( 500 );
	die( "Only loopback requests are allowed.\n" );
} elseif ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
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
	$runner = MediaWikiServices::getInstance()->getJobRunner();
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
