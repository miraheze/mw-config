<?php
/*
 * LocalSettings.php for Miraheze.
 * Authors of initial version: Southparkfan, John Lewis, Orain contributors
 */

// Initialise WikiInitialise
require_once( '/srv/mediawiki/w/extensions/CreateWiki/includes/WikiInitialise.php' );
$wi = new WikiInitialise();

// Load PrivateSettings (e.g. $wgDBpassword)
require_once( '/srv/mediawiki/config/PrivateSettings.php' );

// Load global skins and extensions
require_once( '/srv/mediawiki/config/GlobalSkins.php' );
require_once( '/srv/mediawiki/config/GlobalExtensions.php' );

// Don't allow web access.
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wgPasswordSender = 'noreply@miraheze.org';

$wmgUploadHostname = 'static.miraheze.org';

$wi->setVariables(
	'/srv/mediawiki/w/cache',
	[
		'wiki'
	],
	[
		'miraheze.org' => 'wiki'
	]
);

$wi->config->settings += [
	// invalidates user sessions - do not change unless it is an emergency.
	'wgAuthenticationTokenVersion' => [
		'default' => '4',
	],

	// 3D
	'wg3dProcessor' => [
		'wmgUse3D' => [ 
			'/usr/bin/xvfb-run',
			'-a',
			'-s',
			'-ac -screen 0 1280x1024x24',
			'/srv/3d2png/3d2png.js',
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
	],
	'wgAbuseFilterIsCentral' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgAbuseFilterBlockDuration' => [
		'default' => 'indefinte',
	],
	'wgAbuseFilterAnonBlockDuration' => [
		'default' => 2592000,
	],
	'wgAbuseFilterRestrictions' => [
		'default' => [
			'blockautopromote' => true,
			'block' => true,
			'degroup' => true,
			'rangeblock' => true,
		],
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

	// AddThis
	'wgAddThisHeader' => [
		'wmgUseAddThis' => false,	
	],

	// Anti-spam
	'wgAccountCreationThrottle' => [
		'default' => 5,
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
	],
	'wgLogSpamBlacklistHits' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgTitleBlacklistLogHits' => [
		'default' => false,
		'loginwiki' => true,
		'metawiki' => true,
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
			'useAddThisFollow' => ''
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
			'useAddThisFollow' => ''
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
	],

	// Cache
	'wgCacheDirectory' => [
		'default' => '/srv/mediawiki/w/cache',
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
	'wgReCaptchaSendRemoteIP' => [
		'default' => false,
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

	// Cargo
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
		'holidayswiki' => 'numeric',
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
		'cwarswiki' => false,
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

	// CentralNotice
	'wgNoticeInfrastructure' => [
		'default' => false,
		'metawiki' => true,
	],
	'wgCentralSelectedBannerDispatcher' => [
		'default' => "https://meta.miraheze.org/w/index.php/Special:BannerLoader",
	],
	'wgCentralBannerRecorder' => [
		'default' => "https://meta.miraheze.org/w/index.php/Special:RecordImpression",
	],
	'wgCentralDBname' => [
		'default' => 'metawiki',
	],
	'wgCentralHost' => [
		'default' => "https://meta.miraheze.org",
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

	// CheckUser
	'wgCheckUserForceSummary' => [
		'default' => true,
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

	// Citoid
	'wgCitoidFullRestbaseURL' => [
		'wmgUseCitoid' => "https://{$wi->hostname}/{$wi->hostname}/",
	],

	// Collection
	'wgCommunityCollectionNamespace' => [
		'wmgUseCollection' => 5,
	],
	'wgCollectionMWServeURL' => [
		'wmgUseCollection' => 'https://ocg-lb.miraheze.org',
	],
	'wgCollectionPODPartners' => [
		'wmgUseCollection' => [],
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

	// Cookies
	'wgCookieDomain' => [
		'default' => ''
	],
	'wgCookieSameSite' => [
		'default' => 'None'
	],
	'wgUseSameSiteLegacyCookies' => [
		'default' => true
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
	'wgCosmosProfileTagGroups' => [
		'default' => [
			'bureaucrat',
			'bot',
			'sysop',
			'interface-admin'
		],
	],
	'wgCosmosNumberofGroupTags' => [
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
		'batfamilywiki' => [
			'recentchanges' => false,
			'interface' => [
				'cosmos-custom-rail-module' => 'normal',
				'cosmos-custom-sticky-rail-module' => 'sticky',
			],
		],
		'batmanwiki' => [
			'recentchanges' => false,
			'interface' => [
				'cosmos-custom-rail-module' => 'normal',
				'cosmos-custom-sticky-rail-module' => 'sticky',
			],
		],
		'malwiki' => [
			'recentchanges' => false,
			'interface' => [
				'cosmos-custom-rail-module' => 'normal',
				'cosmos-custom-sticky-rail-module' => 'sticky',
			],
		],
		'snapwikiwiki' => [
			'recentchanges' => false,
			'interface' => [
				'cosmos-custom-rail-module' => 'normal',
				'cosmos-custom-sticky-rail-module' => 'sticky',
			],
		],
		'thewhiteroomwiki' => [
			'recentchanges' => false,
			'interface' => [
				'cosmos-custom-rail-module' => 'normal',
				'cosmos-custom-sticky-rail-module' => 'sticky',
			],
		],
	],

	// CreateWiki
	'wgCreateWikiBlacklistedSubdomains' => [
		'default' => [
			'subdomain\d{0,2}',
			'example\d{0,2}',
			'betameta\d{0,2}',
			'beta\d{0,2}',
			'prueba\d{0,2}',
			'community\d{0,2}',
			'testwiki\d{0,2}',
			'wikitest\d{0,2}',
			'help\d{0,2}',
			'noc',
			'sandbox\d{0,2}',
			'outreach',
			'gazeteer',
			'gazetteer',
			'wikitech',
			'wiki',
			'www',
			'wikis',
			'misc\d{1,2}',
			'db\d{1,2}',
			'cp\d{1,2}',
			'mw\d{1,2}',
			'jobrunner\d{1,2}',
			'gluster\d{1,2}',
			'ns\d{1,2}',
			'bacula\d{1,2}',
			'misc\d{1,2}',
			'mail\d{1,2}',
			'mw\d{1,2}',
			'ldap\d{1,2}',
			'cloud\d{1,2}',
			'mon\d{1,2}',
			'lizardfs\d{1,2}',
			'rdb\d{1,2}',
			'phab\d{1,2}',
			'services\d{1,2}',
			'puppet\d{1,2}',
			'test\d{1,2}',
			'dbbackup\d{1,2}',
			'graylog\d{1,2}',
			'mem\d{1,2}',
			'miraheze\d{0,2}',
		],
	],
	'wgCreateWikiCannedResponses' => [
		'default' => [
			// Approval reasons:
			'Perfect request' => 'Perfect. Clear purpose, scope, and topic. Please be advised this approval does not preclude other wikis from being approved and created that share this topic, provided they aren\'t 95-100% content forks of your wiki. Please ensure your wiki complies with all aspects of Content Policy at all times. Thank you.',
			'Good request' => 'Pretty good. Purpose and description are a bit vague, but there is nonetheless a clear enough purpose, scope, and/or topic here. Please be advised this approval does not preclude other wikis from being approved and created that share this topic, provided they aren\'t 95-100% content forks of your wiki. Please ensure your wiki complies with all aspects of Content Policy at all times.',
			'Okay request' => 'Okay-ish. Description doesn\'t meet our requirements, but in this case the sitename, URL, and categorisation suggest this is a wiki that would follow the Content Policy made clear by the preceding fields, and it is conditionally approved as such. Please be advised that if your wiki deviates too much from this approval, remedial action can be taken by a Steward, if necessary, and that this approval does not preclude approval of similar wikis sharing this likely topic. Please ensure your wiki complies with all aspects of Content Policy at all times. Thank you.',
			'Categorised as private' => 'The purpose and scope of your wiki is clear enough. Please ensure your wiki complies with all aspects of the Content Policy at all times. Please also note that I have categorised your wiki as "Private". Thank you.',
			
			// Decline reasons:
			'Needs more details' => 'Can you give us a few more details on the purpose for, scope of, and topic of your wiki, and briefly describe some of your wiki\'s content in approximately 2-3 sentences? Additionally can you elaborate on your wiki\'s scope and topical focus a bit further? A few sentences describing the scope of your wiki and the sort of content it will contain should be helpful. Please go back into your original request and add to, but do not replace, your existing description. Thank you.',
			'Invalid or unclear subdomain' => 'The scope and purpose of the wiki seem clear enough. However, your requested subdomain is either invalid, is too generic, conveys a Miraheze affiliation, or suggests the wiki is an English language or multilingual wiki when it is not. Please change it to something that better reflects your wiki\'s purpose and scope. Thank you.',
			'Use Public Test Wiki' => 'Please use Public Test Wiki, https://publictestwiki.com, to test the administrator and bureaucrat tools (as well as Miraheze since the wiki is hosted by us). You should review and follow all TestWiki:Policies, especially TestWiki:Testing policy and TestWiki:Main policy, reverting all tests you perform in the reverse order which you performed them. Request permissions at TestWiki:Request permissions. Thank you.',	
			'Database exists (wiki still active)' => 'Wiki database name and subdomain already exist. Please visit the local wiki and contribute there. Please reach out to any local bureaucrat to request any permissions if you require them. If bureaucrats are not active on the wiki after a reasonable period of time, please start a local election and ask a Steward to evaluate it on the Stewards\' Noticeboard. Thanks.',
			'Database exists (wiki already deleted)' => 'Wiki database name already exists, but the wiki itself has already been deleted in accordance with the Dormancy Policy. I will request a Steward to undelete it for you. When it has been undeleted and reopened, please visit the local wiki and ensure you make at least one edit or log action every 45 days. Wikis are only deleted after 6 months of complete inactivity; if you require a Dormancy Policy exemption, you should review the policy and request it once your wiki has at least 40-60 content pages. Thank you.',
			'Duplicate request' => 'Declining as a duplicate request, which needs more information. Please do not edit this request and instead go back into your original request. Also, please do not submit duplicate requests. Thank you.',
			'Content Policy (unsubstantiated insult)' => 'Declining per Content Policy provision, "Miraheze does not host wikis with the sole purpose to spread unsubstantiated insult, hate or rumours against a person or group of people." Thank you for understanding.',
			'Content Policy (makes it difficult for other wikis)' => 'Declining per Content Policy provision, "A wiki must not create problems which make it difficult for other wikis." Thank you for understanding.',
			'Content Policy (commercial activity)' => 'Declining per Content Policy provision, "The primary purpose of your wiki cannot be for commercial activity." Thank you for understanding. If in error, please edit this wiki request and articulate a clearer purpose and scope for your wiki that makes it clear how this wiki would not violate this criterion of Content Policy.',
			'Content Policy (illegal UK activity)' => 'Declining per Content Policy provision, "Miraheze does not host any content that is illegal in the United Kingdom." Thank you for understanding. If you believe this decline reason was used incorrectly, please address this with the declining wiki creator on their user talk page first before escalating your concern at Stewards\' noticeboard. Thank you.',	
			'Duplicate wiki' => 'Your proposed wiki appears to duplicate, either substantially or entirely, the content of an existing wiki (see the "Request Comments" tab for one or more link(s) to the existing wiki(s)). Could you please describe in a few more sentences by adding to, but not replacing, your existing description, the scope and focus for your wiki, and also assure us that your wiki will not be a complete or substantial duplication? Thank you.',
			'Author request' => 'Declined at the request of the wiki requestor.',
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
	'wgCreateWikiDBDirectory' => [
		'default' => '/srv/mediawiki/dblist',
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
			"$IP/maintenance/tables.sql",
			"$IP/maintenance/tables-generated.sql",
			"$IP/extensions/AbuseFilter/abusefilter.tables.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/BetaFeatures/sql/create_counts.sql",
			"$IP/extensions/CheckUser/cu_log.sql",
			"$IP/extensions/CheckUser/cu_changes.sql",
			"$IP/extensions/DataDump/sql/data_dump.sql",
			"$IP/extensions/Echo/echo.sql",
			"$IP/extensions/GlobalBlocking/sql/global_block_whitelist.sql",
			"$IP/extensions/OAuth/schema/OAuth.sql",
			"$IP/extensions/RottenLinks/sql/rottenlinks.sql",
			"$IP/extensions/UrlShortener/schemas/urlshortcodes.sql"
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
		'default' => '/srv/mediawiki/w/cache'
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
	'wgSharedDB' => [
		'default' => 'metawiki',
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

	// DisqusTag
	'egDisqusShortname' => [
		'default' => '',
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
	],
	'wgEchoSharedTrackingDB' => [
		'default' => 'metawiki',
	],
	'wgEchoUseCrossWikiBetaFeature' => [
		'default' => true,
	],
	'wgEchoMentionStatusNotifications' => [
		'default' => true,
	],

	// Exempt from Robot Control (INDEX/NOINDEX namespaces)
	'wgExemptFromUserRobotsControl' => [
		'default' => $wgContentNamespaces,
		'reviwikiwiki' => [],
		'thelonsdalebattalionwiki' => [],
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
	
	// HTTP
	'wgHTTPConnectTimeout' => [
		'default' => 3.0,
	],
	'wgHTTPTimeout' => [
		'default' => 20,
	],
	
	// Extensions and Skins
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
	'wmgUseAdvancedSearch' => [
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
	'wmgUseArrays' => [
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
	'wmgUseAutoCreatePage' => [
		'default' => false,
	],
	'wmgUseBlogPage' => [
		'default' => false,
	],
	'wmgUseBabel' => [
		'default' => false,
	],
	// Must be on at all times except for ldapwikiwiki
	'wmgUseCentralAuth' => [
		'default' => true,
		'ldapwikiwiki' => false,
	],
	'wmgUseCapiunto' => [
		'default' => false,
	],
	'wmgUseCargo' => [
		'default' => false,
	],
	'wmgUseCategorySortHeaders' => [
		'default' => false,
	],
	'wmgUseCategoryTree' => [
		'default' => false,
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
	'wmgUseCitizen' => [
		'default' => false,
	],
	'wmgUseCitoid' => [
		'default' => false,
	],
	'wmgUseCleanChanges' => [
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
		'default' => false,
	],
	'wmgUseCommentbox' => [
		'default' => false,
	],
	'wmgUseCommentStreams' => [
		'default' => false,
	],
	'wmgUseComments' => [
		'default' => false, // Sysop has 'commentadmin' by default
	],
	'wmgUseCommonsMetadata' => [
		'default' => false,
	],
	'wmgUseContactPage' => [
		'default' => false,
	],
	'wmgUseContributionScores' => [
		'default' => false,
	],
	'wmgUseCosmos' => [
		'default' => false,
	],
	'wmgUseCreatePage' => [
		'default' => false,
	],
	'wmgUseCreatePageUw' => [
		'default' => false,
	],
	'wmgUseCreateRedirect' => [
		'default' => false,
	],
	'wmgUseCSS' => [
		'default' => false,
	],
	'wmgUseCalendarWikivoyage' => [
		'default' => false,
	],
	'wmgUseDarkMode' => [
		'default' => false,
	],
	'wmgUseDataTransfer' => [
		'default' => false,
	],
	'wmgUseDeleteUserPages' => [
		'default' => false,
	],
	'wmgUseDescription2' => [
		'default' => false,
	],
	'wmgUseDisambiguator' => [
		'default' => false,
	],
	'wmgUseDiscussionTools' => [
		'default' => false,
	],
	'wmgUseDisplayTitle' => [
		'default' => false,
	],
	'wmgUseDisqusTag' => [
		'default' => false,
	],
	'wmgUseDuskToDawn' => [
		'default' => false,
	],
	'wmgUseDPLForum' => [
		'default' => false,
	],
	'wmgUseDummyFandoomMainpageTags' => [
		'default' => false,
	],
	'wmgUseDynamicPageList' => [
		'default' => false,
	],
	'wmgUseDynamicPageList3' => [
		'default' => false,
	],
	'wmgUseDynamicSidebar' => [
		'default' => false,
	],
	'wmgUseEditcount' => [
		'default' => false,
	],
	'wmgUseEditNotify' => [
		'default' => false,
	],
	'wmgUseEditSubpages' => [
		'default' => false,
	],
	'wmgUseErudite' => [
		'default' => false,
	],
	'wmgUseFancyBoxThumbs' => [
		'default' => false,
	],
	'wmgUseFemiwiki' => [
		'default' => false,
	],
	'wmgUseFlaggedRevs' => [
		'default' => false,
	],
	'wmgUseFlow' => [
		'default' => false,
	],
	'wmgUseForcePreview' => [
		'default' => false,
	],
	'wmgUseForeground' => [
		'default' => false,
	],
	'wmgUseFontAwesome' => [
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
	'wmgUseGeoGebra' => [
		'default' => false,
	],
	'wmgUseGettingStarted' => [
		'default' => false,
	],
	'wmgUseGlobalUserPage' => [
		'default' => false,
	],
	'wmgUseGlobalWatchlist' => [
		'default' => false,
		'loginwiki' => true,
	],
	'wmgUseGoogleDocs4MW' => [
		'default' => false,
	],
	'wmgUseGoogleNewsSitemap' => [
		'default' => false,
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
	'wmgUseHasSomeColours' => [
		'default' => false,
	],
	'wmgUseHAWelcome' => [
		'default' => false,
	],
	'wmgUseHeaderFooter' => [
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
	'wmgUseJsCalendar' => [
		'default' => false,
	],
	'wmgUseJsonConfig' => [
		'default' => false,
	],
	'wmgUseKartographer' => [
		'default' => false,
	],
	'wmgUseLabeledSectionTransclusion' => [
		'default' => false,
	],
	'wmgUseLanguageSelector' => [
		'default' => false,
	],
	'wmgUseLastModified' => [
		'default' => false,
	],
	'wmgUseLdap' => [
		'default' => false,
		'ldapwikiwiki' => true,
	],
	'wmgUseLiberty' => [
		'default' => false,
	],
	'wmgUseLingo' => [
		'default' => false,
	],
	'wmgUseLinkSuggest' => [
		'default' => false,
	],
	'wmgUseLinkTarget' => [
		'default' => false,
	],
	'wmgUseLinkTitles' => [
		'default' => false,
	],
	'wmgUseLinter' => [
		'default' => false,
	],
	'wmgUseListings' => [
		'default' => false,
	],
	'wmgUseLogoFunctions' => [
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
	'wmgUseMask' => [
		'default' => false,
	],
	'wmgUseMassEditRegex' => [
		'default' => false,
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
	'wmgUseMedik' => [
		'default' => false,
	],
	'wmgUseMermaid' => [
		'default' => false,
	],
	'wmgUseMetrolook' => [
		'default' => false,
	],
	'wmgUseMinervaNeue' => [
		'default' => false,
	],
	'wmgUseMobileFrontend' => [
		'default' => false,
	],
	'wmgUseMobileTabsPlugin' => [
		'default' => false,
	],
	'wmgUseModeration' => [
		'default' => false,
	],
	'wmgUseModernSkylight' => [
		'default' => false,
	],
	'wmgUseMonaco' => [
		'default' => false,
	],
	'wmgUseMsCalendar' => [
		'default' => false,
	],
	'wmgUseMsCatSelect' => [
		'default' => false,
	],
	'wmgUseMsLinks' => [
		'default' => false,
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
	'wmgUseMyVariables' => [
		'default' => false,
	],
	'wmgUseNewestPages' => [
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
	'wmgUseNimbus' => [
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
	'wmgUseNumberedHeadings' => [
		'default' => false,
	],
	'wmgUseOpenGraphMeta' => [
		'default' => false,
	],
	'wmgUseOrphanedTalkPages' => [
		'default' => false,
	],
	'wmgUsePageAssessments' => [
		'default' => false,
	],
	'wmgUsePageDisqus' => [
		'default' => false,
	],
	'wmgUsePagedTiffHandler' => [
		'default' => false,
	],
	'wmgUsePageForms' => [
		'default' => false,
	],
	'wmgUsePageImages' => [
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
	'wmgUsePollNY' => [
		'default' => false,
	],
	'wmgUsePortableInfobox' => [
		'default' => false,
	],
	'wmgUsePreloader' => [
		'default' => false,
	],
	'wmgUseProofreadPage' => [
		'default' => false,
	],
	'wmgUseProtectSite' => [
		'default' => false,
	],
	'wmgUseProtectionIndicator' => [
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
	'wmgUseRegexFunctions' => [
		'default' => false,
	],
	'wmgUseRelatedArticles' => [
		'default' => false,
	],
	'wmgUseReplaceText' => [
		'default' => false,
	],
	'wmgUseReport' => [
		'default' => false,
	],
	'wmgUseRevisionSlider' => [
		'default' => false,
	],
	'wmgUseRightFunctions' => [
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
	'wmgUseUrlShortener' => [
		'default' => false,
	],
	'wmgUseShortDescription' => [
		'default' => false,
	],
	'wmgUseSimpleBlogPage' => [
		'default' => false,
	],
	'wmgUseSimpleChanges' => [
		'default' => false,
	],
	'wmgUseSimpleTooltip' => [
		'default' => false,
	],
	'wmgUseSlackNotifications' => [
		'default' => false,
	],
	'wmgUseSnapProjectEmbed' => [
		'default' => false,
	],
	'wmgUseSoftRedirector' => [
		'default' => false,
	],
	'wmgUseSocialProfile' => [
		'default' => false,
	],
	'wmgUseSpoilers' => [
		'default' => false,
	],
	'wmgUseSpriteSheet' => [
		'default' => false,
	],
	'wmgUseStopForumSpam' => [
		'default' => false,
	],
	'wmgUseSubpageFun' => [
		'default' => false,
	],
	'wmgUseSubPageList3' => [
		'default' => false,
	],
	'wmgUseSyntaxHighlightGeSHi' => [
		'default' => false,
	],
	'wgScribuntoUseGeSHi' => [
		'default' => true,
	],
	// Combo of Tabs + Tabber
	'wmgUseTabsCombination' => [
		'default' => false,
	],
	'wmgUseTemplateData' => [
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
	'wmgUseTextExtracts' => [
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
	'wmgUseTimeMachine' => [
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
	'wmgUseTranslationNotifications' => [
		'default' => false,
	],
	'wmgUseTreeAndMenu' => [
		'default' => false,
	],
	'wmgUseTruglass' => [
		'default' => false,
	],
	'wmgUseTweeki' => [
		'default' => false,
	],
	'wmgUseTwitterTag' => [
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
	'wmgUseUserFunctions' => [
		'default' => false,
	],
	'wmgUseUserPageEditProtection' => [
		'default' => false,
	],
	'wmgUseUserWelcome' => [
		'default' => false,
	],
	'wmgUseVEForAll' => [
		'default' => false,
	],
	'wmgUseVoteNY' => [
		'default' => false,
	],
	'wmgUseVideo' => [
		'default' => false,
	],
	'wmgUseVisualEditor' => [
		'default' => false,
	],
	'wmgUseVariables' => [
		'default' => false,
	],
	'wmgUseVariablesLua' => [
		'default' => false,
	],
	'wmgUseWebChat' => [
		'default' => false,
	],
	'wmgUseWikibaseClient' => [
		'default' => false,
	],
	'wmgUseWikibaseLexeme' => [
		'default' => false,
	],
	'wmgUseWikibaseQualityConstraints' => [
		'default' => false,
	],
	'wmgUseWikibaseRepository' => [
		'default' => false,
	],
	'wmgUseWikiCategoryTagCloud' => [
		'default' => false,
	],
	'wmgUseWikidataPageBanner' => [
		'default' => false,
	],
	'wmgUseWikiForum' => [
		'default' => false,
	],
	'wmgUsewikihiero' => [
		'default' => false,
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
	'wgFlaggedRevsTags' => [
		'default' => [
			'status' => [
				'quality' => 1,
				'levels' => 2,
				'pristine' => 3,
			],
		],
		'infectopedwiki' => [
			'accuracy' => [
				'levels' => 4,
				'quality' => 2,
				'pristine' => 4,
			],
			'depth' => [
				'levels' => 4,
				'quality' => 2,
				'pristine' => 4,
			],
			'tone' => [
				'levels' => 4,
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
 					'src' => "https://$wmgUploadHostname/metawiki/7/7e/Powered_by_Miraheze.png",
 					'url' => 'https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze',
 					'alt' => 'Miraheze Wiki Hosting'
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

	// Liberty
	'wgLibertyMainColor' => [
		'default' => '#4188F1',
	],
	'wgLibertySecondColor' => [
		'default' => '#2774DC',
	],
	'wgLibertyUseGravatar' => [
		'default' => false,
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
	'wgMirahezeCommons' => [
		'default' => true,
	],
	// Only the board and SRE are allowed access
	// DO NOT ADD UNAUTHORISED USERS
	'wgMirahezeStaffAccessIds' => [
		'default' => [
			2, // Southparkfan (SRE and Board)
			19, // Reception123 (SRE)
			5258, // Void (Board)
			13554, // Paladox (SRE)
			24689, // RobLa (Board)
			57564, // RhinosF1 (SRE)
			73651, // Owen (Board)
			96304, // Universal Omega (SRE)
		],
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
	],

	// GlobalCssJs
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

	// GlobalPreferences
	'wgGlobalPreferencesDB' => [
		'default' => 'mhglobal',
		'ldapwikiwiki' => 'ldapwikiwiki',
	],

	// GlobalUsage
	'wgGlobalUsageDatabase' => [
		'default' => 'commonswiki',
	],

	// GlobalUserPage
	'wgGlobalUserPageAPIUrl' => [
		'default' => 'https://login.miraheze.org/w/api.php',
	],
	'wgGlobalUserPageDBname' => [
		'default' => 'loginwiki',
	],

	// Grant Permissions for BotPasswords and OAuth
	'+wgGrantPermissions' => [
		'default' => [
			'basic' => [
				'user' => true,
			],
		],
		'+ahinfoboxeswiki' => [
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
		'ahinfoboxeswiki' => [
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
			'Unverified_Games' => 'unverified',
		],
	],

	// ImageMagick
	'wgUseImageMagick' => [
		'default' => true,
	],
	'wgImageMagickConvertCommand' => [
		'default' => '/usr/local/bin/mediawiki-firejail-convert',
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
		'+ahinfoboxeswiki' => [
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
		'+incubatorwiki' => [
			'wmincubator',
			'wikiaincubatorplus',
		],
		'+mrjaroslavikwiki' => [
			'wikipedia' => [
				'cs',
				'en',
			],
		],
		'+r4356thwiki' => [
			'scratchwiki',
			'snapwiki',
		],
		'+reviwikiwiki' => [
			'wikipedia' => [
				'en',
				'ko'
			],
		],
		'+sesupportwiki' => [
			'mrjaroslavikwiki',
		],
		'+snapdatawiki' => [
			'd',
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
				"LDAP_OPT_X_TLS_CACERTFILE" => '/etc/ssl/certs/Sectigo.crt',
			],
		],
	],

	// License
	'wgRightsIcon' => [
		'default' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'freesoftwarepediawiki' => 'https://upload.wikimedia.org/wikipedia/commons/4/42/GFDL_Logo.svg',
		'jadtechwiki' => "https://$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'quyranesswiki' => "https://$wmgUploadHostname/quyranesswiki/0/03/Copyright.svg.png",
		'revitwiki' => "https://$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
		'taerelvariwiki' => "https://$wmgUploadHostname/taerelvariwiki/0/03/Copyright.svg.png",
	],
	'wgRightsPage' => [
		'default' => '',
		'diavwiki' => 'Project:Copyrights',
		'quyranesswiki' => 'Project:Copyrights',
		'taerelvariwiki' => 'Project:Copyrights',
	],
	'wgRightsText' => [
		'default' => 'Creative Commons Attribution Share Alike',
		'cvswiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'freesoftwarepediawiki' => 'GNU Free Documentation License',
		'exlinkwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'exstatiowiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'incubatorwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'isvwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'jadtechwiki' => 'Copyright © Jak and Daxter Technical Wiki. All rights reserved.',
		'militarywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'privadowiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'quyranesswiki' => '©2021 TheBurningPrincess (All Rights Reserved)',
		'rctwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'revitwiki' => '©2013-2021 by Lionel J. Camara (All Rights Reserved)',
		'reviwikiwiki' => 'Creative Commons Attribution Share Alike',
		'taerelvariwiki' => '©2021 TheBurningPrincess (All Rights Reserved)',
		'wikidemocracywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikigrowthwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikilexiconwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'worldtrainwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
	],
	'wgRightsUrl' => [
		'default' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'cvswiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'freesoftwarepediawiki' => 'http://www.gnu.org/licenses/fdl-1.3.html',
		'exlinkwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'exstatiowiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'incubatorwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'isvwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'jadtechwiki' => 'https://jadtech.miraheze.org/wiki/MediaWiki:Copyright',
		'militarywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'privadowiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'quyranesswiki' => 'https://quyraness.miraheze.org/wiki/MediaWiki:Copyright',
		'rctwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwikiwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr',
		'taerelvariwiki' => 'https://taerelvari.miraheze.org/wiki/MediaWiki:Copyright',
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
		'gzewiki' => [ "file://" ],
		'kaiwiki' => [ "file://" ],
		'vtwiki' => [ "discord://" ],
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
			'127.0.0.1' => true,
			'::1' => true,
			'51.195.236.212' => true,
			'2001:41d0:800:178a::10' => true,
			'51.195.236.246' => true,
			'2001:41d0:800:1bbd::13' => true,
		],
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
			'syntaxhighlight_geshi',
			'urlshortener',
		],
	],
	'wgManageWikiPermissionsAdditionalAddGroups' => [
		'default' => [],
		'rf1botwiki' => [
			'bureaucrat' => [
				'Repo_Maintainer',
			],
		],
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
			'user' => [
				'mwoauthmanagemygrants' => true,
				'user' => true,
			],
			'steward' => [
				'centralauth-usermerge' => true,
				'usermerge' => true,
				'userrights' => true,
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
		'+documentcontrolwiki' => [
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
			],
			'templateeditor' => [
				'edittemplateprotected' => true,
			],
		],
    		'+famepediawiki' => [
			'Extendedconfirmed' => [
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
		'+lhmnwiki' => [
			'extendedconfirmed' => [
				'editextendedconfirmedprotected' => true,
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
		'+quircwiki' => [
			'QuIRC_Staff' => [
				'editstaffprotected' => true,
			],
		],
		'+rf1botwiki' => [
			'Repo_Maintainer' => [
				'editrepos' => true,
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
		'rf1botwiki' => [
			'bureaucrat' => [
				'Repo_Maintainer',
			],
		],
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

	// Miraheze specific config
	'wgServicesRepo' => [
		'default' => '/srv/services/services',
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
			"image/svg+xml",
			"application/pdf",
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
		'idolish7wiki' => true,
	],
	'wgShellRestrictionMethod' => [
		'default' => 'firejail',
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
	'wgModerationIgnoredInNamespaces' => [
		'default' => [],
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

	// MultiBoilerplate settings
	'wgMultiBoilerplateDiplaySpecialPage' => [
		'default' => false,
	],

	// MultimediaViewer (not beta)
	'wgMediaViewerEnableByDefault' => [
		'default' => false,
	],

	// MobileFrontend
	'wgMFNoMobilePages' => [
		'default' => [],
	],

	// Math
	'wgMathoidCli' => [
 		'default' => [
 			'/srv/mathoid/cli.js',
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
		'wmgUseMultiBoilerplate' => true,
	],
	'wgMultiBoilerplateOptions' => [
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
	],

	// OAuth
	'wgMWOAuthCentralWiki' => [
		'default' => 'metawiki',
		'ldapwikiwiki' => false,
	],
	'wgMWOAuthSharedUserSource' => [
		'default' => 'CentralAuth',
	],
	'wgMWOAuthSecureTokenTransfer' => [
		'default' => true,
	],

	// PageDisqus
	'wgPageDisqusShortname' => [
		'default' => '',
	],

	// Pagelang
	'wgPageLanguageUseDB' => [
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
	'+wgVirtualRestConfig' => [
		'wmgUseFlow' => [
			'modules' => [
				'parsoid' => [
					'url' => "{$wi->server}/w/rest.php",
 					'domain' => $wi->server,
 					'prefix' => $wi->dbname,
 					'forwardCookies' => true,
 					'restbaseCompat' => false,
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
				],
			],
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
					'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'bot' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'sysop' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'bureaucrat' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
			],
			'checks' => [
				'MinimalPasswordLength' => 'PasswordPolicyChecks::checkMinimalPasswordLength',
				'MinimumPasswordLengthToLogin' => 'PasswordPolicyChecks::checkMinimumPasswordLengthToLogin',
				'PasswordCannotMatchUsername' => 'PasswordPolicyChecks::checkPasswordCannotMatchUsername',
				'PasswordCannotBeSubstringInUsername' => 'PasswordPolicyChecks::checkPasswordCannotBeSubstringInUsername',
				'PasswordCannotMatchDefaults' => 'PasswordPolicyChecks::checkPasswordCannotMatchDefaults',
				'MaximalPasswordLength' => 'PasswordPolicyChecks::checkMaximalPasswordLength',
				'PasswordNotInCommonList' => 'PasswordPolicyChecks::checkPasswordNotInCommonList',
			],
		],
	],
	'wgCentralAuthGlobalPasswordPolicies' => [
				'default' => [
					'steward' => [
						'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true ],
						'MinimumPasswordLengthToLogin' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
						'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
						'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
						'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
						'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
						'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					],
					'sysadmin' => [
						'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true ],
						'MinimumPasswordLengthToLogin' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
						'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
						'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
						'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
						'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
						'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					],
					'trustandsafety' => [
						'MinimalPasswordLength' => [ 'value' => 10, 'suggestChangeOnLogin' => true ],
						'MinimumPasswordLengthToLogin' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
						'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
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
 			'usebetatoolbar-cgd' => 1
 		],
		'+bioencyclopediawiki' => [
			'usenewrc' => 0
		],
		'+dcmultiversewiki' => [
			'usecodemirror' => 1,
			'visualeditor-newwikitext' => 1,
			'usebetatoolbar' => 0,
			'usebetatoolbar-cgd' => 0,
			'visualeditor-enable-experimental' => 1,
		],
		'+isvwiki' => [
			'flow-topiclist-sortby' => 'newest',
		],
		'+reviwikiwiki' => [
			'rcenhancedfilters-disable' => 1,
			'usenewrc' => 0
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

	// Redis
	'wmgCacheSettings' => [
		'default' => [
			'memcached' => [
				'server' => [
					// Sessions and Object cache (mem2)
					'51.195.236.245:11211',
					// Parser and Message cache (mem1)
					'51.195.236.223:11211'
				],
			],
			'jobrunner' => [
				'server' => '51.195.236.220:6379',
				'password' => $wmgRedisPassword,
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
	'wgRelatedArticlesFooterWhitelistedSkins' => [
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
		'+ahinfoboxeswiki' => [
			'editrollbackprotected',
			'edittemplateprotected',
			'editrestrictedtemplateprotected',
			'editimportprotected',
		],
    		'+allpediawiki' => [
			'editextendedconfirmedprotected',
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
		'+documentcontrolwiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+famepediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+hypopediawiki' => [
			'bureaucrat',
			'editextendedconfirmedprotected',
		],
		'+igrovyesistemywiki' => [
			'trusted',
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
		],
		'+lhmnwiki' => [
			'editextendedconfirmedprotected',
		],
		'+memeswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'+naasgamelandwiki' => [
			'editarchiveprotected',
			'editofficialprotected',
		],
		'+quircwiki' => [
			'editstaffprotected',
		],
		'+rf1botwiki' => [
			'editrepos',
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
		'ahinfoboxeswiki' => [
			'editrollbackprotected',
			'edittemplateprotected',
			'editrestrictedtemplateprotected',
			'editimportprotected',
		],
    		'allpediawiki' => [
			'editextendedconfirmedprotected',
		],
		'documentcontrolwiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'famepediawiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'hypopediawiki' => [
			'editextendedconfirmedprotected',
		],
		'lhmnwiki' => [
			'editextendedconfirmedprotected',
		],
		'memeswiki' => [
			'editextendedconfirmedprotected',
			'edittemplateprotected',
		],
		'naasgamelandwiki' => [
			'editarchiveprotected',
			'editofficialprotected',
		],
		'simulatorwiki' => [
			'editfragment',
			'edittemplate',
		],
		'wmgUseSocialProfile' => [
			'updatepoints',
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
			"*",
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
	'wgScribuntoUseCodeEditor' => [
		'default' => true,
	],
	'wgScribuntoSlowFunctionThreshold' => [
		'default' => 0.99,
	],
	'wgScribuntoEngineConf' => [
		'default' => [
			'luasandbox' => [
				'class' => "Scribunto_LuaSandboxEngine",
 				'memoryLimit' => 52428800,
 				'cpuLimit' => 10,
				'profilerPeriod' => 0.02,
 				'allowEnvFuncs' => false,
 				'maxLangCacheSize' => 200
			],
			'luastandalone' => [
				'class' => "Scribunto_LuaStandaloneEngine",
 				'errorFile' => null,
 				'luaPath' => null,
 				'memoryLimit' => 52428800,
				'cpuLimit' => 10,
				'profilerPeriod' => 0.02,
 				'allowEnvFuncs' => false,
 				'maxLangCacheSize' => 200
			],
			'luaautodetect' => [
 				'factory' => 'Scribunto_LuaEngine::newAutodetectEngine',
 			],
		],
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
	'wgWordmark' => [
		'default' => false,
	],
	'wgWordmarkHeight' => [
		'default' => 18,
	],
	'wgWordmarkWidth' => [
		'default' => 116,
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

	// Timezone
	'wgLocaltimezone' => [
		'default' => 'UTC',
	],

	// Theme
	'wgDefaultTheme' => [
		'default' => "",
	],

	// TitleBlacklist
	'wgTitleBlacklistSources' => [
		'default' => [
			'global' => [
				'type' => 'url',
				'src' => 'https://meta.miraheze.org/w/index.php?title=Title_blacklist&action=raw',
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
	'wgTidyConfig' => [
		'default' => [
			'driver' => 'RemexHtml'
		],
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

	// Uploads
 	'wmgPrivateUploads' => [
 		'default' => false,
 		'ciptamediawiki' => true,
 		'rhinosf1wiki' => true,
 		'staffwiki' => true,
 		'mikekilitterboxwiki' => true
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
	],
	'wgUrlShortenerDomainsWhitelist' => [	
		'default' => [],
	],
	'wgUrlShortenerAllowedDomains' => [
		'default' => [
			'(.*\.)?miraheze\.org',
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

	// Vanish (MW 1.34+)
	'wgUseCdn' => [
		'default' => true,
	],
	'wgCdnServers' => [
		'default' => [
			'128.199.139.216:81', // cp3
			'51.195.236.219:81', // cp10
			'51.195.236.250:81', // cp11
			'51.222.25.132:81', // cp12
			'51.38.69.175:81', // cp13
		],
	],
	
	// Vector
	'wgVectorDefaultSkinVersion' => [
		'default' => '1',
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
	'wgEnableWikibaseClient' => [
		'default' => false,
		'wmgUseWikibaseClient' => true,
	],
	'wgEnableWikibaseRepo' => [
		'default' => false,
		'wmgUseWikibaseRepository' => true,
	],

	// WebChat config
	'wgWebChatServer' => [
		'default' => false,
	],
	'wgWebChatChannel' => [
		'default' => false,
	],
	'wgWebChatClient' => [
		'default' => 'freenodeChat',
	],

	// WikiForum
	'wgWikiForumAllowAnonymous' => [
		'default' => true,
	],
	'wgWikiForumLogsInRC' => [
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

	// CreateWiki Defined Special Variables
	'cwClosed' => [
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
			'antispoof' => false,
			'api' => 'warning',
			'api-feature-usage' => false,
			'api-readonly' => false,
			// When using this, use buffer.
			'api-request' => false,
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
			'collection' => 'debug',
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
			'Linter' => false,
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
			'slow-parse' => false,
			'SocialProfile' => false,
			'SpamBlacklist' => false,
			'SpamBlacklistHit' => false,
			'SpamRegex' => false,
			'SQLBagOStuff' => false,
			'squid' => false,
			'StashEdit' => false,
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
if ( !preg_match( '/^(.*)\.miraheze\.org$/', $wi->hostname, $matches ) ) {
	$wi->config->settings['wgCentralAuthCookieDomain'][$wi->dbname] = $wi->hostname;
}

// End settings requiring access to variables

$wi->readCache();
$wi->config->extractAllGlobals( $wi->dbname );

// ManageWiki settings
require_once __DIR__ . "/ManageWikiExtensions.php";
require_once __DIR__ . "/ManageWikiNamespaces.php";
require_once __DIR__ . "/ManageWikiSettings.php";

// Due to an issue with +wgDefaultUserOptions not allowing wiki overrides,
//we have to work around this by creating a local config and merging.
$wgDefaultUserOptions = array_merge( $wgDefaultUserOptions, $wmgDefaultUserOptions );

$wgUploadPath = "https://static.miraheze.org/$wgDBname";
$wgUploadDirectory = "/mnt/mediawiki-static/$wgDBname";

$wgLocalisationCacheConf['storeClass'] = LCStoreCDB::class;
$wgLocalisationCacheConf['storeDirectory'] = "$IP/cache/l10n";
$wgLocalisationCacheConf['manualRecache'] = true;

if ( !file_exists( '/srv/mediawiki/w/cache/l10n/l10n_cache-en.cdb' ) ) {
	$wgLocalisationCacheConf['manualRecache'] = false;
}

if ( extension_loaded( 'wikidiff2' ) ) {
	$wgDiff = false;
}

// Fonts
putenv( "GDFONTPATH=/usr/share/fonts/truetype/freefont" );

// Varnish

// We set wgInternalServer to wgServer as we need this to get purging working (we convert wgServer from https:// to http://).
// https://www.mediawiki.org/wiki/Manual:$wgInternalServer
$wgInternalServer = str_replace( 'https://', 'http://', $wgServer );

// Include other configuration files
require_once( '/srv/mediawiki/config/Database.php' );
require_once( '/srv/mediawiki/config/GlobalCache.php' );
require_once( '/srv/mediawiki/config/GlobalLogging.php' );
require_once( '/srv/mediawiki/config/LocalExtensions.php' );
require_once( '/srv/mediawiki/config/Sitenotice.php' );

if ( $wi->missing ) {
	require_once( '/srv/mediawiki/config/MissingWiki.php' );
}

// When using ?forceprofile=1, a profile can be found as an HTML comment
// Disabled on production hosts because it seems to be causing performance issues (how ironic)
if ( wfHostname() === 'test3' ) {
	// Prevent cache (better be safe than sorry)
	$wi->config->settings['wgUseCdn']['default'] = false;

	if ( isset( $_GET['forceprofile'] ) && $_GET['forceprofile'] == 1 ) {
		$wgProfiler['class'] = 'ProfilerXhprof';
		$wgProfiler['output'] = [ 'ProfilerOutputText' ];
		$wgProfiler['flags'] = TIDEWAYS_XHPROF_FLAGS_CPU;
		$wgProfiler['visible'] = false;
	}
}

// Define last to avoid all dependencies
require_once( '/srv/mediawiki/config/LocalWiki.php' );

// Define last - Extension message files for loading extensions
if ( !defined( 'MW_NO_EXTENSION_MESSAGES' ) ) {
	require_once( '/srv/mediawiki/config/ExtensionMessageFiles.php' );
}

// Last Stuff
$wi->config->extractAllGlobals( $wi->dbname );
$wgConf = $wi->config;
