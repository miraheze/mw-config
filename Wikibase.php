<?php

// Documentation for Wikibase: https://www.mediawiki.org/wiki/Wikibase/Installation/Advanced_configuration#Configuration

// You should only need to set $wgWBClientSettings['repoUrl'], $wgWBClientSettings['repoDatabase'] and $wgWBClientSettings['changesDatabase']
// on the wiki.

$wgWBRepoSettings['entityNamespaces']['item'] = $wi->config->get( 'wmgWikibaseRepoItemNamespaceID', $wi->dbname );
$wgWBRepoSettings['entityNamespaces']['property'] = $wi->config->get( 'wmgWikibaseRepoPropertyNamespaceID', $wi->dbname );
$wgWBRepoSettings['sharedCacheKeyPrefix'] = $wi->dbname . ':WBL/' . rawurlencode( $wgVersion );
$wgWBRepoSettings['allowEntityImport'] = $wi->config->get( 'wmgAllowEntityImport', $wi->dbname );
$wgWBRepoSettings['enableEntitySearchUI'] = $wi->config->get( 'wmgEnableEntitySearchUI', $wi->dbname );
$wgWBRepoSettings['federatedPropertiesEnabled'] = $wi->config->get( 'wmgFederatedPropertiesEnabled', $wi->dbname );
$wgWBRepoSettings['formatterUrlProperty'] = $wi->config->get( 'wmgFormatterUrlProperty', $wi->dbname );
$wgWBRepoSettings['canonicalUriProperty'] = $wi->config->get( 'wmgCanonicalUriProperty', $wi->dbname );

$wgWBRepoSettings['siteLinkGroups'] = [
	'miraheze'
];
$wgWBRepoSettings['specialSiteLinkGroups'] = [];

$wgWBClientSettings['repoUrl'] =  $wi->config->get( 'wmgWikibaseRepoUrl', $wi->dbname );
$wgWBClientSettings['repoDatabase'] =  $wi->config->get( 'wmgWikibaseRepoDatabase', $wi->dbname );
$wgWBClientSettings['changesDatabase'] =  $wi->config->get( 'wmgWikibaseRepoDatabase', $wi->dbname );
$wgWBClientSettings['repositories'] = [
	'' => [
		'repoDatabase' => $wi->config->get( 'wmgWikibaseRepoDatabase', $wi->dbname ),
		'baseUri' => $wi->config->get( 'wmgWikibaseRepoUrl', $wi->dbname ) . '/entity/',
		'entityNamespaces' => [
			'item' => $wi->config->get( 'wmgWikibaseItemNamespaceID', $wi->dbname ),
			'property' => $wi->config->get( 'wmgWikibasePropertyNamespaceID', $wi->dbname )
		],
		'prefixMapping' => [
			'' => ''
		]
	]
];
$wgWBClientSettings['siteGlobalID'] = $wi->dbname;
$wgWBClientSettings['repoScriptPath'] = '/w';
$wgWBClientSettings['repoArticlePath'] = '/wiki/$1';
$wgWBClientSettings['siteGroup'] = 'miraheze';
$wgWBClientSettings['repoNamespaces'] = [
	'wikibase-item' => 'Item',
	'wikibase-property' => 'Property'
];
$wgWBClientSettings['siteLinksGroups'] = [
	'miraheze'
];
$wgWBClientSettings['purgeCacheBatchSize'] = 100;
$wgWBClientSettings['recentChangesBatchSize'] = 100;

// Per-wiki
if ( $wi->dbname === 'famedatawiki' ) {
	$wgWBRepoSettings['statementSections'] = [
		'item' => [
			'statements' => null,
			'identifiers' => [
				'type' => 'dataType',
				'dataTypes' => [
					'external-id',
				],
			],
		],
		'property' => [
			'statements' => null,
			'constraints' => [
				'type' => 'propertySet',
				'propertyIds' => [
					'P142',
				],
			],
		],
	];
}

if ( $wi->dbname === 'famepediawiki' ) {
	$wgWBRepoSettings['useKartographerGlobeCoordinateFormatter'] = true;

	$wgWBClientSettings['useKartographerMaplinkInWikitext'] = true;
	$wgWBClientSettings['repoSiteName'] = 'FAMEData';
}
