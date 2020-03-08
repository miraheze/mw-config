<?php

$wgLBFactoryConf = [
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => [
		// wiki => c1
	],
	'sectionLoads' => [
		'DEFAULT' => [
			'db6' => 1,
		],
		'c1' => [
			'db6' => 1,
		],
	],
	'serverTemplate' => [
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'flags' => DBO_SSL | DBO_COMPRESS,
		'sslCertPath' => '/etc/ssl/certs/wildcard.miraheze.org.crt',
		'sslKeyPath' => '/etc/ssl/private/wildcard.miraheze.org.key',
	],
	'hostsByName' => [
		'db6' => 'db6.miraheze.org',
	],
	'externalLoads' => [
		'echo' => [
			'db6' => 1, // should echo c1
		],
	],
	'readOnlyBySection' => [
		'DEFAULT' => 'Maintenance ongoing on the database server.',
		'c1' => 'Maintenance ongoing on the database server.',
		// 'c3' => 'Maintenance ongoing on the database server.',
	],
];
