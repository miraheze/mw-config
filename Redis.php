<?php

if ( php_sapi_name() !== 'cli' ) {
	$wgObjectCaches['redis'] = [
		'class' => 'RedisBagOStuff',
		'servers' => [ '81.4.127.174:6379' ],
		'password' => $wmgRedisPassword,
		'persistent' => true,
	];

	/*$wgMemCachedServers = [
		'127.0.0.1:11211'
	];*/

	$wgMainCacheType = 'redis';
	$wgSessionCacheType = 'redis';
}
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_NONE;
$wgUseLocalMessageCache = true; // may be required for $wgMessageCacheType = false?
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

if ( php_sapi_name() !== 'cli' ) {
	$wgJobTypeConf['default'] = [
		'class' => 'JobQueueRedis',
		'redisServer' => '81.4.127.174:6379',
		'redisConfig' => [
			'connectTimeout' => 2,
			'password' => $wmgRedisPassword,
			'compression' => 'gzip',
		],
		'claimTTL' => 3600,
		'daemonized' => true,
	];

	$wgJobQueueAggregator = [
		'class' => 'JobQueueAggregatorRedis',
		'redisServers' => [ '81.4.127.174:6379', '81.4.127.174:6379' ], // fake misc2 as fallback
		'redisConfig' => [
			'connectTimeout' => 2,
			'password' => $wmgRedisPassword,
			'compression' => 'gzip',
		]
	];
}
