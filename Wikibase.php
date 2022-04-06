<?php

// Documentation for Wikibase: https://www.mediawiki.org/wiki/Wikibase/Installation/Advanced_configuration#Configuration

// You should only need to set $wgWBClientSettings['repoUrl'], $wgWBClientSettings['repoDatabase'] and $wgWBClientSettings['changesDatabase']
// on the wiki.

$entitySources = [
	'local' => [
		'entityNamespaces' => [
			'item' => $wmgWikibaseRepoItemNamespaceID,
			'property' => $wmgWikibaseRepoPropertyNamespaceID,
		],
		'repoDatabase' => $wmgWikibaseRepoDatabase,
		'baseUri' => $wmgWikibaseRepoUrl . '/entity/',
		'interwikiPrefix' => '',
		'rdfNodeNamespacePrefix' => 'wd',
		'rdfPredicateNamespacePrefix' => '',
		'type' => 'db'
	],
];

if ( $wi->config->get( 'wmgUseWikibaseLexeme', $wi->dbname ) ) {
	$entitySources['local']['entityNamespaces']['lexeme'] = 146;
	$wgWBRepoSettings['entityNamespaces']['lexeme'] = 146;
}

$wgWBRepoSettings['entitySources'] = $entitySources;
$wgWBRepoSettings['localEntitySourceName'] = 'local';
$wgWBRepoSettings['entityNamespaces']['item'] = $wmgWikibaseRepoItemNamespaceID;
$wgWBRepoSettings['entityNamespaces']['property'] = $wmgWikibaseRepoPropertyNamespaceID;
$wgWBRepoSettings['allowEntityImport'] = $wmgAllowEntityImport;
$wgWBRepoSettings['enableEntitySearchUI'] = $wmgEnableEntitySearchUI;
$wgWBRepoSettings['federatedPropertiesEnabled'] = $wmgFederatedPropertiesEnabled;
$wgWBRepoSettings['formatterUrlProperty'] = $wmgFormatterUrlProperty ?: null;
$wgWBRepoSettings['canonicalUriProperty'] = $wmgCanonicalUriProperty ?: null;

$wgWBRepoSettings['siteLinkGroups'] = [
	'miraheze'
];

$wgWBRepoSettings['specialSiteLinkGroups'] = [];

$wgWBClientSettings['entitySources'] = $entitySources;
$wgWBClientSettings['itemAndPropertySourceName'] = 'local';
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

if ( $wgDBname === 'gratisdatawiki' ) {
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
	$wgWBRepoSettings['dataRightsUrl'] = 'https://creativecommons.org/publicdomain/zero/1.0/';
	// Define constraints for various strings, such as multilingual terms (such as labels, descriptions and aliases).
	$wgWBRepoSettings['string-limits'] = [
		'multilang' => [
			'length' => 500, // length constraint
		],
		'VT:monolingualtext' => [
			'length' => 700,
		],
		'VT:string' => [
			'length' => 700,
		],
		'PT:url' => [
			'length' => 1000,
		],
	];
	$wgWBRepoSettings['allowEntityImport'] = false;
	$wgWBRepoSettings['preferredPageImagesProperties'] = [
		// Photos
		'P386',
		'P520',
		'P521',
		'P522',
		'P523',
		'P524',
		// Complex graphics
		'P135',
		'P136',
		'P387',
		'P525',
		// Simple graphics
		'P526',
		'P527',
		'P528',
		'P470',
		'P529',
		// Multi page content
		'P530',
		// Maps
		'P531',
		'P327',
		'P532',
		'P533',
	];
	$wgWBRepoSettings['preferredGeoDataProperties'] = [
		'P134',
	];
	$wgWBRepoSettings['siteLinkGroups'] = [
		'miraheze',
		'gratispaideia'
	];
}

if ( $wgDBname === 'gratispaideiawiki' ) {
	$wgWBClientSettings['repoSiteName'] = 'Gratisdata';
	$wgWBClientSettings['pageSchemaNamespaces'] = [ 0, 4, 14 ];
	// Some well-known properties' IDs which are used to format references
	$wgWBClientSettings['wellKnownReferencePropertyIds'] = [
		// (note: The keys are not chosen at random; the software knows exactly which ones they are and which ones they are not)
		'referenceUrl' => 'P15',
		'title' => 'P106',
		'statedIn' => 'P75',
		'author' => 'P127',
		'publisher' => 'P125',
		'publicationDate' => 'P110',
		'retrievedDate' => 'P200',
	];
	$wgWBClientSettings['enableImplicitDescriptionUsage'] = true;
	$wgWBClientSettings['linkItemTags'] = [
		'client-linkitem-change'
	];
	$wgWBClientSettings['sendEchoNotification'] = true;
	$wgWBClientSettings['echoIcon'] = [
		'url' => 'https://static.miraheze.org/commonswiki/a/a4/GDechoIcon.svg',
	];
	$wgWBClientSettings['otherProjectsLinks'] = [
		'gratisdatawiki',
		'metawiki',
		'commonswiki',
		'benpediawiki',
	];
}

if ( $wgDBname === 'benpediawiki' ) {
	$wgWBClientSettings['repoSiteName'] = 'Gratisdata';
}

if ( $wgDBname === 'horimiyawiki' ) {
	$wgWBRepoSettings['statementSections'] = [
		'item' => [
			'statements' => null,
			'identifiers' => [
				'type' => 'dataType',
				'dataTypes' => [ 'external-id' ],
			],
		],
	];
}

// don't need these to be a global
unset( $entitySources );
