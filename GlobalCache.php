<?php

$wgMemCachedServers = [
	'127.0.0.1:11212',
	'127.0.0.1:11213',
];
$wgRedisServerIP = '[2a10:6740::6:306]:6379';

$wgMainCacheType = 'memcached-pecl';
$wgParserCacheType = 'db-replicated';
$wgLanguageConverterCacheType = CACHE_ACCEL;

$wgParserCacheExpireTime = 86400 * 10; // 10 days
$wgRevisionCacheExpiry = 86400 * 3; // 3 days

$wgDLPQueryCacheTime = 120;
$wgDplSettings['queryCacheTime'] = 120;

// Currently we can't set this if GroupsSidebar us used.
// This should ideally be patched upstream, converting the hook used
// to SidebarBeforeOutput rather than SkinBuildSidebar, which is
// more appropriate for this extension.
// Also disable sidebar cache for solarawiki as a solution to T8732
if ( !$wgConf->get( 'wmgUseGroupsSidebar', $wi->dbname ) && $wgDBname !== 'solarawiki' ) {
	$wgEnableSidebarCache = true;
}

$wgUseLocalMessageCache = true;
$wgInvalidateCacheOnLocalSettingsChange = false;

// session cache needs to be flipped for betaheze to avoid session conflicts
$wgObjectCaches['memcached-mem-1'] = [
	'class'                => MemcachedPeclBagOStuff::class,
	'serializer'           => 'php',
	'persistent'           => false,
	'servers'              => [ '127.0.0.1:11212' ],
	// Effectively disable the failure limit (0 is invalid)
	'server_failure_limit' => 1e9,
	// Effectively disable the retry timeout
	'retry_timeout'        => -1,
	'loggroup'             => 'memcached',
	'timeout'              => 0.5 * 1e6, // 500ms, in microseconds
];

$wgObjectCaches['memcached-mem-2'] = [
	'class'                => MemcachedPeclBagOStuff::class,
	'serializer'           => 'php',
	'persistent'           => false,
	'servers'              => [ '127.0.0.1:11213' ],
	// Effectively disable the failure limit (0 is invalid)
	'server_failure_limit' => 1e9,
	// Effectively disable the retry timeout
	'retry_timeout'        => -1,
	'loggroup'             => 'memcached',
	'timeout'              => 0.5 * 1e6, // 500ms, in microseconds
];

$wgConf->settings['wgSessionCacheType']['default'] = 'memcached-mem-2';
$wgConf->settings['wgSessionCacheType']['betaheze'] = 'memcached-mem-1';

if ( preg_match( '/^(.*)\.betaheze\.org$/', $wi->server ) ) {
	$wgMainWANCache = 'betaheze';
	$wgWANObjectCaches['betaheze'] = [
		'class' => WANObjectCache::class,
		'cacheId' => 'memcached-mem-1',
	];
	$wgRedisServerIP = '[2a10:6740::6:109]:6379';
}

$wgJobTypeConf['default'] = [
	'class' => JobQueueRedis::class,
	'redisServer' => $wgRedisServerIP,
	'redisConfig' => [
		'connectTimeout' => 2,
		'password' => $wmgRedisPassword,
		'compression' => 'gzip',
	],
	'claimTTL' => 3600,
	'daemonized' => true,
];

if ( PHP_SAPI === 'cli' ) {
	# APC not available in CLI mode
	$wgLanguageConverterCacheType = CACHE_NONE;
}
