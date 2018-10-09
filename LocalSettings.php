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
$wgLocalVirtualHosts = array( '81.4.109.166' );

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
define( 'NS_PSEUDO_NEWS', 1724);
define( 'NS_PSEUDO_NEWS_TALK', 1725);
define( 'NS_PSEUDO_BASE_DICTIONARY', 1726);
define( 'NS_PSEUDO_BASE_DICTIONARY_TALK', 1727);
define( 'NS_PSEUDO_BASE_LIBRARY', 1728);
define( 'NS_PSEUDO_BASE_LIBRARY_TALK', 1729);
define( 'NS_PSEUDO_BASE_MUSIC', 1730);
define( 'NS_PSEUDO_BASE_MUSIC_TALK', 1731);
define( 'NS_RGB', 1732);
define( 'NS_RGB_TALK', 1733);
define( 'NS_LINESTYLE', 1734);
define( 'NS_LINESTYLE_TALK', 1735);
define( 'NS_IDEA', 1736);
define( 'NS_IDEA_TALK', 1737);
define( 'NS_POLICY', 1738);
define( 'NS_POLICY_TALK', 1739);
define( 'NS_LEGACY', 1740);
define( 'NS_LEGACY_TALK', 1741);
define( 'NS_BOILERPLATE', 1742);
define( 'NS_BOILERPLATE_TALK', 1743);
define( 'NS_WPIMPORT', 1744);
define( 'NS_WPIMPORT_TALK', 1745);
define( 'NS_ARCHIVE', 1746);
define( 'NS_ARCHIVE_TALK', 1747);
define( 'NS_WPREDIRECT', 1748);
define( 'NS_WPREDIRECT_TALK', 1749);
define( 'NS_WALKTHROUGH', 1750);
define( 'NS_WALKTHROUGH_TALK', 1751);
define( 'NS_STAFF', 1752);
define( 'NS_STAFF_TALK', 1753);
define( 'NS_TEMA', 1754);
define( 'NS_TEMA_TALK', 1755);
define( 'NS_PAGE', 1756);
define( 'NS_PAGE_TALK', 1757);
define( 'NS_ANEXO', 1758);
define( 'NS_ANEXO_TALK', 1759);
define( 'NS_ESTUDIO', 1760);
define( 'NS_ESTUDIO_TALK', 1761);
define( 'NS_PRUEBA', 1762);
define( 'NS_PRUEBA_TALK', 1763);
define( 'NS_REGISTRO', 1764);
define( 'NS_REGISTRO_TALK', 1765);
define( 'NS_LISTA', 1766);
define( 'NS_LISTA_TALK', 1767);
define( 'NS_BUG', 1768);
define( 'NS_BUG_TALK', 1769);
define( 'NS_PROYECTO', 1770);
define( 'NS_PROYECTO_TALK', 1771);
define( 'NS_TALLER', 1772);
define( 'NS_TALLER_TALK', 1773);
define( 'NS_MODELO', 1774);
define( 'NS_MODELO_TALK', 1775);
define( 'NS_HANDBOOK', 1776);
define( 'NS_HANDBOOK_TALK', 1777);
define( 'NS_EXTENSION', 1778);
define( 'NS_EXTENSION_TALK', 1779);
define( 'NS_SKIN', 1780);
define( 'NS_SKIN_TALK', 1781);
define( 'NS_GAMEPAGE', 1782);
define( 'NS_GAMEPAGE_TALK', 1783);
define( 'NS_BOOK', 1784);
define( 'NS_BOOK_TALK', 1785);
define( 'NS_BOOK_NAVIGATION', 1786);
define( 'NS_BOOK_NAVIGATION_TALK', 1787);
define( 'NS_APPLICATION', 1788);
define( 'NS_APPLICATION_TALK', 1789);
define( 'NS_SUMMARY', 1790);
define( 'NS_SUMMARY_TALK', 1791);
define( 'NS_MANUAL', 1790);
define( 'NS_MANUAL_TALK', 1791);
define( 'NS_API', 1792);
define( 'NS_API_TALK', 1793);
define( 'NS_DATA', 1794);
define( 'NS_DATA_TALK', 1795);
define( 'NS_DICTIONARY', 1796);
define( 'NS_DICTIONARY_TALK', 1797);
define( 'NS_CALENDAR', 1798);
define( 'NS_CALENDAR_TALK', 1799);
define( 'NS_ENCYCLOPEDIA', 1800);
define( 'NS_ENCYCLOPEDIA_TALK', 1801);
define( 'NS_QURAN', 1802);
define( 'NS_QURAN_TALK', 1803);
define( 'NS_CYTATY', 1804);
define( 'NS_CYTATY_TALK', 1805);
define( 'NS_NONNEWS', 1806);
define( 'NS_NONNEWS_TALK', 1807);
define( 'NS_NONZRODLA', 1808);
define( 'NS_NONZRODLA_TALK', 1809);
define( 'NS_SLOWNIK', 1810);
define( 'NS_SLOWNIK_TALK', 1811);
define( 'NS_GRA', 1812);
define( 'NS_GRA_TALK', 1813);
define( 'NS_PORADNIK', 1814);
define( 'NS_PORADNIK_TALK', 1815);
define( 'NS_PORUM', 1816);
define( 'NS_PORUM_TALK', 1817);
define( 'NS_THREAD', 1818);
define( 'NS_THREAD_TALK', 1819);
define( 'NS_MESSAGE_WALL', 1820);
define( 'NS_MESSAGE_WALL_TALK', 1821);
define( 'NS_USER_BLOG', 1822);
define( 'NS_USER_BLOG_TALK', 1823);
define( 'NS_USER_BLOG_COMMENT', 1824);
define( 'NS_USER_BLOG_COMMENT_TALK', 1825);
define( 'NS_HUB', 1826);
define( 'NS_HUB_TALK', 1827);
define( 'NS_LIST', 1828);
define( 'NS_LIST_TALK', 1829);
define( 'NS_LAW', 1830);
define( 'NS_LAW_AMENDING', 1831);
define( 'NS_EXECUTIVE_ORDER', 1832);
define( 'NS_EXECUTIVE_ORDER_TALK', 1833);
define( 'NS_GROUP', 1834);
define( 'NS_GROUP_TALK', 1835);

define( 'NS_PORTALE', 2000); // Skipping values to 2000 per T3553
define( 'NS_DISCUSSIONI_PORTALE', 2001);
define( 'NS_PROGETTO', 2002);
define( 'NS_DISCUSSIONI_PROGETTO', 2010);
define( 'NS_CIMITERO', 2011);
define( 'NS_NONNOTIZIE', 2012);
define( 'NS_DISCUSSIONI_NONNOTIZIE', 2013);
define( 'NS_NONVOYAGE', 2014);
define( 'NS_DISCUSSIONI_NONVOYAGE', 2015);
define( 'NS_NONQUOTE', 2020);
define( 'NS_DISCUSSIONI_NONQUOTE', 2021);
define( 'NS_NONDIZIONARiO', 2022);
define( 'NS_DISCUSSIONI_NONDIZIONARIO', 2023);
define( 'NS_NONVERSITA', 2024);
define( 'NS_DISCUSSIONI_NONVERVISTA', 2025);
define( 'NS_NONSOURCE', 2026);
define( 'NS_DISCUSSIONI_NONSOURCE', 2027);
define( 'NS_NONBOOKS', 2028);
define( 'NS_DISCUSSIONI_NONBOOKS', 2029);
define( 'NS_DISCUSSIONI_CIMITERO', 2030);
define( 'NS_FANWORK', 2032);
define( 'NS_FANWORK_TALK', 2033);

// Refer to NS_MODULE before importing Scribunto (tmewiki)
define( 'WMG_NS_MODULE', 828 );
define( 'WMG_NS_MODULE_TALK', 829 );

// Special namespace re-defined
define( 'NS_PROOFREAD_PAGE', 250);
define( 'NS_PROOFREAD_PAGE_TALK', 251);
define( 'NS_PROOFREAD_INDEX', 252);
define( 'NS_PROOFREAD_INDEX_TALK', 253);

// NS 860, 861, 862, 863 allocated for Item/Item_talk/Property/Property_talk by Wikibase

$wgConf->settings = array(
	// invalidates user sessions
	'wgAuthenticationTokenVersion' => array(
		'default' => '3',
	),

	// AbuseFilter
	'wgAbuseFilterActions' => array(
		'default' => array(
			'block' => true,
			'blockautopromote' => true,
			'degroup' => true,
			'disallow' => true,
			'rangeblock' => true,
			'tag' => true,
			'throttle' => true,
			'warn' => true,
		),
	),
	'wgAbuseFilterCentralDB' => array(
		'default' => 'metawiki',
	),
	'wgAbuseFilterIsCentral' => array(
		'default' => false,
		'metawiki' => true,
	),
	'wgAbuseFilterBlockDuration' => array(
		'default' => 'indefinte',
		'weatherwiki' => '1 week',
	),
	'wgAbuseFilterAnonBlockDuration' => array(
		'default' => 2592000,
		'weatherwiki' => '72 hours',
	),
	'wgAbuseFilterRestrictions' => array(
 		'default' => array(
 			'blockautopromote' => true,
 			'block' => true,
 			'degroup' => true,
 			'rangeblock' => true,
 		),
 		'weatherwiki' => array(
 			'blockautopromote' => false,
			'block' => false,
 			'degroup' => false,
 			'rangeblock' => true,
		),
	),
	// Anti-spam
	'wgAccountCreationThrottle' => array(
		'default' => 5,
		'proxybotwiki' => 7,
		'weatherwiki' => 6,
	),
	'wgAutoConfirmAge' => array(
		'default' => 345600, // 4 days * 24 hours * 60 minutes * 60 seconds
		'marioserieswikiwiki' => 2592000, // 30 days * 24 hours * 60 minutes * 60 seconds 
		'proxybotwiki' => 604800, // 7 days * 24 hours * 60 minutes * 60 seconds
	),
	'wgAutoConfirmCount' => array(
		'default' => 10,
		'marioserieswikiwiki' => 500, 
	),

	// BetaFeatures
	'wgMediaViewerIsInBeta' => array(
		'default' => false,
	),
	'wgPopupsBetaFeature' => array(
		'default' => false,
	),
	'wgVisualEditorEnableWikitext' => array(
		'default' => false,
	),
	'wgPivotFeatures' => array(
		'thegreatwarwiki' => array(
			'usePivotTabs' => true,
			'fixedNavBar' => true,
			'showHelpUnderTools' => false,
			'showRecentChangesUnderTools' => false,
			'wikiNameDesktop' => 'The Great War 1914-1918',
			'showFooterIcons' => true
		),
	),
	'wgEnableRcFiltersBetaFeature' => array(
		'default' => false,
		'test1wiki' => true,
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
		'default' => 'mhglobal',
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
	'wgRevisionCacheExpiry' => array(
		'default' => 0,
	),

	// CentralNotice
	'wgNoticeInfrastructure' => array(
		'default' => false,
		'metawiki' => true,
	),
	'wgCentralSelectedBannerDispatcher' => array(
		'default' => "//meta.miraheze.org/w/index.php/Special:BannerLoader",
	),
	'wgCentralBannerRecorder' => array(
		'default' => "//meta.miraheze.org/w/index.php/Special:RecordImpression",
	),
	'wgCentralDBname' => array(
		'default' => 'metawiki',
	),
	'wgNoticeProjects' => array(
		'default' => array( 'closed', 'private', 'open' ),
	),
	'wgCentralHost' => array(
		'default' => "//meta.miraheze.org",
	),
	'wgNoticeProject' => array(
		'default' => 'open',
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
	'wgCentralAuthAutoMigrate' => array(
		'default' => true,
	),
	'wgCentralAuthAutoMigrateNonGlobalAccounts' => array(
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
		'nenawikiwiki' => false,
	),
	'wgCentralAuthDatabase' => array(
		'default' => 'mhglobal',
	),
	'wgCentralAuthEnableGlobalRenameRequest' => array(
		'default' => false,
		'metawiki' => true,
	),
	'wgCentralAuthLoginWiki' => array(
		'default' => 'loginwiki',
	),
	'wgCentralAuthPreventUnattached' => array(
		'default' => true,
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

	'wgCommentsInRecentChanges' => array(
		'default' => false,
		'newusopediawiki' => true,
	),

	'wgCommentsSortDescending' => array(
		'default' => false,
		'newusopediawiki' => true,
	),

	 // Contribution Scores
	 'wgContribScoreDisableCache' => array(
 		 'default' => true,
 	 ),

	// CreateWiki
	'wgCreateWikiCustomDomainPage' => array(
		'default' => 'Special:MyLanguage/Custom_domains',
	),
	'wgCreateWikiDatabase' => array(
		'default' => 'mhglobal',
	),
	'wgCreateWikiGlobalWiki' => array(
		'default' => 'metawiki',
	),
	'wgCreateWikiDBDirectory' => array(
		'default' => '/srv/mediawiki/dblist',
	),
	'wgCreateWikiEmailNotifications' => array(
		'default' => true,
	),
	'wgCreateWikiNotificationEmail' => array(
		'default' => 'staff@miraheze.org',
	),
	'wgCreateWikiSQLfiles' => array(
		'default' => array(
			"$IP/maintenance/tables.sql",
			"$IP/extensions/AbuseFilter/abusefilter.tables.sql",
			"$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_info.sql",
			"$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_vote.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/ApprovedRevs/sql/ApprovedRevs.sql",
			"$IP/extensions/ArticleFeedbackv5/sql/ArticleFeedbackv5.sql",
			"$IP/extensions/ArticleRatings/ratings.sql",
			"$IP/extensions/BetaFeatures/sql/create_counts.sql",
			"$IP/extensions/Cargo/sql/Cargo.sql",
			"$IP/extensions/CheckUser/cu_log.sql",
			"$IP/extensions/CheckUser/cu_changes.sql",
			"$IP/extensions/Comments/sql/comments.sql",
			"$IP/extensions/GeoData/sql/db-backed.sql",
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
			"$IP/extensions/Moderation/sql/patch-moderation.sql",
			"$IP/extensions/Moderation/sql/patch-moderation_block.sql",
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
			"$IP/extensions/PollNY/sql/poll.sql",
			"$IP/extensions/ProofreadPage/sql/ProofreadIndex.sql",
			"$IP/extensions/QuizGame/sql/quizgame.sql",
			"$IP/extensions/SocialProfile/UserProfile/sql/user_profile.sql",
			"$IP/extensions/SocialProfile/UserProfile/sql/user_fields_privacy.sql",
			"$IP/extensions/SocialProfile/UserStats/sql/user_system_messages.sql",
			"$IP/extensions/SocialProfile/UserStats/sql/user_points_monthly.sql",
			"$IP/extensions/SocialProfile/UserStats/sql/user_points_archive.sql",
			"$IP/extensions/SocialProfile/UserStats/sql/user_points_weekly.sql",
			"$IP/extensions/SocialProfile/UserStats/sql/user_stats.sql",
			"$IP/extensions/SocialProfile/SystemGifts/sql/systemgifts.sql",
			"$IP/extensions/SocialProfile/UserRelationship/sql/user_relationship.sql",
			"$IP/extensions/SocialProfile/UserGifts/sql/usergifts.sql",
			"$IP/extensions/SocialProfile/UserBoard/sql/user_board.sql",
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
			"$IP/extensions/VoteNY/sql/vote.mysql",
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
	'wgCreateWikiCategories' => array(
		'default' => array(
			'Community' => 'community',
			'Education' => 'education',
			'Electronics' => 'eletronics',
			'Fandom' => 'fandom',
			'Fantasy' => 'fantasy',
			'Gaming' => 'gaming',
			'Geography' => 'geography',
			'Leisure' => 'leisure',
			'Literature/Writing' => 'literature',
			'Medicine/Medical' => 'medical',
			'Military/War' => 'military',
			'Music' => 'music',
			'Podcast' => 'podcast',
			'Private' => 'private',
			'Religion' => 'religion',
			'Software/Computing' => 'software',
			'Sports' => 'sport',
			'Uncategorised' => 'uncategorised',
		),
	),
	'wgCreateWikiUseCategories' => array(
		'default' => true,
	),
	'wgCreateWikiSubdomain' => array(
		'default' => 'miraheze.org',
	),
	'wgCreateWikiUseClosedWikis' => array(
		'default' => true,
	),
	'wgCreateWikiUseCustomDomains' => array(
		'default' => true,
	),
	'wgCreateWikiUseInactiveWikis' => array(
		'default' => true,
	),
	'wgCreateWikiUsePrivateWikis' => array(
		'default' => true,
	),

	// Cookies extension settings
	'wgCookieWarningMoreUrl' => array(
		'default' => 'https://meta.miraheze.org/wiki/Privacy_Policy#4._Cookies',
		'thelonsdalebattalionwiki' => 'https://thelonsdalebattalion.co.uk/wiki/The_Lonsdale_Battalion:Cookies'
	),
	'wgCookieSetOnAutoblock' => array(
		'default' => true,
		'weatherwiki' => false,
	),
	'wgCookieWarningEnabled' => array(
		'default' => true,
	),
	'wgCookieWarningGeoIPLookup' => array(
		'default' => 'php',
	),
	'wgCookieWarningGeoIp2' => array(
		'default' => true,
	),
	'wgCookieWarningGeoIp2Path' => array(
		'default' => '/srv/GeoLite2-City.mmdb',
	),
	// RC feed
	'wgStructuredChangeFiltersShowPreference' => array(
		'default' => true,
		'reviwiki' => false,
		'reviwikiwiki' => false,
	),
	'wgStructuredChangeFiltersShowWatchlistPreference' => array(
		'default' => true,
	),
	'wgStructuredChangeFiltersOnWatchlist' => array(
		'default' => true,
	),
	// Database
	'wgAllowSchemaUpdates' => array(
		'default' => false,
	),
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
	
	'wgMaxImageArea' => array(
		'default' => '1.25e7',
		'altversewiki' => '2.5e7',
		'nonbinarywiki' => '2.5e7',
	),

	// Delete
	'wgDeleteRevisionsLimit' => array(
		'default' => '250', // databases don't have much memory - let's not overload them in future
	),

	// DJVU
	'wgDjvuDump' => array(
		'default' => '/usr/bin/djvudump',
	),
	'wgDjvuRenderer' => array(
		'default' => '/usr/bin/ddjvu',
	),
	'wgDjvuTxt' => array(
		'default' => '/usr/bin/djvutxt',
	),
	'wgPFEnableStringFunctions' => array(
		'default' => false,
	),
	'wgAllowSlowParserFunctions' => array(
		'default' => false,
	),

	// Echo
	'wgEchoCrossWikiNotifications' => array(
		'default' => true,
		'weatherwiki' => false,
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
		'weatherwiki' => false,
	),
	// Exempt from Robot Control (INDEX/NOINDEX namespaces)
 	'wgExemptFromUserRobotsControl' => array(
 		'default' => $wgContentNamespaces,
 		'thelonsdalebattalionwiki' => array(),
 	),

	// Extensions and Skins
	'wmgUse3D' => array(
		'default' => false,
	),
	'wmgUseAddThis' => array(
		'default' => false,
	),
	'wmgUseAddHTMLMetaAndTitle' => array(
		'default' => false,
	),
	'wmgUseAdminLinks' => array(
		'default' => false,
	),
	'wmgUseAJAXPoll' => array(
		'default' => false,
	),
	'wmgUseApex' => array(
		'default' => false,
	),
	'wmgUseApprovedRevs' => array(
		'default' => false,
	),
	'wmgUseArticleFeedbackv5' => array(
		'default' => false,
	),
	'wmgUseArticleRatings' => array(
		'default' => false,
	),
	'wmgUseArticleToCategory2' => array(
		'default' => false,
	),
	'wmgUseAuthorProtect' => array(
		'default' => false,
	),
	'wmgUseAutoCreateCategoryPages' => array(
		'default' => false, // DO NOT enable on wikis that have more than 500 categories. See T1230
	),
	'wmgUseBlogPage' => array(
		'default' => false,
	),
	'wmgUseBabel' => array(
		'default' => false,
	),
	'wmgUseMSCalendar' => array(
		'default' => false,
	),
	'wmgUseCapiunto' => array(
		'default' => false,
	),
	'wmgUseCargo' => array(
		'default' => false,
	),
	'wmgUseCategoryTree' => array(
		'default' => true,
		'whentheycrywiki' => false,
	),
	'wmgUseCharInsert' => array(
		'default' => false,
	),
	'wmgUseCite' => array(
		'default' => false,
	),
	'wmgUseCiteThisPage' => array(
		'default' => false,
	),
	'wmgUseCodeEditor' => array(
		'default' => false,
	),
	'wmgUseCodeMirror' => array(
		'default' => false,
	),
	'wmgUseCollapsibleVector' => array(
		'default' => false,
	),
	'wmgUseCollection' => array(
		'default'  => false,
	),
	'wmgUseComments' => array(
		'default' => false, // Sysop has 'commentadmin' by default
	),
	'wmgUseContactPage' => array(
		'default' => false, // Add wiki config to ContactPage.php
		'apellidosmurcianoswiki' => true,
		'ayrshirewiki' => true,
		'christipediawiki' => true,
		'cdcwiki' => true,
		'fablabesdswiki' => true,
		'test1wiki' => true,
	),
	'wmgUseContributionScores' => array(
		'default' => false,
	),
	'wmgUseCreatePage' => array(
		'default' => false,
	),
	'wmgUseCreateRedirect' => array(
		'default' => false,
	),
	'wmgUseCrossReference' => array(
		'default' => false,
	),
	'wmgUseCSS' => array(
		'default' => false,
	),
	'wmgUseCustomHeader' => array(
		'default' => false,
		'hlptestwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseDarkVector' => array(
		'default' => false,
	),
	'wmgUseDescription2' => array(
		'default' => false,
	),
	'wmgUseDisambiguator' => array(
		'default' => false,
	),
	'wmgUseDismissableSiteNotice' => array(
		'default' => true,
	),
	'wmgUseDuskToDawn' => array(
		'default' => false,
	),
	'wmgUseDonateBoxInSidebar' => array( # Disabled for now --Rececption123
		'default' => false,
		'metawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseDPLForum' => array(
		'default' => false,
	),
	'wmgUseDuplicator' => array(
		'default' => false,
	),
	'wmgUseDynamicPageList' => array( // DynamicPageList and DynamicPageList3 should NOT be enabled together; they do not work together
		'default' => false,
	),
	'wmgUseDynamicPageList3' => array( // DynamicPageList and DynamicPageList3 should NOT be enabled together; they do not work together
		'default' => false,
	),
	'wmgUseEditcount' => array(
		'default' => false,
	),
	'wmgUseEditSubpages' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseEducationProgram' => array(
		'default' => false,
	),
	'wmgUseElectronPdfService' => array(
		'default' => false,
	),
	'wmgUseErudite' => array(
		'default' => false,
	),
	'wmgUseEventLogging' => array(
		'default' => false,
	),
	'wmgUseFancyBoxThumbs' => array(
		'default' => false,
	),
	'wmgUseFeaturedFeeds' => array(
		'default' => false, // Not enabled anywhere?
	),
	'wmgUseFlaggedRevs' => array(
		'default' => false,
	),
	'wmgUseFlow' => array(
		'default' => false, // Please make sure MediaWiki services is enabled on the wiki in the services.yaml file in the services repo
	),
	'wmgUseForeground' => array(
		'default' => false,
	),
	'wmgUseGadgets' => array(
		'default' => false,
	),
	'wmgUseGamepress' => array(
		'default' => false,
	),
	'wmgUseGeoCrumbs' => array(
		'default' => false,
	),
	'wmgUseGeoData' => array(
		'default' => false,
	),
	'wmgUseGettingStarted' => array(
		'default' => false,
	),
	'wmgUseGlobalUserPage' => array(
		'default' => true,
		'reviwikiwiki' => false, // T3671
	),
	'wmgUseGraph' => array(
		'default' => false,
	),
	'wmgUseGroupsSidebar' => array(
		'default' => false,
	),
	'wmgUseGuidedTour' => array(
		'default' => false,
	),
	'wmgUseHAWelcome' => array(
		'default' => false,
	),
	'wmgUseHeaderTabs' => array(
		'default' => false,
	),
	'wmgUseHideSection' => array(
		'default' => false,
	),
	'wmgUseHighlightLinksInCategory' => array(
		'default' => false,
	),
	'wmgUseImageMap' => array(
		'default' => false,
	),
	'wmgUseImageRating' => array(
		'default' => false,
	),
	'wmgUseInputBox' => array(
		'default' => false,
	),
	'wmgUseJavascriptSlideshow' => array(
		'default' => false,
	),
	'wmgUseJosa' => array(
		'default' => false,
	),
	'wmgUseJSBreadCrumbs' => array(
		'default' => false,
	),
	'wmgUseKartographer' => array(
                'default' => false,
	),
	'wmgUseLabeledSectionTransclusion' => array(
		'default' => false,
	),
	'wmgUseLiberty' => array(
		'default' => false,
	),
	'wmgUseLinkSuggest' => array(
		'default' => false,
		'test1wiki' => true,
		'avalicearchiveswiki' => true,
	),
	'wmgUseLinkTarget' => array(
		'default' => false,
	),
	'wmgUseListings' => array(
		'default' => false,
	),
	'wmgUseLoopsCombo' => array(
		'default' => false,
	),
	'wmgUseMagicNoCache' => array(
		'default' => false,
	),
	'wmgUseMaps' => array(
		'default' => false,
	),
	'wmgUseMassEditRegex' => array(
		'default' => false, // sysop is given permission 'masseditregex' by default
	),
	'wmgUseMassMessage' => array(
		'default' => false,
	),
	'wmgUseMath' => array(
		'default' => false,
	),
	'wmgUseMediaWikiChat' => array(
		'default' => false,
	),
	'wmgUseMetrolook' => array(
		'default' => false,
	),
	'wmgUseMobileFrontend' => array(
		'default' => true,
		'carmeigatwiki' => false,
		'cmgwiki' => false,
		'corydoctorowwiki' => false,
		'horizonwiki' => false,
		'izanagiwiki' => false,
		'jawptestwiki' => false,
		'macfan4000wiki' => false,
		'nestartstechwiki' => false, // Re-enable when collapse issue is fixed --Reception123
		'ndwiki' => false,
		'permanentfuturelabwiki' => false,
		'reviwiki' => false,
		'reviwikiwiki' => false,
	),
	'wmgUseModeration' => array( // Don't forget to also set the 'moderation' right.
		'default' => false,
		'nenawikiwiki' => true,
		'sdiywiki' => false,
		'studentspoweringchangewiki' => true,
		'test1wiki' => true,
	),
	'wmgUseModernSkylight' => array(
		'default' => false,
	),
	'wmgUseMsPackage' => array(
		'default' => false, // do not set this to false without disabling MsUpload on all wikis below
		'calexitwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseMsUpload' => array(
		'default' => false,
	),
	'wmgUseMultimediaViewer' => array(
		'default' => false,
	),
	'wmgUseMultiBoilerplate' => array(
		'default' => false,
	),
	'wmgUseNewestPages' => array(
		'default' => false,
	),
	'wmgUseNews' => array(
		'default' => false,
	),
	'wmgUseNewSignupPage' => array(
		'default' => false,
	),
	'wmgUseNewsletter' => array(
		'default' => false,
	),
	'wmgUseNewUserMessage' => array(
		'default' => false,
	),
	'wmgUseNewUserNotif' => array(
		'default' => false,
	),
	'wmgUseNostalgia' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseNoTitle' => array(
		'default' => false,
	),
	'wmgUseNukeDPL' => array(
		'default' => false,
	),
	'wmgUseOpenGraphMeta' => array(
		'default' => false,
	),
	'wmgUsePagedTiffHandler' => array(
		'default' => false,
	),
	'wmgUsePageForms' => array(
		'default' => false,
	),
	'wmgUsePageNotice' => array(
		'default' => false,
	),
	'wmgUsePageTriage' => array(
		'default' => false,
	),
	'wmgUsePdfBook' => array(
		'default' => false,
	),
	'wmgUsePDFEmbed' => array(
		'default' => false,
	),
	'wmgUsePdfHandler' => array(
		'default' => false,
	),
	'wmgUsePipeEscape' => array(
		'default' => false,
	),
	'wmgUsePivot' => array(
		'default' => false,
	),
	'wmgUsePoem' => array(
		'default' => false,
	),
	'wmgUsePopups' => array(
		'default' => false,
	),
	'wmgUsePoll' => array(
		'default' => false,
	),
	'wmgUsePollNY' => array(
		'default' => false,
	),
	'wmgUseProofreadPage' => array(
		'default' => false,
	),
	'wmgUseProtectSite' => array(
		'default' => false,
	),
	'wmgUsePurge' => array(
		'default' => false,
	),
	'wmgUseQuiz' => array(
		'default' => false,
	),
	'wmgUseQuizGame' => array(
		'default' => false,
	),
	'wmgUseRandomGameUnit' => array(
		'default' => false,
	),
	'wmgUseRandomImage' => array(
		'default' => false,
	),
	'wmgUseRandomSelection' => array(
		'default' => false,
	),
	'wmgUseRefreshed' => array(
		'default' => false,
	),
	'wmgUseRelatedArticles' => array(
		'default' => false,
	),
	'wmgUseReplaceText' => array(
		'default' => false,
	),
	'wmgUseRevisionSlider' => array(
		'default' => false,
	),
	'wmgUseRSS' => array(
		'default' => false,
	),
	'wmgUseSandboxLink' => array(
		'default' => false,
	),
	'wmgUseScore' => array(
		'default' => false,
	),
	'wmgUseScratchBlocks' => array(
		'default' => false,
	),
	'wmgUseShortURL' => array(
		'default' => true,
		'macfan4000wiki' => false,
	),
	'wmgUseSimpleChanges' => array(
		'default' => false,
	),
	'wmgUseSimpleTooltip' => array(
		'default' => false,
	),
	'wmgUseSiteScout' => array(
		'default' => false,
	),
	// Requires copying of two directories: https://www.mediawiki.org/wiki/Extension:SocialProfile#Directories
	// Should be this, but change $nameofwiki at the end:
	// sudo -u www-data cp -R /srv/mediawiki/w/extensions/SocialProfile/avatars /srv/mediawiki/w/extensions/SocialProfile/awards /mnt/mediawiki-static/$nameofwiki/
	'wmgUseSocialProfile' => array(
		'default' => false,
	),
	'wmgUseSpoilers' => array(
		'default' => false,
	),
	'wmgUseSubpageFun' => array(
		'default' => false,
	),
	'wmgUseSubPageList3' => array(
		'default' => false,
	),
	'wgScribuntoUseGeSHi' => array(
		'default' => true,
	),
	// Combo of Tabs + Tabber
	'wmgUseTabsCombination' => array(
		'default' => false,
	),
	'wmgUseTemplateSandbox' => array(
		'default' => false,
	),
	'wmgUseTemplateStyles' => array(
		'default' => false,
	),
	'wmgUseTheme' => array(
		'default' => false,
	),
	'wmgUseTimedMediaHandler' => array(
		'default' => false,
	),
	'wmgUseTimeline' => array(
		'default' => false,
	),
	'wmgUseThanks' => array(
		'default' => false,
	),
	'wmgUseTitleKey' => array(
		'default' => false,
	),
	'wmgUseTocTree' => array(
		'default' => false,
	),
	'wmgUseTranslate' => array(
		'default' => false,
	),
	'wmgUseTweeki' => array(
		'default' => false,
	),
	'wmgUseTwoColConflict' => array(
		'default' => false,
	),
	'wmgUseUniversalLanguageSelector' => array(
		'default' => false,
	),
	'wmgUseUploadsLink' => array(
		'default' => false,
	),
	'wmgUseUrlGetParameters' => array(
		'default' => false,
	),
	'wmgUseUserWelcome' => array(
		'default' => false,
	),
	'wmgUseVoteNY' => array(
		'default' => false,
	),
	'wmgUseVisualEditor' => array(
		'default' => false, // Please make sure MediaWiki services is enabled on the wiki in the services.yaml file in the services repo
	),
	'wmgUseVariables' => array(
		'default' => false,
	),
	'wmgUseWebChat' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'ildrilwiki' => true,
		'lothuialethwiki' => true,
		'marioserieswiki' => true,
		'pnphilotenwiki' => true,
		'test1wiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseWhoIsWatching' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseWidgets' => array(
		'default' => false,
	),
	'wmgUseWikibaseRepository' => array(
		'default' => false,
	),
	'wmgUseWikidataPageBanner' => array(
		'default' => false,
	),
	'wmgUseWikiForum' => array(
		'default' => false,
	),
	'wmgUsewikihiero' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseWikimediaIncubator' => array(
		'default' => false,
		'incubatorwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseWikiLove' => array(
		'default' => false,
	),
	'wmgUseWikiTextLoggedInOut' => array(
		'default' => false,
	),
	'wmgUseYouTube' => array(
		'default' => false,
	),

	// External link target
	'wgExternalLinkTarget' => array(
		'default' => false,
		'cpiwiki' => '_blank',
		'doinwiki' => '_blank',
		'forexwiki' => '_blank',
		'modularwiki' => true,
		'nenawikiwiki' => '_blank',
		'scruffywiki' => '_blank',
		'sdiywiki' => '_blank',
		'sylwiki' => '_blank',
		'templatewiki' => '_blank',		
		'wisdomwikiwiki' => '_blank',
		'yacresourceswiki' => '_blank',
	),


	// Allow External Images
	'wgAllowExternalImages' => array(
		'default' => false,
		'amicitiawiki' => true,
		'magezwiki' => true,
		'magnaversewiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'travailcollaboratifwiki' => true,
		'sitraduwiki' => true,
	),
	'wgAllowExternalImagesFrom' => array(
		'default' => false,
		'astrobiologywiki' => array(
			'https://www.science20.com',
			'https://quora.com',
			'https://robertinventor.com',
		),
		'doomsdaydebunkedwiki' => array(
			'https://www.science20.com',
			'https://quora.com',
			'https://robertinventor.com',
		),
	),

	// Allow HTML <img> tag
	'wgAllowImageTag' => array(
		'default' => false,
		'horizonwiki' => true,
		'magezwiki' => true,
		'mikrodevwiki' => true,
		'travailcollaboratifwiki' => true,
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
			WMG_NS_MODULE,
			NS_LIBRARY,
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
		'infectopedwiki' => array(
			'accuracy' => array( 
				'levels' => 3, 
				'quality' => 2, 
				'pristine' => 4,
			),
			'depth' => array( 
				'levels' => 3, 
				'quality' => 2, 
				'pristine' => 4,
			),
			'tone' => array( 
				'levels' => 3, 
				'quality' => 1, 
				'pristine' => 4,
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
	'wmgSimpleFlaggedRevsUI' => array(
		'default' => true,
		'infectopedwiki' => false,
	),
	'wmgFlaggedRevsLowProfile' => array(
		'default' => true,
		'infectopedwiki' => false,
	),

	// Files
	'wgEnableUploads' => array(
		'default' => true,
	),
	'wgAllowCopyUploads' => array(
		'default' => false,
		'entropediawiki' => true,
		'macfan4000wiki' => true,
		'ndwiki' => true,
		'nerdzonewiki' => true,
		'nonbinarywiki' => true,
	),
	'wgAllowTitlesInSVG' => array(
		'default' => false,
		'vsfan' => true,
	),
	'wgCopyUploadsFromSpecialUpload' => array(
		'default' => false,
		'entropediawiki' => true,
		'macfan4000wiki' => true,
		'ndwiki' => true,
		'nerdzonewiki' => true,
	),
	'wgFileExtensions' => array(
		'default' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu' ),
		'+amaninfowiki' => array('pcap', 'cap' ),
		'+avalicearchiveswiki' => array('exe', 'zip', 'css', 'woff', 'woff2', 'ttf' ),
		'+bigforestwiki' => array( 'apng', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'doc', 'docx', 'txt', 'rtf', 'htm', 'html', 'xml', 'ppt', 'pptx' ),
		'+bsaikatsuwiki' => array( 'oga', 'ogx' ),
		'+cmgwiki' => array('html', 'htm', 'pdf', 'ppt', 'pptx', 'xls', 'xlxs', 'zip', 'py', 'js', 'php', 'tar', 'gz', 'crt'),
		'+csnimsbordeauxwiki' => array( 'docx', 'xlsx', 'pptx', 'pub', 'xps', 'odt', 'ods', 'odp', 'odg', 'otg', 'rar', 'tar', 'gz', 'gz2', 'bz', 'bz2', 'zip', 'ipe', 'dia', 'svg', 'bib', 'add', 'spl', 'cls', 'tex', 'bst', 'sh', 'bat', 'gp', 'dat', 'fig', 'sty', 'py', 'cpp', 'hpp', 'hxx', 'c', 'h', 'mat', 'txt', 'desktop', 'md', 'perf', 'plot', 'data', 'xml', 'html', 'alist' ),
		'+doinwiki' => array('pdf', 'ppt', 'pptx', 'xls', 'xlxs', 'zip' ),
		'+exercicesdefrancaisprodfrwiki' => array('html', 'htm' ),
		'+exitsincwiki' => array('txt' ),
		'+fawiki' => array('ttf', 'eot', 'woff', 'apk'),
		'+indrikwiki' => array('mp3', 'mus', 'mid' ),
		'+jadtechwiki' => array('png', 'bmp', 'gif', 'ico', 'ogg', 'mp3', 'svg', 'pdf', 'flac', 'mp4', 'exe', 'zip', 'jpeg', 'jpg'),
		'+jayuwikiwiki' => array('bmp', 'apng', 'tiff', 'wav', 'mp3', 'oga', 'ogv', 'asv', 'swf', 'wmv'),
		'+jcswiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'ppt', 'pptx', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'zip'),
		'+modularwiki' => array('mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv'),
		'+pculsdwiki' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu', 'mp3', 'wma', 'mp4', 'zip', 'rar', 'xlsx', 'ppt', 'docx', 'doc'),
		'+pfl2wiki' => array('rar' ),
		'+podpediawiki' => array('mp3', 'zip'),
		'+qmswiki' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip'),
		'+schulwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'ppt', 'pptx', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'zip'),
		'+scruffywiki' => array('mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv', 'zip'),
		'+sdiywiki' => array('mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv', 'zip'),
		'+serinfhospwiki' => array( 'pdf', 'zip' ),
		'+showroomwiki' => array( 'png', 'gif', 'jpg', 'jpeg', 'doc', 'xls', 'pdf', 'ppt', 'tiff', 'bmp', 'docx', 'xlsx', 'pptx'),
		'+techeducationwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'ppt', 'xls', 'xlsx','xml'),
		'+themirrorwiki' => array( 'mp3'),
		'+tmewiki' => array('tiff', 'tif', 'webp', 'xcf', 'mid', 'ogv', 'oga', 'flac', 'opus', 'wav', 'webm'),
		'+unabwiki' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'),
		'+valentinaprojectwiki' => array( 'val', 'vit', 'vst'),
		'+vsfan' =>  array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu', 'webp' ),
		'+vandalismwikiwiki' => array('tiff', 'tif', 'webp', 'xcf', 'mid', 'ogv', 'oga', 'flac', 'opus', 'wav', 'webm'),
		'+wirtschaftsinformatikhbs' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu', 'docx', 'pptx', 'vsd' ),
		'+wisdomwikiwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'txt', 'rtf', 'zip'),
	),
	'wgUseInstantCommons' => array(
		'default' => true,
	),
	'wgEnableImageWhitelist' => array(
		'default' => false,
	),
	'wgShowArchiveThumbnails' => array(
		'default' => true,
		'doinwiki' => false,
	),
	'wgVerifyMimeType' => array(
		'default' => true,
		'jcswiki' => false,
	),
	'wgSVGMetadataCutoff' => array(
		'default' => 262144,
		'altversewiki' => 13421772,
	),

	// Flow
	'wmgFlowDefaultNamespaces' => array(
		'default' => true,
		'nationsglorywiki' => false,
		'lzhscpwikiwiki' => false,
	),

	// GlobalBlocking
	'wgApplyGlobalBlocks' => array(
		'default' => true,
		'metawiki' => false,
		'weatherwiki' => false, // let me do the blocking on my wiki, please
	),
	'wgGlobalBlockingDatabase' => array(
		'default' => 'mhglobal', // use mhglobal for global blocks
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

	// GlobalPreferences
	'wgGlobalPreferencesDB' => array(
		'default' => 'centralauth',
	),

 	// GlobalUserPage
 	'wgGlobalUserPageAPIUrl' => array(
		'default' => 'https://meta.miraheze.org/w/api.php',
	),
	'wgGlobalUserPageDBname' => array(
		'default' => 'metawiki',
	),

	// HighlightLinks
	'wgHighlightLinksInCategory' => array(
		'default' => array(),
		'allthetropeswiki' => array(
			'Trope' => 'trope',
			'YMMV_Trope' => 'ymmv',
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
	'wgExtraInterlanguageLinkPrefixes' => array(
		'default' => array(),
	),

	//Imports
	'wgImportSources' => array(
		'default' => array(
			'meta',
			'templatewiki',
		),
		'+incubatorwiki' => array(
			'wmincubator',
			'wikiaincubatorplus',
		),
		'+weatherwiki' => array(
			'wikipedia',
		),
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
		'incubatorwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'isvwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'jadtechwiki' => "//$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'revitwiki' => "//$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
	),
	'wgRightsPage' => array(
		'default' => '',
		'diavwiki' => 'Project:Copyrights',
		'kstartupswiki' => 'Project:저작권',
		'wisdomwikiwiki' => 'Copyleft',
	),
	'wgRightsText' => array(
		'default' => 'Creative Commons Attribution Share Alike',
		'incubatorwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'isvwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'jadtechwiki' => 'Copyright © Jak and Daxter Technical Wiki. All rights reserved.',
		'revitwiki' => '©2013-2018 by Lionel J. Camara (All Rights Reserved)',
		'reviwikiwiki' => 'Creative Commons Attribution Share Alike',
	),
	'wgRightsUrl' => array(
		'default' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'incubatorwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'isvwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'jadtechwiki' => 'https://jadtech.miraheze.org/wiki/MediaWiki:Copyright',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwikiwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr',
	),
	'wmgWikiLicense' => array(
		'default' => 'cc-by-sa',
	),

	// Links
	'+wgUrlProtocols' => array(
		'default' => array(),
		// file protocol only allowed on private wikis
		'bchwiki' => array ( "file://" ),
		'gzewiki' => array ( "file://" ),
		'kaiwiki' => array ( "file://" ),
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
		'jacksonheightswiki' => true,
		'nenawikiwiki' => true,
	),

	'wgTexvc' => array(
		'default' => '/usr/bin/texvc',
	),

	// ManageWiki
	'wgEnableManageWiki' => array(
		'default' => true,
	),
	'wgManageWikiExtensionsDefault' => array(
		'default' => array(
			'cite',
			'citethispage',
		),
	),
	'wgManageWikiCDBDirectory' => array(
		'default' => '/mnt/mediawiki-static/cdb/managewiki',
	),
	'wgManageWikiPermissionsAdditionalAddGroups' => array(
		'default' => array(),
	),
	'wgManageWikiPermissionsAdditionalRights' => array(
		'default' => array(
			'checkuser' => array(
				'checkuser' => true,
				'checkuser-log' => true,
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
			'user' => array(
				'user' => true,
			),
			'steward' => array(
				'userrights' => true,
			),
		),
		'+autocountwiki' => array(
			'authors' => array(
				'torunblocked' => true,
				'read' => true,
			),
		),
		'+bitcoindebateswiki' => array(
			'emailconfirmed' => array(
				'read' => true,
			),
		),
		'+cmgwiki' => array(
			'gst' => array(
				'read' => true,
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
		'+enigmawiki' => array(
			'scribe' => array(
				'read' => true,
			),
		),
		'+igrovyesistemywiki' => array(
			'autopatrolled' => array(
				'trusted' => true,
			),
			'autoreview' => array(
				'trusted' => true,
			),
			'bot' => array(
				'trusted' => true,
			),
			'editor' => array(
				'trusted' => true,
			),
			'reviewer' => array(
				'trusted' => true,
			),
			'co' => array(
				'co' => true,
				'ceo' => true,
				'trusted' => true,
			),
			'bureaucrat' => array(
				'bureaucrat' => true,
				'trusted' => true,
			),
			'sysmag' => array(
				'sysmag' => true,
				'trusted' => true,
			),
			'sysop' => array(
				'trusted' => true,
			),
			'ceo' => array(
				'bureaucrat' => true,
				'sysmag' => true,
				'trusted' => true,
			),
			'UserType1' => array(
				'UserType1' => true,
			),
			'UserType2' => array(
				'UserType2' => true,
			),
			'UserType3' => array(
				'UserType3' => true,
			),
			'UserType4' => array(
				'UserType4' => true,
			),
			'UserType5' => array(
				'UserType5' => true,
			),
			'UserType6' => array(
				'UserType6' => true,
			),
			'UserType7' => array(
				'UserType7' => true,
			),
		),
		'+jacksonheightswiki' => array(
			'emailconfirmed' => array(
				'read' => true,
			),
		),
		'+jayuwikiwiki' => array(
			'sysop' => array(
				'editvoter' => true,
			),
			'voter' => array(
				'editvoter' => true,
			),
		),
		'+lcars47wiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
			),
			'devteam' => array(
				'bureaucrat' => true,
				'read' => true,
				'devteam' => true,
			),
		),
		'+marthaspeakswiki' => array(
			'sysop' => array(
				'templateeditor' => true,
			),
			'templateeditor' => array(
				'templateeditor' => true,
			),
		),
		'+nenawikiwiki' => array(
			'emailconfirmed' => array(
				'read' => true,
			),
		),
		'+metawiki' => array(
			'confirmed' => array(
				'mwoauthproposeconsumer' => true,
				'mwoauthupdateownconsumer' => true,
			),
			'cvt' => array(
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'globalblock' => true,
			),
			'proxybot' => array(
				'globalblock' => true,
				'centralauth-lock' => true,
			),
			'steward' => array(
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'centralauth-oversight' => true,
				'centralauth-rename' => true,
				'centralauth-unmerge' => true,
				'createwiki' => true,
				'globalblock' => true,
				'managewiki' => true,
				'managewiki-restricted' => true,
				'noratelimit' => true,
				'userrights' => true,
				'userrights-interwiki' => true,
			),
			'sysop' => array(
				'interwiki' => true,
			),
			'user' => array(
				'requestwiki' => true,
			),
			'wikicreator' => array(
				'createwiki' => true,
			),
		),
		'+nonsensopediawiki' => array(
			'moderator' => array(
				'skipcaptcha' => true,
			),
		),
		'+pruebawiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
			),
			'consul' => array(
				'read' => true,
				'bureaucrat' => true,
				'consul' => true,
				'torunblocked' => true,
			),
			'testgroup' => array(
				'read' => true,
			),
		),
		'+radviserwiki' => array(
			'editor' => array(
				'editor' => true,
			),
			'sysop' => array(
				'editor' => true,
			),
		),
		'+sau226wiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
			),
			'consul' => array(
				'bureaucrat' => true,
				'consul' => true,
				'read' => true,
			),
			'testgroup' => array(
				'read' => true,
			),
		),
		'+serinfhospwiki' => array(
			'SupportStaff' => array(
				'read' => true,
			),
			'SalesStaff' => array(
				'read' => true,
			),
			'PreSalesStaff' => array(
				'read' => true,
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
		'+ssptopwiki' => array(
			'read-only' => array(
				'read' => true,
			),
		),
		'+swisscomraidwiki' => array(
			'emailconfirmed' => array(
				'read' => true,
			),
		),
		'+svwiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
			),
			'consul' => array(
				'bureaucrat' => true,
				'consul' => true,
				'read' => true,
			),
			'testgroup' => array(
				'read' => true,
			),
		),
		'+thesciencearchiveswiki' => array(
			'sysop' => array(
				'templateeditor' => true,
			),
			'templateeditor' => array(
				'templateeditor' => true,
			),
		),
		'+trexwiki' => array(
			'co' => array(
				'co' => true,
				'ceo' => true,
			),
			'ceo' => array(
				'ceo' => true,
				'editors' => true,
			),
			'bureaucrat' => array(
				'bureaucrat' => true,
			),
		),
		'+whentheycrywiki' => array(
			'user' => array(
				'edit-create' => true,
			),
		),
		'weatherwiki' => array(
			'steward' => array(
				'userrights' => true,
				'userrights-interwiki' => true,
				'hideuser' => true,
				'suppressrevision' => true,
				'suppressionlog' => true,
				'viewsuppressed' => true,
				'checkuser' => true,
				'checkuser-log' => true,
				'renameuser' => true,
				'abusefilter-private' => true,
				'abusefilter-private-log' => true,
				'abusefilter-hide-log' => true,
				'abusefilter-hidden-log' => true,
				'oathauth-enable' => true,
				'managewiki' => true,
				'managewiki-restricted' => true,
			),
		),
		'+yeoksawiki' => array(
			'sysop' => array(
				'project-edit' => true,
			),
		),
	),
	'wgManageWikiAdditionalRemoveGroups' => array(
		'default' => array(),
	),
	'wgManageWikiPermissionsBlacklistRights' => array(
		'default' => array(
			'any' => array(
				'abusefilter-hide-log',
				'abusefilter-hidden-log',
				'abusefilter-modify-global',
				'abusefilter-private',
				'abusefilter-private-log',
				'aft-oversighter',
				'autocreateaccount',
				'bigdelete',
				'centralauth-lock',
				'centralauth-oversight',
				'centralauth-rename',
				'centralauth-unmerge',
				'centralauth-usermerge',
				'checkuser',
				'checkuser-log',
				'createwiki',
				'flow-suppress',
				'globalblock',
				'globalblock-exempt',
				'globalgroupmembership',
				'globalgrouppermissions',
				'hideuser',
				'interwiki',
				'managewiki-restricted',
				'managewiki-editdefault',
				'mwoauthmanageconsumer',
				'mwoauthmanagemygrants',
				'mwoauthsuppress',
				'mwoauthviewprivate',
				'mwoauthviewsuppressed',
				'renameuser',
				'requestwiki',
				'siteadmin',
				'suppressionlog',
				'suppressrevision',
				'userrights',
				'userrights-interwiki',
				'viewpmlog',
				'viewsuppressed',
			),
			'*' => array(
				'read',
				'skipcaptcha',
				'torunblocked',
			),
		),
	),
	'wgManageWikiPermissionsBlacklistGroups' => array(
		'default' => array(
			'checkuser',
			'oversight',
			'steward'
		),
	),
	'wgManageWikiPermissionsDefaultPrivateGroup' => array(
		'default' => 'member',
	),
	'wgManageWikiPermissionsManagement' => array(
		'default' => true,
	),
	'wgManageWikiHelpUrl' => array(
		'default' => '//meta.miraheze.org/wiki/ManageWiki',
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

	// MatomoAnalytics
	'wgMatomoAnalyticsDatabase' => array(
		'default' => 'mhglobal',
	),
	'wgMatomoAnalyticsServerURL' => array(
		'default' => 'https://matomo.miraheze.org/',
	),
	'wgMatomoAnalyticsUseDB' => array(
		'default' => true,
	),
	'wgMatomoAnalyticsGlobalID' => array(
		'default' => 1,
	),
	
	//MediaWikiChat settings
	'wgChatLinkUsernames' => array(
		'default' => false,
		'nerdzonewiki' => true,
	),
	'wgChatMeCommand' => array(
		'default' => false,
		'nerdzonewiki' => true,
	),
	
	// Metrolook settings
	'wgMetrolookDownArrow' => array(
		'default' => true,
		'allthetropeswiki' => false,
		'ayrshirewiki' => false,
		'thegreatwarwiki' => false,
		'thelonsdalebattalionwiki' => false,
	),
	'wgMetrolookUploadButton' => array(
		'default' => true,
		'allthetropeswiki' => false,
		'thegreatwarwiki' => false,
	),
	'wgMetrolookBartile' => array(
		'default' => true,
		'ayrshirewiki' => false,
		'thegreatwarwiki' => false,
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
	'wgMetrolookFeatures' => array(
		'default' => array( 
			'collapsiblenav' => array( 'global' => false, 'user' => true ) ),
		'thegreatwarwiki' => array(
			'collapsiblenav' => array( 'global' => true, 'user' => true ) ),
	),
	
	// miraheze specific config
	'wgServicesRepo' => array(
		'default' => '/srv/services/services',
	),
	
	'wgMirahezeServicesExtensions' => array(
		'default' => [ 'VisualEditor', 'Flow' ],
	),

	// Inactive wikis
	// https://meta.miraheze.org/wiki/Dormancy_Policy/Exceptions and https://meta.miraheze.org/wiki/Dormancy_Policy/Exemptions
	'wgCreateWikiInactiveWikisWhitelist' => array(
		'default' => array(
			// Exceptions
			'commonswikiwiki',
			'conductwiki',
			'cvtwiki',
			'metawiki',
			'staffwiki',
			'loginwiki',
			// Exemptions
			'allthetropeswiki',
			'ansaikuropediawiki',
			'biblicalwikiwiki',
			'bitcoindebateswiki',
			'bpwiki',
			'cmgwiki',
			'crazybloxianempireinfowiki',
			'dditecwiki',
			'geomasterywiki',
			'incubatorwiki',
			'lexiquewiki',
			'librewiki',
			'linenwiki',
			'marketingspecialswiki',
			'modularwiki',
			'newarkmanorwiki',
			'newusopediawiki',
			'nissanecuwiki',
			'noalatalawiki',
			'openhatchwiki',
			'proxybotwiki',
			'reviwiki',
			'reviwikiwiki',
			'sawikiwiki',
			'sdiywiki',
			'softwarecrisiswiki',
			'sonwiki',
			'spaceechowiki',
			'spiralwiki',
			'lothuialethwiki',
			't40wiki',
			'taliaferrowiki',
			'templatewiki',
			'testwiki',
			'tnoteswiki',
			'usopediajunkyardwiki',
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
		'blocknetwiki' => false,
		'takethatwikiwiki' => false,
		'tmewiki' => false,
		'vandalismwikiwiki' => false,
	),
	'wgCapitalLinks' => array(
		'default' => true,
		'dicowiki' => false,
	),
	'wgActiveUserDays' => array(
		'default' => 30,
		'weatherwiki' => 7,
	),

	// MobileFrontend
	'wmgMFAutodetectMobileView' => array(
		'default' => false,
	),
	'wgMFDefaultSkinClass' => array(
		'default' => 'SkinMinerva',
	),
	
	// Moderation extension settings
	'wgModerationNotificationEnable' => array( // Enable or disable notifications. 
		'default' => false,
		'sdiywiki' => true,
	),
	'wgModerationNotificationNewOnly' => array( // Notify administrator only about new pages requests. 
		'default' => false,
	),
	'wgModerationEmail' => array( // Email to send notifications to.
		'default' => $wgPasswordSender,
		'sdiywiki' => 'admin@sdiy.info',
	),

	// MsCatSelect vars
	'wgMSCS_WarnNoCategories' => array(
		'default' => true,
	),

	// MsUpload settings
	'wgMSU_useDragDrop' => array(
		'default' => true,
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
	
	// MultiBoilerplate settings
	'wgMultiBoilerplateDiplaySpecialPage' => array(
		'default' => false,
		'scruffywiki' => true,
		'sdiywiki' => true,
	),

	// MultimediaViewer (not beta)
	'wgMediaViewerEnableByDefault' => array(
		'calexitwiki' => true,
		'cristianopediawiki' => true,
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
		'apunteswiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'centralwiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'destinoswiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'infowiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'mediatecawiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'privadowiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'tallerwiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'ucroníaswiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
		 ),
		'2b2twiki' => array(
			NS_THREAD => 'Thread',
			NS_THREAD_TALK => 'Thread_Talk',
			NS_MESSAGE_WALL => 'Message_Wall',
			NS_MESSAGE_WALL_TALK => 'Message_Wall_Talk',
			NS_USER_BLOG => 'User_Blog',
			NS_USER_BLOG_TALK => 'User_Blog_Talk',
			NS_USER_BLOG_COMMENT => 'User_blog_comment',
			NS_USER_BLOG_COMMENT_TALK => 'User_blog_comment_talk',
		),
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
		'avalicearchiveswiki' => array(
			NS_FANWORK => 'Fanbase',
			NS_FANWORK_TALK => 'Fanbase_talk',
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
		'casuarinawiki' => array(
			NS_LIBRARY => '圖書館',
			NS_LIBRARY_TALK => '圖書討論',
		),
		'claneuphoriawiki' => array(
			NS_CLAN => 'Clan',
			NS_CLAN_TALK => 'Clan_talk',
		),
		'crazybloxianempireinfowiki' => array(
			NS_LIST => 'List',
			NS_LIST_TALK => 'List_talk',
			NS_LAW => 'Law',
			NS_LAW_AMENDING => 'Law_amending',
			NS_EXECUTIVE_ORDER => 'Executive_Order',
			NS_EXECUTIVE_ORDER_TALK => 'Executive_Order_talk',
			NS_GROUP => 'Group',
			NS_GROUP_TALK => 'Group_talk',
		),	
		'cristianopediawiki' => array(
			NS_TEMA => 'Tema',
			NS_TEMA_TALK => 'Tema_discusión',
		),
		'fawiki' => array(
			NS_API => 'رابط برنامه‌نویسی',
			NS_API_TALK => 'بحث رابط برنامه‌نویسی',
			NS_EXTENSION => 'افزونه ',
			NS_EXTENSION_TALK => 'Extension_talk',
			NS_MANUAL => 'نسکچهٔ راهنما',
			NS_MANUAL_TALK => 'بحث نسکچهٔ راهنما',
			NS_SKIN => 'پوسته',
			NS_SKIN_TALK => 'Skin_talk',
			NS_SUMMARY => 'کوته‌نگاشت',
			NS_SUMMARY_TALK => 'بحث کوته‌نگاشت',
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
		'isvwiki' => array(
			NS_LIBRARY => 'Sbornik',
			NS_LIBRARY_TALK => 'Besěda_sbornika',
		),
		'jadtechwiki' => array(
			NS_GAMEPAGE => 'Game',
			NS_GAMEPAGE_TALK => 'Game_talk',
		),
		'kirarafantasiawiki' => array(
			NS_DATA => 'Data',
			NS_DATA_TALK => 'Data_talk',
		),
		'metawiki' => array(
			NS_TECH => 'Tech',
			NS_TECH_TALK => 'Tech_talk'
		),
		'noalatalawiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
		),
		'nonciclopediawiki' => array(
			NS_PORTALE => 'Portale',
			NS_DISCUSSIONI_PORTALE => 'Portale_talk',
			NS_PROGETTO => 'Progetto',
			NS_DISCUSSIONI_PROGETTO => 'Progetto_talk',
			NS_CIMITERO => 'Cimitero',
			NS_DISCUSSIONI_CIMITERO => 'Cimitero_talk',
			NS_NONNOTIZIE => 'Nonnotizie',
			NS_DISCUSSIONI_NONNOTIZIE => 'Nonnotizie_talk',
			NS_NONVOYAGE => 'Nonvoyage',
			NS_DISCUSSIONI_NONVOYAGE => 'Nonvoyage_talk',
			NS_NONQUOTE => 'Nonquote',
			NS_DISCUSSIONI_NONQUOTE => 'Nonquote_talk',
			NS_NONDIZIONARiO => 'Nondizionario',
			NS_DISCUSSIONI_NONDIZIONARIO => 'Nondizionario_talk',
			NS_NONVERSITA => 'Nonversità',
			NS_DISCUSSIONI_NONVERVISTA => 'Nonversità_talk',
			NS_NONSOURCE => 'Nonsource',
			NS_DISCUSSIONI_NONSOURCE => 'Nonsource_talk',
			NS_NONBOOKS => 'Nonbooks',
			NS_DISCUSSIONI_NONBOOKS => 'Nonbooks_talk',
		),
		'nonsensopediawiki' => array(
			NS_CYTATY => 'Cytaty', 
			NS_CYTATY_TALK => 'Dyskusja cytatów', 
			NS_NONNEWS => 'NonNews', 
			NS_NONNEWS_TALK => 'Dyskusja NonNews', 
			NS_NONZRODLA => 'NonŹródła', 
			NS_NONZRODLA_TALK => 'Dyskusja NonŹródeł', 
			NS_SLOWNIK => 'Słownik', 
			NS_SLOWNIK_TALK => 'Dyskusja słownika', 
			NS_GRA => 'Gra', 
			NS_GRA_TALK => 'Dyskusja gry', 
			NS_PORTAL => 'Portal', 
			NS_PORTAL_TALK => 'Dyskusja portalu', 
			NS_PORADNIK => 'Poradnik', 
			NS_PORADNIK_TALK => 'Dyskusja poradnika', 
			NS_PORUM => 'Porum',
			NS_PORUM_TALK => 'Dyskusja Porum',
		),
		'oecumenewiki' => array(
			NS_ARCHIVE => 'Архив',
			NS_ARCHIVE_TALK => 'Обсуждение_архива',
			NS_PORTAL => 'Портал',
			NS_PORTAL_TALK => 'Обсуждение_портала',
		),
		'picardwiki' => array(
			NS_WPIMPORT => 'WPImport',
			NS_WPIMPORT_TALK => 'WPImport_Diskussion',
			NS_WPREDIRECT => 'WPRedirect',
			NS_WPREDIRECT_TALK => 'WPRedirect_Diskussion',
		),
		'ratanpirwiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
		),
		'reviwiki' => array(
			NS_SERVER => 'Server',
			NS_SERVER_TALK => 'Server_talk',
		),
		'reviwikiwiki' => array(
			NS_HANDBOOK => '핸드북',
			NS_HANDBOOK_TALK => '핸드북토론',
		),
		'revitwiki' => array(
			NS_RGB => 'RGB',
			NS_RGB_TALK => 'RGB_talk',
			NS_IDEA => 'IDEA',
			NS_IDEA_TALK => 'IDEA_talk',
			NS_LINESTYLE => 'LineStyle',
			NS_LINESTYLE_TALK => 'LineStyle_talk',
		),
		'rpgbrigadewiki' => array(
			NS_VIDEO => 'Video',
			NS_VIDEO_TALK => 'Video_talk',
		),
		'safiriawiki' => array(
			NS_HOENN => 'Hoenn',
			NS_HOENN_TALK => 'Hoenn_talk',
		),
		'scruffywiki' => array(
			NS_DRAFT => 'Draft',
			NS_DRAFT_TALK => 'Draft_talk',
			NS_BOILERPLATE => 'Boilerplate',
			NS_BOILERPLATE_TALK => 'Boilerplate_talk',			
		),
		'sdiywiki' => array(
			NS_DRAFT => 'Draft',
			NS_DRAFT_TALK => 'Draft_talk',
			NS_BOILERPLATE => 'Boilerplate',
			NS_BOILERPLATE_TALK => 'Boilerplate_talk',			
		),
		'statisticswiki' => array(
			NS_HUB => 'Hub',
			NS_HUB_TALK => 'Hub_talk',
		),
		'studynotekrwiki' => array(
			NS_STUDY_NOTE => 'Study note',
			NS_STUDY_NOTE_TALK => 'Study note_talk',
			NS_EXPLANATION => 'Explanation',
			NS_EXPLANATION_TALK => 'Explanation_talk',
		),
		'tallerdecristianopediawiki' => array(
			NS_TEMA => 'Tema',
			NS_TEMA_TALK => 'Tema_discusión',
		),
		'thelonsdalebattalionwiki' => array(
			NS_GLOSSARY => 'Glossary',
			NS_GLOSSARY_TALK => 'Glossary_talk',
		),
		'trexwiki' => array(
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
			NS_GAME => 'Game',
			NS_GAME_TALK => 'Game_talk',
			NS_IDEA => 'Idea',
			NS_IDEA_TALK => 'Idea_talk',
			NS_TIMELINE => 'Timeline',
			NS_TIMELINE_TALK => 'Timeline_talk',
			NS_POLICY => 'Policy',
			NS_POLICY_TALK => 'Policy_talk',
		),
		'uncyclopediawiki' => array(
			NS_PSEUDO_NEWS => '伪基新闻',
			NS_PSEUDO_NEWS_TALK => '伪基新闻谈',
			NS_PSEUDO_BASE_DICTIONARY => '伪基词典',
			NS_PSEUDO_BASE_DICTIONARY_TALK => '伪基词典谈',
			NS_PSEUDO_BASE_LIBRARY => '伪基文库',
			NS_PSEUDO_BASE_LIBRARY_TALK => '伪基文库谈',
			NS_PSEUDO_BASE_MUSIC => '伪基音乐',
			NS_PSEUDO_BASE_MUSIC_TALK => '伪基音乐谈',
		),
		'uwswiki' => array(
 		 	NS_WNS2 => 'WNS2',
  		 	NS_WNS2_TALK => 'WNS2_talk',
		),
		'vandalismwikiwiki' => array(
			NS_PROJECT => 'VW',
			NS_PROJECT_TALK => 'VT',
		),
		'votingwiki' => array(
			NS_LEGACY => 'Legacy',
			NS_LEGACY_TALK => 'Legacy_talk',
  		),
		'warriorpediawiki' => array(
			NS_POLICY => 'Policy',
			NS_POLICY_TALK => 'Policy_talk',
		),
		'wikibookwiki' => array(
			NS_BOOK => 'نسک',
			NS_BOOK_TALK => 'بحث نسک',
			NS_BOOK_NAVIGATION => 'ناوبری نسک',
			NS_BOOK_NAVIGATION_TALK => 'بحث ناوبری نسک', 
			NS_APPLICATION => 'برنامه',
			NS_APPLICATION_TALK => 'بحث برنامه',
			NS_DICTIONARY => 'واژه‌نامه',
			NS_DICTIONARY_TALK => 'بحث واژه‌نامه',
			NS_CALENDAR => 'گاه‌شمار',
			NS_CALENDAR_TALK => 'بحث گاه‌شمار',
			NS_ENCYCLOPEDIA => 'دانش‌نامه',
			NS_ENCYCLOPEDIA => 'بحث دانش‌نامه',
			NS_PORTAL => 'درگاه',
			NS_PORTAL_TALK => 'بحث درگاه',
			NS_QURAN => 'قرآن',
			NS_QURAN_TALK => 'بحث قرآن',
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
		'whentheycrywiki' => array(
			NS_SPRITES => 'Sprites',
			NS_SPRITES_TALK => 'Sprites_talk',
			NS_GALLERY => 'Gallery',
			NS_GALLERY_TALK => 'Gallery_talk',
		),
		'yokaiwatchwiki' => array(
			NS_WALKTHROUGH => 'Walkthrough',
			NS_WALKTHROUGH_TALK => 'Walkthrough_talk',
			NS_GALLERY => 'Gallery',
			NS_GALLERY_TALK => 'Gallery_talk',
			NS_POLICY => 'Policy',
			NS_POLICY_TALK => 'Policy_talk',
			NS_STAFF => 'Staff',
			NS_STAFF_TALK => 'Staff_talk',
		),
	),
	'wgContentNamespaces' => array(
		'default' => array( NS_MAIN ),
		'+apunteswiki' => array( NS_ANEXO ),
		'+centralwiki' => array( NS_ANEXO ),
		'+destinoswiki' => array( NS_ANEXO ),
		'+infowiki' => array( NS_ANEXO ),
		'+mediatecawiki' => array( NS_ANEXO ),
		'+privadowiki' => array( NS_ANEXO ),
		'+tallerwiki' => array( NS_ANEXO ),
		'+ucroniaswiki' => array( NS_ANEXO ),
		'+calexitwiki' => array( NS_OPINION, NS_TIMELINE, NS_HISTORICAL_TIMELINE ),
		'+nonsensopediawiki' => array( NS_CYTATY, NS_NONNEWS, NS_NONZRODLA, NS_SLOWNIK, NS_GRA, NS_PORADNIK ),
		'+reviwiki' => array( NS_SERVER ),
		'+reviwikiwiki' => array ( NS_HANDBOOK ),
		'+safiriawiki' => array( NS_HOENN ),
		'+tmewiki' => array( NS_CALL_OF_DUTY, NS_MINECRAFT, NS_SUPER_MARIO_LAND_2, NS_SUPER_MARIO_WORLD_2, NS_SUPER_MARIO_BROS, NS_SUPER_MARIO_ADVANCE, NS_SUPER_MARIO_ADVANCE_2, NS_SUPER_MARIO_ADVANCE_3, NS_SUPER_MARIO_ADVANCE_4, NS_THE_LEGEND_OF_ZELDA, NS_CIVILIZATION_IV, NS_GAME, NS_IDEA, NS_TIMELINE ),
	),
	'wgMathValidModes' => array(
		'default' => array( 'png' ),
	),
	'wgMetaNamespace' => array(
		'default' => null,
		'apunteswiki' => 'Apuntes',
		'centralwiki' => 'Central',
		'destinoswiki' => 'Destinos',
		'infowiki' => 'Info',
		'mediatecawiki' => 'Mediateca',
		'privadowiki' => 'Privado',
		'tallerwiki' => 'Tallerwiki',
		'ucroniaswiki' => 'Ucronías',
		'calexitwiki' => 'CalExit_Wiki',
		'incubatorwiki' => 'Incubator',
		'jawp2chwiki' => 'まとめwiki',
		'tmewiki' => 'TME',
	),
	'+wgNamespaceAliases' => array(
		'default' => array(),
		'+apunteswiki' => array(
 			'A' => NS_PROJECT,
 		),
 		'+centralwiki' => array(
 			'C' => NS_PROJECT,
 		),
 		'+destinoswiki' => array(
 			'D' => NS_PROJECT,
			'WV' => NS_PROYECTO,
			'Wikiviajes' => NS_PROYECTO,
 		),
 		'+infowiki' => array(
 			'I' => NS_PROJECT,
 		),
 		'+mediatecawiki' => array(
 			'M' => NS_PROJECT,
 		),
 		'+privadowiki' => array(
 			'P' => NS_PROJECT,
 		),
 		'+tallerwiki' => array(
 			'T' => NS_PROJECT,
 		),
 		'+ucroniaswiki' => array(
 			'U' => NS_PROJECT,
		),
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
		'+bpwiki' => array(
			'Halaman' => NS_PROOFREAD_PAGE,
			'Pembicaraan_Halaman' => NS_PROOFREAD_PAGE_TALK,
			'Indeks' => NS_PROOFREAD_INDEX,
			'Pembicaraan_Indeks' => NS_PROOFREAD_INDEX_TALK,
		),
		'+casuarinawiki' => array(
			'文庫' => NS_LIBRARY,
			'文庫討論' => NS_LIBRARY_TALK,
		),
		'+dakhilcommunitywiki' => array(
			'DC' => NS_MAIN,
			'DC_talk' => NS_TALK,
		),
		'+humorpediawiki' => array(
			'HP' => NS_PROJECT,
			'HP_talk' => NS_PROJECT_TALK,
		),
		'+incubatorwiki' => array(
			'I' => NS_PROJECT,
			'IT' => NS_PROJECT_TALK,
		),
		'+isvwiki' => array(
			'Library' => NS_LIBRARY,
			'Library_talk' => NS_LIBRARY_TALK,
		),
		'+picardwiki' => array(
			'NS_USER_PROFILE' => 'Benutzerprofil',
			'NS_USER_PROFILE_TALK' => 'Benutzerprofil Diskussion',
		),
		'+proxybotwiki' => array(
			'UT' => NS_USER_TALK,
		),
		'+reviwikiwiki' => array(
			'Handbook' => NS_HANDBOOK,
			'Handbook_talk' => NS_HANDBOOK_TALK,
		),
		'+studynotekrwiki' => array(
			'KSN' => NS_KOREAN_STUDY_NOTE,
			'KSN_TALK' => NS_KOREAN_STUDY_NOTE_TALK,
		),
		'+tmewiki' => array(
			'The_Multilingual_Encyclopedia' => NS_PROJECT,
			'Projekto' => NS_PROJECT,
			'The_Multilingual_Encyclopedia_talk' => NS_PROJECT_TALK,
			'Bestand' => NS_FILE,
			'Fichier' => NS_FILE,
			'Archivo' => NS_FILE,
			'Kuva' => NS_FILE,
			'Dosiero' => NS_FILE,
			'Файл' => NS_FILE,
			'Plik' => NS_FILE,
			'Datei' => NS_FILE,
			'Fil' => NS_FILE,
			'画像' => NS_FILE,
			'Lêer' => NS_FILE,
			'Fitxer' => NS_FILE,
			'Imatge' => NS_FILE,
			'Datoteka' => NS_FILE,
			'Ficheiro' => NS_FILE,
			'Afbeelding' => NS_FILE,
			'Выява' => NS_FILE,
			'Ofbyld' => NS_FILE,
			'ფაილი' => NS_FILE,
			'Mynd' => NS_FILE,
			'Talaksan' => NS_FILE,
			'Lêerbespreking' => NS_FILE_TALK,
			'Overleg_afbeelding' => NS_FILE_TALK,
			'Размовы пра файл' => NS_FILE_TALK,
			'Ofbyld oerlis' => NS_FILE_TALK,
			'ფაილის განხილვა' => NS_FILE_TALK,
			'Myndakjak' => NS_FILE_TALK,
			'Usapang talaksan' => NS_FILE_TALK,
			'Categorie' => NS_CATEGORY,
			'Catégorie' => NS_CATEGORY,
			'Categoría' => NS_CATEGORY,
			'Módulo' => WMG_NS_MODULE,
			'Especial' => NS_SPECIAL,
			'Espesyal' => NS_SPECIAL,
			'Specialaĵo' => NS_SPECIAL,
			'Specialis' => NS_SPECIAL,
			'Категория' => NS_CATEGORY,
			'Портал' => NS_PORTAL,
			'Служебная' => NS_SPECIAL,
			'Luokka' => NS_CATEGORY,
			'Kategorio' => NS_CATEGORY,
			'Modèle' => NS_TEMPLATE,
			'Aide' => NS_HELP,
			'Kategoria' => NS_CATEGORY,
			'Specjalna' => NS_SPECIAL,
			'Szablon' => NS_TEMPLATE,
			'Pomoc' => NS_HELP,
			'Moduł' => WMG_NS_MODULE,
			'Skabelon' => NS_TEMPLATE,
			'Kategori' => NS_CATEGORY,
			'Predefinição' => NS_TEMPLATE,
			'Imagem' => NS_IMAGE,
			'Kategorie' => NS_CATEGORY,
			'Kategoriebespreking' => NS_CATEGORY_TALK,
			'Plantilla' => NS_TEMPLATE,
			'Ŝablono' => NS_TEMPLATE,
			'Ayuda' => NS_HELP,
			'Sjabloon' => NS_TEMPLATE,
			'Vorlage' => NS_TEMPLATE,
			'Bild' => NS_MEDIA,
			'Modulo' => WMG_NS_MODULE,
			'Categoria' => NS_CATEGORY,
			'Kategorija' => NS_CATEGORY,
			'Helpo' => NS_HELP,
			'Kategorya' => NS_CATEGORY,
			'Modelo' => NS_TEMPLATE,
			'Axuda' => NS_HELP,
			'Катэгорыя' => NS_CATEGORY,
			'Размовы пра катэгорыю' => NS_CATEGORY_TALK,
			'Kategory' => NS_CATEGORY,
			'Kategory oerlis' => NS_CATEGORY_TALK,
			'კატეგორია' => NS_CATEGORY,
			'კატეგორიის განხილვა' => NS_CATEGORY_TALK,
			'თარგი' => NS_TEMPLATE,
			'თარგის განხილვა' => NS_TEMPLATE_TALK,
			'Bólkur' => NS_CATEGORY,
			'Bólkakjak' => NS_CATEGORY_TALK,
			'Myndaspjall' => NS_FILE_TALK,
			'Flokkur' => NS_CATEGORY,
			'Flokkaspjall' => NS_CATEGORY_TALK,
			'Fitxategi' => NS_FILE,
			'Fitxategi_eztabaida' => NS_FILE_TALK,
			'Txantiloi' => NS_TEMPLATE,
			'Txantiloi_eztabaida' => NS_TEMPLATE_TALK,
			'Kategória' => NS_CATEGORY,
			'Kategóriavita' => NS_CATEGORY_TALK,
			'Fájl' => NS_FILE,
			'Fájlvita' => NS_FILE_TALK,
			'Sablon' => NS_TEMPLATE,
			'Sablonvita' => NS_TEMPLATE_TALK,
			'Категорија' => NS_CATEGORY,
			'Разговор_за_категорија' => NS_CATEGORY_TALK,
			'Податотека' => NS_FILE,
			'Разговор_за_податотека' => NS_FILE_TALK,
			'Шаблон' => NS_TEMPLATE,
			'Разговор_за_шаблон' => NS_TEMPLATE_TALK,
			'Malline' => NS_TEMPLATE,
			'Keskustelu_mallineesta' => NS_TEMPLATE_TALK,
			'Attēls' => NS_FILE,
			'Attēla_diskusija' => NS_FILE_TALK,
			'Veidne' => NS_TEMPLATE,
			'Veidnes_diskusija' => NS_TEMPLATE_TALK,
			'Modulis' => WMG_NS_MODULE,
			'Moduļa_diskusija' => WMG_NS_MODULE_TALK,
			'Tiedosto' => NS_FILE,
			'Keskustelu_tiedostosta' => NS_FILE_TALK,
			'Moduuli' => WMG_NS_MODULE,
			'Keskustelu_moduulista' => WMG_NS_MODULE_TALK,
			'Vaizdas' => NS_FILE,
			'Vaizdo_aptarimas' => NS_FILE_TALK,
			'Šablonas' => NS_TEMPLATE,
			'Šablono_aptarimas' => NS_TEMPLATE_TALK,
			'Tập_tin' => NS_FILE,
			'Thảo_luận_Tập_tin' => NS_FILE_TALK,
			'Bản_mẫu' => NS_TEMPLATE,
			'Thảo_luận_Bản_mẫu' => NS_TEMPLATE_TALK,
			'Thể_loại' => NS_CATEGORY,
			'Thảo_luận_Thể_loại' => NS_CATEGORY_TALK,
			'Padron' => NS_TEMPLATE,
			'Usapang_padron' => NS_TEMPLATE_TALK,
		),
		'+vandalismwikiwiki' => array(
			'H' => NS_HELP,
			'HT' => NS_HELP_TALK,
			'VW' => NS_PROJECT,
			'VT' => NS_PROJECT_TALK,
		),
	),
	'+wgNamespaceProtection' => array(
		'default' => array(),
		'+nenawikiwiki' => array(
			NS_MAIN => array(
				'edit-content-pages',
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
				'edit-content-pages',
			),
			NS_TALK => array(
				'edit-talkpages',
			),
		),
		'+whentheycrywiki' => array(
			NS_USER => array(
				'edit-userpage',
			),
		),
		'+weatherwiki' => array(
			NS_PROJECT => array(
				'edit-restrictednamespace',
			),
			NS_TEMPLATE => array(
				'edit-restrictednamespace',
			),
			WMG_NS_MODULE => array(
				'edit-restrictednamespace',
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
		'+isvwiki' => array(
			NS_LIBRARY => true,
		),
		'+metawiki' => array(
			NS_TECH => true,
		),
		'+starmetalwiki' => array(
			NS_USER => true,
		),
		'+thelonsdalebattalionwiki' => array(
			NS_GLOSSARY => true,
		),
		'+tmewiki' => array(
			NS_CALL_OF_DUTY => true,
			NS_MINECRAFT => true,
			NS_SUPER_MARIO_LAND_2 => true,
			NS_SUPER_MARIO_WORLD_2 => true,
			NS_SUPER_MARIO_BROS => true,
			NS_SUPER_MARIO_ADVANCE => true,
			NS_SUPER_MARIO_ADVANCE_2 => true,
			NS_SUPER_MARIO_ADVANCE_3 => true,
			NS_SUPER_MARIO_ADVANCE_4 => true,
			NS_THE_LEGEND_OF_ZELDA => true,
			NS_CIVILIZATION_IV => true,
			NS_GAME => true,
			NS_IDEA => true,
			NS_TIMELINE => true,
		),
	),
	'+wgNamespacesWithSubpages' => array(
		'default' => array(
			NS_MAIN => true,
		),
		'+apunteswiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+centralwiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+destinoswiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+infowiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+mediatecawiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+privadowiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+tallerwiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+ucroniaswiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
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
		'+alwikiwiki' => array(
			NS_MAIN => true,
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
		'+christipediawiki' => array(
			NS_MAIN => true,
		),
		'+cnvwiki' => array(
			NS_MAIN => true,
		),
		'+conductwiki' => array(
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
		'+isvwiki' => array(
			NS_LIBRARY => true,
			NS_LIBRARY_TALK => true,
		),
		'+jadtechwiki' => array(
			NS_GAMEPAGE => true,
			NS_GAMEPAGE_TALK => true,
		),
		'+jawp2chwiki' => array(
			NS_TEMPLATE => true,
		),
		'+machiningwiki' => array(
			NS_MAIN => true,
			NS_TEMPLATE => true,
		),
		'+metawiki' => array(
			NS_MAIN => true,
			NS_TECH => true,
		),
		'+r2wiki' => array(
			NS_MAIN => true,
		),
		'+raymanspeedrunwiki' => array(
			NS_MAIN => true,
		),
		'+reviwiki' => array(
			NS_MAIN => true,
			NS_SERVER => true,
		),
		'+reviwikiwiki' => array(
			NS_MAIN => true,
			NS_HANDBOOK => true,
		),
		'+rswiki' => array(
			NS_TEMPLATE => true,
		),
		'+safiriawiki' => array(
			NS_MAIN => true,
			NS_HOENN => true,
		),
		'+sidemwiki' => array(
			NS_MAIN => true,
			NS_USER => true,
		),
		'+thegreatwarwiki' => array(
			NS_MAIN => true,
		),
		'+tmewiki' => array(
			NS_MAIN => true,
			NS_USER => true,
			NS_PROJECT => true,
			NS_TEMPLATE => true,
			NS_PORTAL => true,
			NS_CALL_OF_DUTY => true,
			NS_MINECRAFT => true,
			NS_SUPER_MARIO_LAND_2 => true,
			NS_SUPER_MARIO_WORLD_2 => true,
			NS_SUPER_MARIO_BROS => true,
			NS_SUPER_MARIO_ADVANCE => true,
			NS_SUPER_MARIO_ADVANCE_2 => true,
			NS_SUPER_MARIO_ADVANCE_3 => true,
			NS_SUPER_MARIO_ADVANCE_4 => true,
			NS_THE_LEGEND_OF_ZELDA => true,
			NS_CIVILIZATION_IV => true,
			NS_GAME => true,
			NS_IDEA => true,
			NS_TIMELINE => true,
		),
		'+voidwiki' => array(
			NS_MAIN => true,
		),
		'+wisdomwikiwiki' => array(
			NS_MAIN => true,
			NS_LCS => true,
			NS_LIBRARY => true,
			NS_TEACHING => true,
		),
	),
	
	'wgNamespaceContentModels' => array(
		'default' => array(),
		'isvwiki' => array(
			WMG_NS_MODULE_TALK => 'flow-board',
			NS_LIBRARY_TALK => 'flow-board',
		),
		'apunteswiki' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
		'centralwiki' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
		'destinoswiki' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
		'infowiki' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
		'mediatecawiki' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
		'privadowiki' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
		'taller' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
		'ucroniaswiki' => array(
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
		),
	),
	// OATHAuth
	'wgOATHAuthDatabase' => array(
		'default' => 'mhglobal',
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
		'nvcwiki' => true,
		'nerdzonewiki' => true,
		'spiralwiki' => true,
	),

	// Page Size
	'wgMaxArticleSize' => array(
		'default' => 2048,
		'nonsensopediawiki' => 8192,
	),

	// PageTriage
	'wgPageTriageInfinitScrolling' => array(
		'default' => true,
	),

	// Permissions
	'wgGroupsAddToSelf' => array(
		'default' => array(),
		'+metawiki' => array(
			'cvt' => array(
				'flood',
			),
		),
		'+weatherwiki' => array(
			'importer' => array(
				'flood',
			),
		),
	),	
	'wgGroupsRemoveFromSelf' => array(
		'default' => array(),
		'+harrypotterwiki' => array(
			'bureaucrat' => array(
				'bureaucrat',
			),
		),
		'+metawiki' => array(
			'cvt' => array(
				'flood',
			),
		),
		'+weatherwiki' => array(
			'importer' => array(
				'flood',
			),
		),
	),
	'wgRevokePermissions' => array(
		'default' => array(),
		'loginwiki' => array(
			'*' => array(
				'edit' => true,
				'move' => true,
			),
		),
		'ssptopwiki' => array(
			'read-only' => array(
				'edit' => true,
			),
		),
		'weatherwiki' => array(
 			'banned' => array(
 				'editmyoptions' => true,
 				'editmyprivateinfo' => true,
 				'editmyusercss' => true,
 				'editmyuserjs' => true,
 				'editmywatchlist' => true,
 				'read' => true,
 				'writeapi' => true,
 				'viewmyprivateinfo' => true,
 				'viewmywatchlist' => true,
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
		'+nenawikiwiki' => array(
			'emailconfirmed' => array(
				APCOND_EMAILCONFIRMED,
			),
		),
		'+igrovyesistemywiki' => array(
			'UserType1' => array(
				"&",
				array( APCOND_EDITCOUNT, 1),
				array( APCOND_AGE, 0 ),
				array( '!', array( APCOND_INGROUPS, 'UserType2' ) ),
			),
			'UserType2' => array(
				"&",
				array( APCOND_EDITCOUNT, 50),
				array( APCOND_AGE, 0 ),
				array( '!', array( APCOND_INGROUPS, 'UserType3' ) ),
			),
			'UserType3' => array(
				"&",
				array( APCOND_EDITCOUNT, 300),
				array( APCOND_AGE, 0 ),
				array( '!', array( APCOND_INGROUPS, 'UserType4' ) ),
			),
			'UserType4' => array(
				"&",
				array( APCOND_EDITCOUNT, 500),
				array( APCOND_AGE, 0 ),
				array( '!', array( APCOND_INGROUPS, 'UserType5' ) ),
			),
			'UserType5' => array(
				"&",
				array( APCOND_EDITCOUNT, 1000),
				array( APCOND_AGE, 0 ),
				array( '!', array( APCOND_INGROUPS, 'UserType6' ) ),
			),
			'UserType6' => array(
				"&",
				array( APCOND_EDITCOUNT, 2000),
				array( APCOND_AGE, 0 ),
				array( '!', array( APCOND_INGROUPS, 'UserType7' ) ),
			),
			'UserType7' => array(
				"&",
				array( APCOND_EDITCOUNT, 3000),
				array( APCOND_AGE, 0 ),
			),
		),
		'+jacksonheightswiki' => array(
			'emailconfirmed' => array(
				APCOND_EMAILCONFIRMED,
			),
		),
		'+kyivstarwiki' => array(
			'co' => array(
				"&",
				array( APCOND_EDITCOUNT, 3000 ),
				array( APCOND_AGE, 365 * 86400 ),
			),
			'ceo' => array(
				"&",
				array( APCOND_EDITCOUNT, 2000 ),
				array( APCOND_AGE, 275 * 86400 ),
			),
			'editor' => array(
				"&",
				array( APCOND_EDITCOUNT, 300 ),
				array( APCOND_AGE, 45 * 86400 ),
			),
			'extendedconfirmed' => array(
				"&",
				array( APCOND_EDITCOUNT, 500 ),
				array( APCOND_AGE, 90 * 86400 ),
			),
			'sysmag' => array(
				"&",
				array( APCOND_EDITCOUNT, 1000 ),
				array( APCOND_AGE, 185 * 86400 ),
			),
			'trusted' => array(
				"&",
				array( APCOND_EDITCOUNT, 50 ),
				array( APCOND_AGE, 7 * 86400 ),
			),
		),
		'+olegcinemawiki' => array(
			'uploader' => array(
				"&",
				array( APCOND_AGE, 10 * 86400 ),
			),
		),
	),
	'wgAutopromoteOnce' => array(
		'default' => array(),
		'weatherwiki' => array(
			'extendedconfirmed' => array(
				"&",
				array( APCOND_EDITCOUNT, 100 ),
				array( APCOND_AGE, 30 * 86400 ),
			),
		),
	),
	'wgImplicitGroups' => array(
		'default' => array( '*', 'user', 'autoconfirmed' ),
		'bitcoindebateswiki' => array( '*', 'user', 'autoconfirmed', 'emailconfirmed' ),
	),

	// RateLimits
	'+wgRateLimits' => array(
		'default' => array(),
		'metawiki' => array(
			'requestwiki' => array(
				'user' => array( 1, 3600 ),
			),
		),
	),

	// RecentChanges
	'wgRCMaxAge' => array(
		'default' => 180 * 24 * 3600,
	),

	// RelatedArticles settings
	'wgRelatedArticlesFooterWhitelistedSkins' => array(
		'default' => array(
			'minerva',
			'timeless',
			'vector',
		),
		'avalicearchiveswiki' => array(
			'metrolook',
			'vector',
		),
	),
	'wgRelatedArticlesLoggingSamplingRate' => array(
		'default' => false,
		'allthetropeswiki' => '0.01',
		'avalicearchiveswiki' => '0.01',
		'calexitwiki' => '0.01',
		'youtubewiki' => '0.01',
	),
	'wgRelatedArticlesShowReadMore' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'avalicearchiveswiki' => true,
		'calexitwiki' => true,
		'youtubewiki' => true,
	),
	'wgRelatedArticlesShowInFooter' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'avalicearchiveswiki' => true,
		'calexitwiki' => true,
		'youtubewiki' => true,
	),
	'wgRelatedArticlesUseCirrusSearch' => array(
		'default' => false,
	),

	// Restriction types
	'+wgRestrictionLevels' => array(
		'default' => array(
			'user',
		),
		'+bigforestwiki' => array(
			'editvoter',
		),
		'+cmgwiki' => array(
			'bureaucrat',
			'sysop',
			'pm',
			'member',
		),
		'+dpwiki' => array(
			'bureaucrat',
			'respected',
		),
		'+testwiki' => array(
			'bureaucrat',
			'consul',
		),
		'igrovyesistemywiki' => array(
			'trusted',
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		),
		'+kyivstarwiki' => array(
			'co',
			'ceo',
			'editor',
			'extendedconfirmed',
			'sysmag',
			'trusted',
		),
		'+lcars47wiki' => array(
			'bureaucrat',
			'devteam',
		),
		'+marthaspeakswiki' => array(
			'templateeditor',
		),
		'+sau226wiki' => array(
			'bureaucrat',
			'consul',
		),
		'+jayuwikiwiki' => array(
			'editvoter',
		),
		'+pruebawiki' => array(
			'bureaucrat',
			'consul',
		),
		'+radviserwiki' => array(
			'editor',
		),
		'+sovereignwiki' => array(
			'officer',
			'game-master',
		),
		'+studynotekrwiki' => array(
			'voter',
		),
		'+thesciencearchiveswiki' => array(
			'templateeditor',
		),
		'+trexwiki' => array(
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		),
		'weatherwiki' => array(),
	),

	'+wgRestrictionTypes' => array(
		'default' => array(
			'delete',
		),
		'cmgwiki' => array(
			'delete',
			'protect',
		),
		'lcars47wiki' => array(
			'delete',
			'protect',
		),
		'pruebawiki' => array(
			'delete',
			'protect',
		),
		'sau226wiki' => array(
			'delete',
			'protect',
		),
		'testwiki' => array(
			'delete',
			'protect',
		),
		'weatherwiki' => array(),
	),

	// Robot policy
	'wgDefaultRobotPolicy' => array(
		'default' => 'index,follow',
		'ashinawiki' => 'noindex,nofollow',
		'destinoswiki' => 'noindex,nofollow',
		'foodsharinghamburgwiki' => 'noindex,nofollow',
		'ildrilwiki' => 'noindex,nofollow',
		'librewiki' => 'noindex,nofollow',
		'lothuialethwiki' => 'noindex,nofollow',
		'paddelnwiki' => 'noindex,nofollow',
		'reviwikiwiki' => 'noindex,nofollow',
		'zhdelwiki' => 'noindex,nofollow',
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
	'wgScribuntoSlowFunctionThreshold' => array(
		'default' => 0.99,
	),
	'wgScribuntoEngineConf' => array(
		'default' => array(
			'luasandbox' => array(
				'cpuLimit' => 10,
				'maxLangCacheSize' => 200,
			),
			'luastandalone' => array(
				'cpuLimit' => 10,
				'maxLangCacheSize' => 200,
			),
		),
	),

	// Site notice opt out
	'wmgSiteNoticeOptOut' => array(
		'default' => false,
		'nenawikiwiki' => true,
		'weatherwiki' => true,
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
	'wgUserBoard' => array(
		'default' => false,
	),
	'wgUserProfileThresholds' => array(
		'default' => array(
			'edits' => 0,
		),
		'allthetropes' => array(
			'edits' => 10,
		),
	),
	'wgUserProfileDisplay' => array(
		'default' => array(
			'board' => false,
			'friends' => false,
			'foes' => false,
		),
	),
	// Statistics
	'wgArticleCountMethod' => array(
		'default' => 'link', // To update it, you will need to run the maintenance/updateArticleCount.php script
		'fourleafficswiki' => 'any',
		'ildrilwiki' => 'any',
		'lothuialethwiki' => 'any',
	),

	// Squid (aka Varnish)
	'wgUseSquid' => array(
		'default' => true,
	),
	'wgSquidServers' => array(
		'default' => array(
			'107.191.126.23:81', // cp2
			'81.4.109.133:81', // cp4
			'172.104.111.8:81', // cp5
		),
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
	),
	'wgFavicon' => array(
		'default' => '/favicon.ico',
	),
	'wgLogo' => array(
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
	),

	// TemplateSandbox
	'wgTemplateSandboxEditNamespaces' => array(
		'default' => array(
			NS_TEMPLATE,
			WMG_NS_MODULE
		)
	),

	// Timezone
	'wgLocaltimezone' => array(
		'default' => 'UTC',
	),
	
	// Theme
	'wgDefaultTheme' => array(
		'default' => "",
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
			'src'  => 'https://meta.miraheze.org/w/index.php?title=Title_blacklist&action=raw',
		),
		'meta' => array(
			'type' => 'url',
			'src' => 'https://meta.miraheze.org/w/index.php?title=MediaWiki:Titleblacklist&action=raw',
		),
	),
	
	'wgTidyConfig' => array(
		'default' => null,
		'tmewiki' => array(
			'driver' => 'RemexHtml',
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
		'pfl2wiki' => true,
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
			'adadevelopersacademy\.wiki',
			'allthetropes\.org',
			'aman\.info\.tm',
			'antiguabarbudacalypso\.com',
			'astrapedia\.ru',
			'athenapedia\.org',
			'b1tes\.org',
			'bconnected\.aidanmarkham\.com',
			'bebaskanpengetahuan\.org',
			'wiki\.ameciclo\.org',
			'wiki\.autocountsoft\.com',
			'wiki\.besuccess\.com',
			'wiki\.clonedeploy\.org',
			'wiki\.ciptamedia\.org',
			'wiki\.consentcraft\.uk',
			'cornetto\.online',
			'dariawiki\.org',
			'decrypted\.wiki',
			'wiki.dobots\.nl',
			'wiki\.dottorconte\.eu',
			'wiki\.downhillderelicts\.com',
			'wiki\.drones4nature\.info',
			'wiki\.dwplive\.com',
			'www\.eerstelijnszones\.be',
			'embobada\.com',
			'wiki\.exnihilolinux\.org',
			'froggy\.info',
			'fibromyalgia-engineer\.com',
			'fikcyjnatv\.pl',
			'wiki\.gamergeeked\.us',
			'wiki\.gesamtschule-nordkirchen\.de',
			'garrettcountyguide\.com',
			'give\.effectively\.to',
			'wiki\.grottocenter\.org',
			'wiki\.gtsc\.vn',
			'www\.iceposeidonwiki\.com',
			'wiki\.inebriation-confederation\.com',
			'wiki\.jacksonheights\.nyc',
			'karagash\.info',
			'wiki\.kourouklides\.com',
			'kunwok\.org',
			'www\.lab612\.at',
			'wiki\.ldmsys\.net',
			'wiki\.lostminecraftminers\.org',
			'lodge\.jsnydr\.com',
			'wiki\.make717\.org',
			'wiki\.macc\.nyc',
			'madgenderscience\.wiki',
			'marinebiodiversitymatrix\.org',
			'meregos\.com',
			'nenawiki\.org',
			'wiki\.ngscott\.net',
			'nonbinary\.wiki',
			'wiki\.lbcomms\.co.za',
			'wiki\.rizalespe\.com',
			'saf\.songcontests\.eu',
			'wiki\.staraves-no\.cz',
			'wiki.pupilliam\.com',
			'oecumene\.org',
			'www\.openonderwijs\.org',
			'papelor\.io',
			'permanentfuturelab\.wiki',
			'pl\.nonbinary\.wiki',
			'podpedia\.org',
			'programming\.red',
			'publictestwiki\.com',
			'pwiki.arkcls.com',
			'reviwiki\.info',
			'russopedia\.info',
			'private\.revi.wiki',
			'saveta\.org',
			'sdiy\.info',
			'studentwiki\.ddns\.net',
			'www\.splat-teams\.com',
			'takethatwiki\.com',
			'wiki\.taotac.org',
			'taotac\.info'.
			'wiki\.teessidehackspace\.org\.uk',
			'wiki\.tensorflow\.community',
			'thelonsdalebattalion\.co.uk',
			'toonpedia\.cf',
			'wiki\.tulpa\.info',
			'wiki\.valentinaproject.org',
			'wiki\.kaisaga.com',
			'wikiescola\.com\.br',
			'wiki\.worlduniversityandschool\.org'.
			'wikipuk\.cl',
			'wiki\.ombre\.io',
			'wiki.rmbrk\.com',
			'wisdomwiki\.org',
			'sandbox\.wisdomwiki.org',
			'savage-wiki\.com',
			'speleo\.wiki',
			'www\.zenbuddhism\.info',
			'wiki\.zymonic\.com',
			'espiral\.org',
			'spiral\.wiki',
			'wikibase\.revi\.wiki',
			'wiki\.teamwizardry\.com',
			'wiki\.svenskabriardklubben\.se',
			'www\.schulwiki\.de',
			'holonet\.pw',
			'guiasdobrasil\.com\.br',
			'enc\.for\.uz',
			'docs\.websmart\.media',
			'wiki\.mikrodev\.com',
			'wiki\.campaign-labour\.org',
			'encyclopedie\.didactiqueprofessionnelle\.org',
		),
	),

	// VisualEditor
	'wmgVisualEditorEnableDefault' => array(
		'default' => true,
		'allthetropeswiki' => false,
		'isvwiki' => false,
		'jcswiki' => true,
		'malaysiawiki' => true,
		'schulwiki' => true,
		'testwiki' => false,
	),
	'wmgVisualEditorAvailableNamespaces' => array(
		'default' => array(
			NS_MAIN => true,
			NS_USER => true,
		),
		'wmgVisualEditorAvailableNamespaces' => array(
 		'default' => array(
			NS_MAIN => true,
			NS_USER => true,
		),
		'+apunteswiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+centralwiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+destinoswiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+infowiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+mediatecawiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+privadowiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+tallerwiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+ucroniaswiki' => array(
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
	 	 ),
		'+calexitwiki' => array(
			NS_DRAFT => true,
			NS_HELP => true,
			NS_HISTORICAL_TIMELINE => true,
			NS_OPINION => true,
			NS_TIMELINE => true,
 			NS_PORTAL => true,
		),
		'+cristianopediawiki' => array(
			NS_TEMA => true,
		),		
		'+espiralwiki' => array(
			NS_PROJECT => true,
		),
		'+isvwiki' => array(
			NS_LIBRARY => true,
		),
		'+oncprojectwiki' => array(
			NS_PROJECT => true,
			NS_TEMPLATE => true,
			NS_CATEGORY => true,
			NS_FILE => true,
		),
		'+tallerdecristianopediawiki' => array(
			NS_TEMA => true,
		),
		'+wisdomwikiwiki' => array(
			NS_LCS => true,
			NS_MEDI => true,
			NS_LIBRARY => true,
			NS_TEACHING => true,
			NS_BLANK => true,
		),
	),
	'wgVisualEditorShowBetaWelcome' => array(
		'default' => true,
		'isvwiki' => false,
		'jcswiki' => false,
		'apunteswiki' => false,
		'centralwiki' => false,
		'destinoswiki' => false,
		'infowiki' => false,
		'mediatecawiki' => false,
		'privadowiki' => false,
		'tallerwiki' => false,
		'ucroniaswiki' => false,
	),
	'wgVisualEditorSupportedSkins' => array(
		'default' => array(),
		'permanentfuturelabwiki' => array( 'foreground' ),
		'pfsolutions' => array( 'metrolook' ),
	),
	'wgVisualEditorUseSingleEditTab' => array(
		'default' => false,
		'espiralwiki' => true,
		'isvwiki' => true,
		'spiralwiki' => true,
	),

	// Protect site config
	'wgProtectSiteLimit' => array(
		'default' => '1 week',
		'infectopedwiki' => '10 years',
		'campaignlabwiki' => 'indefinite',
		'tnoteswiki' => 'indefinite',
		'weatherwiki' => 'indefinite',
	),
	'wgProtectSiteDefaultTimeout' => array(
		'default' => '1 hour',
		'infectopedwiki' => '1 year',
		'tnoteswiki' => '2 hours',
		'weatherwiki' => '1 week',
	),		

	// WebChat config
	'wmgWebChatServer' => array(
		'default' => false,
		'allthetropeswiki' => 'irc.freenode.net',
		'ildrilwiki' => 'irc.sorcery.net',
		'lothuialethwiki' => 'irc.sorcery.net',
		'pnphilotenwiki' => 'irc.freenode.net',
		'wisdomwikiwiki' => 'irc.freenode.net',
	),
	'wmgWebChatChannel' => array(
		'default' => false,
		'allthetropeswiki' => '#miraheze-allthetropes',
		'ildrilwiki' => '#Aesir',
		'lothuialethwiki' => '#Aesir',
		'pnphilotenwiki' => '#miraheze-pnphiloten',
		'wisdomwikiwiki' => '#miraheze-wisdomwiki',
	),
	'wmgWebChatClient' => array(
		'default' => false,
		'allthetropeswiki' => 'freenodeChat',
		'ildrilwiki' => 'Mibbit',
		'lothuialethwiki' => 'Mibbit',
		'pnphilotenwiki' => 'freenodeChat',
		'wisdomwikiwiki' => 'freenodeChat',
	),
	
	// Wikimedia Incubator Settings
	
	'wmincProjects' => array(
		'default' => array(
			'p' => 'Wikipedia',
			'b' => 'Wikibooks',
			't' => 'Wiktionary',
			'q' => 'Wikiquote',
			'n' => 'Wikinews',
			'y' => 'Wikivoyage',
			's' => 'Wikisource',
			'v' => 'Wikiversity',
		),
	),
	'wmincProjectSite' => array(
		'default' => array(
			'name' => 'Incubator Plus 2.0',
			'short' => 'incplus',
		),
	),
	'wmincSisterProjects' => array(
		'default' => false,
	),
	'wmincExistingWikis' => array(
		'default' => false,
	),
	'wmincClosedWikis' => array(
		'default' => false,
	),
	'wmincMultilingualProjects' => array(
		'default' => false,
	),
		

	// Whitelist
	'wmgUseMainPageWhitelist' => array(
		'default' => true,
		'rwsaleswiki' => false,
	),



	// WikiDiscover
	'wgWikiDiscoverClosedList' => array(
		'default' => '/srv/mediawiki/dblist/closed.dblist',
	),
	'wgWikiDiscoverInactiveList' => array(
		'default' => '/srv/mediawiki/dblist/inactive.dblist',
	),
	'wgWikiDiscoverPrivateList' => array(
		'default' => '/srv/mediawiki/dblist/private.dblist',
	),

	// Empty arrays (do not touch unless you know what you're doing)
	'wmgClosedWiki' => array(
		'default' => false,
	),
	'wmgInactiveWiki' => array(
		'default' => false,
	),
	'wmgPrivateWiki' => array(
		'default' => false,
	),
	'wgRandomGameDisplay' => array(
		'default' => array(
			'random_picturegame' => false,
			'random_poll' => false,
		),
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
} else {
	$wgDBname = '';
}

# Initialize dblist
$wgLocalDatabases = array();
$wmgDatabaseList = file( "/srv/mediawiki/dblist/all.dblist" );

// ManageWiki settings
require_once( "/srv/mediawiki/config/ManageWiki.php" );

foreach ( $wmgDatabaseList as $wikiLine ) {
	$wikiDB = explode( '|', $wikiLine, 6 );
	list( $DBname, $siteName, $siteLang, $siteExtensions, $siteSettings ) = array_pad( $wikiDB, 6, '' );
	$wgLocalDatabases[] = $DBname;
	$wgConf->settings['wgSitename'][$DBname] = $siteName;
	$wgConf->settings['wgLanguageCode'][$DBname] = $siteLang;

	$siteExtensionsArray = explode( ",", $siteExtensions );
	foreach ( $wgManageWikiExtensions as $name => $ext ) {
		if ( in_array( $name, $siteExtensionsArray ) ) {
			$wgConf->settings[$ext['var']][$DBname] = true;
		}
	}

	$siteSettingsArray = json_decode( $siteSettings, true );
	if ( is_array( $siteSettingsArray ) || is_object( $siteSettingsArray ) ) {
		foreach ( $siteSettingsArray as $setVar => $setVal ) {
			$wgConf->settings[$setVar][$DBname] = $setVal;
		}
	}
}

foreach ( $wgConf->settings['wgServer'] as $name => $val ) {
        if ( $val === 'https://' . $wmgHostname ) {
            $wgDBname = $name;
        }
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

$wmgInactiveDatabasesList = file( "/srv/mediawiki/dblist/inactive.dblist" );
foreach ( $wmgInactiveDatabasesList as $database ) {
	$database = trim( $database );
	$wgConf->settings['wmgInactiveWiki'][$database] = true;
}

// Needs to be set AFTER $wgDBname is set to a correct value
$wgUploadDirectory = "/mnt/mediawiki-static/$wgDBname";
$wgUploadPath = "https://static.miraheze.org/$wgDBname";

$wgConf->wikis = $wgLocalDatabases;
$wgConf->extractAllGlobals( $wgDBname );

if ( !preg_match( '/^(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
        $wgCentralAuthCookieDomain = $wmgHostname;
	$wgCookieDomain = $wmgHostname;
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

if ( $wgDBname === 'tmewiki' ) {
	$wgFooterIcons['poweredby']['wikiapiary'] = array(
    		'src' => 'https://wikiapiary.com/w/images/wikiapiary/b/b4/Monitored_by_WikiApiary.png',
    		'url' => 'https://wikiapiary.com/wiki/The_Multilingual_Encyclopedia_(miraheze.org)',
    		'alt' => 'Monitored by WikiApiary',
	);
}

$wgDefaultUserOptions['enotifwatchlistpages'] = 0;
$wgDefaultUserOptions['globaluserpage'] = false;
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;

if ( !file_exists( '/srv/mediawiki/w/cache/l10n/l10n_cache-en.cdb' ) ) {
	$wgLocalisationCacheConf['manualRecache'] = false;
}

$wgExtensionEntryPointListFiles[] = "/srv/mediawiki/config/extension-list";

// Fonts
putenv( "GDFONTPATH=/usr/share/fonts/truetype/freefont" );

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
require_once( "/srv/mediawiki/config/Sitenotice.php" );

// per T3457 - Miraheze Commons
if ( $wgDBname !== 'commonswikiwiki' ) {
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared-commons',
		'directory' => '/mnt/mediawiki-static/commonswikiwiki',
		'url' => 'https://static.miraheze.org/commonswikiwiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => 'commonswikiwiki',
		'descBaseUrl' => 'https://commonswiki.miraheze.org/wiki/File:',
	];
}

// Servers accessible by non cache proxies should not have squid config enabled
if ( !preg_match( "/^mw[0-9]*/", wfHostname() ) ) {
	$wgUseSquid = false;
}

// Define last to avoid all dependencies
require_once( "/srv/mediawiki/config/LocalWiki.php" );

// Define last - Extension message files for loading extensions
if ( !defined( 'MW_NO_EXTENSION_MESSAGES' ) ) {
	require_once( "/srv/mediawiki/config/ExtensionMessageFiles.php" );
}
