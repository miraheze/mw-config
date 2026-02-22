<?php

use MediaWiki\JobQueue\JobQueueRedis;
use Wikimedia\ObjectCache\MemcachedPeclBagOStuff;
use Wikimedia\ObjectCache\MultiWriteBagOStuff;
use Wikimedia\ObjectCache\RedisBagOStuff;

$wgMemCachedServers = [];
$wgMemCachedPersistent = false;

if ( $wi->isBeta() ) {
	/* $wgManageWikiServers = [
		// test151
		'10.0.15.118:443',
	]; */
} else {
	$wgCdnServers = [
		/** cp161 */
		'10.0.16.137:81',
		/** cp171 */
		'10.0.17.138:81',
		/** cp191 */
		'10.0.19.146:81',
		/** cp201 */
		'10.0.20.166:81',
	];

	/* $wgManageWikiServers = [
		// mw151
		'10.0.15.114:443',
		// mw152
		'10.0.15.115:443',
		// mw153
		'10.0.15.140:443',
		// mwtask151
		'10.0.15.150:443',

		// mw161
		'10.0.16.132:443',
		// mw162
		'10.0.16.133:443',
		// mw163
		'10.0.16.151:443',
		// mwtask161
		'10.0.16.157:443',

		// mw171
		'10.0.17.122:443',
		// mw172
		'10.0.17.123:443',
		// mw173
		'10.0.17.153:443',
		// mwtask171
		'10.0.17.144:443',

		// mw181
		'10.0.18.104:443',
		// mw182
		'10.0.18.105:443',
		// mw183
		'10.0.18.155:443',
		// mwtask181
		'10.0.18.106:443',

		// mw191
		'10.0.19.160:443',
		// mw192
		'10.0.19.161:443',
		// mw193
		'10.0.19.164:443',

		// mw201
		'10.0.20.162:443',
		// mw202
		'10.0.20.163:443',
		// mw203
		'10.0.20.165:443',
	]; */
}

$wgObjectCaches['mcrouter'] = [
	'class' => MemcachedPeclBagOStuff::class,
	'serializer' => 'php',
	'persistent' => false,
	'servers' => [ '127.0.0.1:11213' ],
	'server_failure_limit' => 1e9,
	'retry_timeout' => -1,
	'loggroup' => 'memcached',
	// 250ms, in microseconds
	'timeout' => 0.25 * 1e6,
	'allow_tcp_nagle_delay' => false,
];

$wgObjectCaches['mcrouter-primary-dc'] = array_merge(
	$wgObjectCaches['mcrouter'],
	[ 'routingPrefix' => '/wikitide/mw/' ]
);

$wgMirahezeMagicMemcachedServers = [
	[ '10.0.15.113', 11211 ],
	[ '10.0.16.131', 11211 ],
	[ '10.0.20.148', 11211 ],
	[ '10.0.19.154', 11211 ],
];

if ( $wi->isBeta() ) {
	$wgMirahezeMagicMemcachedServers = [
		[ '10.0.15.118', 11211 ],
	];
}

$wgObjectCaches['mysql-multiwrite'] = [
	'class' => MultiWriteBagOStuff::class,
	'caches' => [
		0 => [
			'factory' => [ 'ObjectCache', 'getInstance' ],
			'args' => [ 'mcrouter' ],
		],
		1 => [
			'class' => SqlBagOStuff::class,
			'servers' => [
				'pc1' => [
					'type' => 'mysql',
					'host' => $wi->isBeta() ? '10.0.17.158' : '10.0.20.169',
					'dbname' => $wi->isBeta() ? 'testparsercache' : 'parsercache',
					'user' => $wgDBuser,
					'password' => $wgDBpassword,
					'flags' => 0,
				],
			],
			'purgePeriod' => 0,
			'tableName' => 'pc',
			'shards' => $wi->isBeta() ? 1 : 256,
			'reportDupes' => false,
		],
	],
	'replication' => 'async',
	'reportDupes' => false,
];

$wgObjectCaches['db-mainstash'] = [
	'class' => SqlBagOStuff::class,
	'cluster' => $wi->isBeta() ? 'beta' : 'echo',
	'dbDomain' => $wi->isBeta() ? 'testmainstash' : 'mainstash',
	'tableName' => 'objectstash',
	'multiPrimaryMode' => false,
	'purgePeriod' => 100,
	'purgeLimit' => 1000,
	'reportDupes' => false,
];

$wgMainStash = 'db-mainstash';
$wgMicroStashType = 'mcrouter-primary-dc';

$wgObjectCaches['redis-session'] = [
	'class' => RedisBagOStuff::class,
	'servers' => [ $wi->isBeta() ? '10.0.15.118:6379' : '10.0.19.149:6379' ],
	'password' => $wmgRedisPassword,
	'loggroup' => 'redis',
	'reportDupes' => false,
];

$wgSessionCacheType = 'redis-session';
$wgCentralAuthSessionCacheType = 'redis-session';
$wgEchoSeenTimeCacheType = 'redis-session';

$wgCreateWikiCacheType = 'mcrouter';
$wgManageWikiCacheType = 'mcrouter';

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
	// Defaults to using MainStash
	'StashType' => null,
	// 24h in production, VE will fail to save after this time.
	'StashDuration' => 24 * 60 * 60,
	// Only cache if parsing takes longer than n seconds; 0 means cache all.
	'CacheThresholdTime' => $wgDBname === 'commonswiki' ? 1.0 : 0.0,
	// Disable cache warming on commonswiki for now.
	'WarmParsoidParserCache' => $wgDBname === 'commonswiki' ? false : true,
];

if ( $wgDBname === 'commonswiki' ) {
	$wgParserCacheFilterConfig['parsoid-pcache'] += [
		// Disable parsoid-pcache for file description pages on commonswiki.
		NS_FILE => [
			// Cache none
			'minCpuTime' => PHP_INT_MAX,
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

$wgDPLAlwaysCacheResults = true;
$wgDPLQueryCacheTime = 120;

$wgSearchSuggestCacheExpiry = 10800;

// Disable sidebar cache for select wikis as a solution to T8732, T9699, and T9884
if ( !$wmgSharedDomainPathPrefix && $wgDBname !== 'solarawiki' && $wgDBname !== 'constantnoblewiki' && $wgDBname !== 'nonciclopediawiki' ) {
	$wgEnableSidebarCache = true;
}

$wgUseLocalMessageCache = true;
$wgInvalidateCacheOnLocalSettingsChange = false;

$wgCdnMatchParameterOrder = false;

if ( $wi->isBeta() ) {
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
