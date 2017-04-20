<?php

$wgLBFactoryConf = array(
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => array(
		'allthetropeswiki' => 'c2',
		'buswiki' => 'c2',
		'centralauth' => 'c2',
		'extloadwiki' => 'c2',
		'loginwiki' => 'c2',
		'supernamuwiki' => 'c2',
		'tmewiki' => 'c2',
	),
	'sectionLoads' => array(
		'DEFAULT' => array(
			'db2' => 1,
		),
		'c1' => array(
			'db2' => 1,
		),
		'c2' => array(
			'db3' => 1,
		),
	),
	'serverTemplate' => array(
		'dbname' => $wgDBname,
		'user' => $wgDBuser,
		'password' => $wgDBpassword,
		'type' => 'mysql',
	),
	'hostsByName' => array(
		'db2' => '81.4.125.112',
		'db3' => '81.4.127.157',
	),
	'readOnlyBySection' => array(
	//	'DEFAULT' => '',
	//	'c1' => '',
	//	'c2' => '',
	),
);
