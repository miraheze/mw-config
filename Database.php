<?php

use Wikimedia\Rdbms\LBFactoryMulti;
use Wikimedia\Rdbms\LoadMonitor;
use Wikimedia\Rdbms\LoadMonitorNull;

if ( strpos( wfHostname(), 'test' ) === 0 ) {
	// Mirabeta database configuration
	$wgLBFactoryConf = [
		'class' => LBFactoryMulti::class,
		'secret' => $wgSecretKey,
		'sectionsByDB' => $wi->wikiDBClusters,
		'sectionLoads' => [
			'DEFAULT' => [
				'db172' => 0,
			],
			'c1' => [
				'db172' => 0,
			],
		],
		'serverTemplate' => [
			'dbname' => $wgDBname,
			'user' => $wgDBuser,
			'password' => $wgDBpassword,
			'type' => 'mysql',
			'flags' => DBO_DEFAULT | ( MW_ENTRY_POINT === 'cli' ? DBO_DEBUG : 0 ),
			'variables' => [
				// https://mariadb.com/docs/reference/mdb/system-variables/innodb_lock_wait_timeout
				'innodb_lock_wait_timeout' => 15,
			],
		],
		'hostsByName' => [
			'db172' => '10.0.17.158',
		],
		'externalLoads' => [
			'beta' => [
				/** where the metawikibeta database is located */
				'db172' => 0,
			],
		],
		'readOnlyBySection' => [
			// 'DEFAULT' => 'Maintenance is in progress. Please try again in a few minutes.',
			// 'c1' => 'Maintenance is in progress. Please try again in a few minutes.',
		],
	];
} else {
	// Production database configuration
	$wgLBFactoryConf = [
		'class' => LBFactoryMulti::class,
		'secret' => $wgSecretKey,
		'sectionsByDB' => $wi->wikiDBClusters,
		'sectionLoads' => [
			'DEFAULT' => [
				'db192' => 0,
			],
			'c1' => [
				'db151' => 0,
			],
			'c2' => [
				'db161' => 0,
			],
			'c3' => [
				'db171' => 0,
			],
			'c4' => [
				'db181' => 0,
			],
			's1' => [
				'db192' => 0,
			],
		],
		'serverTemplate' => [
			'dbname' => $wgDBname,
			'user' => $wgDBuser,
			'password' => $wgDBpassword,
			'type' => 'mysql',
			'flags' => DBO_DEFAULT | ( MW_ENTRY_POINT === 'cli' ? DBO_DEBUG : 0 ),
			'variables' => [
				// https://mariadb.com/docs/reference/mdb/system-variables/innodb_lock_wait_timeout
				'innodb_lock_wait_timeout' => 120,
			],
		],
		'hostsByName' => [
			'db151' => '10.0.15.110',
			'db161' => '10.0.16.128',
			'db171' => '10.0.17.119',
			'db181' => '10.0.18.102',
			'db192'	=> '10.0.19.170',
		],
		'externalLoads' => [
			'echo' => [
				/** where the metawiki database is located */
				'db192' => 0,
			],
		],
		'readOnlyBySection' => [
			// 'DEFAULT' => 'Maintenance is in progress. Please try again in a few minutes.',
			// 'c1' => 'Maintenance is in progress. Please try again in a few minutes.',
			// 'c2' => 'Maintenance is in progress. Please try again in a few minutes.',
			// 'c3' => 'Maintenance is in progress. Please try again in a few minutes.',
			// 'c4' => 'Maintenance is in progress. Please try again in a few minutes.',
			// 's1' => 'Maintenance is in progress. Please try again in a few minutes.',
		],
	];
}

$wgLBFactoryConf['loadMonitor']['class'] = LoadMonitor::class;
// Disable LoadMonitor in CLI, it doesn't provide much value in CLI.
if ( PHP_SAPI === 'cli' ) {
	$wgLBFactoryConf['loadMonitor']['class'] = LoadMonitorNull::class;
}

$wgLBFactoryConf['loadMonitor']['maxConnCount'] = 350;

// Disallow web request database transactions that are slower than 10 seconds
$wgMaxUserDBWriteDuration = 10;

// Max execution time for expensive queries of special pages (in milliseconds)
$wgMaxExecutionTimeForExpensiveQueries = 30000;

$wgMiserMode = true;

$wgSQLMode = null;
