<?php
/*
LocalSettings.php for Miraheze.
Authors of initial version: Southparkfan, John Lewis, Orain contributors
*/

# Load PrivateSettings (e.g. wgDBpassword)
require_once( "/srv/mediawiki/config/PrivateSettings.php" );

# Load global skins and extensions
require_once( "/srv/mediawiki/config/GlobalSkins.php" );
require_once( "/srv/mediawiki/config/GlobalExtensions.php" );

# Don't allow web access.
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wmgUploadHostname = "static.miraheze.org";

# Initialize $wgConf
$wgConf = new SiteConfiguration;
$wgConf->suffixes = array( 'wiki' );
$wgLocalVirtualHosts = array( '81.4.125.112' );

$wmgHostname = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : 'undefined';

// Namespaces (please count upwards from 1600 to avoid any conflicts!)
define( 'NS_TECH', 1600 );
define( 'NS_TECH_TALK', 1601 );
define( 'NS_HL2RP', 1602 );
define( 'NS_HL2RP_TALK', 1603 );
define( 'NS_ARP', 1604 );
define( 'NS_ARP_TALK', 1605 );
define( 'NS_EVENT', 1606 );
define( 'NS_EVENT_TALK', 1607 );
define( 'NS_CLAN', 1608 );
define( 'NS_CLAN_TALK', 1609 );
define( 'NS_POE', 1610 );
define( 'NS_POE_TALK', 1611 );
define( 'NS_LEAGUE', 1612 );
define( 'NS_LEAGUE_TALK', 1613 );
define( 'NS_SMITE', 1614 );
define( 'NS_SMITE_TALK', 1615 );
define( 'NS_SERVER', 1616 );
define( 'NS_SERVER_TALK', 1617);
define( 'NS_COMIC', 1618 );
define( 'NS_COMIC_TALK', 1619 );
define( 'NS_TROPEWORKSHOP', 1620 );
define( 'NS_TROPEWORKSHOP_TALK', 1621 );
define( 'NS_HOENN', 1622 );
define( 'NS_HOENN_TALK', 1623 );
define( 'NS_OFFICIAL', 1624 );
define( 'NS_OFFICIAL_TALK', 1625 );
define( 'NS_PORTAL', 1626 );
define( 'NS_PORTAL_TALK', 1627 );
define( 'NS_CALL_OF_DUTY', 1628 );
define( 'NS_CALL_OF_DUTY_TALK', 1629 );
define( 'NS_REVIEWS', 1630 );
define( 'NS_REVIEWS_TALK', 1631 );
define( 'NS_TEST', 1632);
define( 'NS_TEST_TALK', 1633);
define( 'NS_MINECRAFT', 1636 );
define( 'NS_MINECRAFT_TALK', 1637 );
define( 'NS_SUPER_MARIO_LAND_2', 1638 );
define( 'NS_SUPER_MARIO_LAND_2_TALK', 1639 );
define( 'NS_SUPER_MARIO_WORLD_2', 1640 );
define( 'NS_SUPER_MARIO_WORLD_2_TALK', 1641 );
define( 'NS_SUPER_MARIO_BROS', 1642 );
define( 'NS_SUPER_MARIO_BROS_TALK', 1643 );
define( 'NS_SUPER_MARIO_ADVANCE', 1644 );
define( 'NS_SUPER_MARIO_ADVANCE_TALK', 1645 );
define( 'NS_SUPER_MARIO_ADVANCE_2', 1646 );
define( 'NS_SUPER_MARIO_ADVANCE_2_TALK', 1647 );
define( 'NS_SUPER_MARIO_ADVANCE_3', 1648 );
define( 'NS_SUPER_MARIO_ADVANCE_3_TALK', 1649 );
define( 'NS_SUPER_MARIO_ADVANCE_4', 1650 );
define( 'NS_SUPER_MARIO_ADVANCE_4_TALK', 1651 );
define( 'NS_THE_LEGEND_OF_ZELDA', 1652 );
define( 'NS_THE_LEGEND_OF_ZELDA_TALK', 1653 );
define( 'NS_LCS', 1654 );
define( 'NS_LCS_TALK', 1655 );
define( 'NS_MEDI', 1656 );
define( 'NS_MEDI_TALK', 1657 );
define( 'NS_LIBRARY', 1658);
define( 'NS_LIBRARY_TALK', 1659);
define( 'NS_TEACHING', 1660);
define( 'NS_TEACHING_TALK', 1661);
define( 'NS_BLANK', 1662);
define( 'NS_BLANK_TALK', 1663);
define( 'NS_RESEARCH', 1664);
define( 'NS_RESEARCH_TALK', 1665);
define( 'NS_ADMIN', 1666);
define( 'NS_ADMIN_TALK', 1667);
define( 'NS_WORKSHOP', 1668);
define( 'NS_WORKSHOP_TALK', 1669);
define( 'NS_SELP', 1670);
define( 'NS_SELP_TALK', 1671);
define( 'NS_STUDY_NOTE', 1672);
define( 'NS_STUDY_NOTE_TALK', 1673);
define( 'NS_EXPLANATION', 1674);
define( 'NS_EXPLANATION_TALK', 1675);
define( 'NS_KOREAN_STUDY_NOTE', 1676);
define( 'NS_KOREAN_STUDY_NOTE_TALK', 1677);
define( 'NS_GLOSSARY', 1678);
define( 'NS_GLOSSARY_TALK', 1679);
define( 'NS_SPRITES', 1680);
define( 'NS_SPRITES_TALK', 1681);
define( 'NS_GALLERY', 1682);
define( 'NS_GALLERY_TALK', 1683);
define( 'NS_HALAMAN', 1684);
define( 'NS_HALAMAN_TALK', 1685);
define( 'NS_DICT', 1686);
define( 'NS_DICT_TALK', 1687);
define( 'NS_FEATURED', 1688);
define( 'NS_FEATURED_TALK', 1689);
define( 'NS_ARTIKEL', 1690);
define( 'NS_ARTIKEL_TALK', 1691);
define( 'NS_VIDEO', 1692);
define( 'NS_VIDEO_TALK', 1693);
define( 'NS_OPINION', 1694);
define( 'NS_OPINION_TALK', 1695);
define( 'NS_TIMELINE', 1696);
define( 'NS_TIMELINE_TALK', 1697);
define( 'NS_DRAFT', 1700);
define( 'NS_DRAFT_TALK', 1701);
define( 'NS_HISTORICAL_TIMELINE', 1702);
define( 'NS_HISTORICAL_TIMELINE_TALK', 1703);
define( 'NS_QUIZSET', 1704);
define( 'NS_QUIZSET_TALK', 1705);
define( 'NS_NOTEBOOK', 1706);
define( 'NS_NOTEBOOK_TALK', 1707);
define( 'NS_SOURCE', 1708);
define( 'NS_SOURCE_TALK', 1709);
define( 'NS_GAME', 1710);
define( 'NS_GAME_TALK', 1711);
define( 'NS_PICTUREBOARD', 1712);
define( 'NS_PICTUREBOARD_TALK', 1713);
define( 'NS_TINYFOREST', 1714);
define( 'NS_TINYFOREST_TALK', 1715);
define( 'NS_WNS2', 1716);
define( 'NS_WNS2_TALK', 1717);
define( 'NS_HOWTO', 1718);
define( 'NS_HOWTO_TALK', 1719);
define( 'NS_NEWSLINK', 1720);
define( 'NS_NEWSLINK_TALK', 1721);
define( 'NS_CIVILIZATION_IV', 1722);
define( 'NS_CIVILIZATION_IV_TALK', 1723);

// Refer to NS_MODULE before importing Scribunto (tmewiki)
define( 'WMG_NS_MODULE', 828 );
define( 'WMG_NS_MODULE_TALK', 829 );

// Special namespace re-defined
define( 'NS_PROOFREAD_PAGE', 250);
define( 'NS_PROOFREAD_PAGE_TALK', 251);
define( 'NS_PROOFREAD_INDEX', 252);
define( 'NS_PROOFREAD_INDEX_TALK', 253);

$wgConf->settings = array(
	// AbuseFilter
	'wgAbuseFilterCentralDB' => array(
		'default' => 'metawiki',
	),
	'wgAbuseFilterIsCentral' => array(
		'default' => false,
		'metawiki' => true,
	),


	// Anti-spam
	'wgAccountCreationThrottle' => array(
		'default' => 5,
	),
	'wgAutoConfirmAge' => array(
		'default' => 345600, // 4 days * 24 hours * 60 minutes * 60 seconds
		'developmentwiki' => 259200, // 3 days * 24 hours * 60 minutes * 60 seconds
	),
	'wgAutoConfirmCount' => array(
		'default' => 10,
	),

	// BetaFeatures
	'wgMediaViewerIsInBeta' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'inazumaelevenwiki' => true,
		'justinbieberwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'pruebawiki' => true,
		'thehushhushsagawiki' => true,
		'tokyohoulwiki' => true,
		'youtubewiki' => true,
	),
	'wgPopupsBetaFeature' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'inazumaelevenwiki' => true,
		'justinbieberwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'thehushhushsagawiki' => true,
		'tokyoghoulwiki' => true,
		'youtubewiki' => true,
	),
	'wgVisualEditorEnableWikitext' => array(
		'default' => false,
		'extloadwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'raymanspeedrunwiki' => true,
		'thehushhushsagawiki' => true,
		'tokyoghoulwiki' => true,
	),
	// Block
	'wgAutoblockExpiry' => array(
		'default' => 86400, // 24 hours * 60 minutes * 60 seconds
		'brynda1231wiki' => 230400, // 64 hours * 60 minutes * 60 seconds
		'marioserieswiki' => 111600, //31 hours - T1709
	),
	'wgBlockAllowsUTEdit' => array(
		'default' => true,
	),

	// Bot passwords
	'wgBotPasswordsDatabase' => array(
		'default' => 'centralauth',
	),

	// Cache
	'wgCacheDirectory' => array(
		'default' => '/srv/mediawiki/w/cache',
	),
	'wgLocalisationCacheConf' => array(
		'default' => array(
			'class' => 'LocalisationCache',
			'store' => 'files',
			'storeDirectory' => "$IP/cache/l10n",
			'manualRecache' => true,
		),
	),
	// Do not enable this without Southparkfan's
	// permission, as it could let Redis crash.
	'wgPreprocessorCacheThreshold' => array(
		'default' => false,
	),
	'wgResourceLoaderMaxage' => array(
		'default' => array(
			'versioned' => array(
				'server' => 12 * 60 * 60, // 12 hours
				'client' => 1 * 24 * 60 * 60, // 1 day
			),
			'unversioned' => array(
				'server' => 5 * 60, // 5 minutes
				'client' => 30 * 60, // 30 minutes
			),
		),
	),

	// Captcha
	'wgCaptchaClass' => array(
		'default' => 'ReCaptchaNoCaptcha',
	),
	'wgReCaptchaSendRemoteIP' => array(
		'default' => false,
	),

	// CentralAuth
	'wgCentralAuthAutoCreateWikis' => array(
		'default' => array( 'loginwiki', 'metawiki' ),
	),
	'wgCentralAuthAutoNew' => array(
		'default' => true,
	),
	'wgCentralAuthAutoLoginWikis' => array(
		'default' => array(
			'allthetropes.org' => 'allthetropeswiki',
			'alwiki.net' => 'alwikiwiki',
			'antiguabarbudacalypso.com' => 'antiguabarbudacalypsowiki',
			'aman.info.tm' => 'amaninfowiki',
			'bettermedia.info' => 'bettermediawiki',
			'bootlegged.questionable.photography' => 'bootleggedwiki',
			'changemy.org' => 'changemyorgwiki',
			'disabled.life' => 'disabledlifewiki',
			'wiki.drones4nature.info' => 'drones4allwiki',
			'es.publictestwiki.com' => 'pruebawiki',
			'espiral.org' => 'espiralwiki',
			'evelopedia.tk' => 'evelopediawiki',
			'fibromyalgia-engineer.com' => 'fibromyalgiaengineerwiki',
			'gamdug.tk' => 'gamdugwiki',
			'ircwiki.cf' => 'ircwiki',
			'wiki.jacksonheights.nyc' => 'jacksonheightswiki',
			'meta.trek.tk' => 'metatrekwiki',
			'nenawiki.org' => 'nenawikiwiki',
			'www.openonderwijs.org' => 'openonderwijswiki',
			'oyeavdelingen.org' => 'oyeavdelingenwiki',
			'permanentfuturelab.wiki' => 'permanentfuturelabwiki',
			'private.revi.wiki' => 'reviwiki',
			'publictestwiki.com' => 'testwiki',
			'reviwiki.info' => 'reviwikiwiki',
			'sandbox.wisdomwiki.org' => 'wisdomsandboxwiki',
			'savage-wiki.com' => 'savagewikiwiki',
			'speleo.wiki' => 'speleowiki',
			'spiral.wiki' => 'spiralwiki',
			'takethatwiki.com' => 'takethatwikiwiki',
			'wiki.teessidehackspace.org.uk' => 'teessidehackspacewiki',
			'thelonsdalebattalion.co.uk' => 'thelonsdalebattalionwiki',
			'wiki.aenasan.com' => 'aenasanwiki',
			'wiki.besuccess.com' => 'kstartupswiki',
			'wiki.denverkr.cf' => 'denverkrwiki',
			'wiki.dottorconte.eu' => 'dottorcontewiki',
			'wiki.dwplive.com' => 'dwplivewiki',
			'wiki.garyjohnsonmeetups.com' => 'garyjohnsonmeetupswiki',
			'wiki.grottocenter.org' => 'grottocenterwiki',
			'wiki.kaisaga.com' => 'wikikaisagawiki',
			'wiki.labby.io' => 'labbywiki',
			'wiki.livesnowmap.com' => 'livesnowmapwiki',
			'wiki.lbcomms.co.za' => 'nextlevelwikiwiki',
			'wiki.make717.org' => 'make717wiki',
			'wiki.meeusen.net' => 'meeusenwiki',
			'wiki.rizalespe.com' => 'rizalespewiki',
			'wiki.valentinaproject.org' => 'valentinaprojectwiki',
			'wikiescola.com.br' => 'wikiescolawiki',
			'www.wikiletras.tk' => 'wikiletraswiki',
			'wikiparkinson.org' => 'wikiparkinsonwiki',
			'wikipuk.cl' => 'wikipucwiki',
			'wisdomwiki.org' => 'wisdomwikiwiki',
			'histories.wiki' => 'wishcertwiki',
			'www.zenbuddhism.info' => 'zenbuddhismwiki',
			'www.aksaraywiki.com' => 'aksaraywikiwiki',
		),
	),
	'wgCentralAuthAutoMigrate' => array(
		'default' => true,
	),
	'wgCentralAuthCookies' => array(
		'default' => true,
	),
	'wgCentralAuthCookieDomain' => array(
		'default' => '.miraheze.org',
	),
	'wgCentralAuthCreateOnView' => array(
		'default' => true,
	),
	'wgCentralAuthDatabase' => array(
		'default' => 'centralauth',
	),
	'wgCentralAuthEnableGlobalRenameRequest' => array(
		'default' => false,
		'metawiki' => true,
	),
	'wgCentralAuthLoginWiki' => array(
		'default' => 'loginwiki',
	),
	'wgCentralAuthSilentLogin' => array(
		'default' => true,
	),
	
	// CheckUser
	'wgCheckUserForceSummary' => array(
		'default' => true,
	),

	// Comments extension
	'wgCommentsDefaultAvatar' => array(
		'default' => '/w/extensions/SocialProfile/avatars/default_ml.gif',
	),
	
	 // Contribution Scores
	 'wgContribScoreDisableCache' => array(
 		 'default' => true,
 	 ),

	// CreateWiki
	'wmgCreateWikiSQLfiles' => array(
		'default' => array(
			"$IP/maintenance/tables.sql",
			"$IP/extensions/AbuseFilter/abusefilter.tables.sql",
			"$IP/extensions/AJAXPoll/patches/create-table--ajaxpoll_info.sql",
			"$IP/extensions/AJAXPoll/patches/create-table--ajaxpoll_vote.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/ArticleFeedbackv5/sql/ArticleFeedbackv5.sql",
			"$IP/extensions/ArticleRatings/ratings.sql",
			"$IP/extensions/BetaFeatures/sql/create_counts.sql",
			"$IP/extensions/CheckUser/cu_log.sql",
			"$IP/extensions/CheckUser/cu_changes.sql",
			"$IP/extensions/Comments/sql/comments.sql",
			"$IP/extensions/Echo/echo.sql",
			"$IP/extensions/EducationProgram/sql/EducationProgram.sql",
			"$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
			"$IP/extensions/Flow/flow.sql",
			"$IP/extensions/GlobalBlocking/localdb_patches/setup-global_block_whitelist.sql",
			"$IP/extensions/Math/db/math.mysql.sql",
			"$IP/extensions/Math/db/mathlatexml.mysql.sql",
			"$IP/extensions/Math/db/mathoid.mysql.sql",
			"$IP/extensions/MediaWikiChat/sql/chat.sql",
  			"$IP/extensions/MediaWikiChat/sql/chat_users.sql",
			"$IP/extensions/MsCalendar/MsCalendar.sql",
			"$IP/extensions/Newsletter/sql/nl_issues.sql",
			"$IP/extensions/Newsletter/sql/nl_newsletters.sql",
			"$IP/extensions/Newsletter/sql/nl_publishers.sql",
			"$IP/extensions/Newsletter/sql/nl_subscriptions.sql",
			"$IP/extensions/OAuth/backend/schema/mysql/OAuth.sql",
			"$IP/extensions/PageTriage/sql/PageTriageTags.sql",
			"$IP/extensions/PageTriage/sql/PageTriagePageTags.sql",
			"$IP/extensions/PageTriage/sql/PageTriagePage.sql",
			"$IP/extensions/PageTriage/sql/PageTriageLog.sql",
			"$IP/extensions/Poll/archives/Poll-install-manual.sql",
			"$IP/extensions/ProofreadPage/sql/ProofreadIndex.sql",
			"$IP/extensions/SocialProfile/UserProfile/user_profile.sql",
			"$IP/extensions/SocialProfile/UserProfile/user_fields_privacy.sql",
			"$IP/extensions/SocialProfile/UserSystemMessages/user_system_messages.sql",
			"$IP/extensions/SocialProfile/UserStats/user_points_monthly.sql",
			"$IP/extensions/SocialProfile/UserStats/user_points_archive.sql",
			"$IP/extensions/SocialProfile/UserStats/user_points_weekly.sql",
			"$IP/extensions/SocialProfile/UserStats/user_stats.sql",
			"$IP/extensions/SocialProfile/SystemGifts/systemgifts.sql",
			"$IP/extensions/SocialProfile/UserRelationship/user_relationship.sql",
			"$IP/extensions/SocialProfile/UserGifts/usergifts.sql",
			"$IP/extensions/SocialProfile/UserBoard/user_board.sql",
			"$IP/extensions/TimedMediaHandler/TimedMediaHandler.sql",
			"$IP/extensions/TitleKey/titlekey.sql",
			"$IP/extensions/Translate/sql/revtag.sql",
			"$IP/extensions/Translate/sql/translate_groupreviews.sql",
			"$IP/extensions/Translate/sql/translate_groupstats.sql",
			"$IP/extensions/Translate/sql/translate_messageindex.sql",
			"$IP/extensions/Translate/sql/translate_metadata.sql",
			"$IP/extensions/Translate/sql/translate_reviews.sql",
			"$IP/extensions/Translate/sql/translate_sections.sql",
			"$IP/extensions/Translate/sql/translate_stash.sql",
			"$IP/extensions/Translate/sql/translate_tm.sql",
			"$IP/extensions/VoteNY/vote.mysql",
			"$IP/extensions/Wikibase/repo/sql/Wikibase.sql",
			"$IP/extensions/Wikibase/repo/sql/changes.sql",
			"$IP/extensions/Wikibase/repo/sql/changes_dispatch.sql",
			"$IP/extensions/Wikibase/repo/sql/changes_subscription.sql",
			"$IP/extensions/Wikibase/repo/sql/wb_property_info.sql",
			"$IP/extensions/WikiForum/sql/wikiforum.sql",
			"$IP/extensions/WikiLove/patches/WikiLoveLog.sql",
			"$IP/extensions/UrlShortener/schemas/urlshortcodes.sql"
		),
	),
	// Cookies extension settings
	'wgCookieWarningMoreUrl' => array(
		'default' => false,
		'thelonsdalebattalionwiki' => 'https://thelonsdalebattalion.co.uk/wiki/The_Lonsdale_Battalion:Cookies'
	),
	// Database
	'wgCompressRevisions' => array(
		'default' => false,
		'allthetropeswiki' => true,
	),
	'wgDBadminuser' => array(
		'default' => 'wikiadmin',
	),
	'wgDBuser' => array(
		'default' => 'mediawiki',
	),
	'wgReadOnly' => array(
		'default' => false,
	),
	'wgSharedDB' => array(
		'default' => 'metawiki',
	),
	'wgSharedTables' => array(
		'default' => array(),
	),

	// Delete
	'wgDeleteRevisionsLimit' => array(
		'default' => '250', // databases don't have much memory - let's not overload them in future
	),

	// Editing Matrix
	'wmgEditingMatrix' => array(
		'default' => array(
			'anon' => false, // disable anonymous editing
			'user' => false, // disable user editing
			'editor' => false, // add an editor group for editing + sysop assign
			'sysop' => false, // allow sysop' to edit (not needed)
		),
		'+690squadronwiki' => array(
			'anon' => true,
		),
		'+8stationwiki' => array(
			'anon' => true,
		),
		'+adiaprojectwiki' => array(
			'anon' => true,
		),
		'+adnovumwiki' => array(
			'anon' => true,
		),
		'+aleenghawiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+allbanks2wiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+antiguabarbudacalypsowiki' => array(
			'anon' => true,
		),
		'+bitcoindebateswiki' => array(
      			'anon' => true,
			'user' => true,
    		),
		'+caeruleawiki' => array(
			'anon' => true,
		),
		'+calexitwiki' => array(
			'anon' => true,
		),
		'+carvingwiki' => array(
			'anon' => true,
		),
		'+christipediawiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+claneuphoriawiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+clementsworldbuildingwiki' => array(
			'anon' => true,
		),
		'+compilerdevwiki' => array(
			'anon' => true,
		),
		'+cosiadventurewiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+cpiwiki' => array(
			'anon' => true,
		),
		'+dalarwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+dditecwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+dottorcontewiki' => array(
			'anon' => true,
		),
		'+drones4allwiki' => array(
			'anon' => true,
		),
		'+evelopediawiki' => array(
			'anon' => true,
		),
		'+exercicesdefrancaisprodfrwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+forexwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+fieldresearchwiki' => array(
			'anon' => true,
		),
		'+freecollegeprojectwiki' => array(
			'anon' => true,
		),
		'+frontdeskswiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+geodatawiki' => array(
			'anon' => true,
		),
		'+godaigowiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+hlptestwiki' => array(
			'anon' => true,
		),
		'+houseofettlingarfreyuwiki' => array(
			'anon' => true,
		),
		'+howtoturtlewiki' => array(
			'anon' => true,
		),
		'+izanagiwiki' => array(
			'anon' => true,
		),
		'+jjmodwiki' => array(
			'anon' => true,
		),
		'+justwikiwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+jokowiki' => array(
			'anon' => true,
		),
		'+karniarutheniawiki' => array(
			'anon' => true,
		),
		'+kl6fwiki' => array(
			'anon' => true,
		),
		'+maiasongcontestwiki' => array(
			'anon' => true,
		),
		'+medergistswiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
			'editor' => true,
		),
		'+metatrekwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+ircwiki' => array(
			'anon' => true,
		),
		'+micropediawiki' => array(
			'anon' => true,
		),
		'+miraiwiki' => array(
			'anon' => true,
		),
		'+modularwiki' => array(
			'anon' => true,
		),
		'+nenawikiwiki' => array(
			'anon' => true,
			'sysop' => true,
		),
		'+noalatalawiki' => array(
			'anon' => true,
		),
		'+ntlawwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+nvuwiki' => array(
			'user' => true,
		),
		'+ofthevampirewiki' => array(
			'anon' => true,
		),
		'+oncprojectwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+philmont126wiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+poserdazfreebieswiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+plazmaburstwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
			'editor' => true,
		),
		'+prfmukwiki' => array(
			'anon' => true,
		),
		'+priyowiki' => array(
			'anon' => true,
		),
		'+revitwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
			'editor' => true,
		),
		'+reviwikiwiki' => array(
			'anon' => true,
		),
		'+rpgbrigadewiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+saliorpediawiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+safiriawiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+seldirwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+softwarecrisiswiki' => array(
			'anon' => true,
		),
		'+stemorgwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+sthomaspriwiki' => array(
			'user' => true,
			'sysop' => true,
		),
		'+swisscomraidwiki' => array(
			'user' => true,
			'anon' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+sylwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+szkwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+thoughtonomywikiwiki' => array(
			'anon' => true,
		),
		'+touhouenginewiki' => array(
			'anon' => true,
		),
		'+traunstoanerwiki' => array(
			'anon' => true,
		),
		'+turkcesozlukwiki' => array(
			'anon' => true,
		),
		'+welcomewiki' => array(
			'anon' => true,
		),
		'+wisdomwikiwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+wisdomsandboxwiki' => array(
			'anon' => true,
		),
	),

	'wgPFEnableStringFunctions' => array(
		'default' => false,
		'marcoschriekwiki' => true,
	),

	'wgAllowSlowParserFunctions' => array(
		'default' => false,
		'trexwiki' => true,
	),
	// Dormancy policy && RC stuff
	'wgRCMaxAge' => array(
		'default' => 180 * 24 * 3600,
		'allthetropeswiki' => 90 * 24 * 3600,
		'extloadwiki' => 90 * 24 * 3600,
		'loginwiki' => 90 * 24 * 3600,
		'metawiki' => 90 * 24 * 3600,
		'testwiki' => 90 * 24 * 3600,
	),
	// Echo
	'wgEchoCrossWikiNotifications' => array(
		'default' => true,
	),
	'wgEchoUseJobQueue' => array(
		'default' => true,
	),
	'wgEchoSharedTrackingCluster' => array(
		'default' => 'echo',
	),
	'wgEchoSharedTrackingDB' => array(
		'default' => 'metawiki',
	),
	'wgEchoUseCrossWikiBetaFeature' => array(
		'default' => true,
	),

	// Extensions and Skins
	// AccessControl: due to security risks, use of this extension is at a wikis' calculated risk.
	// Prior to enabling the extension a bureaucrat should agree (on their own wiki)
	// that Miraheze is NOT responsible for any data leaks caused by this extension,
	// and that the wiki and elevated users are fully responsible for the usage of AccessControl.
	'wmgUseAccessControl' => array(
		'default' => false,
		'bmedwiki' => true,
		'claneuphoriawiki' => true,
		'extloadwiki' => true,
		'metaautonomywiki' => true,
		'mindgearwiki' => true,
		'ndnwiki' => true,
		'westmarcheswiki' => true,
		'wimawiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseAddHTMLMetaAndTitle' => array(
		'default' => false,
		'alwikiwiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'partupwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseAdminLinks' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'cssandjsschoolboardwiki' => true,
		'developmentwiki' => true,
		'extloadwiki' => true,
		'heistwiki' => true,
		'ircwiki' => true,
		'jayuwikiwiki' => true,
		'ndnwiki' => true,
		'perpuswiki' => true,
		'pgnwikiwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'pruebawiki' => true,
		'starsetonlinewiki' => true,
		'szkwiki' => true,
		'takethatwikiwiki' => true,
		'testwiki' => true,
		'tochkiwiki' => true,
		'touhouenginewiki' => true,
		'worldbattlewiki' => true,
		'yugiohwiki' => true,
	),
	'wmgUseAJAXPoll' => array(
		'default' => false,
		'bigforestwiki' => true,
		'extloadwiki' => true,
		'inkubatorwiki' => true,
		'malaysiawiki' => true,
		'nationstateswiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseApex' => array(
		'default' => false,
		'dtswiki' => true,
		'extloadwiki' => true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseArticleFeedbackv5' => array(
		'default' => false,
		'applewikiwiki' => true,
		'applebranchwiki' => true,
		'fablabesdswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseArticleRatings' => array(
		'default' => false,
		'applewikiwiki' => true,
		'applebranchwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseAuthorProtect' => array(
		'default' => false,
		'ayrshirewiki' => true,
		'extloadwiki' => true,
		'grandtheftwikiwiki' => true,
		'jakeperswiki' => true,
		'sthomaspriwiki' => true,
		'testauthorprotectwiki' => true,
		'trexwiki' => true,
	),
	'wmgUseAutoCreateCategoryPages' => array(
		'default' => false, // DO NOT enable on wikis that have more than 500 categories. See T1230
		'ayrshirewiki' => true,
		'extloadwiki' => true,
		'knowledgewiki' => true,
		'nationstateswiki' => true,
	),
	'wmgUseAutomaticBoardWelcome' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'ircwiki' => true,
		'pgnwikiwiki' => true,
	),
	'wmgUseAutoSitemap' => array(
		'default' => false, // Please read T1558#32765 before enabling on any wiki! --Reception123
		'alwikiwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseBlogPage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'ircwiki' => true,
		'wikidolphinhansenwiki' => true,
	),
	'wmgUseBootstrapMediawiki' => array(
		'default' => false,
		'extloadwiki' => true,
		'kstartupswiki' => true,
		'raymanspeedrunwiki' => true,
	),
	'wmgUseMSCalendar' => array(
		'default' => false,
		'5awiki' => true,
		'aucelewiki' => true,
		'barbarasherwikiwiki' => true,
		'dtswiki' => true,
		'extloadwiki' => true,
		'financialfindswiki' => true,
		'hontsukuruwiki' => true,
		'kozawiki' => true,
		'philmont126wiki' => true,
		'robertsnoteswiki' => true,
		'sterbalfamilyrecipeswiki' => true,
		'sterbalssundrystudieswiki' => true,
		'umodwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseCategoryTree' => array(
		'default' => true,
		'whentheycrywiki' => false,
		'chocowiki' => true,
	),
	'wmgUseCharInsert' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'anothertimeline2120wiki' => true,
		'bigforestwiki' => true,
		'brynda1231wiki' => true,
		'cssandjsschoolboardwiki' => true,
		'doinwiki' => true,
		'dtswiki' => true,
		'extloadwiki' => true,
		'isvwiki' => true,
		'jawp2chwiki' => true,
		'jayuwikiwiki' => true,
		'modularwiki' => true,
		'particracywikiwiki' => true,
		'recentiawiki' => true,
		'studynotekrwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseCollapsibleVector' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'anuwiki' => true,
		'extloadwiki' => true,
		'modularwiki' => true,
		'scruffywiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseComments' => array(
		'default' => false, // Remember to assign 'commentadmin' rights!
		'allthetropeswiki' => true,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'animationmoviewikiwiki' => true,
		'extloadwiki' => true,
		'foodsharinghamburgwiki' => true,
		'ircwiki' => true,
		'jayuwikiwiki' => true,
		'muckhackwiki' => true,
		'pgnwikiwiki' => true,
		'plazmaburstwiki' => true,
		'porpwiki' => true,
		'priyowiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'takethatwikiwiki' => true,
		'tawseelawiki' => true,
		'wikidolphinhansenwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseContactPage' => array(
		'default' => false, // Add wiki config to ContactPage.php
		'ayrshirewiki' => true,
		'christipediawiki' => true,
		'fablabesdswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseContributionScores' => array(
		'default' => false,
		'extloadwiki' => false,
	),
	'wmgUseCookieWarning' => array(
		'default' => false,
		'extloadwiki' => true,
		'pgnwikiwiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseCreatePage' => array(
		'default' => false,
		'alwikiwiki' => true,
		'evelopediawiki' => true,
		'extloadwiki' => true,
		'tawseelawiki' => true,
	),
	'wmgUseCreateRedirect' => array(
		'default' => false,
		'calexitwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseCreateWiki' => array(
		'default' => false,
		'metawiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseCrossReference' => array(
		'default' => false,
		'chocowiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseCSS' => array(
		'default' => false,
		'690squadronwiki' => true,
		'allthetropeswiki' => true,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'dtswiki' => true,
		'extloadwiki' => true,
		'knowledgewiki' => true,
		'takethatwikiwiki' => true,
		'webflowwiki' => true,
	),
	'wmgUseCustomHeader' => array(
		'default' => false,
		'hlptestwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseCustomNavBlocks' => array(
		'default' => false,
		'calexitwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseDarkVector' => array(
		'default' => true,
		'extloadwiki' => true,
		'grandtheftautowiki' => true,
	),
	'wmgUseDismissableSiteNotice' => array(
		'default' => true,
		'extloadwiki' => true,
	),
	'wmgUseDuskToDawn' => array(
		'default' => false,
		'extloadwiki' => true,
		'ofthevampirewiki' => true,
	),
	'wmgUseDPLForum' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'inkubatorwiki' => true,
		'rpgbrigadewiki' => true,
	),
	'wmgUseDuplicator' => array(
		'default' => false,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'foundationsofteachingwiki' => true,
	),
	'wmgUseDynamicPageList' => array(
		'default' => false,
		'camerainfowiki' => true,
		'extloadwiki' => true,
		'heistwiki' => true,
		'hydrawikiwiki' => true,
		'kstartupswiki' => true,
		'noalatalawiki' => true,
		'rpgbrigadewiki' => true,
		'sidemwiki' => true,
		'wikiletraswiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
		'chocowiki' => true,
	),
	'wmgUseDynamicPageList3' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'ayrshirewiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'sthomaspriwiki' => true,
	),
	'wmgUseEditcount' => array(
		'default' => false,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'dtswiki' => true,
		'extloadwiki' => true,
		'muckhackwiki' => true,
		'perpuswiki' => true,
		'sthomaspriwiki' => true,
		'trexwiki' => true,
	),
	'wmgUseEditSubpages' => array(
		'default' => false,
		'extloadwiki' => true,
		'jayuwikiwiki' => true,
	),
	'wmgUseEducationProgram' => array(
		'default' => false,
		'extloadwiki' => true,
		'ganeshawiki' => true,
		'lezar224wiki' => true,
		'pruebawiki' => true,
		'tutorwiki' => true,
	),
	'wmgUseErudite' => array(
		'default' => false,
		'bdorpwiki' => true,
		'datachronwiki' => true,
		'extloadwiki' => true,
		'lunacyindwiki' => true,
	),
	'wmgUseFancyBoxThumbs' => array(
		'default' => false,
		'ayrshirewiki' => true,
		'extloadwiki' => true,
		'lgproduktsupportwiki' => true,
	),
	'wmgUseFeaturedFeeds' => array(
		'default' => false,
	),
	'wmgUseFlaggedRevs' => array(
		'default' => false,
		'extloadwiki' => true,
		'isvwiki' => true,
		'pruebawiki' => true,
		'styleguidesheetwiki' => true,
		'trexwiki' => true,
		'tutorwiki' => true,
	),
	'wmgUseFlow' => array(
		'default' => false, // Please make sure parsoid is enabled on the wiki in the parsoid.yaml file in the parsoid repo
		'690squadronwiki' => true,
		'8stationwiki' => true,
		'adnovumwiki' => true,
		'ageofimperialistswiki' => true,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'bgowiki' => true,
		'bnetwiki' => true,
		'calexitwiki' => true,
		'cecwiki' => true,
		'christipediawiki' => true,
		'coldbloodedwiki' => true,
		'detlefswiki' => true,
		'developmentwiki' => true,
		'dicficwiki' => true,
		'drones4allwiki' => true,
		'dtswiki' => true,
		'ernaehrungsrathhwiki' => true,
		'espiralwiki' => true,
		'evelopediawiki' => true,
		'extloadwiki' => true,
		'fbwikiwiki' => true,
		'grandtheftwikiwiki' => true,
		'grandtheftautowiki' => true,
		'ircwiki' => true,
		'korachwiki' => true,
		'kstartupswiki' => true,
		'kwikiwiki' => true,
		'lezar224wiki' => true,
		'literaturewiki' => true,
		'marcoschriekwiki' => true,
		'moziwiki' => true,
		'muckhackwiki' => true,
		'nomicwiki' => true,
		'nationsglorywiki' => true,
		'nextlevelwikiwiki' => true,
		'nxwikiwiki' => true,
		'oyeavdelingenwiki' => true,
		'permanentfuturelabwiki' => true,
		'prfmukwiki' => true,
		'priyowiki' => true,
		'soshomophobiewiki' => true,
		'spiralwiki' => true,
		'sthomaspriwiki' => true,
		'takethatwikiwiki' => true,
		'touhouenginewiki' => true,
		'universebuildwiki' => true,
		'votingwiki' => true,
		'wisdomsandboxwiki' => true,
		'wisdomwikiwiki' => true,
		'wishcertwiki' => true,
		'yacresourceswiki' => true,
		'yeoksawiki' => true,
	),
	'wmgUseForeground' => array(
		'default' => false,
		'3dicwiki' => true,
		'allthetropeswiki' => true,
		'corydoctorowwiki' => true,
		'extloadwiki' => true,
		'fusewiki' => true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'jayuwikiwiki' => true,
		'permanentfuturelabwiki' => true,
		'starsetonlinewiki' => true,
	),
	'wmgUseGamepress' => array(
		'default' => false,
		'claneuphoriawiki' => true,
		'extloadwiki' => true,
		'karmazynxyz' => true,
	),
	'wmgUseGraph' => array(
		'default' => false,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseGroupsSidebar' => array(
		'default' => false,
		'extloadwiki' => true,
		'tedcswiki' => true,
	),
	// Be aware of https://www.mediawiki.org/wiki/Extension:Header_Tabs#Incompatible_extensions
	'wmgUseHeaderTabs' => array(
		'default' => false,
		'bdorpwiki' => true,
		'datachronwiki' => true,
		'dtswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseHideSection' => array(
		'default' => false,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'developmentwiki' => true,
		'extloadwiki' => true,
		'hendrickswiki' => true,
	),
	'wmgUseHighlightLinksInCategory' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseImageMap' => array(
		'default' => false,
		'adnovumwiki' => true,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'creersonarbrewiki' => true,
		'doinwiki' => true,
		'dtswiki' => true,
		'esctwiki' => true,
		'extloadwiki' => true,
		'hendrickswiki' => true,
		'jayuwikiwiki' => true,
		'pgnwikiwiki' => true,
		'sthomaspriwiki' => true,
		'studynotekrwiki' => true,
		'takethatwikiwiki' => true,
		'tiandiwiki' => true,
		'universebuildwiki' => true,
		'victorianrpwiki' => true,
		'whentheycrywiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseJavascriptSlideshow' => array(
		'default' => false,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'jayuwikiwiki' => true,
		'plazmaburstwiki' => true,
		'takethatwikiwiki' => true,
		'tymyrddinwiki' => true,
	),
	'wmgUseJosa' => array(
		'default' => false,
		'extloadwiki' => true,
		'reviwiki' => true,
	),
	'wmgUseLabeledSectionTransclusion' => array(
		'default' => false,
		'bmedwiki' => true,
		'bpwiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'extloadwiki' => true,
		'sidemwiki' => true,
		'testwiki' => true,
	),
	'wmgUseLinkSuggest' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseLoopsCombo' => array( // Remember to remove from Variables if the wiki is enabled there
		'default' => false,
		'bigforestwiki' => true,
		'bgowiki' => true,
		'eotewiki' => true,
		'extloadwiki' => true,
		'marcoschriekwiki' => true,
		'ndnwiki' => true,
		'raymanspeedrunwiki' => true,
		'rpgbrigadewiki' => true,
	),
	'wmgUseMaps' => array(
		'default' => false,
		'aerosswiki' => true,
		'ayrshirewiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'enmarchewiki' => true,
		'extloadwiki' => true,
		'jacksonheightswiki' => true,
		'jayuwikiwiki' => true,
		'noalatalawiki' => true,
		'takethatwikiwiki' => true,
		'thelonsdalebattalionwiki' => true,
		'wikidmatlandwiki' => true,
	),
	'wmgUseMassEditRegex' => array(
		'default' => false, // sysop is given permission 'masseditregex' by default
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'cpiwiki' => true,
		'extloadwiki' => true,
		'jayuwikiwiki' => true,
		'magezwiki' => true,
		'poserdazfreebieswiki' => true,
		'takethatwikiwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseMediaWikiChat' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'extloadwiki' => true,
		'ircwiki' => true,
		'pgnwikiwiki' => true,
	),
	'wmgUseMetrolook' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'ayrshirewiki' => true,
		'dtswiki'=> true,
		'extloadwiki' => true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'ircwiki' => true,
		'microsoftwiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseMobileFrontend' => array(
		'default' => true,
		'applebranchwiki' => false,
		'applewikiwiki'=> false,
		'ganeshawiki' => false,
		'izanagiwiki' => false,
		'ndnwiki' => false,
		'permanentfuturelabwiki' => false,
		'reviwiki' => false,
		'reviwikiwiki' => false,
	),
	'wmgUseModernSkylight' => array(
		'default' => false,
		'extloadwiki' => true,
		'jayuwikiwiki' => true,
	),
	'wmgUseMonaco' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseMsPackage' => array(
		'default' => false,
		'calexitwiki' => true,
		'catboxwiki' => true,
		'extloadwiki' => true, // do not set this to false without disabling MsUpload on all wikis below
	),
	// MsUpload is enabled on extloadwiki via MsPackage
	'wmgUseMsUpload' => array(
		'default' => false,
		'8stationwiki' => true,
		'adnovumwiki' => true,
		'aerosswiki' => true,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'amaninfowiki' => true,
		'animationmoviewikiwiki' => true,
		'ayrshirewiki' => true,
		'bgowiki' => true,
		'bigforestwiki' => true,
		'casuarinawiki' => true,
		'christipediawiki' => true,
		'doinwiki' => true,
		'doraemonwiki' => true,
		'emulationwiki' => true,
		'evawiki' => true,
		'exitsincwiki' => true,
		'hendrickswiki' => true,
		'hktransportpediawiki' => true,
		'izanagiwiki' => true,
		'jayuwikiwiki' => true,
		'knowledgewiki' => true,
		'lanstationwiki' => true,
		'lapoliticswiki' => true,
		'luckandlogicwiki' => true,
		'modularwiki' => true,
		'nationstateswiki' => true,
		'nenawikiwiki' => true,
		'oyeavdelingenwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'scruffywiki' => true,
		'snowthegamewiki' => true,
		'thelonsdalebattalionwiki' => true,
		'universebuildwiki' => true,
		'webflowwiki' => true,
		'whentheycrywiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseMultimediaViewer' => array(
		'default' => false,
		'aerosswiki' => true,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'bttestwiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'inazumaelevenwiki' => true,
		'ircwiki' => true,
		'justinbieberwiki' => true,
		'microsoftwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'nationstateswiki' => true,
		'ndnwiki' => true,
		'pgnwikiwiki' => true,
		'prfmukwiki' => true,
		'rpgbrigadewiki' => true,
		'sthomaspriwiki' => true,
		'takethatwikiwiki' => true,
		'thefosterswiki' => true,
		'thehushhushsagawiki' => true,
		'thelonsdalebattalionwiki' => true,
		'tokyoghoulwiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseMultiBoilerplate' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'chimaerawiki' => true,
		'extloadwiki' => true,
		'muckhackwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseNewestPages' => array(
		'default' => false,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'extloadwiki' => true,
		'muckhackwiki' => true,
	),
	'wmgUseNews' => array(
		'default' => false,
		'cpiwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseNewSignupPage' => array(
		'default' => false,
		'extloadwiki' => false, // DO NOT ENABLE !! This extension uses ShoutWiki notices and is not adapted for Miraheze. See T761#22421 --Reception123
	),
	'wmgUseNewsletter' => array(
		'default' => false,
		'espiralwiki' => true,
		'extloadwiki' => true,
		'ircwiki' => true,
	),
	'wmgUseNewUserMessage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'developmentwiki' => true,
		'extloadwiki' => true,
		'ganeshawiki' => true,
		'ircwiki' => true,
		'muckhackwiki' => true,
		'perpuswiki' => true,
		'pgnwikiwiki' => true,
		'takethatwikiwiki' => true,
		'thelonsdalebattalionwiki' => true,
		'trexwiki' => true,
		'tutorwiki' => true,
		'universebuildwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseNewUsersList' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseNostalgia' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseNoTitle' => array(
		'default' => false,
		'imperiuswiki' => true,
		'aktposwiki' => true,
		'alwikiwiki' => true,
		'carvingwiki' => true,
		'developmentwiki' => true,
		'dtswiki' => true,
		'extloadwiki' => true,
		'hendrickswiki' => true,
		'idleomenswiki' => true,
		'lbsgeswiki' => true,
		'luckandlogicwiki' => true,
		'rpgbrigadewiki' => true,
		'universebuildwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseOATHAuth' => array(
		'default' => false,
		'extloadwiki' => true,
		'metawiki' => true,
	),
	'wmgUseOpenGraphMeta' => array(
		'default' => false,
		'extloadwiki' => false, // Upstream issue. T1617. --Reception123
	),
	'wmgUsePagedTiffHandler' => array(
		'default' => false,
		'bpwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUsePageForms' => array(
		'default' => false,
		'extloadwiki' => false, // 502 errors. See T1489 for details. --Reception123
	),
	'wmgUsePageNotice' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'ndnwiki' => true,
		'sthomaspriwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUsePageTriage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bgowiki' => true,
		'calexitwiki' => true,
		'cssandjsschoolboardwiki' => true,
		'extloadwiki' => true,
		'ndnwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'sthomaspriwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUsePDFEmbed' => array(
		'default' => false,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'calexitwiki' => true,
		'constwiki' => true,
		'extloadwiki' => true,
		'frontdeskswiki' => true,
		'ggdrwiki' => true,
		'lgproduktsupportwiki' => true,
		'ndnwiki' => true,
		'nextlevelwikiwiki' => true,
		'noalatalawiki' => true,
		'savagewikiwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
		'virpatel524wiki' => true,
	),
	'wmgUsePdfHandler' => array(
		'default' => false,
		'690squadronwiki' => true,
		'apneuverenigingwiki' => true,
		'bigforestwiki' => true,
		'bpwiki' => true,
		'calexitwiki' => true,
		'constwiki' => true,
		'extloadwiki' => true,
		'jayuwikiwiki' => true,
		'kstartupswiki' => true,
		'modularwiki' => true,
		'noalatalawiki' => true,
		'scruffywiki' => true,
	),
	'wmgUsePopups' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'extloadwiki' => true,
		'inazumaelevenwiki' => true,
		'jayuwikiwiki' => true,
		'justinbieberwiki' => true,
		'marcoschriekwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'pgnwikiwiki' => true,
		'takethatwikiwiki' => true,
		'thefosterswiki' => true,
		'thehushhushsagawiki' => true,
		'tokyoghoulwiki' => true,
		'votingwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
		'youtubewiki' => true,
	),
	'wmgUsePoll' => array(
		'default' => false,
		'alwikiwiki' => true,
		'bigforestwiki' => true,
		'extloadwiki' => true,
		'ganeshawiki' => true,
		'jayuwikiwiki' => true,
		'malaysiawiki' => true,
		'pgnwikiwiki' => true,
		'takethatwikiwiki' => true,
		'tutorwiki' => true,
		'universebuildwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseProofreadPage' => array(
		'default' => false,
		'bpwiki' => true,
		'extloadwiki' => true,
		'kstartupswiki' => true,
	),
	'wmgUseProtectSite' => array(
		'default' => false,
		'barbarasherwikiwiki' => true,
		'calexitwiki' => true,
		'financialfindswiki' => true,
		'extloadwiki' => true,
		'nationsglorywiki' => true,
		'robertsnoteswiki' => true,
		'robertswiki' => true,
		'sqlserverwiki' => true,
		'sterbalfamilyrecipeswiki' => true,
		'sterbalssundrystudieswiki' => true,
		'sthomaspriwiki' => true,
	),
	'wmgUseQuiz' => array(
		'default' => false,
		'alwikiwiki' => true,
		'bigforestwiki' => true,
		'extloadwiki' => true,
		'ganeshawiki' => true,
		'jayuwikiwiki' => true,
		'pruebawiki' => true,
	),
	'wmgUseRandomSelection' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'humorpediawiki' => true,
		'rpgbrigadewiki' => true,
		'takethatwikiwiki' => true,
		'tmewiki' => true,
		'russiawatchwiki' => true,
	),
	'wmgUseRefreshed' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'extloadwiki' => true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'robertswiki' => true,
	),
	'wmgUseRelatedArticles' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'justinbieberwiki' => true,
		'pgnwikiwiki' => true,
		'thehushhushsagawiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseReplaceText' => array(
		'default' => false,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'evawiki' => true,
		'extloadwiki' => true,
		'jayuwikiwiki' => true,
		'modularwiki' => true,
		'scruffywiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseRSS' => array(
		'default' => false,
		'emulationwiki' => true,
		'extloadwiki' => true,
		'lgproduktsupportwiki' => true,
		'tymyrddinwiki' => true,
	),
	'wmgUseSandboxLink' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'idtestwiki' => true,
		'modularwiki' => true,
		'nationstateswiki' => true,
		'scruffywiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseScratchBlocks' => array(
		'default' => false,
		'extloadwiki' => true,
		'qwertywiki' => true,
	),
	'wmgUseShortURL' => array(
		'default' => true,
		'applewikiwiki' => false,
		'applebranchwiki' => false,
	),
	'wmgUseSimpleChanges' => array(
		'default' => false,
		'christipediawiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseSimpleTooltip' => array(
		'default' => false,
		'8stationwiki' => true,
		'apolcourseswiki' => true,
		'calexitwiki' => true,
		'cpiwiki' => true,
		'extloadwiki' => true,
		'jakeperswiki' => true,
		'perpuswiki' => true,
		'trexwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseSiteScout' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
	),
	// Requires copying of two directories: https://www.mediawiki.org/wiki/Extension:SocialProfile#Directories
	// Should be this, but change $nameofwiki at the end:
	// sudo -u www-data cp -R /srv/mediawiki/w/extensions/SocialProfile/avatars /srv/mediawiki/w/extensions/SocialProfile/awards /mnt/mediawiki-static/$nameofwiki/
	'wmgUseSocialProfile' => array(
		'default' => false,
		'adnovumwiki' => true,
		'allthetropeswiki' => true,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'calexitwiki' => true,
		'datachronwiki' => true,
		'extloadwiki' => true,
		'ircwiki' => true,
		'lezar224wiki' => true,
		'micropediawiki' => true,
		'priyowiki' => true,
		'stellachronicawiki' => true,
		'takethatwikiwiki' => true,
	),
	'wmgUseSpoilers' => array(
		'default' => false,
		'adventurewikiwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseSubpageFun' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseSubPageList3' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseSyntaxHighlight' => array(
		'default' => false,
		'alfrescowiki' => true,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'bigforestwiki' => true,
		'cssandjsschoolboardwiki' => true,
		'datasciencewiki' => true,
		'detlefswiki' => true,
		'doinwiki' => true,
		'dtswiki' => true,
		'extloadwiki' => true,
		'ganeshawiki' => true,
		'hendrickswiki' => true,
		'integrawiki' => true,
		'isvwiki' => true,
		'jawp2chwiki' => true,
		'jayuwikiwiki' => true,
		'karmazynxyz' => true,
		'lizhongresearchwiki' => true,
		'modularwiki' => true,
		'ndnwiki' => true,
		'nextlevelwikiwiki' => true,
		'noalatalawiki' => true,
		'partupwiki' => true,
		'pascalscada' => true,
		'perpuswiki' => true,
		'priyowiki' => true,
		'programmingreferencewiki' => true,
		'scruffywiki' => true,
		'sizzlecookiewiki' => true,
		'sourcewiki' => true,
		'spacegamewiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'sysexwiki' => true,
		'tmewiki' => true,
		'trexwiki' => true,
		'touhouenginewiki' => true,
		'tutorwiki' => true,
		'valentinaprojectwiki' => true,
		'wikicervanteswiki' => true,
		'xdjibiwiki' => true,
		'xofwiki' => true,
		'xjtluwiki' => true,
	),
	// Combo of Tabs + Tabber
	'wmgUseTabsCombination' => array(
		'default' => false,
		'8stationwiki' => true,
		'aerosswiki' => true,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'developmentwiki' => true,
		'eternalconficttwiki' => true,
		'extloadwiki' => true,
		'jayuwikiwiki' => true,
		'knowledgewiki' => true,
		'lunacyindwiki' => true,
		'magezwiki' => true,
		'nationstateswiki' => true,
		'thelonsdalebattalionwiki' => true,
		'russiawatchwiki' => true,
		'sidemwiki' => true,
		'stellachronicawiki' => true,
		'takethatwikiwiki' => true,
		'universebuildwiki' => true,
		'whentheycrywiki' => true,
	),
	'wmgUseTemplateSandbox' => array(
		'default' => false,
		'bigforestwiki' => true,
		'extloadwiki' => true,
		'isvwiki' => true,
		'jayuwikiwiki' => true,
		'modularwiki' => true,
	),
	'wmgUseTheme' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'claneuphoriawiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseTimedMediaHandler' => array(
		'default' => false,
		'arquivosdoprincipadowiki' => true,
		'bigforestwiki' => true,
		'corydoctorowwiki' => true,
		'extloadwiki' => true,
		'enmarchewiki' => true,
		'geirpediawiki' => true,
		'tymyrddinwiki' => true,
	),
	'wmgUseTimeless' => array( 
		'default' => false,
		'corydoctorowwiki' => true,
		'extloadwiki' => true,
		'grandtheftautowiki' => true,
	),
	'wmgUseTitleKey' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseTocTree' => array(
		'default' => false,
		'extloadwiki' => true,
		'tedcswiki' => true,
	),
	'wmgUseTranslate' => array(
		'default' => false,
		'3dicwiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'cpiwiki' => true,
		'dishwiki' => true,
		'extloadwiki' => true,
		'inazumaelevenwiki' => true,
		'ircwiki' => true,
		'jayuwikiwiki' => true,
		'metawiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'nanatsunotaizaiwiki' => true,
		'nvcwiki' => true,
		'pathfinderwiki' => true,
		'pgnwikiwiki' => true,
		'rpgbrigadewiki' => true,
		'spiralwiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'testwiki' => true,
		'thehushhushsagawiki' => true,
		'tokyoghoulwiki' => true,
		'trexwiki' => true,
		'tutorwiki' => true,
		'tymyrddinwiki' => true,
		'urpswiki' => true,
		'valentinaprojectwiki' => true,
		'welcomewiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseUserWelcome' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseVoteNY' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'espiralwiki' => true,
		'extloadwiki' => true,
		'ganeshawiki' => true,
		'wikidolphinhansenwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseVisualEditor' => array(
		'default' => false, // Please make sure parsoid is enabled on the wiki in the parsoid.yaml file in the parsoid repo
		'1209wiki' => true,
		'3dicwiki' => true,
		'3dicxyzwiki' => true,
		'690squadronwiki' => true,
		'8stationwiki' => true,
		'aacenterpriselearningwiki' => true,
		'adnovumwiki' => true,
		'aerosswiki' => true,
		'aescapeswiki' => true,
		'ageofenlightenmentwiki' => true,
		'ageofimperialismwiki' => true,
		'ageofimperialistswiki' => true,
		'ageloniawiki' => true,
		'aidorupediawiki' => true,
		'airwiki' => true,
		'aktposwiki' => true,
		'alanpediawiki' => true,
		'algopediawiki' => true,
		'allbanks2wiki' => true,
		'allthetropeswiki' => true,
		'alternatehistorywiki' => true,
		'alwikiwiki' => true,
		'animationmoviewikiwiki' => true,
		'apneuverenigingwiki' => true,
		'applebranchwiki' => true,
		'arabudlandwiki' => true,
		'arguwikiwiki' => true,
		'artificercreationswiki' => true,
		'aryamanwiki' => true,
		'ayrshirewiki' => true,
		'atheneumwiki' => true,
		'attackontitanwiki' => true,
		'bchwiki' => true,
		'bgowiki' => true,
		'betapurplewiki' => true,
		'bettermediawiki' => true,
		'betternewswiki' => true,
		'biblicalwikiwiki' => true,
		'bibliowiki' => true,
		'bigforestwiki' => true,
		'biskwiki' => true,
		'bmedwiki' => true,
		'boulderwikiwiki' => true,
		'bpawiki' => true,
		'braindumpwiki' => true,
		'breedersofthenephelymwiki' => true,
		'brynda1231wiki' => true,
		'bttestwiki' => true,
		'byblopediawiki' => true,
		'calexitwiki' => true,
		'cancerwiki' => true,
		'carelliwiki' => true,
		'carvingwiki' => true,
		'casuarinawiki' => true,
		'changemyorgwiki' => true,
		'chimaerawiki' => true,
		'christipediawiki' => true,
		'civitaswiki' => true,
		'clementsworldbuildingwiki' => true,
		'clicordiwiki' => true,
		'cnvwiki' => true,
		'cogitopediewiki' => true,
		'coldbloodedwiki' => true,
		'conquestofparadiserpwiki' => true,
		'corydoctorowwiki' => true,
		'cssandjsschoolboardwiki' => true,
		'cybersecuritywiki' => true,
		'cvsmbwiki' => true,
		'dalarwiki' => true,
		'datachronwiki' => true,
		'detlefswiki' => true,
		'developmentwiki' => true,
		'dicficwiki' => true,
		'dishwiki' => true,
		'dmwwiki' => true,
		'doinwiki' => true,
		'doraemonwiki' => true,
		'dottorcontewiki' => true,
		'drones4allwiki' => true,
		'dtswiki' => true,
		'dwplivewiki' => true,
		'easterwiki' => true,
		'easywikiwiki' => true,
		'ernaehrungsrathhwiki' => true,
		'espiralwiki' => true,
		'esswaywiki' => true,
		'etpowiki' => true,
		'evawiki' => true,
		'evelopediawiki' => true,
		'extloadwiki' => true,
		'fablabesdswiki' => true,
		'fantasiawiki' => true,
		'fbwikiwiki' => true,
		'fishpercolatorwiki' => true,
		'fmbvwiki' => true,
		'foodsharinghamburgwiki' => true,
		'freeandopenwiki' => true,
		'freestateofjoneswiki' => true,
		'frontdeskswiki' => true,
		'fsxworldspainwiki' => true,
		'fusewiki' => true,
		'ganeshawiki' => true,
		'geirpediawiki' => true,
		'genwiki' => true,
		'gncwiki' => true,
		'grandtheftwikiwiki' => true,
		'grandtheftautowiki' => true,
		'gzewiki' => true,
		'hamfemwiki' => true,
		'hftqmswiki' => true,
		'historiaalternativawiki' => true,
		'hjelpemidlerwiki' => true,
		'hktransportpediawiki' => true,
		'hlptestwiki' => true,
		'hobbieswiki' => true,
		'hshsinfoportalwiki' => true,
		'hsoodenwiki' => true,
		'hytecwiki' => true,
		'icmscholarswiki' => true,
		'ilearnthingswiki' => true,
		'imstswiki' => true,
		'inazumaelevenwiki' => true,
		'integrywiki' => true,
		'ircwiki' => true,
		'islamwissenschaftwiki' => true,
		'izanagiwiki' => true,
		'jakeperswiki' => true,
		'janesskillspackwiki' => true,
		'jayuwikiwiki' => true,
		'justinbieberwiki' => true,
		'karmazynxyzwiki' => true,
		'kassaiwiki' => true,
		'karniarutheniawiki' => true,
		'kevincwiki' => true,
		'kinderacicwiki' => true,
		'knowledgewiki' => true,
		'kozawiki' => true,
		'krebswiki' => true,
		'kstartupswiki' => true,
		'lancemedicalwiki' => true,
		'lapoliticswiki' => true,
		'lbsgeswiki' => true,
		'lezar224wiki' => true,
		'lingnlangwiki' => true,
		'littlebigplanetwiki' => true,
		'lizardwiki' => true,
		'lovelivewiki' => true,
		'luckandlogicwiki' => true,
		'lunfengwiki' => true,
		'magezwiki' => true,
		'maiasongcontestwiki' => true,
		'malaysiawiki' => true,
		'marcoschriekwiki' => true,
		'make717wiki' => true,
		'medergistswiki' => true,
		'medlabisowiki' => true,
		'menufeedwiki' => true,
		'meregoswiki' => true,
		'metawiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'miningpromieswiki' => true,
		'modularwiki' => true,
		'muckhackwiki' => true,
		'musicarchivewiki' => true,
		'musiclibrarywiki' => true,
		'mydegreewiki' => true,
		'mylogicwiki' => true,
		'mynyddwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'nationstateswiki' => true,
		'ndnwiki' => true,
		'nenawikiwiki' => true,
		'neuromotorwiki' => true,
		'neuronpediawiki' => true,
		'newarkmanorwiki' => true,
		'newcolumbiawiki' => true,
		'newknowledgewiki' => true,
		'newtrendwiki' => true,
		'nextlevelwikiwiki' => true,
		'noalatalawiki' => true,
		'nonbinarywiki' => true,
		'nvcwiki' => true,
		'nwpwiki' => true,
		'nxwikiwiki' => true,
		'ofthevampirewiki' => true,
		'oncprojectwiki' => true,
		'opengovpioneerswiki' => true,
		'ourmxfestwiki' => true,
		'overonwiki' => true,
		'oyeavdelingenwiki' => true,
		'panoramawiki' => true,
		'paodeaodawiki' => true,
		'partupwiki' => true,
		'patch153wiki' => true,
		'pbmwiki' => true,
		'permanentfuturelabwiki' => true,
		'pfsolutionswiki' => true,
		'pgnwikiwiki' => true,
		'plasticssongcontestwiki' => true,
		'pqwiki' => true,
		'politicswiki' => true,
		'porpwiki' => true,
		'prfmukwiki' => true,
		'priyowiki' => true,
		'pruebawiki' => true,
		'pso2wiki' => true,
		'purpanrangueiluswiki' => true,
		'qwertywiki' => true,
		'rawdatawiki' => true,
		'raymanspeedrunwiki' => true,
		'revitwiki' => true,
		'robertswiki' => true,
		'rocketleaguequebecwiki' => true,
		'rootsandlimbswiki' => true,
		'rpcharacterswiki' => true,
		'safiriawiki' => true,
		'savagewikiwiki' => true,
		'scruffywiki' => true,
		'seldirwiki' => true,
		'setonwiki' => true,
		'shippingandmetawiki' => true,
		'sidemwiki' => true,
		'simonjonwiki' => true,
		'sirikotwiki' => true,
		'sjuhabitatwiki' => true,
		'skyfireflyffwiki' => true,
		'snowthegamewiki' => true,
		'soshomophobiewiki' => true,
		'southparkfanwiki' => true,
		'spiralwiki' => true,
		'starsetonlinewiki' => true,
		'stellachronicawiki' => true,
		'sthomaspriwiki' => true,
		'studynotekrwiki' => true,
		'takethatwikiwiki' => true,
		'tawseelawiki' => true,
		'techeducationwiki' => true,
		'tcc6640wiki' => true,
		'tekkenwiki' => true,
		'teleswikiwiki' => true,
		'testwiki' => true,
		'thecscwiki' => true,
		'thefosterswiki' => true,
		'thehushhushsagawiki' => true,
		'theworldwiki' => true,
		'titaniawiki' => true,
		'tmewiki' => true,
		'tochkiwiki' => true,
		'tokyoghoulwiki' => true,
		'torejorgwiki' => true,
		'touhouenginewiki' => true,
		'trablangwiki' => true,
		'trexwiki' => true,
		'trumpwiki' => true,
		'tsponiewiki' => true,
		'twswiki' => true,
		'tymyrddinwiki' => true,
		'uoluwiki' => true,
		'unikumwiki' => true,
		'universebuildwiki' => true,
		'valentinaprojectwiki' => true,
		'vgalimentiwiki' => true,
		'victorianrpwiki' => true,
		'videogameswiki' => true,
		'votingwiki' => true,
		'wabcwiki' => true,
		'webflowwiki' => true,
		'westmarcheswiki' => true,
		'wikibookswiki' => true,
		'wikicervanteswiki' => true,
		'wikidolphinhansenwiki' => true,
		'wikiescolawiki' => true,
		'wikihoyowiki' => true,
		'wikikaisagawiki' => true,
		'wikinicuswiki' => true,
		'wikipucwiki' => true,
		'wisdomsandboxwiki' => true,
		'wisdomwikiwiki' => true,
		'wishcertwiki' => true,
		'worldbuildingwiki' => true,
		'wthsapgovwiki' => true,
		'xdjibiwiki' => true,
		'xdwxstywiki' => true,
		'xjtluwiki' => true,
		'yeoksawiki' => true,
		'ylscwiki' => true,
		'yourosongcontestwiki' => true,
		'youtubewiki' => true,
		'chocowiki' => true,
		'zitabiteswiki' => true,
	),
	'wmgUseVariables' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'ayrshirewiki' => true,
		'bgowiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'eotewiki' => true,
		'jayuwikiwiki' => true,
		'marcoschriekwiki' => true,
		'szkwiki' => true,
		'takethatwikiwiki' => true,
		'wikikaisagawiki' => true,
	),
	'wmgUseWebChat' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'pnphilotenwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseWhoIsWatching' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseWidgets' => array(
		'default' => false,
		'aemanualwiki' => true,
		'amaninfowiki' => true,
		'ayrshirewiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'geodatawiki' => true,
		'jayuwikiwiki' => true,
		'modularwiki' => true,
		'muckhackwiki' => true,
		'plazmaburstwiki' => true,
		'scruffywiki' => true,
		'soshomophobiewiki' => true,
		'takethatwikiwiki' => true,
		'thecscwiki' => true,
		'wikipucwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseWikibaseRepository' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseWikiForum' => array(
		'default' => false, // DO NOT ENABLE. disables captcha on all actions. See T1124 (upstream) --Reception123
	//	'applebranchwiki' => true,
	//	'alwikiwiki' => true,
	//	'applewikiwiki' => true,
	//	'entropediawiki' => true,
	//	'extloadwiki' => true,
	//	'grandtheftautowiki' => true,
	//      'knowledgewiki' => true,
	//	'indexwiki' => true,
	//	'ircwiki' => true,
	//	'porpwiki' => true,
	//	'starsetonlinewiki' => true,
	//	'stellachronicawiki' => true,
	//	'wikicervanteswiki' => true,
	//	'wisdomwikiwiki' => true,
	//	'wisdomsandboxwiki' => true,
	),
	'wmgUsewikihiero' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseWikiLove' => array(
		'default' => false,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'pgnwikiwiki' => true,
		'pruebawiki' => true,
		'robertswiki' => true,
	),
	'wmgUseWikiTextLoggedInOut' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'extloadwiki' => true,
		'pgnwikiwiki' => true,
	),
	'wmgUseYouTube' => array(
		'default' => false,
		'1209wiki' => true,
		'airwiki' => true,
		'alanpediawiki' => true,
		'allthetropeswiki' => true,
		'aktposwiki' => true,
		'animationmoviewikiwiki' => true,
		'apolcourseswiki' => true,
		'bigforestwiki' => true,
		'biuwiki' => true,
		'bmedwiki' => true,
		'calexitwiki' => true,
		'carvingwiki' => true,
		'christipediawiki' => true,
		'corydoctorowwiki' => true,
		'datachronwiki' => true,
		'developmentwiki' => true,
		'dmwwiki' => true,
		'doinwiki' => true,
		'doraemonpediawiki' => true,
		'dwplivewiki' => true,
		'eternalconfictwiki' => true,
		'evawiki' => true,
		'evelopediawiki' => true,
		'extloadwiki' => true,
		'florianoromanowiki' => true,
		'freecollegeprojectwiki' => true,
		'geirpediawiki' => true,
		'geodatawiki' => true,
		'hktransportpediawiki' => true,
		'inazumaelevenwiki' => true,
		'islamwissenschaftwiki' => true,
		'izanagiwiki' => true,
		'jakeperswiki' => true,
		'jayuwikiwiki' => true,
		'janesskillspackwiki' => true,
		'lifewiki' => true,
		'luckandlogicwiki' => true,
		'marcoschriekwiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'modularwiki' => true,
		'muckhackwiki' => true,
		'ndnwiki' => true,
		'noalatalawiki' => true,
		'ontariobrasswiki' => true,
		'openonderwijswiki' => true,
		'pgnwikiwiki' => true,
		'plazmaburstwiki' => true,
		'prfmukwiki' => true,
		'priyowiki' => true,
		'rpgbrigadewiki' => true,
		'starsetonlinewiki' => true,
		'sthomaspriwiki' => true,
		'szkwiki' => true,
		'takethatwikiwiki' => true,
		'testwiki' => true,
		'tmewiki' => true,
		'valentinaprojectwiki' => true,
		'wikiletraswiki' => true,
		'wikipucwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
		'worldpediawiki' => true,
		'webflowwiki' => true,
		'yacresourceswiki' => true,
	),

	// External link target
	'wgExternalLinkTarget' => array(
		'default' => false,
		'cpiwiki' => '_blank',
		'doinwiki' => '_blank',
		'forexwiki' => '_blank',
		'nenawikiwiki' => '_blank',
		'sylwiki' => '_blank',
		'wisdomwikiwiki' => '_blank',
		'wisdomsandboxwiki' => '_blank',
		'yacresourceswiki' => '_blank',
	),
	
	// Allow External Images
	'wgAllowExternalImages' => array(
		'default' => false,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'westmarcheswiki' => true,
	),
	
	// Allow HTML <img> tag
	'wgAllowImageTag' => array(
		'default' => false,
		'westmarcheswiki' => true,
	),

	// FlaggedRevs
	'wmgFlaggedRevsNamespaces' => array(
		'default' => array(
			NS_MAIN,
			NS_FILE,
			NS_TEMPLATE,
			NS_HELP,
			NS_PROJECT,
		),
		'isvwiki' => array(
			NS_MAIN,
			NS_FILE,
			NS_TEMPLATE,
			NS_CATEGORY,
			828,
		),
		'trexwiki' => array(
			NS_ARTIKEL,
			NS_FILE,
			NS_TEMPLATE,
		),
	),
	'wmgFlaggedRevsProtection' => array(
		'default' => false,
		'pruebawiki' => true,
	),
	'wmgFlaggedRevsTags' => array(
		'default' => array(
			'status' => array(
				'quality' => 1,
				'levels' => 2,
				'pristine' => 3,
			),
		),
		'isvwiki' => array(
			'status' => array(
				'levels' => 1,
				'quality' => 2,
				'pristine' => 4,
			),
		),
	),
	'wmgFlaggedRevsTagsRestrictions' => array(
		'default' => array(
			'status' => array(
				'review' => 1,
				'autoreview' => 1,
			),
		),
	),
	'wmgFlaggedRevsTagsAuto' => array(
		'default' => array(
			'status' => 1,
		),
	),
	'wmgFlaggedRevsAutopromote' => array(
		'default' => array(
			'days' => 14,
			'edits' => 100,
			'excludeLastDays' => 1,
			'benchmarks' => 1,
			'spacing' => 1,
			'totalContentEdits' => 100,
			'totalCheckedEdits' => 100,
			'uniqueContentPages' => 10,
			'editComments' => 80,
			'userpageBytes' => 1,
			'neverBlocked' => true,
			'maxRevertedEditRatio'=> .05,
		),
		'isvwiki' => false,
		'pruebawiki' => false,
	),
	'wmgFlaggedRevsAutoReview' => array(
		'default' => true,
	),
	'wmgFlaggedRevsRestrictionLevels' => array(
		'default' => array( '', 'sysop' ),
		'pruebawiki' => array( '', 'sysop', 'bureaucrat', 'consul', 'autoconfirmed', 'user' ),
	),

	// Files
	'wgEnableUploads' => array(
		'default' => true,
	),
	'wgAllowCopyUploads' => array(
		'default' => false,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'catboxwiki' => true,
		'entropediawiki' => true,
		'ndnwiki' => true,
	),
	'wgCopyUploadsFromSpecialUpload' => array(
		'default' => false,
		'applebranchwiki' => true,
		'applewikiwiki' => true,
		'catboxwiki' => true,
		'entropediawiki' => true,
		'ndnwiki' => true,
	),
	'wgFileExtensions' => array(
		'default' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf' ),
		'+amaninfowiki' => array('pcap', 'cap' ),
		'+bigforestwiki' => array( 'apng', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'doc', 'docx', 'txt', 'rtf', 'htm', 'html', 'xml', 'ppt', 'pptx' ),
		'+doinwiki' => array('pdf', 'ppt', 'pptx', 'xls', 'xlxs', 'zip' ),
		'+exercicesdefrancaisprodfrwiki' => array('html', 'htm' ),
		'+exitsincwiki' => array('txt' ),
		'+jayuwikiwiki' => array('bmp', 'apng', 'tiff', 'wav', 'mp3', 'oga', 'ogv', 'asv', 'swf', 'wmv'),
		'+modularwiki' => array('pdf', 'mid', 'mp3', 'flac', 'svg', 'fpd' ),
		'+oyeavdelingenwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx'),
		'+scruffywiki' => array( 'pdf', 'mid', 'mp3', 'flac', 'svg', 'fpd'),
		'+techeducationwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'ppt', 'xls', 'xlsx','xml'),
		'+wisdomwikiwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'txt', 'rtf', 'zip'),
		'+wisdomsandboxwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'txt', 'rtf', 'zip'),
	),
	'wgUseInstantCommons' => array(
		'default' => true,
		'amaninfowiki' => false,
		'modularwiki' => false,
		'pso2wiki' => false,
		'sidemwiki' => false,
		'thefosterswiki' => false,
	),
	'wgEnableImageWhitelist' => array(
		'default' => false,
	),
	'wgShowArchiveThumbnails' => array(
		'default' => true,
		'doinwiki' => false,
	),

	// Flow
	'wmgFlowDefaultNamespaces' => array(
		'default' => true,
		'nationsglorywiki' => false,
	),

	// GlobalBlocking
	'wgApplyGlobalBlocks' => array(
		'default' => true,
		'metawiki' => false,
	),
	'wgGlobalBlockingDatabase' => array(
		'default' => 'centralauth', // use centralauth for global blocks
	),

	// GlobalCssJs
	'wgGlobalCssJsConfig' => array(
		'default' => array(
			'wiki' => 'metawiki',
			'source' => 'metawiki',
		),
	),
	'+wgResourceLoaderSources' => array(
		'default' => array(
			'metawiki' => array(
				'apiScript' => '//meta.miraheze.org/w/api.php',
				'loadScript' => '//meta.miraheze.org/w/load.php',
			),
		),
	),
	'wgUseGlobalSiteCssJs' => array(
		'default' => false,
	),

	// HighlightLinks
	'wgHighlightLinksInCategory' => array(
		'default' => array(),
		'allthetropeswiki' => array(
			'Trope' => 'trope',
			'YMMV_Trope' => 'ymmv',
		),
		'extloadwiki' => array(
			'Trope' => 'trope',
		),
	),

	// ImageMagick
	'wgUseImageMagick' => array(
		'default' => true,
	),
	'wgImageMagickCommand' => array(
		'default' => '/usr/bin/convert',
	),

	// Interwiki
	'wgEnableScaryTranscluding' => array(
		'default' => true,
	),
	'wgInterwikiCentralDB' => array(
		'default' => 'metawiki',
	),

	// Job Queue
	'wgJobRunRate' => array(
		'default' => 0,
	),

	// Language
	'wgLanguageCode' => array( // Hardcode "en"
		'default' => 'en',
	),

	// License
	'wgRightsIcon' => array(
		'default' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'coldbloodedwiki' => 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-sa.png',		
		'compilerdevwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'diavwiki' => "//$wmgUploadHostname/diavwiki/f/fc/Copyrighted_Content.png",
		'espiralwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'japanjayuwikiwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'jawp2chwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'jayuvandalwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'kstartupswiki' => 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png',
		'libertywikiwiki' => 'http://creativecommons.org.nz/wp-content/uploads/2012/05/by-nc-sa1.png',
		'lothuialethwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'lymernilwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'rezeroswiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'safiriawiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'sourcewiki' => 'https://source.miraheze.org/wiki/Source_Code_Wiki:Copyrights',
		'spiralwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'universebuildwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'wisdomwikiwiki' => 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png',
	),
	'wgRightsPage' => array(
		'default' => '',
		'developmentwiki' => 'Official:Copyrights',
		'diavwiki' => 'Project:Copyrights',
		'kstartupswiki' => 'Project:저작권',
		'sourcewiki' => 'Project:Copyrights',
		'wisdomwikiwiki' => 'Copyleft',
	),
	'wgRightsText' => array(
		'default' => 'Creative Commons Attribution Share Alike',
		'coldbloodedwiki' => '크리에이티브 커먼즈 저작자표시-동일조건변경허락 4.0 국제 라이선스',		
		'compilerdevwiki' => 'CC0 Public Domain',
		'diavwiki' => 'All Rights Reserved',
		'espiralwiki' => 'CC0 Public Domain',
		'gamdugwiki' => 'Attribution-NonCommercial 3.0 Australia',
		'humorpediawiki' => 'Creative Commons Attribution-ShareAlike 4.0 International License',
		'japanjayuwikiwiki' => 'Creative Commons Attribution Share Alike',
		'jawp2chwiki' => 'CC0 Public Domain',
		'jayuvandalwiki' => 'Creative Commons Attribution Share Alike',
		'kstartupswiki' => '크리에이티브 커먼즈 저작자표시-비영리-변경금지 4.0 국제 라이선스',
		'libertywikiwiki' => 'Attribution-NonCommercial-ShareAlike 3.0 Unported',
		'lothuialethwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'lymernilwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'metatrekwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'oyeavdelingenwiki' => 'All Rights Reserved',
		'rezeroswiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'safiriawiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'sourcewiki' => 'Wiki copyright information.',
		'spiralwiki' => 'CC0 Public Domain',
		'tmewiki' => 'Creative Commons Attribution-ShareAlike 4.0 International License',
		'universebuildwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'wisdomwikiwiki' => 'Creative Commons Attribution-NonCommercial-NoDerivatives',
	),
	'wgRightsUrl' => array(
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/',
		'bigforestwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'coldbloodedwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/deed.ko',		
		'compilerdevwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'espiralwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'gamdugwiki' => 'https://creativecommons.org/licenses/by-nc/3.0/au/',
		'humorpediawiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'japanjayuwikiwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'jawp2chwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/deed.ja',
		'jayuvandalwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'jayuwikiwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'kstartupswiki' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/deed.ko',
		'kwikiwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'libertywikiwiki' => 'https://creativecommons.org/licenses/by-nc-sa/3.0/',
		'mapinfowiki' => 'https://creativecommons.org/licenses/by/4.0/',
		'metatrekwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'rezeroswiki' => 'https://creativecommons.org/licenses/by-nc-sa/2.0/',
		'safiriawiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'sourcewiki' => 'https://source.miraheze.org/wiki/Source_Code_Wiki:Copyrights',
		'spiralwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'lothuialethwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'lymernilwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'tmewiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'ujhswiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'universebuildwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'unjeongwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'wisdomwikiwiki' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/',
	),

	// Links
	'+wgUrlProtocols' => array(
		'default' => array(),
		// file protocol only allowed on private wikis
		'gzewiki' => array ( "file://" ),
	),

	// Mail
	'wgEnableEmail' => array(
		'default' => true,
	),
	'wgPasswordSender' => array(
		'default' => 'noreply@miraheze.org',
	),
	'wgSMTP' => array(
		'default' => array(
			'host' => 'mail.miraheze.org',
			'port' => 25,
			'IDHost' => 'miraheze.org',
			'auth' => true,
			'username' => 'noreply',
			'password' => $wmgSMTPPassword,
		),
	),
	'wgEnotifWatchlist' => array(
		'default' => true,
	),
	'wgUserEmailUseReplyTo' => array(
		'default' => true,
	),
	'wgEmailConfirmToEdit' => array(
		'default' => false,
		'nenawikiwiki' => true,
	),

	// Math
	'wgMathValidModes' => array(
		'default' => array( 'png' ),
	),
	'wgTexvc' => array(
		'default' => '/usr/bin/texvc',
	),

	// ManageWiki
	'wgManageWikiMainDatabase' => array(
		'default' => 'metawiki',
	),
	'wgManageWikiGlobalWiki' => array(
		'default' => 'metawiki',
	),
	'wgEnableManageWiki' => array(
		'default' => true,
	),
	'wmgManageWikiGroup' => array( // the usergroup allowed 'managewiki'
		'default' => 'bureaucrat',
		'metawiki' => 'wikicreator',
		'pruebawiki' => 'consul',
		'robertswiki' => 'staff',
		'testwiki' => 'consul',
	),

	// MassMessage
	'wgAllowGlobalMessaging' => array(
		'default' => false,
		'metawiki' => true,
	),
	'wgNamespacesToPostIn' => array(
		'default' => array( NS_PROJECT ),
		'+bgowiki' => array(
			NS_MAIN,
			NS_PROJECT,
		),
	),

	// Metrolook settings
	'wgMetrolookDownArrow' => array(
		'default' => true,
		'allthetropeswiki' => false,
		'ayrshirewiki' => false,
		'thelonsdalebattalionwiki' => false,
	),
	'wgMetrolookUploadButton' => array(
		'default' => true,
		'allthetropeswiki' => false,
	),
	'wgMetrolookBartile' => array(
		'default' => true,
		'ayrshirewiki' => false,
		'thelonsdalebattalionwiki' => false,
	),
	'wgMetrolookMobile' => array(
		'default' => true,
		'ayrshirewiki' => false,
	),
	'wgMetrolookUseIconWatch' => array(
		'default' => true,
		'ayrshirewiki' => false,
	),
	'wgMetrolookLine' => array(
		'default' => true,
		'ayrshirewiki' => false,
	),

	// MirahezeMagic
	// https://meta.miraheze.org/wiki/Dormancy_Policy/Exceptions
	'wgFindInactiveWikisWhitelist' => array(
		'default' => array(
			'metawiki',
			'allthetropeswiki',
			'biblicalwikiwiki',
			'bitcoindebateswiki',
			'bpwiki',
			'cvtwiki',
			'newarkmanorwiki',
			'softwarecrisiswiki',
			'spiralwiki',
			'extloadwiki',
			'loginwiki',
			'lothuialethwiki',
			'taliaferrowiki',
			'testwiki',
			'wrightwiki',
			'wright000wiki',
			'wright001wiki',
			'wright002wiki',
			'wright003wiki',
			'wright004wiki',
			'wright005wiki',
			'wright006wiki',
			'wright007wiki',
			'wright008wiki',
			'wright009wiki',
			'wright010wiki',
			'wright011wiki',
			'wright012wiki',
			'wright013wiki',
			'wright014wiki',
			'wright015wiki',
			'wright016wiki',
			'wright017wiki',
			'wright018wiki',
			'wright017wiki',
			'wright018wiki',
			'wright019wiki',
			'wright020wiki',
			'wright021wiki',
			'wright022wiki',
			'wright023wiki',
			'wright024wiki',
			'wright025wiki',
			'wright026wiki',
			'wright027wiki',
			'wright028wiki',
			'wright029wiki',
			'wright030wiki',
			'wright031wiki',
			'wright032wiki',
			'wright033wiki',
			'wright034wiki',
			'wright035wiki',
			'wright036wiki',
			'wright037wiki',
			'wright038wiki',
			'wright039wiki',
			'wright040wiki',
			'wright041wiki',
			'wright042wiki',
			'wright043wiki',
			'wright044wiki',
			'wright045wiki',
			'wright046wiki',
			'wright047wiki',
			'wright048wiki',
			'wright049wiki',
			'wright050wiki',
			'wright051wiki',
			'wright052wiki',
			'wright053wiki',
			'wright054wiki',
			'wright055wiki',
			'wright056wiki',
			'wright057wiki',
			'wright058wiki',
			'wright059wiki',
			'wright060wiki',
			'wright061wiki',
			'wright062wiki',
			'wright063wiki',
			'wright064wiki',
			'wright065wiki',
			'wright066wiki',
			'wright067wiki',
			'wright068wiki',
			'wright069wiki',
			'wright070wiki',
			'wright071wiki',
			'wright072wiki',
			'wright073wiki',
			'wright074wiki',
			'wright075wiki',
			'wright076wiki',
			'wright077wiki',
			'wright078wiki',
			'wright079wiki',
			'wright080wiki',
			'wright081wiki',
			'wright082wiki',
			'wright083wiki',
			'wright084wiki',
			'wright085wiki',
			'wright086wiki',
			'wright087wiki',
			'wright088wiki',
			'wright089wiki',
			'wright090wiki',
			'wright091wiki',
			'wright092wiki',
			'wright093wiki',
			'wright094wiki',
			'wright095wiki',
			'wright096wiki',
			'wright097wiki',
			'wright098wiki',
			'wright099wiki',
			'wright100wiki',
		),
	),

	// Misc. stuff
	'wgSitename' => array(
		'default' => 'No sitename set!',
	),
	'wgAllowDisplayTitle' => array(
		'default' => true,
	),
	'wgRestrictDisplayTitle' => array(
		'default' => true, // Wikis with NoTitle have it set to false
		'ayrshirewiki' => true,
		'takethatwikiwiki' => false,
	),

	// MobileFrontend
	'wmgMFAutodetectMobileView' => array(
		'default' => true,
		'trexwiki' => false,
	),

	// MsCatSelect vars
	'wgMSCS_WarnNoCategories' => array(
		'default' => true,
		'extloadwiki' => false,
	),

	// MsUpload settings
	'wgMSU_useDragDrop' => array(
		'default' => false,
		'anduinwiki' => true,
		'calexitwiki' => true,
	),

	'wgMSU_showAutoCat' => array(
		'default' => false,
		'anduinwiki' => true,
	),

	'wgMSU_checkAutoCat' => array(
		'default' => false,
		'anduinwiki' => true,
	),

	'wgMSU_confirmReplace' => array(
		'default' => false,
		'anduinwiki' => true,
	),

	// MultimediaViewer (not beta)
	'wgMediaViewerEnableByDefault' => array(
		'calexitwiki' => true,
		'extloadwiki' => true,
		'grandtheftautowiki' => true,
		'knowledgewiki' => true,
		'thefosterswiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	// MobileFrontend 
	'wgMFNoMobilePages' => array(
		'default' => array(),
		'alwikiwiki' => array(
			'Main Page',
		),
	),
	// Namespaces
	'wgExtraNamespaces' => array(
		'default' => array(),
		'adiapediawiki' => array(
			NS_DICT => 'Dict',
			NS_DICT_TALK => 'Dict_talk',
		),
		'adnovumwiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
			NS_HELP => 'Help',
			NS_HELP_TALK => 'Help_talk',
		),
		'allthetropeswiki' => array(
			NS_TROPEWORKSHOP => 'Trope_Workshop',
			NS_TROPEWORKSHOP_TALK => 'Trope_Workshop_talk',
			NS_REVIEWS => 'Reviews',
			NS_REVIEWS_TALK => 'Reviews_talk',
			NS_FEATURED => 'Featured_Page',
			NS_FEATURED_TALK => 'Featured_Page_talk',
		),
		'bigforestwiki' => array(
			NS_QUIZSET => 'Quizset',
			NS_QUIZSET_TALK => 'Quizset_talk',
			NS_NOTEBOOK => 'Notebook',
			NS_NOTEBOOK_TALK => 'Notebook_talk',
			NS_SOURCE => 'Source',
			NS_SOURCE_TALK => 'Source_talk',
			NS_GAME => 'Game',
			NS_GAME_TALK => 'Game_talk',
			NS_PICTUREBOARD => 'Pictureboard',
			NS_PICTUREBOARD_TALK => 'Pictureboard_talk',
			NS_TINYFOREST => 'Tinyforest',
			NS_TINYFOREST_TALK => 'Tinyforest_talk',
			NS_NEWSLINK => 'Newslink',
			NS_NEWSLINK_TALK => 'Newslink_talk',
		),
		'calexitwiki' => array(
			NS_DRAFT => 'Draft',
			NS_DRAFT_TALK => 'Draft_talk',
			NS_HELP => 'Help',
			NS_HELP_TALK => 'Help_talk',
			NS_HISTORICAL_TIMELINE => 'Historical Timeline',
			NS_OPINION => 'Opinion',
			NS_OPINION_TALK => 'Opinion_talk',
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
			NS_TIMELINE => 'Timeline',
		),
		'catboxwiki' => array(
			NS_COMIC => 'Comic',
			NS_COMIC_TALK => 'Comic_talk'
		),
		'claneuphoriawiki' => array(
			NS_CLAN => 'Clan',
			NS_CLAN_TALK => 'Clan_talk',
		),
		'developmentwiki' => array(
			NS_OFFICIAL => 'Official',
			NS_OFFICIAL_TALK => 'Official_talk',
		),
		'humorpediawiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
			NS_HOWTO => 'Howto',
			NS_HOWTO_TALK => 'Howto_talk',
		),
		'hydrawikiwiki' => array(
			NS_RESEARCH => "Research",
			NS_RESEARCH_TALK => "Research_talk",
			NS_ADMIN => "Admin",
			NS_ADMIN_TALK => "Admin_talk",
			NS_WORKSHOP => "Workshop",
			NS_WORKSHOP_TALK => "Workshop_talk",
			NS_SELP => "Selp",
			NS_SELP_TALK => "Selp_talk",
		),
		'metawiki' => array(
			NS_TECH => 'Tech',
			NS_TECH_TALK => 'Tech_talk'
		),
		'noalatalawiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
		),
		'ratanpirwiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
		),
		'reviwiki' => array(
			NS_SERVER => 'Server',
			NS_SERVER_TALK => 'Server_talk',
		),
		'rpgbrigadewiki' => array(
			NS_VIDEO => 'Video',
			NS_VIDEO_TALK => 'Video_talk',
		),
		'safiriawiki' => array(
			NS_HOENN => 'Hoenn',
			NS_HOENN_TALK => 'Hoenn_talk',
		),
		'studynotekrwiki' => array(
			NS_STUDY_NOTE => 'Study note',
			NS_STUDY_NOTE_TALK => 'Study note_talk',
			NS_EXPLANATION => 'Explanation',
			NS_EXPLANATION_TALK => 'Explanation_talk',
		),
		'thelonsdalebattalionwiki' => array(
			NS_GLOSSARY => 'Glossary',
			NS_GLOSSARY_TALK => 'Glossary_talk',
		),
		'+trexwiki' => array(
			NS_HALAMAN => 'Halaman',
			NS_HALAMAN_TALK => 'Permbicaraan_Halaman',
			NS_ARTIKEL => 'Artikel',
			NS_ARTIKEL_TALK => 'Artikel_talk',
		),
		'tmewiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
			NS_CALL_OF_DUTY => 'Call_of_Duty',
			NS_CALL_OF_DUTY_TALK => 'Call_of_Duty_talk',
			NS_MINECRAFT => 'Minecraft',
			NS_MINECRAFT_TALK => 'Minecraft_talk',
			NS_SUPER_MARIO_LAND_2 => 'Super_Mario_Land_2',
			NS_SUPER_MARIO_LAND_2_TALK => 'Super_Mario_Land_2_talk',
			NS_SUPER_MARIO_WORLD_2 => 'Super_Mario_World_2',
			NS_SUPER_MARIO_WORLD_2_TALK => 'Super_Mario_World_2_talk',
			NS_SUPER_MARIO_BROS => 'Super_Mario_Bros.',
			NS_SUPER_MARIO_BROS_TALK => 'Super_Mario_Bros._talk',
			NS_SUPER_MARIO_ADVANCE => 'Super_Mario_Advance',
			NS_SUPER_MARIO_ADVANCE_TALK => 'Super_Mario_Advance_talk',
			NS_SUPER_MARIO_ADVANCE_2 => 'Super_Mario_Advance_2',
			NS_SUPER_MARIO_ADVANCE_2_TALK => 'Super_Mario_Advance_2_talk',
			NS_SUPER_MARIO_ADVANCE_3 => 'Super_Mario_Advance_3',
			NS_SUPER_MARIO_ADVANCE_3_TALK => 'Super_Mario_Advance_3_talk',
			NS_SUPER_MARIO_ADVANCE_4 => 'Super_Mario_Advance_4',
			NS_SUPER_MARIO_ADVANCE_4_TALK => 'Super_Mario_Advance_4_talk',
			NS_THE_LEGEND_OF_ZELDA => 'The_Legend_of_Zelda',
			NS_THE_LEGEND_OF_ZELDA_TALK => 'The_Legend_of_Zelda_talk',
			NS_CIVILIZATION_IV => 'Civilization_IV',
			NS_CIVILIZATION_IV_TALK => 'Civilization_IV_talk',
			NS_DRAFT => 'Draft',
			NS_DRAFT_TALK => 'Draft_talk',
			NS_OFFICIAL => 'Official',
			NS_OFFICIAL_TALK => 'Official_talk',
		),
		'uwswiki' => array(
 		 	NS_WNS2 => 'WNS2',
  		 	NS_WNS2_TALK => 'WNS2_talk',
  		),
		'wisdomwikiwiki' => array(
			NS_LCS	=> 'LCS',
			NS_LCS_TALK => 'LCS_talk',
			NS_MEDI => 'Medi',
			NS_MEDI_TALK => 'Medi_talk',
			NS_LIBRARY => 'Library',
			NS_LIBRARY_TALK => 'Library_talk',
			NS_TEACHING => 'Teaching',
			NS_TEACHING_TALK => 'Teaching_talk',
			NS_BLANK => 'Blank',
			NS_BLANK_TALK => 'Blank_talk',
		),
		'wisdomsandboxwiki' => array(
			NS_TEST	=> 'TEST',
			NS_TEST_TALK => 'TEST_talk',
		),
		'whentheycrywiki' => array(
			NS_SPRITES => 'Sprites',
			NS_SPRITES_TALK => 'Sprites_talk',
			NS_GALLERY => 'Gallery',
			NS_GALLERY_TALK => 'Gallery_talk',
		),
	),
	'wgContentNamespaces' => array(
		'default' => array( NS_MAIN ),
		'+calexitwiki' => array( NS_OPINION, NS_TIMELINE, NS_HISTORICAL_TIMELINE ),
		'+catboxwiki' => array( NS_COMIC ),
		'+reviwiki' => array( NS_SERVER ),
		'+safiriawiki' => array( NS_HOENN ),
		'+tmewiki' => array( NS_CALL_OF_DUTY, NS_MINECRAFT, NS_SUPER_MARIO_LAND_2, NS_SUPER_MARIO_WORLD_2, NS_SUPER_MARIO_BROS, NS_SUPER_MARIO_ADVANCE_2, NS_SUPER_MARIO_ADVANCE_3, NS_SUPER_MARIO_ADVANCE_4, NS_THE_LEGEND_OF_ZELDA, NS_CIVILIZATION_IV ),
	),
	'wgMetaNamespace' => array(
		'default' => null,
		'calexitwiki' => 'CalExit_Wiki',
		'jawp2chwiki' => 'まとめwiki',
		'tmewiki' => 'TME',
	),
	'+wgNamespaceAliases' => array(
		'default' => array(),
		'+adnovumwiki' => array(
			'ARP' => NS_PROJECT,
			'ARP_talk' => NS_PROJECT_TALK,
			'H' => NS_HELP,
			'H_talk' => NS_HELP_TALK,
		),
		'+allthetropeswiki' => array(
			'ATT' => NS_PROJECT,
			'ATT_talk' => NS_PROJECT_TALK,
			'YKTTW' => NS_TROPEWORKSHOP,
			'YKTTW_talk' => NS_TROPEWORKSHOP_TALK,
			'Blurb' => NS_FEATURED,
			'Blurb_talk' => NS_FEATURED_TALK,
		),
		'+bigforestwiki' => array(
			'사' => NS_USER,
			'큰' => NS_PROJECT,
			'Temp' => NS_TEMPLATE,
			'퀴즈' => NS_QUIZSET,
			'공책' => NS_NOTEBOOK,
			'책' => NS_SOURCE,
			'게임' => NS_GAME,
			'그림판' => NS_PICTUREBOARD,
			'작은숲' => NS_TINYFOREST,
			"토" => NS_TALK,
			"사토" => NS_USER_TALK,
			"숲" => NS_PROJECT,
			"큰숲" => NS_PROJECT,
			"숲토" => NS_PROJECT_TALK,
			"파" => NS_FILE,
			"틀토" => NS_TEMPLATE_TALK,
			"분" => NS_CATEGORY,
			"분토" => NS_CATEGORY_TALK,
			"뉴스" => NS_NEWSLINK,
		),
		'+humorpediawiki' => array(
			'HP' => NS_PROJECT,
			'HP_talk' => NS_PROJECT_TALK,
		),
		'+studynotekrwiki' => array(
			'KSN' => NS_KOREAN_STUDY_NOTE,
			'KSN_TALK' => NS_KOREAN_STUDY_NOTE_TALK,
		),
		'+tmewiki' => array(
			'The_Multilingual_Encyclopedia' => NS_PROJECT,
			'The_Multilingual_Encyclopedia_talk' => NS_PROJECT_TALK,
			'Bestand' => NS_FILE,
			'Fichier' => NS_FILE,
			'Categorie' => NS_CATEGORY,
			'Catégorie' => NS_CATEGORY,
			'Categoría' => NS_CATEGORY,
			'Archivo' => NS_FILE,
			'Módulo' => WMG_NS_MODULE,
			'Especial' => NS_SPECIAL,
			'Espesyal' => NS_SPECIAL,
			'Specialaĵo' => NS_SPECIAL,
			'Specialis' => NS_SPECIAL,
			'Категория' => NS_CATEGORY,
			'Портал' => NS_PORTAL,
			'Служебная' => NS_SPECIAL,
			'Kuva' => NS_FILE,
			'Luokka' => NS_CATEGORY,
			'Dosiero' => NS_FILE,
			'Kategorio' => NS_CATEGORY,
			'Файл' => NS_FILE,
			'Modèle' => NS_TEMPLATE,
			'Aide' => NS_HELP,
			'Plik' => NS_FILE,
			'Kategoria' => NS_CATEGORY,
			'Specjalna' => NS_SPECIAL,
			'Szablon' => NS_TEMPLATE,
			'Pomoc' => NS_HELP,
			'Moduł' => WMG_NS_MODULE,
			'Datei' => NS_FILE,
			'Fil' => NS_FILE,
			'Skabelon' => NS_TEMPLATE,
			'Kategori' => NS_CATEGORY,
			'Predefinição' => NS_TEMPLATE,
			'Imagem' => NS_IMAGE,
			'画像' => NS_FILE,
			'Kategorie' => NS_CATEGORY,
			'Kategoriebespreking' => NS_CATEGORY_TALK,
			'Lêer' => NS_FILE,
			'Lêerbespreking' => NS_FILE_TALK,
		),
	),
	'+wgNamespaceProtection' => array(
		'default' => array(),
		'+nenawikiwiki' => array(
			NS_MAIN => array(
				'edit-admin-pages',
			),
			NS_USER => array(
				'edit-content-pages',
			),
			NS_PROJECT => array(
				'edit-content-pages',
			),
			NS_FILE => array(
				'edit-content-pages',
			),
			NS_TEMPLATE => array(
				'edit-content-pages',
			),
			NS_HELP => array(
				'edit-admin-pages',
			),
			NS_CATEGORY => array(
				'edit-admin-pages',
			),
		),
		'+yeoksawiki' => array(
			NS_PROJECT => array(
				'project-edit',
			),
		),
	),
	'+wgNamespacesToBeSearchedDefault' => array(
		'default' => array(),
		'+metawiki' => array(
			NS_TECH => true,
		),
		'+thelonsdalebattalionwiki' => array(
			NS_GLOSSARY => true,
		),
	),
	'+wgNamespacesWithSubpages' => array(
		'default' => array(),
		'+adnovumwiki' => array(
			NS_MAIN => true,
			NS_USER => true,
			NS_TEMPLATE => true,
			NS_PORTAL => true,
			NS_HELP => true,
		),
		'+allthetropeswiki' => array(
			NS_MAIN => true,
			NS_TROPEWORKSHOP => true,
		),
		'+caeruleawiki' => array(
			NS_MAIN => true,
		),
		'+calexitwiki' => array(
			NS_DRAFT => true,
			NS_HELP => true,
			NS_HISTORICAL_TIMELINE => true,
			NS_MAIN => true,
			NS_OPINION => true,
			NS_PORTAL => true,
			NS_TEMPLATE => true,
			NS_TIMELINE => true,
			NS_USER => true,
		),
		'+catboxwiki' => array(
			NS_MAIN => true,
			NS_COMIC => true,
			NS_OFFICIAL => true,
			NS_TEMPLATE => true,
		),
		'+christipediawiki' => array(
			NS_MAIN => true,
		),
		'+clementsworldbuildingwiki' => array(
			NS_MAIN => true,
		),
		'+cnvwiki' => array(
			NS_MAIN => true,
		),
		'+eotewiki' => array(
			NS_MAIN => true,
		),
		'+hobbieswiki' => array(
			NS_MAIN => true,
		),
		'+humorpediawiki' => array(
			NS_MAIN => true,
			NS_TALK => true,
			NS_USER => true,
			NS_USER_TALK => true,
			NS_PROJECT => true,
			NS_PROJECT_TALK => true,
			NS_FILE => true,
			NS_FILE_TALK => true,
			NS_MEDIAWIKI => true,
			NS_MEDIAWIKI_TALK => true,
			NS_TEMPLATE => true,
			NS_TEMPLATE_TALK => true,
			NS_HELP => true,
			NS_HELP_TALK => true,
			NS_CATEGORY => true,
			NS_CATEGORY_TALK => true,
		),
		'+ictjudikaturawiki' => array(
			NS_MAIN => true,
		),
		'+janesskillspackwiki' => array(
			NS_MAIN => true,
			NS_USER => true,
			NS_PROJECT => true,
		),
		'+jawp2chwiki' => array(
			NS_TEMPLATE => true,
		),
		'+metawiki' => array(
			NS_MAIN => true,
			NS_TECH => true,
		),
		'+partupwiki' => array(
			NS_MAIN => true,
		),
		'+raymanspeedrunwiki' => array(
			NS_MAIN => true,
		),
		'+reviwiki' => array(
			NS_MAIN => true,
			NS_SERVER => true,
		),
		'+safiriawiki' => array(
			NS_MAIN => true,
			NS_HOENN => true,
		),
		'+sidemwiki' => array(
			NS_MAIN => true,
			NS_USER => true,
		),
		'+tmewiki' => array(
			NS_MAIN => true,
			NS_USER => true,
			NS_PROJECT => true,
			NS_TEMPLATE => true,
			NS_PORTAL => true,
			NS_CALL_OF_DUTY => true,
		),
		'+unikumwiki' => array(
			NS_MAIN => true,
		),
		'+wisdomwikiwiki' => array(
			NS_MAIN => true,
			NS_LCS => true,
			NS_LIBRARY => true,
			NS_TEACHING => true,
		),
		'+wisdomsandboxwiki' => array(
			NS_MAIN => true,
			NS_TEST => true,
		),
	),

	// OATHAuth
	'wgOATHAuthDatabase' => array(
		'default' => 'centralauth',
	),

	// OAuth
	'wgMWOAuthCentralWiki' => array(
		'default' => 'metawiki',
	),
	'wgMWOAuthSharedUserSource' => array(
		'default' => 'CentralAuth',
	),
	'wgMWOAuthSecureTokenTransfer' => array(
		'default' => true,
	),

	// Pagelang
	'wgPageLanguageUseDB' => array(
		'default' => false,
		'spiralwiki' => true,
	),

	//PageTriage
	'wgPageTriageInfinitScrolling' => array(
		'default' => true,
	),

	// Permissions
	'wgAddGroups' => array(
		'default' => array(
			'bureaucrat' => array(
				'bot',
				'bureaucrat',
				'sysop',
			),
			'sysop' => array(
				'autopatrolled',
				'confirmed',
				'rollbacker',
			),
		),
		'+allthetropeswiki' => array(
			'sysop' => array(
				'commentadmin',
			),
		),
		'+applebranchwiki' => array(
			'sysop' => array(
				'commentadmin',
				'staff',
				'reviewer',
			),
		),
		'+applewikiwiki' => array(
			'sysop' => array(
				'commentadmin',
				'staff',
				'reviewer',
			),
		),
		'+animationmoviewikiwiki' => array(
			'sysop' => array(
				'commentadmin',
			),
		),
		'+bigforestwiki' => array(
			'bureaucrat' => array(
				'confirmed',
				'voter',
				'judge',
			),
			'judge' => array(
				'confirmed',
				'autopatrolled',
				'voter',
			),
			'sysop' => array(
				'voter',
			),
		),
		'+cssandjsschoolboardwiki' => array(
			'Founder' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
			),
		),
		'+developmentwiki' => array(
			'supervisor' => array(
				'bureaucrat',
				'sysop',
				'trusted',
				'interfaceeditor'
			),
			'wikifounder' => array(
				'supervisor',
				'bureaucrat',
				'sysop',
				'trusted',
				'interfaceeditor'
			),
		),
		'+dokumenwiki' => array(
			'bureaucrat' => array(
				'member',
			),
		),
		'+dpwiki' => array(
			'bureaucrat' => array(
				'respected',
			),
		),
		'+jayuwikiwiki' => array(
			'bureaucrat' => array(
				'voter',
			),
			'sysop' => array(
				'commentadmin',
			),
		),
		'+nenawikiwiki' => array(
			'sysop' => array(
				'editor',
			),
		),
		'+trexwiki' => array(
			'co' => array(
				'ceo',
			),
			'ceo' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
				'sysmag',
				'editors',
				'reviewer',
				'autochecked users',
			),
			'bureaucrat' => array(
				'sysmag',
			),
		),
		'+pruebawiki' => array(
			'sysop' => array(
				'editor',
				'reviewer',
				'testgroup',
			),
			'bureaucrat' => array(
				'bureaucrat',
				'sysop',
				'bot',
				'confirmed',
				'rollbacker',
				'autopatrolled',
				'editor',
				'reviewer',
				'testgroup',
			),
			'consul' => array(
				'bot',
				'consul',
				'bureaucrat',
				'testgroup',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
				'editor',
				'reviewer',
				'epcoordinator',
				'epinstructor',
				'epcampus',
				'eponline',
			),
		),
		'+quantumwiki' => array(
			'Founder' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
			),
		),
		'+robertswiki' => array(
			'sysop' => array(
				'bot',
			),
			'staff' => array(
				'bureaucrat',
				'staff',
			),
		),
		'+testwiki' => array(
			'bureaucrat' => array(
				'testgroup',
				'bureaucrat',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
			'consul' => array(
				'bot',
				'bureaucrat',
				'consul',
				'testgroup',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
		),
		'snowthegamewiki' => array(
			'bureaucrat' => array(
				'bot',
				'bureaucrat',
				'sysop',
			),
		),
		'+sovereignwiki' => array(
			'bureaucrat' => array(
				'officer',
				'game-master',
				'sysop',
				'bureaucrat',
				'rollbacker',
				'autopatrolled',
				'confirmed',
			),
		),
		'+studynotekrwiki' => array(
			'sysop' => array(
				'voter',
			),
			'bureaucrat' => array(
				'sysop',
				'voter',
				'bot',
				'autopatrolled'
			),
		),
		'+westmarcheswiki' => array(
			'sysop' => array(
				'gamemasters',
				'loremasters',
			),
		),
		'+wikidolphinhansenwiki' => array(
			'sysop' => array(
				'commentadmin',
			),
		),
	),
	'+wgGroupPermissions' => array(
		'default' => array(
			'*' => array(
				'abusefilter-log' => true,
				'abusefilter-log-detail' => true,
				'abusefilter-view' => true,
				'centralauth-autoaccount' => true,
				'oathauth-enable' => false, // does this work?
			),
			'autopatrolled' => array(
				'autopatrol' => true,
				'patrol' => true,
				'skipcaptcha' => true,
			),
			'autoconfirmed' => array(
				'mwoauthproposeconsumer' => true,
				'mwoauthupdateownconsumer' => true,
				'skipcaptcha' => true,
			),
			'bureaucrat' => array(
				'renameuser' => false,
				'userrights' => false,
			),
			'confirmed' => array(
				'editsemiprotected' => true,
				'patrol' => true,
				'skipcaptcha' => true,
			),
			'oversight' => array(
				'abusefilter-hidden-log' => true,
				'abusefilter-hide-log' => true,
				'browsearchive' => true,
				'deletedhistory' => true,
				'deletedtext' => true,
				'deletelogentry' => true,
				'deleterevision' => true,
				'hideuser' => true,
				'suppressionlog' => true,
				'suppressrevision' => true,
			),
			'rollbacker' => array(
				'rollback' => true,
			),
			'sysop' => array(
				'abusefilter-modify' => true,
				'abusefilter-modify-restricted' => true,
				'abusefilter-revert' => true,
				'deletelogentry' => true,
				'deleterevision' => true,
				'rollback' => true,
			),
			'user' => array(
				'user' => true, // for "Allow logged in users" protection level
			),
			'steward' => array(
				'userrights' => true,
			),
		),
		'+allbanks2wiki' => array(
			'autoconfirmed' => array(
				'edit' => false,
				'createpage' => false,
			),
			'confirmed' => array(
				'edit' => false,
				'createpage' => false,
			),
		),
		'+allthetropeswiki' => array(
			'sysop' => array(
				'editothersprofiles' => true,
			),
		),
		'+applebranchwiki' => array(
			'user' => array(
				'upload_by_url' => true,
			),
		),
		'+applewikiwiki' => array(
			'user' => array(
				'upload_by_url' => true,
			),
		),
		'+bigforestwiki' => array(
			'autoconfirmed' => array(
				'rollback' => true,
				'move' => true,
				'movefile' => true,
				'upload' => true,
			),
			'bureaucrat' => array(
				'block' => true,
				'unblockself' => true,
			),
			'confirmed' => array(
				'rollback' => true,
				'move' => true,
				'movefile' => true,
				'upload' => true,
			),
			'judge' => array(
				'editvoter' => true,
				'ipblock-exempt' => true,
				'blockemail' => true,
				'block' => true,
				'unblockself' => true,
				'editusercss' => true,
				'edituserjs' => true,
				'patrol' => true,
				'autopatrolled' => true,
				'delete' => true,
				'deleterevision' => true,
				'undelete' => true,
				'browsearchive' => true,
				'deletedtext' => true,
				'managechangetags' => true,
				'tboverride' => true,
				'abusefilter-view-private' => true,
				'abusefilter-log-private' => true,
				'protect' => true,
				'spamblacklistlog' => true,
				'titleblacklistlog' => true,
				'unwatchedpages' => true,
				'rollback' => true,
				'proxyunbannable' => true,
				'override-antispoof' => true,
				'deletelogentry' => true,
				'editprotected' => true,
				'editsemiprotected' => true,
			),
			'sysop' => array(
				'editvoter' => true,
			),
			'user' => array(
				'editmycss' => true,
				'editmyjs' => true,
				'writeapi' => true,
			),
			'voter' => array(
				'editvoter' => true,
			),
		),
		'+bitcoindebateswiki' => array(
			'emailconfirmed' => array(
				'read' => true,
				'edit' => true,
				'createpage' => true,
			),
		),
		'+brynda1231wiki' => array(
			'sysop' => array(
				'createpage' => true,
			),
		),
		'+catboxwiki' => array(
			'user' => array(
				'upload_by_url' => true,
			),
		),
		'+cssandjsschoolboardwiki' => array(
			'Founder' => array(
				'read' => true,
			),
		),
		'+cpiwiki' => array(
			'sysop' => array(
				'masseditregex'
			),
		),
		'+developmentwiki' => array(
			'steward' => array(
				'wikifounder' => true,
				'supervisor' => true,
				'bureaucrat' => true,
			),
			'trusted' => array(
				'editsemiprotected' => true,
				'autoconfirmed' => true,
				'skipcaptcha' => true,
				'autopatrol' => true,
				'patrol' => true,
				'block' => true,
				'protect' => true,
				'delete' => true,
				'move' => true,
			),
			'supervisor' => array(
				'blockemail' => true,
				'block' => true,
				'ipblock-exempt' => true,
				'proxyunbannable' => true,
				'protect' => true,
				'managechangetags' => true,
				'createaccount' => true,
				'flow-delete' => true,
				'deletelogentry' => true,
				'deleterevision' => true,
				'delete' => true,
				'globalblock-whitelist' => true,
				'flow-edit-post' => true,
				'editusercss' => true,
				'edituserjs' => true,
				'editprotected' => true,
				'editsemiprotected' => true,
				'editinterface' => true,
				'autopatrol' => true,
				'importupload' => true,
				'import' => true,
				'flow-lock' => true,
				'patrol' => true,
				'markbotedits' => true,
				'nuke' => true,
				'mergehistory' => true,
				'abusefilter-modify' => true,
				'abusefilter-modify-restricted' => true,
				'move-categorypages' => true,
				'movefile' => true,
				'move' => true,
				'move-subpages' => true,
				'move-rootuserpages' => true,
				'autoconfirmed' => true,
				'noratelimit' => true,
				'suppressredirect' => true,
				'reupload-shared' => true,
				'override-antispoof' => true,
				'tboverride' => true,
				'reupload' => true,
				'skipcaptcha' => true,
				'rollback' => true,
				'abusefilter-revert' => true,
				'browsearchive' => true,
				'massmessage' => true,
				'unblockself' => true,
				'undelete' => true,
				'upload' => true,
				'apihighlimits' => true,
				'mf-uploadbutton' => true,
				'unwatchedpages' => true,
				'deletedhistory' => true,
				'deletedtext' => true,
				'spamblacklistlog' => true,
				'titleblacklistlog' => true,
				'supervisor' => true,
			),
			'bureaucrat' => array(
				'bureaucrat' => true,
			),
			'wikifounder' => array(
				'wikifounder' => true,
			),
			'interfaceeditor' => array(
				'editprotected' => true,
				'editsemiprotected' => true,
				'editinterface' => true,
			),
		),
		'+deltaquadtestwiki' => array(
			'bureaucrat' => array(
				'commentadmin' => true,
				'author' => true,
				'authorprotect' => true,
				'torunblock' => true,
			),
		),
		'+dpwiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
				'respected' => true,
			),
			'respected' => array(
				'respected' => true,
			),
		),
		'+intpwiki' => array(
			'sysop' => array(
				'createpage' => true,
			),
		),
		'+isvwiki' => array(
			'user' => array(
				'editmyusercss' => true,
				'editmyuserjs' => true,
			),
			'autoconfirmed' => array(
				'move' => true,
			),
			'bot' => array(
				'autoreview' => true,
			),
			'autopatrolled' => array(
				'autoreview' => true,
			),
			'confirmed' => array(
				'autoconfirmed' => true,
				'autoreview' => true,
				'review' => true,
				'unreviewedpages' => true,
				'movefile' => true,
				'move-categorypages' => true,
				'move-subpages' => true,
			),
		),
		'+jayuwikiwiki' => array(
			'autoconfirmed' => array(
				'move' => true,
				'move-subpages' => true,
				'move-categorypages' => true,
				'movefile' => true,
				'move-rootuserpages' => true,
				'upload' => true,
				'reupload-shared' => true,
			),
			'confirmed' => array(
				'move' => true,
				'move-subpages' => true,
				'move-categorypages' => true,
				'movefile' => true,
				'move-rootuserpages' => true,
				'upload' => true,
				'reupload-shared' => true,
			),
			'sysop' => array(
				'commentadmin' => true,
				'editvoter' => true,
			),
			'voter' => array(
				'delete' => true,
				'browsearchive' => true,
				'deleterevision' => true,
				'deletedtext' => true,
				'editvoter' => true,
				'suppressredirect' => true,
				'voter' => true,
				'autopatrol' => true,
				'patrol' => true,
				'skipcaptcha' => true,
				'editsemiprotected' => true,
				'rollback' => true,
			),
		),
		'+kstartupswiki' => array(
			'autoconfirmed' => array(
				'createpage' => true,
				'createtalk' => true,
				'edit' => true,
			),
			'bot' => array(
				'createpage' => true,
				'createtalk' => true,
				'edit' => true,
			),
			'bureaucrat' => array(
				'createpage' => true,
				'createtalk' => true,
				'edit' => true,
			),
			'sysop' => array(
				'createpage' => true,
				'createtalk' => true,
				'edit' => true,
			),
			'user' => array(
				'createtalk' => true,
				'edit' => true,
			),
		),
		'+metawiki' => array(
			'autoconfirmed' => array(
				'move' => true,
				'createpage' => true,
			),
			'confirmed' => array(
				'move' => true,
				'createpage' => true,
			),
			'cvt' => array(
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'globalblock' => true,
			),
			'steward' => array(
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'centralauth-oversight' => true,
				'centralauth-rename' => true,
				'centralauth-unmerge' => true,
				'createwiki' => true,
				'managewiki' => true,
				'managewiki-restricted' => true,
				'noratelimit' => true,
				'userrights' => true,
				'userrights-interwiki' => true,
			),
			'sysop' => array(
				'interwiki' => true,
				'oathauth-enable' => true,
			),
			'wikicreator' => array(
				'createwiki' => true,
			),
		),
		'+nenawikiwiki' => array(
			'editor' => array(
				'createpage' => true,
				'move' => true,
				'move-subpages' => true,
				'move-rootuserpages' => true,
				'movefile' => true,
				'writeapi' => true,
				'upload' => true,
				'reupload' => true,
				'reupload-shared' => true,
				'minoredit' => true,
				'purge' => true,
				'edit-content-pages' => true,
			),
			'sysop' => array(
				'edit-content-pages' => true,
				'edit-admin-pages' => true,
			),
		),
		'+pgnwikiwiki' => array(
			'sysop' => array(
				'commentadmin' => true,
			),
		),
		'+plazmaburstwiki' => array(
			'sysop' => array(
				'commentadmin' => true,
			),
		),
		'+poserdazfreebieswiki' => array(
			'autoconfirmed' => array(
				'edit' => true,
				'createpage' => true,
			),
			'confirmed' => array(
				'edit' => true,
				'createpage' => true,
			),
		),
		'+pruebawiki' => array(
			'autopatrolled' => array(
				'patrol' => true,
				'autopatrol' => true,
				'autoreview' => true,
				'skipcaptcha' => true,
			),
			'bureaucrat' => array(
				'bureaucrat' => true,
				'nuke' => true,
				'editinterface' => true,
				'globalblock-whitelist' => true,
			),
			'consul' => array(
				'read' => true,
				'nuke' => true,
				'bureaucrat' => true,
				'consul' => true,
				'editinterface' => true,
				'autoreview' => true,
				'review' => true,
				'validate' => true,
				'stablesettings' => true,
				'ipblock-exempt' => true,
				'torunblocked' => true,
			),
			'testgroup' => array(
				'read' => true,
			),
		),
		'+pso2wiki' => array(
 			'sysop' => array(
 				'unreviewedpages' => true,
 			),
 		),
		'+robertswiki' => array(
			'bureaucrat' => array(
				'nuke' => true,
				'abusefilter-modify-restricted' => true,
				'abusefilter-revert' => true,
				'globalblock-whitelist' => true,
			),
			'staff' => array(
				'protectsite' => true,
				'editstaff' => true,
			),
		),
		'+sovereignwiki' => array(
			'officer' => array(
				'read' => true,
				'officer' => true,
			),
			'game-master' => array(
				'read' => true,
				'game-master' => true,
			),
		),
		'+sthomaspriwiki' => array(
			'bureaucrat' => array(
				'block' => true,
				'blockemail' => true,
			),
		),
		'+swisscomraidwiki' => array(
			'emailconfirmed' => array(
				'read' => true,
				'edit' => true,
				'createpage' => true,
			),
		),
		'+quantumwiki' => array(
			'Founder' => array(
				'read' => true,
			),
		),
		'+studynotekrwiki' => array(
			'voter' => array(
				'rollback' => true,
				'editsemiprotected' => true,
				'patrol' => true,
				'skipcpatcha' => true,
				'voter' => true,
			),
			'sysop' => array(
				'commentadmin' => true,
			),
		),
		'+spiralwiki' => array(
			'sysop' => array(
				'pagelang' => true,
			),
		),
		'+takethatwikiwiki' => array(
			'sysop' => array(
				'commentadmin' => true,
			),
		),
		'+testwiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
				'nuke' => true,
				'editinterface' => true,
				'globalblock-whitelist' => true,
			),
			'consul' => array(
				'read' => true,
				'bureaucrat' => true,
				'consul' => true,
				'editinterface' => true,
			),
			'testgroup' => array(
				'read' => true,
			),
		),
		'+trexwiki' => array(
			'co' => array(
				'co' => true,
				'ceo' => true,
				'reviewer' => true,
				'protect' => true,
			),
			'ceo' => array(
				'ceo' => true,
				'blockemail' => true,
				'block' => true,
				'ipblock-exempt' => true,
				'proxyunbannable' => true,
				'protect' => true,
				'managechangetags' => true,
				'createaccount' => true,
				'flow-delete' => true,
				'deletelogentry' => true,
				'deleterevision' => true,
				'delete' => true,
				'globalblock-whitelist' => true,
				'flow-edit-post' => true,
				'editusercss' => true,
				'edituserjs' => true,
				'editprotected' => true,
				'editsemiprotected' => true,
				'editinterface' => true,
				'autopatrol' => true,
				'importupload' => true,
				'import' => true,
				'flow-lock' => true,
				'patrol' => true,
				'markbotedits' => true,
				'nuke' => true,
				'mergehistory' => true,
				'abusefilter-modify' => true,
				'abusefilter-modify-restricted' => true,
				'move-categorypages' => true,
				'movefile' => true,
				'move' => true,
				'move-subpages' => true,
				'move-rootuserpages' => true,
				'autoconfirmed' => true,
				'noratelimit' => true,
				'suppressredirect' => true,
				'reupload-shared' => true,
				'override-antispoof' => true,
				'tboverride' => true,
				'reupload' => true,
				'skipcaptcha' => true,
				'rollback' => true,
				'abusefilter-revert' => true,
				'browsearchive' => true,
				'massmessage' => true,
				'unblockself' => true,
				'undelete' => true,
				'upload' => true,
				'apihighlimits' => true,
				'mf-uploadbutton' => true,
				'unwatchedpages' => true,
				'deletedhistory' => true,
				'deletedtext' => true,
				'spamblacklistlog' => true,
				'titleblacklistlog' => true,
				'validate' => true,
				'autoreview' => true,
				'autochecked users' => true,
				'editors' => true,
			),
			'bureaucrat' => array(
				'bureaucrat' => true,
				'nuke' => true,
				'movefile' => true,
				'blockemail' => true,
			),
			'sysmag' => array(
				'autoreview' => true,
				'autoconfirmed' => true,
				'autopatrolled' => true,
				'editinterface' => true,
			),
		),
		'+westmarcheswiki' => array(
			'gamemasters' => array(
				'read' => true,
				'edit' => true,
				'gamemasters' => true,
			),
			'loremasters' => array(
				'read' => true,
				'edit' => true,
				'loremasters' => true,
			),
		),
		'+wikipucwiki' => array(
			'*' => array(
				'ajaxpoll-vote' => true,
				'ajaxpoll-view-results' => true,
				'voteny' => true,
				'upload' => true,
			),
		),
		'+yeoksawiki' => array(
			'sysop' => array(
				'project-edit' => true,
			),
		),
	),
	'wgGroupsRemoveFromSelf' => array(
		'default' => array(),
		'+robertswiki' => array(
			'sysop' => array(
				'sysop',
			),
		),
	),
	'wgRemoveGroups' => array(
		'default' => array(
			'bureaucrat' => array(
				'bot',
				'sysop',
			),
			'sysop' => array(
				'autopatrolled',
				'confirmed',
				'rollbacker',
			),
		),
		'+allthetropeswiki' => array(
			'sysop' => array(
				'commentadmin',
			),
		),
		'+applebranchwiki' => array(
			'sysop' => array(
				'commentadmin',
				'staff',
				'reviewer',
			),
		),
		'+applewikiwiki' => array(
			'sysop' => array(
				'commentadmin',
				'staff',
				'reviewer',
			),
		),
		'+bigforestwiki' => array(
			'bureaucrat' => array(
				'confirmed',
				'voter',
				'judge',
				'bureaucrat',
			),
			'judge' => array(
				'confirmed',
				'autopatrolled',
				'sysop',
				'judge',
				'voter',
				'bureaucrat',
			),
			'sysop' => array(
				'voter',
			),
		),
		'+cssandjsschoolboardwiki' => array(
			'Founder' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
			),
		),
		'+developmentwiki' => array(
			'supervisor' => array(
				'bureaucrat',
				'sysop',
				'trusted',
				'interfaceeditor'
			),
			'wikifounder' => array(
				'supervisor',
				'bureaucrat',
				'sysop',
				'trusted',
				'interfaceeditor'
			),
		),
		'+dokumenwiki' => array(
			'bureaucrat' => array(
				'member',
			),
		),
		'+dpwiki' => array(
			'bureaucrat' => array(
				'respected',
			),
		),
		'+jayuwikiwiki' => array(
			'bureaucrat' => array(
				'voter',
			),
			'sysop' => array(
				'commentadmin',
			),
		),
		'+pruebawiki' => array(
			'sysop' => array(
				'editor',
				'reviewer',
				'testgroup',
			),
			'bureaucrat' => array(
				'sysop',
				'bot',
				'confirmed',
				'rollbacker',
				'autopatrolled',
				'editor',
				'reviewer',
				'testgroup',
			),
			'consul' => array(
				'bot',
				'bureaucrat',
				'testgroup',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
				'editor',
				'reviewer',
				'epcoordinator',
				'epinstructor',
				'epcampus',
				'eponline',
			),
		),
		'+quantumwiki' => array(
			'Founder' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
			),
		),
		'+robertswiki' => array(
			'sysop' => array(
				'bot',
			),
			'staff' => array(
				'bureaucrat',
				'staff',
			),
		),
		'+testwiki' => array(
			'bureaucrat' => array(
				'testgroup',
				'bot',
			),
			'consul' => array(
				'bot',
				'bureaucrat',
				'testgroup',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
		),
		'+trexwiki' => array(
			'co' => array(
				'ceo',
			),
			'ceo' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
				'sysmag',
				'editors',
				'reviewer',
				'autochecked users',
			),
			'bureaucrat' => array(
				'sysmag',
			),
		),
		'+sovereignwiki' => array(
			'bureaucrat' => array(
				'officer',
				'game-master',
				'sysop',
				'bureaucrat',
				'rollbacker',
				'autopatrolled',
				'confirmed',
			),
		),
		'studynotekrwiki' => array(
			'sysop' => array(
				'voter'
			),
			'bureaucrat' => array(
				'sysop',
				'voter',
				'bot',
				'autopatrolled',
			),
		),
		'+wikidolphinhansenwiki' => array(
			'sysop' => array(
				'commentadmin',
			),
		),
	),
	'wgRevokePermissions' => array(
		'default' => array(),
		'loginwiki' => array(
			'*' => array(
				'edit' => true,
			),
		),
		'testwiki' => array(
			'sysop' => array(
				# 'nuke' => true, // done in overrides at end of file
				# 'editinterface' => true, //mistakenly applies to other groups as well
			),
		),
	),
	'wgAutopromote' => array(
		'default' => array(
			'autoconfirmed' => array(
				"&",
				array( APCOND_EDITCOUNT, &$wgAutoConfirmCount ),
				array( APCOND_AGE, &$wgAutoConfirmAge ),
			),
		),
		'+bitcoindebateswiki' => array(
			'emailconfirmed' => array(
				APCOND_EMAILCONFIRMED,
			),
		),
	),
	'wgImplicitGroups' => array(
		'default' => array( '*', 'user', 'autoconfirmed' ),
		'bitcoindebateswiki' => array( '*', 'user', 'autoconfirmed', 'emailconfirmed' ),
	),
	
	// Piwik settings
	'wmgPiwikSiteID' => array(
		'default' => '1',
		'allthetropeswiki' => '2',
	),

	// RelatedArticles settings
	'wgRelatedArticlesLoggingSamplingRate' => array(
	 	'default' => false,
	 	'allthetropeswiki' => '0.01',
	 	'calexitwiki' => '0.01',
	 	'extloadwiki' => '0.01',
	 	'youtubewiki' => '0.01',
	 ),
	 'wgRelatedArticlesShowReadMore' => array(
	 	'default' => false,
	 	'allthetropeswiki' => true,
		'calexitwiki' => true,
	 	'extloadwiki' => true,
	 	'youtubewiki' => true,
	 ),
	 'wgRelatedArticlesShowInFooter' => array(
	 	'default' => false,
	 	'allthetropeswiki' => true,
		'calexitwiki' => true,
	 	'extloadwiki' => true,
	 	'youtubewiki' => true,
	 ),

	// Restriction types
	'+wgRestrictionLevels' => array(
		'default' => array(
			'user',
		),
		'+bigforestwiki' => array(
			'editvoter',
		),
		'+dpwiki' => array(
			'bureaucrat',
			'respected',
		),
		'+testwiki' => array(
			'bureaucrat',
			'consul',
		),
		'+developmentwiki' => array(
			'bureaucrat',
			'supervisor',
			'wikifounder',
		),
		'+jayuwikiwiki' => array(
			'editvoter',
		),
		'+pruebawiki' => array(
			'bureaucrat',
			'consul',
		),
		'+robertswiki' => array(
			'editstaff',
		),
		'+sovereignwiki' => array(
			'officer',
			'game-master',
		),
		'+studynotekrwiki' => array(
			'voter',
		),
		'+trexwiki' => array(
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		),
		'+westmarcheswiki' => array(
			'gamemasters',
			'loremasters',
		),
	),

	'+wgRestrictionTypes' => array(
		'default' => array(
			'delete',
		),
		'pruebawiki' => array(
			'delete',
			'protect',
		),
	),
	
	// Robot policy
	'wgDefaultRobotPolicy' => array(
		'default' => 'index,follow',
		'lothuialethwiki' => 'noindex,nofollow',
	),

	// RSS Settings
	'wgRSSCacheAge' => array(
		'default' => '3600'
	),
	'wgRSSProxy' => array(
		'default' => false,
	),
	'wgRSSDateDefaultFormat' => array(
		'default' => 'Y-m-d H:i:s'
	),

	// Scribunto
	'wgCodeEditorEnableCore' => array(
		'default' => true,
	),
	'wgScribuntoUseCodeEditor' => array(
		'default' => true,
	),

	// Server
	'wgArticlePath' => array(
		'default' => '/wiki/$1',
	),
	'wgDisableOutputCompression' => array(
		'default' => true,
	),
	'wgScriptExtension' => array(
		'default' => '.php',
	),
	'wgScriptPath' => array(
		'default' => '/w',
	),
	'wgServer' => array(
		'default' => 'https://$lang.miraheze.org',
		'aenasanwiki' => 'https://wiki.aenasan.com',
		'aksaraywikiwiki' => 'https://www.aksaraywiki.com',
		'allthetropeswiki' => 'https://allthetropes.org',
		'alwikiwiki' => 'https://alwiki.net',
		'amaninfowiki' => 'https://aman.info.tm',
		'antiguabarbudacalypsowiki' => 'https://antiguabarbudacalypso.com',
		'bettermediawiki' => 'https://bettermedia.info',
		'bootleggedwiki' => 'https://bootlegged.questionable.photography',
		'changemyorgwiki' => 'https://changemy.org',
		'denverkrwiki' => 'https://wiki.denverkr.cf',
		'disabledlifewiki' => 'https://disabled.life',
		'dottorcontewiki' => 'https://wiki.dottorconte.eu',
		'drones4allwiki' => 'https://wiki.drones4nature.info',
		'dwplivewiki' => 'https://wiki.dwplive.com',
		'espiralwiki' => 'https://espiral.org',
		'evelopediawiki' => 'https://evelopedia.tk',
		'fibromyalgiaengineerwiki' => 'https://fibromyalgia-engineer.com',
		'gamdugwiki' => 'https://gamdug.tk',
		'garyjohnsonmeetupswiki' => 'https://wiki.garyjohnsonmeetups.com',
		'grottocenterwiki' => 'https://wiki.grottocenter.org',
		'ircwiki' => 'https://ircwiki.cf',
		'jacksonheightswiki' => 'https://wiki.jacksonheights.nyc',
		'kstartupswiki' => 'https://wiki.besuccess.com',
		'labbywiki' => 'https://wiki.labby.io',
		'livesnowmapwiki' => 'https://wiki.livesnowmap.com', 
		'make717wiki' => 'https://wiki.make717.org',
		'meeusenwiki' => 'https://wiki.meeusen.net',
		'metatrekwiki' => 'https://meta.trek.tk',
		'nenawikiwiki' => 'https://nenawiki.org',
		'nextlevelwikiwiki' => 'https://wiki.lbcomms.co.za',
		'openonderwijswiki' => 'https://www.openonderwijs.org',
		'oyeavdelingenwiki' => 'https://oyeavdelingen.org',
		'permanentfuturelabwiki' => 'https://permanentfuturelab.wiki',
		'pruebawiki' => 'https://es.publictestwiki.com',
		'testwiki' => 'https://publictestwiki.com',
		'reviwiki' => 'https://private.revi.wiki',
		'reviwikiwiki' => 'https://reviwiki.info',
		'rizalespewiki' => 'https://wiki.rizalespe.com',
		'savagewikiwiki' => 'https://savage-wiki.com',
		'speleowiki' => 'https://speleo.wiki',
		'spiralwiki' => 'https://spiral.wiki',
		'takethatwikiwiki' => 'https://takethatwiki.com',
		'teessidehackspacewiki' => 'https://wiki.teessidehackspace.org.uk',
		'thelonsdalebattalionwiki' => 'https://thelonsdalebattalion.co.uk',
		'valentinaprojectwiki' => 'https://wiki.valentinaproject.org',
		'wikiescolawiki' => 'https://wikiescola.com.br',
		'wikikaisagawiki' => 'https://wiki.kaisaga.com',
		'wikiletraswiki' => 'https://www.wikiletras.tk',
		'wikiparkinsonwiki' => 'https://wikiparkinson.org',
		'wikipucwiki' => 'https://wikipuk.cl',
		'wisdomwikiwiki' => 'https://wisdomwiki.org',
		'wisdomsandboxwiki' => 'https://sandbox.wisdomwiki.org',
		'wishcertwiki' => 'https://histories.wiki',
		'zenbuddhismwiki' => 'https://www.zenbuddhism.info',
	),
	'wgShowHostnames' => array(
		'default' => true,
	),
	'wgUsePathInfo' => array(
		'default' => true,
	),

	// SiteMatrix
	'wgSiteMatrixPrivateSites' => array(
		'default' => "/srv/mediawiki/dblist/private.dblist",
	),
	'wgSiteMatrixClosedSites' => array(
		'default' => "/srv/mediawiki/dblist/closed.dblist",
	),
	'wgSiteMatrixSites' => array(
		'default' => array(),
	),

	// SiteNotice
	'wgDismissableSiteNoticeForAnons' => array(
		'default' => true,
	),
	
	// SocialProfile
	'wgUserProfileThresholds' => array(
		'default' => array(
			'edits' => 0,
		),
		'allthetropes' => array(
			'edits' => 10,
		),
	),

	// Statistics
	'wgArticleCountMethod' => array(
		'default' => 'link', // To update it, you will need to run the maintenance/updateArticleCount.php script
		'fourleafficswiki' => 'any',
		'lothuialethwiki' => 'any',
	),

	// Squid (aka Varnish)
	'wgUseSquid' => array(
		'default' => true,
	),
	'wgSquidServers' => array(
		'default' => array( '81.4.124.61:81', '107.191.126.23:81' ),
	),

	// Style
	'wgAllowUserCss' => array(
		'default' => true,
	),
	'wgAllowUserJs' => array(
		'default' => true,
	),
	'wgAppleTouchIcon' => array(
		'default' => '/apple-touch-icon.png',
		'applewikiwiki' => "//$wmgUploadHostname/applewikiwiki/8/89/Facveicon.ICO",
		'applebranchwiki' => "//$wmgUploadHostname/applebranchwiki/e/ee/AppleBranch_Icon.png",
		'kstartupswiki' => "//$wmgUploadHostname/kstartupswiki/6/64/Favicon.ico",
	),
	'wgCentralAuthLoginIcon' => array(
		'default' => '/usr/share/nginx/favicons/default.ico',
	),
	'wgDefaultSkin' => array(
		'default' => 'vector',
		'3dicwiki' => 'foreground',
		'applebranchwiki' => 'refreshed',
		'applewikiwiki' => 'refreshed',
		'bdorpwiki' => 'erudite',
		'claneuphoriawiki' => 'gamepress',
		'cybercrimewiki' => 'modern',
		'datachronwiki' => 'erudite',
		'dtswiki' => 'metrolook',
		'godaigowiki' => 'monobook',
		'ganeshawiki' => 'monobook',
		'ofthevampirewiki' => 'dusktodawn',
		'ontariobrasswiki' => 'monobook',
		'permanentfuturelabwiki' => 'foreground',
		'raymanspeedrunwiki' => 'bootstrapmediawiki',
		'revitwiki' => 'monobook',
		'thelonsdalebattalionwiki' => 'metrolook',
	),
	'wgFavicon' => array(
		'default' => '/favicon.ico',
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/6/64/Favicon.ico",
		'absurdopediawiki' => "//$wmgUploadHostname/absurdopediawiki/6/64/Favicon.ico",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/b/be/APfavicon.png",
		'adiaprojectwiki' => "//$wmgUploadHostname/adiaprojectwiki/9/91/Adiafavicon.png",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/8/84/Rainbowstar.png",
		'allbanks2wiki' => "//$wmgUploadHostname/allbanks2wiki/7/7f/AllBanks2Logo.png",
		'aenasanwiki' => "//$wmgUploadHostname/aenasanwiki/e/e6/AEfav.ico",
		'aidorupediawiki' => "//$wmgUploadHostname/aidorupediawiki/3/33/Idolsonawikiico.png",
		'alternatehistorywiki' => "//$wmgUploadHostname/alternatehistorywiki/6/64/Favicon.ico",
		'alwikiwiki' => "//$wmgUploadHostname/alwikiwiki/5/59/ALWikiFavicon.ico",
		'amaninfowiki' => "//$wmgUploadHostname/amaninfowiki/6/64/Favicon.ico",
		'animationmoviewikiwiki' => "//$wmgUploadHostname/animationmoviewikiwiki/7/7f/Favicon-20170311123705233.ico",
		'anothertimeline2120wiki' => "//$wmgUploadHostname/anothertimeline2120wiki/6/64/Favicon.ico",
		'applewikiwiki' => "//$wmgUploadHostname/applewikiwiki/8/89/Facveicon.ICO",
		'applebranchwiki' => "//$wmgUploadHostname/applebranchwiki/e/ee/AppleBranch_Icon.png",
		'assaultandroidcactuswiki' => "//$wmgUploadHostname/assaultandroidcactuswiki/6/64/Favicon.ico",
		'astrowiki' => "//$wmgUploadHostname/astrowiki/6/64/Favicon.ico",
		'bchwiki' => "//$wmgUploadHostname/bchwiki/c/c0/Logo_135.png",
		'bdorpwiki' => "//$wmgUploadHostname/bdorpwiki/3/3b/Favicongif.gif",
		'betapurplewiki' => "//$wmgUploadHostname/betapurplewiki/6/64/Favicon.ico",
		'bgowiki' => "//$wmgUploadHostname/bgowiki/6/64/Favicon.ico",
		'bigforestwiki' => "//$wmgUploadHostname/bigforestwiki/d/d2/Favicon_SeongJjinDoe_v2.png",
		'bzdetopediawiki' => "//$wmgUploadHostname/bzdetopediawiki/6/64/Favicon.ico",
		'calexitwiki' => "//$wmgUploadHostname/calexitwiki/6/6a/Cali_flag_favicon.ico",
		'carvingwiki' => "//$wmgUploadHostname/carvingwiki/6/64/Favicon.ico",
		'changemyorgwiki' => "//$wmgUploadHostname/changemyorgwiki/6/64/Favicon.ico",
		'christipediawiki' => "//$wmgUploadHostname/christipediawiki/e/e7/Logo_Christipedia.jpg",
		'claneuphoriawiki' => "//$wmgUploadHostname/claneuphoriawiki/6/64/Favicon.ico",
		'clementsworldbuildingwiki' => "//$wmgUploadHostname/clementsworldbuildingwiki/8/8b/CW_favicon.ico",
		'cnvwiki' => "//$wmgUploadHostname/cnvwiki/6/64/Favicon.ico",
		'coldbloodedwiki' => "//$wmgUploadHostname/coldbloodedwiki/6/64/Favicon.ico",
		'compilerdevwiki' => "//$wmgUploadHostname/compilerdevwiki/c/c9/Logo.png",
		'cosiadventurewiki' => "//$wmgUploadHostname/cosiadventurewiki/3/3b/Wiki_logo.png",
		'crankipediawiki' => "//$wmgUploadHostname/crankipediawiki/4/4c/Crankilogo.png",
		'cssandjsschoolboardwiki' => '//upload.wikimedia.org/wikipedia/commons/2/2b/Page_css_48.png',
		'datachronwiki' => "//$wmgUploadHostname/datachronwiki/f/f3/1408002974_WS.png",
		'diavwiki' => "//$wmgUploadHostname/diavwiki/6/64/Favicon.ico",
		'dditecwiki' => "//$wmgUploadHostname/dditecwiki/8/87/Ddu_logo.png",
		'doinwiki' => "//$wmgUploadHostname/doinwiki/6/64/Favicon.ico",
		'doraemonwiki' => "//$wmgUploadHostname/doraemonwiki/2/2f/Favicon-doraemonwiki.ico",
		'drones4allwiki' => "//$wmgUploadHostname/drones4allwiki/2/26/Favicon.png",
		'dwplivewiki' => "//$wmgUploadHostname/dwplivewiki/6/64/Favicon.ico",
		'emulationwiki' => "//$wmgUploadHostname/emulationwiki/6/60/Wiki_favicon.png",
		'enmarchewiki' => "//$wmgUploadHostname/enmarchewiki/d/d8/LogoEM32x32transparency.png",
		'eternalconfictwiki' => "//$wmgUploadHostname/eternalconfictwiki/a/a9/AD_new_logo4.png",
		'etpowiki' => "//$wmgUploadHostname/etpowiki/1/1f/FaviconETPO.gif",
		'evawiki' => "//$wmgUploadHostname/evawiki/6/64/Favicon.ico",
		'evelopediawiki' => "//$wmgUploadHostname/evelopediawiki/6/64/Favicon.ico",
		'fbwikiwiki' => "//$wmgUploadHostname/fbwikiwiki/4/4c/Fbwiki_favicon.ico",
		'fmbvwiki' => "//$wmgUploadHostname/fmbvwiki/0/06/Fmbvfavicon.png",
		'forexwiki' => "//$wmgUploadHostname/forexwiki/6/64/Favicon.ico",
		'freecollegeprojectwiki' => "//$wmgUploadHostname/freecollegeprojectwiki/1/18/FreeCollegeProject.ico",
		'freestateofjoneswiki' => "//$wmgUploadHostname/freestateofjoneswiki/d/d4/Free_State_of_Jones_Seal.png",
		'genwiki' => "//$wmgUploadHostname/genwiki/6/64/Favicon.ico",
		'geodatawiki' => "//$wmgUploadHostname/geodatawiki/6/64/Favicon.ico",
		'grandtheftautowiki' => "//$wmgUploadHostname/grandtheftautowiki/c/c7/GrandTheftAutoFavicon.png",
		'grottocenterwiki' => "//$wmgUploadHostname/grottocenterwiki/6/64/Favicon.ico",
		'hamfemwiki' => "//$wmgUploadHostname/hamfemwiki/c/c5/Favicon-16x16.png",
		'hktransportpediawiki' => "//$wmgUploadHostname/hktransportpediawiki/e/ee/Favicon-20170319060448889.ico",
		'houseofettlingarfreyuwiki' => "//$wmgUploadHostname/houseofettlingarfreyuwiki/7/70/Shield_Arms_House_Ettlingar_Freyu.png",
		'humorpediawiki' => "//$wmgUploadHostname/humorpediawiki/6/64/Favicon.ico",
		'icmscholarswiki' => "//$wmgUploadHostname/icmscholarswiki/6/69/Logo135px.png",
		'imperiuswiki' => "//$wmgUploadHostname/imperiuswiki/b/b2/ImperiusFavicon.ico",
		'isvwiki' => "//$wmgUploadHostname/isvwiki/5/53/Med%C5%BEuviki-favicon.ico",
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/3/35/Favicon_%282%29.ico",
		'jacksonheightswiki' => "//$wmgUploadHostname/jacksonheightswiki/0/0d/JH-wiki-2.ico",
		'jawp2chwiki' => "//$wmgUploadHostname/jawp2chwiki/f/f4/Jawp2ch_favicon.ico",
		'karniarutheniawiki' => "//$wmgUploadHostname/karniarutheniawiki/1/17/Krlogo.png",
		'kkandpwiki' => "//$wmgUploadHostname/kkandpwiki/c/ca/Favicon1-1024x1024.png",
		'kstartupswiki' => "//$wmgUploadHostname/kstartupswiki/6/64/Favicon.ico",
		'lanstationwiki' => "//$wmgUploadHostname//lanstationwiki/9/9b/Miniianfav.png",
		'lexiquewiki' => "//$wmgUploadHostname/lexiquewiki/0/0f/Lexique_favicon.ico",
		'luckandlogicwiki' => "//$wmgUploadHostname/luckandlogicwiki/2/26/Favicon.png",
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
		'modularwiki' => "//$wmgUploadHostname/modularwiki/6/64/Favicon.ico",
		'natenwiki' => "//$wmgUploadHostname/natenwiki/c/c9/Logo.png",
		'nationsglorywiki' => "//$wmgUploadHostname/nationsglorywiki/0/04/NationsGlory.png",
		'nenawikiwiki' => "//$wmgUploadHostname/nenawikiwiki/f/fa/Nena911orange.ico",
		'newcolumbiawiki' => "//$wmgUploadHostname/newcolumbiawiki/5/5b/Wiki-favicon.png",
		'nonbinarywiki' => "//$wmgUploadHostname/nonbinarywiki/5/53/Wikiicon.ico",
		'nutscriptwiki' => "//$wmgUploadHostname/nutscriptwiki/6/64/Favicon.ico",
		'nxwikiwiki' => "//$wmgUploadHostname/nxwikiwiki/9/9b/Nxlogo.png",
		'thoughtonomywikiwiki' => "//$wmgUploadHostname/thoughtonomywikiwiki/2/26/Favicon.png",
		'omniversaliswiki' => "//$wmgUploadHostname/omniversaliswiki/d/db/Omniversalis_Icon.ico",
		'oneagencydunedinwiki' => "//$wmgUploadHostname/oneagencydunedinwiki/d/de/OneAgency_Favicon.png",
		'openonderwijswiki' => "//$wmgUploadHostname/openonderwijswiki/c/ca/Ooo_logo_square_favicon.svg",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'openkorebrasilwikiwiki' => "//$wmgUploadHostname/openkorebrasilwikiwiki/3/35/WikiLogo.png",
		'overonwiki' => "//$wmgUploadHostname/overonwiki/2/2e/Overon_Logo.svg",
		'paranormalwiki' => "//$wmgUploadHostname/paranormalwiki/2/2d/PW.ico",
		'particracywikiwiki' => "//$wmgUploadHostname/particracywikiwiki/6/64/Favicon.ico",
		'partupwiki' => "//$wmgUploadHostname/partupwiki/6/64/Favicon.ico",
		'patch153wiki' => "//$wmgUploadHostname/patch153wiki/1/1f/ICMS.png",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/6/64/Favicon.ico",
		'pfsolutionswiki' => "//$wmgUploadHostname/pfsolutionswiki/0/0f/PF_Solutions_Icon.ico",
		'plasmawiki' => "//$wmgUploadHostname/plasmawiki/e/e3/PlasmaWiki_Favicon.ico",
		'pocketmonsterswiki' => "//$wmgUploadHostname/pocketmonsterswiki/d/d2/PMFavicon.png",
		'pluspiwiki' => "//$wmgUploadHostname/pluspiwiki/6/64/Favicon.ico",
		'raymanspeedrunwiki' => "//$wmgUploadHostname/raymanspeedrunwiki/0/08/Rayman_Speedrun_Wiki_Favicon.png",
		'rpgbrigadewiki' => "//$wmgUploadHostname/rpgbrigadewiki/6/64/Favicon.ico",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/f/fc/Safiria_wiki_favicon.png",
		'saliorpediawiki' => "//$wmgUploadHostname/saliorpediawiki/a/ac/Favicon-1.png",
		'savagewikiwiki' => "//$wmgUploadHostname/savagewikiwiki/6/64/Favicon.ico",
		'scruffywiki' => "//$wmgUploadHostname/scruffywiki/6/64/Favicon.ico",
		'sfrepresentuswiki' => "//$wmgUploadHostname/sfrepresentuswiki/5/5c/Favicon_logo.png",
		'shadawiki' => "//$wmgUploadHostname/shadawiki/c/c4/SHA_Favicon.svg",
		'shippingandmetawiki' => "//$wmgUploadHostname/shippingandmetawiki/6/64/Favicon.ico",
		'sidemwiki' => "//$wmgUploadHostname/sidemwiki/7/76/Sidem-favicon.ico",
		'sikhwikitestwiki' => "//$wmgUploadHostname/sikhwikitestwiki/9/97/Cover_The_Purpose_of_Your_Life_cropped.jpg",
		'sirikotwiki' => '//sirikot.com/favicon.png',
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'speleowiki' => "//$wmgUploadHostname/speleowiki/6/64/Favicon.ico",
		'sqlserverwiki' => "//$wmgUploadHostname/sqlserverwiki/6/64/Favicon.ico",
		'starsetonlinewiki' => "//$wmgUploadHostname/starsetonlinewiki/9/93/Wiki_favicon.ico",
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/9/93/Scwiki-favicon.png",
		'sysexwiki' => "//$wmgUploadHostname/sysexwiki/1/1d/Sysex.ico",
		'takethatwikiwiki' => "//$wmgUploadHostname/takethatwikiwiki/6/64/Favicon.ico",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/6/64/Favicon.ico",
		'teessidehackspacewiki' => "//$wmgUploadHostname/teessidehackspacewiki/6/64/Favicon.ico",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/7/7f/Teleslogosmoler.png",
		'texwikiwiki' => "//$wmgUploadHostname/texwikiwiki/2/26/Favicon.png",
		'thecscwiki' => "//$wmgUploadHostname/thecscwiki/0/0d/Csc_favicon.png",
		'thelonsdalebattalionwiki' => "//$wmgUploadHostname/thelonsdalebattalionwiki/2/21/SoldiersFavicon.png",
		'themfbclubwiki' => "//$wmgUploadHostname/themfbclubwiki/6/64/Favicon.ico",
		'titreprovisoirewiki' => "//$wmgUploadHostname/titreprovisoirewiki/0/01/Favicon_titrepro.png",
		'trumpwiki' => "//$wmgUploadHostname/trumpwiki/a/a9/T-cartoon-face.ico",
		'twswiki' => "//$wmgUploadHostname/twswiki/3/34/Tws-favicon.png",
		'tymyrddinwiki' => "//$wmgUploadHostname/tymyrddinwiki/6/63/Ty-myrddin-favicon.ico",
		'ubuntuwiki' => "//$wmgUploadHostname/ubuntuwiki/1/11/UbuntuWiki.png",
		'universebuildwiki' => "//$wmgUploadHostname/universebuildwiki/f/fd/UniversebuildFavicon.png",
		'valentinaprojectwiki' => "//$wmgUploadHostname/valentinaprojectwiki/1/1d/Valentina_logo_favicon.png",
		'wdbwiki' => "//$wmgUploadHostname/wdbwiki/2/26/Dancing-135px.png",
		'welcomewikiwiki' => "//$wmgUploadHostname/welcomewikiwiki/6/69/20150913_WelcomeWiki-Logo_Favicon32x32.png",
		'webflowwiki' => "//$wmgUploadHostname/webflowwiki/6/64/Favicon.ico",
		'wikibookswiki' => "//$wmgUploadHostname/wikibookswiki/6/60/Wiki_favicon.png",
		'wikicervanteswiki' => "//$wmgUploadHostname/wikicervanteswiki/0/08/FaviconCervantes.ico",
		'wikidolphinhansenwiki' => "//$wmgUploadHostname/wikidolphinhansenwiki/b/bf/Dolphin-icon-150.png",
		"wikiletraswiki" => "//$wmgUploadHostname/wikiletraswiki/2/26/Favicon.png",
		'wikipucwiki' => "//$wmgUploadHostname/wikipucwiki/2/26/Favicon.png",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/6/64/Favicon.ico",
		'wisdomsandboxwiki' => "//$wmgUploadHostname/wisdomsandboxwiki/6/64/Favicon.ico",
	),
	'wgLogo' => array(
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
		'690squadronwiki' => "//$wmgUploadHostname/690squadronwiki/f/f4/Squadlogo.png",
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/3/3b/Wiki_logo.png",
		'aacenterpriselearningwiki' => "//$wmgUploadHostname/aacenterpriselearningwiki/c/c6/AACLogo.jpg",
		'absurdopediawiki' => "//$wmgUploadHostname/absurdopediawiki/b/bc/Wiki.png",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/f/f1/APlogo.png",
		'adiaprojectwiki' => "//$wmgUploadHostname/adiaprojectwiki/8/8b/Adialogo.png",
		'adnovumwiki' => "//$wmgUploadHostname/adnovumwiki/f/fa/AdnovumRPtemplogo.png",
		'aenasanwiki' => "//$wmgUploadHostname/aenasanwiki/f/f1/AEicon1.png",
		'airwiki' => "//$wmgUploadHostname/airwiki/8/8e/Logo-scadta-133x133.gif",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/3/33/Logo-amafuwa.png",
		'aleenghawiki' => "//$wmgUploadHostname/aleenghawiki/c/c7/Aleen-gha_d20_Logo.jpg",
		'algopediawiki' => "//$wmgUploadHostname/algopediawiki/8/88/Algopedia-logo135px.png",
		'alternatehistorywiki' => "//$wmgUploadHostname/alternatehistorywiki/b/bc/Wiki.png",
		'allbanks2wiki' => "//$wmgUploadHostname/allbanks2wiki/7/7f/AllBanks2Logo.png",
		'allthetropeswiki' => "//$wmgUploadHostname/allthetropeswiki/8/86/Logo-Square-v1-1x.png",
		'alternatehistory' => "//$wmgUploadHostname/alternatehistorywiki/b/bc/Wiki.png",
		'alwikiwiki' => "//$wmgUploadHostname/alwikiwiki/3/35/WikiLogo.png",
		'amaninfowiki' => "//$wmgUploadHostname/amaninfowiki/c/c9/Logo.png",
		'animationmoviewikiwiki' => "//$wmgUploadHostname/animationmoviewikiwiki/b/bd/Fdg.PNG",
		'anothertimeline2120wiki' => "//$wmgUploadHostname/anothertimeline2120wiki/3/3b/Wiki_logo.png",
		'applebranchwiki' => "//$wmgUploadHostname/applebranchwiki/0/03/AppleBranch_135.png",
		'applewikiwiki' => "//$wmgUploadHostname/applewikiwiki/c/c9/AppleWikilogo.PNG",
		'arefepvawiki' => "//$wmgUploadHostname/arefepvawiki/9/92/Logoaf.png",
		'assaultandroidcactuswiki' => "//$wmgUploadHostname/assaultandroidcactuswiki/7/7b/Cactus_icon.png",
		'astrowiki' => "//$wmgUploadHostname/astrowiki/6/6c/Astromagicka_logo.png",
		'anuwiki' => "//$wmgUploadHostname/anuwiki/8/8e/Anuwikilogo.png",
		'avionwiki' => "//$wmgUploadHostname/avionwiki/3/31/Argis_Wiki_Logo.png",
		'ayrshirewiki' => "//$wmgUploadHostname/ayrshirewiki/b/bc/Wiki.png",
		'bakufuwiki' => "//$wmgUploadHostname/bakufuwiki/b/bc/Wiki.png",
		'ballaratpubswiki' => "//$wmgUploadHostname/ballaratpubswiki/4/42/Hotels_of_Ballarat_logo.jpg",
		'bchwiki' => "//$wmgUploadHostname/bchwiki/c/c0/Logo_135.png",
		'bdorpwiki' => "//$wmgUploadHostname/bdorpwiki/2/22/Main_page.PNG",
		'beatstationwiki' => "//$wmgUploadHostname/beatstationwiki/d/da/Wiki_logo2.png",
		'berlinowiki' => "//$wmgUploadHostname/berlinowiki/thumb/b/be/Berlino_new_logo.png/253px-Berlino_new_logo.png",
		'betapurplewiki' => "//$wmgUploadHostname/betapurplewiki/0/0e/BetaPurpleLogo.png",
		'biblicalwikiwiki' => "//$wmgUploadHostname/biblicalwikiwiki/e/e2/WikiLogo.svg",
		'bigforestwiki' => "//$wmgUploadHostname/bigforestwiki/f/f0/Logo_Candidate.png",
		'bloodstainedwiki' => "//$wmgUploadHostname/bloodstainedwiki/7/71/Logo_Icon.png",
		'bootstrappingwiki' => "//$wmgUploadHostname/bootstrappingwiki/f/fd/Bootstrapping.png",
		'bqwiki' => "//$wmgUploadHostname/bqwiki/6/6d/Bq-wiki.svg",
		'breedersofthenephelymwiki' => "//$wmgUploadHostname/breedersofthenephelymwiki/4/49/WindowsIcon.png",
		'burnoutwiki' => "//$wmgUploadHostname/burnoutwiki/0/0b/BURNOUTWIKI_LOGO_135px.png",
		'bzdetopediawiki' => "//$wmgUploadHostname/bzdetopediawiki/b/bc/Wiki.png",
		'calexitwiki' => "//$wmgUploadHostname/calexitwiki/a/ab/Cali-bear-geog-black-small.png",
		'carelliwiki' => "//$wmgUploadHostname/carelliwiki/9/9c/Logo-carelli.png",
		'carvingwiki' => "//$wmgUploadHostname/carvingwiki/5/59/Snowflake135.png",
		'centriswiki' => "//$wmgUploadHostname/centriswiki/8/86/Logo_da_Wiki_-_simples.png",
		'changemyorgwiki' => "//$wmgUploadHostname/changemyorgwiki/2/2c/ChangeMyOrgUpdatedLogo.png",
		'christipediawiki' => "//$wmgUploadHostname/christipediawiki/e/e7/Logo_Christipedia.jpg",
		'chromiumrosewiki' => "//$wmgUploadHostname/chromiumrosewiki/b/ba/ChromiumRose135x135.png",
		'clementsworldbuildingwiki' => "//$wmgUploadHostname/clementsworldbuildingwiki/3/39/Cw_logo.png",
		'cnvwiki' => "//$wmgUploadHostname/cnvwiki/b/bc/Wiki.png",
		'coldbloodedwiki' => "//$wmgUploadHostname/coldbloodedwiki/1/12/WikiLogo_135.png",
		'collabvmwiki' => "//$wmgUploadHostname/collabvmwiki/c/c9/Logo.png",
		'compilerdevwiki' => "//$wmgUploadHostname/compilerdevwiki/c/c9/Logo.png",
		'conuconwiki' => "//phabricator.miraheze.org/file/data/o6plmtjp4afd6vvxcx2m/PHID-FILE-fzbuutpmykupn5jz256h/CONUCON_small_face.png",
		'cosiadventurewiki' => "//$wmgUploadHostname/cosiadventurewiki/3/3b/Wiki_logo.png",
		'cpiwiki' => "//$wmgUploadHostname/cpiwiki/0/01/CPI_Alpha_DS_2_160px.png",
		'cssandjsschoolboardwiki' => "//upload.wikimedia.org/wikipedia/commons/c/c7/Css.png",
		'crankipediawiki' => "//$wmgUploadHostname/crankipediawiki/4/4c/Crankilogo.png",
		'cvmlabwiki' => "//$wmgUploadHostname/cvmlabwiki/3/3b/Wiki_logo.png",
		'czechpolicywiki' => "//$wmgUploadHostname/czechpolicywiki/2/20/Plain_logo.png",
		'datachronwiki' => "//$wmgUploadHostname/datachronwiki/f/f3/1408002974_WS.png",
		'dcrzonewiki' => "//$wmgUploadHostname/dcrzonewiki/4/4b/Wikilogo.png",
		'dditecwiki' => "//$wmgUploadHostname/dditecwiki/8/87/Ddu_logo.png",
		'decisorwiki' => "//$wmgUploadHostname/decisorwiki/8/87/DECISOR135x135.png",
		'dicficwiki' => "//$wmgUploadHostname/dicficwiki/b/b1/Dicfic-logo.png",
		'diggywikipolskawiki' => "//$wmgUploadHostname/diggywikipolskawiki/8/81/Logodiggy.png",
		'doinwiki' => "//$wmgUploadHostname/doinwiki/6/60/Wiki_Logo.png",
		'doraemonwiki' => "//$wmgUploadHostname/doraemonwiki/8/8b/D2.png",
		'drones4allwiki' => "//$wmgUploadHostname/drones4allwiki/6/60/Wiki_Logo.png",
		'dsiguidewiki' => "//$wmgUploadHostname/dsiguidewiki/1/13/Wikilogod.jpg",
		'dwplivewiki' => "//$wmgUploadHostname/dwplivewiki/c/c0/Logo_135.png",
		'emulationwiki' => "//$wmgUploadHostname/emulationwiki/3/3b/Wiki_logo.png",
		'embobadawiki' => "//$wmgUploadHostname/embobadawiki/3/35/Tof.png",
		'enmarchewiki' => "//$wmgUploadHostname/enmarchewiki/a/af/Logo-em-alsace68.png",
		'eotewiki' => "//$wmgUploadHostname/eotewiki/6/64/Logo_triumph.png",
		'esctwiki' => "//$wmgUploadHostname/esctwiki/d/d9/Heart.png",
		'espiralwiki' => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Spiral_project_logo.svg/135px-Spiral_project_logo.svg.png',
		'eternalconfictwiki' => "//$wmgUploadHostname/eternalconfictwiki/a/a9/AD_new_logo4.png",
		'etpowiki' => "//$wmgUploadHostname/etpowiki/1/1f/LogoETPO.gif",
		'evawiki' => "//$wmgUploadHostname/evawiki/e/ec/EVA-Wiki.png",
		'exercicesdefrancaisprodfrwiki' => "//$wmgUploadHostname/exercicesdefrancaisprodfrwiki/c/c4/Logo_Exercices.jpeg",
		'fablabesdswiki' => "//$wmgUploadHostname/fablabesdswiki/3/3c/CFDS_Logo.svg",
		'fbwikiwiki' => "//$wmgUploadHostname/fbwikiwiki/thumb/4/4a/Fbwiki_logo.png/135px-Fbwiki_logo.png",
		'fieldresearchwiki' => "//$wmgUploadHostname/fieldresearchwiki/d/d1/Logo_c.jpg",
		'fifamwiki' => "//$wmgUploadHostname/fifamwiki/0/0c/Wikilogo_160px.png",
		'fishpercolatorwiki' => "//$wmgUploadHostname/fishpercolatorwiki/d/d2/FPLogo.png",
		'fmbvwiki' => "//$wmgUploadHostname/fmbvwiki/3/33/Fmbvlogo.png",
		'frontdeskswiki' => "//$wmgUploadHostname/frontdeskswiki/b/b3/Fdawikilogo.png",
		'foodsharinghamburgwiki' => "//$wmgUploadHostname/foodsharinghamburgwiki/d/d2/FoodsharingHamburgLogo135px.jpg",
		'forexwiki' => "//$wmgUploadHostname/forexwiki/c/c9/Logo.png",
		'freecollegeprojectwiki' => "//$wmgUploadHostname/freecollegeprojectwiki/6/60/FC_Logo_135p.png",
		'freestateofjoneswiki' => "//$wmgUploadHostname/freestateofjoneswiki/2/29/Free_State_of_Jones_Seal_Logo.png",
		'fusiongpwiki' => "//$wmgUploadHostname/fusiongpwiki/f/f2/Fusion_Ball.png",
		'galenadevwiki' => "//$wmgUploadHostname/galenadevwiki/9/96/Temp_logo1.png",
		'genwiki' => "//$wmgUploadHostname/genwiki/0/03/Genesis-logo-reized.png",
		'geodatawiki' => "//$wmgUploadHostname/geodatawiki/c/c1/GlobeIcon160.png",
		'grandtheftautowiki' => "//$wmgUploadHostname/grandtheftautowiki/9/9e/GrandTheftAuto.png",
		'grottocenterwiki' => "//$wmgUploadHostname/grottocenterwiki/a/ac/Logo_grottocenter.png",
		'gundambiowiki' => "//$wmgUploadHostname/gundambiowiki/b/bc/Wiki.png",
		'hamfemwiki' => "//$wmgUploadHostname/hamfemwiki/3/33/Hamfem-Logo1.jpg",
		'heralwikiawiki' => "//$wmgUploadHostname/heralwikiawiki/c/c9/Logo.png",
		'hktransportpediawiki' => "//$wmgUploadHostname/hktransportpediawiki/6/60/Logo2wiki.PNG",
		'houseofettlingarfreyuwiki' => "//$wmgUploadHostname/houseofettlingarfreyuwiki/7/74/Shield_Arms_House_Ettlingar_Freyu5.png",
		'hshsinfoportalwiki' => "//$wmgUploadHostname/hshsinfoportalwiki/e/ec/HSHS_Logo.jpeg",
		'hsoodenwiki' => "//$wmgUploadHostname/hsoodenwiki/8/82/135px-wiki-logo-blank.png",
		'humorpediawiki' => "//$wmgUploadHostname/humorpediawiki/b/bc/Wiki.png",
		'hydrawikiwiki' => "//$wmgUploadHostname/hydrawikiwiki/7/79/Hydra-logo.png",
		'isvwiki' => "//$wmgUploadHostname/isvwiki/b/bc/Med%C5%BEuviki-logo-latn.svg",
		'jacksonheightswiki' => "//$wmgUploadHostname/jacksonheightswiki/b/b5/Jackson_heights_logo_135_X_135.png",
		'jawp2chwiki' => "//$wmgUploadHostname/jawp2chwiki/b/b1/Jawp2ch_Logo1.svg",
		'jayuwikiwiki' => "//$wmgUploadHostname/jayuwikiwiki/d/d7/Jayuwiki3.png",
		'jokowiki' => "//$wmgUploadHostname/jokowiki/0/0d/Icon_Joko.png",
		'karniarutheniawiki' => "//$wmgUploadHostname/karniarutheniawiki/1/17/Krlogo.png",
		'kkandpwiki' => "//$wmgUploadHostname/kkandpwiki/0/09/Monogram-01.png",
		'kosmopolitikawiki' => "//$wmgUploadHostname/kosmopolitikawiki/d/db/Kosmopolitika's_Rocket_1.3.png",
		'kspancevowiki' => "//$wmgUploadHostname/kspancevowiki/1/1a/Krunamala.png",
		'kstartupswiki' => "//$wmgUploadHostname/kstartupswiki/1/14/Mediawiki-icon-135x135.png",
		'lbsgeswiki' => "//$wmgUploadHostname/lbsgeswiki/0/05/WikiLogo.jpg",
		'lingnlangwiki' => "//wmgUploadHostname/lingnlangwiki/b/bc/Wiki.png",
		'lunfengwiki' => "//$wmgUploadHostname/lunfengwiki/b/bc/Wiki.png",
		'idleomenswiki' => "//$wmgUploadHostname/idleomenswiki/9/9e/IdleOmens-Logo.png",
		'icmscholarswiki' => "//$wmgUploadHostname/icmscholarswiki/6/69/Logo135px.png",
		'imperiuswiki' => "//$wmgUploadHostname/imperiuswiki/9/94/ImperiusLogo.png",
		'integrywiki' => "//$wmgUploadHostname/integrywiki/b/bc/Wiki.png",
		'islamwissenschaftwiki' => "//$wmgUploadHostname/islamwissenschaftwiki/b/bc/Wiki.png",
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/e/eb/IZLogo.png",
		'lanstationwiki' => "//$wmgUploadHostname/lanstationwiki/e/e2/Miniian.png",
		'lexiquewiki' =>  "//$wmgUploadHostname/lexiquewiki/6/6d/LibraryLexique-smallRes.png",
		'lingnlangwiki' => "//$wmgUploadHostname/lingnlangwiki/b/bc/Wiki.png",
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
		'livesnowmapwiki' => "//$wmgUploadHostname/livesnowmapwiki/2/27/Snowflake.png",
		'luckandlogicwiki' => "//$wmgUploadHostname/luckandlogicwiki/2/26/Favicon.png",
		'madgendersciencewiki' => "//$wmgUploadHostname/madgendersciencewiki/1/1f/Mgs_logo.jpg",
		'mafiawiki' => "//$wmgUploadHostname/mafiawiki/a/a6/Header.png",
		'make717wiki' => "//$wmgUploadHostname/make717wiki/thumb/f/fc/Make717_Logo.png/150px-Make717_Logo.png",
		'maiasongcontestwiki' => "//$wmgUploadHostname/maiasongcontestwiki/b/bc/Sitelogo.png",
		'makeiteasyautoswiki' => "//$wmgUploadHostname/makeiteasyautoswiki/0/01/Miea.png",
		'malaysiawiki' => "//$wmgUploadHostname/malaysiawiki/1/1d/Malaysian_flag_round135.png",
		'mcwiki' => "//$wmgUploadHostname/mcwiki/b/bc/Wiki.png",
		'mindgearwiki' => "//$wmgUploadHostname/mindgearwiki/3/36/Mind_Gear.png",
		'mikrodevwiki' => "//$wmgUploadHostname/mikrodevwiki/c/c9/Logo.png",
		'miraewiki' => "//$wmgUploadHostname/miraewiki/2/22/LogoOfMirae.png",
		'modularwiki' => "//$wmgUploadHostname/modularwiki/d/dc/Modular_synth_wiki_logo.png",
		'moralecwiki' => "//$wmgUploadHostname/moralecwiki/e/e8/Moralec-pluto.png",
		'musicarchivewiki' => "//$wmgUploadHostname/musicarchivewiki/d/d4/Logo.jpg",
		'mynimowiki' => "//$wmgUploadHostname/mynimowiki/thumb/7/77/Mynimo_Wiki.png/120px-Mynimo_Wiki.png",
		'natenwiki' => "//$wmgUploadHostname/natenwiki/c/c9/Logo.png",
		'nationsglorywiki' => "//$wmgUploadHostname/nationsglorywiki/2/29/Logo_Wiki.jpg",
		'nenawikiwiki' => "//$wmgUploadHostname/nenawikiwiki/4/4d/NENA_logo_120x100.png",
		'newarkmanorwiki' => "//$wmgUploadHostname/newarkmanorwiki/8/89/Wiki_logo.jpg",
		'newcolumbiawiki' => "//$wmgUploadHostname/newcolumbiawiki/a/a0/Wiki-logo.png",
		'nanopediawiki' => "//$wmgUploadHostname/nanopediawiki/c/c9/Logo.png",
		'nonbinarywiki' => "//$wmgUploadHostname/nonbinarywiki/a/a9/Wikilogo.svg",
		'notezenwiki' => "//$wmgUploadHostname/notezenwiki/c/c9/Logo.png",
		'nutscriptwiki' => "//$wmgUploadHostname/nutscriptwiki/2/26/Nutscript.png",
		'nxwikiwiki' => "//$wmgUploadHostname/nxwikiwiki/9/9b/Nxlogo.png",
		'omniversaliswiki' => "//$wmgUploadHostname/omniversaliswiki/9/95/Omniversalis_Wiki-Logo.png",
		'oneagencydunedinwiki' => "//$wmgUploadHostname/oneagencydunedinwiki/e/eb/OneAgency_WikiLogo_Black.png",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'openkorebrasilwikiwiki' => "//$wmgUploadHostname/openkorebrasilwikiwiki/3/35/WikiLogo.png",
		'openpokewikiwiki' => "//$wmgUploadHostname/openpokewikiwiki/a/a0/Openpokewiki-logo.svg",
		'othermwiki' => "//$wmgUploadHostname/othermwiki/c/c9/Logo.png",
		'overonwiki' => "//$wmgUploadHostname/overonwiki/2/2e/Overon_Logo.svg",
		'oyeavdelingenwiki' => "//$wmgUploadHostname/oyeavdelingenwiki/7/7b/OUS_Logo.png",
		'oneironautwiki' => "//$wmgUploadHostname/oneironautwiki/7/7b/Oneironaut-Wiki-logo.png",
		'paranormalwiki' => "//$wmgUploadHostname/paranormalwiki/2/2d/Parawiki.png",
		'particracywikiwiki' => "//$wmgUploadHostname/particracywikiwiki/6/69/Wiki_logo_parti.png",
		'partupwiki' => "//$wmgUploadHostname/partupwiki/a/a6/Part-up-logo-150x150-mediawiki.png",
		'patch153wiki' => "//$wmgUploadHostname/patch153wiki/1/1f/ICMS.png",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/c/c0/Permanent-Future-Lab-logo-150x150-mediawiki.png",
		'pfsolutionswiki' => "//$wmgUploadHostname/pfsolutionswiki/1/19/Swoosh_-_Transparent.png",
		'pgnwikiwiki' => "//$wmgUploadHostname/pgnwikiwiki/2/22/MainPhotoWiki.png",
		'philmont126wiki' => "//$wmgUploadHostname/philmont126wiki/f/f6/PhilmontLogo.jpg",
		'plasmawiki' => "//$wmgUploadHostname/plasmawiki/0/08/PlasmaWiki_Logo.svg",
		'plazmaburstwiki' => "//$wmgUploadHostname/plazmaburstwiki/6/6f/Plazmaburst-logo.png",
		'pluspiwiki' => "//$wmgUploadHostname/pluspiwiki/b/bd/Pluspi.png",
		'pocketmonsterswiki' => "//$wmgUploadHostname/pocketmonsterswiki/4/47/PMLogo.png",
		'printmakingbewiki' => "//$wmgUploadHostname/printmakingbewiki/2/22/Pmk-logo-wiki-135px.png",
		'priyowiki' => "//$wmgUploadHostname/priyowiki/c/c9/Logo.png",
		'procrastipediawiki' => "//$wmgUploadHostname/procrastipediawiki/1/1e/PCPedia_Logo.png",
		'pruebawiki' => "//$wmgUploadHostname/pruebawiki/7/77/LogoWiki.PNG",
		'raymanspeedrunwiki' => "//$wmgUploadHostname/raymanspeedrunwiki/0/0e/Rayman_Speedrun_Wiki_Logo.png",
		'rebelalliancewiki' => "//$wmgUploadHostname/rebelalliancewiki/f/fe/Logo135.png",
		'reiaasuwiki' => "//$wmgUploadHostname/reiaasuwiki/1/1e/Reiaasu-wiki-logo-1.png",
		'reservedurablewiki' => "//$wmgUploadHostname/reservedurablewiki/3/37/Logo_sustainable_storage_135_pi.png",
		'rpgbrigadewiki' => "//$wmgUploadHostname/rpgbrigadewiki/c/c9/Logo.png",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/2/24/Newcoa_small.png",
		'sapperpediawiki' => "//$wmgUploadHostname/sapperpediawiki/f/f8/Sapperpedia_small.png",
		'saliorpediawiki' => "//$wmgUploadHostname/saliorpediawiki/9/98/BirdRoc.png",
		'savagewikiwiki' => "//$wmgUploadHostname/savagewikiwiki/9/98/Sav_Wiki_logo.jpg",
		'scruffywiki' => "//$wmgUploadHostname/scruffywiki/4/43/Scruffy_logo.png",
		'sfrepresentuswiki' => "//$wmgUploadHostname/sfrepresentuswiki/4/41/RepUsLogo_small.png",
		'shadawiki' => "//$wmgUploadHostname/shadawiki/e/e3/SHA_Wiki_logo.svg",
		'shippingandmetawiki' => "//$wmgUploadHostname/shippingandmetawiki/7/7d/CSM_Logo.png",
		'sidemwiki' => "//$wmgUploadHostname/sidemwiki/a/a5/Sidem-logo.png",
		'sikhwikitestwiki' => "//$wmgUploadHostname/sikhwikitestwiki/b/b5/Cover_The_Purpose_of_Your_Life_LOGO_135x135.png",
		'sirikotwiki' => '//www.sirikot.com/wiki_logo.png',
		'sjuhabitatwiki' => "//$wmgUploadHostname/sjuhabitatwiki/7/7a/Habi_logo_wiki.png",
		'skyfireflyffwiki' => "//$wmgUploadHostname/skyfireflyffwiki/c/c9/Logo.png",
		'smfdoesathingwiki' => "//$wmgUploadHostname/smfdoesathingwiki/b/bc/Wiki.png",
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'sorevivalwiki' => "//$wmgUploadHostname/sorevivalwiki/2/20/System_Overload_Revival_Logo.png",
		'sqlserverwiki' => "//$wmgUploadHostname/sqlserverwiki/d/d4/Logo.jpg",
		'speleowiki' => "//$wmgUploadHostname/speleowiki/c/c3/SpeleoWikiV1.2_135x135.png",
		'spidersilkwiki' => "//$wmgUploadHostname/spidersilkwiki/2/25/Spidersilk-logo.jpg",
		'spiralwiki' => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Spiral_project_logo.svg/135px-Spiral_project_logo.svg.png',
		'starsetonlinewiki' => "//$wmgUploadHostname/starsetonlinewiki/8/89/Wiki_logo.jpg",
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/d/d0/SCLogo2.png",
		'stemorgwiki' => "//$wmgUploadHostname/stemorgwiki/9/90/S.A.I.L._Enhanced.PNG",
		'sterbalfamilyrecipeswiki' => "//$wmgUploadHostname/sterbalfamilyrecipeswiki/c/c4/Logo-135x135.jpg",
		'stormfmwiki' => "//$wmgUploadHostname/stormfmwiki/1/18/Stormlogo_small.png",
		'studynotekrwiki' => "//$wmgUploadHostname/studynotekrwiki/b/b3/Imageedit_6_7597747851.gif",
		'supportdrivenwiki' => "//$wmgUploadHostname/supportdrivenwiki/c/c1/Logo_dark.png",
		'sysexwiki' => "//$wmgUploadHostname/sysexwiki/1/13/Sysex.png",
		'takethatwikiwiki' => "//$wmgUploadHostname/takethatwikiwiki/e/e8/Take_That_Wiki_Logo_Small.png",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/b/bc/Wiki.png",
		'teessidehackspacewiki' => "//$wmgUploadHostname/teessidehackspacewiki/3/34/Teesside-hackspace-logo.svg",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/b/b6/Teleslogo01.png",
		'terriblespacewiki' => "//$wmgUploadHostname/terriblespacewiki/e/eb/Terrible_space_logo.png",
		'testwiki' => "//$wmgUploadHostname/testwiki/9/99/NewLogo.png",
		'texwikiwiki' => "//$wmgUploadHostname/texwikiwiki/3/34/Texwikilogo.png",
		'thecscwiki' => "//$wmgUploadHostname/thecscwiki/5/5d/CSC_logo_final.svg",
		'thefosterswiki' => "//$wmgUploadHostname/thefosterswiki/archive/c/c9/20160726073101%21Logo.png",
		'thelonsdalebattalionwiki' => "//$wmgUploadHostname/thelonsdalebattalionwiki/2/22/SoldiersLogo.png",
		'themfbclubwiki' => "//$wmgUploadHostname/themfbclubwiki/b/bc/Wiki.png",
		'thingexplainerwiki' => "//$wmgUploadHostname/thingexplainerwiki/3/33/Mainpage_logo.png",
		'teireawiki' => "//$wmgUploadHostname/teireawiki/e/e5/Teirea_wiki_logo.png",
		'texwikiwiki' => "//$wmgUploadHostname/texwikiwiki/e/ed/Texwikilogo2.png",
		'titreprovisoirewiki' => "//$wmgUploadHostname/titreprovisoirewiki/d/d4/Logo_titrepro.svg",
		'thoughtonomywikiwiki' => "//$wmgUploadHostname/thoughtonomywikiwiki/8/8c/ThoughtonomyLogo.png",
		'toftcricketclubwiki' => "//$wmgUploadHostname/toftcricketclubwiki/2/23/ToftLogo.png",
		'trainwiki' => "//$wmgUploadHostname/trainwiki/c/ce/Cdwk.png",
		'trexwiki' => "//$wmgUploadHostname/trexwiki/4/49/Wikit.png",
		'trumpwiki' => "//$wmgUploadHostname/trumpwiki/c/c3/Magnifying-logo.jpg",
		'twswiki' => "//$wmgUploadHostname/twswiki/3/34/Tws-favicon.png",
		'tymyrddinwiki' => "//$wmgUploadHostname/tymyrddinwiki/c/c5/Ty-myrddin-logo-transparant.png",
		'ubuntuwiki' => "//$wmgUploadHostname/ubuntuwiki/1/11/UbuntuWiki.png",
		'umpcwiki' => "//$wmgUploadHostname/umpcwiki/5/53/LogoUMPC-spunta.png",
		'unoitudowiki' => "//$wmgUploadHostname/unoitudowiki/1/1b/Logo_unoi.png",
		'uprisewiki' => "//$wmgUploadHostname/uprisewiki/2/2e/DotLogo130px.png",
		'unikumwiki' => "//$wmgUploadHostname/unikumwiki/e/e0/Unikum_135x135.png",
		'universebuildwiki' => "//$wmgUploadHostname/universebuildwiki/2/2f/UniversebuildLogo.png",
		'valentinaprojectwiki' => "//$wmgUploadHostname/valentinaprojectwiki/2/25/Valentina_logo_v1.png",
		'velcomwiki' => "//$wmgUploadHostname/velcomwiki/0/0f/Velcom_logo.png",
		'vgalimentiwiki' => "//$wmgUploadHostname/vgalimentiwiki/f/f9/Vgalimenti-logo.png",
		'wabcwiki' => "//$wmgUploadHostname/wabcwiki/2/25/Logowabc.png",
		'wdbwiki' => "//$wmgUploadHostname/wdbwiki/2/26/Dancing-135px.png",
		'welcomewikiwiki' => "//$wmgUploadHostname/welcomewikiwiki/d/df/20150913_WelcomeWiki-Logo_TranspWritten135x135.png",
		'webflowwiki' => "//$wmgUploadHostname/webflowwiki/f/fb/Webflow-logo-raster-blue-2015.png",
		'webtoonwiki' => "//$wmgUploadHostname/webtoonwiki/b/ba/Webtoon_wiki_symbol.PNG",
		'wikiletraswiki' => "//$wmgUploadHostname/wikiletraswiki/c/c9/Logo.png",
		'wikiparkinsonwiki' => "//$wmgUploadHostname/wikiparkinsonwiki/f/fb/WikiParkinsonLogo-135.png",
		'wikipucwiki' => "//$wmgUploadHostname/wikipucwiki/9/98/Logowikifinal.png",
		'wikiversitywiki' => "//$wmgUploadHostname/wikiversitywiki/7/71/Wikiversity-Miraheze-temporary-logo.png",
		'whentheycrywiki' => "//$wmgUploadHostname/whentheycrywiki/b/b5/Logo_m.png",
		'worldbattlewiki' => "//$wmgUploadHostname/worldbattlewiki/4/40/Globe1.png",
		'worldofkirbycraftwiki' => "//$wmgUploadHostname/worldofkirbycraftwiki/2/2f/WoKWikiLogo.png",
		'worldpediawiki' => "//$wmgUploadHostname/worldpediawiki/b/bc/Wiki.png",
		'wikibookswiki' => "//$wmgUploadHostname/wikibookswiki/3/3b/Wiki_logo.png",
		'wikicervanteswiki' => "//$wmgUploadHostname/wikicervanteswiki/0/0c/LogodelWiki.png",
		'wikidolphinhansenwiki' => "//$wmgUploadHostname/wikidolphinhansenwiki/b/bf/Dolphin-icon-150.png",
		'wikipucwiki' => "//$wmgUploadHostname/wikipucwiki/f/fb/Logo_finito_trans.png",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/0/02/WWlogo.png",
		'wisdomsandboxwiki' => "//$wmgUploadHostname/wisdomsandboxwiki/b/be/Sandbox_Logo.png",
	),

	// Timezone
	'wgLocaltimezone' => array(
		'default' => 'UTC',
		'alanpediawiki' => 'Asia/Taipei',
		'alwikiwiki' => 'America/New_York',
		'bigforestwiki' => 'Asia/Seoul',
		'calexitwiki' => 'America/Los_Angeles',
		'carvingwiki' => 'America/Denver',
		'casuarinawiki' => 'Asia/Shanghai',
		'catboxwiki' => 'America/Detroit',
		'coldbloodedwiki' => 'Asia/Seoul',
		'doinwiki' => 'Asia/Seoul',
		'doraemonpediawiki' => 'Asia/Taipei',
		'fbwikiwiki' => 'Asia/Seoul',
		'kstartupswiki' => 'Asia/Seoul',
		'libertywiki' => 'Asia/Seoul',
		'lunfengwiki' => 'Asia/Taipei',
		'ontariobrasswiki' => 'America/Toronto',
		'reviwiki' => 'Asia/Seoul',
		'reviwikiwiki' => 'Asia/Seoul',
		'webtoonwiki' => 'Asia/Seoul',
	),
	
	// TitleBlacklist 
	'wgTitleBlacklistSources' => array(
		'default' => array(
			'type' => 'url',
			'src'  => 'https://meta.miraheze.org/w/index.php?title=Title_blacklist&action=raw',
		),
		'meta' => array(
			'type' => 'url',
			'src' => 'https://meta.miraheze.org/w/index.php?title=MediaWiki:Titleblacklist&action=raw',
		),
	),
	'wgTitleBlacklistUsernameSources' => array(
		'default' => array(
			'type' => 'url',
			'src'  => 'https://meta.miraheze.org/w/index.php?title=Titleblacklist&action=raw',
		),
		'meta' => array(
			'type' => 'url',
			'src' => 'https://meta.miraheze.org/w/index.php?title=MediaWiki:Title_blacklist&action=raw',
		),
	),

	// Translate
	'wmgTranslateBlacklist' => array(
		'default' => array(),
		'metawiki' => array(
			'*' => array(
				'en' => 'English is the source language.',
			),
		),
		'spiralwiki' => array(
			'*' => array(
				'en' => 'English is the source language.',
			),
		),
	),
	'wmgTranslateTranslationServices' => array(
		'default' => array(),
	),
	'wmgTranslateDocumentationLanguageCode' => array(
		'default' => false,
		'nvcwiki' => 'qqq',
	),

	// UniversalLanguageSelector
	'wgULSAnonCanChangeLanguage' => array(
		'default' => false,
	),

	// UrlShortener
	'wgUrlShortenerTemplate' => array(
		'default' => '/m/$1',
	),
	'wgUrlShortenerDBName' => array(
		'default' => 'metawiki',
	),
	'wgUrlShortenerDomainsWhitelist' => array(
		'default' => array(
			'(.*\.)?miraheze\.org',
			'wiki\.aenasan\.com',
			'allthetropes\.org',
			'aman\.info\.tm',
			'antiguabarbudacalypso\.com',
			'arms\.institute',
			'bettermedia\.info',
			'bootlegged\.questionable\.photography',
			'boulderwiki\.org',
			'changemy\.org',
			'wiki\.besuccess\.com',
			'wiki\.denverkr\.cf',
			'wiki\.dottorconte\.eu',
			'wiki\.downhillderelicts\.com',
			'wiki\.drones4nature\.info',
			'wiki\.dwplive\.com',
			'fibromyalgia-engineer\.com',
			'gamdug\.tk',
			'wiki\.garyjohnsonmeetups\.com',
			'wiki\.grottocenter\.org',
			'haxion\.space',
			'ircwiki\.cf',
			'wiki\.jacksonheights\.nyc',
			'wiki\.labby\.io',
			'wiki\.livesnowmap\.com',
			'wiki\.make717\.org',
			'meta\.trek\.tk',
			'nenawiki\.org',
			'wiki\.lbcomms\.co.za',
			'wiki\.rizalespe\.com',
			'wiki\.simplicitysolutionsgroup\.com',
			'oneagencydunedin\.wiki',
			'www\.openonderwijs\.org',
			'oyeavdelingen\.org',
			'permanentfuturelab\.wiki',
			'publictestwiki\.com',
			'reviwiki\.info',
			'private\.revi.wiki',
			'wiki\.rpgbrigade\.org',
			'takethatwiki\.com',
			'wiki\.teessidehackspace\.org\.uk',
			'thelonsdalebattalion\.co.uk',
			'universebuild\.com',
			'wiki\.valentinaproject.org',
			'wiki\.kaisaga.com',
			'wikiescola\.com\.br',
			'www.wikiletras\.tk',
			'wikiparkinson\.org',
			'wikipuk\.cl',
			'wisdomwiki\.org',
			'wiki\.wishcert\.com',
			'sandbox\.wisdomwiki.org',
			'savage-wiki\.com',
			'speleo\.wiki',
			'www\.zenbuddhism\.info',
			'www\.aksaraywiki\.com',
			'espiral\.org',
			'spiral\.wiki',
			'wiki\.coldblooded\.ga',
		),
	),

	// VisualEditor
	'wmgVisualEditorEnableDefault' => array(
		'default' => true,
		'allthetropeswiki' => false,
		'bttestwiki' => true,
		'panoramawiki' => false,
		'testwiki' => false,
	),
	'wmgVisualEditorAvailableNamespaces' => array(
		'default' => array(
			NS_MAIN => true,
			NS_USER => true,
		),
		'+calexitwiki' => array(
			NS_DRAFT => true,
			NS_HELP => true,
			NS_HISTORICAL_TIMELINE => true,
			NS_OPINION => true,
			NS_TIMELINE => true,
 			NS_PORTAL => true,
		),
		'+coldbloodedwiki' => array(
			NS_PROJECT => true,
		),
		'+espiralwiki' => array(
			NS_PROJECT => true,
		),
		'+fbwikiwiki' => array(
			NS_PROJECT => true,
		),
		'oncprojectwiki' => array(
			NS_PROJECT => true,
			NS_TEMPLATE => true,
			NS_CATEGORY => true,
			NS_FILE => true,
		),
		'+wisdomwikiwiki' => array(
			NS_LCS => true,
			NS_MEDI => true,
			NS_LIBRARY => true,
			NS_TEACHING => true,
			NS_BLANK => true,
		),
		'+wisdomsandboxwiki' => array(
			NS_TEST => true,
		),
	),
	'wgVisualEditorSupportedSkins' => array(
		'defualt' => array(),
		'fusewiki' => array( 'foreground' ),
		'permanentfuturelabwiki' => array( 'foreground' ),
	),
	'wgVisualEditorUseSingleEditTab' => array(
		'default' => false,
		'coldbloodedwiki' => true,
		'espiralwiki' => true,
		'fbwikiwiki' => true,
		'spiralwiki' => true,
	),
	'wmgFlowEditorList' => array(
		'default' => array('wikitext', 'visualeditor'),
		'calexitwiki' => array('visualeditor'),
		'coldbloodedwiki' => array('visualeditor'),
		'espiralwiki' => array('visualeditor'),
		'fbwikiwiki' => array('visualeditor'),
		'spiralwiki' => array('visualeditor'),
	),

	// WebChat config
	'wmgWebChatServer' => array(
		'default' => false,
		'allthetropeswiki' => 'irc.freenode.net',
		'extloadwiki' => 'irc.freenode.net',
		'pnphilotenwiki' => 'irc.freenode.net',
		'wisdomwikiwiki' => 'irc.freenode.net',
		'wisdomsandboxwiki' => 'irc.freenode.net',
	),
	'wmgWebChatChannel' => array(
		'default' => false,
		'allthetropeswiki' => '#miraheze-allthetropes',
		'extloadwiki' => '#miraheze-staff',
		'pnphilotenwiki' => '#miraheze-pnphiloten',
		'wisdomwikiwiki' => '#miraheze-wisdomwiki',
		'wisdomsandboxwiki' => '#miraheze-wisdomwiki',
	),
	'wmgWebChatClient' => array(
		'default' => false,
		'allthetropeswiki' => 'freenodeChat',
		'extloadwiki' => 'freenodeChat',
		'pnphilotenwiki' => 'freenodeChat',
		'wisdomwikiwiki' => 'freenodeChat',
		'wisdomsandboxwiki' => 'freenodeChat',
	),

	// Empty arrays (do not touch unless you know what you're doing)
	'wmgClosedWiki' => array(
		'default' => false,
	),
	'wmgPrivateWiki' => array(
		'default' => false,
	),
);

function efGetSiteParams( $conf, $wiki ) {
	$site = null;
	$lang = null;
	foreach ( $conf->suffixes as $suffix ) {
		if ( substr( $wiki, -strlen( $suffix ) ) == $suffix ) {
			$site = $suffix;
			$lang = substr( $wiki, 0, -strlen( $suffix ) );
			break;
		}
	}
	return array(
		'suffix' => $site,
		'lang' => $lang,
		'params' => array(
			'lang' => $lang,
			'site' => $site,
			'wiki' => $wiki,
		),
		'tags' => array(),
	);
}

$wgConf->siteParamsCallback = 'efGetSiteParams';

# The thing that determines the dbname
if ( defined( 'MW_DB' ) ) {
	$wgDBname = MW_DB;
} elseif ( $wmgHostname === 'meta.miraheze.org' ) {
	$wgDBname = 'metawiki';
} elseif ( preg_match( '/^(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgDBname = $matches[1] . 'wiki';
} elseif ( $search = array_search( 'https://' . $wmgHostname, $wgConf->settings['wgServer'] ) ) {
	$wgDBname = $search;
} else {
	$wgDBname = false;
}

# Initialize dblist
$wgLocalDatabases = array();
$wmgDatabaseList = file( "/srv/mediawiki/dblist/all.dblist" );

foreach ( $wmgDatabaseList as $wikiLine ) {
	$wikiDB = explode( '|', $wikiLine, 4 );
	list( $DBname, $siteName, $siteLang, $wikiTagList ) = array_pad( $wikiDB, 4, '' );
	$wgLocalDatabases[] = $DBname;
	$wgConf->settings['wgSitename'][$DBname] = $siteName;
	$wgConf->settings['wgLanguageCode'][$DBname] = $siteLang;
}

$wmgPrivateDatabasesList = file( "/srv/mediawiki/dblist/private.dblist" );
foreach ( $wmgPrivateDatabasesList as $database ) {
	$database = trim( $database );
	$wgConf->settings['wmgPrivateWiki'][$database] = true;
}

$wmgClosedDatabasesList = file( "/srv/mediawiki/dblist/closed.dblist" );
foreach ( $wmgClosedDatabasesList as $database ) {
	$database = trim( $database );
	$wgConf->settings['wmgClosedWiki'][$database] = true;
}

// Hard overrides that don't work when set in $wgConf->settings
$wgGroupPermissions['bureaucrat']['userrights'] = false;
$wgGroupPermissions['sysop']['bigdelete'] = false;

// Needs to be set AFTER $wgDBname is set to a correct value
$wgUploadDirectory = "/mnt/mediawiki-static/$wgDBname";
$wgUploadPath = "https://static.miraheze.org/$wgDBname";

$wgConf->wikis = $wgLocalDatabases;
$wgConf->extractAllGlobals( $wgDBname );

if ( isset( $wgCentralAuthAutoLoginWikis[$wmgHostname] ) ) {
	unset( $wgCentralAuthAutoLoginWikis[$wmgHostname] );
	$wgCentralAuthCookieDomain = $wmgHostname;
}

# Footer icon
$wgFooterIcons['poweredby']['miraheze'] = array(
	'src' => "https://$wmgUploadHostname/metawiki/7/7e/Powered_by_Miraheze.png",
	'url' => 'https://meta.miraheze.org/wiki/',
	'alt' => 'Miraheze Wiki Hosting',
);

if ( $wgDBname === 'permanentfuturelabwiki' ) {
	$wgFooterIcons['poweredby']['wikiapiary'] = array(
		'src' => 'https://wikiapiary.com/w/images/wikiapiary/b/b4/Monitored_by_WikiApiary.png',
		'url' => 'https://wikiapiary.com/wiki/Permanent_Future_Lab',
		'alt' => 'Monitored by WikiApiary',
	);
}

$wgDefaultUserOptions['enotifwatchlistpages'] = 0;
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;

if ( !file_exists( '/srv/mediawiki/w/cache/l10n/l10n_cache-en.cdb' ) ) {
	$wgLocalisationCacheConf['manualRecache'] = false;
}

// Fonts
putenv( "GDFONTPATH=/usr/share/fonts/truetype/freefont" );

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 3;

// Write your SiteNotice below.  Comment out this section to disable.
/*$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
 	global $wgDBname;
	if ( $wgDBname !== 'rpgbrigadewiki' ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>There is currently an <a href="https://meta.miraheze.org/wiki/Requests_for_Stewardship#Void.27s_Request_for_Stewardship">open Request for Stewardship</a>. All Miraheze users are welcome to comment.</td>
			</tr></tbody></table>
EOF;
	}
	return true;
}*/

// Hook so that Terms of Service is included in footer
$wgHooks['SkinTemplateOutputPageBeforeExec'][] = 'lfTOSLink';
function lfTOSLink( $sk, &$tpl ) {
	$tpl->set( 'termsofservice', $sk->footerLink( 'termsofservice', 'termsofservicepage' ) );
	$tpl->data['footerlinks']['places'][] = 'termsofservice';
	return true;
}

// Include other configuration files
require_once( "/srv/mediawiki/config/Database.php" );
require_once( "/srv/mediawiki/config/GlobalLogging.php" );
require_once( "/srv/mediawiki/config/LocalExtensions.php" );
require_once( "/srv/mediawiki/config/MissingWiki.php" );
require_once( "/srv/mediawiki/config/Redis.php" );

// Define last to avoid all dependencies
require_once( "/srv/mediawiki/config/LocalWiki.php" );
