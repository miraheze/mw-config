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

// Refer to NS_MODULE before importing Scribunto (tmewiki)
define( 'WMG_NS_MODULE', 828 );
define( 'WMG_NS_MODULE_TALK', 829 );

// Special namespace re-defined
define( 'NS_PROOFREAD_PAGE', 250);
define( 'NS_PROOFREAD_PAGE_TALK', 251);
define( 'NS_PROOFREAD_INDEX', 252);
define( 'NS_PROOFREAD_INDEX_TALK', 253);

// NS 860, 861, 862, 863 allocated for Item/Item_talk/Property/Property_talk

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
		'proxybotwiki' => 7,
	),
	'wgAutoConfirmAge' => array(
		'default' => 345600, // 4 days * 24 hours * 60 minutes * 60 seconds
		'developmentwiki' => 259200, // 3 days * 24 hours * 60 minutes * 60 seconds
		'proxybotwiki' => 604800, // 7 days * 24 hours * 60 minutes * 60 seconds
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
		'test1wiki' => true,
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
		'ipolywiki' => true,
		'justinbieberwiki' => true,
		'medicinawiki' => true,
		'nanatsunotaizaiwiki' => true,
		'test1wiki' => true,
		'thehushhushsagawiki' => true,
		'tokyoghoulwiki' => true,
		'youtubewiki' => true,
	),
	'wgVisualEditorEnableWikitext' => array(
		'default' => false,
		'aerosswiki' => true,
		'attackontitanwiki' => true,
		'extloadwiki' => true,
		'knowledgewiki' => true,
		'magnaversewiki' => true,
		'nanatsunotaizaiwiki' => true,
		'raymanspeedrunwiki' => true,
		'test1wiki' => true,
		'thehushhushsagawiki' => true,
		'tmewiki' => true,
		'tokyoghoulwiki' => true,
		'zharkunuwiki' => true,
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
		'default' => array( 'closed', 'private', 'all' ),
	),
	'wgCentralHost' => array(
		'default' => "//meta.miraheze.org",
	),
	'wgNoticeProject' => array(
		'default' => array( 'all' ),
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
			'adadevelopersacademy.wiki' => 'adadevelopersacademywiki',
			'allthetropes.org' => 'allthetropeswiki',
			'www.alwiki.net' => 'alwikiwiki',
			'antiguabarbudacalypso.com' => 'antiguabarbudacalypsowiki',
			'aman.info.tm' => 'amaninfowiki',
			'athenapedia.org' => 'athenapediawiki',
			'b1tes.org' => 'b1teswiki',
			'bconnected.aidanmarkham.com' => 'bconnectedwiki',
			'bebaskanpengetahuan.org' => 'bpwiki',
			'dariawiki.org' => 'dariawikiwiki',
			'disabled.life' => 'disabledlifewiki',
			'embobada.com' => 'embobadawiki',
			'es.publictestwiki.com' => 'pruebawiki',
			'espiral.org' => 'espiralwiki',
			'fikcyjnatv.pl' => 'fikcyjnatvwiki',
			'froggy.info' => 'feuwiki',
			'garrettcountyguide.com' => 'garrettcountyguidewiki',
			'karagash.info' => 'karagashwiki',
			'kunwok.org' => 'kunwokwiki',
			'lodge.jsnydr.com' => 'lodgejsnydrwiki',
			'madgenderscience.wiki' => 'madgendersciencewiki',
			'marinebiodiversitymatrix.org' => 'marinebiodiversitymatrixwiki',
			'meregos.com' => 'meregoswiki',
			'morfarkulten.tk' => 'morfarkultenwiki',
			'nenawiki.org' => 'nenawikiwiki',
			'nonbinary.wiki' => 'nonbinarywiki',
			'www.openonderwijs.org' => 'openonderwijswiki',
			'oecumene.org' => 'oecumenewiki',
			'papelor.io' => 'papeloriowiki',
			'penalwiki.awiki.org' => 'penalwikiwiki',
			'permanentfuturelab.wiki' => 'permanentfuturelabwiki',
			'pl.nonbinary.wiki' => 'plnonbinarywiki',
			'podpedia.org' => 'podpediawiki',
			'private.revi.wiki' => 'reviwiki',
			'programming.red' => 'programmingredwiki',
			'publictestwiki.com' => 'testwiki',
			'pwiki.arkcls.com' => 'pwikiwiki',
			'reviwiki.info' => 'reviwikiwiki',
			'savage-wiki.com' => 'savagewikiwiki',
			'saveta.org' => 'savetawiki',
			'sdiy.info' => 'sdiywiki',
			'speleo.wiki' => 'speleowiki',
			'spiral.wiki' => 'spiralwiki',
			'takethatwiki.com' => 'takethatwikiwiki',
			'wiki.teessidehackspace.org.uk' => 'teessidehackspacewiki',
			'thelonsdalebattalion.co.uk' => 'thelonsdalebattalionwiki',
			'wikibase.revi.wiki' => 'reviwbwiki',
			'wiki.ameciclo.org' => 'ameciclowiki',
			'wiki.autocountsoft.com' => 'autocountwiki',
			'wiki.besuccess.com' => 'kstartupswiki',
			'wiki.clonedeploy.org' => 'clonedeploywiki',
			'wiki.ciptamedia.org' => 'ciptamediawiki',
			'wiki.consentcraft.uk' => 'consentcraftwiki',
			'wiki.drones4nature.info' => 'drones4allwiki',
			'wiki.dwplive.com' => 'dwplivewiki',
			'wiki.exnihilolinux.org' => 'exnihilolinuxwiki',
			'wiki.gamergeeked.us' => 'nerdwiki',
			'wiki.gesamtschule-nordkirchen.de' => 'jcswiki',
			'wiki.grottocenter.org' => 'grottocenterwiki',
			'wiki.inebriation-confederation.com' => 'inebriationconfederationwiki',
			'wiki.jacksonheights.nyc' => 'jacksonheightswiki',
			'wiki.kourouklides.com' => 'kourouklideswiki',
			'wiki.lbcomms.co.za' => 'nextlevelwikiwiki',
			'wiki.ldmsys.net' => 'itiswiki',
			'wiki.lostminecraftminers.org' => 'lostminecraftminerswiki',
			'wiki.macc.nyc' => 'maccnycwiki',
			'wiki.make717.org' => 'make717wiki',
			'wiki.meeusen.net' => 'meeusenwiki',
			'wiki.staraves-no.cz' => 'staravesnowiki',
			'wiki.teamwizardry.com' => 'teamwizardrywiki',
			'wiki.tensorflow.community' => 'tensorflowlearningwiki',
			'wiki.tulpa.info' => 'tulpawiki',
			'wiki.valentinaproject.org' => 'valentinaprojectwiki',
			'wikiescola.com.br' => 'wikiescolawiki',
			'wiki.worlduniversityandschool.org' => 'worlduniversityandschoolwiki',
			'wiki.zymonic.com' => 'zymonicwiki',
			'wikipuk.cl' => 'wikipucwiki',
			'wisdomwiki.org' => 'wisdomwikiwiki',
			'histories.wiki' => 'wishcertwiki',
			'www.eerstelijnszones.be' => 'eerstelijnszoneswiki',
			'www.lab612.at' => 'lab612wiki',
			'www.iceposeidonwiki.com' => 'iceposeidonwiki',
			'www.splat-teams.com' => 'splatteamswiki',
			'www.zenbuddhism.info' => 'zenbuddhismwiki',
		),
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
		'default' => 'centralauth',
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

	 // Contribution Scores
	 'wgContribScoreDisableCache' => array(
 		 'default' => true,
 	 ),

	// CreateWiki
	'wmgCreateWikiSQLfiles' => array(
		'default' => array(
			"$IP/maintenance/tables.sql",
			"$IP/extensions/AbuseFilter/abusefilter.tables.sql",
			"$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_info.sql",
			"$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_vote.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/ArticleFeedbackv5/sql/ArticleFeedbackv5.sql",
			"$IP/extensions/ArticleRatings/ratings.sql",
			"$IP/extensions/BetaFeatures/sql/create_counts.sql",
			"$IP/extensions/Cargo/sql/Cargo.sql",
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
			"$IP/extensions/ProofreadPage/sql/ProofreadIndex.sql",
			"$IP/extensions/QuizGame/sql/quizgame.sql",	
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
	// Cookies extension settings
	'wgCookieWarningMoreUrl' => array(
		'default' => false,
		'thelonsdalebattalionwiki' => 'https://thelonsdalebattalion.co.uk/wiki/The_Lonsdale_Battalion:Cookies'
	),
	'wgCookieSetOnAutoblock' => array(
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

	// Editing Matrix
	'wmgEditingMatrix' => array(
		'default' => array(
			'anon' => false, // Disables editing by anonymous users if set to true
			'user' => false, // Disables editing by logged in users if set to true
			'editor' => false, // Creates an 'editor' group assignable by bureaucrats/sysops if set to true
			'sysop' => false, // Allows sysops to edit if anonymous and logged in users are not allowed to edit.
			'bureaucrat' => false, // Allows bureaucrats to edit if anonymous, logged in users and sysops are not allowed to edit.
		),
		'+690squadronwiki' => array(
			'anon' => true,
		),
		'+8stationwiki' => array(
			'anon' => true,
		),
		'+achancetopursuewiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+adiaprojectwiki' => array(
			'anon' => true,
		),
		'+adnovumwiki' => array(
			'anon' => true,
		),
		'+aesbasewiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+aleenghawiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+antiguabarbudacalypsowiki' => array(
			'anon' => true,
		),
		'+antropologiaargentinawiki' => array(
			'anon' => true,
		),
		'+apellidosmurcianoswiki' => array(
			'anon' => true,
		),
		'+autocountwiki' => array(
			'anon' => true,
			'user' => true,
		),
		'+berenwiki' => array(
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
		'+carmeigatwiki' => array(
			'anon' => true,
		),
		'+christipediawiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+cristianopediawiki' => array(
			'anon' => true,
		),		
		'+claneuphoriawiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+clonedeploywiki' => array(
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
		'+creationismwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
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
		'+designatedsurvivorwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+drones4allwiki' => array(
			'anon' => true,
		),
		'+earthianwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+enenwiki' => array(
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
		'+frejaerikssonwiki' => array(
			'anon' => true,
			'user' => true,
			'bureaucrat' => true,
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
		'+harrypotterwiki' => array(
			'anon' => true,
		),		
		'+hlptestwiki' => array(
			'anon' => true,
		),
		'+houseofettlingarfreyuwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+ildrilwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+ipolywiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+ircwiki' => array(
			'anon' => true,
		),
		'+izanagiwiki' => array(
			'anon' => true,
		),
		'+geomasterywiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+jokowiki' => array(
			'anon' => true,
		),
		'+jwikiwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+karniarutheniawiki' => array(
			'anon' => true,
		),
		'+karrotwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+kl6fwiki' => array(
			'anon' => true,
		),
		'+kunwokwiki' => array(
   			'anon' => true, 
   			'user' => true,   
   			'editor' => true, 
   			'sysop' => true,   
		),
		'+lab612wiki' => array(
			'anon' => true,
		),
		'+lcars47wiki' => array(
			'anon' => true,
		),
		'+lexiquewiki' => array(
			'anon' => true,
		),
		'+lovesgreatadventurewiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+madgendersciencewiki' => array(
			'anon' => true,
		),
		'+maiasongcontestwiki' => array(
			'anon' => true,
		),
		'+marinebiodiversitymatrixwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+medergistswiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
			'editor' => true,
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
		'+musmyswiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+ncpprcwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+nenawikiwiki' => array(
			'anon' => true,
			'user' => true,
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
		'+ofthevampirewiki' => array(
			'anon' => true,
		),
		'+oncprojectwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+openkorebrasilwikiwiki' => array(
			'anon' => true,
		),
		'+paddelnwiki' => array(
			'anon' => true,
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
		'+pmavwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),			
		'+pocketmonsterswiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+priyowiki' => array(
			'anon' => true,
		),
		'+pythiawiki' => array(
			'anon' => true,
			'user' => true,
		),
		'+r2wiki' => array(
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
			'user' => true,
			'sysop' => true,
		),
		'+rpgbrigadewiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+safiriawiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+saharinspacewiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
		),
		'+scruffywiki' => array(
			'anon' => true,
		),		
		'+sdiywiki' => array(
			'anon' => true,
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
		'+templatewiki' => array(
			'anon' => true,
		),
		'+test1wiki' => array(
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
		'+ubrwikiwiki' => array(
			'anon' => true,
			'user' => true,
			'editor' => true,
			'sysop' => true,
		),
		'+utamacrosswiki' => array(
			'anon' => true,
		),
		'+welcomewiki' => array(
			'anon' => true,
		),
		'+whentheycrywiki' => array(
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
		'wishwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+wikielectionwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
		),
		'+yoavfreundwiki' => array(
			'anon' => true,
			'user' => true,
			'sysop' => true,
			'editor' => true,
		),
		'+yokaiwatchwiki' => array(
			'anon' => true,
		),
		'+zhdelwiki' => array(
			'anon' => true,
			'user' => true,
		),
	),

	'wgPFEnableStringFunctions' => array(
		'default' => false,
		'realmgrinderwiki' => true,
	),

	'wgAllowSlowParserFunctions' => array(
		'default' => false,
		'cristianopediawiki' => true,
		'elarawiki' => true,
		'trexwiki' => true,
		'unionwiki' => true,
		'wiki1776wiki' => true,
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
	// Exempt from Robot Control (INDEX/NOINDEX namespaces)
 	'wgExemptFromUserRobotsControl' => array(
 		'default' => $wgContentNamespaces,
 		'thelonsdalebattalionwiki' => array(),
 	),

	// Extensions and Skins
	// AccessControl: due to security risks, use of this extension is at a wikis' calculated risk.
	// Prior to enabling the extension a bureaucrat should agree (on their own wiki)
	// that Miraheze is NOT responsible for any data leaks caused by this extension,
	// and that the wiki and elevated users are fully responsible for the usage of AccessControl.
//	'wmgUseAccessControl' => array(
//		'default' => false, // Do not enable! Causes errors with 1.29 --Reception123
//		'claneuphoriawiki' => true,
//		'test1wiki' => true,
//		'metaautonomywiki' => true,
//		'vanderbiltentwiki' => true,
//		'wisdomwikiwiki' => true,
//	),
	'wmgUseAddThis' => array(
		'default' => false,
		'christipediawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseAddHTMLMetaAndTitle' => array(
		'default' => false,
		'alwikiwiki' => true,
		'calexitwiki' => true,
		'r2wiki' => true,
		'test1wiki' => true,
		'undisclosedwiki' => true,
		'valentinaprojectwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseAdminLinks' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'developmentwiki' => true,
		'dongyangwiki' => true,
		'ferahistoriawiki' => true,
		'test1wiki' => true,
		'heistwiki' => true,
		'ircwiki' => true,
		'jayuwikiwiki' => true,
		'ndwiki' => true,
		'perpuswiki' => true,
		'pgnwikiwiki' => true,
		'podpediawiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'pruebawiki' => true,
		'shortwikiwiki' => true,
		'takethatwikiwiki' => true,
		'testwiki' => true,
		'thebbwiki' => true,
		'tochkiwiki' => true,
		'touhouenginewiki' => true,
		'yugiohwiki' => true,
	),
	'wmgUseAJAXPoll' => array(
		'default' => false,
		'bigforestwiki' => true,
		'test1wiki' => true,
		'inkubatorwiki' => true,
		'malaysiawiki' => true,
		'nationstateswiki' => true,
		'podpediawiki' => true,
		'shortwikiwiki' => true,
		'thebbwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseApex' => array(
		'default' => false,
		'dtswiki' => true,
		'test1wiki' => true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'thebbwiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseArticleFeedbackv5' => array(
		'default' => false,
		'fablabesdswiki' => true,
		'macfan4000wiki' => true,
		'test1wiki' => true,
	),
	'wmgUseArticleRatings' => array(
		'default' => false,
		'macfan4000wiki' => true,
		'test1wiki' => true,
	),
	'wmgUseArticleToCategory2' => array(
		'default' => false,
		'jayuwikiwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseAuthorProtect' => array(
		'default' => false,
		'ayrshirewiki' => true,
		'test1wiki' => true,
		'grandtheftwikiwiki' => true,
		'sthomaspriwiki' => true,
		'testauthorprotectwiki' => true,
		'trexwiki' => true,
	),
	'wmgUseAutoCreateCategoryPages' => array(
		'default' => false, // DO NOT enable on wikis that have more than 500 categories. See T1230
		'ayrshirewiki' => true,
		'test1wiki' => true,
		'knowledgewiki' => true,
		'magnaversewiki' => true,
		'nationstateswiki' => true,
	),
	'wmgUseBlogPage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'ircwiki' => true,
		'magnaversewiki' => true,
		'podpediawiki' => true,
		'thebbwiki' => true,
		'wikidolphinhansenwiki' => true,
	),
	'wmgUseBootstrapMediawiki' => array(
		'default' => false,
		'test1wiki' => true,
		'kstartupswiki' => true,
		'raymanspeedrunwiki' => true,
		'shortwikiwiki' => true,
	),
	'wmgUseMSCalendar' => array(
		'default' => false,
		'5awiki' => true,
		'aucelewiki' => true,
		'barbarasherwikiwiki' => true,
		'dtswiki' => true,
		'eyebobswiki' => true,
		'test1wiki' => true,
		'financialfindswiki' => true,
		'kozawiki' => true,
		'philmont126wiki' => true,
		'robertsnoteswiki' => true,
		'sterbalfamilyrecipeswiki' => true,
		'sterbalssundrystudieswiki' => true,
		'umodwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseCapiunto' => array(
		'default' => false,
		'civclassicwiki' => true,
		'modularwiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'templatewiki' => true,
		'test1wiki' => true,
	),
	'wmgUseCargo' => array(
		'default' => false,
		'bigtoewiki' => true,
		'machiningwiki' => true,
		'modularwiki' => true,		
		'scruffywiki' => true,
		'sdiywiki' => true,
		'templatewiki' => true,
		'test1wiki' => true,
	),
	'wmgUseCategoryTree' => array(
		'default' => true,
		'whentheycrywiki' => false,
	),
	'wmgUseCentralNotice' => array(
		'default' => false,
		'metawiki' => true,
	),
	'wmgUseCharInsert' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'anothertimeline2120wiki' => true,
		'bigforestwiki' => true,
		'brynda1231wiki' => true,
		'doinwiki' => true,
		'dtswiki' => true,
		'test1wiki' => true,
		'hantpediawiki' => true,
		'internetpediawiki' => true,
		'isvwiki' => true,
		'jawp2chwiki' => true,
		'jayuwikiwiki' => true,
		'jeongiwiki' => true,
		'maplewiki' => true,
		'modularwiki' => true,
		'newnamlawiki' => true,
		'oecumenewiki' => true,
		'particracywikiwiki' => true,
		'recentiawiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'studynotekrwiki' => true,
		'templatewiki' => true,		
		'viagroupiawiki' => true,
		'wikapediawiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseCollapsibleVector' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'harrypotterwiki' => true,		
		'test1wiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseComments' => array(
		'default' => false, // Sysop has 'commentadmin' by default
		'allthetropeswiki' => true,
		'animationmoviewikiwiki' => true,
		'appswiki' => true,
		'test1wiki' => true,
		'foodsharinghamburgwiki' => true,
		'ircwiki' => true,
		'jayuwikiwiki' => true,
		'macfan4000wiki' => true,
		'paddelnwiki' => true,
		'pgnwikiwiki' => true,
		'plazmaburstwiki' => true,
		'podpediawiki' => true,
		'priyowiki' => true,
		'puzzlewiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'takethatwikiwiki' => true,
		'thebbwiki' => true,
		'turbografx16wiki' => true,
		'wikidolphinhansenwiki' => true,
		'wikipucwiki' => true,
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
		'dongyangwiki' => true,
		'malaysiawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseCookieWarning' => array(
		'default' => false,
		'eerstelijnszoneswiki' => true,
		'test1wiki' => true,
		'pgnwikiwiki' => true,
	),
	'wmgUseCreatePage' => array(
		'default' => false,
		'alwikiwiki' => true,
		'ferahistoriawiki' => true,
		'showroomwiki' => true,
		'test1wiki' => true,
		'thebbwiki' => true,
		'twelvethfleetwiki' => true,
		'vanderbiltentwiki' => true,
	),
	'wmgUseCreateRedirect' => array(
		'default' => false,
		'calexitwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseCreateWiki' => array(
		'default' => false,
		'metawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseCrossReference' => array(
		'default' => false,
		'chocowiki' => true,
		'test1wiki' => true,
	),
	'wmgUseCSS' => array(
		'default' => false,
		'690squadronwiki' => true,
		'allthetropeswiki' => true,
		'arcticlandshelpwiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'dtswiki' => true,
		'firstroboticswikiwiki' => true,
		'test1wiki' => true,
		'knowledgewiki' => true,
		'macfan4000wiki' => true,
		'shortwikiwiki' => true,
		'takethatwikiwiki' => true,
	),
	'wmgUseCustomHeader' => array(
		'default' => false,
		'hlptestwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseDarkVector' => array(
		'default' => false,
		'test1wiki' => true,
		'girlsfrontlinewiki' => true,
		'grandtheftautowiki' => true,
		'shortwikiwiki' => true,
	),
	'wmgUseDismissableSiteNotice' => array(
		'default' => true,
	),
	'wmgUseDuskToDawn' => array(
		'default' => false,
		'test1wiki' => true,
		'ofthevampirewiki' => true,
	),
	'wmgUseDonateBoxInSidebar' => array( # Disabled for now --Rececption123
		'default' => false,
		'metawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseDPLForum' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
		'inkubatorwiki' => true,
		'isvwiki' => true,
		'rpgbrigadewiki' => true,
		'shortwikiwiki' => true,
		'thebbwiki' => true,
	),
	'wmgUseDuplicator' => array(
		'default' => false,
		'calexitwiki' => true,
		'test1wiki' => true,
		'foundationsofteachingwiki' => true,
	),
	'wmgUseDynamicPageList' => array( // DynamicPageList and DynamicPageList3 should NOT be enabled together; they do not work together
		'default' => false,
		'appswiki' => true,
		'bilgiwiki' => true,
		'heistwiki' => true,
		'hexelswiki' => true,
		'hydrawikiwiki' => true,
		'jcswiki' => true,
		'kstartupswiki' => true,
		'maccnycwiki' => true,
		'noalatalawiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'rpgbrigadewiki' => true,
		'sidemwiki' => true,
		'themirrorwiki' => true,
		'wikiletraswiki' => true,
		'wisdomwikiwiki' => true,
		'chocowiki' => true,
	),
	'wmgUseDynamicPageList3' => array( // DynamicPageList and DynamicPageList3 should NOT be enabled together; they do not work together
		'default' => false,
		'allthetropeswiki' => true,
		'ayrshirewiki' => true,
		'calexitwiki' => true,
		'poserdazfreebieswiki' => true,
		'showroomwiki' => true,
		'sthomaspriwiki' => true,
		'test1wiki' => true,
		'tmewiki' => true,
		'vandalismwikiwiki' => true,
	),
	'wmgUseEditcount' => array(
		'default' => false,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'appswiki' => true,
		'dongyangwiki' => true,
		'dtswiki' => true,
		'test1wiki' => true,
		'magnaversewiki' => true,
		'perpuswiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'shortwikiwiki' => true,
		'sthomaspriwiki' => true,
		'trexwiki' => true,
	),
	'wmgUseEditSubpages' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseEducationProgram' => array(
		'default' => false,
		'test1wiki' => true,
		'pruebawiki' => true,
		'tutorwiki' => true,
	),
	'wmgUseElectronPdfService' => array(
		'default' => false,
		'jcswiki' => true,
		'test1wiki' => true,
	),
	'wmgUseErudite' => array(
		'default' => false,
		'bdorpwiki' => true,
		'test1wiki' => true,
		'lunacyindwiki' => true,
	),
	'wmgUseEventLogging' => array(
		'default' => false,
		'test1wiki' => true,
		'isvwiki' => true,
	),
	'wmgUseFancyBoxThumbs' => array(
		'default' => false,
		'ayrshirewiki' => true,
		'bilgiwiki' => true,
		'eerstelijnszoneswiki' => true,
		'test1wiki' => true,
		'lgproduktsupportwiki' => true,
	),
	'wmgUseFeaturedFeeds' => array(
		'default' => false,
	),
	'wmgUseFlaggedRevs' => array(
		'default' => false,
		'bilgiwiki' => true,
		'test1wiki' => true,
		'infectopedwiki' => true,
		'isvwiki' => true,
		'pornganizerwiki' => true,
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
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'appswiki' => true,
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
		'earthianwiki' => true,
		'ernaehrungsrathhwiki' => true,
		'espiralwiki' => true,
		'fluxordevwiki' => true,
		'test1wiki' => true,
		'gepacobiodivwiki' => true,
		'grandtheftwikiwiki' => true,
		'grandtheftautowiki' => true,
		'idwwiki' => true,
		'infectopedwiki' => true,
		'ircwiki' => true,
		'kbrprojectwiki' => true,
		'kstartupswiki' => true,
		'literaturewiki' => true,
		'lzhscpwikiwiki' => true,
		'moziwiki' => true,
		'nenawikiwiki' => true,
		'nomicwiki' => true,
		'nationsglorywiki' => true,
		'nextlevelwikiwiki' => true,
		'nxwikiwiki' => true,
		'oecumenewiki' => true,
		'peopleshararamwiki' => true,
		'permanentfuturelabwiki' => true,
		'priyowiki' => true,
		'puzzlewiki' => true,
		'rswiki' => true,
		'rwsaleswiki' => true,
		'soshomophobiewiki' => true,
		'spiralwiki' => true,
		'sthomaspriwiki' => true,
		'takethatwikiwiki' => true,
		'touhouenginewiki' => true,
		'votingwiki' => true,
		'wisdomwikiwiki' => true,
		'wishcertwiki' => true,
		'yacresourceswiki' => true,
		'yeoksawiki' => true,
	),
	'wmgUseForeground' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'corydoctorowwiki' => true,
		'test1wiki' => true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'jayuwikiwiki' => true,
		'permanentfuturelabwiki' => true,
	),
	'wmgUseGamepress' => array(
		'default' => false,
		'claneuphoriawiki' => true,
		'test1wiki' => true,
		'karmazynxyz' => true,
	),
	'wmgUseGraph' => array(
		'default' => false,
		'appswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'jeongiwiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'shortwikiwiki' => true,
		'test1wiki' => true,
		'unionwiki' => true,
		'unionnorteamericanawiki' => true,
		'wiki1776wiki' => true,
	),
	'wmgUseGroupsSidebar' => array(
		'default' => false,
		'test1wiki' => true,
		'tedcswiki' => true,
	),
	'wmgUseGuidedTour' => array(
		'default' => false,
		'test1wiki' => true,
		'isvwiki' => true,
	),
	'wmgUseHAWelcome' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
		'ircwiki' => true,
		'pgnwikiwiki' => true,
	),
	// Be aware of https://www.mediawiki.org/wiki/Extension:Header_Tabs#Incompatible_extensions
	'wmgUseHeaderTabs' => array(
		'default' => false,
		'bdorpwiki' => true,
		'dtswiki' => true,
		'ferahistoriawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseHideSection' => array(
		'default' => false,
		'aktposwiki' => true,
		'allthetropeswiki' => true,
		'developmentwiki' => true,
		'test1wiki' => true,
		'hendrickswiki' => true,
	),
	'wmgUseHighlightLinksInCategory' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
	),
	'wmgUseImageMap' => array(
		'default' => false,
		'adnovumwiki' => true,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'bilgiwiki' => true,
		'civclassicwiki' => true,
		'creersonarbrewiki' => true,
		'doinwiki' => true,
		'dtswiki' => true,
		'esctwiki' => true,
		'ferahistoriawiki' => true,
		'test1wiki' => true,
		'garrettcountyguidewiki' => true,
		'hendrickswiki' => true,
		'jayuwikiwiki' => true,
		'magnaorbiswiki' => true,
		'pgnwikiwiki' => true,
		'qmswiki' => true,
		'sccwiki' => true,
		'shortwikiwiki' => true,
		'sthomaspriwiki' => true,
		'studynotekrwiki' => true,
		'takethatwikiwiki' => true,
		'tellestiawiki' => true,
		'tiandiwiki' => true,
		'tmewiki' => true,
		'travailcollaboratifwiki' => true,
		'unionwiki' => true,
		'unionnorteamericanawiki' => true,
		'vandalismwikiwiki' => true,
		'victorianrpwiki' => true,
		'whentheycrywiki' => true,
		'wiki1776wiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseJavascriptSlideshow' => array(
		'default' => false,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'jayuwikiwiki' => true,
		'jeongiwiki' => true,
		'plazmaburstwiki' => true,
		'shortwikiwiki' => true,
		'showroomwiki' => true,
		'takethatwikiwiki' => true,
		'tymyrddinwiki' => true,
	),
	'wmgUseJosa' => array(
		'default' => false,
		'test1wiki' => true,
		'reviwiki' => true,
		'reviwikiwiki' => true,
		'shortwikiwiki' => true,
	),
	'wmgUseLabeledSectionTransclusion' => array(
		'default' => false,
		'bpwiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'cristianopediawiki' => true,
		'madgendersciencewiki' => true,
		'test1wiki' => true,
		'sidemwiki' => true,
		'testwiki' => true,
		'tmewiki' => true,
		'unionwiki' => true,
		'unionnorteamericanawiki' => true,
		'vandalismwikiwiki' => true,
		'wiki1776wiki' => true,
	),
	'wmgUseLinkSuggest' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseLoginNotify' => array(
		'default' => false, 
		'loginwiki' => true,
		'metawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseLoopsCombo' => array( // Remember to remove from Variables if the wiki is enabled there
		'default' => false,
		'bigforestwiki' => true,
		'bgowiki' => true,
		'eotewiki' => true,
		'test1wiki' => true,
		'raymanspeedrunwiki' => true,
		'rpgbrigadewiki' => true,
		'shortwikiwiki' => true,
		'sysexwiki' => true,
		'teatraywiki' => true,
		'wixosswiki' => true,
	),
	'wmgUseMagicNoCache' => array(
		'default' => false,
		'test1wiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseMaps' => array(
		'default' => false,
		'aerosswiki' => true,
		'ayrshirewiki' => true,
		'bigforestwiki' => true,
		'bilgiwiki' => true,
		'calexitwiki' => true,
		'dongyangwiki' => true,
		'enmarchewiki' => true,
		'howtogettowiki' => true,
		'jacksonheightswiki' => true,
		'jayuwikiwiki' => true,
		'jwikiwiki' => true,
		'liesbornwikiwiki' => true,
		'magnaversewiki' => true,
		'noalatalawiki' => true,
		'shortwikiwiki' => true,
		'showroomwiki' => true,
		'speleowiki' => true,
		'takethatwikiwiki' => true,
		'test1wiki' => true,
		'thelonsdalebattalionwiki' => true,
		'tmewiki' => true,
		'unionnorteamericanawiki' => true,
		'vandalismwikiwiki' => true,
	),
	'wmgUseMassEditRegex' => array(
		'default' => false, // sysop is given permission 'masseditregex' by default
		'allthetropeswiki' => true,
		'appswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'cpiwiki' => true,
		'jayuwikiwiki' => true,
		'jeongiwiki' => true,
		'magezwiki' => true,
		'modularwiki' => true,		
		'podpediawiki' => true,
		'poserdazfreebieswiki' => true,
		'puzzlewiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'takethatwikiwiki' => true,
		'templatewiki' => true,		
		'test1wiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseMediaWikiChat' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'test1wiki' => true,
		'hasanistanwiki' => true,
		'ircwiki' => true,
		'macfan4000wiki' => true,
		'pgnwikiwiki' => true,
		'podpediawiki' => true,
		'thebbwiki' => true,
	),
	'wmgUseMetrolook' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'appswiki' => true,
		'ayrshirewiki' => true,
		'dtswiki'=> true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'ircwiki' => true,
		'microsoftwiki' => true,
		'pfsolutionswiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'test1wiki' => true,
		'thegreatwarwiki' => true,
		'thelonsdalebattalionwiki' => true,
	),
	'wmgUseMobileFrontend' => array(
		'default' => true,
		'carmeigatwiki' => false,
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
		'test1wiki' => true,
	),
	'wmgUseModernSkylight' => array(
		'default' => false,
		'test1wiki' => true,
		'jayuwikiwiki' => true,
	),
	'wmgUseMonaco' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
	),
	'wmgUseMsPackage' => array(
		'default' => false, // do not set this to false without disabling MsUpload on all wikis below
		'calexitwiki' => true,
		'test1wiki' => true,
	),
	// MsUpload is enabled on extloadwiki via MsPackage
	'wmgUseMsUpload' => array(
		'default' => false,
		'8stationwiki' => true,
		'adnovumwiki' => true,
		'aesbasewiki' => true,
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
		'cristianopediawiki' => true,		
		'doinwiki' => true,
		'emulationwiki' => true,
		'evawiki' => true,
		'exitsincwiki' => true,
		'garrettcountyguidewiki' => true,
		'healthvectorwiki' => true, 
		'hendrickswiki' => true,
		'hktransportpediawiki' => true,
		'izanagiwiki' => true,
		'jayuwikiwiki' => true,
		'jeongiwiki' => true,
		'knowledgewiki' => true,
		'lanstationwiki' => true,
		'lapoliticswiki' => true,
		'magnaversewiki' => true,
		'modularwiki' => true,		
		'nationstateswiki' => true,
		'nenawikiwiki' => true,
		'podpediawiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'revitwiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,	
		'shortwikiwiki' => true,
		'showmedicinawiki' => true,
		'sidemwiki' => true,
		'snowthegamewiki' => true,
		'speleowiki' => true,
		'thebbwiki' => true,
		'thelonsdalebattalionwiki' => true,
		'tmewiki' => true,
		'uncyclopediawiki' => true,
		'undisclosedwiki' => true,
		'unionwiki' => true,
		'unionnorteamericanawiki' => true,
		'utamacrosswiki' => true,
		'valentinaprojectwiki' => true,
		'vandalismwikiwiki' => true,
		'whentheycrywiki' => true,
		'wiki1776wiki' => true,
		'wisdomwikiwiki' => true,
		'wixosswiki' => true,
	),
	'wmgUseMultimediaViewer' => array(
		'default' => false,
		'aerosswiki' => true,
		'allthetropeswiki' => true,
		'attackontitanwiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'cristianopediawiki' => true,
		'test1wiki' => true,
		'inazumaelevenwiki' => true,
		'ircwiki' => true,
		'jayuwikiwiki' => true,
		'justinbieberwiki' => true,
		'knowledgewiki' => true,
		'lfwikiwiki' => true,
		'magnaversewiki' => true,
		'microsoftwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'nationstateswiki' => true,
		'pgnwikiwiki' => true,
		'rpgbrigadewiki' => true,
		'shortwikiwiki' => true,
		'speleowiki' => true,
		'sthomaspriwiki' => true,
		'takethatwikiwiki' => true,
		'thefosterswiki' => true,
		'thegreatwarwiki' => true,
		'thehushhushsagawiki' => true,
		'thelonsdalebattalionwiki' => true,
		'tmewiki' => true,
		'tokyoghoulwiki' => true,
		'unionwiki' => true,
		'unionnorteamericanawiki' => true,
		'whentheycrywiki' => true,
		'wiki1776wiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseMultiBoilerplate' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'chimaerawiki' => true,
		'test1wiki' => true,
		'poserdazfreebieswiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseNewestPages' => array(
		'default' => false,
		'appswiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'pfl2wiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'test1wiki' => true,
	),
	'wmgUseNews' => array(
		'default' => false,
		'cpiwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseNewSignupPage' => array(
		'default' => false,
		'nenawikiwiki' => true,
	),
	'wmgUseNewsletter' => array(
		'default' => false,
		'espiralwiki' => true,
		'test1wiki' => true,
		'ircwiki' => true,
	),
	'wmgUseNewUserMessage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'developmentwiki' => true,
		'test1wiki' => true,
		'ircwiki' => true,
		'perpuswiki' => true,
		'pgnwikiwiki' => true,
		'puzzlewiki' => true,
		'shortwikiwiki' => true,
		'takethatwikiwiki' => true,
		'thelonsdalebattalionwiki' => true,
		'trexwiki' => true,
		'tutorwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseNewUsersList' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
	),
	'wmgUseNostalgia' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseNoTitle' => array(
		'default' => false,
		'imperiuswiki' => true,
		'aktposwiki' => true,
		'alwikiwiki' => true,
		'civclassicwiki' => true,
		'developmentwiki' => true,
		'dtswiki' => true,
		'podpediawiki' => true,
		'test1wiki' => true,
		'hendrickswiki' => true,
		'rpgbrigadewiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseOpenGraphMeta' => array(
		'default' => false,
		'extloadwiki' => false, // Upstream issue. T1617. --Reception123
	),
	'wmgUsePagedTiffHandler' => array(
		'default' => false,
		'bpwiki' => true,
		'test1wiki' => true,
	),
	'wmgUsePageForms' => array(
		'default' => false,
		'bigtoewiki' => true,
		'scruffywiki' => true,
		'serinfhospwiki' => true,
		'test1wiki' => true,
	),
	'wmgUsePageNotice' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'ndwiki' => true,
		'sthomaspriwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUsePageTriage' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bgowiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'ndwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'sthomaspriwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUsePdfBook' => array( // Does not work when CustomNavBlocks is enabled! --Reception123
		'default' => false,
		'chocowiki' => true,
		'foundationsofteachingwiki' => true,
		'ncpprcwiki' => true,
		'nenawikiwiki' => true,
		'serinfhospwiki' => true,
		'test1wiki' => true,
	),
	'wmgUsePDFEmbed' => array(
		'default' => false,
		'calexitwiki' => true,
		'constwiki' => true,
		'test1wiki' => true,
		'frontdeskswiki' => true,
		'ggdrwiki' => true,
		'jacksonheightswiki' => true,
		'jcswiki' => true,
		'lgproduktsupportwiki' => true,
		'macfan4000wiki' => true,
		'machiningwiki' => true,
		'magnaversewiki' => true,
		'nextlevelwikiwiki' => true,
		'noalatalawiki' => true,
		'savagewikiwiki' => true,
		'speleowiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUsePdfHandler' => array(
		'default' => false,
		'690squadronwiki' => true,
		'apneuverenigingwiki' => true,
		'bigforestwiki' => true,
		'bpwiki' => true,
		'calexitwiki' => true,
		'constwiki' => true,
		'test1wiki' => true,
		'jayuwikiwiki' => true,
		'kstartupswiki' => true,
		'magnaversewiki' => true,
		'modularwiki' => true,		
		'noalatalawiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'undisclosedwiki' => true,
	),
	'wmgUsePopups' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'test1wiki' => true,
		'inazumaelevenwiki' => true,
		'jayuwikiwiki' => true,
		'justinbieberwiki' => true,
		'lfwikiwiki' => true,
		'nanatsunotaizaiwiki' => true,
		'pgnwikiwiki' => true,
		'shortwikiwiki' => true,
		'showroomwiki' => true,
		'takethatwikiwiki' => true,
		'thebbwiki' => true,
		'thefosterswiki' => true,
		'thegreatwarwiki' => true,
		'thehushhushsagawiki' => true,
		'tokyoghoulwiki' => true,
		'utamacrosswiki' => true,
		'votingwiki' => true,
		'wisdomwikiwiki' => true,
		'youtubewiki' => true,
	),
	'wmgUsePoll' => array(
		'default' => false,
		'alwikiwiki' => true,
		'bigforestwiki' => true,
		'test1wiki' => true,
		'jayuwikiwiki' => true,
		'malaysiawiki' => true,
		'pgnwikiwiki' => true,
		'shortwikiwiki' => true,
		'takethatwikiwiki' => true,
		'templatewiki' => true,				
		'thebbwiki' => true,
		'tutorwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseProofreadPage' => array(
		'default' => false,
		'bpwiki' => true,
		'test1wiki' => true,
		'kstartupswiki' => true,
	),
	'wmgUseProtectSite' => array(
		'default' => false,
		'barbarasherwikiwiki' => true,
		'calexitwiki' => true,
		'eerstelijnszoneswiki' => true,
		'financialfindswiki' => true,
		'test1wiki' => true,
		'harrypotterwiki' => true,		
		'hasanistanwiki' => true,
		'infectopedwiki' => true,
		'nationsglorywiki' => true,
		'podpediawiki' => true,
		'robertsnoteswiki' => true,
		'sqlserverwiki' => true,
		'sterbalfamilyrecipeswiki' => true,
		'sterbalssundrystudieswiki' => true,
		'sthomaspriwiki' => true,
		'thebbwiki' => true,
		'tnoteswiki' => true,
		'undisclosedwiki' => true,
	),
	'wmgUseQuiz' => array(
		'default' => false,
		'alwikiwiki' => true,
		'bigforestwiki' => true,
		'bilgiwiki' => true,
		'jayuwikiwiki' => true,
		'pruebawiki' => true,
		'shortwikiwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseQuizGame' => array(
		'default' => false,
		'dongyangwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseRandomSelection' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'appswiki' => true,
		'humorpediawiki' => true,
		'lingnlangwiki' => true,
		'madgendersciencewiki' => true,
		'newnamlawiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'rpgbrigadewiki' => true,
		'russiawatchwiki' => true,
		'takethatwikiwiki' => true,
		'shortwikiwiki' => true,
		'test1wiki' => true,
		'themirrorwiki' => true,
		'tmewiki' => true,
		'vandalismwikiwiki' => true,
	),
	'wmgUseRefreshed' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
		'grandtheftautowiki' => true,
		'inazumaelevenwiki' => true,
		'macfan4000wiki' => true,
	),
	'wmgUseRelatedArticles' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bilgiwiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'justinbieberwiki' => true,
		'lfwikiwiki' => true,
		'pgnwikiwiki' => true,
		'thehushhushsagawiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseReplaceText' => array(
		'default' => false,
		'bigforestwiki' => true,
		'bigtoewiki' => true,
		'calexitwiki' => true,
		'evawiki' => true,
		'garrettcountyguidewiki' => true,
		'jayuwikiwiki' => true,
		'jeongiwiki' => true,		
		'modularwiki' => true,		
		'podpediawiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'templatewiki' => true,				
		'test1wiki' => true,
		'thebbwiki' => true,
		'thelonsdalebattalionwiki' => true,
		'thegreatwarwiki' => true,
		'unionwiki' => true,
		'wiki1776wiki' => true,
	),
	'wmgUseRSS' => array(
		'default' => false,
		'emulationwiki' => true,
		'lgproduktsupportwiki' => true,
		'pfl2wiki' => true,
		'podpediawiki' => true,
		'speleowiki' => true,
		'test1wiki' => true,
		'tmewiki' => true,
		'tymyrddinwiki' => true,
		'vandalismwikiwiki' => true,
	),
	'wmgUseSandboxLink' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'appswiki' => true,
		'calexitwiki' => true,
		'garrettcountyguidewiki' => true,
		'test1wiki' => true,
		'idtestwiki' => true,
		'jawptestwiki' => true,
		'lfwikiwiki' => true,
		'modularwiki' => true,
		'nationstateswiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'templatewiki' => true,	
		'tmewiki' => true,
		'vandalismwikiwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseScore' => array(
		'default' => false,
		'garamwiki' => true,
		'music101wiki' => true,
		'test1wiki' => true,
	),
	'wmgUseScratchBlocks' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseShortURL' => array(
		'default' => true,
		'macfan4000wiki' => false,
	),
	'wmgUseSimpleChanges' => array(
		'default' => false,
		'christipediawiki' => true,
		'test1wiki' => true,
		'oecumenewiki' => true,
	),
	'wmgUseSimpleTooltip' => array(
		'default' => false,
		'8stationwiki' => true,
		'calexitwiki' => true,
		'cpiwiki' => true,
		'test1wiki' => true,
		'perpuswiki' => true,
		'trexwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseSiteScout' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
	),
	// Requires copying of two directories: https://www.mediawiki.org/wiki/Extension:SocialProfile#Directories
	// Should be this, but change $nameofwiki at the end:
	// sudo -u www-data cp -R /srv/mediawiki/w/extensions/SocialProfile/avatars /srv/mediawiki/w/extensions/SocialProfile/awards /mnt/mediawiki-static/$nameofwiki/
	'wmgUseSocialProfile' => array(
		'default' => false,
		'adnovumwiki' => true,
		'allthetropeswiki' => true,
		'appswiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'ircwiki' => true,
		'macfan4000wiki' => true,
		'micropediawiki' => true,
		'peopleshararamwiki' => true,
		'picardwiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'priyowiki' => true,
		'stellachronicawiki' => true,
		'takethatwikiwiki' => true,
		'thebbwiki' => true,
	),
	'wmgUseSpoilers' => array(
		'default' => false,
		'adventurewikiwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseSubpageFun' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseSubPageList3' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
	),
	'wmgUseSyntaxHighlight' => array(
		'default' => false,
		'alfrescowiki' => true,
		'allthetropeswiki' => true,
		'alwikiwiki' => true,
		'amaninfowiki' => true,
		'amicitiawiki' => true,
		'autocountwiki' => true,
		'bigforestwiki' => true,
		'cpudevwiki' => true,
		'detlefswiki' => true,
		'doinwiki' => true,
		'dtswiki' => true,
		'test1wiki' => true,
		'fluxordevwiki' => true,
		'gtnhwiki' => true,
		'hendrickswiki' => true,
		'integrawiki' => true,
		'isnstjustwiki' => true,
		'isvwiki' => true,
		'jawp2chwiki' => true,
		'jayuwikiwiki' => true,
		'jeongiwiki' => true,
		'karmazynxyz' => true,
		'liko12wiki' => true,
		'lizhongresearchwiki' => true,
		'metawiki' => true,
		'modularwiki' => true,
		'mpappaswiki' => true,
		'ndwiki' => true,
		'nextlevelwikiwiki' => true,
		'noalatalawiki' => true,
		'r2wiki' => true,
		'pascalscada' => true,
		'perpuswiki' => true,
		'priyowiki' => true,
		'programmingreferencewiki' => true,
		'proxybotwiki' => true,
		'pwikiwiki' => true,
		'raspberrywiki' => true,
		'reviwiki' => true,
		'reviwikiwiki' => true,
		'rswiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'showroomwiki' => true,
		'sizzlecookiewiki' => true,
		'slinxxywiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'sysexwiki' => true,
		'teatraywiki' => true,
		'templatewiki' => true,				
		'tmewiki' => true,
		'trexwiki' => true,
		'touhouenginewiki' => true,
		'turbografx16wiki' => true,
		'tutorwiki' => true,
		'valentinaprojectwiki' => true,
		'vandalismwikiwiki' => true,
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
		'ferahistoriawiki' => true,
		'hirapediawiki' => true,
		'jayuwikiwiki' => true,
		'knowledgewiki' => true,
		'lunacyindwiki' => true,
		'magezwiki' => true,
		'nationstateswiki' => true,
		'neptuniawikiwiki' => true,
		'thelonsdalebattalionwiki' => true,
		'russiawatchwiki' => true,
		'shortwikiwiki' => true,
		'sidemwiki' => true,
		'stellachronicawiki' => true,
		'takethatwikiwiki' => true,
		'test1wiki' => true,
		'tmewiki' => true,
		'vandalismwikiwiki' => true,
		'whentheycrywiki' => true,
		'youtauwiki' => true,
	),
	'wmgUseTemplateSandbox' => array(
		'default' => false,
		'bigforestwiki' => true,
		'isvwiki' => true,
		'jayuwikiwiki' => true,
		'modularwiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'templatewiki' => true,				
		'test1wiki' => true,
	),
	'wmgUseTheme' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'claneuphoriawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseTimedMediaHandler' => array(
		'default' => false,
		'arquivosdoprincipadowiki' => true,
		'bigforestwiki' => true,
		'corydoctorowwiki' => true,
		'enmarchewiki' => true,
		'geirpediawiki' => true,
		'indrikwiki' => true,
		'jayuwikiwiki' => true,
		'jeongiwiki' => true,
		'podpediawiki' => true,
		'shortwikiwiki' => true,
		'test1wiki' => true,
		'tymyrddinwiki' => true,
	),
	'wmgUseTimeless' => array(
		'default' => false,
		'corydoctorowwiki' => true,
		'cristianopediawiki' => true,		
		'grandtheftautowiki' => true,
		'test1wiki' => true,
	),
	'wmgUseTitleKey' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'test1wiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseTocTree' => array(
		'default' => false,
		'test1wiki' => true,
		'tedcswiki' => true,
	),
	'wmgUseTranslate' => array(
		'default' => false,
		'ayurbookswiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'cpiwiki' => true,
		'dishwiki' => true,
		'dongyangwiki' => true,
		'gontranwiki' => true,
		'guiaslocaiswiki' => true,
		'test1wiki' => true,
		'inazumaelevenwiki' => true,
		'ircwiki' => true,
		'jayuwikiwiki' => true,
		'macfan4000wiki' => true,
		'mc2wiki' => true,
		'metawiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'nanatsunotaizaiwiki' => true,
		'nvcwiki' => true,
		'r2wiki' => true,
		'pathfinderwiki' => true,
		'pgnwikiwiki' => true,
		'podpediawiki' => true,
		'rpgbrigadewiki' => true,
		'shortwikiwiki' => true,
		'spiralwiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'templatewiki' => true,		
		'testwiki' => true,
		'thehushhushsagawiki' => true,
		'tmewiki' => true,
		'tokyoghoulwiki' => true,
		'trexwiki' => true,
		'tutorwiki' => true,
		'tymyrddinwiki' => true,
		'valentinaprojectwiki' => true,
		'vandalismwikiwiki' => true,
		'welcomewiki' => true,
		'worlduniversityandschoolwiki' => true,
		'youtubewiki' => true,
	),
	'wmgUseTweeki' => array(
		'default' => false,
		'corydoctorowwiki' => true,
		'raymanspeedrunwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseUrlGetParameters' => array(
		'default' => false,
		'newnamlawiki' => true,
		'test1wiki' => true,
	),
	'wmgUseUserWelcome' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
	),
	'wmgUseVoteNY' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'espiralwiki' => true,
		'test1wiki' => true,
		'podpediawiki' => true,
		'wikidolphinhansenwiki' => true,
		'wikipucwiki' => true,
	),
	'wmgUseVisualEditor' => array(
		'default' => false, // Please make sure parsoid is enabled on the wiki in the parsoid.yaml file in the parsoid repo
		'690squadronwiki' => true,
		'8stationwiki' => true,
		'adnovumwiki' => true,
		'aerosswiki' => true,
		'aescapeswiki' => true,
		'ageofenlightenmentwiki' => true,
		'ageloniawiki' => true,
		'aidorupediawiki' => true,
		'airwiki' => true,
		'aktposwiki' => true,
		'algopediawiki' => true,
		'allthetropeswiki' => true,
		'alternatehistorywiki' => true,
		'alwikiwiki' => true,
		'animationmoviewikiwiki' => true,
		'apneuverenigingwiki' => true,
		'appswiki' => true,
		'arefepvawiki' => true,
		'artificercreationswiki' => true,
		'ayrshirewiki' => true,
		'ayurbookswiki' => true,
		'attackontitanwiki' => true,
		'balcanopediascharlatanicawiki' => true,
		'bchwiki' => true,
		'bgowiki' => true,
		'betapurplewiki' => true,
		'bettermediawiki' => true,
		'betternewswiki' => true,
		'biblicalwikiwiki' => true,
		'bibliowiki' => true,
		'bigforestwiki' => true,
		'bpawiki' => true,
		'braindumpwiki' => true,
		'breedersofthenephelymwiki' => true,
		'brxdwiki' => true,
		'bunker401wiki' => true,
		'brynda1231wiki' => true,
		'byblopediawiki' => true,
		'calexitwiki' => true,
		'calibrowiki' => true,
		'cancerwiki' => true,
		'cantorijwiki' => true,
		'carelliwiki' => true,
		'carmeigatwiki' => true,
		'casuarinawiki' => true,
		'cdcwiki' => true,
		'cccpwiki' => true,
		'changemyorgwiki' => true,
		'chimaerawiki' => true,
		'christipediawiki' => true,
		'cristianopediawiki' => true,		
		'civitaswiki' => true,
		'clonedeploywiki' => true,
		'cnvwiki' => true,
		'cogitopediewiki' => true,
		'coldbloodedwiki' => true,
		'conquestofparadiserpwiki' => true,
		'corydoctorowwiki' => true,
		'csnimsbordeauxwiki' => true,
		'cybersecuritywiki' => true,
		'dalarwiki' => true,
		'detlefswiki' => true,
		'developmentwiki' => true,
		'dicficwiki' => true,
		'didaprowiki' => true,
		'dishwiki' => true,
		'doinwiki' => true,
		'drones4allwiki' => true,
		'dtswiki' => true,
		'dwplivewiki' => true,
		'earthianwiki' => true,
		'easterwiki' => true,
		'edmundwiki' => true,
		'eerstelijnszoneswiki' => true,
		'ellersliedemowiki' => true,
		'ernaehrungsrathhwiki' => true,
		'espiralwiki' => true,
		'etpowiki' => true,
		'evawiki' => true,
		'eyebobswiki' => true,
		'test1wiki' => true,
		'fablabesdswiki' => true,
		'fantasiawiki' => true,
		'feuwiki' => true,
		'fgnoteswiki' => true,
		'fikcyjnatvwiki' => true,
		'fmbvwiki' => true,
		'foodsharinghamburgwiki' => true,
		'freeandopenwiki' => true,
		'freestateofjoneswiki' => true,
		'frejaerikssonwiki' => true,
		'ferahistoriawiki' => true,
		'frontdeskswiki' => true,
		'fsxworldspainwiki' => true,
		'gameonwiki' => true,
		'geirpediawiki' => true,
		'generalistprogramwiki' => true,
		'generationsbamorowiki' => true,
		'geresbamyanwiki' => true,
		'genwiki' => true,
		'gepacobiodivwiki' => true,
		'gontranwiki' => true,
		'grandtheftwikiwiki' => true,
		'grandtheftautowiki' => true,
		'grdarchivewiki' => true,
		'gtnhwiki' => true,
		'gzewiki' => true,
		'hamfemwiki' => true,
		'harrypotterwiki' => true,
		'healthvectorwiki' => true,
		'historiaalternativawiki' => true,
		'hjelpemidlerwiki' => true,
		'hktransportpediawiki' => true,
		'hlptestwiki' => true,
		'hobbieswiki' => true,
		'hsoodenwiki' => true,
		'hytecwiki' => true,
		'icmscholarswiki' => true,
		'idwwiki' => true,
		'inazumaelevenwiki' => true,
		'indrikwiki' => true,
		'inebriationconfederationwiki' => true,
		'infectopedwiki' => true,
		'innovwikiprotowiki' => true,
		'ipolywiki' => true,
		'ircwiki' => true,
		'isvwiki' => true,
		'iwnwiki' => true,
		'izanagiwiki' => true,
		'jayuwikiwiki' => true,
		'jcswiki' => true,
		'jeongiwiki' => true,
		'justinbieberwiki' => true,
		'kaiwiki' => true,
		'karmazynxyzwiki' => true,
		'kassaiwiki' => true,
		'karniarutheniawiki' => true,
		'kbrprojectwiki' => true,
		'kevincwiki' => true,
		'kgbwiki' => true,
		'kinderacicwiki' => true,
		'knowledgewiki' => true,
		'kozawiki' => true,
		'krebswiki' => true,
		'kstartupswiki' => true,
		'lambdawarswiki' => true,
		'lapoliticswiki' => true,
		'lfwikiwiki' => true,
		'lingnlangwiki' => true,
		'lovelivewiki' => true,
		'lunfengwiki' => true,
		'maccnycwiki' => true,
		'macfan4000wiki' => true,
		'magezwiki' => true,
		'magnaversewiki' => true,
		'maiasongcontestwiki' => true,
		'malaysiawiki' => true,
		'marinebiodiversitymatrix' => true,
		'marioserieswikiwiki' => true,
		'make717wiki' => true,
		'maktabawiki' => true,
		'medergistswiki' => true,
		'medicinawiki' => true,
		'medlabisowiki' => true,
		'meregoswiki' => true,
		'metawiki' => true,
		'mikeandchrisproductionswiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'miningpromieswiki' => true,
		'modelshipreferencewiki' => true,
		'modularwiki' => true,
		'musicarchivewiki' => true,
		'mustafar29wiki' => true,
		'mynyddwiki' => true,
		'n2gowiki' => true,
		'nanatsunotaizaiwiki' => true,
		'nationstateswiki' => true,
		'ndwiki' => true,
		'nenawikiwiki' => true,
		'neuromotorwiki' => true,
		'newarkmanorwiki' => true,
		'newcolumbiawiki' => true,
		'newknowledgewiki' => true,
		'nextlevelwikiwiki' => true,
		'noalatalawiki' => true,
		'nonbinarywiki' => true,
		'novayawiki' => true,
		'nvcwiki' => true,
		'nxwikiwiki' => true,
		'nychousingwikiwiki' => true,
		'oecumenewiki' => true,
		'ofthevampirewiki' => true,
		'oncprojectwiki' => true,
		'oolawikiwiki' => true,
		'opengovpioneerswiki' => true,
		'opmiwiki' => true,
		'ourmxfestwiki' => true,
		'overonwiki' => true,
		'paodeaodawiki' => true,
		'r2wiki' => true,
		'patch153wiki' => true,
		'peopleshararamwiki' => true,
		'permanentfuturelabwiki' => true,
		'petctviewerwiki' => true,
		'pfsolutionswiki' => true,
		'pgnwikiwiki' => true,
		'plasticssongcontestwiki' => true,
		'plnonbinarywiki' => true,
		'pmavwiki' => true,		
		'podpediawiki' => true,
		'politicswiki' => true,
		'puzzlewiki' => true,
		'priyowiki' => true,
		'pruebawiki' => true,
		'pso2wiki' => true,
		'pwikiwiki' => true,
		'pythiawiki' => true,
		'raspberrywiki' => true,
		'rawdatawiki' => true,
		'raymanspeedrunwiki' => true,
		'revitwiki' => true,
		'rigpapariswiki' => true,
		'rootsandlimbswiki' => true,
		'rwdvolvowiki' => true,
		'rwsaleswiki' => true,
		'safiriawiki' => true,
		'saharinspacewiki' => true,
		'sapienswiki' => true,
		'savagewikiwiki' => true,
		'scruffywiki' => true,
		'schicksalswikiwiki' => true,
		'sdiywiki' => true,
		'seawiki' => true,
		'seldirwiki' => true,
		'serinfhospwiki' => true,
		'setonwiki' => true,
		'shippingandmetawiki' => true,
		'shortwikiwiki' => true,
		'showmedicinawiki' => true,
		'sidemwiki' => true,
		'simonjonwiki' => true,
		'sirikotwiki' => true,
		'snowthegamewiki' => true,
		'socrateswiki' => true,
		'songcontestswiki' => true,
		'soshomophobiewiki' => true,
		'southparkfanwiki' => true,
		'spiralwiki' => true,
		'spritopiawiki' => true,
		'stellachronicawiki' => true,
		'sthomaspriwiki' => true,
		'stjarnfestivalenwiki' => true,
		'studynotekrwiki' => true,
		'summerolympicswiki' => true,
		'tagwiki' => true,
		'takethatwikiwiki' => true,
		'techeducationwiki' => true,
		'templatewiki' => true,				
		'tekkenwiki' => true,
		'teleswikiwiki' => true,
		'teriawiki' => true,
		'testwiki' => true,
		'testarkclswiki' => true,
		'thebbwiki' => true,
		'thecscwiki' => true,
		'thefosterswiki' => true,
		'thehushhushsagawiki' => true,
		'theworldwiki' => true,
		'titaniawiki' => true,
		'tmewiki' => true,
		'tnoteswiki' => true,
		'tochkiwiki' => true,
		'tocgamingprojectwiki' => true,
		'tokyoghoulwiki' => true,
		'toppsdigitalcardtraderwiki' => true,
		'torejorgwiki' => true,
		'touhouenginewiki' => true,
		'trablangwiki' => true,
		'trexwiki' => true,
		'triseptsolutionswiki' => true,
		'trumpwiki' => true,
		'trwcwiki' => true,
		'tsponiewiki' => true,
		'twswiki' => true,
		'tymyrddinwiki' => true,
		'ubrwikiwiki' => true,
		'uoluwiki' => true,
		'undisclosedwiki' => true,
		'unionwiki' => true,
		'unionnorteamericanawiki' => true,
		'unowiki' => true,
		'ussewiki' => true,
		'valentinaprojectwiki' => true,
		'vandalismwikiwiki' => true,
		'vanderbiltentwiki' => true,
		'vgalimentiwiki' => true,
		'viagroupiawiki' => true,
		'vicprojectwiki' => true,
		'victorianrpwiki' => true,
		'vilemaximwiki' => true,
		'volleyballwiki' => true,
		'votingwiki' => true,
		'wabcwiki' => true,
		'whsapushwiki' => true,
		'wiki1776wiki' => true,
		'wikidolphinhansenwiki' => true,
		'wikiescolawiki' => true,
		'wikinicuswiki' => true,
		'wikipucwiki' => true,
		'wisdomwikiwiki' => true,
		'wishcertwiki' => true,
		'wishwiki' => true,
		'wustlnsgywiki' => true,
		'xdjibiwiki' => true,
		'xjtluwiki' => true,
		'yeoksawiki' => true,
		'ylscwiki' => true,
		'yourosongcontestwiki' => true,
		'yourtechnicalservicewiki' => true,
		'youtubewiki' => true,
		'chocowiki' => true,
		'zendariwiki' => true,
		'zitabiteswiki' => true,
		'zharkunuwiki' => true,
	),
	'wmgUseVariables' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'ayrshirewiki' => true,
		'bgowiki' => true,
		'bilgiwiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'eotewiki' => true,
		'takethatwikiwiki' => true,
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
		'aemanualwiki' => true,
		'amaninfowiki' => true,
		'appswiki' => true,
		'ayrshirewiki' => true,
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'embobadawiki' => true,
		'geodatawiki' => true,
		'gtnhwiki' => true,
		'harrypotterwiki' => true,
		'modularwiki' => true,
		'nationsglorywiki' => true,
		'plazmaburstwiki' => true,
		'podpediawiki' => true,
		'puzzlewiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'soshomophobiewiki' => true,
		'takethatwikiwiki' => true,
		'templatewiki' => true,				
		'test1wiki' => true,
		'thecscwiki' => true,
		'wikipucwiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUseWikibaseRepository' => array(
		'default' => false,
		'ayurbookswiki' => true,
		'beminwiki' => true,
		'bilgiwiki' => true,
		'gontranwiki' => true,
		'maiasongcontestwiki' => true,
		'reviwbwiki' => true,
		'test1wiki' => true,
		'vukufwiki' => true,
	),
	'wmgUseWikiForum' => array(
		'default' => false,
		'alwikiwiki' => true,
		'entropediawiki' => true,
		'grandtheftautowiki' => true,
	  	'knowledgewiki' => true,
		'indexwiki' => true,
		'ircwiki' => true,
		'macfan4000wiki' => true,
		'peopleshararamwiki' => true,
		'picardwiki' => true,
		'podpediawiki' => true,
		'stellachronicawiki' => true,
		'test1wiki' => true,
		'wisdomwikiwiki' => true,
	),
	'wmgUsewikihiero' => array(
		'default' => false,
		'test1wiki' => true,
	),
	'wmgUseWikiLove' => array(
		'default' => false,
		'appswiki' => true,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'corydoctorowwiki' => true,
		'macfan4000wiki' => true,
		'test1wiki' => true,
		'pgnwikiwiki' => true,
		'podpediawiki' => true,
		'proxybotwiki' => true,
		'pruebawiki' => true,
		'puzzlewiki' => true,
		'tmewiki' => true,
		'vandalismwikiwiki' => true,
	),
	'wmgUseWikiTextLoggedInOut' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'calexitwiki' => true,
		'test1wiki' => true,
		'pgnwikiwiki' => true,
	),
	'wmgUseYouTube' => array(
		'default' => false,
		'aesbasewiki' => true,
		'airwiki' => true,
		'allthetropeswiki' => true,
		'aktposwiki' => true,
		'animationmoviewikiwiki' => true,
		'appswiki' => true,
		'bigforestwiki' => true,
		'bilgiwiki' => true,
		'biuwiki' => true,
		'bunker401wiki' => true,
		'calexitwiki' => true,
		'christipediawiki' => true,
		'corydoctorowwiki' => true,
		'developmentwiki' => true,
		'doinwiki' => true,
		'doraemonpediawiki' => true,
		'dwplivewiki' => true,
		'enmarchewiki' => true,
		'evawiki' => true,
		'test1wiki' => true,
		'freecollegeprojectwiki' => true,
		'geirpediawiki' => true,
		'geodatawiki' => true,
		'hantpediawiki' => true,
		'hktransportpediawiki' => true,
		'inazumaelevenwiki' => true,
		'internetpediawiki' => true,
		'izanagiwiki' => true,
		'jayuwikiwiki' => true,
		'jcswiki' => true,
		'jeongiwiki' => true,
		'knowledgewiki' => true,
		'lifewiki' => true,
		'lexiquewiki' => true,
		'madgendersciencewiki' => true,
		'mikrodevwiki' => true,
		'mikrodevdocswiki' => true,
		'miraewiki' => true,
		'modularwiki' => true,
		'n2gowiki' => true,
		'noalatalawiki' => true,
		'ontariobrasswiki' => true,
		'opengovpioneerswiki' => true,
		'openonderwijswiki' => true,
		'pfl2wiki' => true,
		'pgnwikiwiki' => true,
		'plazmaburstwiki' => true,
		'podpediawiki' => true,
		'priyowiki' => true,
		'puzzlewiki' => true,
		'pwikiwiki' => true,
		'rpgbrigadewiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'sthomaspriwiki' => true,
		'takethatwikiwiki' => true,
		'testwiki' => true,
		'thebbwiki' => true,
		'thelonsdalebattalionwiki' => true,
		'tmewiki' => true,
		'uncyclopediawiki' => true,
		'valentinaprojectwiki' => true,
		'vandalismwikiwiki' => true,
		'wikapediawiki' => true,
		'wikiletraswiki' => true,
		'wikipucwiki' => true,
		'wisdomwikiwiki' => true,
		'wishwiki' => true,
		'worldpediawiki' => true,
		'yacresourceswiki' => true,
		'youtauwiki' => true,
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
	),

	// Allow HTML <img> tag
	'wgAllowImageTag' => array(
		'default' => false,
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
		'nonbinarywiki' => true,
	),
	'wgCopyUploadsFromSpecialUpload' => array(
		'default' => false,
		'entropediawiki' => true,
		'macfan4000wiki' => true,
		'ndwiki' => true,
	),
	'wgFileExtensions' => array(
		'default' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu' ),
		'+amaninfowiki' => array('pcap', 'cap' ),
		'+bigforestwiki' => array( 'apng', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'doc', 'docx', 'txt', 'rtf', 'htm', 'html', 'xml', 'ppt', 'pptx' ),
		'+csnimsbordeauxwiki' => array( 'docx', 'xlsx', 'pptx', 'pub', 'xps', 'odt', 'ods', 'odp', 'odg', 'otg', 'rar', 'tar', 'gz', 'gz2', 'bz', 'bz2', 'zip', 'ipe', 'dia', 'svg', 'bib', 'add', 'spl', 'cls', 'tex', 'bst', 'sh', 'bat', 'gp', 'dat', 'fig', 'sty', 'py', 'cpp', 'hpp', 'hxx', 'c', 'h', 'mat', 'txt', 'desktop', 'md', 'perf', 'plot', 'data', 'xml', 'html', 'alist' ),
		'+doinwiki' => array('pdf', 'ppt', 'pptx', 'xls', 'xlxs', 'zip' ),
		'+exercicesdefrancaisprodfrwiki' => array('html', 'htm' ),
		'+exitsincwiki' => array('txt' ),
		'+indrikwiki' => array('mp3', 'mus', 'mid' ),
		'+jayuwikiwiki' => array('bmp', 'apng', 'tiff', 'wav', 'mp3', 'oga', 'ogv', 'asv', 'swf', 'wmv'),
		'+jcswiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'ppt', 'pptx', 'bmp', 'tiff', 'avi', 'mov', 'mp3', 'mp4', 'wma', 'swf', 'zip'),
		'+modularwiki' => array('mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv'),
		'+pculsdwiki' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu', 'mp3', 'wma', 'mp4', 'zip', 'rar', 'xlsx', 'ppt', 'docx', 'doc'),
		'+pfl2wiki' => array('rar' ),
		'+podpediawiki' => array('mp3', 'zip'),
		'+qmswiki' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip'),
		'+scruffywiki' => array('mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv'),
		'+sdiywiki' => array('mid', 'mp3', 'flac', 'fpd', 'oga', 'ogv'),
		'+serinfhospwiki' => array( 'pdf', 'zip' ),
		'+showroomwiki' => array( 'png', 'gif', 'jpg', 'jpeg', 'doc', 'xls', 'pdf', 'ppt', 'tiff', 'bmp', 'docx', 'xlsx', 'pptx'),
		'+techeducationwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'ppt', 'xls', 'xlsx','xml'),
		'+themirrorwiki' => array( 'mp3'),
		'+tmewiki' => array('tiff', 'tif', 'webp', 'xcf', 'mid', 'ogv', 'oga', 'flac', 'opus', 'wav', 'webm'),
		'+valentinaprojectwiki' => array( 'val', 'vit', 'vst'),
		'+vandalismwikiwiki' => array('tiff', 'tif', 'webp', 'xcf', 'mid', 'ogv', 'oga', 'flac', 'opus', 'wav', 'webm'),
		'+wisdomwikiwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx', 'txt', 'rtf', 'zip'),
	),
	'wgUseInstantCommons' => array(
		'default' => true,
		'amaninfowiki' => false,
		'jcswiki' => false,
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
	'wgVerifyMimeType' => array(
		'default' => true,
		'jcswiki' => false,
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
		'adiaprojectwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'ashinawiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'coldbloodedwiki' => 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-sa.png',
		'cpudevwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'diavwiki' => "//$wmgUploadHostname/diavwiki/f/fc/Copyrighted_Content.png",
		'espiralwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'ildrilwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'japanjayuwikiwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'jawp2chwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'jayuvandalwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'jcswiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'kstartupswiki' => 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png',
		'libertywikiwiki' => 'http://creativecommons.org.nz/wp-content/uploads/2012/05/by-nc-sa1.png',
		'lothuialethwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'lymernilwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'revitwiki' => "//$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
		'rezeroswiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'safiriawiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png',
		'schnellbildungwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'spiralwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'wisdomwikiwiki' => 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png',
	),
	'wgRightsPage' => array(
		'default' => '',
		'developmentwiki' => 'Official:Copyrights',
		'diavwiki' => 'Project:Copyrights',
		'kstartupswiki' => 'Project:저작권',
		'wisdomwikiwiki' => 'Copyleft',
	),
	'wgRightsText' => array(
		'default' => 'Creative Commons Attribution Share Alike',
		'adiaprojectwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'ashinawiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported',
		'coldbloodedwiki' => '크리에이티브 커먼즈 저작자표시-동일조건변경허락 4.0 국제 라이선스',
		'cpudevwiki' => 'CC0 Public Domain',
		'diavwiki' => 'All Rights Reserved',
		'espiralwiki' => 'CC0 Public Domain',
		'gamdugwiki' => 'Attribution-NonCommercial 3.0 Australia',
		'humorpediawiki' => 'Creative Commons Attribution-ShareAlike 4.0 International License',
		'ildrilwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'japanjayuwikiwiki' => 'Creative Commons Attribution Share Alike',
		'jawp2chwiki' => 'CC0 Public Domain',
		'jayuvandalwiki' => 'Creative Commons Attribution Share Alike',
		'jcswiki' => 'CC0 Public Domain',
		'kstartupswiki' => '크리에이티브 커먼즈 저작자표시-비영리-변경금지 4.0 국제 라이선스',
		'libertywikiwiki' => 'Attribution-NonCommercial-ShareAlike 3.0 Unported',
		'lothuialethwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'lymernilwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'revitwiki' => '©2013-2018 by Lionel J. Camara (All Rights Reserved)',
		'rezeroswiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'safiriawiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'schnellbildungwiki' => 'CC0 Public Domain',
		'spiralwiki' => 'CC0 Public Domain',
		'tmewiki' => 'Creative Commons Attribution-ShareAlike 4.0 International License',
		'vandalismwikiwiki' => 'Creative Commons Attribution-ShareAlike 4.0 International License',
		'wisdomwikiwiki' => 'Creative Commons Attribution-NonCommercial-NoDerivatives',
	),
	'wgRightsUrl' => array(
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/',
		'adiaprojectwiki' => 'https://creativecommons.org/licenses/by-nc-sa/3.0/',
		'ashinawiki' => 'https://creativecommons.org/licenses/by-nc-sa/3.0/',
		'bigforestwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'coldbloodedwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/deed.ko',
		'cpudevwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'espiralwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'gamdugwiki' => 'https://creativecommons.org/licenses/by-nc/3.0/au/',
		'humorpediawiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'ildrilwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'japanjayuwikiwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'jawp2chwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/deed.ja',
		'jayuvandalwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'jayuwikiwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'jcswiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'kstartupswiki' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/deed.ko',
		'libertywikiwiki' => 'https://creativecommons.org/licenses/by-nc-sa/3.0/',
		'mapinfowiki' => 'https://creativecommons.org/licenses/by/4.0/',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwikiwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr/',
		'rezeroswiki' => 'https://creativecommons.org/licenses/by-nc-sa/2.0/',
		'safiriawiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'schnellbildungwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'spiralwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'lothuialethwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'lymernilwiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'tmewiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'ujhswiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'unjeongwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'vandalismwikiwiki' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'wisdomwikiwiki' => 'https://creativecommons.org/licenses/by-nc-nd/4.0/',
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
		'harrypotterwiki' => 'headmaster',		
		'lcars47wiki' => 'manager',
		'metawiki' => 'wikicreator',
		'pruebawiki' => 'consul',
		'sau226wiki' => 'consul',		
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
	
	// MirahezeMagic
	// https://meta.miraheze.org/wiki/Dormancy_Policy/Exceptions and https://meta.miraheze.org/wiki/Dormancy_Policy/Exemptions
	'wgFindInactiveWikisWhitelist' => array(
		'default' => array(
			// Exceptions
			'conductwiki',
			'cvtwiki',
			'metawiki', 
			'staffwiki',
			'loginwiki',
			// Exemptions
			'allthetropeswiki',
			'biblicalwikiwiki',
			'bitcoindebateswiki',
			'bpwiki',
			'cvtwiki',
			'dditecwiki',
			'geomasterywiki',
			'lexiquewiki',
			'modularwiki',
			'newarkmanorwiki',
			'nissanecuwiki',
			'noalatalawiki',
			'proxybotwiki',
			'reviwiki',
			'reviwikiwiki',
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
			'unionnorteamericanawiki',
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
	'wgCapitalLinks' => array(
		'default' => true,
		'dicowiki' => false,
	),

	// MobileFrontend
	'wmgMFAutodetectMobileView' => array(
		'default' => true,
		'trexwiki' => false,
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
		'default' => 'wgEmergencyContact',
		'sdiywiki' => 'admin@sdiy.info',
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
		'bigforestwiki' => true,
		'calexitwiki' => true,
		'jayuwikiwiki' => true,
		'modularwiki' => true,
		'scruffywiki' => true,
		'sdiywiki' => true,
		'shortwikiwiki' => true,
		'showmedicinawiki' => true,
		'wixosswiki' => true,
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
		'casuarinawiki' => array(
			NS_LIBRARY => '圖書館',
			NS_LIBRARY_TALK => '圖書討論',
		),
		'claneuphoriawiki' => array(
			NS_CLAN => 'Clan',
			NS_CLAN_TALK => 'Clan_talk',
		),
		'cristianopediawiki' => array(
			NS_TEMA => 'Tema',
			NS_TEMA_TALK => 'Tema discusión',
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
		'unionwiki' => array(
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
			NS_BUG => 'Bug',
			NS_BUG_TALK => 'Bug_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
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
		'wiki1776wiki' => array(
			NS_TEST => 'Prueba',
			NS_TEST_TALK => 'Prueba_discusión',
			NS_PAGE => 'Página',
			NS_PAGE_TALK => 'Página_discusión',
			NS_ANEXO => 'Anexo',
			NS_ANEXO_TALK => 'Anexo_discusión',
			NS_ESTUDIO => 'Estudio',
			NS_ESTUDIO_TALK => 'Estudio_discusión',
			NS_REGISTRO => 'Registro',
			NS_REGISTRO_TALK => 'Registro_discusión',
			NS_LISTA => 'Lista',
			NS_LISTA_TALK => 'Lista_discusión',
			NS_BUG => 'Bug',
			NS_BUG_TALK => 'Bug_discusión',
			NS_PROYECTO => 'Proyecto',
			NS_PROYECTO_TALK => 'Proyecto_discusión',
			NS_TALLER => 'Taller',
			NS_TALLER_TALK => 'Taller_discusión',
			NS_MODELO => 'Modelo',
			NS_MODELO_TALK => 'Modelo_discusión',
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
		'+calexitwiki' => array( NS_OPINION, NS_TIMELINE, NS_HISTORICAL_TIMELINE ),
		'+reviwiki' => array( NS_SERVER ),
		'+safiriawiki' => array( NS_HOENN ),
		'+tmewiki' => array( NS_CALL_OF_DUTY, NS_MINECRAFT, NS_SUPER_MARIO_LAND_2, NS_SUPER_MARIO_WORLD_2, NS_SUPER_MARIO_BROS, NS_SUPER_MARIO_ADVANCE, NS_SUPER_MARIO_ADVANCE_2, NS_SUPER_MARIO_ADVANCE_3, NS_SUPER_MARIO_ADVANCE_4, NS_THE_LEGEND_OF_ZELDA, NS_CIVILIZATION_IV, NS_GAME, NS_IDEA, NS_TIMELINE ),
	        '+unionwiki' => array( NS_ANEXO ),
		'+wiki1776wiki' => array( NS_ANEXO ),
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
		'+picardwiki' => array(
			'NS_USER_PROFILE' => 'Benutzerprofil',
			'NS_USER_PROFILE_TALK' => 'Benutzerprofil Diskussion',
		),
		'+proxybotwiki' => array(
			'UT' => NS_USER_TALK,
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
		'+isvwiki' => array(
			// Forum talk
			111 => array(
				'editinterface'
			),
		),
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
		'+wiki1776wiki' => array(
			NS_MAIN => true,
			NS_TEST => true,
			NS_PAGE => true,
		),
		'+wisdomwikiwiki' => array(
			NS_MAIN => true,
			NS_LCS => true,
			NS_LIBRARY => true,
			NS_TEACHING => true,
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
		'+animationmoviewikiwiki' => array(
			'sysop' => array(
				'commentadmin',
			),
		),
		'+autocountwiki' => array(
			'sysop' => array(
				'authors',
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
		'+dditecwiki' => array(
			'sysop' => array(
				'member',
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
		'+earthianwiki' => array(
			'sysop' => array(
				'Citizen',
			),
		),
		'+harrypotterwiki' => array(
			'headmaster' => array(
				'bureaucrat',
				'sysop',
				'autopatrolled',
				'confirmed',
				'rollbacker',
			),
			'sysop' => array(
				'widgeteditor'
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
		'+kyivstarwiki' => array(
			'sysop' => array(
				'extendedconfirmed',
			),
		),
		'+infectopedwiki' => array(
			'bureaucrat' => array(
				'reviewer' => true,
			),
		),
		'lcars47wiki' => array(
			'bureaucrat' => array(
				'sysop',
				'bot',				
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
			'sysop' => array(
				'autopatrolled',
				'confirmed',
				'rollbacker',
			),			
			'devteam' => array(
				'bot',
				'bureaucrat',
				'devteam',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
			'manager' => array(
				'bot',
				'bureaucrat',
				'devteam',
				'manager',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),			
		),
		'+macfan4000wiki' => array(
			'sysop' => array(
				'commentadmin',
				'staff',
				'reviewer',
				'chatmod',
			),
		),
		'+madgendersciencewiki' => array(
			'sysop' => array(
				'scholar',
			),
		),
		'+metawiki' => array(
			'sysop' => array(
				'translator',
				'translationadmin',
			),
		),
		'+nenawikiwiki' => array(
			'sysop' => array(
				'editor',
				'nenamembers',
			),
		),
		'+nonbinarywiki' => array(
			'sysop' => array(
				'uploader',
			),
		),
		'+podpediawiki' => array(
			'sysop' => array(
				'commentadmin',
			),
		),			
		'+sau226wiki' => array(
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
		'+sdiywiki' => array(
			'sysop' => array(
				'moderator',
				'automoderated',
			),
		),		
		'+serinfhospwiki' => array(
			'sysop' => array(
				'SupportStaff',
				'SalesStaff',
				'PreSalesStaff',
			),
		),
		'+ssptopwiki' => array(
			'sysop' => array(
				'read-only',
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
		'+snowthegamewiki' => array(
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
				'autoconfirmed' => true,
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
		'+allthetropeswiki' => array(
			'sysop' => array(
				'editothersprofiles' => true,
			),
		),
		'+autocountwiki' => array(
			'user' => array(
				'createtalk' => true,
			),
			'authors' => array(
				'changetags' => true,
				'applychangetags' => true,
				'torunblocked' => true,
				'createtalk' => true,
				'createpage' => true,
				'edit' => true,
				'editcontentmodel' => true,
				'minoredit' => true,
				'move-categorypages' => true,
				'move-rootuserpages' => true,
				'movefile' => true,
				'move' => true,
				'move-subpages' => true,
				'reupload-shared' => true,
				'reupload' => true,
				'purge' => true,
				'read' => true,
				'sendemail' => true,
				'upload' => true,
				'writeapi' => true,
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
		'+cpiwiki' => array(
			'sysop' => array(
				'masseditregex'
			),
		),
		'+dditecwiki' => array(
			'member' => array(
				'createtalk' => true,
				'createpage' => true,
				'edit' => true,
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
		'+earthianwiki' => array(
			'Citizen' => array(
				'edit' => true,
			),
		),
		'+harrypotterwiki' => array(
			'headmaster' => array(
				'protectsite' => true,
				'abusefilter-modify-restricted' => true,				
			),
		),		
		'+hasanistanwiki' => array(
			'user' => array(
				'chat' => true,
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
		'+jacksonheightswiki' => array(
			'emailconfirmed' => array(
				'read' => true,
				'edit' => true,
				'createpage' => true,
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
		'+kyivstarwiki' => array(
			'sysop' => array(
				'extendedconfirmed' => true,
			),
			'autopatrolled' => array(
				'extendedconfirmed' => true,
			),
			'bot' => array(
				'extendedconfirmed' => true,
			),
		),
		'+lcars47wiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
				'nuke' => true,
				'editinterface' => true,
				'globalblock-whitelist' => true,
			),
			'devteam' => array(
				'abusefilter-modify-restricted' => true,
				'bureaucrat' => true,
				'devteam' => true,
				'editinterface' => true,
				'read' => true,
			),
			'manager' => array(
				'abusefilter-modify' => true,
				'abusefilter-modify-restricted' => true,				
			),
		),
		'+macfan4000wiki' => array(
			'user' => array(
				'upload_by_url' => true,
			),
		),
		'+madgendersciencewiki' => array(
			'scholar' => array(
				'editprotected' => true,
			),
		),
		'+marinebiodiversitymatrixwiki' => array(
			'member' => array(
				'createtalk' => true,
				'createpage' => true,
				'edit' => true,
			),
		),
		'+metawiki' => array(
			'abuse' => array(
				'centralauth-lock' => true,
				'globalblock' => true,
				'managewiki' => true,
				'managewiki-restricted' => true,
				'noratelimit' => true,
				'userrights' => true,
				'userrights-interwiki' => true,
			),
			'autoconfirmed' => array(
				'move' => true,
				'createpage' => true,
				'translate' => true,
			),
			'confirmed' => array(
				'move' => true,
				'createpage' => true,
				'translate' => true,
			),
			'cvt' => array(
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'globalblock' => true,
			),
			'proxybot' => array(
				'editprotected' => true,
				'globalblock' => true,
				'block' => true,
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
			'translator' => array(
				'translate' => true,
			),
			'translationadmin' => array(
				'pagelang' => true,
				'pagetranslation' => true,
				'translate-import' => true,
				'translate-manage' => true,
			),
			'wikicreator' => array(
				'createwiki' => true,
			),
		),
		'+nenawikiwiki' => array(
			'editor' => array(
				'createpage' => true,
				'edit' => true,
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
			'nenamembers' => array(
				'createtalk' => true,
				'edit' => true,
				'edit-talkpages' => true,
			),
			'sysop' => array(
				'edit-content-pages' => true,
				'edit-admin-pages' => true,
				'moderation' => true,
			),
			'emailconfirmed' => array(
				'read' => true,
			),
		),
		'+nonbinarywiki' => array(
			'uploader' => array(
				'upload_by_url' => true,
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
		'+pythiawiki' => array(
			'bureaucrat' => array(
				'edit' => true,
				'createpage' => true,
			),
		),
				
		'+sau226wiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
				'nuke' => true,
				'editinterface' => true,
				'globalblock-whitelist' => true,
			),
			'consul' => array(
				'abusefilter-modify-restricted' => true,
				'bureaucrat' => true,
				'consul' => true,
				'editinterface' => true,
				'read' => true,
			),
			'testgroup' => array(
				'read' => true,
			),
		),
		'+sdiywiki' => array(
			'sysop' => array(
				'moderation' => true,
			),
			'moderator' => array(
				'moderation', // Allow moderator to use Special:Moderation
				'automoderated', // Allow moderator to assign/remove "automoderated" flag
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
				'edit' => true,
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
				'abusefilter-modify-restricted' => true,
				'bureaucrat' => true,
				'consul' => true,
				'editinterface' => true,
				'read' => true,
			),
			'testgroup' => array(
				'read' => true,
			),
		),
		'thebbwiki' => array(
			'sysop' => array(
				'commentadmin' => true,
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
		'+whentheycrywiki' => array(
			'user' => array(
				'createtalk',
				'edit-create',
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
		'+zhdelwiki' => array(
			'confirmed' => array(
				'createpage' => true,
				'edit' => true,
				'move' => true,
				'upload' => true,
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
		'+autocountwiki' => array(
			'sysop' => array(
				'authors',
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
		'+dditecwiki' => array(
			'sysop' => array(
				'member',
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
		'+earthianwiki' => array(
			'sysop' => array(
				'Citizen',
			),
		),
		'+harrypotterwiki' => array(
			'headmaster' => array(
				'bureaucrat',
				'sysop',
				'autopatrolled',
				'confirmed',
				'rollbacker',
			),
			'sysop' => array(
				'widgeteditor'
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
		'+kyivstarwiki' => array(
			'sysop' => array(
				'extendedconfirmed',
			),
		),
		'+infectopedwiki' => array(
			'bureaucrat' => array(
				'reviewer' => true,
			),
		),
		'lcars47wiki' => array(
			'bureaucrat' => array(
				'sysop',
				'bot',				
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
			'sysop' => array(
				'autopatrolled',
				'confirmed',
				'rollbacker',
			),			
			'devteam' => array(
				'bot',
				'bureaucrat',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),
			'manager' => array(
				'bot',
				'bureaucrat',
				'devteam',
				'sysop',
				'confirmed',
				'autopatrolled',
				'rollbacker',
			),			
		),
		'+macfan4000wiki' => array(
			'sysop' => array(
				'commentadmin',
				'staff',
				'reviewer',
				'chatmod',
			),
		),
		'+madgendersciencewiki' => array(
			'sysop' => array(
				'scholar',
			),
		),
		'+metawiki' => array(
			'sysop'	=> array(
				'translator',
				'translationadmin',
			),
		),
		'+nenawikiwiki' => array(
			'sysop' => array(
				'editor',
				'nenamembers',
			),
		),
		'+nonbinarywiki' => array(
			'sysop' => array(
				'uploader',
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
		'+sau226wiki' => array(
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
		'+sdiywiki' => array(
			'sysop' => array(
				'moderator',
				'automoderated',				
			),
		),		
		'+serinfhospwiki' => array(
			'sysop' => array(
				'SupportStaff',
				'SalesStaff',
				'PreSalesStaff',
			),
		),
		'+ssptopwiki' => array(
			'sysop' => array(
				'read-only',
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
		'+sycwiki' => array(
			'bureaucrat' => array(
				'bureaucrat',
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
		'ssptopwiki' => array(
			'read-only' => array(
				'edit' => true,
			),
		),
		'testwiki' => array(
			'sysop' => array(
				# 'nuke' => true, // done in overrides at end of file
				# 'editinterface' => true, //mistakenly applies to other groups as well
			),
		),
		'zhdelwiki' => array(
			'autoconfirmed' => array(
				'editsemiprotected' => true,
				'autoconfirmed' => true,
				'skipcaptcha' => true,
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
		'+jacksonheightswiki' => array(
			'emailconfirmed' => array(
				APCOND_EMAILCONFIRMED,
			),
		),
		'+kyivstarwiki' => array(
			'extendedconfirmed' => array(
				array( APCOND_EDITCOUNT, 500),
				array( APCOND_AGE, 30 * 86400 ),
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

	// RateLimits
	'+wgRateLimits' => array(
		'default' => array(),
		'metawiki' => array(
			'requestwiki' => array(
				'user' => array( 1, 3600 ),
			),
		),
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
		'+kyivstarwiki' => array(
			'extendedconfirmed',
		),
		'+lcars47wiki' => array(
			'bureaucrat',
			'devteam',
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
	),

	'+wgRestrictionTypes' => array(
		'default' => array(
			'delete',
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
	),

	// Robot policy
	'wgDefaultRobotPolicy' => array(
		'default' => 'index,follow',
		'foodsharinghamburgwiki' => 'noindex,nofollow',
		'ildrilwiki' => 'noindex,nofollow',
		'librewiki' => 'noindex,nofollow',
		'lothuialethwiki' => 'noindex,nofollow',
		'paddelnwiki' => 'noindex,nofollow',
		'reviwikiwiki' => 'noindex,nofollow',
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

	// Site notice opt out
	'wmgSiteNoticeOptOut' => array(
		'default' => false,
		'nenawikiwiki' => true,
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
		'adadevelopersacademywiki' => 'https://adadevelopersacademy.wiki',
		'allthetropeswiki' => 'https://allthetropes.org',
		'alwikiwiki' => 'https://www.alwiki.net',
		'amaninfowiki' => 'https://aman.info.tm',
		'ameciclowiki' => 'https://wiki.ameciclo.org',
		'antiguabarbudacalypsowiki' => 'https://antiguabarbudacalypso.com',
		'athenapediawiki' => 'https://athenapedia.org',
		'autocountwiki' => 'https://wiki.autocountsoft.com',
		'b1teswiki' => 'https://b1tes.org',
		'bconnectedwiki' => 'https://bconnected.aidanmarkham.com',
		'bpwiki' => 'https://bebaskanpengetahuan.org',
		'ciptamediawiki' => 'https://wiki.ciptamedia.org',
		'clonedeploywiki' => 'https://wiki.clonedeploy.org',
		'consentcraftwiki' => 'https://wiki.consentcraft.uk',
		'dariawikiwiki' => 'https://dariawiki.org',
		'disabledlifewiki' => 'https://disabled.life',
		'drones4allwiki' => 'https://wiki.drones4nature.info',
		'dwplivewiki' => 'https://wiki.dwplive.com',
		'eerstelijnszoneswiki' => 'https://www.eerstelijnszones.be',
		'embobadawiki' => 'https://embobada.com',
		'espiralwiki' => 'https://espiral.org',
		'exnihilolinux' => 'https://wiki.exnihilolinux.org',
		'feuwiki' => 'https://froggy.info',
		'fikcyjnatvwiki' => 'https://fikcyjnatv.pl',
		'garrettcountyguidewiki' => 'https://garrettcountyguide.com',
		'grottocenterwiki' => 'https://wiki.grottocenter.org',
		'iceposeidonwiki' => 'https://www.iceposeidonwiki.com',
		'inebriationconfederationwiki' => 'https://wiki.inebriation-confederation.com',
		'itiswiki' => 'https://wiki.ldmsys.net',
		'jacksonheightswiki' => 'https://wiki.jacksonheights.nyc',
		'jcswiki' => 'https://wiki.gesamtschule-nordkirchen.de',
		'karagashwiki' => 'https://karagash.info',
		'kourouklideswiki' => 'https://wiki.kourouklides.com',
		'kstartupswiki' => 'https://wiki.besuccess.com',
		'kunwokwiki' => 'https://kunwok.org',
		'lab612wiki' => 'https://www.lab612.at',
		'lodgejsnydrwiki' => 'https://lodge.jsnydr.com',
		'lostminecraftminerswiki' => 'https://wiki.lostminecraftminers.org',
		'maccnycwiki' => 'https://wiki.macc.nyc',
		'madgendersciencewiki' => 'https://madgenderscience.wiki',
		'make717wiki' => 'https://wiki.make717.org',
		'marinebiodiversitymatrixwiki' => 'https://marinebiodiversitymatrix.org',
		'meeusenwiki' => 'https://wiki.meeusen.net',
		'meregoswiki' => 'https://meregos.com',
		'morfarkultenwiki' => 'https://morfarkulten.tk',
		'nenawikiwiki' => 'https://nenawiki.org',
		'nerdwiki' => 'https://wiki.gamergeeked.us',
		'nextlevelwikiwiki' => 'https://wiki.lbcomms.co.za',
		'nonbinarywiki' => 'https://nonbinary.wiki',
		'oecumenewiki' => 'https://oecumene.org',
		'openonderwijswiki' => 'https://www.openonderwijs.org',
		'papeloriowiki' => 'https://papelor.io',
		'penalwikiwiki' => 'https://penalwiki.awiki.org',
		'permanentfuturelabwiki' => 'https://permanentfuturelab.wiki',
		'plnonbinarywiki' => 'https://pl.nonbinary.wiki',
		'podpediawiki' => 'https://podpedia.org',
		'programmingredwiki' => 'https://programming.red',
		'pruebawiki' => 'https://es.publictestwiki.com',
		'pwikiwiki' => 'https://pwiki.arkcls.com',
		'testwiki' => 'https://publictestwiki.com',
		'tulpawiki' => 'https://wiki.tulpa.info',
		'reviwiki' => 'https://private.revi.wiki',
		'reviwbwiki' => 'https://wikibase.revi.wiki',
		'reviwikiwiki' => 'https://reviwiki.info',
		'savagewikiwiki' => 'https://savage-wiki.com',
		'savetawiki' => 'https://saveta.org',
		'sdiywiki' => 'https://sdiy.info',
		'speleowiki' => 'https://speleo.wiki',
		'spiralwiki' => 'https://spiral.wiki',
		'splatteamswiki' => 'https://www.splat-teams.com',
		'staravesnowiki' => 'https://wiki.staraves-no.cz',
		'takethatwikiwiki' => 'https://takethatwiki.com',
		'teamwizardrywiki' => 'https://wiki.teamwizardry.com',
		'teessidehackspacewiki' => 'https://wiki.teessidehackspace.org.uk',
		'tensorflowlearningwiki' => 'https://wiki.tensorflow.community',
		'thelonsdalebattalionwiki' => 'https://thelonsdalebattalion.co.uk',
		'valentinaprojectwiki' => 'https://wiki.valentinaproject.org',
		'wikiescolawiki' => 'https://wikiescola.com.br',
		'wikipucwiki' => 'https://wikipuk.cl',
		'wisdomwikiwiki' => 'https://wisdomwiki.org',
		'wishcertwiki' => 'https://histories.wiki',
		'worlduniversityandschoolwiki' => 'https://wiki.worlduniversityandschool.org',
		'zenbuddhismwiki' => 'https://www.zenbuddhism.info',
		'zymonicwiki' => 'https://wiki.zymonic.com',
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
			'81.4.109.133:81' // cp4
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
		'jawp2chwiki' => "//$wmgUploadHostname/jawp2chwiki/2/27/Jawp2ch_apple-touch-icon.png",
		'jcswiki' => "//$wmgUploadHostname/jcswiki/5/5b/Jcs_app.png",
		'kstartupswiki' => "//$wmgUploadHostname/kstartupswiki/6/64/Favicon.ico",
		'revitwiki' => "//$wmgUploadHostname/https://static.miraheze.org/revitwiki/4/43/Apple-touch-icon.png",
	),
	'wgCentralAuthLoginIcon' => array(
		'default' => '/usr/share/nginx/favicons/default.ico',
	),
	'wgDefaultSkin' => array(
		'default' => 'vector',
		'appswiki' => 'metrolook',
		'bdorpwiki' => 'erudite',
		'claneuphoriawiki' => 'gamepress',
		'corydoctorowwiki' => 'timeless',
		'cristianopediawiki' => 'timeless',		
		'dtswiki' => 'metrolook',
		'girlsfrontlinewiki' => 'darkvector',
		'godaigowiki' => 'monobook',
		'macfan4000wiki' => 'refreshed',
		'ofthevampirewiki' => 'dusktodawn',
		'ontariobrasswiki' => 'monobook',
		'pculsdwiki' => 'monobook',
		'permanentfuturelabwiki' => 'foreground',
		'pfsolutionswiki' => 'metrolook',
		'podpediawiki' => 'metrolook',
		'puzzlewiki' => 'metrolook',
		'raymanspeedrunwiki' => 'bootstrapmediawiki',
		'revitwiki' => 'vector',
		'thebbwiki' => 'apex',
		'thegreatwarwiki' => 'metrolook',
		'thelonsdalebattalionwiki' => 'metrolook',
	),
	'wgFavicon' => array(
		'default' => '/favicon.ico',
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/6/64/Favicon.ico",
		'absurdopediawiki' => "//$wmgUploadHostname/absurdopediawiki/6/64/Favicon.ico",
		'adadevelopersacademywiki' => "//$wmgUploadHostname/adadevelopersacademywiki/4/43/Ada_favicon.ico",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/b/be/APfavicon.png",
		'adiaprojectwiki' => "//$wmgUploadHostname/adiaprojectwiki/9/91/Adiafavicon.png",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/8/84/Rainbowstar.png",
		'aenasanwiki' => "//$wmgUploadHostname/aenasanwiki/e/e6/AEfav.ico",
		'aidorupediawiki' => "//$wmgUploadHostname/aidorupediawiki/3/33/Idolsonawikiico.png",
		'alternatehistorywiki' => "//$wmgUploadHostname/alternatehistorywiki/6/64/Favicon.ico",
		'alwikiwiki' => "//$wmgUploadHostname/alwikiwiki/5/59/ALWikiFavicon.ico",
		'amaninfowiki' => "//$wmgUploadHostname/amaninfowiki/6/64/Favicon.ico",
		'amicitiawiki' => "//$wmgUploadHostname/amicitiawiki/5/5b/Amicitia_favicon.svg",
		'animationmoviewikiwiki' => "//$wmgUploadHostname/animationmoviewikiwiki/7/7f/Favicon-20170311123705233.ico",
		'anothertimeline2120wiki' => "//$wmgUploadHostname/anothertimeline2120wiki/6/64/Favicon.ico",
		'apellidosmurcianoswiki' => "//$wmgUploadHostname/apellidosmurcianoswiki/2/26/Favicon.png",
		'assaultandroidcactuswiki' => "//$wmgUploadHostname/assaultandroidcactuswiki/6/64/Favicon.ico",
		'bchwiki' => "//$wmgUploadHostname/bchwiki/c/c0/Logo_135.png",
		'bdorpwiki' => "//$wmgUploadHostname/bdorpwiki/3/3b/Favicongif.gif",
		'beminwiki' => "//$wmgUploadHostname/beminwiki/1/15/BeminFavicon.png",
		'betapurplewiki' => "//$wmgUploadHostname/betapurplewiki/6/64/Favicon.ico",
		'bgowiki' => "//$wmgUploadHostname/bgowiki/6/64/Favicon.ico",
		'bigforestwiki' => "//$wmgUploadHostname/bigforestwiki/d/d2/Favicon_SeongJjinDoe_v2.png",
		'bpawiki' => "//$wmgUploadHostname/bpawiki/c/c5/Favicon-16x16.png",
		'calexitwiki' => "//$wmgUploadHostname/calexitwiki/6/6a/Cali_flag_favicon.ico",
		'calibrowiki' => "//$wmgUploadHostname/calibrowiki/c/c5/Favicon-16x16.png",
		'cdcwiki' => "//$wmgUploadHostname/cdcwiki/c/c3/Cd_ts_button_24.png",
		'changemyorgwiki' => "//$wmgUploadHostname/changemyorgwiki/6/64/Favicon.ico",
		'christipediawiki' => "//$wmgUploadHostname/christipediawiki/e/e7/Logo_Christipedia.jpg",
		'civclassicwiki' => "//$wmgUploadHostname/civclassicwiki/f/fe/CivLogo.png",
		'cristianopediawiki' => "//$wmgUploadHostname/cristianopediawiki/2/23/Biblia_y_cruz.svg",
		'claneuphoriawiki' => "//$wmgUploadHostname/claneuphoriawiki/6/64/Favicon.ico",
		'cnvwiki' => "//$wmgUploadHostname/cnvwiki/6/64/Favicon.ico",
		'coldbloodedwiki' => "//$wmgUploadHostname/coldbloodedwiki/6/64/Favicon.ico",
		'constancywiki' => "//$wmgUploadHostname/constancywiki/8/89/Faviconconstancy.gif",
		'cosiadventurewiki' => "//$wmgUploadHostname/cosiadventurewiki/3/3b/Wiki_logo.png",
		'crankipediawiki' => "//$wmgUploadHostname/crankipediawiki/4/4c/Crankilogo.png",
 		'cristianopediawiki' => "//$wmgUploadHostname/cristianopediawiki/2/23/Biblia_y_cruz.svg",		
		'diavwiki' => "//$wmgUploadHostname/diavwiki/6/64/Favicon.ico",
		'dditecwiki' => "//$wmgUploadHostname/dditecwiki/8/87/Ddu_logo.png",
		'doinwiki' => "//$wmgUploadHostname/doinwiki/6/64/Favicon.ico",
		'drones4allwiki' => "//$wmgUploadHostname/drones4allwiki/2/26/Favicon.png",
		'dwplivewiki' => "//$wmgUploadHostname/dwplivewiki/6/64/Favicon.ico",
		'eerstelijnszoneswiki' => "//$wmgUploadHostname/eerstelijnszoneswiki/6/64/Favicon.ico",
		'emulationwiki' => "//$wmgUploadHostname/emulationwiki/6/60/Wiki_favicon.png",
		'encyclopaedicawiki' => "//$wmgUploadHostname/encyclopaedicawiki/e/e0/Favicon_new.png",
		'enmarchewiki' => "//$wmgUploadHostname/enmarchewiki/d/d8/LogoEM32x32transparency.png",
		'etpowiki' => "//$wmgUploadHostname/etpowiki/1/1f/FaviconETPO.gif",
		'evawiki' => "//$wmgUploadHostname/evawiki/6/64/Favicon.ico",
		'fefoxtttwiki' => "//$wmgUploadHostname/fefoxtttwiki/d/d7/NewIcon.jpg",
		'feuwiki' => "//$wmgUploadHostname/feuwiki/6/64/Favicon.ico",
		'fmbvwiki' => "//$wmgUploadHostname/fmbvwiki/0/06/Fmbvfavicon.png",
		'forexwiki' => "//$wmgUploadHostname/forexwiki/6/64/Favicon.ico",
		'freecollegeprojectwiki' => "//$wmgUploadHostname/freecollegeprojectwiki/1/18/FreeCollegeProject.ico",
		'freestateofjoneswiki' => "//$wmgUploadHostname/freestateofjoneswiki/d/d4/Free_State_of_Jones_Seal.png",
		'genwiki' => "//$wmgUploadHostname/genwiki/6/64/Favicon.ico",
		'geodatawiki' => "//$wmgUploadHostname/geodatawiki/6/64/Favicon.ico",
		'girlsfrontlinewiki' => "//$wmgUploadHostname/girlsfrontlinewiki/2/2d/GirlsFrontline_logo-16px.jpg",
		'grandtheftautowiki' => "//$wmgUploadHostname/grandtheftautowiki/c/c7/GrandTheftAutoFavicon.png",
		'grottocenterwiki' => "//$wmgUploadHostname/grottocenterwiki/6/64/Favicon.ico",
		'guiaslocaiswiki' => "//$wmgUploadHostname/guiaslocaiswiki/d/d7/Wiki.jpeg",
		'hamfemwiki' => "//$wmgUploadHostname/hamfemwiki/c/c5/Favicon-16x16.png",
		'hamimwiki' => "//$wmgUploadHostname/hamimwiki/6/64/Favicon.ico",
		'harrypotterwiki' => "//$wmgUploadHostname/harrypotterwiki/b/b5/TheHarryPotterWikiFavicon.png",
		'hktransportpediawiki' => "//$wmgUploadHostname/hktransportpediawiki/e/ee/Favicon-20170319060448889.ico",
		'holycrosswiki' => "//$wmgUploadHostname/holycrosswiki/8/84/Anchor_Cross.png",
		'honkai3rdwiki' => "//$wmgUploadHostname/honkai3rdwiki/a/a6/Ai_Favicon.png",
		'houseofettlingarfreyuwiki' => "//$wmgUploadHostname/houseofettlingarfreyuwiki/7/70/Shield_Arms_House_Ettlingar_Freyu.png",
		'humorpediawiki' => "//$wmgUploadHostname/humorpediawiki/6/64/Favicon.ico",
		'icmscholarswiki' => "//$wmgUploadHostname/icmscholarswiki/6/69/Logo135px.png",
		'icterwiki' => "//$wmgUploadHostname/icterwiki/4/43/Icter.png",
		'idwwiki' => "//$wmgUploadHostname/idwwiki/0/0d/Idw.favicon.png",
		'imperiuswiki' => "//$wmgUploadHostname/imperiuswiki/b/b2/ImperiusFavicon.ico",
		'isvwiki' => "//$wmgUploadHostname/isvwiki/5/53/Med%C5%BEuviki-favicon.ico",
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/3/35/Favicon_%282%29.ico",
		'jacksonheightswiki' => "//$wmgUploadHostname/jacksonheightswiki/0/0d/JH-wiki-2.ico",
		'jadtechwiki' => "//$wmgUploadHostname/jadtechwiki/4/46/WikiFavicon.ico",
		'jawp2chwiki' => "//$wmgUploadHostname/jawp2chwiki/f/f4/Jawp2ch_favicon.ico",
		'jcswiki' => "//$wmgUploadHostname/jcswiki/2/2e/JCS-Wiki.png",
		'karniarutheniawiki' => "//$wmgUploadHostname/karniarutheniawiki/1/17/Krlogo.png",
		'kkandpwiki' => "//$wmgUploadHostname/kkandpwiki/c/ca/Favicon1-1024x1024.png",
		'korczakwiki' => "//$wmgUploadHostname/korczakwiki/2/2a/Korczak_ikona.ico",
		'kstartupswiki' => "//$wmgUploadHostname/kstartupswiki/6/64/Favicon.ico",
		'kunwokwiki' => "//$wmgUploadHostname/kunwokwiki/6/64/Favicon.ico",
		'lanstationwiki' => "//$wmgUploadHostname//lanstationwiki/9/9b/Miniianfav.png",
		'lavoniawiki' => "//$wmgUploadHostname/lavoniawiki/4/44/Universo_Lavônia_-_Favicon.png",
		'leftypolwiki' => "//$wmgUploadHostname//leftypolwiki/d/d5/Red_flag.gif",
		'lexiquewiki' => "//$wmgUploadHostname/lexiquewiki/0/0f/Lexique_favicon.ico",
		'lfwikiwiki' => "//$wmgUploadHostname/lfwikiwiki/1/1a/5lFgOTZ.png",
		'liko12wiki' => "//$wmgUploadHostname/liko12wiki/b/b3/Wiki-Favicon.png",
		'lingnlangwiki' => "//$wmgUploadHostname/lingnlangwiki/7/7e/Fav.ico",
		'logalnetwiki' => "//$wmgUploadHostname/logalnetwiki/2/26/Favicon.png",
		'lovesgreatadventurewiki' => "//$wmgUploadHostname/lovesgreatadventurewiki/5/53/Shield_High_Realm2.png",
		'maccnycwiki' => "//$wmgUploadHostname/maccnycwiki/3/3f/MACC_Logo.png",
		'madgendersciencewiki' => "//$wmgUploadHostname/madgendersciencewiki/0/01/Mgsfavicon.png",
		'nationsglorywiki' => "//$wmgUploadHostname/nationsglorywiki/0/04/NationsGlory.png",
		'nenawikiwiki' => "//$wmgUploadHostname/nenawikiwiki/f/fa/Nena911orange.ico",
		'newcolumbiawiki' => "//$wmgUploadHostname/newcolumbiawiki/5/5b/Wiki-favicon.png",
		'nonbinarywiki' => "//$wmgUploadHostname/nonbinarywiki/5/53/Wikiicon.ico",
		'nutscriptwiki' => "//$wmgUploadHostname/nutscriptwiki/6/64/Favicon.ico",
		'nxwikiwiki' => "//$wmgUploadHostname/nxwikiwiki/9/9b/Nxlogo.png",
		'thoughtonomywikiwiki' => "//$wmgUploadHostname/thoughtonomywikiwiki/2/26/Favicon.png",
		'oecumenewiki' => "//$wmgUploadHostname/oecumenewiki/6/64/Favicon.ico",
		'omniversaliswiki' => "//$wmgUploadHostname/omniversaliswiki/d/db/Omniversalis_Icon.ico",
		'opendominionwiki' => "//$wmgUploadHostname/opendominionwiki/9/90/OpenDominionFavicon.ico",
		'openonderwijswiki' => "//$wmgUploadHostname/openonderwijswiki/c/ca/Ooo_logo_square_favicon.svg",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'openkorebrasilwikiwiki' => "//$wmgUploadHostname/openkorebrasilwikiwiki/3/35/WikiLogo.png",
		'ordiswiki' => "//$wmgUploadHostname/ordiswiki/0/04/OE_Logo_favicon.png",
		'ortuswiki' => "//$wmgUploadHostname/ortuswiki/7/77/Ortus_favicon.png",
		'overonwiki' => "//$wmgUploadHostname/overonwiki/2/2e/Overon_Logo.svg",
		'paranormalwiki' => "//$wmgUploadHostname/paranormalwiki/2/2d/PW.ico",
		'particracywikiwiki' => "//$wmgUploadHostname/particracywikiwiki/6/64/Favicon.ico",
		'r2wiki' => "//$wmgUploadHostname/r2wiki/6/64/Favicon.ico",
		'patch153wiki' => "//$wmgUploadHostname/patch153wiki/1/1f/ICMS.png",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/6/64/Favicon.ico",
		'pfsolutionswiki' => "//$wmgUploadHostname/pfsolutionswiki/0/0f/PF_Solutions_Icon.ico",
		'picardwiki' => "//$wmgUploadHostname/picardwiki/8/8f/Picard-Wiki_favicon.png",
		'plasmawiki' => "//$wmgUploadHostname/plasmawiki/e/e3/PlasmaWiki_Favicon.ico",
		'plnonbinarywiki' => "//$wmgUploadHostname/plnonbinarywiki/7/76/Icon.ico",
		'pluspiwiki' => "//$wmgUploadHostname/pluspiwiki/6/64/Favicon.ico",
		'pocketmonsterswiki' => "//$wmgUploadHostname/pocketmonsterswiki/d/d2/PMFavicon.png",
		'podpediawiki' => "//$wmgUploadHostname/podpediawiki/0/0e/PodpediaFavicon2.png",
		'puzzlewiki' => "//$wmgUploadHostname/puzzlewiki/0/0d/PuzzlepediaFavicon.png",
		'pwikiwiki' => "//$wmgUploadHostname/pwikiwiki/8/8c/Arkcls_favicon.ico",
		'raymanspeedrunwiki' => "//$wmgUploadHostname/raymanspeedrunwiki/0/08/Rayman_Speedrun_Wiki_Favicon.png",
		'revitwiki' => "//$wmgUploadHostname/revitwiki/6/64/Favicon.ico",
		'rpgbrigadewiki' => "//$wmgUploadHostname/rpgbrigadewiki/6/64/Favicon.ico",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/f/fc/Safiria_wiki_favicon.png",
		'savagewikiwiki' => "//$wmgUploadHostname/savagewikiwiki/6/64/Favicon.ico",
		'scruffywiki' => "//$wmgUploadHostname/scruffywiki/6/64/Favicon.ico",
		'sdiywiki' => "//$wmgUploadHostname/sdiywiki/6/64/Favicon.ico",
		'shadawiki' => "//$wmgUploadHostname/shadawiki/c/c4/SHA_Favicon.svg",
		'shippingandmetawiki' => "//$wmgUploadHostname/shippingandmetawiki/6/64/Favicon.ico",
		'showroomwiki' => "//$wmgUploadHostname/showroomwiki/2/26/Favicon.png",
		'sidemwiki' => "//$wmgUploadHostname/sidemwiki/7/76/Sidem-favicon.ico",
		'sikhwikitestwiki' => "//$wmgUploadHostname/sikhwikitestwiki/9/97/Cover_The_Purpose_of_Your_Life_cropped.jpg",
		'sirikotwiki' => '//sirikot.com/favicon.png',
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'speleowiki' => "//$wmgUploadHostname/speleowiki/6/64/Favicon.ico",
		'sqlserverwiki' => "//$wmgUploadHostname/sqlserverwiki/6/64/Favicon.ico",
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/9/93/Scwiki-favicon.png",
		'sysexwiki' => "//$wmgUploadHostname/sysexwiki/1/1d/Sysex.ico",
		'tagwiki' => "//$wmgUploadHostname/tagwiki/6/66/Tag_logo.png",
		'takethatwikiwiki' => "//$wmgUploadHostname/takethatwikiwiki/6/64/Favicon.ico",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/6/64/Favicon.ico",
		'teessidehackspacewiki' => "//$wmgUploadHostname/teessidehackspacewiki/6/64/Favicon.ico",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/7/7f/Teleslogosmoler.png",
		'templatewiki' => "//$wmgUploadHostname/templatewiki/6/64/Favicon.ico",
		'texwikiwiki' => "//$wmgUploadHostname/texwikiwiki/2/26/Favicon.png",
		'thecscwiki' => "//$wmgUploadHostname/thecscwiki/0/0d/Csc_favicon.png",
		'thedistancewiki' => "//$wmgUploadHostname/thedistancewiki/2/26/Favicon.png",
		'thegreatwarwiki' => "//$wmgUploadHostname/thegreatwarwiki/2/21/SoldiersFavicon.png",
		'thelonsdalebattalionwiki' => "//$wmgUploadHostname/thelonsdalebattalionwiki/2/21/SoldiersFavicon.png",
		'themfbclubwiki' => "//$wmgUploadHostname/themfbclubwiki/6/64/Favicon.ico",
		'titreprovisoirewiki' => "//$wmgUploadHostname/titreprovisoirewiki/0/01/Favicon_titrepro.png",
		'triseptsoloutionswiki' => "//$wmgUploadHostname/triseptsolutionswiki/c/c4/TriseptFavicon.png",
		'trumpwiki' => "//$wmgUploadHostname/trumpwiki/a/a9/T-cartoon-face.ico",
		'tudienwiki' => "//$wmgUploadHostname/tudienwiki/6/64/Favicon.ico",
		'tulpawiki' => "//$wmgUploadHostname/tulpawiki/6/63/Tulpa.info-Favicon.png",
		'twswiki' => "//$wmgUploadHostname/twswiki/3/34/Tws-favicon.png",
		'tymyrddinwiki' => "//$wmgUploadHostname/tymyrddinwiki/6/63/Ty-myrddin-favicon.ico",
		'ubrwikiwiki' => "//$wmgUploadHostname/ubrwikiwiki/6/64/Favicon.ico",
		'umemaro3dwiki' => "//$wmgUploadHostname/umemaro3dwiki/e/e4/Featuredmark.png",
		'utamacrosswiki' => "//$wmgUploadHostname/utamacrosswiki/7/7a/Freyacon.png",
		'valentinaprojectwiki' => "//$wmgUploadHostname//valentinaprojectwiki/9/9e/Seamly2D_logo_128x128.png",
		'vandalismwikiwiki' => "//$wmgUploadHostname//vandalismwikiwiki/6/64/Favicon.ico",
		'wikidolphinhansenwiki' => "//$wmgUploadHostname/wikidolphinhansenwiki/b/bf/Dolphin-icon-150.png",
		"wikiletraswiki" => "//$wmgUploadHostname/wikiletraswiki/2/26/Favicon.png",
		'wikipucwiki' => "//$wmgUploadHostname/wikipucwiki/2/26/Favicon.png",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/6/64/Favicon.ico",
		'wishwiki' => "//$wmgUploadHostname/wishwiki/a/aa/Internet_favicon.png",
		'worldpediaenwiki' => "//$wmgUploadHostname/worldpediaenwiki/6/64/Favicon.ico",
		'worlduniversityandschoolwiki' => "//$wmgUploadHostname/worlduniversityandschoolwiki/6/60/WorldUnivAndSchLogo2017-08-18Wave.png",
		'zharkunuwiki' => "//$wmgUploadHostname/zharkunuwiki/4/41/Zharkunu_Logo_-_135.png",
	),
	'wgLogo' => array(
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
		'690squadronwiki' => "//$wmgUploadHostname/690squadronwiki/f/f4/Squadlogo.png",
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/3/3b/Wiki_logo.png",
		'aapwiki' => "//$wmgUploadHostname/aapwiki/6/61/Aaplogo.jpg",
		'absurdopediawiki' => "//$wmgUploadHostname/absurdopediawiki/b/bc/Wiki.png",
		'adadevelopersacademywiki' => "//$wmgUploadHostname/adadevelopersacademywiki/b/bc/ADA_logo_small.png",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/f/f1/APlogo.png",
		'adiaprojectwiki' => "//$wmgUploadHostname/adiaprojectwiki/8/8b/Adialogo.png",
		'adnovumwiki' => "//$wmgUploadHostname/adnovumwiki/f/fa/AdnovumRPtemplogo.png",
		'aenasanwiki' => "//$wmgUploadHostname/aenasanwiki/f/f1/AEicon1.png",
		'aesbasewiki' => "//$wmgUploadHostname/aesbasewiki/1/15/IconAESBASE.jpg",
		'aibowiki' => "//$wmgUploadHostname/aibowiki/b/bd/Sonyaibologo.png",
		'airwiki' => "//$wmgUploadHostname/airwiki/8/8e/Logo-scadta-133x133.gif",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/3/33/Logo-amafuwa.png",
		'aleenghawiki' => "//$wmgUploadHostname/aleenghawiki/c/c7/Aleen-gha_d20_Logo.jpg",
		'algopediawiki' => "//$wmgUploadHostname/algopediawiki/8/88/Algopedia-logo135px.png",
		'almanachdebauswicwiki' => "//$wmgUploadHostname/almanachdebauswicwiki/c/c9/Logo.png",
		'alternatehistorywiki' => "//$wmgUploadHostname/alternatehistorywiki/b/bc/Wiki.png",
		'allthetropeswiki' => "//$wmgUploadHostname/allthetropeswiki/8/86/Logo-Square-v1-1x.png",
		'alternatehistory' => "//$wmgUploadHostname/alternatehistorywiki/b/bc/Wiki.png",
		'alwikiwiki' => "//$wmgUploadHostname/alwikiwiki/3/35/WikiLogo.png",
		'amaninfowiki' => "//$wmgUploadHostname/amaninfowiki/c/c9/Logo.png",
		'amicitiawiki' => "//$wmgUploadHostname/amicitiawiki/9/9b/Amicitia_logo.png",
		'animationmoviewikiwiki' => "//$wmgUploadHostname/animationmoviewikiwiki/b/bd/Fdg.PNG",
		'anjunawiki' => "//$wmgUploadHostname/anjunawiki/thumb/1/19/Formross2_logo.jpg/120px-Formross2_logo.jpg",
		'anothertimeline2120wiki' => "//$wmgUploadHostname/anothertimeline2120wiki/3/3b/Wiki_logo.png",
		'apellidosmurcianoswiki' => "//$wmgUploadHostname/apellidosmurcianoswiki/2/27/Amlogo.png",
		'appswiki' => "//$wmgUploadHostname/appswiki/d/d2/AppediaLogo.png",
		'arefepvawiki' => "//$wmgUploadHostname/arefepvawiki/9/92/Logoaf.png",
		'assaultandroidcactuswiki' => "//$wmgUploadHostname/assaultandroidcactuswiki/7/7b/Cactus_icon.png",
		'ashenswikiwiki' => "//$wmgUploadHostname/ashenswikiwiki/e/e4/Ashens_Wiki_Logo.png",
		'asckeyswiki' => "//$wmgUploadHostname/asckeyswiki/a/a3/ASC-logo-135px.jpg",
		'autocountwiki' => "//$wmgUploadHostname/autocountwiki/d/d4/Logo.jpg",
		'ayrshirewiki' => "//$wmgUploadHostname/ayrshirewiki/b/bc/Wiki.png",
		'bakufuwiki' => "//$wmgUploadHostname/bakufuwiki/b/bc/Wiki.png",
		'ballaratpubswiki' => "//$wmgUploadHostname/ballaratpubswiki/4/42/Hotels_of_Ballarat_logo.jpg",
		'bchwiki' => "//$wmgUploadHostname/bchwiki/c/c0/Logo_135.png",
		'bchplswiki' => "//$wmgUploadHostname/bchplswiki/5/56/Bitcoin-cash-wiki-logo.png",
		'bconnectedwiki' => "//$wmgUploadHostname/bconnectedwiki/6/61/LogoSmall.png",
		'bdorpwiki' => "//$wmgUploadHostname/bdorpwiki/2/22/Main_page.PNG",
		'beatstationwiki' => "//$wmgUploadHostname/beatstationwiki/d/da/Wiki_logo2.png",
		'beminwiki' => "//$wmgUploadHostname/beminwiki/1/11/Beminpedia_logo.png",
		'berlinowiki' => "//$wmgUploadHostname/berlinowiki/thumb/b/be/Berlino_new_logo.png/253px-Berlino_new_logo.png",
		'betapurplewiki' => "//$wmgUploadHostname/betapurplewiki/0/0e/BetaPurpleLogo.png",
		'biblicalwikiwiki' => "//$wmgUploadHostname/biblicalwikiwiki/e/e2/WikiLogo.svg",
		'bigforestwiki' => "//$wmgUploadHostname/bigforestwiki/f/f0/Logo_Candidate.png",
		'bloodstainedwiki' => "//$wmgUploadHostname/bloodstainedwiki/7/71/Logo_Icon.png",
		'bootstrappingwiki' => "//$wmgUploadHostname/bootstrappingwiki/f/fd/Bootstrapping.png",
		'bqwiki' => "//$wmgUploadHostname/bqwiki/6/6d/Bq-wiki.svg",
		'breedersofthenephelymwiki' => "//$wmgUploadHostname/breedersofthenephelymwiki/4/49/WindowsIcon.png",
		'bpawiki' => "//$wmgUploadHostname/bpawiki/d/d3/Bpa-140.jpg",
		'bugolaviawiki' => "//$wmgUploadHostname/bugolaviawiki/2/28/Bugolavian_Coat_of_Arms.png",
		'bunker401wiki' => "//$wmgUploadHostname/bunker401wiki/7/74/Logo_Bunker_401.png",
		'calexitwiki' => "//$wmgUploadHostname/calexitwiki/a/ab/Cali-bear-geog-black-small.png",
		'calibrowiki' => "//$wmgUploadHostname/calibrowiki/0/01/Calibro-logo.png",
		'capstonecitywiki' => "//$wmgUploadHostname/capstonecitywiki/c/c4/Wikilogo2018-02-19.jpg",
		'carelliwiki' => "//$wmgUploadHostname/carelliwiki/9/9c/Logo-carelli.png",
		'carmeigatwiki' => "//$wmgUploadHostname/carmeigatwiki/c/c9/Logo.png",
		'cdcwiki' => "//$wmgUploadHostname/cdcwiki/9/96/Cd_logo_hd_words_B.png",
		'changemyorgwiki' => "//$wmgUploadHostname/changemyorgwiki/2/2c/ChangeMyOrgUpdatedLogo.png",
		'christipediawiki' => "//$wmgUploadHostname/christipediawiki/e/e7/Logo_Christipedia.jpg",
		'civclassicwiki' => "//$wmgUploadHostname/civclassicwiki/f/fe/CivLogo.png",
		'clonedeploywiki' => "//$wmgUploadHostname/clonedeploywiki/3/39/Clonedeploy-logo.png",
		'cnvwiki' => "//$wmgUploadHostname/cnvwiki/b/bc/Wiki.png",
		'coldbloodedwiki' => "//$wmgUploadHostname/coldbloodedwiki/1/12/WikiLogo_135.png",
		'collabvmwiki' => "//$wmgUploadHostname/collabvmwiki/c/c9/Logo.png",
		'colonizemarswiki' => "//$wmgUploadHostname/colonizemarswiki/c/c1/Colonize_logo.png",
		'consentcraftwiki' => "//$wmgUploadHostname/consentcraftwiki/3/35/Spawnlogo.PNG",
		'constancywiki' => "//$wmgUploadHostname/constancywiki/5/57/Wikifix.png",
		'cosiadventurewiki' => "//$wmgUploadHostname/cosiadventurewiki/3/3b/Wiki_logo.png",
		'cosnwiki' => "//$wmgUploadHostname/cosnwiki/6/6b/Logo_Wiki_CoSN.png",
		'cpiwiki' => "//$wmgUploadHostname/cpiwiki/0/01/CPI_Alpha_DS_2_160px.png",
		'csnimsbordeauxwiki' => "//$wmgUploadHostname/csnimsbordeauxwiki/1/1a/Logo_équipe_CSN_IMS_Bordeaux.png",
 		'cristianopediawiki' => "//$wmgUploadHostname/cristianopediawiki/2/23/Biblia_y_cruz.svg",		
		'crankipediawiki' => "//$wmgUploadHostname/crankipediawiki/4/4c/Crankilogo.png",
		'czechpolicywiki' => "//$wmgUploadHostname/czechpolicywiki/2/20/Plain_logo.png",
		'dakhilcommunitywiki' => "//$wmgUploadHostname/dakhilcommunitywiki/4/49/Myfile.png",
		'dariawikiwiki' => "//$wmgUploadHostname/dariawikiwiki/e/e9/Darialogo1.jpg",
		'dcrzonewiki' => "//$wmgUploadHostname/dcrzonewiki/4/4b/Wikilogo.png",
		'dditecwiki' => "//$wmgUploadHostname/dditecwiki/8/87/Ddu_logo.png",
		'developingspacewiki' => "//$wmgUploadHostname/developingspacewiki/f/f7/Entireverse_wiki.png",
		'diascwiki' => "//$wmgUploadHostname/diascwiki/8/8f/Diasc.png",
		'dicficwiki' => "//$wmgUploadHostname/dicficwiki/b/b1/Dicfic-logo.png",
		'didaprowiki' => "//$wmgUploadHostname/didaprowiki/5/58/LOGORPD-135X135.jpg",
		'diggywikipolskawiki' => "//$wmgUploadHostname/diggywikipolskawiki/8/81/Logodiggy.png",
		'doinwiki' => "//$wmgUploadHostname/doinwiki/6/60/Wiki_Logo.png",
		'drones4allwiki' => "//$wmgUploadHostname/drones4allwiki/6/60/Wiki_Logo.png",
		'dwplivewiki' => "//$wmgUploadHostname/dwplivewiki/c/c0/Logo_135.png",
		'eerstelijnszoneswiki' => "//$wmgUploadHostname/eerstelijnszoneswiki/8/83/Logo_wiki_ELZ.jpg",
		'emulationwiki' => "//$wmgUploadHostname/emulationwiki/3/3b/Wiki_logo.png",
		'embobadawiki' => "//$wmgUploadHostname/embobadawiki/d/d5/Logo-embobada.png",
		'encyclopaedicawiki' => "//$wmgUploadHostname/encyclopaedicawiki/e/e0/Favicon_new.png",
		'enmarchewiki' => "//$wmgUploadHostname/enmarchewiki/c/c9/LaREM68-135x135.png",
		'ensemblemulhousewiki' => "//$wmgUploadHostname/ensemblemulhousewiki/e/e7/EnsembleMulhouse135x135logo.png",
		'eotewiki' => "//$wmgUploadHostname/eotewiki/6/64/Logo_triumph.png",
		'esctwiki' => "//$wmgUploadHostname/esctwiki/d/d9/Heart.png",
		'espiralwiki' => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Spiral_project_logo.svg/135px-Spiral_project_logo.svg.png',
		'etpowiki' => "//$wmgUploadHostname/etpowiki/1/1f/LogoETPO.gif",
		'evawiki' => "//$wmgUploadHostname/evawiki/e/ec/EVA-Wiki.png",
		'exercicesdefrancaisprodfrwiki' => "//$wmgUploadHostname/exercicesdefrancaisprodfrwiki/c/c4/Logo_Exercices.jpeg",
		'eyebobswiki' => "//$wmgUploadHostname/eyebobswiki/0/0d/Eyebobs_logo_Resized.jpg",
		'fablabesdswiki' => "//$wmgUploadHostname/fablabesdswiki/3/3c/CFDS_Logo.svg",
		'fefoxtttwiki' => "//$wmgUploadHostname/fefoxtttwiki/d/d7/NewIcon.jpg",
		'feuwiki' => "//$wmgUploadHostname/feuwiki/8/81/Feu-logo.png",
		'fieldresearchwiki' => "//$wmgUploadHostname/fieldresearchwiki/d/d1/Logo_c.jpg",
		'florianwikiwiki' => "//$wmgUploadHostname/florianwikiwiki/9/99/Florian_Wiki.png",
		'fmbvwiki' => "//$wmgUploadHostname/fmbvwiki/3/33/Fmbvlogo.png",
		'frontdeskswiki' => "//$wmgUploadHostname/frontdeskswiki/b/b3/Fdawikilogo.png",
		'foodsharinghamburgwiki' => "//$wmgUploadHostname/foodsharinghamburgwiki/d/d2/FoodsharingHamburgLogo135px.jpg",
		'forexwiki' => "//$wmgUploadHostname/forexwiki/c/c9/Logo.png",
		'freecollegeprojectwiki' => "//$wmgUploadHostname/freecollegeprojectwiki/6/60/FC_Logo_135p.png",
		'freestateofjoneswiki' => "//$wmgUploadHostname/freestateofjoneswiki/2/29/Free_State_of_Jones_Seal_Logo.png",
		'furbyislandwiki' => "//$wmgUploadHostname/furbyislandwiki/b/bc/Wiki.png",
		'galenadevwiki' => "//$wmgUploadHostname/galenadevwiki/9/96/Temp_logo1.png",
		'genwiki' => "//$wmgUploadHostname/genwiki/0/03/Genesis-logo-reized.png",
		'geodatawiki' => "//$wmgUploadHostname/geodatawiki/c/c1/GlobeIcon160.png",
		'girlsfrontlinewiki' => "//$wmgUploadHostname/girlsfrontlinewiki/3/35/GirlsFrontline_logo-135px.jpg",
		'grandtheftautowiki' => "//$wmgUploadHostname/grandtheftautowiki/9/9e/GrandTheftAuto.png",
		'grdarchivewiki' => "//$wmgUploadHostname/grdarchivewiki/b/be/Greater_Arms_of_Delvera.png",
		'grottocenterwiki' => "//$wmgUploadHostname/grottocenterwiki/a/ac/Logo_grottocenter.png",
		'gugacastwiki' => "//$wmgUploadHostname/gugacastwiki/7/79/Gugacast_Logo_135x135.png",
		'guiaslocaiswiki' => "//$wmgUploadHostname/guiaslocaiswiki/d/d7/Wiki.jpeg",
		'gundambiowiki' => "//$wmgUploadHostname/gundambiowiki/b/bc/Wiki.png",
		'gulpiewiki' => "//$wmgUploadHostname/gulpiewiki/d/de/Gulpie_logo.png",		
		'hamfemwiki' => "//$wmgUploadHostname/hamfemwiki/3/33/Hamfem-Logo1.jpg",
		'hamimwiki' => "//$wmgUploadHostname/hamimwiki/2/28/Hamimlogo.png",
		'hantpediawiki' => "//$wmgUploadHostname/hantpediawiki/b/bc/Wiki.png",
		'harrypotterwiki' => "//$wmgUploadHostname/harrypotterwiki/e/eb/TheHarryPotterWikiLogo2.png",
		'heathenwiki' => "//$wmgUploadHostname/heathenwiki/b/b5/HeathenWiki_Logo.png",
		'heralwikiawiki' => "//$wmgUploadHostname/heralwikiawiki/c/c9/Logo.png",
		'herbertlawgroupwiki' => "//$wmgUploadHostname/herbertlawgroupwiki/a/a0/LogoResized.png",
		'hexelswiki' => "//$wmgUploadHostname/hexelswiki/f/ff/Hexlogo135.png",
		'hktransportpediawiki' => "//$wmgUploadHostname/hktransportpediawiki/6/60/Logo2wiki.PNG",
		'holycrosswiki' => "//$wmgUploadHostname/holycrosswiki/c/c9/Logo.png",
		'honkai3rdwiki' => "//$wmgUploadHostname/honkai3rdwiki/8/8e/Hi3_logo.png",
		'houseofettlingarfreyuwiki' => "//$wmgUploadHostname/houseofettlingarfreyuwiki/7/74/Shield_Arms_House_Ettlingar_Freyu5.png",
		'hsoodenwiki' => "//$wmgUploadHostname/hsoodenwiki/8/82/135px-wiki-logo-blank.png",
		'humorpediawiki' => "//$wmgUploadHostname/humorpediawiki/b/bc/Wiki.png",
		'hydrawikiwiki' => "//$wmgUploadHostname/hydrawikiwiki/7/79/Hydra-logo.png",
		'icmscholarswiki' => "//$wmgUploadHostname/icmscholarswiki/6/69/Logo135px.png",
		'icterwiki' => "//$wmgUploadHostname/icterwiki/a/af/ICTERsmall.png",
		'idwwiki' => "//$wmgUploadHostname/idwwiki/f/f5/Idw.profile.png",
		'imperiuswiki' => "//$wmgUploadHostname/imperiuswiki/9/94/ImperiusLogo.png",
		'indrikwiki' => "//$wmgUploadHostname/indrikwiki/2/2e/Indriklogo_%28160x160%29.jpg",
		'ipolywiki' => "//$wmgUploadHostname/ipolywiki/3/33/IPoly_Logo_-SQ-.png",
		'isvwiki' => "//$wmgUploadHostname/isvwiki/b/bc/Med%C5%BEuviki-logo-latn.svg",
		'itasiawiki' => "//$wmgUploadHostname/itasiawiki/f/f7/Mylogo.png",
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/e/eb/IZLogo.png",
		'jacksonheightswiki' => "//$wmgUploadHostname/jacksonheightswiki/b/b5/Jackson_heights_logo_135_X_135.png",
		'jadtechwiki' => "//$wmgUploadHostname/jadtechwiki/3/35/WikiLogo.png",
		'jawp2chwiki' => "//$wmgUploadHostname/jawp2chwiki/b/b1/Jawp2ch_Logo1.svg",
		'jawptestwiki' => "//$wmgUploadHostname/jawptestwiki/e/ee/LogoLar.jpg",
		'jayuwikiwiki' => "//$wmgUploadHostname/jayuwikiwiki/d/d7/Jayuwiki3.png",
		'jcswiki' => "//$wmgUploadHostname/jcswiki/2/2e/JCS-Wiki.png",
		'geomasterywiki' => "//$wmgUploadHostname/geomasterywiki/d/d4/Logo.jpg",
		'jokowiki' => "//$wmgUploadHostname/jokowiki/0/0d/Icon_Joko.png",
		'karniarutheniawiki' => "//$wmgUploadHostname/karniarutheniawiki/1/17/Krlogo.png",
		'kbrprojectwiki' => "//$wmgUploadHostname/kbrprojectwiki/c/c1/Rlogo.png",
		'kirarafantasiawiki' => "//$wmgUploadHostname/kirarafantasiawiki/b/b4/Kirafanlogo.png",
		'kkandpwiki' => "//$wmgUploadHostname/kkandpwiki/0/09/Monogram-01.png",
		'kosmopolitikawiki' => "//$wmgUploadHostname/kosmopolitikawiki/d/db/Kosmopolitika's_Rocket_1.3.png",
		'kspancevowiki' => "//$wmgUploadHostname/kspancevowiki/1/1a/Krunamala.png",
		'korczakwiki' => "//$wmgUploadHostname/korczakwiki/5/5a/Korczak_Logo.png",
		'kstartupswiki' => "//$wmgUploadHostname/kstartupswiki/1/14/Mediawiki-icon-135x135.png",
		'kunwokwiki' => "//$wmgUploadHostname/kunwokwiki/8/8f/Kunwok_135x150.jpg",
		'kuonsamwiki' => "//$wmgUploadHostname/kuonsamwiki/b/bc/My_Handsome.png",
		'lambdawarswiki' => "//$wmgUploadHostname/lambdawarswiki/7/76/LW_logo_mainpage.png",
		'lanstationwiki' => "//$wmgUploadHostname/lanstationwiki/e/e2/Miniian.png",
		'lapeninsulewiki' => "//$wmgUploadHostname/lapeninsulewiki/6/66/Constellation_de_la_P%C3%A9ninsule.png",
		'lavoniawiki' => "//$wmgUploadHostname/lavoniawiki/9/9e/Universo_Lavônia.png",
		'leftypolwiki' => "//$wmgUploadHostname//leftypolwiki/3/3b/Wiki_logo.png",
		'lexiquewiki' => "//$wmgUploadHostname/lexiquewiki/6/6d/LibraryLexique-smallRes.png",
		'lfwikiwiki' => "//$wmgUploadHostname/lfwikiwiki/3/3d/Brunch_%281%29.png",
		'liko12wiki' => "//$wmgUploadHostname/liko12wiki/a/a6/Wiki-Logo.png",
		'lingnlangwiki' => "//$wmgUploadHostname/lingnlangwiki/b/bc/Wiki.png",
		'livesnowmapwiki' => "//$wmgUploadHostname/livesnowmapwiki/2/27/Snowflake.png",
		'logalnetwiki' => "//$wmgUploadHostname/logalnetwiki/3/35/LN-Icon_135x.png",
		'lostminecraftminerswiki' => "//$wmgUploadHostname/lostminecraftminerswiki/8/8e/2018Logo_LMM.png",
		'lovesgreatadventurewiki' => "//$wmgUploadHostname/lovesgreatadventurewiki/5/53/Shield_High_Realm2.png",
		'lunfengwiki' => "//$wmgUploadHostname/lunfengwiki/b/bc/Wiki.png",
		'maccnycwiki' => "//$wmgUploadHostname/maccnycwiki/3/3f/MACC_Logo.png",
		'madgendersciencewiki' => "//$wmgUploadHostname/madgendersciencewiki/3/3e/Mgslogo_color.png",
		'make717wiki' => "//$wmgUploadHostname/make717wiki/thumb/f/fc/Make717_Logo.png/150px-Make717_Logo.png",
		'maiasongcontestwiki' => "//$wmgUploadHostname/maiasongcontestwiki/b/bc/Sitelogo.png",
		'makingitpodcastwiki' => "//$wmgUploadHostname/makingitpodcastwiki/2/27/Makingit-podcastlogo.png",
		'makeiteasyautoswiki' => "//$wmgUploadHostname/makeiteasyautoswiki/0/01/Miea.png",
		'malaysiawiki' => "//$wmgUploadHostname/malaysiawiki/1/1d/Malaysian_flag_round135.png",
		'marinebiodiversitymatrixwiki' => "//$wmgUploadHostname/marinebiodiversitymatrixwiki/3/34/IUCN_logo_transparent_WICKI_web.jpg",
		'mawikimaisonwiki' => "//$wmgUploadHostname/mawikimaisonwiki/3/33/Wikihouse.png",
		'mexasaachenwiki' => "//$wmgUploadHostname/mexasaachenwiki/8/8e/MexAS.png",
		'mikeandchrisproductions' => "//$wmgUploadHostname/mikeandchrisproductionswiki/thumb/a/aa/MCP_Wiki_Logo.png/135px-MCP_Wiki_Logo.png",
		'mikrodevwiki' => "//$wmgUploadHostname/mikrodevwiki/c/c9/Logo.png",
		'miraewiki' => "//$wmgUploadHostname/miraewiki/2/22/LogoOfMirae.png",
		'mncwikipediawiki' => "//$wmgUploadHostname/mncwikipediawiki/a/a7/Manju_Gurun_Wiki.png",
		'musicarchivewiki' => "//$wmgUploadHostname/musicarchivewiki/d/d4/Logo.jpg",
		'musmyswiki' => "//$wmgUploadHostname/musmyswiki/9/90/Musmys.png",
		'mynimowiki' => "//$wmgUploadHostname/mynimowiki/thumb/7/77/Mynimo_Wiki.png/120px-Mynimo_Wiki.png",
		'nationsglorywiki' => "//$wmgUploadHostname/nationsglorywiki/2/28/NationsGlory_Logo_V2.png",
		'nenawikiwiki' => "//$wmgUploadHostname/nenawikiwiki/4/49/Nenalogo.png",
		'newarkmanorwiki' => "//$wmgUploadHostname/newarkmanorwiki/8/89/Wiki_logo.jpg",
		'newcolumbiawiki' => "//$wmgUploadHostname/newcolumbiawiki/a/a0/Wiki-logo.png",
		'nonbinarywiki' => "//$wmgUploadHostname/nonbinarywiki/a/a9/Wikilogo.svg",
		'notezenwiki' => "//$wmgUploadHostname/notezenwiki/c/c9/Logo.png",
		'nutscriptwiki' => "//$wmgUploadHostname/nutscriptwiki/2/26/Nutscript.png",
		'nxwikiwiki' => "//$wmgUploadHostname/nxwikiwiki/9/9b/Nxlogo.png",
		'oecumenewiki' => "//$wmgUploadHostname/oecumenewiki/2/2d/Logo-Oecumene.svg",
		'omniversaliswiki' => "//$wmgUploadHostname/omniversaliswiki/9/95/Omniversalis_Wiki-Logo.png",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'opendominionwiki' => "//$wmgUploadHostname/opendominionwiki/3/3a/OpenDominionLogo.png",
		'openkorebrasilwikiwiki' => "//$wmgUploadHostname/openkorebrasilwikiwiki/3/35/WikiLogo.png",
		'openpokewikiwiki' => "//$wmgUploadHostname/openpokewikiwiki/a/a0/Openpokewiki-logo.svg",
		'ostravawiki' => "//$wmgUploadHostname/ostravawiki/c/ca/Os.png", 
		'overonwiki' => "//$wmgUploadHostname/overonwiki/2/2e/Overon_Logo.svg",
		'ordiswiki' => "//$wmgUploadHostname/ordiswiki/6/65/OE_Logo.png",
		'ortuswiki' => "//$wmgUploadHostname/ortuswiki/3/37/Ortica_sidebar_logo.png",
		'paddelnwiki' => "//$wmgUploadHostname/paddelnwiki/9/9c/GutDrauf.png",
		'papeloriowiki' => "//$wmgUploadHostname/papeloriowiki/6/63/Logo_papelorio_135.jpg",
		'paranormalwiki' => "//$wmgUploadHostname/paranormalwiki/2/2d/Parawiki.png",
		'particracywikiwiki' => "//$wmgUploadHostname/particracywikiwiki/6/69/Wiki_logo_parti.png",
		'r2wiki' => "//$wmgUploadHostname/r2wiki/a/a6/Part-up-logo-150x150-mediawiki.png",
		'papeloriowiki' => "//$wmgUploadHostname/papeloriowiki/2/26/Logo_papelorio.jpg",
		'patch153wiki' => "//$wmgUploadHostname/patch153wiki/1/1f/ICMS.png",
		'pculsdwiki' => "//$wmgUploadHostname/pculsdwiki/d/d7/Pculogo.png",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/c/c0/Permanent-Future-Lab-logo-150x150-mediawiki.png",
		'pfsolutionswiki' => "//$wmgUploadHostname/pfsolutionswiki/3/33/Swoosh_-_Square-Logo.png",
		'pgnwikiwiki' => "//$wmgUploadHostname/pgnwikiwiki/2/22/MainPhotoWiki.png",
		'philmont126wiki' => "//$wmgUploadHostname/philmont126wiki/f/f6/PhilmontLogo.jpg",
		'picardwiki' => "//$wmgUploadHostname/picardwiki/b/b0/Picardwikilogo.png",
		'plasmawiki' => "//$wmgUploadHostname/plasmawiki/0/08/PlasmaWiki_Logo.svg",
		'plazmaburstwiki' => "//$wmgUploadHostname/plazmaburstwiki/6/6f/Plazmaburst-logo.png",
		'plnonbinarywiki' => "//$wmgUploadHostname/plnonbinarywiki/a/a9/Wikilogo.svg",
		'pluspiwiki' => "//$wmgUploadHostname/pluspiwiki/b/bd/Pluspi.png",
		'pocketmonsterswiki' => "//$wmgUploadHostname/pocketmonsterswiki/4/47/PMLogo.png",
		'podpediawiki' => "//$wmgUploadHostname/podpediawiki/2/28/Podpedia_Logo_3.png",
		'printmakingbewiki' => "//$wmgUploadHostname/printmakingbewiki/2/22/Pmk-logo-wiki-135px.png",
		'priyowiki' => "//$wmgUploadHostname/priyowiki/c/c9/Logo.png",
		'procrastipediawiki' => "//$wmgUploadHostname/procrastipediawiki/1/1e/PCPedia_Logo.png",
		'programmingredwiki' => "//$wmgUploadHostname/programmingredwiki/0/0f/Red-3d-icon-cmyk.jpg",
		'pruebawiki' => "//$wmgUploadHostname/pruebawiki/7/77/LogoWiki.PNG",
		'puzzlewiki' => "//$wmgUploadHostname/puzzlewiki/a/a9/PuzzlepediaLogo.png",
		'pwikiwiki' => "//$wmgUploadHostname/pwikiwiki/5/5b/ARK_CLS-135x135.png",
		'qmswiki' => "//$wmgUploadHostname/qmswiki/8/8f/QMS_Logo.png",
		'raymanspeedrunwiki' => "//$wmgUploadHostname/raymanspeedrunwiki/0/0e/Rayman_Speedrun_Wiki_Logo.png",
		'reiaasuwiki' => "//$wmgUploadHostname/reiaasuwiki/1/1e/Reiaasu-wiki-logo-1.png",
		'reservedurablewiki' => "//$wmgUploadHostname/reservedurablewiki/3/37/Logo_sustainable_storage_135_pi.png",
		'revitwiki' => "//$wmgUploadHostname/revitwiki/d/d0/Real_World_Revit.png",
		'rpgbrigadewiki' => "//$wmgUploadHostname/rpgbrigadewiki/c/c9/Logo.png",
		'rwdvolvowiki' => "//$wmgUploadHostname/rwdvolvowiki/9/93/Rwdvolvo-135px.png",
		'rwsaleswiki' => "//$wmgUploadHostname/rwsaleswiki/8/88/Rw-logo.png",
		'sadpepswiki' => "//$wmgUploadHostname/sadpepswiki/f/f7/Mylogo.png",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/2/24/Newcoa_small.png",
		'sapperpediawiki' => "//$wmgUploadHostname/sapperpediawiki/f/f8/Sapperpedia_small.png",
		'savagewikiwiki' => "//$wmgUploadHostname/savagewikiwiki/9/98/Sav_Wiki_logo.jpg",
		'scffantasyescwiki' => "//$wmgUploadHostname/scffantasyescwiki/8/82/EurovisionLogo.png",
		'schnellbildungwiki' => "//$wmgUploadHostname/schnellbildungwiki/6/6f/Logo.svg",
		'schicksalswikiwiki' => "//$wmgUploadHostname/schicksalswikiwiki/b/bc/Wiki.png",
		'scientiawikiwiki' => "//$wmgUploadHostname/scientiawikiwiki/d/d4/Logo.jpg",
		'scruffywiki' => "//$wmgUploadHostname/scruffywiki/4/43/Scruffy_logo.png",
		'sdiywiki' => "//$wmgUploadHostname/sdiywiki/9/92/SDIY_wiki_logo.png",
		'serinfhospwiki' => "//$wmgUploadHostname/serinfhospwiki/c/c1/Logotype.svg",
		'shadawiki' => "//$wmgUploadHostname/shadawiki/e/e3/SHA_Wiki_logo.svg",
		'shippingandmetawiki' => "//$wmgUploadHostname/shippingandmetawiki/7/7d/CSM_Logo.png",
		'shortwikiwiki' => "//$wmgUploadHostname/shortwikiwiki/3/3e/쇼트로고_2.png",
		'showroomwiki' => "//$wmgUploadHostname/showroomwiki/e/e0/Arcadis_Logo_small.jpg",
		'showmedicinawiki' => "//$wmgUploadHostname//showmedicinawiki/4/4b/Show_Medicina.jpg",
		'sichoeumlonwiki' => "//$wmgUploadHostname/sichoeumlonwiki/b/b6/MyFile.jpeg",
		'sidemwiki' => "//$wmgUploadHostname/sidemwiki/a/a5/Sidem-logo.png",
		'sikhwikitestwiki' => "//$wmgUploadHostname/sikhwikitestwiki/b/b5/Cover_The_Purpose_of_Your_Life_LOGO_135x135.png",
		'sirikotwiki' => '//www.sirikot.com/wiki_logo.png',
		'smfdoesathingwiki' => "//$wmgUploadHostname/smfdoesathingwiki/b/bc/Wiki.png",
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'sqlserverwiki' => "//$wmgUploadHostname/sqlserverwiki/d/d4/Logo.jpg",
		'speleowiki' => "//$wmgUploadHostname/speleowiki/c/c3/SpeleoWikiV1.2_135x135.png",
		'spiralwiki' => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Spiral_project_logo.svg/135px-Spiral_project_logo.svg.png',
		'spritopiawiki' => "//$wmgUploadHostname/spritopiawiki/1/16/YDSf115.png",
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/d/d0/SCLogo2.png",
		'stemorgwiki' => "//$wmgUploadHostname/stemorgwiki/3/32/Wiki_logo_fix.png",
		'sterbalfamilyrecipeswiki' => "//$wmgUploadHostname/sterbalfamilyrecipeswiki/c/c4/Logo-135x135.jpg",
		'stjarnfestivalenwiki' => "//$wmgUploadHostname/stjarnfestivalenwiki/1/18/Stjärnfestivalen_Logo.png",
		'studynotekrwiki' => "//$wmgUploadHostname/studynotekrwiki/b/b3/Imageedit_6_7597747851.gif",
		'sumerrawiki' => "//$wmgUploadHostname/sumerrawiki/8/88/Sumerra_Logo_Vertical_large.jpg",
		'supportdrivenwiki' => "//$wmgUploadHostname/supportdrivenwiki/c/c1/Logo_dark.png",
		'syscoopwiki' => "//$wmgUploadHostname/syscoopwiki/c/c6/Logo_ensi.jpg",
		'sysexwiki' => "//$wmgUploadHostname/sysexwiki/1/13/Sysex.png",
		'tagwiki' => "//$wmgUploadHostname/tagwiki/6/66/Tag_logo.png",
		'takethatwikiwiki' => "//$wmgUploadHostname/takethatwikiwiki/e/e8/Take_That_Wiki_Logo_Small.png",
		'talkingtomandfriendswiki' => "//$wmgUploadHostname/talkingtomandfriendswiki/6/6e/Ttafwiki_logo_2.png",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/b/bc/Wiki.png",
		'teessidehackspacewiki' => "//$wmgUploadHostname/teessidehackspacewiki/3/34/Teesside-hackspace-logo.svg",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/b/b6/Teleslogo01.png",
		'tellestiawiki' => "//$wmgUploadHostname/tellestiawiki/d/df/TClogo.png",
		'templatewiki' => "//$wmgUploadHostname/templatewiki/8/8a/Miraheze_Template_Wiki_logo.png",
		'testarkclswiki' => "//$wmgUploadHostname/testarkclswiki/5/5b/ARK_CLS-135x135.png",
		'testwiki' => "//$wmgUploadHostname/testwiki/9/99/NewLogo.png",
		'texwikiwiki' => "//$wmgUploadHostname/texwikiwiki/3/34/Texwikilogo.png",
		'theavatarchronicleswiki' => "//$wmgUploadHostname/theavatarchronicleswiki/0/05/DragonIcon.svg",
		'thecscwiki' => "//$wmgUploadHostname/thecscwiki/5/5d/CSC_logo_final.svg",
		'thefosterswiki' => "//$wmgUploadHostname/thefosterswiki/archive/c/c9/20160726073101%21Logo.png",
		'thegreatwarwiki' => "//$wmgUploadHostname/thegreatwarwiki/2/22/SoldiersLogo.png",
		'thelonsdalebattalionwiki' => "//$wmgUploadHostname/thelonsdalebattalionwiki/2/22/SoldiersLogo.png",
		'themfbclubwiki' => "//$wmgUploadHostname/themfbclubwiki/b/bc/Wiki.png",
		'thingexplainerwiki' => "//$wmgUploadHostname/thingexplainerwiki/3/33/Mainpage_logo.png",
		'thireswiki' => "//$wmgUploadHostname/thireswiki/9/9e/티레스_위키_로고.png",
		'teireawiki' => "//$wmgUploadHostname/teireawiki/e/e5/Teirea_wiki_logo.png",
		'texwikiwiki' => "//$wmgUploadHostname/texwikiwiki/e/ed/Texwikilogo2.png",
		'tiandiwiki' => "//$wmgUploadHostname/tiandiwiki/8/80/Tiandiwikilogo135.png",
		'tigerpediawiki' => "//$wmgUploadHostname/tigerpediawiki/9/9b/TP_transparent_135.png",
		'titreprovisoirewiki' => "//$wmgUploadHostname/titreprovisoirewiki/d/d4/Logo_titrepro.svg",
		'thoughtonomywikiwiki' => "//$wmgUploadHostname/thoughtonomywikiwiki/8/8c/ThoughtonomyLogo.png",
		'thedistancewiki' => "//$wmgUploadHostname/thedistancewiki/e/e2/NewWikiLogo.gif",
		'toftcricketclubwiki' => "//$wmgUploadHostname/toftcricketclubwiki/2/23/ToftLogo.png",
		'trainwiki' => "//$wmgUploadHostname/trainwiki/c/ce/Cdwk.png",
		'trashpirateswiki' => "//$wmgUploadHostname/trashpirateswiki/0/09/TrashPirateLogo.jpg",
		'travailcollaboratifwiki' => "//$wmgUploadHostname/travailcollaboratifwiki/8/83/Collaborons.jpg",
		'trexwiki' => "//$wmgUploadHostname/trexwiki/4/49/Wikit.png",
		'triforcewikiwiki' => "//$wmgUploadHostname/triforcewikiwiki/8/8f/Triforce_Wiki_Logo.png",
		'triseptsoloutionswiki' => "//$wmgUploadHostname/triseptsolutionswiki/2/25/Trisept_Logo.png",
		'trumpwiki' => "//$wmgUploadHostname/trumpwiki/c/c3/Magnifying-logo.jpg",
		'tudienwiki' => "//$wmgUploadHostname/tudienwiki/f/f0/Ftvh_Avatar.png",
		'tulpawiki' => "//$wmgUploadHostname/tulpawiki/1/10/Tulpa.info-Logo.png",
		'twswiki' => "//$wmgUploadHostname/twswiki/3/34/Tws-favicon.png",
		'tymyrddinwiki' => "//$wmgUploadHostname/tymyrddinwiki/c/c5/Ty-myrddin-logo-transparant.png",
		'ubrwikiwiki' => "//$wmgUploadHostname/ubrwikiwiki/2/24/UBR_logo.png",
		'umpcwiki' => "//$wmgUploadHostname/umpcwiki/5/53/LogoUMPC-spunta.png",
		'unoitudowiki' => "//$wmgUploadHostname/unoitudowiki/1/1b/Logo_unoi.png",
		'umemaro3dwiki' => "//$wmgUploadHostname/umemaro3dwiki/b/bc/Wiki.png",
		'uncyclopediawiki' => "//$wmgUploadHostname/uncyclopediawiki/d/d8/No_picture.png",
		'utamacrosswiki' => "//$wmgUploadHostname/utamacrosswiki/c/cb/Utamacross_logo.png",
		'valentinaprojectwiki' => "//$wmgUploadHostname//valentinaprojectwiki/9/9e/Seamly2D_logo_128x128.png",
		'vandalismwikiwiki' => "//$wmgUploadHostname//vandalismwikiwiki/b/bc/Wiki.png",
		'velcomwiki' => "//$wmgUploadHostname/velcomwiki/0/0f/Velcom_logo.png",
		'vgalimentiwiki' => "//$wmgUploadHostname/vgalimentiwiki/f/f9/Vgalimenti-logo.png",
		'viagroupiawiki' => "//$wmgUploadHostname/viagroupiawiki/2/22/ViagroupiaLogo.png",
		'vtkwiki' => "//$wmgUploadHostname/vtkwiki/d/dc/VTK_logo.png",
		'wabcwiki' => "//$wmgUploadHostname/wabcwiki/2/25/Logowabc.png",
		'wikid9220wiki' => "//$wmgUploadHostname/wikid9220wiki/1/14/Bloc_Marque_District_9220_135px.png",
		'wikiletraswiki' => "//$wmgUploadHostname/wikiletraswiki/c/c9/Logo.png",
		'wikiparkinsonwiki' => "//$wmgUploadHostname/wikiparkinsonwiki/f/fb/WikiParkinsonLogo-135.png",
		'wikipucwiki' => "//$wmgUploadHostname/wikipucwiki/9/98/Logowikifinal.png",
		'wikiversitywiki' => "//$wmgUploadHostname/wikiversitywiki/7/71/Wikiversity-Miraheze-temporary-logo.png",
		'whentheycrywiki' => "//$wmgUploadHostname/whentheycrywiki/b/b5/Logo_m.png",
		'wokeusbwiki' => "//$wmgUploadHostname/wokeusbwiki/1/19/WOKEWIKI.png",
		'worldofkirbycraftwiki' => "//$wmgUploadHostname/worldofkirbycraftwiki/2/2f/WoKWikiLogo.png",
		'worldpediawiki' => "//$wmgUploadHostname/worldpediawiki/b/bc/Wiki.png",
		'wikibregiswiki' => "//$wmgUploadHostname/wikibregiswiki/1/1a/Logo_wiki_brégis.jpg",
		'wikidolphinhansenwiki' => "//$wmgUploadHostname/wikidolphinhansenwiki/b/bf/Dolphin-icon-150.png",
		'wikipoliticuswiki' => "//$wmgUploadHostname/wikipoliticuswiki/9/94/WikipolisLogo.png",
		'wikipucwiki' => "//$wmgUploadHostname/wikipucwiki/f/fb/Logo_finito_trans.png",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/0/02/WWlogo.png",
		'wishwiki' => "//$wmgUploadHostname/wishwiki/c/c6/Tamers_internet.png",
		'worldpediaenwiki' => "//$wmgUploadHostname/worldpediaenwiki/b/bc/Wiki.png",
		'worlduniversityandschoolwiki' => "//$wmgUploadHostname/worlduniversityandschoolwiki/6/60/WorldUnivAndSchLogo2017-08-18Wave.png",
		'zendariwiki' => "//$wmgUploadHostname/zendariwiki/9/91/Zendari_Logo_4by4.png",
		'zharkunuwiki' => "//$wmgUploadHostname/zharkunuwiki/4/41/Zharkunu_Logo_-_135.png",
		'zhdelwiki' => "//$wmgUploadHostname/zhdelwiki/b/b8/Icono_archivo_borrar.png",
		
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
		'alwikiwiki' => 'America/New_York',
		'bigforestwiki' => 'Asia/Seoul',
		'calexitwiki' => 'America/Los_Angeles',
		'casuarinawiki' => 'Asia/Shanghai',
		'coldbloodedwiki' => 'Asia/Seoul',
		'doinwiki' => 'Asia/Seoul',
		'doraemonpediawiki' => 'Asia/Taipei',
		'hantpediawiki' => 'Asia/Taipei',
		'internetpediawiki' => 'Asia/Taipei',
		'kaiwiki' => 'Pacific/Honolulu',
		'kstartupswiki' => 'Asia/Seoul',
		'libertywiki' => 'Asia/Seoul',
		'lunfengwiki' => 'Asia/Taipei',
		'nenawikiwiki' => 'America/New_York',
		'ontariobrasswiki' => 'America/Toronto',
		'proxybotwiki' => 'America/Chicago',
		'revitwiki' => 'Pacific/Honolulu',
		'reviwiki' => 'Asia/Seoul',
		'reviwbwiki' => 'Asia/Seoul',
		'reviwikiwiki' => 'Asia/Seoul',
		'sau226wiki' => 'Australia/Perth',
		'shortwikiwiki' => 'Asia/Seoul',
		'tensorflowlearningwiki' => 'Asia/Shanghai',
		'thelonsdalebattalionwiki' => 'Europe/London',
		'wikapediawiki' => 'Asia/Taipei',
		'wixosswiki' => 'Asia/Shanghai',
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
			'arms\.institute',
			'athenapedia\.org',
			'b1tes\.org',
			'bconnected\.aidanmarkham\.com',
			'bebaskanpengetahuan\.org',
			'boulderwiki\.org',
			'wiki\.ameciclo\.org',
			'wiki\.autocountsoft\.com',
			'wiki\.besuccess\.com',
			'wiki\.clonedeploy\.org',
			'wiki\.ciptamedia\.org',
			'wiki\.consentcraft\.uk',
			'dariawiki\.org',
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
			'wiki\.grottocenter\.org',
			'www\.iceposeidonwiki\.com',
			'wiki\.inebriation-confederation\.com',
			'haxion\.space',
			'wiki\.jacksonheights\.nyc',
			'karagash\.info',
			'wiki\.kourouklides\.com',
			'kunwok\.org',
			'www\.lab612\.at',
			'wiki\.labby\.io',
			'wiki\.ldmsys\.net',
			'wiki\.lostminecraftminers\.org',
			'wiki\.lspdfr\.de',
			'lodge\.jsnydr\.com',
			'wiki\.make717\.org',
			'wiki\.macc\.nyc',
			'madgenderscience\.wiki',
			'marinebiodiversitymatrix\.org',
			'meregos\.com',
			'morfarkulten\.tk',
			'nenawiki\.org',
			'nonbinary\.wiki',
			'wiki\.lbcomms\.co.za',
			'wiki\.rizalespe\.com',
			'wiki\.simplicitysolutionsgroup\.com',
			'wiki\.staraves-no\.cz',
			'oecumene\.org',
			'oneagencydunedin\.wiki',
			'www\.openonderwijs\.org',
			'oyeavdelingen\.org',
			'papelor\.io',
			'penalwiki\.awiki\.org',
			'permanentfuturelab\.wiki',
			'pl\.nonbinary\.wiki',
			'podpedia\.org',
			'programming\.red',
			'publictestwiki\.com',
			'pwiki.arkcls.com',
			'reviwiki\.info',
			'private\.revi.wiki',
			'wiki\.rpgbrigade\.org',
			'saveta\.org',
			'sdiy\.info',
			'www\.splat-teams\.com',
			'takethatwiki\.com',
			'wiki\.teessidehackspace\.org\.uk',
			'wiki\.tensorflow\.community',
			'thelonsdalebattalion\.co.uk',
			'wiki\.tulpa\.info',
			'universebuild\.com',
			'wiki\.valentinaproject.org',
			'wiki\.kaisaga.com',
			'wikiescola\.com\.br',
			'wiki\.worlduniversityandschool\.org'.
			'wikipuk\.cl',
			'wisdomwiki\.org',
			'wiki\.wishcert\.com',
			'sandbox\.wisdomwiki.org',
			'savage-wiki\.com',
			'speleo\.wiki',
			'www\.zenbuddhism\.info',
			'wiki\.zymonic\.com',
			'espiral\.org',
			'spiral\.wiki',
			'wiki\.coldblooded\.ga',
			'wikibase\.revi\.wiki',
			'wiki\.teamwizardry\.com',
		),
	),

	// VisualEditor
	'wmgVisualEditorEnableDefault' => array(
		'default' => true,
		'allthetropeswiki' => false,
		'isvwiki' => false,
		'jcswiki' => true,
		'malaysiawiki' => true,
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
		'+cristianopediawiki' => array(
			NS_TEMA => true,
		),		
		'+espiralwiki' => array(
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
	),
	'wgVisualEditorShowBetaWelcome' => array(
		'default' => true,
		'isvwiki' => false,
		'jcswiki' => false,
	),
	'wgVisualEditorSupportedSkins' => array(
		'default' => array(),
		'permanentfuturelabwiki' => array( 'foreground' ),
		'pfsolutions' => array( 'metrolook' ),
	),
	'wgVisualEditorUseSingleEditTab' => array(
		'default' => false,
		'coldbloodedwiki' => true,
		'espiralwiki' => true,
		'isvwiki' => true,
		'spiralwiki' => true,
	),

	// Protect site config
	'wgProtectSiteLimit' => array(
		'default' => '1 week',
		'infectopedwiki' => 'indefinite',
		'tnoteswiki' => 'indefinite',
	),
	'wgProtectSiteDefaultTimeout' => array(
		'default' => '1 hour',
		'infectopedwiki' => '2 hours',
		'tnoteswiki' => '2 hours',
	),

	// WebChat config
	'wmgWebChatServer' => array(
		'default' => false,
		'allthetropeswiki' => 'irc.freenode.net',
		'extloadwiki' => 'irc.freenode.net',
		'ildrilwiki' => 'irc.sorcery.net',
		'lothuialethwiki' => 'irc.sorcery.net',
		'pnphilotenwiki' => 'irc.freenode.net',
		'wisdomwikiwiki' => 'irc.freenode.net',
	),
	'wmgWebChatChannel' => array(
		'default' => false,
		'allthetropeswiki' => '#miraheze-allthetropes',
		'extloadwiki' => '#miraheze-staff',
		'ildrilwiki' => '#Aesir',
		'lothuialethwiki' => '#Aesir',
		'pnphilotenwiki' => '#miraheze-pnphiloten',
		'wisdomwikiwiki' => '#miraheze-wisdomwiki',
	),
	'wmgWebChatClient' => array(
		'default' => false,
		'allthetropeswiki' => 'freenodeChat',
		'extloadwiki' => 'freenodeChat',
		'ildrilwiki' => 'Mibbit',
		'lothuialethwiki' => 'Mibbit',
		'pnphilotenwiki' => 'freenodeChat',
		'wisdomwikiwiki' => 'freenodeChat',
	),

	// Whitelist
	'wmgUseMainPageWhitelist' => array(
		'default' => true,
		'rwsaleswiki' => false,
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

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 14;
$snImportant = true; // Set to true if the sitenotice should be show regardless of if wikis want it to be shown

// Write your SiteNotice below.  Comment out this section to disable.
/*$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;
	 if ( !$wmgSiteNoticeOptOut || $snImportant ) {
		$siteNotice .= <<<EOF
		<table class="wikitable" style="text-align:center;"><tbody><tr>
		<td>Our VPS provider, RamNode, is performing maintenance on one of the servers used to host our VPSes. Therefore there will be downtime around 10:00 UTC and all wikis will be read-only starting 9:30 UTC, so make sure to save all your changes before then. ETA is approximately 2 hours from the initial time given. Please see our <a href="https://www.facebook.com/miraheze/">Facebook</a> or our <a href="https://twitter.com/miraheze">Twitter</a> for more updates.</p></td>
		</tr></tbody></table>
EOF;
	 }
	return true;
}
*/

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

// Define last - Extension message files for loading extensions
if ( !defined( 'MW_NO_EXTENSION_MESSAGES' ) ) {
	require_once( "/srv/mediawiki/config/ExtensionMessageFiles.php" );
}
