<?php

$wi->config->settings['wgLBFactoryConf']['default'] = [
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => $wi->wikiDBClusters,
	'sectionLoads' => [
		'DEFAULT' => [
			'db9' => 1,
		],
		'c1' => [
			'db9' => 1,
		],
		'c2' => [
 			'db11' => 1,
 		],
		'c3' => [
 			'db12' => 1,
 		],
		'c4' => [
 			'db13' => 1,
 		],
	],
	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'flags' => DBO_SSL | DBO_COMPRESS,
		// MediaWiki checks if the certificate presented by MariaDB is signed
		// by the certificate authority listed in 'sslCAFile'. In emergencies
		// this could be set to /etc/ssl/certs/ca-certificates.crt (all trusted
		// CAs), but setting this to one CA reduces attack vector and CAs
		// to dig through when checking the certificate provided by MariaDB.
		'sslCAFile' => '/etc/ssl/certs/Sectigo.crt',
	],
	'hostsByName' => [
		'db9' => 'db9.miraheze.org',
		'db11' => 'db11.miraheze.org',
		'db12' => 'db12.miraheze.org',
		'db13' => 'db13.miraheze.org',
	],
	'externalLoads' => [
		'echo' => [
			'db9' => 1, // should echo c1
		],
	],
	'readOnlyBySection' => [
		// 'DEFAULT' => 'Maintenance ongoing on the database server.',
		// 'c1' => 'Maintenance ongoing on the database server.',
		// 'c2' => 'Maintenance ongoing on the database server.',
		// 'c3' => 'Maintenance ongoing on the database server.',
		// 'c4' => 'Maintenance ongoing on the database server.',
	],
];
