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

if ( !in_array( $_SERVER['REMOTE_ADDR'], [ '127.0.0.1', '0:0:0:0:0:0:0:1', '::1' ], true ) ) {
	die( "Only loopback requests are allowed.\n" );
} elseif ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
	die( "Request must use POST.\n" );
}

define( 'MEDIAWIKI_JOB_RUNNER', 1 );

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
$wiki = $_GET['wiki'] ?? '';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );

// fatals but not random I/O warnings
error_reporting( E_ERROR );
ini_set( 'display_errors', 1 );
$wgShowExceptionDetails = true;

// Session consistency is not helpful here and will slow things down in some cases
$lbFactory = MediaWiki\MediaWikiServices::getInstance()->getDBLoadBalancerFactory();
$lbFactory->disableChronologyProtection();

try {
	$mediawiki = new MediaWiki();
	$runner = new JobRunner();
	$response = $runner->run( [
		'type' => $_GET['type'] ?? false,
		'maxJobs' => $_GET['maxjobs'] ?? 5000,
		'maxTime' => $_GET['maxtime'] ?? 30
	] );

	print json_encode( $response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

	$mediawiki->restInPeace();
} catch ( Exception $e ) {
	# Since output is logged to file, get MediaWiki to generate a raw error
	$wgCommandLineMode = true;

	MWExceptionHandler::handleException( $e );
}
