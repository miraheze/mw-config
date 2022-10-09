<?php

$wgFileBackends[] = [
	'class'              => 'SwiftFileBackend',
	'name'               => 'miraheze-swift',
	// This makes the container start with miraheze-dbname-.
	// We re-rewrite the url so it hits a different container then specified here
	// public go to miraheze-mw and private go to miraheze-mw-private.
	'wikiId'             => 'miraheze-$wgDBname',
	'lockManager'        => 'nullLockManager',
	'swiftAuthUrl'       => 'https://swift-lb.miraheze.org/auth',
	'swiftStorageUrl'    => 'https://swift-lb.miraheze.org/v1/AUTH_mw',
	'swiftUser'          => 'mw:media',
	'swiftKey'           => $wmgSwiftPassword,
	'shardViaHashLevels' => [
		'public'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'thumb'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'temp'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'transcoded'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'deleted'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
	],
	'parallelize'        => 'implicit',
	'cacheAuthInfo'      => true,
	'readAffinity'       => true,
	'readUsers'           => [ 'mw:media' ],
	'writeUsers'          => [ 'mw:media' ],
	'connTimeout'         => 10,
	'reqTimeout'          => 900,
];

$container = $wmgPrivateUploads ? 'mw-private' : 'mw';
// Public
$dataDumpContainer = 'mw';

$dataDumpPath = "$wgDBname/dumps";

if ( $cwPrivate ) {
	// Private
	$dataDumpContainer = 'mw-private';
	if ( !$wmgPrivateUploads ) {
		$dataDumpPath = "dumps/$wgDBname";
	}
}

$wgLocalFileRepo = [
	'class' => 'LocalRepo',
	'name' => 'local',
	'backend' => 'miraheze-swift',
	'scriptDirUrl' => $wgScriptPath,
	'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
	'hashLevels' => $wgHashedUploadDirectory ? 2 : 0,
	'thumbScriptUrl' => $wgThumbnailScriptPath,
	'transformVia404' => !$wgGenerateThumbnailOnParse,
	'deletedDir' => $wgDeletedDirectory,
	'deletedHashLevels' => $wgHashedUploadDirectory ? 3 : 0,
	'isPrivate' => $wmgPrivateUploads,
	// new folders need to be added to puppet/modules/swift/files/SwiftMedia/miraheze/rewrite.py
	'zones' => [
		'public'  => [
			'container' => $container,
			'directory' => $wgDBname,
		],
		'thumb'   => [
			'container' => $container,
			'directory' => "$wgDBname/thumb",
		],
		'temp'    => [
			'container' => $container,
			'directory' => "$wgDBname/temp",
		],
		'deleted' => [
			'container' => $container,
			'directory' => "$wgDBname/deleted",
		],
		'archive' => [
			'container' => $container,
			'directory' => "$wgDBname/archive",
		],
		'awards' => [
			'container' => $container,
			'directory' => "$wgDBname/awards",
		],
		'avatars' => [
			'container' => $container,
			'directory' => "$wgDBname/avatars",
		],
		'lockdir' => [
			'container' => $container,
			'directory' => "$wgDBname/lockdir",
		],
		'timeline-render' => [
			'container' => $container,
			'directory' => "$wgDBname/timeline",
		],
		'score-render' => [
			'container' => $container,
			'directory' => "$wgDBname/score",
		],
		'math' => [
			'container' => $container,
			'directory' => "$wgDBname/math",
		],
		'transcoded' => [
			'container' => $container,
			'directory' => "$wgDBname/transcoded",
		],
		'dumps-backup' => [
			'container' => $dataDumpContainer,
			'directory' => $dataDumpPath,
		],
		// As meta is the set wiki we use the public container.
		'ImportDump' => [
			'container' => 'miraheze-mw',
			'directory' => "$wgImportDumpCentralWiki/ImportDump",
		],
	],
];
