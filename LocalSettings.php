<?php

/**
 * LocalSettings.php for Miraheze.
 * Authors of initial version: Southparkfan, John Lewis, Orain contributors
 */

// Configure PHP request timeouts.
if ( PHP_SAPI === 'cli' ) {
	$wgRequestTimeLimit = 0;
} elseif (
	( $_SERVER['HTTP_HOST'] ?? '' ) === 'mwtask1.miraheze.org' ||
	( $_SERVER['HTTP_HOST'] ?? '' ) === 'mwtask111.miraheze.org'
) {
	$wgRequestTimeLimit = 1200;
} elseif ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	$wgRequestTimeLimit = 200;
} else {
	$wgRequestTimeLimit = 60;
}

if ( $wmgProfiler ?? [] ) {
	$wgProfiler = $wmgProfiler;
	$wgHTTPTimeout = 10;
}

// Initialise WikiInitialise
require_once '/srv/mediawiki/w/extensions/CreateWiki/includes/WikiInitialise.php';
$wi = new WikiInitialise();

// Load PrivateSettings (e.g. $wgDBpassword)
require_once '/srv/mediawiki/config/PrivateSettings.php';

// Load global skins and extensions
require_once '/srv/mediawiki/config/GlobalSkins.php';
require_once '/srv/mediawiki/config/GlobalExtensions.php';

// Don't allow web access.
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wgPasswordSender = 'noreply@miraheze.org';

$wmgUploadHostname = 'static.miraheze.org';

$wi->setVariables(
	'/srv/mediawiki/cache',
	[
		'wiki'
	],
	[
		'miraheze.org' => 'wiki'
	],
	[
		'betaheze.org' => 'betaheze'
	]
);

$wi->config->settings += [

	// invalidates user sessions - do not change unless it is an emergency.
	'wgAuthenticationTokenVersion' => [
		'default' => '5',
	],

	// 3D
	'wg3dProcessor' => [
		'wmgUse3D' => [
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
		'betaheze' => 'betawiki',
	],
	'wgAbuseFilterIsCentral' => [
		'default' => false,
		'metawiki' => true,
		'betawiki' => true,
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

	// AddThis
	'wgAddThisHeader' => [
		'wmgUseAddThis' => false,
	],

	// Anti-spam
	'wgAccountCreationThrottle' => [
		'default' => [
			[
				'count' => 1,
				'seconds' => 300,
			],
			[
				'count' => 5,
				'seconds' => 86400,
			],
		],
	],
	// https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SpamBlacklist#Block_list_syntax
	'wgBlacklistSettings' => [
		'default' => [
			'spam' => [
				'files' => [
					'https://meta.miraheze.org/w/index.php?title=Spam_blacklist&action=raw&sb_ver=1',
				],
			],
		],
		'betaheze' => [
			'spam' => [
				'files' => [
					'https://beta.betaheze.org/w/index.php?title=Spam_blacklist&action=raw&sb_ver=1',
				],
			],
		],
	],
	'wgLogSpamBlacklistHits' => [
		'default' => false,
		'metawiki' => true,
		'betaheze' => true,
	],
	'wgTitleBlacklistLogHits' => [
		'default' => false,
		'loginwiki' => true,
		'metawiki' => true,
		'betaheze' => true,
	],

	// ApprovedRevs
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
	'egApprovedRevsAutomaticApprovals' => [
		'default' => true,
	],

	// ArticleCreationWorkflow
	'wgArticleCreationLandingPage' => [
		'default' => 'Project:Article wizard',
	],
	'wgUseCustomLandingPageStyles' => [
		'default' => true,
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
	'wgPivotFeatures' => [
		'default' => [
			'showActionsForAnon' => true,
			'fixedNavBar' => false,
			'usePivotTabs' => false,
			'showHelpUnderTools' => true,
			'showRecentChangesUnderTools' => true,
			'wikiName' => $wi->sitename,
			'wikiNameDesktop' => $wi->sitename,
			'navbarIcon' => false,
			'preloadFontAwesome' => false,
			'showFooterIcons' => true,
			'addThisPUBID' => '',
			'useAddThisShare' => '',
			'useAddThisFollow' => '',
		],
		'+dmlwikiwiki' => [
			'showActionsForAnon' => true,
			'fixedNavBar' => false,
			'usePivotTabs' => true,
			'showHelpUnderTools' => true,
			'showRecentChangesUnderTools' => true,
			'wikiName' => 'DML Wiki',
			'wikiNameDesktop' => 'Welcome',
			'navbarIcon' => true,
			'preloadFontAwesome' => false,
			'showFooterIcons' => true,
			'addThisPUBID' => '',
			'useAddThisShare' => '',
			'useAddThisFollow' => '',
		],
		'+thegreatwarwiki' => [
			'showActionsForAnon' => true,
			'fixedNavBar' => true,
			'usePivotTabs' => true,
			'showHelpUnderTools' => false,
			'showRecentChangesUnderTools' => false,
			'wikiName' => $wi->sitename,
			'wikiNameDesktop' => 'The Great War 1914-1918',
			'navbarIcon' => false,
			'preloadFontAwesome' => false,
			'showFooterIcons' => true,
			'addThisPUBID' => '',
			'useAddThisShare' => '',
			'useAddThisFollow' => '',
		],
	],

	// Block
	'wgAutoblockExpiry' => [
		'default' => 86400, // 24 hours * 60 minutes * 60 seconds
	],
	'wgBlockAllowsUTEdit' => [
		'default' => true,
	],
	'wgEnableBlockNoticeStats' => [
		'default' => false,
	],
	'wgEnablePartialBlocks' => [
		'default' => true,
	],

	// Bot passwords
	'wgBotPasswordsDatabase' => [
		'default' => 'mhglobal',
		'betaheze' => 'betawiki',
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
	'wgPreprocessorCacheThreshold' => [
		'default' => false,
	],
	'wgResourceLoaderMaxage' => [
		'default' => [
			'versioned' => 12 * 60 * 60,
			'unversioned' => 5 * 60,
		],
	],
	'wgRevisionCacheExpiry' => [
		'default' => 0,
	],
	'wgEnableSidebarCache' => [
		'default' => false,
	],

	// Captcha
	'wgCaptchaClass' => [
		'default' => 'ReCaptchaNoCaptcha',
	],
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
		'+wmgUseWikiForum' => [
			'wikiforum' => true,
		],
	],
	'wgReCaptchaSendRemoteIP' => [
		'default' => false,
	],
	'wgReCaptchaSiteKey' => [
		'default' => '6LeR1msdAAAAAEMnmLm8lI0HMP5wFvYuQFdYX8NH',
	],
	'wgReCaptchaVersion' => [
		'default' => 'v3',
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
	'wgCategoryCollation' => [ // updateCollation.php should be ran after the change
		'default' => 'uppercase',
		'academiadesusarduwiki' => 'uca-fr',
		'holidayswiki' => 'numeric',
		'supermanwiki' => 'numeric',
		'wmgUseCategorySortHeaders' => 'CustomHeaderCollation',
	],
	'wgCategoryPagingLimit' => [
		'default' => 200,
	],
	'wgUseCategoryBrowser' => [
		'default' => false,
	],

	// CategoryTree
	'wgCategoryTreeDefaultMode' => [
		'default' => 0,
	],
	'wgCategoryTreeCategoryPageMode' => [
		'default' => 0,
	],

	// CentralAuth
	'wgCentralAuthAutoCreateWikis' => [
		'default' => [
			'loginwiki',
			'metawiki',
		],
		'betaheze' => [
			'betawiki',
		],
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
		'betaheze' => '.betaheze.org',
	],
	'wgCentralAuthCookiePrefix' => [
		'default' => 'centralauth_',
		'betaheze' => 'betacentralauth_',
	],
	'wgCentralAuthCreateOnView' => [
		'default' => true,
		'cwarswiki' => false,
		'nenawikiwiki' => false,
	],
	'wgCentralAuthDatabase' => [
		'default' => 'mhglobal',
		'betaheze' => 'testglobal',
	],
	'wgCentralAuthEnableGlobalRenameRequest' => [
		'default' => false,
		'metawiki' => true,
		'betawiki' => true,
	],
	'wgCentralAuthEnableUserMerge' => [
		'default' => false,
		'metawiki' => true,
		'betawiki' => true,
	],
	'wgCentralAuthLoginWiki' => [
		'default' => 'loginwiki',
		'betaheze' => 'betawiki',
	],
	'wgCentralAuthPreventUnattached' => [
		'default' => true,
	],
	'wgCentralAuthSilentLogin' => [
		'default' => true,
	],

	// CentralNotice
	'wgNoticeInfrastructure' => [
		'default' => false,
		'metawiki' => true,
		'betawiki' => true,
	],
	'wgCentralSelectedBannerDispatcher' => [
		'default' => 'https://meta.miraheze.org/w/index.php/Special:BannerLoader',
		'betaheze' => 'https://beta.betaheze.org/w/index.php/Special:BannerLoader',
	],
	'wgCentralBannerRecorder' => [
		'default' => 'https://meta.miraheze.org/w/index.php/Special:RecordImpression',
		'betaheze' => 'https://beta.betaheze.org/w/index.php/Special:RecordImpression',
	],
	'wgCentralDBname' => [
		'default' => 'metawiki',
		'betaheze' => 'betawiki',
	],
	'wgCentralHost' => [
		'default' => 'https://meta.miraheze.org',
		'betaheze' => 'https://beta.betaheze.org',
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

	// Chameleon
	'egChameleonLayoutFile' => [
		'default' => '/srv/mediawiki/w/skins/chameleon/layouts/standard.xml',
		'lakehubwiki' => '/srv/mediawiki/w/skins/chameleon/layouts/fixedhead.xml',
		'koopacabanawiki' => '/srv/mediawiki/w/skins/chameleon/layouts/navhead.xml',
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
		'betaheze' => 'betawiki',
	],
	'wgCheckUserGBtoollink' => [
		'default' => [
			'centralDB' => 'metawiki',
			'groups' => [
				'steward',
			],
		],
		'betaheze' => [
			'centralDB' => 'betawiki',
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
		'betaheze' => [
			'centralDB' => 'betawiki',
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
	'wgCitizenShowPageTools' => [
		'default' => true,
	],
	'wgCitizenEnableDrawerSubSearch' => [
		'default' => false,
	],
	'wgCitizenPortalAttach' => [
		'default' => 'first',
	],
	'wgCitizenThemeColor' => [
		'default' => '#131a21',
	],

	// Comments
	'wgCommentsDefaultAvatar' => [
		'default' => '/w/extensions/SocialProfile/avatars/default_ml.gif',
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
	'wgContactConfig' => [
		'default' => [
			'default' => [
				'RecipientUser' => null,
				'SenderEmail' => $wgPasswordSender,
				'SenderName' => 'Miraheze No Reply',
				'RequireDetails' => true,
				'IncludeIP' => false, // Should never be set to true
				'MustBeLoggedIn' => false,
				'AdditionalFields' => [
					'Text' => [
						'label-message' => 'emailmessage',
						'type' => 'textarea',
						'rows' => 20,
						'required' => true,
					],
				],
				'DisplayFormat' => 'table',
				'RLModules' => [],
				'RLStyleModules' => [],
			],
		],
	],
	'wmgContactPageRecipientUser' => [
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
	'wgCookieDomain' => [
		'default' => '',
		'betaheze' => '.betaheze.org',
	],
	'wgCookieSameSite' => [
		'default' => 'None',
		'betaheze' => 'Strict',
	],
	'wgUseSameSiteLegacyCookies' => [
		'default' => true,
		'betaheze' => false,
	],
	'wgCookieSetOnAutoblock' => [
		'default' => true,
	],
	'wgCookieSetOnIpBlock' => [
		'default' => true,
	],

	// Cosmos
	'wgCosmosWordmark' => [
		'default' => false,
	],
	'wgCosmosBackgroundImage' => [
		'default' => false,
	],
	'wgCosmosBackgroundImageSize' => [
		'default' => 'cover',
	],
	'wgCosmosMainBackgroundColor' => [
		'default' => '#1A1A1A',
	],
	'wgCosmosContentBackgroundColor' => [
		'default' => '#ffffff',
	],
	'wgCosmosBannerBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosWikiHeaderBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosLinkColor' => [
		'default' => '#0645ad',
	],
	'wgCosmosButtonBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosToolbarBackgroundColor' => [
		'default' => '#000000',
	],
	'wgCosmosFooterBackgroundColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosEnablePortableInfoboxEuropaTheme' => [
		'default' => true,
	],
	'wgCosmosBackgroundImageRepeat' => [
		'default' => false,
	],
	'wgCosmosBackgroundImageFixed' => [
		'default' => true,
	],
	'wgCosmosContentWidth' => [
		'default' => 'default',
	],
	'wgCosmosUseWVUISearch' => [
		'default' => true,
	],
	'wgCosmosSearchUseActionAPI' => [
		'default' => true,
	],
	'wgCosmosSearchDescriptionSource' => [
		'default' => 'textextracts',
	],
	'wgCosmosMaxSearchResults' => [
		'default' => 6,
	],
	'wgCosmosSocialProfileModernTabs' => [
		'default' => true,
	],
	'wgCosmosSocialProfileRoundAvatar' => [
		'default' => true,
	],
	'wgCosmosSocialProfileShowEditCount' => [
		'default' => true,
	],
	'wgCosmosSocialProfileAllowBio' => [
		'default' => true,
	],
	'wgCosmosSocialProfileFollowBioRedirects' => [
		'default' => false,
	],
	'wgCosmosSocialProfileShowGroupTags' => [
		'default' => true,
	],
	'wgCosmosUseSocialProfileAvatar' => [
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
	'wgCosmosSocialProfileNumberofGroupTags' => [
		'default' => 2,
	],
	'wgCosmosContentOpacityLevel' => [
		'default' => 100,
	],
	'wgCosmosEnabledRailModules' => [
		'default' => [
			'recentchanges' => 'normal',
			'interface' => [
				'cosmos-custom-rail-module' => 'normal',
				'cosmos-custom-sticky-rail-module' => 'sticky',
			],
		],
		'+batfamilywiki' => [
			'recentchanges' => 0,
		],
		'+batmanwiki' => [
			'recentchanges' => 0,
		],
		'+devilmanwiki' => [
			'recentchanges' => 0,
		],
		'+dragontamerwiki' => [
			'recentchanges' => 0,
		],
		'+malwiki' => [
			'recentchanges' => 0,
		],
		'+snapwikiwiki' => [
			'recentchanges' => 0,
		],
		'+softcellwiki' => [
			'recentchanges' => 0,
		],
		'+thewhiteroomwiki' => [
			'recentchanges' => 0,
		],
	],
	'wgCosmosEnableWantedPages' => [
		'default' => false,
		'batmanwiki' => true,
		'snapwikiwiki' => true,
	],

	// CreateWiki
	'wgCreateWikiBlacklistedSubdomains' => [
		'default' => [
			'miraheze(.*)',
			'betaheze(.*)',
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
			'wikitech',
			'wikis?',
			'www',
			'security',
			'donate',
			'blog',
			'status',
			'sslhost',
			'sslrequest',
			'deployment',
			'hostmaster',
			'wildcard',
			'list',
			'localhost',
			'mailman',
			'webmail',
			'phabricator',
			'static',
			'matomo',
			'grafana',
			'icinga',
			'misc\d+',
			'db\d+',
			'cp\d+',
			'mw\d+',
			'jobrunner\d+',
			'gluster(fs)?\d+',
			'ns\d+',
			'bacula\d+',
			'mail(\d+)?',
			'ldap\d+',
			'cloud\d+',
			'mon\d+',
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
			'bast(\d+)?',
		],
	],
	'wgCreateWikiCannedResponses' => [
		'default' => [
			'Approval reasons' => [
				'Perfect request' => 'Perfect. Clear purpose, scope, and topic. Please be advised this approval does not preclude other wikis from being approved and created that share this topic, provided they aren\'t 95-100% content forks of your wiki. Please ensure your wiki complies with all aspects of Content Policy at all times. Thank you.',
				'Good request' => 'Pretty good. Purpose and description are a bit vague, but there is nonetheless a clear enough purpose, scope, and/or topic here. Please be advised this approval does not preclude other wikis from being approved and created that share this topic, provided they aren\'t 95-100% content forks of your wiki. Please ensure your wiki complies with all aspects of Content Policy at all times.',
				'Okay request' => 'Okay-ish. Description doesn\'t meet our requirements, but in this case the sitename, URL, and categorisation suggest this is a wiki that would follow the Content Policy made clear by the preceding fields, and it is conditionally approved as such. Please be advised that if your wiki deviates too much from this approval, remedial action can be taken by a Steward, if necessary, and that this approval does not preclude approval of similar wikis sharing this likely topic. Please ensure your wiki complies with all aspects of Content Policy at all times. Thank you.',
				'Categorised as private' => 'The purpose and scope of your wiki is clear enough. Please ensure your wiki complies with all aspects of the Content Policy at all times. Please also note that I have categorised your wiki as "Private". Thank you.',
			],
			'Decline reasons' => [
				'Needs more details' => 'Can you give us a few more details on the purpose for, scope of, and topic of your wiki, and briefly describe some of your wiki\'s content in approximately 2-3 sentences? Additionally can you elaborate on your wiki\'s scope and topical focus a bit further? A few sentences describing the scope of your wiki and the sort of content it will contain should be helpful. Please go back into your original request and add to, but do not replace, your existing description. Thank you.',
				'Invalid or unclear subdomain' => 'The scope and purpose of the wiki seem clear enough. However, your requested subdomain is either invalid, is too generic, conveys a Miraheze affiliation, or suggests the wiki is an English language or multilingual wiki when it is not. Please change it to something that better reflects your wiki\'s purpose and scope. Thank you.',
				'Use Public Test Wiki' => 'Please use Public Test Wiki, https://publictestwiki.com, to test the administrator and bureaucrat tools (as well as Miraheze since the wiki is hosted by us). You should review and follow all TestWiki:Policies, especially TestWiki:Testing policy and TestWiki:Main policy, reverting all tests you perform in the reverse order which you performed them. Request permissions at TestWiki:Request permissions. Thank you.',
				'Excessive requests' => 'Declining as you have requested an excessive amount of wikis. Thank you for your understanding. If you believe you have legitimate need for this amount of wikis, please reply to this request with a 2-3 sentence reasoning on why you need the wikis.',
				'Database exists (wiki still active)' => 'Wiki database name and subdomain already exist. Please visit the local wiki and contribute there. Please reach out to any local bureaucrat to request any permissions if you require them. If bureaucrats are not active on the wiki after a reasonable period of time, please start a local election and ask a Steward to evaluate it on the Stewards\' noticeboard. Thanks.',
				'Database exists (wiki closed)' => 'Wiki database name already exists, but the wiki is closed. Please visit the requests for adoption page to request to reopen the wiki or ask for help on community noticeboard.',
				'Database exists (wiki already deleted)' => 'Wiki database name already exists, but the wiki itself has already been deleted in accordance with the Dormancy Policy. I will request a Steward to undelete it for you. When it has been undeleted and reopened, please visit the local wiki and ensure you make at least one edit or log action every 45 days. Wikis are only deleted after 6 months of complete inactivity; if you require a Dormancy Policy exemption, you should review the policy and request it once your wiki has at least 40-60 content pages. Thank you.',
				'Duplicate request' => 'Declining as a duplicate request, which needs more information. Please do not edit this request and instead go back into your original request. Also, please do not submit duplicate requests. Thank you.',
				'Content Policy (unsubstantiated insult)' => 'Declining per Content Policy provision, "Miraheze does not host wikis with the sole purpose to spread unsubstantiated insult, hate or rumours against a person or group of people." Thank you for understanding.',
				'Content Policy (makes it difficult for other wikis)' => 'Declining per Content Policy provision, "A wiki must not create problems which make it difficult for other wikis." Thank you for understanding.',
				'Content Policy (commercial activity)' => 'Declining per Content Policy provision, "The primary purpose of your wiki cannot be for commercial activity." Thank you for understanding. If in error, please edit this wiki request and articulate a clearer purpose and scope for your wiki that makes it clear how this wiki would not violate this criterion of Content Policy.',
				'Content Policy (illegal UK activity)' => 'Declining per Content Policy provision, "Miraheze does not host any content that is illegal in the United Kingdom." Thank you for understanding. If you believe this decline reason was used incorrectly, please address this with the declining wiki creator on their user talk page first before escalating your concern to the Stewards\' noticeboard. Thank you.',
				'Duplicate wiki' => 'Your proposed wiki appears to duplicate, either substantially or entirely, the content of an existing wiki (see the "Request Comments" tab for one or more link(s) to the existing wiki(s)). Could you please describe in a few more sentences by adding to, but not replacing, your existing description, the scope and focus for your wiki, and also assure us that your wiki will not be a complete or substantial duplication? Thank you.',
				'Author request' => 'Declined at the request of the wiki requester.',
			],
			'On hold reasons' => [
				'On hold pending response' => 'On hold pending response from the wiki requester (see the "Request Comments" tab). Please reply to the questions left by the wiki creator on this request but do not create another wiki request. Thank you.',
				'On hold pending review' => 'On hold pending review from another wiki creator or steward. Please do not resubmit this request.',
			],
		],
	],
	'wgCreateWikiCustomDomainPage' => [
		'default' => 'Special:MyLanguage/Custom_domains',
	],
	'wgCreateWikiDatabase' => [
		'default' => 'mhglobal',
	],
	'wgCreateWikiDatabaseClusters' => [
		'default' => [
			'c2',
			'c3',
			'c4',
		]
	],
	// Use if you want to stop wikis being created on this cluster
	'wgCreateWikiDatabaseClustersInactive' => [
		'default' => [
			'c1',
		]
	],
	'wgCreateWikiGlobalWiki' => [
		'default' => 'metawiki',
	],
	'wgCreateWikiEmailNotifications' => [
		'default' => true,
	],
	'wgCreateWikiNotificationEmail' => [
		'default' => 'sre@miraheze.org',
	],
	'wgCreateWikiPersistentModelFile' => [
		'default' => '/mnt/mediawiki-static/requestmodel.phpml'
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
			"$IP/extensions/AbuseFilter/db_patches/mysql/abusefilter.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/BetaFeatures/sql/tables-generated.sql",
			"$IP/extensions/CheckUser/cu_log.sql",
			"$IP/extensions/CheckUser/cu_changes.sql",
			"$IP/extensions/DataDump/sql/data_dump.sql",
			"$IP/extensions/Echo/echo.sql",
			"$IP/extensions/GlobalBlocking/sql/mysql/tables-generated-global_block_whitelist.sql",
			"$IP/extensions/OAuth/schema/OAuth.sql",
			"$IP/extensions/RottenLinks/sql/rottenlinks.sql",
			"$IP/extensions/UrlShortener/schemas/tables-generated.sql",
		],
	],
	'wgCreateWikiStateDays' => [
		'default' => [
			'inactive' => 45,
			'closed' => 15,
			'removed' => 120,
			'deleted' => 14
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
	'wgCreateWikiUseJobQueue' => [
		'default' => true,
	],

	// CookieWarning
	'wgCookieWarningMoreUrl' => [
		'default' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Privacy_Policy#4._Cookies',
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
	'wgCompressRevisions' => [
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
	'wgSharedTables' => [
		'default' => [],
	],

	// Delete
	'wgDeleteRevisionsLimit' => [
		'default' => '1000', // databases don't have much memory - let's not overload them in future - set to 1,000 T5287
	],

	// DiscordNotifications
	'wgDiscordFromName' => [
		'default' => '',
	],
	'wgDiscordAvatarUrl' => [
		'default' => '',
	],
	'wgDiscordShowNewUserEmail' => [
		'default' => false,
	],
	'wgDiscordShowNewUserIP' => [
		'default' => false,
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
	'wgDiscordNotificationsShowSuppressed' => [
		'default' => false,
	],
	'wgDiscordNotificationWikiUrl' => [
		'default' => '',
	],
	'wgDiscordNotificationBlockedUser' => [
		'default' => true,
	],
	'wgDiscordNotificationNewUser' => [
		'default' => true,
	],
	'wgDiscordShowNewUserFullName' => [
		'default' => false,
	],
	'wgDiscordAdditionalIncomingWebhookUrls' => [
		'default' => [],
	],
	'wgDiscordIncomingWebhookUrl' => [
		'default' => '',
	],

	// Description2
	'wgEnableMetaDescriptionFunctions' => [
		'wmgUseDescription2' => true,
	],

	// DismissableSiteNotice
	'wgDismissableSiteNoticeForAnons' => [
		'default' => true,
	],

	// Display Title
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
		'betaheze' => 'beta',
	],
	'wgEchoSharedTrackingDB' => [
		'default' => 'metawiki',
		'betaheze' => 'betawiki',
	],
	'wgEchoUseCrossWikiBetaFeature' => [
		'default' => true,
	],
	'wgEchoMentionStatusNotifications' => [
		'default' => true,
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

	// HTTP
	'wgHTTPConnectTimeout' => [
		'default' => 3.0,
	],
	'wgHTTPTimeout' => [
		'default' => 20,
	],

	// DataDump
	'wgDataDump' => [
		'default' => []
	],
	'wgDataDumpDirectory' => [
		'default' => "/mnt/mediawiki-static/{$wi->dbname}/dumps/",
	],
	'wgDataDumpDownloadUrl' => [
		'default' => "https://static.miraheze.org/{$wi->dbname}/dumps/\${filename}",
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
			'status' => [
				'levels' => 2,
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
			'status' => [
				'review' => 1,
				'autoreview' => 1,
			],
		],
	],
	'wgFlaggedRevsTagsAuto' => [
		'default' => [
			'status' => 1,
		],
	],
	'wgFlaggedRevsAutopromote' => [
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
	],
	'wgFlaggedRevsAutoReview' => [
		'default' => 3,
	],
	'wgFlaggedRevsRestrictionLevels' => [
		'default' => [
			'',
			'sysop'
		],
	],
	'wgSimpleFlaggedRevsUI' => [
		'default' => true,
	],
	'wgFlaggedRevsLowProfile' => [
		'default' => true,
	],

	// Footers
	'+wgFooterIcons' => [
		'default' => [
			'poweredby' => [
				'miraheze' => [
					'src' => "https://$wmgUploadHostname/commonswiki/f/ff/Powered_by_Miraheze.svg",
					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
					'alt' => 'Hosted by Miraheze'
				]
			]
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
	'wgCopyUploadsFromSpecialUpload' => [
		'default' => false,
	],
	'wgGenerateThumbnailOnParse' => [
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
		],
	],
	'wgUseInstantCommons' => [
		'default' => true,
	],
	'wgMaxImageArea' => [
		'default' => '1.25e7',
	],
	'wgMaxAnimatedGifArea' => [
		'default' => '1.25e7',
	],
	'wgMirahezeCommons' => [
		'default' => true,
	],
	// Only the board and SRE are allowed access
	// DO NOT ADD UNAUTHORISED USERS
	'wgMirahezeStaffAccessIds' => [
		'default' => [
			1, // John (SRE)
			19, // Reception123 (SRE)
			5258, // Void (SRE and Board)
			13554, // Paladox (SRE)
			24689, // RobLa (Board)
			243629, // RhinosF1 (SRE)
			73651, // Owen (Board)
			96304, // Universal Omega (SRE)
			2639, // Agent Isai (SRE)
		],
	],
	'wgMirahezeSurveyEnabled' => [
		'default' => false,
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
	],
	'wgSVGConverter' => [
		'default' => 'ImageMagick',
	],
	'wgUploadMissingFileUrl' => [
		'default' => false,
	],
	'wgUploadNavigationUrl' => [
		'default' => false,
	],

	// Foreground
	'wgForegroundFeatures' => [
		'default' => [],
		'egoishwiki' => [
			'showActionsForAnon' => false,
			'NavWrapperType' => 'divonly',
			'showHelpUnderTools' => false,
			'showRecentChangesUnderTools' => true,
			'enableTabs' => true,
			'wikiName' => '',
			'navbarIcon' => true,
			'IeEdgeCode' => 1,
			'showFooterIcons' => 0,
			'addThisFollowPUBID' => ''
		],
		'marionetworkwiki' => [
			'enableTabs' => true,
			'navbarIcon' => true,
			'showFooterIcons' => true,
			'wikiName' => ''
		],
		'rotompediawiki' => [
			'navbarIcon' => true,
		]
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
		'dcmultiversewiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'packed',
		],
		'theboyswiki' => [
			'imagesPerRow' => 0,
			'imageWidth' => 120,
			'imageHeight' => 120,
			'captionLength' => true,
			'showBytes' => true,
			'showDimensions' => true,
			'mode' => 'packed',
		],
	],

	// GlobalBlocking
	'wgApplyGlobalBlocks' => [
		'default' => true,
		'metawiki' => false,
	],
	'wgGlobalBlockingDatabase' => [
		'default' => 'mhglobal', // use mhglobal for global blocks
		'betaheze' => 'testglobal',
	],

	// GlobalCssJs
	'wgGlobalCssJsConfig' => [
		'default' => [
			'wiki' => 'metawiki',
			'source' => 'metawiki',
		],
		'betaheze' => [
			'wiki' => 'betawiki',
			'source' => 'betawiki',
		],
	],
	'+wgResourceLoaderSources' => [
		'default' => [
			'metawiki' => [
				'apiScript' => '//meta.miraheze.org/w/api.php',
				'loadScript' => '//meta.miraheze.org/w/load.php',
			],
		],
		'betaheze' => [
			'betawiki' => [
				'apiScript' => '//beta.betaheze.org/w/api.php',
				'loadScript' => '//beta.betaheze.org/w/load.php',
			],
		],
	],
	'wgUseGlobalSiteCssJs' => [
		'default' => false,
	],

	// GlobalPreferences
	'wgGlobalPreferencesDB' => [
		'default' => 'mhglobal',
		'betaheze' => 'testglobal',
	],

	// GlobalUsage
	'wgGlobalUsageDatabase' => [
		'default' => 'commonswiki',
		'tuscriaturaswiki' => 'intercriaturaswiki',
		'yourcreatureswiki' => 'intercriaturaswiki',
		'intercriaturaswiki' => 'intercriaturaswiki',
	],

	// GlobalUserPage
	'wgGlobalUserPageAPIUrl' => [
		'default' => 'https://login.miraheze.org/w/api.php',
		'betaheze' => 'https://beta.betaheze.org/w/api.php',
	],
	'wgGlobalUserPageDBname' => [
		'default' => 'loginwiki',
		'betaheze' => 'betawiki',
	],

	// Grant Permissions for BotPasswords and OAuth
	'+wgGrantPermissions' => [
		'default' => [
			'basic' => [
				'user' => true,
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

	// Image Limits
	'wgImageLimits' => [
		'default' => [
			[ 320, 240 ],
			[ 640, 480 ],
			[ 800, 600 ],
			[ 1024, 768 ],
			[ 1280, 1024 ],
			[ 2560, 2048 ],
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
	],
	'wgIncidentReportingServices' => [
		'default' => [
			'Bacula' => 'https://meta.miraheze.org/wiki/Tech:Bacula',
			'DNS' => 'https://meta.miraheze.org/wiki/Tech:DNS',
			'Ganglia' => 'https://meta.miraheze.org/wiki/Tech:Ganglia',
			'Grafana' => 'https://meta.miraheze.org/wiki/Tech:Grafana',
			'Icinga' => 'https://meta.miraheze.org/wiki/Tech:Icinga',
			'LizardFS' => 'https://meta.miraheze.org/wiki/Tech:Lizardfs',
			'Mail' => 'https://meta.miraheze.org/wiki/Tech:Mail',
			'MariaDB' => 'https://meta.miraheze.org/wiki/Tech:MariaDB',
			'Matomo' => 'https://meta.miraheze.org/wiki/Tech:Matomo',
			'MediaWiki' => 'https://meta.miraheze.org/wiki/Tech:MediaWiki_appserver',
			'Memcached' => 'https://meta.miraheze.org/wiki/Tech:Memcached',
			'NFS' => 'https://meta.miraheze.org/wiki/Tech:NFS',
			'NGINX' => 'https://meta.miraheze.org/wiki/Tech:Nginx',
			'Parsoid' => 'https://meta.miraheze.org/wiki/Tech:Parsoid',
			'Phabricator' => 'https://meta.miraheze.org/wiki/Tech:Phabricator',
			'Puppet Server' => 'https://meta.miraheze.org/wiki/Tech:Puppet',
			'Redis' => 'https://meta.miraheze.org/wiki/Tech:Redis',
			'Salt' => 'https://meta.miraheze.org/wiki/Tech:Salt',
			'Service Providers' => false,
			'Varnish' => 'https://meta.miraheze.org/wiki/Tech:Varnish',
		],
	],
	'wgIncidentReportingTaskUrl' => [
		'default' => 'https://phabricator.miraheze.org/',
	],

	// Interwiki
	'wgEnableScaryTranscluding' => [
		'default' => true,
	],
	'wgInterwikiCentralDB' => [
		'default' => 'metawiki',
		'betaheze' => 'betawiki',
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
		'default' => [],
		'isvwiki' => [
			'isv' => 'Medžuslovjansky / Меджусловјанскы',
		],
	],

	// Imports
	'wgImportSources' => [
		'default' => [
			'meta',
			'loginwiki',
			'mw',
			'templatewiki',
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
		'+hypixelwiki' => [
			'hypixelwikifandom',
		],
		'+incubatorwiki' => [
			'wmincubator',
			'wikiaincubatorplus',
		],
		'+memedatawiki' => [
			'd',
			'fd',
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

	// JavascriptSlideshow
	'wgHtml5' => [
		'wmgUseJavascriptSlideshow' => true,
	],

	// Job Queue
	'wgJobRunRate' => [
		'default' => 0,
	],

	// JsonConfig
	'wgJsonConfigEnableLuaSupport' => [
		'default' => true,
	],
	'wgJsonConfigs' => [
		'default' => [
			'Map.JsonConfig' => [
				'namespace' => 486,
				'nsName' => 'Data',
				// page name must end in ".map", and contain at least one symbol
				'pattern' => '/.\.map$/',
				'license' => 'CC-BY-SA 4.0',
				'isLocal' => false,
			],
			'Tabular.JsonConfig' => [
				'namespace' => 486,
				'nsName' => 'Data',
				// page name must end in ".tab", and contain at least one symbol
				'pattern' => '/.\.tab$/',
				'license' => 'CC-BY-SA 4.0',
				'isLocal' => false,
			],
		],
	],
	'wgJsonConfigInterwikiPrefix' => [
		'default' => 'commons',
		'commonswiki' => 'meta',
	],
	'wgJsonConfigModels' => [
		'default' => [
			'Map.JsonConfig' => 'JsonConfig\JCMapDataContent',
			'Tabular.JsonConfig' => 'JsonConfig\JCTabularContent',
		],
	],

	// Kartographer
	'wgKartographerWikivoyageMode' => [
		'default' => false,
	],
	'wgKartographerUseMarkerStyle' => [
		'default' => false,
	],
	'wgKartographerMapServer' => [
		'default' => 'https://tile.openstreetmap.org',
	],
	'wgKartographerDfltStyle' => [
		'default' => '.',
	],
	'wgKartographerSrcsetScales' => [
		'default' => false,
	],
	'wgKartographerStyles' => [
		'default' => [],
	],

	// Language
	'wgLanguageCode' => [
		'default' => 'en',
	],

	// LDAP
	'wgLDAPDomainNames' => [
		'ldapwikiwiki' => [
			'miraheze',
		],
	],
	'wgLDAPServerNames' => [
		'ldapwikiwiki' => [
			'miraheze' => 'ldap2.miraheze.org',
		],
	],
	'wgLDAPEncryptionType' => [
		'ldapwikiwiki' => [
			'miraheze' => 'ssl',
		],
	],
	'wgLDAPSearchAttributes' => [
		'ldapwikiwiki' => [
			'miraheze' => 'uid',
		],
	],
	'wgLDAPBaseDNs' => [
		'ldapwikiwiki' => [
			'miraheze' => 'dc=miraheze,dc=org',
		],
	],
	'wgLDAPUserBaseDNs' => [
		'ldapwikiwiki' => [
			'miraheze' => 'ou=people,dc=miraheze,dc=org',
		],
	],
	'wgLDAPProxyAgent' => [
		'ldapwikiwiki' => [
			'miraheze' => 'cn=write-user,dc=miraheze,dc=org',
		],
	],
	'wgLDAPProxyAgentPassword' => [
		'ldapwikiwiki' => [
			'miraheze' => $wmgLdapPassword,
		],
	],
	'wgLDAPWriterDN' => [
		'ldapwikiwiki' => [
			'miraheze' => 'cn=write-user,dc=miraheze,dc=org',
		],
	],
	'wgLDAPWriterPassword' => [
		'ldapwikiwiki' => [
			'miraheze' => $wmgLdapPassword,
		],
	],
	'wgLDAPWriteLocation' => [
		'ldapwikiwiki' => [
			'miraheze' => 'ou=people,dc=miraheze,dc=org',
		],
	],
	'wgLDAPAddLDAPUsers' => [
		'ldapwikiwiki' => [
			'miraheze' => true,
		],
	],
	'wgLDAPUpdateLDAP' => [
		'ldapwikiwiki' => [
			'miraheze' => true,
		],
	],
	'wgLDAPPasswordHash' => [
		'ldapwikiwiki' => [
			'miraheze' => 'ssha',
		],
	],
	'wgLDAPPreferences' => [
		'ldapwikiwiki' => [
			'miraheze' => [
				'email' => 'mail',
				'realname' => 'givenName',
			],
		],
	],
	'wgLDAPUseFetchedUsername' => [
		'ldapwikiwiki' => [
			'miraheze' => true,
		],
	],
	'wgLDAPLowerCaseUsernameScheme' => [
		'ldapwikiwiki' => [
			'miraheze' => false,
			'invaliddomain' => false,
		],
	],
	'wgLDAPLowerCaseUsername' => [
		'ldapwikiwiki' => [
			'miraheze' => false,
			'invaliddomain' => false,
		],
	],
	'wgLDAPOptions' => [
		'ldapwikiwiki' => [
			'miraheze' => [
				'LDAP_OPT_X_TLS_CACERTFILE' => '/etc/ssl/certs/Sectigo.crt',
			],
		],
	],

	// License
	'wgRightsIcon' => [
		'default' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'constantnoblewiki' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/Freeculturalworks-pdbutton.svg',
		'jadtechwiki' => "https://$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'quyranesswiki' => "https://$wmgUploadHostname/quyranesswiki/0/03/Copyright.svg.png",
		'revitwiki' => "https://$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
		'taerelvariwiki' => "https://$wmgUploadHostname/taerelvariwiki/0/03/Copyright.svg.png",
	],
	'wgRightsPage' => [
		'default' => '',
		'constantnoblewiki' => 'Constant Noble:No rights reserved',
		'diavwiki' => 'Project:Copyrights',
		'dmlwikiwiki' => 'MediaWiki:Copyright',
		'quyranesswiki' => 'Project:Copyrights',
		'taerelvariwiki' => 'Project:Copyrights',
	],
	'wgRightsText' => [
		'default' => 'Creative Commons Attribution Share Alike',
		'connorjwatwiki' => 'Creative Commons Attribution-ShareAlike 2.5 Generic (CC BY-SA 2.5)',
		'constantnoblewiki' => 'CC0 1.0 Universal (CC0 1.0) Public Domain Dedication',
		'cvswiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'exlinkwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'exstatiowiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'googologywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'incubatorwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'isvwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'jadtechwiki' => 'Copyright © Jak and Daxter Technical Wiki. All rights reserved.',
		'militarywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'privadowiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'quyranesswiki' => '©2021 TheBurningPrincess (All Rights Reserved)',
		'rctwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'revitwiki' => '©2013-2021 by Lionel J. Camara (All Rights Reserved)',
		'reviwiki' => 'Creative Commons Attribution Share Alike',
		'taerelvariwiki' => '©2021 TheBurningPrincess (All Rights Reserved)',
		'tlhwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikidemocracywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikigrowthwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikilexiconwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'worldtrainwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
	],
	'wgRightsUrl' => [
		'default' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'connorjwatwiki' => 'https://creativecommons.org/licenses/by-sa/2.5',
		'constantnoblewiki' => 'https://creativecommons.org/publicdomain/zero/1.0/',
		'cvswiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'exlinkwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'exstatiowiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'googologywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'incubatorwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'isvwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'jadtechwiki' => 'https://jadtech.miraheze.org/wiki/MediaWiki:Copyright',
		'militarywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'privadowiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'quyranesswiki' => 'https://quyraness.miraheze.org/wiki/MediaWiki:Copyright',
		'rctwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr',
		'taerelvariwiki' => 'https://taerelvari.miraheze.org/wiki/MediaWiki:Copyright',
		'tlhwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'wikidemocracywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'wikigrowthwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
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
		'kaiwiki' => [ 'file://' ],
		'vtwiki' => [ 'discord://' ],
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
		'wmgUseLinter' => [
			/** localhost */
			'127.0.0.1' => true,
			'::1' => true,
			/** mw8 */
			'51.195.236.221' => true,
			'2001:41d0:800:178a::7' => true,
			/** mw9 */
			'51.195.236.222' => true,
			'2001:41d0:800:178a::8' => true,
			/** mw10 */
			'51.195.236.254' => true,
			'2001:41d0:800:1bbd::8' => true,
			/** mw11 */
			'51.195.236.255' => true,
			'2001:41d0:800:1bbd::10' => true,
			/** mw12 */
			'51.195.236.220' => true,
			'2001:41d0:800:178a::6' => true,
			/** mw13 */
			'51.195.236.251' => true,
			'2001:41d0:800:1bbd::5' => true,
			/** test3 */
			'51.195.236.247' => true,
			'2001:41d0:800:1bbd::14' => true,
			/** mw101 */
			'2a10:6740::6:107' => true,
			/** mw102 */
			'2a10:6740::6:108' => true,
			/** mw111 */
			'2a10:6740::6:206' => true,
			/** mw112 */
			'2a10:6740::6:207' => true,
			/** mw121 */
			'2a10:6740::6:308' => true,
			/** mw122 */
			'2a10:6740::6:309' => true,
			/** test101 */
			'2a10:6740::6:109' => true,
		],
	],

	// Loops
	'egLoopsCountLimit' => [
		'default' => 100,
		'constantnoblewiki' => 200,
		'dragontamerwiki' => 300,
	],

	// Mail
	'wgEnableEmail' => [
		'default' => true,
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
	],
	'wgEmergencyContact' => [
		'default' => 'noreply@miraheze.org',
	],
	'wgAllowHTMLEmail' => [
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
			'darkmode',
			'globaluserpage',
			'minervaneue',
			'mobilefrontend',
			'purge',
			'syntaxhighlight_geshi',
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
	],
	'wgManageWikiPermissionsAdditionalRights' => [
		'default' => [
			'*' => [
				'autocreateaccount' => true,
				'read' => true,
				'oathauth-enable' => true,
				'editmyprivateinfo' => true,
				'viewmyprivateinfo' => true,
				'writeapi' => true,
			],
			'checkuser' => [
				'checkuser' => true,
				'checkuser-log' => true,
			],
			'interwiki-admin' => [
				'interwiki' => true
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
			'steward' => [
				'centralauth-usermerge' => true,
				'usermerge' => true,
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
		'+jacksonheightswiki' => [
			'emailconfirmed' => [
				'read' => true,
			],
		],
		'+ldapwikiwiki' => [
			'sysop' => [
				'managewiki-restricted' => true,
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
			'confirmed' => [
				'mwoauthproposeconsumer' => true,
				'mwoauthupdateownconsumer' => true,
			],
			'globalsysop' => [
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
		'+moviepediawiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'founder' => [
				'founder' => true,
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
		'+sesupportwiki' => [
			'editor' => [
				'editor' => true,
			],
			'sysop' => [
				'editor' => true,
			],
		],
		'+testwiki' => [
			'consul' => [
				'consul' => true,
				'bureaucrat' => true,
			],
			'bureaucrat' => [
				'bureaucrat' => true,
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
		'+wmgUseFlow' => [
			'oversight' => [
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
	],
	'wgManageWikiPermissionsBlacklistRights' => [
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
				'centralauth-oversight',
				'centralauth-rename',
				'centralauth-unmerge',
				'centralauth-usermerge',
				'checkuser',
				'checkuser-log',
				'createwiki',
				'editincidents',
				'editothersprofiles-private',
				'flow-suppress',
				'generate-random-hash',
				'globalblock',
				'globalblock-exempt',
				'globalgroupmembership',
				'globalgrouppermissions',
				'handle-pii',
				'hideuser',
				'interwiki',
				'investigate',
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
				'requestwiki',
				'siteadmin',
				'stopforumspam',
				'suppressionlog',
				'suppressrevision',
				'themedesigner',
				'titleblacklistlog',
				'updatepoints',
				'usermerge',
				'userrights',
				'userrights-interwiki',
				'viewglobalprivatefiles',
				'viewpmlog',
				'viewsuppressed',
				'writeapi',
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
				'ipblock-exempt',
				'viewmyprivateinfo',
				'viewmywatchlist',
				'managewiki',
			],
		],
	],
	'wgManageWikiPermissionsBlacklistGroups' => [
		'default' => [
			'checkuser',
			'oversight',
			'steward',
			'staff',
			'interwiki-admin',
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
	'egMapsAvailableServices' => [
		'default' => [
			'leaflet',
		],
	],
	'egMapsDefaultService' => [
		'wmgUseMaps' => 'leaflet',
	],
	'egMapsDisableSmwIntegration' => [
		'wmgUseMaps' => true,
	],

	// MassMessage
	'wgAllowGlobalMessaging' => [
		'default' => false,
		'metawiki' => true,
		'betawiki' => true,
	],

	// MatomoAnalytics
	'wgMatomoAnalyticsDatabase' => [
		'default' => 'mhglobal',
	],
	'wgMatomoAnalyticsServerURL' => [
		'default' => 'https://matomo.miraheze.org/',
	],
	'wgMatomoAnalyticsUseDB' => [
		'default' => true,
	],
	'wgMatomoAnalyticsSiteID' => [
		'default' => 8590,
	],
	'wgMatomoAnalyticsGlobalID' => [
		'default' => 8590,
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

	// Miscellaneous
	'wgSitename' => [
		'default' => 'No sitename set!',
	],
	'wgAllowDisplayTitle' => [
		'default' => true,
	],
	'wgRestrictDisplayTitle' => [
		'default' => true,
		'wmgUseNoTitle' => false,
	],
	'wgCapitalLinks' => [
		'default' => true,
	],
	'wgActiveUserDays' => [
		'default' => 30,
	],
	'wgEnableCanonicalServerLink' => [
		'default' => false,
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
		'default' => '/srv/mediawiki/cache/gitinfo',
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
		'+wmgUse3D' => [
			'application/sla',
		],
	],
	'wgNativeImageLazyLoading' => [
		'default' => false,
	],
	'wgShellRestrictionMethod' => [
		'default' => 'firejail',
	],
	'wgCrossSiteAJAXdomains' => [
		'default' => [
			'login.miraheze.org',
			'meta.miraheze.org',
		],
		'betaheze' => [
			'beta.betaheze.org',
		],
	],
	'wgTidyConfig' => [
		'default' => [
			'driver' => 'RemexHtml',
			'pwrap' => false,
		],
	],
	'wmgWhitelistRead' => [
		'default' => false,
	],

	// MobileFrontend
	'wgMFAutodetectMobileView' => [
		'default' => false,
	],
	'wgDefaultMobileSkin' => [
		'default' => 'minerva',
	],
	'wgMobileUrlTemplate' => [
		'default' => '',
	],
	'wgMFMobileHeader' => [
		'wmgUseMobileFrontend' => 'X-Subdomain',
	],
	'wgMFNoindexPages' => [
		'wmgUseMobileFrontend' => false,
	],
	'wgMFStopRedirectCookieHost' => [
		'wmgUseMobileFrontend' => $wi->hostname,
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

	// Moderation extension settings
	// Enable or disable notifications.
	'wgModerationNotificationEnable' => [
		'default' => false,
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

	// MultimediaViewer (not beta)
	'wgMediaViewerEnableByDefault' => [
		'default' => true,
	],

	// MobileFrontend
	'wgMFNoMobilePages' => [
		'default' => [],
	],

	// Math
	'wgMathoidCli' => [
		'default' => [
			'/srv/mathoid/src/cli.js',
			'-c',
			'/etc/mathoid/config.yaml'
		]
	],
	'wgMathValidModes' => [
		'default' => [
			'mathml'
		],
	],

	// MultiBoilerplate
	'wgMultiBoilerplateDisplaySpecialPage' => [
		'vgportdbwiki' => true,
		'wmgUseMultiBoilerplate' => false,
	],
	'wgMultiBoilerplateOptions' => [
		'wmgUseMultiBoilerplate' => false,
	],
	'wgMultiBoilerplateOverwrite' => [
		'vgportdbwiki' => true,
		'wmgUseMultiBoilerplate' => false,
	],

	// New User Email Notification
	'wgNewUserNotifEmailTargets' => [
		'default' => [],
		'femmanwiki' => [
			'gustav@nyvell.net'
		],
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
	'wmgUsersNotifiedOnAllChanges' => [
		'default' => '',
	],

	// OATHAuth
	'wgOATHAuthDatabase' => [
		'default' => 'mhglobal',
		'ldapwikiwiki' => 'ldapwikiwiki',
		'betaheze' => 'testglobal',
	],

	// OAuth
	'wgMWOAuthCentralWiki' => [
		'default' => 'metawiki',
		'ldapwikiwiki' => false,
		'betaheze' => 'betawiki',
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
		'vgportdbwiki' => [
			NS_MAIN,
			3000,
			3004,
			3006,
		],
	],

	// Pagelang
	'wgPageLanguageUseDB' => [
		'default' => false,
	],

	// PageForms
	'wgPageFormsLinkAllRedLinksToForms' => [
		'default' => false,
		'frontierrpgwiki' => true,
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
	'+wgVirtualRestConfig' => [
		'wmgUseFlow' => [
			'modules' => [
				'parsoid' => [
					'url' => "{$wi->server}/w/rest.php",
					'domain' => $wi->server,
					'prefix' => $wi->dbname,
					'forwardCookies' => true,
					'restbaseCompat' => false,
					'timeout' => 15,
				],
			],
		],
		'wmgUseLinter' => [
			'modules' => [
				'parsoid' => [
					'url' => "{$wi->server}/w/rest.php",
					'domain' => $wi->server,
					'prefix' => $wi->dbname,
					'forwardCookies' => true,
					'restbaseCompat' => false,
					'timeout' => 15,
				],
			],
		],
		'wmgUseVisualEditor' => [
			'modules' => [
				'parsoid' => [
					'url' => "{$wi->server}/w/rest.php",
					'domain' => $wi->server,
					'prefix' => $wi->dbname,
					'forwardCookies' => true,
					'restbaseCompat' => false,
					'timeout' => 15,
				],
			],
		],
	],
	'wgParsoidSettings' => [
		'default' => [
			'useSelser' => true,
		],
		'+wmgUseLinter' => [
			'linting' => true,
		],
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
	'wgRevokePermissions' => [
		'default' => [],
		'+simulatorwiki' => [
			'moderated' => [
				'skip-moderation' => true,
			],
		],
		'+wmgUseMediaWikiChat' => [
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
					'MinimalPasswordLength' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
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
			'globalsysop' => [
				'MinimalPasswordLength' => [ 'value' => 12, 'suggestChangeOnLogin' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'interwiki-admin' => [
				'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'steward' => [
				'MinimalPasswordLength' => [ 'value' => 12, 'suggestChangeOnLogin' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'sysadmin' => [
				'MinimalPasswordLength' => [ 'value' => 12, 'suggestChangeOnLogin' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
				'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
				'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
			],
			'trustandsafety' => [
				'MinimalPasswordLength' => [ 'value' => 12, 'suggestChangeOnLogin' => true ],
				'MinimumPasswordLengthToLogin' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
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

	// Preferences
	'wmgDefaultUserOptions' => [
		'default' => [
			'enotifwatchlistpages' => 0,
			'math' => 'mathml',
			'usebetatoolbar' => 1,
			'usebetatoolbar-cgd' => 1,
		],
		'+bioencyclopediawiki' => [
			'usenewrc' => 0,
		],
		'+dcmultiversewiki' => [
			'usecodemirror' => 1,
			'visualeditor-newwikitext' => 1,
			'usebetatoolbar' => 0,
			'usebetatoolbar-cgd' => 0,
			'visualeditor-enable-experimental' => 1,
		],
		'+dmlwikiwiki' => [
			'imagesize' => 2,
		],
		'+isvwiki' => [
			'flow-topiclist-sortby' => 'newest',
		],
		'+nintendowiki' => [
			'rcenhancedfilters-disable' => 1,
			'usenewrc' => 0,
		],
		'+pokemon2wiki' => [
			'rcenhancedfilters-disable' => 1,
			'usenewrc' => 0,
		],
		'+reviwiki' => [
			'rcenhancedfilters-disable' => 1,
			'usenewrc' => 0,
		],
		'+smashbroswiki' => [
			'rcenhancedfilters-disable' => 1,
			'usenewrc' => 0,
		],
		'+solarawiki' => [
			'usecodemirror' => 1,
		],
		'+yablestudiowiki' => [
			'visualeditor-newwikitext' => 1,
			'visualeditor-tabs' => 'multi-tab',
		],
		'+wmgUseCleanChanges' => [
			'usenewrc' => 1,
		],
	],
	'wgHiddenPrefs' => [
		'default' => [],
	],

	// Preloader
	'wgPreloaderSource' => [
		'default' => [
			0 => 'Template:Boilerplate',
		],
	],

	// ProofreadPage
	'wgProofreadPageNamespaceIds' => [
		'wmgUseProofreadPage' => [
			'index' => 252,
			'page' => 250,
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
	'wmgRPRatingPageBlacklist' => [
		'default' => false,
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

	// RelatedArticles
	'wgRelatedArticlesFooterAllowedSkins' => [
		'default' => [
			'minerva',
			'timeless',
			'vector',
		],
	],
	'wgRelatedArticlesUseCirrusSearch' => [
		'wmgUseRelatedArticles' => false,
	],

	// RemovePII
	'wgRemovePIIHashPrefixOptions' => [
		'default' => [
			'Trust and Safety' => 'MirahezeGDPR_',
			'Stewards' => 'Vanished user ',
		],
	],
	'wgRemovePIIHashPrefix' => [
		'default' => 'MirahezeGDPR_',
	],
	'wgRemovePIIAllowedWikis' => [
		'default' => [
			'metawiki',
			'betawiki',
		],
	],

	// ReplaceText
	'wgReplaceTextResultsLimit' => [
		'default' => 250,
	],

	// Restriction types
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
		'+althistorywiki' => [
			'editrollbackprotected',
			'edittemplateprotected',
			'editrestrictedtemplateprotected',
			'editimportprotected',
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
			'bureaucrat',
			'editextendedconfirmedprotected',
		],
		'+hypotheticalhurricaneswiki' => [
			'editextendedconfirmedprotected',
			'editbureaucratprotected',
			'editleaderprotected',
		],
		'+igrovyesistemywiki' => [
			'trusted',
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		],
		'+lhmnwiki' => [
			'editqualityarticles',
			'editextendedconfirmedprotected',
		],
		'+memeswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+moviepediawiki' => [
			'bureaucrat',
			'founder',
		],
		'+naasgamelandwiki' => [
			'editarchiveprotected',
			'editofficialprotected',
		],
		'+nicolopediawiki' => [
			'edittemplateprotected',
		],
		'+sesupportwiki' => [
			'editor',
		],
		'+simulatorwiki' => [
			'edittemplate',
		],
		'+testwiki' => [
			'bureaucrat',
			'consul',
		],
		'+thesciencearchiveswiki' => [
			'templateeditor',
		],
		'+vnenderbotwiki' => [
			'template',
			'extendedconfirmed',
			'owner',
		],
		'+wmgUseAuthorProtect' => [
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
		'allpediawiki' => [
			'editextendedconfirmedprotected',
		],
		'althistorywiki' => [
			'editrollbackprotected',
			'edittemplateprotected',
			'editrestrictedtemplateprotected',
			'editimportprotected',
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
			'editextendedconfirmedprotected',
		],
		'hypotheticalhurricaneswiki' => [
			'editextendedconfirmedprotected',
			'editbureaucratprotected',
			'editleaderprotected',
		],
		'lhmnwiki' => [
			'editqualityarticles',
			'editextendeconfirmedprotected',
		],
		'memeswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'naasgamelandwiki' => [
			'editarchiveprotected',
			'editofficialprotected',
		],
		'nicolopediawiki' => [
			'edittemplateprotected',
		],
		'simulatorwiki' => [
			'editfragment',
			'edittemplate',
		],
		'+wmgUseSocialProfile' => [
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

	// Robot policy
	'wgDefaultRobotPolicy' => [
		'default' => 'index,follow',
	],
	'wgNamespaceRobotPolicies' => [
		'default' => [
			'NS_SPECIAL' => 'noindex',
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
	'wgRSSCacheAge' => [
		'default' => '3600'
	],
	'wgRSSProxy' => [
		'default' => false,
	],
	'wgRSSDateDefaultFormat' => [
		'default' => 'Y-m-d H:i:s'
	],
	'wgRSSUrlWhitelist' => [
		'wmgUseRSS' => [
			'*',
		],
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

	// Server
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
		'default' => 'https://miraheze.org',
		'betaheze' => 'https://betaheze.org',
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

	// Shell
	'wgMaxShellMemory' => [
		'default' => 2097152
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

	// Site notice pt out
	'wmgSiteNoticeOptOut' => [
		'default' => false,
	],

	// Skins
	'wgSkipSkins' => [
		'default' => [],
	],

	// SlackNotifications
	'wgSlackFromName' => [
		'default' => '',
	],
	'wgSlackNotificationWikiUrlEnding' => [
		'default' => 'index.php?title=',
	],
	'wgSlackNotificationWikiUrl' => [
		'default' => '',
	],
	'wgSlackShowNewUserEmail' => [
		'default' => false,
	],
	'wgSlackShowNewUserIP' => [
		'default' => false,
	],
	'wgSlackIncomingWebhookUrl' => [
		'default' => '',
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
			'articles' => true, // Blog
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
	// Download from https://www.stopforumspam.com/downloads (recommended listed_ip_30_all.zip)
	// for ipv4 + ipv6 combined.
	// TODO: Setup cron to update this automatically.
	'wgSFSIPListLocation' => [
		'default' => '/mnt/mediawiki-static/private/stopforumspam/listed_ip_30_ipv46_all.txt',
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
		'default' => '/usr/share/nginx/favicons/default.ico',
	],
	'wgDefaultSkin' => [
		'default' => 'vector',
	],
	'wgFallbackSkin' => [
		'default' => 'vector',
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

	// TemplateStyles
	'wgTemplateStylesAllowedUrls' => [
		'default' => [
			'audio' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/>',
				'<^(?:https:)?//static\\.miraheze\\.org/>',
			],
			'image' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/>',
				'<^(?:https:)?//static\\.miraheze\\.org/>',
			],
			'svg' => [
				'<^(?:https:)?//upload\\.wikimedia\\.org/wikipedia/commons/[^?#]*\\.svg(?:[?#]|$)>',
				'<^(?:https:)?//static\\.miraheze\\.org/[^?#]*\\.svg(?:[?#]|$)>',
			],
			'font' => [],
			'namespace' => [
				'<.>',
			],
			'css' => [],
		],
	],

	// TimedMediaHandler
	'wgFFmpegLocation' => [
		'default' => '/usr/bin/ffmpeg',
	],
	'wgFFmpeg2theoraLocation' => [
		'wmgUseTimedMediaHandler' => '/usr/bin/ffmpeg2theora',
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
				'src' => 'https://meta.miraheze.org/w/index.php?title=Title_blacklist&action=raw',
			],
			'local' => [
				'type' => 'localpage',
				'src' => 'MediaWiki:Titleblacklist',
			],
		],
		'betaheze' => [
			'global' => [
				'type' => 'url',
				'src' => 'https://beta.betaheze.org/w/index.php?title=Title_blacklist&action=raw',
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
	'wgTranslateBlacklist' => [
		'default' => [],
		'metawiki' => [
			'*' => [
				'en' => 'English is the source language.',
			],
		],
		'minecraftathomewiki' => [
			'*' => [
				'en-gb' => 'This variant of English is not allowed to be translated.',
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
	'wgTranslatePageTranslationULS' => [
		'default' => false,
	],
	'wgTranslateTranslationServices' => [
		'default' => [],
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

	// Uploads
	'wmgPrivateUploads' => [
		'default' => false,
		'ciptamediawiki' => true,
		'rhinosf1wiki' => true,
		'staffwiki' => true,
		'mikekilitterboxwiki' => true,
	],
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
		'wmgUseTranslate' => false,
		'wmgUseUniversalLanguageSelector' => false,
	],

	// UrlShortener
	'wgUrlShortenerTemplate' => [
		'default' => '/m/$1',
	],
	'wgUrlShortenerDBName' => [
		'default' => 'metawiki',
		'betaheze' => 'betawiki',
	],
	'wgUrlShortenerAllowedDomains' => [
		'default' => [
			'(.*\.)?miraheze\.org',
		],
		'betaheze' => [
			'(.*\.)?betaheze\.org',
		],
	],

	// UserFunctions
	'wgUFEnablePersonalDataFunctions' => [
		'default' => false, // DO NOT set to true under any circumstances --Reception123
	],

	// UserPageEditProtection
	'wgOnlyUserEditUserPage' => [
		'wmgUseUserPageEditProtection' => true,
	],

	// Varnish
	'wgUseCdn' => [
		'default' => true,
	],
	'wgCdnServers' => [
		'default' => [
			'51.195.220.68:81', // cp20
			'198.244.148.90:81', // cp21
			'149.56.140.43:81', // cp30
			'149.56.141.75:81', // cp31
		],
	],

	// Vector
	'wgVectorDefaultSkinVersion' => [
		'default' => '1',
	],
	'wgVectorDefaultSkinVersionForExistingAccounts' => [
		'default' => '1',
	],
	'wgVectorDefaultSkinVersionForNewAccounts' => [
		'default' => '1',
	],
	'wgVectorResponsive' => [
		'default' => false,
	],
	'wgVectorUseWvuiSearch' => [
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

	// VisualEditor
	'wmgVisualEditorEnableDefault' => [
		'default' => false,
		'wmgUseVisualEditor' => true,
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

	// ProtectSite
	'wgProtectSiteLimit' => [
		'default' => '1 week',
	],
	'wgProtectSiteDefaultTimeout' => [
		'default' => '1 hour',
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
	'wmincTestWikiNamespaces' => [
		'default' => [
			NS_MAIN, NS_TALK,
			NS_TEMPLATE, NS_TEMPLATE_TALK,
			NS_CATEGORY, NS_CATEGORY_TALK,
			828, 829 // NS_MODULE, NS_MODULE_TALK
		],
		'idiotpediaincubatorwiki' => [
			NS_MAIN, NS_TALK,
			NS_CATEGORY, NS_CATEGORY_TALK,
			828, 829 // NS_MODULE, NS_MODULE_TALK
		],
	],
	// WikiLove
	'wgWikiLoveGlobal' => [
		'wmgUseWikiLove' => true,
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
	'wgWikiSeoDisableLogoFallbackImage' => [
		'default' => false,
	],
	'wgWikiSeoEnableAutoDescription' => [
		'default' => false,
	],
	'wgWikiSeoTryCleanAutoDescription' => [
		'default' => false,
	],

	// CreateWiki Defined Special Variables
	'cwClosed' => [
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
			// When using this, use buffer.
			'api-request' => [ 'graylog' => 'debug', 'buffer' => true ],
			'api-warning' => false,
			'authentication' => false,
			'authevents' => false,
			'autoloader' => false,
			'BlockManager' => false,
			'BlogPage' => false,
			'BounceHandler' => false,
			'cache-cookies' => false,
			'caches' => false,
			'captcha' => 'debug',
			'cargo' => false,
			'CentralAuth' => 'debug',
			'CentralAuthRename' => false,
			'CentralAuthUserMerge' => false,
			'CentralAuthVerbose' => false,
			'CentralNotice' => false,
			'cite' => false,
			'ContentHandler' => false,
			'CookieWarning' => false,
			'cookie' => false,
			'CreateWiki' => 'debug',
			'DBConnection' => 'warning',
			'DBPerformance' => false,
			'DBQuery' => false,
			'DBReplication' => false,
			'DBTransaction' => false,
			'DeferredUpdates' => 'error',
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
			'EventLogging' => false,
			'EventStreamConfig' => false,
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
			'GettingStarted' => false,
			'gitinfo' => false,
			'GlobalTitleFail' => false,
			'GlobalWatchlist' => false,
			'headers-sent' => false,
			'http' => 'warning',
			'HttpError' => 'error', // Only log http errors with a 500+ code
			// 'JobExecutor' => [ 'logstash' => 'warning' ],
			'JobQueueRedis' => 'debug',
			'localisation' => false,
			'ldap' => 'warning',
			'Linter' => 'debug',
			'LocalFile' => 'warning',
			'localhost' => false,
			'LockManager' => false,
			'logging' => false,
			'LoginNotify' => false,
			'ManageWiki' => 'debug',
			'MassMessage' => false,
			'Math' => 'info',
			'MatomoAnalytics' => 'debug',
			'Mime' => false,
			'memcached' => [ 'graylog' => 'error' ], // Debug sprews too much information + sample (otherwise you'll get 2 million+ messages in a few minutes)
			'message-format' => false,
			'MessageCache' => false,
			'MessageCacheError' => false,
			'mobile' => false,
			'NewUserMessage' => false,
			'OAuth' => 'info',
			'objectcache' => false,
			'OldRevisionImporter' => false,
			'OutputBuffer' => false,
			'PageTriage' => false,
			'PageViewInfo' => false,
			'Parser' => false,
			'ParserCache' => false,
			'preferences' => false,
			'purge' => false,
			'query' => false,
			'ratelimit' => false,
			'readinglists' => false,
			'recursion-guard' => false,
			'RecursiveLinkPurge' => false,
			'redis' => [ 'graylog' => 'warning', 'sample' => 20 ], // Debug sprews too much information + sample (otherwise you'll get 2 million+ messages in a few minutes)
			'Renameuser' => 'debug',
			'resourceloader' => false,
			'ResourceLoaderImage' => false,
			'RevisionStore' => false,
			'runJobs' => 'warning',
			'SaveParse' => false,
			'security' => 'debug',
			'session' => 'info',
			'session-ip' => 'info',
			'SimpleAntiSpam' => false,
			'slow-parse' => 'debug',
			'slow-parsoid' => 'debug',
			'SocialProfile' => false,
			'SpamBlacklist' => false,
			'SpamBlacklistHit' => false,
			'SpamRegex' => false,
			'SQLBagOStuff' => false,
			'squid' => false,
			'StashEdit' => false,
			'T263581' => false,
			'texvc' => false,
			'throttler' => false,
			'thumbnail' => 'debug',
			'thumbnailaccess' => false,
			'TitleBlacklist' => false,
			'TitleBlacklist-cache' => false,
			'torblock' => false,
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
			'wfLogDBError' => 'debug', // Former $wgDBerrorLog
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
		'betaheze' => false,
	],

	// Email notifications on privileged actions configuration
	'wgMirahezeMagicLogEmailConditions' => [
		'default' => [
			'trustandsafety' => [
				'group' => 'trustandsafety',
				'email' => 'owen@miraheze.org',
			],
		],
	],
];

// Start settings requiring external dependency checks/functions
if ( !preg_match( '/^(.*)\.(miraheze|betaheze)\.org$/', $wi->hostname, $matches ) ) {
	$wi->config->settings['wgCentralAuthCookieDomain'][$wi->dbname] = $wi->hostname;
}

$wi->readCache();

// ManageWiki settings
require_once __DIR__ . '/ManageWikiExtensions.php';
$wi->disabledExtensions = [];

$wi->config->extractAllGlobals( $wi->dbname );
$wi->loadExtensions();

require_once __DIR__ . '/ManageWikiNamespaces.php';
require_once __DIR__ . '/ManageWikiSettings.php';

// Due to an issue with +wgDefaultUserOptions not allowing wiki overrides,
//we have to work around this by creating a local config and merging.
$wgDefaultUserOptions = array_merge( $wgDefaultUserOptions, $wmgDefaultUserOptions );

$wgUploadPath = "https://static.miraheze.org/$wgDBname";
$wgUploadDirectory = "/mnt/mediawiki-static/$wgDBname";

$wgLocalisationCacheConf['storeClass'] = LCStoreCDB::class;
$wgLocalisationCacheConf['storeDirectory'] = '/srv/mediawiki/cache/l10n';
$wgLocalisationCacheConf['manualRecache'] = true;

if ( !file_exists( '/srv/mediawiki/cache/l10n/l10n_cache-en.cdb' ) ) {
	$wgLocalisationCacheConf['manualRecache'] = false;
}

if ( extension_loaded( 'wikidiff2' ) ) {
	$wgDiff = false;
}

// Varnish

// We set wgInternalServer to wgServer as we need this to get purging working (we convert wgServer from https:// to http://).
// https://www.mediawiki.org/wiki/Manual:$wgInternalServer
$wgInternalServer = str_replace( 'https://', 'http://', $wgServer );

if ( $wgRequestTimeLimit ) {
	$wgHTTPMaxTimeout = $wgHTTPMaxConnectTimeout = $wgRequestTimeLimit;
}

// Include other configuration files
require_once '/srv/mediawiki/config/Database.php';
require_once '/srv/mediawiki/config/GlobalCache.php';
require_once '/srv/mediawiki/config/GlobalLogging.php';
require_once '/srv/mediawiki/config/Sitenotice.php';

if ( $wi->missing ) {
	require_once '/srv/mediawiki/ErrorPages/MissingWiki.php';
}

if ( in_array( wfHostname(), [ 'test3', 'test101' ] ) ) {
	// Prevent cache (better be safe than sorry)
	$wi->config->settings['wgUseCdn']['default'] = false;
}

// Define last to avoid all dependencies
require_once '/srv/mediawiki/config/Defines.php';
require_once '/srv/mediawiki/config/LocalWiki.php';

// Define last - Extension message files for loading extensions
if ( !defined( 'MW_NO_EXTENSION_MESSAGES' ) ) {
	require_once '/srv/mediawiki/config/ExtensionMessageFiles.php';
}

// Last Stuff
$wgConf = $wi->config;
unset( $wi );

$wgHooks['MediaWikiServices'][] = 'extractGlobals';

function extractGlobals() {
	global $wgConf, $wgDBname, $wgAPIModules;

	$wgConf->extractAllGlobals( $wgDBname );

	if ( isset( $wgAPIModules['commentlist'] ) ) {
		unset( $wgAPIModules['commentlist'] );
	}
}
