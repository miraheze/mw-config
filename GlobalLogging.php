<?php
$wmgLogDir = "/var/log/mediawiki";

$wgDebugLogFile = "$wmgLogDir/$wmgHostname.log";
$wgDBerrorLog = "$wmgLogDir/debuglogs/database.log";

$wgDebugLogGroups = array(
	'404' => "$wmgLogDir/debuglogs/404.log",
	'api' => "$wmgLogDir/debuglogs/api.log",
	'captcha' => "$wmgLogDir/debuglogs/captcha.log",
	'CentralAuth' => "$wmgLogDir/debuglogs/CentralAuth.log",
	'collection' => "$wmgLogDir/debuglogs/collection.log",
	'CreateWiki' => "$wmgLogDir/debuglogs/CreateWiki.log",
	'error' => "$wmgLogDir/debuglogs/php-error.log",
	'exception' => "$wmgLogDir/debuglogs/exception.log",
	'exec' => "$wmgLogDir/debuglogs/exec.log",
	'Math' => "$wmgLogDir/debuglogs/Math.log",
	'OAuth' => "$wmgLogDir/debuglogs/OAuth.log",
	'redis' => "$wmgLogDir/debuglogs/redis.log",
	'thumbnail' => "$wmgLogDir/debuglogs/thumbnail.log",
);

if ( $wgCommandLineMode ) {
	error_reporting( -1 );
	ini_set( 'display_startup_errors', 1 );
	ini_set( 'display_errors', 1 );

	$wgShowExceptionDetails = true;

	$wgShowSQLErrors = true;
	$wgDebugDumpSql = true;
	$wgShowDBErrorBacktrace = true;
}
