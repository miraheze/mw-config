<?php
// Documentation for Wikibase: https://www.mediawiki.org/wiki/Wikibase/Installation/Advanced_configuration#Configuration

// You should only need to set $wgWBClientSettings['repoUrl'], $wgWBClientSettings['repositories']['repoDatabase'] and $wgWBClientSettings['changesDatabase']
// on the wiki.

$wi->config->settings['wmgWBRepoSettings']['default'] = [
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
];

$wi->config->settings['wmgWBClientSettings']['default'] = [
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
];
$wgWBRepoSettings[] = false;
$wgWBRepoSettings = array_merge( $wgWBRepoSettings, $wmgWBRepoSettings );
$wgWBClientSettings[] = false;
$wgWBClientSettings = array_merge( $wgWBClientSettings, $wmgWBClientSettings );
