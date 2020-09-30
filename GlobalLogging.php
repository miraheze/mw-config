<?php
$wmgLogDir = "/var/log/mediawiki";

$wi->config->settings['wgDBerrorLog']['default'] = "$wmgLogDir/debuglogs/database.log";

$wi->config->settings['wgDebugLogGroups']['default'] = [
	'404' => "$wmgLogDir/debuglogs/404.log",
	'api' => "$wmgLogDir/debuglogs/api.log",
	'captcha' => "$wmgLogDir/debuglogs/captcha.log",
	'CentralAuth' => "$wmgLogDir/debuglogs/CentralAuth.log",
	'collection' => "$wmgLogDir/debuglogs/collection.log",
	'CreateWiki' => "$wmgLogDir/debuglogs/CreateWiki.log",
	'Echo' => "$wmgLogDir/debuglogs/Echo.log",
	'error' => "$wmgLogDir/debuglogs/php-error.log",
	'exception' => "$wmgLogDir/debuglogs/exception.log",
	'exec' => "$wmgLogDir/debuglogs/exec.log",
	'ldap' => "$wmgLogDir/debuglogs/ldap.log",
	'Math' => "$wmgLogDir/debuglogs/Math.log",
	'MatomoAnalytics' => "$wmgLogDir/debuglogs/MatomoAnalytics.log",
	'ManageWiki' => "$wmgLogDir/debuglogs/ManageWiki.log",
	'OAuth' => "$wmgLogDir/debuglogs/OAuth.log",
	'redis' => "$wmgLogDir/debuglogs/redis.log",
	'spf-tmp' => "$wmgLogDir/debuglogs/spf-tmp.log",
	'thumbnail' => "$wmgLogDir/debuglogs/thumbnail.log",
	'VisualEditor' => "$wmgLogDir/debuglogs/VisualEditor.log",
];

if ( $wgCommandLineMode ) {
	error_reporting( -1 );
	ini_set( 'display_startup_errors', 1 );
	ini_set( 'display_errors', 1 );

	$wgShowExceptionDetails = true;

	$wgShowSQLErrors = true;
	$wgDebugDumpSql = true;
	$wgShowDBErrorBacktrace = true;
}
