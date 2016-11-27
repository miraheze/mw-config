<?php
$wgObjectCaches['redis'] = array(
	'class' => 'RedisBagOStuff',
	'servers' => array( '81.4.127.174:6379' ),
	'password' => $wmgRedisPassword,
);

$wgMainCacheType = 'redis';
$wgSessionCacheType = CACHE_DB;
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_NONE;
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

$wgJobTypeConf['default'] = array(
	'class' => 'JobQueueRedis',
	'redisServer' => '81.4.127.174:6379',
	'redisConfig' => array(
		'connectTimeout' => 2,
		'password' => $wmgRedisPassword,
		'compression' => 'gzip',
	),
	'claimTTL' => 3600,
	'daemonized' => true,
);

$wgJobQueueAggregator = array(
        'class' => 'JobQueueAggregatorRedis',
        'redisServers' => array( '81.4.127.174:6379', '81.4.127.174:6379' ), // fake misc2 as fallback
        'redisConfig' => array(
                'connectTimeout' => 2,
                'password' => $wmgRedisPassword,
                'compression' => 'gzip',
        )
);
