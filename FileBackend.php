<?php

$wgFileBackends[] = [
	'class'              => SwiftFileBackend::class,
	'name'               => 'miraheze-swift',
	// This is the prefix for the container that it starts with.
	'wikiId'             => "miraheze-$wgDBname",
	'lockManager'        => 'redisLockManager',
	'swiftAuthUrl'       => 'https://swift-lb.wikitide.net/auth',
	'swiftStorageUrl'    => 'https://swift-lb.wikitide.net/v1/AUTH_mw',
	'swiftUser'          => 'mw:media',
	'swiftKey'           => $wmgSwiftPassword,
	'swiftTempUrlKey'    => '',
	'parallelize'        => 'implicit',
	'cacheAuthInfo'      => true,
	'readAffinity'       => true,
	'readUsers'           => [ 'mw:media' ],
	'writeUsers'          => [ 'mw:media' ],
	'connTimeout'         => 10,
	'reqTimeout'          => 900,
];

$beta = preg_match( '/^(.*)\.(mirabeta|nexttide)\.org$/', $wi->server );
$redisServerIP = $beta ?
	'10.0.15.118:6379' :
	'10.0.15.142:6379';

$wgLockManagers[] = [
	'name' => 'redisLockManager',
	'class' => RedisLockManager::class,
	'lockServers' => [
		'rdb1' => $redisServerIP,
	],
	'srvsByBucket' => [
		0 => [ 'rdb1' ]
	],
	'redisConfig' => [
		'connectTimeout' => 2,
		'readTimeout' => 2,
		'password' => $wmgRedisPassword,
	]
];

$wgGenerateThumbnailOnParse = false;
$wgUploadThumbnailRenderMethod = 'http';
$wgUploadThumbnailRenderHttpCustomHost = 'static.wikitide.net';
$wgUploadThumbnailRenderHttpCustomDomain = 'swift-lb.wikitide.net';

$wgThumbnailBuckets = [ 1920 ];
$wgThumbnailMinimumBucketDistance = 100;

// Thumbnail prerendering at upload time
$wgUploadThumbnailRenderMap = [ 320, 640, 800, 1024, 1280, 1920 ];

if ( $cwPrivate ) {
	$wgUploadThumbnailRenderMap = [];
	$wgUploadPath = '/w/img_auth.php';
	$wgImgAuthUrlPathMap = [
		'/avatars/' => 'mwstore://miraheze-swift/avatars/',
		'/awards/' => 'mwstore://miraheze-swift/awards/',
		'/dumps/' => 'mwstore://miraheze-swift/dumps-backup/',
		'/score/' => 'mwstore://miraheze-swift/score-render/',
		'/phonos-render/' => 'mwstore://miraheze-swift/phonos-render/',
		'/timeline/' => 'mwstore://miraheze-swift/timeline-render/',
		'/upv2avatars/' => 'mwstore://miraheze-swift/upv2avatars/',
	];
}

if ( $wgDBname === 'hololivewiki' ) {
	// default: 3600 * 6 (6 hours)
	// hololivewiki: 86400 * 7 (7 days) (T11973)
	$wgUploadStashMaxAge = 86400 * 7;
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
	'isPrivate' => $cwPrivate,
	'zones' => $cwPrivate
		? [
			'thumb' => [ 'url' => "$wgScriptPath/thumb_handler.php" ] ]
		: [],
];
