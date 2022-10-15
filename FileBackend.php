<?php

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
	'zones' => $wmgPrivateUploads
		? [
			'thumb' => [ 'url' => "$wgScriptPath/thumb_handler.php" ] ]
		: [],
];

// Used for migrating from FS to Swift.
$fsUploadDir = $wmgPrivateUploads ? "/mnt/mediawiki-static/private/$wgDBname" : "/mnt/mediawiki-static/$wgDBname";

$wgFileBackends[] = [
	'class'              => 'FSFileBackend',
	'name'               => 'local-backend-fs',
	'lockManager'        => 'fsLockManager',
	'containerPaths'     => [
		'local-public'      => $fsUploadDir,
		'local-thumb'       => "$fsUploadDir/thumb",
		'local-transcoded'  => "$fsUploadDir/transcoded",
		// 'local-deleted'     => "$fsUploadDir/deleted",
		'local-temp'        => "$fsUploadDir/temp",
	],
	'fileMode' => 420,
	'directoryMode' => 511,
];

$wgLocalFileRepo = [
	'class' => 'LocalRepo',
	'name' => 'fs-local',
	'backend' => 'local-backend-fs',
	'directory' => $fsUploadDir,
	'scriptDirUrl' => $wgScriptPath,
	'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
	'hashLevels' => $wgHashedUploadDirectory ? 2 : 0,
	'thumbScriptUrl' => $wgThumbnailScriptPath,
	'transformVia404' => !$wgGenerateThumbnailOnParse,
	'deletedDir' => $wgDeletedDirectory,
	'deletedHashLevels' => $wgHashedUploadDirectory ? 3 : 0,
	'isPrivate' => $wmgPrivateUploads,
	'zones' => $wmgPrivateUploads
		? [
			'thumb' => [ 'url' => "$wgScriptPath/thumb_handler.php" ] ]
		: [],
];
