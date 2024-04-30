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

// 1400MiB
ini_set( 'memory_limit', 1400 * 1024 * 1024 );

// Configure PHP request timeouts.
if ( PHP_SAPI === 'cli' ) {
	$wgRequestTimeLimit = 0;
} elseif (
	( $_SERVER['HTTP_HOST'] ?? '' ) === 'jobrunner.wikitide.net' ||
	( $_SERVER['HTTP_HOST'] ?? '' ) === 'mwtask171.wikitide.net' ||
	( $_SERVER['HTTP_HOST'] ?? '' ) === 'mwtask181.wikitide.net'
) {
	$wgRequestTimeLimit = 86400;
} elseif ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	$wgRequestTimeLimit = 200;
} else {
	$wgRequestTimeLimit = 60;
}

/**
 * When using ?forceprofile=1, a profile can be found as an HTML comment
 * Disabled on production hosts because it seems to be causing performance issues (how ironic)
 */
$forceprofile = $_GET['forceprofile'] ?? 0;
if ( $forceprofile == 1 && extension_loaded( 'xhprof' ) ) {
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
$wgDatabaseClustersMaintenance = [];

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
$wi = new MirahezeFunctions();

// Load PrivateSettings (e.g. $wgDBpassword)
require_once '/srv/mediawiki/config/PrivateSettings.php';

// Load global skins and extensions
require_once '/srv/mediawiki/config/GlobalSkins.php';
require_once '/srv/mediawiki/config/GlobalExtensions.php';

$wgPasswordSender = 'noreply@miraheze.org';
$wmgUploadHostname = 'static.miraheze.org';

$wgStatsFormat = 'dogstatsd';
$wgStatsTarget = 'udp://localhost:9125';
// graphite151
$wgStatsdServer = '10.0.15.145';

$wgConf->settings += [
	// invalidates user sessions - do not change unless it is an emergency.
	'wgAuthenticationTokenVersion' => [
		'default' => '8',
	],

	'wgPrivilegedGroups' => [
		'default' => [ 'bureaucrat', 'checkuser', 'interface-admin', 'suppress', 'sysop' ],
		'+metawiki' => [ 'steward', 'sre' ],
	],

	// 'pagelinks' table migration
	'wgPageLinksSchemaMigrationStage' => [
		'default' => SCHEMA_COMPAT_WRITE_BOTH | SCHEMA_COMPAT_READ_OLD,
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
			'degroup' => true,
			'disallow' => true,
			'rangeblock' => false,
			'tag' => true,
			'throttle' => true,
			'warn' => true,
		],
	],
	'wgAbuseFilterCentralDB' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
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
		'mirabeta' => [
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
	'wgTitleBlacklistLogHits' => [
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

	// Bot passwords
	'wgBotPasswordsDatabase' => [
		'default' => 'mhglobal',
		'mirabeta' => 'metawikibeta',
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
		'+ext-WikiForum' => [
			'wikiforum' => true,
		],
		'+ext-ContactPage' => [
			'contactpage' => true,
		],
	],
	'wgHCaptchaSiteKey' => [
		'default' => 'e6d26503-a3fb-47fb-9639-efe259a34a33',
	],

	// Cargo
	'wgCargoDBuser' => [
		'default' => 'cargouser',
	],
	'wgCargoFileDataColumns' => [
		'default' => [],
		'egoishwiki' => [
			'mediaType',
			'path',
			'lastUploadDate',
			'fullText',
			'numPages',
		],
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
		'egoishwiki' => [
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
		'academiadesusarduwiki' => 'uca-fr',
		'holidayswiki' => 'numeric',
		'levyraatiwikiwiki' => 'numeric',
		'supermanwiki' => 'numeric',
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
		'mirabeta' => [
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
	'wgCentralAuthCookies' => [
		'default' => true,
	],
	'wgCentralAuthCookiePrefix' => [
		'default' => 'centralauth_',
		'mirabeta' => 'betacentralauth_',
	],
	'wgCentralAuthDatabase' => [
		'default' => 'mhglobal',
		'mirabeta' => 'testglobal',
	],
	'wgCentralAuthEnableGlobalRenameRequest' => [
		'default' => true,
	],
	'wgCentralAuthGlobalBlockInterwikiPrefix' => [
		'default' => 'meta',
	],
	'wgCentralAuthLoginWiki' => [
		'default' => 'loginwiki',
		'mirabeta' => 'loginwikibeta',
	],
	'wgCentralAuthOldNameAntiSpoofWiki' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
	],
	'wgCentralAuthPreventUnattached' => [
		'default' => true,
	],
	'wgGlobalRenameDenylist' => [
		'default' => 'https://meta.miraheze.org/wiki/MediaWiki:Global_rename_blacklist?action=raw',
		'mirabeta' => 'https://meta.mirabeta.org/wiki/MediaWiki:Global_rename_blacklist?action=raw',
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
		'mirabeta' => 'https://meta.mirabeta.org/wiki/Special:BannerLoader',
	],
	'wgCentralBannerRecorder' => [
		'default' => 'https://meta.miraheze.org/wiki/Special:RecordImpression',
		'mirabeta' => 'https://meta.mirabeta.org/wiki/Special:RecordImpression',
	],
	'wgCentralDBname' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
	],
	'wgCentralHost' => [
		'default' => 'https://meta.miraheze.org',
		'mirabeta' => 'https://meta.mirabeta.org',
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
		'mirabeta' => 'metawikibeta',
	],
	'wgCheckUserGBtoollink' => [
		'default' => [
			'centralDB' => 'metawiki',
			'groups' => [
				'steward',
			],
		],
		'mirabeta' => [
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
			],
		],
		'mirabeta' => [
			'centralDB' => 'metawikibeta',
			'groups' => [
				'steward',
			],
		],
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
	'wgCitizenEnableCJKFonts' => [
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
	'wgCommentStreamsEnableTalk' => [
		'default' => false,
	],
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

	// CommonsMetadata
	'wgCommonsMetadataForceRecalculate' => [
		'default' => false,
	],

	// ContactPage
	'wmgContactPageRecipientUser' => [
		'default' => null,
	],

	// Used to add a link to Special:Contact on the footer, not from extension
	'wmgMirahezeContactPageFooter' => [
		'default' => false,
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
	'wgUseSameSiteLegacyCookies' => [
		'default' => true,
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

	// CreatePageUw
	'wgCreatePageUwUseVE' => [
		'default' => false,
	],

	// CreateWiki
	'wgCreateWikiDisallowedSubdomains' => [
		'default' => [
			'(.*)miraheze(.*)',
			'mirabeta(.*)',
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
			'm',
			'sandbox',
			'outreach',
			'gazett?eer',
			'semantic(mediawiki)?',
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
			'ldap(\d+)?',
			'cloud\d+',
			'mon\d+',
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
				'Content Policy (illegal US activity)' => 'Declining per Content Policy provision, "Miraheze does not host any content that is illegal in the United States." Thank you for understanding. If you believe this decline reason was used incorrectly, please address this with the declining wiki creator on their user talk page first before escalating your concern to Steward requests. Thank you.',
				'Content Policy (makes it difficult for other wikis)' => 'Declining per Content Policy provision, "A wiki must not create problems which make it difficult for other wikis." Thank you for your understanding.',
				'Content Policy (no anarchy wikis)' => 'Declining per Content Policy provision, "Miraheze does not host wikis that operate on the basis of an anarchy system (i.e. no leadership and no rules)." Thank you for your understanding.',
				'Content Policy (sexual nature involving minors)' => 'Declining per Content Policy provision, "Miraheze does not host wikis of a sexual nature which involve minors in any way." Thank you for your understanding.',
				'Content Policy (toxic communities)' => 'Declining per Content Policy provision, "Miraheze does not host wikis where the community has developed in such a way as to be characterised as toxic." Thank you for your understanding.',
				'Content Policy (unsubstantiated insult)' => 'Declining per Content Policy provision, "Miraheze does not host wikis which spread unsubstantiated insult, hate or rumours against a person or group of people." Thank you for your understanding.',
				'Content Policy (violence, hatred or harrassment)' => 'Declining per Content Policy provision, "Miraheze does not host wikis that promote violence, hatred, or harassment against a person or group of people." Thank you for your understanding.',
				'Content Policy (Wikimedia-like wikis/forks)' => 'Declining per Content Policy provision, "Direct forks and forks where a substantial amount of content is copied from a Wikimedia project are not allowed." Thank you for your understanding.',
				'Content Policy (Reception wiki)' => 'Declining per Content Policy provision, "Wikis should not be structured around bullet-point, good/bad commentary." Thank you for your understanding.',
				/* 'Content Policy (additional restrictions)' => 'Declining per the Content Policy's additional restrictions, which includes the topic of your wiki. Thank you for your understanding.', */
				'Author request' => 'Declined at the request of the wiki requester.',
			],
			'On hold reasons' => [
				'On hold pending response' => 'On hold pending response from the wiki requester (see the "Request Comments" tab). Please reply to the questions left by the wiki creator on this request, but do not create another wiki request. Thank you.',
				'On hold pending review from another wiki creator' => 'On hold pending review from another wiki creator or a Steward.',
			],
		],
	],
	'wgCreateWikiCustomDomainPage' => [
		'default' => 'Special:MyLanguage/Custom_domains',
	],
	'wgCreateWikiDatabaseClusters' => [
		'default' => [
			'c1',
			'c2',
			'c3',
			'c4',
		],
		'mirabeta' => [
			'c2',
		],
	],
	// Use if you want to stop wikis being created on this cluster
	'wgCreateWikiDatabaseClustersInactive' => [
		'default' => []
	],
	'wgCreateWikiDatabaseSuffix' => [
		'default' => 'wiki',
		'mirabeta' => 'wikibeta',
	],
	'wgCreateWikiDisableRESTAPI' => [
		'default' => true,
		'metawiki' => false,
		'metawikibeta' => false,
	],
	'wgCreateWikiGlobalWiki' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
	],
	'wgCreateWikiEmailNotifications' => [
		'default' => true,
	],
	'wgCreateWikiEnableManageInactiveWikis' => [
		'default' => true,
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
	'wgCreateWikiNotificationEmail' => [
		'default' => 'sre@miraheze.org',
	],
	'wgCreateWikiPurposes' => [
		'default' => [
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
	'wgCreateWikiSQLfiles' => [
		'default' => [
			"$IP/maintenance/tables-generated.sql",
			"$IP/extensions/AbuseFilter/db_patches/mysql/tables-generated.sql",
			"$IP/extensions/AntiSpoof/sql/mysql/tables-generated.sql",
			"$IP/extensions/BetaFeatures/sql/tables-generated.sql",
			"$IP/extensions/CheckUser/schema/mysql/tables-generated.sql",
			"$IP/extensions/DataDump/sql/data_dump.sql",
			"$IP/extensions/Echo/sql/mysql/tables-generated.sql",
			"$IP/extensions/GlobalBlocking/sql/mysql/tables-generated-global_block_whitelist.sql",
			"$IP/extensions/OAuth/schema/mysql/tables-generated.sql",
			"$IP/extensions/RottenLinks/sql/rottenlinks.sql",
			"$IP/extensions/UrlShortener/schemas/tables-generated.sql",
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
	'wgCreateWikiUseCategories' => [
		'default' => true,
	],
	'wgCreateWikiSubdomain' => [
		'default' => 'miraheze.org',
		'mirabeta' => 'mirabeta.org',
	],
	'wgCreateWikiUseClosedWikis' => [
		'default' => true,
	],
	'wgCreateWikiUseCustomDomains' => [
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
			'timeline-render' => 'public-private'
		],
	],
	'wgCreateWikiUseJobQueue' => [
		'default' => true,
		'metawikibeta' => false,
	],

	'wgRequestWikiMinimumLength' => [
		'default' => 250,
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

	// Darkmode
	'wgDarkModeTogglePosition' => [
		'default' => 'personal',
	],

	// Database
	'wgAllowSchemaUpdates' => [
		'default' => false,
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
		'default' => null,
		'srewiki' => 'ldapwikiwiki',
	],
	'wgSharedTables' => [
		'default' => [],
		'srewiki' => [ 'actor', 'user', 'user_properties', 'user_autocreate_serial' ],
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
	'wgDiscordNotificationMovedArticle' => [
		'default' => true,
	],
	'wgDiscordNotificationFileUpload' => [
		'default' => true,
	],
	'wgDiscordNotificationProtectedArticle' => [
		'default' => true,
	],
	'wgDiscordNotificationAfterImportPage' => [
		'default' => true,
	],
	'wgDiscordNotificationShowSuppressed' => [
		'default' => false,
	],
	'wgDiscordNotificationCentralAuthWikiUrl' => [
		'default' => 'https://meta.miraheze.org/',
	],
	'wgDiscordNotificationBlockedUser' => [
		'default' => true,
	],
	'wgDiscordNotificationNewUser' => [
		'default' => true,
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
	'wgDiscordCurlProxy' => [
		'default' => 'http://bastion.wikitide.net:8080',
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

	// DynamicPageList
	'wgDLPAllowUnlimitedCategories' => [
		'default' => false,
	],
	'wgDLPAllowUnlimitedResults' => [
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
		'mirabeta' => 'beta',
	],
	'wgEchoSharedTrackingDB' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
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
	'wgWatchlistExpiry' => [
		'default' => false,
	],

	// EmbedVideo
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

	// Evelution
	'wgEvelutionLeftPersonalLinks' => [
		'default' => false,
	],
	'wgEvelutionDisableColorManagement' => [
		'default' => false,
	],
	'wgEvelutionDisableRightRail' => [
		'default' => false,
	],
	'wgEvelutionServerMode' => [
		'default' => false,
	],
	'wgEvelutionStickyRail' => [
		'default' => true,
	],
	'wgEvelutionDisableRightRailFromSpecificPages' => [
		'default' => [],
	],
	'wgEvelutionMonoLogo' => [
		'default' => false,
	],
	'wgEvelutionChangeMessageBoxesToBanners' => [
		'default' => false,
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
		'+cslmodswiki' => [
			'api.steampowered.com/*' => [
				'replacements' => [
					'STEAM_API_KEY' => $wmgExternalDataCredsCslmodswiki ?? '',
				],
			],
		],
	],

	// HTTP
	'wgHTTPProxy' => [
		'default' => 'http://bastion.wikitide.net:8080',
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

	// Footers
	'+wgFooterIcons' => [
		'default' => [
			'poweredby' => [
				'miraheze' => [
					'src' => 'https://static.miraheze.org/commonswiki/f/ff/Powered_by_Miraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze',
				],
			],
		],
		'hsckwiki' => [
			'poweredby' => [
				'songnguxyz' => [
					'src' => 'https://static.miraheze.org/lhmnwiki/5/58/Footer.SN.xyz.svg',
					'url' => 'https://songngu.xyz',
					'alt' => 'Dự án được bảo quản bởi SongNgư.xyz',
				],
				'miraheze' => [
					'src' => 'https://static.miraheze.org/commonswiki/f/ff/Powered_by_Miraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze',
				],
			],
		],
		'lhmnwiki' => [
			'poweredby' => [
				'songnguxyz' => [
					'src' => 'https://static.miraheze.org/lhmnwiki/5/58/Footer.SN.xyz.svg',
					'url' => 'https://songngu.xyz',
					'alt' => 'Dự án được bảo quản bởi SongNgư.xyz',
				],
				'miraheze' => [
					'src' => 'https://static.miraheze.org/commonswiki/f/ff/Powered_by_Miraheze.svg',
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze',
				],
			],
		]
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
	'wgMaxUploadSize' => [
		'default' => 1024 * 1024 * 4096,
		/** T9673 - 10MB */
		'dragdownwiki' => 1024 * 1024 * 10,
		/** 20MB - qixwikiwiki */
		'qixwikiwiki' => 1024 * 1024 * 20,
	],
	'wgAllowCopyUploads' => [
		'default' => false,
	],
	'wgCopyUploadsFromSpecialUpload' => [
		'default' => false,
	],
	'wgCopyUploadProxy' => [
		'default' => 'http://bastion.wikitide.net:8080',
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
		'default' => 500,
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
	'wgMirahezeSurveyEnabled' => [
		'default' => false,
	],
	'wgEnableImageWhitelist' => [
		'default' => false,
	],
	'wgImagePreconnect' => [
		'default' => true,
	],
	'wgShowArchiveThumbnails' => [
		'default' => true,
	],
	'wgVerifyMimeType' => [
		'default' => true,
	],
	'wgSVGMetadataCutoff' => [
		'default' => 262144,
	],
	'wgSVGConverter' => [
		'default' => 'rsvg',
	],
	'wgSVGConverterPath' => [
		'default' => '/usr/local/bin'
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
		'dccomicswiki' => [
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
	'wgGlobalBlockingDatabase' => [
		'default' => 'mhglobal',
		'mirabeta' => 'testglobal',
	],

	// GlobalCssJs
	'wgGlobalCssJsConfig' => [
		'default' => [
			'wiki' => 'metawiki',
			'source' => 'metawiki',
		],
		'mirabeta' => [
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
		'mirabeta' => [
			'metawikibeta' => [
				'apiScript' => '//meta.mirabeta.org/w/api.php',
				'loadScript' => '//meta.mirabeta.org/w/load.php',
			],
		],
	],
	'wgUseGlobalSiteCssJs' => [
		'default' => false,
	],

	// GlobalNewFiles
	'wgGlobalNewFilesDatabase' => [
		'default' => 'mhglobal',
		'mirabeta' => 'testglobal',
	],

	// GlobalPreferences
	'wgGlobalPreferencesDB' => [
		'default' => 'mhglobal',
		'mirabeta' => 'testglobal',
	],

	// GlobalUsage
	'wgGlobalUsageDatabase' => [
		'default' => 'commonswiki',
		'gpcommonswiki' => 'gpcommonswiki',
		'gratisdatawiki' => 'gpcommonswiki',
		'gratispaideiawiki' => 'gpcommonswiki',
		'intercriaturaswiki' => 'intercriaturaswiki',
		'tuscriaturaswiki' => 'intercriaturaswiki',
		'yourcreatureswiki' => 'intercriaturaswiki',
	],
	'wgGlobalUsageSharedRepoWiki' => [
		'default' => false,
		'gpcommonswiki' => 'gpcommonswiki',
		'gratisdatawiki' => 'gpcommonswiki',
		'gratispaideiawiki' => 'gpcommonswiki',
	],
	'wgGlobalUsagePurgeBacklinks' => [
		'default' => false,
		'gpcommonswiki' => true,
		'gratisdatawiki' => true,
		'gratispaideiawiki' => true,
	],

	// GlobalUserPage
	'wgGlobalUserPageAPIUrl' => [
		'default' => 'https://login.miraheze.org/w/api.php',
		'mirabeta' => 'https://login.mirabeta.org/w/api.php',
	],
	'wgGlobalUserPageDBname' => [
		'default' => 'loginwiki',
		'mirabeta' => 'loginwikibeta',
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
		'+althistorywiki' => [
			'editprotected' => [
				'editrollbackprotected' => true,
				'edittemplateprotected' => true,
				'editrestrictedtemplateprotected' => true,
				'editimportprotected' => true,
			],
			'import' => [
				'import' => true,
				'importupload' => true,
			],
		],
		'+simulatorwiki' => [
			'editprotected' => [
				'editfragment' => true,
				'edittemplate' => true,
			],
			'import' => [
				'import' => true,
				'importupload' => true,
			],
		],
	],
	'+wgGrantPermissionGroups' => [
		'default' => [],
		'althistorywiki' => [
			'import' => 'administration',
		],
		'simulatorwiki' => [
			'import' => 'administration',
		],
	],

	// GrowthExperiments
	'wgWelcomeSurveyEnabled' => [
		'default' => false,
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
		'vgportdbwiki' => [
			'Games_Lacking_Information_Online' => 'obscure',
			'Incomplete_Pages' => 'incomplete',
		],
	],

	// ImageMagick
	'wgUseImageMagick' => [
		'default' => true,
	],
	'wgImageMagickConvertCommand' => [
		'default' => '/usr/local/bin/mediawiki-firejail-convert',
	],
	'wgSharpenParameter' => [
		'default' => '0x0.8',
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
	'wgIncidentReportingDatabase' => [
		'default' => 'incidents',
		'mirabeta' => 'testglobal',
	],
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
	'wgInterwikiCentralDB' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
	],
	'wgExtraInterlanguageLinkPrefixes' => [
		'default' => [
			'simple',
		],
		'+commonswiki' => [
			'wikimediacommons',
			'w',
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
		'+wikibenwiki' => [
			'bw' => 'Benwegul',
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
				'baseTransOnly' => true,
			],
			'wikiforge' => [
				/** WikiForge */
				'interwiki' => 'wf',
				'url' => 'https://$2.wikiforge.net/wiki/$1',
				'baseTransOnly' => true,
			],
		],
	],

	// InterwikiSorting
	'wgInterwikiSortingSort' => [
		'ext-InterwikiSorting' => 'code',
	],

	// ImportDump
	'wgImportDumpCentralWiki' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
	],
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
		'default' => 'screen -d -m bash -c ". /etc/swift-env.sh; swift download miraheze-metawiki-local-public {file-path} -o /home/$USER/{file-name}; mwscript importDump.php {wiki} -y --no-updates --username-prefix={username-prefix} /home/$USER/{file-name}; mwscript rebuildall.php {wiki} -y; mwscript initSiteStats.php {wiki} --active --update -y; rm /home/$USER/{file-name}"',
		'metawikibeta' => 'screen -d -m bash -c ". /etc/swift-env.sh; swift download miraheze-metawikibeta-local-public {file-path} -o /home/$USER/{file-name}; mwscript importDump.php {wiki} -y --no-updates --username-prefix={username-prefix} /home/$USER/{file-name}; mwscript rebuildall.php {wiki} -y; mwscript initSiteStats.php {wiki} --active --update -y; rm /home/$USER/{file-name}"',
	],
	'wgImportDumpUsersNotifiedOnAllRequests' => [
		'default' => [
			'Alex (Miraheze)',
			'MacFan4000',
			'Original Authority',
			'Reception123',
			'Universal Omega',
		],
	],
	'wgImportDumpUsersNotifiedOnFailedImports' => [
		'default' => [
			'Alex (Miraheze)',
			'MacFan4000',
			'Original Authority',
			'Reception123',
			'Universal Omega',
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
		'+althistorywiki' => [
			'wikimediacommons',
		],
		'+batfamilywiki' => [
			'batmanwiki',
			'batmanwikifandom',
			'd',
		],
		'+batmanwiki' => [
			'batfamilywiki',
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
		'+celebswiki' => [
			'simplewiki',
		],
		'+devwiki' => [
			'templatewikiarchive',
		],
		'+hkrailwiki' => [
			'zhwikipedia',
			'hkrailfan',
		],
		'+ilaiwiki' => [
			'wikipedia' => [
				'en',
				'fr',
			],
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
		'+polandballstaffwiki' => [
			'polandballwiki',
			'polandballwikisongcontestwiki',
			'polcomwiki',
		],
		'+polcomwiki' => [
			'c',
			'polandballwiki',
			'polandballwikisongcontestwiki',
		],
		'+redminwiki' => [
			'scratchwiki',
			'snapwiki',
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
		'+securipediawiki' => [
			'pv',
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
		'+zealandiawiki' => [
			'wikia' => [
				'adoriasim',
				'zealandian-republic',
				'zealandia-polsim',
				'zealandia-2',
				'zealandian-legal-archives',
				'zealandia-mapping',
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
		'default' => [
			1.3,
			1.5,
			2,
			2.6,
			3,
		],
		'bluepageswiki' => [
			1,
		],
		'hkrailwiki' => [
			1,
		],
		'isvwiki' => [
			1,
		],
		'leborkwiki' => [
			1,
		],
	],
	'wgKartographerStaticMapframe' => [
		'default' => false,
	],
	'wgKartographerSimpleStyleMarkers' => [
		'default' => true,
		'bluepageswiki' => false,
		'gratisdatawiki' => false,
		'hkrailwiki' => false,
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

	// Language
	'wgLanguageCode' => [
		'default' => 'en',
	],

	// LDAP
	'wgLDAPDomainNames' => [
		'ldapwikiwiki' => [
			'wikitide',
		],
		'srewiki' => [
			'wikitide',
		],
	],
	'wgLDAPServerNames' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ldap.wikitide.net',
		],
		'srewiki' => [
			'wikitide' => 'ldap.wikitide.net',
		],
	],
	'wgLDAPEncryptionType' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ssl',
		],
		'srewiki' => [
			'wikitide' => 'ssl',
		],
	],
	'wgLDAPSearchAttributes' => [
		'ldapwikiwiki' => [
			'wikitide' => 'uid',
		],
		'srewiki' => [
			'wikitide' => 'uid',
		],
	],
	'wgLDAPBaseDNs' => [
		'ldapwikiwiki' => [
			'wikitide' => 'dc=miraheze,dc=org',
		],
		'srewiki' => [
			'wikitide' => 'dc=miraheze,dc=org',
		],
	],
	'wgLDAPUserBaseDNs' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ou=people,dc=miraheze,dc=org',
		],
		'srewiki' => [
			'wikitide' => 'ou=people,dc=miraheze,dc=org',
		],
	],
	'wgLDAPProxyAgent' => [
		'ldapwikiwiki' => [
			'wikitide' => 'cn=write-user,dc=miraheze,dc=org',
		],
		'srewiki' => [
			'wikitide' => 'cn=write-user,dc=miraheze,dc=org',
		],
	],
	'wgLDAPProxyAgentPassword' => [
		'ldapwikiwiki' => [
			'wikitide' => $wmgLdapPassword,
		],
		'srewiki' => [
			'wikitide' => $wmgLdapPassword,
		],
	],
	'wgLDAPWriterDN' => [
		'ldapwikiwiki' => [
			'wikitide' => 'cn=write-user,dc=miraheze,dc=org',
		],
		'srewiki' => [
			'wikitide' => 'cn=write-user,dc=miraheze,dc=org',
		],
	],
	'wgLDAPWriterPassword' => [
		'ldapwikiwiki' => [
			'wikitide' => $wmgLdapPassword,
		],
		'srewiki' => [
			'wikitide' => $wmgLdapPassword,
		],
	],
	'wgLDAPWriteLocation' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ou=people,dc=miraheze,dc=org',
		],
		'srewiki' => [
			'wikitide' => 'ou=people,dc=miraheze,dc=org',
		],
	],
	'wgLDAPAddLDAPUsers' => [
		'ldapwikiwiki' => [
			'wikitide' => true,
		],
		'srewiki' => [
			'wikitide' => true,
		],
	],
	'wgLDAPUpdateLDAP' => [
		'ldapwikiwiki' => [
			'wikitide' => true,
		],
		'srewiki' => [
			'wikitide' => true,
		],
	],
	'wgLDAPPasswordHash' => [
		'ldapwikiwiki' => [
			'wikitide' => 'ssha',
		],
		'srewiki' => [
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
		'srewiki' => [
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
		'srewiki' => [
			'wikitide' => true,
		],
	],
	'wgLDAPLowerCaseUsernameScheme' => [
		'ldapwikiwiki' => [
			'wikitide' => false,
			'invaliddomain' => false,
		],
		'srewiki' => [
			'wikitide' => false,
			'invaliddomain' => false,
		],
	],
	'wgLDAPLowerCaseUsername' => [
		'ldapwikiwiki' => [
			'wikitide' => false,
			'invaliddomain' => false,
		],
		'srewiki' => [
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
		'srewiki' => [
			'wikitide' => [
				'LDAP_OPT_X_TLS_CACERTFILE' => '/etc/ssl/certs/LetsEncrypt.crt',
			],
		],
	],
	'wgLDAPDebug' => [
		'ldapwikiwiki' => 1,
		'srewiki' => 1,
	],

	// License
	'wgRightsIcon' => [
		'constantnoblewiki' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/Freeculturalworks-pdbutton.svg',
		'jadtechwiki' => "https://$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'quyranesswiki' => "https://$wmgUploadHostname/quyranesswiki/0/03/Copyright.svg.png",
		'revitwiki' => "https://$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
		'spnatiwiki' => 'https://upload.wikimedia.org/wikipedia/commons/f/f8/License_icon-mit-88x31-2.svg',
	],
	'wgRightsPage' => [
		'default' => '',
		'constantnoblewiki' => 'Constant Noble:No rights reserved',
		'diavwiki' => 'Project:Copyrights',
		'dmlwikiwiki' => 'MediaWiki:Copyright',
		'quyranesswiki' => 'Project:Copyrights',
	],
	'wgRightsText' => [
		'connorjwatwiki' => 'Creative Commons Attribution-ShareAlike 2.5 Generic (CC BY-SA 2.5)',
		'constantnoblewiki' => 'CC0 1.0 Universal (CC0 1.0) Public Domain Dedication',
		'exlinkwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'glitchcitywiki' => 'Creative Commons Attribution-NonCommercial 3.0 Unported (CC BY-NC 3.0)',
		'googologywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'incubatorwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'jadtechwiki' => 'Copyright © Jak and Daxter Technical Wiki. All rights reserved.',
		'militarywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'privadowiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'quyranesswiki' => '©2021 TheBurningPrincess (All Rights Reserved)',
		'rctwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'revitwiki' => '©2013-2024 by Lionel J. Camara (All Rights Reserved)',
		'reviwiki' => 'Creative Commons Attribution Share Alike',
		'sekatetwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'spnatiwiki' => 'Copyright (c) 2015 The SPNATI Contributors',
		'songnguxyzwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'tlhmupaqwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'tlhwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikidemocracywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikilexiconwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'worldtrainwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
	],
	'wgRightsUrl' => [
		'default' => '',
		'connorjwatwiki' => 'https://creativecommons.org/licenses/by-sa/2.5',
		'constantnoblewiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'exlinkwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'glitchcitywiki' => 'https://creativecommons.org/licenses/by-nc/3.0',
		'googologywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'incubatorwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'jadtechwiki' => 'https://jadtech.miraheze.org/wiki/MediaWiki:Copyright',
		'militarywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'privadowiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'quyranesswiki' => 'https://quyraness.miraheze.org/wiki/MediaWiki:Copyright',
		'rctwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr',
		'sekatetwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'spnatiwiki' => 'https://gitgud.io/spnati/spnati/-/blob/master/LICENSE',
		'songnguxyzwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'tlhmupaqwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'tlhwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'wikidemocracywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'wikilexiconwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'worldtrainwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
	],
	'wmgWikiLicense' => [
		'default' => 'cc-by-sa',
	],

	// Links?
	'+wgUrlProtocols' => [
		'default' => [],
		// file protocol only allowed on private wikis
		'gzewiki' => [ 'file://' ],
		'vtwiki' => [ 'discord://' ],
		'100acgwiki' => [ 'infoflow://' ],
	],

	// LinkTarget
	'wgLinkTargetParentClasses' => [
		'default' => [],
		'anewc0dawiki' => [
			[ 'newtablinks', 'wikiwalk' ],
			'_self' => [ 'sametablinks' ]
		],
		'scruffywiki' => [
			'_blank' => [ '' ]
		],
		'sdiywikiwiki' => [
			'_blank' => [ '' ]
		],
		'simpleelectronicswiki' => [
			'_blank' => [ '' ]
		],
	],

	// LinkTitles
	'wgLinkTitlesFirstOnly' => [
		'default' => true,
		'simulatorwiki' => false,
	],
	'wgLinkTitlesParseOnEdit' => [
		'default' => true,
		'simulatorwiki' => false,
	],
	'wgLinkTitlesSameNamespace' => [
		'default' => true,
		'simulatorwiki' => false,
	],
	'wgLinkTitlesSourceNamespaces' => [
		'default' => [],
		'simulatorwiki' => [
			NS_MAIN,
			3000,
		],
	],
	'wgLinkTitlesTargetNamespaces' => [
		'default' => [],
		'simulatorwiki' => [
			NS_MAIN,
		],
	],

	// LiliPond
	'wgScoreLilyPond' => [
		'default' => '/dev/null',
	],
	'wgScoreDisableExec' => [
		'default' => true,
	],

	// Linter
	'wgLinterSubmitterWhitelist' => [
		'ext-Linter' => [
			/** localhost */
			'::1' => true,
			/** mw151 */
			'2602:294:0:c8::105' => true,
			/** mw152 */
			'2602:294:0:c8::106' => true,
			/** mw161 */
			'2602:294:0:b13::106' => true,
			/** mw162 */
			'2602:294:0:b13::107' => true,
			/** mw171 */
			'2602:294:0:b23::104' => true,
			/** mw172 */
			'2602:294:0:b23::105' => true,
			/** mw181 */
			'2602:294:0:b12::105' => true,
			/** mw182 */
			'2602:294:0:b12::106' => true,
			/** mwtask181 */
			'2602:294:0:b12::107' => true,
			/** test151 */
			'2602:294:0:c8::109' => true,
		],
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
	'wgManageWiki' => [
		'default' => [
			'core' => true,
			'extensions' => true,
			'namespaces' => true,
			'permissions' => true,
			'settings' => true
		],
	],
	'wgManageWikiExtensionsDefault' => [
		'default' => [
			'categorytree',
			'cite',
			'citethispage',
			'codeeditor',
			'codemirror',
			'darkmode',
			'globaluserpage',
			'minervaneue',
			'mobilefrontend',
			'purge',
			'syntaxhighlight_geshi',
			'textextracts',
			'urlshortener',
			'wikiseo',
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
			'sre' => [
				'sre',
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
				'writeapi' => true,
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
		'+hypopediawiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
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
		'+memeswiki' => [
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
			],
			'templateeditor' => [
				'edittemplateprotected' => true,
			],
		],
		'+metawiki' => [
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
			],
			'global-renamer' => [
				'centralauth-rename' => true,
			],
			'global-sysop' => [
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
				'centralauth-suppress' => true,
				'centralauth-rename' => true,
				'centralauth-unmerge' => true,
				'createwiki' => true,
				'createwiki-deleterequest' => true,
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
			'sre' => [
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'handle-ssl-requests' => true,
				'oathauth-verify-user' => true,
				'oathauth-disable-for-user' => true,
				'view-private-import-requests' => true,
				'view-private-ssl-requests' => true,
			],
			'suppress' => [
				'createwiki-suppressrequest' => true,
				'createwiki-suppressionlog' => true,
			],
			'trustandsafety' => [
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
			'sysop' => [
				'interwiki' => true,
			],
			'user' => [
				'request-import' => true,
				'request-ssl' => true,
				'requestwiki' => true,
			],
			'wiki-creator' => [
				'createwiki' => true,
				'createwiki-deleterequest' => true,
			],
		],
		'+metawikibeta' => [
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
			'global-sysop' => [
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
				'centralauth-unmerge' => true,
				'createwiki' => true,
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
			'sre' => [
				'globalgroupmembership' => true,
				'globalgrouppermissions' => true,
				'handle-import-request-interwiki' => true,
				'handle-import-requests' => true,
				'oathauth-verify-user' => true,
				'oathauth-disable-for-user' => true,
				'view-private-import-requests' => true,
			],
			'trustandsafety' => [
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
				'request-import' => true,
				'request-ssl' => true,
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
		'+naasgamelandwiki' => [
			'bot' => [
				'editarchiveprotected' => true,
			],
			'cocreator' => [
				'editarchiveprotected' => true,
				'editofficialprotected' => true,
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
		'+nicolopediawiki' => [
			'templateeditor' => [
				'edittemplateprotected' => true,
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
		'+srewiki' => [
			'sysop' => [
				'managewiki-restricted' => true,
			],
			'user' => [
				'read' => true,
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
		'+ext-Flow' => [
			'suppress' => [
				'flow-suppress' => true,
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
			'sre' => [
				'sre',
			],
			'trustandsafety' => [
				'trustandsafety',
			],
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
				'centralauth-createlocal',
				'centralauth-lock',
				'centralauth-suppress',
				'centralauth-rename',
				'centralauth-unmerge',
				'checkuser',
				'checkuser-log',
				'createwiki',
				'createwiki-deleterequest',
				'createwiki-suppressionlog',
				'createwiki-suppressrequest',
				'editincidents',
				'editothersprofiles-private',
				'flow-suppress',
				'generate-random-hash',
				'globalblock',
				'globalblock-exempt',
				'globalgroupmembership',
				'globalgrouppermissions',
				'handle-import-request-interwiki',
				'handle-import-requests',
				'handle-pii',
				'hideuser',
				'investigate',
				'ipinfo',
				'ipinfo-view-basic',
				'ipinfo-view-full',
				'ipinfo-view-log',
				'managewiki-restricted',
				'managewiki-editdefault',
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
				'renameuser',
				'reportincident',
				'request-import',
				'requestwiki',
				'siteadmin',
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
				'writeapi',
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
	'wgManageWikiPermissionsDisallowedGroups' => [
		'default' => [
			'checkuser',
			'smwadministrator',
			'oversight',
			'steward',
			'staff',
			'suppress',
			'interwiki-admin',
			'sre',
			'trustandsafety',
		],
		'+metawiki' => [
			'electionadmin',
		],
	],
	'wgManageWikiPermissionsDefaultPrivateGroup' => [
		'default' => 'member',
	],
	'wgManageWikiHelpUrl' => [
		'default' => '//meta.miraheze.org/wiki/Special:MyLanguage/ManageWiki',
	],
	'wgManageWikiForceSidebarLinks' => [
		'default' => false,
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
	'wgMatomoAnalyticsDatabase' => [
		'default' => 'mhglobal',
		'mirabeta' => 'testglobal',
	],
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

	// MediaWikiChat settings
	'wgChatLinkUsernames' => [
		'default' => false,
	],
	'wgChatMeCommand' => [
		'default' => false,
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
	],

	// MirahezeMagic
	'wgMirahezeMagicAccessIdsMap' => [
		'default' => [
			// Only the board are allowed access
			// DO NOT ADD UNAUTHORIZED USERS
			'iowiki' => [
				/** Reception123 */
				19,
				/** Universal Omega */
				438966,
				/** Harej */
				13892,
				/** NotAracham */
				345529,
				/** Labster */
				2551,
			],
			// Only the board and SRE allowed access
			// DO NOT ADD UNAUTHORIZED USERS
			'staffwiki' => [
				/** Reception123 (SRE and Board) */
				19,
				/** Void (SRE) */
				5258,
				/** MacFan4000 (SRE) */
				6758,
				/** Universal Omega (SRE and Board) */
				438966,
				/** Harej (Board) */
				13892,
				/** NotAracham (Board) */
				345529,
				/** Labster (Board) */
				2551,
				/** Original Authority (SRE) */
				353865,
				/** Alex (Miraheze) — OrangeStar (SRE) */
				464360,
				/** Evalprime (SRE) */
				342246,
			],
			// Only the board and SRE allowed access
			// DO NOT ADD UNAUTHORIZED USERS
			'srewiki' => [
				/** Reception123 (SRE and Board) */
				19,
				/** Void (SRE) */
				5258,
				/** MacFan4000 (SRE) */
				6758,
				/** Universal Omega (SRE and Board) */
				438966,
				/** Harej (Board) */
				13892,
				/** NotAracham (Board) */
				345529,
				/** Labster (Board) */
				2551,
				/** Original Authority (SRE) */
				353865,
				/** Alex (Miraheze) — OrangeStar (SRE) */
				464360,
				/** Evalprime (SRE) */
				342246,
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
		'xtexvnetwiki' => [
			'ISBN' => true,
			'PMID' => false,
			'RFC' => true,
		],
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
	'wgMaxExecutionTimeForExpensiveQueries' => [
		'default' => 30000,
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
			'meta.miraheze.org',
		],
		'mirabeta' => [
			'login.miraheze.org',
			'meta.mirabeta.org',
		],
		'+gratisdatawiki' => [
			'gratispaideia.miraheze.org',
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
		'hkrailwiki' => [
			'zh',
			'zh-hant',
			'zh-hans',
		],
	],
	'wgDefaultLanguageVariant' => [
		'default' => false,
		'hkrailwiki' => 'zh-hk',
		'zhtranswiki' => 'zh-cn',
	],
	'wgResourceLoaderMaxQueryLength' => [
		'default' => 5000,
	],
	'wgCleanSignatures' => [
		'default' => true,
	],

	// MobileFrontend
	'wgMFAutodetectMobileView' => [
		'default' => true,
	],
	'wgMFDefaultEditor' => [
		'default' => 'preference',
	],
	'wgDefaultMobileSkin' => [
		'default' => 'minerva',
	],
	'wgMobileUrlTemplate' => [
		'default' => '',
	],
	'wgMFMobileHeader' => [
		'ext-MobileFrontend' => 'X-Subdomain',
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
		'mcspringfieldserverwiki' => [
			'base' => [
				'.nomobile',
			],
		],
		'xtexvnetwiki' => [
			'base' => [
				'.vertical-navbox',
				'.nomobile',
			],
		],
	],
	'wgMFNoindexPages' => [
		'ext-MobileFrontend' => false,
	],
	'wgMFUseDesktopSpecialHistoryPage' => [
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
	'wgMFUseDesktopSpecialWatchlistPage' => [
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
	'wgMFUseDesktopContributionsPage' => [
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
	'wgMFQueryPropModules' => [
		'default' => [
			'pageprops',
		],
		'gratisdatawiki' => [
			'entityterms',
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
	'wgMFEnableWikidataDescriptions' => [
		'default' => [
			'base' => false,
			'beta' => true,
		],
		'gratispaideiawiki' => [
			'base' => true,
			'beta' => true,
		],
	],
	'wgMFDisplayWikibaseDescriptions' => [
		'default' => [
			'search' => false,
			'nearby' => false,
			'watchlist' => false,
			'tagline' => false,
		],
		'famedatawiki' => [
			'search' => true,
			'nearby' => false,
			'watchlist' => true,
			'tagline' => false,
		],
		'gratispaideiawiki' => [
			'search' => true,
			'nearby' => false,
			'watchlist' => true,
			'tagline' => false,
		],
		'gratisdatawiki' => [
			'search' => true,
			'nearby' => false,
			'watchlist' => true,
			'tagline' => false,
		],
	],
	'wgMFCollapseSectionsByDefault' => [
		'default' => true,
		'twistwoodtaleswiki' => false,
	],
	'wgMFCustomSiteModules' => [
		'default' => true,
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
		'simulatorwiki' => [
			3000,
		],
		'talenteddeviantswiki' => [
			NS_MAIN,
			NS_FILE
		],
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

	// MultiPurge
	'wgMultiPurgeEnabledServices' => [
		'default' => [
			'Cloudflare',
			// 'Varnish',
		],
	],
	'wgMultiPurgeServiceOrder' => [
		'default' => [
			// 'Varnish',
			'Cloudflare',
		],
	],

	// MultimediaViewer (not beta)
	'wgMediaViewerEnableByDefault' => [
		'default' => true,
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
		'vgportdbwiki' => true,
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
	'wgNewUserMessageOnAutoCreate' => [
		'default' => false,
		'nmfwikiwiki' => true,
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
	'wgOATHAuthDatabase' => [
		'default' => 'mhglobal',
		'ldapwikiwiki' => 'ldapwikiwiki',
		'srewiki' => 'ldapwikiwiki',
		'mirabeta' => 'testglobal',
	],
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
		'+ldapwikiwiki' => [
			'user',
		],
		'+metawiki' => [
			'electionadmin',
			'global-sysop',
			'interface-admin',
			'sre',
			'trustandsafety'
		],
		// metawikibeta should mirror metawiki
		'+metawikibeta' => [
			'global-sysop',
			'interface-admin',
			'sre',
			'trustandsafety'
		],
	],
	// OAuth
	'wgMWOAuthCentralWiki' => [
		'default' => 'metawiki',
		'ldapwikiwiki' => false,
		'srewiki' => false,
		'mirabeta' => 'metawikibeta',
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
	'wgPageImagesNamespaces' => [
		'default' => [
			NS_MAIN,
		],
		'gpcommonswiki' => [
			NS_MAIN,
			NS_CATEGORY,
		],
		'vgportdbwiki' => [
			NS_MAIN,
			3000,
			3004,
			3006,
		],
	],
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
		'gratispaideiawiki' => true,
		'gratisdatawiki' => true,
		'gpcommonswiki' => true,
	],
	'wgPageImagesLeadSectionOnly' => [
		'default' => false
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

	// Parsoid
	'wgParsoidSettings' => [
		'default' => [
			'useSelser' => true,
		],
		'+ext-Linter' => [
			'linting' => true,
		],
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
		'+simulatorwiki' => [
			'moderated' => [
				'skip-moderation' => true,
			],
		],
		'+ext-MediaWikiChat' => [
			'blockedfromchat' => [
				'chat' => true,
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
				'MinimalPasswordLength' => 'PasswordPolicyChecks::checkMinimalPasswordLength',
				'MinimumPasswordLengthToLogin' => 'PasswordPolicyChecks::checkMinimumPasswordLengthToLogin',
				'PasswordCannotBeSubstringInUsername' => 'PasswordPolicyChecks::checkPasswordCannotBeSubstringInUsername',
				'PasswordCannotMatchDefaults' => 'PasswordPolicyChecks::checkPasswordCannotMatchDefaults',
				'MaximalPasswordLength' => 'PasswordPolicyChecks::checkMaximalPasswordLength',
				'PasswordNotInCommonList' => 'PasswordPolicyChecks::checkPasswordNotInCommonList',
			],
		],
	],
	'wgCentralAuthGlobalPasswordPolicies' => [
		'default' => [
			'global-sysop' => [
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
			'sre' => [
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
		],
	],

	// Popups
	'wgPopupsHideOptInOnPreferencesPage' => [
		'default' => false,
	],
	'wgPopupsOptInDefaultState' => [
		'default' => 0,
	],

	// PortableInfobox
	'wgPortableInfoboxResponsiblyOpenCollapsed' => [
		'default' => true,
	],
	'wgPortableInfoboxCacheRenderers' => [
		'default' => true,
	],

	// Preferences
	'+wgDefaultUserOptions' => [
		'default' => [
			'enotifwatchlistpages' => 0,
			'math' => 'mathml',
			'usebetatoolbar' => 1,
			'usebetatoolbar-cgd' => 1,
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
		'+dmlwikiwiki' => [
			'imagesize' => 2,
		],
		'+donkeykongwiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+dragonquest2wiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+fanpediawiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+finalfantasywiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+isvwiki' => [
			'flow-topiclist-sortby' => 'newest',
			'usecodemirror' => 1,
		],
		'+kirbywiki' => [
			'thumbsize' => 3,
		],
		'+landarwiki' => [
			'usenewrc' => 0,
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
		],
		'+luigismansionwiki' => [
			'usenewrc' => 0,
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'thumbsize' => 3,
		],
		'+mariowiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+metroidwiki' => [
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
		'+pokemonwiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+rarewiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+reviwiki' => [
			'rcenhancedfilters-disable' => 1,
			'usenewrc' => 0,
		],
		'+segawiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+smashbroswiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+solarawiki' => [
			'usecodemirror' => 1,
		],
		'+squareenixwiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+wariowiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
		],
		'+yoshiwiki' => [
			'rcenhancedfilters-disable' => 1,
			'wlenhancedfilters-disable' => 1,
			'usenewrc' => 0,
			'thumbsize' => 3,
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
				'user' => [ 1, 3600 ],
			],
		],
	],

	// RatePage
	'wgRPRatingPageBlacklist' => [
		'default' => [],
	],
	'wgRPAddSidebarSection' => [
		'default' => true,
	],
	'wgRPSidebarPosition' => [
		'default' => 2,
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

	// ReportIncident
	'wgReportIncidentAdministratorsPage' => [
		'default' => 'meta:Trust_and_Safety',
	],
	'wgReportIncidentEmailFromAddress' => [
		'default' => $wgPasswordSender,
	],
	'wgReportIncidentRecipientEmails' => [
		'default' => [
			'ts@wikitide.org',
		],
	],

	// Resources
	'wgExtensionAssetsPath' => [
		'default' => '/' . $wi->version . '/extensions',
	],
	'wgLocalStylePath' => [
		'default' => '/' . $wi->version . '/skins',
	],
	'wgResourceBasePath' => [
		'default' => '/' . $wi->version,
	],
	'wgResourceLoaderMaxQueryLength' => [
		'default' => 5000,
	],
	'wgStylePath' => [
		'default' => '/' . $wi->version . '/skins',
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

	// RequestSSL
	'wgRequestSSLCentralWiki' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
	],
	'wgRequestSSLScriptCommand' => [
		'default' => 'sudo /root/ssl-certificate -d {customdomain} -g -p',
	],
	'wgRequestSSLUsersNotifiedOnAllRequests' => [
		'default' => [
			'MacFan4000',
			'Original Authority',
			'Reception123',
			'Universal Omega',
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
		'+321nailswiki' => [
			'templateeditor',
			'extendedconfirmed',
		],
		'+allpediawiki' => [
			'editextendedconfirmedprotected',
		],
		'+althistorywiki' => [
			'editrollbackprotected',
			'edittemplateprotected',
			'editrestrictedtemplateprotected',
			'editimportprotected',
		],
		'+bigforestwiki' => [
			'editvoter',
		],
		'+celebswiki' => [
			'editmoduleprotected',
			'edittemplateprotected',
			'editfounderprotected',
		],
		'+cmgwiki' => [
			'bureaucrat',
			'sysop',
			'pm',
			'member',
		],
		'+collegecitoyenwiki' => [
			'editextendedsemiprotected',
		],
		'+csydeswiki' => [
			'editblacklisted',
		],
		'+devwiki' => [
			'editinterface',
		],
		'+famedatawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+famepediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+gratispaideiawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+hypopediawiki' => [
			'editbureaucratprotected',
			'editextendedconfirmedprotected',
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
		'+memeswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
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
		'+naasgamelandwiki' => [
			'editarchiveprotected',
			'editofficialprotected',
		],
		'+nicolopediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'nycsubwaywiki' => [
			'',
			'autoconfirmed',
			'sysop',
		],
		'+phightingwiki' => [
			'edittrusteduserprotected',
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
		'+simulatorwiki' => [
			'edittemplate',
		],
		'+testwiki' => [
			'editbureaucratprotected',
			'editconsulprotected',
		],
		'+theredpionnerwiki' => [
			'extendedconfirmed',
			'templateeditor',
		],
		'+trwdeploymentwiki' => [
			'bureaucrat',
			'consul',
		],
		'+vnenderbotwiki' => [
			'template',
			'extendedconfirmed',
			'owner',
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
		'althistorywiki' => [
			'editrollbackprotected',
			'edittemplateprotected',
			'editrestrictedtemplateprotected',
			'editimportprotected',
		],
		'celebswiki' => [
			'editmoduleprotected',
			'edittemplateprotected',
			'editfounderprotected',
		],
		'collegecitoyenwiki' => [
			'editextendedsemiprotected',
		],
		'csydeswiki' => [
			'editblacklisted',
		],
		'famedatawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'famepediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'gratispaideiawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'hypopediawiki' => [
			'editbureaucratprotected',
			'editextendedconfirmedprotected',
		],
		'infopediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
			'editwikistaffprotected',
		],
		'knightnwiki' => [
			'editextendedsemiprotected',
		],
		'memeswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'metawiki' => [
			'editautopatrolprotected',
		],
		'mypediawiki' => [
			'editextendedconfirmedprotected',
		],
		'naasgamelandwiki' => [
			'editarchiveprotected',
			'editofficialprotected',
		],
		'nicolopediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'phightingwiki' => [
			'edittrusteduserprotected',
		],
		'pokemonarowiki' => [
			'unrestricted_edit',
		],
		'projectsekaiwiki' => [
			'editguide',
		],
		'scratchpadwiki' => [
			'templateeditor',
			'extendedconfirmed',
			'moderator',
			'bureaucrat',
		],
		'simulatorwiki' => [
			'editfragment',
			'edittemplate',
		],
		'testwiki' => [
			'editbureaucratprotected',
			'editconsulprotected',
		],
		'trwdeploymentwiki' => [
			'bureaucrat',
			'consul',
		],
		'theredpionnerwiki' => [
			'extendedconfirmed',
			'templateeditor',
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
		'+quoteunquotecampaignwiki' => [
			'remi',
			'melon',
			'ink',
			'jaden',
			'thursday',
			'kyle',
			'voyd',
			'sami',
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
		'+snapwikiwiki' => [
			'smerge.imp.fu-berlin.de',
			'www.hinkler.com.au',
		],
	],
	'wgRottenLinksHTTPProxy' => [
		'default' => 'http://bastion.wikitide.net:8080'
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

	// Referrer Policy
	'wgReferrerPolicy' => [
		'default' => [
			'origin-when-cross-origin',
			'origin'
		],
	],

	// RSS Settings
	'wgRSSAllowImageTag' => [
		'default' => false,
		'jwmeetingwiki' => true,
	],
	'wgRSSCacheAge' => [
		'default' => 3600,
	],
	'wgRSSProxy' => [
		'default' => 'http://bastion.wikitide.net:8080',
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
	'wgScriptPath' => [
		'default' => '/w',
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
	'wgTabberNeueEnableMD5Hash' => [
		'default' => true,
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
			],
			'image' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/>',
				'<^(?:https:)?//static\\.miraheze\\.org/>',
				'<^(?:https:)?//static\\.wikitide\\.net/>',
			],
			'svg' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/[^?#]*\\.svg(?:[?#]|$)>',
				'<^(?:https:)?//static\\.miraheze\\.org/[^?#]*\\.svg(?:[?#]|$)>',
				'<^(?:https:)?//static\\.wikitide\\.net/[^?#]*\\.svg(?:[?#]|$)>',
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
			'.mw-editsection',
			'sup.reference',
			'ol.references',
			'.error',
			'.nomobile',
			'.noprint',
			'.noexcerpt',
			'.sortkey',
		],
		'+gratispaideiawiki' => [
			'.metadata',
			'span.coordinates',
			'span.geo-multi-punct',
			'span.geo-nondefault',
			'#coordinates',
		],
		'softcellwiki' => [
			'table',
			'script',
			'input',
			'style',
			'ul.gallery',
			'.mw-editsection',
			'sup.reference',
			'ol.references',
			'.error',
			'.nomobile',
			'.noprint',
			'.noexcerpt',
			'.sortkey',
		],
	],

	// TimedMediaHandler
	'wgOggThumbLocation' => [
		'default' => false,
	],
	'wgTmhEnableMp4Uploads' => [
		'default' => false,
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
		'mirabeta' => [
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
		'hkrailwiki' => [
			'*' => [
				'zh-hant' => '本站已配置[[Project:繁簡處理|自動繁簡轉換]]功能，請在語言表單選擇翻譯語言為「中文」而非「中文（繁體）」。',
				'zh-hk' => '本站已配置[[Project:繁簡處理|自動繁簡轉換]]功能，請在語言表單選擇翻譯語言為「中文」而非「中文（香港）」。',
				'zh-tw' => '本站已配置[[Project:繁簡處理|自動繁簡轉換]]功能，請在語言表單選擇翻譯語言為「中文」而非「中文（台灣）」。',
				'zh-mo' => '本站已配置[[Project:繁簡處理|自動繁簡轉換]]功能，請在語言表單選擇翻譯語言為「中文」而非「中文（澳門）」。',
				'zh-hant' => '本站已配置[[Project:繁簡處理|自动简繁转换]]功能，请在语言表单选择翻译语言为「中文」而非「中文（简体）」。',
				'zh-cn' => '本站已配置[[Project:繁簡處理|自动简繁转换]]功能，请在语言表单选择翻译语言为「中文」而非「中文（中国大陆）」。',
				'zh-sg' => '本站已配置[[Project:繁簡處理|自动简繁转换]]功能，请在语言表单选择翻译语言为「中文」而非「中文（新加坡）」。',
				'zh-my' => '本站已配置[[Project:繁簡處理|自动简繁转换]]功能，请在语言表单选择翻译语言为「中文」而非「中文（马来西亚）」。',
			],
		],
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
	'wgTorBlockProxy' => [
		'default' => 'http://bastion.wikitide.net:8080'
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
	'wgUrlShortenerDBName' => [
		'default' => 'metawiki',
		'mirabeta' => 'metawikibeta',
	],
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
		'default' => '8',
	],

	// UserPageEditProtection
	'wgOnlyUserEditUserPage' => [
		'ext-UserPageEditProtection' => true,
	],

	// Varnish
	'wgUseCdn' => [
		'default' => true,
	],
	'wgMultiPurgeVarnishServers' => [
		'default' => [
			/** cp28 */
			// 'http://[2001:470:25:715::2]:81',
			/** cp36 */
			'http://[2602:294:0:b13::110]:81',
			/** cp37 */
			'http://[2602:294:0:b23::112]:81',
			/** cp41 */
			'http://[2400:d320:2161:9775::1]:81',
			/** cp51 */
			'http://[2407:3641:2161:9774::1]:81',
		],
	],
	// Temporary; except CloudFlare
	'wgCdnServersNoPurge' => [
		'default' => [
			// bast161
			'[2602:294:0:b13::101]',
			// bast181
			'[2602:294:0:b12::102]',
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
	'wgWebAuthnRelyingPartyName' => [
		'default' => 'Miraheze',
		'mirabeta' => 'mirabeta',
	],
	'wgWebAuthnRelyingPartyID' => [
		'default' => 'miraheze.org',
		'mirabeta' => 'mirabeta.org',
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

	// WikiDiscover
	'wgWikiDiscoverUseDescriptions' => [
		'default' => true,
	],

	// WikimediaIncubator
	'wmincProjects' => [
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
		'snxyzincubatorwiki' => [
			'k' => [
				'name' => 'Cookie Run: Kingdom Wiki',
				'dbsuffix' => 'crk',
				'wikitag' => 'cookierunkingdom',
				'sister' => false,
			],
			'c' => [
				'name' => 'Cookie Run Wiki',
				'dbsuffix' => 'cr',
				'wikitag' => 'cookierun',
				'sister' => false,
			],
		],
	],
	'wmincProjectSite' => [
		'default' => [
			'name' => 'Incubator Plus 2.0',
			'short' => 'incplus',
		],
		'snxyzincubatorwiki' => [
			'name' => 'Pisces\'s Incubator',
			'short' => 'pi',
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
	'wmincTestWikiNamespaces' => [
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
		'idiotpediaincubatorwiki' => [
			NS_MAIN,
			NS_TALK,
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
	'wgAlexaSiteVerificationKey' => [
		'default' => false,
	],
	'wgPinterestSiteVerificationKey' => [
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
		'default' => false,
	],
	'wgWikiSeoTryCleanAutoDescription' => [
		'default' => false,
	],
	'wgMetadataGenerators' => [
		'default' => '',
		'gratispaideiawiki' => [
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
	'wgRandomGameDisplay' => [
		'default' => [
			'random_picturegame' => false,
			'random_poll' => false,
			'random_quiz' => false,
		],
	],
	'wgForceHTTPS' => [
		'default' => true,
	],

	// Logging configuation (Graylog)
	'wmgLogToDisk' => [
		'default' => false,
	],
	'wmgMonologChannels' => [
		'default' => [
			'404' => 'debug',
			'AbuseFilter' => false,
			'ActionFactory' => false,
			'antispoof' => false,
			'api' => 'warning',
			'api-feature-usage' => false,
			'api-readonly' => false,
			'api-request' => [ 'graylog' => 'debug', 'eventbus' => 'debug', 'buffer' => true ],
			'api-warning' => false,
			'authentication' => 'info',
			'authevents' => 'info',
			'autoloader' => false,
			'BlockManager' => false,
			'BlogPage' => false,
			'BounceHandler' => false,
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
			'cirrussearch-request' => [ 'graylog' => false, 'eventbus' => 'debug', 'buffer' => true ],
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
			'DuplicateParse' => false,
			'dynamic-sidebar' => false,
			'editpage' => false,
			'Echo' => 'debug',
			'EditConflict' => 'error',
			'EditConstraintRunner' => 'error',
			'error' => 'debug',
			'error-json' => false,
			'EventBus' => [ 'graylog' => 'error' ],
			// Please make sure wgEventLoggingBaseUri is set before re-enabling this group
			'EventLogging' => false,
			'exception' => 'debug',
			'exception-json' => false,
			'exec' => 'debug',
			'export' => false,
			'ExternalStore' => false,
			'fatal' => 'debug',
			'FileImporter' => false,
			'FileOperation' => false,
			'Flow' => 'debug',
			'formatnum' => false,
			'FSFileBackend' => false,
			'gitinfo' => false,
			'GlobalTitleFail' => false,
			'GlobalWatchlist' => false,
			'headers-sent' => false,
			'http' => 'warning',
			'HitCounters' => false,
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
			'runJobs' => 'warning',
			'SaveParse' => false,
			'security' => 'debug',
			'session' => 'info',
			'session-ip' => 'info',
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
		'mirabeta' => false,
	],
];

// Start settings requiring external dependency checks/functions

if ( wfHostname() === 'test151' ) {
	// Prevent cache (better be safe than sorry)
	$wgConf->settings['wgUseCdn']['default'] = false;
}

// ManageWiki settings
require_once __DIR__ . '/ManageWikiExtensions.php';
$wi::$disabledExtensions = [
	// T10883
	'hitcounters',
	// T10882
	'regexfunctions',
	// T10871
	'wikiforum',
	// T10756
	'graph',
	// T11641
	'pageproperties',
	// T11970
	'drafts',
	// Broken, once again...
	'lingo',
];

if ( $wi->version >= '1.42' ) {
	array_push( $wi::$disabledExtensions, 'chameleon' );
	array_push( $wi::$disabledExtensions, 'evelution' );
	array_push( $wi::$disabledExtensions, 'femiwiki' );
	array_push( $wi::$disabledExtensions, 'snapwikiskin' );
	array_push( $wi::$disabledExtensions, 'tweeki' );
	// schema has changed in 1.42 into the mysql folder
	array_push( $wi::$disabledExtensions, 'urlshortener' );
}

$globals = MirahezeFunctions::getConfigGlobals();

// phpcs:ignore MediaWiki.Usage.ForbiddenFunctions.extract
extract( $globals );

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

$wgLocalisationCacheConf['storeClass'] = LCStoreCDB::class;
$wgLocalisationCacheConf['storeDirectory'] = '/srv/mediawiki/cache/' . $wi->version . '/l10n';
$wgLocalisationCacheConf['manualRecache'] = true;

if ( !file_exists( '/srv/mediawiki/cache/' . $wi->version . '/l10n/l10n_cache-en.cdb' ) ) {
	$wgLocalisationCacheConf['manualRecache'] = false;
}

if ( extension_loaded( 'wikidiff2' ) ) {
	$wgDiff = false;
}

// we set $wgInternalServer to $wgServer to get varnish cache purging working
// we convert $wgServer to http://, as varnish does not support purging https requests
$wgInternalServer = str_replace( 'https://', 'http://', $wgServer );

if ( $wgRequestTimeLimit ) {
	$wgHTTPMaxTimeout = $wgHTTPMaxConnectTimeout = $wgRequestTimeLimit;
}

// Include other configuration files
require_once '/srv/mediawiki/config/Database.php';
// require_once '/srv/mediawiki/config/EventBus.php';
require_once '/srv/mediawiki/config/EventStreamConfig.php';
require_once '/srv/mediawiki/config/GlobalCache.php';
require_once '/srv/mediawiki/config/GlobalLogging.php';
require_once '/srv/mediawiki/config/Sitenotice.php';
require_once '/srv/mediawiki/config/FileBackend.php';

if ( $wi->missing ) {
	require_once '/srv/mediawiki/ErrorPages/MissingWiki.php';
}

if ( $cwDeleted ) {
	if ( MW_ENTRY_POINT === 'cli' ) {
		wfHandleDeletedWiki();
	} else {
		define( 'MW_FINAL_SETUP_CALLBACK', 'wfHandleDeletedWiki' );
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
