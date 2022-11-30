<?php

$wgFileBackends[] = [
	'class'              => SwiftFileBackend::class,
	'name'               => 'miraheze-swift',
	// This is the prefix for the container that it starts with.
	'wikiId'             => "miraheze-$wgDBname",
	'lockManager'        => 'redisLockManager',
	'swiftAuthUrl'       => 'https://swift-lb.miraheze.org/auth',
	'swiftStorageUrl'    => 'https://swift-lb.miraheze.org/v1/AUTH_mw',
	'swiftUser'          => 'mw:media',
	'swiftKey'           => $wmgSwiftPassword,
	'parallelize'        => 'implicit',
	'cacheAuthInfo'      => true,
	'readAffinity'       => true,
	'readUsers'           => [ 'mw:media' ],
	'writeUsers'          => [ 'mw:media' ],
	'connTimeout'         => 10,
	'reqTimeout'          => 900,
];

$redisServerIP = '[2a10:6740::6:306]:6379';

$wgLockManagers[] = [
	'name'         => 'redisLockManager',
	'class'        => 'RedisLockManager',
	'lockServers'  => [ 'rdb1' => $redisServerIP ],
	'redisConfig'  => [
		'connectTimeout' => 2,
		'readTimeout'    => 2,
		'password'       => $wmgRedisPassword
	]
];

// Only use swift as the backend if enabled.
if ( $wmgEnableSwift ) {
	$wgGenerateThumbnailOnParse = false;
	$wgUploadThumbnailRenderMethod = 'http';
	$wgUploadThumbnailRenderHttpCustomHost = 'static-new.miraheze.org';
	$wgUploadThumbnailRenderHttpCustomDomain = 'swift-lb.miraheze.org';

	if ( $wmgPrivateUploads ) {
		$wgUploadPath = '/w/img_auth.php';
		$wgImgAuthUrlPathMap = [
			'/dumps/' => 'mwstore://miraheze-swift/dumps-backup/',
			'/timeline/' => 'mwstore://miraheze-swift/timeline-render/',
		];
	}

	$wgLocalFileRepo = [
		'class' => LocalRepo::class,
		'name' => 'local',
		'backend' => 'miraheze-swift',
		'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
		'scriptDirUrl' => $wgScriptPath,
		'hashLevels' => 2,
		'thumbScriptUrl' => $wgThumbnailScriptPath,
		'transformVia404' => true,
		'useJsonMetadata'   => true,
		'useSplitMetadata'  => true,
		'deletedHashLevels' => 3,
		'abbrvThreshold' => 160,
		'isPrivate' => $wmgPrivateUploads,
		'zones' => $cwPrivate
			? [
				'thumb' => [ 'url' => "$wgScriptPath/thumb_handler.php" ] ]
			: [],
	];
}

// Used for migrating from FS to Swift.
$fsUploadDir = $wmgPrivateUploads ? "/mnt/mediawiki-static/private/$wgDBname" : "/mnt/mediawiki-static/$wgDBname";

$wgFileBackends[] = [
	'class'              => FSFileBackend::class,
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

unset( $redisServerIP );
