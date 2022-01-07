<?php
$ovlon = [ 'test3', 'mw8', 'mw9', 'mw10', 'mw11', 'mw12', 'mw13', 'mwtask1' ];
if ( in_array( wfHostname(), $ovlon ) ) {
	$db1 = 'db11';
	$db2 = 'db12';
	$db3 = 'db13';
} else {
	$db1 = 'db101';
	$db2 = 'db111';
	$db3 = 'db121';
}
$wi->config->settings['wgLBFactoryConf']['default'] = [
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => $wi->wikiDBClusters,
	'sectionLoads' => [
		'DEFAULT' => [
			$db1 => 1,
		],
		'c1' => [
			$db1 => 1,
		],
		'c2' => [
			$db1 => 1,
		],
		'c3' => [
			$db2 => 1,
		],
		'c4' => [
			$db3 => 1,
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
		$db1 => "{$db1}.miraheze.org",
		$db2 => "{$db2}.miraheze.org",
		$db3 => "{$db3}.miraheze.org",
	],
	'externalLoads' => [
		'echo' => [
			$db1 => 1, // should echo c2 (where metawiki is located)
		],
		'beta' => [
			$db3 => 1, // should echo c4 (where betawiki is located)
		],
	],
	'readOnlyBySection' => [
		'DEFAULT' => 'DC Switchover in progress. Please try again in a few minutes.',
		// 'c1' => 'Maintenance ongoing on the database server.',
		//'c2' => 'Maintenance ongoing on the database server.',
		//'c3' => 'Maintenance ongoing on the database server.',
		//'c4' => 'Maintenance ongoing on the database server.',
	],
];

// don't need to set these as globals
unset( $db1, $db2, $db3, $ovlon );
