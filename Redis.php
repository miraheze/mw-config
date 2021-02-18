<?php

// Locally hosted and used for object caching
$wgObjectCaches['redis-central'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ $wmgRedisSettings['cache']['server'] ],
	'password' => $wmgRedisSettings['cache']['password'],
	'loggroup' => 'redis',
	'reportDupes' => false,
];

$wgMemCachedServers = [
	'51.195.236.245:11211'
];

$wgMainCacheType = CACHE_MEMCACHED;
$wgSessionCacheType = CACHE_MEMCACHED;
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_DB;
$wgUseLocalMessageCache = true;
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => $wmgRedisSettings['jobrunner']['server'],
	'redisConfig' => [
		'connectTimeout' => 2,
		'password' => $wmgRedisSettings['jobrunner']['password'],
		'compression' => 'gzip',
	],
	'claimTTL' => 3600,
	'daemonized' => true,
];
