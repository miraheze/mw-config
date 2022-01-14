<?php

$wgMemCachedPersistent = false;

// Set timeout to 500ms (in microseconds)
$wgMemCachedTimeout = 0.5 * 1e6;

$ovlon = [ 'test3', 'mw8', 'mw9', 'mw10', 'mw11', 'mw12', 'mw13', 'mwtask1' ];
if ( in_array( wfHostname(), $ovlon ) ) {
	$wmgJobrunnerServer = '51.195.236.215:6379';
	$wmgMem1Server = '51.195.236.223:11211';
	$wmgMem2Server = '51.195.236.245:11211';
	$wmgMemcachedClass = 'MemcachedPhpBagOStuff';
} else {
	$wmgJobrunnerServer = '[2a10:6740::6:306]:6379';
	$wmgMem1Server = '127.0.0.1:11212';
	$wmgMem2Server = '127.0.0.1:11213';
	$wmgMemcachedClass = 'MemcachedPeclBagOStuff';
}

$wgObjectCaches['memcached-mem-1'] = [
	'class'                => $wmgMemcachedClass,
	'serializer'           => 'php',
	'persistent'           => false,
	'servers'              => [ $wmgMem1Server ],
	// Effectively disable the failure limit (0 is invalid)
	'server_failure_limit' => 1e9,
	// Effectively disable the retry timeout
	'retry_timeout'        => -1,
	'loggroup'             => 'memcached',
	'timeout'              => $wgMemCachedTimeout,
];

$wgObjectCaches['memcached-mem-2'] = [
	'class'                => $wmgMemcachedClass,
	'serializer'           => 'php',
	'persistent'           => false,
	'servers'              => [ $wmgMem2Server ],
	// Effectively disable the failure limit (0 is invalid)
	'server_failure_limit' => 1e9,
	// Effectively disable the retry timeout
	'retry_timeout'        => -1,
	'loggroup'             => 'memcached',
	'timeout'              => $wgMemCachedTimeout,
];

$wi->config->settings['wgMainCacheType']['default'] = 'memcached-mem-2';
$wi->config->settings['wgMainCacheType']['betaheze'] = 'memcached-mem-1';

$wi->config->settings['wgSessionCacheType']['default'] = 'memcached-mem-2';
$wi->config->settings['wgSessionCacheType']['betaheze'] = 'memcached-mem-1';

$wgSessionsInObjectCache = true;

$wi->config->settings['wgMessageCacheType']['default'] = 'memcached-mem-1';
$wi->config->settings['wgMessageCacheType']['betaheze'] = 'memcached-mem-2';

$wgUseLocalMessageCache = true;
$wgParserCacheType = CACHE_DB;
$wgParserCacheExpireTime = 86400 * 10;

$wi->config->settings['wgLanguageConverterCacheType']['default'] = 'memcached-mem-1';
$wi->config->settings['wgLanguageConverterCacheType']['betaheze'] = 'memcached-mem-2';

$wgInvalidateCacheOnLocalSettingsChange = false;

$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => $wmgJobrunnerServer,
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
	$wi->config->settings['wgLanguageConverterCacheType']['default'] = CACHE_NONE;
	$wi->config->settings['wgLanguageConverterCacheType']['betaheze'] = CACHE_NONE;
}
