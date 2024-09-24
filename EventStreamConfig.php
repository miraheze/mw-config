<?php

// Stream config default settings.
// The EventStreamConfig extension will add these
// settings to each entry in wgEventStreams if
// the entry does not already have the setting.
$wgEventStreamsDefaultSettings = [
	'topic_prefixes' => [ 'default.' ],
	'canary_events_enabled' => true,
];

$betaStream = preg_match( '/^(.*)\.(mirabeta|nexttide)\.org$/', $wi->server ) ? 'beta/' : '';

$wgEventStreams = [
	'/^mediawiki\\.job\\..+/' => [
		'schema_title' => "mediawiki/job",
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	'/^mediawiki\\.beta\\.job\\..+/' => [
		'schema_title' => "mediawiki/beta/job",
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	'mediawiki.centralnotice.campaign-change' => [
		'schema_title' => "mediawiki/{$betaStream}centralnotice/campaign/change",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.centralnotice.campaign-create' => [
		'schema_title' => "mediawiki/{$betaStream}centralnotice/campaign/create",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.centralnotice.campaign-delete' => [
		'schema_title' => "mediawiki/{$betaStream}centralnotice/campaign/delete",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.cirrussearch.page_rerender.v1' => [
		'schema_title' => "mediawiki/{$betaStream}cirrussearch/page_rerender",
		'destination_event_service' => 'eventgate',
		'message_key_fields' => [
			'wiki_id' => 'wiki_id',
			'page_id' => 'page_id',
		],
	],
	'mediawiki.page-create' => [
		'schema_title' => "mediawiki/{$betaStream}revision/create",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-delete' => [
		'schema_title' => "mediawiki/{$betaStream}page/delete",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-links-change' => [
		'schema_title' => "mediawiki/{$betaStream}page/links-change",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-move' => [
		'schema_title' => "mediawiki/{$betaStream}page/move",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-properties-change' => [
		'schema_title' => "mediawiki/{$betaStream}page/properties-change",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-restrictions-change' => [
		'schema_title' => "mediawiki/{$betaStream}page/restrictions-change",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-suppress' => [
		'schema_title' => "mediawiki/{$betaStream}page/delete",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-undelete' => [
		'schema_title' => "mediawiki/{$betaStream}page/undelete",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.recentchange' => [
		'schema_title' => "mediawiki/{$betaStream}recentchange",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.revision-create' => [
		'schema_title' => "mediawiki/{$betaStream}revision/create",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.revision-tags-change' => [
		'schema_title' => "mediawiki/{$betaStream}revision/tags-change",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.revision-visibility-change' => [
		'schema_title' => "mediawiki/{$betaStream}revision/visibility-change",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.user-blocks-change' => [
		'schema_title' => "mediawiki/{$betaStream}user/blocks-change",
		'destination_event_service' => 'eventgate',
	],
	'resource_change' => [
		'schema_title' => "{$betaStream}resource_change",
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	'resource-purge' => [
		'schema_title' => "{$betaStream}resource_change",
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	'change-prop.transcludes.resource-change' => [
		'schema_title' => "{$betaStream}resource_change",
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	// These are logging channels
	'mediawiki.api-request' => [
		'schema_title' => "mediawiki/{$betaStream}api/request",
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.cirrussearch-request' => [
		'schema_title' => "mediawiki/{$betaStream}cirrussearch/request",
		'destination_event_service' => 'eventgate',
	],
];
