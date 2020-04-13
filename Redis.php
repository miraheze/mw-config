<?php

// Locally hosted and used for object caching
$wgObjectCaches['redis-central'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ '/run/nutcracker/nutcracker.sock' ],
	'password' => $wmgRedisPassword,
	'persistent' => true,
	'loggroup' => 'redis',
	'reportDupes' => false,
];


$wgMainCacheType = 'redis-central';
$wgSessionCacheType = 'redis-central';
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_DB;
$wgUseLocalMessageCache = true;
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

$wmgRedisJobrunnerIp = '51.89.160.135';
$wmgRedisJobrunnerPort = '6379';

$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => "{$wmgRedisJobrunnerIp}:{$wmgRedisJobrunnerPort}",
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
	'redisServers' => [
		"{$wmgRedisJobrunnerIp}:{$wmgRedisJobrunnerPort}",
		"{$wmgRedisJobrunnerIp}:{$wmgRedisJobrunnerPort}"
	], // fake redis fallback
	'redisConfig' => [
		'connectTimeout' => 2,
		'password' => $wmgRedisPassword,
		'compression' => 'gzip',
	]
];
