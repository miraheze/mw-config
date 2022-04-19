<?php

// https://phabricator.miraheze.org/T8703
header( 'X-Wiki-Visibility: ' . ( $cwPrivate ? 'Private' : 'Public' ) );

// Extensions
if ( $wi->dbname !== 'ldapwikiwiki' ) {
	wfLoadExtensions( [
		'CentralAuth',
		'GlobalPreferences',
		'GlobalBlocking',
	] );
}

if ( $wgConf->get( 'wmgUseChameleon', $wi->dbname ) ) {
	wfLoadExtension( 'Bootstrap' );
}

if ( $wgMirahezeCommons && !$cwPrivate ) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wgConf->get( 'wmgUseMultimediaViewer', $wi->dbname ) ) {
	if ( $wgConf->get( 'wmgUse3D', $wi->dbname ) ) {
		$wgMediaViewerExtensions['stl'] = 'mmv.3d';
	}
}

if ( $wgConf->get( 'wmgUsePopups', $wi->dbname ) ) {
	if ( $wmgShowPopupsByDefault ) {
		$wgPopupsHideOptInOnPreferencesPage = true;
		$wgPopupsOptInDefaultState = '1';
		$wgPopupsOptInStateForNewAccounts = '1';
		$wgPopupsReferencePreviewsBetaFeature = false;
	}
}

if ( $wgConf->get( 'wmgUseSemanticMediaWiki', $wi->dbname ) ) {
	require_once '/srv/mediawiki/config/SemanticMediaWiki.php';
}

if ( $wgConf->get( 'wmgUseSocialProfile', $wi->dbname ) ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
}

if ( $wgConf->get( 'wmgUseVisualEditor', $wi->dbname ) ) {
	if ( $wmgVisualEditorEnableDefault ) {
		$wgConf->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 1;
		$wgConf->settings['+wmgDefaultUserOptions']['default']['visualeditor-editor'] = 'visualeditor';
	} else {
		$wgConf->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 0;
	}
}

if (
	$wgConf->get( 'wmgUseWikibaseRepository', $wi->dbname ) ||
	$wgConf->get( 'wmgUseWikibaseClient', $wi->dbname )
) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once '/srv/mediawiki/config/Wikibase.php';
}

// If Flow, VisualEditor, or Linter is used, use the Parsoid php extension
if (
	$wgConf->get( 'wmgUseFlow', $wi->dbname ) ||
	$wgConf->get( 'wmgUseVisualEditor', $wi->dbname ) ||
	$wgConf->get( 'wmgUseLinter', $wi->dbname )
) {
	wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );
	$wgVirtualRestConfig['modules']['parsoid'] = [
		'url' => 'https://mw-lb.miraheze.org/w/rest.php',
		'domain' => $wi->server,
		'prefix' => $wi->dbname,
		'forwardCookies' => true,
		'restbaseCompat' => false,
		'timeout' => 30,
	];
}

$wgAllowedCorsHeaders[] = 'X-Miraheze-Debug';

if ( wfHostname() === 'test101' ) {
	// $wgShellboxUrl = 'http://localhost:8080/shellbox';
}

// Closed Wikis
if ( $cwClosed ) {
	$wgConf->settings['wgRevokePermissions']['default'] = [
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

	if ( $wgConf->get( 'wmgUseComments', $wi->dbname ) ) {
		$wgConf->settings['wgRevokePermissions']['default']['*']['comment'] = true;
	}
}

// Public Wikis
if ( !$cwPrivate ) {
	$wgRCFeeds['irc'] = [
		'formatter' => MirahezeIRCRCFeedFormatter::class,
		'uri' => 'udp://[2a10:6740::6:205]:5070',
		'add_interwiki_prefix' => false,
		'omit_bots' => true,
	];

	$wgConf->settings['wgDiscordIncomingWebhookUrl']['default'] = $wmgGlobalDiscordWebhookUrl;
} else {
	if ( $wmgPrivateUploads ) {
		$wgConf->settings['wgDataDumpDirectory']['default'] = "/mnt/mediawiki-static/private/{$wi->dbname}/dumps/";
	} else {
		$wgConf->settings['wgDataDumpDirectory']['default'] = "/mnt/mediawiki-static/private/dumps/{$wi->dbname}/";
	}

	// Unset wgDataDumpDownloadUrl so private wikis stream the download via Special:DataDump/download
	$wgConf->settings['wgDataDumpDownloadUrl']['default'] = '';
}

// Experimental Wikis
if ( $cwExperimental ) {
	$wgParserEnableLegacyMediaDOM = false;
} else {
	$wgParserEnableLegacyMediaDOM = true;
}

// $wmgPrivateUploads
$wgGenerateThumbnailOnParse = false;
if ( $wmgPrivateUploads ) {
	$wgUploadDirectory = "/mnt/mediawiki-static/private/$wgDBname";
	$wgUploadPath = "https://{$wi->hostname}/w/img_auth.php";
	$wgGenerateThumbnailOnParse = true;
}

// DataDump
$dataDumpDirectory = $wgConf->settings['wgDataDumpDirectory']['default'];
$wgConf->settings['wgDataDump']['default'] = [
	'xml' => [
		'file_ending' => '.xml.gz',
		'generate' => [
			'type' => 'mwscript',
			'script' => "$IP/maintenance/dumpBackup.php",
			'options' => [
				'--full',
				'--logs',
				'--uploads',
				'--output',
				"gzip:{$dataDumpDirectory}" . '${filename}',
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
				$dataDumpDirectory . '${filename}',
				"{$wgUploadDirectory}/"
			],
		],
		'limit' => 1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'generate-dump',
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

// $wmgContactPageRecipientUser
if ( $wmgContactPageRecipientUser ) {
	$wgConf->settings['wgContactConfig']['default']['default']['RecipientUser'] = $wmgContactPageRecipientUser;
}

// $wgFooterIcons
if ( (bool)$wmgWikiapiaryFooterPageName ) {
	$wgConf->settings['+wgFooterIcons']['default']['poweredby']['wikiapiary'] = [
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
		'class' => MediaWiki\Extension\QuickInstantCommons\Repo::class,
		'name' => "shared-{$wmgSharedUploadDBname}",
		'directory' => $wgUploadDirectory,
		'apibase' => "https://{$wmgSharedUploadBaseUrl}/w/api.php",
		'hashLevels' => 2,
		'thumbUrl' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 43200,
		'transformVia404' => true,
		'abbrvThreshold' => 255,
		'apiMetadataExpiry' => 86400,
		'disabledMediaHandlers' => [ TiffHandler::class ],
	];
}

// Miraheze Commons
if ( $wgDBname !== 'commonswiki' && $wgMirahezeCommons ) {
	$wgForeignFileRepos[] = [
		'class' => MediaWiki\Extension\QuickInstantCommons\Repo::class,
		'name' => 'mirahezecommons',
		'directory' => $wgUploadDirectory,
		'apibase' => 'https://commons.miraheze.org/w/api.php',
		'hashLevels' => 2,
		'thumbUrl' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 43200,
		'transformVia404' => true,
		'abbrvThreshold' => 255,
		'apiMetadataExpiry' => 86400,
		'disabledMediaHandlers' => [ TiffHandler::class ],
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
if ( !preg_match( '/^(.*).(miraheze|betaheze).org$/', $wi->hostname ) ) {
	$wgConf->settings['wgUrlShortenerAllowedDomains']['default'] =
		array_merge( $wgUrlShortenerAllowedDomains, [ preg_quote( str_replace( 'https://', '', $wgServer ) ) ] );
}

// JsonConfig
if ( $wgDBname === 'commonswiki' ) {
	$wgConf->settings['wgJsonConfigs']['default']['Map.JsonConfig']['store'] = true;
	$wgConf->settings['wgJsonConfigs']['default']['Tabular.JsonConfig']['store'] = true;
} else {
	$wgConf->settings['wgJsonConfigs']['default']['Map.JsonConfig']['remote'] = [
		'url' => 'https://commons.miraheze.org/w/api.php'
	];

	$wgConf->settings['wgJsonConfigs']['default']['Tabular.JsonConfig']['remote'] = [
		'url' => 'https://commons.miraheze.org/w/api.php'
	];
}

// Licensing variables
switch ( $wmgWikiLicense ) {
	case 'arr':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/License_icon-copyright-88x31.svg/88px-License_icon-copyright-88x31.svg.png';
		$wgConf->settings['wgRightsText']['default'] = 'All Rights Reserved';
		$wgConf->settings['wgRightsUrl']['default'] = false;
		break;
	case 'cc-by':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by.png';
		$wgConf->settings['wgRightsText']['default'] = 'Creative Commons Attribution 4.0 International (CC BY 4.0)';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by/4.0';
		break;
	case 'cc-by-nc':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc.png';
		$wgConf->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0)';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nc/4.0/';
		break;
	case 'cc-by-nd':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nd.png';
		$wgConf->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nd/4.0/';
		break;
	case 'cc-by-sa':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
		$wgConf->settings['wgRightsText']['default'] = 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-sa/4.0/';
		break;
	case 'cc-by-sa-2-0-kr':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
		$wgConf->settings['wgRightsText']['default'] = 'Creative Commons BY-SA 2.0 Korea';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-sa/2.0/kr';
		break;
	case 'cc-by-sa-nc':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png';
		$wgConf->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nc-sa/4.0/';
		break;
	case 'cc-by-nc-nd':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png';
		$wgConf->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0)';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nc-nd/4.0/';
		break;
	case 'cc-pd':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png';
		$wgConf->settings['wgRightsText']['default'] = 'CC0 Public Domain';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/publicdomain/zero/1.0/';
		break;
	case 'gpl-v3':
		$wgConf->settings['wgRightsIcon']['default'] = 'https://www.gnu.org/graphics/gplv3-or-later.png';
		$wgConf->settings['wgRightsText']['default'] = 'GPLv3';
		$wgConf->settings['wgRightsUrl']['default'] = 'https://www.gnu.org/licenses/gpl-3.0-standalone.html';
		break;
	case 'empty':
		break;
}

$wgFooterIcons['copyright']['copyright'] = [
	'url' => $wgConf->get( 'wgRightsUrl', $wi->dbname ),
	'src' => $wgConf->get( 'wgRightsIcon', $wi->dbname ),
	'alt' => $wgConf->get( 'wgRightsText', $wi->dbname ),
];

$wgLocalisationUpdateHttpRequestOptions['proxy'] = 'http://bast.miraheze.org:8080';

$wgLocalisationUpdateRepositories['github'] = [
	'mediawiki' => 'https://raw.github.com/wikimedia/mediawiki/master/%PATH%',
	'extension' => false,
	'skin' => false,
];

$wgMaxShellMemory = 215040; // 210MB
$wgMaxShellFileSize = 51200; // 50MB
$wgMaxShellTime = 50;

$wgShellCgroup = '/sys/fs/cgroup/memory/mediawiki/job';

$wgJobRunRate = 0;
$wgSVGConverters['inkscape'] = '$path/inkscape -w $width -o $output $input';

// Slack
$wgConf->settings['wgSlackFromName']['default'] = $wgSitename;
$wgConf->settings['wgSlackNotificationWikiUrl']['default'] = $wgServer . '/w/';

// Scribunto
$wgScribuntoEngineConf['luasandbox']['cpuLimit'] = 4;
$wgScribuntoEngineConf['luasandbox']['maxLangCacheSize'] = 30;
