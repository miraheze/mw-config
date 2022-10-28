<?php

$wgFileBackends[] = [
	'class'              => 'SwiftFileBackend',
	'name'               => 'miraheze-swift',
	// This is the prefix for the container that it starts with.
	'wikiId'             => "miraheze-$wgDBname",
	'lockManager'        => 'nullLockManager',
	'swiftAuthUrl'       => 'https://swift-lb.miraheze.org/auth',
	'swiftStorageUrl'    => 'https://swift-lb.miraheze.org/v1/AUTH_mw',
	'swiftUser'          => 'mw:media',
	'swiftKey'           => $wmgSwiftPassword,
	'shardViaHashLevels' => [
		'local-public'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'local-thumb'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'local-temp'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'local-transcoded'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'local-deleted'
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

// Only use swift as the backend if enabled.
if ( $wmgEnableSwift ) {
	$wgLocalFileRepo = [
		'class' => 'LocalRepo',
		'name' => 'local',
		'backend' => 'miraheze-swift',
		'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
		'scriptDirUrl' => $wgScriptPath,
		'hashLevels' => 2,
		'thumbScriptUrl' => $wgThumbnailScriptPath,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'deletedDir' => $wgDeletedDirectory,
		'deletedHashLevels' => 3,
		'abbrvThreshold' => 160,
		'isPrivate' => $wmgPrivateUploads,
		'zones' => $wmgPrivateUploads
			? [
				'thumb' => [ 'url' => "$wgScriptPath/thumb_handler.php" ] ]
			: [],
	];
}

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
		'local-deleted'     => "$fsUploadDir/deleted",
		'local-temp'        => "$fsUploadDir/temp",
		'avatars'           => "$fsUploadDir/avatars",
		'awards'            => "$fsUploadDir/awards",
		'dumps-backup'      => "$fsUploadDir/dumps",
		'score-render'      => "$fsUploadDir/score",
		'timeline-render'   => "$fsUploadDir/timeline",
	],
	'fileMode' => 420,
	'directoryMode' => 511,
];
