<?php

/** LocalSettings.php for Miraheze. */

// Don't allow web access.
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

if ( PHP_SAPI !== 'cli' ) {
	header( "Cache-control: no-cache" );
}

setlocale( LC_ALL, 'en_US.UTF-8' );

// test also because it acts as its own jobrunner.
$mwtask = str_starts_with( wfHostname(), 'mwtask' ) ||
	str_starts_with( wfHostname(), 'test' );

// Higher on mwtask
if ( $mwtask ) {
	// 3000MiB
	ini_set( 'memory_limit', 3000 * 1024 * 1024 );
} else {
	// 1400MiB
	ini_set( 'memory_limit', 1400 * 1024 * 1024 );
}

// Configure PHP request timeouts.
if ( PHP_SAPI === 'cli' ) {
	$wgRequestTimeLimit = 0;
} elseif ( $mwtask ) {
	$host = $_SERVER['HTTP_HOST'] ?? '';
	if ( str_starts_with( $host, 'videoscaler.' ) ) {
		$wgRequestTimeLimit = 86400;
	} elseif ( str_starts_with( $host, 'jobrunner-high.' ) || str_starts_with( wfHostname(), 'test' ) ) {
		$wgRequestTimeLimit = 259200;
	} else {
		$wgRequestTimeLimit = 1200;
	}
} elseif ( ( $_SERVER['REQUEST_METHOD'] ?? '' ) === 'POST' ) {
	$wgRequestTimeLimit = 200;
} else {
	$wgRequestTimeLimit = 60;
}

/**
 * When using ?forceprofile=1, a profile can be found as an HTML comment
 * Disabled on production hosts because it seems to be causing performance issues (how ironic)
 */
$forceprofile = (int)( $_GET['forceprofile'] ?? 0 );
if ( $forceprofile === 1 && extension_loaded( 'xhprof' ) ) {
	$xhprofFlags = XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS;
	xhprof_enable( $xhprofFlags );

	$wgProfiler = [
		'class' => ProfilerXhprof::class,
		'flags' => $xhprofFlags,
		'running' => true,
		'output' => 'text',
	];

	// Don't need a global here
	unset( $xhprofFlags );

	$wgHTTPTimeout = 60;
} elseif ( PHP_SAPI === 'cli' && extension_loaded( 'xhprof' ) ) {
	$xhprofFlags = XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS;

	$wgProfiler = [
		'class' => ProfilerXhprof::class,
		'flags' => $xhprofFlags,
		'output' => 'text',
	];

	// Don't need a global here
	unset( $xhprofFlags );
}

// Show custom database maintenance error page on these clusters.
$wgDatabaseClustersMaintenanceType = 'unscheduled';
$wgDatabaseClustersMaintenance = [];

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
$wi = new MirahezeFunctions();

// Load PrivateSettings (e.g. $wgDBpassword)
require_once '/srv/mediawiki/config/PrivateSettings.php';

// Load global skins and extensions
require_once '/srv/mediawiki/config/GlobalExtensions.php';
require_once '/srv/mediawiki/config/GlobalSkins.php';

$wgPasswordSender = 'noreply@miraheze.org';
$wmgUploadHostname = 'static.wikitide.net';

// bast161, bast181
$servers = [ '10.0.16.127', '10.0.18.101' ];
$proxy = 'http://' . $servers[ array_rand( $servers ) ] . ':8080';

$proxyGlobals = [
	'wgHTTPProxy',
	'wgDiscordCurlProxy',
	'wgCopyUploadProxy',
	'wgMediaModerationHttpProxy',
	'wgMathHTTPProxy',
	'wgRottenLinksHTTPProxy',
	'wgRSSProxy',
	'wgTorBlockProxy',
	'wgHCaptchaProxy',
];

foreach ( $proxyGlobals as $global ) {
	$GLOBALS[ $global ] = $proxy;
}

// Don't need globals here
unset( $proxy, $proxyGlobals, $servers );

$wgStatsFormat = 'dogstatsd';
$wgStatsTarget = 'udp://localhost:9125';

$wmgSharedDomainPathPrefix = '';

$wgScriptPath = '/w';
$wgLoadScript = "$wgScriptPath/load.php";

$wgCanonicalServer = $wi->server;

if ( ( $_SERVER['HTTP_HOST'] ?? '' ) === $wi->getSharedDomain()
	|| getenv( 'MW_USE_SHARED_DOMAIN' )
) {
	if ( $wi->dbname === 'ldapwikiwiki' ) {
		print "Can only be used for SUL wikis\n";
		exit( 1 );
	}

	$wmgSharedDomainPathPrefix = "/$wgDBname";
	$wgScriptPath  = "$wmgSharedDomainPathPrefix/w";

	$wgCanonicalServer = 'https://' . $wi->getSharedDomain();
	$wgLoadScript = "{$wgCanonicalServer}$wgScriptPath/load.php";

	$wgUseSiteCss = false;
	$wgUseSiteJs = false;

	// We use load.php directly from auth for custom domains due to CSP
	$wgCentralAuthSul3SharedDomainRestrictions['allowedEntryPoints'] = [ 'load' ];
}

$wgScript = "$wgScriptPath/index.php";

$wgResourceBasePath = "$wmgSharedDomainPathPrefix/{$wi->version}";
$wgExtensionAssetsPath = "$wgResourceBasePath/extensions";
$wgStylePath = "$wgResourceBasePath/skins";
$wgLocalStylePath = $wgStylePath;

$wgConf->settings += [
	// Invalidates user sessions - do not change unless it is an emergency!
	'wgAuthenticationTokenVersion' => [
		'default' => '11',
	],

	'wgEnableEditRecovery' => [
		'default' => true
	],

	'wgPrivilegedGroups' => [
		'default' => [ 'bureaucrat', 'checkuser', 'interface-admin', 'suppress', 'sysop' ],
		'+metawiki' => [ 'steward', 'techteam' ],
	],

	'wgParserEnableUserLanguage' => [
		'default' => false,
		'utgwiki' => true,
	],

	// 3D
	'wg3dProcessor' => [
		'ext-3d' => [
			'/usr/bin/xvfb-run',
			'-a',
			'-s',
			'-ac -screen 0 1280x1024x24',
			'/srv/3d2png/src/3d2png.js',
		],
	],

	// AbuseFilter
	'wgAbuseFilterActions' => [
		'default' => [
			'block' => true,
			'blockautopromote' => true,
			'degroup' => false,
			'disallow' => true,
			'rangeblock' => false,
			'tag' => true,
			'throttle' => true,
			'warn' => true,
		],
	],
	'wgAbuseFilterCentralDB' => [
		'default' => 'metawiki',
		'beta' => 'metawikibeta',
	],
	'wgAbuseFilterIsCentral' => [
		'default' => false,
		'metawiki' => true,
		'metawikibeta' => true,
	],
	'wgAbuseFilterBlockDuration' => [
		'default' => 'indefinite',
	],
	'wgAbuseFilterAnonBlockDuration' => [
		'default' => 2592000,
	],
	'wgAbuseFilterNotifications' => [
		'default' => 'udp',
	],
	'wgAbuseFilterLogPrivateDetailsAccess' => [
		'default' => true,
	],
	'wgAbuseFilterPrivateDetailsForceReason' => [
		'default' => true,
	],
	'wgAbuseFilterEmergencyDisableThreshold' => [
		'default' => [
			'default' => 0.05,
		],
	],
	'wgAbuseFilterEmergencyDisableCount' => [
		'default' => [
			'default' => 2,
		],
	],

	// AdminLinks
	'wgAdminLinksDelimiter' => [
		'default' => '•',
	],

	// Anti-spam
	'wgAccountCreationThrottle' => [
		'default' => [
			[
				'count' => 3,
				'seconds' => 300,
			],
			[
				'count' => 10,
				'seconds' => 86400,
			],
		],
	],

	// AdvancedSearch
	// Added due to T14186
	'wgAdvancedSearchDeepcatEnabled' => [
		'default' => false,
	],

	'wgPasswordAttemptThrottle' => [
		'default' => [
			// this is X attempts per IP globally
			// user accounts are not taken into consideration
			[
				/** 5 attempts in 5 minutes */
				'count' => 5,
				'seconds' => 300,
			],
			[
				/** 40 attempts in 24 hours */
				'count' => 40,
				'seconds' => 86400,
			],
			[
				/** 60 attempts in 48 hours */
				'count' => 60,
				'seconds' => 172800,
			],
			[
				/** 75 attempts in 72 hours */
				'count' => 75,
				'seconds' => 259200,
			],
		],
	],
	// https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SpamBlacklist#Block_list_syntax
	'wgBlacklistSettings' => [
		'default' => [
			'spam' => [
				'files' => [
					'https://meta.miraheze.org/wiki/MediaWiki:Global_spam_blacklist?action=raw&sb_ver=1',
				],
			],
		],
		'beta' => [
			'spam' => [
				'files' => [
					'https://meta.mirabeta.org/wiki/MediaWiki:Global_spam_blacklist?action=raw&sb_ver=1',
				],
			],
		],
	],
	'wgLogSpamBlacklistHits' => [
		'default' => true,
	],

	// ApprovedRevs
	'egApprovedRevsAutomaticApprovals' => [
		'default' => true,
	],
	'egApprovedRevsBlankFileIfUnapproved' => [
		'default' => false,
	],
	'egApprovedRevsBlankIfUnapproved' => [
		'default' => false,
	],
	'egApprovedRevsEnabledNamespaces' => [
		'default' => [
			NS_MAIN => true,
			NS_USER => true,
			NS_FILE => true,
			NS_TEMPLATE => true,
			NS_HELP => true,
			NS_PROJECT => true
		],
	],
	'egApprovedRevsFileAutomaticApprovals' => [
		'default' => true,
	],
	'egApprovedRevsFileShowApproveLatest' => [
		'default' => false,
	],
	'egApprovedRevsShowApproveLatest' => [
		'default' => false,
	],
	'egApprovedRevsShowNotApprovedMessage' => [
		'default' => false,
	],

	// ArticleCreationWorkflow
	'wgArticleCreationLandingPage' => [
		'default' => 'Project:Article wizard',
	],
	'wgUseCustomLandingPageStyles' => [
		'default' => true,
	],

	// ArticlePlaceholder
	'wgArticlePlaceholderImageProperty' => [
		'default' => 'P18',
	],
	'wgArticlePlaceholderReferencesBlacklist' => [
		'default' => 'P143',
	],
	'wgArticlePlaceholderSearchEngineIndexed' => [
		'default' => false,
	],
	'wgArticlePlaceholderRepoApiUrl' => [
		'default' => 'https://www.wikidata.org/w/api.php',
	],

	// Babel
	'wgBabelCategoryNames' => [
		'default' => [
			'0' => 'User %code%-0',
			'1' => 'User %code%-1',
			'2' => 'User %code%-2',
			'3' => 'User %code%-3',
			'4' => 'User %code%-4',
			'5' => 'User %code%-5',
			'N' => 'User %code%-N',
		],
	],
	'wgBabelMainCategory' => [
		'default' => 'User %code%',
	],

	// BetaFeatures
	'wgMediaViewerIsInBeta' => [
		'default' => false,
	],
	'wgVisualEditorEnableWikitextBetaFeature' => [
		'default' => false,
	],
	'wgVisualEditorEnableDiffPageBetaFeature' => [
		'default' => false,
	],
	'wgPopupsReferencePreviewsBetaFeature' => [
		'default' => true,
	],

	// Block
	'wgAutoblockExpiry' => [
		// 24 hours * 60 minutes * 60 seconds
		'default' => 86400,
	],
	'wgBlockAllowsUTEdit' => [
		'default' => true,
	],
	'wgEnableBlockNoticeStats' => [
		'default' => false,
	],
	'wgEnablePartialActionBlocks' => [
		'default' => true,
	],

	// Cache
	'wgCacheDirectory' => [
		'default' => '/srv/mediawiki/cache',
	],
	'wgExtensionEntryPointListFiles' => [
		'default' => [
			'/srv/mediawiki/config/extension-list'
		],
	],

	// CampaignEvents
	'wgCampaignEventsProgramsAndEventsDashboardInstance' => [
		'default' => null,
	],
	'wgCampaignEventsEnableWikimediaParticipantQuestions' => [
		'default' => true,
	],

	// Captcha
	'wgCaptchaTriggers' => [
		'default' => [
			'edit' => false,
			'create' => false,
			'sendemail' => false,
			'addurl' => true,
			'createaccount' => true,
			'badlogin' => true,
			'badloginperuser' => true
		],
		'+metawiki' => [
			'contactpage' => true,
		],
		'+ext-WikiForum' => [
			'wikiforum' => true,
		],
	],
	'wgHCaptchaSiteKey' => [
		'default' => 'e6d26503-a3fb-47fb-9639-efe259a34a33',
	],

	// Cargo
	'wgCargoDBuser' => [
		'default' => 'cargouser2024',
	],
	'wgCargoFileDataColumns' => [
		'default' => [],
	],
	'wgCargoPageDataColumns' => [
		'default' => [],
		'dmlwikiwiki' => [
			'creationDate',
			'modificationDate',
			'creator',
			'fullText',
			'categories',
			'numRevisions',
			'isRedirect',
		],
	],

	// Categories
	'wgCategoryCollation' => [
		// updateCollation.php should be ran after changing
		'default' => 'uppercase',
		'extoniawiki' => 'uca-fr',
		'holidayswiki' => 'numeric',
		'levyraatiwikiwiki' => 'numeric',
		'historikawiki' => 'uca-cs',
		'omniversumwiki' => 'uca-cs',
		'rapanuidictionaryprojectwiki' => 'uca-es',
		'ext-CategorySortHeaders' => CustomHeaderCollation::class,
	],
	'wgCategoryPagingLimit' => [
		'default' => 200,
	],

	// CategoryTree
	'wgCategoryTreeDefaultMode' => [
		'default' => 0,
	],
	'wgCategoryTreeCategoryPageMode' => [
		'default' => 0,
	],
	'wgCategoryTreeMaxDepth' => [
		'default' => [ 10 => 1, 20 => 1, 0 => 2 ],
		'100acgwiki' => [ 10 => 5, 20 => 2, 0 => 4, 100 => 1 ],
	],

	// CentralAuth
	'wgCentralAuthAutoCreateWikis' => [
		'default' => [
			'loginwiki',
			'metawiki',
		],
		'beta' => [
			'loginwikibeta',
			'metawikibeta',
		],
	],
	'wgCentralAuthAutoMigrate' => [
		'default' => true,
	],
	'wgCentralAuthAutoMigrateNonGlobalAccounts' => [
		'default' => true,
	],
	'wgCentralAuthCentralWiki' => [
		'default' => 'metawiki',
		'beta' => 'metawikibeta',
	],
	'wgCentralAuthCookies' => [
		'default' => true,
	],
	'wgCentralAuthCookiePrefix' => [
		'default' => 'centralauth_',
		'beta' => 'betacentralauth_',
	],
	'wgCentralAuthEnableGlobalRenameRequest' => [
		'default' => true,
	],
	'wgCentralAuthGlobalBlockInterwikiPrefix' => [
		'default' => 'meta',
	],
	'wgCentralAuthLoginWiki' => [
		'default' => 'loginwiki',
		'beta' => 'loginwikibeta',
	],
	'wgCentralAuthOldNameAntiSpoofWiki' => [
		'default' => 'metawiki',
		'beta' => 'metawikibeta',
	],
	'wgCentralAuthPreventUnattached' => [
		'default' => true,
	],
	'wgCentralAuthRestrictSharedDomain' => [
		'default' => true,
	],
	'wmgCentralAuthAutoLoginWikis' => [
		'default' => [
			'.miraheze.org' => 'metawiki',
		],
		'beta' => [
			'.mirabeta.org' => 'metawikibeta',
		],
	],
	'wgGlobalRenameDenylist' => [
		'default' => 'https://meta.miraheze.org/wiki/MediaWiki:Global_rename_blacklist?action=raw',
		'beta' => 'https://meta.mirabeta.org/wiki/MediaWiki:Global_rename_blacklist?action=raw',
	],
	'wgGlobalRenameDenylistRegex' => [
		'default' => true,
	],

	// CentralNotice
	'wgNoticeInfrastructure' => [
		'default' => false,
		'metawiki' => true,
		'metawikibeta' => true,
	],
	'wgCentralSelectedBannerDispatcher' => [
		'default' => 'https://meta.miraheze.org/wiki/Special:BannerLoader',
		'beta' => 'https://meta.mirabeta.org/wiki/Special:BannerLoader',
	],
	'wgCentralBannerRecorder' => [
		'default' => 'https://meta.miraheze.org/wiki/Special:RecordImpression',
		'beta' => 'https://meta.mirabeta.org/wiki/Special:RecordImpression',
	],
	'wgCentralHost' => [
		'default' => 'https://meta.miraheze.org',
		'beta' => 'https://meta.mirabeta.org',
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

	// Chameleon
	'egChameleonLayoutFile' => [
		'default' => '/srv/mediawiki/config/chameleon-layouts/standard.xml',
	],
	'egChameleonEnableExternalLinkIcons' => [
		'default' => false,
	],

	// CheckUser
	'wgCheckUserForceSummary' => [
		'default' => true,
	],
	'wgCheckUserEnableSpecialInvestigate' => [
		'default' => true,
	],
	'wgCheckUserLogLogins' => [
		'default' => true,
	],
	'wgCheckUserCAtoollink' => [
		'default' => 'metawiki',
		'beta' => 'metawikibeta',
	],
	'wgCheckUserGBtoollink' => [
		'default' => [
			'centralDB' => 'metawiki',
			'groups' => [
				'steward',
			],
		],
		'beta' => [
			'centralDB' => 'metawikibeta',
			'groups' => [
				'steward',
			],
		],
	],
	'wgCheckUserCAMultiLock' => [
		'default' => [
			'centralDB' => 'metawiki',
			'groups' => [
				'steward',
				'trustandsafety',
			],
		],
		'beta' => [
			'centralDB' => 'metawikibeta',
			'groups' => [
				'steward',
				'trustandsafety',
			],
		],
	],
	'wgCheckUserGlobalContributionsCentralWikiId' => [
		'default' => null,
		// 'default' => 'metawiki',
		//'beta' => 'metawikibeta',
	],

	// CirrusSearch
	'wgCirrusSearchPrefixSearchStartsWithAnyWord' => [
		'default' => false,
		'rainversewiki' => true,
	],

	// Citizen
	'wgCitizenThemeDefault' => [
		'default' => 'auto',
	],
	'wgCitizenEnableCollapsibleSections' => [
		'default' => true,
	],
	'wgCitizenGlobalToolsPortlet' => [
		'default' => '',
	],
	'wgCitizenShowPageTools' => [
		'default' => 1,
	],
	'wgCitizenThemeColor' => [
		'default' => '#131a21',
	],
	'wgCitizenSearchGateway' => [
		'default' => 'mwActionApi',
	],
	'wgCitizenSearchDescriptionSource' => [
		'default' => 'textextracts',
	],
	'wgCitizenMaxSearchResults' => [
		'default' => 6,
	],
	'wgCitizenEnableCommandPalette' => [
		'default' => true,
	],
	'wgCitizenEnableCJKFonts' => [
		'default' => false,
	],
	'wgCitizenOverflowNowrapClasses' => [
		'default' => [
			'citizen-table-nowrap',
			'cargoDynamicTable',
			'dataTable',
			'smw-datatable',
			'srf-datatable',
		],
	],
	'wgCitizenHeaderPosition' => [
		'default' => 'left',
	],

	// CodeMirror
	'wgCodeMirrorV6' => [
		'default' => false,
	],

	// Comments
	'wgCommentsDefaultAvatar' => [
		'default' => '/' . $wi->version . '/extensions/SocialProfile/avatars/default_ml.gif',
	],
	'wgCommentsInRecentChanges' => [
		'default' => false,
	],
	'wgCommentsSortDescending' => [
		'default' => false,
	],

	// CommentStreams
	'wgCommentStreamsEnableSearch' => [
		'default' => true,
	],
	'wgCommentStreamsNewestStreamsOnTop' => [
		'default' => false,
	],
	'wgCommentStreamsUserAvatarPropertyName' => [
		'default' => null,
	],
	'wgCommentStreamsEnableVoting' => [
		'default' => false,
	],
	'wgCommentStreamsModeratorFastDelete' => [
		'default' => false,
	],
	'wgCommentStreamsSuppressLogsFromRCs' => [
		'default' => true,
	],

	// CommonsMetadata
	'wgCommonsMetadataForceRecalculate' => [
		'default' => false,
	],

	// ConfirmEdit
	'wgConfirmEditEnabledAbuseFilterCustomActions' => [
		'default' => [
			'showcaptcha',
		],
	],

	// Contribution Scores
	'wgContribScoreDisableCache' => [
		'default' => true,
	],
	'wgContribScoreIgnoreBots' => [
		'default' => false,
	],

	// Cookies
	'wgCookieExpiration' => [
		'default' => 30 * 86400,
	],
	'wgCookieSameSite' => [
		'default' => 'None',
	],
	'wgCookieSetOnAutoblock' => [
		'default' => true,
	],
	'wgCookieSetOnIpBlock' => [
		'default' => true,
	],
	'wgExtendedLoginCookieExpiration' => [
		'default' => 365 * 86400,
	],

	// Cosmos
	'wgCosmosBackgroundImage' => [
		'default' => false,
	],
	'wgCosmosBackgroundImageFixed' => [
		'default' => true,
	],
	'wgCosmosBackgroundImageRepeat' => [
		'default' => false,
	],
	'wgCosmosBackgroundImageSize' => [
		'default' => 'cover',
	],
	'wgCosmosBannerBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosButtonBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosContentBackgroundColor' => [
		'default' => '#ffffff',
	],
	'wgCosmosContentWidth' => [
		'default' => 'default',
	],
	'wgCosmosContentOpacityLevel' => [
		'default' => 100,
	],
	'wgCosmosEnablePortableInfoboxEuropaTheme' => [
		'default' => true,
	],
	'wgCosmosEnabledRailModules' => [
		'default' => [
			'recentchanges' => 'normal',
			'interface' => [
				'cosmos-custom-rail-module' => 'normal',
				'cosmos-custom-sticky-rail-module' => 'sticky',
			],
		],
	],
	'wgCosmosEnableWantedPages' => [
		'default' => false,
		'batmanwiki' => true,
		'snapwikiwiki' => true,
	],
	'wgCosmosFooterBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosLinkColor' => [
		'default' => '#0645ad',
	],
	'wgCosmosMainBackgroundColor' => [
		'default' => '#1A1A1A',
	],
	'wgCosmosMaxSearchResults' => [
		'default' => 6,
	],
	'wgCosmosSearchDescriptionSource' => [
		'default' => 'textextracts',
	],
	'wgCosmosSearchUseActionAPI' => [
		'default' => true,
	],
	'wgCosmosSocialProfileAllowBio' => [
		'default' => true,
	],
	'wgCosmosSocialProfileFollowBioRedirects' => [
		'default' => false,
	],
	'wgCosmosSocialProfileModernTabs' => [
		'default' => true,
	],
	'wgCosmosSocialProfileNumberofGroupTags' => [
		'default' => 2,
	],
	'wgCosmosSocialProfileRoundAvatar' => [
		'default' => true,
	],
	'wgCosmosSocialProfileShowEditCount' => [
		'default' => true,
	],
	'wgCosmosSocialProfileShowGroupTags' => [
		'default' => true,
	],
	'wgCosmosSocialProfileTagGroups' => [
		'default' => [
			'bureaucrat',
			'bot',
			'sysop',
			'interface-admin'
		],
	],
	'wgCosmosToolbarBackgroundColor' => [
		'default' => '#000000',
	],
	'wgCosmosUseSocialProfileAvatar' => [
		'default' => true,
	],
	'wgCosmosWikiHeaderBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosWordmark' => [
		'default' => false,
	],

	// Create Page
	'wgCreatePageEditExisting' => [
		'default' => false,
	],
	'wgCreatePageUseVisualEditor' => [
		'default' => false,
	],

	// CreatePageUw
	'wgCreatePageUwUseVE' => [
		'default' => false,
	],

	// CreateWiki
	'wgCreateWikiAIConfig' => [
		'default' => [
			'baseurl' => 'https://disabled-service.wikitide.net',
			'dryrun' => true,
			'model' => 'createwiki-ai',
		],
	],
	'wgCreateWikiAIThreshold' => [
		'default' => -1,
	],
	'wgCreateWikiDisallowedSubdomains' => [
		'default' => [
			'(.*)miraheze(.*)',
			'(.*)wikitide(.*)',
			'(.*)orain(.*)',
			'(.*)mirabeta(.*)',
			'(.*)betaheze(.*)',
			'(.*)nexttide(.*)',
			'subdomain',
			'example',
			'beta(meta)?',
			'prueba',
			'community',
			'testwiki',
			'wikitest',
			'help',
			'noc',
			'wc',
			'dc',
			'm',
			'sandbox',
			'outreach',
			'gazett?eer',
			'semantic(mediawiki)?',
			'accounts(internal)?',
			'(internal)?tech(internal)?',
			'sre',
			'smw',
			'wikitech',
			'wikis?',
			'www',
			'security',
			'donate',
			'blog',
			'health',
			'status',
			'acme',
			'ssl',
			'sslhost',
			'sslrequest',
			'letsencrypt',
			'deployment',
			'hostmaster',
			'wildcard',
			'list',
			'localhost',
			'mailman',
			'webmail',
			'phabricator',
			'static',
			'upload',
			'grafana',
			'icinga',
			'logging',
			'monitoring',
			'analytics',
			'auth',
			'csw(\d+)?',
			'matomo(\d+)?',
			'prometheus(\d+)?',
			'misc\d+',
			'db\d+',
			'cp\d+',
			'mw\d+',
			'jobrunner\d+',
			'gluster(fs)?(\d+)?',
			'ns\d+',
			'bacula\d+',
			'mail(\d+)?',
			'ldap(wiki)?(\d+)?',
			'cloud\d+',
			'mon\d+',
			'bots(\d+)',
			'kafka(\d+)?',
			'swift(ac|fs|object|proxy)?(\d+)?',
			'lizardfs\d+',
			'elasticsearch(\d+)?',
			'rdb\d+',
			'phab(\d+)?',
			'services\d+',
			'puppet\d+',
			'test\d+',
			'dbbackup\d+',
			'graylog(\d+)?',
			'mem\d+',
			'jobchron\d+',
			'mwtask(\d+)?',
			'es\d+',
			'os\d+',
			'bast(ion)?(\d+)?',
			'reports(\d+)?',
			'(.*)wiki(pedi)?a(.*)',
			'opensearch(\d+)?',
			'mywiki',
			'phorge(\d+)?',
		],
	],
	'wgCreateWikiCannedResponses' => [
		'default' => [
			'Approval reasons' => [
				'Perfect request' => 'Perfect. Clear purpose, scope, and topic. Please ensure your wiki complies with all aspects of the Content Policy at all times and that it does not deviate from the approved scope or else your wiki may be closed. Thank you for choosing Miraheze!',
				'Good request' => 'Pretty good. Purpose and description are a bit vague, but there is nonetheless a clear enough purpose, scope, and/or topic here. Please ensure your wiki complies with all aspects of the Content Policy at all times and that it does not deviate from the approved scope or else your wiki will be closed. Thank you for choosing Miraheze!',
				'Okay request' => 'Okay-ish. Description is somewhat vague, but the sitename, URL, and categorization suggest that this is a wiki that would follow the Content Policy made clear by the preceding fields, and it is conditionally approved as such. Please be advised that if your wiki deviates too much from this approval, remedial action can be taken by a Steward, up to and including wiki closure and potential revocation of wiki requesting privileges if necessary. Please ensure your wiki complies with all aspects of Content Policy at all times. Thank you.',
				'Categorized as private' => 'The purpose and scope of your wiki is clear enough. Please ensure your wiki complies with all aspects of the Content Policy at all times or it may be closed. Please also note that I have categorized your wiki as "Private". Thank you.',
			],
			'Decline reasons' => [
				'Needs more details' => 'Can you give us more details on the purpose for, scope of, and topic of your wiki, ideally in at least 2-3 sentences? Please update your request via the "Edit request" tab and add to, but do not replace, your existing description. Thank you.',
				'Invalid or unclear subdomain' => 'The scope and purpose of your wiki seem clear enough. However, the requested subdomain is either invalid, too generic, conveys a Miraheze affiliation, or suggests that the wiki is an English language or multilingual wiki when it is not. Please change it to something that better reflects your wiki\'s purpose and scope. Thank you.',
				'Invalid sitename/subdomain (obscene wording)' => 'The scope and purpose of your wiki seem clear enough. However, the requested wiki name or subdomain is in violation of our Content Policy, which prohibits obscene wording in wiki names and subdomains. Please change it to something that is appropriate. Thank you.',
				'Use Public Test Wiki' => 'Please use Public Test Wiki (https://publictestwiki.com) to test the administrator and bureaucrat tools, as well as Miraheze since the wiki is hosted by us. Please follow all local policies, reverting all tests you perform in the reverse order which you performed them. Local permissions can be requested at TestWiki:Request permissions. Thank you.',
				'Database exists (wiki active)' => 'A wiki already exists at the selected subdomain. Please visit the local wiki and contribute there. Please reach out to any local bureaucrat to request any permissions if you require them; if bureaucrats are not active on the wiki after a reasonable period of time, please start a local election and ask a Steward to evaluate it at Steward requests. Thank you.',
				'Database exists (wiki closed)' => 'A wiki already exists at the selected subdomain selected but is closed. Please visit the Requests for reopening wikis page to request to reopen the wiki or ask for help on the Community portal.',
				'Database exists (wiki already deleted)' => 'A wiki already exists at the selected subdomain but has been deleted in accordance with the Dormancy Policy. I will request a Steward undelete it for you. When it has been undeleted and reopened, please visit the local wiki and ensure you make at least one edit or log action every 45 days. Wikis are only deleted after 6 months of complete inactivity; if you require a Dormancy Policy exemption, you should review the policy and request it once your wiki has at least 40-60 content pages. Thank you.',
				'Database exists (wiki undeleted)' => 'A wiki already exists at the selected subdomain; it was previously closed/deleted but has been reopened. Please visit the wiki and ensure you make at least one edit or log action every 45 days. Wikis are only deleted after 6 months of complete inactivity. Please reach out to any local bureaucrat to request any permissions if you require them. If bureaucrats are not active on the wiki after a reasonable period of time, please start a local election and ask a Steward to evaluate it at Steward requests. Thank you.',
				'Database exists (unrelated purpose)' => 'A wiki already exists at the selected subdomain; however, the wiki does not seem to have the same purpose as the one you are requesting here, so you will need to request a different subdomain. Please update this request once you have selected a new subdomain to reopen it for consideration.',
				'Duplicate request (not enough information)' => 'Declining as a duplicate request that needs more information. Please do not edit this request; instead, you should go back into your original request and refrain from submitting duplicate requests in the future. Thank you.',
				'Duplicate request (already approved)' => 'Declining as a duplicate of a request that has already been approved. Any changes to your wiki should be made via ManageWiki locally or requested at Steward requests or Phabricator whenever unavailable via ManageWiki. Thank you.',
				'Excessive requests' => 'Declining as you have requested an excessive amount of wikis. If you believe you have legitimate need for this amount of wikis, please reply to this request with a 2-3 sentence reasoning on why you need the wikis.',
				'Vandal request' => 'Declining as this wiki request is product of either vandalism or trolling.',
				'Content Policy (commercial activity)' => 'Declining per Content Policy provision, "The primary purpose of your wiki cannot be for commercial activity." Thank you for understanding. If in error, please edit this wiki request and articulate a clearer purpose and scope for your wiki that makes it clear how this wiki would not violate this criterion of Content Policy.',
				'Content Policy (deceive, defraud or mislead)' => 'Declining per Content Policy provision, "Miraheze does not host wikis with the sole purpose of deceiving, defrauding, or misleading people." Thank you for your understanding.',
				'Content Policy (duplicate/similar wiki)' => 'Your proposed wiki appears to duplicate, either substantially or entirely, the scope of an existing wiki, which is prohibited by the Content Policy. Please contribute to the existing wiki instead; if you feel that this is in error, please describe in a few sentences how your wiki will not violate this policy. Thank you.',
				'Content Policy (file sharing service)' => 'Declining per Content Policy provision, "Miraheze does not host wikis whose main purpose is to act as a file sharing service." Thank you for your understanding.',
				'Content Policy (forks)' => 'Declining per Content Policy provision, "Direct forks of other Miraheze wikis where no attempts at mediations are made are not allowed." Thank you for your understanding.',
				'Content Policy (illegal US activity)' => 'Declining per Content Policy provision, "Miraheze does not host any content that is illegal in the United States." Thank you for understanding. If you believe this decline reason was used incorrectly, please address this with the declining wiki reviewer on their user talk page first before escalating your concern to Steward requests. Thank you.',
				'Content Policy (makes it difficult for other wikis)' => 'Declining per Content Policy provision, "A wiki must not create problems which make it difficult for other wikis." Thank you for your understanding.',
				'Content Policy (no anarchy wikis)' => 'Declining per Content Policy provision, "Miraheze does not host wikis that operate on the basis of an anarchy system (i.e. no leadership and no rules)." Thank you for your understanding.',
				'Content Policy (sexual nature involving minors)' => 'Declining per Content Policy provision, "Miraheze does not host wikis of a sexual nature which involve minors in any way." Thank you for your understanding.',
				'Content Policy (toxic communities)' => 'Declining per Content Policy provision, "Miraheze does not host wikis where the community has developed in such a way as to be characterised as toxic." Thank you for your understanding.',
				'Content Policy (unsubstantiated insult)' => 'Declining per Content Policy provision, "Miraheze does not host wikis which spread unsubstantiated insult, hate or rumours against a person or group of people." Thank you for your understanding.',
				'Content Policy (violence, hatred or harrassment)' => 'Declining per Content Policy provision, "Miraheze does not host wikis that promote violence, hatred, or harassment against a person or group of people." Thank you for your understanding.',
				'Content Policy (Wikimedia-like wikis/forks)' => 'Declining per Content Policy provision, "Direct forks and forks where a substantial amount of content is copied from a Wikimedia project are not allowed." Thank you for your understanding.',
				'Content Policy (Reception wiki)' => 'Declining per Content Policy provision, "Wikis should not be structured around bullet-point, good/bad commentary." Thank you for your understanding.',
				'Content Policy (restricted topics)' => 'Declining per the Content Policy\'s additional restrictions, which includes the topic of your wiki. Please see [[Help:Restricted Wiki Topics]] for more information. Thank you for your understanding.',
				'Author request' => 'Declined at the request of the wiki requester.',
				'No response' => 'Since we haven\'t heard back from you, this request will now be closed. If you\'re still interested in this wiki, please respond to the questions in comments above. You can reopen the request on the "Edit request" tab to put your request back in the review queue. Thank you.',
			],
			'On hold reasons' => [
				'On hold pending response' => 'On hold pending response from the wiki requester (see the "Request Comments" tab). Please reply to the questions left by the wiki reviewer on this request, but do not create another wiki request. Thank you.',
				'On hold pending review from another wiki reviewer' => 'On hold pending review from another wiki reviewer or a Steward.',
			],
		],
	],
	'wgCreateWikiDatabaseClusters' => [
		'default' => [
			'db151 (c1)' => 'c1',
			'db161 (c2)' => 'c2',
			'db171 (c3)' => 'c3',
			'db181 (c4)' => 'c4',
		],
		'beta' => [
			'db172 (c1)' => 'c1',
		],
	],
	// Use if you want to stop wikis being created on this cluster
	'wgCreateWikiDatabaseClustersInactive' => [
		'default' => [
			// DO NOT USE S1! RESERVED FOR CORE DATABASES
			'db192 (s1)' => 's1',
		],
	],
	'wgCreateWikiDatabaseSuffix' => [
		'default' => 'wiki',
		'beta' => 'wikibeta',
	],
	'wgCreateWikiDisableRESTAPI' => [
		'default' => true,
		'metawiki' => false,
		'metawikibeta' => false,
	],
	'wgCreateWikiEmailNotifications' => [
		'default' => true,
	],
	'wgCreateWikiEnableManageInactiveWikis' => [
		'default' => true,
	],
	'wgCreateWikiNotificationEmail' => [
		// Don't put plain text email here.
		'default' => base64_decode( 'dGVjaEB3aWtpdGlkZS5vcmc=' ),
	],
	'wgCreateWikiPurposes' => [
		'default' => [
			'Select an option...' => '',
			'Alternate history wiki' => 'Alternate history wiki',
			'Class or group project education wiki' => 'Class or group project education wiki',
			'Curriculum resource wiki' => 'Curriculum resource wiki',
			'Documentation (hardware) wiki' => 'Documentation (hardware) wiki',
			'Documentation (software) wiki' => 'Documentation (software) wiki',
			'Encyclopedia (general) wiki' => 'Encyclopedia (general) wiki',
			'Encyclopedia (specialized) wiki' => 'Encyclopedia (specialized) wiki',
			'Eurovision-style song contest statistics tracking wiki' => 'Eurovision-style song contest statistics tracking wiki',
			'Fictional worldbuilding/constructed world wiki' => 'Fictional worldbuilding/constructed world wiki',
			'Minecraft server wiki' => 'Minecraft server wiki',
			'Organization (coordination) wiki' => 'Organization (coordination) wiki',
			'Political simulation wiki' => 'Political simulation wiki',
			'Roleplaying game wiki' => 'Roleplaying game wiki',
			'Video game (specified video game) information wiki' => 'Video game (specified video game) information wiki',
			'Video game (broad genre or video game series) information wiki' => 'Video game (broad genre or video game series) information wiki',
			'None of the above' => 'None of the above',
		],
	],
	'wgCreateWikiShowBiographicalOption' => [
		'default' => true,
	],
	'wgCreateWikiSQLFiles' => [
		'default' => [
			"$IP/sql/mysql/tables-generated.sql",
			"$IP/extensions/AbuseFilter/db_patches/mysql/tables-generated.sql",
			"$IP/extensions/AntiSpoof/sql/mysql/tables-generated.sql",
			"$IP/extensions/BetaFeatures/sql/tables-generated.sql",
			"$IP/extensions/CheckUser/schema/mysql/tables-generated.sql",
			"$IP/extensions/CheckUser/schema/mysql/tables-virtual-checkuser-generated.sql",
			"$IP/extensions/DataDump/sql/data_dump.sql",
			"$IP/extensions/Echo/sql/mysql/tables-generated.sql",
			"$IP/extensions/GlobalBlocking/sql/mysql/tables-generated-global_block_whitelist.sql",
			"$IP/extensions/Linter/sql/mysql/tables-generated.sql",
			"$IP/extensions/MediaModeration/schema/mysql/tables-generated.sql",
			"$IP/extensions/OAuth/schema/mysql/tables-generated.sql",
			"$IP/extensions/RottenLinks/sql/rottenlinks.sql",
			"$IP/extensions/UrlShortener/schemas/mysql/tables-generated.sql",
		],
	],
	'wgCreateWikiStateDays' => [
		'default' => [
			'inactive' => 60,
			'closed' => 60,
			'removed' => 245,
			'deleted' => 31
		],
	],
	'wgCreateWikiCacheDirectory' => [
		'default' => '/srv/mediawiki/cache'
	],
	'wgCreateWikiCategories' => [
		'default' => [
			'Select an option...' => '',
			'Art & Architecture' => 'artarc',
			'Automotive' => 'automotive',
			'Business & Finance' => 'businessfinance',
			'Community' => 'community',
			'Education' => 'education',
			'Electronics' => 'electronics',
			'Entertainment' => 'entertainment',
			'Fandom' => 'fandom',
			'Fantasy' => 'fantasy',
			'Gaming' => 'gaming',
			'Geography' => 'geography',
			'History' => 'history',
			'Humour/Satire' => 'humour',
			'Language/Linguistics' => 'langling',
			'Leisure' => 'leisure',
			'Literature/Writing' => 'literature',
			'Media/Journalism' => 'media',
			'Medicine/Medical' => 'medical',
			'Military/War' => 'military',
			'Music' => 'music',
			'Podcast' => 'podcast',
			'Politics' => 'politics',
			'Private' => 'private',
			'Religion' => 'religion',
			'Science' => 'science',
			'Software/Computing' => 'software',
			'Song Contest' => 'songcontest',
			'Sports' => 'sport',
			'Uncategorised' => 'uncategorised',
		],
	],
	'wgCreateWikiInactiveExemptReasonOptions' => [
		'default' => [
			'Wiki completed and made to be read' => 'comp',
			'Wiki made for time-based gathering' => 'tbg',
			'Wiki made to be read' => 'mtr',
			'Temporary exemption for exceptional hardship, see DPE' => 'temphardship',
			'Other, see DPE' => 'other',
		],
	],
	'wgCreateWikiRequestCountWarnThreshold' => [
		'default' => 5,
	],
	'wgCreateWikiSubdomain' => [
		'default' => 'miraheze.org',
		'beta' => 'mirabeta.org',
	],
	'wgCreateWikiUseClosedWikis' => [
		'default' => true,
	],
	'wgCreateWikiUseEchoNotifications' => [
		'default' => true,
	],
	'wgCreateWikiUseExperimental' => [
		'default' => true,
	],
	'wgCreateWikiUseInactiveWikis' => [
		'default' => true,
	],
	'wgCreateWikiUsePrivateWikis' => [
		'default' => true,
	],
	'wgCreateWikiContainers' => [
		'default' => [
			'avatars' => 'public-private',
			'awards' => 'public-private',
			'local-public' => 'public-private',
			'local-thumb' => 'public-private',
			'local-transcoded' => 'public-private',
			'local-temp' => 'private',
			'local-deleted' => 'private',
			'dumps-backup' => 'public-private',
			'phonos-render' => 'public-private',
			'timeline-render' => 'public-private',
			'upv2avatars' => 'public-private',
		],
	],
	'wgCreateWikiUseJobQueue' => [
		'default' => true,
	],
	'wgRequestWikiMinimumLength' => [
		'default' => 350,
	],
	'wgRequestWikiConfirmAgreement' => [
		'default' => true,
	],

	// CookieWarning
	'wgCookieWarningMoreUrl' => [
		'default' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Privacy_Policy#2._Cookies',
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

	// CustomSearchProfiles
	'wgCustomSearchProfilesProfiles' => [
		'default' => [],
		'rainversewiki' => [
			'comic' => [
				'namespaces' => [
					// Rain
					3002,
					// MIS
					3004,
					// Rainbow
					3006,
				],
			],
			'mainspace' => [
				'namespaces' => [ NS_MAIN ],
			],
		],
	],

	// Darkmode
	'wgDarkModeTogglePosition' => [
		'default' => 'personal',
	],

	// Database
	'wgAllowSchemaUpdates' => [
		'default' => false,
	],
	'wgDBadminuser' => [
		'default' => 'wikiadmin2024',
	],
	'wgDBuser' => [
		'default' => 'mediawiki2024',
	],
	'wgReadOnly' => [
		'default' => false,
	],
	'wgSharedDB' => [
		'default' => null,
	],
	'wgSharedTables' => [
		'default' => [],
	],
	'+wgVirtualDomainsMapping' => [
		'default' => [
			'virtual-botpasswords' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-centralauth' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-centralnotice' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-checkuser-global' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-createwiki-central' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-globalblocking' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-globaljsonlinks' => [
				'db' => 'commonswiki',
			],
			'virtual-globalnewfiles' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-globalusage' => [
				'db' => 'commonswiki',
			],
			'virtual-importdump' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-incidentreporting' => [
				'db' => $wi->getIncidentsDatabase(),
			],
			'virtual-interwiki' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-LoginNotify' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-managewiki-central' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-matomoanalytics' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-oathauth' => [
				'db' => $wi->getGlobalDatabase(),
			],
			'virtual-oauth' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-requestcustomdomain' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-urlshortener' => [
				'db' => $wi->getCentralDatabase(),
			],
		],
		'ldapwikiwiki' => [
			'virtual-interwiki' => [
				'db' => $wi->getCentralDatabase(),
			],
			'virtual-LoginNotify' => [
				'db' => 'ldapwikiwiki',
			],
			'virtual-oathauth' => [
				'db' => 'ldapwikiwiki',
			],
		],
		'+beta' => [
			'virtual-botpasswords' => [
				'db' => 'metawikibeta',
			],
			'virtual-globaljsonlinks' => [
				'db' => 'commonswikibeta',
			],
			'virtual-globalusage' => [
				'db' => 'commonswikibeta',
			],
		],
	],

	// DataMaps
	'wgDataMapsEnableCreateMap' => [
		'default' => true,
	],
	'wgDataMapsEnableVisualEditor' => [
		'default' => false,
	],
	'wgDataMapsAllowExperimentalFeatures' => [
		'default' => false,
	],

	// Details
	'wgDetailsMWCollapsibleCompatibility' => [
		'default' => true,
	],

	// Drafts
	'egDraftsAutoSaveWait' => [
		'default' => 120,
	],
	'egDraftsAutoSaveTimeout' => [
		'default' => 10,
	],
	'egDraftsAutoSaveInputBased' => [
		'default' => false,
	],
	'egDraftsLifeSpan' => [
		'default' => 30,
	],
	'egDraftsCleanRatio' => [
		'default' => 1000,
	],

	// Delete
	'wgDeleteRevisionsLimit' => [
		// databases don't have much memory
		// let's not overload them (T5287)
		'default' => 1000,
	],

	// DiscordNotifications
	'wgDiscordAvatarUrl' => [
		'default' => '',
	],
	'wgDiscordFromName' => [
		'default' => $wi->sitename,
	],
	'wgDiscordIgnoreMinorEdits' => [
		'default' => false,
	],
	'wgDiscordIncludePageUrls' => [
		'default' => true,
	],
	'wgDiscordIncludeUserUrls' => [
		'default' => true,
	],
	'wgDiscordIncludeDiffSize' => [
		'default' => true,
	],
	'wgDiscordNotificationEnabledActions' => [
		'default' => [
			'AddedArticle' => true,
			'EditedArticle' => true,
			'MovedArticle' => true,
			'ProtectedArticle' => true,
			'RemovedArticle' => true,
			'UnremovedArticle' => true,
			'AfterImportPage' => true,
			'FileUpload' => true,
			'BlockedUser' => true,
			'NewUser' => true,
			'UserGroupsChanged' => true,
			'ModerationPending' => true,
		],
	],
	'wgDiscordNotificationShowImage' => [
		'default' => true,
	],
	'wgDiscordNotificationShowSuppressed' => [
		'default' => false,
	],
	'wgDiscordNotificationCentralAuthWikiUrl' => [
		'default' => 'https://meta.miraheze.org/',
	],
	'wgDiscordNotificationIncludeAutocreatedUsers' => [
		'default' => true,
		'commonswiki' => false,
		'devwiki' => false,
		'loginwiki' => false,
		'metawiki' => false,
		'testwiki' => false,
	],
	'wgDiscordAdditionalIncomingWebhookUrls' => [
		'default' => [],
	],
	'wgDiscordDisableEmbedFooter' => [
		'default' => false,
		'puzzleswikiwiki' => true,
		'themanaworldwiki' => true,
	],
	'wgDiscordExcludeConditions' => [
		'default' => [
			'experimental' => [
				'article_inserted' => [
					'groups' => [
						'sysop',
					],
					'permissions' => [
						'bot',
						'managewiki-core',
						'managewiki-extensions',
						'managewiki-namespaces',
						'managewiki-permissions',
						'managewiki-settings',
					],
				],
				'article_saved' => [
					'groups' => [
						'sysop',
					],
					'permissions' => [
						'bot',
						'managewiki-core',
						'managewiki-extensions',
						'managewiki-namespaces',
						'managewiki-permissions',
						'managewiki-settings',
					],
				],
			],
			'users' => [
				// Exclude excessive bots from all feeds
				'Creaturawikibot',
				'FuzzyBot',
				'HispanoBOT',
			],
		],
		'+commonswiki' => [
			'groups' => [
				'bot',
			],
		],
		'+devwiki' => [
			'groups' => [
				'bot',
			],
		],
		'+metawiki' => [
			'article_inserted' => [
				'groups' => [
					'bot',
					'flood',
				],
			],
			'article_saved' => [
				'groups' => [
					'bot',
					'flood',
				],
			],
		],
		'+testwiki' => [
			'groups' => [
				'bot',
			],
		],
	],
	'wgDiscordEnableExperimentalCVTFeatures' => [
		'default' => true,
	],
	'wgDiscordExperimentalCVTMatchFilter' => [
		'default' => [ '(n[1i!*]gg[3*e]r|r[e3*]t[4@*a]rd|f[@*4]gg[0*o]t|ch[1!i*]nk)' ],
	],
	'wgDiscordExperimentalFeedLanguageCode' => [
		'default' => 'en',
	],

	// DiscussionTools
	'wgDiscussionTools_visualenhancements' => [
		'default' => 'default',
		'isvwiki' => 'available',
	],
	'wgDiscussionTools_visualenhancements_reply' => [
		'default' => 'default',
		'isvwiki' => 'available',
	],
	'wgDiscussionTools_visualenhancements_pageframe' => [
		'default' => 'default',
		'isvwiki' => 'available',
	],

	// Description2
	'wgEnableMetaDescriptionFunctions' => [
		'ext-Description2' => true,
	],

	// DismissableSiteNotice
	'wgDismissableSiteNoticeForAnons' => [
		'default' => true,
	],

	// Display Title
	'wgDisplayTitleFollowRedirects' => [
		'default' => true,
	],
	'wgDisplayTitleHideSubtitle' => [
		'default' => false,
	],

	// DJVU
	'wgDjvuDump' => [
		'default' => '/usr/bin/djvudump',
	],
	'wgDjvuRenderer' => [
		'default' => '/usr/bin/ddjvu',
	],
	'wgDjvuTxt' => [
		'default' => '/usr/bin/djvutxt',
	],

	// DynamicPageList (Wikimedia)
	'wgDLPAllowUnlimitedCategories' => [
		'default' => false,
	],
	'wgDLPAllowUnlimitedResults' => [
		'default' => false,
	],

	// DynamicPageList4
	'wgDPLAllowUnlimitedCategories' => [
		'default' => false,
		'bluearchivewiki' => true,
		'fischwiki' => true,
		'metzowiki' => true,
		'traceprojectwikiwiki' => true,
	],
	'wgDPLAllowUnlimitedResults' => [
		'default' => false,
		'metzowiki' => true,
		'traceprojectwikiwiki' => true,
	],
	'wgDPLMaxCategoryCount' => [
		'default' => 8,
		'constantnoblewiki' => 100,
		'dappervolkwiki' => 15,
		'gui7814sgtafanonwiki' => 1000,
		'persistwiki' => 10,
	],
	'wgDPLMaxResultCount' => [
		'default' => 500,
		'constantnoblewiki' => 2500,
		'gui7814sgtafanonwiki' => 1000,
	],

	// DynamicSidebar
	'wgDynamicSidebarUsePageCategories' => [
		'default' => false,
	],

	// Echo
	'wgEchoCrossWikiNotifications' => [
		'default' => true,
	],
	'wgEchoUseJobQueue' => [
		'default' => true,
	],
	'wgEchoSharedTrackingCluster' => [
		'default' => 'echo',
		'beta' => 'beta',
	],
	'wgEchoSharedTrackingDB' => [
		'default' => 'metawiki',
		'beta' => 'metawikibeta',
	],
	'wgEchoUseCrossWikiBetaFeature' => [
		'default' => true,
	],
	'wgEchoMentionStatusNotifications' => [
		'default' => true,
	],
	'wgEchoMaxMentionsInEditSummary' => [
		'default' => 0,
	],
	'wgEchoPerUserBlacklist' => [
		'default' => true,
	],
	'wgEchoWatchlistNotifications' => [
		'default' => false,
	],
	'wgEchoWatchlistEmailOncePerPage' => [
		'default' => true,
	],

	// Editing
	'wgEditSubmitButtonLabelPublish' => [
		'default' => false,
		'ysmwikiwiki' => true,
	],

	// EditSimilar
	'wgEditSimilarMaxResultsPool' => [
		'default' => 50,
	],
	'wgEditSimilarMaxResultsToDisplay' => [
		'default' => 3,
	],
	'wgEditSimilarCounterValue' => [
		'default' => 1,
	],
	'wgEditSimilarAlwaysShowThanks' => [
		'default' => false,
	],

	// ElasticSearch
	'wmgDisableSearchUpdate' => [
		'default' => false,
	],
	'wmgSearchType' => [
		'default' => false,
	],
	'wmgShowPopupsByDefault' => [
		'default' => false,
	],

	// EmbedVideo
	'wgEmbedVideoAddFileExtensions' => [
		'default' => true,
		'removededmsongswiki' => false,
	],
	'wgEmbedVideoEnableVideoHandler' => [
		'default' => true,
	],
	'wgEmbedVideoRequireConsent' => [
		'default' => true,
	],
	'wgEmbedVideoFetchExternalThumbnails' => [
		'default' => true,
	],
	'wgEmbedVideoDefaultWidth' => [
		'default' => 320,
		'inforevivalwiki' => 640,
	],

	// External Data
	'wgExternalDataSources' => [
		/**
		 * @note Databases should NEVER be configured here!
		 * @see https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:External_Data/Databases
		 *
		 * @note Programs should NEVER be configured here!
		 * @see https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:External_Data/Local_programs
		 *
		 * @note LDAP should NEVER be configured here!
		 * @see https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:External_Data/LDAP
		 *
		 * @note If configuring local files here, please be mindful of how it is done to avoid security implications.
		 * @see https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:External_Data/Local_files
		 *
		 * @note SOAP should NEVER be configured here, unless you understand it and can confirm the security of it is acceptable.
		 */
		'ext-ExternalData' => [
			'*' => [
				'min cache seconds' => 3600,
				'always use stale cache' => false,
				'throttle key' => '$2nd_lvl_domain$',
				'throttle interval' => 0,
				'replacements' => [],
				'allowed urls' => [],
				'options' => [
					'timeout' => 'default',
					// MediaWiki's documentation (to be specific, MediaWiki\Http\HttpRequestFactory#create()) states that this
					// should be enabled only for trusted URLs, as an attacker-controlled URL can cause a redirect to bounce
					// off to intranet services. However, we do not have any filtering on the URL, so an attacker already has
					// SSRF by virtue of having ExternalData enabled. Therefore, the issue raised by the docs are a non-issue
					// for this specific usecase.
					'followRedirects' => true,
				],
				'encodings' => [
					'ASCII',
					'UTF-8',
					'Windows-1251',
					'Windows-1252',
					'Windows-1254',
					'KOI8-R',
					'ISO-8859-1',
				],
				'params' => [],
				'param filters' => [],
				'verbose' => true,
			],
		],
	],

	// FeaturedFeeds
	'wgFeaturedFeedsDefaults' => [
		'default' => [
			'limit' => 10,
			'frequency' => 'daily',
			'inUserLanguage' => false,
		],
	],

	'wmgMirahezeFeaturedFeedsInUserLanguage' => [
		'default' => false,
	],

	'wgDisplayFeedsInSidebar' => [
		'default' => true,
	],

	// FlaggedRevs
	'wgFlaggedRevsProtection' => [
		'default' => false,
	],
	'wgFlaggedRevsOverride' => [
		'default' => true,
	],
	'wgFlaggedRevsTags' => [
		'default' => [
			'accuracy' => [
				'levels' => 3,
				'quality' => 2,
				'pristine' => 4,
			],
		],
		'infectopedwiki' => [
			'accuracy' => [
				'levels' => 4,
			],
		],
		'isvwiki' => [
			'status' => [
				'levels' => 1,
			],
		],
	],
	'wgFlaggedRevsTagsRestrictions' => [
		'default' => [
			'accuracy' => [
				'review' => 1,
				'autoreview' => 1,
			],
		],
	],
	'wgFlaggedRevsTagsAuto' => [
		'default' => [
			'accuracy' => 1,
		],
	],
	'wgFlaggedRevsAutopromote' => [
		'default' => false,
	],
	'wgFlaggedRevsAutoReview' => [
		'default' => 3,
	],
	'wgFlaggedRevsRestrictionLevels' => [
		'default' => [
			'sysop',
		],
	],
	'wgSimpleFlaggedRevsUI' => [
		'default' => true,
	],
	'wgFlaggedRevsLowProfile' => [
		'default' => true,
	],

	'wgWatchlistExpiry' => [
		'default' => true
	],
	'wgShortPagesNamespaceExclusions' => [
		'default' => [],
		'tuscriaturaswiki' => [ NS_CATEGORY ],
	],

	// Footers
	'+wgFooterIcons' => [
		'default' => [
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/commonswiki/f/fe/Powered_by_Miraheze_(no_box).svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
		],
		'aceistanwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/utgwiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/utgwiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/aceistanwiki/a/af/Gpl.svg',
					'url' => 'https://www.gnu.org/licenses/gpl-3.0-standalone.html',
					'alt' => 'GPL 3.0',
				],
			],
		],
		'animalroyalewiki' => [
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/animalroyalewiki/f/f2/CC_BY-NC-SA_logo.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/3.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/animalroyalewiki/d/da/Poweredby_mediawiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/commonswiki/f/fe/Powered_by_Miraheze_(no_box).svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
		],
		'itemasylumwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/itemasylumwiki/f/f7/Poweredbymediawiki_badge.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/itemasylumwiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/itemasylumwiki/b/b0/Ccbysa_badge.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'ballgamewiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/ballgamewiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/ballgamewiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/ballgamewiki/0/0f/Badge-ccbysa.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
		],
		'blockstarplanetwiki' => [
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/blockstarplanetwiki/4/49/Miraheze.png',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
					'height' => '65',
					'width' => '65',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/blockstarplanetwiki/f/fe/CreativeCommons.png',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
					'height' => '65',
					'width' => '65',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/blockstarplanetwiki/0/05/Mediawiki.png',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
					'height' => '65',
					'width' => '65',
				],
			],
		],
		'cafewiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://hybridcafe.wiki/w/img_auth.php/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://hybridcafe.wiki/w/img_auth.php/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				]
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://hybridcafe.wiki/w/img_auth.php/0/0f/Badge-ccbysa.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'fischwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/cafewiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/cafewiki/8/81/Miraheze_badge.svg',
					'url' => 'https://miraheze.org',
					'alt' => 'Hosted by Miraheze',
				]
			],
		],
		'outlasterwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/outlasterwiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/outlasterwiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				]
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/outlasterwiki/0/0f/Badge-ccbysa.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
		],
		'farmwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/farmwiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/farmwiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				]
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/farmwiki/3/33/Badge-ccbyncsa.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'fraudulentfronterawiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/fraudulentfronterawiki/0/06/Poweredbymw.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/fraudulentfronterawiki/9/97/Poweredbymh.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/fraudulentfronterawiki/5/57/Ccbyncsa.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'100bangaiwiki' => [
			'hostedby' => [
				'songnguxyz' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/5/58/Footer.SN.xyz.svg',
					'url' => 'https://songngu.xyz',
					'alt' => 'Dự án được bảo quản bởi SongNgư.xyz',
					'height' => '36',
					'width' => '118',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/1/1c/Miraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Lưu trữ bởi Miraheze',
					'height' => '36',
					'width' => '36',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/9/9b/MediaWiki.svg',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Xây dựng trên MediaWiki',
					'height' => '42',
					'width' => '110',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/4/4e/CC-BY-SA-4.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Ghi công - Chia sẻ tương tự 4.0 (CC BY-SA 4.0)',
					'height' => '42',
					'width' => '110',
				],
			],
		],
		'snxyzmetawiki' => [
			'hostedby' => [
				'songnguxyz' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/5/58/Footer.SN.xyz.svg',
					'url' => 'https://songngu.xyz',
					'alt' => 'Dự án được bảo quản bởi SongNgư.xyz',
					'height' => '36',
					'width' => '118',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/1/1c/Miraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Lưu trữ bởi Miraheze',
					'height' => '36',
					'width' => '36',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/9/9b/MediaWiki.svg',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Xây dựng trên MediaWiki',
					'height' => '42',
					'width' => '110',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/4/4e/CC-BY-SA-4.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Ghi công - Chia sẻ tương tự 4.0 (CC BY-SA 4.0)',
					'height' => '42',
					'width' => '110',
				],
			],
		],
		'lhmnwiki' => [
			'supportedby' => [
				'songnguxyz' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/5/58/Footer.SN.xyz.svg',
					'url' => 'https://songngu.xyz',
					'alt' => 'Dự án được bảo quản bởi SongNgư.xyz',
					'height' => '36',
					'width' => '118',
				],
				'indiewikifed' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/a/a2/IWF_Footer.svg',
					'url' => 'https://lophocmatngu.wiki/WLHMN:Independent_Wiki_Federation',
					'alt' => 'Một thành viên của Liên Minh Wiki Tự Do',
					'height' => '40',
					'width' => '110',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/1/1c/Miraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Lưu trữ bởi Miraheze',
					'height' => '36',
					'width' => '36',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/9/9b/MediaWiki.svg',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Xây dựng trên MediaWiki',
					'height' => '42',
					'width' => '110',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/4/4e/CC-BY-SA-4.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Ghi công - Chia sẻ tương tự 4.0 (CC BY-SA 4.0)',
					'height' => '42',
					'width' => '110',
				],
			],
		],
		'cgwiki' => [
			'hostedby' => [
				'songnguxyz' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/5/58/Footer.SN.xyz.svg',
					'url' => 'https://songngu.xyz',
					'alt' => 'Dự án được bảo quản bởi SongNgư.xyz',
					'height' => '36',
					'width' => '118',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/1/1c/Miraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Lưu trữ bởi Miraheze',
					'height' => '36',
					'width' => '36',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/lhmnwiki/9/9b/MediaWiki.svg',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Xây dựng trên MediaWiki',
					'height' => '42',
					'width' => '110',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/cgwiki/2/27/CC_BY-NC-SA-4.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Ghi công - Phi thương mại - Chia sẻ tương tự 4.0 (CC BY-NC-SA 4.0)',
					'height' => '42',
					'width' => '110',
				],
			],
		],
		'thechurchofthestatuewiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/thechurchofthestatuewiki/7/75/Black_mediawiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
					'height' => '25',
					'width' => '25',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/thechurchofthestatuewiki/1/1f/Miraheze_black.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
					'height' => '25',
					'width' => '25',
				]
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/thechurchofthestatuewiki/b/b6/Cc_by_sa.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
			'freeart' => [
				'freeart' => [
					'src' => 'https://static.wikitide.net/thechurchofthestatuewiki/6/68/Free_art_licence_footmark.svg',
					'url' => 'https://artlibre.org/licence/lal/en/',
					'alt' => 'Free Art Licence (FAL)',
				],
			],
		],
		'tnowiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/tnowiki/0/05/Mediawiki.png',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/tnowiki/4/49/Miraheze.png',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze',
				]
			]
		],
		'universalunionwiki' => [
			'hostedby' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/universalunionwiki/7/74/HostedByMiraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/universalunionwiki/6/60/PoweredByMediawiki.svg',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'poweredbysmw' => [
				'semanticmediawiki' => [
					'src' => 'https://static.wikitide.net/universalunionwiki/7/77/SemanticMediaWiki.svg',
					'url' => 'https://www.semantic-mediawiki.org/wiki/Semantic_MediaWiki',
					'alt' => 'Powered by Semantic MediaWiki',
					'class' => 'smw-footer',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/universalunionwiki/f/f3/Cc.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
		],
		'utgwiki' => [
			'hostedby' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/utgwiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/utgwiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/utgwiki/0/0f/Badge-ccbysa.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'rabbidstakeoverwiki' => [
			'hostedby' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/utgwiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/utgwiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/rabbidstakeoverwiki/3/33/Badge-ccbyncsa.svg',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'yonicversewiki' => [
			'hostedby' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/yonicversewiki/a/a5/Wiki_Citizen_Footer_Badge.svg#miraheze',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/yonicversewiki/a/a5/Wiki_Citizen_Footer_Badge.svg#mediawiki',
					'url' => 'https://www.mediawiki.org',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'cargo' => [
				'cargo' => [
					'src' => 'https://static.wikitide.net/yonicversewiki/a/a5/Wiki_Citizen_Footer_Badge.svg#cargo',
					'url' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Cargo',
					'alt' => 'Database by Cargo',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/yonicversewiki/a/a5/Wiki_Citizen_Footer_Badge.svg#cc',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'damnationwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/damnationwiki/a/a9/Poweredby_mediawiki_white.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/damnationwiki/1/11/Powered_by_Miraheze_%28no_box%29_white.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
		],
		'noobsincombatcoldfrontwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/noobsincombatcoldfrontwiki/b/b0/PoweredByMediaWiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
			],
			'miraheze' => [
				'miraheze' => [
					'src' => 'https://static.wikitide.net/noobsincombatcoldfrontwiki/8/81/Miraheze_badge.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/noobsincombatcoldfrontwiki/a/a6/Final-cc-by-sa.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
		],
		'computerunionwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/universalunionwiki/6/60/PoweredByMediawiki.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
				'miraheze' => [
					'src' => 'https://static.wikitide.net/universalunionwiki/7/74/HostedByMiraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/universalunionwiki/f/f3/Cc.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
		],
		'toyboxfunhousewiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/toyboxfunhousewiki/3/3c/Powered_by_MEDIAWIKI.png',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
				'miraheze' => [
					'src' => 'https://static.wikitide.net/toyboxfunhousewiki/9/9b/Hosted_by_MIRAHEZE.png',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/toyboxfunhousewiki/0/0e/CC_BY-SA.png',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
		],
		'nicosnextbotswiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/nicosnextbotswiki/0/05/Wiki_poweredbymediawiki.png',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
				'miraheze' => [
					'src' => 'https://static.wikitide.net/nicosnextbotswiki/e/eb/Wiki_hostedbymiraheze.png',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/nicosnextbotswiki/f/fc/Wiki_ccbyncsa.png',
					'url' => 'https://creativecommons.org/licenses/by-nc-sa/4.0/',
					'alt' => 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)',
				],
			],
		],
		'etohwiki' => [
			'poweredby' => [
				'mediawiki' => [
					'src' => 'https://static.wikitide.net/etohwiki/a/a3/Badge-mediawiki-icon.svg',
					'url' => 'https://www.mediawiki.org/',
					'alt' => 'Powered by MediaWiki',
				],
				'miraheze' => [
					'src' => 'https://static.wikitide.net/etohwiki/4/42/Badge-miraheze-icon.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze_Meta',
					'alt' => 'Hosted by Miraheze',
				],
			],
			'copyright' => [
				'copyright' => [
					'src' => 'https://static.wikitide.net/etohwiki/b/b6/Cc_by_sa.svg',
					'url' => 'https://creativecommons.org/licenses/by-sa/4.0/',
					'alt' => 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)',
				],
			],
		],
	],
	'wmgWikiapiaryFooterPageName' => [
		'default' => '',
	],

	'wgMaxCredits' => [
		'default' => 0,
	],
	'wgShowCreditsIfMax' => [
		'default' => true,
	],

	// Files
	'wgEnableUploads' => [
		'default' => true,
	],
	'wgEnableAsyncUploads' => [
		'default' => true,
	],
	'wgMaxUploadSize' => [
		'default' => 1024 * 1024 * 4096,
		/** T9673 - 10MB */
		'dragdownwiki' => 1024 * 1024 * 10,
		/** T12515 - 2MB */
		'irisstationwiki' => 1024 * 1024 * 2,
		/** T13930 - 5MB */
		'wikigeniuswiki' => 1024 * 1024 * 5,
	],
	'wgAllowCopyUploads' => [
		'default' => false,
	],
	'wgCopyUploadsFromSpecialUpload' => [
		'default' => false,
	],
	'wgFileExtensions' => [
		'default' => [
			'djvu',
			'gif',
			'ico',
			'jpg',
			'jpeg',
			'ogg',
			'pdf',
			'png',
			'svg',
			'webp',
		],
	],
	'wgUseQuickInstantCommons' => [
		'default' => true,
	],
	'wgQuickInstantCommonsPrefetchMaxLimit' => [
		'default' => 1000,
	],
	'wgQuickInstantCommonsUserAgentInfo' => [
		'default' => 'https://miraheze.org; tech@miraheze.org',
	],
	'wgMaxImageArea' => [
		'default' => 10e7,
	],
	'wgMaxAnimatedGifArea' => [
		'default' => '1.25e7',
	],
	'wgMirahezeCommons' => [
		'default' => true,
	],
	'wgMirahezeReportsBlockAlertKeywords' => [
		'default' => [
			'underage',
			'under age',
			'under 13',
			'death threats',
			'death threat',
			'child pornography',
			'images of children',
			'images of minors',
			'suicide',
			'kill me',
			'kill themselves',
			'kill themselfs',
			'kill themself',
			'murder',
			'terrorist',
			'terrorism',
			'bomb threat',
			'bomb hoax',
		],
	],
	'wgEnableImageWhitelist' => [
		'default' => false,
	],
	'wgImagePreconnect' => [
		'default' => true,
	],
	'wgImgTagSanitizeDomain' => [
		'default' => false,
	],
	'wgShowArchiveThumbnails' => [
		'default' => true,
	],
	'wgVerifyMimeType' => [
		'default' => true,
	],
	'wgSVGMetadataCutoff' => [
		'default' => 5242880,
	],
	'wgSVGConverter' => [
		'default' => 'rsvg',
	],
	'wgSVGConverterPath' => [
		'default' => '/usr/local/bin',
	],
	'wgSVGNativeRendering' => [
		'default' => true,
	],
	'wgUploadMissingFileUrl' => [
		'default' => false,
	],
	'wgUploadNavigationUrl' => [
		'default' => false,
	],

	// Gallery Options
	'wgGalleryOptions' => [
		'default' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'traditional',
		],
		'darkangelwiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'packed',
		],
		'dccomicswiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'packed',
		],
		'dcmultiversewiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'packed',
		],
		'ghostmachinewiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'packed',
		],
		'pilgrammedwiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 180,
			'imageHeight' => 180,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'traditional',
		],
		'rippaversewiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'packed',
		],
	],

	// GeoData
	'wgGlobes' => [
		'default' => [],
		'gratisdatawiki' => [
			'earth',
			'mercury',
			'venus',
			'moon',
			'mars',
			'phobos',
			'deimos',
			'ganymede',
			'callisto',
			'io',
			'europa',
			'mimas',
			'enceladus',
			'tethys',
			'dione',
			'rhea',
			'titan',
			'hyperion',
			'iapetus',
			'phoebe',
			'miranda',
			'ariel',
			'umbriel',
			'titania',
			'oberon',
			'triton',
			'pluto',
		],
	],
	// GlobalBlocking
	'wgApplyGlobalBlocks' => [
		'default' => true,
		// 'metawiki' => false,
	],

	// GlobalCssJs
	'wgGlobalCssJsConfig' => [
		'default' => [
			'wiki' => 'metawiki',
			'source' => 'metawiki',
		],
		'beta' => [
			'wiki' => 'metawikibeta',
			'source' => 'metawikibeta',
		],
	],
	'+wgResourceLoaderSources' => [
		'default' => [
			'metawiki' => [
				'apiScript' => '//meta.miraheze.org/w/api.php',
				'loadScript' => '//meta.miraheze.org/w/load.php',
			],
		],
		'beta' => [
			'metawikibeta' => [
				'apiScript' => '//meta.mirabeta.org/w/api.php',
				'loadScript' => '//meta.mirabeta.org/w/load.php',
			],
		],
	],
	'wgUseGlobalSiteCssJs' => [
		'default' => false,
	],

	// GlobalPreferences
	'wgGlobalPreferencesDB' => [
		'default' => 'mhglobal',
		'beta' => 'testglobal',
	],

	// GlobalUsage
	'wgGlobalUsageSharedRepoWiki' => [
		'default' => 'commonswiki',
		'beta' => 'commonswikibeta',
		'gpcommonswiki' => 'gpcommonswiki',
		'gratisdatawiki' => 'gpcommonswiki',
		'gratispaideiawiki' => 'gpcommonswiki',
	],
	'wgGlobalUsagePurgeBacklinks' => [
		'default' => true,
	],

	// GlobalUserPage
	'wgGlobalUserPageAPIUrl' => [
		'default' => 'https://login.miraheze.org/w/api.php',
		'beta' => 'https://login.mirabeta.org/w/api.php',
	],
	'wgGlobalUserPageDBname' => [
		'default' => 'loginwiki',
		'beta' => 'loginwikibeta',
	],

	// Grant Permissions for BotPasswords and OAuth
	'+wgGrantPermissions' => [
		'default' => [
			'basic' => [
				'user' => true,
			],
			'usedatadumpapi' => [
				'view-dump' => true,
				'generate-dump' => true,
				'delete-dump' => true,
			],
		],
		'+phightingwiki' => [
			'editprotected' => [
				'edittrusteduserprotected' => true
			]
		],
	],
	'+wgGrantPermissionGroups' => [
		'default' => [],
	],

	// HAWelcome
	'wgHAWelcomeWelcomeUsername' => [
		'default' => 'HAWelcome',
	],
	'wgHAWelcomeStaffGroupName' => [
		'default' => 'sysop',
	],
	'wgHAWelcomeSignatureFromPreferences' => [
		'default' => false,
	],

	// HasSomeColours
	'wgHasSomeColoursColourOne' => [
		'default' => '#555',
	],
	'wgHasSomeColoursColourTwo' => [
		'default' => '#d77',
	],

	// HeaderTabs
	'wgHeaderTabsRenderSingleTab' => [
		'default' => false,
	],
	'wgHeaderTabsDisableDefaultToc' => [
		'default' => true,
	],
	'wgHeaderTabsGenerateTabTocs' => [
		'default' => false,
	],
	'wgHeaderTabsEditTabLink' => [
		'default' => true,
	],

	// HideSection
	'wgHideSectionImages' => [
		'default' => false,
	],

	// HighlightLinks
	'wgHighlightLinksInCategory' => [
		'default' => [],
		'allthetropeswiki' => [
			'Trope' => 'trope',
			'YMMV_Trope' => 'ymmv',
		],
		'pilgrammedwiki' => [
			'Melee_Weapons' => 'c-Melee_Weapons',
			'Mage_Weapons' => 'c-Mage_Weapons',
			'Bows' => 'c-Bows',
			'Guns' => 'c-Guns',
			'Bosses' => 'c-Bosses',
			'Materials' => 'c-Materials',
			'Quests' => 'c-Quests',
		],
	],

	// ImageMagick
	'wgUseImageMagick' => [
		'default' => true,
	],
	'wgImageMagickConvertCommand' => [
		'default' => '/usr/local/bin/mediawiki-firejail-magick',
	],
	'wgJpegPixelFormat' => [
		'default' => 'yuv420',
		'dominionstrategywiki' => 'yuv444',
	],
	'wgSharpenParameter' => [
		'default' => '0x0.8',
		'dominionstrategywiki' => '0x0.0',
	],
	'wgImageMagickTempDir' => [
		'default' => '/tmp/magick-tmp',
	],

	// Image Limits
	'wgImageLimits' => [
		'default' => [
			[ 320, 240 ],
			[ 640, 480 ],
			[ 800, 600 ],
			[ 1024, 768 ],
			[ 1280, 1024 ],
			[ 2560, 2048 ],
		],
		'dmlwikiwiki' => [
			[ 320, 240 ],
			[ 640, 480 ],
			[ 800, 800 ],
		],
	],

	// IncidentReporting
	'wgIncidentReportingServices' => [
		'default' => [
			'Bacula' => 'https://meta.miraheze.org/wiki/Tech:Bacula',
			'Bastion' => 'https://meta.miraheze.org/wiki/Tech:Bastion',
			'Cloud Infrastructure' => false,
			'ElasticSearch' => 'https://meta.miraheze.org/wiki/Tech:ElasticSearch',
			'DNS' => 'https://meta.miraheze.org/wiki/Tech:DNS',
			'Ganglia' => 'https://meta.miraheze.org/wiki/Tech:Ganglia',
			'GlusterFS' => 'https://meta.miraheze.org/wiki/Tech:GlusterFS',
			'Grafana' => 'https://meta.miraheze.org/wiki/Tech:Grafana',
			'Icinga' => 'https://meta.miraheze.org/wiki/Tech:Icinga',
			'LizardFS' => 'https://meta.miraheze.org/wiki/Tech:LizardFS',
			'Mail' => 'https://meta.miraheze.org/wiki/Tech:Mail',
			'MariaDB' => 'https://meta.miraheze.org/wiki/Tech:MariaDB',
			'Matomo' => 'https://meta.miraheze.org/wiki/Tech:Matomo',
			'MediaWiki' => 'https://meta.miraheze.org/wiki/Tech:MediaWiki_appserver',
			'Memcached' => 'https://meta.miraheze.org/wiki/Tech:Memcached',
			'NFS' => 'https://meta.miraheze.org/wiki/Tech:NFS',
			'NGINX' => 'https://meta.miraheze.org/wiki/Tech:Nginx',
			'Parsoid' => 'https://meta.miraheze.org/wiki/Tech:Parsoid',
			'Phorge' => 'https://meta.miraheze.org/wiki/Tech:Phorge',
			'Puppet Server' => 'https://meta.miraheze.org/wiki/Tech:Puppet',
			'Redis' => 'https://meta.miraheze.org/wiki/Tech:Redis',
			'Salt' => 'https://meta.miraheze.org/wiki/Tech:Salt',
			'Service Providers' => false,
			'Swift' => 'https://meta.miraheze.org/wiki/Tech:Swift',
			'Varnish' => 'https://meta.miraheze.org/wiki/Tech:Varnish',
		],
	],
	'wgIncidentReportingTaskUrl' => [
		'default' => 'https://issue-tracker.miraheze.org/',
	],

	// Interwiki
	'wgEnableScaryTranscluding' => [
		'default' => true,
	],
	'wgExtraInterlanguageLinkPrefixes' => [
		'default' => [
			'simple',
		],
		'+commonswiki' => [
			'wikimediacommons',
			'eswiki',
			'wikispecies',
		],
		'+isvwiki' => [
			'd',
		],
		'+nonciclopediawiki' => [
			'dlm',
			'olb',
			'tlh',
			'zombie',
		],
	],
	'wgExtraLanguageNames' => [
		'default' => [
			// Prevent mh from being treated as an interlanguage link (T11615)
			'mh' => '',
		],
		'+benpediawiki' => [
			'qbg' => 'bengénesk',
		],
		'+factfinder3dwiki' => [
			'eg' => 'Anchiartedlixh Lrieggulier',
			'bl' => 'Betlix',
			'et' => 'Entertidés Lettíno',
			'gb' => 'Globiens',
			'rb' => 'Robbochiex',
		],
		'+fuutropediawiki' => [
			'eg' => 'Anchiartedlixh Lrieggulier',
			'bl' => 'Betlix',
			'et' => 'Entertidés Lettíno',
			'gb' => 'Globiens',
			'rb' => 'Robbochiex',
		],
		'+gpcommonswiki' => [
			'qqq' => 'Message documentation',
			'pcm' => 'Nigerian Pidgin',
		],
		'+gratisdatawiki' => [
			'qqq' => 'Message documentation',
			'pcm' => 'Nigerian Pidgin',
		],
		'+isvwiki' => [
			'isv' => 'Medžuslovjansky / Меджусловјанскы',
		],
		'+sonaponawiki' => [
			'tok' => 'toki pona',
		],
	],

	// InterwikiDispatcher
	'wgIWDPrefixes' => [
		'default' => [
			'fandom' => [
				/** Fandom */
				'interwiki' => 'fandom',
				'url' => 'https://$2.fandom.com/wiki/$1',
				'urlInt' => 'https://$2.fandom.com/$3/wiki/$1',
				'baseTransOnly' => true,
			],
			'miraheze' => [
				/** Miraheze */
				'interwiki' => 'mh',
				'url' => 'https://$2.miraheze.org/wiki/$1',
				'dbname' => '$2wiki',
				'baseTransOnly' => true,
			],
			'wikitide' => [
				/** WikiTide */
				'interwiki' => 'wt',
				'url' => 'https://$2.wikitide.org/wiki/$1',
				'dbname' => '$2wiki',
				'baseTransOnly' => true,
			],
			'wiki_gg' => [
				/** Wiki.gg */
				'interwiki' => 'wgg',
				'url' => 'https://$2.wiki.gg/wiki/$1',
				'urlInt' => 'https://$2.wiki.gg/$3/wiki/$1',
				'baseTransOnly' => true,
			],
		],
		'+utgwiki' => [
			'translate' => [
				'interwiki' => 'transl',
				'url' => 'https://utg-miraheze-org.translate.goog/wiki/$1?_x_tr_sl=en&_x_tr_tl=$2',
				'baseTransOnly' => true,
			],
		],
	],

	// InterwikiSorting
	'wgInterwikiSortingSort' => [
		'ext-InterwikiSorting' => 'code',
	],

	// ImportDump
	'wgImportDumpEnableAutomatedJob' => [
		'default' => true,
	],
	'wgImportDumpInterwikiMap' => [
		'default' => [
			'fandom.com' => 'wikia',
			'miraheze.org' => 'mh',
			// 'wikitide.org' => 'wt',
		],
	],
	'wgImportDumpScriptCommand' => [
		'default' => 'screen -d -m bash -c ". /etc/swift-env.sh; swift download miraheze-metawiki-local-public {file-path} -o /home/$USER/{file-name}; mwscript importDump {wiki} -y --no-updates --username-prefix={username-prefix} /home/$USER/{file-name}; mwscript rebuildall {wiki} -y; mwscript initSiteStats {wiki} --active --update -y; rm /home/$USER/{file-name}"',
		'metawikibeta' => 'screen -d -m bash -c ". /etc/swift-env.sh; swift download miraheze-metawikibeta-local-public {file-path} -o /home/$USER/{file-name}; mwscript importDump {wiki} -y --no-updates --username-prefix={username-prefix} /home/$USER/{file-name}; mwscript rebuildall {wiki} -y; mwscript initSiteStats {wiki} --active --update -y; rm /home/$USER/{file-name}"',
	],
	'wgImportDumpUsersNotifiedOnAllRequests' => [
		'default' => [
			'MacFan4000 (Miraheze)',
			'Reception123',
			'Universal Omega',
			'RhinosF1 (Miraheze)',
		],
	],
	'wgImportDumpUsersNotifiedOnFailedImports' => [
		'default' => [
			'MacFan4000 (Miraheze)',
			'Reception123',
			'Universal Omega',
			'RhinosF1 (Miraheze)',
		],
	],

	// Imports
	'wgImportSources' => [
		'default' => [
			'meta',
			'dev',
			'loginwiki',
			'mw',
			'wikipedia',
			'metawikimedia',
		],
		'+batmanwiki' => [
			'batmanwikifandom',
			'd',
		],
		'+bnwikiwiki' => [
			'wikipedia' => [
				'bn',
				'en',
			],
		],
		'+brolandiawiki' => [
			'wikipedia' => [
				'fr',
			],
		],
		'+devwiki' => [
			'templatewikiarchive',
		],
		'+incubatorwiki' => [
			'wmincubator',
			'wikiaincubatorplus',
		],
		'+loginwiki' => [
			'testwikiwiki',
		],
		'+mrjaroslavikwiki' => [
			'wikipedia' => [
				'cs',
				'en',
			],
		],
		'+mymensinghwiki' => [
			'bnwikiwiki',
			'wikipedia' => [
				'bn',
				'en',
			],
		],
		'+ndgwiki' => [
			'nenawikiwiki',
		],
		'+nenawikiwiki' => [
			'ndgwiki',
		],
		'+reviwiki' => [
			'wikipedia' => [
				'en',
				'ko'
			],
		],
		'+sesupportwiki' => [
			'mrjaroslavikwiki',
		],
		'+shemwiki' => [
			'wikipedia' => [
			'fr',
			'en'
			],
		],
		'+snapdatawiki' => [
			'd',
			'snapwiki',
			'wikimediacommons',
		],
		'+snapwikiwiki' => [
			'scratchwiki',
			'd',
		],
		'+wikitrashwiki' => [
			'wikipedia' => [
				'it',
			],
		],
		'+yahyawiki' => [
			'wikipedia' => [
				'bn',
				'en',
			],
		],
		'+zhwpwikiwiki' => [
			'zhwp',
		],
		'+zhdelwiki' => [
			'zhwikipedia',
		],
	],

	'wgExportMaxHistory' => [
		'default' => 1000
	],

	'wgExportAllowListContributors' => [
		'default' => false,
	],

	'wgIgnoreImageErrors' => [
		'default' => true
	],

	// IPInfo
	'wgIPInfoGeoLite2Prefix' => [
		'default' => '/srv/mediawiki/geoip/GeoLite2-',
	],

	// JavascriptSlideshow
	'wgHtml5' => [
		'ext-JavascriptSlideshow' => true,
	],

	// JsonConfig
	'wgJsonConfigEnableLuaSupport' => [
		'default' => true,
	],
	'wgJsonConfigInterwikiPrefix' => [
		'default' => 'commons',
		'commonswiki' => 'meta',
	],
	'wgJsonConfigModels' => [
		'default' => [
			'Map.JsonConfig' => JsonConfig\JCMapDataContent::class,
			'Tabular.JsonConfig' => JsonConfig\JCTabularContent::class,
		],
		'+ftlmultiversewiki' => [
			'Data.JsonConfig' => null,
		],
	],
	'wgTrackGlobalJsonLinks' => [
		'default' => false,
	],

	// Kartographer
	'wgKartographerDfltStyle' => [
		'default' => '.',
	],
	'wgKartographerEnableMapFrame' => [
		'default' => true,
	],
	'wgKartographerMapServer' => [
		'default' => 'https://tile.openstreetmap.org',
	],
	'wgKartographerSrcsetScales' => [
		'default' => [],
	],
	'wgKartographerStaticMapframe' => [
		'default' => false,
	],
	'wgKartographerSimpleStyleMarkers' => [
		'default' => true,
		'bluepageswiki' => false,
		'gratisdatawiki' => false,
		'isvwiki' => false,
		'leborkwiki' => false,
	],
	'wgKartographerStyles' => [
		'default' => [
			'osm-intl',
			'osm',
		],
	],
	'wgKartographerUseMarkerStyle' => [
		'default' => false,
	],
	'wgKartographerWikivoyageMode' => [
		'default' => false,
	],

	// Lakeus
	'wgLakeusShowRepositoryLink' => [
		'default' => true,
	],
	'wgLakeusSiteNoticeHasBorder' => [
		'default' => false,
	],
	'wgLakeusShouldAnimatePortlets' => [
		'default' => false,
	],
	'wgLakeusShowStickyTOC' => [
		'default' => false,
	],
	'wgLakeusWikiDefaultColorScheme' => [
		'default' => 'light',
	],

	// Language
	'wgLanguageCode' => [
		'default' => 'en',
	],
	'wgUseXssLanguage' => [
		'beta' => true,
	],

	// LDAP
	'wgLDAPDomainNames' => [
		'ldapwikiwiki' => [
			'wikitide',
		],
	],
	'wgLDAPServerNames' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ldap.wikitide.net',
		],
	],
	'wgLDAPEncryptionType' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ssl',
		],
	],
	'wgLDAPSearchAttributes' => [
		'ldapwikiwiki' => [
			'wikitide' => 'uid',
		],
	],
	'wgLDAPBaseDNs' => [
		'ldapwikiwiki' => [
			'wikitide' => 'dc=miraheze,dc=org',
		],
	],
	'wgLDAPUserBaseDNs' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ou=people,dc=miraheze,dc=org',
		],
	],
	'wgLDAPProxyAgent' => [
		'ldapwikiwiki' => [
			'wikitide' => 'cn=write-user,dc=miraheze,dc=org',
		],
	],
	'wgLDAPProxyAgentPassword' => [
		'ldapwikiwiki' => [
			'wikitide' => $wmgLdapPassword,
		],
	],
	'wgLDAPWriterDN' => [
		'ldapwikiwiki' => [
			'wikitide' => 'cn=write-user,dc=miraheze,dc=org',
		],
	],
	'wgLDAPWriterPassword' => [
		'ldapwikiwiki' => [
			'wikitide' => $wmgLdapPassword,
		],
	],
	'wgLDAPWriteLocation' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ou=people,dc=miraheze,dc=org',
		],
	],
	'wgLDAPAddLDAPUsers' => [
		'ldapwikiwiki' => [
			'wikitide' => true,
		],
	],
	'wgLDAPUpdateLDAP' => [
		'ldapwikiwiki' => [
			'wikitide' => true,
		],
	],
	'wgLDAPPasswordHash' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ssha',
		],
	],
	'wgLDAPPreferences' => [
		'ldapwikiwiki' => [
			'wikitide' => [
				'email' => 'mail',
				'realname' => 'givenName',
			],
		],
	],
	'wgLDAPUseFetchedUsername' => [
		'ldapwikiwiki' => [
			'wikitide' => true,
		],
	],
	'wgLDAPLowerCaseUsernameScheme' => [
		'ldapwikiwiki' => [
			'wikitide' => false,
			'invaliddomain' => false,
		],
	],
	'wgLDAPLowerCaseUsername' => [
		'ldapwikiwiki' => [
			'wikitide' => false,
			'invaliddomain' => false,
		],
	],
	'wgLDAPOptions' => [
		'ldapwikiwiki' => [
			'wikitide' => [
				'LDAP_OPT_X_TLS_CACERTFILE' => '/etc/ssl/certs/LetsEncrypt.crt',
			],
		],
	],
	'wgLDAPDebug' => [
		'ldapwikiwiki' => 1,
	],

	// License
	'wgRightsIcon' => [
		'constantnoblewiki' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/Freeculturalworks-pdbutton.svg',
		'jadtechwiki' => "https://$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'revitwiki' => "https://$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
		'spnatiwiki' => 'https://upload.wikimedia.org/wikipedia/commons/f/f8/License_icon-mit-88x31-2.svg',
	],
	'wgRightsPage' => [
		'default' => '',
		'constantnoblewiki' => 'Constant Noble:No rights reserved',
		'diavwiki' => 'Project:Copyrights',
		'dmlwikiwiki' => 'MediaWiki:Copyright',
		'xyywiki' => 'Project:Copyrights',
	],
	'wgRightsText' => [
		'animalroyalewiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)',
		'animalroyalezhwiki' => 'Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)',
		'connorjwatwiki' => 'Creative Commons Attribution-ShareAlike 2.5 Generic (CC BY-SA 2.5)',
		'constantnoblewiki' => 'CC0 1.0 Universal (CC0 1.0) Public Domain Dedication',
		'exlinkwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'glitchcitywiki' => 'Creative Commons Attribution-NonCommercial 3.0 Unported (CC BY-NC 3.0)',
		'googologywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'incubatorwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'jadtechwiki' => 'Copyright © Jak and Daxter Technical Wiki. All rights reserved.',
		'rctwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'revitwiki' => '©2013-2025 by Lionel J. Camara (All Rights Reserved)',
		'reviwiki' => 'Creative Commons Attribution Share Alike',
		'saozhwiki' => '署名-非商业性使用-相同方式共享 3.0 中国大陆 (CC BY-NC-SA 3.0 CN)',
		'sekatetwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'spnatiwiki' => 'Copyright (c) 2015 The SPNATI Contributors',
		'wikilexiconwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
	],
	'wgRightsUrl' => [
		'default' => '',
		'animalroyalewiki' => 'https://creativecommons.org/licenses/by-nc-sa/3.0',
		'animalroyalezhwiki' => 'https://creativecommons.org/licenses/by-nc-sa/3.0',
		'connorjwatwiki' => 'https://creativecommons.org/licenses/by-sa/2.5',
		'constantnoblewiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'exlinkwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'glitchcitywiki' => 'https://creativecommons.org/licenses/by-nc/3.0',
		'googologywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'incubatorwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'jadtechwiki' => 'https://jadtech.miraheze.org/wiki/MediaWiki:Copyright',
		'rctwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr',
		'saozhwiki' => 'https://creativecommons.org/licenses/by-nc-sa/3.0/cn/',
		'sekatetwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'spnatiwiki' => 'https://gitgud.io/spnati/spnati/-/blob/master/LICENSE',
		'tlhwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'wikilexiconwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'worldtrainwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
	],
	'wmgWikiLicense' => [
		'default' => 'cc-by-sa',
	],

	// Links?
	'+wgUrlProtocols' => [
		'default' => [],
		'cloudstreamwiki' => [ 'cloudstreamrepo://' ],
		'downgradegameswiki' => [ 'steam://' ],
		'cafewiki' => [ 'roblox://', 'discord://' ],
		'urbanshadewiki' => [ 'roblox://' ],
		'utgwiki' => [ 'roblox://' ],
		'farmwiki' => [ 'roblox://' ],
		// file protocol only allowed on private wikis
		'rainversewiki' => [ 'gemini://' ],
		'100acgwiki' => [ 'infoflow://' ],
	],

	// LinkTarget
	'wgLinkTargetParentClasses' => [
		'default' => [],
		'anewc0dawiki' => [
			[ 'newtablinks', 'wikiwalk' ],
			'_self' => [ 'sametablinks' ]
		],
		'randrwiki' => [
			'_blank' => [ '' ]
		],
		'scruffwiki' => [
			'_blank' => [ '' ]
		],
		'sdiywikiwiki' => [
			'_blank' => [ '' ]
		],
		'simpleelectronicswikiwiki' => [
			'_blank' => [ '' ]
		],
	],

	// LinkTitles
	'wgLinkTitlesCheckRedirect' => [
		'default' => true,
	],
	'wgLinkTitlesEnableNoTargetMagicWord' => [
		'default' => false,
	],
	'wgLinkTitlesFirstOnly' => [
		'default' => true,
	],
	'wgLinkTitlesBlackList' => [
		'default' => [],
	],
	'wgLinkTitlesMinimumTitleLength' => [
		'default' => 4,
	],
	'wgLinkTitlesParseHeadings' => [
		'default' => false,
	],
	'wgLinkTitlesParseOnEdit' => [
		'default' => true,
	],
	'wgLinkTitlesParseOnRender' => [
		'default' => false,
	],
	'wgLinkTitlesPreferShortTitles' => [
		'default' => false,
	],
	'wgLinkTitlesSmartMode' => [
		'default' => true,
	],
	'wgLinkTitlesSameNamespace' => [
		'default' => true,
	],
	'wgLinkTitlesSkipTemplates' => [
		'default' => false,
	],
	'wgLinkTitlesSpecialPageReloadAfter' => [
		'default' => 1,
	],
	'wgLinkTitlesSourceNamespaces' => [
		'default' => [],
	],
	'wgLinkTitlesTargetNamespaces' => [
		'default' => [],
	],
	'wgLinkTitlesWordStartOnly' => [
		'default' => false,
	],
	'wgLinkTitlesWordEndOnly' => [
		'default' => false,
	],

	// LiliPond
	'wgScoreLilyPond' => [
		'default' => '/dev/null',
	],
	'wgScoreDisableExec' => [
		'default' => true,
	],

	// Linter
	'wgLinterWriteNamespaceColumnStage' => [
		'default' => true,
	],
	'wgLinterWriteTagAndTemplateColumnsStage' => [
		'default' => true,
	],

	// LoginNotify
	'wgLoginNotifyAttemptsNewIP' => [
		'default' => 3,
	],
	'wgLoginNotifySeenBucketSize' => [
		'default' => 8 * 86400,
	],
	'wgLoginNotifySeenExpiry' => [
		'default' => 80 * 86400,
	],
	'wgLoginNotifyUseSeenTable' => [
		'default' => true,
	],

	// Loops
	'egLoopsCountLimit' => [
		// DO NOT RAISE FOR ANY WIKI -- Universal Omega
		'default' => 100,
	],

	// Mail
	'wgEnableEmail' => [
		'default' => true,
	],
	'wgSMTP' => [
		'default' => [
			'host' => 'ssl://smtp-relay.gmail.com',
			'localhost' => '::1',
			'port' => 465,
			'IDHost' => 'miraheze.org',
			'auth' => false,
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
	],
	'wgEmergencyContact' => [
		'default' => 'noreply@miraheze.org',
	],
	'wgAllowHTMLEmail' => [
		'default' => true,
	],
	'wgEnableSpecialMute' => [
		'default' => true,
	],
	'wgEnableUserEmailMuteList' => [
		'default' => true,
	],

	// ManageWiki
	'wgManageWikiCacheDirectory' => [
		'default' => '/srv/mediawiki/cache',
	],
	'wgManageWikiExtensionsDefault' => [
		// WARNING: When adding a new extension here, please check whether there are any SQL files that need to be run
		// during installation! The installation steps defined in ManageWikiExtensions will not be executed here.
		// Instead, the relevant SQL files should be added to $wgCreateWikiSQLFiles (see also T14385 and T14400).
		'default' => [
			'categorytree',
			'cite',
			'citethispage',
			'codeeditor',
			'codemirror',
			// T14325: added here after being removed from global skins
			'cologneblue',
			'globaluserpage',
			'minervaneue',
			'mobilefrontend',
			// T14325: added here after being removed from global skins
			'modern',
			'multimediaviewer',
			'portableinfobox',
			'purge',
			'syntaxhighlight_geshi',
			'templatesandbox',
			'templatestyles',
			'textextracts',
			'thanks',
			'urlshortener',
			'wikiseo',
		],
	],
	'wgManageWikiForceSidebarLinks' => [
		'default' => false,
	],
	'wgManageWikiHandledUnknownContentModels' => [
		// Only add content models here that is not possible to get working on new wikis.
		// Content models that are possible should be setup when doing imports etc...
		// to avoid potential content model mismatch issues.
		'default' => [
			// Flow was removed
			'flow-board',
			// Interactivemap is a Fandom extension and the compatibility
			// mode in DataMaps does not work.
			'interactivemap',
		],
	],
	'wgManageWikiHelpUrl' => [
		'default' => '//meta.miraheze.org/wiki/Special:MyLanguage/ManageWiki',
	],
	'wgManageWikiModulesEnabled' => [
		'default' => [
			'core' => true,
			'extensions' => true,
			'namespaces' => true,
			'permissions' => true,
			'settings' => true,
		],
	],
	'wgManageWikiPermissionsAdditionalAddGroups' => [
		'default' => [],
		'sesupportwiki' => [
			'sysop' => [
				'editor',
			],
		],
		'metawiki' => [
			'techteam' => [
				'techteam',
			],
			'trustandsafety' => [
				'trustandsafety',
			],
		],
	],
	'wgManageWikiPermissionsAdditionalRemoveGroups' => [
		'default' => [],
		'sesupportwiki' => [
			'sysop' => [
				'editor',
			],
		],
		'metawiki' => [
			'techteam' => [
				'techteam',
			],
			'trustandsafety' => [
				'trustandsafety',
			],
		],
	],
	'wgManageWikiPermissionsAdditionalRights' => [
		'default' => [
			'*' => [
				'autocreateaccount' => true,
				'read' => true,
				'oathauth-enable' => true,
				'viewmyprivateinfo' => true,
				'editmyoptions' => true,
				'editmyprivateinfo' => true,
				'editmywatchlist' => true,
				'reportincident' => true,
			],
			'checkuser' => [
				'checkuser' => true,
				'checkuser-log' => true,
				'abusefilter-privatedetails' => true,
				'abusefilter-privatedetails-log' => true,
			],
			'suppress' => [
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
				'viewsuppressed' => true,
			],
			'steward' => [
				'userrights' => true,
			],
			'user' => [
				'mwoauthmanagemygrants' => true,
				'sendemail' => false,
				'user' => true,
			],
		],
		'+allpediawiki' => [
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
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
		'+famedatawiki' => [
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
			],
			'templateeditor' => [
				'edittemplateprotected' => true,
			],
		],
		'+famepediawiki' => [
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
			],
			'templateeditor' => [
				'edittemplateprotected' => true,
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
		'+infopediawiki' => [
			'wikistaff' => [
				'editwikistaffprotected' => true,
			],
		],
		'+ldapwikiwiki' => [
			'sysop' => [
				'managewiki-restricted' => true,
			],
			'user' => [
				'read' => true,
			],
		],
		'+metawiki' => [
			'assistant-steward' => [
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'centralauth-rename' => true,
				'createwiki' => true,
				'createwiki-deleterequest' => true,
				'globalblock' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'managewiki-extensions' => true,
				'managewiki-namespaces' => true,
				'managewiki-permissions' => true,
				'managewiki-settings' => true,
				'managewiki-restricted' => true,
				'noratelimit' => true,
			],
			'checkuser' => [
				'abusefilter-privatedetails' => true,
				'abusefilter-privatedetails-log' => true,
				'checkuser' => true,
				'checkuser-log' => true,
				'securepoll-view-voter-pii' => true,
			],
			'confirmed' => [
				'mwoauthproposeconsumer' => true,
				'mwoauthupdateownconsumer' => true,
			],
			'electionadmin' => [
				'securepoll-create-poll' => true,
				'securepoll-edit-poll' => true,
			],
			'global-renamer' => [
				'centralauth-rename' => true,
			],
			'global-admin' => [
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'centralauth-rename' => true,
				'globalblock' => true,
			],
			'proxybot' => [
				'globalblock' => true,
				'centralauth-lock' => true,
			],
			'steward' => [
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'centralauth-suppress' => true,
				'centralauth-rename' => true,
				'createwiki' => true,
				'createwiki-deleterequest' => true,
				'sendemail' => true,
				'globalblock' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'managewiki-core' => true,
				'managewiki-extensions' => true,
				'managewiki-namespaces' => true,
				'managewiki-permissions' => true,
				'managewiki-settings' => true,
				'managewiki-restricted' => true,
				'noratelimit' => true,
				'oathauth-verify-user' => true,
				'userrights' => true,
				'userrights-interwiki' => true,
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'view-private-import-requests' => true,
			],
			'techteam' => [
				'sendemail' => true,
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'handle-custom-domain-requests' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'oathauth-verify-user' => true,
				'oathauth-disable-for-user' => true,
				'view-private-import-requests' => true,
			],
			'suppress' => [
				'createwiki-suppressrequest' => true,
				'createwiki-suppressionlog' => true,
			],
			'trustandsafety' => [
				'userrights' => true,
				'sendemail' => true,
				'globalblock' => true,
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'userrights-interwiki' => true,
				'centralauth-lock' => true,
				'centralauth-rename' => true,
				'handle-pii' => true,
				'oathauth-disable-for-user' => true,
				'oathauth-verify-user' => true,
				'view-private-import-requests' => true,
			],
			'sysop' => [
				'interwiki' => true,
			],
			'user' => [
				'request-custom-domain' => true,
				'request-import' => true,
				'requestwiki' => true,
			],
			'wiki-creator' => [
				'createwiki' => true,
				'createwiki-deleterequest' => true,
			],
		],
		'+metawikibeta' => [
			'assistant-steward' => [
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'centralauth-rename' => true,
				'createwiki' => true,
				'createwiki-deleterequest' => true,
				'globalblock' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'managewiki-extensions' => true,
				'managewiki-namespaces' => true,
				'managewiki-permissions' => true,
				'managewiki-restricted' => true,
				'managewiki-settings' => true,
				'noratelimit' => true,
			],
			'autopatrolled' => [
				'autopatrolled' => true,
			],
			'confirmed' => [
				'mwoauthproposeconsumer' => true,
				'mwoauthupdateownconsumer' => true,
			],
			'global-renamer' => [
				'centralauth-rename' => true,
			],
			'global-admin' => [
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'globalblock' => true,
			],
			'proxybot' => [
				'globalblock' => true,
				'centralauth-lock' => true,
			],
			'requestwikiblocked' => [
				'read' => true,
			],
			'steward' => [
				'abusefilter-modify-global' => true,
				'centralauth-lock' => true,
				'centralauth-suppress' => true,
				'centralauth-rename' => true,
				'createwiki' => true,
				'sendemail' => true,
				'globalblock' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'managewiki-core' => true,
				'managewiki-extensions' => true,
				'managewiki-namespaces' => true,
				'managewiki-permissions' => true,
				'managewiki-settings' => true,
				'managewiki-restricted' => true,
				'noratelimit' => true,
				'userrights' => true,
				'userrights-interwiki' => true,
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'view-private-import-requests' => true,
			],
			'techteam' => [
				'sendemail' => true,
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'oathauth-verify-user' => true,
				'oathauth-disable-for-user' => true,
				'view-private-import-requests' => true,
			],
			'trustandsafety' => [
				'sendemail' => true,
				'userrights' => true,
				'globalblock' => true,
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'userrights-interwiki' => true,
				'centralauth-lock' => true,
				'centralauth-rename' => true,
				'handle-pii' => true,
				'oathauth-disable-for-user' => true,
				'oathauth-verify-user' => true,
				'view-private-import-requests' => true,
			],
			'user' => [
				'request-custom-domain' => true,
				'request-import' => true,
				'requestwiki' => true,
			],
			'wiki-creator' => [
				'createwiki' => true,
			],
		],
		'+moviepediawiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'founder' => [
				'founder' => true,
			],
		],
		'+mypediawiki' => [
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
			],
			'sysop' => [
				'editextendedconfirmedprotected' => true,
			],
		],
		'+nenawikiwiki' => [
			'editor' => [
				'edit-content-pages' => true,
				'edit-talkpage' => true,
			],
			'emailconfirmed' => [
				'read' => true,
			],
			'nenamembers' => [
				'edit-talkpage' => true,
			],
			'sysop' => [
				'edit-admin-pages' => true,
			],
		],
		'+phightingwiki' => [
			'trusted_users' => [
				'edittrusteduserprotected' => true,
			],
		],
		'+sesupportwiki' => [
			'editor' => [
				'editor' => true,
			],
			'sysop' => [
				'editor' => true,
			],
		],
		'+testwiki' => [
			'tech' => [
				'globalgrouppermissions' => true,
			],
		],
		'+vnenderbotwiki' => [
			'templateeditor' => [
				'template' => true,
			],
			'extendedconfirmed' => [
				'extendedconfirmed' => true,
			],
			'Owner' => [
				'template' => true,
				'extendedconfirmed' => true,
				'owner' => true,
			],
		],
		'+whentheycrywiki' => [
			'user' => [
				'edit-create' => true,
			],
		],
	],
	'wgManageWikiPermissionsDefaultPrivateGroup' => [
		'default' => 'member',
	],
	'wgManageWikiPermissionsDisallowedGroups' => [
		'default' => [
			'assistant-steward',
			'checkuser',
			'checkuser-temporary-account-viewer',
			'global-admin',
			'smwadministrator',
			'oversight',
			'steward',
			'staff',
			'suppress',
			'temporary-account-viewer',
			'techteam',
			'trustandsafety',
		],
		'+metawiki' => [
			'electionadmin',
		],
	],
	'wgManageWikiPermissionsDisallowedRights' => [
		'default' => [
			'any' => [
				'abusefilter-hide-log',
				'abusefilter-hidden-log',
				'abusefilter-modify-global',
				'abusefilter-private',
				'abusefilter-private-log',
				'abusefilter-privatedetails',
				'abusefilter-privatedetails-log',
				'aft-oversighter',
				'autocreateaccount',
				'bigdelete',
				'blockemail',
				'centralauth-createlocal',
				'centralauth-lock',
				'centralauth-suppress',
				'centralauth-rename',
				'centralauth-unmerge',
				'checkuser',
				'checkuser-log',
				'checkuser-temporary-account',
				'checkuser-temporary-account-no-preference',
				'checkuser-temporary-account-log',
				'checkuser-temporary-account-auto-reveal',
				'createwiki',
				'createwiki-deleterequest',
				'createwiki-suppressionlog',
				'createwiki-suppressrequest',
				'editincidents',
				'editothersprofiles-private',
				'sendemail',
				'generate-random-hash',
				'globalblock',
				'globalblock-exempt',
				'globalgroupmembership',
				'globalgrouppermissions',
				'handle-custom-domain-requests',
				'handle-import-request-interwiki',
				'handle-import-requests',
				'handle-pii',
				'hideuser',
				'investigate',
				'ipinfo',
				'ipinfo-view-basic',
				'ipinfo-view-full',
				'ipinfo-view-log',
				'managewiki-editdefault',
				'managewiki-privacy',
				'managewiki-restricted',
				'moderation-checkuser',
				'mwoauthmanageconsumer',
				'mwoauthmanagemygrants',
				'mwoauthsuppress',
				'mwoauthviewprivate',
				'mwoauthviewsuppressed',
				'oathauth-api-all',
				'oathauth-enable',
				'oathauth-disable-for-user',
				'oathauth-verify-user',
				'oathauth-view-log',
				'oathauth-recover-for-user',
				'renameuser',
				'renameuser-global',
				'reportincident',
				'request-custom-domain',
				'request-import',
				'requestwiki',
				'siteadmin',
				'searchdigest-admin',
				'securepoll-view-voter-pii',
				'smw-admin',
				'smw-patternedit',
				'smw-viewjobqueuewatchlist',
				'stopforumspam',
				'suppressionlog',
				'suppressrevision',
				'themedesigner',
				'titleblacklistlog',
				'updatepoints',
				'userrights',
				'userrights-interwiki',
				'view-private-import-requests',
				'viewglobalprivatefiles',
				'viewpmlog',
				'viewsuppressed',
				'campaignevents-organize-events',
			],
			'user' => [
				'autoconfirmed',
				'noratelimit',
				'skipcaptcha',
				'managewiki-core',
				'managewiki-extensions',
				'managewiki-namespaces',
				'managewiki-permissions',
				'managewiki-settings',
				'globalblock-whitelist',
				'ipblock-exempt',
				'interwiki',
			],
			'*' => [
				'read',
				'skipcaptcha',
				'torunblocked',
				'centralauth-merge',
				'generate-dump',
				'editsitecss',
				'editsitejson',
				'editsitejs',
				'editusercss',
				'edituserjson',
				'edituserjs',
				'editmyoptions',
				'editmyprivateinfo',
				'editmywatchlist',
				'globalblock-whitelist',
				'interwiki',
				'ipblock-exempt',
				'viewmyprivateinfo',
				'viewmywatchlist',
				'managewiki-core',
				'managewiki-extensions',
				'managewiki-namespaces',
				'managewiki-permissions',
				'managewiki-settings',
				'noratelimit',
				'autoconfirmed',
			],
		],
	],
	'wgManageWikiUseCustomDomains' => [
		'default' => true,
	],

	// Maps
	'egMapsDefaultService' => [
		'ext-Maps' => 'leaflet',
	],
	'egMapsDisableSmwIntegration' => [
		'ext-Maps' => false,
	],

	// MassMessage
	'wgAllowGlobalMessaging' => [
		'default' => false,
		'metawiki' => true,
		'metawikibeta' => true,
	],

	// MatomoAnalytics
	'wgMatomoAnalyticsServerURL' => [
		'default' => 'https://analytics.wikitide.net/',
	],
	'wgMatomoAnalyticsUseDB' => [
		'default' => true,
	],
	'wgMatomoAnalyticsSiteID' => [
		'default' => 1,
	],
	'wgMatomoAnalyticsGlobalID' => [
		'default' => 1,
	],
	'wgMatomoAnalyticsDisableCookie' => [
		'default' => true,
	],
	'wgMatomoAnalyticsEnableCustomDimensionsUserType' => [
		'default' => true,
	],

	// MediaModeration
	'wgMediaModerationFrom' => [
		'default' => 'noreply@wikitide.org',
	],
	'wgMediaModerationRecipientList' => [
		'default' => [
			// Don't put plain text email here.
			base64_decode( 'dHNAd2lraXRpZGUub3Jn' ),
		],
	],

	// Medik settings
	'wgMedikColor' => [
		'default' => '#FFBE00',
	],
	'wgMedikContentWidth' => [
		'default' => 'default',
	],
	'wgMedikLogoWidth' => [
		'default' => 'default',
	],
	'wgMedikResponsive' => [
		'default' => true,
	],
	'wgMedikShowLogo' => [
		'default' => 'none',
	],
	'wgMedikUseLogoWithoutText' => [
		'default' => false,
	],

	// Metrolook settings
	'wgMetrolookDownArrow' => [
		'default' => true,
	],
	'wgMetrolookUploadButton' => [
		'default' => true,
	],
	'wgMetrolookBartile' => [
		'default' => true,
	],
	'wgMetrolookMobile' => [
		'default' => true,
	],
	'wgMetrolookUseIconWatch' => [
		'default' => true,
	],
	'wgMetrolookLine' => [
		'default' => true,
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

	// MinervaNeue
	'wgMinervaEnableSiteNotice' => [
		'default' => true,
	],
	'wgMinervaApplyKnownTemplateHacks' => [
		'default' => true,
		'isvwiki' => false,
		'mcspringfieldserverwiki' => false,
	],
	'wgMinervaAlwaysShowLanguageButton' => [
		'default' => true,
	],
	'wgMinervaTalkAtTop' => [
		'default' => [
			'base' => false,
			'beta' => false,
			'loggedin' => true,
		],
		'isvwiki' => [
			'base' => true,
			'beta' => true,
			'loggedin' => true,
		],
	],
	'wgMinervaHistoryInPageActions' => [
		'default' => [
			'base' => false,
			'beta' => false,
			'amc' => true,
		],
		'isvwiki' => [
			'base' => true,
			'beta' => true,
			'amc' => true,
		],
	],
	'wgMinervaAdvancedMainMenu' => [
		'default' => [
			'base' => false,
			'beta' => false,
			'amc' => true,
		],
		'isvwiki' => [
			'base' => true,
			'beta' => true,
			'amc' => true,
		],
	],
	'wgMinervaPersonalMenu' => [
		'default' => [
			'base' => false,
			'beta' => false,
			'amc' => true,
		],
		'isvwiki' => [
			'base' => true,
			'beta' => true,
			'amc' => true,
		],
	],
	'wgMinervaOverflowInPageActions' => [
		'default' => [
			'base' => false,
			'beta' => false,
			'amc' => true,
		],
		'isvwiki' => [
			'base' => true,
			'beta' => true,
			'amc' => true,
		],
	],
	'wgMinervaShowCategories' => [
		'default' => [
			'base' => false,
			'loggedin' => false,
			'amc' => true,
		],
		'criticalrolewiki' => [
			'base' => true,
			'loggedin' => false,
			'amc' => true,
		],
		'isvwiki' => [
			'base' => true,
			'loggedin' => true,
			'amc' => true,
		],
		'osmaniawiki' => [
			'base' => true,
			'loggedin' => true,
			'amc' => true,
		],
	],

	// Mirage
	'wgMirageEnableImageWordmark' => [
		'default' => true,
	],
	'wgMirageHiddenRightRailModules' => [
		'default' => [],
	],
	'wgMirageTheme' => [
		'default' => false,
	],

	// MirahezeMagic
	'wgMirahezeMagicAccessIdsMap' => [
		'default' => [
			// Only the board are allowed access
			// DO NOT ADD UNAUTHORIZED USERS
			'iowiki' => [
				/** Reception123 */
				19,
				/** Labster */
				2551,
				/** Harej */
				13892,
				/** Raidarr */
				249078,
				/** NotAracham */
				345529,
				/** Universal Omega */
				438966,
				/** Agent Isai */
				512002,
			],
			// Only the board and Technology team are allowed access
			// DO NOT ADD UNAUTHORIZED USERS
			'staffwiki' => [
				/** Labster (Board) */
				2551,
				/** Harej (Board) */
				13892,
				/** RhinosF1 (Miraheze) (Technology team) */
				243629,
				/** Raidarr (Board) */
				249078,
				/** Agent (Miraheze) (Technology team and Board) */
				330070,
				/** NotAracham (Board) */
				345529,
				/** Universal Omega (Miraheze) (Technology team and Board) */
				459599,
				/** BlankEclair (Miraheze) (Technology team) */
				592845,
				/** SomeRandomDeveloper (Miraheze) (Technology team) */
				650827,
				/** Skye (Miraheze) (Technology team) */
				786522,
				/** MacFan4000 (Miraheze) (Technology team) */
				796050,
				/** Paladox (Miraheze) (Technology team) */
				796073,
				/** PetraMagna (Miraheze) (Technology team) */
				796099,
				/** Original Authority (Miraheze) (Technology team) */
				796544,
				/** Reception123 (Miraheze) (Technology team and Board) */
				796684,
				/** Void (Miraheze) (Technology team) */
				798213,
			],
		],
	],

	// Miscellaneous
	'wgAllowDisplayTitle' => [
		'default' => true,
	],
	'wgRestrictDisplayTitle' => [
		'default' => true,
		'ext-NoTitle' => false,
	],
	'wgCapitalLinks' => [
		'default' => true,
	],
	'wgEnableMagicLinks' => [
		'default' => [
			'ISBN' => false,
			'PMID' => false,
			'RFC' => false,
		],
	],
	'wgEnableProtectionIndicators' => [
		'default' => false,
	],
	'wgActiveUserDays' => [
		'default' => 30,
	],
	'wgEnableCanonicalServerLink' => [
		'default' => true,
	],
	'wgPageCreationLog' => [
		'default' => true,
	],
	'wgRCWatchCategoryMembership' => [
		'default' => false,
	],
	'wgExpensiveParserFunctionLimit' => [
		'default' => 99,
	],
	'wgAllowSlowParserFunctions' => [
		'default' => false,
	],
	'wgExternalLinkTarget' => [
		'default' => false,
	],
	'wgGitInfoCacheDirectory' => [
		'default' => '/srv/mediawiki/cache/' . $wi->version . '/gitinfo',
	],
	'wgAllowExternalImages' => [
		'default' => false,
	],
	'wgFragmentMode' => [
		'default' => [
			'html5',
			'legacy'
		],
	],
	'wgTrustedMediaFormats' => [
		'default' => [
			MEDIATYPE_BITMAP,
			MEDIATYPE_AUDIO,
			MEDIATYPE_VIDEO,
			'image/svg+xml',
			'application/pdf',
		],
		'+polytopewiki' => [
			MEDIATYPE_TEXT,
		],
		'+ext-3d' => [
			'application/sla',
		],
	],
	'wgNativeImageLazyLoading' => [
		'default' => false,
	],
	'wgShellRestrictionMethod' => [
		'default' => 'firejail',
	],
	'wgShellboxUrls' => [
		'default' => [
			'default' => null,
		],
		'+ext-Score' => [
			'score' => 'http://localhost:6024/shellbox',
		],
	],
	'wgCrossSiteAJAXdomains' => [
		'default' => [
			'login.miraheze.org',
		],
		'beta' => [
			'login.mirabeta.org',
		],
		'private' => [],
		'wikicreatorswiki' => [
			'meta.miraheze.org',
		],
	],
	'wgWhitelistRead' => [
		'default' => [],
	],
	'wgWhitelistReadRegexp' => [
		'default' => [],
		'kanrikyarawiki' => [ "#(?!(?:Draft(?: talk)?:|Notes(?: talk)?:|User(?: talk)?:[^/]+/sandbox/))^#" ]
	],
	'wgDisabledVariants' => [
		'default' => [],
		'zhtardiswiki' => [
			'zh-hans',
			'zh-hant',
			'zh-mo',
			'zh-my',
		],
	],
	'wgDefaultLanguageVariant' => [
		'default' => false,
		'zhtranswiki' => 'zh-cn',
	],
	'wgCleanSignatures' => [
		'default' => true,
	],
	'wgResponsiveImages' => [
		'default' => true,
		'lookoutsidewiki' => false,
	],

	// MobileFrontend
	'wgDefaultMobileSkin' => [
		'default' => 'minerva',
	],
	'wgMFNamespacesWithoutCollapsibleSections' => [
		// See https://github.com/wikimedia/mediawiki-extensions-MobileFrontend?tab=readme-ov-file#wgmfnamespaceswithoutcollapsiblesections
		'default' => [
			NS_FILE,
			NS_CATEGORY,
			NS_SPECIAL,
			NS_MEDIA,
		],
	],
	'wgMFAdvancedMobileContributions' => [
		'default' => true,
	],
	'wgMFAmcOutreach' => [
		'default' => false,
	],
	'wgMFAmcOutreachMinEditCount' => [
		'default' => 100,
	],
	'wgMFAutodetectMobileView' => [
		'default' => true,
	],
	'wgMFCustomSiteModules' => [
		'default' => false,
	],
	'wgMFDisplayWikibaseDescriptions' => [
		'default' => [
			'search' => false,
			'nearby' => false,
			'watchlist' => false,
			'tagline' => false,
		],
	],
	'wgMFEnableBeta' => [
		'default' => true,
	],
	'wgMFEnableFontChanger' => [
		'default' => [
			'beta' => true,
			'base' => true,
		],
	],
	'wgMFEnableMobilePreferences' => [
		'default' => false,
	],
	'wgMFEnableVEWikitextEditor' => [
		'default' => false,
	],
	'wgMFEnableWikidataDescriptions' => [
		'default' => [
			'beta' => true,
			'base' => false,
		],
	],
	'wgMFDefaultEditor' => [
		'default' => 'preference',
	],
	'wgMFFallbackEditor' => [
		'default' => 'visual',
	],
	'wgMFLazyLoadImages' => [
		'default' => [
			'beta' => true,
			'base' => true,
		]
	],
	'wgMFLazyLoadSkipSmallImages' => [
		'default' => false,
	],
	'wgMFLogWrappedInfoboxes' => [
		'default' => true,
	],
	'wgMFMobileHeader' => [
		'ext-MobileFrontend' => 'X-Subdomain',
	],
	'wgMFNoindexPages' => [
		'ext-MobileFrontend' => false,
	],
	'wgMFQueryPropModules' => [
		'default' => [
			'pageprops',
		],
		'gratisdatawiki' => [
			'entityterms',
		],
	],
	'wgMFRemovableClasses' => [
		'default' => [
			'beta' => [],
			'base' => [
				'.navbox',
				'.vertical-navbox',
				'.nomobile',
			],
		],
		'danmachienwiki' => [
			'base' => [
				'.nomobile',
			],
		],
		'mcspringfieldserverwiki' => [
			'base' => [
				'.nomobile',
			],
		],
	],
	'wgMFSearchAPIParams' => [
		'default' => [
			'ppprop' => 'displaytitle',
		],
		'famedatawiki' => [
			'wbetterms' => 'label',
		],
		'gratisdatawiki' => [
			'wbetterms' => 'label',
		],
	],
	'wgMFSearchGenerator' => [
		'default' => [
			'name' => 'prefixsearch',
			'prefix' => 'ps',
		],
		'famedatawiki' => [
			'name' => 'wbsearch',
			'prefix' => 'wbs',
		],
		'gratisdatawiki' => [
			'name' => 'wbsearch',
			'prefix' => 'wbs',
		],
	],
	'wgMFShowFirstParagraphBeforeInfobox' => [
		'default' => [
			'base' => true,
			'beta' => true,
		],
	],
	'wgMFShowMobileViewToTablets' => [
		'default' => true,
	],
	'wgMFUseDesktopSpecialEditWatchlistPage' => [
		'default' => [
			'base' => false,
			'beta' => false,
			'amc' => true,
		],
	],
	'wgMFUseWikibase' => [
		'default' => false,
	],
	'wgMinervaNightMode' => [
		'default' => [
			'amc' => true,
			'base' => true,
			'loggedin' => true,
		],
	],

	// Moderation extension settings
	// Enable or disable notifications.
	'wgModerationNotificationEnable' => [
		'default' => false,
		'obeymewiki' => true,
	],
	// Notify administrator only about new pages requests.
	'wgModerationNotificationNewOnly' => [
		'default' => false,
	],
	// Email to send notifications to.
	'wgModerationEmail' => [
		'default' => $wgPasswordSender,
	],
	'wgModerationPreviewLink' => [
		'default' => false,
	],
	'wgModerationEnableEditChange' => [
		'default' => false,
	],
	'wgModerationOnlyInNamespaces' => [
		'default' => [],
	],

	// Monaco
	'wgMonacoAllowUseTheme' => [
		'default' => true,
	],
	'wgMonacoTheme' => [
		'default' => 'sapphire',
	],

	// MsCatSelect vars
	'wgMSCS_WarnNoCategories' => [
		'default' => true,
	],

	// MsUpload settings
	'wgMSU_useDragDrop' => [
		'default' => true,
	],
	'wgMSU_showAutoCat' => [
		'default' => false,
	],
	'wgMSU_checkAutoCat' => [
		'default' => false,
	],
	'wgMSU_confirmReplace' => [
		'default' => false,
	],

	// MultimediaViewer (not beta)
	'wgMediaViewerEnableByDefault' => [
		'default' => true,
	],
	'wgMediaViewerThumbnailBucketSizes' => [
		'default' => [
			320,
			800,
			1024,
			1280,
			1920,
			2560,
			2880,
		],
		'strinovawiki' => [
			320,
			800,
			1024,
			1280,
			1920,
			2560,
		],
	],

	// Math
	'wgMathValidModes' => [
		'default' => [
			'mathml'
		],
	],

	// MultiBoilerplate
	'wgMultiBoilerplateOptions' => [
		'ext-MultiBoilerplate' => false,
	],
	'wgMultiBoilerplateOverwrite' => [
		'ext-MultiBoilerplate' => false,
	],

	// NamespacePreload
	'wgNamespacePreloadDoExpansion' => [
		'default' => true,
	],

	// NearbyPages - T11025
	'wgNearbyPagesUrl' => [
		'default' => '/w/api.php',
	],

	// New User Email Notification
	'wgNewUserNotifEmailTargets' => [
		'default' => [],
	],

	// NewUserMessage configs
	'wgNewUserSuppressRC' => [
		'default' => false,
	],
	'wgNewUserMinorEdit' => [
		'default' => true,
	],
	'wgNewUserMessageOnAutoCreate' => [
		'default' => false,
	],

	// nofollow links
	'wgNoFollowLinks' => [
		'default' => true,
	],
	'wgNoFollowNsExceptions' => [
		'default' => [],
	],

	// Users Notified On All Changes
	'wgUsersNotifiedOnAllChanges' => [
		'default' => [],
	],

	// OATHAuth
	'wgOATHExclusiveRights' => [
		'default' => [
			'abusefilter-privatedetails',
			'abusefilter-privatedetails-log',
			'centralauth-lock',
			'centralauth-rename',
			'centralauth-suppress',
			'checkuser',
			'checkuser-log',
			'globalblock',
			'globalgrouppermissions',
			'globalgroupmembership',
			'securepoll-view-voter-pii',
			'suppressionlog',
			'suppressrevision',
			'userrights',
			'userrights-interwiki',
		],
		'+metawiki' => [
			'edituserjs',
			'editsitejs',
		],
	],
	'wgOATHRequiredForGroups' => [
		'default' => [
			'checkuser',
			'suppress',
			'steward',
		],
		'+cafewiki' => [
			'sysop',
		],
		'+ldapwikiwiki' => [
			'user',
		],
		'+metawiki' => [
			'assistant-steward',
			'electionadmin',
			'global-admin',
			'interface-admin',
			'techteam',
			'trustandsafety',
		],
		// metawikibeta should mirror metawiki
		'+metawikibeta' => [
			'global-admin',
			'interface-admin',
			'techteam',
			'trustandsafety'
		],
		'+recaptimesquadwiki' => [
			'bureaucrat',
			'crew-recaptime-dev',
			'interface-admin',
			'sysop',
		],
	],
	// OAuth
	'wgMWOAuthCentralWiki' => [
		'default' => 'metawiki',
		'ldapwikiwiki' => false,
		'beta' => 'metawikibeta',
	],
	'wgOAuth2GrantExpirationInterval' => [
		'default' => 'PT4H',
	],
	'wgOAuth2RefreshTokenTTL' => [
		'default' => 'P365D',
	],
	'wgMWOAuthSharedUserSource' => [
		'default' => 'CentralAuth',
	],
	'wgMWOAuthSecureTokenTransfer' => [
		'default' => true,
	],
	'wgOAuth2PublicKey' => [
		'default' => '/srv/mediawiki/config/OAuth2.key.pub',
	],
	'wgOAuth2PrivateKey' => [
		'default' => '/srv/mediawiki/config/OAuth2.key',
	],

	// Page Images
	'wgPageImagesDenylist' => [
		'ext-PageImages' => [
			[
				'type' => 'db',
				'page' => 'MediaWiki:Pageimages-denylist',
				'db' => false,
			],
		],
	],
	'wgPageImagesExpandOpenSearchXml' => [
		'default' => false,
	],
	'wgPageImagesLeadSectionOnly' => [
		'default' => false,
	],
	'wgPageImagesOpenGraph' => [
		'default' => true,
	],

	// Pagelang
	'wgPageLanguageUseDB' => [
		'default' => false,
	],

	// PageForms
	'wgPageFormsRenameEditTabs' => [
		'default' => false,
	],
	'wgPageFormsRenameMainEditTab' => [
		'default' => false,
	],
	'wgPageFormsSimpleUpload' => [
		'default' => false,
	],
	'wgPageFormsLinkAllRedLinksToForms' => [
		'default' => false,
	],

	// Page Size
	'wgMaxArticleSize' => [
		'default' => 2048,
	],

	// ParserFunctions
	'wgPFEnableStringFunctions' => [
		'default' => false,
	],

	// ParserMigration
	'wgParserMigrationEnableQueryString' => [
		'default' => true,
	],
	'wgParserMigrationEnableReportVisualBug' => [
		'default' => true,
		'private' => false,
	],
	'wgParserMigrationFeedbackAPIURL' => [
		'default' => 'https://meta.miraheze.org/w/api.php',
		'metawiki' => false,
		'private' => false,
	],
	'wgParserMigrationFeedbackTitle' => [
		'default' => 'Tech:Parsoid/Feedback',
		'private' => false,
	],
	'wgParserMigrationFeedbackTitleURL' => [
		'default' => 'https://meta.miraheze.org/wiki/Tech:Parsoid/Feedback',
		'metawiki' => false,
		'private' => false,
	],

	// Parsoid
	'wgParsoidSettings' => [
		'default' => [
			'useSelser' => true,
		],
		'+ext-Linter' => [
			'linting' => true,
		],
	],

	// Phonos
	'wgPhonosEspeak' => [
		'default' => '/usr/local/bin/mediawiki-firejail-espeak',
	],
	'wgPhonosLame' => [
		'default' => '/usr/local/bin/mediawiki-firejail-lame',
	],
	'wgPhonosEngine' => [
		/*
		 * Only espeak is supported!
		 * - Google's text to speech engine requires an API key
		 * - Larynx is run on wmcloud. Sending the traffic generated by us to them would be unfair to them. If wanted we can probably run our own Larynx instance
		 * Do not change this OR add to ManageWiki unless you added support for other engines
		 */
		'default' => 'espeak',
	],
	'wgPhonosInlineAudioPlayerMode' => [
		'default' => false,
	],

	'wgTemporaryParsoidHandlerParserCacheWriteRatio' => [
		'default' => 1.0,
		'commonswiki' => 0.0,
	],

	// PdfHandler
	'wgPdfProcessor' => [
		'default' => '/usr/local/bin/mediawiki-firejail-ghostscript',
	],
	'wgPdfPostProcessor' => [
		'default' => '/usr/local/bin/mediawiki-firejail-convert',
	],

	// Permissions
	'wgGroupsAddToSelf' => [
		'default' => [],
	],
	'wgGroupsRemoveFromSelf' => [
		'default' => [],
	],
	'+wgRevokePermissions' => [
		'default' => [],
		'+cookbookwiki' => [
			'users_blocked_from_commenting' => [
				'comment' => true,
				'commentlinks' => true,
				'comment-delete-own' => true,
			],
		],
		'+metawiki' => [
			'requestwikiblocked' => [
				'requestwiki' => true,
			],
		],
	],
	'wgImplicitGroups' => [
		'default' => [
			'*',
			'user',
			'autoconfirmed'
		],
	],

	// Password policy
	'wgPasswordPolicy' => [
		'default' => [
			'policies' => [
				'default' => [
					'MinimalPasswordLength' => [ 'value' => 6, 'suggestChangeOnLogin' => false ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'bot' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'sysop' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'bureaucrat' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
			],
			'checks' => [
				'MinimalPasswordLength' => 'MediaWiki\\Password\\PasswordPolicyChecks::checkMinimalPasswordLength',
				'MinimumPasswordLengthToLogin' => 'MediaWiki\\Password\\PasswordPolicyChecks::checkMinimumPasswordLengthToLogin',
				'PasswordCannotBeSubstringInUsername' => 'MediaWiki\\Password\\PasswordPolicyChecks::checkPasswordCannotBeSubstringInUsername',
				'PasswordCannotMatchDefaults' => 'MediaWiki\\Password\\PasswordPolicyChecks::checkPasswordCannotMatchDefaults',
				'MaximalPasswordLength' => 'MediaWiki\\Password\\PasswordPolicyChecks::checkMaximalPasswordLength',
				'PasswordNotInCommonList' => 'MediaWiki\\Password\\PasswordPolicyChecks::checkPasswordNotInCommonList',
			],
		],
	],
	'wgCentralAuthGlobalPasswordPolicies' => [
		'default' => [
			'assistant-steward' => [
				'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true, 'forceChange' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 1 ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'global-admin' => [
				'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true, 'forceChange' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 1 ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'global-patroller' => [
				'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true, 'forceChange' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 1 ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'steward' => [
				'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true, 'forceChange' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 1 ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'techteam' => [
				'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true, 'forceChange' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 1 ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'trustandsafety' => [
				'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true, 'forceChange' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 1 ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'wiki-mechanics' => [
				'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true, 'forceChange' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 1 ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
		],
	],

	// Popups
	'wgPopupsHideOptInOnPreferencesPage' => [
		'default' => false,
	],
	'wgPopupsTextExtractsIntroOnly' => [
		'default' => true,
	],
	'wgPopupsOptInDefaultState' => [
		'default' => 0,
	],

	// PortableInfobox
	'wgPortableInfoboxResponsiblyOpenCollapsed' => [
		'default' => true,
	],
	'wgPortableInfoboxUseFileDescriptionPage' => [
		'default' => false,
	],
	'wgPortableInfoboxUseHeadings' => [
		'default' => true,
	],
	'wgPortableInfoboxCacheRenderers' => [
		'default' => true,
	],
	'wgPortableInfoboxCustomImageWidth' => [
		'default' => 300,
	],

	// Preferences
	'+wgDefaultUserOptions' => [
		'default' => [
			'enotifwatchlistpages' => 0,
			'math' => 'mathml',
			'usebetatoolbar' => 1,
			'usebetatoolbar-cgd' => 1,
		],
		'+acwiki' => [
			'usenewrc' => 0,
			'thumbsize' => 3,
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
		],
		'+banjokazooiewiki' => [
			'rcenhancedfilters-disable' => 1,
			'thumbsize' => 3,
			'usenewrc' => 0,
			'wlenhancedfilters-disable' => 1,
		],
		'+cecuwiki' => [
			'vector-theme' => 'os',
		],
		'+combatinitiationwiki' => [
			'vector-theme' => 'os',
		],
		'+crashspyrowiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+criticalrolewiki' => [
			'thumbsize' => 3,
		],
		'+crocwiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+dappervolkwiki' => [
			'vector-theme' => 'os',
		],
		'+dccomicswiki' => [
			'visualeditor-newwikitext' => 1,
			'usebetatoolbar' => 0,
			'usebetatoolbar-cgd' => 0,
		],
		'+dcmultiversewiki' => [
			'visualeditor-newwikitext' => 1,
			'usebetatoolbar' => 0,
			'usebetatoolbar-cgd' => 0,
		],
		'+dmlwikiwiki' => [
			'imagesize' => 2,
		],
		'+fanpediawiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+fwtdwiki' => [
			'minerva-theme' => 'night',
		],
		'+kaiserreichwiki' => [
			'vector-theme' => 'night',
		],
		'+kirbywiki' => [
			'thumbsize' => 3,
		],
		'+landarwiki' => [
			'usenewrc' => 0,
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
		],
		'+lazerpigeonwiki' => [
			'vector-theme' => 'os',
		],
		'+mariowiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+nintendowiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+piggywiki' => [
			'vector-theme' => 'night',
		],
		'+pokemonwiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+reviwiki' => [
			'rcenhancedfilters-disable' => 1,
			'usenewrc' => 0,
		],
		'+rippaversewiki' => [
			'visualeditor-newwikitext' => 1,
			'usebetatoolbar' => 0,
			'usebetatoolbar-cgd' => 0,
		],
		'+sp2pediawiki' => [
			'vector-theme' => 'night',
		],
		'+ssbuniversewiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+stopitslenderwiki' => [
			'minerva-theme' => 'night',
			'vector-theme' => 'night',
		],
		'+versesanddimensionswiki' => [
			'vector-theme' => 'night',
		],
		'+zenithwiki' => [
			'vector-theme' => 'night',
		],
		'+zhtranswiki' => [
			'echo-subscriptions-email-dt-subscription' => true,
			'echo-subscriptions-email-dt-subscription-archiving' => true,
			'echo-subscriptions-email-mention' => true,
			'echo-subscriptions-email-reverted' => true,
			'echo-subscriptions-web-mention-failure' => true,
			'echo-subscriptions-web-mention-success' => true,
			'echo-subscriptions-web-reverted' => true,
			'enotifwatchlistpages' => true,
			'toc-expand' => true,
			'visualeditor-tabs' => 'prefer-wt',
			'uselivepreview' => true,
			'watchlistunwatchlinks' => true,
		],
		'+ext-CleanChanges' => [
			'usenewrc' => 1,
		],
	],
	'wmgCodeMirrorEnableDefault' => [
		'default' => false,
	],

	// Preloader
	'wgPreloaderSource' => [
		'default' => [
			0 => 'Template:Boilerplate',
		],
	],

	// ProofreadPage
	'wgProofreadPageNamespaceIds' => [
		'ext-ProofreadPage' => [
			'index' => 252,
			'page' => 250,
		],
	],

	// PropertySuggester
	'wgPropertySuggesterDeprecatedIds' => [
		'default' => [],
	],
	'wgPropertySuggesterClassifyingPropertyIds' => [
		'default' => [],
	],
	'wgPropertySuggesterInitialSuggestions' => [
		'default' => [],
	],
	'wgPropertySuggesterMinProbability' => [
		'default' => 0.05,
	],

	// PWA
	'wgPWAConfigs' => [
		'ext-PWA' => [
			'main' => [
				'manifest' => 'manifest.json',
				'patterns' => [ '/.*/' ],
			],
		],
	],

	// RateLimits
	'+wgRateLimits' => [
		'default' => [],
		'metawiki' => [
			'requestwiki' => [
				'ip-all' => [ 1, 259200 ],
				'user' => [ 1, 259200 ],
			],
		],
		'loginwiki' => [
			'edit' => [
				'ip-all' => [ 5, 3600 ],
				'user' => [ 5, 3600 ],
			],
		],
	],

	// RatePage
	'wgRPRatingAllowedNamespaces' => [
		'default' => [ NS_MAIN ],
	],
	'wgRPRatingPageBlacklist' => [
		'default' => [],
	],
	'wgRPSidebarPosition' => [
		'default' => 2,
	],
	'wgRPAddSidebarSection' => [
		'default' => true,
	],
	'wgRPShowResultsBeforeVoting' => [
		'default' => false,
	],
	'wgRPUseMMVModule' => [
		'default' => true,
	],

	// RecentChanges
	'wgFeedLimit' => [
		'default' => 50,
	],
	'wgRCMaxAge' => [
		'default' => 180 * 24 * 3600,
	],
	'wgRCLinkDays' => [
		'default' => [ 1, 3, 7, 14, 30 ],
	],
	'wgRCLinkLimits' => [
		'default' => [ 50, 100, 250, 500 ],
	],
	'wgUseRCPatrol' => [
		'default' => true,
	],
	'wmgDefaultRecentChangesDays' => [
		'default' => 7,
	],

	// RenderBlocking
	'wgRenderBlockingInlineAssets' => [
		'default' => false,
	],

	// ReportIncident
	'wgReportIncidentAdministratorsPage' => [
		'default' => 'meta:Trust_and_Safety',
	],
	'wgReportIncidentEmailFromAddress' => [
		'default' => $wgPasswordSender,
	],
	'wgReportIncidentRecipientEmails' => [
		'default' => [
			// Don't put plain text email here.
			base64_decode( 'dHNAd2lraXRpZGUub3Jn' ),
		],
	],

	// Resources
	'wgResourceLoaderMaxQueryLength' => [
		'default' => 5000,
	],

	// RelatedArticles
	'wgRelatedArticlesFooterAllowedSkins' => [
		'default' => [
			'citizen',
			'cosmos',
			'minerva',
			'timeless',
			'vector',
			'vector-2022',
		],
	],
	'wgRelatedArticlesCardLimit' => [
		'default' => 3,
	],
	'wgRelatedArticlesDescriptionSource' => [
		'default' => false,
	],

	// RemovePII
	'wgRemovePIIAllowedWikis' => [
		'default' => [
			'metawiki',
			'metawikibeta',
		],
	],
	'wgRemovePIIAutoPrefix' => [
		'default' => 'MirahezeGDPR_',
	],
	'wgRemovePIIDPAValidationEndpoint' => [
		'default' => 'https://reports.miraheze.org/api/dpa/{dpa_id}/{username}',
	],
	'wgRemovePIIHashPrefixOptions' => [
		'default' => [
			'Trust and Safety' => 'MirahezeGDPR_',
			'Stewards' => 'Vanished user ',
		],
	],
	'wgRemovePIIHashPrefix' => [
		'default' => 'MirahezeGDPR_',
	],

	// RequestCustomDomain
	'wgRequestCustomDomainDatabaseSuffix' => [
		'default' => 'wiki',
		'beta' => 'wikibeta',
	],
	'wgRequestCustomDomainDisallowedDomains' => [
		'default' => [
			'miraheze.org',
			'miraheze.wiki',
			'mira.wiki',
			'orain.org',
			'wikitide.org',
			'wikitide.com',
			'wikitide.net',
			'wiki.surf',
		],
	],
	'wgRequestCustomDomainSubdomain' => [
		'default' => 'miraheze.org',
		'beta' => 'mirabeta.org',
	],
	'wgRequestCustomDomainUsersNotifiedOnAllRequests' => [
		'default' => [
			'MacFan4000 (Miraheze)',
			'Original Authority',
			'Universal Omega',
			'RhinosF1 (Miraheze)',
		],
	],

	// Restriction types
	// For i18n purposes, custom types should ideally follow the format of editXXprotected
	'wgRestrictionLevels' => [
		'default' => [
			'',
			'user',
			'autoconfirmed',
			'sysop'
		],
		'+allpediawiki' => [
			'editextendedconfirmedprotected',
		],
		'+321nailswiki' => [
			'templateeditor',
			'extendedconfirmed',
		],
		'+brandonwmwiki' => [
			'editbureaucratprotected',
			'editconsulprotected',
		],
		'+cgwiki' => [
			'',
			'user',
			'autoconfirmed',
			'cg',
			'sysop',
		],
		'+cmgwiki' => [
			'bureaucrat',
			'sysop',
			'pm',
			'member',
		],
		'+codinghutwiki' => [
			'editbureaucratprotected',
			'experiencedcodinghutter',
			'templateeditor'
		],
		'+constantnoblewiki' => [
			'editfounderprotected'
		],
		'+cricketnepalwiki' => [
			'editbureaucratprotected',
			'editstaffprotected',
			'edittemplateprotected',
		],
		'+csydeswiki' => [
			'editblacklisted',
		],
		'+damnationwiki' => [
			'editmoderatorprotected',
		],
		'+devwiki' => [
			'editinterface',
		],
		'+famedatawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+fischwiki' => [
			'editmoderatorprotected',
		],
		'+gengbaikewiki' => [
			'bureaucrat',
		],
		'+googlewiki' => [
			'editbureaucratprotected',
		],
		'+gratispaideiawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+hypotheticalweatherwiki' => [
			'',
			'user',
			'autoconfirmed',
			'templateeditor',
			'extendedconfirmed',
			'author',
			'moderator',
			'sysop',
			'bureaucrat',
		],
		'+igrovyesistemywiki' => [
			'trusted',
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		],
		'+infopediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
			'editwikistaffprotected',
		],
		'+knightnwiki' => [
			'editextendedsemiprotected',
		],
		'+mcsosirswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
			'editfounderprotected',
		],
		'+metawiki' => [
			'editautopatrolprotected',
		],
		'+moviepediawiki' => [
			'bureaucrat',
			'founder',
		],
		'+mypediawiki' => [
			'editextendedconfirmedprotected',
		],
		'+phightingwiki' => [
			'edittrusteduserprotected',
		],
		'+saozhwiki' => [
			'edittech',
			'editarbiter',
			'editpatrol',
		],
		'+sesupportwiki' => [
			'editor',
		],
		'+scratchpadwiki' => [
			'',
			'user',
			'autoconfirmed',
			'templateeditor',
			'extendedconfirmed',
			'moderator',
			'sysop',
			'bureaucrat',
		],
		'+starstruckwiki' => [
			'editinterfaceadminprotected',
		],
		'+stickmancomicwiki' => [
			'editbureaucratprotected',
		],
		'+testwiki' => [
			'editbureaucratprotected',
			'editconsulprotected',
		],
		'+tikipediawiki' => [
			'editextendedconfirmedprotected',
		],
		'+trwdeploymentwiki' => [
			'bureaucrat',
			'consul',
		],
		'+ultimatelevelbuilderwiki' => [
			'editemailconfirmedprotected',
			'editextendedconfirmedprotected',
		],
		'+vnenderbotwiki' => [
			'template',
			'extendedconfirmed',
			'owner',
		],
		'+weltseelewiki' => [
			'editresearcherprotected',
		],
		'+xyywiki' => [
			'editautopatrolprotected',
			'edittechprotected',
		],
		'+ysmwikiwiki' => [
			'editextendedconfirmedprotected',
		],
		'+ext-AuthorProtect' => [
			'author',
		],
	],
	'wgRestrictionTypes' => [
		'default' => [
			'create',
			'edit',
			'move',
			'upload',
		],
	],

	// Rights
	'+wgAvailableRights' => [
		'default' => [],
		'321nailswiki' => [
			'templateeditor',
			'extendedconfirmed',
		],
		'allpediawiki' => [
			'editextendedconfirmedprotected',
		],
		'cgwiki' => [
			'cg'
		],
		'codinghutwiki' => [
			'editbureaucratprotected',
			'experiencedcodinghutter',
			'templateeditor'
		],
		'constantnoblewiki' => [
			'editfounderprotected'
		],
		'cricketnepalwiki' => [
			'editbureaucratprotected',
			'editstaffprotected',
			'edittemplateprotected',
		],
		'csydeswiki' => [
			'editblacklisted',
		],
		'damnationwiki' => [
			'editmoderatorprotected',
		],
		'famedatawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'fischwiki' => [
			'editmoderatorprotected',
		],
		'gratispaideiawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'hypotheticalweatherwiki' => [
			'templateeditor',
			'extendedconfirmed',
			'moderator',
			'bureaucrat',
		],
		'infopediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
			'editwikistaffprotected',
		],
		'googlewiki' => [
			'editbureaucratprotected',
		],
		'knightnwiki' => [
			'editextendedsemiprotected',
		],
		'mcsosirswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
			'editfounderprotected',
		],
		'metawiki' => [
			'editautopatrolprotected',
		],
		'mypediawiki' => [
			'editextendedconfirmedprotected',
		],
		'phightingwiki' => [
			'edittrusteduserprotected',
		],
		'pokemonarowiki' => [
			'edittrusteduserprotected',
		],
		'projectsekaiwiki' => [
			'editguide',
		],
		'saozhwiki' => [
			'edittech',
			'editarbiter',
			'editpatrol',
		],
		'scratchpadwiki' => [
			'templateeditor',
			'extendedconfirmed',
			'moderator',
			'bureaucrat',
		],
		'starstruckwiki' => [
			'editinterfaceadminprotected',
		],
		'stickmancomicwiki' => [
			'editbureaucratprotected',
		],
		'testwiki' => [
			'editbureaucratprotected',
			'editconsulprotected',
		],
		'tikipediawiki' => [
			'editextendedconfirmedprotected',
		],
		'ultimatelevelbuilderwiki' => [
			'editemailconfirmedprotected',
			'editextendedconfirmedprotected',
		],
		'trwdeploymentwiki' => [
			'bureaucrat',
			'consul',
		],
		'weltseelewiki' => [
			'editresearcherprotected',
		],
		'xyywiki' => [
			'editautopatrolprotected',
			'edittechprotected',
		],
		'ysmwikiwiki' => [
			'editextendedconfirmedprotected',
		],
		'+ext-SocialProfile' => [
			'updatepoints',
		],
	],

	// RightFunctions
	'wgRightFunctionsUserGroups' => [
		'default' => [
			'*',
			'user',
			'autoconfirmed',
			'sysop',
			'bureaucrat',
		],
	],

	// RobloxAPI
	'wgRobloxAPICachingExpiries' => [
		'ext-RobloxAPI' => [
			'*' => 1800,
			'assetDetails' => 43200,
			'assetThumbnail' => 7200,
			'groupData' => 3600,
			'userAvatarThumbnail' => 3600,
			'userId' => 86400,
			'userInfo' => 86400,
		],
	],

	// RottenLinks
	'wgRottenLinksCurlTimeout' => [
		'default' => 10,
	],
	'wgRottenLinksExcludeWebsites' => [
		'default' => [
			'localhost',
			'127.0.0.1',
		],
		'+rainversewiki' => [
			'jocelynsamara.deviantart.com',
			'www.deviantart.com',
		],
		'+snapwikiwiki' => [
			'smerge.imp.fu-berlin.de',
			'www.hinkler.com.au',
		],
	],

	// Robot policy
	'wgDefaultRobotPolicy' => [
		'default' => 'index,follow',
	],
	'wgNamespaceRobotPolicies' => [
		'default' => [
			NS_SPECIAL => 'noindex',
		],
	],

	// RSS Settings
	'wgRSSAllowImageTag' => [
		'default' => false,
		'jwmeetingwiki' => true,
	],
	'wgRSSAllowLinkTag' => [
		'default' => false,
	],
	'wgRSSCacheAge' => [
		'default' => 3600,
	],
	'wgRSSItemMaxLength' => [
		'default' => 200,
	],
	'wgRSSDateDefaultFormat' => [
		'default' => 'Y-m-d H:i:s',
	],
	'wgRSSUrlWhitelist' => [
		'ext-RSSfeed' => [
			'*',
		],
	],

	// Score
	'wgScoreImageMagickConvert' => [
		'ext-Score' => '/usr/bin/convert',
	],
	'wgScoreSafeMode' => [
		'ext-Score' => true,
	],

	// ScratchBlocks
	'wgScratchBlocks4BlockVersion' => [
		'default' => 3,
	],

	// Scribunto
	'wgCodeEditorEnableCore' => [
		'default' => true,
	],
	'wgScribuntoDefaultEngine' => [
		'default' => 'luasandbox',
	],
	'wgScribuntoUseCodeEditor' => [
		'default' => true,
	],
	'wgScribuntoSlowFunctionThreshold' => [
		'default' => 0.99,
	],

	// Search
	'wgSearchType' => [
		'ext-CirrusSearch' => 'CirrusSearch',
		'ext-TitleKey' => MediaWiki\Extension\TitleKey\SearchEngineMySQL::class,
	],

	// SearchDigest
	'wgSearchDigestCreateRedirect' => [
		'default' => true,
	],
	'wgSearchDigestDateThreshold' => [
		'default' => 604800,
	],
	'wgSearchDigestMinimumMisses' => [
		'default' => 10,
	],

	// SecurePoll
	'wgSecurePollUseLogging' => [
		'default' => true,
	],
	'wgSecurePollSingleTransferableVoteEnabled' => [
		'default' => true,
	],
	'wgSecurePollUseNamespace' => [
		'default' => true,
	],

	// Server
	'wgArticlePath' => [
		'default' => '/wiki/$1',
	],
	'wgDisableOutputCompression' => [
		'default' => true,
	],
	'wgShowHostnames' => [
		'default' => true,
	],
	'wgThumbPath' => [
		'default' => '/w/thumb_handler.php'
	],
	'wgUsePathInfo' => [
		'default' => true,
	],

	// SimpleBatchUpload
	'wgSimpleBatchUploadMaxFilesPerBatch' => [
		'default' => [
			'*' => 5,
			'autoconfirmed' => 25,
			'bureaucrat' => 500,
			'confirmed' => 50,
			'sysop' => 250,
			'user' => 5,
		],
	],

	// SimpleChanges
	'wgSimpleChangesOnlyContentNamespaces' => [
		'default' => false,
	],
	'wgSimpleChangesOnlyLatest' => [
		'default' => true,
	],
	'wgSimpleChangesShowUser' => [
		'default' => false,
	],

	// Share
	'wgShareEmail' => [
		'default' => false,
	],
	'wgShareFacebook' => [
		'default' => true,
	],
	'wgShareLinkedIn' => [
		'default' => false,
	],
	'wgShareReddit' => [
		'default' => false,
	],
	'wgShareTumblr' => [
		'default' => false,
	],
	'wgShareTwitter' => [
		'default' => true,
	],
	'wgShareUseBasicButtons' => [
		'default' => false,
	],
	'wgShareUsePlainLinks' => [
		'default' => true,
	],

	// ShortDescription
	'wgShortDescriptionEnableTagline' => [
		'default' => true,
	],

	// Site notice opt out
	'wmgSiteNoticeOptOut' => [
		'default' => false,
	],

	// Skins
	'wgSkipSkins' => [
		'default' => [],
	],

	// Snap! skin
	'wgSnapwikiskinWvuiSearchOptions' => [
		'default' => [
			'showThumbnail' => false,
			'showDescription' => false,
		],
		'snapwikiwiki' => [
			'showThumbnail' => true,
			'showDescription' => false,
		],
	],

	// SocialProfile
	'wgUserBoard' => [
		'default' => false,
	],
	'wgUserProfileThresholds' => [
		'default' => [
			'edits' => 0,
		],
		'allthetropeswiki' => [
			'edits' => 10,
		],
	],
	'wgUserProfileDisplay' => [
		'default' => [
			'activity' => false,
			'articles' => true,
			'avatar' => true,
			'awards' => true,
			'board' => false,
			'custom' => true,
			'foes' => false,
			'friends' => false,
			'games' => false,
			'gifts' => true,
			'interests' => true,
			'personal' => true,
			'profile' => true,
			'stats' => false,
			'userboxes' => false,
		],
	],
	'wgUserStatsPointValues' => [
		'default' => [
			'edit' => 50,
			'vote' => 0,
			'comment' => 0,
			'comment_plus' => 0,
			'comment_ignored' => 0,
			'opinions_created' => 0,
			'opinions_pub' => 0,
			'referral_complete' => 0,
			'friend' => 0,
			'foe' => 0,
			'gift_rec' => 0,
			'gift_sent' => 0,
			'points_winner_weekly' => 0,
			'points_winner_monthly' => 0,
			'user_image' => 1000,
			'poll_vote' => 0,
			'quiz_points' => 0,
			'quiz_created' => 0,
		],
		'lhmnwiki' => [
			'edit' => 50,
			'vote' => 0,
			'comment' => 0,
			'comment_plus' => 0,
			'comment_ignored' => 0,
			'opinions_created' => 0,
			'opinions_pub' => 0,
			'referral_complete' => 0,
			'friend' => 0,
			'foe' => 0,
			'gift_rec' => 100,
			'gift_sent' => 0,
			'points_winner_weekly' => 200,
			'points_winner_monthly' => 500,
			'user_image' => 1000,
			'poll_vote' => 10,
			'quiz_points' => 1,
			'quiz_created' => 5,
		],
		'testwikibeta' => [
			'delete' => 500,
			'edit' => 500,
			'unprotect' => 500,
			'rollback' => 500,
			'revert' => 500,
			'vote' => 100,
			'comment' => 200,
			'comment_plus' => 100,
			'comment_ignored' => 100,
			'opinions_created' => 100,
			'opinions_pub' => 100,
			'protect' => 500,
			'referral_complete' => 100,
			'friend' => 100,
			'foe' => 100,
			'gift_rec' => 100,
			'gift_sent' => 100,
			'points_winner_weekly' => 100,
			'points_winner_monthly' => 100,
			'user_image' => 1000,
			'poll_vote' => 100,
			'quiz_points' => 100,
			'quiz_created' => 100,
		],
	],
	'wgFriendingEnabled' => [
		'default' => true,
	],
	'wgUserPageChoice' => [
		'default' => true,
	],

	// Statistics
	'wgArticleCountMethod' => [
		'default' => 'link',
	],

	// StopForumSpam
	// Downloaded from https://www.stopforumspam.com/downloads (recommended listed_ip_90_all.zip)
	// for ipv4 + ipv6 combined.
	// Cron runs automatically at midnight to update list.
	'wgSFSIPListLocation' => [
		'default' => '/srv/mediawiki/stopforumspam/listed_ip_90_ipv46_all.txt',
	],

	// Styling
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
		'default' => '/srv/mediawiki/favicons/default.ico',
	],
	'wgDefaultSkin' => [
		'default' => 'vector-2022',
	],
	'wgFallbackSkin' => [
		'default' => 'vector-2022',
	],
	'wgFavicon' => [
		'default' => '/favicon.ico',
	],
	'wgLogo' => [
		'default' => "https://$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
	],
	'wgIcon' => [
		'default' => false,
	],
	'wgWordmark' => [
		'default' => false,
	],
	'wgWordmarkHeight' => [
		'default' => 18,
	],
	'wgWordmarkWidth' => [
		'default' => 116,
	],
	'wgMaxTocLevel' => [
		'default' => 999,
	],

	// TabberNeue
	'wgTabberNeueAddTabPrefix' => [
		'default' => true,
	],
	'wgTabberNeueEnableAnimation' => [
		'default' => true,
	],
	'wgTabberNeueParseTabName' => [
		'default' => false,
	],
	'wgTabberNeueUpdateLocationOnTabChange' => [
		'default' => true,
	],

	// TemplateStyles
	'wgTemplateStylesAllowedUrls' => [
		'default' => [
			'audio' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/>',
				'<^(?:https:)?//static\\.miraheze\\.org/>',
				'<^(?:https:)?//static\\.wikitide\\.net/>',
				'<^(?:https:)?//[a-zA-Z0-9\\-]\\.(miraheze|wikitide)\\.org/w/img_auth\\.php/>',
				'<^(?:https:)?//' . preg_quote( $wi->server ) . '/w/img_auth\\.php/>',
			],
			'image' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/>',
				'<^(?:https:)?//static\\.miraheze\\.org/>',
				'<^(?:https:)?//static\\.wikitide\\.net/>',
				'<^(?:https:)?//[a-zA-Z0-9\\-]\\.(miraheze|wikitide)\\.org/w/img_auth\\.php/>',
				'<^(?:https:)?//' . preg_quote( $wi->server ) . '/w/img_auth\\.php/>',
			],
			'svg' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/[^?#]*\\.svg(?:[?#]|$)>',
				'<^(?:https:)?//static\\.miraheze\\.org/[^?#]*\\.svg(?:[?#]|$)>',
				'<^(?:https:)?//static\\.wikitide\\.net/[^?#]*\\.svg(?:[?#]|$)>',
				'<^(?:https:)?//[a-zA-Z0-9\\-]\\.(miraheze|wikitide)\\.org/w/img_auth\\.php/[^?#]*\\.svg(?:[?#]|$)>',
				'<^(?:https:)?//' . preg_quote( $wi->server ) . '/w/img_auth\\.php/[^?#]*\\.svg(?:[?#]|$)>',
			],
			'font' => [],
			'namespace' => [
				'<.>',
			],
			'css' => [],
		],
	],

	// TextExtracts
	'wgExtractsRemoveClasses' => [
		'default' => [
			'table',
			'div',
			'figure',
			'script',
			'input',
			'style',
			'ul.gallery',
			'mw\\:editsection',
			'editsection',
			'meta',
			'sup.reference',
			'ol.references',
			'.error',
			'.nomobile',
			'.noprint',
			'.noexcerpt',
			'.sortkey',
			'.mw-empty-elt',
		],
	],

	// TimedMediaHandler
	'wgEnableTranscode' => [
		'default' => true,
	],
	'wgOggThumbLocation' => [
		'default' => false,
	],
	'wgTmhEnableMp4Uploads' => [
		'default' => false,
	],
	'wgTmhFluidsynthLocation' => [
		'default' => '/usr/bin/fluidsynth',
	],
	'wgTmhSoundfontLocation' => [
		'default' => '/usr/share/sounds/sf2/FluidR3_GM.sf2',
	],

	// Timeless
	'wgTimelessBackdropImage' => [
		'default' => 'cat.svg',
	],
	'wgTimelessLogo' => [
		'default' => null,
	],
	'wgTimelessWordmark' => [
		'default' => null,
	],

	// Timeline
	'wgTimelineFontDirectory' => [
		'default' => '/usr/share/fonts/truetype/freefont',
	],

	// Time
	'wgLocaltimezone' => [
		'default' => 'UTC',
	],
	'wgAmericanDates' => [
		'default' => false,
	],

	// Theme
	'wgDefaultTheme' => [
		'default' => '',
	],

	// Title Icon
	'wgTitleIcon_EnableIconInPageTitle' => [
		'default' => true,
	],
	'wgTitleIcon_EnableIconInSearchTitle' => [
		'default' => true,
	],
	'wgTitleIcon_CSSSelector' => [
		'default' => '#firstHeading',
	],
	'wgTitleIcon_UseFileNameAsToolTip' => [
		'default' => true,
	],

	// TitleBlacklist
	'wgTitleBlacklistSources' => [
		'default' => [
			'global' => [
				'type' => 'url',
				'src' => 'https://meta.miraheze.org/wiki/MediaWiki:Global_title_blacklist?action=raw&tb_ver=1',
			],
			'local' => [
				'type' => 'localpage',
				'src' => 'MediaWiki:Titleblacklist',
			],
		],
		'beta' => [
			'global' => [
				'type' => 'url',
				'src' => 'https://meta.mirabeta.org/wiki/MediaWiki:Global_title_blacklist?action=raw&tb_ver=1',
			],
			'local' => [
				'type' => 'localpage',
				'src' => 'MediaWiki:Titleblacklist',
			],
		],
	],
	'wgTitleBlacklistUsernameSources' => [
		'default' => '*',
	],
	'wgTitleBlacklistLogHits' => [
		'default' => false,
	],
	'wgTitleBlacklistBlockAutoAccountCreation' => [
		'default' => false,
	],

	// Translate
	'wgTranslateDisabledTargetLanguages' => [
		'default' => [],
		'astralpartywiki' => [
			'*' => [
				'zh' => 'Translate in zh-hans or zh-hant instead please.',
				'zh-cn' => 'Translate in zh-hans instead please.',
				'zh-my' => 'Translate in zh-hans instead please.',
				'zh-sg' => 'Translate in zh-hans instead please.',
				'zh-tw' => 'Translate in zh-hant instead please.',
				'zh-hk' => 'Translate in zh-hant instead please.',
				'zh-mo' => 'Translate in zh-hant instead please.',
			],
		],
		'metawiki' => [
			'*' => [
				'en' => 'English is the source language.',
				'cdo' => 'This language code should remain unused. Localise in cdo-hant, cdo-hans or cdo-latn please.',
				'cdo-hani' => 'This language code should remain unused. Localise in cdo-hant or cdo-hans please.',
				'cjy' => 'This language code should remain unused. Localise in cjy-hans or cjy-hant please.',
				'cpx' => 'This language code should remain unused. Localise in cpx-hans, cpx-hant or cpx-latn please.',
				'crh' => 'This language code should remain unused. Localise in crh-cyrl or crh-latn please.',
				'gan' => 'This language code should remain unused. Localise in gan-hans or gan-hant please.',
				'hak' => 'This language code should remain unused. Localise in hak-hans, hak-hant or hak-latn please.',
				'iu' => 'This language code should remain unused. Localise in ike-cans or ike-latn please.',
				'ku' => 'This language code should remain unused. Localise in ku-arab or ku-latn please.',
				'mnc' => 'This language code should remain unused. Localise in mnc-latn or mnc-mong please.',
				'nan' => 'This language code should remain unused. Localise in nan-hans, nan-hant, nan-latn-pehoeji or nan-latn-tailo please.',
				'nan-hani' => 'This language code should remain unused. Localise in nan-hans or nan-hant please.',
				'nan-latn' => 'This language code should remain unused. Localise in nan-latn-pehoeji or nan-latn-tailo please.',
				'sh' => 'This language code should remain unused. Localise in sh-cyrl or sh-latn please.',
				'tg' => 'This language code should remain unused. Localise in tg-cyrl or tg-latn please.',
				'wuu' => 'This language code should remain unused. Localise in wuu-hans or wuu-hant please.',
				'yue' => 'This language code should remain unused. Localise in yue-hans or yue-hant please.',
				'zh' => 'This language code should remain unused. Localise in zh-hans, zh-hant or zh-hk please.',
				'zh-cn' => 'This language code should remain unused. Localise in zh-hans please.',
				'zh-tw' => 'This language code should remain unused. Localise in zh-hant please.',
				'zh-mo' => 'This language code should remain unused. Localise in zh-hk please.',
				'zh-my' => 'This language code should remain unused. Localise in zh-hans please.',
				'zh-sg' => 'This language code should remain unused. Localise in zh-hans please.',
			],
		],
		'rainworldwiki' => [
			'*' => [
				'zh' => 'Translate in zh-hans instead please',
				'zh-cn' => 'Translate in zh-hans instead please',
			],
		],
		'spiralwiki' => [
			'*' => [
				'en' => 'English is the source language.',
			],
		],
	],
	'wgTranslateDocumentationLanguageCode' => [
		'default' => false,
	],
	'wgTranslateNumerals' => [
		'default' => true,
	],
	'wgTranslatePageTranslationULS' => [
		'default' => false,
	],
	'wgTranslateTranslationServices' => [
		'default' => [],
	],
	'wgTranslateTranslationDefaultService' => [
		'default' => false,
	],

	// TorBlock
	'wgTorIPs' => [
		'default' => [
			'91.198.174.232',
			'208.80.152.2',
			'208.80.152.134'
		]
	],
	'wgTorTagChanges' => [
		'default' => false
	],
	'wgTorDisableAdminBlocks' => [
		'default' => false
	],

	// UnlinkedWikibase
	'wgUnlinkedWikibaseStatementsParserFunc' => [
		'default' => false,
	],

	// Tweeki
	'wgTweekiSkinUseBootstrap4' => [
		'default' => false,
	],
	'wgTweekiSkinImagePageTOCTabs' => [
		'default' => false,
	],
	'wgTweekiSkinFooterIcons' => [
		'default' => false,
	],
	'wgTweekiSkinGridNone' => [
		'default' => [
			'mainoffset' => 1,
			'mainwidth' => 10,
		],
		'factoriopluswiki' => [
			'mainoffset' => 0,
			'mainwidth' => 12,
		],
	],
	'wgTweekiSkinUseBtnParser' => [
		'default' => false,
	],
	'wgTweekiSkinUseTooltips' => [
		'default' => false,
	],
	'wgTweekiSkinUseIconWatch' => [
		'default' => false,
	],
	'wgTweekiSkinHideAnon' => [
		'default' => [
			'subnav' => true
		],
		'obeymewiki' => [
			'subnav' => false,
		],
	],

	// UploadWizard
	'wmgUploadWizardFlickrApiKey' => [
		'ext-UploadWizard' => 'aeefff139445d825d4460796616f9349',
	],

	// Uploads
	'wmgEnableSharedUploads' => [
		'default' => false,
	],
	'wmgSharedUploadBaseUrl' => [
		'default' => false,
	],
	'wmgSharedUploadDBname' => [
		'default' => false,
	],
	'wmgSharedUploadClientDBname' => [
		'default' => false,
	],

	// UniversalLanguageSelector
	'wgULSAnonCanChangeLanguage' => [
		'default' => false,
	],
	'wgULSLanguageDetection' => [
		'default' => false,
	],
	'wgULSPosition' => [
		'default' => 'personal',
	],
	'wgULSGeoService' => [
		'ext-Translate' => false,
		'ext-UniversalLanguageSelector' => false,
	],
	'wgULSIMEEnabled' => [
		'default' => true,
		'gratispaideiawiki' => false,
	],
	'wgULSWebfontsEnabled' => [
		'default' => true,
	],

	// UrlShortener
	'wgUrlShortenerServer' => [
		'metawiki' => 'wiki.surf',
	],
	'wgUrlShortenerTemplate' => [
		'default' => '/m/$1',
		'metawiki' => '/$1',
	],

	// UserFunctions
	'wgUFEnabledPersonalDataFunctions' => [
		/**
		 * 'ip', 'realname' and/or 'useremail' should never
		 * be enabled here under any circumstances, in order
		 * to ensure privacy.
		 */
		'default' => [
			'nickname',
			'username',
		],
	],
	'wgUFAllowedNamespaces' => [
		'default' => [
			NS_MEDIAWIKI => true,
		],
	],

	// UserPageEditProtection
	'wgOnlyUserEditUserPage' => [
		'ext-UserPageEditProtection' => true,
	],

	// UserProfileV2
	'wgUserProfileV2Color' => [
		'default' => '#E1E1E1',
	],
	'wgUserProfileV2AvatarBorderRadius' => [
		'default' => '50%',
	],
	'wgUserProfileV2UseGlobalAvatars' => [
		'default' => false,
	],

	// Varnish
	'wgUseCdn' => [
		'default' => true,
	],
	'wgCdnServersNoPurge' => [
		'default' => [
			// localhost is a must!
			'127.0.0.1',
			// CloudFlare IPs - https://www.cloudflare.com/ips/
			// Sept. 2023 edition; make sure to keep updated or bad things happen!
			'103.21.244.0/22',
			'103.22.200.0/22',
			'103.31.4.0/22',
			'104.16.0.0/13',
			'104.24.0.0/14',
			'108.162.192.0/18',
			'131.0.72.0/22',
			'141.101.64.0/18',
			'162.158.0.0/15',
			'172.64.0.0/13',
			'173.245.48.0/20',
			'188.114.96.0/20',
			'190.93.240.0/20',
			'197.234.240.0/22',
			'198.41.128.0/17',
			'2400:cb00::/32',
			'2606:4700::/32',
			'2803:f800::/32',
			'2405:b500::/32',
			'2405:8100::/32',
			'2a06:98c0::/29',
			'2c0f:f248::/32',
		],
	],
	'wgCdnMaxAge' => [
		'default' => 432000,
	],

	// Vector
	'wgVectorResponsive' => [
		'default' => false,
	],
	'wgVectorDefaultSidebarVisibleForAnonymousUser' => [
		'default' => true,
	],
	'wgVectorNightMode' => [
		'default' => [
			'logged_out' => false,
			'logged_in' => true,
			'beta' => false,
		],
	],
	'wgVectorWvuiSearchOptions' => [
		'default' => [
			'showThumbnail' => true,
			'showDescription' => true,
		],
		'snapwikiwiki' => [
			'showThumbnail' => true,
			'showDescription' => false,
		],
	],
	'wgVectorMaxWidthOptions' => [
		'default' => [
			'exclude' => [
				'mainpage' => false,
				'querystring' => [
					'action' => '(history|edit)',
					'diff' => '.+',
				],
				'namespaces' => [
					NS_SPECIAL,
					NS_CATEGORY,
				],
			],
			'include' => [
				'Special:Preferences',
			],
		],
		'+gratispaideiawiki' => [
			'include' => [
				'Special:Preferences',
				'Special:UserLogin',
				'Special:CreateAccount',
			],
		],
		'+gpcommonswiki' => [
			'include' => [
				'Special:Preferences',
				'Special:UserLogin',
				'Special:CreateAccount',
			],
		],
		'gratisdatawiki' => [
			'exclude' => [
				'mainpage' => false,
				'querystring' => [
					'action' => '(history|edit)',
					'diff' => '.+',
				],
				'namespaces' => [
					NS_MAIN,
					NS_SPECIAL,
					NS_CATEGORY,
				],
			],
			'include' => [
				'Special:Preferences',
				'Special:UserLogin',
				'Special:CreateAccount',
			],
		],
		'piggywiki' => [
			'exclude' => [],
			'include' => [],
		],
	],
	'wgVectorStickyHeader' => [
		'default' => [
			'logged_in' => true,
			'logged_out' => false,
		],
		'gpcommonswiki' => [
			'logged_in' => false,
			'logged_out' => false,
		],
		'gratisdatawiki' => [
			'logged_in' => false,
			'logged_out' => false,
		],
	],
	'wgVectorLanguageInHeader' => [
		'default' => [
			'logged_in' => true,
			'logged_out' => true,
		],
		'gpcommonswiki' => [
			'logged_in' => false,
			'logged_out' => false,
		],
		'gratisdatawiki' => [
			'logged_in' => false,
			'logged_out' => false,
		],
	],
	'wgVectorLanguageInMainPageHeader' => [
		'default' => [
			'logged_in' => false,
			'logged_out' => false,
		],
		'tkuwiki' => [
			'logged_in' => true,
			'logged_out' => true,
		],
	],

	// VisualEditor
	'wmgVisualEditorEnableDefault' => [
		'default' => false,
		'ext-VisualEditor' => true,
	],
	'wgVisualEditorEnableWikitext' => [
		'default' => false,
	],
	'wgVisualEditorShowBetaWelcome' => [
		'default' => true,
	],
	'wgVisualEditorUseSingleEditTab' => [
		'default' => false,
	],
	'wgVisualEditorEnableDiffPage' => [
		'default' => false,
	],
	'wgVisualEditorEnableVisualSectionEditing' => [
		'default' => 'mobile',
	],
	'wgVisualEditorTransclusionDialogSuggestedValues' => [
		'default' => false,
	],
	'wgVisualEditorTransclusionDialogInlineDescriptions' => [
		'default' => false,
	],
	'wgVisualEditorTransclusionDialogBackButton' => [
		'default' => false,
	],
	'wgVisualEditorTransclusionDialogNewSidebar' => [
		'default' => false,
	],
	'wgVisualEditorTemplateSearchImprovements' => [
		'default' => false,
	],

	// ProtectSite
	'wgProtectSiteLimit' => [
		'default' => '1 week',
	],
	'wgProtectSiteDefaultTimeout' => [
		'default' => '1 hour',
	],

	// WebAuthn
	'wgWebAuthnLimitPasskeysToRoaming' => [
		'default' => true,
	],

	// Wikibase
	'wmgAllowEntityImport' => [
		'default' => false,
	],
	'wmgCanonicalUriProperty' => [
		'default' => false,
	],
	'wmgEnableEntitySearchUI' => [
		'default' => false,
	],
	'wmgFederatedPropertiesEnabled' => [
		'default' => false,
	],
	'wmgFormatterUrlProperty' => [
		'default' => false,
	],
	'wmgWikibaseRepoDatabase' => [
		'default' => $wi->dbname
	],
	'wmgWikibaseRepoUrl' => [
		'default' => 'https://wikidata.org'
	],
	'wmgWikibaseItemNamespaceID' => [
		'default' => 0
	],
	'wmgWikibasePropertyNamespaceID' => [
		'default' => 120
	],
	'wmgWikibaseRepoItemNamespaceID' => [
		'default' => 860
	],
	'wmgWikibaseRepoPropertyNamespaceID' => [
		'default' => 862
	],

	// WikibaseLexeme
	'wgLexemeLanguageCodePropertyId' => [
		'default' => null,
	],
	'wgLexemeEnableDataTransclusion' => [
		'default' => false,
	],

	// WikibaseQualityConstraints
	'wgWBQualityConstraintsInstanceOfId' => [
		'default' => 'P31',
	],
	'wgWBQualityConstraintsSubclassOfId' => [
		'default' => 'P279',
	],
	'wgWBQualityConstraintsStartTimePropertyIds' => [
		'default' => [
			'P569',
			'P571',
			'P580',
			'P585',
		],
		'gratisdatawiki' => [
			'P26',
			'P11',
			'P174',
			'P80',
		],
	],
	'wgWBQualityConstraintsEndTimePropertyIds' => [
		'default' => [
			'P570',
			'P576',
			'P582',
			'P585',
		],
		'gratisdatawiki' => [
			'P132',
			'P539',
			'P175',
			'P80',
		],
	],
	'wgWBQualityConstraintsPropertyConstraintId' => [
		'default' => 'P2302',
	],
	'wgWBQualityConstraintsExceptionToConstraintId' => [
		'default' => 'P2303',
	],
	'wgWBQualityConstraintsConstraintStatusId' => [
		'default' => 'P2316',
	],
	'wgWBQualityConstraintsMandatoryConstraintId' => [
		'default' => 'Q21502408',
	],
	'wgWBQualityConstraintsSuggestionConstraintId' => [
		'default' => 'Q62026391',
	],
	'wgWBQualityConstraintsDistinctValuesConstraintId' => [
		'default' => 'Q21502410',
	],
	'wgWBQualityConstraintsMultiValueConstraintId' => [
		'default' => 'Q21510857',
	],
	'wgWBQualityConstraintsUsedAsQualifierConstraintId' => [
		'default' => 'Q21510863',
	],
	'wgWBQualityConstraintsSingleValueConstraintId' => [
		'default' => 'Q19474404',
	],
	'wgWBQualityConstraintsSymmetricConstraintId' => [
		'default' => 'Q21510862',
	],
	'wgWBQualityConstraintsTypeConstraintId' => [
		'default' => 'Q21503250',
	],
	'wgWBQualityConstraintsValueTypeConstraintId' => [
		'default' => 'Q21510865',
	],
	'wgWBQualityConstraintsInverseConstraintId' => [
		'default' => 'Q21510855',
	],
	'wgWBQualityConstraintsItemRequiresClaimConstraintId' => [
		'default' => 'Q21503247',
	],
	'wgWBQualityConstraintsValueRequiresClaimConstraintId' => [
		'default' => 'Q21510864',
	],
	'wgWBQualityConstraintsConflictsWithConstraintId' => [
		'default' => 'Q21502838',
	],
	'wgWBQualityConstraintsOneOfConstraintId' => [
		'default' => 'Q21510859',
	],
	'wgWBQualityConstraintsMandatoryQualifierConstraintId' => [
		'default' => 'Q21510856',
	],
	'wgWBQualityConstraintsAllowedQualifiersConstraintId' => [
		'default' => 'Q21510851',
	],
	'wgWBQualityConstraintsRangeConstraintId' => [
		'default' => 'Q21510860',
	],
	'wgWBQualityConstraintsDifferenceWithinRangeConstraintId' => [
		'default' => 'Q21510854',
	],
	'wgWBQualityConstraintsCommonsLinkConstraintId' => [
		'default' => 'Q21510852',
	],
	'wgWBQualityConstraintsContemporaryConstraintId' => [
		'default' => 'Q25796498',
	],
	'wgWBQualityConstraintsFormatConstraintId' => [
		'default' => 'Q21502404',
	],
	'wgWBQualityConstraintsUsedForValuesOnlyConstraintId' => [
		'default' => 'Q21528958',
	],
	'wgWBQualityConstraintsUsedAsReferenceConstraintId' => [
		'default' => 'Q21528959',
	],
	'wgWBQualityConstraintsNoBoundsConstraintId' => [
		'default' => 'Q51723761',
	],
	'wgWBQualityConstraintsAllowedUnitsConstraintId' => [
		'default' => 'Q21514353',
	],
	'wgWBQualityConstraintsSingleBestValueConstraintId' => [
		'default' => 'Q52060874',
	],
	'wgWBQualityConstraintsAllowedEntityTypesConstraintId' => [
		'default' => 'Q52004125',
	],
	'wgWBQualityConstraintsCitationNeededConstraintId' => [
		'default' => 'Q54554025',
	],
	'wgWBQualityConstraintsPropertyScopeConstraintId' => [
		'default' => 'Q53869507',
	],
	'wgWBQualityConstraintsLexemeLanguageConstraintId' => [
		'default' => 'Q55819106',
	],
	'wgWBQualityConstraintsLabelInLanguageConstraintId' => [
		'default' => 'Q108139345',
	],
	'wgWBQualityConstraintsLanguagePropertyId' => [
		'default' => 'P424',
	],
	'wgWBQualityConstraintsClassId' => [
		'default' => 'P2308',
	],
	'wgWBQualityConstraintsRelationId' => [
		'default' => 'P2309',
	],
	'wgWBQualityConstraintsInstanceOfRelationId' => [
		'default' => 'Q21503252',
	],
	'wgWBQualityConstraintsSubclassOfRelationId' => [
		'default' => 'Q21514624',
	],
	'wgWBQualityConstraintsInstanceOrSubclassOfRelationId' => [
		'default' => 'Q30208840',
	],
	'wgWBQualityConstraintsPropertyId' => [
		'default' => 'P2306',
	],
	'wgWBQualityConstraintsQualifierOfPropertyConstraintId' => [
		'default' => 'P2305',
	],
	'wgWBQualityConstraintsMinimumQuantityId' => [
		'default' => 'P2313',
	],
	'wgWBQualityConstraintsMaximumQuantityId' => [
		'default' => 'P2312',
	],
	'wgWBQualityConstraintsMinimumDateId' => [
		'default' => 'P2310',
	],
	'wgWBQualityConstraintsMaximumDateId' => [
		'default' => 'P2311',
	],
	'wgWBQualityConstraintsNamespaceId' => [
		'default' => 'P2307',
	],
	'wgWBQualityConstraintsFormatAsARegularExpressionId' => [
		'default' => 'P1793',
	],
	'wgWBQualityConstraintsSyntaxClarificationId' => [
		'default' => 'P2916',
	],
	'wgWBQualityConstraintsConstraintScopeId' => [
		'default' => 'P4680',
	],
	'wgWBQualityConstraintsConstraintEntityTypesId' => [
		'default' => 'P4680',
	],
	'wgWBQualityConstraintsSeparatorId' => [
		'default' => 'P4155',
	],
	'wgWBQualityConstraintsConstraintCheckedOnMainValueId' => [
		'default' => 'Q46466787',
	],
	'wgWBQualityConstraintsConstraintCheckedOnQualifiersId' => [
		'default' => 'Q46466783',
	],
	'wgWBQualityConstraintsConstraintCheckedOnReferencesId' => [
		'default' => 'Q46466805',
	],
	'wgWBQualityConstraintsNoneOfConstraintId' => [
		'default' => 'Q52558054',
	],
	'wgWBQualityConstraintsIntegerConstraintId' => [
		'default' => 'Q52848401',
	],
	'wgWBQualityConstraintsWikibaseItemId' => [
		'default' => 'Q29934200',
	],
	'wgWBQualityConstraintsWikibasePropertyId' => [
		'default' => 'Q29934218',
	],
	'wgWBQualityConstraintsWikibaseLexemeId' => [
		'default' => 'Q51885771',
	],
	'wgWBQualityConstraintsWikibaseFormId' => [
		'default' => 'Q54285143',
	],
	'wgWBQualityConstraintsWikibaseSenseId' => [
		'default' => 'Q54285715',
	],
	'wgWBQualityConstraintsWikibaseMediaInfoId' => [
		'default' => 'Q59712033',
	],
	'wgWBQualityConstraintsPropertyScopeId' => [
		'default' => 'P5314',
	],
	'wgWBQualityConstraintsAsMainValueId' => [
		'default' => 'Q54828448',
	],
	'wgWBQualityConstraintsAsQualifiersId' => [
		'default' => 'Q54828449',
	],
	'wgWBQualityConstraintsAsReferencesId' => [
		'default' => 'Q54828450',
	],
	'wgWBQualityConstraintsEnableSuggestionConstraintStatus' => [
		'default' => false,
	],

	// WebChat config
	'wgWebChatServer' => [
		'default' => false,
	],
	'wgWebChatChannel' => [
		'default' => false,
	],
	'wgWebChatClient' => [
		'default' => 'LiberaChat',
	],

	// WikiEditor
	'wgWikiEditorRealtimePreview' => [
		'default' => false,
	],

	// WikiForum
	'wgWikiForumAllowAnonymous' => [
		'default' => true,
	],
	'wgWikiForumLogsInRC' => [
		'default' => true,
	],

	// WikidataPageBanner
	'wgWPBImage' => [
		'default' => null,
	],
	'wgWPBBannerProperty' => [
		'default' => 'P948',
	],
	'wgWPBEnableDefaultBanner' => [
		'default' => true,
	],
	'wgWPBNamespaces' => [
		'default' => [
			NS_MAIN
		],
	],
	'wgWPBDisabledNamespaces' => [
		'default' => [
			NS_FILE
		],
	],
	'wgWPBStandardSizes' => [
		'default' => [
			320,
			640,
			1280,
			2560
		],
	],
	'wgWPBEnablePageImagesBanners' => [
		'default' => true,
	],
	'wgWPBDisplaySubtitleAfterBannerSkins' => [
		'default' => [
			'minerva'
		],
	],
	'wgWPBEnableHeadingOverride' => [
		'default' => true,
	],
	'wgWPBEnableMainPage' => [
		'default' => false,
	],

	// WikiDiscover
	'wgWikiDiscoverUseDescriptions' => [
		'default' => true,
	],

	// WikimediaIncubator
	'wgWmincProjects' => [
		'default' => [
			'p' => [
				'name' => 'Wikipedia',
				'dbsuffix' => 'wiki',
				'wikitag' => 'wikipedia',
				'sister' => false,
			],
			'b' => [
				'name' => 'Wikibooks',
				'dbsuffix' => 'wikibooks',
				'wikitag' => 'wikibooks',
				'sister' => false,
			],
			't' => [
				'name' => 'Wiktionary',
				'dbsuffix' => 'wiktionary',
				'wikitag' => 'wiktionary',
				'sister' => false,
			],
			'q' => [
				'name' => 'Wikiquote',
				'dbsuffix' => 'wikiquote',
				'wikitag' => 'wikiquote',
				'sister' => false,
			],
			'n' => [
				'name' => 'Wikinews',
				'dbsuffix' => 'wikinews',
				'wikitag' => 'wikinews',
				'sister' => false,
			],
			'y' => [
				'name' => 'Wikivoyage',
				'dbsuffix' => 'wikivoyage',
				'wikitag' => 'wikivoyage',
				'sister' => false,
			],
			's' => [
				'name' => 'Wikisource',
				'dbsuffix' => 'wikisource',
				'wikitag' => 'wikisource',
				'sister' => false,
			],
			'v' => [
				'name' => 'Wikiversity',
				'dbsuffix' => 'wikiversity',
				'wikitag' => 'wikiversity',
				'sister' => false,
			],
		],
	],
	'wgWmincProjectSite' => [
		'default' => [
			'name' => 'Incubator Plus 2.0',
			'short' => 'incplus',
		],
	],
	'wgWmincExistingWikis' => [
		// empty array, see T14782
		'default' => [],
	],
	'wgWmincClosedWikis' => [
		'default' => false,
	],
	'wgWmincMultilingualProjects' => [
		'default' => [],
	],
	'wgWmincTestWikiNamespaces' => [
		'default' => [
			NS_MAIN,
			NS_TALK,
			NS_TEMPLATE,
			NS_TEMPLATE_TALK,
			NS_CATEGORY,
			NS_CATEGORY_TALK,
			/** NS_MODULE */
			828,
			/** NS_MODULE_TALK */
			829,
		],
	],

	// WikiLove
	'wgWikiLoveGlobal' => [
		'ext-WikiLove' => true,
	],

	// WikiSEO configs
	'wgTwitterCardType' => [
		'default' => 'summary_large_image',
	],
	'wgGoogleSiteVerificationKey' => [
		'default' => false,
	],
	'wgBingSiteVerificationKey' => [
		'default' => false,
	],
	'wgFacebookAppId' => [
		'default' => false,
	],
	'wgYandexSiteVerificationKey' => [
		'default' => false,
	],
	'wgPinterestSiteVerificationKey' => [
		'default' => false,
	],
	'wgNortonSiteVerificationKey' => [
		'default' => false,
	],
	'wgNaverSiteVerificationKey' => [
		'default' => false,
	],
	'wgWikiSeoDefaultImage' => [
		'default' => null,
	],
	'wgWikiSeoDisableLogoFallbackImage' => [
		'default' => false,
	],
	'wgWikiSeoEnableAutoDescription' => [
		'default' => true,
	],
	'wgWikiSeoTryCleanAutoDescription' => [
		'default' => false,
	],
	'wgMetadataGenerators' => [
		'default' => [
			'OpenGraph',
			'Twitter',
			'SchemaOrg',
		],
	],
	'wgTwitterSiteHandle' => [
		'default' => '',
		'gratisdatawiki' => '@gratisdatawiki',
	],
	'wgWikiSeoDefaultLanguage' => [
		'default' => '',
		'gratisdatawiki' => 'en-en',
		'gratispaideiawiki' => 'en-en',
	],

	// CreateWiki Defined Special Variables
	'cwClosed' => [
		'default' => false,
	],
	'cwDeleted' => [
		'default' => false,
	],
	'cwExperimental' => [
		'default' => false,
	],
	'cwInactive' => [
		'default' => false,
	],
	'cwPrivate' => [
		'default' => false,
	],

	// Uncategorised
	'wgForceHTTPS' => [
		'default' => true,
	],

	// Schema migration
	'wgFileSchemaMigrationStage' => [
		'default' => SCHEMA_COMPAT_WRITE_BOTH | SCHEMA_COMPAT_READ_OLD,
	],

	// Logging configuation (Graylog)
	'wmgLogToDisk' => [
		'default' => false,
	],
	'wmgMonologChannels' => [
		'default' => [
			// Enable logging errors from all channels not configured otherwise
			'@default' => 'error',
			'404' => 'debug',
			'AbuseFilter' => false,
			'ActionFactory' => false,
			'antispoof' => false,
			'api' => 'warning',
			'api-feature-usage' => false,
			'api-readonly' => false,
			'api-request' => [ 'graylog' => 'debug', 'buffer' => true ],
			'api-warning' => false,
			'authentication' => 'info',
			'authevents' => [ 'graylog' => 'info', 'sample' => 1000 ],
			'autoloader' => false,
			'BlockManager' => false,
			'BlogPage' => false,
			'BounceHandler' => false,
			// Invalid message parameter
			'Bug58676' => 'debug',
			'cache-cookies' => 'debug',
			'caches' => false,
			'captcha' => 'debug',
			'cargo' => false,
			'CentralAuth' => 'info',
			'CentralAuthRename' => false,
			'CentralAuthVerbose' => false,
			'CentralNotice' => false,
			'CirrusSearch' => 'debug',
			'CirrusSearchDeprecation' => 'debug',
			'cirrussearch-request' => [ 'graylog' => false, 'buffer' => true ],
			'CirrusSearchChangeFailed' => 'debug',
			'CirrusSearchSlowRequests' => 'debug',
			'cite' => false,
			'ContentHandler' => false,
			'CookieWarning' => false,
			'cookie' => false,
			'CreateWiki' => 'debug',
			'rdbms' => 'warning',
			'DeferredUpdates' => 'error',
			'DBConnection' => 'warning',
			'DBPerformance' => 'debug',
			'DBQuery' => false,
			'DBReplication' => false,
			'DBTransaction' => false,
			'deprecated' => [ 'graylog' => 'debug', 'sample' => 100 ],
			'diff' => 'debug',
			'DiscordNotifications' => 'warning',
			'DuplicateParse' => false,
			'dynamic-sidebar' => false,
			'DynamicPageList4' => 'debug',
			'editpage' => false,
			'Echo' => 'debug',
			'EditConflict' => 'error',
			'EditConstraintRunner' => 'error',
			'error' => 'debug',
			'error-json' => false,
			'EventBus' => [ 'graylog' => 'error' ],
			// Please make sure wgEventLoggingBaseUri is set before re-enabling this group
			'EventLogging' => false,
			'EventStreamConfig' => 'warning',
			'exception' => 'debug',
			'exception-json' => false,
			'exec' => 'debug',
			'export' => false,
			'ExternalStore' => false,
			'fatal' => 'debug',
			'FileImporter' => false,
			'FileOperation' => false,
			'formatnum' => false,
			'FSFileBackend' => false,
			'gitinfo' => false,
			'GlobalNewFiles' => 'debug',
			'GlobalTitleFail' => false,
			'GlobalWatchlist' => false,
			'headers-sent' => false,
			'http' => 'warning',
			// Only log http errors with a 500+ code
			'HttpError' => 'error',
			'JobExecutor' => [ 'graylog' => 'warning' ],
			'localisation' => false,
			'ldap' => 'warning',
			'LinkBatch' => false,
			// Generates logs for all pages with links to special pages or interwiki links
			'LinkCache' => false,
			'Linter' => 'debug',
			'LocalFile' => 'warning',
			'localhost' => false,
			'LockManager' => 'warning',
			'logging' => false,
			'LoginNotify' => 'info',
			'ManageWiki' => 'debug',
			'MassMessage' => false,
			'Math' => 'info',
			'MatomoAnalytics' => 'debug',
			'mediamoderation' => 'debug',
			'Mime' => false,
			// debug sprews too much information + sample
			// otherwise we get 2 million+ messages within a few minutes
			'memcached' => [ 'graylog' => 'error' ],
			'message-format' => false,
			'MessageCache' => false,
			'MessageCacheError' => 'debug',
			'MirahezeMagic' => 'debug',
			'mobile' => false,
			'NewUserMessage' => false,
			'OAuth' => 'info',
			'objectcache' => 'warning',
			'OldRevisionImporter' => false,
			'OutputBuffer' => false,
			'PageTriage' => false,
			'ParserCache' => false,
			'ParsoidCachePrewarmJob' => 'error',
			'Parsoid' => 'warning',
			'poolcounter' => 'debug',
			'preferences' => false,
			'purge' => false,
			'query' => false,
			'quickinstantcommons' => 'error',
			'ratelimit' => false,
			'readinglists' => false,
			'recursion-guard' => false,
			'RecursiveLinkPurge' => false,
			'redis' => 'info',
			'Renameuser' => 'debug',
			'resourceloader' => false,
			'ResourceLoaderImage' => 'debug',
			'RevisionStore' => false,
			'RobloxAPI' => 'warning',
			'runJobs' => 'warning',
			'SaveParse' => false,
			'security' => 'debug',
			'session' => 'info',
			'session-ip' => 'info',
			'session-sampled' => [ 'graylog' => 'info', 'sample' => 1000 ],
			'SimpleAntiSpam' => false,
			'slow-parse' => 'debug',
			'slow-parsoid' => 'info',
			'SocialProfile' => false,
			'SpamBlacklist' => false,
			'SpamBlacklistHit' => false,
			'SpamRegex' => false,
			'StopForumSpam' => false,
			'SQLBagOStuff' => false,
			'SwiftBackend' => 'info',
			'squid' => false,
			'StashEdit' => false,
			'T263581' => false,
			'texvc' => false,
			'throttler' => false,
			'thumbnail' => 'debug',
			'thumbnailaccess' => false,
			'TitleBlacklist' => false,
			'TitleBlacklist-cache' => false,
			'torblock' => 'debug',
			'TranslationNotifications.Jobs' => false,
			'Translate.Jobs' => false,
			'Translate' => false,
			'UpdateRepo' => false,
			'updateTranstagOnNullRevisions' => false,
			'upload' => false,
			'UserOptionsManager' => false,
			'VisualEditor' => 'debug',
			'warning' => false,
			'wfDebug' => false,
			'wfLogDBError' => 'debug',
			'Wikibase' => false,
			'Wikibase.NewItemIdFormatter' => false,
			'WikibaseQualityConstraints' => false,
			'xff' => false,
			'XMP' => false,
		],
	],
	// Control MediaWiki Deprecation Warnings
	'wgDeprecationReleaseLimit' => [
		'default' => '1.34',
		'beta' => false,
	],

	// Meta namespace
	'wgMetaNamespace' => [
		'default' => str_replace( [ ' ', ':' ], '_', $wi->sitename ),
	],
	'wgMetaNamespaceTalk' => [
		'default' => str_replace( [ ' ', ':' ], '_', "{$wi->sitename}_talk" ),
	],
];

// Needed for ManageWiki to access certain variables remotely
$wgManageWikiSiteConfiguration = $wgConf;

// Start settings requiring external dependency checks/functions

if ( wfHostname() === 'test151' ) {
	// Prevent cache (better be safe than sorry)
	$wgConf->settings['wgUseCdn']['default'] = false;
}

// ManageWiki settings
require_once __DIR__ . '/ManageWikiExtensions.php';
$wi::$disabledExtensions = [
	'drafts' => '[[phorge:T11970|T11970]]',
	'pageproperties' => '[[phorge:T11641|T11641]]',
	'score' => '[[phorge:T5863|T5863]]',
	'simpleblogpage' => '[[phorge:T13252|T13252]]',
	'wikiforum' => '[[phorge:T13064|T13064]]',

	'lingo' => 'Currently broken',
	'linktitles' => 'Performance and compatibility issues ([[phorge:T14992|T14992]])',

	'video' => 'Incompatible with MediaWiki 1.45',

	// Are these still incompatible?
	'chameleon' => 'Incompatible with MediaWiki 1.45',
	'snapwikiskin' => 'Incompatible with MediaWiki 1.45'
];

$globals = MirahezeFunctions::getConfigGlobals();

// phpcs:ignore MediaWiki.Usage.ForbiddenFunctions.extract
extract( $globals );

$wgDiscordNotificationWikiUrl = $wi->server . str_replace( '$1', '', $wgArticlePath );

if ( $wmgSharedDomainPathPrefix ) {
	$wgArticlePath = $wmgSharedDomainPathPrefix . $wgArticlePath;
	$wgServer = '//' . $wi->getSharedDomain();
}

$wi->loadExtensions();

require_once __DIR__ . '/ManageWikiNamespaces.php';
require_once __DIR__ . '/ManageWikiSettings.php';

$wgUploadPath = "//$wmgUploadHostname/$wgDBname";
$wgUploadDirectory = false;

// These are not loaded by mergeMessageFileList.php due to not being on ExtensionRegistry
$wgMessagesDirs['SocialProfile'] = $IP . '/extensions/SocialProfile/i18n';
$wgExtensionMessagesFiles['SocialProfileAlias'] = $IP . '/extensions/SocialProfile/SocialProfile.alias.php';
$wgMessagesDirs['SocialProfileUserProfile'] = $IP . '/extensions/SocialProfile/UserProfile/i18n';
$wgExtensionMessagesFiles['SocialProfileNamespaces'] = $IP . '/extensions/SocialProfile/SocialProfile.namespaces.php';
$wgExtensionMessagesFiles['AvatarMagic'] = $IP . '/extensions/SocialProfile/UserProfile/includes/avatar/Avatar.i18n.magic.php';

$wgLocalisationCacheConf['storeClass'] = LCStoreStaticArray::class;
$wgLocalisationCacheConf['storeDirectory'] = '/srv/mediawiki/cache/' . $wi->version . '/l10n';
$wgLocalisationCacheConf['manualRecache'] = true;

if ( !file_exists( '/srv/mediawiki/cache/' . $wi->version . '/l10n/en.l10n.php' ) ) {
	$wgLocalisationCacheConf['manualRecache'] = false;
}

if ( extension_loaded( 'wikidiff2' ) ) {
	$wgDiff = false;
}

// To get varnish cache purging working, we convert to http://, as varnish
// does not support purging https requests.
$wgInternalServer = str_replace( 'https://', 'http://', $wgCanonicalServer );

if ( $wgRequestTimeLimit ) {
	$wgHTTPMaxTimeout = $wgHTTPMaxConnectTimeout = $wgRequestTimeLimit;
}

// Include other configuration files
require_once '/srv/mediawiki/config/Database.php';
if ( !$wi->isBeta() ) {
	require_once '/srv/mediawiki/config/EventBus.php';
}
require_once '/srv/mediawiki/config/EventStreamConfig.php';
require_once '/srv/mediawiki/config/GlobalCache.php';
require_once '/srv/mediawiki/config/GlobalLogging.php';
require_once '/srv/mediawiki/config/Sitenotice.php';
require_once '/srv/mediawiki/config/FileBackend.php';

if ( $wgUseQuickInstantCommons ) {
	$wgForeignFileRepos[] = [
		'class' => Miraheze\MirahezeMagic\ForeignAPIRepoWithFixedUA::class,
		'name' => 'wikimediacommons',
		'backend' => 'miraheze-swift-shared',
		'apibase' => 'https://commons.wikimedia.org/w/api.php',
		'url' => 'https://upload.wikimedia.org/wikipedia/commons',
		'thumbUrl' => 'https://upload.wikimedia.org/wikipedia/commons/thumb',
		'directory' => $wgUploadDirectory,
		'hashLevels' => 2,
		'transformVia404' => true,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 604800,
		'apiThumbCacheExpiry' => 0,
		'initialCapital' => true,
		'zones' => [
			// actual swift containers have 'local-*'
			'public' => [ 'container' => 'local-public' ],
			'thumb' => [ 'container' => 'local-thumb' ],
			'temp' => [ 'container' => 'local-temp' ],
			'deleted' => [ 'container' => 'local-deleted' ],
		],
	];
}

if ( $wi->missing ) {
	require_once '/srv/mediawiki/ErrorPages/MissingWiki.php';
}

if ( $cwDeleted ) {
	if ( MW_ENTRY_POINT === 'cli' ) {
		wfHandleDeletedWiki();
	} else {
		$wgHooks['ApiBeforeMain'][] = 'wfHandleDeletedWiki';
		$wgHooks['BeforeInitialize'][] = 'wfHandleDeletedWiki';
	}
}

function wfHandleDeletedWiki() {
	require_once '/srv/mediawiki/ErrorPages/DeletedWiki.php';
}

// Define last to avoid all dependencies
require_once '/srv/mediawiki/config/GlobalSettings.php';
require_once '/srv/mediawiki/config/LocalWiki.php';

// Configure late to ensure $wgDBname is set properly
$wgCargoDBname = $wgDBname . 'cargo';

// Define last - Extension message files for loading extensions
if (
	file_exists( __DIR__ . '/ExtensionMessageFiles-' . $wi->version . '.php' ) &&
	!defined( 'MW_NO_EXTENSION_MESSAGES' )
) {
	require_once __DIR__ . '/ExtensionMessageFiles-' . $wi->version . '.php';
}

// Don't need a global here
unset( $wi );
