<?php

$wgLBFactoryConf = array(
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => array(
		'default' => 'c1',
	),
	'sectionLoads' => array(
		'DEFAULT' => array(
			'db4' => 1,
		),
	),
	'serverTemplate' => array(
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
	),
	'hostsByName' => array(
		'db4' => '81.4.109.166',
	),
	'externalLoads' => array(
		'echo' => array(
			'db4' => 1,
		),
	),
	'readOnlyBySection' => array(
	//	'DEFAULT' => 'Maintenance ongoing on the database server.',
	//	'c1' => 'Maintenance ongoing on the database server.',
	),
);
