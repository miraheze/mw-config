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

	// CentralAuth
	'wgCentralAuthAutoNew' => array(
		'default' => true,
	),
	'wgCentralAuthAutoLoginWikis' => array(
		'default' => array(
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
			"$IP/extensions/GlobalBlocking/localdb_patches/setup-global_block_whitelist.sql",
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

	// Extensions
	'wmgUseBabel' => array(
		'default' => true,
	),
	'wmgUseWikiEditor' => array(
		'default' => false,
		'extloadwiki' => true,
	),
	'wmgUseCreateWiki' => array(
		'default' => false,
		'metawiki' => true,
		'extloadwiki' => true,
	),
	'wmgUseEchoThanks' => array(
		'default' => true,
	),
	'wmgUseFlow' => array(
		'default' => false,
		'extloadwiki' => true,
		'parsoidwiki' => true,
		'spiralwiki' => true,
	),
	'wmgUseTranslate' => array(
		'default' => false,
		'extloadwiki' => true,
		'metawiki' => true,
		'spiralwiki' => true,
	),
	'wmgUseVisualEditor' => array(
		'default' => false, // Do not enable. -John
	),

	// Files
	'wgEnableUploads' => array(
		'default' => true,
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
	),

	// GlobalBlocking
	'wgApplyGlobalBlocks' => array(
		'default' => true,
		'metawiki' => false,
	),
	'wgGlobalBlockingDatabase' => array(
		'default' => 'centralauth', // use centralauth for global blocks
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

	// MassMessage
	'wgAllowGlobalMessaging' => array(
		'default' => false,
		'metawiki' => true,
	),

	// Misc stuff
	'wgSitename' => array(
		'default' => 'No sitename set!',
	),

	// Permissions
	'wgAddGroups' => array(
		'default' => array(
			'bureaucrat' => array(
				'bot',
				'sysop',
				'bureaucrat',
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
			'bureaucrat' => array(
				'renameuser' => false,
				'userrights' => false,
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
			'sysop' => array(
				'abusefilter-modify' => true,
				'abusefilter-modify-restricted' => true,
				'abusefilter-revert' => true,
				'deletelogentry' => true,
				'deleterevision' => true,
				'massmessage' => false,
				'rollback' => true,
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
			'wikicreator' => array(
				'createwiki' => true,
			),
		),
	),
	'wgRemoveGroups' => array(
		'default' => array(
			'bureaucrat' => array(
				'bot',
				'sysop',
			),
		),
	),

	     // License
	'wgRightsIcon' => array(
		'default' => "//$wmgUploadHostname/common/skins/common/images/cc-by-sa.png",
	),
	'wgRightsPage' => array(
		'default' => '',
	),
	'wgRightsText' => array(
		'default' => 'Creative Commons Attribution Share Alike',
	),
	'wgRightsUrl' => array(
		'default' => 'https://creativecommons.org/licenses/by-sa/3.0/',

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
	'wgDefaultSkin' => array(
		'default' => 'vector',
	),
	'wgLogo' => array(
		'default' => "//$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
		'spiralwiki' => "//$wmgUploadHostname/spiralwiki/f/fa/Espiralogo.svg",
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
} elseif ( preg_match( '/^www\.(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgDBname = $matches[1] . 'wiki';
} elseif ( preg_match( '/^(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgDBname = $matches[1] . 'wiki';
} elseif ( $search = array_search( 'http://' . $wmgHostname, $wgConf->settings['wgServer'] ) ) {
	$wgDBname = $search;
} elseif ( $search = array_search( 'https://' . $wmgHostname, $wgConf->settings['wgServer'] ) ) {
	$wgDBname = $search;
} else {
	$wgDBname = false;
}

# Initialize dblist (ensure metawiki is always up even in the
# case of a corrupt dblist)
$wgLocalDatabases = array( 'metawiki' );
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

require_once( "/srv/mediawiki/config/GlobalLogging.php" );
require_once( "/srv/mediawiki/config/RedisConfig.php" );

// wgGroupPermissions which don't work when set in $wgConf->settings
$wgGroupPermissions['bureaucrat']['userrights'] = false;

// Needs to be set AFTER $wgDBname is set to a correct value
$wgUploadDirectory = "/srv/mediawiki-static/$wgDBname";
$wgUploadPath = "https://static.miraheze.org/$wgDBname";


if ( isset( $wgConf->settings['wmgPrivateWiki'][$wgDBname] ) ) {
	$wgGroupPermissions['*']['read'] = false;
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['writeapi'] = false;
	$wgGroupPermissions['user']['read'] = false;
	$wgGroupPermissions['user']['edit'] = false;
	$wgGroupPermissions['user']['upload'] = false;
	$wgGroupPermissions['user']['writeapi'] = false;
	$wgGroupPermissions['user']['emailuser'] = false;
	$wgGroupPermissions['member']['read'] = true;
	$wgGroupPermissions['member']['edit'] = true;
	$wgGroupPermissions['member']['emailuser'] = true;
	$wgGroupPermissions['member']['upload'] = true;
	$wgGroupPermissions['member']['writeapi'] = true;
	$wgAddGroups['bureaucrat'] = array( 'bot', 'sysop', 'bureaucrat', 'member' );
	$wgRemoveGroups['bureaucrat'] = array( 'bot', 'sysop', 'member' );
	$wgWhitelistRead =
		array(
			"Main Page",
			"Special:UserLogin",
			"Special:UserLogout",
			"Special:ResetPassword",
			"MediaWiki:Common.css",
			"Special:CentralAutoLogin",
			"Special:CentralLogin",
			"Special:ConfirmEmail"
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

$wgCaptchaClass = 'QuestyCaptcha';
$myChallengeString = substr( md5( uniqid( mt_rand(), true ) ), 0, 8 );
$myChallengeIndex = rand(0, 7) + 1;
$myChallengePositions = array( 'first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth' );
$myChallengePositionName = $myChallengePositions[$myChallengeIndex - 1];
$wgCaptchaQuestions[] = array(
        'question' => "Please provide the $myChallengePositionName character from
the sequence <code>$myChallengeString</code>:",
        'answer' => $myChallengeString[$myChallengeIndex - 1]
);

if ( !in_array( $wgDBname, $wgLocalDatabases ) ) {
	header( "HTTP/1.0 404 Not Found" );
	echo <<<EOF
	<center><h1>404 Wiki Not Found</h1></center>
	<hr>
	<center>nginx - MediaWiki</center>
EOF;
	die( 1 );
}
