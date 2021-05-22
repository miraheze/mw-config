<?php

// All group of wikis/tag specific things should go at the top. Below the file, custom wiki config starts.

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
	
	if ( $wmgUseComments ) {
		$wi->config->settings['wgRevokePermissions']['default']['*']['comment'] = true;
	}
}


// Public Wikis
if ( !$cwPrivate ) {
	$wgRCFeeds['irc'] = [
		'formatter' => 'MirahezeIRCRCFeedFormatter',
		'uri' => 'udp://51.195.236.249:5070',
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
}

// $wmgPrivateUploads
if ( $wmgPrivateUploads ) {
	$wgUploadDirectory = "/mnt/mediawiki-static/private/$wgDBname";
	$wgUploadPath = "https://{$wi->hostname}/w/img_auth.php";
	$wi->config->settings['wgGenerateThumbnailOnParse']['default'] = true;
}

if ( $wmgUsersNotifiedOnAllChanges ) {
	$wgUsersNotifiedOnAllChanges = explode( "\n", $wmgUsersNotifiedOnAllChanges );
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
		],
		'limit' => 1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'generate-dump',
			'delete' => 'delete-dump',
		],
	],
	'xml-namespace' => [
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
			]
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
		    'value' => '--namespaces',
		    'hide-if' => [ '!==', 'generatedumptype', 'xml-namespace' ]
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

// CookieWarning exempt ElectronPdfService
if ( isset( $_SERVER['REMOTE_ADDR'] ) && in_array( $_SERVER['REMOTE_ADDR'], [ '51.195.236.212', '2001:41d0:800:178a::10', '51.195.236.246', '2001:41d0:800:1bbd::13' ] ) ) {
	$wi->config->settings['wgCookieWarningEnabled']['default'] = false;
}

// $wmgContactPageRecipientUser
if( $wmgContactPageRecipientUser ) {
	$wi->config->settings['wgContactConfig']['default']['default']['RecipientUser'] = $wmgContactPageRecipientUser;
}

// $wgFooterIcons
if ( (bool)$wmgWikiapiaryFooterPageName ) {
 	$wi->config->settings['+wgFooterIcons']['default']['poweredby']['wikiapiary'] = [
 		'src' => 'https://wikiapiary.com/w/images/wikiapiary/b/b4/Monitored_by_WikiApiary.png',
 		'url' => 'https://wikiapiary.com/wiki/' . str_replace(' ', '_', $wmgWikiapiaryFooterPageName),
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
		'class' => 'ForeignDBViaLBRepo',
		'name' => "shared-{$wmgSharedUploadDBname}",
		'directory' => "/mnt/mediawiki-static/{$wmgSharedUploadDBname}",
		'url' => "https://static.miraheze.org/{$wmgSharedUploadDBname}",
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => $wmgSharedUploadDBname,
		'descBaseUrl' => "https://{$wmgSharedUploadBaseUrl}/wiki/File:",
		'scriptDirUrl' => "https://{$wmgSharedUploadBaseUrl}/w",
	];
}

// Miraheze Commons
if ( $wgDBname !== 'commonswiki' && $wgMirahezeCommons ) {
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
	'1x' => $wgLogo,
];

if ( $wgWordmark ) {
	$wgLogos['wordmark'] = [
		'src' => $wgWordmark,
		'width' => $wgWordmarkWidth,
		'height' => $wgWordmarkHeight,
	];
}

// $wgUrlShortenerAllowedDomains
if ( !preg_match( '/^(.*).miraheze.org$/', $wi->hostname ) ) {
	$wi->config->settings['wgUrlShortenerAllowedDomains']['default'] =
		array_merge( $wgUrlShortenerAllowedDomains, [ preg_quote( str_replace( 'https://', '', $wgServer ) ) ] );
}

// $wmgUseYandexTranslate
if ( $wmgUseYandexTranslate ) {
	$wgTranslateTranslationServices['Yandex'] = [
		'url' => 'https://translate.yandex.net/api/v1.5/tr.json/translate',
		'key' => $wmgYandexTranslationKey,
		'pairs' => 'https://translate.yandex.net/api/v1.5/tr.json/getLangs',
		'timeout' => 3,
		'langorder' => [ 'en', 'ru', 'uk', 'de', 'fr', 'pl', 'it', 'es', 'tr' ],
		'langlimit' => 1,
		'type' => 'yandex',
	];
}

// Per-wiki settings
if ( $wgDBname === 'dcmultiversewiki' ) {
	$wgDplSettings['allowUnlimitedCategories'] = true;
	$wgDplSettings['allowUnlimitedResults'] = true;
	$wgDplSettings['maxResultCount'] = 999;
}

if ( $wgDBname === 'erislywiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';
	
	function onBeforePageDisplay( OutputPage $out ) {
		$out->addMeta( 'PreMiD_Presence', 'Erisly' );
	}
}

if ( $wgDBname === 'metawiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

	function onBeforePageDisplay( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}

	$wgHooks['SkinBuildSidebar'][] = 'onSkinBuildSidebar';

	function onSkinBuildSidebar( $skin, &$bar ) {
		$bar['miraheze-sidebar-donate'][] = [
			'text' => $skin->msg( 'miraheze-donate' ),
			'href' => '/wiki/Special:MyLanguage/Donate',
			'title' => $skin->msg( 'miraheze-donate' ),
			'id' => 'n-donate',
		];
	}
}

if ( $wgDBname === 'pokemundowiki') {
	$wgHooks['BeforePageDisplay'][] = 'loadFonts';

	function loadFonts ( OutputPage $out ) {
		$out->addLink( ['rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com'] );
		$out->addLink( ['rel' => 'stylesheet', 'href' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap'] );
	}
}

if ( $wgDBname === 'snapwikiwiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'addViewport';
	
	function addViewport( OutputPage $out ) {
		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
	}
}

if ( $wgDBname === 'newusopediawiki' ) {
	$wgFilterLogTypes['comments'] = false;
}

if ( $wgDBname === 'traceprojectwikiwiki' ) {
	$wgDplSettings['allowUnlimitedCategories'] = true;
	$wgDplSettings['allowUnlimitedResults'] = true;
}

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

// Discord
$wi->config->settings['wgDiscordFromName']['default'] = $wgSitename;
$wi->config->settings['wgDiscordNotificationWikiUrl']['default'] = $wgServer . '/w/';

// Slack
$wi->config->settings['wgSlackFromName']['default'] = $wgSitename;
$wi->config->settings['wgSlackNotificationWikiUrl']['default'] = $wgServer . '/w/';
