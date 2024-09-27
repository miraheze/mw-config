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
	'mediawiki.centralnotice.campaign-change' => [
		'schema_title' => 'mediawiki/centralnotice/campaign/change',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.centralnotice.campaign-create' => [
		'schema_title' => 'mediawiki/centralnotice/campaign/create',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.centralnotice.campaign-delete' => [
		'schema_title' => 'mediawiki/centralnotice/campaign/delete',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.cirrussearch.page_rerender.v1' => [
		'schema_title' => 'mediawiki/cirrussearch/page_rerender',
		'destination_event_service' => 'eventgate',
		'message_key_fields' => [
			'wiki_id' => 'wiki_id',
			'page_id' => 'page_id',
		],
	],
	// mediawiki.cirrussearch.page_rerender stream for private wikis
	'mediawiki.cirrussearch.page_rerender.private.v1' => [
		'schema_title' => 'mediawiki/cirrussearch/page_rerender',
		'destination_event_service' => 'eventgate-main',
		'message_key_fields' => [
			'wiki_id' => 'wiki_id',
			'page_id' => 'page_id',
		],
		'producers' => [
			'mediawiki_eventbus' => [
				'enabled' => false,
			],
		],
	],
	'mediawiki.page-create' => [
		'schema_title' => 'mediawiki/revision/create',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-delete' => [
		'schema_title' => 'mediawiki/page/delete',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-links-change' => [
		'schema_title' => 'mediawiki/page/links-change',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-move' => [
		'schema_title' => 'mediawiki/page/move',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-properties-change' => [
		'schema_title' => 'mediawiki/page/properties-change',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-restrictions-change' => [
		'schema_title' => 'mediawiki/page/restrictions-change',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-suppress' => [
		'schema_title' => 'mediawiki/page/delete',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.page-undelete' => [
		'schema_title' => 'mediawiki/page/undelete',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.recentchange' => [
		'schema_title' => 'mediawiki/recentchange',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.revision-create' => [
		'schema_title' => 'mediawiki/revision/create',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.revision-tags-change' => [
		'schema_title' => 'mediawiki/revision/tags-change',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.revision-visibility-change' => [
		'schema_title' => 'mediawiki/revision/visibility-change',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.user-blocks-change' => [
		'schema_title' => 'mediawiki/user/blocks-change',
		'destination_event_service' => 'eventgate',
	],
	'resource_change' => [
		'schema_title' => 'resource_change',
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	'resource-purge' => [
		'schema_title' => 'resource_change',
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	'change-prop.transcludes.resource-change' => [
		'schema_title' => 'resource_change',
		'destination_event_service' => 'eventgate',
		'canary_events_enabled' => false,
	],
	// These are logging channels
	'mediawiki.api-request' => [
		'schema_title' => 'mediawiki/api/request',
		'destination_event_service' => 'eventgate',
	],
	'mediawiki.cirrussearch-request' => [
		'schema_title' => 'mediawiki/cirrussearch/request',
		'destination_event_service' => 'eventgate',
	],
];

if ( $cwPrivate ) {
	$wgEventStreams['/^mediawiki\\.job\\..+/']['producers']['mediawiki_eventbus']['enabled'] = true;
	$wgEventStreams['mediawiki.cirrussearch.page_rerender.private.v1']['producers']['mediawiki_eventbus']['enabled'] = true;
}
