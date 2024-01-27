<?php

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
		'flags' => DBO_DEFAULT | ( $wgCommandLineMode ? DBO_DEBUG : 0 ),
		'variables' => [
			// https://mariadb.com/docs/reference/mdb/system-variables/innodb_lock_wait_timeout
			'innodb_lock_wait_timeout' => 15,
		],
	],
	'hostsByName' => [
		'db151' => '10.0.15.110',
		'db161' => '10.0.16.128',
		'db171' => '10.0.17.119',
		'db181' => '10.0.18.102',
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
	'readOnlyBySection' => [
		// 'DEFAULT' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c1' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c2' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c3' => 'DC Switchover in progress. Please try again in a few minutes.',
		'c4' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c5' => 'DC Switchover in progress. Please try again in a few minutes.',
	],
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
