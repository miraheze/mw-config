<?php

$wgLBFactoryConf = [
	'class' => \Wikimedia\Rdbms\LBFactoryMulti::class,
	'secret' => $wgSecretKey,
	'sectionsByDB' => $wi->wikiDBClusters,
	'sectionLoads' => [
		'DEFAULT' => [
			'db131' => 0,
		],
		'c1' => [
			'db131' => 0,
		],
		'c2' => [
			'db101' => 0,
		],
		'c3' => [
			'db142' => 0,
		],
		'c4' => [
			'db121' => 0,
		],
		'c5' => [
			'db131' => 0,
		],
	],
	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'ssl' => true,
		'flags' => DBO_DEFAULT | ( $wgCommandLineMode ? DBO_DEBUG : 0 ),
		'variables' => [
			// https://mariadb.com/docs/reference/mdb/system-variables/innodb_lock_wait_timeout
			'innodb_lock_wait_timeout' => 15,
		],
		/**
		 * MediaWiki checks if the certificate presented by MariaDB is signed
		 * by the certificate authority listed in 'sslCAFile'. In emergencies
		 * this could be set to /etc/ssl/certs/ca-certificates.crt (all trusted
		 * CAs), but setting this to one CA reduces attack vector and CAs
		 * to dig through when checking the certificate provided by MariaDB.
		 */
		'sslCAFile' => '/etc/ssl/certs/Sectigo.crt',
	],
	'hostsByName' => [
		'db101' => 'db101.miraheze.org',
		'db121' => 'db121.miraheze.org',
		'db131' => 'db131.miraheze.org',
		'db142' => 'db142.miraheze.org',
	],
	'externalLoads' => [
		'beta' => [
			/** where the metawikibeta database is located */
			'db121' => 0,
		],
		'echo' => [
			/** where the metawiki database is located */
			'db131' => 0,
		],
	],
	'readOnlyBySection' => [
		// 'DEFAULT' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c1' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c2' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c3' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c4' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c5' => 'DC Switchover in progress. Please try again in a few minutes.',
	],
];

// Disallow web request database transactions that are slower than 10 seconds
$wgMaxUserDBWriteDuration = 10;

// Max execution time for expensive queries of special pages (in milliseconds)
$wgMaxExecutionTimeForExpensiveQueries = 30000;

// Compress revisions
$wgCompressRevisions = true;

$wgSQLMode = null;
