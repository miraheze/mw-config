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

// metawiki
define( 'NS_TECH', 1600 );
define( 'NS_TECH_TALK', 1601 );

// quantixwiki
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

// ReviWiki
define( 'NS_SERVER', 1616 );
define( 'NS_SERVER_TALK', 1617);

// catboxwiki
define( 'NS_COMIC', 1618 );
define( 'NS_COMIC_TALK', 1619 );

// allthetropeswiki
define( 'NS_TROPEWORKSHOP', 1620 );
define( 'NS_TROPEWORKSHOP_TALK', 1621 );

// safiriawiki
define( 'NS_HOENN', 1622 );
define( 'NS_HOENN_TALK', 1623 );

// developmentwiki
define( 'NS_OFFICIAL', 1624 );
define( 'NS_OFFICIAL_TALK', 1625 );

// AdnovumWiki (AdnovumRP) and others
define( 'NS_PORTAL', 1626 );
define( 'NS_PORTAL_TALK', 1627 );

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
	'wgSpamBlacklistFiles' => array(
		'default' => array(
			"https://meta.wikimedia.org/w/index.php?title=Spam_blacklist&action=raw&sb_ver=1",
		),
	),
	'wgTitleBlacklistSources' => array(
		'default' => array(
			array(
				'type' => 'url',
				'src' => 'https://meta.wikimedia.org/w/index.php?title=Title_blacklist&action=raw',
			),
		),
	),
	// BetaFeatures
	'wgMediaViewerIsInBeta' => array(
		'default' => false,
		'allthetropeswiki' => true,
	),
	'wgPopupsBetaFeature' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'ndtestwiki' => true,
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
				'server' => 25 * 60, // 25 minutes
				'client' => 60 * 60, // 1 hour
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
			'anuwiki.com' => 'anuwiki',
			'antiguabarbudacalypso.com' => 'antiguabarbudacalypsowiki',
			'boulderwiki.org' => 'boulderwikiwiki',
			'carving.wiki' => 'carvingwiki',
			'haxion.space' => 'haxionspacewiki',
			'oneagencydunedin.wiki' => 'oneagencydunedinwiki',
			'oyeavdelingen.org' => 'oyeavdelingenwiki',
			'permanentfuturelab.wiki' => 'permanentfuturelabwiki',
			'private.revi.wiki' => 'reviwiki',
			'publictestwiki.com' => 'testwiki',
			'spiral.wiki' => 'spiralwiki',
			'universebuild.com' => 'universebuildwiki',
			'wiki.dottorconte.eu' => 'dottorcontewiki',
			'wiki.dwplive.com' => 'dwplivewiki',
			'wikiparkinson.org' => 'wikiparkinsonwiki',
			'wiki.printmaking.be' => 'printmakingbewiki',
			'wiki.valentinaproject.org' => 'valentinaprojectwiki',
			'wiki.zepaltusproject.com' => 'zepaltusprojectwiki',
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
		// 'allthetropeswiki' => 'Due to an issue with the MediaWiki upgrade, we\'ll keep All The Tropes in read-only mode to fix some upgrade issues. Sorry for the inconvenience, and please email sysadmin [at] miraheze [dot] org if you have any questions.',
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

	// Disable editing
	'wmgDisableAnonEditing' => array(
		'default' => false,
		'8stationwiki' => true,
		'adnovumwiki' => true,
		'antiguabarbudacalypsowiki' => true,
		'carvingwiki' => true,
		'christipediawiki' => true,
		'clementsworldbuildingwiki' => true,
		'dottorcontewiki' => true,
		'drunkenpeasantswikiwiki' => true,
		'forexwiki' => true,
		'fieldresearchwiki' => true,
		'freecollegeprojectwiki' => true,
		'geodatawiki' => true,
		'izanagiwiki' => true,
		'kl6fwiki' => true,
		'micropediawiki' => true,
		'microsoftwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'ricwiki' => true,
		'softwarecrisiswiki' => true,
		'snowthegamewiki' => true,
		'sylwiki' => true,
		'thoughtonomywikiwiki' => true,
		'touhouenginewiki' => true,
		'turkcesozlukwiki' => true,
		'vrgowiki' => true,
		'welcomewiki' => true,
		'wikiacawiki' => true,
		'walthamstowlabourwiki' => true,
	),
	'wmgDisableUserEditing' => array(
		'default' => false,
		'chrisipediawiki' => true,
		'forexwiki' => true,
		'geodatawiki' => true,
		'vrgowiki' => true,
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
	'wmgUseAddHTMLMetaAndTitle' => array(
		'default' => false,
		'extloadwiki' => true,
		'partupwiki' => true,
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
		'ndtestwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'szkwiki' => true,
		'testwiki' => true,
		'tochkiwiki' => true,
		'touhouenginewiki' => true,
		'walthamstowlabourwiki' => true,
		'yggdrasilwiki' => true,
	),
	'wmgUseBabel' => array(
		'default' => true,
	),
	'wmgUseBetaFeatures' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'ndtestwiki' => true,
	),
	'wmgUseCharInsert' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'cssandjsschoolboardwiki' => true,
		'extloadwiki' => true,
		'ndtestwiki' => true,
		'walthamstowlabourwiki' => true,
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
	),
	'wmgUseComments' => array(
		'default' => false,
		'extloadwiki' => true,
		'ezdmfwiki' => true,
		'openconstitutionwiki' => true,
		'priyowiki' => true,
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
		'ndtestwiki' => true,
		'webflowwiki' => true,
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
	),
	'wmgUseEchoThanks' => array(
		'default' => true,
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
		'mecanonwiki' => true,
		'ndtestwiki' => true,
		'oyeavdelingenwiki' => true,
		'permanentfuturelabwiki' => true,
		'priyowiki' => true,
		'ricwiki' => true,
		'spiralwiki' => true,
		'touhouenginewiki' => true,
		'universebuildwiki' => true,
		'walthamstowlabourwiki' => true,
		'wisdomwikiwiki' => true,
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
	),
	'wmgUseInputBox' => array(
		'default' => true,
		'allthetropeswiki' => false, // breaks editing
		'newcolumbiawiki' => true,
		'simonjonwiki' => true,
	),
	'wmgUseJosa' => array(
		'default' => false,
		'extloadwiki' => true,
		'reviwiki' => true,
	),
	'wmgUseLoopsCombo' => array(
		'default' => false,
		'bgowiki' => true,
		'eotewiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseMsPackage' => array(
		'default' => false,
		'catboxwiki' => true,
		'extloadwiki' => true, //do not set this to false without disabling MsUpload on all wikis below
		'gameswiki' => true,
		'quantixwiki' => true,
		'urho3dwiki' => true,
	),
	//MsUpload is enabled on extloadwiki via MsPackage
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
		'ndtestwiki' => true,
		'oyeavdelingenwiki' => true,
		'poserdazfreebieswiki' => true,
		'priyowiki' => true,
		'snowthegamewiki' => true,
		'universebuildwiki' => true,
		'webflowwiki' => true,
	),
	'wmgUseMultimediaViewer' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'ndtestwiki' => true,
	),
	'wmgUseMobileFrontend' => array(
		'default' => true,
		'izanagiwiki' => false,
	),
	'wmgUseMonaco' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true, 
	),
	'wmgUseNativeSvgHandler' => array(
	    'default' => true,
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
	),
	'wmgUseNoTitle' => array(
		'default' => false,
		'aktposwiki' => true,
		'carvingwiki' => true,
		'developmentwiki' => true,
		'extloadwiki' => true,
		'lbsgeswiki' => true,
		'luckandlogicwiki' => true,
		'ndtestwiki' => true,
		'openconstitutionwiki' => true,
		'universebuildwiki' => true,
		'urho3dwiki' => true,
	),
	'wmgUsePageNotice' => array(
		'default' => false,
		'extloadwiki' => true,
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
	),
	'wmgUsePopups' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'christipediawiki' => true,
		'extloadwiki' => true,
		'ndtestwiki' => true,
		'walthamstowlabourwiki' => true,
	),
	'wmgUsePoll' => array(
		'default' => false,
		'extloadwiki' => true,
		'lclwiki' => true,
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
	'wmgUseSandboxLink' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'idtestwiki' => true,
		'ndtestwiki' => true,
	),
	'wmgUseScratchBlocks' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseScribunto' => array(
		'default' => false,
		'adnovumwiki' => true,
		'aescapeswiki' => true,
		'airwiki' => true,
		'allthetropeswiki' => true,
		'antiguabarbudacalypsowiki' => true,
		'aktposwiki' => true,
		'aryamanwiki' => true,
		'avionwiki' => true,
		'biblicalwikiwiki' => true,
		'bgowiki' => true,
		'buswiki' => true,
		'boulderwikiwiki' => true,
		'catboxwiki' => true,
		'cbmediawiki' => true,
		'cssandjsschoolboardwiki' => true,
		'dalarwiki' => true,
		'developmentwiki' => true,
		'diavwiki' => true,
		'dmwwiki' => true,
		'extloadwiki' => true,
		'gameswiki' => true,
		'humorpediawiki' => true,
		'idtestwiki' => true,
		'iqtwiki' => true,
		'izanagiwiki' => true,
		'jbkwwiki' => true,
		'kurumiwiki' => true,
		'lclwikiwiki' => true,
		'lifelinewiki' => true,
		'librewiki' => true,
		'luismark2015wiki' => true,
		'meregoswiki' => true,
		'missionalwisdomwiki' => true,
		'ndtestwiki' => true,
		'newhudsoniawiki' => true,
		'newknowledgewiki' => true,
		'novahistoriaewiki' => true,
		'ontariobrasswiki' => true,
		'panoramawiki' => true,
		'partupwiki' => true,
		'pflanzenwiki' => true,
		'poserdazfreebieswiki' => true,
		'poserdazfreebiestestwiki' => true,
		'pqwiki' => true,
		'quantixwiki' => true,
		'rawdatawiki' => true,
		'reriawiki' => true,
		'safiriawiki' => true,
		'sfrepresentuswiki' => true,
		'shoppingwiki' => true,
		'sirikotwiki' => true,
		'simonjonwiki' => true,
		'specialeducationwiki' => true,
		'spiralwiki' => true,
		'stellachronicawiki' => true,
		'stormfmwiki' => true,
		'stoutofreachwiki' => true,
		'studynotekrwiki' => true,
		'szkwiki' => true,
		'tanodswiki' => true,
		'tmewiki' => true,
		'tyrolmountainswiki' => true,
		'universebuildwiki' => true,
		'wdbwiki' => true,
		'walthamstowlabourwiki' => true,
		'whentheycrywiki' => true,
		'whufcyouthwiki' => true,
		'worldofkirbycraftwiki' => true,
		'newcolumbiawiki' => true,
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
		'apolcourseswiki' => true,
		'extloadwiki' => true,
		'idtestwiki' => true,
	),
	// Requires copying of two directories: https://www.mediawiki.org/wiki/Extension:SocialProfile#Directories
	// Requires run of update.php
	'wmgUseSocialProfile' => array(
		'default' => false,
		'adnovumwiki' => true,
		'datachronwiki' => true,
		'extloadwiki' => true,
		'micropediawiki' => true,
		'stellachronicawiki' => true,
		'stoutofreachwiki' => true,
		'priyowiki' => true,
	),
	'wmgUseSubpageFun' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
	),
	// Possible cause of HHVM crashes
	'wmgUseSyntaxHighlight' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'datasciencewiki' => true,
		'cssandjsschoolboardwiki' => true,
		'extloadwiki' => true,
		'ezdmfwiki' => true,
		'idtestwiki' => true,
		'ndtestwiki' => true,
		'pascalscada' => true,
		'priyowiki' => true,
		'sizzlecookiewiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'touhouenginewiki' => true,
		'urho3dwiki' => true,
		'valentinaprojectwiki' => true,
		'wikicervanteswiki' => true,
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
	),
	'wmgUseTitleKey' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'walthamstowlabourwiki' => true,
	),
	'wmgUseTranslate' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'extloadwiki' => true,
		'metawiki' => true,
		'stellachronicawiki' => true,
		'spiralwiki' => true,
		'rtwiki' => true,
		'testwiki' => true,
		'valentinaprojectwiki' => true,
		'welcomewiki' => true,
	),
	'wmgUseVisualEditor' => array(
		'default' => false, // Please make sure parsoid is enabled on modules/parsoid/manifests/init.pp or modules/parsoid/templates/settings.js (custom domains only)
		'8stationwiki' => true,
		'aacenterpriselearningwiki' => true,
		'adnovumwiki' => true,
		'aescapeswiki' => true,
		'airwiki' => true,
		'alanpediawiki' => true,
		'allbanks2wiki' => true,
		'allthetropeswiki' => true,
		'aktposwiki' => true,
		'applebranchwiki' => true,
		'arabudlandwiki' => true,
		'arguwikiwiki' => true,
		'aryamanwiki' => true,
		'atheneumwiki' => true,
		'augustinianumwiki' => true,
		'bgowiki' => true,
		'biblicalwikiwiki' => true,
		'boulderwikiwiki' => true,
		'braindumpwiki' => true,
		'carvingwiki' => true,
		'cbmediawiki' => true,
		'chandruswethswiki' => true,
		'christipediawiki' => true,
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
		'extloadwiki' => true,
		'elainarmuawiki' => true,
		'ernaehrungsrathhwiki' => true,
		'esswaywiki' => true,
		'etpowiki' => true,
		'evawiki' => true,
		'ezdmfwiki' => true,
		'fishpercolatorwiki' => true,
		'foodsharinghamburgwiki' => true,
		'gameswiki' => true,
		'geirpediawiki' => true,
		'genwiki' => true,
		'grandtheftwikiwiki' => true,
		'hftqmswiki' => true,
		'hobbieswiki' => true,
		'hshsinfoportalwiki' => true,
		'hsoodenwiki' => true,
		'idtestwiki' => true,
		'islamwissenschaftwiki' => true,
		'izanagiwiki' => true,
		'lbsgeswiki' => true,
		'lclwikiwiki' => true,
		'littlebigplanetwiki' => true,
		'lizardwiki' => true,
		'luckandlogicwiki' => true,
		'lunfengwiki' => true,
		'mecanonwiki' => true,
		'meregoswiki' => true,
		'metawiki' => true,
		'mydegreewiki' => true,
		'ndtestwiki' => true,
		'newcolumbiawiki' => true,
		'newknowledgewiki' => true,
		'newtrendwiki' => true,
		'nidda23wiki' => true,
		'nwpwiki' => true,
		'oyeavdelingenwiki' => true,
		'openconstitutionwiki' => true,
		'panoramawiki' => true,
		'partupwiki' => true,
		'pflanzenwiki' => true,
		'priyowiki' => true,
		'pqwiki' => true,
		'permanentfuturelabwiki' => true,
		'qwertywiki' => true,
		'rawdatawiki' => true,
		'recherchesdocumentaireswiki' => true,
		'ricwiki' => true,
		'safiriawiki' => true,
		'shoppingwiki' => true,
		'snowthegamewiki' => true,
		'soshomophobiewiki' => true,
		'stellachronicawiki' => true,
		'studynotekrwiki' => true,
		'simonjonwiki' => true,
		'sirikotwiki' => true,
		'spiralwiki' => true,
		'taylorwiki' => true,
		'teleswikiwiki' => true,
		'testwiki' => true,
		'tmewiki' => true,
		'tochkiwiki' => true,
		'torejorgwiki' => true,
		'touhouenginewiki' => true,
		'unikumwiki' => true,
		'universebuildwiki' => true,
		'urho3dwiki' => true,
		'valentinaprojectwiki' => true,
		'vrgowiki' => true,
		'walthamstowlabourwiki' => true,
		'webflowwiki' => true,
		'wikicervanteswiki' => true,
		'wisdomwikiwiki' => true,
		'yggdrasilwiki' => true,
	),
	'wmgUseVariables' => array(
		'default' => false,
		'allthetropeswiki' => true,
		'bgowiki' => true,
		'extloadwiki' => true,
		'eotewiki' => true,
		'szkwiki' => true,
		'walthamstowlabourwiki' => true,
	),
	'wmgUseWikiEditor' => array(
		'default' => true,
	),
	// When enabling WikiForum on wikis, update.php must be manually run on that wiki!
	'wmgUseWikiForum' => array(
		'default' => false,
		'entropediawiki' => true,
		'extloadwiki' => true,
		'indexwiki' => true,
		'stellachronicawiki' => true,
		'wikicervanteswiki' => true,
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
		'freecollegeprojectwiki' => true,
		'gameswiki' => true,
        'geirpediawiki' => true,
		'islamwissenschaftwiki' => true,
		'izanagiwiki' => true,
		'lclwikiwiki' => true,
		'lifewiki' => true,
		'luckandlogicwiki' => true,
		'ndtestwiki' => true,
		'ontariobrasswiki' => true,
		'priyowiki' => true,
		'szkwiki' => true,
		'testwiki' => true,
		'twplantwiki' => true,
		'valentinaprojectwiki' => true,
		'wisdomwikiwiki' => true,
		'worldpediawiki' => true,
		'webflowwiki' => true,
		'urho3dwiki' => true,
	),

	// External link target
	'wgExternalLinkTarget' => array(
		'default' => false,
		'forexwiki' => '_blank',
		'sylwiki' => '_blank',
		'vrgowiki' => '_blank',
	),

	// Files
	'wgEnableUploads' => array(
		'default' => true,
		'testwiki' => true,
	),
	'wgAllowCopyUploads' => array(
		'default' => false,
		'catboxwiki' => true,
		'entropediawiki' => true,
		'ndtestwiki' => true,
		'quantixwiki' => true,
	),
	'wgCopyUploadsFromSpecialUpload' => array(
		'default' => false,
		'catboxwiki' => true,
		'entropediawiki' => true,
		'ndtestwiki' => true,
		'quantixwiki' => true,
	),
	'wgFileExtensions' => array(
		'default' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf' ),
		'+oyeavdelingenwiki' => array( 'docx', 'doc', 'odt', 'ods', 'odp', 'xls', 'xlsx')
	),
	'wgUseInstantCommons' => array(
		'default' => true,
	),
	'wgEnableImageWhitelist' => array(
		'default' => false,
	),

	// Flow
	'wmgFlowOccupyNamespaces' => array(
		'default' => array(),
		'8sationwiki' => array(
			NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK, 
			NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK
		),
		'drunkenpeasantswikiwiki' => array(
			NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK, 
			NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK
		),
		'permanentfuturelabwiki' => array(
			NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK, 
			NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK
		),
		'spiralwiki' => array(
			NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK,
			NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK
		),
		'walthamstowlabourwiki' => array(
			NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK,
			NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK
		),
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
		'spiralwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
		'universebuildwiki' => "https://meta.miraheze.org/w/resources/assets/licenses/cc-by-nc-sa.png",
	),
	'wgRightsPage' => array(
		'default' => '',
		'developmentwiki' => 'Official:Copyrights',
		'diavwiki' => 'Project:Copyrights',
		'quantixwiki' => 'Project:Copyrights',
	),
	'wgRightsText' => array(
		'default' => 'Creative Commons Attribution Share Alike',
		'diavwiki' => 'All Rights Reserved',
		'oyeavdelingenwiki' => 'All Rights Reserved',
		'safiriawiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
		'spiralwiki' => 'CC0 Public Domain',
		'universebuildwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike',
	),
	'wgRightsUrl' => array(
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/',
		'safiriawiki' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
		'spiralwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
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

	// MirahezeMagic
	// https://meta.miraheze.org/wiki/Dormancy_Policy/Exceptions
	'wgFindInactiveWikisWhitelist' => array(
		'default' => array(
			'metawiki',
			'allthetropeswiki',
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
		'nissanecuwiki' => true,
	),

	// Mobile
	'wgMFAutodetectMobileView' => array(
		'default' => true,
	),
	
	// MsCatSelect vars
	'wgMSCS_WarnNoCategories' => array( // MSCatSelect (from MsPackage) option
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
		'tmewiki' => array(
			NS_PORTAL => 'Portal',
			NS_PORTAL_TALK => 'Portal_talk',
		),
	),
	'wgContentNamespaces' => array(
		'default' => array( NS_MAIN ),
		'catboxwiki' => array( NS_MAIN, NS_COMIC ),
		'quantixwiki' => array( NS_MAIN, NS_HL2RP, NS_ARP, NS_EVENT, NS_CLAN, NS_POE, NS_LEAGUE, NS_SMITE ),
		'reviwiki' => array( NS_MAIN, NS_SERVER ),
		'safiriawiki' => array( NS_MAIN, NS_HOENN ),
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
		'+tmewiki' => array(
			'The_Multilingual_Encyclopedia' => NS_PROJECT,
			'The_Multilingual_Encyclopedia_talk' => NS_PROJECT_TALK,
			'Bestand' => NS_FILE,
			'Categorie' => NS_CATEGORY,
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
		),
		'+unikumwiki' => array(
			NS_MAIN => true,
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
		'+christipediawiki' => array(
			'bureaucrat' => array(
				'editor',
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
		'+forexwiki' => array(
			'sysop' => array(
				'editor',
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
			'*' => array(
				'edit' => false,
				'createpage' => false,
			),
			'user' => array(
				'edit' => false,
				'createpage' => false,
			),
			'autoconfirmed' => array(
				'edit' => false,
				'createpage' => false,
			),
			'confirmed' => array(
				'edit' => false,
				'createpage' => false,
			),
			'sysop' => array(
				'edit' => true,
				'createpage' => true,
			),
		),
		'+catboxwiki' => array(
			'user' => array(
				'upload_by_url' => true,
			),
		),
		'+christipediawiki' => array(
			'editor' => array(
				'edit' => true,
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
		'+forexwiki' => array(
			'*' => array(
				'edit' => false,
			),
			'editor' => array(
				'edit' => true,
			),
		),
		'+geodatawiki' => array(
			'sysop' => array(
				'edit' => true,
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
				'noratelimit' => true,
				'userrights' => true,
				'userrights-interwiki' => true,
			),
			'sysop' => array(
				'interwiki' => true,
			),
			'wikicreator' => array(
				'createwiki' => true,
			),
		),
		'+poserdazfreebieswiki' => array(
			'*' => array(
				'edit' => false,
				'createpage' => false,
			),
			'user' => array(
				'edit' => false,
				'createpage' => false,
			),
			'autoconfirmed' => array(
				'edit' => true,
				'createpage' => true,
			),
			'confirmed' => array(
				'edit' => true,
				'createpage' => true,
			),
			'sysop' => array(
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
		'+snowthegamewiki' => array(
			'sysop' => array(
				'createpage' => true,
			),
		),
		'+szkwiki' => array(
			'*' => array(
				'edit' => false,
			),
			'user' => array(
				'edit' => false, 
			),
		),
		'+sylwiki' => array(
			'editor' => array(
				'edit' => true,
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
			'sysop' => array(
				'edit' => true,
			),
			'Teachers' => array(
				'edit' => true, 
			),
		),
		'+walthamstowlabourwiki' => array(
			'*' => array(
				'edit' => false,
			),
			'user' => array(
				'edit' => false,
			),
			'editor' => array(
				'edit' => true,
			),
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
		'lupawiki' => array(
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
		'+chrisipediawiki' => array(
			'bureaucrat' => array(
				'editor',
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
	),
	'+wgRestrictionTypes' => array(
		'default' => array(
			'delete',
		),
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
		'allthetropeswiki' => 'https://allthetropes.org',
		'antiguabarbudacalypsowiki' => 'https://antiguabarbudacalypso.com',
		'anuwiki' => 'https://anuwiki.com',
		'boulderwikiwiki' => 'https://boulderwiki.org',
		'carvingwiki' => 'https://carving.wiki',
		'dottorcontewiki' => 'https://wiki.dottorconte.eu',
		'dwplivewiki' => 'https://wiki.dwplive.com',
		'haxionspacewiki' => 'https://haxion.space',
		'oneagencydunedinwiki' => 'https://oneagencydunedin.wiki',
		'oyeavdelingenwiki' => 'https://oyeavdelingen.org',
		'permanentfuturelabwiki' => 'https://permanentfuturelab.wiki',
		'printmakingbewiki' => 'https://wiki.printmaking.be',
		'testwiki' => 'https://publictestwiki.com',
		'reviwiki' => 'https://private.revi.wiki',
		'spiralwiki' => 'https://spiral.wiki',
		'universebuildwiki' => 'https://universebuild.com',
		'valentinaprojectwiki' => 'https://wiki.valentinaproject.org',
		'wikiparkinsonwiki' => 'https://wikiparkinson.org',
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
		'ontariobrasswiki' => 'monobook',
		'permanentfuturelabwiki' => 'foreground',
		'stellachronicawiki' => 'monobook',
	),
	'wgFavicon' => array(
		'default' => '/favicon.ico',
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/6/64/Favicon.ico",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/b/be/APfavicon.png",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/8/84/Rainbowstar.png",
		'allbanks2wiki' => "//$wmgUploadHostname/allbanks2wiki/7/7f/AllBanks2Logo.png",
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
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/3/35/Favicon_%282%29.ico",
		'luckandlogicwiki' => "//$wmgUploadHostname/luckandlogicwiki/2/26/Favicon.png",
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
		'microsoftwiki' => "//$wmgUploadHostname/microsoftwiki/6/66/Logoforwiki.png",
		'thoughtonomywikiwiki' => "//$wmgUploadHostname/thoughtonomywikiwiki/2/26/Favicon.png",
		'oneagencydunedinwiki' => "//$wmgUploadHostname/oneagencydunedinwiki/d/de/OneAgency_Favicon.png",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'openconstitutionwiki' => "//$wmgUploadHostname/openconstitutionwiki/e/e3/OpnConst_favicon.png",
		'partupwiki' => "//$wmgUploadHostname/partupwiki/6/64/Favicon.ico",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/6/64/Favicon.ico",
		'rwbyfrwiki' =>	"//$wmgUploadHostname/rwbyfrwiki/c/c8/RWBYfavicon.jpg",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/f/fc/Safiria_wiki_favicon.png",
		'sfrepresentuswiki' => "//$wmgUploadHostname/sfrepresentuswiki/5/5c/Favicon_logo.png",
		'sirikotwiki' => '//sirikot.com/favicon.png',
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/9/93/Scwiki-favicon.png",
		'stoutofreachwiki' => "//$wmgUploadHostname/stoutofreachwiki/6/64/Favicon.ico",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/6/64/Favicon.ico",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/7/7f/Teleslogosmoler.png",
		'themfbclubwiki' => "//$wmgUploadHostname/themfbclubwiki/6/64/Favicon.ico",
		'titreprovisoirewiki' => "//$wmgUploadHostname/titreprovisoirewiki/0/01/Favicon_titrepro.png",
		'universebuildwiki' => "//$wmgUploadHostname/universebuildwiki/f/fd/UniversebuildFavicon.png",
		'valentinaprojectwiki' => "//$wmgUploadHostname/valentinaprojectwiki/1/1d/Valentina_logo_favicon.png",
		'wdbwiki' => "//$wmgUploadHostname/wdbwiki/2/26/Dancing-135px.png",
		'welcomewikiwiki' => "//$wmgUploadHostname/welcomewikiwiki/6/69/20150913_WelcomeWiki-Logo_Favicon32x32.png",
		'webflowwiki' => "//$wmgUploadHostname/webflowwiki/6/64/Favicon.ico",
		'wikicervanteswiki' => "//$wmgUploadHostname/wikicervanteswiki/0/08/FaviconCervantes.ico",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/6/64/Favicon.ico",
	),
	'wgLogo' => array(
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
		'8stationwiki' => "//$wmgUploadHostname/8stationwiki/3/3b/Wiki_logo.png",
		'aacenterpriselearningwiki' => "//$wmgUploadHostname/aacenterpriselearningwiki/c/c6/AACLogo.jpg",
		'adiapediawiki' => "//$wmgUploadHostname/adiapediawiki/f/f1/APlogo.png",
		'adnovumwiki' => "//$wmgUploadHostname/adnovumwiki/f/fa/AdnovumRPtemplogo.png",
		'airwiki' => "//$wmgUploadHostname/airwiki/8/8e/Logo-scadta-133x133.gif",
		'aktposwiki' => "//$wmgUploadHostname/aktposwiki/3/33/Logo-amafuwa.png",
		'allbanks2wiki' => "//$wmgUploadHostname/allbanks2wiki/7/7f/AllBanks2Logo.png",
		'allthetropeswiki' => "//$wmgUploadHostname/allthetropeswiki/8/86/Logo-Square-v1-1x.png",
		'applebranchwiki' => "//$wmgUploadHostname/applebranchwiki/0/03/AppleBranch_135.png",
		'anuwiki' => "//$wmgUploadHostname/anuwiki/8/8e/Anuwikilogo.png",
		'bakufuwiki' => "//$wmgUploadHostname/bakufuwiki/b/bc/Wiki.png",
		'bdorpwiki' => "//$wmgUploadHostname/bdorpwiki/2/22/Main_page.PNG",
		'biblicalwikiwiki' => "//$wmgUploadHostname/biblicalwikiwiki/e/e2/WikiLogo.svg",
		'carvingwiki' => "//$wmgUploadHostname/carvingwiki/5/59/Snowflake135.png",
		'christipediawiki' => "//$wmgUploadHostname/christipediawiki/e/e7/Logo_Christipedia.jpg",
		'clementsworldbuildingwiki' => "//$wmgUploadHostname/clementsworldbuildingwiki/3/39/Cw_logo.png",
		'collabvmwiki' => "//$wmgUploadHostname/collabvmwiki/c/c9/Logo.png",
		'conuconwiki' => "//phabricator.miraheze.org/file/data/o6plmtjp4afd6vvxcx2m/PHID-FILE-fzbuutpmykupn5jz256h/CONUCON_small_face.png",
		'cssandjsschoolboardwiki' => "//upload.wikimedia.org/wikipedia/commons/c/c7/Css.png",
		'crankipediawiki' => "//$wmgUploadHostname/crankipediawiki/4/4c/Crankilogo.png",
		'datachronwiki' => "//$wmgUploadHostname/datachronwiki/f/f3/1408002974_WS.png",
		'dicficwiki' => "//$wmgUploadHostname/dicficwiki/b/b1/Dicfic-logo.png",
		'diggywikipolskawiki' => "//$wmgUploadHostname/diggywikipolskawiki/8/81/Logodiggy.png",
		'drunkenpeasantswikiwiki' => "//$wmgUploadHostname/drunkenpeasantswikiwiki/b/bc/Wiki.png",
		'dwplivewiki' => "//$wmgUploadHostname/dwplivewiki/c/c0/Logo_135.png",
		'elsieworldwiki' => "//$wmgUploadHostname/elsiesworldwiki/5/51/Elsie_logo.png",
		'eotewiki' => "//$wmgUploadHostname/eotewiki/6/64/Logo_triumph.png",
		'etpowiki' => "//$wmgUploadHostname/etpowiki/1/1f/LogoETPO.gif",
		'evawiki' => "//$wmgUploadHostname/evawiki/b/bc/Wiki.png",
		'fieldresearchwiki' => "//$wmgUploadHostname/fieldresearchwiki/d/d1/Logo_c.jpg",
		'fishpercolatorwiki' => "//$wmgUploadHostname/fishpercolatorwiki/d/d2/FPLogo.png",
		'foodsharinghamburgwiki' => "//$wmgUploadHostname/foodsharinghamburgwiki/d/d2/FoodsharingHamburgLogo135px.jpg",
		'forexwiki' => "//$wmgUploadHostname/forexwiki/c/c9/Logo.png",
		'freecollegeprojectwiki' => "//$wmgUploadHostname/freecollegeprojectwiki/6/60/FC_Logo_135p.png",
		'fusiongpwiki' => "//$wmgUploadHostname/fusiongpwiki/f/f2/Fusion_Ball.png",
		'genwiki' => "//$wmgUploadHostname/genwiki/0/03/Genesis-logo-reized.png",
		'hshsinfoportalwiki' => "//$wmgUploadHostname/hshsinfoportalwiki/e/ec/HSHS_Logo.jpeg",
		'hsoodenwiki' => "//$wmgUploadHostname/hsoodenwiki/8/82/135px-wiki-logo-blank.png",
		'lbsgeswiki' => "//$wmgUploadHostname/lbsgeswiki/0/05/WikiLogo.jpg",
		'lunfengwiki' => "//$wmgUploadHostname/lunfengwiki/b/bc/Wiki.png",
		'islamwissenschaftwiki' => "//$wmgUploadHostname/islamwissenschaftwiki/b/bc/Wiki.png",
		'izanagiwiki' => "//$wmgUploadHostname/izanagiwiki/e/eb/IZLogo.png",
		'lexiquewiki' =>  "//$wmgUploadHostname/lexiquewiki/6/6d/LibraryLexique-smallRes.png",
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
		'luckandlogicwiki' => "//$wmgUploadHostname/luckandlogicwiki/2/26/Favicon.png",
		'madgendersciencewiki' => "//$wmgUploadHostname/madgendersciencewiki/1/1f/Mgs_logo.jpg",
		'mafiawiki' => "//$wmgUploadHostname/mafiawiki/a/a6/Header.png",
		'mecanonwiki' => "//$wmgUploadHostname/mecanonwiki/8/85/Mecanon_logo.png",
		'microsoftwiki' => "//$wmgUploadHostname/microsoftwiki/6/66/Logoforwiki.png",
		'moralecwiki' => "//$wmgUploadHostname/moralecwiki/e/e8/Moralec-pluto.png",
		'newcolumbiawiki' => "//$wmgUploadHostname/newcolumbiawiki/2/2a/USNC_sunflower_logo.png",
		'oneagencydunedinwiki' => "//$wmgUploadHostname/oneagencydunedinwiki/e/eb/OneAgency_WikiLogo_Black.png",
		'ontariobrasswiki' => "//$wmgUploadHostname/ontariobrasswiki/0/09/Ontariobrass.png",
		'openconstitutionwiki' => "//$wmgUploadHostname/openconstitutionwiki/4/40/LOGO.png",
		'oyeavdelingenwiki' => "//$wmgUploadHostname/oyeavdelingenwiki/7/7b/OUS_Logo.png",
		'oneironautwiki' => "//$wmgUploadHostname/oneironautwiki/7/7b/Oneironaut-Wiki-logo.png",
		'partupwiki' => "//$wmgUploadHostname/partupwiki/a/a6/Part-up-logo-150x150-mediawiki.png",
		'permanentfuturelabwiki' => "//$wmgUploadHostname/permanentfuturelabwiki/c/c0/Permanent-Future-Lab-logo-150x150-mediawiki.png",
		'printmakingbewiki' => "//$wmgUploadHostname/printmakingbewiki/2/22/Pmk-logo-wiki-135px.png",
		'priyowiki' => "//$wmgUploadHostname/priyowiki/c/c9/Logo.png",
		'rebelalliancewiki' => "//$wmgUploadHostname/rebelalliancewiki/f/fe/Logo135.png",
		'reriawiki' => "//$wmgUploadHostname/reriawiki/a/a6/Header.png",
		'reiaasuwiki' => "//$wmgUploadHostname/reiaasuwiki/1/1e/Reiaasu-wiki-logo-1.png",
		'rwbyfrwiki' =>	"//$wmgUploadHostname/rwbyfrwiki/a/a3/RWBYLogo.jpeg",
		'safiriawiki' => "//$wmgUploadHostname/safiriawiki/2/24/Newcoa_small.png",
		'sapperpediawiki' => "//$wmgUploadHostname/sapperpediawiki/f/f8/Sapperpedia_small.png",
		'sfrepresentuswiki' => "//$wmgUploadHostname/sfrepresentuswiki/4/41/RepUsLogo_small.png",
		'sirikotwiki' => '//www.sirikot.com/wiki_logo.png',
		'snowthegamewiki' => "//$wmgUploadHostname/snowthegamewiki/8/89/SNOW_logo_wiki.png",
		'sqlserverwiki' => "//$wmgUploadHostname/sqlserverwiki/d/d4/Logo.jpg",
		'spiralwiki' => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Spiral_project_logo.svg/135px-Spiral_project_logo.svg.png',
		'stellachronicawiki' => "//$wmgUploadHostname/stellachronicawiki/d/d0/SCLogo2.png",
		'stormfmwiki' => "//$wmgUploadHostname/stormfmwiki/1/18/Stormlogo_small.png",
		'stoutofreachwiki' => "//$wmgUploadHostname/stoutofreachwiki/b/bc/Wiki.png",
		'studynotekrwiki' => "//$wmgUploadHostname/studynotekrwiki/b/b3/Imageedit_6_7597747851.gif",
		'tmewiki' => "//$wmgUploadHostname/tmewiki/b/bc/Wiki.png",
		'teleswikiwiki' => "//$wmgUploadHostname/teleswikiwiki/b/b6/Teleslogo01.png",
		'terriblespacewiki' => "//$wmgUploadHostname/terriblespacewiki/e/eb/Terrible_space_logo.png",
		'testwiki' => "//$wmgUploadHostname/testwiki/9/99/NewLogo.png",
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
		'worldofkirbycraftwiki' => "//$wmgUploadHostname/worldofkirbycraftwiki/2/2f/WoKWikiLogo.png",
		'wikicervanteswiki' => "//$wmgUploadHostname/wikicervanteswiki/0/0c/LogodelWiki.png",
		'wisdomwikiwiki' => "//$wmgUploadHostname/wisdomwikiwiki/0/02/WWlogo.png",
		'yggdrasilwiki' => "//$wmgUploadHostname/yggdrasilwiki/c/cd/Yggdrasil-logo.png",
	),

	// Timezone
	'wgLocaltimezone' => array(
		'default' => 'UTC',
		'alanpediawiki' => 'Asia/Taipei',
		'carvingwiki' => 'America/Denver',
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

# Will remove this later --SPF
if ( $wgDBname == 'extloadwiki' || $wgDBname == 'allthetropeswiki' ) {
	require_once( "$IP/extensions/DPLForum/DPLforum.php" );
	require_once( "$IP/extensions/LiquidThreads/LiquidThreads.php" );
	wfLoadExtension( 'MultiBoilerplate' );
	$wgMultiBoilerplateDisplaySpecialPage = true;
	$wgMultiBoilerplateOptions = false;
	require_once( "$IP/extensions/CustomData/CustomData.php" );
	require_once( "$IP/extensions/RelatedArticles/RelatedArticles.php" );
	require_once( "$IP/extensions/SubPageList3/SubPageList3.php" );
}

$wgDefaultUserOptions['enotifwatchlistpages'] = 0;

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
