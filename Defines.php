<?php

// Extensions
if ( $wi->dbname !== 'ldapwikiwiki' ) {
	wfLoadExtensions( [
		'CentralAuth',
		'GlobalPreferences',
	] );
}

if ( $wi->config->get( 'wmgUseChameleon', $wi->dbname ) ) {
	wfLoadExtension( 'Bootstrap' );
}

if ( $wgMirahezeCommons && !$cwPrivate ) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wi->config->get( 'wmgUseMultimediaViewer', $wi->dbname ) ) {
	if ( $wi->config->get( 'wmgUse3D', $wi->dbname ) ) {
		$wgMediaViewerExtensions['stl'] = 'mmv.3d';
	}
}

if ( $wi->config->get( 'wmgUsePopups', $wi->dbname ) ) {
	if ( $wmgShowPopupsByDefault ) {
		$wgPopupsHideOptInOnPreferencesPage = true;
		$wgPopupsOptInDefaultState = '1';
		$wgPopupsOptInStateForNewAccounts = '1';
		$wgPopupsReferencePreviewsBetaFeature = false;
	}
}

if ( $wi->config->get( 'wmgUseSocialProfile', $wi->dbname ) ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
}

if ( $wi->config->get( 'wmgUseVisualEditor', $wi->dbname ) ) {
	if ( $wmgVisualEditorEnableDefault ) {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 1;
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-editor'] = 'visualeditor';
	} else {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 0;
	}
}

if (
	$wi->config->get( 'wmgUseWikibaseRepository', $wi->dbname ) ||
	$wi->config->get( 'wmgUseWikibaseClient', $wi->dbname )
) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once '/srv/mediawiki/config/Wikibase.php';
}

// If Flow, VisualEditor, or Linter is used, use the Parsoid php extension
if (
	$wi->config->get( 'wmgUseFlow', $wi->dbname ) ||
	$wi->config->get( 'wmgUseVisualEditor', $wi->dbname ) ||
	$wi->config->get( 'wmgUseLinter', $wi->dbname )
) {
	wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );
	$wgVirtualRestConfig['modules']['parsoid'] = [
		'url' => "{$wi->server}/w/rest.php",
		'domain' => $wi->server,
		'prefix' => $wi->dbname,
		'forwardCookies' => true,
		'restbaseCompat' => false,
		'timeout' => 15,
	];
}

$wgAllowedCorsHeaders[] = 'X-Miraheze-Debug';

if ( wfHostname() === 'test101' ) {
	// $wgShellboxUrl = 'http://localhost:8080/shellbox';
}

// Closed Wikis
if ( $cwClosed ) {
	$wi->config->settings['wgRevokePermissions']['default'] = [
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

	if ( $wi->config->get( 'wmgUseComments', $wi->dbname ) ) {
		$wi->config->settings['wgRevokePermissions']['default']['*']['comment'] = true;
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

	$wi->config->settings['wgDiscordAdditionalIncomingWebhookUrls']['default'] = [ $wmgGlobalDiscordWebhookUrl ];
} else {
	if ( $wmgPrivateUploads ) {
		$wi->config->settings['wgDataDumpDirectory']['default'] = "/mnt/mediawiki-static/private/{$wi->dbname}/dumps/";
	} else {
		$wi->config->settings['wgDataDumpDirectory']['default'] = "/mnt/mediawiki-static/private/dumps/{$wi->dbname}/";
	}

	// Unset wgDataDumpDownloadUrl so private wikis stream the download via Special:DataDump/download
	$wi->config->settings['wgDataDumpDownloadUrl']['default'] = '';
	$wgWhitelistRead = explode( "\n", $wmgWhitelistRead );

	// Never allow Special:Preferences to be whitelisted (T8448)
	if ( $wgWhitelistRead['Special:Preferences'] ?? false ) {
		unset( $wgWhitelistRead['Special:Preferences'] );
	}
}

// Experimental Wikis
if ( $cwExperimental ) {
	$wgParserEnableLegacyMediaDOM = false;

	$wgLocalFileRepo = [
		'class' => LocalRepo::class,
		'name' => 'local',
		'directory' => $wgUploadDirectory,
		'scriptDirUrl' => $wgScriptPath,
		'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
		'hashLevels' => $wgHashedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => $wgThumbnailScriptPath,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'deletedDir' => $wgDeletedDirectory,
		'deletedHashLevels' => $wgHashedUploadDirectory ? 3 : 0,
		'updateCompatibleMetadata' => $wgUpdateCompatibleMetadata,
		'reserializeMetadata' => $wgUpdateCompatibleMetadata,
		'useJsonMetadata' => true,
		'useSplitMetadata' => true,
	];
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

if ( $wmgUsersNotifiedOnAllChanges ) {
	$wgUsersNotifiedOnAllChanges = explode( "\n", $wmgUsersNotifiedOnAllChanges );
}

if ( $wmgRPRatingPageBlacklist ) {
	$wgRPRatingPageBlacklist = explode( "\n", $wmgRPRatingPageBlacklist );
}

// DataDump
$dataDumpDirectory = $wi->config->settings['wgDataDumpDirectory']['default'];
$wi->config->settings['wgDataDump']['default'] = [
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
	$wi->config->settings['wgContactConfig']['default']['default']['RecipientUser'] = $wmgContactPageRecipientUser;
}

// $wgFooterIcons
if ( (bool)$wmgWikiapiaryFooterPageName ) {
	$wi->config->settings['+wgFooterIcons']['default']['poweredby']['wikiapiary'] = [
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
	$wi->config->settings['wgUrlShortenerAllowedDomains']['default'] =
		array_merge( $wgUrlShortenerAllowedDomains, [ preg_quote( str_replace( 'https://', '', $wgServer ) ) ] );
}

// JsonConfig
if ( $wgDBname === 'commonswiki' ) {
	$wi->config->settings['wgJsonConfigs']['default']['Map.JsonConfig']['store'] = true;
	$wi->config->settings['wgJsonConfigs']['default']['Tabular.JsonConfig']['store'] = true;
} else {
	$wi->config->settings['wgJsonConfigs']['default']['Map.JsonConfig']['remote'] = [
		'url' => 'https://commons.miraheze.org/w/api.php'
	];

	$wi->config->settings['wgJsonConfigs']['default']['Tabular.JsonConfig']['remote'] = [
		'url' => 'https://commons.miraheze.org/w/api.php'
	];
}

// Licensing variables
switch ( $wmgWikiLicense ) {
	case 'arr':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/License_icon-copyright-88x31.svg/88px-License_icon-copyright-88x31.svg.png';
		$wi->config->settings['wgRightsText']['default'] = 'All Rights Reserved';
		$wi->config->settings['wgRightsUrl']['default'] = false;
		break;
	case 'cc-by':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons Attribution 4.0 International (CC BY 4.0)';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by/4.0';
		break;
	case 'cc-by-nc':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0)';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nc/4.0/';
		break;
	case 'cc-by-nd':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nd.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nd/4.0/';
		break;
	case 'cc-by-sa':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-sa/4.0/';
		break;
	case 'cc-by-sa-2-0-kr':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons BY-SA 2.0 Korea';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-sa/2.0/kr';
		break;
	case 'cc-by-sa-nc':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nc-sa/4.0/';
		break;
	case 'cc-by-nc-nd':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0)';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-nc-nd/4.0/';
		break;
	case 'cc-pd':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png';
		$wi->config->settings['wgRightsText']['default'] = 'CC0 Public Domain';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/publicdomain/zero/1.0/';
		break;
	case 'gpl-v3':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://www.gnu.org/graphics/gplv3-or-later.png';
		$wi->config->settings['wgRightsText']['default'] = 'GPLv3';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://www.gnu.org/licenses/gpl-3.0-standalone.html';
		break;
	case 'empty':
		break;
}

$wgFooterIcons['copyright']['copyright'] = [
	'url' => $wi->config->get( 'wgRightsUrl', $wi->dbname ),
	'src' => $wi->config->get( 'wgRightsIcon', $wi->dbname ),
	'alt' => $wi->config->get( 'wgRightsText', $wi->dbname ),
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

$wgUseQuickInstantCommons = false;
if ( $wgUseInstantCommons ) {
	$wgUseInstantCommons = false;
	$wgUseQuickInstantCommons = true;
}

// Discord
$wi->config->settings['wgDiscordFromName']['default'] = $wgSitename;
$wi->config->settings['wgDiscordNotificationWikiUrl']['default'] = $wgServer . '/w/';

// Slack
$wi->config->settings['wgSlackFromName']['default'] = $wgSitename;
$wi->config->settings['wgSlackNotificationWikiUrl']['default'] = $wgServer . '/w/';

// Scribunto
$wgScribuntoEngineConf['luasandbox']['cpuLimit'] = 4;
$wgScribuntoEngineConf['luasandbox']['maxLangCacheSize'] = 30;
