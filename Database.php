<?php

$scsvg = [ 'mw131', 'mw132', 'mw133', 'mw134', 'mw141', 'mw142', 'mw143', 'mwtask141', 'mwtask181' ];
if ( in_array( wfHostname(), $scsvg ) ) {
	$wmgDB151Hostname = 'db101.miraheze.org';
	$wmgDB161Hostname = 'db121.miraheze.org';
	$wmgDB171Hostname = 'db131.miraheze.org';
	$wmgDB181Hostname = 'db142.miraheze.org';
	$wmgDBUseSSL = true;
} else {
	$wmgDB151Hostname = '10.0.15.110';
	$wmgDB161Hostname = '10.0.16.128';
	$wmgDB171Hostname = '10.0.17.119';
	$wmgDB181Hostname = '10.0.18.102';
	$wmgDBUseSSL = false;
}

$wgLBFactoryConf = [
	'class' => \Wikimedia\Rdbms\LBFactoryMulti::class,
	'secret' => $wgSecretKey,
	'sectionsByDB' => $wi->wikiDBClusters,
	'sectionLoads' => [
		'DEFAULT' => [
			'db171' => 0,
		],
		'c1' => [
			'db171' => 0,
		],
		'c2' => [
			'db151' => 0,
		],
		'c3' => [
			'db181' => 0,
		],
		'c4' => [
			'db161' => 0,
		],
		'c5' => [
			'db171' => 0,
		],
	],
	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'ssl' => $wmgDBUseSSL,
		'flags' => DBO_DEFAULT | ( $wgCommandLineMode ? DBO_DEBUG : 0 ),
		'variables' => [
			// https://mariadb.com/docs/reference/mdb/system-variables/innodb_lock_wait_timeout
			'innodb_lock_wait_timeout' => 15,
		],
		'sslCAFile' => $wmgDBUseSSL ? '/etc/ssl/certs/Sectigo.crt' : null,
	],
	'hostsByName' => [
		'db151' => $wmgDB151Hostname,
		'db161' => $wmgDB161Hostname,
		'db171' => $wmgDB171Hostname,
		'db181' => $wmgDB181Hostname,
	],
	'externalLoads' => [
		'beta' => [
			/** where the metawikibeta database is located */
			'db161' => 0,
		],
		'echo' => [
			/** where the metawiki database is located */
			'db171' => 0,
		],
	],
	'readOnlyBySection' => !in_array( wfHostname(), $scsvg ) ? [
		'DEFAULT' => 'DC Switchover in progress. Please try again in a few minutes.',
		'c1' => 'DC Switchover in progress. Please try again in a few minutes.',
		'c2' => 'DC Switchover in progress. Please try again in a few minutes.',
		'c3' => 'DC Switchover in progress. Please try again in a few minutes.',
		'c4' => 'DC Switchover in progress. Please try again in a few minutes.',
		'c5' => 'DC Switchover in progress. Please try again in a few minutes.',
	] : [],
];

// Disable LoadMonitor in CLI, it doesn't provide much value in CLI.
if ( PHP_SAPI === 'cli' ) {
	$wgLBFactoryConf['loadMonitorClass'] = '\Wikimedia\Rdbms\LoadMonitorNull';
}

// Disallow web request database transactions that are slower than 10 seconds
$wgMaxUserDBWriteDuration = 10;

// Max execution time for expensive queries of special pages (in milliseconds)
$wgMaxExecutionTimeForExpensiveQueries = 30000;

$wgMiserMode = true;

// Compress revisions
$wgCompressRevisions = true;

$wgSQLMode = null;
