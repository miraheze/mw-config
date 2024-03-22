<?php

$wgMemCachedServers = [];
$wgMemCachedPersistent = false;

$beta = preg_match( '/^(.*)\.mirabeta\.org$/', $wi->server );

$wgObjectCaches['mcrouter'] = [
	'class'                 => MemcachedPeclBagOStuff::class,
	'serializer'            => 'php',
	'persistent'            => false,
	'servers'               => [ '127.0.0.1:11213' ],
	'server_failure_limit'  => 1e9,
	'retry_timeout'         => -1,
	'loggroup'              => 'memcached',
	// 500ms, in microseconds
	'timeout'               => 0.5 * 1e6,
	'allow_tcp_nagle_delay' => false,
];

$wgMirahezeMagicMemcachedServers = [
	[ '10.0.15.113', 11211 ],
	[ '10.0.16.131', 11211 ],
];

$wgObjectCaches['mysql-multiwrite'] = [
	'class' => MultiWriteBagOStuff::class,
	'caches' => [
		0 => [
			'factory' => [ 'ObjectCache', 'getInstance' ],
			'args' => [ 'mcrouter' ]
		],
		1 => [
			'class' => SqlBagOStuff::class,
			'servers' => [
				'pc1' => [
					'type'     => 'mysql',
					'host'     => '10.0.16.128',
					'dbname'   => $beta ? 'testparsercache' : 'parsercache',
					'user'     => $wgDBuser,
					'password' => $wgDBpassword,
					'flags'    => 0,
				],
			],
			'purgePeriod' => 0,
			'tableName' => 'pc',
			'shards' => $beta ? 1 : 256,
			'reportDupes' => false
		],
	],
	'replication' => 'async',
	'reportDupes' => false
];

$wgObjectCaches['db-mainstash'] = [
	'class' => SqlBagOStuff::class,
	'cluster' => $beta ? 'beta' : 'echo',
	'dbDomain' => $beta ? 'testmainstash' : 'mainstash',
	'tableName' => 'objectstash',
	'multiPrimaryMode' => false,
	'purgePeriod' => 100,
	'purgeLimit' => 1000,
	'reportDupes' => false
];

$wgMainStash = 'db-mainstash';

$wgStatsCacheType = 'mcrouter';
$wgMicroStashType = 'mcrouter';

$wgObjectCaches['redis-session'] = [
	'class' => RedisBagOStuff::class,
	'servers' => [ $beta ? '10.0.15.118:6379' : '10.0.15.142:6379' ],
	'password' => $wmgRedisPassword,
	'loggroup' => 'redis',
	'reportDupes' => false,
];

$wgSessionCacheType = 'redis-session';
$wgCentralAuthSessionCacheType = 'redis-session';
$wgEchoSeenTimeCacheType = 'redis-session';

$wgCreateWikiCacheType = 'redis-session';

$wgSessionName = $wgDBname . 'Session';

// Same as $wgMainStash
$wgMWOAuthSessionCacheType = 'db-mainstash';

// Same as $wgMainCacheType
$wgMWOAuthNonceCacheType = 'mcrouter';

$wgMainCacheType = 'mcrouter';
$wgMessageCacheType = 'mcrouter';

$wgParserCacheType = 'mysql-multiwrite';

$wgChronologyProtectorStash = 'mcrouter';

$wgParsoidCacheConfig = [
	// Defaults to MainStash
	'StashType' => null,
	// 24h in production, VE will fail to save after this time.
	'StashDuration' => 24 * 60 * 60,
	'CacheThresholdTime' => $wgDBname === 'commonswiki' ? 1.0 : 0.0,
	'WarmParsoidParserCache' => $wgDBname !== 'commonswiki' ? true : false,
];

$wgLanguageConverterCacheType = CACHE_ACCEL;

$wgQueryCacheLimit = 5000;

// 7 days
$wgParserCacheExpireTime = 86400 * 7;

// 3 days
$wgRevisionCacheExpiry = 86400 * 3;

// 1 day
$wgObjectCacheSessionExpiry = 86400;

// 7 days
$wgDLPMaxCacheTime = 604800;

$wgDLPQueryCacheTime = 120;
$wgDplSettings['queryCacheTime'] = 120;

$wgSearchSuggestCacheExpiry = 10800;

// Disable sidebar cache for select wikis as a solution to T8732, T9699, and T9884
if ( $wgDBname !== 'solarawiki' && $wgDBname !== 'constantnoblewiki' && $wgDBname !== 'nonciclopediawiki' ) {
	$wgEnableSidebarCache = true;
}

$wgUseLocalMessageCache = true;
$wgInvalidateCacheOnLocalSettingsChange = false;

$wgResourceLoaderUseObjectCacheForDeps = true;

$wgCdnMatchParameterOrder = false;

if ( $beta || $wi->dbname === 'testwiki' ) {
	wfLoadExtension( 'EventBus' );

	$wgEventServices = [
		'eventgate' => [
			'url' => 'http://10.0.18.147:8192/v1/events',
			'timeout' => 5,
		]
	];

	$wgRCFeeds['eventbus'] = [
		'formatter' => EventBusRCFeedFormatter::class,
		'class' => EventBusRCFeedEngine::class,
	];

	$wgJobTypeConf['default'] = [
		'class' => JobQueueEventBus::class,
		'readOnlyReason' => false
	];

	$wgEventBusEnableRunJobAPI = true;
} else {
	$redisServerIP = $beta ?
		'10.0.15.118:6379' :
		'10.0.17.120:6379';

	$wgJobTypeConf['default'] = [
		'class' => JobQueueRedis::class,
		'redisServer' => $redisServerIP,
		'redisConfig' => [
			'connectTimeout' => 2,
			'password' => $wmgRedisPassword,
			'compression' => 'gzip',
		],
		'daemonized' => true,
	];

	unset( $redisServerIP );
}

if ( PHP_SAPI === 'cli' ) {
	// APC not available in CLI mode
	$wgLanguageConverterCacheType = CACHE_NONE;
}
