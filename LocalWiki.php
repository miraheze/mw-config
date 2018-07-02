<?php

// All group of wikis/tag specific things should go at the top. Below the file, custom wiki config starts.

// Closed Wikis
if ( isset( $wgConf->settings['wmgClosedWiki'][$wgDBname] ) ) {
	$wgGroupPermissions['*']['autocreateaccount'] = true;
	$wgRevokePermissions = array(
		'*' => array(
			'block' => true,
			'createaccount' => true,
			'delete' => true,
			'edit' => true,
			'protect' => true,
			'import' => true,
			'upload' => true,
			'undelete' => true,
		),
	);

	$wgNoticeProject = 'closed';

	$wgHooks['SiteNoticeAfter'][] = 'onClosedSiteNoticeAfter';
	function onClosedSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<div class=\"wikitable\" style=\"text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;\"> <span class=\"plainlinks\">This wiki has been closed because there have been <b>no edits</b> or <b>or logs</b> made within the last 60 days. This wiki is now eligible for being adopted. To adopt this wiki please go to <a href="https://meta.miraheze.org/wiki/Requests_for_adoption">Requests for adoption</a> and make a request. If this wiki is not adopted within 6 months it may be deleted. Note: If you are a bureaucrat on this wiki you can go to Special:ManageWiki and uncheck the "closed" box to reopen it. </span></div>
EOF;
		return true;
	}

}

// Inactive Wikis
if ( isset( $wgConf->settings['wmgInactiveWiki'][$wgDBname] ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'onInactiveSiteNoticeAfter';
	function onInactiveSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<div class=\"wikitable\" style=\"text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;\"> <span class=\"plainlinks\"><b><a href="https://meta.miraheze.org/wiki/Stewards%27_noticeboard">Miraheze Staff</a></b> has noticed that this wiki has <b>no edits</b> or <b>logs</b> made within the last 45 days. If you would like to prevent this wiki from being <b>closed</b>, please start showing signs of activity here. If there are no signs of this wiki being used within the next 15 days, this wiki may be closed per the <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. This wiki will then be eligible for adoption by another user. If not adopted and still inactive 135 days from now, this wiki will become eligible for <b>deletion</b>. Please be sure to familiarize yourself with Miraheze's <a href="https://meta.miraheze.org/wiki/Dormancy_Policy">Dormancy Policy</a>. If there is activity on this wiki you can go to <u>Special:ManageWiki</u> and uncheck "inactive" yourself. If you have any other questions or concerns, please don't hesitate to <a href="https://meta.miraheze.org/wiki/Stewards%27_noticeboard">Stewards' noticeboard</a></span></div>
EOF;
		return true;
	}

}

// Private Wikis
if ( isset( $wgConf->settings['wmgPrivateWiki'][$wgDBname] ) ) {
	$wgGroupPermissions['*']['read'] = false;
	$wgGroupPermissions['user']['read'] = false;
	$wgGroupPermissions['member']['read'] = true;
	$wgGroupPermissions['sysop']['read'] = true;
	$wgAddGroups['bureaucrat'][] = 'member';
	$wgAddGroups['sysop'][] = 'member';
	$wgRemoveGroups['bureaucrat'][] = 'member';
	$wgRemoveGroups['sysop'][] = 'member';

	$wgNoticeProject = 'private';

	// To be removed once restbase supports private wiki's
	$wgDefaultUserOptions['math'] = 'png';
} else {
	// Requires the wiki's to be added to the services repo too
	$wgMathValidModes[] = 'mathml';
	$wgDefaultUserOptions['math'] = 'mathml';
	$wgMathMathMLUrl = 'https://mathoid-lb.miraheze.org/';
}

$wgMathFullRestbaseURL = 'https://' . $wmgHostname . '/api/rest_';

// ircrcbot (!=private)
if ( !isset( $wgConf->settings['wmgPrivateWiki'][$wgDBname] ) ) {
	$wgRCFeeds['irc'] = array(
		'formatter' => 'MirahezeIRCRCFeedFormatter',
		'uri' => 'udp://185.52.1.76:5070',
		'add_interwiki_prefix' => false,
		'omit_bots' => true,
	);
}

// Per-wiki overrides
if ( $wgDBname === 'allthetropeswiki' ) {
	$wgNamespaceContentModels[NS_TROPEWORKSHOP_TALK] = 'flow-board';
	$wgNamespaceContentModels[NS_REVIEWS] = 'flow-board';
	$wgRelatedArticlesFooterBlacklistedSkins = [ "minerva" ];
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['user']['createpage'] = true;
}

if ( $wgDBname === 'autocountwiki' ) {
	unset( $wgGroupPermissions['autoconfirmed'] );
	unset( $wgGroupPermissions['autopatrolled'] );

}

if ( $wgDBname === 'ayrshirewiki' ) {
	$GLOBALS['wgSpecialPages']['MapEditor'] = 'SpecialMapEditor';
	$GLOBALS['wgSpecialPageGroups']['MapEditor'] = 'maps';
}

if ( $wgDBname === 'ciptamediawiki' ) {
	$wgUploadDirectory = "/mnt/mediawiki-static/private/ciptamediawiki";
	$wgUploadPath = "https://ciptamedia.miraheze.org/w/img_auth.php";
}

if ( $wgDBname === 'brynda1231wiki' ) {
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
	$wgGroupPermissions['user']['move'] = false;
}

if ( $wgDBname === 'bigforestwiki' ) {
	unset( $wgGroupPermissions['rollbacker'] );
	$wgGroupPermissions['*']['editmycss'] = false;
	$wgGroupPermissions['*']['editmyjs'] = false;
	$wgGroupPermissions['*']['writeapi'] = false;
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['movefile'] = false;
	$wgGroupPermissions['user']['upload'] = false;
}

if ( $wgDBname === 'harrypotterwiki' ) {
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = false;
	$wgHiddenPrefs[] = 'collapsiblenav';
	$wgDefaultUserOptions['collapsiblenav'] = 1;
}

if ( $wgDBname === 'houseofettlingarfreyuwiki' ) {
	$wgGroupPermissions['*']['createtalk'] = false;
	$wgGroupPermissions['*']['createpage'] = true;
}

if ( $wgDBname === 'intpwiki' ) {
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
}

if ( $wgDBname === 'ipolywiki' ) {
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['move-subpages'] = false;
	$wgGroupPermissions['user']['move-categorypages'] = false;
	$wgGroupPermissions['user']['movefile'] = false;
	$wgGroupPermissions['user']['move-rootuserpagse'] = false;
}

if ( $wgDBname === 'isvwiki' ) {
	$wgExtraLanguageNames['isv'] = 'Medžuslovjansky';
	$wgExtraInterlanguageLinkPrefixes = [ 'd' ];

	$wgSimpleFlaggedRevsUI = false;
	
	$wgDefaultUserOptions['flow-topiclist-sortby'] = 'newest';

	$wgGroupPermissions['*']['editmyusercss'] = false;
	$wgGroupPermissions['*']['editmyuserjs'] = false;
	$wgGroupPermissions['*']['flow-hide'] = false;

	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['move-subpages'] = false;
	$wgGroupPermissions['user']['move-categorypages'] = false;
	$wgGroupPermissions['user']['movefile'] = false;

	$wgGroupPermissions['autopatrolled']['autopatrol'] = false;
	$wgGroupPermissions['bot']['autopatrol'] = false;
	$wgGroupPermissions['sysop']['autopatrol'] = false;
	$wgGroupPermissions['autopatrolled']['patrol'] = false;
	$wgGroupPermissions['confirmed']['patrol'] = false;
	$wgGroupPermissions['sysop']['patrol'] = false;

	unset ( $wgGroupPermissions['autoreview'] );
	unset ( $wgGroupPermissions['editor'] );
	unset ( $wgGroupPermissions['reviewer'] );
}

if ( $wgDBname === 'jayuwikiwiki' ) {
	$wgGroupPermissions['*']['writeapi'] = false;
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['move-subpages'] = false;
	$wgGroupPermissions['user']['move-categorypages'] = false;
	$wgGroupPermissions['user']['movefile'] = false;
	$wgGroupPermissions['user']['move-rootuserpages'] = false;
	$wgGroupPermissions['user']['upload'] = false;
	$wgGroupPermissions['user']['reupload-shared'] = false;
}

if ( $wgDBname === 'kstartupswiki' ) {
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['createtalk'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
}

if ( $wgDBname === 'lcars47wiki' ) {
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = false;
}

if ( $wgDBname === 'metawiki' ) {

	$wgGroupPermissions['user']['torunblocked'] = false;
	$wgGroupPermissions['*']['translate'] = false;
	$wgGroupPermissions['user']['translate'] = false;
	$wgHooks['BeforePageDisplay'][] = 'wfModifyMetaTags';

	function wfModifyMetaTags( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}

	$wgGroupPermissions['user']['createpage'] = false; //Recent vandalism. Users have no need to create pages on Meta --Reception123	
	// disable, needs validated bank account
	// $wgDonateBoxInSidebarContent = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"> <input type="hidden" name="cmd" value="_s-xclick"> <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7----- "> <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Donate to Miraheze via Paypal!"> </form>';
	$wgDonateBoxInSidebarContent = '<ul><li><a href="/wiki/Donate">Donate to Miraheze</a></li></ul>';
}

if ( $wgDBname === 'nenawikiwiki' ) {
	$wgGroupPermissions['*']['createtalk'] = false;
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['move-subpages'] = false;
	$wgGroupPermissions['user']['move-rootuserpages'] = false;
	$wgGroupPermissions['user']['movefile'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
	$wgGroupPermissions['user']['createtalk'] = false;
	$wgGroupPermissions['user']['writeapi'] = false;
	$wgGroupPermissions['user']['upload'] = false;
	$wgGroupPermissions['user']['reupload'] = false;
	$wgGroupPermissions['user']['reupload-shared'] = false;
	$wgGroupPermissions['user']['minoredit'] = false;
	$wgGroupPermissions['user']['purge'] = false;
	$wgGroupPermissions['sysop']['autopatrol'] = false;
	$wgGroupPermissions['user']['changetags'] = false;
	$wgGroupPermissions['user']['applychangetags'] = false;
	$wgGroupPermissions['user']['move-categorypages'] = false;
	$wgGroupPermissions['user']['editcontentmodel'] = false;
	$wgGroupPermissions['user']['torunblocked'] = false;

	$wgDefaultUserOptions['flow-editor'] = 'visualeditor';
}

if ( $wgDBname === 'pruebawiki' ) {
	$wgGroupPermissions['sysop']['nuke'] = false;
	$wgGroupPermissions['sysop']['ipblock-exempt'] = false;
	$wgGroupPermissions['sysop']['globalblock-whitelist'] = false;
	unset( $wgGroupPermissions['autoreview'] );
}

if ( $wgDBname === 'radviserwiki' ) {
	$wgGroupPermissions['user']['createpage'] = false;
}

if ( $wgDBname === 'reviwikiwiki' ) {
	$wgGroupPermissions['*']['createtalk'] = false;
}

if ( $wgDBname === 'sau226wiki' ) {
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
	$wgGroupPermissions['sysop']['globalblock-whitelist'] = false;
	$wgGroupPermissions['sysop']['ipblock-exempt'] = false;
	$wgGroupPermissions['sysop']['nuke'] = false;
}

if ( $wgDBname === 'soundboxiki' ) {
	$wgGroupPermissions['*']['createtalk'] = false;
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['editmywatchlist'] = false;
}

if ( $wgDBname === 'sthomaspriwiki' ) {
	$wgGroupPermissions['sysop']['block'] = false;
	$wgGroupPermissions['sysop']['blockemail'] = false;
}

if ( $wgDBname === 'testwiki' ) {
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
	$wgGroupPermissions['sysop']['globalblock-whitelist'] = false;
	$wgGroupPermissions['sysop']['ipblock-exempt'] = false;
	$wgGroupPermissions['sysop']['nuke'] = false;
}

if ( $wgDBname === 'thelonsdalebattalionwiki' ) {
	$egMapsDefaultService = 'googlemaps3';
}

if ( $wgDBname === 'trexwiki' ) {
	$wgGroupPermissions['sysop']['nuke'] = false;
	$wgGroupPermissions['sysop']['blockemail'] = false;
	$wgGroupPermissions['sysop']['deletelogentry'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
	$wgGroupPermissions['sysop']['deletedtext'] = false;
	$wgGroupPermissions['sysop']['deletedhistory'] = false;
	$wgGroupPermissions['sysop']['abusefilter-modify'] = false;
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = false;
}

if ( $wgDBname === 'swisscomraidwiki' ) {
	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;
}

if ( $wgDBname === 'zhdelwiki' ) {
	unset($wgGroupPermissions['autoconfirmed']);
}

// Depends on $wgContentNamespaces
if ( $wgDBname === 'abitaregeawiki' ) {
	$wgExemptFromUserRobotsControl = array();
}

$wgWhitelistRead = array(
	"MediaWiki:Common.css",
	"Special:CentralAutoLogin",
	"Special:CentralLogin",
	"Special:ConfirmEmail",	
	"Special:Notifications",
	"Special:ResetPassword",
	"Special:UserLogin",
	"Special:UserLogout",
	"Special:CreateAccount",
	"Spezial:Benutzerkonto anlegen",
);

if ( $wmgUseMainPageWhitelist ) {
	$wgWhitelistRead = array_merge( $wgWhitelistRead,
		array(
			"Main Page",
			"Página principal",
			"대문",
			"Заглавная страница",
			"Αρχική σελίδα",
			"Pagina principale",
			"Hoofdpagina",
			"Strona główna",
			"עמוד ראשי",
			"Glavna stranica",
    			"lipu lawa",
    			"Pagrindinis puslapis",
    			"Ape",
     			"باستى بەت",
     			"ዋናው ገጽ",
      			"بألگە أصلی",
     			"বেটুপাত",
     			"Галоўная старонка",
			"Gä nzönî",
   			"Glavna strana",
    			"Ñidol Wülngiñ",
			"Page Principale",
    			"मुख्य पानो",
   			"Башбарак",
    			"Тĕп страницă",
    			"Баш бит",
    			"Ihü Mbu",
   			"Bwiema peij",
	    		"Thâu-ia̍h",
			"मुख्यपृष्ठम्",
			"Nayriri Uñstawi",
			"Нүр халх",
			"ಮುಖ್ಯ ಪುಟ",
			"الپاجة الاولانيّة",
			"Pàgina prinçipâ",
			"Phekpui",
			"Haaptblatt",
			"Emudexo",
			"Pàgina Base",
			"Пря лопа",
			"მთავარი გვერდი",
			"Pàgene Prengepàle",
			"Veurblad",
			"Pogu ni Alaman",
			"صفحۂ اول",
			"Huvudsida",
			"मुखपृष्ठ",
			"آویلو صفحہ",
			"Главна страница",
			"Voorblad",
			"Hlavná stránka",
			"Moaite Pache",
			"الصفحه الرئيسيه",
			"Tlukankulu",
			"سأرآسوٙنە",
			"ᓃᔥᑕᒻᐹᔅᑌᒋᓂᑲᓐ",
			"Kaca Pokok",
			"Forside",
			"Peesi tali fiefia",
			"ໜ້າຫຼັກ",
			"مُک صفحو",
			"Баш Саифе",
			"Glavna stranica",
			"Početna strana",
			"Petulo yem efro",
			"Hłowna strona",
			"دەستپێک",
			"Itulau Muamua",
			"Dynnargh",
			"Pagina principală",
			"Головна сторінка",
			"መበገሲ ገጽ",
			"封面",
			"Baş Sahypa",
			"सम्मुख पन्ना",
			"Fandraisana",
			"La Primera Hoja",
			"گَرٕ",
			"Leqephe la pele",
			"メインページ",
			"Αρχικόν σελίδα",
			"Haaptsäit",
			"Hauptseite",
			"Il-Paġna prinċipali",
			"Tepas",
			"بُنیادی تاکدیم",
			"Natad tagayo",
			"गृह पृष्ठ","Cifapad",
			"Lonkásá ya libosó",
			"Hauptseit",
			"Accueil",
			"Halaman Utama",
			"特別:アカウント作成",
			"Chyba povolení",
		)
	);
}

// Additional wgReadWhitelist changes
if ( $wgDBname === 'cvtwiki' ) {
	$wgWhitelistRead[] = 'CVT action log';
}

// Licensing variables
switch ( $wmgWikiLicense ) {
	case 'arr':
		$wgRightsIcon = "//$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png";
		$wgRightsText = 'All Rights Reserved';
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
	case 'empty':
		break;
}

// Permission variables
if ( $wmgEditingMatrix ) {
	$mhEM = $wmgEditingMatrix;
	if ( $mhEM['anon'] ) { // Disables anonymous editing if set to true
		$wgGroupPermissions['*']['edit'] = false;
		$wgGroupPermissions['*']['createpage'] = false;
	}

	if ( $mhEM['user'] ) { // Disables editing by logged in users if set to true
		$wgGroupPermissions['user']['edit'] = false;
		$wgGroupPermissions['user']['createpage'] = false;
	}

	if ( $mhEM['editor'] ) { // Creates an 'editor' group that is addable by bureaucrats/sysops if set to true
		$wgGroupPermissions['editor']['edit'] = true;
		$wgGroupPermissions['editor']['createpage'] = true;
		$wgAddGroups['bureaucrat'][] = 'editor';
		$wgAddGroups['sysop'][] = 'editor';
		$wgRemoveGroups['bureaucrat'][] = 'editor';
		$wgRemoveGroups['sysop'][] = 'editor';
	}

	if ( $mhEM['sysop'] ) { // Allows sysops to edit if $mhEM['anon'] and $mhEM['user'] are both set to true
		$wgGroupPermissions['sysop']['edit'] = true;
		$wgGroupPermissions['sysop']['createpage'] = true;
	}
	
	if ( $mhEM['bureaucrat'] ) { // Allows bureaucrats to edit if $mhEM['anon'] and $mhEM['user'] are both set to true
		$wgGroupPermissions['bureaucrat']['edit'] = true;
		$wgGroupPermissions['bureaucrat']['createpage'] = true;
	}
}

if ( $wmgManageWikiGroup && $wgEnableManageWiki ) { // if set and if enabled
	$wgGroupPermissions[$wmgManageWikiGroup]['managewiki'] = true;
}
