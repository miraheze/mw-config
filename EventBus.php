<?php

use MediaWiki\Extension\EventBus\Adapters\EventRelayer\CdnPurgeEventRelayer;
use MediaWiki\Extension\EventBus\Adapters\JobQueue\JobQueueEventBus;
use MediaWiki\Extension\EventBus\Adapters\RCFeed\EventBusRCFeedEngine;
use MediaWiki\Extension\EventBus\Adapters\RCFeed\EventBusRCFeedFormatter;

$wgEnableEventBus = 'TYPE_ALL';

if ( $cwPrivate ) {
	$wgEnableEventBus = 'TYPE_JOB';
}

if ( $wi->dbname === 'loginwiki' ) {
	$wgEnableEventBus = 'TYPE_JOB|TYPE_PURGE';
}

$wgEventServiceDefault = 'eventgate';

$wgEventServices = [
	'eventgate' => [
		'url' => 'http://10.0.18.147:8192/v1/events',
		'timeout' => 62,
	],
];

$wgEventRelayerConfig = [
	'cdn-url-purges' => [
		'class' => CdnPurgeEventRelayer::class,
		'stream' => 'resource-purge',
	],
	'default' => [
		'class' => EventRelayerNull::class,
	],
];

$wgRCFeeds['eventbus'] = [
	'formatter' => EventBusRCFeedFormatter::class,
	'class' => EventBusRCFeedEngine::class,
];

$wgJobTypeConf['default'] = [
	'class' => JobQueueEventBus::class,
	'readOnlyReason' => false
];

$jobQueueRedis = [
	'class' => JobQueueRedis::class,
	'redisServer' => '10.0.17.120:6379',
	'redisConfig' => [
		'connectTimeout' => 2,
		'password' => $wmgRedisPassword,
		'compression' => 'gzip',
	],
	'daemonized' => true,
];

$wgJobTypeConf['LocalPageMoveJob'] = $jobQueueRedis;
$wgJobTypeConf['LocalRenameUserJob'] = $jobQueueRedis;
$wgJobTypeConf['RemovePIIJob'] = $jobQueueRedis;
$wgJobTypeConf['SetContainersAccessJob'] = $jobQueueRedis;
$wgJobTypeConf['securePollPopulateVoterList'] = $jobQueueRedis;
$wgJobTypeConf['EchoNotificationJob'] = $jobQueueRedis;
$wgJobTypeConf['RecordLintJob'] = $jobQueueRedis;

// Don't need a global here
unset( $jobQueueRedis );

$wgEventBusEnableRunJobAPI =
	wfHostname() === 'mwtask151' ||
	wfHostname() === 'mwtask161' ||
	wfHostname() === 'mwtask171' ||
	wfHostname() === 'mwtask181';
