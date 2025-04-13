<?php

use Wikimedia\ObjectCache\MemcachedPeclBagOStuff;
use Wikimedia\ObjectCache\MultiWriteBagOStuff;
use Wikimedia\ObjectCache\RedisBagOStuff;

$wgMemCachedServers = [];
$wgMemCachedPersistent = false;

$beta = preg_match( '/^(.*)\.(mirabeta|nexttide)\.org$/', $wi->server );

if ( !$beta ) {
	$wgCdnServers = [
		/** cp36 */
		'[2602:294:0:b13::110]:81',
		/** cp37 */
		'[2602:294:0:b23::112]:81',
		/** cp38 */
		'[2602:294:0:b33::102]:81',
	];
}

$wgObjectCaches['mcrouter'] = [
	'class'                 => MemcachedPeclBagOStuff::class,
	'serializer'            => 'php',
	'persistent'            => false,
	'servers'               => [ '127.0.0.1:11213' ],
	'server_failure_limit'  => 1e9,
	'retry_timeout'         => -1,
	'loggroup'              => 'memcached',
	// 250ms, in microseconds
	'timeout'               => 0.25 * 1e6,
	'allow_tcp_nagle_delay' => false,
];

$wgObjectCaches['mcrouter-primary-dc'] = array_merge(
	$wgObjectCaches['mcrouter'],
	[ 'routingPrefix' => "/wikitide/mw/" ]
);

$wgMirahezeMagicMemcachedServers = [
	[ '10.0.15.113', 11211 ],
	[ '10.0.16.131', 11211 ],
	[ '10.0.20.148', 11211 ]
];

if ( $beta ) {
	$wgMirahezeMagicMemcachedServers = [
		[ '10.0.15.118', 11211 ],
	];
}

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
					'host'     => $beta ? '10.0.17.158' : '10.0.16.128',
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

$wgMicroStashType = 'mcrouter-primary-dc';

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

if ( $wgDBname === 'commonswiki' ) {
	$wgParserCacheFilterConfig['parsoid-pcache'] += [
		// disable parsoid-pcache for file description pages on commons
		NS_FILE => [
			// cache none
			'minCpuTime' => PHP_INT_MAX
		],
	];
}

$wgLanguageConverterCacheType = CACHE_ACCEL;

$wgQueryCacheLimit = 5000;

// 15 days
$wgParserCacheExpireTime = 86400 * 15;

// 10 days
$wgDiscussionToolsTalkPageParserCacheExpiry = 86400 * 10;

// 3 days
$wgRevisionCacheExpiry = 86400 * 3;

// 1 day
$wgObjectCacheSessionExpiry = 86400;

// 7 days
$wgDLPMaxCacheTime = 604800;

$wgDLPQueryCacheTime = 120;
$wgDplSettings['queryCacheTime'] = 120;
$wgDplSettings['recursivePreprocess'] = true;

$wgSearchSuggestCacheExpiry = 10800;

// Disable sidebar cache for select wikis as a solution to T8732, T9699, and T9884
if ( $wgDBname !== 'solarawiki' && $wgDBname !== 'constantnoblewiki' && $wgDBname !== 'nonciclopediawiki' ) {
	$wgEnableSidebarCache = true;
}

$wgUseLocalMessageCache = true;
$wgInvalidateCacheOnLocalSettingsChange = false;

$wgCdnMatchParameterOrder = false;

if ( $beta ) {
	$wgJobTypeConf['default'] = [
		'class' => JobQueueRedis::class,
		'redisServer' => '10.0.15.118:6379',
		'redisConfig' => [
			'connectTimeout' => 2,
			'password' => $wmgRedisPassword,
			'compression' => 'gzip',
		],
		'daemonized' => true,
	];
}

if ( PHP_SAPI === 'cli' ) {
	// APC not available in CLI mode
	$wgLanguageConverterCacheType = CACHE_NONE;
}
