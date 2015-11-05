<?php
$wgObjectCaches['redis'] = array(
	'class' => 'RedisBagOStuff',
	'servers' => array( '185.52.1.76:6379' ),
	'password' => $wmgRedisPassword,
);

$wgMainCacheType = CACHE_DB;
$wgSessionCacheType = 'redis';
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_NONE;
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

$wgJobTypeConf['default'] = array(
	'class' => 'JobQueueRedis',
	'redisServer' => '185.52.1.76:6379',
	'redisConfig' => array(
		'connectTimeout' => 2,
		'password' => $wmgRedisPassword,
		'compression' => 'gzip',
	),
	'claimTTL' => 3600,
	'daemonized' => true,
);
