<?php

$wmgUploadHostname = 'static-new.miraheze.org';

$wgFileBackends[] = [
	'class'              => 'SwiftFileBackend',
	'name'               => 'miraheze-swift',
	'wikiId'             => $wgDBname,
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
	# new folders need to be added to puppet/modules/swift/files/SwiftMedia/miraheze/rewrite.py
	'zones' => [
		'public'  => [
			'container' => $container,
		],
		'thumb'   => [
			'container' => $container,
			'directory' => 'thumb',
		],
		'temp'    => [
			'container' => $container,
			'directory' => 'temp',
		],
		'deleted' => [
			'container' => $container,
			'directory' => 'deleted',
		],
		'archive' => [
			'container' => $container,
			'directory' => 'archive',
		],
		'awards' => [
			'container' => $container,
			'directory' => 'awards',
		],
		'avatars' => [
			'container' => $container,
			'directory' => 'avatars',
		],
		'lockdir' => [
			'container' => $container,
			'directory' => 'lockdir',
		],
		'timeline-render' => [
			'container' => $container,
			'directory' => 'timeline',
		],
		'score-render' => [
			'container' => $container,
			'directory' => 'score',
		],
		'math' => [
			'container' => $container,
			'directory' => 'math',
		],
		'transcoded' => [
			'container' => $container,
			'directory' => 'transcoded',
		],
	],
];
