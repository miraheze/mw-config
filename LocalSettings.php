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
$wgLocalVirtualHosts = array( '185.52.1.77' );

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
// MISSING 1634
// MISSING 1635
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
define('NS_ADMIN', 1666);
define('NS_ADMIN_TALK', 1667);
define('NS_WORKSHOP', 1668);
define('NS_WORKSHOP_TALK', 1669);
define('NS_SELP', 1670);
define('NS_SELP_TALK', 1671);
define('NS_STUDY_NOTE', 1672);
define('NS_STUDY_NOTE_TALK', 1673);
define('NS_EXPLANATION', 1674);
define('NS_EXPLANATION_TALK', 1675);
define('NS_KOREAN_STUDY_NOTE', 1676);
define('NS_KOREAN_STUDY_NOTE_TALK', 1677);
define('NS_GLOSSARY', 1678);
define('NS_GLOSSARY_TALK', 1679);

// Refer to NS_MODULE before importing Scribunto (tmewiki)
define( 'WMG_NS_MODULE', 828 );
define( 'WMG_NS_MODULE_TALK', 829 );

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
		'inazumaelevenwiki' => true,
		'thehushhushsagawiki' => true,
		'youtubewiki' => true,
	),
	'wgPopupsBetaFeature' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'inazumaelevenwiki' => true,
		'thehushhushsagawiki' => true,
		'youtubewiki' => true,
	),

	// Block
	'wgBlockAllowsUTEdit' => array(
		'default' => true,
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

	// CentralAuth
	'wgCentralAuthAutoNew' => array(
		'default' => true,
	),
	'wgCentralAuthAutoLoginWikis' => array(
		'default' => array(
			'allthetropes.org' => 'allthetropeswiki',
			'antiguabarbudacalypso.com' => 'antiguabarbudacalypsowiki',
			'anuwiki.com' => 'anuwiki',
			'boulderwiki.org' => 'boulderwikiwiki',
			'carving.wiki' => 'carvingwiki',
			'drone-regulation.info' => 'droneregulationwiki',
			'haxion.space' => 'haxionspacewiki',
			'ircwiki.cf' => 'ircwiki',
			'meta.trek.tk' => 'metatrekwiki',
			'oneagencydunedin.wiki' => 'oneagencydunedinwiki',
			'oyeavdelingen.org' => 'oyeavdelingenwiki',
			'permanentfuturelab.wiki' => 'permanentfuturelabwiki',
			'private.revi.wiki' => 'reviwiki',
			'publictestwiki.com' => 'testwiki',
			'sandbox.wisdomwiki.org' => 'wisdomsandboxwiki',
			'spiral.wiki' => 'spiralwiki',
			'thelonsdalebattalion.co.uk' => 'thelonsdalebattalionwiki',
			'thinkingliquid.org' => 'thinkingliquidwiki',
			'universebuild.com' => 'universebuildwiki',
			'wiki.aenasan.com' => 'aenasanwiki',
			'wiki.dottorconte.eu' => 'dottorcontewiki',
			'wiki.downhillderelicts.com' => 'downhillderelictswiki',
			'wiki.dwplive.com' => 'dwplivewiki',
			'wiki.garyjohnsonmeetups.com' => 'garyjohnsonmeetupswiki',
			'wiki.grottocenter.org' => 'grottocenterwiki',
			'wiki.kaisaga.com' => 'wikikaisagawiki',
			'wiki.make717.org' => 'make717wiki',
			'wiki.printmaking.be' => 'printmakingbewiki',
			'wiki.valentinaproject.org' => 'valentinaprojectwiki',
			'wiki.zepaltusproject.com' => 'zepaltusprojectwiki',
			'wikiparkinson.org' => 'wikiparkinsonwiki',
			'www.fibromyalgia-engineer.com' => 'fibromyalgiaengineerwiki',
			'wisdomwiki.org' => 'wisdomwikiwiki',
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
	'wgCentralAuthLoginWiki' => array(
		'default' => 'loginwiki',
	),
	'wgCentralAuthSilentLogin' => array(
		'default' => true,
	),

	// Comments extension
	'wgCommentsDefaultAvatar' => array(
	    'default' => '/w/extensions/SocialProfile/avatars/default_ml.gif',
	),

	// CreateWiki
	'wmgCreateWikiSQLfiles' => array(
		'default' => array(
			"$IP/maintenance/tables.sql",
			"$IP/extensions/AbuseFilter/abusefilter.tables.sql",
			"$IP/extensions/AJAXPoll/patches/create-table--ajaxpoll_info.sql",
			"$IP/extensions/AJAXPoll/patches/create-table--ajaxpoll_vote.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/BetaFeatures/sql/create_counts.sql",
			"$IP/extensions/CheckUser/cu_log.sql",
			"$IP/extensions/CheckUser/cu_changes.sql",
			"$IP/extensions/Comments/sql/comments.sql",
			"$IP/extensions/Echo/echo.sql",
			"$IP/extensions/Flow/flow.sql",
			"$IP/extensions/GlobalBlocking/localdb_patches/setup-global_block_whitelist.sql",
			"$IP/extensions/Math/db/math.mysql.sql",
			"$IP/extensions/Math/db/mathlatexml.mysql.sql",
			"$IP/extensions/Math/db/mathoid.mysql.sql",
			"$IP/extensions/MSCalendar/MsCalendar.sql",
			"$IP/extensions/OAuth/backend/schema/mysql/OAuth.sql",
			"$IP/extensions/PageTriage/sql/PageTriageTags.sql",
			"$IP/extensions/PageTriage/sql/PageTriagePageTags.sql",
			"$IP/extensions/PageTriage/sql/PageTriagePage.sql",
			"$IP/extensions/PageTriage/sql/PageTriageLog.sql",
			"$IP/extensions/Poll/archives/Poll-install-manual.sql",
			"$IP/extensions/SocialProfile/UserProfile/user_profile.sql",
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
			"$IP/extensions/WikiForum/sql/wikiforum.sql",
			"$IP/extensions/WikiLove/patches/WikiLoveLog.sql",
			"$IP/extensions/UrlShortener/schemas/urlshortcodes.sql"
		),
	),

	// Database
	'wgCompressRevisions' => array(
		'default' => false,
		'allthetropeswiki' => true,
	),
	'wgDBtype' => array(
		'default' => 'mysql',
	),
	'wgDBserver' => array(
		'default' => '185.52.1.77',
	),
	'wgDBuser' => array(
		'default' => 'mediawiki',
	),
	'wgDBadminuser' => array(
		'default' => 'wikiadmin',
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
		'+8stationwiki' => array(
			'anon' => true,
		),
		'+adnovumwiki' => array(
			'anon' => true,
		),
		'+allbanks2wiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+antiguabarbudacalypsowiki' => array(
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
		'+clementsworldbuildingwiki' => array(
			'anon' => true,
		),
		'+dditecwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+dottorcontewiki' => array(
			'anon' => true,
		),
		'+drunkenpeasantswikiwiki' => array(
			'anon' => true,
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
			'user' => true,
			'sysop' => true,
		),
		'+izanagiwiki' => array(
			'anon' => true,
		),
		'+kl6fwiki' => array(
			'anon' => true,
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
		'+ntlawwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+ofthevampirewiki' => array(
			'anon' => true,
		),
		'+oncprojectwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+poserdazfreebieswiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+priyowiki' => array(
			'anon' => true,
		),
		'+ricwiki' => array(
			'anon' => true,
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
		'+snowthegamewiki' => array(
			'anon' => true,
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
		'+thelonsdalebattalionwiki' => array(
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
		'+turkcesozlukwiki' => array(
			'anon' => true,
		),
		'+vrgowiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+welcomewiki' => array(
			'anon' => true,
		),
		'+walthamstowlabourwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
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

	// Dormancy policy && RC stuff
	'wgRCMaxAge' => array(
		'default' => 180 * 24 * 3600,
		'allthetropeswiki' => 90 * 24 * 3600,
		'extloadwiki' => 90 * 24 * 3600,
		'loginwiki' => 90 * 24 * 3600,
		'metawiki' => 90 * 24 * 3600,
		'testwiki' => 90 * 24 * 3600,
	),

	// Extensions
	// AccessControl: due to security risks, use of this extension is at the founder's own risk.
	// Prior to enabling the extension the founder should agree (on their own wiki, under their founder account!)
	// that Miraheze is NOT responsible for any data leaks caused by this extension,
	// and that the founder is fully responsible for the usage of AccessControl.
	'wmgUseAccessControl' => array(
		'default' => false,
		'extloadwiki' => true,
		'wimawiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseAddHTMLMetaAndTitle' => array(
		'default' => false,
		'extloadwiki' => true,
		'partupwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseAdminLinks' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'applebranchwiki' => true,
		'christipediawiki' => true,
		'cssandjsschoolboardwiki' => true,
		'developmentwiki' => true,
		'drunkenpeasantswikiwiki' => true,
		'extloadwiki' => true,
		'ezdmfwiki' => true,
		'gameswiki' => true,
		'heistwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'secondcirclewiki' => true,
		'szkwiki' => true,
		'testwiki' => true,
		'tochkiwiki' => true,
		'touhouenginewiki' => true,
		'walthamstowlabourwiki' => true,
		'worldbattlewiki' => true,
		'yggdrasilwiki' => true,
	),
	'wmgUseAJAXPoll' => array(
		'default' => false,
		'extloadwiki' => true,
		'openconstitutionwiki' => true,
	),
	'wmgUseAuthorProtect' => array(
		'default' => false,
		'extloadwiki' => true,
		'grandtheftwikiwiki' => true,
	),
	'wmgUseBetaFeatures' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'inazumaelevenwiki' => true,
		'robloxscripterswiki' => true,
		'thehushhushsagawiki' => true,
	),
	'wmgUseBlogPage' => array(
		'default' => false,
		'extloadwiki' => true,
		'ircwiki' => true,
		'robloxscripterswiki' => true,
	),
	'wmgUseMSCalendar' => array(
		'default' => false,
		'aucelewiki' => true,
		'extloadwiki' => true,
		'umodwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseCategoryTree' => array(
		'default' => true,
		'whentheycrywiki' => false,
	),
	'wmgUseCharInsert' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'cssandjsschoolboardwiki' => true,
		'extloadwiki' => true,
		'walthamstowlabourwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseContactPage' => array(
		'default' => false, // Add wiki config to ContactPage.php
		'christipediawiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseCollapsibleVector' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'anuwiki' => true,
		'extloadwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseComments' => array(
		'default' => false,
		'extloadwiki' => true,
		'ezdmfwiki' => true,
		'openconstitutionwiki' => true,
		'priyowiki' => true,
		'robloxscripterswiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
	),
	'wmgUseCreateWiki' => array(
		'default' => false,
		'metawiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseCSS' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'webflowwiki' => true,
	),
	'wmgUseDuskToDawn' => array(
		'default' => false,
		'extloadwiki' => true,
		'ofthevampirewiki' => true,
	),
	'wmgUseDynamicPageList' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'augustinianumwiki' => true,
		'camerainfowiki' => true,
		'extloadwiki' => true,
		'heistwiki' => true,
		'hydrawikiwiki' => true,
		'walthamstowlabourwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseEditcount' => array(
		'default' => false,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'idtestwiki' => true,
	),
	'wmgUseFeaturedFeeds' => array(
		'default' => false,
	),
	'wmgUseFlow' => array(
		'default' => false, // Please make sure parsoid is enabled on modules/parsoid/manifests/init.pp or modules/parsoid/templates/settings.js (custom domains only)
		'8stationwiki' => true,
		'adnovumwiki' => true,
		'allthetropeswiki' => true,
		'bgowiki' => true,
		'christipediawiki' => true,
		'cecwiki' => true,
		'dicficwiki' => true,
		'developmentwiki' => true,
		'drunkenpeasantswikiwiki' => true,
		'ernaehrungsrathhwiki' => true,
		'extloadwiki' => true,
		'ezdmfwiki' => true,
		'grandtheftwikiwiki' => true,
		'ircwiki' => true,
		'mecanonwiki' => true,
		'oyeavdelingenwiki' => true,
		'permanentfuturelabwiki' => true,
		'priyowiki' => true,
		'ricwiki' => true,
		'soshomophobiewiki' => true,
		'spiralwiki' => true,
		'touhouenginewiki' => true,
		'universebuildwiki' => true,
		'walthamstowlabourwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
		'yacresourceswiki' => true,
		'yggdrasilwiki' => true,
	),
	'wmgUseForeground' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'permanentfuturelabwiki' => true,
	),
	// Be aware of https://www.mediawiki.org/wiki/Extension:Header_Tabs#Incompatible_extensions
	'wmgUseHeaderTabs' => array(
		'default' => false,
		'bdorpwiki' => true,
		'datachronwiki' => true,
		'extloadwiki' => true,
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
		'creersonarbrewiki' => true,
		'extloadwiki' => true,
		'lclwikiwiki' => true,
		'shoppingwiki' => true,
		'studynotekrwiki' => true,
		'universebuildwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseInputBox' => array(
		'default' => true,
		'allthetropeswiki' => false, // breaks editing
	),
	'wmgUseJosa' => array(
		'default' => false,
		'extloadwiki' => true,
		'reviwiki' => true,
	),
	'wmgUseLinkSuggest' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseLoopsCombo' => array(
		'default' => false,
		'bgowiki' => true,
		'eotewiki' => true,
		'extloadwiki' => true,
		'secondcirclewiki' => true,
	),
	'wmgUseMetrolook' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseMobileFrontend' => array(
		'default' => true,
		'izanagiwiki' => false,
		'permanentfuturelabwiki' => false,
	),
	'wmgUseMonaco' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseMsPackage' => array(
		'default' => false,
		'catboxwiki' => true,
		'extloadwiki' => true, // do not set this to false without disabling MsUpload on all wikis below
		'gameswiki' => true,
		'quantixwiki' => true,
		'urho3dwiki' => true,
	),
	// MsUpload is enabled on extloadwiki via MsPackage
	'wmgUseMsUpload' => array(
		'default' => false,
		'adnovumwiki' => true,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'bgowiki' => true,
		'chandruswethswiki' => true,
		'christipediawiki' => true,
		'drunkenpeasantswikiwiki' => true,
		'elainarmuawiki' => true,
		'evawiki' => true,
		'exitsincwiki' => true,
		'izanagiwiki' => true,
		'luckandlogicwiki' => true,
		'oyeavdelingenwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'snowthegamewiki' => true,
		'universebuildwiki' => true,
		'webflowwiki' => true,
		'whentheycrywiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseMultimediaViewer' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'inazumaelevenwiki' => true,
		'robloxscripterswiki' => true,
	),
	'wmgUseMultiBoilerplate' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseNewestPages' => array(
	    'default' => false,
	    'christipediawiki' => true,
	    'extloadwiki' => true,
	),
	'wmgUseNewUserMessage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'developmentwiki' => true,
		'extloadwiki' => true,
		'universebuildwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseNoTitle' => array(
		'default' => false,
		'aktposwiki' => true,
		'carvingwiki' => true,
		'developmentwiki' => true,
		'extloadwiki' => true,
		'idleomenswiki' => true,
		'lbsgeswiki' => true,
		'luckandlogicwiki' => true,
		'openconstitutionwiki' => true,
		'universebuildwiki' => true,
		'urho3dwiki' => true,
	),
	'wmgUsePageNotice' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'secondcirclewiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUsePageTriage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bgowiki' => true,
		'cssandjsschoolboardwiki' => true,
		'extloadwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUsePopups' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'christipediawiki' => true,
		'extloadwiki' => true,
		'inazumaelevenwiki' => true,
		'walthamstowlabourwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUsePoll' => array(
		'default' => false,
		'extloadwiki' => true,
		'nidda23wiki' => true,
		'universebuildwiki' => true,
	),
	'wmgUseRandomSelection' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'humorpediawiki' => true,
		'tmewiki' => true,
	),
	'wmgUseRelatedArticles' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseSandboxLink' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'idtestwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseScratchBlocks' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseSectionHide' => array(
		'default' => false,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'developmentwiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseSimpleTooltip' => array(
		'default' => false,
		'8stationwiki' => true,
		'apolcourseswiki' => true,
		'extloadwiki' => true,
		'idtestwiki' => true,
	),
	// Requires copying of two directories: https://www.mediawiki.org/wiki/Extension:SocialProfile#Directories
	'wmgUseSocialProfile' => array(
		'default' => false,
		'adnovumwiki' => true,
		'datachronwiki' => true,
		'extloadwiki' => true,
		'micropediawiki' => true,
		'ircwiki' => true,
		'robloxscripterswiki' => true,
		'stellachronicawiki' => true,
		'stoutofreachwiki' => true,
		'priyowiki' => true,
	),
	'wmgUseSubpageFun' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseSyntaxHighlight' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'datasciencewiki' => true,
		'cssandjsschoolboardwiki' => true,
		'extloadwiki' => true,
		'ezdmfwiki' => true,
		'idtestwiki' => true,
		'partupwiki' => true,
		'pascalscada' => true,
		'priyowiki' => true,
		'robloxscripterswiki' => true,
		'sourcewiki' => true,
		'sizzlecookiewiki' => true,
		'spacegamewiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'tmewiki' => true,
		'touhouenginewiki' => true,
		'urho3dwiki' => true,
		'valentinaprojectwiki' => true,
		'wikicervanteswiki' => true,
		'xdjibiwiki' => true,
		'xofwiki' => true,
	),
	// Combo of Tabs + Tabber
	'wmgUseTabsCombination' => array(
		'default' => false,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'developmentwiki' => true,
		'stellachronicawiki' => true,
		'universebuildwiki' => true,
		'whentheycrywiki' => true,
	),
	'wmgUseTimedMediaHandler' => array(
		'default' => false,
		'extloadwiki' => true,
		'geirpediawiki' => true,
	),
	'wmgUseTitleKey' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'walthamstowlabourwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseTranslate' => array(
		'default' => false,
		'extloadwiki' => true,
		'inazumaelevenwiki' => true,
		'metawiki' => true,
		'pathfinderwiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'spiralwiki' => true,
		'robloxscripterswiki' => true,
		'rtwiki' => true,
		'testwiki' => true,
		'thehushhushsagawiki' => true,
		'valentinaprojectwiki' => true,
		'welcomewiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseVoteNY' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'openconstitutionwiki' => true,
		'robloxscripterswiki' => true,
	),
	'wmgUseVisualEditor' => array(
		'default' => false, // Please make sure parsoid is enabled on modules/parsoid/manifests/init.pp or modules/parsoid/templates/settings.js (custom domains only)
		'3dicxyzwiki' => true,
		'8stationwiki' => true,
		'aacenterpriselearningwiki' => true,
		'adnovumwiki' => true,
		'aescapeswiki' => true,
		'ageofimperialismwiki' => true,
		'airwiki' => true,
		'aktposwiki' => true,
		'alanpediawiki' => true,
		'algopediawiki' => true,
		'allbanks2wiki' => true,
		'allthetropeswiki' => true,
		'applebranchwiki' => true,
		'arabudlandwiki' => true,
		'arguwikiwiki' => true,
		'aryamanwiki' => true,
		'atheneumwiki' => true,
		'augustinianumwiki' => true,
		'aurcusonlinewiki' => true,
		'bgowiki' => true,
		'biblicalwikiwiki' => true,
		'bibliowiki' => true,
		'boulderwikiwiki' => true,
		'braindumpwiki' => true,
		'carvingwiki' => true,
		'casuarinawiki' => true,
		'cbmediawiki' => true,
		'chandruswethswiki' => true,
		'christipediawiki' => true,
		'cisowiki' => true,
		'civitaswiki' => true,
		'clementsworldbuildingwiki' => true,
		'clicordiwiki' => true,
		'cssandjsschoolboardwiki' => true,
		'datachronwiki' => true,
		'developmentwiki' => true,
		'dicficwiki' => true,
		'dmwwiki' => true,
		'dottorcontewiki' => true,
		'drunkenpeasantswikiwiki' => true,
		'dwplivewiki' => true,
		'elainarmuawiki' => true,
		'ernaehrungsrathhwiki' => true,
		'esswaywiki' => true,
		'etpowiki' => true,
		'evawiki' => true,
		'extloadwiki' => true,
		'ezdmfwiki' => true,
		'fishpercolatorwiki' => true,
		'foodsharinghamburgwiki' => true,
		'frontdeskswiki' => true,
		'gameswiki' => true,
		'geirpediawiki' => true,
		'genwiki' => true,
		'gncwiki' => true,
		'grandtheftwikiwiki' => true,
		'hftqmswiki' => true,
		'hobbieswiki' => true,
		'hshsinfoportalwiki' => true,
		'hsoodenwiki' => true,
		'idtestwiki' => true,
		'ilearnthingswiki' => true,
		'imstswiki' => true,
		'inazumaelevenwiki' => true,
		'ircwiki' => true,
		'islamwissenschaftwiki' => true,
		'izanagiwiki' => true,
		'lancemedicalwiki' => true,
		'lbsgeswiki' => true,
		'lclwikiwiki' => true,
		'littlebigplanetwiki' => true,
		'lizardwiki' => true,
		'luckandlogicwiki' => true,
		'lunfengwiki' => true,
		'maiasongcontestwiki' => true,
		'mecanonwiki' => true,
		'menufeedwiki' => true,
		'meregoswiki' => true,
		'metawiki' => true,
		'musiclibrarywiki' => true,
		'musictabswiki' => true,
		'mydegreewiki' => true,
		'neuronpediawiki' => true,
		'newcolumbiawiki' => true,
		'newknowledgewiki' => true,
		'newtrendwiki' => true,
		'nidda23wiki' => true,
		'nwpwiki' => true,
		'ofthevampirewiki' => true,
		'openconstitutionwiki' => true,
		'oyeavdelingenwiki' => true,
		'panoramawiki' => true,
		'paodeaodawiki' => true,
		'partupwiki' => true,
		'permanentfuturelabwiki' => true,
		'pflanzenwiki' => true,
		'priyowiki' => true,
		'pqwiki' => true,
		'qwertywiki' => true,
		'rawdatawiki' => true,
		'recherchesdocumentaireswiki' => true,
		'ricwiki' => true,
		'robloxscripterswiki' => true,
		'rpcharacterswiki' => true,
		'safiriawiki' => true,
		'secondcirclewiki' => true,
		'shoppingwiki' => true,
		'simonjonwiki' => true,
		'sirikotwiki' => true,
		'sjuhabitatwiki' => true,
		'skyfireflyffwiki' => true,
		'snowthegamewiki' => true,
		'soshomophobiewiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'spiralwiki' => true,
		'taylorwiki' => true,
		'teleswikiwiki' => true,
		'testwiki' => true,
		'thefosterswiki' => true,
		'thehushhushsagawiki' => true,
		'tmewiki' => true,
		'tochkiwiki' => true,
		'torejorgwiki' => true,
		'touhouenginewiki' => true,
		'unikumwiki' => true,
		'universebuildwiki' => true,
		'urho3dwiki' => true,
		'valentinaprojectwiki' => true,
		'videogameswiki' => true,
		'vrgowiki' => true,
		'walthamstowlabourwiki' => true,
		'webflowwiki' => true,
		'wikibookswiki' => true,
		'wikicervanteswiki' => true,
		'wikikaisagawiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
		'wikihoyowiki' => true,
		'worldbuildingwiki' => true,
		'xdjibiwiki' => true,
		'yourosongcontestwiki' => true,
		'yggdrasilwiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseVariables' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bgowiki' => true,
		'extloadwiki' => true,
		'eotewiki' => true,
		'secondcirclewiki' => true,
		'szkwiki' => true,
		'walthamstowlabourwiki' => true,
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
	'wmgUseWidgets' => array(
		'default' => false,
		'extloadwiki' => false, // Disabled due to breakage from T282
	),
	'wmgUseWikiForum' => array(
		'default' => false,
		'entropediawiki' => true,
		'extloadwiki' => true,
		'indexwiki' => true,
		'ircwiki' => true,
		'stellachronicawiki' => true,
		'wikicervanteswiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
	),
	'wmgUseWikiLove' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseYouTube' => array(
		'default' => false,
		'airwiki' => true,
		'alanpediawiki' => true,
		'allthetropeswiki' => true,
		'aktposwiki' => true,
		'apolcourseswiki' => true,
		'bmedwiki' => true,
		'carvingwiki' => true,
		'christipediawiki' => true,
		'datachronwiki' => true,
		'developmentwiki' => true,
		'dmwwiki' => true,
		'doraemonpediawiki' => true,
		'drunkenpeasantswikiwiki' => true,
		'dwplivewiki' => true,
		'elainarmuawiki' => true,
		'evawiki' => true,
		'extloadwiki' => true,
		'florianoromanowiki' => true,
		'freecollegeprojectwiki' => true,
		'gameswiki' => true,
        	'geirpediawiki' => true,
		'islamwissenschaftwiki' => true,
		'izanagiwiki' => true,
		'lclwikiwiki' => true,
		'lifewiki' => true,
		'luckandlogicwiki' => true,
		'ontariobrasswiki' => true,
		'priyowiki' => true,
		'secondcirclewiki' => true,
		'szkwiki' => true,
		'testwiki' => true,
		'tmewiki' => true,
		'urho3dwiki' => true,
		'valentinaprojectwiki' => true,
		'wisdomwikiwiki' => true,
		'wisdomsandboxwiki' => true,
		'worldpediawiki' => true,
		'webflowwiki' => true,
		'yacresourceswiki' => true,
	),

	// External link target
	'wgExternalLinkTarget' => array(
		'default' => false,
		'forexwiki' => '_blank',
		'sylwiki' => '_blank',
		'vrgowiki' => '_blank',
		'wisdomwikiwiki' => '_blank',
		'wisdomsandboxwiki' => '_blank',
		'yacresourceswiki' => '_blank',
	),

	// Files
	'wgEnableUploads' => array(
		'default' => true,
	),
	'wgAllowCopyUploads' => array(
		'default' => false,
		'catboxwiki' => true,
		'entropediawiki' => true,
		'quantixwiki' => true,
	),
	'wgCopyUploadsFromSpecialUpload' => array(
		'default' => false,
		'catboxwiki' => true,
		'entropediawiki' => true,
		'quantixwiki' => true,
	),
	'wgFileExtensions' => array(
		'default' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf' ),
		'+oyeavdelingenwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx'),
		'+wisdomwikiwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'txt', 'rtf', 'zip'),
		'+wisdomsandboxwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'txt', 'rtf', 'zip'),
	),
	'wgUseInstantCommons' => array(
		'default' => true,
		'thefosterswiki' => false,
	),
	'wgEnableImageWhitelist' => array(
		'default' => false,
	),

	// Flow
	'wmgFlowDefaultNamespaces' => array(
		'default' => false,
		'8stationwiki' => true,
		'allthetropeswiki' => true,
		'drunkenpeasantswikiwiki' => true,
		'permanentfuturelabwiki' => true,
		'spiralwiki' => true,
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
		'diavwiki' => "//$wmgUploadHostname/diavwiki/f/fc/Copyrighted_Content.png",
		'safiriawiki' => "https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png",
		'sourcewiki' => 'https://source.miraheze.org/wiki/Source_Code_Wiki:Copyrights',
		'spiralwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'wisdomwikiwiki' => 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png',
		'universebuildwiki' => "https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png",
	),
	'wgRightsPage' => array(
		'default' => '',
		'developmentwiki' => 'Official:Copyrights',
		'diavwiki' => 'Project:Copyrights',
		'quantixwiki' => 'Project:Copyrights',
		'sourcewiki' => 'Project:Copyrights',
		'wisdomwikiwiki' => 'Copyleft',
	),
	'wgRightsText' => array(
		'default' => 'Creative Commons Attribution Share Alike',
		'diavwiki' => 'All Rights Reserved',
		'metatrekwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'oyeavdelingenwiki' => 'All Rights Reserved',
		'safiriawiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'sourcewiki' => 'Wiki copyright information.',
		'spiralwiki' => 'CC0 Public Domain',
		'wisdomwikiwiki' => 'Creative Commons Attribution-NonCommercial-NoDerivatives',
		'universebuildwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
	),
	'wgRightsUrl' => array(
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/',
		'metatrekwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'safiriawiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'sourcewiki' => 'https://source.miraheze.org/wiki/Source_Code_Wiki:Copyrights',
		'spiralwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'wisdomwikiwiki' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/',
		'universebuildwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
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

	// Math
	'wgTexvc' => array(
		'default' => '/usr/bin/texvc',
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
		'thelonsdalebattalionwiki' => false,
		'allthetropeswiki' => false,
	),
	'wgMetrolookUploadButton' => array(
		'default' => true,
		'allthetropeswiki' => false,
	),
	'wgMetrolookBartile' => array(
		'default' => true,
		'thelonsdalebattalionwiki' => false,
	),

	// MirahezeMagic
	// https://meta.miraheze.org/wiki/Dormancy_Policy/Exceptions
	'wgFindInactiveWikisWhitelist' => array(
		'default' => array(
			'metawiki',
			'allthetropeswiki',
			'bitcoindebateswiki',
			'spiralwiki',
			'extloadwiki',
			'loginwiki',
			'testwiki',
		),
	),
	
	// Misc. stuff
	'wgSitename' => array(
		'default' => 'No sitename set!',
	),
	'wgAllowDisplayTitle' => array(
		'default' => true,
	),

	// Mobile
	'wgMFAutodetectMobileView' => array(
		'default' => true,
	),
	
	// MsCatSelect vars
	'wgMSCS_WarnNoCategories' => array(
		'default' => true,
		'gameswiki' => false,
		'quantixwiki' => false,
	),

	// Namespaces
	'wgExtraNamespaces' => array(
		'default' => array(),
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
		),
		'catboxwiki' => array(
			NS_COMIC => 'Comic',
			NS_COMIC_TALK => 'Comic_talk'
		),
		'developmentwiki' => array(
			NS_OFFICIAL => 'Official',
			NS_OFFICIAL_TALK => 'Official_talk',
		),
		'humorpediawiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
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
		'quantixwiki' => array(
			NS_HL2RP => 'HL2RP',
			NS_HL2RP_TALK => 'HL2RP_talk',
			NS_ARP => 'ARP',
			NS_ARP_TALK => 'ARP_talk',
			NS_EVENT => 'Event',
			NS_EVENT_TALK => 'Event_talk',
			NS_CLAN => 'Clan',
			NS_CLAN_TALK => 'Clan_talk',
			NS_POE => 'PoE',
			NS_POE_TALK => 'PoE_talk',
			NS_LEAGUE => 'League',
			NS_LEAGUE_TALK => 'League_talk',
			NS_SMITE => 'Smite',
			NS_SMITE_TALK => 'Smite_talk'
		),
		'reviwiki' => array(
			NS_SERVER => 'Server',
			NS_SERVER_TALK => 'Server_talk',
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
	),
	'wgContentNamespaces' => array(
		'default' => array( NS_MAIN ),
		'+catboxwiki' => array( NS_COMIC ),
		'+quantixwiki' => array( NS_HL2RP, NS_ARP, NS_EVENT, NS_CLAN, NS_POE, NS_LEAGUE, NS_SMITE ),
		'+reviwiki' => array( NS_SERVER ),
		'+safiriawiki' => array( NS_HOENN ),
		'+tmewiki' => array( NS_CALL_OF_DUTY, NS_MINECRAFT, NS_SUPER_MARIO_LAND_2, NS_SUPER_MARIO_WORLD_2, NS_SUPER_MARIO_BROS, NS_SUPER_MARIO_ADVANCE_2, NS_SUPER_MARIO_ADVANCE_3, NS_SUPER_MARIO_ADVANCE_4, NS_THE_LEGEND_OF_ZELDA ),
	),
	'wgMetaNamespace' => array(
	    'default' => null,
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
		'+catboxwiki' => array(
			NS_MAIN => true,
			NS_COMIC => true,
			NS_OFFICIAL => true,
			NS_TEMPLATE => true,
		),
		'+clementsworldbuildingwiki' => array(
			NS_MAIN => true,
		),
		'+eotewiki' => array(
			NS_MAIN => true,
		),
		'+gameswiki' => array(
			NS_MAIN => true,
			NS_USER => true,
			NS_PROJECT => true,
		),
		'+hobbieswiki' => array(
			NS_MAIN => true,
		),
		'+humorpediawiki' => array(
			NS_TALK => true,
		),
		'+metawiki' => array(
			NS_MAIN => true,
		),
		'+partupwiki' => array(
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
		'+dpwiki' => array(
			'bureaucrat' => array(
				'respected',
			),
		),
		'+idtestwiki' => array(
			'Founder' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
				'trusted',
			),
			'bureaucrat' => array(
				'trusted',
			),
		),
		'+quantixwiki' => array(
			'bureaucrat' => array(
				'bureaucrat',
				'superadmin',
				'admin',
				'coder',
			),
			'coder' => array(
				'confirmed',
				'member',
				'autopatrolled',
			),
			'owner' => array(
				'admin',
				'autopatrolled',
				'bot',
				'bureaucrat',
				'coder',
				'confirmed',
				'superadmin',
				'sysop',
			),
			'superadmin' => array(
				'admin',
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
		'testwiki' => array(
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
				'exampleuser',
				'testgroup',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
			'steward' => array(
				'consul',
				'bot',
				'bureaucrat',
				'consul',
				'exampleuser',
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
		'studynotekrwiki' => array(
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
		'+vrgowiki' => array(
			'bureaucrat' => array(
				'Teachers',
			),
		),
		'+walthamstowlabourwiki' => array(
			'sysop' => array(
				'editor-approver',
				'editor',
			),
			'editor-approver' => array(
				'editor-approver',
				'editor',
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
		'+dpwiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
				'respected' => true,
			),
			'respected' => array(
				'respected' => true,
			),
		),
		'+idtestwiki' => array(
			'Founder' => array(
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
				'founder' => true,
			),
			'bureaucrat' => array(
				'nuke' => true,
				'movefile' => true,
				'blockemail' => true,
			),
			'trusted' => array(
				'block' => true,
				'autoconfirmed' => true,
				'autopatrolled' => true,
			),
		),
		'+metawiki' => array(
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
			),
			'wikicreator' => array(
				'createwiki' => true,
				'managewiki' => true,
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
		'+quantixwiki' => array(
			'admin' => array(
				'read' => true,
			),
			'bureaucrat' => array(
				'bureaucrat' => true,
				'protect' => true,
				'upload_by_url' => true,
			),
			'coder' => array(
				'coder' => true,
				'protect' => true,
				'editprotected' => true,
				'upload' => true,
				'reupload-own' => true,
			),
			'superadmin' => array(
				'read' => true,
			),
			'sysop' => array(
				'upload_by_url' => true,
			),
			'owner' => array(
				'bureaucrat' => true,
				'owner' => true,
				'protect' => true,
				'upload_by_url' => true,
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
		'+testwiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
				'nuke' => true,
				'editinterface' => true,
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
		'+vrgowiki' => array(
			'Teachers' => array(
				'edit' => true,
			),
		),
		'+walthamstowlabourwiki' => array(
			'editor-approver' => array(
				'edit' => true,
			),
		),
	),
	'wgGroupsRemoveFromSelf' => array(
		'default' => array(),
		'gameswiki' => array(
			'*' => true,
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
		'+dpwiki' => array(
			'bureaucrat' => array(
				'respected',
			),
		),
		'+idtestwiki' => array(
			'Founder' => array(
				'autopatrolled',
				'bot',
				'bureaucrat',
				'confirmed',
				'sysop',
				'rollbacker',
				'trusted',
			),
			'bureaucrat' => array(
				'trusted',
			),
		),
		'+quantixwiki' => array(
			'bureaucrat' => array(
				'superadmin',
				'admin',
				'coder',
			),
			'coder' => array(
				'confirmed',
				'member',
				'autopatrolled',
			),
			'owner' => array(
				'admin',
				'autopatrolled',
				'bot',
				'bureaucrat',
				'coder',
				'confirmed',
				'superadmin',
				'sysop',
			),
			'superadmin' => array(
				'admin',
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
		'+testwiki' => array(
			'bureaucrat' => array(
				'testgroup',
				'bot',
			),
			'consul' => array(
				'bot',
				'bureaucrat',
				'exampleuser',
			),
			'steward' => array(
				'consul',
				'exampleuser',
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
		'+vrgowiki' => array(
			'bureaucrat' => array(
				'Teachers',
			),
		),
		'+walthamstowlabourwiki' => array(
			'sysop' => array(
				'editor-approver',
				'editor',
			),
			'editor-approver' => array(
				'editor',
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
			'exampleuser' => array(
				'editmyoptions' => true,
			),
		),
	),
	// RelatedArticles settings
	'wgRelatedArticlesLoggingSamplingRate' => array(
	 	'default' => false,
	 	'allthetropeswiki' => '0.01',
	 	'extloadwiki' => '0.01',
	 	'youtubewiki' => '0.01',
	 ),
	 'wgRelatedArticlesShowReadMore' => array(
	 	'default' => false,
	 	'allthetropeswiki' => true,
	 	'extloadwiki' => true,
	 	'youtubewiki' => true,
	 ),
	 'wgRelatedArticlesShowInFooter' => array(
	 	'default' => false,
	 	'allthetropeswiki' => true,
	 	'extloadwiki' => true,
	 	'youtubewiki' => true,
	 ),
	 
	// Restriction types
	'+wgRestrictionLevels' => array(
		'default' => array(
			'user',
		),
		'+dpwiki' => array(
			'bureaucrat',
			'respected',
		),
		'+quantixwiki' => array(
			'bureaucrat',
			'coder',
			'owner',
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
		'+idtestwiki' => array(
			'trusted',
			'bureaucrat',
			'Founder',
		),
		'+studynotekrwiki' => array(
			'voter',
		),
	),
		
	'+wgRestrictionTypes' => array(
		'default' => array(
			'delete',
		),
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
		'allthetropeswiki' => 'https://allthetropes.org',
		'antiguabarbudacalypsowiki' => 'https://antiguabarbudacalypso.com',
		'anuwiki' => 'https://anuwiki.com',
		'boulderwikiwiki' => 'https://boulderwiki.org',
		'carvingwiki' => 'https://carving.wiki',
		'dottorcontewiki' => 'https://wiki.dottorconte.eu',
		'downhillderelictswiki' => 'https://wiki.downhillderelicts.com',
		'droneregulationwiki' => 'https://drone-regulation.info',
		'dwplivewiki' => 'https://wiki.dwplive.com',
		'fibromyalgiaengineerwiki' => 'https://www.fibromyalgia-engineer.com',
		'garyjohnsonmeetupswiki' => 'https://wiki.garyjohnsonmeetups.com',
		'grottocenterwiki' => 'https://wiki.grottocenter.org',
		'haxionspacewiki' => 'https://haxion.space',
		'ircwiki' => 'https://ircwiki.cf',
		'make717wiki' => 'https://wiki.make717.org',
		'metatrekwiki' => 'https://meta.trek.tk',
		'oneagencydunedinwiki' => 'https://oneagencydunedin.wiki',
		'oyeavdelingenwiki' => 'https://oyeavdelingen.org',
		'permanentfuturelabwiki' => 'https://permanentfuturelab.wiki',
		'printmakingbewiki' => 'https://wiki.printmaking.be',
		'testwiki' => 'https://publictestwiki.com',
		'reviwiki' => 'https://private.revi.wiki',
		'spiralwiki' => 'https://spiral.wiki',
		'thelonsdalebattalionwiki' => 'https://thelonsdalebattalion.co.uk',
		'thinkingliquidwiki' => 'https://thinkingliquid.org',
		'universebuildwiki' => 'https://universebuild.com',
		'valentinaprojectwiki' => 'https://wiki.valentinaproject.org',
		'wikikaisagawiki' => 'https://wiki.kaisaga.com',
		'wikiparkinsonwiki' => 'https://wikiparkinson.org',
		'wisdomwikiwiki' => 'https://wisdomwiki.org',
		'wisdomsandboxwiki' => 'https://sandbox.wisdomwiki.org',
		'zepaltusprojectwiki' => 'https://wiki.zepaltusproject.com',
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
	
	// Statistics
	'wgArticleCountMethod' => array(
		'default' => 'link', // To update it, you will need to run the maintenance/updateArticleCount.php script
		'lomithradienwiki' => 'any',
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
	),
	'wgCentralAuthLoginIcon' => array(
		'default' => '/usr/share/nginx/favicons/default.ico',
	),
	'wgDefaultSkin' => array(
		'default' => 'vector',
		'cybercrimewiki' => 'modern',
		'ofthevampirewiki' => 'dusktodawn',
		'ontariobrasswiki' => 'monobook',
		'permanentfuturelabwiki' => 'foreground',
		'stellachronicawiki' => 'monobook',
		'thelonsdalebattalionwiki' => 'metrolook',
	),
	'wgFavicon' => array(
		'default' => '/favicon.ico',
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/6/64/Favicon.ico",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/b/be/APfavicon.png",
		'adiaprojectwiki' => "//$wmgUploadHostname/adiaprojectwiki/9/91/Adiafavicon.png",
		'aenasanwiki' => "//$wmgUploadHostname/aenasanwiki/e/e6/AEfav.ico",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/8/84/Rainbowstar.png",
		'allbanks2wiki' => "//$wmgUploadHostname/allbanks2wiki/7/7f/AllBanks2Logo.png",
		'astrowiki' => "//$wmgUploadHostname/astrowiki/6/64/Favicon.ico",
		'bdorpwiki' => "//$wmgUploadHostname/bdorpwiki/3/3b/Favicongif.gif",
		'bgowiki' => "//$wmgUploadHostname/bgowiki/6/64/Favicon.ico",
		'carvingwiki' => "//$wmgUploadHostname/carvingwiki/6/64/Favicon.ico",
		'christipediawiki' => "//$wmgUploadHostname/christipediawiki/e/e7/Logo_Christipedia.jpg",
		'clementsworldbuildingwiki' => "//$wmgUploadHostname/clementsworldbuildingwiki/8/8b/CW_favicon.ico",
		'crankipediawiki' => "//$wmgUploadHostname/crankipediawiki/4/4c/Crankilogo.png",
		'cssandjsschoolboardwiki' => '//upload.wikimedia.org/wikipedia/commons/2/2b/Page_css_48.png',
		'datachronwiki' => "//$wmgUploadHostname/datachronwiki/f/f3/1408002974_WS.png",
		'diavwiki' => "//$wmgUploadHostname/diavwiki/6/64/Favicon.ico",
		'drunkenpeasantswikiwiki' => "//$wmgUploadHostname/drunkenpeasantswikiwiki/d/dc/HollowLogo2.png",
		'dwplivewiki' => "//$wmgUploadHostname/dwplivewiki/6/64/Favicon.ico",
		'etpowiki' => "//$wmgUploadHostname/etpowiki/1/1f/FaviconETPO.gif",
		'evawiki' => "//$wmgUploadHostname/evawiki/6/64/Favicon.ico",
		'forexwiki' => "//$wmgUploadHostname/forexwiki/6/64/Favicon.ico",
		'freecollegeprojectwiki' => "//$wmgUploadHostname/freecollegeprojectwiki/1/18/FreeCollegeProject.ico",
		'genwiki' => "//$wmgUploadHostname/genwiki/6/64/Favicon.ico",
		'grottocenterwiki' => "//$wmgUploadHostname/grottocenterwiki/6/64/Favicon.ico",
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/3/35/Favicon_%282%29.ico",
		'lexiquewiki' => "//$wmgUploadHostname/lexiquewiki/0/0f/Lexique_favicon.ico",
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
		'luckandlogicwiki' => "//$wmgUploadHostname/luckandlogicwiki/2/26/Favicon.png",
		'oneagencydunedinwiki' => "//$wmgUploadHostname/oneagencydunedinwiki/d/de/OneAgency_Favicon.png",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'openconstitutionwiki' => "//$wmgUploadHostname/openconstitutionwiki/e/e3/OpnConst_favicon.png",
		'partupwiki' => "//$wmgUploadHostname/partupwiki/6/64/Favicon.ico",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/6/64/Favicon.ico",
		'rwbyfrwiki' =>	"//$wmgUploadHostname/rwbyfrwiki/c/c8/RWBYfavicon.jpg",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/f/fc/Safiria_wiki_favicon.png",
		'saliorpediawiki' => "//$wmgUploadHostname/saliorpediawiki/a/ac/Favicon-1.png",
		'sfrepresentuswiki' => "//$wmgUploadHostname/sfrepresentuswiki/5/5c/Favicon_logo.png",
		'sirikotwiki' => '//sirikot.com/favicon.png',
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'sqlserverwiki' => "//$wmgUploadHostname/sqlserverwiki/6/64/Favicon.ico",
		'starsetonlinewiki' => "//$wmgUploadHostname/starsetonlinewiki/9/93/Wiki_favicon.ico",
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/9/93/Scwiki-favicon.png",
		'stoutofreachwiki' => "//$wmgUploadHostname/stoutofreachwiki/6/64/Favicon.ico",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/7/7f/Teleslogosmoler.png",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/6/64/Favicon.ico",
		'thelonsdalebattalionwiki' => "//$wmgUploadHostname/thelonsdalebattalionwiki/2/21/SoldiersFavicon.png",
		'themfbclubwiki' => "//$wmgUploadHostname/themfbclubwiki/6/64/Favicon.ico",
		'thoughtonomywikiwiki' => "//$wmgUploadHostname/thoughtonomywikiwiki/2/26/Favicon.png",
		'titreprovisoirewiki' => "//$wmgUploadHostname/titreprovisoirewiki/0/01/Favicon_titrepro.png",
		'universebuildwiki' => "//$wmgUploadHostname/universebuildwiki/f/fd/UniversebuildFavicon.png",
		'valentinaprojectwiki' => "//$wmgUploadHostname/valentinaprojectwiki/1/1d/Valentina_logo_favicon.png",
		'wdbwiki' => "//$wmgUploadHostname/wdbwiki/2/26/Dancing-135px.png",
		'webflowwiki' => "//$wmgUploadHostname/webflowwiki/6/64/Favicon.ico",
		'welcomewikiwiki' => "//$wmgUploadHostname/welcomewikiwiki/6/69/20150913_WelcomeWiki-Logo_Favicon32x32.png",
		'wikibookswiki' => "//$wmgUploadHostname/wikibookswiki/6/60/Wiki_favicon.png",
		'wikicervanteswiki' => "//$wmgUploadHostname/wikicervanteswiki/0/08/FaviconCervantes.ico",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/6/64/Favicon.ico",
		'wisdomsandboxwiki' => "//$wmgUploadHostname/wisdomsandboxwiki/6/64/Favicon.ico",
	),
	'wgLogo' => array(
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/3/3b/Wiki_logo.png",
		'aacenterpriselearningwiki' => "//$wmgUploadHostname/aacenterpriselearningwiki/c/c6/AACLogo.jpg",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/f/f1/APlogo.png",
		'adiaprojectwiki' => "//$wmgUploadHostname/adiaprojectwiki/8/8b/Adialogo.png",
		'adnovumwiki' => "//$wmgUploadHostname/adnovumwiki/f/fa/AdnovumRPtemplogo.png",
		'aenasanwiki' => "//$wmgUploadHostname/aenasanwiki/f/f1/AEicon1.png",
		'airwiki' => "//$wmgUploadHostname/airwiki/8/8e/Logo-scadta-133x133.gif",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/3/33/Logo-amafuwa.png",
		'allbanks2wiki' => "//$wmgUploadHostname/allbanks2wiki/7/7f/AllBanks2Logo.png",
		'allthetropeswiki' => "//$wmgUploadHostname/allthetropeswiki/8/86/Logo-Square-v1-1x.png",
		'applebranchwiki' => "//$wmgUploadHostname/applebranchwiki/0/03/AppleBranch_135.png",
		'astrowiki' => "//$wmgUploadHostname/astrowiki/6/6c/Astromagicka_logo.png",
		'anuwiki' => "//$wmgUploadHostname/anuwiki/8/8e/Anuwikilogo.png",
		'bakufuwiki' => "//$wmgUploadHostname/bakufuwiki/b/bc/Wiki.png",
		'bdorpwiki' => "//$wmgUploadHostname/bdorpwiki/2/22/Main_page.PNG",
		'beatstationwiki' => "//$wmgUploadHostname/beatstationwiki/d/da/Wiki_logo2.png",
		'biblicalwikiwiki' => "//$wmgUploadHostname/biblicalwikiwiki/e/e2/WikiLogo.svg",
		'burnoutwiki' => "//$wmgUploadHostname/burnoutwiki/0/0b/BURNOUTWIKI_LOGO_135px.png",
		'carvingwiki' => "//$wmgUploadHostname/carvingwiki/5/59/Snowflake135.png",
		'christipediawiki' => "//$wmgUploadHostname/christipediawiki/e/e7/Logo_Christipedia.jpg",
		'clementsworldbuildingwiki' => "//$wmgUploadHostname/clementsworldbuildingwiki/3/39/Cw_logo.png",
		'collabvmwiki' => "//$wmgUploadHostname/collabvmwiki/c/c9/Logo.png",
		'conuconwiki' => "//phabricator.miraheze.org/file/data/o6plmtjp4afd6vvxcx2m/PHID-FILE-fzbuutpmykupn5jz256h/CONUCON_small_face.png",
		'cssandjsschoolboardwiki' => "//upload.wikimedia.org/wikipedia/commons/c/c7/Css.png",
		'crankipediawiki' => "//$wmgUploadHostname/crankipediawiki/4/4c/Crankilogo.png",
		'datachronwiki' => "//$wmgUploadHostname/datachronwiki/f/f3/1408002974_WS.png",
		'decisorwiki' => "//$wmgUploadHostname/decisorwiki/8/87/DECISOR135x135.png",
		'dicficwiki' => "//$wmgUploadHostname/dicficwiki/b/b1/Dicfic-logo.png",
		'diggywikipolskawiki' => "//$wmgUploadHostname/diggywikipolskawiki/8/81/Logodiggy.png",
		'drunkenpeasantswikiwiki' => "//$wmgUploadHostname/drunkenpeasantswikiwiki/b/bc/Wiki.png",
		'dwplivewiki' => "//$wmgUploadHostname/dwplivewiki/c/c0/Logo_135.png",
		'eotewiki' => "//$wmgUploadHostname/eotewiki/6/64/Logo_triumph.png",
		'etpowiki' => "//$wmgUploadHostname/etpowiki/1/1f/LogoETPO.gif",
		'evawiki' => "//$wmgUploadHostname/evawiki/e/ec/EVA-Wiki.png",
		'fieldresearchwiki' => "//$wmgUploadHostname/fieldresearchwiki/d/d1/Logo_c.jpg",
		'fifamwiki' => "//$wmgUploadHostname/fifamwiki/0/0c/Wikilogo_160px.png",
		'fishpercolatorwiki' => "//$wmgUploadHostname/fishpercolatorwiki/d/d2/FPLogo.png",
		'frontdeskswiki' => "//$wmgUploadHostname/frontdeskswiki/b/b3/Fdawikilogo.png",
		'foodsharinghamburgwiki' => "//$wmgUploadHostname/foodsharinghamburgwiki/d/d2/FoodsharingHamburgLogo135px.jpg",
		'forexwiki' => "//$wmgUploadHostname/forexwiki/c/c9/Logo.png",
		'freecollegeprojectwiki' => "//$wmgUploadHostname/freecollegeprojectwiki/6/60/FC_Logo_135p.png",
		'fusiongpwiki' => "//$wmgUploadHostname/fusiongpwiki/f/f2/Fusion_Ball.png",
		'genwiki' => "//$wmgUploadHostname/genwiki/0/03/Genesis-logo-reized.png",
		'grottocenterwiki' => "//$wmgUploadHostname/grottocenterwiki/a/ac/Logo_grottocenter.png",
		'hshsinfoportalwiki' => "//$wmgUploadHostname/hshsinfoportalwiki/e/ec/HSHS_Logo.jpeg",
		'hsoodenwiki' => "//$wmgUploadHostname/hsoodenwiki/8/82/135px-wiki-logo-blank.png",
		'hydrawikiwiki' => "//$wmgUploadHostname/hydrawikiwiki/7/79/Hydra-logo.png",
		'lbsgeswiki' => "//$wmgUploadHostname/lbsgeswiki/0/05/WikiLogo.jpg",
		'lunfengwiki' => "//$wmgUploadHostname/lunfengwiki/b/bc/Wiki.png",
		'idleomenswiki' => "//$wmgUploadHostname/idleomenswiki/9/9e/IdleOmens-Logo.png",
		'idtestwiki' => "//$wmgUploadHostname/idtestwiki/b/bc/Wiki.png",
		'islamwissenschaftwiki' => "//$wmgUploadHostname/islamwissenschaftwiki/b/bc/Wiki.png",
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/e/eb/IZLogo.png",
		'lexiquewiki' =>  "//$wmgUploadHostname/lexiquewiki/6/6d/LibraryLexique-smallRes.png",
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
		'luckandlogicwiki' => "//$wmgUploadHostname/luckandlogicwiki/2/26/Favicon.png",
		'madgendersciencewiki' => "//$wmgUploadHostname/madgendersciencewiki/1/1f/Mgs_logo.jpg",
		'mafiawiki' => "//$wmgUploadHostname/mafiawiki/a/a6/Header.png",
		'make717wiki' => "//$wmgUploadHostname/make717wiki/thumb/f/fc/Make717_Logo.png/150px-Make717_Logo.png",
		'maiasongcontestwiki' => "//$wmgUploadHostname/maiasongcontestwiki/b/bc/Sitelogo.png",
		'makeiteasyautoswiki' => "//$wmgUploadHostname/makeiteasyautoswiki/0/01/Miea.png",
		'mcwiki' => "//$wmgUploadHostname/mcwiki/b/bc/Wiki.png",
		'mecanonwiki' => "//$wmgUploadHostname/mecanonwiki/8/85/Mecanon_logo.png",
		'mindgearwiki' => "//$wmgUploadHostname/mindgearwiki/3/36/Mind_Gear.png",
		'moralecwiki' => "//$wmgUploadHostname/moralecwiki/e/e8/Moralec-pluto.png",
		'newcolumbiawiki' => "//$wmgUploadHostname/newcolumbiawiki/2/2a/USNC_sunflower_logo.png",
		'nanopediawiki' => "//$wmgUploadHostname/nanopediawiki/c/c9/Logo.png",
		'oneagencydunedinwiki' => "//$wmgUploadHostname/oneagencydunedinwiki/e/eb/OneAgency_WikiLogo_Black.png",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'openconstitutionwiki' => "//$wmgUploadHostname/openconstitutionwiki/4/40/LOGO.png",
		'oyeavdelingenwiki' => "//$wmgUploadHostname/oyeavdelingenwiki/7/7b/OUS_Logo.png",
		'oneironautwiki' => "//$wmgUploadHostname/oneironautwiki/7/7b/Oneironaut-Wiki-logo.png",
		'partupwiki' => "//$wmgUploadHostname/partupwiki/a/a6/Part-up-logo-150x150-mediawiki.png",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/c/c0/Permanent-Future-Lab-logo-150x150-mediawiki.png",
		'plazmaburstwiki' => "//$wmgUploadHostname/plazmaburstwiki/6/6f/Plazmaburst-logo.png",
		'printmakingbewiki' => "//$wmgUploadHostname/printmakingbewiki/2/22/Pmk-logo-wiki-135px.png",
		'priyowiki' => "//$wmgUploadHostname/priyowiki/c/c9/Logo.png",
		'rebelalliancewiki' => "//$wmgUploadHostname/rebelalliancewiki/f/fe/Logo135.png",
		'reriawiki' => "//$wmgUploadHostname/reriawiki/a/a6/Header.png",
		'reiaasuwiki' => "//$wmgUploadHostname/reiaasuwiki/1/1e/Reiaasu-wiki-logo-1.png",
		'rwbyfrwiki' =>	"//$wmgUploadHostname/rwbyfrwiki/a/a3/RWBYLogo.jpeg",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/2/24/Newcoa_small.png",
		'sapperpediawiki' => "//$wmgUploadHostname/sapperpediawiki/f/f8/Sapperpedia_small.png",
		'saliorpediawiki' => "//$wmgUploadHostname/saliorpediawiki/9/98/BirdRoc.png",
		'sdeuropewiki' => "//$wmgUploadHostname/sdeuropewiki/d/d4/Logo.jpg",
		'sfrepresentuswiki' => "//$wmgUploadHostname/sfrepresentuswiki/4/41/RepUsLogo_small.png",
		'sirikotwiki' => '//www.sirikot.com/wiki_logo.png',
		'sjuhabitatwiki' => "//$wmgUploadHostname/sjuhabitatwiki/7/7a/Habi_logo_wiki.png",
		'skyfireflyffwiki' => "//$wmgUploadHostname/skyfireflyffwiki/c/c9/Logo.png",
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'sqlserverwiki' => "//$wmgUploadHostname/sqlserverwiki/d/d4/Logo.jpg",
		'spiralwiki' => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Spiral_project_logo.svg/135px-Spiral_project_logo.svg.png',
		'starsetonlinewiki' => "//$wmgUploadHostname/starsetonlinewiki/8/89/Wiki_logo.jpg",
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/d/d0/SCLogo2.png",
		'stormfmwiki' => "//$wmgUploadHostname/stormfmwiki/1/18/Stormlogo_small.png",
		'stoutofreachwiki' => "//$wmgUploadHostname/stoutofreachwiki/b/bc/Wiki.png",
		'studynotekrwiki' => "//$wmgUploadHostname/studynotekrwiki/b/b3/Imageedit_6_7597747851.gif",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/b/bc/Wiki.png",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/b/b6/Teleslogo01.png",
		'terriblespacewiki' => "//$wmgUploadHostname/terriblespacewiki/e/eb/Terrible_space_logo.png",
		'testwiki' => "//$wmgUploadHostname/testwiki/9/99/NewLogo.png",
		'thefosterswiki' => "//$wmgUploadHostname/thefosterswiki/archive/c/c9/20160726073101%21Logo.png",
		'thelonsdalebattalionwiki' => "//$wmgUploadHostname/thelonsdalebattalionwiki/2/22/SoldiersLogo.png",
		'themfbclubwiki' => "//$wmgUploadHostname/themfbclubwiki/b/bc/Wiki.png",
		'titreprovisoirewiki' => "//$wmgUploadHostname/titreprovisoirewiki/d/d4/Logo_titrepro.svg",
		'thoughtonomywikiwiki' => "//$wmgUploadHostname/thoughtonomywikiwiki/8/8c/ThoughtonomyLogo.png",
		'uprisewiki' => "//$wmgUploadHostname/uprisewiki/2/2e/DotLogo130px.png",
		'unikumwiki' => "//$wmgUploadHostname/unikumwiki/e/e0/Unikum_135x135.png",
		'universebuildwiki' => "//$wmgUploadHostname/universebuildwiki/2/2f/UniversebuildLogo.png",
		'valentinaprojectwiki' => "//$wmgUploadHostname/valentinaprojectwiki/2/25/Valentina_logo_v1.png",
		'vrgowiki' => "//$wmgUploadHostname/vrgowiki/4/4d/VRGO_logga.png",
		'wdbwiki' => "//$wmgUploadHostname/wdbwiki/2/26/Dancing-135px.png",
		'welcomewikiwiki' => "//$wmgUploadHostname/welcomewikiwiki/d/df/20150913_WelcomeWiki-Logo_TranspWritten135x135.png",
		'webflowwiki' => "//$wmgUploadHostname/webflowwiki/f/fb/Webflow-logo-raster-blue-2015.png",
		'webtoonwiki' => "//$wmgUploadHostname/webtoonwiki/b/ba/Webtoon_wiki_symbol.PNG",
		'wikiparkinsonwiki' => "//$wmgUploadHostname/wikiparkinsonwiki/f/fb/WikiParkinsonLogo-135.png",
		'whentheycrywiki' => "//$wmgUploadHostname/whentheycrywiki/b/b5/Logo_m.png",
		'worldbattlewiki' => "//$wmgUploadHostname/worldbattlewiki/4/40/Globe1.png",
		'worldofkirbycraftwiki' => "//$wmgUploadHostname/worldofkirbycraftwiki/2/2f/WoKWikiLogo.png",
		'worldpediawiki' => "//$wmgUploadHostname/worldpediawiki/b/bc/Wiki.png",
		'wikibookswiki' => "//$wmgUploadHostname/wikibookswiki/3/3b/Wiki_logo.png",
		'wikicervanteswiki' => "//$wmgUploadHostname/wikicervanteswiki/0/0c/LogodelWiki.png",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/0/02/WWlogo.png",
		'wisdomsandboxwiki' => "//$wmgUploadHostname/wisdomsandboxwiki/b/be/Sandbox_Logo.png",
		'yggdrasilwiki' => "//$wmgUploadHostname/yggdrasilwiki/c/cd/Yggdrasil-logo.png",
	),

	// Timezone
	'wgLocaltimezone' => array(
		'default' => 'UTC',
		'alanpediawiki' => 'Asia/Taipei',
		'carvingwiki' => 'America/Denver',
		'casuarinawiki' => 'Asia/Shanghai',
		'catboxwiki' => 'America/Detroit',
		'doraemonpediawiki' => 'Asia/Taipei',
		'libertywiki' => 'Asia/Seoul',
		'lunfengwiki' => 'Asia/Taipei',
		'ontariobrasswiki' => 'America/Toronto',
		'reviwiki' => 'Asia/Seoul',
		'rtwiki' => 'Asia/Seoul',
		'webtoonwiki' => 'Asia/Seoul',
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
			'spiral\.wiki',
			'anuwiki\.com',
		),
	),

	// VisualEditor
	'wmgVisualEditorEnableDefault' => array(
		'default' => true,
		'allthetropeswiki' => false,
		'panoramawiki' => false,
		'testwiki' => false,
	),
	'wmgVisualEditorAvailableNamespaces' => array(
		'default' => array(
			NS_MAIN => true,
			NS_USER => true,
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

require_once( "/srv/mediawiki/config/MissingWiki.php" );
require_once( "/srv/mediawiki/config/GlobalLogging.php" );
require_once( "/srv/mediawiki/config/RedisConfig.php" );

// Hard overrides that don't work when set in $wgConf->settings
$wgGroupPermissions['bureaucrat']['userrights'] = false;
$wgGroupPermissions['sysop']['bigdelete'] = false;

// Needs to be set AFTER $wgDBname is set to a correct value
$wgUploadDirectory = "/mnt/mediawiki-static/$wgDBname";
$wgUploadPath = "https://static.miraheze.org/$wgDBname";


if ( isset( $wgConf->settings['wmgPrivateWiki'][$wgDBname] ) ) {
	$wgGroupPermissions['*']['read'] = false;
	$wgGroupPermissions['user']['read'] = false;
	$wgGroupPermissions['member']['read'] = true;
	$wgGroupPermissions['sysop']['read'] = true;
	$wgConf->settings['wgAddGroups']['default']['bureaucrat'][] = 'member';
	$wgConf->settings['wgAddGroups']['default']['sysop'][] = 'member';
	$wgConf->settings['wgRemoveGroups']['default']['bureaucrat'][] = 'member';
	$wgConf->settings['wgRemoveGroups']['default']['sysop'][] = 'member';
	$wgWhitelistRead =
		array(
			"Main Page",
			"MediaWiki:Common.css",
			"Special:CentralAutoLogin",
			"Special:CentralLogin",
			"Special:ConfirmEmail",
			"Special:Notifications",
			"Special:ResetPassword",
			"Special:UserLogin",
			"Special:UserLogout",
		);
}

if ( isset( $wgConf->settings['wmgClosedWiki'][$wgDBname] ) ) {
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['createaccount'] = false;
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
}

$wgConf->wikis = $wgLocalDatabases;
$wgConf->extractAllGlobals( $wgDBname );

if ( isset( $wgCentralAuthAutoLoginWikis[$wmgHostname] ) ) {
	unset( $wgCentralAuthAutoLoginWikis[$wmgHostname] );
	$wgCentralAuthCookieDomain = $wmgHostname;
}

require_once( "/srv/mediawiki/config/LocalExtensions.php" );

# Timeline
putenv( "GDFONTPATH=/usr/share/fonts/truetype/freefont" );
$wgTimelineSettings->ploticusCommand = "/usr/bin/ploticus";
$wgTimelineSettings->perlCommand = "/usr/bin/perl";
$wgTimelineSettings->fontFile = 'FreeSans';

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

# ReCaptcha
$wgCaptchaClass = 'ReCaptchaNoCaptcha';
$wgReCaptchaSendRemoteIP = false; // Don't send users' IPs

# ircrcbot
if ( !isset( $wgConf->settings['wmgPrivateWiki'][$wgDBname] ) ) {
	$wgRCFeeds['irc'] = array(
		'formatter' => 'MirahezeIRCRCFeedFormatter',
		'uri' => 'udp://185.52.1.76:5070',
		'add_interwiki_prefix' => false,
		'omit_bots' => true,
	);
}

# Should be after LocalExtensions due to constants
if ( $wgDBname === 'allthetropeswiki' ) {
	$wgNamespaceContentModels[NS_TROPEWORKSHOP_TALK] = CONTENT_MODEL_FLOW_BOARD;
	$wgNamespaceContentModels[NS_REVIEWS] = CONTENT_MODEL_FLOW_BOARD;
}

# Will remove this later --SPF
if ( $wgDBname == 'extloadwiki' || $wgDBname == 'allthetropeswiki' ) {
	require_once( "$IP/extensions/DPLForum/DPLforum.php" );
	require_once( "$IP/extensions/SubPageList3/SubPageList3.php" );
}

$wgDefaultUserOptions['enotifwatchlistpages'] = 0;
$wgDefaultUserOptions['usebetatoolbar'] = 1;  
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1; 

$wgHooks['PrefsPasswordAudit'][] = 'onPrefsPasswordAuditTestWiki';
function onPrefsPasswordAuditTestWiki( $user, $newPass, $error ) {
	if ( $user->getName() == 'Example' ) {
		return "User not allowed to change password, Example account";
	}

		return true;
}

$wmgParsoidIPs = array( '185.52.1.144' );

// Alternative to forwarding user cookies to Parsoid
if ( !$wgCommandLineMode ) {
	if ( in_array( $_SERVER['REMOTE_ADDR'], $wmgParsoidIPs ) ) {
		$wgGroupPermissions['*']['read'] = true;
		$wgGroupPermissions['*']['edit'] = true;
	}
}

// TestWiki overrides
if ( $wgDBname === 'testwiki' ) {
	$wgGroupPermissions['sysop']['nuke'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
}

// WikiId Test overrides
if ( $wgDBname == 'idtestwiki' ) {
	$wgGroupPermissions['sysop']['nuke'] = false;
	$wgGroupPermissions['sysop']['blockemail'] = false;
	$wgGroupPermissions['sysop']['deletelogentry'] = false;
	$wgGroupPermissions['sysop']['editinterface'] = false;
	$wgGroupPermissions['sysop']['deletedtext'] = false;
}
if ( $wgDBname == 'metawiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'wfModifyMetaTags';

	function wfModifyMetaTags( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}
}

if ( $wgDBname == 'extloadwiki' ) {
	require_once( "$IP/extensions/OpenGraphMeta/OpenGraphMeta.php" );
}

if ( !file_exists( '/srv/mediawiki/w/cache/l10n/l10n_cache-en.cdb' ) ) {
        $wgLocalisationCacheConf['manualRecache'] = false;
}

// Global SiteNotice
/* $wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	$siteNotice .= <<<EOF
	<table class="wikitable" style="text-align:center;"><tbody><tr>
	<td><a href="https://meta.miraheze.org/wiki/Miraheze-1-year">The first anniversary of Miraheze is today! Come celebrate with us, as we reflect on our start and look to the future.</a> And please let us know how you feel about Miraheze by  <a href="http://goo.gl/forms/rHK82494r4SSGt7y2">taking our survey</a>, so that we can learn how to improve our service. Thank you all for reading and editing Miraheze wikis!</a>.</p></td>
	</tr></tbody></table>
EOF;

	return true;
} */
