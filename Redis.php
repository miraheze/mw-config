<?php
$wgObjectCaches['redis'] = [
	'class' => 'RedisBagOStuff',
	'servers' => [ '81.4.127.174:6379' ],
	'password' => $wmgRedisPassword,
	'persistent' => true,
];

if ( wfHostname() == 'test1' ) {
	$wgMemCachedServers = [
		'127.0.0.1:11211'
	];
}

$wgMainCacheType = 'redis'; // CACHE_MEMCACHED causes login problems
$wgSessionCacheType = 'redis';
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_NONE;
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
