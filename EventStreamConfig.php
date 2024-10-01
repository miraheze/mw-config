<?php

// Stream config default settings.
// The EventStreamConfig extension will add these
// settings to each entry in wgEventStreams if
// the entry does not already have the setting.
$wgEventStreamsDefaultSettings = [
	'topic_prefixes' => [ 'default.' ],
	'canary_events_enabled' => true,
];

if ( $cwPrivate ) {
	$wgEventStreamsDefaultSettings += [
		'producers' => [
			'mediawiki_eventbus' => [
				'enabled' => false,
			],
		]
	];
}

$wgEventStreams = [
	'/^mediawiki\\.job\\..+/' => [
		'schema_title' => 'mediawiki/job',
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
];

if ( $cwPrivate ) {
	$wgEventStreams['/^mediawiki\\.job\\..+/']['producers']['mediawiki_eventbus']['enabled'] = true;
}
