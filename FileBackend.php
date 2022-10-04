<?php

$wgFileBackends[] = [
	'class'              => 'SwiftFileBackend',
	'name'               => 'miraheze-swift',
	'wikiId'             => $wgDBname,
	'lockManager'        => 'nullLockManager',
	'swiftAuthUrl'       => 'https://swift-lb.miraheze.org/auth',
	'swiftStorageUrl'    => 'https://swift-lb.miraheze.org/v1/AUTH_mw',
	'swiftUser'          => 'mw:media',
	'swiftKey'           => $wmgSwiftAdminPassword,
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

$wgLocalFileRepo = [
	'class' => 'LocalRepo',
	'name' => 'local',
	'backend' => 'miraheze-swift',
	'directory' => $wgUploadDirectory,
	'scriptDirUrl' => $wgScriptPath,
	'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
	'hashLevels' => $wgHashedUploadDirectory ? 2 : 0,
	'thumbScriptUrl' => $wgThumbnailScriptPath,
	'transformVia404' => !$wgGenerateThumbnailOnParse,
	'deletedDir' => $wgDeletedDirectory,
	'deletedHashLevels' => $wgHashedUploadDirectory ? 3 : 0,
	'thumbDir' => "$wgUploadDirectory/thumb",
	'isPrivate' => $wmgPrivateUpload,
	'zones' => [
		'public'  => [
			'container' => 'mw',
		],
		'thumb'   => [
			'container' => 'mw',
			'directory' => 'thumb',
		],
		'temp'    => [
			'container' => 'mw',
			'directory' => 'temp',
		],
		'deleted' => [
			'container' => 'mw',
			'directory' => 'deleted',
		],
		'archive' => [
			'container' => 'mw',
			'directory' => 'archive',
		],
		'awards' => [
			'container' => 'mw',
			'directory' => 'awards',
		],
		'avatars' => [
			'container' => 'mw',
			'directory' => 'avatars',
		],
		'lockdir' => [
			'container' => 'mw',
			'directory' => 'lockdir',
		],
		'timeline' => [
			'container' => 'mw',
			'directory' => 'timeline',
		],
		'math' => [
			'container' => 'mw',
			'directory' => 'math',
		],
		'transcoded' => [
			'container' => 'mw',
			'directory' => 'transcoded',
		],
	],
];
