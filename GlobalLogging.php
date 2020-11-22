<?php

// Only enable if syslog-ng is deployed on the server
if ( wfHostname() === $wmgCentralLoggingSystem ) {
	$wi->config->settings['wgMWLoggerDefaultSpi']['default'] = [
		'class' => \MediaWiki\Logger\MonologSpi::class,
		'args' => [
			[
				'loggers' => [
					'@default' => [
						'processors' => [ 'wiki', 'psr', 'web' ],
						'handlers' => [ 'what' ],
					],
				],
				'processors' => [
					'psr' => [
						'class' => \Monolog\Processor\PsrLogMessageProcessor::class,
					],
					'web' => [
						'class' => \Monolog\Processor\WebProcessor::class,
					],
					'wiki' => [
						'class' => \MediaWiki\Logger\Monolog\WikiProcessor::class,
					],
				],
				'handlers' => [
					'syslog' => [
						'class' => \MediaWiki\Logger\Monolog\SyslogHandler::class,
						'formatter' => 'logstash',
						'args' => [
							'mediawiki', // tag
							'127.0.0.1', // local syslog-ng daemon
							10514, // local port,
						],
					],
					'what' => [
						'class' => \Monolog\Handler\WhatFailureGroupHandler::class,
						'args' => [
							function () {
								$provider = \MediaWiki\Logger\LoggerFactory::getProvider();
								return array_map( [ $provider, 'getHandler' ], [ 'syslog' ] );
							}
						],
					],
				],
				'formatters' => [
					'logstash' => [
						'class' => \Monolog\Formatter\LogstashFormatter::class,
						'args' => [ 'mediawiki', php_uname( 'n' ), null, '', 1 ],
					],
				],
			],
		],
	];
} else {
	$wmgLogDir = "/var/log/mediawiki";

	$wi->config->settings['wgDBerrorLog']['default'] = "$wmgLogDir/debuglogs/database.log";

	$wi->config->settings['wgDebugLogGroups']['default'] = [
		'404' => "$wmgLogDir/debuglogs/404.log",
		'api' => "$wmgLogDir/debuglogs/api.log",
		'captcha' => "$wmgLogDir/debuglogs/captcha.log",
		'CentralAuth' => "$wmgLogDir/debuglogs/CentralAuth.log",
		'collection' => "$wmgLogDir/debuglogs/collection.log",
		'CreateWiki' => "$wmgLogDir/debuglogs/CreateWiki.log",
		'Echo' => "$wmgLogDir/debuglogs/Echo.log",
		'error' => "$wmgLogDir/debuglogs/php-error.log",
		'exception' => "$wmgLogDir/debuglogs/exception.log",
		'exec' => "$wmgLogDir/debuglogs/exec.log",
		'ldap' => "$wmgLogDir/debuglogs/ldap.log",
		'Math' => "$wmgLogDir/debuglogs/Math.log",
		'MatomoAnalytics' => "$wmgLogDir/debuglogs/MatomoAnalytics.log",
		'ManageWiki' => "$wmgLogDir/debuglogs/ManageWiki.log",
		'OAuth' => "$wmgLogDir/debuglogs/OAuth.log",
		'redis' => [
			'destination' => "$wmgLogDir/debuglogs/redis.log",
			'level' => \Psr\Log\LogLevel::WARNING,
		],
		'spf-tmp' => "$wmgLogDir/debuglogs/spf-tmp.log",
		'thumbnail' => "$wmgLogDir/debuglogs/thumbnail.log",
		'VisualEditor' => "$wmgLogDir/debuglogs/VisualEditor.log",
	];
}

if ( $wgCommandLineMode ) {
	error_reporting( -1 );
	ini_set( 'display_startup_errors', 1 );
	ini_set( 'display_errors', 1 );

	$wgShowExceptionDetails = true;

	$wgShowSQLErrors = true;
	$wgDebugDumpSql = true;
	$wgShowDBErrorBacktrace = true;
}
