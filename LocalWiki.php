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

	$wgHooks['SiteNoticeAfter'][] = 'onClosedSiteNoticeAfter';
	function onClosedSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<div class=\"wikitable\" style=\"text-align: center; width: 90%; margin-left: auto; margin-right:auto; padding: 15px; border: 4px solid black; background-color: #EEE;\"> <span class=\"plainlinks\">This wiki has been closed because there have been <b>no edits</b> or <b>or logs</b> made within the last 60 days. This wiki is now eligible for being adopted. To adopt this wiki please go to <a href="https://meta.miraheze.org/wiki/Requests_for_adoption">Requests for adoption</a> and make a request. If this wiki is not adopted within 6 months it may be deleted. </span></div>
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
	$wgNamespaceContentModels[NS_TROPEWORKSHOP_TALK] = CONTENT_MODEL_FLOW_BOARD;
	$wgNamespaceContentModels[NS_REVIEWS] = CONTENT_MODEL_FLOW_BOARD;
}

if ( $wgDBname === 'brynda1231wiki' ) {
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['sysop']['createpage'] = true;
}

if ( $wgDBname === 'bigforestwiki' ) {
	unset( $wgGroupPermissions['rollbacker'] );
	$wgGroupPermissions['autoconfirmed']['rollback'] = true;
	$wgGroupPermissions['confirmed']['rollback'] = true;
	$wgGroupPermissions['voter']['editvoter'] = true;
	$wgGroupPermissions['sysop']['editvoter'] = true;
	$wgGroupPermissions['bureaucrat']['block'] = true;
	$wgGroupPermissions['bureaucrat']['unblockself'] = true;
	$wgGroupPermissions['judge']['editvoter'] = true;
	$wgGroupPermissions['judge']['ipblock-exempt'] = true;
	$wgGroupPermissions['judge']['blockemail'] = true;
	$wgGroupPermissions['judge']['block'] = true;
	$wgGroupPermissions['judge']['unblockself'] = true;
	$wgGroupPermissions['judge']['editusercss'] = true;
	$wgGroupPermissions['judge']['edituserjs'] = true;
	$wgGroupPermissions['judge']['patrol'] = true;
	$wgGroupPermissions['judge']['autopatrolled'] = true;
	$wgGroupPermissions['judge']['delete'] = true;
	$wgGroupPermissions['judge']['deleterevision'] = true;
	$wgGroupPermissions['judge']['undelete'] = true;
	$wgGroupPermissions['judge']['browsearchive'] = true;
	$wgGroupPermissions['judge']['deletedtext'] = true;
	$wgGroupPermissions['judge']['securepoll-create-poll'] = true;
	$wgGroupPermissions['judge']['managechangetags'] = true;
	$wgGroupPermissions['judge']['tboverride'] = true;
	$wgGroupPermissions['judge']['abusefilter-view-private'] = true;
	$wgGroupPermissions['judge']['abusefilter-log-private'] = true;
	$wgGroupPermissions['judge']['protect'] = true;
	$wgGroupPermissions['judge']['spamblacklistlog'] = true;
	$wgGroupPermissions['judge']['titleblacklistlog'] = true;
	$wgGroupPermissions['judge']['unwatchedpages'] = true;
	$wgGroupPermissions['judge']['rollback'] = true;
	$wgGroupPermissions['judge']['proxyunbannable'] = true;
	$wgGroupPermissions['judge']['override-antispoof'] = true;
	$wgGroupPermissions['judge']['deletelogentry'] = true;
	$wgGroupPermissions['judge']['editprotected'] = true;
	$wgGroupPermissions['judge']['editsemiprotected'] = true;
	$wgAddGroups['judge'] = array( 'confirmed', 'autopatrolled', 'voter' );
	$wgRemoveGroups['judge'] = array( 'confirmed', 'autopatrolled', 'sysop', 'judge', 'voter', 'bureaucrat' );
	$wgAddGroups['sysop'][] = 'voter';
	$wgRemoveGroups['sysop'][] = 'voter';
	$wgAddGroups['bureaucrat'][] = 'confirmed';
	$wgAddGroups['bureaucrat'][] = 'voter';
	$wgAddGroups['bureaucrat'][] = 'judge';
	$wgAddGroups['bureaucrat'][] = 'developing-manager';
	$wgRemoveGroups['bureaucrat'][] = 'confirmed';
	$wgRemoveGroups['bureaucrat'][] = 'voter';
	$wgRemoveGroups['bureaucrat'][] = 'judge';
	$wgRemoveGroups['bureaucrat'][] = 'bureaucrat';
	$wgRemoveGroups['bureaucrat'][] = 'developing-manager';
	$wgRestrictionLevels[] = 'editvoter';
	$wgGroupPermissions['*']['editmycss'] = false;
	$wgGroupPermissions['*']['editmyjs'] = false;
	$wgGroupPermissions['*']['writeapi'] = false;
	$wgGroupPermissions['user']['editmycss'] = true;
	$wgGroupPermissions['user']['editmyjs'] = true;
	$wgGroupPermissions['user']['writeapi'] = true;
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['movefile'] = false;
	$wgGroupPermissions['user']['upload'] = false;
	$wgGroupPermissions['autoconfirmed']['move'] = true;
	$wgGroupPermissions['autoconfirmed']['movefile'] = true;
	$wgGroupPermissions['autoconfirmed']['upload'] = true;
	$wgGroupPermissions['confirmed']['move'] = true;
	$wgGroupPermissions['confirmed']['movefile'] = true;
	$wgGroupPermissions['confirmed']['upload'] = true;
	$wgGroupPermissions['developing-manager']['unblockself'] = true;
	$wgGroupPermissions['developing-manager']['block'] = true;
	$wgGroupPermissions['developing-manager']['noratelimit'] = true;
	$wgGroupPermissions['developing-manager']['override-antispoof'] = true;
	$wgAddGroups['developing-manager'] = array( 'confirmed', 'autopatrolled', 'voter', 'sysop', 'judge' );
	$wgGroupsAddToSelf['developing-manager'][] = 'bureaucrat';
	$wgRemoveGroups['developing-manager'] = array( 'confirmed', 'autopatrolled', 'sysop', 'judge', 'voter' );
	$wgGroupsRemoveFromSelf['developing-manager'][] = 'bureaucrat';
	$wgGroupsRemoveFromSelf['developing-manager'][] = 'developing-manager';
}

if ( $wgDBname == 'elementswiki' ) {
	$wgGroupPermissions['*']['read'] = false;
	$wgGroupPermissions['user']['changetags'] = false;
	$wgGroupPermissions['user']['applychangetags'] = false;
	$wgAddGroups['sysop'] = array();
	$wgRemoveGroups['sysop'] = array();
	$wgAddGroups['bureaucrat'] = array();
	$wgRemoveGroups['bureaucrat'] = array();
	$wgGroupPermissions['sysop']['globalblock-whitelist'] = false;
	$wgGroupPermissions['sysop']['editusercss'] = false;
	$wgGroupPermissions['sysop']['edituserjs'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
	$wgProtectSiteLimit = '2 months';
	$wgGroupPermissions['user']['move'] = false;
	$wgGroupPermissions['user']['movefile'] = false;
	$wgGroupPermissions['user']['move-categorypages'] = false;
	$wgGroupPermissions['user']['move-subpages'] = false;
	$wgGroupPermissions['user']['move-rootuserpages'] = false;
	$wgGroupPermissions['sysop']['move'] = false;
	$wgGroupPermissions['sysop']['movefile'] = false;
	$wgGroupPermissions['sysop']['move-categorypages'] = false;
	$wgGroupPermissions['sysop']['move-rootuserpages'] = false;
	$wgGroupPermissions['sysop']['importupload'] = false;
	$wgGroupPermissions['sysop']['import'] = false;
	$wgGroupPermissions['sysop']['unblockself'] = false;
	$wgGroupPermissions['sysop']['markbotedits'] = false;
	$wgGroupPermissions['sysop']['mergehistory'] = false;
	$wgGroupPermissions['sysop']['massmessage'] = false;
	$wgGroupPermissions['sysop']['unwatchedpages'] = false;
	$wgGroupPermissions['sysop']['reupload'] = false;
	$wgGroupPermissions['sysop']['reupload-shared'] = false;
	$wgGroupPermissions['sysop']['override-antispoof'] = false;
	$wgGroupPermissions['*']['flow-hide'] = false;
	unset( $wgGroupPermissions['suppress'] );
	unset( $wgGroupPermissions['rollbacker'] );
	unset ($wgGroupPermissions['commentadmin'] );
	$wgGroupPermissions['sysop']['flow-delete'] = false;
	$wgGroupPermissions['sysop']['flow-edit-post'] = false;
	$wgGroupPermissions['sysop']['flow-lock'] = false;
	$wgGroupPermissions['sysop']['move-subpages'] = false;
	$wgGroupPermissions['sysop']['tboverride'] = false;
	$wgGroupPermissions['sysop']['noratelimit'] = false;
	$wgGroupPermissions['steward']['userrights'] = false;
}

if ( $wgDBname === 'intpwiki' ) {
	$wgGroupPermissions['*']['createpage'] = false;
	$wgGroupPermissions['user']['createpage'] = false;
	$wgGroupPermissions['sysop']['createpage'] = true;
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
	$wgGroupPermissions['sysop']['nuke'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
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
	$wgGroupPermissions['*']['read'] = false;
	$wgAutopromote['emailconfirmed'] = APCOND_EMAILCONFIRMED;
}
if ( $wgDBname == 'metawiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'wfModifyMetaTags';

	function wfModifyMetaTags( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}

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

// Permission variables
if ( $wmgEditingMatrix ) {
	$mhEM = $wmgEditingMatrix;
	if ( $mhEM['anon'] ) {
		$wgGroupPermissions['*']['edit'] = false;
		$wgGroupPermissions['*']['createpage'] = false;
	}

	if ( $mhEM['user'] ) {
		$wgGroupPermissions['user']['edit'] = false;
		$wgGroupPermissions['user']['createpage'] = false;
	}

	if ( $mhEM['editor'] ) {
		$wgGroupPermissions['editor']['edit'] = true;
		$wgGroupPermissions['editor']['createpage'] = true;
		$wgAddGroups['sysop'][] = 'editor';
		$wgRemoveGroups['sysop'][] = 'editor';
	}

	if ( $mhEM['sysop'] ) {
		$wgGroupPermissions['sysop']['edit'] = true;
		$wgGroupPermissions['sysop']['createpage'] = true;
	}
}
