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

	if ( $cwPrivate ) {
		$wgHooks['SiteNoticeAfter'][] = 'onClosedSiteNoticeAfter';
		function onClosedSiteNoticeAfter( &$siteNotice, $skin ) {
			$siteNotice .= <<<EOF
				<div class="wikitable" style="text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;"> <span class="plainlinks"> <img src="https://static.miraheze.org/metawiki/0/02/Wiki_lock.png" align="left" style="width:80px;height:90px";>This wiki has been closed because there have been <b>no edits</b> or <b>logs</b> made within the last 60 days. Since this wiki is private, it may not be adopted as a public wiki would be. If this wiki is not reopened within 6 months it may be deleted. Note: If you are a bureaucrat on this wiki you can go to <a href="/wiki/Special:ManageWiki">Special:ManageWiki</a> and uncheck the "closed" box to reopen it. If you have any other questions or concerns, please don't hesitate to ask at <a href="https://meta.miraheze.org/wiki/Stewards%27_noticeboard">Stewards' noticeboard</a>. </span></div>
EOF;
			return true;
		}
	} else {
		$wgHooks['SiteNoticeAfter'][] = 'onClosedSiteNoticeAfter';
		function onClosedSiteNoticeAfter( &$siteNotice, $skin ) {
			$siteNotice .= <<<EOF
				<div class="wikitable" style="text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;"> <span class="plainlinks"> <img src="https://static.miraheze.org/metawiki/0/02/Wiki_lock.png" align="left" style="width:80px;height:90px";>This wiki has been closed because there have been <b>no edits</b> or <b>logs</b> made within the last 60 days. This wiki is now eligible for being adopted. To adopt this wiki please go to <a href="https://meta.miraheze.org/wiki/Requests_for_adoption">Requests for adoption</a> and make a request. If this wiki is not adopted within 6 months it may be deleted. Note: If you are a bureaucrat on this wiki you can go to <a href="/wiki/Special:ManageWiki">Special:ManageWiki</a> and uncheck the "closed" box to reopen it. </span></div>
EOF;
			return true;
		}
	}
}

// Inactive Wikis
if ( $cwInactive && (string)$cwInactive != 'exempt' ) {
	$wgHooks['SiteNoticeAfter'][] = 'onInactiveSiteNoticeAfter';
	function onInactiveSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<div class="wikitable" style="text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;"> <span class="plainlinks"> <img src="https://static.miraheze.org/metawiki/5/5f/Out_of_date_clock_icon.png" align="left" style="width:80px;height:90px";>This wiki has <b>no edits</b> or <b>logs</b> made within the last 45 days, therefore it is marked as <b><u>inactive</b></u>. If you would like to prevent this wiki from being <b>closed</b>, please start showing signs of activity here. If there are no signs of this wiki being used within the next 15 days, this wiki may be closed per the <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. This wiki will then be eligible for adoption by another user. If not adopted and still inactive 135 days from now, this wiki will become eligible for <b>deletion</b>. Please be sure to familiarize yourself with Miraheze's <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. If there is activity on this wiki you can go to <u><a href="/wiki/Special:ManageWiki">Special:ManageWiki</a></u> and uncheck "inactive" yourself. If you have any other questions or concerns, please don't hesitate to ask at <a href="https://meta.miraheze.org/wiki/Stewards%27_noticeboard">Stewards' noticeboard</a>. </span></div>
EOF;
		return true;
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

	$wgDiscordFromName = $wgSitename;
	$wgDiscordShowNewUserEmail = false;
	$wgDiscordShowNewUserIP = false;
	$wgDiscordNotificationsShowSuppressed = false;
	$wgDiscordNotificationWikiUrl = $wgServer . '/w/';
	$wgDiscordAdditionalIncomingWebhookUrls =
		$wmgWikiMirahezeDiscordHooks[$wgDBname] ?? $wmgWikiMirahezeDiscordHooks['default'];
}

// CookieWarning exempt ElectronPdfService
if ( isset( $_SERVER['REMOTE_ADDR'] ) &&
	    ( $_SERVER['REMOTE_ADDR'] === '51.89.160.132' || $_SERVER['REMOTE_ADDR'] === '2001:41d0:800:1056::7' || $_SERVER['REMOTE_ADDR'] === '51.89.160.141' || $_SERVER['REMOTE_ADDR'] === '2001:41d0:800:105a::9' ) ) {
	$wi->config->settings['wgCookieWarningEnabled']['default'] = false;
}

// Per-wiki overrides
if ( $wgDBname === 'allthetropeswiki' ) {
	$wgRelatedArticlesFooterBlacklistedSkins = [ "minerva" ];
}

if ( $wgDBname === 'ayrshirewiki' ) {
	$wgSpecialPages['MapEditor'] = 'SpecialMapEditor';
	$wgSpecialPageGroups['MapEditor'] = 'maps';
}

if ( $wmgPrivateUploads ) {
	$wgUploadDirectory = "/mnt/mediawiki-static/private/$wgDBname";
	$wgUploadPath = "https://{$wi->hostname}/w/img_auth.php";
	$wi->config->settings['wgGenerateThumbnailOnParse']['default'] = true;
}

if ( $wgDBname === 'hamzawiki' ) {
	 $wgWhitelistRead[] = [
		"Rukus"
	];
}

if ( $wgDBname === 'isvwiki' ) {
	$wgExtraLanguageNames['isv'] = 'Medžuslovjansky';
	$wgExtraInterlanguageLinkPrefixes = [ 'd' ];

	$wgSimpleFlaggedRevsUI = false;
}

if ( $wgDBname === 'metawiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'wfModifyMetaTags';

	function wfModifyMetaTags( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}

	// disable, needs validated bank account
	// $wgDonateBoxInSidebarContent = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick"> <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7----- "> <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Donate to Miraheze via Paypal!"> </form>';
	$wgDonateBoxInSidebarContent = '<ul><li><a href="/wiki/Donate">Donate to Miraheze</a></li></ul>';
}

if ( $wgDBname === 'nbdbwiki' ) {
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared-nenawikiwiki',
		'directory' => '/mnt/mediawiki-static/nonbinarywiki',
		'url' => 'https://static.miraheze.org/nonbinarywiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => 'nonbinarywiki',
		'descBaseUrl' => 'https://nonbinary.wiki/wiki/File:',
		'scriptDirUrl' => 'https://nonbinary.wiki/w',
	];
}

if ( $wgDBname === 'ndgwiki' ) {
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared-nenawikiwiki',
		'directory' => '/mnt/mediawiki-static/nenawikiwiki',
		'url' => 'https://static.miraheze.org/nenawikiwiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => 'nenawikiwiki',
		'descBaseUrl' => 'https://nenawiki.org/wiki/File:',
		'scriptDirUrl' => 'https://nenawiki.org/w',
	];
}

if ( $wgDBname === 'newusopediawiki' ) {
	$wgFilterLogTypes['comments'] = false;
}

if ( $wgDBname === 'thelonsdalebattalionwiki' ) {
	$egMapsDefaultService = 'googlemaps3';
}

if ( $wgDBname === 'swiki' ) {
	 $wgWhitelistRead[] = [
		"メインページ/ja"
	];
}

if ( $wgDBname === 'swisscomraidwiki' ) {
	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;
}

if ( $wgDBname === 'simcitywiki' ) {
	unset( $wgGroupPermissions['oversight'] );
	unset( $wgGroupPermissions['interwiki-admin'] );
	unset( $wgGroupPermissions['checkuser'] );
}

if ( $wgDBname === 'wikiageingwiki' ) {
	$wgForeignFileRepos[] = [
		'class'                   => 'ForeignAPIRepo',
		'name'                    => 'arwiki',
		'apibase'                 => 'https://ar.wikipedia.org/w/api.php',
		'hashLevels'              => 2,
		'fetchDescription'        => true,
		'descriptionCacheExpiry'  => 43200,
		'apiThumbCacheExpiry'     => 86400,
	];

	$wgForeignFileRepos[] = [
		'class'                   => 'ForeignAPIRepo',
		'name'                    => 'enwiki',
		'apibase'                 => 'https://en.wikipedia.org/w/api.php',
		'hashLevels'              => 2,
		'fetchDescription'        => true,
		'descriptionCacheExpiry'  => 43200,
		'apiThumbCacheExpiry'     => 86400,
	];
}

// Depends on $wgContentNamespaces
if ( $wgDBname === 'abitaregeawiki' ) {
	$wi->config->settings['wgExemptFromUserRobotsControl']['default'] = [];
}

// Additional wgReadWhitelist changes
if ( $wgDBname === 'cvtwiki' ) {
	$wgWhitelistRead[] = 'CVT action log';
}

// Licensing variables
switch ( $wmgWikiLicense ) {
	case 'arr':
		$wi->config->settings['wgRightsIcon']['default'] = 'https://meta.miraheze.org/w/resources/assets/licenses/arr.png';
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

if ( $wgDBname === 'gyaanipediawiki' ||
	 $wgDBname === 'higyaanipediawiki' ||
	 $wgDBname === 'bngyaanipediawiki' ||
	 $wgDBname === 'tegyaanipediawiki' ||
	 $wgDBname === 'tagyaanipediawiki' ||
	 $wgDBname === 'mrgyaanipediawiki' ||
	 $wgDBname === 'gugyaanipediawiki' ||
	 $wgDBname === 'pagyaanipediawiki' ||
	 $wgDBname === 'kngyaanipediawiki' ||
	 $wgDBname === 'maigyaanipediawiki' ||
	 $wgDBname === 'bhgyaanipediawiki' ||
	 $wgDBname === 'asgyaanipediawiki' ||
	 $wgDBname === 'mlgyaanipediawiki'
) {
	// per Ucronistaw
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared',
		'directory' => '/mnt/mediawiki-static/commonsgyaanipediawiki',
		'url' => 'https://static.miraheze.org/commonsgyaanipediawiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => 'commonsgyaanipediawiki',
		'wiki' => 'commonsgyaanipediawiki',
		'descBaseUrl' => 'https://commonsgyaanipedia.miraheze.org/wiki/File:',
	];
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

if ( $wgDBname === 'tuscriaturaswiki' || $wgDBname === 'yourcreatureswiki') {
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared',
		'directory' => '/mnt/mediawiki-static/intercriaturaswiki',
		'url' => 'https://static.miraheze.org/intercriaturaswiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => 'intercriaturaswiki',
		'wiki' => 'intercriaturaswiki',
		'descBaseUrl' => 'https://intercriaturas.miraheze.org/wiki/File:',
	];
}

require_once( '/srv/mediawiki/config/TempDBList.php' );

foreach ( $dbTempList2 as $db ) {
	$wi->config->settings['wgReadOnly'][$db] = 'Database maintenance in progess';
}

foreach ( $dbTempList3 as $db ) {
	$wi->config->settings['wgReadOnly'][$db] = 'Database maintenance in progess';
}
