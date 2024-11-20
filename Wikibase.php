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

$wgWBClientSettings['tmpUnconnectedPagePagePropMigrationStage'] = MIGRATION_NEW;

if ( $wi->isExtensionActive( 'WikibaseLexeme' ) ) {
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

$wgWBRepoSettings['siteGlobalID'] = $wgDBname;

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

$wgWBClientSettings['siteGlobalID'] = $wgDBname;
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

$wgMFUseWikibase = true;

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
	$wgWBRepoSettings['siteLinkGroups'] = [
		'famepedia' => [
			'site' => 'famepedia',
			'title' => 'Famepedia',
			'namespace' => 0,
			'interwiki' => 'famepedia'
		],
	];

	$wgWBClientSettings['useKartographerMaplinkInWikitext'] = true;
	$wgWBClientSettings['repoSiteName'] = 'FAMEData';
}

if ( $wgDBname === 'gpcommonswiki' ) {
	$wgWBClientSettings['repoSiteName'] = 'Gratisdata';
	$wgWBClientSettings['pageSchemaNamespaces'] = [ 0 ];
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
		'url' => 'https://static.wikitide.net/commonswiki/a/a4/GDechoIcon.svg',
	];
	$wgWBClientSettings['propertyOrderUrl'] = 'https://gratisdata.miraheze.org/wiki/MediaWiki:Wikibase-SortedProperties?action=raw&sp_ver=1';
	$wgWBClientSettings['allowDataAccessInUserLanguage'] = true;
	// Data-Bridge
	$wgWBClientSettings['dataBridgeEnabled'] = true;
	$wgWBClientSettings['dataBridgeHrefRegExp'] = '^https://gratisdata\.miraheze\.org/wiki/((Q[1-9][0-9]*)).*#(P[1-9][0-9]*)$';
	$wgWBClientSettings['dataBridgeEditTags'] = [
		'data-bridge'
	];
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
	$wgWBRepoSettings['dataRightsText'] = 'Creative Commons CC0 License';
	$wgWBRepoSettings['dataRightsUrl'] = 'https://creativecommons.org/publicdomain/zero/1.0/';
	// Define constraints for various strings, such as multilingual terms (such as labels, descriptions and aliases).
	$wgWBRepoSettings['string-limits'] = [
		'multilang' => [
			// length constraint
			'length' => 500,
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
	$wgWBRepoSettings['globeUris'] = [
		'http://gratisdata.miraheze.org/entity/Q476' => 'earth',
		'http://gratisdata.miraheze.org/entity/Q987' => 'mercury',
		'http://gratisdata.miraheze.org/entity/Q981' => 'venus',
		'http://gratisdata.miraheze.org/entity/Q985' => 'moon',
		'http://gratisdata.miraheze.org/entity/Q806' => 'mars',
		'http://gratisdata.miraheze.org/entity/Q2126' => 'phobos',
		'http://gratisdata.miraheze.org/entity/Q2118' => 'deimos',
		'http://gratisdata.miraheze.org/entity/Q967' => 'ganymede',
		'http://gratisdata.miraheze.org/entity/Q961' => 'callisto',
		'http://gratisdata.miraheze.org/entity/Q990' => 'io',
		'http://gratisdata.miraheze.org/entity/Q965' => 'europa',
		'http://gratisdata.miraheze.org/entity/Q986' => 'mimas',
		'http://gratisdata.miraheze.org/entity/Q964' => 'enceladus',
		'http://gratisdata.miraheze.org/entity/Q984' => 'tethys',
		'http://gratisdata.miraheze.org/entity/Q963' => 'dione',
		'http://gratisdata.miraheze.org/entity/Q988' => 'rhea',
		'http://gratisdata.miraheze.org/entity/Q983' => 'titan',
		'http://gratisdata.miraheze.org/entity/Q2119' => 'hyperion',
		'http://gratisdata.miraheze.org/entity/Q989' => 'iapetus',
		'http://gratisdata.miraheze.org/entity/Q966' => 'phoebe',
		'http://gratisdata.miraheze.org/entity/Q2122' => 'miranda',
		'http://gratisdata.miraheze.org/entity/Q2117' => 'ariel',
		'http://gratisdata.miraheze.org/entity/Q2129' => 'umbriel',
		'http://gratisdata.miraheze.org/entity/Q2128' => 'titania',
		'http://gratisdata.miraheze.org/entity/Q2125' => 'oberon',
		'http://gratisdata.miraheze.org/entity/Q982' => 'triton',
		'http://gratisdata.miraheze.org/entity/Q2123' => 'pluto',
	];
	$wgWBRepoSettings['updateRepoTags'] = [
		'client-automatic-update'
	];
	$wgWBRepoSettings['viewUiTags'] = [
		'gratisdata-ui'
	];
	$wgWBRepoSettings['specialPageTags'] = [
		'gratisdata-ui'
	];
	$wgWBRepoSettings['termboxTags'] = [
		'gratisdata-ui',
		'termbox',
	];
	$wgWBRepoSettings['entityDataFormats'] = [
		'json',
		'php',
		'rdfxml',
		'n3',
		'turtle',
		'ntriples',
		'html',
		'jsonld',
	];
	$wgWBRepoSettings['taintedReferencesEnabled'] = true;
	$wgWBRepoSettings['useKartographerGlobeCoordinateFormatter'] = true;
	// Data-Bridge
	$wgWBRepoSettings['dataBridgeEnabled'] = true;
	$wgWBRepoSettings['allowDataAccessInUserLanguage'] = true;
	$wgWBRepoSettings['entityAccessLimit'] = 500;
}

if ( $wgDBname === 'gratispaideiawiki' ) {
	$wgWBClientSettings['repoSiteName'] = 'Gratisdata';
	$wgWBClientSettings['pageSchemaNamespaces'] = [ 0 ];
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
		'url' => 'https://static.wikitide.net/commonswiki/a/a4/GDechoIcon.svg',
	];
	$wgWBClientSettings['propertyOrderUrl'] = 'https://gratisdata.miraheze.org/wiki/MediaWiki:Wikibase-SortedProperties?action=raw&sp_ver=1';
	$wgWBClientSettings['allowDataAccessInUserLanguage'] = true;
	// Data-Bridge
	$wgWBClientSettings['dataBridgeEnabled'] = true;
	$wgWBClientSettings['dataBridgeHrefRegExp'] = '^https://gratisdata\.miraheze\.org/wiki/((Q[1-9][0-9]*)).*#(P[1-9][0-9]*)$';
	$wgWBClientSettings['dataBridgeEditTags'] = [
		'data-bridge'
	];
}

if ( $wgDBname === 'benpediawiki' ) {
	$wgWBClientSettings['repoSiteName'] = 'Gratisdata';
	$wgWBClientSettings['pageSchemaNamespaces'] = [ 0 ];
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
