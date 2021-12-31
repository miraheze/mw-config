<?php
$ovlon = [ 'test3', 'mw8', 'mw9', 'mw10', 'mw11', 'mw12', 'mw13', 'mwtask1' ];
if ( in_array( wfHostname(), $ovlon ) ) {
	$wmgDB11Hostname = 'db11.miraheze.org';
	$wmgDB12Hostname = 'db12.miraheze.org';
	$wmgDB13Hostname = 'db13.miraheze.org';
} else {
	$wmgDB11Hostname = 'db101.miraheze.org';
	$wmgDB12Hostname = 'db111.miraheze.org';
	$wmgDB13Hostname = 'db121.miraheze.org';
}
$wi->config->settings['wgLBFactoryConf']['default'] = [
	'class' => 'LBFactoryMulti',
	'sectionsByDB' => $wi->wikiDBClusters,
	'sectionLoads' => [
		'DEFAULT' => [
			'db11' => 1,
		],
		'c1' => [
			'db11' => 1,
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
		'flags' => DBO_SSL,
		// MediaWiki checks if the certificate presented by MariaDB is signed
		// by the certificate authority listed in 'sslCAFile'. In emergencies
		// this could be set to /etc/ssl/certs/ca-certificates.crt (all trusted
		// CAs), but setting this to one CA reduces attack vector and CAs
		// to dig through when checking the certificate provided by MariaDB.
		'sslCAFile' => '/etc/ssl/certs/Sectigo.crt',
	],
	'hostsByName' => [
		'db11' => $wmgDB11Hostname,
		'db12' => $wmgDB12Hostname,
		'db13' => $wmgDB13Hostname,
	],
	'externalLoads' => [
		'echo' => [
			'db11' => 1, // should echo c1
		],
		'beta' => [
			'db13' => 1, // should echo c4 (where betawiki is located)
		],
	],
	'readOnlyBySection' => [
		// 'DEFAULT' => 'Maintenance ongoing on the database server.',
		//'c1' => 'Maintenance ongoing on the database server.',
		//'c2' => 'Maintenance ongoing on the database server.',
		//'c3' => 'Maintenance ongoing on the database server.',
		//'c4' => 'Maintenance ongoing on the database server.',
	],
];
