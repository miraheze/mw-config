<?php

$container = $wmgPrivateUploads ? 'miraheze-mw-private' : 'miraheze-mw';

$wgFileBackends[] = [
	'class'              => 'SwiftFileBackend',
	'name'               => 'miraheze-swift',
	// This is the prefix for the container that it starts with.
	'wikiId'             => 'miraheze',
	'lockManager'        => 'nullLockManager',
	'swiftAuthUrl'       => 'https://swift-lb.miraheze.org/auth',
	'swiftStorageUrl'    => 'https://swift-lb.miraheze.org/v1/AUTH_mw',
	'swiftUser'          => 'mw:media',
	'swiftKey'           => $wmgSwiftPassword,
	'containerPaths' => [
		'local-public' => [
			'container' => $container,
			'directory' => $wgDBname
		],
		'local-thumb' => [
			'container' => $container,
			'directory' => "$wgDBname/thumb"
		],
		'local-temp' => [
			'container' => $container,
			'directory' => "$wgDBname/temp"
		],
		'local-deleted' => [
			'container' => $container,
			'directory' => "$wgDBname/deleted"
		],
		'local-deleted' => [
			'container' => $container,
			'directory' => "$wgDBname/deleted"
		],
		'avatars' => [
			'container' => $container,
			'directory' => "$wgDBname/avatars"
		],
		'award' => [
			'container' => $container,
			'directory' => "$wgDBname/avatars"
		],
		'dumps-backup' => [
			'container' => $container,
			'directory' => "$wgDBname/dumps"
		],
		'score-render' => [
			'container' => $container,
			'directory' => "$wgDBname/score-render"
		],
		'timeline-render' => [
			'container' => $container,
			'directory' => "$wgDBname/timeline"
		],
	],
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
			=> [ 'levels' => 2, 'base' => 36, 'repeat' => 0 ],
	],
	'parallelize'        => 'implicit',
	'cacheAuthInfo'      => true,
	'readAffinity'       => true,
	'readUsers'           => [ 'mw:media' ],
	'writeUsers'          => [ 'mw:media' ],
	'connTimeout'         => 10,
	'reqTimeout'          => 900,
];

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
	'zones' => [],
];
