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
	'swiftTempUrlKey'    => '',
	'parallelize'        => 'implicit',
	'cacheAuthInfo'      => true,
	'readAffinity'       => true,
	'readUsers'           => [ 'mw:media' ],
	'writeUsers'          => [ 'mw:media' ],
	'connTimeout'         => 10,
	'reqTimeout'          => 900,
];

$beta = preg_match( '/^(.*)\.mirabeta\.org$/', $wi->server );
$scsvg = [ 'mw131', 'mw132', 'mw133', 'mw134', 'mw141', 'mw142', 'mw143', 'mwtask141' ];
if ( in_array( wfHostname(), $scsvg ) ) {
	$redisServerIP = '[2a10:6740::6:306]:6379';
} else {
	$redisServerIP = $beta ?
		'[2602:294:0:c8::109]:6379' :
		'[2602:294:0:b23::102]:6379';
}

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
$wgUploadThumbnailRenderHttpCustomHost = 'static.miraheze.org';
$wgUploadThumbnailRenderHttpCustomDomain = 'swift-lb.miraheze.org';

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
	'isPrivate' => $cwPrivate,
	'zones' => $cwPrivate
		? [
			'thumb' => [ 'url' => "$wgScriptPath/thumb_handler.php" ] ]
		: [],
];
