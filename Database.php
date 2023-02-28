<?php

$wgLBFactoryConf = [
	'class' => \Wikimedia\Rdbms\LBFactoryMulti::class,
	'sectionsByDB' => $wi->wikiDBClusters,
	'sectionLoads' => [
		'DEFAULT' => [
			'db131' => 1,
		],
		'c1' => [
			'db131' => 1,
		],
		'c2' => [
			'db101' => 1,
		],
		'c3' => [
			'db142' => 1,
		],
		'c4' => [
			'db121' => 1,
		],
		'c5' => [
			'db131' => 1,
		],
	],
	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'ssl' => true,
		'flags' => DBO_DEFAULT,
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
			/** where the betawiki database is located */
			'db121' => 1,
		],
		'echo' => [
			/** where the metawiki database is located */
			'db131' => 1,
		],
		'parsercache' => [
			/** where the parsercache database is located */
			'db121' => 1,
		],
	],
	'readOnlyBySection' => [
		'DEFAULT' => 'Scheduled database maintenance in progress. Please try again later.',
		'c1' => 'Scheduled database maintenance in progress. Please try again later.',
		'c2' => 'Scheduled database maintenance in progress. Please try again later.',
		// 'c3' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c4' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c5' => 'DC Switchover in progress. Please try again in a few minutes.',
	],
];

// Disallow web request database transactions that are slower than 3 seconds
$wgMaxUserDBWriteDuration = 6;

// Max execution time for expensive queries of special pages (in milliseconds)
$wgMaxExecutionTimeForExpensiveQueries = 30000;

// Compress revisions
$wgCompressRevisions = true;
