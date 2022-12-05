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

$wgLockManagers[] = [
	'name' => 'redisLockManager',
	'class' => RedisLockManager::class,
	'lockServers' => [
		// jobchron121
		'rdb1' => '[2a10:6740::6:306]:6379',
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

if ( $cwPrivate ) {
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
