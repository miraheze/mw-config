<?php
/*
LocalSettings.php for Miraheze.
Authors of initial version: John Lewis, Southparkfan, Orain contributors
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

$wmgHostname = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : null;

// Namespaces (please count upwards from 1600 to avoid any conflicts!)

// metawiki
define( 'NS_TECH', 1600 );
define( 'NS_TECH_TALK', 1601 );

// QuantixWiki
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
	'wgResourceLoaderMaxage' => array(
		'versioned' => array(
			'server' => 30 * 24 * 60 * 60,
			'client' => 30 * 24 * 60 * 60,
		),
		'unversioned' => array(
			'server' => 20 * 60,
			'client' => 20 * 60,
		),
	),

	// CentralAuth
	'wgCentralAuthAutoNew' => array(
		'default' => true,
	),
	'wgCentralAuthAutoLoginWikis' => array(
		'default' => array(
			'anuwiki.com' => 'anuwiki',
			'spiral.wiki' => 'spiralwiki',
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

	// CreateWiki
	'wmgCreateWikiSQLfiles' => array(
		'default' => array(
		        "$IP/maintenance/tables.sql",
		        "$IP/extensions/AbuseFilter/abusefilter.tables.sql",
		        "$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
		        "$IP/extensions/CheckUser/cu_log.sql",
		        "$IP/extensions/CheckUser/cu_changes.sql",
		        "$IP/extensions/Echo/echo.sql",
			"$IP/extensions/Flow/flow.sql",
		        "$IP/extensions/GlobalBlocking/localdb_patches/setup-global_block_whitelist.sql",
			"$IP/extensions/Math/db/math.mysql.sql",
			"$IP/extensions/Math/db/mathlatexml.mysql.sql",
			"$IP/extensions/Math/db/mathoid.mysql.sql",
			"$IP/extensions/OAuth/backend/schema/mysql/OAuth.sql",
			"$IP/extensions/OAuth/backend/schema/mysql/callback_is_prefix.sql",
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
		),
	),

	// Database
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

	// Disable anon editing
	'wmgDisableAnonEditing' => array(
		'default' => false,
		'antiguabarbudacalypsowiki' => true,
	),

	// Extensions
	'wmgUseBabel' => array(
		'default' => true,
	),
	'wmgUseCreateWiki' => array(
		'default' => false,
		'metawiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseDynamicPageList' => array(
		'default' => false,
		'camerainfowiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseEchoThanks' => array(
		'default' => true,
	),
	'wmgUseFlow' => array(
		'default' => false,
		'extloadwiki' => true,
		'spiralwiki' => true,
		'spiraltestwiki' => true,
	),
	'wmgUseMultiUpload' => array(
		'default' => false,
		'extloadwiki' => true,
		'quantixwiki' => true,
	),
	'wmgUseScribunto' => array(
		'default' => false,
		'antiguabarbudacalypsowiki' => true,
		'extloadwiki' => true,
		'kurumiwiki' => true,
		'quantixwiki' => true,
		'spiralwiki' => true,
		'spiraltestwiki' => true,
	),
	'wmgUseTranslate' => array(
		'default' => false,
		'extloadwiki' => true,
		'metawiki' => true,
		'spiralwiki' => true,
		'spiraltestwiki' => true,
		'testwiki' => true,
	),
	'wmgUseVisualEditor' => array(
		'default' => false, // Please consult John before changing variables here! -John
		'extloadwiki' => true,
		'spiralwiki' => true,
		'torejorgwiki' => true,
	),
	'wmgUseWikiEditor' => array(
		'default' => true,
	),

	// Files
	'wgEnableUploads' => array(
		'default' => true,
	),
	'wgAllowCopyUploads' => array(
		'default' => false,
		'quantixwiki' => true,
	),
	'wgCopyUploadsFromSpecialUpload' => array(
		'default' => false,
		'quantixwiki' => true,
	),
	'wgFileExtensions' => array(
		'default' => array( 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf' ),
	),
	'wgUseInstantCommons' => array(
		'default' => true,
	),

	// Flow
	'wmgFlowOccupyNamespaces' => array(
		'default' => array(),
		'spiralwiki' => array(
			NS_TALK, NS_USER_TALK, NS_PROJECT_TALK, NS_FILE_TALK,
			NS_MEDIAWIKI_TALK, NS_TEMPLATE_TALK, NS_HELP_TALK, NS_CATEGORY_TALK
		),
		'spiraltestwiki' => array(
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
		'spiralwiki' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-0.png',
	),
	'wgRightsPage' => array(
		'default' => '',
	),
	'wgRightsText' => array(
		'default' => 'Creative Commons Attribution Share Alike',
		'spiralwiki' => 'CC0 Public Domain',
	),
	'wgRightsUrl' => array(
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/',
		'spiralwiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
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

	// Math
	'wgTexvc' => array(
		'default' => '/usr/bin/texvc',
	),

	// MassMessage
	'wgAllowGlobalMessaging' => array(
		'default' => false,
		'metawiki' => true,
	),

	// Misc stuff
	'wgSitename' => array(
		'default' => 'No sitename set!',
	),

	// Mobile
	'wgMFAutodetectMobileView' => array(
		'default' => true,
	),

	// Namespaces
	'wgExtraNamespaces' => array(
		'default' => array(),
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
	),
	'wgContentNamespaces' => array(
		'default' => array( NS_MAIN ),
		'quantixwiki' => array( NS_MAIN, NS_HL2RP, NS_ARP, NS_EVENT, NS_CLAN, NS_POE, NS_LEAGUE, NS_SMITE ),
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
		'+dpwiki' => array(
			'bureaucrat' => array(
				'respected',
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
		'+testwiki' => array(
			'bureaucrat' => array(
				'testgroup',
			),
			'consul' => array(
				'bot',
				'bureaucrat',
				'consul',
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
		'+testwiki' => array(
			'bureaucrat' => array(
				'bureaucrat' => true,
			),
			'consul' => array(
				'read' => true,
				'consul' => true,
			),
		),
	),
	'wgGroupsRemoveFromSelf' => array(
		'default' => array(),
		'quantixwiki' => array(
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
		'+testwiki' => array(
			'bureaucrat' => array(
				'testgroup',
			),
			'consul' => array(
				'bot',
				'bureaucrat',
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
		'anuwiki' => 'https://anuwiki.com',
		'spiralwiki' => 'https://spiral.wiki',
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
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
	),
	'wgLogo' => array(
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
		'anuwiki' => "//$wmgUploadHostname/anuwiki/8/8e/Anuwikilogo.png",
		'linuxwiki' => "//$wmgUploadHostname/linuxwiki/f/f2/Linuxwikilogo.png",
		'mafiawiki' => "//$wmgUploadHostname/mafiawiki/a/a6/Header.png",
		'spiralwiki' => '//upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Spiral_project_logo.svg/135px-Spiral_project_logo.svg.png',
		'testwiki' => "//$wmgUploadHostname/testwiki/9/99/Mirahezetestwiki.png",
	),

	// Timezone
	'wgLocaltimezone' => array(
		'default' => 'UTC',
		'reviwiki' => 'Asia/Seoul',
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
} elseif ( preg_match( '/^www\.(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
    $wgDBname = $matches[1] . 'wiki';
} elseif ( $search = array_search( 'http://' . $wmgHostname, $wgConf->settings['wgServer'] ) ) {
	$wgDBname = $search;
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
$wgUploadDirectory = "/srv/mediawiki-static/$wgDBname";
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
	'alt' => 'Powered by Miraheze',
);

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
