<?php

$wi->config->settings['wgLBFactoryConf']['default'] = [
	'class' => LBFactoryMulti::class,
	'sectionsByDB' => $wi->wikiDBClusters,
	'sectionLoads' => [
		'DEFAULT' => [
			'db101' => 1,
		],
		'c1' => [
			'db101' => 1,
		],
		'c2' => [
			'db101' => 1,
		],
		'c3' => [
			'db111' => 1,
		],
		'c4' => [
			'db121' => 1,
		],
	],
	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'flags' => DBO_SSL,
		// MediaWiki checks if the certificate presented by MariaDB is signed
		// by the certificate authority listed in 'sslCAFile'. In emergencies
		// this could be set to /etc/ssl/certs/ca-certificates.crt (all trusted
		// CAs), but setting this to one CA reduces attack vector and CAs
		// to dig through when checking the certificate provided by MariaDB.
		'sslCAFile' => '/etc/ssl/certs/Sectigo.crt',
	],
	'hostsByName' => [
		'db101' => 'db101.miraheze.org',
		'db111' => 'db111.miraheze.org',
		'db121' => 'db121.miraheze.org',
	],
	'externalLoads' => [
		'echo' => [
			'db101' => 1, // should echo c2 (where metawiki is located)
		],
		'beta' => [
			'db121' => 1, // should echo c4 (where betawiki is located)
		],
	],
	'readOnlyBySection' => [
		// 'DEFAULT' => 'DC Switchover in progress. Please try again in a few minutes.',
		//'c1' => 'DC Switchover in progress. Please try again in a few minutes.',
		//'c2' => 'DC Switchover in progress. Please try again in a few minutes.',
		//'c3' => 'DC Switchover in progress. Please try again in a few minutes.',
		//'c4' => 'DC Switchover in progress. Please try again in a few minutes.',
	],
];
$wi->config->settings['wgMaxExecutionTimeForExpensiveQueries'] = 20000;
