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

$wmgUploadHostname = "static.miraheze.org";

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

	// Anti-spam
	'wgAccountCreationThrottle' => [
		'default' => 5,
	],
	// https://www.mediawiki.org/wiki/Extension:SpamBlacklist#Blacklist_syntax
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
			'wikiName' => $wgSitename,
			'wikiNameDesktop' => $wgSitename,
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
			'wikiName' => $wgSitename,
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
	'+wgLocalisationCacheConf' => [
		'default' => [
			'storeClass' => LCStoreCDB::class,
			'storeDirectory' => "$IP/cache/l10n",
			'manualRecache' => true,
		],
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

	// Category Collation
	'wgCategoryCollation' => [ // updateCollation.php should be ran after the change
		'default' => 'uppercase',
		'holidayswiki' => 'numeric',
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

	// Cosmos settings
	'wgCosmosBannerLogo' => [
		'default' => null,
	],
	'wgCosmosWikiHeaderWordmark' => [
		'default' => null,
	],
	'wgCosmosWikiHeaderWordmark' => [
		'default' => null,
	],
	'wgCosmosBackgroundImage' => [
		'default' => null,
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
	'wgCosmosButtonColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosToolbarColor' => [
		'default' => '#000000',
	],
	'wgCosmosFooterColor' => [
		'default' => '#c0c0c0',
	],
	'wgCosmosEnablePortableInfoboxEuropaTheme' => [
		'default' => true,
	],
	'wgCosmosBackgroundImageNorepeat' => [
		'default' => true,
	],
	'wgCosmosBackgroundImageFixed' => [
		'default' => true,
	],
	'wgCosmosUseMessageforToolbar' => [
		'default' => false,
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

	// CategoryTree
	'wgCategoryTreeDefaultMode' => [
		'default' => 0,
	],
	'wgCategoryTreeCategoryPageMode' => [
		'default' => 0,
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

	// Captcha
	'wgCaptchaClass' => [
		'default' => 'ReCaptchaNoCaptcha',
	],
	'wgReCaptchaSendRemoteIP' => [
		'default' => false,
	],

	// Category
	'wgUseCategoryBrowser' => [
		'default' => false,
	],

	'wgCategoryPagingLimit' => [
		'default' => 200,
	],

	// CentralAuth
	'wgCentralAuthAutoCreateWikis' => [
		'default' => [
			'loginwiki',
			'metawiki'
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

	// CheckUser
	'wgCheckUserForceSummary' => [
		'default' => true,
	],

	// Comments extension
	'wgCommentsDefaultAvatar' => [
		'default' => '/w/extensions/SocialProfile/avatars/default_ml.gif',
	],
	'wgCommentsInRecentChanges' => [
		'default' => false,
	],
	'wgCommentsSortDescending' => [
		'default' => false,
	],

	// CommentStreams extension
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

	 // Contribution Scores
	 'wgContribScoreDisableCache' => [
		 'default' => true,
	 ],

	// Cookies

	// Keep this set to use the current domain
	'wgCookieDomain' => [
		'default' => ''
	],
	'wgCookieSameSite' => [
		'default' => 'None'
	],
	'wgUseSameSiteLegacyCookies' => [
		'default' => true
	],

	// CreateWiki
	'wgCreateWikiBlacklistedSubdomains' => [
		'default' => '/^(subdomain\d{1,2}|example\d{1,2}|betameta\d{1,2}|beta\d{1,2}|prueba\d{1,2}|community\d{1,2}|testwiki\d{1,2}|wikitest\d{1,2}|help\d{1,2}|noc|sandbox\d{1,2}|outreach|gazeteer|gazetteer|wikitech|wiki|www|wikis|misc\d{1,2}|db\d{1,2}|cp\d{1,2}|mw\d{1,2}|jobrunner\d{1,2}|gluster\d{1,2}|ns\d{1,2}|bacula\d{1,2}|misc\d{1,2}|mail\d{1,2}|mw\d{1,2}|ldap\d{1,2}|cloud\d{1,2}|mon\d{1,2}|lizardfs\d{1,2}|rdb\d{1,2}|phab\d{1,2}|services\d{1,2}|puppet\d{1,2}|test\d{1,2})+$/',
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
		'default' => 'tech@miraheze.org',
	],
	'wgCreateWikiPersistentModelFile' => [
		'default' => '/mnt/mediawiki-static/requestmodel.phpml'
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
			'Automotive' => 'automotive',
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

	// Cookies extension settings
	'wgCookieWarningMoreUrl' => [
		'default' => 'https://meta.miraheze.org/wiki/Privacy_Policy#4._Cookies',
	],
	'wgCookieSetOnAutoblock' => [
		'default' => true,
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

	// CommonsMetadata
	'wgCommonsMetadataForceRecalculate' => [
		'default' => false,
	],

	// Delete
	'wgDeleteRevisionsLimit' => [
		'default' => '1000', // databases don't have much memory - let's not overload them in future - set to 1k T5287
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

	// TimedMediaHandler config
	'wgFFmpegLocation' => [
		'default' => '/usr/bin/ffmpeg',
	],
	'wgTmhEnableMp4Uploads' => [
		'default' => false,
	],

	// Discord
	'wgDiscordFromName' => [
		'default' => '',
	],
	'wgDiscordShowNewUserEmail' => [
		'default' => false,
	],
	'wgDiscordShowNewUserIP' => [
		'default' => false,
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

	// Slack
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

	// Display Title
	'wgDisplayTitleHideSubtitle' => [
		'default' => false,
	],

	// Download from https://www.stopforumspam.com/downloads (recommended listed_ip_30_all.zip)
	// for ipv4 + ipv6 combined.
	// TODO: Setup cron to update this automatically.
	'wgSFSIPListLocation' => [
		'default' => '/mnt/mediawiki-static/private/stopforumspam/listed_ip_30_ipv46_all.txt',
	],

	// ParserFunctions
	'wgPFEnableStringFunctions' => [
		'default' => false,
	],
	'wgAllowSlowParserFunctions' => [
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
	'wmgUseGettingStarted' => [
		'default' => false,
	],
	'wmgUseGlobalUserPage' => [
		'default' => false,
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
	'wmgUseUserWelcome' => [
		'default' => false,
	],
	'wmgUseValidator' => [
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

	// TemplateStyles config
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

	// External link target
	'wgExternalLinkTarget' => [
		'default' => false,
	],

	// Allow External Images
	'wgAllowExternalImages' => [
		'default' => false,
	],

	// DataDump
	'wgDataDump' => [
		'default' => [
			'xml' => [
				'file_ending' => '.xml.gz',
				'generate' => [
					'type' => 'mwscript',
					'script' => "$IP/maintenance/dumpBackup.php",
					'options' => [
						'--full',
						'--logs',
						'--uploads',
						'--output',
						"gzip:/mnt/mediawiki-static/private/dumps/{$wi->dbname}/" . '${filename}',
					],
				],
				'limit' => 1,
				'permissions' => [
					'view' => 'view-dump',
					'generate' => 'generate-dump',
					'delete' => 'delete-dump',
				],
			],
			'image' => [
				'file_ending' => '.tar.gz',
				'generate' => [
					'type' => 'script',
					'script' => '/usr/bin/tar',
					'options' => [
						'--exclude',
						"/mnt/mediawiki-static/{$wi->dbname}/archive",
						'--exclude',
						"/mnt/mediawiki-static/{$wi->dbname}/deleted",
						'--exclude',
						"/mnt/mediawiki-static/{$wi->dbname}/lockdir",
						'--exclude',
						"/mnt/mediawiki-static/{$wi->dbname}/temp",
						'--exclude',
						"/mnt/mediawiki-static/{$wi->dbname}/thumb",
						'-zcvf',
						"/mnt/mediawiki-static/private/dumps/{$wi->dbname}/" . '${filename}',
						"/mnt/mediawiki-static/{$wi->dbname}/"
					],
				],
				'limit' => 1,
				'permissions' => [
					'view' => 'view-dump',
					'generate' => 'generate-dump',
					'delete' => 'delete-dump',
				],
			],
			'managewiki_backup' => [
				'file_ending' => '.json',
				'generate' => [
					'type' => 'mwscript',
					'script' => "$IP/extensions/MirahezeMagic/maintenance/generateManageWikiBackup.php",
					'options' => [
						'--filename',
						'${filename}'
					],
				],
				'limit' => 1,
				'permissions' => [
					'view' => 'view-dump',
					'generate' => 'generate-dump',
					'delete' => 'delete-dump',
				],
			],
		],
	],
	'wgDataDumpDirectory' => [
		'default' => "/mnt/mediawiki-static/private/dumps/{$wi->dbname}/",
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
 					'url' => 'https://meta.miraheze.org/wiki/',
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

	// https://www.mediawiki.org/wiki/Skin:Liberty
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

	// Foreground
	'wgForegroundFeatures' => [
		'default' => [],
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
	],

	// GlobalBlocking
	'wgApplyGlobalBlocks' => [
		'default' => true,
		'metawiki' => false,
		'simcitywiki' => false,
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
	],

	// HAWelcome
	'wgHAWelcomeWelcomeUsername' => [
		'default' => $wgSitename,
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
	],

	// ImageMagick
	'wgUseImageMagick' => [
		'default' => true,
	],
	'wgImageMagickCommand' => [
		'default' => '/usr/bin/convert',
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
			'Icinga' => 'https://meta.miraheze.org/wiki/Tech:Icinga',
			'LizardFS' => false,
			'Mail' => 'https://meta.miraheze.org/wiki/Tech:Mail',
			'MariaDB' => 'https://meta.miraheze.org/wiki/Tech:MariaDB',
			'Matomo' => 'https://meta.miraheze.org/wiki/Tech:Matomo',
			'MediaWiki' => 'https://meta.miraheze.org/wiki/Tech:MediaWiki_appserver',
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
			'isv' => [
				'Medžuslovjansky',
			],
		],
	],

	// Imports
	'wgImportSources' => [
		'default' => [
			'meta',
			'loginwiki',
			'templatewiki',
			'wikipedia',
		],
		'+batfamilywiki' => [
			'batmanwiki',
			'batmanwikifandom',
		],
		'+batmanwiki' => [
			'batfamilywiki',
			'batmanwikifandom',
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
		'+snapwikiwiki' => [
			'scratchwiki',
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
	'wgLanguageCode' => [ // Hardcode "en"
		'default' => 'en',
	],

	// License
	'wgRightsIcon' => [
		'default' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'freesoftwarepediawiki' => 'https://upload.wikimedia.org/wikipedia/commons/4/42/GFDL_Logo.svg',
		'jadtechwiki' => "https://$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'revitwiki' => "https://$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
	],
	'wgRightsPage' => [
		'default' => '',
		'diavwiki' => 'Project:Copyrights',
	],
	'wgRightsText' => [
		'default' => 'Creative Commons Attribution Share Alike',
		'freesoftwarepediawiki' => 'GNU Free Documentation License',
		'exlinkwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'incubatorwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'isvwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'jadtechwiki' => 'Copyright © Jak and Daxter Technical Wiki. All rights reserved.',
		'militarywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'privadowiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'revitwiki' => '©2013-2020 by Lionel J. Camara (All Rights Reserved)',
		'reviwikiwiki' => 'Creative Commons Attribution Share Alike',
		'wikidemocracywiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikigrowthwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'wikilexiconwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
		'worldtrainwikiwiki' => 'Creative Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)',
	],
	'wgRightsUrl' => [
		'default' => 'https://creativecommons.org/licenses/by-sa/4.0/',
		'freesoftwarepediawiki' => 'http://www.gnu.org/licenses/fdl-1.3.html',
		'exlinkwikiwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'incubatorwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'isvwiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'jadtechwiki' => 'https://jadtech.miraheze.org/wiki/MediaWiki:Copyright',
		'militarywiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'privadowiki' => 'https://creativecommons.org/licenses/by-sa/3.0',
		'revitwiki' => 'https://revit.miraheze.org/wiki/MediaWiki:Copyright',
		'reviwikiwiki' => 'https://creativecommons.org/licenses/by-sa/2.0/kr',
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

	// LiliPond
	'wgScoreLilyPond' => [
		'default' => '/dev/null',
	],

	// Mail
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
	'wgManageWikiCDBDirectory' => [
		'default' => '/srv/mediawiki/w/cache/managewiki',
	],
	'wgManageWikiNamespacesExtraContentModels' => [
		'default' => [],
	],
	'wgManageWikiPermissionsAdditionalAddGroups' => [
		'default' => [],
		'rf1botwiki' => [
			'bureaucrat' => [
				'Repo_Maintainer',
			],
		],
		'simcitywiki' => [
			'founder' => [
				'banned',
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
		'+hypopediawiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
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
		'simcitywiki' => [
			'steward' => [
				'hideuser' => true,
				'abusefilter-hide-log' => true,
				'abusefilter-hidden-log' => true,
				'abusefilter-privatedetails' => true,
				'abusefilter-privatedetails-log' => true,
				'suppressionlog' => true,
				'suppressrevision' => true,
				'viewsuppressed' => true,
				'interwiki' => true,
				'centralauth-rename' => true,
				'renameuser' => true,
				'checkuser' => true,
				'checkuser-log' => true,
				'managewiki-restricted' => true,
				'bigdelete' => true,
				'userrights' => true,
				'usermerge' => true,
				'centralauth-usermerge' => true,
				'oathauth-enable' => true,
			],
			'user' => [
				'mwoauthmanagemygrants' => true,
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
		'simcitywiki' => [
			'founder' => [
				'banned',
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
				'globalblock',
				'globalblock-exempt',
				'globalgroupmembership',
				'globalgrouppermissions',
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
				'oathauth-disable-for-user',
				'oathauth-verify-user',
				'oathauth-view-log',
				'renameuser',
				'requestwiki',
				'siteadmin',
				'stopforumspam',
				'suppressionlog',
				'suppressrevision',
				'titleblacklistlog',
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
		'default' => '//meta.miraheze.org/wiki/ManageWiki',
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

	// Minerva settings
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

	// Misc. stuff
	'wgSitename' => [
		'default' => 'No sitename set!',
	],
	'wgAllowDisplayTitle' => [
		'default' => true,
	],
	'wgRestrictDisplayTitle' => [
		'default' => true, // Wikis with NoTitle have it set to false
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
	'egApprovedRevsAutomaticApprovals' => [
		'default' => true,
	],
	'wgFragmentMode' => [
		'default' => [
			'html5',
			'legacy'
		],
	],
	'wgNativeImageLazyLoading' => [
		'default' => false,
		'idolish7wiki' => true,
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
	'wgModerationIgnoredInNamespaces' => [
		'default' => [],
	],
	'wgModerationOnlyInNamespaces' => [
		'default' => [],
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

	// Users Notified On All Changes
	'wgUsersNotifiedOnAllChanges' => [
		'default' => [],
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

	// Pagelang
	'wgPageLanguageUseDB' => [
		'default' => false,
	],

	// Used for the PageDisqus extension
	'wgPageDisqusShortname' => [
		'default' => null,
	],

	// Used for the DisqusTag extension
	'wgDisqusShortname' => [
		'default' => null,
	],

	// Page Size
	'wgMaxArticleSize' => [
		'default' => 2048,
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
		'simcitywiki' => [
			'banned' => [
				'read' => true,
				'createaccount' => true,
				'viewmywatchlist' => true,
				'viewmyprivateinfo' => true,
				'editmywatchlist' => true,
				'editmyoptions' => true,
				'editmyprivateinfo' => true,
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
					'PasswordCannotMatchBlacklist' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'bot' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchBlacklist' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'sysop' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchBlacklist' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotBeSubstringInUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchDefaults' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'MaximalPasswordLength' => [ 'value' => 4096, 'suggestChangeOnLogin' => true ],
					'PasswordNotInCommonList' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
				],
				'bureaucrat' => [
					'MinimalPasswordLength' => [ 'value' => 8, 'suggestChangeOnLogin' => true ],
					'MinimumPasswordLengthToLogin' => [ 'value' => 6, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchUsername' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
					'PasswordCannotMatchBlacklist' => [ 'value' => true, 'suggestChangeOnLogin' => true ],
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
				'PasswordCannotMatchBlacklist' => 'PasswordPolicyChecks::checkPasswordCannotMatchDefaults',
				'PasswordCannotMatchDefaults' => 'PasswordPolicyChecks::checkPasswordCannotMatchDefaults',
				'MaximalPasswordLength' => 'PasswordPolicyChecks::checkMaximalPasswordLength',
				'PasswordNotInLargeBlacklist' => 'PasswordPolicyChecks::checkPasswordNotInCommonList',
				'PasswordNotInCommonList' => 'PasswordPolicyChecks::checkPasswordNotInCommonList',
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

	// Redis
	'wmgRedisSettings' => [
		'default' => [
			'cache' => [
				'server' => '/run/nutcracker/nutcracker.sock',
				'password' => $wmgRedisPassword,
			],
			'jobrunner' => [
				'server' => '51.89.160.135:6379',
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

	// RelatedArticles settings
	'wgRelatedArticlesFooterWhitelistedSkins' => [
		'default' => [
			'minerva',
			'timeless',
			'vector',
		],
	],
	'wgRelatedArticlesUseCirrusSearch' => [
		'default' => false,
	],

	// Restriction types
	'wgRestrictionLevels' => [
		'default' => [
			'',
			'user',
			'autoconfirmed',
			'sysop'
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
		'+hypopediawiki' => [
			'bureaucrat',
		],
		'+igrovyesistemywiki' => [
			'trusted',
			'sysmag',
			'bureaucrat',
			'ceo',
			'co',
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
		'simcitywiki' => [
			'autoconfirmed',
			'sysop',
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
		'+devwiki' => [
			'editinterface'
		],
	],
	'wgRestrictionTypes' => [
		'default' => [
			'create',
			'edit',
			'move',
			'upload',
			'delete',
			'protect'
		],
	],

	// RottenLinks
	'wgRottenLinksCurlTimeout' => [
		'default' => 10,
	],

	// Robot policy
	'wgDefaultRobotPolicy' => [
		'default' => 'index,follow',
	],
	'wgNamespaceRobotPolicies' => [
		'default' => [
			'NS_SPECIAL' => 'noindex',
		],
		'+taswinwiki' => [
			'NS_TEMPLATE' => 'noindex,nofollow',
		],
		'+horizonwiki' => [
			'NS_MAIN' => 'index,follow'
		],
		'+ucroniaswiki' => [
			'NS_TEMPLATE' => 'noindex,nofollow',
			'NS_MODULE' => 'noindex,nofollow',
			'NS_MEDIAWIKI' => 'noindex,nofollow',
			'NS_USER' => 'noindex,nofollow',
			'NS_ANEXO' => 'index,follow',
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

	// WikiSEO configs
	'wgTwitterCardType' => [
		'default' => 'summary_large_image',
	],
	'wgGoogleSiteVerificationKey' => [
		'default' => null,
	],
	'wgBingSiteVerificationKey' => [
		'default' => null,
	],
	'wgFacebookAppId' => [
		'default' => null,
	],
	'wgYandexSiteVerificationKey' => [
		'default' => null,
	],
	'wgAlexaSiteVerificationKey' => [
		'default' => null,
	],
	'wgPinterestSiteVerificationKey' => [
		'default' => null,
	],

	'wgExpensiveParserFunctionLimit' => [
		'default' => 99, //per https://www.mediawiki.org/wiki/Manual:$wgExpensiveParserFunctionLimit
	],

	// Site notice opt out
	'wmgSiteNoticeOptOut' => [
		'default' => false,
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

	// SiteNotice
	'wgDismissableSiteNoticeForAnons' => [
		'default' => true,
	],

	// Skins
	'wgSkipSkins' => [
		'default' => [],
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

	// Vanish (MW 1.34+)
	'wgUseCdn' => [
		'default' => true,
	],
	'wgCdnServers' => [
		'default' => [
			'128.199.139.216:81', // cp3
			'51.77.107.210:81', // cp6
			'51.89.160.142:81', // cp7
			'51.222.27.129:81', // cp9
		],
	],

	// Style
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
	'wmgUseYandexTranslate' => [
		'default' => false,
	],

	// Uploads
 	'wmgPrivateUploads' => [
 		'default' => false,
 		'ciptamediawiki' => true,
 		'rhinosf1wiki' => true,
 		'staffwiki' => true,
 		'mikekilitterboxwiki' => true
 	],
	'wmgSharedUploadBaseUrl' => [
		'default' => false,
	],
	'wmgSharedUploadDBname' => [
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

	// VisualEditor
	'wmgVisualEditorEnableDefault' => [
		'default' => true,
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

	// Protect site config
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
	'wmgEnableEntitySearchUI' => [
		'default' => true,
	],
	'wmgFederatedPropertiesEnabled' => [
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

	// WikiForum settings
	'wgWikiForumAllowAnonymous' => [
		'default' => true,
	],
	'wgWikiForumLogsInRC' => [
		'default' => true,
	],

	// Wikimedia Incubator Settings
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
	'wgMWLoggerDefaultSpi' => [
		'default' => [
			'class' => \MediaWiki\Logger\LegacySpi::class,
		],
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
			'localisation' => false,
			'ldap' => 'warning',
			'Linter' => false,
			'LocalFile' => false,
			'localhost' => false,
			'LockManager' => false,
			'logging' => false,
			'LoginNotify' => false,
			'ManageWiki' => 'debug',
			'MassMessage' => false,
			'Math' => 'info',
			'MatomoAnalytics' => 'debug',
			'Mime' => false,
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
];

// Start settings requiring external dependency checks/functions
if ( !preg_match( '/^(.*)\.miraheze\.org$/', $wi->hostname, $matches ) ) {
	$wi->config->settings['wgCentralAuthCookieDomain'][$wi->dbname] = $wi->hostname;
}

if ( !file_exists( '/srv/mediawiki/w/cache/l10n/l10n_cache-en.cdb' ) ) {
	$wi->config->settings['wgLocalisationCacheConf']['default']['manualRecache'] = false;
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

// Fonts
putenv( "GDFONTPATH=/usr/share/fonts/truetype/freefont" );

// Include other configuration files
require_once( '/srv/mediawiki/config/Database.php' );
require_once( '/srv/mediawiki/config/GlobalLogging.php' );
require_once( '/srv/mediawiki/config/LocalExtensions.php' );
require_once( '/srv/mediawiki/config/Redis.php' );
require_once( '/srv/mediawiki/config/Sitenotice.php' );

if ( $wi->missing ) {
	require_once( '/srv/mediawiki/config/MissingWiki.php' );
}

// When using ?forceprofile=1, a profile can be found as an HTML comment
// Disabled on production hosts because it seems to be causing performance issues (how ironic)
if ( wfHostname() === 'test2' ) {
	// Prevent cache (better be safe than sorry)
	$wi->config->settings['wgUseCdn']['default'] = false;

	if ( isset( $_GET['forceprofile'] ) && $_GET['forceprofile'] == 1 ) {
		$wgProfiler['class'] = 'ProfilerXhprof';
		$wgProfiler['output'] = [ 'ProfilerOutputText' ];
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
