<?php
$wgObjectCaches['redis'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ '127.0.0.1:22121' ],
	'password' => $wmgRedisPassword,
	'persistent' => true,
];

/*$wgMemCachedServers = [
	'127.0.0.1:11211'
];*/

$wgMainCacheType = 'redis';
$wgSessionCacheType = 'redis';
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_NONE;
$wgUseLocalMessageCache = true; // may be required for $wgMessageCacheType = false?
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => '127.0.0.1:22121',
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
	'redisServers' => [ '127.0.0.1:22121', '127.0.0.1:22121' ], // fake misc2 as fallback
	'redisConfig' => [
		'connectTimeout' => 2,
		'password' => $wmgRedisPassword,
		'compression' => 'gzip',
	]
];
