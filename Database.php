<?php

$wgLBFactoryConf = [
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => [
		'testwiki' => 'c1'
	],
	'sectionLoads' => [
		'DEFAULT' => [
			'db4' => 1,
		],
		'c1' => [
			'db4' => 1,
		],
		'c2' => [
			'db5' => 1,
		],
	],
	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'flags' => DBO_SSL,
		'sslCertPath' => '/etc/ssl/certs/wildcard.miraheze.org.crt',
		'sslKeyPath' => '/etc/ssl/private/wildcard.miraheze.org.key',
	],
	'hostsByName' => [
		// 81.4.109.166
		'db4' => 'mediawiki-internal-db-master.miraheze.org',
		// 168.235.110.50
		'db5' => 'mediawiki-internal-db-master-db5.miraheze.org',
	],
	'externalLoads' => [
		'echo' => [
			'db4' => 1, // should echo c1
//			'db5' => 1, // should echo c2
		],
	],
	'readOnlyBySection' => [
		// 'DEFAULT' => 'Maintenance ongoing on the database server.',
		// 'c1' => 'Maintenance ongoing on the database server.',
		// 'c2' => 'Maintenance ongoing on the database server.',
	],
];
