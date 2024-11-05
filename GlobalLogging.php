<?php

use MediaWiki\Extension\EventBus\Adapters\Monolog\EventBusMonologHandler;
use MediaWiki\Logger\LoggerFactory;
use MediaWiki\Logger\Monolog\BufferHandler;
use MediaWiki\Logger\Monolog\LogstashFormatter;
use MediaWiki\Logger\Monolog\SyslogHandler;
use MediaWiki\Logger\Monolog\WikiProcessor;
use MediaWiki\Logger\MonologSpi;
use Monolog\Handler\SamplingHandler;
use Monolog\Handler\WhatFailureGroupHandler;
use Monolog\Processor\PsrLogMessageProcessor;
use Monolog\Processor\WebProcessor;
use Psr\Log\LogLevel;

// Monolog logging configuration

$wmgMonologProcessors = [
	'wiki' => [
		'class' => WikiProcessor::class,
	],
	'psr' => [
		'class' => PsrLogMessageProcessor::class,
	],
	'web' => [
		'class' => WebProcessor::class,
	],
	'mhconfig' => [
		'factory' => static function () {
			return static function ( array $record ) {
				global $wgLBFactoryConf, $wgDBname;
				$record['extra']['shard'] = $wgLBFactoryConf['sectionsByDB'][$wgDBname] ?? 'c1';

				return $record;
			};
		}
	],
];

$wmgMonologHandlers = [];

foreach ( [ 'debug', 'info', 'warning', 'error' ] as $logLevel ) {
	$wmgMonologHandlers[ "graylog-$logLevel" ] = [
		'class'     => SyslogHandler::class,
		'formatter' => 'logstash',
		'args'      => [
			// tag
			'mediawiki',
			// host
			'127.0.0.1',
			// port
			10514,
			// facility
			LOG_USER,
			// log level threshold
			$logLevel,
		],
	];
}

$wmgMonologHandlers['what-debug'] = [
	'class'     => WhatFailureGroupHandler::class,
	'formatter' => 'logstash',
	'args' => [
		static function () {
			$provider = LoggerFactory::getProvider();
			return array_map( [ $provider, 'getHandler' ], [ 'graylog-debug' ] );
		}
	],
];

// Post construction calls to make for new Logger instances
$wmgMonologLoggerCalls = [
	'setTimezone' => [ new DateTimeZone( 'UTC' ) ],
];

$wmgMonologConfig = [
	'loggers' => [
		// Template for all undefined log channels
		'@default' => [
			'handlers' => [ 'what-debug' ],
			'processors' => array_keys( $wmgMonologProcessors ),
			'calls' => $wmgMonologLoggerCalls,
		],
	],
	'processors' => $wmgMonologProcessors,
	'handlers' => $wmgMonologHandlers,
	'formatters' => [
		'logstash' => [
			'class' => LogstashFormatter::class,
			'args' => [ 'mediawiki', php_uname( 'n' ), '', '', 1 ],
		],
	],
];

// Add logging channels defined in $wmgMonologChannels
foreach ( $wmgMonologChannels as $channel => $opts ) {
	if ( $opts === false ) {
		// Log channel disabled on this wiki
		$wmgMonologConfig['loggers'][$channel] = [
			'handlers' => [],
			'calls' => $wmgMonologLoggerCalls,
		];
		continue;
	}

	$opts = is_array( $opts ) ? $opts : [ 'graylog' => $opts ];
	$opts = array_merge(
		[
			'graylog' => 'debug',
			'eventbus' => false,
			'buffer' => false,
			'sample' => false,
		],
		$opts
	);

	$handlers = [];

	if ( $opts['eventbus'] ) {
		$eventBusHandler = "eventbus-{$opts['eventbus']}";
		if ( !isset( $wmgMonologConfig['handlers'][$eventBusHandler] ) ) {
			// Register handler that will only pass events of the given log level
			$wmgMonologConfig['handlers'][$eventBusHandler] = [
				'class' => EventBusMonologHandler::class,
				'args' => [
					// EventServiceName
					'eventgate',
				]
			];
		}
		$handlers[] = $eventBusHandler;
	}

	// Configure Graylog handler
	if ( $opts['graylog'] ) {
		$level = $opts['graylog'];
		$graylogHandler = "graylog-{$level}";
		if ( isset( $wmgMonologHandlers[ $graylogHandler ] ) ) {
			$handlers[] = $graylogHandler;
		}
	}

	if ( $opts['sample'] ) {
		$sample = $opts['sample'];
		foreach ( $handlers as $idx => $handlerName ) {
			$sampledHandler = "{$handlerName}-sampled-{$sample}";
			if ( !isset( $wmgMonologConfig['handlers'][$sampledHandler] ) ) {
				// Register a handler that will sample the event stream and
				// pass events on to $handlerName for storage
				$wmgMonologConfig['handlers'][$sampledHandler] = [
					'class' => SamplingHandler::class,
					'args' => [
						static function () use ( $handlerName ) {
							return LoggerFactory::getProvider()->getHandler(
								$handlerName
							);
						},
						$sample,
					],
				];
			}
			$handlers[$idx] = $sampledHandler;
		}
	}

	if ( $opts['buffer'] ) {
		foreach ( $handlers as $idx => $handlerName ) {
			$bufferedHandler = "{$handlerName}-buffered";
			if ( !isset( $wmgMonologConfig['handlers'][$bufferedHandler] ) ) {
				// Register a handler that will buffer the event stream and
				// pass events to the nested handler after closing the request
				$wmgMonologConfig['handlers'][$bufferedHandler] = [
					'class' => BufferHandler::class,
					'args' => [
						static function () use ( $handlerName ) {
							return LoggerFactory::getProvider()->getHandler(
								$handlerName
							);
						},
					],
				];
			}
			$handlers[$idx] = $bufferedHandler;
		}
	}

	if ( $handlers ) {
		// wrap the collection of handlers in a WhatFailureGroupHandler
		// to swallow any exceptions that might leak out otherwise
		$failureGroupHandler = 'failuregroup|' . implode( '|', $handlers );
		if ( !isset( $wmgMonologConfig['handlers'][$failureGroupHandler] ) ) {
			$wmgMonologConfig['handlers'][$failureGroupHandler] = [
				'class' => WhatFailureGroupHandler::class,
				'args' => [
					static function () use ( $handlers ) {
						$provider = LoggerFactory::getProvider();
						return array_map(
							[ $provider, 'getHandler' ],
							$handlers
						);
					}
				],
			];
		}

		$wmgMonologConfig['loggers'][$channel] = [
			'handlers' => [ $failureGroupHandler ],
			'processors' => array_keys( $wmgMonologProcessors ),
			'calls' => $wmgMonologLoggerCalls,
		];

	}
}

if ( $wmgLogToDisk ) {
	$wmgLogDir = '/var/log/mediawiki';

	$wgDBerrorLog = "$wmgLogDir/debuglogs/database.log";

	$wgDebugLogGroups = [
		'404' => "$wmgLogDir/debuglogs/404.log",
		'api' => "$wmgLogDir/debuglogs/api.log",
		'captcha' => "$wmgLogDir/debuglogs/captcha.log",
		'CentralAuth' => "$wmgLogDir/debuglogs/CentralAuth.log",
		'CreateWiki' => "$wmgLogDir/debuglogs/CreateWiki.log",
		'Echo' => "$wmgLogDir/debuglogs/Echo.log",
		'error' => "$wmgLogDir/debuglogs/php-error.log",
		'exception' => "$wmgLogDir/debuglogs/exception.log",
		'exec' => "$wmgLogDir/debuglogs/exec.log",
		'ldap' => "$wmgLogDir/debuglogs/ldap.log",
		'Math' => "$wmgLogDir/debuglogs/Math.log",
		'MatomoAnalytics' => "$wmgLogDir/debuglogs/MatomoAnalytics.log",
		'ManageWiki' => "$wmgLogDir/debuglogs/ManageWiki.log",
		'memcached' => [
			'destination' => "$wmgLogDir/debuglogs/memcached.log",
			'level' => LogLevel::ERROR,
		],
		'OAuth' => "$wmgLogDir/debuglogs/OAuth.log",
		'redis' => [
			'destination' => "$wmgLogDir/debuglogs/redis.log",
			'level' => LogLevel::WARNING,
		],
		'thumbnail' => "$wmgLogDir/debuglogs/thumbnail.log",
		'VisualEditor' => "$wmgLogDir/debuglogs/VisualEditor.log",
	];
} else {
	$wgMWLoggerDefaultSpi = [
		'class' => MonologSpi::class,
		'args' => [ $wmgMonologConfig ],
	];
}

if ( MW_ENTRY_POINT === 'cli' ) {
	ini_set( 'display_startup_errors', 1 );
	ini_set( 'display_errors', 1 );

	$wgShowExceptionDetails = true;
	$wgDebugDumpSql = true;
}

if (
	wfHostname() === 'mwtask151' ||
	wfHostname() === 'mwtask161' ||
	wfHostname() === 'mwtask171' ||
	wfHostname() === 'mwtask181' ||
	wfHostname() === 'test151'
) {
	$wgShowExceptionDetails = true;
}
