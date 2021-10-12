<?php

// Documentation for Wikibase: https://www.mediawiki.org/wiki/Wikibase/Installation/Advanced_configuration#Configuration

// You should only need to set $wgWBClientSettings['repoUrl'], $wgWBClientSettings['repoDatabase'] and $wgWBClientSettings['changesDatabase']
// on the wiki.

if ( version_compare( MW_VERSION, '1.37', '>=' ) ) {
	$wgWBRepoSettings['entitySources'] = [
		'' => [
			'repoDatabase' => $wmgWikibaseRepoDatabase,
			'entityNamespaces' => [
				'item' => $wmgWikibaseRepoItemNamespaceID,
				'property' => $wmgWikibaseRepoPropertyNamespaceID,
			],
			'baseUri' => $wmgWikibaseRepoUrl . '/entity/',
			'rdfNodeNamespacePrefix' => 'wd',
			'rdfPredicateNamespacePrefix' => '',
			'interwikiPrefix' => '',
			'type' => 'db',
		],
	];
}

$wgWBRepoSettings['entityNamespaces']['item'] = $wmgWikibaseRepoItemNamespaceID;
$wgWBRepoSettings['entityNamespaces']['property'] = $wmgWikibaseRepoPropertyNamespaceID;
$wgWBRepoSettings['sharedCacheKeyPrefix'] = $wi->dbname . ':WBL/' . rawurlencode( $wgVersion );
$wgWBRepoSettings['allowEntityImport'] = $wmgAllowEntityImport;
$wgWBRepoSettings['enableEntitySearchUI'] = $wmgEnableEntitySearchUI;
$wgWBRepoSettings['federatedPropertiesEnabled'] = $wmgFederatedPropertiesEnabled;
$wgWBRepoSettings['formatterUrlProperty'] = $wmgFormatterUrlProperty ? $wmgFormatterUrlProperty : null;
$wgWBRepoSettings['canonicalUriProperty'] = $wmgCanonicalUriProperty ? $wmgCanonicalUriProperty : null;

$wgWBRepoSettings['siteLinkGroups'] = [
	'miraheze'
];
$wgWBRepoSettings['specialSiteLinkGroups'] = [];

$wgWBClientSettings['repoUrl'] = $wmgWikibaseRepoUrl;
$wgWBClientSettings['repoDatabase'] = $wmgWikibaseRepoDatabase;
$wgWBClientSettings['changesDatabase'] = $wmgWikibaseRepoDatabase;
$wgWBClientSettings['repositories'] = [
	'' => [
		'repoDatabase' => $wmgWikibaseRepoDatabase,
		'baseUri' => $wmgWikibaseRepoUrl . '/entity/',
		'entityNamespaces' => [
			'item' => $wmgWikibaseItemNamespaceID,
			'property' => $wmgWikibasePropertyNamespaceID
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
if ( $wgDBname === 'famedatawiki' ) {
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

if ( $wgDBname === 'famepediawiki' ) {
	$wgWBRepoSettings['useKartographerGlobeCoordinateFormatter'] = true;

	$wgWBClientSettings['useKartographerMaplinkInWikitext'] = true;
	$wgWBClientSettings['repoSiteName'] = 'FAMEData';
}
