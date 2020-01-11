<?php

// Locally hosted and used for object caching
$wgObjectCaches['redis-local'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ '127.0.0.1:6379' ],
	'password' => $wmgRedisPassword,
	'persistent' => true,
	'loggroup' => 'redis',
];

// misc2 (used for sessions)
$wgObjectCaches['redis-central'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ '127.0.0.1:22121' ],
	'password' => $wmgRedisPassword,
	'persistent' => true,
	'loggroup' => 'redis',
];

/*$wgMemCachedServers = [
	'127.0.0.1:11211'
];*/

$wgMainCacheType = 'redis-central';
$wgSessionCacheType = 'redis-central';
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_NONE;
$wgUseLocalMessageCache = true; // may be required for $wgMessageCacheType = false?
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

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
