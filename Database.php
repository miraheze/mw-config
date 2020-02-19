<?php

$wgLBFactoryConf = [
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => [
 		'allthetropeswiki' => 'c2',
		'baobabarchiveswiki' => 'c2',
		'concordancewiki' => 'c3',
		'dreamversewiki' => 'c3',
 		'frikipediawiki' => 'c2',
		'nbdbwiki' => 'c3',
		'nonbinarywiki' => 'c3',
 		'nonciclopediawiki' => 'c2',
 		'nonsensopediawiki' => 'c2',
		'onepiecewiki' => 'c3',
		'rotompediawiki' => 'c3',
 		'testwiki' => 'c3',
 		'toxicfandomsandhatedomswiki' => 'c2',
 		'uncyclomirrorwiki' => 'c2',
 		'zhdelwiki' => 'c2',
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
		'c3' => [
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
		'db4' => 'db4.miraheze.org',
		'db5' => 'db5.miraheze.org',
		'db6' => 'db6.miraheze.org',
	],
	'externalLoads' => [
		'echo' => [
			'db4' => 1, // should echo c1
		],
	],
	'readOnlyBySection' => [
		// 'DEFAULT' => 'Maintenance ongoing on the database server.',
		// 'c1' => 'Maintenance ongoing on the database server.',
		// 'c2' => 'Maintenance ongoing on the database server.',
		// 'c3' => 'Maintenance ongoing on the database server.',
	],
];
