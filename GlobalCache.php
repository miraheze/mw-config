<?php

$wgMemCachedServers = [];
$wgMemCachedPersistent = false;

$beta = preg_match( '/^(.*)\.mirabeta\.org$/', $wi->server );

$wgObjectCaches['mcrouter'] = [
	'class'                 => 'MemcachedPeclBagOStuff',
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
					'type'      => 'mysql',
					'host'      => 'db121.miraheze.org',
					'dbname'    => $beta ? 'testparsercache' : 'parsercache',
					'user'      => $wgDBuser,
					'password'  => $wgDBpassword,
					'ssl'       => true,
					'flags'     => 0,
					'sslCAFile' => '/etc/ssl/certs/Sectigo.crt',
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
	'class' => 'SqlBagOStuff',
	'server' => [
		'type'      => 'mysql',
		'host'      => $beta ? 'db121.miraheze.org' : 'db131.miraheze.org',
		'dbname'    => $beta ? 'testmainstash' : 'mainstash',
		'user'      => $wgDBuser,
		'password'  => $wgDBpassword,
		'ssl'       => true,
		'flags'     => 0,
		'sslCAFile' => '/etc/ssl/certs/Sectigo.crt',
	],
	'dbDomain' => 'mainstash',
	'globalKeyLbDomain' => 'mainstash',
	'tableName' => 'objectstash',
	'multiPrimaryMode' => false,
	'purgePeriod' => 100,
	'purgeLimit' => 1000,
	'reportDupes' => false
];

$wgMainStash = 'db-mainstash';

$wgStatsCacheType = 'mcrouter';
$wgMicroStashType = 'mcrouter';

$wgSessionCacheType = 'mcrouter';

// Same as $wgMainStash
$wgMWOAuthSessionCacheType = 'db-mainstash';

$wgMainCacheType = 'mcrouter';
$wgMessageCacheType = 'mcrouter';

$wgParserCacheType = 'mysql-multiwrite';

$wgChronologyProtectorStash = 'mcrouter';

$wgParsoidCacheConfig = [
	// Defaults to MainStash
	'StashType' => null,
	// 24h in production, VE will fail to save after this time.
	'StashDuration' => 24 * 60 * 60,
	'CacheThresholdTime' => 0.0,
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

$redisServerIP = $beta ?
	'[2a10:6740::6:406]:6379' :
	'[2a10:6740::6:306]:6379';

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

if ( PHP_SAPI === 'cli' ) {
	// APC not available in CLI mode
	$wgLanguageConverterCacheType = CACHE_NONE;
}

unset( $redisServerIP );
