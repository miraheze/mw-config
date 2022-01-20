<?php

$wgMemCachedServers = [
	// '127.0.0.1:11212',
	'127.0.0.1:11213',
];

$wgMainCacheType = 'memcached-pecl';
$wgParserCacheType = 'db-replicated';
$wgLanguageConverterCacheType = CACHE_ACCEL;

$wgParserCacheExpireTime = 86400 * 10;
$wgDLPQueryCacheTime = 120;

$wgEnableSidebarCache = false;
$wgUseLocalMessageCache = true;
$wgInvalidateCacheOnLocalSettingsChange = false;

// session cache needs to be flipped for betaheze to avoid session conflicts
/* $wgObjectCaches['memcached-mem-1'] = [
	'class'                => 'MemcachedPeclBagOStuff',
	'serializer'           => 'php',
	'persistent'           => false,
	'servers'              => [ '127.0.0.1:11212' ],
	// Effectively disable the failure limit (0 is invalid)
	'server_failure_limit' => 1e9,
	// Effectively disable the retry timeout
	'retry_timeout'        => -1,
	'loggroup'             => 'memcached',
	'timeout'              => 0.5 * 1e6, // 500ms, in microseconds
]; */

$wgObjectCaches['memcached-mem-2'] = [
	'class'                => 'MemcachedPeclBagOStuff',
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

$wi->config->settings['wgSessionCacheType']['default'] = 'memcached-mem-2';
// $wi->config->settings['wgSessionCacheType']['betaheze'] = 'memcached-mem-1';

$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => '[2a10:6740::6:306]:6379',
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
