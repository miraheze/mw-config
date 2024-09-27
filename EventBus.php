<?php

use MediaWiki\Extension\EventBus\Adapters\EventRelayer\CdnPurgeEventRelayer;
use MediaWiki\Extension\EventBus\Adapters\JobQueue\JobQueueEventBus;
use MediaWiki\Extension\EventBus\Adapters\RCFeed\EventBusRCFeedEngine;
use MediaWiki\Extension\EventBus\Adapters\RCFeed\EventBusRCFeedFormatter;
use Wikimedia\EventRelayer\EventRelayerNull;

$wgEnableEventBus = 'TYPE_ALL';

if ( $cwPrivate ) {
	$wgEnableEventBus = 'TYPE_JOB|TYPE_EVENT';
	$wgEventBusStreamNamesMap = [
		'mediawiki.page_change.v1' => 'mediawiki.page_change.private.v1',
		'mediawiki.cirrussearch.page_rerender.v1' =>
			'mediawiki.cirrussearch.page_rerender.private.v1',
	];
}

if ( $wi->dbname === 'loginwiki' || $wi->dbname === 'loginwikibeta' ) {
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

$wgEventBusEnableRunJobAPI =
	wfHostname() === 'mwtask151' ||
	wfHostname() === 'mwtask161' ||
	wfHostname() === 'mwtask171' ||
	wfHostname() === 'mwtask181' ||
	wfHostname() === 'test151';
