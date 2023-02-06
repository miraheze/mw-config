<?php

// https://phabricator.miraheze.org/T8703
header( 'X-Wiki-Visibility: ' . ( $cwPrivate ? 'Private' : 'Public' ) );

// Extensions
if ( $wi->dbname !== 'ldapwikiwiki' ) {
	wfLoadExtensions( [
		'CentralAuth',
		'GlobalPreferences',
		'GlobalBlocking',
		'RemovePII',
	] );
}

if ( $wi->isExtensionActive( 'chameleon' ) ) {
	wfLoadExtension( 'Bootstrap' );
}

if ( $wgMirahezeCommons && !$cwPrivate ) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wi->isExtensionActive( 'InterwikiSorting' ) ) {
	$wgInterwikiSortingInterwikiSortOrders = include __DIR__ . '/InterwikiSortOrders.php';
}

if ( $wi->isAllOfExtensionsActive( '3d', 'MultimediaViewer' ) ) {
	$wgMediaViewerExtensions['stl'] = 'mmv.3d';
}

if ( $wi->isExtensionActive( 'Popups' ) ) {
	if ( $wmgShowPopupsByDefault ) {
		$wgPopupsHideOptInOnPreferencesPage = true;
		$wgPopupsOptInDefaultState = '1';
		$wgPopupsOptInStateForNewAccounts = '1';
		$wgPopupsReferencePreviewsBetaFeature = false;
	}
}

if ( $wi->isExtensionActive( 'SemanticMediaWiki' ) ) {
	require_once '/srv/mediawiki/config/SemanticMediaWiki.php';
}

if ( $wi->isExtensionActive( 'SocialProfile' ) ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";

	$wgSocialProfileFileBackend = 'miraheze-swift';
}

if ( $wi->isExtensionActive( 'VisualEditor' ) ) {
	if ( $wmgVisualEditorEnableDefault ) {
		$wgDefaultUserOptions['visualeditor-enable'] = 1;
		$wgDefaultUserOptions['visualeditor-editor'] = 'visualeditor';
	} else {
		$wgDefaultUserOptions['visualeditor-enable'] = 0;
	}
}

if ( $wi->isAnyOfExtensionsActive( 'WikibaseClient', 'WikibaseRepository' ) ) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once '/srv/mediawiki/config/Wikibase.php';
}

// If Flow, VisualEditor, or Linter is used, use the Parsoid php extension
if ( $wi->isAnyOfExtensionsActive( 'Flow', 'VisualEditor', 'Linter' ) ) {
	wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );

	if ( $wi->isExtensionActive( 'VisualEditor' ) ) {
		$wgVisualEditorParsoidAutoConfig = false;
	}

	$wgVirtualRestConfig = [
		'paths' => [],
		'modules' => [
			'parsoid' => [
				'url' => 'https://mw-lb.miraheze.org/w/rest.php',
				'domain' => $wi->server,
				'prefix' => $wi->dbname,
				'forwardCookies' => (bool)$cwPrivate,
				'restbaseCompat' => false,
				'timeout' => 30,
			],
		],
		'global' => [
			'timeout' => 360,
			'forwardCookies' => false,
			'HTTPProxy' => null,
		],
	];

	if ( $wi->isExtensionActive( 'Flow' ) ) {
		$wgFlowParsoidURL = 'https://mw-lb.miraheze.org/w/rest.php';
		$wgFlowParsoidPrefix = $wi->dbname;
		$wgFlowParsoidTimeout = 30;
		$wgFlowParsoidForwardCookies = (bool)$cwPrivate;
	}
}

$wgAllowedCorsHeaders[] = 'X-Miraheze-Debug';

// Closed Wikis
if ( $cwClosed ) {
	$wgRevokePermissions = [
		'*' => [
			'block' => true,
			'createaccount' => true,
			'delete' => true,
			'edit' => true,
			'protect' => true,
			'import' => true,
			'upload' => true,
			'undelete' => true,
		],
	];

	if ( $wi->isExtensionActive( 'Comments' ) ) {
		$wgRevokePermissions['*']['comment'] = true;
	}
}

// Public Wikis
if ( !$cwPrivate ) {
	$wgRCFeeds['irc'] = [
		'formatter' => MirahezeIRCRCFeedFormatter::class,
		'uri' => 'udp://[2a10:6740::6:505]:5070',
		'add_interwiki_prefix' => false,
		'omit_bots' => true,
	];

	$wgDiscordIncomingWebhookUrl = $wmgGlobalDiscordWebhookUrl;
	$wgDiscordExperimentalWebhook = $wmgDiscordExperimentalWebhook;

	$wgDataDumpDownloadUrl = "https://{$wmgUploadHostname}/{$wi->dbname}/dumps/\${filename}";
}

// Experimental Wikis
if ( $cwExperimental ) {
	$wgParserEnableLegacyMediaDOM = false;
} else {
	$wgParserEnableLegacyMediaDOM = true;
}

// Dynamic cookie settings dependant on $wgServer
if ( preg_match( '/miraheze\.org$/', $wi->server ) ) {
	$wgCentralAuthCookieDomain = '.miraheze.org';
	$wgMFStopRedirectCookieHost = '.miraheze.org';
} elseif ( preg_match( '/betaheze\.org$/', $wi->server ) ) {
	$wgCentralAuthCookieDomain = '.betaheze.org';
	$wgMFStopRedirectCookieHost = '.betaheze.org';
} else {
	$wgCentralAuthCookieDomain = $wi->hostname;
	$wgMFStopRedirectCookieHost = $wi->hostname;
}

// DataDump
$wgDataDumpFileBackend = 'miraheze-swift';
$wgDataDumpDirectory = '';

$wgDataDump = [
	'xml' => [
		'file_ending' => '.xml.gz',
		'useBackendTempStore' => true,
		'generate' => [
			'type' => 'mwscript',
			'script' => "$IP/maintenance/dumpBackup.php",
			'options' => [
				'--full',
				'--logs',
				'--uploads',
				'--output',
				'gzip:/tmp/${filename}',
			],
			'arguments' => [
				'--namespaces'
			],
		],
		'limit' => 1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'generate-dump',
			'delete' => 'delete-dump',
		],
		'htmlform' => [
			'name' => 'namespaceselect',
			'type' => 'namespaceselect',
			'exists' => true,
			'noArgsValue' => 'all',
			'hide-if' => [ '!==', 'generatedumptype', 'xml' ],
			'label-message' => 'datadump-namespaceselect-label'
		],
	],
	'image' => [
		'file_ending' => '.tar.gz',
		'generate' => [
			'type' => 'script',
			'script' => '/usr/bin/tar',
			'options' => [
				'--exclude',
				"{$wgUploadDirectory}/archive",
				'--exclude',
				"{$wgUploadDirectory}/deleted",
				'--exclude',
				"{$wgUploadDirectory}/lockdir",
				'--exclude',
				"{$wgUploadDirectory}/temp",
				'--exclude',
				"{$wgUploadDirectory}/thumb",
				'--exclude',
				"{$wgUploadDirectory}/dumps",
				'-zcvf',
				$wgDataDumpDirectory . '${filename}',
				"{$wgUploadDirectory}/"
			],
		],
		'limit' => -1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'managewiki-restricted',
			'delete' => 'delete-dump',
		],
	],
	'managewiki_backup' => [
		'file_ending' => '.json',
		'generate' => [
			'type' => 'mwscript',
			'script' => "$IP/extensions/MirahezeMagic/maintenance/generateManageWikiBackup.php",
			'options' => [
				'--filename',
				'${filename}'
			],
		],
		'limit' => 1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'generate-dump',
			'delete' => 'delete-dump',
		],
	],
];

// ContactPage configuration
if ( $wi->isExtensionActive( 'ContactPage' ) ) {
	$wgContactConfig = [
		'default' => [
			'RecipientUser' => $wmgContactPageRecipientUser ?? null,
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Miraheze No Reply',
			'RequireDetails' => true,
			// Should never be set to true
			'IncludeIP' => false,
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [
				'Text' => [
					'label-message' => 'emailmessage',
					'type' => 'textarea',
					'rows' => 20,
					'required' => true,
				],
			],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => [],
		],
	];
}

// UploadWizard configuration
if ( $wi->isExtensionActive( 'UploadWizard' ) ) {
	$wgUploadWizardConfig = [
		'campaignExpensiveStatsEnabled' => false,
		'flickrApiKey' => $wmgUploadWizardFlickrApiKey,
	];
}

if ( $wi->isExtensionActive( 'Score' ) ) {
	$wgScoreFileBackend = 'miraheze-swift';
}

if ( $wi->isExtensionActive( 'EasyTimeline' ) ) {
	$wgTimelineFileBackend = 'miraheze-swift';
}

// $wgFooterIcons
if ( (bool)$wmgWikiapiaryFooterPageName ) {
	$wgFooterIcons['poweredby']['wikiapiary'] = [
		'src' => 'https://static.miraheze.org/commonswiki/b/b4/Monitored_by_WikiApiary.png',
		'url' => 'https://wikiapiary.com/wiki/' . str_replace( ' ', '_', $wmgWikiapiaryFooterPageName ),
		'alt' => 'Monitored by WikiApiary'
	];
}

// $wgForeignFileRepos
if ( $wmgEnableSharedUploads && $wmgSharedUploadDBname && in_array( $wmgSharedUploadDBname, $wgLocalDatabases ) ) {
	if ( !$wmgSharedUploadBaseUrl || $wmgSharedUploadBaseUrl === $wmgSharedUploadDBname ) {
		$wmgSharedUploadSubdomain = substr( $wmgSharedUploadDBname, 0, -4 );

		$wmgSharedUploadBaseUrl = "{$wmgSharedUploadSubdomain}.miraheze.org";
	}

	$wgForeignFileRepos[] = [
		'class' => ForeignDBViaLBRepo::class,
		'name' => "shared-{$wmgSharedUploadDBname}",
		'backend' => 'miraheze-swift',
		'url' => "https://static.miraheze.org/{$wmgSharedUploadDBname}",
		'hashLevels' => 2,
		'thumbScriptUrl' => false,
		'transformVia404' => true,
		'hasSharedCache' => true,
		'descBaseUrl' => "https://{$wmgSharedUploadBaseUrl}/wiki/File:",
		'scriptDirUrl' => "https://{$wmgSharedUploadBaseUrl}/w",
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => $wmgSharedUploadDBname,
		'initialCapital' => true,
		'zones' => [
			'public' => [
				'container' => 'local-public',
			],
			'thumb' => [
				'container' => 'local-thumb',
			],
			'temp' => [
				'container' => 'local-temp',
			],
			'deleted' => [
				'container' => 'local-deleted',
			],
		],
		'abbrvThreshold' => 160
	];
}

// Miraheze Commons
if ( $wgDBname !== 'commonswiki' && $wgMirahezeCommons ) {
	$wgForeignFileRepos[] = [
		'class' => ForeignDBViaLBRepo::class,
		'name' => 'mirahezecommons',
		'backend' => 'miraheze-swift',
		'url' => 'https://static.miraheze.org/commonswiki',
		'hashLevels' => 2,
		'thumbScriptUrl' => false,
		'transformVia404' => true,
		'hasSharedCache' => true,
		'descBaseUrl' => 'https://commons.miraheze.org/wiki/File:',
		'scriptDirUrl' => 'https://commons.miraheze.org/w',
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => 'commonswiki',
		'initialCapital' => true,
		'zones' => [
			'public' => [
				'container' => 'local-public',
			],
			'thumb' => [
				'container' => 'local-thumb',
			],
			'temp' => [
				'container' => 'local-temp',
			],
			'deleted' => [
				'container' => 'local-deleted',
			],
		],
		'abbrvThreshold' => 160
	];
}

// $wgLogos
$wgLogos = [
	'1x' => $wgLogo,
];

$wgApexLogo = [
	'1x' => $wgLogos['1x'],
	'2x' => $wgLogos['1x'],
];

if ( $wgIcon ) {
	$wgLogos['icon'] = $wgIcon;
}

if ( $wgWordmark ) {
	$wgLogos['wordmark'] = [
		'src' => $wgWordmark,
		'width' => $wgWordmarkWidth,
		'height' => $wgWordmarkHeight,
	];
}

// $wgUrlShortenerAllowedDomains
$wgUrlShortenerAllowedDomains = [
	'(.*\.)?miraheze\.org',
];

if ( preg_match( '/^(.*).betaheze.org$/', $wi->hostname ) ) {
	$wgUrlShortenerAllowedDomains = [
		'(.*\.)?betaheze\.org',
	];
}

if ( !preg_match( '/^(.*).(miraheze|betaheze).org$/', $wi->hostname ) ) {
	$wgUrlShortenerAllowedDomains = array_merge(
		$wgUrlShortenerAllowedDomains,
		[ preg_quote( str_replace( 'https://', '', $wgServer ) ) ]
	);
}

// JsonConfig
if ( $wi->isExtensionActive( 'JsonConfig' ) ) {
	$wgJsonConfigs = [
		'Map.JsonConfig' => [
			'namespace' => 486,
			'nsName' => 'Data',
			// page name must end in ".map", and contain at least one symbol
			'pattern' => '/.\.map$/',
			'license' => 'CC-BY-SA 4.0',
			'isLocal' => false,
		],
		'Tabular.JsonConfig' => [
			'namespace' => 486,
			'nsName' => 'Data',
			// page name must end in ".tab", and contain at least one symbol
			'pattern' => '/.\.tab$/',
			'license' => 'CC-BY-SA 4.0',
			'isLocal' => false,
		],
	];

	if ( $wgDBname !== 'commonswiki' ) {
		$wgJsonConfigs['Map.JsonConfig']['remote'] = [
			'url' => 'https://commons.miraheze.org/w/api.php'
		];

		$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
			'url' => 'https://commons.miraheze.org/w/api.php'
		];
	}
}

// Vector
$vectorVersion = $wgDefaultSkin === 'vector-2022' ? '2' : '1';
$wgVectorDefaultSkinVersionForExistingAccounts = $vectorVersion;

// Don't need a global here
unset( $vectorVersion );

// Licensing variables

/**
 * Default values.
 * We can not set these in LocalSettings.php, to prevent them
 * from causing absolute overrides.
 */
$wgRightsIcon = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
$wgRightsText = 'Creative Commons Attribution Share Alike';
$wgRightsUrl = 'https://creativecommons.org/licenses/by-sa/4.0/';

/**
 * Override values from ManageWiki.
 * If set in LocalSettings.php, this will be overridden
 * by wiki values there, due to caching forcing SiteConfiguration
 * values to be absolute overrides. This is however how licensing should
 * be forced. LocalSettings.php values should take priority, which they do.
 */
switch ( $wmgWikiLicense ) {
	case 'arr':
		$wgRightsIcon = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/License_icon-copyright-88x31.svg/88px-License_icon-copyright-88x31.svg.png';
		$wgRightsText = 'All Rights Reserved';
		$wgRightsUrl = false;
		break;
	case 'cc-by':
		$wgRightsIcon = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by.png';
		$wgRightsText = 'Creative Commons Attribution 4.0 International (CC BY 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by/4.0';
		break;
	case 'cc-by-nc':
		$wgRightsIcon = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc.png';
		$wgRightsText = 'Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nc/4.0/';
		break;
	case 'cc-by-nd':
		$wgRightsIcon = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nd.png';
		$wgRightsText = 'Creative Commons Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nd/4.0/';
		break;
	case 'cc-by-sa':
		$wgRightsIcon = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
		$wgRightsText = 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-sa/4.0/';
		break;
	case 'cc-by-sa-2-0-kr':
		$wgRightsIcon = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
		$wgRightsText = 'Creative Commons BY-SA 2.0 Korea';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-sa/2.0/kr';
		break;
	case 'cc-by-sa-nc':
		$wgRightsIcon = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png';
		$wgRightsText = 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nc-sa/4.0/';
		break;
	case 'cc-by-nc-nd':
		$wgRightsIcon = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png';
		$wgRightsText = 'Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nc-nd/4.0/';
		break;
	case 'cc-pd':
		$wgRightsIcon = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png';
		$wgRightsText = 'CC0 Public Domain';
		$wgRightsUrl = 'https://creativecommons.org/publicdomain/zero/1.0/';
		break;
	case 'gpl-v3':
		$wgRightsIcon = 'https://www.gnu.org/graphics/gplv3-or-later.png';
		$wgRightsText = 'GPLv3';
		$wgRightsUrl = 'https://www.gnu.org/licenses/gpl-3.0-standalone.html';
		break;
	case 'gfdl':
		$wgRightsIcon = 'https://www.gnu.org/graphics/gfdl-logo-tiny.png';
		$wgRightsText = 'GNU Free Document License 1.3';
		$wgRightsUrl = 'https://www.gnu.org/licenses/fdl-1.3.en.html';
		break;
	case 'empty':
		break;
}

/**
 * Make sure it works to override the footer icon
 * for other overrides in LocalSettings.php.
 */
if ( $wgConf->get( 'wgRightsIcon', $wi->dbname ) ) {
	$wgFooterIcons['copyright']['copyright'] = [
		'url' => $wgConf->get( 'wgRightsUrl', $wi->dbname ),
		'src' => $wgConf->get( 'wgRightsIcon', $wi->dbname ),
		'alt' => $wgConf->get( 'wgRightsText', $wi->dbname ),
	];
}

// Kilobytes
$wgMaxShellFileSize = 512 * 1024;
$wgMaxShellMemory = 1024 * 1024;

// 50 seconds
$wgMaxShellTime = 50;

$wgShellCgroup = '/sys/fs/cgroup/memory/mediawiki/job';

$wgJobRunRate = 0;
$wgSVGConverters['inkscape'] = '$path/inkscape -w $width -o $output $input';

// Scribunto
/** 50MB */
$wgScribuntoEngineConf['luasandbox']['memoryLimit'] = 50 * 1024 * 1024;
$wgScribuntoEngineConf['luasandbox']['cpuLimit'] = 10;
