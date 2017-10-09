<?php

// All group of wikis/tag specific things should go at the top. Below the file, custom wiki config starts.

// Closed Wikis
if ( isset( $wgConf->settings['wmgClosedWiki'][$wgDBname] ) ) {
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['createaccount'] = false;
	$wgGroupPermissions['*']['autocreateaccount'] = true;
	$wgGroupPermissions['user']['edit'] = false;
	$wgGroupPermissions['user']['createaccount'] = false;
	$wgGroupPermissions['sysop']['createaccount'] = false;
	$wgGroupPermissions['sysop']['upload'] = false;
	$wgGroupPermissions['sysop']['delete'] = false;
	$wgGroupPermissions['sysop']['deletedtext'] = false;
	$wgGroupPermissions['sysop']['deletedhistory'] = false;
	$wgGroupPermissions['sysop']['deletelogentry'] = false;
	$wgGroupPermissions['sysop']['deleterevision'] = false;
	$wgGroupPermissions['sysop']['undelete'] = false;
	$wgGroupPermissions['sysop']['import'] = false;
	$wgGroupPermissions['sysop']['importupload'] = false;
	$wgGroupPermissions['sysop']['edit'] = false;
	$wgGroupPermissions['sysop']['block'] = false;
	$wgGroupPermissions['sysop']['protect'] = false;

	$wgNoticeProject[] = 'closed';

	$wgHooks['SiteNoticeAfter'][] = 'onClosedSiteNoticeAfter';
	function onClosedSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<div class=\"wikitable\" style=\"text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;\"> <span class=\"plainlinks\">This wiki has been closed because there have been <b>no edits</b> or <b>or logs</b> made within the last 60 days. This wiki is now eligible for being adopted. To adopt this wiki please go to <a href="https://meta.miraheze.org/wiki/Requests_for_adoption">Requests for adoption</a> and make a request. If this wiki is not adopted within 6 months it may be deleted. Note: If you are a bureaucrat on this wiki you can go to Special:ManageWiki and uncheck the "closed" box to reopen it. </span></div>
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

	$wgNoticeProject[] = 'private';
}

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

if ( $wgDBname === 'ayrshirewiki' ) {
	$GLOBALS['wgSpecialPages']['MapEditor'] = 'SpecialMapEditor';
	$GLOBALS['wgSpecialPageGroups']['MapEditor'] = 'maps';
	$egMapsGMaps3ApiKey = $wmgMapsGMaps3ApiKey;
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
	$wgSimpleFlaggedRevsUI = false;
	
	$wgGroupPermissions['*']['editmyusercss'] = false;
	$wgGroupPermissions['*']['editmyuserjs'] = false;
	
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

if ( $wgDBname === 'metawiki' ) {
	$wgGroupPermissions['user']['torunblocked'] = false;
	$wgGroupPermissions['*']['translate'] = false;
	$wgGroupPermissions['user']['translate'] = false;	
}

if ( $wgDBname === 'nenawikiwiki' ) {
	$wgGroupPermissions['*']['createtalk'] = false;
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['move-subpages'] = false;
	$wgGroupPermissions['user']['move-rootuserpages'] = false;
	$wgGroupPermissions['user']['movefile'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
	$wgGroupPermissions['user']['writeapi'] = false;
	$wgGroupPermissions['user']['upload'] = false;
	$wgGroupPermissions['user']['reupload'] = false;
	$wgGroupPermissions['user']['reupload-shared'] = false;
	$wgGroupPermissions['user']['minoredit'] = false;
	$wgGroupPermissions['user']['purge'] = false;
	$wgGroupPermissions['sysop']['autopatrol'] = false;
	$wgDefaultUserOptions['flow-editor'] = 'visualeditor';
}

if ( $wgDBname === 'pruebawiki' ) {
	$wgGroupPermissions['sysop']['nuke'] = false;
	$wgGroupPermissions['sysop']['ipblock-exempt'] = false;
	$wgGroupPermissions['sysop']['globalblock-whitelist'] = false;
	unset( $wgGroupPermissions['autoreview'] );
}

if ( $wgDBname == 'soundboxiki' ) {
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

if ( $wgDBname == 'trexwiki' ) {
	$wgGroupPermissions['sysop']['nuke'] = false;
	$wgGroupPermissions['sysop']['blockemail'] = false;
	$wgGroupPermissions['sysop']['deletelogentry'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
	$wgGroupPermissions['sysop']['deletedtext'] = false;
	$wgGroupPermissions['sysop']['deletedhistory'] = false;
	$wgGroupPermissions['sysop']['abusefilter-modify'] = false;
	$wgGroupPermissions['sysop']['abusefilter-modify-restricted'] = false;
}

if ( $wgDBname == 'swisscomraidwiki' ) {
	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;
}

if ( $wgDBname == 'metawiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'wfModifyMetaTags';

	function wfModifyMetaTags( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}

	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['createpage'] = false; //Recent vandalism. Users have no need to create pages on Meta --Reception123

}

// Depends on $wgContentNamespaces
if ( $wgDBname == 'abitaregeawiki' ) {
	$wgExemptFromUserRobotsControl = array();
}

$wgWhitelistRead =
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
		"MediaWiki:Common.css",
		"Special:CentralAutoLogin",
		"Special:CentralLogin",
		"Special:ConfirmEmail",
		"Special:Notifications",
		"Special:ResetPassword",
		"Special:UserLogin",
		"Special:UserLogout",
		"Special:CreateAccount",
		"Spezial:Benutzerkonto anlegen"
);

// Additional wgReadWhitelist changes
if ( $wgDBname === 'cvtwiki' ) {
	$wgWhitelistRead[] = 'CVT action log';
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
}

if ( $wmgManageWikiGroup && $wgEnableManageWiki ) { // if set and if enabled
	$wgGroupPermissions[$wmgManageWikiGroup]['managewiki'] = true;
}
