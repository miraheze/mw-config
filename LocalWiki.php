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

	if ( $cwPrivate ) {
		$wgHooks['SiteNoticeAfter'][] = 'onClosedSiteNoticeAfter';
		function onClosedSiteNoticeAfter( &$siteNotice, $skin ) {
			$siteNotice .= <<<EOF
				<div class="wikitable" style="text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;"> <span class="plainlinks"> <img src="https://static.miraheze.org/metawiki/0/02/Wiki_lock.png" align="left" style="width:80px;height:90px";>This wiki has been closed because there have been <b>no edits</b> or <b>logs</b> made within the last 60 days. Since this wiki is private, it may not be adopted as a public wiki would be. If this wiki is not reopened within 6 months it may be deleted. Note: If you are a bureaucrat on this wiki you can go to <a href="/wiki/Special:ManageWiki">Special:ManageWiki</a> and uncheck the "closed" box to reopen it. If you have any other questions or concerns, please don't hesitate to ask at <a href="https://meta.miraheze.org/wiki/Stewards%27_noticeboard">Stewards' noticeboard</a>. </span></div>
EOF;
		}
	} else {
		$wgHooks['SiteNoticeAfter'][] = 'onClosedSiteNoticeAfter';
		function onClosedSiteNoticeAfter( &$siteNotice, $skin ) {
			$siteNotice .= <<<EOF
				<div class="wikitable" style="text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;"> <span class="plainlinks"> <img src="https://static.miraheze.org/metawiki/0/02/Wiki_lock.png" align="left" style="width:80px;height:90px";>This wiki has been closed because there have been <b>no edits</b> or <b>logs</b> made within the last 60 days. This wiki is now eligible for being adopted. To adopt this wiki please go to <a href="https://meta.miraheze.org/wiki/Requests_for_adoption">Requests for adoption</a> and make a request. If this wiki is not adopted within 6 months it may be deleted. Note: If you are a bureaucrat on this wiki you can go to <a href="/wiki/Special:ManageWiki">Special:ManageWiki</a> and uncheck the "closed" box to reopen it. </span></div>
EOF;
		}
	}
}

// Inactive Wikis
if ( $cwInactive && (string)$cwInactive != 'exempt' ) {
	if ( $cwPrivate ) {
	        $wgHooks['SiteNoticeAfter'][] = 'onInactiveSiteNoticeAfter';
	        function onInactiveSiteNoticeAfter( &$siteNotice, $skin ) {
		        $siteNotice .= <<<EOF
			<div class="wikitable" style="text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;"> <span class="plainlinks"> <img src="https://static.miraheze.org/metawiki/5/5f/Out_of_date_clock_icon.png" align="left" style="width:80px;height:90px";>This wiki has <b>no edits</b> or <b>logs</b> made within the last 45 days, therefore it is marked as <b><u>inactive</b></u>. If you would like to prevent this wiki from being <b>closed</b>, please start showing signs of activity here. If there are no signs of this wiki being used within the next 15 days, this wiki may be closed per the <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. This wiki will not be eligible for adoption by another user even after it is closed since it is private. If this wiki is still inactive 135 days from now, this wiki will become eligible for <b>deletion</b>. Please be sure to familiarize yourself with Miraheze's <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. If you are a bureaucrat, you can go to <u><a href="/wiki/Special:ManageWiki">Special:ManageWiki</a></u> and uncheck "inactive" yourself. If you have any other questions or concerns, please don't hesitate to ask at <a href="https://meta.miraheze.org/wiki/Stewards%27_noticeboard">Stewards' noticeboard</a>. </span></div>
EOF;
	}
} else {
	$wgHooks['SiteNoticeAfter'][] = 'onInactiveSiteNoticeAfter';
	function onInactiveSiteNoticeAfter( &$siteNotice, $skin ) {
		        $siteNotice .= <<<EOF
			<div class="wikitable" style="text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;"> <span class="plainlinks"> <img src="https://static.miraheze.org/metawiki/5/5f/Out_of_date_clock_icon.png" align="left" style="width:80px;height:90px";>This wiki has <b>no edits</b> or <b>logs</b> made within the last 45 days, therefore it is marked as <b><u>inactive</b></u>. If you would like to prevent this wiki from being <b>closed</b>, please start showing signs of activity here. If there are no signs of this wiki being used within the next 15 days, this wiki may be closed per the <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. This wiki will then be eligible for adoption by another user. If not adopted and still inactive 135 days from now, this wiki will become eligible for <b>deletion</b>. Please be sure to familiarize yourself with Miraheze's <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. If you are a bureaucrat, you can go to <u><a href="/wiki/Special:ManageWiki">Special:ManageWiki</a></u> and uncheck "inactive" yourself. If you have any other questions or concerns, please don't hesitate to ask at <a href="https://meta.miraheze.org/wiki/Stewards%27_noticeboard">Stewards' noticeboard</a>. </span></div>
EOF;
		}
	}
}

// Public Wikis
if ( !$cwPrivate ) {
	$wgRCFeeds['irc'] = [
		'formatter' => 'MirahezeIRCRCFeedFormatter',
		'uri' => 'udp://51.89.160.138:5070',
		'add_interwiki_prefix' => false,
		'omit_bots' => true,
	];

	// global extension
	wfLoadExtension( 'DiscordNotifications' );
} else {
	$wgWhitelistRead .= "\nSpecial:OAuth";
}

// CookieWarning exempt ElectronPdfService
if ( isset( $_SERVER['REMOTE_ADDR'] ) &&
	    ( $_SERVER['REMOTE_ADDR'] === '51.89.160.132' || $_SERVER['REMOTE_ADDR'] === '2001:41d0:800:1056::7' || $_SERVER['REMOTE_ADDR'] === '51.89.160.141' || $_SERVER['REMOTE_ADDR'] === '2001:41d0:800:105a::9' ) ) {
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
if ( $wmgSharedUploadDBname && in_array( $wmgSharedUploadDBname, $wgLocalDatabases ) ) {
	if ( !$wmgSharedUploadBaseUrl || $wmgSharedUploadBaseUrl === $wmgSharedUploadDBname ) {
		$wmgSharedUploadSubdomain = substr($wmgSharedUploadDBname, 0, -4);

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

if ( $wgDBname === 'csydeswiki' ) {
	wfLoadExtension( 'HAWelcome' ); // T6272
}

if ( $wmgPrivateUploads ) {
	$wgUploadDirectory = "/mnt/mediawiki-static/private/$wgDBname";
	$wgUploadPath = "https://{$wi->hostname}/w/img_auth.php";
	$wi->config->settings['wgGenerateThumbnailOnParse']['default'] = true;
}

if ( $wgDBname === 'metawiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'wfModifyMetaTags';

	function wfModifyMetaTags( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}

	$wgHooks['SkinBuildSidebar'][] = 'wfDonateLink';

	function wfDonateLink( $skin, &$bar ) {
		$bar['donate'][] = [
			'text'  => $skin->msg( 'miraheze-donate' ),
			'href'  => '/wiki/Donate',
			'title' => $skin->msg( 'miraheze-donate' ),
			'id'    => 'n-donate',
		];
	}
}

if ( $wgDBname === 'newusopediawiki' ) {
	$wgFilterLogTypes['comments'] = false;
}

if ( $wgDBname === 'thelonsdalebattalionwiki' ) {
	$egMapsDefaultService = 'googlemaps3';
}

if ( $wgDBname === 'simcitywiki' ) {
	unset( $wgGroupPermissions['oversight'] );
	unset( $wgGroupPermissions['interwiki-admin'] );
	unset( $wgGroupPermissions['checkuser'] );
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
	case 'cc-by-sa-3-0':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png';
		$wi->config->settings['wgRightsText']['default'] = 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)';
		$wi->config->settings['wgRightsUrl']['default'] = 'https://creativecommons.org/licenses/by-sa/3.0';
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

if ( $wgDBname === 'erislywiki' ) { // T5981
	$wgHooks['OutputPageParserOutput'][] = 'onOutputPageParserOutput';
	function onOutputPageParserOutput( OutputPage &$out, ParserOutput $parseroutput ) {
		// $out is an instance of the OutputPage object.
		// Add a meta tag
		$out->addMeta( 'PreMiD_Presence', 'Erisly' );
	}
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

// Discord
$wi->config->settings['wgDiscordFromName']['default'] = $wgSitename;
$wi->config->settings['wgDiscordNotificationWikiUrl']['default'] = $wgServer . '/w/';
$wi->config->settings['wgDiscordAdditionalIncomingWebhookUrls']['default'] = $wmgWikiMirahezeDiscordHooks['default'];
if ( isset( $wmgWikiMirahezeDiscordHooks[ $wgDBname ] ) ) {
	$wi->config->settings['wgDiscordAdditionalIncomingWebhookUrls']['default'] = array_merge(
		$wmgWikiMirahezeDiscordHooks['default'],
		$wmgWikiMirahezeDiscordHooks[ $wgDBname ]
	);
}

// Slack
$wi->config->settings['wgSlackFromName']['default'] = $wgSitename;
$wi->config->settings['wgSlackNotificationWikiUrl']['default'] = $wgServer . '/w/';
$wi->config->settings['wgSlackIncomingWebhookUrl']['default'] = $wmgWikiMirahezeDiscordHooks['default'];
if ( isset( $wmgWikiMirahezeSlackHooks[ $wgDBname ] ) ) {
	$wi->config->settings['wgSlackIncomingWebhookUrl']['default'] = $wmgWikiMirahezeSlackHooks[ $wgDBname ];
}
