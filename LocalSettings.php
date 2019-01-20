<?php
/*
LocalSettings.php for Miraheze.
Authors of initial version: Southparkfan, John Lewis, Orain contributors
*/

# Load PrivateSettings (e.g. wgDBpassword)
require_once "/srv/mediawiki/config/PrivateSettings.php";

# Load global skins and extensions
require_once "/srv/mediawiki/config/GlobalSkins.php";
require_once "/srv/mediawiki/config/GlobalExtensions.php";

# Don't allow web access.
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wmgUploadHostname = "static.miraheze.org";

# Initialize $wgConf
$wgConf = new SiteConfiguration;
$wgConf->suffixes = [ 'wiki' ];
$wgLocalVirtualHosts = [ '81.4.109.166' ];

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
define( 'NS_SERVER_TALK', 1617 );
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
define( 'NS_TEST', 1632 );
define( 'NS_TEST_TALK', 1633 );
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
define( 'NS_LIBRARY', 1658 );
define( 'NS_LIBRARY_TALK', 1659 );
define( 'NS_TEACHING', 1660 );
define( 'NS_TEACHING_TALK', 1661 );
define( 'NS_BLANK', 1662 );
define( 'NS_BLANK_TALK', 1663 );
define( 'NS_RESEARCH', 1664 );
define( 'NS_RESEARCH_TALK', 1665 );
define( 'NS_ADMIN', 1666 );
define( 'NS_ADMIN_TALK', 1667 );
define( 'NS_WORKSHOP', 1668 );
define( 'NS_WORKSHOP_TALK', 1669 );
define( 'NS_SELP', 1670 );
define( 'NS_SELP_TALK', 1671 );
define( 'NS_STUDY_NOTE', 1672 );
define( 'NS_STUDY_NOTE_TALK', 1673 );
define( 'NS_EXPLANATION', 1674 );
define( 'NS_EXPLANATION_TALK', 1675 );
define( 'NS_KOREAN_STUDY_NOTE', 1676 );
define( 'NS_KOREAN_STUDY_NOTE_TALK', 1677 );
define( 'NS_GLOSSARY', 1678 );
define( 'NS_GLOSSARY_TALK', 1679 );
define( 'NS_SPRITES', 1680 );
define( 'NS_SPRITES_TALK', 1681 );
define( 'NS_GALLERY', 1682 );
define( 'NS_GALLERY_TALK', 1683 );
define( 'NS_HALAMAN', 1684 );
define( 'NS_HALAMAN_TALK', 1685 );
define( 'NS_DICT', 1686 );
define( 'NS_DICT_TALK', 1687 );
define( 'NS_FEATURED', 1688 );
define( 'NS_FEATURED_TALK', 1689 );
define( 'NS_ARTIKEL', 1690 );
define( 'NS_ARTIKEL_TALK', 1691 );
define( 'NS_VIDEO', 1692 );
define( 'NS_VIDEO_TALK', 1693 );
define( 'NS_OPINION', 1694 );
define( 'NS_OPINION_TALK', 1695 );
define( 'NS_TIMELINE', 1696 );
define( 'NS_TIMELINE_TALK', 1697 );
define( 'NS_DRAFT', 1700 );
define( 'NS_DRAFT_TALK', 1701 );
define( 'NS_HISTORICAL_TIMELINE', 1702 );
define( 'NS_HISTORICAL_TIMELINE_TALK', 1703 );
define( 'NS_QUIZSET', 1704 );
define( 'NS_QUIZSET_TALK', 1705 );
define( 'NS_NOTEBOOK', 1706 );
define( 'NS_NOTEBOOK_TALK', 1707 );
define( 'NS_SOURCE', 1708 );
define( 'NS_SOURCE_TALK', 1709 );
define( 'NS_GAME', 1710 );
define( 'NS_GAME_TALK', 1711 );
define( 'NS_PICTUREBOARD', 1712 );
define( 'NS_PICTUREBOARD_TALK', 1713 );
define( 'NS_TINYFOREST', 1714 );
define( 'NS_TINYFOREST_TALK', 1715 );
define( 'NS_WNS2', 1716 );
define( 'NS_WNS2_TALK', 1717 );
define( 'NS_HOWTO', 1718 );
define( 'NS_HOWTO_TALK', 1719 );
define( 'NS_NEWSLINK', 1720 );
define( 'NS_NEWSLINK_TALK', 1721 );
define( 'NS_CIVILIZATION_IV', 1722 );
define( 'NS_CIVILIZATION_IV_TALK', 1723 );
define( 'NS_PSEUDO_NEWS', 1724 );
define( 'NS_PSEUDO_NEWS_TALK', 1725 );
define( 'NS_PSEUDO_BASE_DICTIONARY', 1726 );
define( 'NS_PSEUDO_BASE_DICTIONARY_TALK', 1727 );
define( 'NS_PSEUDO_BASE_LIBRARY', 1728 );
define( 'NS_PSEUDO_BASE_LIBRARY_TALK', 1729 );
define( 'NS_PSEUDO_BASE_MUSIC', 1730 );
define( 'NS_PSEUDO_BASE_MUSIC_TALK', 1731 );
define( 'NS_RGB', 1732 );
define( 'NS_RGB_TALK', 1733 );
define( 'NS_LINESTYLE', 1734 );
define( 'NS_LINESTYLE_TALK', 1735 );
define( 'NS_IDEA', 1736 );
define( 'NS_IDEA_TALK', 1737 );
define( 'NS_POLICY', 1738 );
define( 'NS_POLICY_TALK', 1739 );
define( 'NS_LEGACY', 1740 );
define( 'NS_LEGACY_TALK', 1741 );
define( 'NS_BOILERPLATE', 1742 );
define( 'NS_BOILERPLATE_TALK', 1743 );
define( 'NS_WPIMPORT', 1744 );
define( 'NS_WPIMPORT_TALK', 1745 );
define( 'NS_ARCHIVE', 1746 );
define( 'NS_ARCHIVE_TALK', 1747 );
define( 'NS_WPREDIRECT', 1748 );
define( 'NS_WPREDIRECT_TALK', 1749 );
define( 'NS_WALKTHROUGH', 1750 );
define( 'NS_WALKTHROUGH_TALK', 1751 );
define( 'NS_STAFF', 1752 );
define( 'NS_STAFF_TALK', 1753 );
define( 'NS_TEMA', 1754 );
define( 'NS_TEMA_TALK', 1755 );
define( 'NS_PAGE', 1756 );
define( 'NS_PAGE_TALK', 1757 );
define( 'NS_ANEXO', 1758 );
define( 'NS_ANEXO_TALK', 1759 );
define( 'NS_ESTUDIO', 1760 );
define( 'NS_ESTUDIO_TALK', 1761 );
define( 'NS_PRUEBA', 1762 );
define( 'NS_PRUEBA_TALK', 1763 );
define( 'NS_REGISTRO', 1764 );
define( 'NS_REGISTRO_TALK', 1765 );
define( 'NS_LISTA', 1766 );
define( 'NS_LISTA_TALK', 1767 );
define( 'NS_BUG', 1768 );
define( 'NS_BUG_TALK', 1769 );
define( 'NS_PROYECTO', 1770 );
define( 'NS_PROYECTO_TALK', 1771 );
define( 'NS_TALLER', 1772 );
define( 'NS_TALLER_TALK', 1773 );
define( 'NS_MODELO', 1774 );
define( 'NS_MODELO_TALK', 1775 );
define( 'NS_HANDBOOK', 1776 );
define( 'NS_HANDBOOK_TALK', 1777 );
define( 'NS_EXTENSION', 1778 );
define( 'NS_EXTENSION_TALK', 1779 );
define( 'NS_SKIN', 1780 );
define( 'NS_SKIN_TALK', 1781 );
define( 'NS_GAMEPAGE', 1782 );
define( 'NS_GAMEPAGE_TALK', 1783 );
define( 'NS_BOOK', 1784 );
define( 'NS_BOOK_TALK', 1785 );
define( 'NS_BOOK_NAVIGATION', 1786 );
define( 'NS_BOOK_NAVIGATION_TALK', 1787 );
define( 'NS_APPLICATION', 1788 );
define( 'NS_APPLICATION_TALK', 1789 );
define( 'NS_SUMMARY', 1790 );
define( 'NS_SUMMARY_TALK', 1791 );
define( 'NS_MANUAL', 1790 );
define( 'NS_MANUAL_TALK', 1791 );
define( 'NS_API', 1792 );
define( 'NS_API_TALK', 1793 );
define( 'NS_DATA', 1794 );
define( 'NS_DATA_TALK', 1795 );
define( 'NS_DICTIONARY', 1796 );
define( 'NS_DICTIONARY_TALK', 1797 );
define( 'NS_CALENDAR', 1798 );
define( 'NS_CALENDAR_TALK', 1799 );
define( 'NS_ENCYCLOPEDIA', 1800 );
define( 'NS_ENCYCLOPEDIA_TALK', 1801 );
define( 'NS_QURAN', 1802 );
define( 'NS_QURAN_TALK', 1803 );
define( 'NS_CYTATY', 1804 );
define( 'NS_CYTATY_TALK', 1805 );
define( 'NS_NONNEWS', 1806 );
define( 'NS_NONNEWS_TALK', 1807 );
define( 'NS_NONZRODLA', 1808 );
define( 'NS_NONZRODLA_TALK', 1809 );
define( 'NS_SLOWNIK', 1810 );
define( 'NS_SLOWNIK_TALK', 1811 );
define( 'NS_GRA', 1812 );
define( 'NS_GRA_TALK', 1813 );
define( 'NS_PORADNIK', 1814 );
define( 'NS_PORADNIK_TALK', 1815 );
define( 'NS_PORUM', 1816 );
define( 'NS_PORUM_TALK', 1817 );
define( 'NS_THREAD', 1818 );
define( 'NS_THREAD_TALK', 1819 );
define( 'NS_MESSAGE_WALL', 1820 );
define( 'NS_MESSAGE_WALL_TALK', 1821 );
define( 'NS_USER_BLOG', 1822 );
define( 'NS_USER_BLOG_TALK', 1823 );
define( 'NS_USER_BLOG_COMMENT', 1824 );
define( 'NS_USER_BLOG_COMMENT_TALK', 1825 );
define( 'NS_HUB', 1826 );
define( 'NS_HUB_TALK', 1827 );
define( 'NS_LIST', 1828 );
define( 'NS_LIST_TALK', 1829 );
define( 'NS_LAW', 1830 );
define( 'NS_LAW_AMENDING', 1831 );
define( 'NS_EXECUTIVE_ORDER', 1832 );
define( 'NS_EXECUTIVE_ORDER_TALK', 1833 );
define( 'NS_GROUP', 1834 );
define( 'NS_GROUP_TALK', 1835 );
define( 'NS_PARAMETER', 1836 );
define( 'NS_PARAMETER_TALK', 1837 );
define( 'NS_EXAMPLE', 1838 );
define( 'NS_EXAMPLE_TALK', 1839 );
define( 'NS_STOREFRONT', 1840 );
define( 'NS_STOREFRONT_TALK', 1841 );
define( 'NS_MUSINGS', 1842 );
define( 'NS_MUSINGS_TALK', 1843 );
define( 'NS_TECHDICT', 1844 );
define( 'NS_TECHDICT_TALK', 1845 );

define( 'NS_PORTALE', 2000 ); // Skipping values to 2000 per T3553
define( 'NS_DISCUSSIONI_PORTALE', 2001 );
define( 'NS_PROGETTO', 2002 );
define( 'NS_DISCUSSIONI_PROGETTO', 2003 );
define( 'NS_CIMITERO', 2004 );
define( 'NS_DISCUSSIONI_CIMITERO', 2005 );
define( 'NS_NONNOTIZIE', 2006 );
define( 'NS_DISCUSSIONI_NONNOTIZIE', 2007 );
define( 'NS_NONVOYAGE', 2008 );
define( 'NS_DISCUSSIONI_NONVOYAGE', 2009 );
define( 'NS_NONQUOTE', 2010 );
define( 'NS_DISCUSSIONI_NONQUOTE', 2011 );
define( 'NS_NONDIZIONARIO', 2012 );
define( 'NS_DISCUSSIONI_NONDIZIONARIO', 2013 );
define( 'NS_NONIVERSITA', 2014 );
define( 'NS_DISCUSSIONI_NONIVERSITA', 2015 );
define( 'NS_NONSOURCE', 2016 );
define( 'NS_DISCUSSIONI_NONSOURCE', 2017 );
define( 'NS_NONBOOKS', 2018 );
define( 'NS_DISCUSSIONI_NONBOOKS', 2019 );
define( 'NS_FANWORK', 2020 );
define( 'NS_FANWORK_TALK', 2021 );
define( 'NS_SOP_ATS_MKW', 2024 );
define( 'NS_SOP_ATS_MKW_TALK', 2025 );
define( 'NS_MOS_MKW', 2026 );
define( 'NS_MOS_MKW_TALK', 2027 );
define( 'NS_LOA', 2028 );
define( 'NS_LOA_TALK', 2029 );
define( 'NS_LOCA_MKW', 2030 );
define( 'NS_LOCA_MKW_TALK', 2031 );
define( 'NS_TUT', 2032 );
define( 'NS_TUT_TALK', 2033 );
define( 'NS_ASPECT', 2034 );
define( 'NS_ASPECT_TALK', 2035 );

// Refer to NS_MODULE before importing Scribunto (tmewiki)
define( 'WMG_NS_MODULE', 828 );
define( 'WMG_NS_MODULE_TALK', 829 );

// Special namespace re-defined
define( 'NS_PROOFREAD_PAGE', 250 );
define( 'NS_PROOFREAD_PAGE_TALK', 251 );
define( 'NS_PROOFREAD_INDEX', 252 );
define( 'NS_PROOFREAD_INDEX_TALK', 253 );

// NS 860, 861, 862, 863 allocated for Item/Item_talk/Property/Property_talk by Wikibase

$wgConf->settings = [
	// invalidates user sessions [MWExempt]
	'wgAuthenticationTokenVersion' => [
		'default' => '3',
	],

	// AbuseFilter [MWCandidate]
	'wgAbuseFilterActions' => [
		'default' => [
			'block' => true,
			'blockautopromote' => true,
			'degroup' => true,
			'disallow' => true,
			'rangeblock' => true,
			'tag' => true,
			'throttle' => true,
			'warn' => true,
		],
	],
	'wgAbuseFilterCentralDB' => [
		'default' => 'metawiki',
	],
	'wgAbuseFilterIsCentral' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgAbuseFilterBlockDuration' => [
		'default' => 'indefinte',
		'weatherwiki' => '1 week',
	],
	'wgAbuseFilterAnonBlockDuration' => [
		'default' => 2592000,
		'weatherwiki' => '72 hours',
	],
	'wgAbuseFilterRestrictions' => [
		'default' => [
			'blockautopromote' => true,
			'block' => true,
			'degroup' => true,
			'rangeblock' => true,
		],
		'weatherwiki' => [
			'blockautopromote' => false,
			'block' => false,
			'degroup' => false,
			'rangeblock' => true,
		],
	],
	// Anti-spam [MWCandidate]
	'wgAccountCreationThrottle' => [
		'default' => 5,
		'proxybotwiki' => 7,
		'weatherwiki' => 6,
	],
	'wgAutoConfirmAge' => [
		'default' => 345600, // 4 days * 24 hours * 60 minutes * 60 seconds
		'marioserieswikiwiki' => 2592000, // 30 days * 24 hours * 60 minutes * 60 seconds
		'proxybotwiki' => 604800, // 7 days * 24 hours * 60 minutes * 60 seconds
	],
	'wgAutoConfirmCount' => [
		'default' => 10,
		'marioserieswikiwiki' => 500,
 	],

	// BetaFeatures [MWCandidate]
	'wgMediaViewerIsInBeta' => [
		'default' => false,
	],
	'wgPopupsBetaFeature' => [
		'default' => false,
	],
	'wgVisualEditorEnableWikitext' => [
		'default' => false,
	],
	'wgPivotFeatures' => [
		'thegreatwarwiki' => [
			'usePivotTabs' => true,
			'fixedNavBar' => true,
			'showHelpUnderTools' => false,
			'showRecentChangesUnderTools' => false,
			'wikiNameDesktop' => 'The Great War 1914-1918',
			'showFooterIcons' => true
		],
	],
	'wgEnableRcFiltersBetaFeature' => [
		'default' => false,
		'test1wiki' => true,
	],
	// Block [MWCandidate]
	'wgAutoblockExpiry' => [
		'default' => 86400, // 24 hours * 60 minutes * 60 seconds
		'brynda1231wiki' => 230400, // 64 hours * 60 minutes * 60 seconds
		'marioserieswiki' => 111600, // 31 hours - T1709
	],
	'wgBlockAllowsUTEdit' => [
		'default' => true,
	],

	// Bot passwords [MWExempt]
	'wgBotPasswordsDatabase' => [
		'default' => 'mhglobal',
	],

	// Cache [MWExempt]
	'wgCacheDirectory' => [
		'default' => '/srv/mediawiki/w/cache',
	],
	'wgLocalisationCacheConf' => [
		'default' => [
			'class' => 'LocalisationCache',
			'store' => 'files',
			'storeDirectory' => "$IP/cache/l10n",
			'manualRecache' => true,
		],
	],
	'wgPreprocessorCacheThreshold' => [
		'default' => false,
	],
	'wgResourceLoaderMaxage' => [
		'default' => [
			'versioned' => [
				'server' => 12 * 60 * 60, // 12 hours
				'client' => 1 * 24 * 60 * 60, // 1 day
			],
			'unversioned' => [
				'server' => 5 * 60, // 5 minutes
				'client' => 30 * 60, // 30 minutes
			],
		],
	],
	'wgRevisionCacheExpiry' => [
		'default' => 0,
	],

	// CentralNotice [MWExempt]
	'wgNoticeInfrastructure' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgCentralSelectedBannerDispatcher' => [
		'default' => "//meta.miraheze.org/w/index.php/Special:BannerLoader",
	],
	'wgCentralBannerRecorder' => [
		'default' => "//meta.miraheze.org/w/index.php/Special:RecordImpression",
	],
	'wgCentralDBname' => [
		'default' => 'metawiki',
	],
	'wgCentralHost' => [
		'default' => "//meta.miraheze.org",
	],
	'wgNoticeProject' => [
		'default' => 'all',
	],
	'wgNoticeProjects' => [
		'default' => [
			'all',
			'optout',
		],
	],
	'wgNoticeUseTranslateExtension' => [
		'default' => true,
	],

	// Captcha [MWExempt]
	'wgCaptchaClass' => [
		'default' => 'ReCaptchaNoCaptcha',
	],
	'wgReCaptchaSendRemoteIP' => [
		'default' => false,
	],

	// Category
	'wgUseCategoryBrowser' => [
		'default' => false,
		'modesofdiscoursewiki' => true,
	],

	// CentralAuth [MWExempt]
	'wgCentralAuthAutoCreateWikis' => [
		'default' => [ 'loginwiki', 'metawiki' ],
	],
	'wgCentralAuthAutoNew' => [
		'default' => true,
	],
	'wgCentralAuthAutoMigrate' => [
		'default' => true,
	],
	'wgCentralAuthAutoMigrateNonGlobalAccounts' => [
		'default' => true,
	],
	'wgCentralAuthCookies' => [
		'default' => true,
	],
	'wgCentralAuthCookieDomain' => [
		'default' => '.miraheze.org',
	],
	'wgCentralAuthCreateOnView' => [
		'default' => true,
		'nenawikiwiki' => false,
	],
	'wgCentralAuthDatabase' => [
		'default' => 'mhglobal',
	],
	'wgCentralAuthEnableGlobalRenameRequest' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgCentralAuthEnableUserMerge' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgCentralAuthLoginWiki' => [
		'default' => 'loginwiki',
	],
	'wgCentralAuthPreventUnattached' => [
		'default' => true,
	],
	'wgCentralAuthSilentLogin' => [
		'default' => true,
	],

	// CheckUser [MWExempt]
	'wgCheckUserForceSummary' => [
		'default' => true,
	],

	// Comments extension [MWCandidate]
	'wgCommentsDefaultAvatar' => [
		'default' => '/w/extensions/SocialProfile/avatars/default_ml.gif',
	],

	'wgCommentsInRecentChanges' => [
		'default' => false,
		'newusopediawiki' => true,
	],

	'wgCommentsSortDescending' => [
		'default' => false,
		'newusopediawiki' => true,
	],

	 // Contribution Scores [MWCandidate]
	 'wgContribScoreDisableCache' => [
		 'default' => true,
	 ],

	// CreateWiki [MWExempt]
	'wgCreateWikiCustomDomainPage' => [
		'default' => 'Special:MyLanguage/Custom_domains',
	],
	'wgCreateWikiDatabase' => [
		'default' => 'mhglobal',
	],
	'wgCreateWikiGlobalWiki' => [
		'default' => 'metawiki',
	],
	'wgCreateWikiDBDirectory' => [
		'default' => '/srv/mediawiki/dblist',
	],
	'wgCreateWikiEmailNotifications' => [
		'default' => true,
	],
	'wgCreateWikiNotificationEmail' => [
		'default' => 'staff@miraheze.org',
	],
	'wgCreateWikiSQLfiles' => [
		'default' => [
			"$IP/maintenance/tables.sql",
			"$IP/extensions/AbuseFilter/abusefilter.tables.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/BetaFeatures/sql/create_counts.sql",
			"$IP/extensions/CheckUser/cu_log.sql",
			"$IP/extensions/CheckUser/cu_changes.sql",
			"$IP/extensions/Echo/echo.sql",
			"$IP/extensions/GlobalBlocking/globalblocking.sql",
			"$IP/extensions/Moderation/sql/patch-moderation.sql",
			"$IP/extensions/Moderation/sql/patch-moderation_block.sql",
			"$IP/extensions/OAuth/backend/schema/mysql/OAuth.sql",
			"$IP/extensions/RottenLinks/sql/rottenlinks.sql",
			"$IP/extensions/Translate/sql/revtag.sql",
			"$IP/extensions/Translate/sql/translate_groupreviews.sql",
			"$IP/extensions/Translate/sql/translate_groupstats.sql",
			"$IP/extensions/Translate/sql/translate_messageindex.sql",
			"$IP/extensions/Translate/sql/translate_metadata.sql",
			"$IP/extensions/Translate/sql/translate_reviews.sql",
			"$IP/extensions/Translate/sql/translate_sections.sql",
			"$IP/extensions/Translate/sql/translate_stash.sql",
			"$IP/extensions/Translate/sql/translate_tm.sql",
			"$IP/extensions/UrlShortener/schemas/urlshortcodes.sql"
		],
	],
	'wgCreateWikiCategories' => [
		'default' => [
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
		],
	],
	'wgCreateWikiUseCategories' => [
		'default' => true,
	],
	'wgCreateWikiSubdomain' => [
		'default' => 'miraheze.org',
	],
	'wgCreateWikiUseClosedWikis' => [
		'default' => true,
	],
	'wgCreateWikiUseCustomDomains' => [
		'default' => true,
	],
	'wgCreateWikiUseInactiveWikis' => [
		'default' => true,
	],
	'wgCreateWikiUsePrivateWikis' => [
		'default' => true,
	],

	// Cookies extension settings [MWCandidate]
	'wgCookieWarningMoreUrl' => [
		'default' => 'https://meta.miraheze.org/wiki/Privacy_Policy#4._Cookies',
		'thelonsdalebattalionwiki' => 'https://thelonsdalebattalion.co.uk/wiki/The_Lonsdale_Battalion:Cookies'
	],
	'wgCookieSetOnAutoblock' => [
		'default' => true,
		'weatherwiki' => false,
	],
	'wgCookieWarningEnabled' => [
		'default' => true,
	],
	'wgCookieWarningGeoIPLookup' => [
		'default' => 'php',
	],
	'wgCookieWarningGeoIp2' => [
		'default' => true,
	],
	'wgCookieWarningGeoIp2Path' => [
		'default' => '/srv/GeoLite2-City.mmdb',
	],

	// Cookie stuff
	'wgCookieSetOnIpBlock' => [
		'default' => true,
	],

	// RC feed [MWCandidate]
	'wgStructuredChangeFiltersShowPreference' => [
		'default' => true,
		'reviwiki' => false,
		'reviwikiwiki' => false,
		'apunteswiki' => false,
		'centralwiki' => false,
		'destinoswiki' => false,
		'infowiki' => false,
		'mediatecawiki' => false,
		'privadowiki' => false,
		'tallerwiki' => false,
		'ucroniaswiki' => false,
	],
	'wgStructuredChangeFiltersShowWatchlistPreference' => [
		'default' => true,
	],
	'wgStructuredChangeFiltersOnWatchlist' => [
		'default' => true,
	],
	// Database [MWExempt]
	'wgAllowSchemaUpdates' => [
		'default' => false,
	],
	'wgCompressRevisions' => [
		'default' => false,
		'allthetropeswiki' => true,
		'buswiki' => true,
		'nonciclopediawiki' => true,
		'nonsensopediawiki' => true,
		'openhatchwiki' => true,
	],
	'wgDBadminuser' => [
		'default' => 'wikiadmin',
	],
	'wgDBuser' => [
		'default' => 'mediawiki',
	],

	'wgReadOnly' => [
		'default' => false,
	],
	'wgSharedDB' => [
		'default' => 'metawiki',
	],
	'wgSharedTables' => [
		'default' => [],
	],
	'wgActorTableSchemaMigrationStage' => [
		'default' => SCHEMA_COMPAT_NEW,
		'test1wiki' => SCHEMA_COMPAT_NEW,
	],

	'wgCommentTableSchemaMigrationStage' => [
		'default' => MIGRATION_NEW,
	],

	// Uncategorised? [MWCandidate]
	'wgMaxImageArea' => [
		'default' => '1.25e7',
		'altversewiki' => '2.5e7',
		'nonbinarywiki' => '2.5e7',
	],

	// Delete [MWExempt]
	'wgDeleteRevisionsLimit' => [
		'default' => '250', // databases don't have much memory - let's not overload them in future
	],

	// DJVU [MWExempt]
	'wgDjvuDump' => [
		'default' => '/usr/bin/djvudump',
	],
	'wgDjvuRenderer' => [
		'default' => '/usr/bin/ddjvu',
	],
	'wgDjvuTxt' => [
		'default' => '/usr/bin/djvutxt',
	],

	// ParserFunctions [MW]
	'wgPFEnableStringFunctions' => [
		'default' => false,
	],
	'wgAllowSlowParserFunctions' => [
		'default' => false,
	],

	// Echo [MWCandidate]
	'wgEchoCrossWikiNotifications' => [
		'default' => true,
		'weatherwiki' => false,
	],
	'wgEchoUseJobQueue' => [
		'default' => true,
	],
	'wgEchoSharedTrackingCluster' => [
		'default' => 'echo',
	],
	'wgEchoSharedTrackingDB' => [
		'default' => 'metawiki',
	],
	'wgEchoUseCrossWikiBetaFeature' => [
		'default' => true,
		'weatherwiki' => false,
	],
	// Exempt from Robot Control (INDEX/NOINDEX namespaces) [MWCandidate]
	'wgExemptFromUserRobotsControl' => [
		'default' => $wgContentNamespaces,
		'thelonsdalebattalionwiki' => [],
	],

	// Extensions and Skins [MWCandidate]
	'wmgUse3D' => [
		'default' => false,
	],
	'wmgUseAddThis' => [
		'default' => false,
	],
	'wmgUseAddHTMLMetaAndTitle' => [
		'default' => false,
	],
	'wmgUseAdminLinks' => [
		'default' => false,
	],
	'wmgUseAJAXPoll' => [
		'default' => false,
	],
	'wmgUseApex' => [
		'default' => false,
	],
	'wmgUseApprovedRevs' => [
		'default' => false,
	],
	'wmgUseArticleFeedbackv5' => [
		'default' => false,
	],
	'wmgUseArticleRatings' => [
		'default' => false,
	],
	'wmgUseArticleToCategory2' => [
		'default' => false,
	],
	'wmgUseAuthorProtect' => [
		'default' => false,
	],
	'wmgUseAutoCreateCategoryPages' => [
		'default' => false, // DO NOT enable on wikis that have more than 500 categories. See T1230
	],
	'wmgUseBlogPage' => [
		'default' => false,
	],
	'wmgUseBabel' => [
		'default' => false,
	],
	'wmgUseMSCalendar' => [
		'default' => false,
	],
	'wmgUseCapiunto' => [
		'default' => false,
	],
	'wmgUseCargo' => [
		'default' => false,
	],
	'wmgUseCategoryTree' => [
		'default' => true,
		'whentheycrywiki' => false,
	],
	'wmgUseCharInsert' => [
		'default' => false,
	],
	'wmgUseCite' => [
		'default' => false,
	],
	'wmgUseCiteThisPage' => [
		'default' => false,
	],
	'wmgUseCitoid' => [
		'default' => false,
	],
	'wmgUseCodeEditor' => [
		'default' => false,
	],
	'wmgUseCodeMirror' => [
		'default' => false,
	],
	'wmgUseCollapsibleVector' => [
		'default' => false,
	],
	'wmgUseCollection' => [
		'default'  => false,
	],
	'wmgUseComments' => [
		'default' => false, // Sysop has 'commentadmin' by default
	],
	'wmgUseContactPage' => [
		'default' => false, // Add wiki config to ContactPage.php
		'apellidosmurcianoswiki' => true,
		'ayrshirewiki' => true,
		'christipediawiki' => true,
		'cdcwiki' => true,
		'fablabesdswiki' => true,
		'qboxnextwiki' => true,
		'test1wiki' => true,
	],
	'wmgUseContributionScores' => [
		'default' => false,
	],
	'wmgUseCreatePage' => [
		'default' => false,
	],
	'wmgUseCreateRedirect' => [
		'default' => false,
	],
	'wmgUseCrossReference' => [
		'default' => false,
	],
	'wmgUseCSS' => [
		'default' => false,
	],
	'wmgUseCustomHeader' => [
		'default' => false,
		'hlptestwiki' => true,
		'test1wiki' => true,
	],
	'wmgUseDarkVector' => [
		'default' => false,
	],
	'wmgUseDescription2' => [
		'default' => false,
	],
	'wmgUseDisambiguator' => [
		'default' => false,
	],
	'wmgUseDismissableSiteNotice' => [
		'default' => true,
	],
	'wmgUseDuskToDawn' => [
		'default' => false,
	],
	'wmgUseDonateBoxInSidebar' => [ # Disabled for now --Rececption123
		'default' => false,
		'metawiki' => true,
		'test1wiki' => true,
	],
	'wmgUseDPLForum' => [
		'default' => false,
	],
	'wmgUseDummyFandoomMainpageTags' => [
		'default' => false,
	],
	'wmgUseDuplicator' => [
		'default' => false,
	],
	'wmgUseDynamicPageList' => [ // DynamicPageList and DynamicPageList3 should NOT be enabled together; they do not work together
		'default' => false,
	],
	'wmgUseDynamicPageList3' => [ // DynamicPageList and DynamicPageList3 should NOT be enabled together; they do not work together
		'default' => false,
	],
	'wmgUseEditcount' => [
		'default' => false,
	],
	'wmgUseEditSubpages' => [
		'default' => false,
		'test1wiki' => true,
	],
	'wmgUseEducationProgram' => [
		'default' => false,
	],
	'wmgUseElectronPdfService' => [
		'default' => false,
	],
	'wmgUseErudite' => [
		'default' => false,
	],
	'wmgUseEventLogging' => [
		'default' => false,
	],
	'wmgUseFancyBoxThumbs' => [
		'default' => false,
	],
	'wmgUseFeaturedFeeds' => [
		'default' => false, // Not enabled anywhere?
	],
	'wmgUseFlaggedRevs' => [
		'default' => false,
	],
	'wmgUseFlow' => [
		'default' => false, // Please make sure MediaWiki services is enabled on the wiki in the services.yaml file in the services repo
	],
	'wmgUseForeground' => [
		'default' => false,
	],
	'wmgUseGadgets' => [
		'default' => false,
	],
	'wmgUseGamepress' => [
		'default' => false,
	],
	'wmgUseGenealogy' => [
		'default' => false,
	],
	'wmgUseGeoCrumbs' => [
		'default' => false,
	],
	'wmgUseGeoData' => [
		'default' => false,
	],
	'wmgUseGettingStarted' => [
		'default' => false,
	],
	'wmgUseGlobalUserPage' => [
		'default' => true,
		'reviwikiwiki' => false, // T3671
	],
	'wmgUseGraph' => [
		'default' => false,
	],
	'wmgUseGroupsSidebar' => [
		'default' => false,
	],
	'wmgUseGuidedTour' => [
		'default' => false,
	],
	'wmgUseHAWelcome' => [
		'default' => false,
	],
	'wmgUseHeaderTabs' => [
		'default' => false,
	],
	'wmgUseHideSection' => [
		'default' => false,
	],
	'wmgUseHighlightLinksInCategory' => [
		'default' => false,
	],
	'wmgUseImageMap' => [
		'default' => false,
	],
	'wmgUseImageRating' => [
		'default' => false,
	],
	'wmgUseInputBox' => [
		'default' => false,
	],
	'wmgUseJavascriptSlideshow' => [
		'default' => false,
	],
	'wmgUseJosa' => [
		'default' => false,
	],
	'wmgUseJSBreadCrumbs' => [
		'default' => false,
	],
	'wmgUseKartographer' => [
		'default' => false,
	],
	'wmgUseLabeledSectionTransclusion' => [
		'default' => false,
	],
	'wmgUseLiberty' => [
		'default' => false,
	],
	'wmgUseLinkSuggest' => [
		'default' => false,
		'test1wiki' => true,
		'avalicearchiveswiki' => true,
	],
	'wmgUseLinkTarget' => [
		'default' => false,
	],
	'wmgUseLinkTitles' => [
		'default' => false,
	],
	'wmgUseListings' => [
		'default' => false,
	],
	'wmgUseLoopsCombo' => [
		'default' => false,
	],
	'wmgUseMagicNoCache' => [
		'default' => false,
	],
	'wmgUseMaps' => [
		'default' => false,
	],
	'wmgUseMassEditRegex' => [
		'default' => false, // sysop is given permission 'masseditregex' by default
	],
	'wmgUseMassMessage' => [
		'default' => false,
	],
	'wmgUseMath' => [
		'default' => false,
	],
	'wmgUseMediaWikiChat' => [
		'default' => false,
	],
	'wmgUseMetrolook' => [
		'default' => false,
	],
	'wmgUseMobileFrontend' => [
		'default' => true,
		'carmeigatwiki' => false,
		'cmgwiki' => false,
		'corydoctorowwiki' => false,
		'horizonwiki' => false,
		'izanagiwiki' => false,
		'jawptestwiki' => false,
		'nestartstechwiki' => false, // Re-enable when collapse issue is fixed --Reception123
		'ndwiki' => false,
		'permanentfuturelabwiki' => false,
		'reviwiki' => false,
		'reviwikiwiki' => false,
	],
	'wmgUseModeration' => [
		'default' => false,
		'nenawikiwiki' => true,
		'sdiywiki' => false,
		'socioatlaswiki' => true,
		'studentspoweringchangewiki' => true,
		'test1wiki' => true,
	],
	'wmgUseModernSkylight' => [
		'default' => false,
	],
	'wmgUseMsPackage' => [
		'default' => false, // do not set this to false without disabling MsUpload on all wikis below
		'test1wiki' => true,
	],
	'wmgUseMsUpload' => [
		'default' => false,
	],
	'wmgUseMultimediaViewer' => [
		'default' => false,
	],
	'wmgUseMultiBoilerplate' => [
		'default' => false,
	],
	'wmgUseNewestPages' => [
		'default' => false,
	],
	'wmgUseNews' => [
		'default' => false,
	],
	'wmgUseNewSignupPage' => [
		'default' => false,
	],
	'wmgUseNewsletter' => [
		'default' => false,
	],
	'wmgUseNewUserMessage' => [
		'default' => false,
	],
	'wmgUseNewUserNotif' => [
		'default' => false,
	],
	'wmgUseNostalgia' => [
		'default' => false,
	],
	'wmgUseNoTitle' => [
		'default' => false,
	],
	'wmgUseNukeDPL' => [
		'default' => false,
	],
	'wmgUseOpenGraphMeta' => [
		'default' => false,
	],
	'wmgUsePagedTiffHandler' => [
		'default' => false,
	],
	'wmgUsePageForms' => [
		'default' => false,
	],
	'wmgUsePageNotice' => [
		'default' => false,
	],
	'wmgUsePageTriage' => [
		'default' => false,
	],
	'wmgUsePdfBook' => [
		'default' => false,
	],
	'wmgUsePDFEmbed' => [
		'default' => false,
	],
	'wmgUsePdfHandler' => [
		'default' => false,
	],
	'wmgUsePipeEscape' => [
		'default' => false,
	],
	'wmgUsePivot' => [
		'default' => false,
	],
	'wmgUsePoem' => [
		'default' => false,
	],
	'wmgUsePopups' => [
		'default' => false,
	],
	'wmgUsePoll' => [
		'default' => false,
	],
	'wmgUsePollNY' => [
		'default' => false,
	],
	'wmgUsePortableInfobox' => [
		'default' => false,
	],
	'wmgUseProofreadPage' => [
		'default' => false,
	],
	'wmgUseProtectSite' => [
		'default' => false,
	],
	'wmgUsePurge' => [
		'default' => false,
	],
	'wmgUseQuiz' => [
		'default' => false,
	],
	'wmgUseQuizGame' => [
		'default' => false,
	],
	'wmgUseRandomGameUnit' => [
		'default' => false,
	],
	'wmgUseRandomImage' => [
		'default' => false,
	],
	'wmgUseRandomSelection' => [
		'default' => false,
	],
	'wmgUseRefreshed' => [
		'default' => false,
	],
	'wmgUseRelatedArticles' => [
		'default' => false,
	],
	'wmgUseReplaceText' => [
		'default' => false,
	],
	'wmgUseRevisionSlider' => [
		'default' => false,
	],
	'wmgUseRSS' => [
		'default' => false,
	],
	'wmgUseSandboxLink' => [
		'default' => false,
	],
	'wmgUseScore' => [
		'default' => false,
	],
	'wmgUseScratchBlocks' => [
		'default' => false,
	],
	'wmgUseShortURL' => [
		'default' => true,
		'macfan4000wiki' => false,
	],
	'wmgUseSimpleChanges' => [
		'default' => false,
	],
	'wmgUseSimpleTooltip' => [
		'default' => false,
	],
	'wmgUseSiteScout' => [
		'default' => false,
	],
	// Requires copying of two directories: https://www.mediawiki.org/wiki/Extension:SocialProfile#Directories
	// Should be this, but change $nameofwiki at the end:
	// sudo -u www-data cp -R /srv/mediawiki/w/extensions/SocialProfile/avatars /srv/mediawiki/w/extensions/SocialProfile/awards /mnt/mediawiki-static/$nameofwiki/
	'wmgUseSocialProfile' => [
		'default' => false,
	],
	'wmgUseSpoilers' => [
		'default' => false,
	],
	'wmgUseSubpageFun' => [
		'default' => false,
	],
	'wmgUseSubPageList3' => [
		'default' => false,
	],
	'wgScribuntoUseGeSHi' => [
		'default' => true,
	],
	// Combo of Tabs + Tabber
	'wmgUseTabsCombination' => [
		'default' => false,
	],
	'wmgUseTemplateSandbox' => [
		'default' => false,
	],
	'wmgUseTemplateStyles' => [
		'default' => false,
	],
	'wmgUseTemplateWizard' => [
		'default' => false,
	],
	'wmgUseTheme' => [
		'default' => false,
	],
	'wmgUseTimedMediaHandler' => [
		'default' => false,
	],
	'wmgUseTimeline' => [
		'default' => false,
	],
	'wmgUseThanks' => [
		'default' => false,
	],
	'wmgUseTitleKey' => [
		'default' => false,
	],
	'wmgUseTocTree' => [
		'default' => false,
	],
	'wmgUseTranslate' => [
		'default' => false,
	],
	'wmgUseTweeki' => [
		'default' => false,
	],
	'wmgUseTwoColConflict' => [
		'default' => false,
	],
	'wmgUseUniversalLanguageSelector' => [
		'default' => false,
	],
	'wmgUseUploadsLink' => [
		'default' => false,
	],
	'wmgUseUrlGetParameters' => [
		'default' => false,
	],
	'wmgUseUserWelcome' => [
		'default' => false,
	],
	'wmgUseVoteNY' => [
		'default' => false,
	],
	'wmgUseVisualEditor' => [
		'default' => false, // Please make sure MediaWiki services is enabled on the wiki in the services.yaml file in the services repo
	],
	'wmgUseVariables' => [
		'default' => false,
	],
	'wmgUseWebChat' => [
		'default' => false,
		'allthetropeswiki' => true,
		'ildrilwiki' => true,
		'lothuialethwiki' => true,
		'marioserieswiki' => true,
		'pnphilotenwiki' => true,
		'test1wiki' => true,
		'wisdomwikiwiki' => true,
	],
	'wmgUseWhoIsWatching' => [
		'default' => false,
		'test1wiki' => true,
	],
	'wmgUseWidgets' => [
		'default' => false,
	],
	'wmgUseWikibaseRepository' => [
		'default' => false,
	],
	'wmgAllowEntityImport' => [
		'default' => false,
	],
	'wmgEnableEntitySearchUI' => [
		'default' => true,
	],
	'wmgUseWikidataPageBanner' => [
		'default' => false,
	],
	'wmgUseWikiForum' => [
		'default' => false,
	],
	'wmgUsewikihiero' => [
		'default' => false,
		'test1wiki' => true,
	],
	'wmgUseWikimediaIncubator' => [
		'default' => false,
	],
	'wmgUseWikiLove' => [
		'default' => false,
	],
	'wmgUseWikiSeo' => [
		'default' => false,
	],
	'wmgUseWikiTextLoggedInOut' => [
		'default' => false,
	],
	'wmgUseYouTube' => [
		'default' => false,
	],

	// External link target [MWCandidate]
	'wgExternalLinkTarget' => [
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
	],

	// Allow External Images [MWCandidate]
	'wgAllowExternalImages' => [
		'default' => false,
		'amicitiawiki' => true,
		'magezwiki' => true,
		'magnaversewiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'tensegritywiki' => true,
		'travailcollaboratifwiki' => true,
		'sitraduwiki' => true,
	],
	'wgAllowExternalImagesFrom' => [
		'default' => false,
		'astrobiologywiki' => [
			'https://www.science20.com',
			'https://quora.com',
			'https://robertinventor.com',
		],
		'doomsdaydebunkedwiki' => [
			'https://www.science20.com',
			'https://quora.com',
			'https://robertinventor.com',
		],
	],

	// Allow HTML <img> tag [MWCandidate]
	'wgAllowImageTag' => [
		'default' => false,
		'horizonwiki' => true,
		'magezwiki' => true,
		'mikrodevwiki' => true,
		'travailcollaboratifwiki' => true,
	],

	// FlaggedRevs [MWCandidate]
	'wmgFlaggedRevsNamespaces' => [
		'default' => [
			NS_MAIN,
			NS_FILE,
			NS_TEMPLATE,
			NS_HELP,
			NS_PROJECT,
		],
		'isvwiki' => [
			NS_MAIN,
			NS_FILE,
			NS_TEMPLATE,
			NS_CATEGORY,
			WMG_NS_MODULE,
			NS_LIBRARY,
		],
		'trexwiki' => [
			NS_ARTIKEL,
			NS_FILE,
			NS_TEMPLATE,
		],
	],
	'wmgFlaggedRevsProtection' => [
		'default' => false,
		'pruebawiki' => true,
	],
	'wmgFlaggedRevsTags' => [
		'default' => [
			'status' => [
				'quality' => 1,
				'levels' => 2,
				'pristine' => 3,
			],
		],
		'infectopedwiki' => [
			'accuracy' => [
				'levels' => 3,
				'quality' => 2,
				'pristine' => 4,
			],
			'depth' => [
				'levels' => 3,
				'quality' => 2,
				'pristine' => 4,
			],
			'tone' => [
				'levels' => 3,
				'quality' => 1,
				'pristine' => 4,
			],
		],
		'isvwiki' => [
			'status' => [
				'levels' => 1,
				'quality' => 2,
				'pristine' => 4,
			],
		],
	],
	'wmgFlaggedRevsTagsRestrictions' => [
		'default' => [
			'status' => [
				'review' => 1,
				'autoreview' => 1,
			],
		],
	],
	'wmgFlaggedRevsTagsAuto' => [
		'default' => [
			'status' => 1,
		],
	],
	'wmgFlaggedRevsAutopromote' => [
		'default' => [
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
			'maxRevertedEditRatio' => 0.05,
		],
		'isvwiki' => false,
		'pruebawiki' => false,
	],
	'wmgFlaggedRevsAutoReview' => [
		'default' => true,
	],
	'wmgFlaggedRevsRestrictionLevels' => [
		'default' => [ '', 'sysop' ],
		'pruebawiki' => [ '', 'sysop', 'bureaucrat', 'consul', 'autoconfirmed', 'user' ],
	],
	'wmgSimpleFlaggedRevsUI' => [
		'default' => true,
		'infectopedwiki' => false,
	],
	'wmgFlaggedRevsLowProfile' => [
		'default' => true,
		'infectopedwiki' => false,
	],

	// Files [MWCandidate]
	'wgEnableUploads' => [
		'default' => true,
	],
	// T3797
	'wgMaxUploadSize' => [
		'default' => 262144000,
	],
	'wgUploadSizeWarning' => [
		'default' => 262144000,
	],
	'wgAllowCopyUploads' => [
		'default' => false,
	],
	'wgAllowTitlesInSVG' => [
		'default' => false,
		'vsfan' => true,
	],
	'wgCopyUploadsFromSpecialUpload' => [
		'default' => false,
	],
	'wgFileExtensions' => [
		'default' => [ 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu' ],
		'+50beardsofgreywiki' => [ 'mp4' ],
		'+amaninfowiki' => [ 'pcap', 'cap', 'zip', 'tar', 'tar.gz', 'rar' ],
		'+avalicearchiveswiki' => [ 'exe', 'zip', 'css', 'woff', 'woff2', 'ttf' ],
		'+bigforestwiki' => [ 'apng', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'doc', 'docx', 'txt', 'rtf', 'htm', 'html', 'xml', 'ppt', 'pptx' ],
		'+bsaikatsuwiki' => [ 'oga', 'ogx' ],
		'+cmgwiki' => [ 'html', 'htm', 'pdf', 'ppt', 'pptx', 'xls', 'xlxs', 'zip', 'py', 'js', 'php', 'tar', 'gz', 'crt' ],
		'+cmgiwiki' => [ 'html', 'htm', 'pdf', 'ppt', 'pptx', 'xls', 'xlxs', 'docx', 'doc', 'txt', 'zip', 'py', 'js', 'php', 'tar', 'gz', 'crt' ],
		'+csnimsbordeauxwiki' => [ 'docx', 'xlsx', 'pptx', 'pub', 'xps', 'odt', 'ods', 'odp', 'odg', 'otg', 'rar', 'tar', 'gz', 'gz2', 'bz', 'bz2', 'zip', 'ipe', 'dia', 'svg', 'bib', 'add', 'spl', 'cls', 'tex', 'bst', 'sh', 'bat', 'gp', 'dat', 'fig', 'sty', 'py', 'cpp', 'hpp', 'hxx', 'c', 'h', 'mat', 'txt', 'desktop', 'md', 'perf', 'plot', 'data', 'xml', 'html', 'alist' ],
		'+doinwiki' => [ 'pdf', 'ppt', 'pptx', 'xls', 'xlxs', 'zip' ],
		'+exercicesdefrancaisprodfrwiki' => [ 'html', 'htm' ],
		'+exitsincwiki' => [ 'txt' ],
		'+fawiki' => [ 'ttf', 'eot', 'woff', 'apk' ],
		'+guiasdobrasilwiki' => [ 'zip', 'tar', 'tar.gz', 'rar', ],
		'+hypernostalgiawiki' => [ 'mp4', 'webm', 'ogv', 'mp3' ],
		'+indrikwiki' => [ 'mp3', 'mus', 'mid' ],
		'+jadtechwiki' => [ 'png', 'bmp', 'gif', 'ico', 'ogg', 'mp3', 'svg', 'pdf', 'flac', 'mp4', 'exe', 'zip', 'jpeg', 'jpg' ],
		'+jayuwikiwiki' => [ 'bmp', 'apng', 'tiff', 'wav', 'mp3', 'oga', 'ogv', 'asv', 'swf', 'wmv' ],
		'+jcswiki' => [ 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'ppt', 'pptx', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'zip' ],
		'+modularwiki' => [ 'mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv' ],
		'+pculsdwiki' => [ 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu', 'mp3', 'wma', 'mp4', 'zip', 'rar', 'xlsx', 'ppt', 'docx', 'doc' ],
		'+pfl2wiki' => [ 'rar' ],
		'+podpediawiki' => [ 'mp3', 'zip' ],
		'+qmswiki' => [ 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip' ],
		'+schulwiki' => [ 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'ppt', 'pptx', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'zip' ],
		'+scruffywiki' => [ 'mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv', 'zip' ],
		'+sdiywiki' => [ 'mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv', 'zip' ],
		'+serinfhospwiki' => [ 'pdf', 'zip' ],
		'+showroomwiki' => [ 'png', 'gif', 'jpg', 'jpeg', 'doc', 'xls', 'pdf', 'ppt', 'tiff', 'bmp', 'docx', 'xlsx', 'pptx' ],
		'+techeducationwiki' => [ 'docx', 'doc', 'odt', 'ods', 'odp', 'ppt', 'xls', 'xlsx','xml' ],
		'+themirrorwiki' => [ 'mp3' ],
		'+thenetwiki' => [ 'zip', 'rar', 'dae' ],
		'+tmewiki' => [ 'tiff', 'tif', 'webp', 'xcf', 'mid', 'ogv', 'oga', 'flac', 'opus', 'wav', 'webm' ],
		'+unabwiki' => [ 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx' ],
		'+valentinaprojectwiki' => [ 'val', 'vit', 'vst' ],
		'+vsfan' => [ 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu', 'webp' ],
		'+vandalismwikiwiki' => [ 'tiff', 'tif', 'webp', 'xcf', 'mid', 'ogv', 'oga', 'flac', 'opus', 'wav', 'webm' ],
		'+wirtschaftsinformatikhbs' => [ 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu', 'docx', 'pptx', 'vsd' ],
		'+wisdomwikiwiki' => [ 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'txt', 'rtf', 'zip' ],
	],
	'wgUseInstantCommons' => [
		'default' => true,
	],
	'wgEnableImageWhitelist' => [
		'default' => false,
	],
	'wgShowArchiveThumbnails' => [
		'default' => true,
	],
	'wgVerifyMimeType' => [
		'default' => true,
	],
	'wgSVGMetadataCutoff' => [
		'default' => 262144,
		'altversewiki' => 13421772,
		'magnaversewiki' => 13421772,
	],
	'wgSVGConverter' => [
		'default' => 'ImageMagick',
		'arphilosophywiki' => 'inkscape',
		'ktswiki' => 'inkscape',
	],

	// Flow [MWCandidate] (MWNamespaces?)
	'wmgFlowDefaultNamespaces' => [
		'default' => true,
		'nationsglorywiki' => false,
		'lzhscpwikiwiki' => false,
	],

	// GlobalBlocking [MWExempt]
	'wgApplyGlobalBlocks' => [
		'default' => true,
		'metawiki' => false,
		'weatherwiki' => false, // let me do the blocking on my wiki, please
	],

	// GlobalCssJs [MWCandidate]
	'wgGlobalCssJsConfig' => [
		'default' => [
			'wiki' => 'metawiki',
			'source' => 'metawiki',
		],
	],
	'+wgResourceLoaderSources' => [
		'default' => [
			'metawiki' => [
				'apiScript' => '//meta.miraheze.org/w/api.php',
				'loadScript' => '//meta.miraheze.org/w/load.php',
			],
		],
	],
	'wgUseGlobalSiteCssJs' => [
		'default' => false,
	],

	// GlobalPreferences [MWExempt]
	'wgGlobalPreferencesDB' => [
		'default' => 'centralauth',
	],

	// GlobalUserPage [MWExempt]
	'wgGlobalUserPageAPIUrl' => [
		'default' => 'https://login.miraheze.org/w/api.php',
	],
	'wgGlobalUserPageDBname' => [
		'default' => 'loginwiki',
	],

	// HighlightLinks [MWCandidate]
	'wgHighlightLinksInCategory' => [
		'default' => [],
		'allthetropeswiki' => [
			'Trope' => 'trope',
			'YMMV_Trope' => 'ymmv',
		],
	],

	// ImageMagick [MWExempt]
	'wgUseImageMagick' => [
		'default' => true,
	],
	'wgImageMagickCommand' => [
		'default' => '/usr/bin/convert',
	],

	// Interwiki [MWCandidate]
	'wgEnableScaryTranscluding' => [
		'default' => true,
	],
	'wgInterwikiCentralDB' => [
		'default' => 'metawiki',
	],
	'wgExtraInterlanguageLinkPrefixes' => [
		'default' => [],
		'+apunteswiki' => [
			'ct',
			'm',
			'u',
			'i',
			'd',
			't',
			'p',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
		'+centralwiki' => [
			'm',
			'u',
			'i',
			'a',
			'd',
			't',
			'p',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
		'+destinoswiki' => [
			'ct',
			'm',
			'u',
			'i',
			'a',
			't',
			'p',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
		'+infowiki' => [
			'ct',
			'm',
			'u',
			'a',
			'd',
			't',
			'p',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
		'+mediatecawiki' => [
			'ct',
			'u',
			'i',
			'a',
			'd',
			't',
			'p',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
		'+nonciclopediawiki' => [
			'dlm',
			'tlh',
			'zombie',
		],
		'+privadowiki' => [
			'ct',
			'm',
			'u',
			'i',
			'a',
			'd',
			't',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
		'+tallerwiki' => [
			'ct',
			'm',
			'u',
			'i',
			'a',
			'd',
			'p',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
		'+ucroniaswiki' => [
			'ct',
			'm',
			'i',
			'a',
			'd',
			't',
			'p',
			'w',
			'v',
			'n',
			'b',
			'wikt',
			'q',
			'ver',
			's',
			'alt',
		],
	],

	// Imports [MWCandidate]
	'wgImportSources' => [
		'default' => [
			'meta',
			'templatewiki',
		],
		'+incubatorwiki' => [
			'wmincubator',
			'wikiaincubatorplus',
		],
		'+weatherwiki' => [
			'wikipedia',
		],
	],

	// Job Queue [MWExempt]
	'wgJobRunRate' => [
		'default' => 0,
	],

	// Kartographer [MWCandidate]
	'wgKartographerWikivoyageMode' => [
		'default' => false,
		'apunteswiki' => true,
		'centralwiki' => true,
		'destinoswiki' => true,
		'infowiki' => true,
		'mediatecawiki' => true,
		'privadowiki' => true,
		'tallerwiki' => true,
		'ucroniaswiki' => true,
	 ],
	'wgKartographerUseMarkerStyle' => [
		'default' => false,
		'apunteswiki' => true,
		'centralwiki' => true,
		'destinoswiki' => true,
		'infowiki' => true,
		'mediatecawiki' => true,
		'privadowiki' => true,
		'tallerwiki' => true,
		'ucroniaswiki' => true,
	 ],

	// Language [MWExempt]
	'wgLanguageCode' => [ // Hardcode "en"
		'default' => 'en',
	],

	// License [MW]
	'wgRightsIcon' => [
		'default' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'incubatorwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'isvwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'jadtechwiki' => "//$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'revitwiki' => "//$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
	],
	'wgRightsPage' => [
		'default' => '',
		'diavwiki' => 'Project:Copyrights',
		'kstartupswiki' => 'Project:저작권',
		'wisdomwikiwiki' => 'Copyleft',
	],
	'wgRightsText' => [
		'default' => 'Creative Commons Attribution Share Alike',
		'incubatorwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'isvwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'jadtechwiki' => 'Copyright © Jak and Daxter Technical Wiki. All rights reserved.',
		'revitwiki' => '©2013-2019 by Lionel J. Camara (All Rights Reserved)',
		'reviwikiwiki' => 'Creative Commons Attribution Share Alike',
	],
	'wgRightsUrl' => [
		'default' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'incubatorwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'isvwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'jadtechwiki' => 'https://jadtech.miraheze.org/wiki/MediaWiki:Copyright',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwikiwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr',
	],
	'wmgWikiLicense' => [
		'default' => 'cc-by-sa',
	],

	// Links [MWExempt]?
	'+wgUrlProtocols' => [
		'default' => [],
		// file protocol only allowed on private wikis
		'bchwiki' => [ "file://" ],
		'gzewiki' => [ "file://" ],
		'kaiwiki' => [ "file://" ],
	],

	// Mail [MWCandidate]
	'wgEnableEmail' => [
		'default' => true,
	],
	'wgPasswordSender' => [
		'default' => 'noreply@miraheze.org',
	],
	'wgSMTP' => [
		'default' => [
			'host' => 'mail.miraheze.org',
			'port' => 25,
			'IDHost' => 'miraheze.org',
			'auth' => true,
			'username' => 'noreply',
			'password' => $wmgSMTPPassword,
		],
	],
	'wgEnotifWatchlist' => [
		'default' => true,
	],
	'wgUserEmailUseReplyTo' => [
		'default' => true,
	],
	'wgEmailConfirmToEdit' => [
		'default' => false,
		'jacksonheightswiki' => true,
		'nenawikiwiki' => true,
	],

	'wgTexvc' => [
		'default' => '/usr/bin/texvc',
	],

	// ManageWiki [MWExempt]
	'wgManageWiki' => [
		'default' => [
			'cdb' => true,
			'core' => true,
			'extensions' => true,
			'namespaces' => true,
			'permissions' => true,
			'settings' => true
		],
	],
	'wgManageWikiExtensionsDefault' => [
		'default' => [
			'cite',
			'citethispage',
		],
	],
	'wgManageWikiCDBDirectory' => [
		'default' => '/srv/mediawiki/w/cache/managewiki',
	],
	'wgManageWikiPermissionsAdditionalAddGroups' => [
		'default' => [],
	],
	'wgManageWikiPermissionsAdditionalRights' => [
		'default' => [
			'checkuser' => [
				'checkuser' => true,
				'checkuser-log' => true,
			],
			'oversight' => [
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
			],
			'user' => [
				'user' => true,
			],
			'steward' => [
				'centralauth-usermerge' => true,
				'usermerge' => true,
				'userrights' => true,
			],
		],
		'+autocountwiki' => [
			'authors' => [
				'torunblocked' => true,
				'read' => true,
			],
		],
		'+bitcoindebateswiki' => [
			'emailconfirmed' => [
				'read' => true,
			],
		],
		'+cmgwiki' => [
			'gst' => [
				'read' => true,
			],
		],
		'+dpwiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
				'respected' => true,
			],
			'respected' => [
				'respected' => true,
			],
		],
		'+enigmawiki' => [
			'scribe' => [
				'read' => true,
			],
		],
		'+igrovyesistemywiki' => [
			'autopatrolled' => [
				'trusted' => true,
			],
			'autoreview' => [
				'trusted' => true,
			],
			'bot' => [
				'trusted' => true,
			],
			'editor' => [
				'trusted' => true,
			],
			'reviewer' => [
				'trusted' => true,
			],
			'co' => [
				'co' => true,
				'ceo' => true,
				'trusted' => true,
			],
			'bureaucrat' => [
				'bureaucrat' => true,
				'trusted' => true,
			],
			'sysmag' => [
				'sysmag' => true,
				'trusted' => true,
			],
			'sysop' => [
				'trusted' => true,
			],
			'ceo' => [
				'bureaucrat' => true,
				'sysmag' => true,
				'trusted' => true,
			],
			'UserType1' => [
				'UserType1' => true,
			],
			'UserType2' => [
				'UserType2' => true,
			],
			'UserType3' => [
				'UserType3' => true,
			],
			'UserType4' => [
				'UserType4' => true,
			],
			'UserType5' => [
				'UserType5' => true,
			],
			'UserType6' => [
				'UserType6' => true,
			],
			'UserType7' => [
				'UserType7' => true,
			],
		],
		'+jacksonheightswiki' => [
			'emailconfirmed' => [
				'read' => true,
			],
		],
		'+jayuwikiwiki' => [
			'sysop' => [
				'editvoter' => true,
			],
			'voter' => [
				'editvoter' => true,
			],
		],
		'+lcars47wiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'devteam' => [
				'bureaucrat' => true,
				'read' => true,
				'devteam' => true,
			],
		],
		'+marthaspeakswiki' => [
			'sysop' => [
				'templateeditor' => true,
			],
			'templateeditor' => [
				'templateeditor' => true,
			],
		],
		'+nenawikiwiki' => [
			'emailconfirmed' => [
				'read' => true,
			],
		],
		'+metawiki' => [
			'confirmed' => [
				'mwoauthproposeconsumer' => true,
				'mwoauthupdateownconsumer' => true,
			],
			'cvt' => [
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'globalblock' => true,
			],
			'proxybot' => [
				'globalblock' => true,
				'centralauth-lock' => true,
			],
			'steward' => [
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
			],
			'sysop' => [
				'interwiki' => true,
			],
			'user' => [
				'requestwiki' => true,
			],
			'wikicreator' => [
				'createwiki' => true,
			],
		],
		'+nonsensopediawiki' => [
			'moderator' => [
				'skipcaptcha' => true,
			],
		],
		'+pruebawiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'consul' => [
				'read' => true,
				'bureaucrat' => true,
				'consul' => true,
				'torunblocked' => true,
			],
			'testgroup' => [
				'read' => true,
			],
		],
		'+radviserwiki' => [
			'editor' => [
				'editor' => true,
			],
			'sysop' => [
				'editor' => true,
			],
		],
		'+sau226wiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'consul' => [
				'bureaucrat' => true,
				'consul' => true,
				'read' => true,
			],
			'testgroup' => [
				'read' => true,
			],
		],
		'+serinfhospwiki' => [
			'SupportStaff' => [
				'read' => true,
			],
			'SalesStaff' => [
				'read' => true,
			],
			'PreSalesStaff' => [
				'read' => true,
			],
		],
		'+sovereignwiki' => [
			'officer' => [
				'read' => true,
				'officer' => true,
			],
			'game-master' => [
				'read' => true,
				'game-master' => true,
			],
		],
		'+ssptopwiki' => [
			'read-only' => [
				'read' => true,
			],
		],
		'+swisscomraidwiki' => [
			'emailconfirmed' => [
				'read' => true,
			],
		],
		'+svwiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'consul' => [
				'bureaucrat' => true,
				'consul' => true,
				'read' => true,
			],
			'testgroup' => [
				'read' => true,
			],
		],
		'+thesciencearchiveswiki' => [
			'sysop' => [
				'templateeditor' => true,
			],
			'templateeditor' => [
				'templateeditor' => true,
			],
		],
		'+trexwiki' => [
			'co' => [
				'co' => true,
				'ceo' => true,
			],
			'ceo' => [
				'ceo' => true,
				'editors' => true,
			],
			'bureaucrat' => [
				'bureaucrat' => true,
			],
		],
		'+whentheycrywiki' => [
			'user' => [
				'edit-create' => true,
			],
		],
		'weatherwiki' => [
			'steward' => [
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
				'usermerge' => true,
			],
		],
		'+yeoksawiki' => [
			'sysop' => [
				'project-edit' => true,
			],
		],
	],
	'wgManageWikiAdditionalRemoveGroups' => [
		'default' => [],
	],
	'wgManageWikiPermissionsBlacklistRights' => [
		'default' => [
			'any' => [
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
				'usermerge',
				'userrights',
				'userrights-interwiki',
				'viewglobalprivatefiles',
				'viewpmlog',
				'viewsuppressed',
			],
			'*' => [
				'read',
				'skipcaptcha',
				'torunblocked',
				'centralauth-merge',
			],
		],
	],
	'wgManageWikiPermissionsBlacklistGroups' => [
		'default' => [
			'checkuser',
			'oversight',
			'steward'
		],
	],
	'wgManageWikiPermissionsDefaultPrivateGroup' => [
		'default' => 'member',
	],
	'wgManageWikiHelpUrl' => [
		'default' => '//meta.miraheze.org/wiki/ManageWiki',
	],

	// MassMessage [MWCandidate]
	'wgAllowGlobalMessaging' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgNamespacesToPostIn' => [
		'default' => [ NS_PROJECT ],
		'+bgowiki' => [
			NS_MAIN,
			NS_PROJECT,
		],
	],

	// MatomoAnalytics [MWExempt]
	'wgMatomoAnalyticsDatabase' => [
		'default' => 'mhglobal',
	],
	'wgMatomoAnalyticsServerURL' => [
		'default' => 'https://matomo.miraheze.org/',
	],
	'wgMatomoAnalyticsUseDB' => [
		'default' => true,
	],
	'wgMatomoAnalyticsGlobalID' => [
		'default' => 1,
	],

	// MediaWikiChat settings [MWCandidate]
	'wgChatLinkUsernames' => [
		'default' => false,
		'nerdzonewiki' => true,
	],
	'wgChatMeCommand' => [
		'default' => false,
		'nerdzonewiki' => true,
	],

	// Metrolook settings [MWCandidate]
	'wgMetrolookDownArrow' => [
		'default' => true,
		'allthetropeswiki' => false,
		'ayrshirewiki' => false,
		'thegreatwarwiki' => false,
		'thelonsdalebattalionwiki' => false,
	],
	'wgMetrolookUploadButton' => [
		'default' => true,
		'allthetropeswiki' => false,
		'thegreatwarwiki' => false,
	],
	'wgMetrolookBartile' => [
		'default' => true,
		'ayrshirewiki' => false,
		'thegreatwarwiki' => false,
		'thelonsdalebattalionwiki' => false,
	],
	'wgMetrolookMobile' => [
		'default' => true,
		'ayrshirewiki' => false,
	],
	'wgMetrolookUseIconWatch' => [
		'default' => true,
		'ayrshirewiki' => false,
	],
	'wgMetrolookLine' => [
		'default' => true,
		'ayrshirewiki' => false,
	],
	'wgMetrolookFeatures' => [
		'default' => [
			'collapsiblenav' => [
				'global' => false,
				'user' => true
			]
		],
		'thegreatwarwiki' => [
			'collapsiblenav' => [
				'global' => true,
				'user' => true
			]
		],
	],

	// miraheze specific config [MWExempt]
	'wgServicesRepo' => [
		'default' => '/srv/services/services',
	],

	'wgMirahezeServicesExtensions' => [
		'default' => [ 'VisualEditor', 'Flow' ],
	],

	// Inactive wikis [MWCandidate]
	// https://meta.miraheze.org/wiki/Dormancy_Policy/Exceptions and https://meta.miraheze.org/wiki/Dormancy_Policy/Exemptions
	'wgCreateWikiInactiveWikisWhitelist' => [
		'default' => [
			// Exceptions
			'ashinawiki',
			'commonswikiwiki',
			'conductwiki',
			'cvtwiki',
			'metawiki',
			'staffwiki',
			'loginwiki',
			// Exemptions
			'allthetropeswiki',
			'altversewiki',
			'ansaikuropediawiki',
			'biblicalwikiwiki',
			'bitcoindebateswiki',
			'bpwiki',
			'cmgwiki',
			'crazybloxianempireinfowiki',
			'dditecwiki',
			'familiojwiki',
			'geomasterywiki',
			'ildrilwiki',
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
			'scruffywiki',
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
		],
	],

	// Misc. stuff [MWCandidate]
	'wgSitename' => [
		'default' => 'No sitename set!',
	],
	'wgAllowDisplayTitle' => [
		'default' => true,
	],
	'wgRestrictDisplayTitle' => [
		'default' => true, // Wikis with NoTitle have it set to false
		'ayrshirewiki' => true,
		'blocknetwiki' => false,
		'takethatwikiwiki' => false,
		'tmewiki' => false,
		'vandalismwikiwiki' => false,
	],
	'wgCapitalLinks' => [
		'default' => true,
		'dicowiki' => false,
	],
	'wgActiveUserDays' => [
		'default' => 30,
		'weatherwiki' => 7,
	],
	'wgEnableCanonicalServerLink' => [
		'default' => false,
		'electowikiwiki' => true,
	],
	'wgPageCreationLog' => [
		'default' => true,
	],

	// MobileFrontend [MWCandidate]
	'wmgMFAutodetectMobileView' => [
		'default' => false,
	],
	'wgMFDefaultSkinClass' => [
		'default' => 'SkinMinerva',
	],
	'wgMobileUrlTemplate' => [
		'default' => '',
	],

	// Moderation extension settings [MWCandidate]
	'wgModerationNotificationEnable' => [ // Enable or disable notifications.
		'default' => false,
		'sdiywiki' => true,
	],
	'wgModerationNotificationNewOnly' => [ // Notify administrator only about new pages requests.
		'default' => false,
	],
	'wgModerationEmail' => [ // Email to send notifications to.
		'default' => $wgPasswordSender,
		'sdiywiki' => 'admin@sdiy.info',
	],

	// MsCatSelect vars [MWCandidate]
	'wgMSCS_WarnNoCategories' => [
		'default' => true,
	],

	// MsUpload settings [MWCandidate]
	'wgMSU_useDragDrop' => [
		'default' => true,
		'weatherwiki' => false,
	],

	'wgMSU_showAutoCat' => [
		'default' => false,
		'anduinwiki' => true,
	],

	'wgMSU_checkAutoCat' => [
		'default' => false,
		'anduinwiki' => true,
	],

	'wgMSU_confirmReplace' => [
		'default' => false,
		'anduinwiki' => true,
	],

	// MultiBoilerplate settings [MWCandidate]
	'wgMultiBoilerplateDiplaySpecialPage' => [
		'default' => false,
		'scruffywiki' => true,
		'sdiywiki' => true,
	],

	// MultimediaViewer (not beta) [MWCandidate]
	'wgMediaViewerEnableByDefault' => [
		'default' => false,
		'grandtheftautowiki' => true,
		'knowledgewiki' => true,
		'thefosterswiki' => true,
		'thelonsdalebattalionwiki' => true,
	],
	// MobileFrontend [MWCandidate]
	'wgMFNoMobilePages' => [
		'default' => [],
		'alwikiwiki' => [
			'Main Page',
		],
	],
	// Namespaces [MWNamespaces]
	'wgExtraNamespaces' => [
		'default' => [],
		'apunteswiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'centralwiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'destinoswiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'infowiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'mediatecawiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'modesofdiscoursewiki' => [
			NS_ASPECT => 'Aspect',
			NS_ASPECT_TALK => 'Aspect_talk',
		],
		'privadowiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'tallerwiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'ucroniaswiki' => [
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
			NS_EXAMPLE => 'Ejemplo',
			NS_EXAMPLE_TALK => 'Ejemplo_discusión',
		 ],
		'2b2twiki' => [
			NS_THREAD => 'Thread',
			NS_THREAD_TALK => 'Thread_Talk',
			NS_MESSAGE_WALL => 'Message_Wall',
			NS_MESSAGE_WALL_TALK => 'Message_Wall_Talk',
			NS_USER_BLOG => 'User_Blog',
			NS_USER_BLOG_TALK => 'User_Blog_Talk',
			NS_USER_BLOG_COMMENT => 'User_blog_comment',
			NS_USER_BLOG_COMMENT_TALK => 'User_blog_comment_talk',
		],
		'adiapediawiki' => [
			NS_DICT => 'Dict',
			NS_DICT_TALK => 'Dict_talk',
		],
		'adnovumwiki' => [
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
			NS_HELP => 'Help',
			NS_HELP_TALK => 'Help_talk',
		],
		'allthetropeswiki' => [
			NS_TROPEWORKSHOP => 'Trope_Workshop',
			NS_TROPEWORKSHOP_TALK => 'Trope_Workshop_talk',
			NS_REVIEWS => 'Reviews',
			NS_REVIEWS_TALK => 'Reviews_talk',
			NS_FEATURED => 'Featured_Page',
			NS_FEATURED_TALK => 'Featured_Page_talk',
		],
		'arphilosophywiki' => [
			NS_TECHDICT => 'Techdict',
			NS_TECHDICT_TALK => 'Techdict_talk',
		],
		'avalicearchiveswiki' => [
			NS_FANWORK => 'Fanbase',
			NS_FANWORK_TALK => 'Fanbase_talk',
		],
		'bigforestwiki' => [
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
		],
		'casuarinawiki' => [
			NS_LIBRARY => '圖書館',
			NS_LIBRARY_TALK => '圖書討論',
		],
		'claneuphoriawiki' => [
			NS_CLAN => 'Clan',
			NS_CLAN_TALK => 'Clan_talk',
		],
		'crazybloxianempireinfowiki' => [
			NS_LIST => 'List',
			NS_LIST_TALK => 'List_talk',
			NS_LAW => 'Law',
			NS_LAW_AMENDING => 'Law_amending',
			NS_EXECUTIVE_ORDER => 'Executive_Order',
			NS_EXECUTIVE_ORDER_TALK => 'Executive_Order_talk',
			NS_GROUP => 'Group',
			NS_GROUP_TALK => 'Group_talk',
			NS_STOREFRONT => 'Storefront',
			NS_STOREFRONT_TALK => 'Storefront_talk',
		],
		'ecoepiwiki' => [
			NS_PARAMETER => 'Parameter',
			NS_PARAMETER_TALK => 'Parameter_talk',
		],
		'fawiki' => [
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
		],
		'humorpediawiki' => [
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
			NS_HOWTO => 'Howto',
			NS_HOWTO_TALK => 'Howto_talk',
		],
		'hydrawikiwiki' => [
			NS_RESEARCH => "Research",
			NS_RESEARCH_TALK => "Research_talk",
			NS_ADMIN => "Admin",
			NS_ADMIN_TALK => "Admin_talk",
			NS_WORKSHOP => "Workshop",
			NS_WORKSHOP_TALK => "Workshop_talk",
			NS_SELP => "Selp",
			NS_SELP_TALK => "Selp_talk",
		],
		'hypernostalgiawiki' => [
			NS_DICTIONARY => 'Dictionary',
			NS_DICTIONARY_TALK => 'Dictionary_talk',
			NS_SOURCE => 'Source',
			NS_SOURCE_TALK => 'Source_talk',
		],
		'isvwiki' => [
			NS_LIBRARY => 'Sbornik',
			NS_LIBRARY_TALK => 'Besěda_sbornika',
		],
		'jadtechwiki' => [
			NS_GAMEPAGE => 'Game',
			NS_GAMEPAGE_TALK => 'Game_talk',
		],
		'kirarafantasiawiki' => [
			NS_DATA => 'Data',
			NS_DATA_TALK => 'Data_talk',
		],
		'metawiki' => [
			NS_TECH => 'Tech',
			NS_TECH_TALK => 'Tech_talk'
		],
		'monarchistswiki' => [
			NS_MUSINGS => 'Musings',
			NS_MUSINGS_TALK => 'Musings_talk',
		],
		'noalatalawiki' => [
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
		],
		'nonciclopediawiki' => [
			NS_PORTALE => 'Portale',
			NS_DISCUSSIONI_PORTALE => 'Discussioni_portale',
			NS_PROGETTO => 'Progetto',
			NS_DISCUSSIONI_PROGETTO => 'Discussioni_progetto',
			NS_CIMITERO => 'Cimitero',
			NS_DISCUSSIONI_CIMITERO => 'Discussioni_cimitero',
			NS_NONNOTIZIE => 'Nonnotizie',
			NS_DISCUSSIONI_NONNOTIZIE => 'Discussioni_nonnotizie',
			NS_NONVOYAGE => 'Nonvoyage',
			NS_DISCUSSIONI_NONVOYAGE => 'Discussioni_nonvoyage',
			NS_NONQUOTE => 'Nonquote',
			NS_DISCUSSIONI_NONQUOTE => 'Discussioni_nonquote',
			NS_NONDIZIONARIO => 'Nondizionario',
			NS_DISCUSSIONI_NONDIZIONARIO => 'Discussioni_nondizionario',
			NS_NONIVERSITA => 'Noniversità',
			NS_DISCUSSIONI_NONIVERSITA => 'Discussioni_noniversità',
			NS_NONSOURCE => 'Nonsource',
			NS_DISCUSSIONI_NONSOURCE => 'Discussioni_nonsource',
			NS_NONBOOKS => 'Nonbooks',
			NS_DISCUSSIONI_NONBOOKS => 'Discussioni_nonbooks',
		],
		'nonsensopediawiki' => [
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
		],
		'oecumenewiki' => [
			NS_ARCHIVE => 'Архив',
			NS_ARCHIVE_TALK => 'Обсуждение_архива',
			NS_PORTAL => 'Портал',
			NS_PORTAL_TALK => 'Обсуждение_портала',
		],
		'picardwiki' => [
			NS_WPIMPORT => 'WPImport',
			NS_WPIMPORT_TALK => 'WPImport_Diskussion',
			NS_WPREDIRECT => 'WPRedirect',
			NS_WPREDIRECT_TALK => 'WPRedirect_Diskussion',
		],
		'ratanpirwiki' => [
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
		],
		'reviwiki' => [
			NS_SERVER => 'Server',
			NS_SERVER_TALK => 'Server_talk',
		],
		'reviwikiwiki' => [
			NS_HANDBOOK => '핸드북',
			NS_HANDBOOK_TALK => '핸드북토론',
		],
		'revitwiki' => [
			NS_RGB => 'RGB',
			NS_RGB_TALK => 'RGB_talk',
			NS_IDEA => 'IDEA',
			NS_IDEA_TALK => 'IDEA_talk',
			NS_LINESTYLE => 'LineStyle',
			NS_LINESTYLE_TALK => 'LineStyle_talk',
		],
		'rpgbrigadewiki' => [
			NS_VIDEO => 'Video',
			NS_VIDEO_TALK => 'Video_talk',
		],
		'safiriawiki' => [
			NS_HOENN => 'Hoenn',
			NS_HOENN_TALK => 'Hoenn_talk',
		],
		'scruffywiki' => [
			NS_DRAFT => 'Draft',
			NS_DRAFT_TALK => 'Draft_talk',
			NS_BOILERPLATE => 'Boilerplate',
			NS_BOILERPLATE_TALK => 'Boilerplate_talk',
 		],
		'sdiywiki' => [
			NS_DRAFT => 'Draft',
			NS_DRAFT_TALK => 'Draft_talk',
			NS_BOILERPLATE => 'Boilerplate',
			NS_BOILERPLATE_TALK => 'Boilerplate_talk',
 		],
		'slymoddingwiki' => [
			NS_TUT => 'Tutorial',
			NS_TUT_TALK => 'Tutorial_talk',
		],
		'sopatsmkwwiki' => [
			NS_SOP_ATS_MKW => 'SOP ATS MKW',
			NS_SOP_ATS_MKW_TALK => 'SOP ATS MKW_talk',
			NS_MOS_MKW => 'MOS MKW',
			NS_MOS_MKW_TALK => 'MOS MKW_talk',
			NS_LOA => 'LOA',
			NS_LOA_TALK => 'LOA_talk',
			NS_LOCA_MKW => 'LOCA MKW',
			NS_LOCA_MKW_TALK => 'LOCA MKW_talk',
			NS_ARTIKEL => 'ARTIKEL',
			NS_ARTIKEL_TALK => 'ARTIKEL_talk',
		],
		'statisticswiki' => [
			NS_HUB => 'Hub',
			NS_HUB_TALK => 'Hub_talk',
		],
		'studynotekrwiki' => [
			NS_STUDY_NOTE => 'Study note',
			NS_STUDY_NOTE_TALK => 'Study note_talk',
			NS_EXPLANATION => 'Explanation',
			NS_EXPLANATION_TALK => 'Explanation_talk',
		],
		'thelonsdalebattalionwiki' => [
			NS_GLOSSARY => 'Glossary',
			NS_GLOSSARY_TALK => 'Glossary_talk',
		],
		'trexwiki' => [
			NS_HALAMAN => 'Halaman',
			NS_HALAMAN_TALK => 'Permbicaraan_Halaman',
			NS_ARTIKEL => 'Artikel',
			NS_ARTIKEL_TALK => 'Artikel_talk',
		],
		'tmewiki' => [
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
		],
		'uncyclopediawiki' => [
			NS_PSEUDO_NEWS => '伪基新闻',
			NS_PSEUDO_NEWS_TALK => '伪基新闻谈',
			NS_PSEUDO_BASE_DICTIONARY => '伪基词典',
			NS_PSEUDO_BASE_DICTIONARY_TALK => '伪基词典谈',
			NS_PSEUDO_BASE_LIBRARY => '伪基文库',
			NS_PSEUDO_BASE_LIBRARY_TALK => '伪基文库谈',
			NS_PSEUDO_BASE_MUSIC => '伪基音乐',
			NS_PSEUDO_BASE_MUSIC_TALK => '伪基音乐谈',
		],
		'uwswiki' => [
			NS_WNS2 => 'WNS2',
			NS_WNS2_TALK => 'WNS2_talk',
		],
		'vandalismwikiwiki' => [
			NS_PROJECT => 'VW',
			NS_PROJECT_TALK => 'VT',
		],
		'votingwiki' => [
			NS_LEGACY => 'Legacy',
			NS_LEGACY_TALK => 'Legacy_talk',
		],
		'warriorpediawiki' => [
			NS_POLICY => 'Policy',
			NS_POLICY_TALK => 'Policy_talk',
		],
		'wikibookwiki' => [
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
		],
		'wisdomwikiwiki' => [
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
		],
		'whentheycrywiki' => [
			NS_SPRITES => 'Sprites',
			NS_SPRITES_TALK => 'Sprites_talk',
			NS_GALLERY => 'Gallery',
			NS_GALLERY_TALK => 'Gallery_talk',
		],
		'yokaiwatchwiki' => [
			NS_WALKTHROUGH => 'Walkthrough',
			NS_WALKTHROUGH_TALK => 'Walkthrough_talk',
			NS_GALLERY => 'Gallery',
			NS_GALLERY_TALK => 'Gallery_talk',
			NS_POLICY => 'Policy',
			NS_POLICY_TALK => 'Policy_talk',
			NS_STAFF => 'Staff',
			NS_STAFF_TALK => 'Staff_talk',
		],
	],
	'wgContentNamespaces' => [
		'default' => [ NS_MAIN ],
		'+apunteswiki' => [ NS_ANEXO ],
		'+centralwiki' => [ NS_ANEXO ],
		'+destinoswiki' => [ NS_ANEXO ],
		'+infowiki' => [ NS_ANEXO ],
		'+mediatecawiki' => [ NS_ANEXO ],
		'+privadowiki' => [ NS_ANEXO ],
		'+tallerwiki' => [ NS_ANEXO ],
		'+ucroniaswiki' => [ NS_ANEXO ],
		'+nonsensopediawiki' => [ NS_CYTATY, NS_NONNEWS, NS_NONZRODLA, NS_SLOWNIK, NS_GRA, NS_PORADNIK ],
		'+reviwiki' => [ NS_SERVER ],
		'+reviwikiwiki' => [ NS_HANDBOOK ],
		'+safiriawiki' => [ NS_HOENN ],
		'+tmewiki' => [ NS_CALL_OF_DUTY, NS_MINECRAFT, NS_SUPER_MARIO_LAND_2, NS_SUPER_MARIO_WORLD_2, NS_SUPER_MARIO_BROS, NS_SUPER_MARIO_ADVANCE, NS_SUPER_MARIO_ADVANCE_2, NS_SUPER_MARIO_ADVANCE_3, NS_SUPER_MARIO_ADVANCE_4, NS_THE_LEGEND_OF_ZELDA, NS_CIVILIZATION_IV, NS_GAME, NS_IDEA, NS_TIMELINE ],
	],
	'wgMathValidModes' => [
		'default' => [ 'png' ],
	],
	'wgMetaNamespace' => [
		'default' => null,
		'apunteswiki' => 'Apuntes',
		'centralwiki' => 'Central',
		'destinoswiki' => 'Destinos',
		'infowiki' => 'Info',
		'mediatecawiki' => 'Mediateca',
		'privadowiki' => 'Privado',
		'tallerwiki' => 'Tallerwiki',
		'ucroniaswiki' => 'Ucronías',
		'incubatorwiki' => 'Incubator',
		'jawp2chwiki' => 'まとめwiki',
		'tmewiki' => 'TME',
	],
	'+wgNamespaceAliases' => [
		'default' => [
			'Image' => NS_FILE,
			'Image_talk' => NS_FILE_TALK,
		],
		'+apunteswiki' => [
			'A' => NS_PROJECT,
		],
		'+centralwiki' => [
			'C' => NS_PROJECT,
		],
		'+destinoswiki' => [
			'D' => NS_PROJECT,
			'WV' => NS_PROYECTO,
			'Wikiviajes' => NS_PROYECTO,
		],
		'+infowiki' => [
			'I' => NS_PROJECT,
		],
		'+mediatecawiki' => [
			'M' => NS_PROJECT,
		],
		'+privadowiki' => [
			'P' => NS_PROJECT,
		],
		'+tallerwiki' => [
			'T' => NS_PROJECT,
		],
		'+ucroniaswiki' => [
			'U' => NS_PROJECT,
		],
		'+adnovumwiki' => [
			'ARP' => NS_PROJECT,
			'ARP_talk' => NS_PROJECT_TALK,
			'H' => NS_HELP,
			'H_talk' => NS_HELP_TALK,
		],
		'+allthetropeswiki' => [
			'ATT' => NS_PROJECT,
			'ATT_talk' => NS_PROJECT_TALK,
			'YKTTW' => NS_TROPEWORKSHOP,
			'YKTTW_talk' => NS_TROPEWORKSHOP_TALK,
			'Blurb' => NS_FEATURED,
			'Blurb_talk' => NS_FEATURED_TALK,
		],
		'+bigforestwiki' => [
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
		],
		'+bpwiki' => [
			'Halaman' => NS_PROOFREAD_PAGE,
			'Pembicaraan_Halaman' => NS_PROOFREAD_PAGE_TALK,
			'Indeks' => NS_PROOFREAD_INDEX,
			'Pembicaraan_Indeks' => NS_PROOFREAD_INDEX_TALK,
		],
		'+casuarinawiki' => [
			'文庫' => NS_LIBRARY,
			'文庫討論' => NS_LIBRARY_TALK,
		],
		'+dakhilcommunitywiki' => [
			'DC' => NS_MAIN,
			'DC_talk' => NS_TALK,
		],
		'+ecoepiwiki' => [
			'P' => NS_PARAMETER,
			'PT' => NS_PARAMETER_TALK,
		],
		'+humorpediawiki' => [
			'HP' => NS_PROJECT,
			'HP_talk' => NS_PROJECT_TALK,
		],
		'+incubatorwiki' => [
			'I' => NS_PROJECT,
			'IT' => NS_PROJECT_TALK,
		],
		'+isvwiki' => [
			'Library' => NS_LIBRARY,
			'Library_talk' => NS_LIBRARY_TALK,
		],
		'+picardwiki' => [
			'NS_USER_PROFILE' => 'Benutzerprofil',
			'NS_USER_PROFILE_TALK' => 'Benutzerprofil Diskussion',
		],
		'+proxybotwiki' => [
			'UT' => NS_USER_TALK,
		],
		'+reviwikiwiki' => [
			'Handbook' => NS_HANDBOOK,
			'Handbook_talk' => NS_HANDBOOK_TALK,
		],
		'+studynotekrwiki' => [
			'KSN' => NS_KOREAN_STUDY_NOTE,
			'KSN_TALK' => NS_KOREAN_STUDY_NOTE_TALK,
		],
		'+tmewiki' => [
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
			'Imagem' => NS_FILE,
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
		],
		'+vandalismwikiwiki' => [
			'H' => NS_HELP,
			'HT' => NS_HELP_TALK,
			'VW' => NS_PROJECT,
			'VT' => NS_PROJECT_TALK,
		],
	],
	'+wgNamespaceProtection' => [
		'default' => [],
		'+nenawikiwiki' => [
			NS_MAIN => [
				'edit-content-pages',
			],
			NS_USER => [
				'edit-content-pages',
			],
			NS_PROJECT => [
				'edit-content-pages',
			],
			NS_FILE => [
				'edit-content-pages',
			],
			NS_TEMPLATE => [
				'edit-content-pages',
			],
			NS_HELP => [
				'edit-admin-pages',
			],
			NS_CATEGORY => [
				'edit-content-pages',
			],
			NS_TALK => [
				'edit-talkpages',
			],
		],
		'+whentheycrywiki' => [
			NS_USER => [
				'edit-userpage',
			],
		],
		'+weatherwiki' => [
			NS_PROJECT => [
				'edit-restrictednamespace',
			],
			NS_TEMPLATE => [
				'edit-restrictednamespace',
			],
			WMG_NS_MODULE => [
				'edit-restrictednamespace',
			],
		],
		'+yeoksawiki' => [
			NS_PROJECT => [
				'project-edit',
			],
		],
	],
	'+wgNamespacesToBeSearchedDefault' => [
		'default' => [],
		'+isvwiki' => [
			NS_LIBRARY => true,
		],
		'+metawiki' => [
			NS_TECH => true,
		],
		'+monarchistswiki' => [
			NS_MUSINGS => true,
		],
		'+starmetalwiki' => [
			NS_USER => true,
		],
		'+thelonsdalebattalionwiki' => [
			NS_GLOSSARY => true,
		],
		'+tmewiki' => [
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
		],
	],
	'+wgNamespacesWithSubpages' => [
		'default' => [
			NS_MAIN => true,
		],
		'+apunteswiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+centralwiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+crazybloxianempireinfowiki' => [
			NS_LIST => true,
			NS_LIST_TALK => true,
			NS_STOREFRONT => true,
			NS_STOREFRONT_TALK => true,
			NS_LAW => true,
			NS_LAW_AMENDING => true,
			NS_EXECUTIVE_ORDER => true,
			NS_EXECUTIVE_ORDER_TALK => true,
			NS_GROUP => true,
			NS_GROUP_TALK => true,
		 ],
		'+destinoswiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+infowiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+mediatecawiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+privadowiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+tallerwiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+ucroniaswiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+adnovumwiki' => [
			NS_MAIN => true,
			NS_USER => true,
			NS_TEMPLATE => true,
			NS_PORTAL => true,
			NS_HELP => true,
		],
		'+allthetropeswiki' => [
			NS_MAIN => true,
			NS_TROPEWORKSHOP => true,
		],
		'+alwikiwiki' => [
			NS_MAIN => true,
		],
		'+caeruleawiki' => [
			NS_MAIN => true,
		],
		'+christipediawiki' => [
			NS_MAIN => true,
		],
		'+cnvwiki' => [
			NS_MAIN => true,
		],
		'+conductwiki' => [
			NS_MAIN => true,
		],
		'+ecoepiwiki' => [
			NS_PARAMETER => true,
			NS_PARAMETER_TALK => true,
		],
		'+eotewiki' => [
			NS_MAIN => true,
		],
		'+hobbieswiki' => [
			NS_MAIN => true,
		],
		'+humorpediawiki' => [
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
		],
		'+ictjudikaturawiki' => [
			NS_MAIN => true,
		],
		'+isvwiki' => [
			NS_LIBRARY => true,
			NS_LIBRARY_TALK => true,
		],
		'+jadtechwiki' => [
			NS_GAMEPAGE => true,
			NS_GAMEPAGE_TALK => true,
		],
		'+jawp2chwiki' => [
			NS_TEMPLATE => true,
		],
		'+machiningwiki' => [
			NS_MAIN => true,
			NS_TEMPLATE => true,
		],
		'+metawiki' => [
			NS_MAIN => true,
			NS_TECH => true,
		],
		'+monarchistswiki' => [
			NS_MUSINGS => true,
		],
		'+r2wiki' => [
			NS_MAIN => true,
		],
		'+raymanspeedrunwiki' => [
			NS_MAIN => true,
		],
		'+reviwiki' => [
			NS_MAIN => true,
			NS_SERVER => true,
		],
		'+reviwikiwiki' => [
			NS_MAIN => true,
			NS_HANDBOOK => true,
		],
		'+nonciclopediawiki' => [
			NS_PORTALE => true,
			NS_DISCUSSIONI_PORTALE => true,
			NS_PROGETTO => true,
			NS_DISCUSSIONI_PROGETTO => true,
			NS_CIMITERO => true,
			NS_DISCUSSIONI_CIMITERO => true,
			NS_NONNOTIZIE => true,
			NS_DISCUSSIONI_NONNOTIZIE => true,
			NS_NONVOYAGE => true,
			NS_DISCUSSIONI_NONVOYAGE => true,
			NS_NONQUOTE => true,
			NS_DISCUSSIONI_NONQUOTE => true,
			NS_NONDIZIONARIO => true,
			NS_DISCUSSIONI_NONDIZIONARIO => true,
			NS_NONIVERSITA => true,
			NS_DISCUSSIONI_NONIVERSITA => true,
			NS_NONSOURCE => true,
			NS_DISCUSSIONI_NONSOURCE => true,
			NS_NONBOOKS => true,
			NS_DISCUSSIONI_NONBOOKS => true,
		],
		'+rswiki' => [
			NS_TEMPLATE => true,
		],
		'+safiriawiki' => [
			NS_MAIN => true,
			NS_HOENN => true,
		],
		'+sidemwiki' => [
			NS_MAIN => true,
			NS_USER => true,
		],
		'+thegreatwarwiki' => [
			NS_MAIN => true,
		],
		'+tmewiki' => [
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
		],
		'+voidwiki' => [
			NS_MAIN => true,
		],
		'+wisdomwikiwiki' => [
			NS_MAIN => true,
			NS_LCS => true,
			NS_LIBRARY => true,
			NS_TEACHING => true,
		],
	],

	'wgNamespaceContentModels' => [
		'default' => [],
		'isvwiki' => [
			WMG_NS_MODULE_TALK => 'flow-board',
			NS_LIBRARY_TALK => 'flow-board',
		],
		'apunteswiki' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
		'centralwiki' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
		'destinoswiki' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
		'infowiki' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
		'mediatecawiki' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
		'privadowiki' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
		'taller' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
		'ucroniaswiki' => [
			NS_TEST_TALK => 'flow-board',
			NS_PAGE_TALK => 'flow-board',
			NS_ANEXO_TALK => 'flow-board',
			NS_REGISTRO_TALK => 'flow-board',
			NS_LISTA_TALK => 'flow-board',
			NS_PROYECTO_TALK => 'flow-board',
			NS_TALLER_TALK => 'flow-board',
			NS_MODELO_TALK => 'flow-board',
			NS_EXAMPLE_TALK => 'flow-board',
		],
	],
	// OATHAuth [MWExempt]
	'wgOATHAuthDatabase' => [
		'default' => 'mhglobal',
	],

	// OAuth [MWExempt]
	'wgMWOAuthCentralWiki' => [
		'default' => 'metawiki',
	],
	'wgMWOAuthSharedUserSource' => [
		'default' => 'CentralAuth',
	],
	'wgMWOAuthSecureTokenTransfer' => [
		'default' => true,
	],

	// Pagelang [MW]
	'wgPageLanguageUseDB' => [
		'default' => false,
	],

	// Page Size [MWCandidate]
	'wgMaxArticleSize' => [
		'default' => 2048,
		'nonsensopediawiki' => 8192,
	],

	// PageTriage [MWCandidate]
	'wgPageTriageInfinitScrolling' => [
		'default' => true,
	],

	// Permissions [MWPermissions]
	'wgGroupsAddToSelf' => [
		'default' => [],
		'+metawiki' => [
			'cvt' => [
				'flood',
			],
		],
		'+weatherwiki' => [
			'importer' => [
				'flood',
			],
		],
	],
	'wgGroupsRemoveFromSelf' => [
		'default' => [],
		'+harrypotterwiki' => [
			'bureaucrat' => [
				'bureaucrat',
			],
		],
		'+metawiki' => [
			'cvt' => [
				'flood',
			],
		],
		'+weatherwiki' => [
			'importer' => [
				'flood',
			],
		],
	],
	'wgRevokePermissions' => [
		'default' => [],
		'ssptopwiki' => [
			'read-only' => [
				'edit' => true,
			],
		],
		'weatherwiki' => [
			'banned' => [
				'editmyoptions' => true,
				'editmyprivateinfo' => true,
				'editmyusercss' => true,
				'editmyuserjs' => true,
				'editmywatchlist' => true,
				'read' => true,
				'writeapi' => true,
				'viewmyprivateinfo' => true,
				'viewmywatchlist' => true,
			],
		],
	],
	'wgAutopromote' => [
		'default' => [
			'autoconfirmed' => [
				"&",
				[ APCOND_EDITCOUNT, &$wgAutoConfirmCount ],
				[ APCOND_AGE, &$wgAutoConfirmAge ],
			],
		],
		'+bitcoindebateswiki' => [
			'emailconfirmed' => [
				APCOND_EMAILCONFIRMED,
			],
		],
		'+nenawikiwiki' => [
			'emailconfirmed' => [
				APCOND_EMAILCONFIRMED,
			],
		],
		'+igrovyesistemywiki' => [
			'UserType1' => [
				"&",
				[ APCOND_EDITCOUNT, 1 ],
				[ APCOND_AGE, 0 ],
				[ '!', [ APCOND_INGROUPS, 'UserType2' ] ],
			],
			'UserType2' => [
				"&",
				[ APCOND_EDITCOUNT, 50 ],
				[ APCOND_AGE, 0 ],
				[ '!', [ APCOND_INGROUPS, 'UserType3' ] ],
			],
			'UserType3' => [
				"&",
				[ APCOND_EDITCOUNT, 300 ],
				[ APCOND_AGE, 0 ],
				[ '!', [ APCOND_INGROUPS, 'UserType4' ] ],
			],
			'UserType4' => [
				"&",
				[ APCOND_EDITCOUNT, 500 ],
				[ APCOND_AGE, 0 ],
				[ '!', [ APCOND_INGROUPS, 'UserType5' ] ],
			],
			'UserType5' => [
				"&",
				[ APCOND_EDITCOUNT, 1000 ],
				[ APCOND_AGE, 0 ],
				[ '!', [ APCOND_INGROUPS, 'UserType6' ] ],
			],
			'UserType6' => [
				"&",
				[ APCOND_EDITCOUNT, 2000 ],
				[ APCOND_AGE, 0 ],
				[ '!', [ APCOND_INGROUPS, 'UserType7' ] ],
			],
			'UserType7' => [
				"&",
				[ APCOND_EDITCOUNT, 3000 ],
				[ APCOND_AGE, 0 ],
			],
		],
		'+jacksonheightswiki' => [
			'emailconfirmed' => [
				APCOND_EMAILCONFIRMED,
			],
		],
		'+kyivstarwiki' => [
			'co' => [
				"&",
				[ APCOND_EDITCOUNT, 3000 ],
				[ APCOND_AGE, 365 * 86400 ],
			],
			'ceo' => [
				"&",
				[ APCOND_EDITCOUNT, 2000 ],
				[ APCOND_AGE, 275 * 86400 ],
			],
			'editor' => [
				"&",
				[ APCOND_EDITCOUNT, 300 ],
				[ APCOND_AGE, 45 * 86400 ],
			],
			'extendedconfirmed' => [
				"&",
				[ APCOND_EDITCOUNT, 500 ],
				[ APCOND_AGE, 90 * 86400 ],
			],
			'sysmag' => [
				"&",
				[ APCOND_EDITCOUNT, 1000 ],
				[ APCOND_AGE, 185 * 86400 ],
			],
			'trusted' => [
				"&",
				[ APCOND_EDITCOUNT, 50 ],
				[ APCOND_AGE, 7 * 86400 ],
			],
		],
		'+olegcinemawiki' => [
			'uploader' => [
				"&",
				[ APCOND_AGE, 10 * 86400 ],
			],
		],
	],
	'wgAutopromoteOnce' => [
		'default' => [],
		'weatherwiki' => [
			'extendedconfirmed' => [
				"&",
				[ APCOND_EDITCOUNT, 100 ],
				[ APCOND_AGE, 30 * 86400 ],
			],
		],
	],
	'wgImplicitGroups' => [
		'default' => [ '*', 'user', 'autoconfirmed' ],
		'bitcoindebateswiki' => [ '*', 'user', 'autoconfirmed', 'emailconfirmed' ],
	],

	// Password policy [MWExempt]
	'wgPasswordPolicy' => [
		'default' => [
			'policies' => [
				'default' => [
					'MinimalPasswordLength' => 6,
					'PasswordCannotMatchUsername' => true,
					'PasswordCannotMatchBlacklist' => true,
					'MaximalPasswordLength' => 4096,
				],
				'bot' => [
					'MinimalPasswordLength' => 8,
					'MinimumPasswordLengthToLogin' => 6,
					'PasswordCannotMatchUsername' => true,
				],
				'sysop' => [
					'MinimalPasswordLength' => 8,
					'MinimumPasswordLengthToLogin' => 6,
					'PasswordCannotMatchUsername' => true,
					'PasswordCannotBePopular' => 25,
				],
				'bureaucrat' => [
					'MinimalPasswordLength' => 8,
					'MinimumPasswordLengthToLogin' => 6,
					'PasswordCannotMatchUsername' => true,
					'PasswordCannotBePopular' => 25,
				],
			],
			'checks' => [
				'MinimalPasswordLength' => 'PasswordPolicyChecks::checkMinimalPasswordLength',
				'MinimumPasswordLengthToLogin' => 'PasswordPolicyChecks::checkMinimumPasswordLengthToLogin',
				'PasswordCannotMatchUsername' => 'PasswordPolicyChecks::checkPasswordCannotMatchUsername',
				'PasswordCannotMatchBlacklist' => 'PasswordPolicyChecks::checkPasswordCannotMatchBlacklist',
				'MaximalPasswordLength' => 'PasswordPolicyChecks::checkMaximalPasswordLength',
				'PasswordCannotBePopular' => 'PasswordPolicyChecks::checkPopularPasswordBlacklist'
			],
		],
	],

	// RateLimits [MWExempt]
	'+wgRateLimits' => [
		'default' => [],
		'metawiki' => [
			'requestwiki' => [
				'user' => [ 1, 3600 ],
			],
		],
	],

	// RecentChanges [MWCandidate]
	'wgRCMaxAge' => [
		'default' => 180 * 24 * 3600,
	],

	// RelatedArticles settings [MWCandidate]
	'wgRelatedArticlesFooterWhitelistedSkins' => [
		'default' => [
			'minerva',
			'timeless',
			'vector',
		],
		'avalicearchiveswiki' => [
			'metrolook',
			'vector',
		],
	],
	'wgRelatedArticlesLoggingSamplingRate' => [
		'default' => false,
		'allthetropeswiki' => '0.01',
		'avalicearchiveswiki' => '0.01',
		'youtubewiki' => '0.01',
	],
	'wgRelatedArticlesShowReadMore' => [
		'default' => false,
		'allthetropeswiki' => true,
		'avalicearchiveswiki' => true,
		'youtubewiki' => true,
	],
	'wgRelatedArticlesShowInFooter' => [
		'default' => false,
		'allthetropeswiki' => true,
		'avalicearchiveswiki' => true,
		'youtubewiki' => true,
	],
	'wgRelatedArticlesUseCirrusSearch' => [
		'default' => false,
	],

	// Restriction types [MWCandidate]
	'+wgRestrictionLevels' => [
		'default' => [
			'user',
		],
		'+bigforestwiki' => [
			'editvoter',
		],
		'+cmgwiki' => [
			'bureaucrat',
			'sysop',
			'pm',
			'member',
		],
		'+dpwiki' => [
			'bureaucrat',
			'respected',
		],
		'+testwiki' => [
			'bureaucrat',
			'consul',
		],
		'igrovyesistemywiki' => [
			'trusted',
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		],
		'+kyivstarwiki' => [
			'co',
			'ceo',
			'editor',
			'extendedconfirmed',
			'sysmag',
			'trusted',
		],
		'+lcars47wiki' => [
			'bureaucrat',
			'devteam',
		],
		'+marthaspeakswiki' => [
			'templateeditor',
		],
		'+sau226wiki' => [
			'bureaucrat',
			'consul',
		],
		'+jayuwikiwiki' => [
			'editvoter',
		],
		'+pruebawiki' => [
			'bureaucrat',
			'consul',
		],
		'+radviserwiki' => [
			'editor',
		],
		'+sovereignwiki' => [
			'officer',
			'game-master',
		],
		'+studynotekrwiki' => [
			'voter',
		],
		'+thesciencearchiveswiki' => [
			'templateeditor',
		],
		'+trexwiki' => [
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		],
		'weatherwiki' => [],
	],

	'+wgRestrictionTypes' => [
		'default' => [
			'delete',
		],
		'cmgwiki' => [
			'delete',
			'protect',
		],
		'lcars47wiki' => [
			'delete',
			'protect',
		],
		'pruebawiki' => [
			'delete',
			'protect',
		],
		'sau226wiki' => [
			'delete',
			'protect',
		],
		'testwiki' => [
			'delete',
			'protect',
		],
		'weatherwiki' => [],
	],

	// Robot policy [MWCandidate]
	'wgDefaultRobotPolicy' => [
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
	],

	// RSS Settings [MWCandidate]
	'wgRSSCacheAge' => [
		'default' => '3600'
	],
	'wgRSSProxy' => [
		'default' => false,
	],
	'wgRSSDateDefaultFormat' => [
		'default' => 'Y-m-d H:i:s'
	],

	// Scribunto [MWCandidate]
	'wgCodeEditorEnableCore' => [
		'default' => true,
	],
	'wgScribuntoUseCodeEditor' => [
		'default' => true,
	],
	'wgScribuntoSlowFunctionThreshold' => [
		'default' => 0.99,
	],
	'wgScribuntoEngineConf' => [
		'default' => [
			'luasandbox' => [
				'cpuLimit' => 10,
				'maxLangCacheSize' => 200,
			],
			'luastandalone' => [
				'cpuLimit' => 10,
				'maxLangCacheSize' => 200,
			],
		],
	],

	// Site notice opt out [MW]
	'wmgSiteNoticeOptOut' => [
		'default' => false,
	],

	// Server [MWExempt]
	'wgArticlePath' => [
		'default' => '/wiki/$1',
	],
	'wgDisableOutputCompression' => [
		'default' => true,
	],
	'wgScriptExtension' => [
		'default' => '.php',
	],
	'wgScriptPath' => [
		'default' => '/w',
	],
	'wgServer' => [
		'default' => 'https://$lang.miraheze.org',
	],
	'wgShowHostnames' => [
		'default' => true,
	],
	'wgUsePathInfo' => [
		'default' => true,
	],

	// SiteNotice [MWCandidate]
	'wgDismissableSiteNoticeForAnons' => [
		'default' => true,
	],

	// SocialProfile [MWCandidate]
	'wgUserBoard' => [
		'default' => false,
	],
	'wgUserProfileThresholds' => [
		'default' => [
			'edits' => 0,
		],
		'allthetropes' => [
			'edits' => 10,
		],
	],
	'wgUserProfileDisplay' => [
		'default' => [
			'board' => false,
			'friends' => false,
			'foes' => false,
		],
	],

	// Statistics [MWCandidate]
	'wgArticleCountMethod' => [
		'default' => 'link', // To update it, you will need to run the maintenance/updateArticleCount.php script
		'fourleafficswiki' => 'any',
		'ildrilwiki' => 'any',
		'lothuialethwiki' => 'any',
	],

	// Squid (aka Varnish) [MWExempt]
	'wgUseSquid' => [
		'default' => true,
	],
	'wgSquidServers' => [
		'default' => [
			'107.191.126.23:81', // cp2
			'81.4.109.133:81', // cp4
			'172.104.111.8:81', // cp5
		],
	],

	// Style [MWCandidate]
	'wgAllowUserCss' => [
		'default' => true,
	],
	'wgAllowUserJs' => [
		'default' => true,
	],
	'wgAppleTouchIcon' => [
		'default' => '/apple-touch-icon.png',
	],
	'wgCentralAuthLoginIcon' => [
		'default' => '/usr/share/nginx/favicons/default.ico',
	],
	'wgDefaultSkin' => [
		'default' => 'vector',
	],
	'wgFavicon' => [
		'default' => '/favicon.ico',
	],
	'wgLogo' => [
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
	],

	// TemplateSandbox [MWCandidate] (MWNamespaces?)
	'wgTemplateSandboxEditNamespaces' => [
		'default' => [
			NS_TEMPLATE,
			WMG_NS_MODULE
		]
	],

	// Timezone [MW]
	'wgLocaltimezone' => [
		'default' => 'UTC',
	],

	// Theme [MWCandidate]
	'wgDefaultTheme' => [
		'default' => "",
	],

	// TitleBlacklist [MWExempt]
	'wgTitleBlacklistSources' => [
		'default' => [
			'type' => 'url',
			'src'  => 'https://meta.miraheze.org/w/index.php?title=Title_blacklist&action=raw',
		],
		'meta' => [
			'type' => 'url',
			'src' => 'https://meta.miraheze.org/w/index.php?title=MediaWiki:Titleblacklist&action=raw',
		],
	],
	'wgTitleBlacklistUsernameSources' => [
		'default' => [
			'type' => 'url',
			'src'  => 'https://meta.miraheze.org/w/index.php?title=Title_blacklist&action=raw',
		],
		'meta' => [
			'type' => 'url',
			'src' => 'https://meta.miraheze.org/w/index.php?title=MediaWiki:Titleblacklist&action=raw',
		],
	],
	'wgTidyConfig' => [
		'default' => [
			'driver' => 'RemexHtml'
		],
	],

	// Translate [MWCandidate]
	'wmgTranslateBlacklist' => [
		'default' => [],
		'metawiki' => [
			'*' => [
				'en' => 'English is the source language.',
			],
		],
		'spiralwiki' => [
			'*' => [
				'en' => 'English is the source language.',
			],
		],
	],
	'wmgTranslateTranslationServices' => [
		'default' => [],
	],
	'wmgTranslateDocumentationLanguageCode' => [
		'default' => false,
		'nvcwiki' => 'qqq',
	],

	// UniversalLanguageSelector [MWCandidate]
	'wgULSAnonCanChangeLanguage' => [
		'default' => false,
	],

	// UrlShortener [MWExempt]
	'wgUrlShortenerTemplate' => [
		'default' => '/m/$1',
	],
	'wgUrlShortenerDBName' => [
		'default' => 'metawiki',
	],
	'wgUrlShortenerDomainsWhitelist' => [
		'default' => [
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
			'taotac\.info' .
			'wiki\.teessidehackspace\.org\.uk',
			'wiki\.tensorflow\.community',
			'thelonsdalebattalion\.co.uk',
			'toonpedia\.cf',
			'wiki\.tulpa\.info',
			'wiki\.valentinaproject.org',
			'wiki\.kaisaga.com',
			'wikiescola\.com\.br',
			'wiki\.worlduniversityandschool\.org' .
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
		],
	],

	// VisualEditor [MWCandidate]
	'wmgVisualEditorEnableDefault' => [
		'default' => true,
	],
	'wmgVisualEditorAvailableNamespaces' => [
		'default' => [
			NS_MAIN => true,
			NS_USER => true,
		],
		'+apunteswiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+centralwiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+destinoswiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+infowiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+mediatecawiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+privadowiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+tallerwiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+ucroniaswiki' => [
			NS_PROJECT => true,
			NS_PAGE => true,
			NS_ANEXO => true,
			NS_TEST => true,
			NS_REGISTRO => true,
			NS_LISTA => true,
			NS_PROYECTO => true,
			NS_TALLER => true,
			NS_MODELO => true,
			NS_EXAMPLE => true,
		 ],
		'+espiralwiki' => [
			NS_PROJECT => true,
		],
		'+isvwiki' => [
			NS_LIBRARY => true,
		],
		'+oncprojectwiki' => [
			NS_PROJECT => true,
			NS_TEMPLATE => true,
			NS_CATEGORY => true,
			NS_FILE => true,
		],
		'+wisdomwikiwiki' => [
			NS_LCS => true,
			NS_MEDI => true,
			NS_LIBRARY => true,
			NS_TEACHING => true,
			NS_BLANK => true,
		],
	],
	'wgVisualEditorShowBetaWelcome' => [
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
	],
	'wgVisualEditorSupportedSkins' => [
		'default' => [],
		'permanentfuturelabwiki' => [ 'foreground' ],
		'pfsolutions' => [ 'metrolook' ],
	],
	'wgVisualEditorUseSingleEditTab' => [
		'default' => false,
		'espiralwiki' => true,
		'isvwiki' => true,
		'spiralwiki' => true,
	],
	// WikidataPageBanner [MWCandidate]
	'wgWPBNamespaces' => [
		'default' => [ NS_MAIN ],
		'+apunteswiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
		'+centralwiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
		'+destinoswiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
		'+infowiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
		'+mediatecawiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
		'+privadowiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
		'+tallerwiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
		'+ucroniaswiki' => [ NS_REGISTRO, NS_PROYECTO, NS_TALLER, NS_EXAMPLE ],
	],

	// Protect site config [MWCandidate]
	'wgProtectSiteLimit' => [
		'default' => '1 week',
		'infectopedwiki' => '10 years',
		'campaignlabwiki' => 'indefinite',
		'tnoteswiki' => 'indefinite',
		'weatherwiki' => 'indefinite',
	],
	'wgProtectSiteDefaultTimeout' => [
		'default' => '1 hour',
		'infectopedwiki' => '1 year',
		'tnoteswiki' => '2 hours',
		'weatherwiki' => '1 week',
	],

	// WebChat config [MWCandidate]
	'wmgWebChatServer' => [
		'default' => false,
		'allthetropeswiki' => 'irc.freenode.net',
		'ildrilwiki' => 'irc.sorcery.net',
		'lothuialethwiki' => 'irc.sorcery.net',
		'pnphilotenwiki' => 'irc.freenode.net',
		'wisdomwikiwiki' => 'irc.freenode.net',
	],
	'wmgWebChatChannel' => [
		'default' => false,
		'allthetropeswiki' => '#miraheze-allthetropes',
		'ildrilwiki' => '#Aesir',
		'lothuialethwiki' => '#Aesir',
		'pnphilotenwiki' => '#miraheze-pnphiloten',
		'wisdomwikiwiki' => '#miraheze-wisdomwiki',
	],
	'wmgWebChatClient' => [
		'default' => false,
		'allthetropeswiki' => 'freenodeChat',
		'ildrilwiki' => 'Mibbit',
		'lothuialethwiki' => 'Mibbit',
		'pnphilotenwiki' => 'freenodeChat',
		'wisdomwikiwiki' => 'freenodeChat',
	],

	// Wikimedia Incubator Settings [MWExempt?]
	'wmincProjects' => [
		'default' => [
			'p' => 'Wikipedia',
			'b' => 'Wikibooks',
			't' => 'Wiktionary',
			'q' => 'Wikiquote',
			'n' => 'Wikinews',
			'y' => 'Wikivoyage',
			's' => 'Wikisource',
			'v' => 'Wikiversity',
		],
	],
	'wmincProjectSite' => [
		'default' => [
			'name' => 'Incubator Plus 2.0',
			'short' => 'incplus',
		],
	],
	'wmincSisterProjects' => [
		'default' => [
			'm' => 'Miraheze Meta',
		],
	],
	'wmincExistingWikis' => [
		'default' => null,
	],
	'wmincClosedWikis' => [
		'default' => false,
	],
	'wmincMultilingualProjects' => [
		'default' => [],
	],

	// Whitelist [MWCandidate]
	'wmgUseMainPageWhitelist' => [
		'default' => true,
		'rwsaleswiki' => false,
	],

	// WikiDiscover [MWExempt]
	'wgWikiDiscoverClosedList' => [
		'default' => '/srv/mediawiki/dblist/closed.dblist',
	],
	'wgWikiDiscoverInactiveList' => [
		'default' => '/srv/mediawiki/dblist/inactive.dblist',
	],
	'wgWikiDiscoverPrivateList' => [
		'default' => '/srv/mediawiki/dblist/private.dblist',
	],

	// Empty arrays (do not touch unless you know what you're doing)
	'wmgClosedWiki' => [
		'default' => false,
	],
	'wmgInactiveWiki' => [
		'default' => false,
	],
	'wmgPrivateWiki' => [
		'default' => false,
	],

	// Uncategorised [MWCandidate]
	'wgRandomGameDisplay' => [
		'default' => [
			'random_picturegame' => false,
			'random_poll' => false,
		],
	],
];

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
	return [
		'suffix' => $site,
		'lang' => $lang,
		'params' => [
			'lang' => $lang,
			'site' => $site,
			'wiki' => $wiki,
		],
		'tags' => [],
	];
}

$wgConf->siteParamsCallback = 'efGetSiteParams';

# The thing that determines the dbname
if ( defined( 'MW_DB' ) ) {
	$wgDBname = MW_DB;
} elseif ( $wmgHostname === 'meta.miraheze.org' ) {
	$wgDBname = 'metawiki';
} elseif ( preg_match( '/^(.*)\.m\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgDBname = $matches[1] . 'wiki';
} elseif ( preg_match( '/^(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgDBname = $matches[1] . 'wiki';
} else {
	$wgDBname = '';
}

# Initialize dblist
$wgLocalDatabases = [];
$wmgDatabaseList = file( "/srv/mediawiki/dblist/all.dblist" );

// ManageWiki settings
require_once "/srv/mediawiki/config/ManageWiki.php";

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
	foreach ( $wgConf->settings['wgMobileUrlTemplate'] as $value => $mobileurl ) {
		if ( $mobileurl === $wmgHostname ) {
			$wgDBname = $value;
		}
	}

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

if ( preg_match( '/^(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgMobileUrlTemplate = '%h0.m.miraheze.org';
} elseif ( preg_match( '/^(.*)\.m\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgMobileUrlTemplate = '%h0.m.miraheze.org';
}

if ( !preg_match( '/^(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgCentralAuthCookieDomain = $wmgHostname;
	$wgCookieDomain = $wmgHostname;
}

# Footer icon
$wgFooterIcons['poweredby']['miraheze'] = [
	'src' => "https://$wmgUploadHostname/metawiki/7/7e/Powered_by_Miraheze.png",
	'url' => 'https://meta.miraheze.org/wiki/',
	'alt' => 'Miraheze Wiki Hosting',
];

if ( $wgDBname === 'permanentfuturelabwiki' ) {
	$wgFooterIcons['poweredby']['wikiapiary'] = [
		'src' => 'https://wikiapiary.com/w/images/wikiapiary/b/b4/Monitored_by_WikiApiary.png',
		'url' => 'https://wikiapiary.com/wiki/Permanent_Future_Lab',
		'alt' => 'Monitored by WikiApiary',
	];
}

if ( $wgDBname === 'tmewiki' ) {
	$wgFooterIcons['poweredby']['wikiapiary'] = [
			'src' => 'https://wikiapiary.com/w/images/wikiapiary/b/b4/Monitored_by_WikiApiary.png',
			'url' => 'https://wikiapiary.com/wiki/The_Multilingual_Encyclopedia_(miraheze.org)',
			'alt' => 'Monitored by WikiApiary',
	];
}

$wgDefaultUserOptions['enotifwatchlistpages'] = 0;
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
require_once "/srv/mediawiki/config/Database.php";
require_once "/srv/mediawiki/config/GlobalLogging.php";
require_once "/srv/mediawiki/config/LocalExtensions.php";
require_once "/srv/mediawiki/config/MissingWiki.php";
require_once "/srv/mediawiki/config/Redis.php";
require_once "/srv/mediawiki/config/Sitenotice.php";

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
require_once "/srv/mediawiki/config/LocalWiki.php";

// Define last - Extension message files for loading extensions
if ( !defined( 'MW_NO_EXTENSION_MESSAGES' ) ) {
	require_once "/srv/mediawiki/config/ExtensionMessageFiles.php";
}
