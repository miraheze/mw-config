<?php

// Stream config default settings.
// The EventStreamConfig extension will add these
// settings to each entry in wgEventStreams if
// the entry does not already have the setting.
$wgEventStreamsDefaultSettings = [
	'topic_prefixes' => [ 'default.' ],
];

$wgEventStreams = [
	'/^mediawiki\\.job\\..+/' => [
		'schema_title' => 'mediawiki/job',
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
];
