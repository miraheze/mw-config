<?php

$wgMemCachedPersistent = false;

// Set timeout to 500ms (in microseconds)
$wgMemCachedTimeout = 0.5 * 1e6;

$wgObjectCaches['memcached-pecl'] = [
	'class'                => 'MemcachedPeclBagOStuff',
	'serializer'           => 'php',
	'persistent'           => false,
	'servers'              => [ $wmgCacheSettings['memcached']['server'] ],
	// Effectively disable the failure limit (0 is invalid)
	'server_failure_limit' => 1e9,
	// Effectively disable the retry timeout
	'retry_timeout'        => -1,
	'loggroup'             => 'memcached',
	'timeout'              => $wgMemCachedTimeout,
];

$wgMainCacheType = 'memcached-pecl';
$wgSessionCacheType = 'memcached-pecl';
$wgSessionsInObjectCache = true;

$wgMessageCacheType = CACHE_DB;
$wgUseLocalMessageCache = true;
$wgParserCacheType = CACHE_DB;
$wgLanguageConverterCacheType = CACHE_DB;

$jobrunnerSettings = $wmgCacheSettings['jobrunner'];
$wgJobTypeConf['default'] = [
	'class' => 'JobQueueRedis',
	'redisServer' => $jobrunnerSettings['server'],
	'redisConfig' => [
		'connectTimeout' => 2,
		'password' => $jobrunnerSettings['password'],
		'compression' => 'gzip',
	],
	'claimTTL' => 3600,
	'daemonized' => true,
];
