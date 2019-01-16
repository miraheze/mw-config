<?php

$wgLBFactoryConf = array(
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => array(
		// 'wiki' => 'c1'
	),
	'sectionLoads' => array(
		'DEFAULT' => array(
			'db4' => 1,
		),
		'c1' => array(
			'db4' => 1,
		),
	),
	'serverTemplate' => array(
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
		'flags' => DBO_SSL,
		'sslCertPath' => '/etc/ssl/certs/wildcard.miraheze.org.crt',
		'sslKeyPath' => '/etc/ssl/private/wildcard.miraheze.org.key',
	),
	'hostsByName' => array(
		// 81.4.109.166
		'db4' => 'mediawiki-internal-db-master.miraheze.org',
	),
	'externalLoads' => array(
		'echo' => array(
			'db4' => 1, // should echo c1
		),
	),
	'readOnlyBySection' => array(
	//	'DEFAULT' => 'Maintenance ongoing on the database server.',
	//	'c1' => 'Maintenance ongoing on the database server.',
	),
);
