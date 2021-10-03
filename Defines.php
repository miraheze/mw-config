<?php

// Extensions
if ( $wi->config->get( 'wmgUseCentralAuth', $wi->dbname ) ) {
	wfLoadExtension( 'CentralAuth' );
}

if ( $wi->config->get( 'wmgUseChameleon', $wi->dbname ) ) {
	wfLoadExtension( 'Bootstrap' );
}

if ( $wi->config->get( 'wmgUseCollection', $wi->dbname ) ) {
	wfLoadExtension( 'ElectronPdfService' );
}

if (
	$wi->config->get( 'wgMirahezeCommons', $wi->dbname ) &&
	!$wi->config->get( 'cwPrivate', $wi->dbname )
) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wi->config->get( 'wmgUseGlobalWatchlist', $wi->dbname ) ) {
	wfLoadExtension( 'GlobalWatchlist' );
}

if ( $wi->config->get( 'wmgUseLdap', $wi->dbname ) ) {
	wfLoadExtension( 'LdapAuthentication' );

	$wgAuthManagerAutoConfig['primaryauth'] += [
		LdapPrimaryAuthenticationProvider::class => [
			'class' => LdapPrimaryAuthenticationProvider::class,
			'args' => [ [
				'authoritative' => true, // don't allow local non-LDAP accounts
			] ],
			'sort' => 50, // must be smaller than local pw provider
		],
	];
}

if (
	$wi->config->get( 'wmgUseMultimediaViewer', $wi->dbname ) &&
	$wi->config->get( 'wmgUse3D', $wi->dbname )
) {
	$wgMediaViewerExtensions['stl'] = 'mmv.3d';
}

if (
	$wi->config->get( 'wmgUsePopups', $wi->dbname ) &&
	$wi->config->get( 'wmgShowPopupsByDefault', $wi->dbname )
) {
	$wgPopupsHideOptInOnPreferencesPage = true;
	$wgPopupsOptInDefaultState = '1';
	$wgPopupsOptInStateForNewAccounts = '1';
	$wgPopupsReferencePreviewsBetaFeature = false;
}

if ( $wi->config->get( 'wmgUseSocialProfile', $wi->dbname ) ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
}

if ( $wi->config->get( 'wmgUseVisualEditor', $wi->dbname ) ) {
	if ( $wi->config->get( 'wmgVisualEditorEnableDefault', $wi->dbname ) ) {
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
}

// Closed Wikis
if ( $wi->config->get( 'cwClosed', $wi->dbname ) ) {
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
if ( !$wi->config->get( 'cwPrivate', $wi->dbname ) ) {
	$wgRCFeeds['irc'] = [
		'formatter' => 'MirahezeIRCRCFeedFormatter',
		'uri' => 'udp://51.195.236.249:5070',
		'add_interwiki_prefix' => false,
		'omit_bots' => true,
	];

	$wi->config->settings['wgDiscordAdditionalIncomingWebhookUrls']['default'] = [ $wmgGlobalDiscordWebhookUrl ];
} else {
	if ( $wi->config->get( 'wmgPrivateUploads', $wi->dbname ) ) {
		$wi->config->settings['wgDataDumpDirectory']['default'] = "/mnt/mediawiki-static/private/{$wi->dbname}/dumps/";
	} else {
		$wi->config->settings['wgDataDumpDirectory']['default'] = "/mnt/mediawiki-static/private/dumps/{$wi->dbname}/";
	}

	// Unset wgDataDumpDownloadUrl so private wikis stream the download via Special:DataDump/download
	$wi->config->settings['wgDataDumpDownloadUrl']['default'] = '';
	$wgWhitelistRead = explode( "\n", $wi->config->get( 'wmgWhitelistRead', $wi->dbname ) );
}

// $wmgPrivateUploads
if ( $wi->config->get( 'wmgPrivateUploads', $wi->dbname ) ) {
	$wgUploadDirectory = "/mnt/mediawiki-static/private/$wi->dbname";
	$wgUploadPath = "https://{$wi->hostname}/w/img_auth.php";
	$wi->config->settings['wgGenerateThumbnailOnParse']['default'] = true;
}

if ( $wi->config->get( 'wmgUsersNotifiedOnAllChanges', $wi->dbname ) ) {
	$wgUsersNotifiedOnAllChanges = explode( "\n", $wi->config->get( 'wmgUsersNotifiedOnAllChanges', $wi->dbname ) );
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

// Exempt from Robot Control (INDEX/NOINDEX namespaces)
if ( !$wi->config->get( 'wgExemptFromUserRobotsControl', $wi->dbname ) ) {
	$wi->config->get( 'wgExemptFromUserRobotsControl', $wi->dbname ) = [];
}

// CookieWarning exempt ElectronPdfService
if ( in_array( $_SERVER['REMOTE_ADDR'] ?? false, [ '51.195.236.212', '2001:41d0:800:178a::10', '51.195.236.246', '2001:41d0:800:1bbd::13' ] ) ) {
	$wi->config->settings['wgCookieWarningEnabled']['default'] = false;
}

// $wmgContactPageRecipientUser
if ( $wi->config->get( 'wmgContactPageRecipientUser', $wi->dbname ) ) {
	$wi->config->settings['wgContactConfig']['default']['default']['RecipientUser'] = $wi->config->get( 'wmgContactPageRecipientUser', $wi->dbname );
}

// $wgFooterIcons
if ( (bool)$wi->config->get( 'wmgWikiapiaryFooterPageName', $wi->dbname ) ) {
	$wi->config->settings['+wgFooterIcons']['default']['poweredby']['wikiapiary'] = [
		'src' => 'https://static.miraheze.org/commonswiki/b/b4/Monitored_by_WikiApiary.png',
		'url' => 'https://wikiapiary.com/wiki/' . str_replace( ' ', '_', $wi->config->get( 'wmgWikiapiaryFooterPageName', $wi->dbname ) ),
		'alt' => 'Monitored by WikiApiary'
	];
}

// $wgForeignFileRepos
if (
	$wi->config->get( 'wmgEnableSharedUploads', $wi->dbname ) &&
	$wi->config->get( 'wmgSharedUploadDBname', $wi->dbname ) &&
	in_array(
		$wi->config->get( 'wmgSharedUploadDBname', $wi->dbname ),
		$wi->config->get( 'wgLocalDatabases', $wi->dbname )
	)
) {
	if (
	!$wi->config->get( 'wmgSharedUploadBaseUrl', $wi->dbname ) ||
	$wi->config->get( 'wmgSharedUploadBaseUrl', $wi->dbname ) ===
		$wi->config->get( 'wmgSharedUploadDBname', $wi->dbname )
) {
		$wmgSharedUploadSubdomain = substr( $wi->config->get( 'wmgSharedUploadDBname', $wi->dbname ), 0, -4 );

		$wmgSharedUploadBaseUrl = "{$wmgSharedUploadSubdomain}.miraheze.org";
	} else {
		$wmgSharedUploadBaseUrl = $wi->config->get( 'wmgSharedUploadBaseUrl', $wi->dbname );
	}

	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => "shared-{$wi->config->get( 'wmgSharedUploadDBname', $wi->dbname )}",
		'directory' => "/mnt/mediawiki-static/{$wi->config->get( 'wmgSharedUploadDBname', $wi->dbname )}",
		'url' => "https://static.miraheze.org/{$wi->config->get( 'wmgSharedUploadDBname', $wi->dbname )}",
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => $wi->config->get( 'wmgSharedUploadDBname', $wi->dbname ),
		'descBaseUrl' => "https://{$wmgSharedUploadBaseUrl}/wiki/File:",
		'scriptDirUrl' => "https://{$wmgSharedUploadBaseUrl}/w",
	];
}

// Miraheze Commons
if ( $wi->dbname !== 'commonswiki' && $wi->config->get( 'wgMirahezeCommons', $wi->dbname ) ) {
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared-commons',
		'directory' => '/mnt/mediawiki-static/commonswiki',
		'url' => 'https://static.miraheze.org/commonswiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => 'commonswiki',
		'descBaseUrl' => 'https://commons.miraheze.org/wiki/File:',
	];
}

// $wgLogos
$wgLogos = [
	'1x' => $wi->config->get( 'wgLogo', $wi->dbname ),
];

$wgApexLogo = [
	'1x' => $wgLogos['1x'],
	'2x' => $wgLogos['1x'],
];

if ( $wi->config->get( 'wgIcon', $wi->dbname ) ) {
	$wgLogos['icon'] = $wi->config->get( 'wgIcon', $wi->dbname );
}

if ( $wi->config->get( 'wgWordmark', $wi->dbname ) ) {
	$wgLogos['wordmark'] = [
		'src' => $wi->config->get( 'wgWordmark', $wi->dbname ),
		'width' => $wi->config->get( 'wgWordmarkWidth', $wi->dbname ),
		'height' => $wi->config->get( 'wgWordmarkHeight', $wi->dbname ),
	];
}

// $wgUrlShortenerAllowedDomains
if ( !preg_match( '/^(.*).miraheze.org$/', $wi->hostname ) ) {
	$wi->config->settings['wgUrlShortenerAllowedDomains']['default'] =
		array_merge( $wi->config->get( 'wgUrlShortenerAllowedDomains', $wi->dbname ), [ preg_quote( str_replace( 'https://', '', $wi->server ) ) ] );
}

// JsonConfig
if ( $wi->dbname === 'commonswiki' ) {
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
switch ( $wi->config->get( 'wmgWikiLicense', $wi->dbname ) ) {
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

// Discord
$wi->config->settings['wgDiscordFromName']['default'] = $wi->sitename;
$wi->config->settings['wgDiscordNotificationWikiUrl']['default'] = $wi->server . '/w/';

// Slack
$wi->config->settings['wgSlackFromName']['default'] = $wi->sitename;
$wi->config->settings['wgSlackNotificationWikiUrl']['default'] = $wi->server . '/w/';

// Scribunto
$wgScribuntoEngineConf['luasandbox']['cpuLimit'] = 5;
$wgScribuntoEngineConf['luasandbox']['maxLangCacheSize'] = 200;
