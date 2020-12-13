<?php

// Locally hosted and used for object caching
$wgObjectCaches['redis-central'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ $wmgRedisSettings['cache']['server'] ],
	'password' => $wmgRedisSettings['cache']['password'],
	'persistent' => true,
	'loggroup' => 'redis',
	'reportDupes' => false,
];


$wgMainCacheType = 'redis-central';
$wgSessionCacheType = 'redis-central';
$wgSessionsInObjectCache = true;

$wgMessageCacheType = 'redis-central';
$wgUseLocalMessageCache = true;
$wgParserCacheType = 'redis-central';
$wgLanguageConverterCacheType = 'redis-central';

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
