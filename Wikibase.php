<?php
// Documentation for Wikibase: https://www.mediawiki.org/wiki/Wikibase/Installation/Advanced_configuration#Configuration

// You should only need to set $wgWBClientSettings['repoUrl'], $wgWBClientSettings['repositories']['repoDatabase'] and $wgWBClientSettings['changesDatabase']
// on the wiki.

global $wgWBRepoSettings, $wgWBClientSettings;

$wgWBRepoSettings = array_merge( $wgWBRepoSettings, [
	'entityNamespaces' => [
		'item' => 860,
		'property' => 862,
	],
	'sharedCacheKeyPrefix' => $wi->dbname . ':WBL',
	'allowEntityImport' => $wmgAllowEntityImport,
	'enableEntitySearchUI' => $wmgEnableEntitySearchUI,
	'federatedPropertiesEnabled' => $wmgFederatedPropertiesEnabled,
	'siteLinkGroups' => [	
		'miraheze',	
	],	
	'specialSiteLinkGroups' => [],
] );

$wgWBClientSettings = array_merge( $wgWBClientSettings, [
	'repoUrl' => $wmgWikibaseRepoUrl,
	'changesDatabase' => $wmgWikibaseRepoDatabase,
	'repositories' => [
		'' => [
			'repoDatabase' => $wmgWikibaseRepoDatabase,
			'baseUri' => $wmgWikibaseRepoUrl . '/entity/',
			'entityNamespaces' => [
				'item' => '',
				'property' => 'Property',
			],
			'prefixMapping' => [
				'' => '',
			],
		],
	],
	'siteGlobalID' => $wi->dbname,
	'repoScriptPath' => '/w',
	'repoArticlePath' => '/wiki/$1',
	'siteGroup' => 'miraheze',
	'repoNamespaces' => [
		'item' => '',
		'property' => 'Property',
	],
	'siteLinksGroups' => [
		'miraheze',
	],
	'purgeCacheBatchSize' => 100,
	'recentChangesBatchSize' => 100,
] );
