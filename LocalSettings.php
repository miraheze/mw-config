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

$wgConf->settings = [
	// invalidates user sessions
	'wgAuthenticationTokenVersion' => [
		'default' => '3',
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
		'modesofdiscoursewiki' => true,
	],
	
	'wgCategoryPagingLimit' => [
		'default' => 200,
		'nenawikiwiki' => 1500,
	],

	// CentralAuth
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

	 // Contribution Scores
	 'wgContribScoreDisableCache' => [
		 'default' => true,
	 ],

	// CreateWiki
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
		'default' => 'tech@miraheze.org',
	],
	'wgCreateWikiSQLfiles' => [
		'default' => [
			"$IP/maintenance/tables.sql",
			"$IP/extensions/AbuseFilter/abusefilter.tables.sql",
			"$IP/extensions/AntiSpoof/sql/patch-antispoof.mysql.sql",
			"$IP/extensions/BetaFeatures/sql/create_counts.sql",
			"$IP/extensions/CheckUser/cu_log.sql",
			"$IP/extensions/CheckUser/cu_changes.sql",
			"$IP/extensions/DataDump/sql/data_dump.sql",
			"$IP/extensions/Echo/echo.sql",
			"$IP/extensions/GlobalBlocking/sql/global_block_whitelist.sql",
			"$IP/extensions/GlobalBlocking/sql/globalblocks.sql",
			"$IP/extensions/OAuth/schema/mysql/OAuth.sql",
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
	'wgCreateWikiUseEchoNotifications' => [
		'default' => true,
	],
	'wgCreateWikiUseInactiveWikis' => [
		'default' => true,
	],
	'wgCreateWikiUsePrivateWikis' => [
		'default' => true,
	],

	// Cookies extension settings
	'wgCookieWarningMoreUrl' => [
		'default' => 'https://meta.miraheze.org/wiki/Privacy_Policy#4._Cookies',
	],
	'wgCookieSetOnAutoblock' => [
		'default' => true,
	],
	// Cookies extension settings
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
		'absurdopediawiki' => true,
		'allthetropeswiki' => true,
		'altversewiki' => true,
		'americangirldollswiki' => true,
		'animatedfeetwiki' => true,
		'animebathswiki' => true,
		'baobabarchiveswiki' => true,
		'beidipediawiki' => true,
		'buswiki' => true,
		'commonwealthwiki' => true,
		'crappygameswiki' => true,
		'crystalmaidenswiki' => true,
		'cwarswiki' => true,
		'evilbabeswiki' => true,
		'incubatorwiki' => true,
		'metawiki' => true,
		'nonciclopediawiki' => true,
		'nonsensopediawiki' => true,
		'onepiecewiki' => true,
		'openhatchwiki' => true,
		'quircwiki' => true,
		'simswiki' => true,
		'thelastsovereignwiki' => true,
		'tmewiki' => true,
		'toxicfandomsandhatedomswiki' => true,
		'trollpastawiki' => true,
		'trollpastauncensoredwiki' => true,
		'uncyclomirrorwiki' => true,
		'ungamewiki' => true,
	],
	'wgDBadminuser' => [
		'default' => 'wikiadmin',
	],
	'wgDBuser' => [
		'default' => 'mediawiki',
	],

	'wgReadOnly' => [
		'default' => false,
		'00sretrolivingwiki' => 'Migration in progress',
		'1920swiki' => 'Migration in progress',
		'1gkrsus1qkswiki' => 'Migration in progress',
		'2b2thackswiki' => 'Migration in progress',
		'2gearwiki' => 'Migration in progress',
		'2ggwiki' => 'Migration in progress',
		'2ndenlightenmentwiki' => 'Migration in progress',
		'3b9twiki' => 'Migration in progress',
		'3ndriuzwiki' => 'Migration in progress',
		'3wecwiki' => 'Migration in progress',
		'4005wiki' => 'Migration in progress',
		'4b4twiki' => 'Migration in progress',
		'6n7f9p8bi23lks0tmwn07ebrjh1wiki' => 'Migration in progress',
		'72993wiki' => 'Migration in progress',
		'7lakesrecwiki' => 'Migration in progress',
		'aawikiwiki' => 'Migration in progress',
		'abayedavwiki' => 'Migration in progress',
		'aberrantencyclopediawiki' => 'Migration in progress',
		'abitaregeawiki' => 'Migration in progress',
		'abominablememefandomswiki' => 'Migration in progress',
		'abuarchiveswiki' => 'Migration in progress',
		'abysmalrobotmasterswiki' => 'Migration in progress',
		'access7wiki' => 'Migration in progress',
		'aclapperwiki' => 'Migration in progress',
		'actwiki' => 'Migration in progress',
		'acwiki' => 'Migration in progress',
		'adamdadswellwiki' => 'Migration in progress',
		'adamsonwiki' => 'Migration in progress',
		'addawiki' => 'Migration in progress',
		'adiaforiawiki' => 'Migration in progress',
		'admintrainingwiki' => 'Migration in progress',
		'adowwiki' => 'Migration in progress',
		'adpirumwiki' => 'Migration in progress',
		'adrianwestwiki' => 'Migration in progress',
		'aemanualwiki' => 'Migration in progress',
		'aetcfutureenvironmentswiki' => 'Migration in progress',
		'aetherversewiki' => 'Migration in progress',
		'ageanisleswiki' => 'Migration in progress',
		'aghspacesystemswiki' => 'Migration in progress',
		'agiledowiki' => 'Migration in progress',
		'agoldenbraidwiki' => 'Migration in progress',
		'ahmsaqibwiki' => 'Migration in progress',
		'aibowiki' => 'Migration in progress',
		'aieduwiki' => 'Migration in progress',
		'ajedrezaricatorneoswiki' => 'Migration in progress',
		'alacritysimwiki' => 'Migration in progress',
		'alfawankiwiki' => 'Migration in progress',
		'almamathwiki' => 'Migration in progress',
		'alphabookwiki' => 'Migration in progress',
		'alphasmartwiki' => 'Migration in progress',
		'altaussieruleswiki' => 'Migration in progress',
		'alteriawiki' => 'Migration in progress',
		'althistorywiki' => 'Migration in progress',
		'altirlfictionwiki' => 'Migration in progress',
		'altrussiawiki' => 'Migration in progress',
		'altsciwiki' => 'Migration in progress',
		'amazinglogoswikiwiki' => 'Migration in progress',
		'americanhorrorstorywiki' => 'Migration in progress',
		'anarchymceuwiki' => 'Migration in progress',
		'anarchysmpwiki' => 'Migration in progress',
		'anarchywiki' => 'Migration in progress',
		'andreaswiki' => 'Migration in progress',
		'androwiki' => 'Migration in progress',
		'animaniacswiki' => 'Migration in progress',
		'animenoseswiki' => 'Migration in progress',
		'animewiki' => 'Migration in progress',
		'anthonythoughtswiki' => 'Migration in progress',
		'anythingorigamiyodawiki' => 'Migration in progress',
		'anythingwikiwiki' => 'Migration in progress',
		'apdbwiki' => 'Migration in progress',
		'aplwikiwiki' => 'Migration in progress',
		'appalinggachatuberswiki' => 'Migration in progress',
		'applewiki' => 'Migration in progress',
		'aranziaronzowiki' => 'Migration in progress',
		'arcaterrawiki' => 'Migration in progress',
		'archivetransyahoowiki' => 'Migration in progress',
		'archmanwiki' => 'Migration in progress',
		'arcologiewiki' => 'Migration in progress',
		'arcticlandshelpwiki' => 'Migration in progress',
		'ardhiswiki' => 'Migration in progress',
		'argentaandaurawiki' => 'Migration in progress',
		'argwiki' => 'Migration in progress',
		'aridndwiki' => 'Migration in progress',
		'arkenauwiki' => 'Migration in progress',
		'artdatabasewiki' => 'Migration in progress',
		'asawiki' => 'Migration in progress',
		'ascotwiki' => 'Migration in progress',
		'asctrainingwiki' => 'Migration in progress',
		'asordidconflictwiki' => 'Migration in progress',
		'atbwwiki' => 'Migration in progress',
		'atdallstarsfangamewiki' => 'Migration in progress',
		'ateliernumeriquewiki' => 'Migration in progress',
		'atelierwiki' => 'Migration in progress',
		'athenelwiki' => 'Migration in progress',
		'atlantisboardwiki' => 'Migration in progress',
		'atmosanarchywiki' => 'Migration in progress',
		'atrocioustwitteraccountswikiwiki' => 'Migration in progress',
		'atrociousyahooanswersuserswiki' => 'Migration in progress',
		'attackontitanwiki' => 'Migration in progress',
		'aureawiki' => 'Migration in progress',
		'avesalwiki' => 'Migration in progress',
		'awesomegachatuberswiki' => 'Migration in progress',
		'awfulflags247wiki' => 'Migration in progress',
		'ayurvedawiki' => 'Migration in progress',
		'badomanwiki' => 'Migration in progress',
		'badywiki' => 'Migration in progress',
		'bagattianwiki' => 'Migration in progress',
		'bakapediawiki' => 'Migration in progress',
		'baseballkowiki' => 'Migration in progress',
		'basedeconnaissanceswiki' => 'Migration in progress',
		'basspediawiki' => 'Migration in progress',
		'bastionwiki' => 'Migration in progress',
		'basurawiki' => 'Migration in progress',
		'battlegridwiki' => 'Migration in progress',
		'battlelandsroyalewiki' => 'Migration in progress',
		'bchwiki' => 'Migration in progress',
		'bdalwiki' => 'Migration in progress',
		'bearwikiwiki' => 'Migration in progress',
		'beingnotrichatsdsuwiki' => 'Migration in progress',
		'bekbwiki' => 'Migration in progress',
		'bellsgardenwiki' => 'Migration in progress',
		'belohorizontewiki' => 'Migration in progress',
		'benchasewiki' => 'Migration in progress',
		'bengelskwiki' => 'Migration in progress',
		'benjpatwiki' => 'Migration in progress',
		'bertmgwiki' => 'Migration in progress',
		'bestcomputerswiki' => 'Migration in progress',
		'betapurplewiki' => 'Migration in progress',
		'betaversewiki' => 'Migration in progress',
		'beyondinfinitecrisiswiki' => 'Migration in progress',
		'bgmwiki' => 'Migration in progress',
		'bigbrotherwikiwiki' => 'Migration in progress',
		'bikipediawiki' => 'Migration in progress',
		'bimdesignswiki' => 'Migration in progress',
		'biuwiki' => 'Migration in progress',
		'blacklistedpediawiki' => 'Migration in progress',
		'blobcatiawikiwiki' => 'Migration in progress',
		'blobcatswiki' => 'Migration in progress',
		'bloxywiki' => 'Migration in progress',
		'blunawiki' => 'Migration in progress',
		'bmtunewiki' => 'Migration in progress',
		'bnfworldwiki' => 'Migration in progress',
		'bogusboardgameswiki' => 'Migration in progress',
		'bonzimediacwiki' => 'Migration in progress',
		'bookofeverythingwiki' => 'Migration in progress',
		'bookswiki' => 'Migration in progress',
		'boomercordwiki' => 'Migration in progress',
		'borderprojectwiki' => 'Migration in progress',
		'borrowerwikiwiki' => 'Migration in progress',
		'botdogswiki' => 'Migration in progress',
		'boxturtlestudioswiki' => 'Migration in progress',
		'bpfaqwiki' => 'Migration in progress',
		'braininjurywiki' => 'Migration in progress',
		'brendensuniversewiki' => 'Migration in progress',
		'browniewisardwiki' => 'Migration in progress',
		'bruhmmitwiki' => 'Migration in progress',
		'btrpnetworkwiki' => 'Migration in progress',
		'btswiki' => 'Migration in progress',
		'budapediawiki' => 'Migration in progress',
		'buffetsystemwiki' => 'Migration in progress',
		'bugswiki' => 'Migration in progress',
		'bullshitpediawiki' => 'Migration in progress',
		'bushcraftpediawiki' => 'Migration in progress',
		'bwwwmfwiki' => 'Migration in progress',
		'cacswiki' => 'Migration in progress',
		'caeruleawiki' => 'Migration in progress',
		'callipoliswiki' => 'Migration in progress',
		'camelotwiki' => 'Migration in progress',
		'canadiancadetswiki' => 'Migration in progress',
		'candiesncurseswiki' => 'Migration in progress',
		'cantonianwiki' => 'Migration in progress',
		'capoluocoswiki' => 'Migration in progress',
		'captaintylorwikiwiki' => 'Migration in progress',
		'capybarawiki' => 'Migration in progress',
		'carletonwiki' => 'Migration in progress',
		'carmesimwiki' => 'Migration in progress',
		'carnetswiki' => 'Migration in progress',
		'cartesiumwiki' => 'Migration in progress',
		'cartoonbuttswiki' => 'Migration in progress',
		'cbdgwiki' => 'Migration in progress',
		'cbtwiki' => 'Migration in progress',
		'cclwiki' => 'Migration in progress',
		'ccsakurawiki' => 'Migration in progress',
		'ccvwiki' => 'Migration in progress',
		'celldidwikiwiki' => 'Migration in progress',
		'cetwiki' => 'Migration in progress',
		'chanwiki' => 'Migration in progress',
		'chaogroundswikiwiki' => 'Migration in progress',
		'chaosfantasywiki' => 'Migration in progress',
		'chaosgruppewiki' => 'Migration in progress',
		'chaoshongkongwiki' => 'Migration in progress',
		'cheoljunwikiwiki' => 'Migration in progress',
		'chestwiki' => 'Migration in progress',
		'childcarewiki' => 'Migration in progress',
		'chpkoyunlariwiki' => 'Migration in progress',
		'christianliteraturewiki' => 'Migration in progress',
		'chronostoriawiki' => 'Migration in progress',
		'ciconiawiki' => 'Migration in progress',
		'cikansaiwiki' => 'Migration in progress',
		'cinemassacrengwiki' => 'Migration in progress',
		'classicliberalismwiki' => 'Migration in progress',
		'classpectwiki' => 'Migration in progress',
		'climatecollapsewiki' => 'Migration in progress',
		'clinlabwiki' => 'Migration in progress',
		'clonerwiki' => 'Migration in progress',
		'cloudpixelwiki' => 'Migration in progress',
		'cloudytheologywiki' => 'Migration in progress',
		'clubspongebobwikiwiki' => 'Migration in progress',
		'cmrwthwiki' => 'Migration in progress',
		'cmuiitpwiki' => 'Migration in progress',
		'cngtechresourceswiki' => 'Migration in progress',
		'cnwiki' => 'Migration in progress',
		'cocoppadollswiki' => 'Migration in progress',
		'coffeejellywiki' => 'Migration in progress',
		'cogitopediewiki' => 'Migration in progress',
		'colchaguawiki' => 'Migration in progress',
		'colegioprpwikiwiki' => 'Migration in progress',
		'combinatorialnumbertheorywiki' => 'Migration in progress',
		'combinerebjigglywikiwiki' => 'Migration in progress',
		'commercialsubjectwiki' => 'Migration in progress',
		'communitybuildingwiki' => 'Migration in progress',
		'compaerowiki' => 'Migration in progress',
		'companionanimalwiki' => 'Migration in progress',
		'computercrafteduwiki' => 'Migration in progress',
		'computerdocumentsecuritywiki' => 'Migration in progress',
		'consentcraftwiki' => 'Migration in progress',
		'construpediabrasilwiki' => 'Migration in progress',
		'contingencywiki' => 'Migration in progress',
		'contraaowiki' => 'Migration in progress',
		'contractguildwiki' => 'Migration in progress',
		'controversialwikisanduserswiki' => 'Migration in progress',
		'copeloniawiki' => 'Migration in progress',
		'coperiawiki' => 'Migration in progress',
		'copilotewiki' => 'Migration in progress',
		'coreversewiki' => 'Migration in progress',
		'corporateclashwiki' => 'Migration in progress',
		'cosmoglosswiki' => 'Migration in progress',
		'counterattackmobilecommunautywiki' => 'Migration in progress',
		'crankipediawiki' => 'Migration in progress',
		'crappyfacebookuserswiki' => 'Migration in progress',
		'crappygamesinspanishwiki' => 'Migration in progress',
		'crappymovieswiki' => 'Migration in progress',
		'crappyreceptionwikiswiki' => 'Migration in progress',
		'crayolawiki' => 'Migration in progress',
		'crimsonomegasbaronywiki' => 'Migration in progress',
		'crisisfighterswiki' => 'Migration in progress',
		'critterwiki' => 'Migration in progress',
		'crossfacultyresearchwiki' => 'Migration in progress',
		'crossroadswiki' => 'Migration in progress',
		'crowdwiki' => 'Migration in progress',
		'crtwiki' => 'Migration in progress',
		'crueg19wiki' => 'Migration in progress',
		'crusbdwiki' => 'Migration in progress',
		'crystalmaidenswiki' => 'Migration in progress',
		'csharpwiki' => 'Migration in progress',
		'csjinwiki' => 'Migration in progress',
		'csnimsbordeauxwiki' => 'Migration in progress',
		'cubicplanetwiki' => 'Migration in progress',
		'cutywikiwiki' => 'Migration in progress',
		'cvestigationswiki' => 'Migration in progress',
		'cworkplacewiki' => 'Migration in progress',
		'cyannewiki' => 'Migration in progress',
		'cyberculturewiki' => 'Migration in progress',
		'cyclonepediawiki' => 'Migration in progress',
		'cygnuswiki' => 'Migration in progress',
		'daemonicowiki' => 'Migration in progress',
		'damoriwiki' => 'Migration in progress',
		'damtawiki' => 'Migration in progress',
		'danceofchaoswiki' => 'Migration in progress',
		'dangerzonewiki' => 'Migration in progress',
		'darkagewiki' => 'Migration in progress',
		'darkbitlikewiki' => 'Migration in progress',
		'darkfallnewdawnwiki' => 'Migration in progress',
		'darshanamalawiki' => 'Migration in progress',
		'databasewiki' => 'Migration in progress',
		'datafountainwiki' => 'Migration in progress',
		'datasciencescotlandwiki' => 'Migration in progress',
		'dateswiki' => 'Migration in progress',
		'datosgalloswiki' => 'Migration in progress',
		'dayonewiki' => 'Migration in progress',
		'dbawiki' => 'Migration in progress',
		'dd5wiki' => 'Migration in progress',
		'deadgodswiki' => 'Migration in progress',
		'deadlandswiki' => 'Migration in progress',
		'deadlymonsterswiki' => 'Migration in progress',
		'decentyoutuberswikiwiki' => 'Migration in progress',
		'decyclopediawiki' => 'Migration in progress',
		'deemwikiwiki' => 'Migration in progress',
		'deepbluewiki' => 'Migration in progress',
		'deepmathwiki' => 'Migration in progress',
		'deltarunefanonwiki' => 'Migration in progress',
		'deltastrikeforcewiki' => 'Migration in progress',
		'delugewiki' => 'Migration in progress',
		'denimonewiki' => 'Migration in progress',
		'derpypediawiki' => 'Migration in progress',
		'desainerwiki' => 'Migration in progress',
		'designtoolboxwiki' => 'Migration in progress',
		'deutschewiki' => 'Migration in progress',
		'dgrainwiki' => 'Migration in progress',
		'dhavionwiki' => 'Migration in progress',
		'dianliangwiki' => 'Migration in progress',
		'diawiki' => 'Migration in progress',
		'dictionarywiki' => 'Migration in progress',
		'dicultewiki' => 'Migration in progress',
		'difewiki' => 'Migration in progress',
		'diggzwiki' => 'Migration in progress',
		'digimonwiki' => 'Migration in progress',
		'digitalpioneerswiki' => 'Migration in progress',
		'dionysusmemedumpwiki' => 'Migration in progress',
		'discordeurovisionsongcontestwiki' => 'Migration in progress',
		'discordiannationswiki' => 'Migration in progress',
		'discordiawiki' => 'Migration in progress',
		'discordwiki' => 'Migration in progress',
		'discoveryofindiawiki' => 'Migration in progress',
		'disgracefuldiscordserverswiki' => 'Migration in progress',
		'dishwiki' => 'Migration in progress',
		'dlangwiki' => 'Migration in progress',
		'dlewiki' => 'Migration in progress',
		'dmzwiki' => 'Migration in progress',
		'dndsrdplwiki' => 'Migration in progress',
		'doc4guspwiki' => 'Migration in progress',
		'dohcarwiki' => 'Migration in progress',
		'dossierwiki' => 'Migration in progress',
		'dottwiki' => 'Migration in progress',
		'downtherabbitholewiki' => 'Migration in progress',
		'drbatmanwiki' => 'Migration in progress',
		'dreameaterwiki' => 'Migration in progress',
		'drecwiki' => 'Migration in progress',
		'drmauchwiki' => 'Migration in progress',
		'dropshockwiki' => 'Migration in progress',
		'drtwiki' => 'Migration in progress',
		'dschaghoniawiki' => 'Migration in progress',
		'dscwiki' => 'Migration in progress',
		'dsj4mcupwiki' => 'Migration in progress',
		'dsj4puchareuropywiki' => 'Migration in progress',
		'ducalewiki' => 'Migration in progress',
		'duncyclopediawiki' => 'Migration in progress',
		'dunlaviawiki' => 'Migration in progress',
		'duskawakeningdevelopmentwiki' => 'Migration in progress',
		'dwewiki' => 'Migration in progress',
		'dwindlewiki' => 'Migration in progress',
		'dwplivewiki' => 'Migration in progress',
		'eakoswiki' => 'Migration in progress',
		'earthspearclanwiki' => 'Migration in progress',
		'earthwiki' => 'Migration in progress',
		'eastvswestwiki' => 'Migration in progress',
		'ebberronp2ewiki' => 'Migration in progress',
		'ebwiki' => 'Migration in progress',
		'eclectechwiki' => 'Migration in progress',
		'ecologicwiki' => 'Migration in progress',
		'ecypewiki' => 'Migration in progress',
		'edinburghwiki' => 'Migration in progress',
		'edstuffwiki' => 'Migration in progress',
		'eduappswiki' => 'Migration in progress',
		'edusinhankonwiki' => 'Migration in progress',
		'eeladcwiki' => 'Migration in progress',
		'egancowiki' => 'Migration in progress',
		'egbrcwiki' => 'Migration in progress',
		'eicyclopediewiki' => 'Migration in progress',
		'einekatzewiki' => 'Migration in progress',
		'elderkingswiki' => 'Migration in progress',
		'elderscrollswiki' => 'Migration in progress',
		'elflandedwiki' => 'Migration in progress',
		'elgoonishshivewiki' => 'Migration in progress',
		'elliotwiki' => 'Migration in progress',
		'ellythinkswiki' => 'Migration in progress',
		'elsass2020wiki' => 'Migration in progress',
		'emfwiki' => 'Migration in progress',
		'emgpwiki' => 'Migration in progress',
		'emmanueldwiki' => 'Migration in progress',
		'emojitalkwiki' => 'Migration in progress',
		'emotipediawiki' => 'Migration in progress',
		'emtorontowiki' => 'Migration in progress',
		'enavarrowiki' => 'Migration in progress',
		'encikkiwiki' => 'Migration in progress',
		'encyclopediagojirawiki' => 'Migration in progress',
		'encycloqwediawiki' => 'Migration in progress',
		'endlesswiki' => 'Migration in progress',
		'energyjppwiki' => 'Migration in progress',
		'entecwikiwiki' => 'Migration in progress',
		'enumaelishwiki' => 'Migration in progress',
		'environmentjppwiki' => 'Migration in progress',
		'epidemiologywiki' => 'Migration in progress',
		'epikrikafanonwiki' => 'Migration in progress',
		'erchoswiki' => 'Migration in progress',
		'ermensteinwiki' => 'Migration in progress',
		'esconvewiki' => 'Migration in progress',
		'estupidopediawiki' => 'Migration in progress',
		'etarrechowiki' => 'Migration in progress',
		'ethicsmoralphilosophywiki' => 'Migration in progress',
		'eurasiasongcontestwiki' => 'Migration in progress',
		'europawiki' => 'Migration in progress',
		'eurosongwiki' => 'Migration in progress',
		'eurovisionvirtuelwiki' => 'Migration in progress',
		'everythinginternetwikiwiki' => 'Migration in progress',
		'evsmapswiki' => 'Migration in progress',
		'exambotwiki' => 'Migration in progress',
		'exatalewikiwiki' => 'Migration in progress',
		'excellentrobotmasterswiki' => 'Migration in progress',
		'expiratrodorwiki' => 'Migration in progress',
		'exposingseedswiki' => 'Migration in progress',
		'exptprotocolwiki' => 'Migration in progress',
		'extensionswiki' => 'Migration in progress',
		'ez2wikiwiki' => 'Migration in progress',
		'ezbuildingwiki' => 'Migration in progress',
		'factaviawiki' => 'Migration in progress',
		'fagyaanipediawiki' => 'Migration in progress',
		'faketvchannelswiki' => 'Migration in progress',
		'falloutnukaworldpluswiki' => 'Migration in progress',
		'familiarsongswiki' => 'Migration in progress',
		'familiawiki' => 'Migration in progress',
		'fanmadefeetwiki' => 'Migration in progress',
		'fanoniawiki' => 'Migration in progress',
		'fanonwiki' => 'Migration in progress',
		'fanonwikiwiki' => 'Migration in progress',
		'fantendowiki' => 'Migration in progress',
		'fapceomswiki' => 'Migration in progress',
		'faqtestwiki' => 'Migration in progress',
		'fatewarswiki' => 'Migration in progress',
		'faultycharacterswiki' => 'Migration in progress',
		'feedbackwikiwiki' => 'Migration in progress',
		'ferahistoriawiki' => 'Migration in progress',
		'feralarchiveswiki' => 'Migration in progress',
		'ferryclimentwiki' => 'Migration in progress',
		'ferwiki' => 'Migration in progress',
		'feszekwikiwiki' => 'Migration in progress',
		'feywarswiki' => 'Migration in progress',
		'fictionalsportswiki' => 'Migration in progress',
		'fictoclimateswiki' => 'Migration in progress',
		'fifafootballsimulatorwiki' => 'Migration in progress',
		'fifamanagerkowiki' => 'Migration in progress',
		'files21wiki' => 'Migration in progress',
		'fillariwikiwiki' => 'Migration in progress',
		'finalgearwiki' => 'Migration in progress',
		'finobewiki' => 'Migration in progress',
		'firmamentwiki' => 'Migration in progress',
		'flemepediawiki' => 'Migration in progress',
		'florentynawiki' => 'Migration in progress',
		'florianbwiki' => 'Migration in progress',
		'fluxiowiki' => 'Migration in progress',
		'fnafcommunitywiki' => 'Migration in progress',
		'fnafplanetwiki' => 'Migration in progress',
		'foolsgoldwiki' => 'Migration in progress',
		'forbiddenwiki' => 'Migration in progress',
		'forgottentaleswiki' => 'Migration in progress',
		'formula1wiki' => 'Migration in progress',
		'forumwiki' => 'Migration in progress',
		'fourleafficswiki' => 'Migration in progress',
		'fourthsectorwiki' => 'Migration in progress',
		'foxandpandawiki' => 'Migration in progress',
		'fpirisofthevortexwiki' => 'Migration in progress',
		'francisfranckwiki' => 'Migration in progress',
		'frawiki' => 'Migration in progress',
		'fredmalanwiki' => 'Migration in progress',
		'freeconshwiki' => 'Migration in progress',
		'freecountrywiki' => 'Migration in progress',
		'freedompediarandomwiki' => 'Migration in progress',
		'freedomwiki' => 'Migration in progress',
		'freerealmswiki' => 'Migration in progress',
		'frenchwiki' => 'Migration in progress',
		'frikipediawiki' => 'Migration in progress',
		'frischwiki' => 'Migration in progress',
		'ftc8438wiki' => 'Migration in progress',
		'ftprwiki' => 'Migration in progress',
		'fttwiki' => 'Migration in progress',
		'fumpletestwiki' => 'Migration in progress',
		'funnypediawiki' => 'Migration in progress',
		'furnationwiki' => 'Migration in progress',
		'furraewiki' => 'Migration in progress',
		'futuramapediawiki' => 'Migration in progress',
		'fyrnsiduwiki' => 'Migration in progress',
		'g12wiki' => 'Migration in progress',
		'g90faewiki' => 'Migration in progress',
		'gaeawikiwiki' => 'Migration in progress',
		'gaiuspaxiumwiki' => 'Migration in progress',
		'galacteewiki' => 'Migration in progress',
		'galdfowiki' => 'Migration in progress',
		'gameboywiki' => 'Migration in progress',
		'gamedevwikiwiki' => 'Migration in progress',
		'gameofgoblinswiki' => 'Migration in progress',
		'gamerejectswiki' => 'Migration in progress',
		'gamesmonsterswiki' => 'Migration in progress',
		'gamingdbwiki' => 'Migration in progress',
		'gangseowiki' => 'Migration in progress',
		'gaywiki' => 'Migration in progress',
		'gcp711wiki' => 'Migration in progress',
		'geeatuwawiki' => 'Migration in progress',
		'gengwiki' => 'Migration in progress',
		'genshipwiki' => 'Migration in progress',
		'geo3550wiki' => 'Migration in progress',
		'geoboiogfwiki' => 'Migration in progress',
		'gepacobiodivwiki' => 'Migration in progress',
		'gfxcardswiki' => 'Migration in progress',
		'ggwiki' => 'Migration in progress',
		'giganeuroendocrinologywiki' => 'Migration in progress',
		'gildewiki' => 'Migration in progress',
		'gkwiki' => 'Migration in progress',
		'glitchvaultwiki' => 'Migration in progress',
		'glosariocurriculumwiki' => 'Migration in progress',
		'glossariowiki' => 'Migration in progress',
		'gluehutwiki' => 'Migration in progress',
		'gnumicrobiologywiki' => 'Migration in progress',
		'gnutubewiki' => 'Migration in progress',
		'goanimatev6wiki' => 'Migration in progress',
		'godocwiki' => 'Migration in progress',
		'golakiwiki' => 'Migration in progress',
		'goldpediawiki' => 'Migration in progress',
		'goodvyonderswikiwiki' => 'Migration in progress',
		'googologywiki' => 'Migration in progress',
		'gr93wiki' => 'Migration in progress',
		'graespwiki' => 'Migration in progress',
		'grannywiki' => 'Migration in progress',
		'granprincipatodimontesantowiki' => 'Migration in progress',
		'granturismowikiwiki' => 'Migration in progress',
		'grappleforcerenawiki' => 'Migration in progress',
		'grcmwiki' => 'Migration in progress',
		'greatlooneytunescartoonswiki' => 'Migration in progress',
		'greatlundenwiki' => 'Migration in progress',
		'greenlakepartnerswiki' => 'Migration in progress',
		'greenleftwiki' => 'Migration in progress',
		'greenpointwiki' => 'Migration in progress',
		'groupskingwiki' => 'Migration in progress',
		'gt2000wiki' => 'Migration in progress',
		'guayoyophysicswiki' => 'Migration in progress',
		'gugyaanipediawiki' => 'Migration in progress',
		'guiaslocaiswiki' => 'Migration in progress',
		'guidewiki' => 'Migration in progress',
		'guildwars2wiki' => 'Migration in progress',
		'gulpiewiki' => 'Migration in progress',
		'gustavoobomtuvisionwiki' => 'Migration in progress',
		'gustavoshiddenpalacewiki' => 'Migration in progress',
		'gutthiudawiki' => 'Migration in progress',
		'gzewiki' => 'Migration in progress',
		'habitatpartageroannaiswiki' => 'Migration in progress',
		'hackdownwiki' => 'Migration in progress',
		'hackipediawiki' => 'Migration in progress',
		'haikuoswiki' => 'Migration in progress',
		'hansolwiki' => 'Migration in progress',
		'hardwarepusherswiki' => 'Migration in progress',
		'harrypotter1gbcwiki' => 'Migration in progress',
		'hawaiiwiki' => 'Migration in progress',
		'hazbinhotelwiki' => 'Migration in progress',
		'hcwiki' => 'Migration in progress',
		'heavenlyedgewiki' => 'Migration in progress',
		'heliohostwiki' => 'Migration in progress',
		'helixwaltzwiki' => 'Migration in progress',
		'hellinmcwiki' => 'Migration in progress',
		'helveticawiki' => 'Migration in progress',
		'herramientasinformaticaswiki' => 'Migration in progress',
		'hiddenessencewiki' => 'Migration in progress',
		'highschoolequivwiki' => 'Migration in progress',
		'himabuwikiwiki' => 'Migration in progress',
		'hindarfjallwiki' => 'Migration in progress',
		'hindumediawikiwiki' => 'Migration in progress',
		'hinterworldwiki' => 'Migration in progress',
		'histo28wiki' => 'Migration in progress',
		'historiawiki' => 'Migration in progress',
		'historicalcatswiki' => 'Migration in progress',
		'hittleinfowiki' => 'Migration in progress',
		'hmangadoujinshiprojectwiki' => 'Migration in progress',
		'homestuckandmspawiki' => 'Migration in progress',
		'hongkongprotestlibrarywiki' => 'Migration in progress',
		'hongwikiwiki' => 'Migration in progress',
		'horrendoustoyswiki' => 'Migration in progress',
		'horriblecommunityuserswiki' => 'Migration in progress',
		'horribleobjectshowswiki' => 'Migration in progress',
		'horriblesoftwarewiki' => 'Migration in progress',
		'horridinternetserieswiki' => 'Migration in progress',
		'hoshishinichiwiki' => 'Migration in progress',
		'hostedbyjeremywiki' => 'Migration in progress',
		'howtimhardingreplacedstevienicholsonwiki' => 'Migration in progress',
		'hqripperswiki' => 'Migration in progress',
		'hrlwiki' => 'Migration in progress',
		'hurricanevisionwiki' => 'Migration in progress',
		'huwikiwiki' => 'Migration in progress',
		'hyblockwiki' => 'Migration in progress',
		'hydrogenwiki' => 'Migration in progress',
		'hydrotownswiki' => 'Migration in progress',
		'hypercanewiki' => 'Migration in progress',
		'hypernostalgiawiki' => 'Migration in progress',
		'hypewiki' => 'Migration in progress',
		'hypobookswiki' => 'Migration in progress',
		'hypomediametawikiwiki' => 'Migration in progress',
		'hyponewswiki' => 'Migration in progress',
		'hypopediawiki' => 'Migration in progress',
		'hypotheticaltropicalcycloneswiki' => 'Migration in progress',
		'ibbtwiki' => 'Migration in progress',
		'ibrowniewiki' => 'Migration in progress',
		'icarusonlinebrasilwiki' => 'Migration in progress',
		'icarusonlinebrwiki' => 'Migration in progress',
		'icydomainwiki' => 'Migration in progress',
		'ideaplaygroundwiki' => 'Migration in progress',
		'identswiki' => 'Migration in progress',
		'idiotinfowiki' => 'Migration in progress',
		'idiotmediawiki' => 'Migration in progress',
		'idiotpediakrwiki' => 'Migration in progress',
		'idraywikiwiki' => 'Migration in progress',
		'idt2wiki' => 'Migration in progress',
		'iedmwiki' => 'Migration in progress',
		'ielsgozoresourceswiki' => 'Migration in progress',
		'ifcjwiki' => 'Migration in progress',
		'ifrs17koreawiki' => 'Migration in progress',
		'igrovyesistemywiki' => 'Migration in progress',
		'ihlwiki' => 'Migration in progress',
		'ikatawiki' => 'Migration in progress',
		'imawesomewiki' => 'Migration in progress',
		'imbecilepediawiki' => 'Migration in progress',
		'imperiallawarchivewiki' => 'Migration in progress',
		'imperiumwiki' => 'Migration in progress',
		'inbewegungwiki' => 'Migration in progress',
		'incorrecttohowikiwiki' => 'Migration in progress',
		'incworldwiki' => 'Migration in progress',
		'indremawiki' => 'Migration in progress',
		'infernomscpwiki' => 'Migration in progress',
		'infopediawiki' => 'Migration in progress',
		'infotexxhemwiki' => 'Migration in progress',
		'ingenieriaindustrialunt1980wiki' => 'Migration in progress',
		'ininfinitumwiki' => 'Migration in progress',
		'inscribedwiki' => 'Migration in progress',
		'inspectorgadgetwiki' => 'Migration in progress',
		'inspinwiki' => 'Migration in progress',
		'internobrasilguiaslocaiswiki' => 'Migration in progress',
		'intgovforumdeutschlandwiki' => 'Migration in progress',
		'intsdigitalwiki' => 'Migration in progress',
		'intwiki' => 'Migration in progress',
		'invenwiki' => 'Migration in progress',
		'iolwiki' => 'Migration in progress',
		'iowglossarywiki' => 'Migration in progress',
		'iowiki' => 'Migration in progress',
		'ipadaccessibilityhowtoeswiki' => 'Migration in progress',
		'ipediawiki' => 'Migration in progress',
		'ipogspwiki' => 'Migration in progress',
		'ircwiki' => 'Migration in progress',
		'ironriverwiki' => 'Migration in progress',
		'irpediawiki' => 'Migration in progress',
		'irpwiki' => 'Migration in progress',
		'italykingdomwiki' => 'Migration in progress',
		'itbildungsoffensivesgwiki' => 'Migration in progress',
		'iteramcwiki' => 'Migration in progress',
		'itetstudentwikiwiki' => 'Migration in progress',
		'itiswiki' => 'Migration in progress',
		'itsualiwiki' => 'Migration in progress',
		'iuwikiwiki' => 'Migration in progress',
		'ivazeduwiki' => 'Migration in progress',
		'jackdaviswiki' => 'Migration in progress',
		'jacksonswarehousewiki' => 'Migration in progress',
		'jacobvikhailashawiki' => 'Migration in progress',
		'jamie88wiki' => 'Migration in progress',
		'januswiki' => 'Migration in progress',
		'japanwikiwiki' => 'Migration in progress',
		'jardinecolewiki' => 'Migration in progress',
		'jawewiki' => 'Migration in progress',
		'jerrybombwiki' => 'Migration in progress',
		'jescwiki' => 'Migration in progress',
		'jiveswiki' => 'Migration in progress',
		'joftojoorwiki' => 'Migration in progress',
		'johanswandelingenwiki' => 'Migration in progress',
		'johnneilthompsonwiki' => 'Migration in progress',
		'jojobanwiki' => 'Migration in progress',
		'joltanwiki' => 'Migration in progress',
		'jppwiki' => 'Migration in progress',
		'jumpgatewiki' => 'Migration in progress',
		'junkyreddituserswiki' => 'Migration in progress',
		'justonestepwiki' => 'Migration in progress',
		'juwiki' => 'Migration in progress',
		'kaanewiki' => 'Migration in progress',
		'kaichidebatewiki' => 'Migration in progress',
		'kaijaegerwiki' => 'Migration in progress',
		'kaioduartewiki' => 'Migration in progress',
		'kanekhanchanwiki' => 'Migration in progress',
		'kangarootestingwiki' => 'Migration in progress',
		'kaniltechnoswiki' => 'Migration in progress',
		'kantheawiki' => 'Migration in progress',
		'karagahmajaziwiki' => 'Migration in progress',
		'karakaijouzunotakagisanwiki' => 'Migration in progress',
		'kassandrawiki' => 'Migration in progress',
		'kasungawiki' => 'Migration in progress',
		'katjabosterswiki' => 'Migration in progress',
		'kbgwiki' => 'Migration in progress',
		'kcajcraftwiki' => 'Migration in progress',
		'khyaworldbuildingwiki' => 'Migration in progress',
		'kidalwiki' => 'Migration in progress',
		'kimbusinesswiki' => 'Migration in progress',
		'kinderacicwiki' => 'Migration in progress',
		'kinyandraxclwiki' => 'Migration in progress',
		'kirbysbizarreadventureswiki' => 'Migration in progress',
		'kitaswikiwiki' => 'Migration in progress',
		'kiuchifunwiki' => 'Migration in progress',
		'kkutuwiki' => 'Migration in progress',
		'klfcompilationswiki' => 'Migration in progress',
		'klimaplanwiki' => 'Migration in progress',
		'kmicswiki' => 'Migration in progress',
		'knightsofpendragonwiki' => 'Migration in progress',
		'knoblauchincwiki' => 'Migration in progress',
		'koolituswiki' => 'Migration in progress',
		'koreduwiki' => 'Migration in progress',
		'kpwikiwiki' => 'Migration in progress',
		'kqscwiki' => 'Migration in progress',
		'krappylandwiki' => 'Migration in progress',
		'ksfc31thwiki' => 'Migration in progress',
		'ktxgmwiki' => 'Migration in progress',
		'kulmcmemberswiki' => 'Migration in progress',
		'kumhohswikiwiki' => 'Migration in progress',
		'kuoyuewiki' => 'Migration in progress',
		'kvgswiki' => 'Migration in progress',
		'kyunganwiki' => 'Migration in progress',
		'l2rwiki' => 'Migration in progress',
		'lagfandswiki' => 'Migration in progress',
		'lagranbalcanizacionwiki' => 'Migration in progress',
		'lainwiki' => 'Migration in progress',
		'landtranswiki' => 'Migration in progress',
		'lanstationwiki' => 'Migration in progress',
		'laotianyingzwiki' => 'Migration in progress',
		'largenumberswiki' => 'Migration in progress',
		'lascesadeidraghiwiki' => 'Migration in progress',
		'lavoniawiki' => 'Migration in progress',
		'lbwiki' => 'Migration in progress',
		'ldocwiki' => 'Migration in progress',
		'leafcoalitionwiki' => 'Migration in progress',
		'learningblockswiki' => 'Migration in progress',
		'legrandmessagerwiki' => 'Migration in progress',
		'lemopediawiki' => 'Migration in progress',
		'lentopediawiki' => 'Migration in progress',
		'letterofmikewiki' => 'Migration in progress',
		'lettersfromthewastelandwiki' => 'Migration in progress',
		'lexicon5nitwiki' => 'Migration in progress',
		'lgbtqwiki' => 'Migration in progress',
		'lgvwiki' => 'Migration in progress',
		'liberiwiki' => 'Migration in progress',
		'librarywiki' => 'Migration in progress',
		'liceopediawiki' => 'Migration in progress',
		'licnowiki' => 'Migration in progress',
		'limbotestwiki' => 'Migration in progress',
		'limnstationwiki' => 'Migration in progress',
		'limpdwiki' => 'Migration in progress',
		'lingnlangwiki' => 'Migration in progress',
		'linguadexwiki' => 'Migration in progress',
		'livawiki' => 'Migration in progress',
		'liveactionchildrenfeetwiki' => 'Migration in progress',
		'liveassistantwiki' => 'Migration in progress',
		'livromerdawiki' => 'Migration in progress',
		'ljdtwiki' => 'Migration in progress',
		'logoswiki' => 'Migration in progress',
		'logriswiki' => 'Migration in progress',
		'lonefallwiki' => 'Migration in progress',
		'longchampwiki' => 'Migration in progress',
		'loorwiki' => 'Migration in progress',
		'lordmidasgpwwiki' => 'Migration in progress',
		'losersandlaserswiki' => 'Migration in progress',
		'lostcitieswiki' => 'Migration in progress',
		'lotrwiki' => 'Migration in progress',
		'lowincomewiki' => 'Migration in progress',
		'lposwikiwiki' => 'Migration in progress',
		'lq2wiki' => 'Migration in progress',
		'lucowiki' => 'Migration in progress',
		'luminawiki' => 'Migration in progress',
		'lunacyindwiki' => 'Migration in progress',
		'lunebleuewiki' => 'Migration in progress',
		'luterrowiki' => 'Migration in progress',
		'm2recherchewiki' => 'Migration in progress',
		'm4ftmwiki' => 'Migration in progress',
		'mabiwikibrwiki' => 'Migration in progress',
		'macrochasmwiki' => 'Migration in progress',
		'madeupbattleswiki' => 'Migration in progress',
		'madprowiki' => 'Migration in progress',
		'madzebrasciencewiki' => 'Migration in progress',
		'mafteachwiki' => 'Migration in progress',
		'magicubewiki' => 'Migration in progress',
		'maintenantswiki' => 'Migration in progress',
		'makarywiki' => 'Migration in progress',
		'makemediawiki' => 'Migration in progress',
		'makerghatwiki' => 'Migration in progress',
		'makerspacewiki' => 'Migration in progress',
		'maketruthmatteragainwiki' => 'Migration in progress',
		'mangowiki' => 'Migration in progress',
		'mapawiki' => 'Migration in progress',
		'mar9122wiki' => 'Migration in progress',
		'marblelymicswiki' => 'Migration in progress',
		'marchforthebelovewiki' => 'Migration in progress',
		'mariowikiwiki' => 'Migration in progress',
		'marketdesignwiki' => 'Migration in progress',
		'markswikiwiki' => 'Migration in progress',
		'marlboroughwiki' => 'Migration in progress',
		'marsanghaswiki' => 'Migration in progress',
		'martinwmwiki' => 'Migration in progress',
		'marukopediawiki' => 'Migration in progress',
		'marvinthemartionwiki' => 'Migration in progress',
		'mashedpotaytoeswiki' => 'Migration in progress',
		'masseffectwiki' => 'Migration in progress',
		'massivecraftwiki' => 'Migration in progress',
		'mastersindragonswiki' => 'Migration in progress',
		'matekwiki' => 'Migration in progress',
		'mathematicswiki' => 'Migration in progress',
		'mathwiki' => 'Migration in progress',
		'matrivewiki' => 'Migration in progress',
		'matsawikiwiki' => 'Migration in progress',
		'matsuowiki' => 'Migration in progress',
		'maxwellsnowballmaplesyrupwiki' => 'Migration in progress',
		'maydayfrancewiki' => 'Migration in progress',
		'mcbookwiki' => 'Migration in progress',
		'mcdmwiki' => 'Migration in progress',
		'mcfaddenwiki' => 'Migration in progress',
		'mcfoxxwiki' => 'Migration in progress',
		'mcu2wiki' => 'Migration in progress',
		'mcufrwiki' => 'Migration in progress',
		'mediocrefandomsandhatedomswiki' => 'Migration in progress',
		'mediocrewikisanduserswiki' => 'Migration in progress',
		'megamanromhackswiki' => 'Migration in progress',
		'megamanspritecomicwiki' => 'Migration in progress',
		'megawikiwiki' => 'Migration in progress',
		'megrezdevwiki' => 'Migration in progress',
		'megrezwiki' => 'Migration in progress',
		'meidowiki' => 'Migration in progress',
		'meiwiki' => 'Migration in progress',
		'melbqueerdndwiki' => 'Migration in progress',
		'melodiawiki' => 'Migration in progress',
		'meritismwiki' => 'Migration in progress',
		'metallurgical2imagingwiki' => 'Migration in progress',
		'metrocraftwiki' => 'Migration in progress',
		'metrohexfederationwiki' => 'Migration in progress',
		'mexicowikiwiki' => 'Migration in progress',
		'mgyaanipediawiki' => 'Migration in progress',
		'mhrwiki' => 'Migration in progress',
		'miaupediawiki' => 'Migration in progress',
		'michaelaldrichwiki' => 'Migration in progress',
		'michopediawiki' => 'Migration in progress',
		'micrascityonewiki' => 'Migration in progress',
		'micronationinfowiki' => 'Migration in progress',
		'middleyearswiki' => 'Migration in progress',
		'mielswiki' => 'Migration in progress',
		'mightymagiswordseditswiki' => 'Migration in progress',
		'miiwiki' => 'Migration in progress',
		'mikeypediawiki' => 'Migration in progress',
		'militaryhistorywiki' => 'Migration in progress',
		'mimirswikiwiki' => 'Migration in progress',
		'mindseyewiki' => 'Migration in progress',
		'minecraftwiki' => 'Migration in progress',
		'minecraftwikigamethaiwiki' => 'Migration in progress',
		'minepediawiki' => 'Migration in progress',
		'mirahezewiki' => 'Migration in progress',
		'mirauwiki' => 'Migration in progress',
		'mirawiki' => 'Migration in progress',
		'mirrorpediawiki' => 'Migration in progress',
		'mitbwiki' => 'Migration in progress',
		'mnemonicwiki' => 'Migration in progress',
		'mnzdrmwiki' => 'Migration in progress',
		'mobileapiarywiki' => 'Migration in progress',
		'mobilnimilanwiki' => 'Migration in progress',
		'moby2buywiki' => 'Migration in progress',
		'modellierwikiwiki' => 'Migration in progress',
		'modernmusicwikiwiki' => 'Migration in progress',
		'modernsmpwiki' => 'Migration in progress',
		'modernswingwiki' => 'Migration in progress',
		'modesofdiscoursewiki' => 'Migration in progress',
		'mojoseedwiki' => 'Migration in progress',
		'momobomberwiki' => 'Migration in progress',
		'monsterharemwiki' => 'Migration in progress',
		'montrandecsneighbourswiki' => 'Migration in progress',
		'moonbasewiki' => 'Migration in progress',
		'moonrakerwiki' => 'Migration in progress',
		'moosewiki' => 'Migration in progress',
		'mopconlangswiki' => 'Migration in progress',
		'mortalrealmswiki' => 'Migration in progress',
		'mostwantedwiki' => 'Migration in progress',
		'mpteamphmetawiki' => 'Migration in progress',
		'mqmswiki' => 'Migration in progress',
		'mrgyaanipediawiki' => 'Migration in progress',
		'mrwikiwiki' => 'Migration in progress',
		'mspainwiki' => 'Migration in progress',
		'mtbmmwiki' => 'Migration in progress',
		'mugshotswiki' => 'Migration in progress',
		'mugwiki' => 'Migration in progress',
		'musgwiki' => 'Migration in progress',
		'musicarchivewiki' => 'Migration in progress',
		'musicfunwiki' => 'Migration in progress',
		'musicwiki' => 'Migration in progress',
		'muslimpediabetawiki' => 'Migration in progress',
		'muslimwiki' => 'Migration in progress',
		'mvolkskammerwiki' => 'Migration in progress',
		'mwmofficialwikiwiki' => 'Migration in progress',
		'mxlinuxusersenwiki' => 'Migration in progress',
		'mychoiceswiki' => 'Migration in progress',
		'myfirsttrialwikiwiki' => 'Migration in progress',
		'mykokowiki' => 'Migration in progress',
		'mynimowiki' => 'Migration in progress',
		'myrealmswiki' => 'Migration in progress',
		'mysimstorieswiki' => 'Migration in progress',
		'mzdigitalwiki' => 'Migration in progress',
		'naerdomawiki' => 'Migration in progress',
		'nailswiki' => 'Migration in progress',
		'nambrightwiki' => 'Migration in progress',
		'nanatsunotaizaiwiki' => 'Migration in progress',
		'nandiautomacaowiki' => 'Migration in progress',
		'nanjopenchatwiki' => 'Migration in progress',
		'nanowiki' => 'Migration in progress',
		'nappxagulanguagewiki' => 'Migration in progress',
		'naruhitowiki' => 'Migration in progress',
		'nasatastranawiki' => 'Migration in progress',
		'nationsleaguewiki' => 'Migration in progress',
		'ncuwiki' => 'Migration in progress',
		'ndnwiki' => 'Migration in progress',
		'neanawiki' => 'Migration in progress',
		'neolibwiki' => 'Migration in progress',
		'neopediawiki' => 'Migration in progress',
		'neprokatilowiki' => 'Migration in progress',
		'nesstalgiawiki' => 'Migration in progress',
		'nestcopenhagenwiki' => 'Migration in progress',
		'neswiki' => 'Migration in progress',
		'netazarwiki' => 'Migration in progress',
		'netwikiwiki' => 'Migration in progress',
		'neutraltvshowswiki' => 'Migration in progress',
		'newearthwiki' => 'Migration in progress',
		'newromanimperiumwiki' => 'Migration in progress',
		'nexusaeterniawiki' => 'Migration in progress',
		'nihiliswiki' => 'Migration in progress',
		'nihongowiki' => 'Migration in progress',
		'nijppwiki' => 'Migration in progress',
		'nlclarencewiki' => 'Migration in progress',
		'nnmcwiki' => 'Migration in progress',
		'nobodygivesathingwiki' => 'Migration in progress',
		'nodeswiki' => 'Migration in progress',
		'nonameislandwiki' => 'Migration in progress',
		'nonsawiki' => 'Migration in progress',
		'nonsensopediawiki' => 'Migration in progress',
		'norulesmcwiki' => 'Migration in progress',
		'notesselfwiki' => 'Migration in progress',
		'novelistswiki' => 'Migration in progress',
		'novembergangwiki' => 'Migration in progress',
		'novemberwiki' => 'Migration in progress',
		'nudevideogamewiki' => 'Migration in progress',
		'nugridwiki' => 'Migration in progress',
		'nuhexponatewiki' => 'Migration in progress',
		'nujumwiki' => 'Migration in progress',
		'nulgardwiki' => 'Migration in progress',
		'numerique33wiki' => 'Migration in progress',
		'nutscriptwiki' => 'Migration in progress',
		'objectderpinesswiki' => 'Migration in progress',
		'oceaniasongcontestwiki' => 'Migration in progress',
		'odekbwiki' => 'Migration in progress',
		'odiacresuwiki' => 'Migration in progress',
		'oecumenewiki' => 'Migration in progress',
		'oescwiki' => 'Migration in progress',
		'officialmatewiki' => 'Migration in progress',
		'ogfwiki' => 'Migration in progress',
		'ohaerpwiki' => 'Migration in progress',
		'olalawiki' => 'Migration in progress',
		'oldfagwiki' => 'Migration in progress',
		'olegcinemawiki' => 'Migration in progress',
		'om3gawiki' => 'Migration in progress',
		'onaginawiki' => 'Migration in progress',
		'ontariowiki' => 'Migration in progress',
		'opalwiki' => 'Migration in progress',
		'openbvelibwiki' => 'Migration in progress',
		'openenventorywikiwiki' => 'Migration in progress',
		'opertumwiki' => 'Migration in progress',
		'opinionsandstuffwiki' => 'Migration in progress',
		'oppaprizelistwiki' => 'Migration in progress',
		'orcwiki' => 'Migration in progress',
		'organismpediawiki' => 'Migration in progress',
		'orgueshdfwiki' => 'Migration in progress',
		'orgwikiwiki' => 'Migration in progress',
		'osaindexwiki' => 'Migration in progress',
		'osmaniawiki' => 'Migration in progress',
		'osspediawiki' => 'Migration in progress',
		'ostanwiki' => 'Migration in progress',
		'otenkigirlwiki' => 'Migration in progress',
		'ottgamingwiki' => 'Migration in progress',
		'outiswiki' => 'Migration in progress',
		'outoriaswiki' => 'Migration in progress',
		'outpost01oversightwiki' => 'Migration in progress',
		'outwiki' => 'Migration in progress',
		'overstarwikiwiki' => 'Migration in progress',
		'overworldwikiwiki' => 'Migration in progress',
		'oveudovalewiki' => 'Migration in progress',
		'owitstlwiki' => 'Migration in progress',
		'oxertooxerwiki' => 'Migration in progress',
		'ozmicronationswiki' => 'Migration in progress',
		'pacwiki' => 'Migration in progress',
		'pafootballhistorywiki' => 'Migration in progress',
		'pagyaanipediawiki' => 'Migration in progress',
		'paisdeanaguawiki' => 'Migration in progress',
		'paliencyclopediawiki' => 'Migration in progress',
		'paracosmicsandboxwiki' => 'Migration in progress',
		'partisfrwiki' => 'Migration in progress',
		'passitonwiki' => 'Migration in progress',
		'pathfinderwiki' => 'Migration in progress',
		'patriamwiki' => 'Migration in progress',
		'pazwiki' => 'Migration in progress',
		'pcbswiki' => 'Migration in progress',
		'pd1wiki' => 'Migration in progress',
		'pecanwiki' => 'Migration in progress',
		'peledrannwiki' => 'Migration in progress',
		'pengoniawiki' => 'Migration in progress',
		'pensandonisssowiki' => 'Migration in progress',
		'pentalynxwiki' => 'Migration in progress',
		'perfectionanimatorswiki' => 'Migration in progress',
		'perseowiki' => 'Migration in progress',
		'perthowikiwiki' => 'Migration in progress',
		'pessoalzywiki' => 'Migration in progress',
		'petscloneswiki' => 'Migration in progress',
		'pewpewcraftwiki' => 'Migration in progress',
		'phanuwikiwiki' => 'Migration in progress',
		'pharmaxwiki' => 'Migration in progress',
		'phineasandferbwiki' => 'Migration in progress',
		'phylaxtechwiki' => 'Migration in progress',
		'physicswikiwiki' => 'Migration in progress',
		'piewiki' => 'Migration in progress',
		'pimdwiki' => 'Migration in progress',
		'pixelsonascreenwiki' => 'Migration in progress',
		'pixmanwiki' => 'Migration in progress',
		'planetshadowwiki' => 'Migration in progress',
		'plantsvszombieswiki' => 'Migration in progress',
		'plateformerefugieswiki' => 'Migration in progress',
		'playstudiowiki' => 'Migration in progress',
		'pliroforikiwiki' => 'Migration in progress',
		'plomienikrzyzwiki' => 'Migration in progress',
		'plongeesmartiniquewiki' => 'Migration in progress',
		'pmpwiki' => 'Migration in progress',
		'pocketmonsterswiki' => 'Migration in progress',
		'pointmanwiki' => 'Migration in progress',
		'pokefandexwiki' => 'Migration in progress',
		'pokemonpediawiki' => 'Migration in progress',
		'pokemonquartz3dwiki' => 'Migration in progress',
		'pokemonrankedwiki' => 'Migration in progress',
		'pokeorgwiki' => 'Migration in progress',
		'policeukwiki' => 'Migration in progress',
		'politicswiki' => 'Migration in progress',
		'polokingwiki' => 'Migration in progress',
		'polyamoriewiki' => 'Migration in progress',
		'ponyislandtimelinewikiwiki' => 'Migration in progress',
		'popnbookswiki' => 'Migration in progress',
		'portowiki' => 'Migration in progress',
		'possiblywiki' => 'Migration in progress',
		'postitnotewiki' => 'Migration in progress',
		'powerpuffgirlswiki' => 'Migration in progress',
		'powerrangersfanonwiki' => 'Migration in progress',
		'practicallyinsaneclubwiki' => 'Migration in progress',
		'praxismotorsportwiki' => 'Migration in progress',
		'precurewiki' => 'Migration in progress',
		'prettycurewiki' => 'Migration in progress',
		'primuselementwiki' => 'Migration in progress',
		'principatoabbazialedimontesantowiki' => 'Migration in progress',
		'prismawikiwiki' => 'Migration in progress',
		'privatecraftwiki' => 'Migration in progress',
		'prmwiki' => 'Migration in progress',
		'prnetwiki' => 'Migration in progress',
		'progbooksandcourseswiki' => 'Migration in progress',
		'programmingwikiwiki' => 'Migration in progress',
		'projectbahterawiki' => 'Migration in progress',
		'projectbiologiawiki' => 'Migration in progress',
		'projectsoundicatewiki' => 'Migration in progress',
		'projectvanillewiki' => 'Migration in progress',
		'prolibertaswiki' => 'Migration in progress',
		'promedwiki' => 'Migration in progress',
		'pronabecwiki' => 'Migration in progress',
		'propagandawiki' => 'Migration in progress',
		'protonationswiki' => 'Migration in progress',
		'psiconautawiki' => 'Migration in progress',
		'psychewiki' => 'Migration in progress',
		'puginteractivewiki' => 'Migration in progress',
		'punwiki' => 'Migration in progress',
		'pushupswiki' => 'Migration in progress',
		'pyorrepediawiki' => 'Migration in progress',
		'pythonwiki' => 'Migration in progress',
		'pyxxlwiki' => 'Migration in progress',
		'quasarspringswiki' => 'Migration in progress',
		'quewakirawiki' => 'Migration in progress',
		'quillnetsolutionswiki' => 'Migration in progress',
		'quinnwikiwiki' => 'Migration in progress',
		'quircwiki' => 'Migration in progress',
		'quranwiki' => 'Migration in progress',
		'r6swiki' => 'Migration in progress',
		'r6wiki' => 'Migration in progress',
		'racoswikiwiki' => 'Migration in progress',
		'radiocarswiki' => 'Migration in progress',
		'ragempwiki' => 'Migration in progress',
		'railrebornwiki' => 'Migration in progress',
		'railwikiwiki' => 'Migration in progress',
		'raindropwiki' => 'Migration in progress',
		'rambleswiki' => 'Migration in progress',
		'randomnesswiki' => 'Migration in progress',
		'randompediawiki' => 'Migration in progress',
		'raspberrywiki' => 'Migration in progress',
		'raspyjesterwikiwiki' => 'Migration in progress',
		'ratanpirwiki' => 'Migration in progress',
		'rationalwikiwikiwiki' => 'Migration in progress',
		'ratstation13wiki' => 'Migration in progress',
		'raumanalysiswiki' => 'Migration in progress',
		'ravenofsodomwiki' => 'Migration in progress',
		'raywikiwiki' => 'Migration in progress',
		'rccwiki' => 'Migration in progress',
		'rcocgroupwiki' => 'Migration in progress',
		'rdowiki' => 'Migration in progress',
		'realityrealnesswiki' => 'Migration in progress',
		'realmlandswiki' => 'Migration in progress',
		'reaperwiki' => 'Migration in progress',
		'reconwiki' => 'Migration in progress',
		'redditwiki' => 'Migration in progress',
		'redheartswiki' => 'Migration in progress',
		'redstone336mario909worldwiki' => 'Migration in progress',
		'reforgedwiki' => 'Migration in progress',
		'regenerativeagriculturewiki' => 'Migration in progress',
		'reghoftwiki' => 'Migration in progress',
		'regulartranscriptswiki' => 'Migration in progress',
		'rehatrutnovwiki' => 'Migration in progress',
		'reillyqueenswiki' => 'Migration in progress',
		'reinounidowiki' => 'Migration in progress',
		'reiwawiki' => 'Migration in progress',
		'remythwiki' => 'Migration in progress',
		'renegadeswiki' => 'Migration in progress',
		'renewcawiki' => 'Migration in progress',
		'repositoriumwiki' => 'Migration in progress',
		'reservedurablewiki' => 'Migration in progress',
		'retrocwiki' => 'Migration in progress',
		'retrolandwiki' => 'Migration in progress',
		'reunchanwiki' => 'Migration in progress',
		'reverseterribletvshowswiki' => 'Migration in progress',
		'rf1botwiki' => 'Migration in progress',
		'rhinodiarywiki' => 'Migration in progress',
		'riamuwiki' => 'Migration in progress',
		'rlicealeswiki' => 'Migration in progress',
		'rlwiki' => 'Migration in progress',
		'rmbrkwiki' => 'Migration in progress',
		'roanneengrevewiki' => 'Migration in progress',
		'robinversewiki' => 'Migration in progress',
		'robloxdiscordwiki' => 'Migration in progress',
		'roboticjeffywiki' => 'Migration in progress',
		'rocketemporiumwiki' => 'Migration in progress',
		'romanicwiki' => 'Migration in progress',
		'rontgenwikiwiki' => 'Migration in progress',
		'rosecrossreferencewiki' => 'Migration in progress',
		'roseofcolumbiawiki' => 'Migration in progress',
		'rosgenwiki' => 'Migration in progress',
		'rotfwikiwiki' => 'Migration in progress',
		'rotorwikiwiki' => 'Migration in progress',
		'roycowikiwiki' => 'Migration in progress',
		'rpctestwiki' => 'Migration in progress',
		'rriwiki' => 'Migration in progress',
		'rseifvwiki' => 'Migration in progress',
		'rt2wiki' => 'Migration in progress',
		'ruberwiki' => 'Migration in progress',
		'ruffianspersonalwikiwiki' => 'Migration in progress',
		'ruffyandbooiewiki' => 'Migration in progress',
		'ruffysrdrwikiwiki' => 'Migration in progress',
		'ruffysreddeadwiki' => 'Migration in progress',
		'rusanwikiwiki' => 'Migration in progress',
		'russianrevolutionwiki' => 'Migration in progress',
		'russlandwikiwiki' => 'Migration in progress',
		'rvrvwiki' => 'Migration in progress',
		'sabiviwiki' => 'Migration in progress',
		'sacrificewiki' => 'Migration in progress',
		'saenanthulewiki' => 'Migration in progress',
		'sagafannawiki' => 'Migration in progress',
		'sainthwang09wiki' => 'Migration in progress',
		'saintmemoirwiki' => 'Migration in progress',
		'sakebitewiki' => 'Migration in progress',
		'salvationwikiwiki' => 'Migration in progress',
		'sandboxsurvivalwiki' => 'Migration in progress',
		'sanguoshawiki' => 'Migration in progress',
		'sanpantulwikiwiki' => 'Migration in progress',
		'sapienswiki' => 'Migration in progress',
		'sapperpediawiki' => 'Migration in progress',
		'satirepediawiki' => 'Migration in progress',
		'sbfwwiki' => 'Migration in progress',
		'sblcpwiki' => 'Migration in progress',
		'sbwikiwiki' => 'Migration in progress',
		'scendencewiki' => 'Migration in progress',
		'schnellbildungwiki' => 'Migration in progress',
		'scholarstownwoodwiki' => 'Migration in progress',
		'scictepaopsconlangswiki' => 'Migration in progress',
		'scijwiki' => 'Migration in progress',
		'sclugwiki' => 'Migration in progress',
		'scoutingwikiwiki' => 'Migration in progress',
		'scratchpadwiki' => 'Migration in progress',
		'scrummasterclnicswiki' => 'Migration in progress',
		'sdasrwiki' => 'Migration in progress',
		'sectorsedgewiki' => 'Migration in progress',
		'sekaibitoentertainmentwiki' => 'Migration in progress',
		'seleniawiki' => 'Migration in progress',
		'selfdirectedlearningwiki' => 'Migration in progress',
		'semeclopediawiki' => 'Migration in progress',
		'senkyorailwaywiki' => 'Migration in progress',
		'sensonewiki' => 'Migration in progress',
		'sentrieswiki' => 'Migration in progress',
		'seohayunwiki' => 'Migration in progress',
		'seokhyuwiki' => 'Migration in progress',
		'seolgoonswiki' => 'Migration in progress',
		'seonylogwiki' => 'Migration in progress',
		'sethinthecitywiki' => 'Migration in progress',
		'sevenwonderswiki' => 'Migration in progress',
		'sf2016wiki' => 'Migration in progress',
		'sfm5s003wiki' => 'Migration in progress',
		'shadywiki' => 'Migration in progress',
		'shatteredlandswiki' => 'Migration in progress',
		'sheeplywiki' => 'Migration in progress',
		'shellshocklivewiki' => 'Migration in progress',
		'shenronwiki' => 'Migration in progress',
		'shewonwiki' => 'Migration in progress',
		'shinanowiki' => 'Migration in progress',
		'shingekinokyojinwiki' => 'Migration in progress',
		'shitholecountrieswiki' => 'Migration in progress',
		'shitpostpediawiki' => 'Migration in progress',
		'shoptopiawiki' => 'Migration in progress',
		'showroomwiki' => 'Migration in progress',
		'sidewinderwiki' => 'Migration in progress',
		'siekwiki' => 'Migration in progress',
		'sigmaiqwiki' => 'Migration in progress',
		'sigwiki' => 'Migration in progress',
		'simonswikiwiki' => 'Migration in progress',
		'simplyvanillawiki' => 'Migration in progress',
		'sizecomparisonwiki' => 'Migration in progress',
		'slaveleiawiki' => 'Migration in progress',
		'slavicvisionwiki' => 'Migration in progress',
		'slegtikomwiki' => 'Migration in progress',
		'slinxxywiki' => 'Migration in progress',
		'slymoddingwiki' => 'Migration in progress',
		'smartbnbwiki' => 'Migration in progress',
		'smartcityspbwiki' => 'Migration in progress',
		'smfwiki' => 'Migration in progress',
		'smutstonewiki' => 'Migration in progress',
		'smwiwiki' => 'Migration in progress',
		'sneezywiki' => 'Migration in progress',
		'snooversewiki' => 'Migration in progress',
		'snswiki' => 'Migration in progress',
		'socialjusticekoreanwiki' => 'Migration in progress',
		'socialjusticewiki' => 'Migration in progress',
		'sofosearthvisionwiki' => 'Migration in progress',
		'sogoseyouniversewiki' => 'Migration in progress',
		'soilprojectwiki' => 'Migration in progress',
		'sokratesbasewiki' => 'Migration in progress',
		'solarisuniversewiki' => 'Migration in progress',
		'somemongwiki' => 'Migration in progress',
		'soothsingerwiki' => 'Migration in progress',
		'sopatsmkwwiki' => 'Migration in progress',
		'sopsiborwiki' => 'Migration in progress',
		'sotetasswiki' => 'Migration in progress',
		'sotwwiki' => 'Migration in progress',
		'soukvinirawiki' => 'Migration in progress',
		'southwestsoccerpediawiki' => 'Migration in progress',
		'space1979wiki' => 'Migration in progress',
		'spacepediawiki' => 'Migration in progress',
		'spaceportowiki' => 'Migration in progress',
		'spacewiki' => 'Migration in progress',
		'spectrewiki' => 'Migration in progress',
		'spenymusicwiki' => 'Migration in progress',
		'sporepediawiki' => 'Migration in progress',
		'sprawikiwiki' => 'Migration in progress',
		'srcwikiwiki' => 'Migration in progress',
		'ssawakeningwiki' => 'Migration in progress',
		'ssawwiki' => 'Migration in progress',
		'ssbfwiki' => 'Migration in progress',
		'sshwiki' => 'Migration in progress',
		'ssiswikiwiki' => 'Migration in progress',
		'sskotzwiki' => 'Migration in progress',
		'stampywiki' => 'Migration in progress',
		'staravesnowiki' => 'Migration in progress',
		'starekralovstvowiki' => 'Migration in progress',
		'starfinderhomebrewwiki' => 'Migration in progress',
		'stargatewiki' => 'Migration in progress',
		'starshipisiswiki' => 'Migration in progress',
		'startupswiki' => 'Migration in progress',
		'starwarseroticawiki' => 'Migration in progress',
		'stateofadelaidewiki' => 'Migration in progress',
		'stcowanwiki' => 'Migration in progress',
		'stedingenwiki' => 'Migration in progress',
		'steensenvarmingwiki' => 'Migration in progress',
		'stellanoiawiki' => 'Migration in progress',
		'stickywikiwiki' => 'Migration in progress',
		'strawberrychanwikiwiki' => 'Migration in progress',
		'studentspoweringchangewiki' => 'Migration in progress',
		'stupidetcwiki' => 'Migration in progress',
		'stupidrobloxplayerswiki' => 'Migration in progress',
		'subdomain24wikiventadorwiki' => 'Migration in progress',
		'subdominiowiki' => 'Migration in progress',
		'sudzerbalwiki' => 'Migration in progress',
		'summerolympicswiki' => 'Migration in progress',
		'sungchuanwiki' => 'Migration in progress',
		'superiorwiki' => 'Migration in progress',
		'supermariologanwikiwiki' => 'Migration in progress',
		'supersmashbrosdestinefangamewiki' => 'Migration in progress',
		'surfdatawiki' => 'Migration in progress',
		'surrealmemeswiki' => 'Migration in progress',
		'suslopediawiki' => 'Migration in progress',
		'sustainablestoragewiki' => 'Migration in progress',
		'svivawiki' => 'Migration in progress',
		'swdeveloperwiki' => 'Migration in progress',
		'sweawiki' => 'Migration in progress',
		'swedishmuseumwiki' => 'Migration in progress',
		'sweetgreenrtwiki' => 'Migration in progress',
		'swikiwiki' => 'Migration in progress',
		'swissidewiki' => 'Migration in progress',
		'swtotorwiki' => 'Migration in progress',
		'syncaiwiki' => 'Migration in progress',
		'szkalownicywiki' => 'Migration in progress',
		'szrediawiki' => 'Migration in progress',
		'tabernadoguaxinimwiki' => 'Migration in progress',
		'taesserwiki' => 'Migration in progress',
		'taggifywiki' => 'Migration in progress',
		'tagyaanipediawiki' => 'Migration in progress',
		'tahonawiki' => 'Migration in progress',
		'taichungcentralwiki' => 'Migration in progress',
		'taichungpediawiki' => 'Migration in progress',
		'takapediawiki' => 'Migration in progress',
		'takariznawiki' => 'Migration in progress',
		'takuwikiwiki' => 'Migration in progress',
		'talesofvantroswiki' => 'Migration in progress',
		'talicskaiwiki' => 'Migration in progress',
		'taoestudyguidewiki' => 'Migration in progress',
		'tarnobrzeskawiki' => 'Migration in progress',
		'taubwissenwiki' => 'Migration in progress',
		'tbpcaacourseguideswiki' => 'Migration in progress',
		'tbqswiki' => 'Migration in progress',
		'tdproductwiki' => 'Migration in progress',
		'team3082wiki' => 'Migration in progress',
		'techegwiki' => 'Migration in progress',
		'techrefwiki' => 'Migration in progress',
		'techtreewiki' => 'Migration in progress',
		'techwikiwiki' => 'Migration in progress',
		'tegyaanipediawiki' => 'Migration in progress',
		'tekrourwiki' => 'Migration in progress',
		'tellestiawiki' => 'Migration in progress',
		'teologiawiki' => 'Migration in progress',
		'terriblecompanieswiki' => 'Migration in progress',
		'terriblediscorduserswiki' => 'Migration in progress',
		'terriblejustdancesongswiki' => 'Migration in progress',
		'terriblestuffthathappenedtotubbybloxianwiki' => 'Migration in progress',
		'teslapediawiki' => 'Migration in progress',
		'testdeletewiki' => 'Migration in progress',
		'testfsdwiki' => 'Migration in progress',
		'testwattwiki' => 'Migration in progress',
		'textadventureswiki' => 'Migration in progress',
		'tfrumblewiki' => 'Migration in progress',
		'thebigencyclopediawiki' => 'Migration in progress',
		'thebiglistofmanualswiki' => 'Migration in progress',
		'thecommonwealthwiki' => 'Migration in progress',
		'thecompetitionswiki' => 'Migration in progress',
		'thedistancewiki' => 'Migration in progress',
		'thegoodandbadmediawikiwiki' => 'Migration in progress',
		'thehearthwiki' => 'Migration in progress',
		'thehushhushsagawiki' => 'Migration in progress',
		'thehypotheticalencyclopediawiki' => 'Migration in progress',
		'thelastsovereignwiki' => 'Migration in progress',
		'thelegendofdragoonwiki' => 'Migration in progress',
		'thelifeofgregwiki' => 'Migration in progress',
		'theliteratureprojectwiki' => 'Migration in progress',
		'theloudhousewiki' => 'Migration in progress',
		'thelovesickdollwiki' => 'Migration in progress',
		'themugendudelorewiki' => 'Migration in progress',
		'themummichogblogwiki' => 'Migration in progress',
		'thenationstatewiki' => 'Migration in progress',
		'thenewhobbyistwiki' => 'Migration in progress',
		'thenexusuniversewiki' => 'Migration in progress',
		'thenooborderwiki' => 'Migration in progress',
		'theonemagestorypowerswiki' => 'Migration in progress',
		'theriftbreakerwiki' => 'Migration in progress',
		'thesciencewaywiki' => 'Migration in progress',
		'theshardswiki' => 'Migration in progress',
		'thesimpsonshitandrunwikiwiki' => 'Migration in progress',
		'thetoptenstrollswikiwiki' => 'Migration in progress',
		'thetoptenswikiwiki' => 'Migration in progress',
		'thewalkingdeadwiki' => 'Migration in progress',
		'thewallwiki' => 'Migration in progress',
		'thewanwiki' => 'Migration in progress',
		'theworstwikiwiki' => 'Migration in progress',
		'thezulubeatswiki' => 'Migration in progress',
		'thinkdesignwiki' => 'Migration in progress',
		'thislandingwiki' => 'Migration in progress',
		'thronewiki' => 'Migration in progress',
		'tidlerpediawiki' => 'Migration in progress',
		'tilvewiki' => 'Migration in progress',
		'tindallgramswiki' => 'Migration in progress',
		'tipseditorialiwiki' => 'Migration in progress',
		'tmwiki' => 'Migration in progress',
		'toastycraftwiki' => 'Migration in progress',
		'toawiki' => 'Migration in progress',
		'tocgamingprojectwiki' => 'Migration in progress',
		'toituminewiki' => 'Migration in progress',
		'tolandsunknownwiki' => 'Migration in progress',
		'tolbiawiki' => 'Migration in progress',
		'tolstoywiki' => 'Migration in progress',
		'tomeofrevwiki' => 'Migration in progress',
		'tomwiki' => 'Migration in progress',
		'tomythomaswiki' => 'Migration in progress',
		'tookahoowiki' => 'Migration in progress',
		'topbikewiki' => 'Migration in progress',
		'topocartwiki' => 'Migration in progress',
		'torejorgwiki' => 'Migration in progress',
		'torkwiki' => 'Migration in progress',
		'torlanduniversewiki' => 'Migration in progress',
		'towarzystwoprawakredytowegowiki' => 'Migration in progress',
		'toxicinternetsocietywiki' => 'Migration in progress',
		'transgenderwiki' => 'Migration in progress',
		'transmedia20wiki' => 'Migration in progress',
		'trashybookswiki' => 'Migration in progress',
		'trekhitwiki' => 'Migration in progress',
		'trgamewiki' => 'Migration in progress',
		'triolongtermswiki' => 'Migration in progress',
		'tripartitewiki' => 'Migration in progress',
		'tropesfrwiki' => 'Migration in progress',
		'trpacodewiki' => 'Migration in progress',
		'trpgwiki' => 'Migration in progress',
		'trpwiki' => 'Migration in progress',
		'truchewikiwiki' => 'Migration in progress',
		'trwcwiki' => 'Migration in progress',
		'trwonadwiki' => 'Migration in progress',
		'tsbsaltmineswiki' => 'Migration in progress',
		'tsgenwiki' => 'Migration in progress',
		'tssuwiki' => 'Migration in progress',
		'ttaemwiki' => 'Migration in progress',
		'ttpwiki' => 'Migration in progress',
		'tttewiki' => 'Migration in progress',
		'tubbybloxianwiki' => 'Migration in progress',
		'tunisiewiki' => 'Migration in progress',
		'twcbangalorewiki' => 'Migration in progress',
		'twinkletestwiki' => 'Migration in progress',
		'twinlobewiki' => 'Migration in progress',
		'twisrpgwiki' => 'Migration in progress',
		'twitch1wiki' => 'Migration in progress',
		'twmicwiki' => 'Migration in progress',
		'twrwiki' => 'Migration in progress',
		'ucpraisewiki' => 'Migration in progress',
		'ucrirtestwiki' => 'Migration in progress',
		'udiawiki' => 'Migration in progress',
		'uesrpgwiki' => 'Migration in progress',
		'uibkwiki' => 'Migration in progress',
		'ukrainianrurikovichiwiki' => 'Migration in progress',
		'ultimatedayzwiki' => 'Migration in progress',
		'ultratainiawiki' => 'Migration in progress',
		'umpcwiki' => 'Migration in progress',
		'unadminswiki' => 'Migration in progress',
		'unblockedwikiwiki' => 'Migration in progress',
		'uncyclomirrorwiki' => 'Migration in progress',
		'uncyclowikidatabasewiki' => 'Migration in progress',
		'unfixedwiki' => 'Migration in progress',
		'uninspiredwiki' => 'Migration in progress',
		'unionofindependentstateswiki' => 'Migration in progress',
		'universomsxwiki' => 'Migration in progress',
		'unixhaterswiki' => 'Migration in progress',
		'unknownshoreswiki' => 'Migration in progress',
		'unmhscethicswiki' => 'Migration in progress',
		'unrecnationswiki' => 'Migration in progress',
		'uranuswiki' => 'Migration in progress',
		'urbacultureswiki' => 'Migration in progress',
		'urologywiki' => 'Migration in progress',
		'usailabswiki' => 'Migration in progress',
		'usanawiki' => 'Migration in progress',
		'usnslnstcwiki' => 'Migration in progress',
		'usstateteamswiki' => 'Migration in progress',
		'utopiancapitalismwiki' => 'Migration in progress',
		'utowikiwiki' => 'Migration in progress',
		'vaharrawiki' => 'Migration in progress',
		'vandaliscawiki' => 'Migration in progress',
		'vanillaearthwiki' => 'Migration in progress',
		'varushwiki' => 'Migration in progress',
		'vaultwiki' => 'Migration in progress',
		'vddatawikiwiki' => 'Migration in progress',
		'vdjppwiki' => 'Migration in progress',
		'vegannoteswiki' => 'Migration in progress',
		'vegyeszwikiwiki' => 'Migration in progress',
		'velmariawiki' => 'Migration in progress',
		'vemapwiki' => 'Migration in progress',
		'venciclopediawiki' => 'Migration in progress',
		'venkonwiki' => 'Migration in progress',
		'verblaziiconicwiki' => 'Migration in progress',
		'versiondatabasewiki' => 'Migration in progress',
		'vestaliawiki' => 'Migration in progress',
		'vexwiki' => 'Migration in progress',
		'viasatnatureandplayboywiki' => 'Migration in progress',
		'vidastechwiki' => 'Migration in progress',
		'videogameconsoleswiki' => 'Migration in progress',
		'vidwiki' => 'Migration in progress',
		'viileapediawiki' => 'Migration in progress',
		'villainoususerswiki' => 'Migration in progress',
		'vinalvyrwiki' => 'Migration in progress',
		'visewiki' => 'Migration in progress',
		'visionpackauwiki' => 'Migration in progress',
		'vitaewiki' => 'Migration in progress',
		'vitriolwiki' => 'Migration in progress',
		'vitsiwikiwiki' => 'Migration in progress',
		'vixenwarswikiwiki' => 'Migration in progress',
		'viziwikilivewiki' => 'Migration in progress',
		'vlevowiki' => 'Migration in progress',
		'voiceactorwiki' => 'Migration in progress',
		'voiceswiki' => 'Migration in progress',
		'volteuropawiki' => 'Migration in progress',
		'vpediawiki' => 'Migration in progress',
		'vpvkacwiki' => 'Migration in progress',
		'vraiwikiwiki' => 'Migration in progress',
		'vukufwiki' => 'Migration in progress',
		'vvunawiki' => 'Migration in progress',
		'wabuwiki' => 'Migration in progress',
		'waltwilliamswiki' => 'Migration in progress',
		'wandocyberwiki' => 'Migration in progress',
		'warapediawiki' => 'Migration in progress',
		'warmagewiki' => 'Migration in progress',
		'warriorpediawiki' => 'Migration in progress',
		'waterlovelovewiki' => 'Migration in progress',
		'waterlovewiki' => 'Migration in progress',
		'waterwiki' => 'Migration in progress',
		'waywardthoughtswiki' => 'Migration in progress',
		'wcawiki' => 'Migration in progress',
		'wdpedigreewiki' => 'Migration in progress',
		'wediggitwiki' => 'Migration in progress',
		'wepediawiki' => 'Migration in progress',
		'weprojectwiki' => 'Migration in progress',
		'werewolfwiki' => 'Migration in progress',
		'westlanderswiki' => 'Migration in progress',
		'whitesidewiki' => 'Migration in progress',
		'wholemindhealthwiki' => 'Migration in progress',
		'wikiaiwiki' => 'Migration in progress',
		'wikiandliswiki' => 'Migration in progress',
		'wikianewswiki' => 'Migration in progress',
		'wikiavandalswiki' => 'Migration in progress',
		'wikibasculewiki' => 'Migration in progress',
		'wikibayanwiki' => 'Migration in progress',
		'wikichavagneswiki' => 'Migration in progress',
		'wikichefwiki' => 'Migration in progress',
		'wikicubiawiki' => 'Migration in progress',
		'wikidespacitowiki' => 'Migration in progress',
		'wikideviwiki' => 'Migration in progress',
		'wikiescolawiki' => 'Migration in progress',
		'wikifrancoiswiki' => 'Migration in progress',
		'wikikrigwiki' => 'Migration in progress',
		'wikilee2wiki' => 'Migration in progress',
		'wikimdwiki' => 'Migration in progress',
		'wikimediciwiki' => 'Migration in progress',
		'wikipersianwiki' => 'Migration in progress',
		'wikipesijawiki' => 'Migration in progress',
		'wikiptcagwiki' => 'Migration in progress',
		'wikisnakewiki' => 'Migration in progress',
		'wikitdcwiki' => 'Migration in progress',
		'wikitikowiki' => 'Migration in progress',
		'wikitopewiki' => 'Migration in progress',
		'wikitwiki' => 'Migration in progress',
		'wikiugurwiki' => 'Migration in progress',
		'wikivertewiki' => 'Migration in progress',
		'wildcateherbariumwiki' => 'Migration in progress',
		'wildlifegamewiki' => 'Migration in progress',
		'wilsonlabwiki' => 'Migration in progress',
		'windows95wikiwiki' => 'Migration in progress',
		'windowsappswikiwiki' => 'Migration in progress',
		'wintermoorwiki' => 'Migration in progress',
		'winxwiki' => 'Migration in progress',
		'wiseanswerswiki' => 'Migration in progress',
		'wishmakerwiki' => 'Migration in progress',
		'wmrwikiwiki' => 'Migration in progress',
		'wnclibrarywiki' => 'Migration in progress',
		'wolcenwiki' => 'Migration in progress',
		'wolfwiki' => 'Migration in progress',
		'wonnebergwiki' => 'Migration in progress',
		'woodnookwiki' => 'Migration in progress',
		'workflowwiki' => 'Migration in progress',
		'workoutwikiwiki' => 'Migration in progress',
		'workwiki' => 'Migration in progress',
		'world1953wiki' => 'Migration in progress',
		'worldatarmswiki' => 'Migration in progress',
		'worldbuildingwiki' => 'Migration in progress',
		'worldflipperwiki' => 'Migration in progress',
		'worldhistoryofconflictswiki' => 'Migration in progress',
		'worldofeocrwiki' => 'Migration in progress',
		'worldofpafwiki' => 'Migration in progress',
		'worldsongfestivalwiki' => 'Migration in progress',
		'worldwikiwiki' => 'Migration in progress',
		'wpcunofficialwiki' => 'Migration in progress',
		'wszystkordynacjawiki' => 'Migration in progress',
		'x1c7wiki' => 'Migration in progress',
		'xerexwiki' => 'Migration in progress',
		'xevyxemwiki' => 'Migration in progress',
		'xfbswiki' => 'Migration in progress',
		'xocwiki' => 'Migration in progress',
		'xrfrancewiki' => 'Migration in progress',
		'xxxiiildwiki' => 'Migration in progress',
		'xyonwiki' => 'Migration in progress',
		'yakuzamoddingwiki' => 'Migration in progress',
		'yalewikiwiki' => 'Migration in progress',
		'yang2020wikiwiki' => 'Migration in progress',
		'yellowikiwiki' => 'Migration in progress',
		'ygotaswiki' => 'Migration in progress',
		'yonatanashadfavoritetvshowsandmovieswiki' => 'Migration in progress',
		'younghakwikiwiki' => 'Migration in progress',
		'yourosongcontestwiki' => 'Migration in progress',
		'ypdscwiki' => 'Migration in progress',
		'ypnwiki' => 'Migration in progress',
		'yuliswiki' => 'Migration in progress',
		'yummyfoodswiki' => 'Migration in progress',
		'yzzxwiki' => 'Migration in progress',
		'zachwiki' => 'Migration in progress',
		'zandbakwiki' => 'Migration in progress',
		'zankiwiki' => 'Migration in progress',
		'zarariaswikiwiki' => 'Migration in progress',
		'zerawiki' => 'Migration in progress',
		'zetaplanetwiki' => 'Migration in progress',
		'zimmlabwiki' => 'Migration in progress',
		'zonautonomiawiki' => 'Migration in progress',
		'zoopytvwiki' => 'Migration in progress',
		'zuluexastrashwikiwiki' => 'Migration in progress',
	],
	'wgSharedDB' => [
		'default' => 'metawiki',
	],
	'wgSharedTables' => [
		'default' => [],
	],
	'wgActorTableSchemaMigrationStage' => [
		'default' => SCHEMA_COMPAT_NEW,
	],

	'wgCommentTableSchemaMigrationStage' => [
		'default' => MIGRATION_NEW,
	],
	//CommonsMetadata
	'wgCommonsMetadataForceRecalculate' => [
		'default' => false,
	],

	// Delete
	'wgDeleteRevisionsLimit' => [
		'default' => '250', // databases don't have much memory - let's not overload them in future
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
	
	// TimedMediaHandler config
	'wgFFmpegLocation' => [
		'default' => '/usr/bin/ffmpeg',
	],
	
	// Discord
	'wgDiscordNotificationNewUser' => [
		'default' => true,
	],
	
	# Download from https://www.stopforumspam.com/downloads (recommended listed_ip_30_all.zip)
	# for ipv4 + ipv6 combined.
	# TODO: Setup cron to update this automatically.
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
		'thelonsdalebattalionwiki' => [],
	],

	// ElasticSearch
	'wmgDisableSearchUpdate' => [
		'default' => false,
	],
	'wmgSearchType' => [
		'default' => false,
	],

	// Preloader
	'wgPreloaderSource' => [
		'default' => [
 			0 => 'Template:Boilerplate',
 		],
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
	'wmgUseMSCalendar' => [
		'default' => false,
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
	'wmgUseCirrusSearch' => [
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
	'wmgUseCommonsMetadata' => [
		'default' => false,
	],
	'wmgUseContactPage' => [
		'default' => false, // Add wiki config to ContactPage.php
		'apellidosmurcianoswiki' => true,
		'ayrshirewiki' => true,
		'christipediawiki' => true,
		'cdcwiki' => true,
		'fablabesdswiki' => true,
		'guiaslocaiswiki' => true,
		'qboxnextwiki' => true,
		'test2wiki' => true,
	],
	'wmgUseContributionScores' => [
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
	'wmgUseCrossReference' => [
		'default' => false,
	],
	'wmgUseCSS' => [
		'default' => false,
	],
	'wmgUseDarkMode' => [
		'default' => false,
	],
	'wmgUseDataDump' => [
		'default' => true,
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
	'wmgUseDisplayTitle' => [
		'default' => false,
	],
	'wmgUseDisqusTag' => [
		'default' => false,
		'test2wiki' => true,
	],
	'wmgUseDuskToDawn' => [
		'default' => false,
	],
	'wmgUseDonateBoxInSidebar' => [ # Disabled for now --Rececption123
		'default' => false,
		'metawiki' => true,
		'test2wiki' => true,
	],
	'wmgUseDPLForum' => [
		'default' => false,
	],
	'wmgUseDummyFandoomMainpageTags' => [
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
	],
	'wmgUseErudite' => [
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
	'wmgUseKartographer' => [
		'default' => false,
	],
	'wmgUseLabeledSectionTransclusion' => [
		'default' => false,
	],
	'wmgUseLastModified' => [
		'default' => false,
	],
	'wmgUseLiberty' => [
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
		'default' => false,
	],
	'wmgUseModeration' => [
		'default' => false,
	],
	'wmgUseModernSkylight' => [
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
	'wmgUseNumberedHeadings' => [
		'default' => false,
	],
	'wmgUseOpenGraphMeta' => [
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
	'wmgUseSoftRedirector' => [
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
	'wmgUseSpriteSheet' => [
		'default' => false,
	],
	'wmgUseStopForumSpam' => [
		'default' => false,
		'test2wiki' => true,
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
	],
	'wmgUseWhoIsWatching' => [
		'default' => false,
		'test2wiki' => true,
	],
	'wmgUseWidgets' => [
		'default' => false,
	],
	'wmgUseWikibaseRepository' => [
		'default' => false,
	],
	'wmgUseWikibaseClient' => [
		'default' => false,
	],
	'wmgAllowEntityImport' => [
		'default' => false,
	],
	'wmgEnableEntitySearchUI' => [
		'default' => true,
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
		'test2twiki' => true,
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
		// Remove when https://gerrit.wikimedia.org/r/486828/ is merged
		'default' => [
			'audio' => [
				'<^(?:https:)?\/\/upload\\.wikimedia\\.org\/wikipedia\/commons\/>',
			],
			'image' => [
				'<^(?:https:)?\/\/upload\\.wikimedia\\.org\/wikipedia\/commons\/>',
			],
			'svg' => [
				'<^(?:https:)?\/\/upload\\.wikimedia\\.org/wikipedia\/commons\/[^?#]*\\.svg(?:[?#]|$)>',
			],
			'font' => [],
			'namespace' => [ '<.>' ],
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

	// Allow HTML <img> tag
	'wgAllowImageTag' => [
		'default' => false,
	],
	'egApprovedRevsEnabledNamespaces' => [
 		'valkyrienskieswiki' => [
			NS_MAIN => false,
			NS_USER => false,
 			NS_FILE => false,
			NS_TEMPLATE => false,
			NS_HELP => false,
			NS_PROJECT => false
		],
 		'hispanowiki' => [
			NS_USER => false,
 			NS_FILE => false,
			NS_TEMPLATE => false,
			NS_HELP => false,
			NS_PROJECT => false
		],
 		'ucroniaswiki' => [
			NS_USER => false,
 			NS_FILE => false,
			NS_TEMPLATE => false,
			NS_HELP => false,
			NS_PROJECT => false
		],
	],

	// FlaggedRevs
	'wmgFlaggedRevsProtection' => [
		'default' => false,
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
		'default' => 3,
	],
	'wmgFlaggedRevsRestrictionLevels' => [
		'default' => [ '', 'sysop' ],
	],
	'wmgSimpleFlaggedRevsUI' => [
		'default' => false,
	],
	'wmgFlaggedRevsLowProfile' => [
		'default' => false,
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
	// Must be kept insync with wgFileExtensions in ManageWikiSettings.php
	'wgFileExtensions' => [
		'default' => [ 'gif', 'ico', 'jpeg', 'jpg', 'ogg', 'png', 'svg', 'pdf', 'djvu' ],
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
		'default' => 'centralauth',
	],

	// GlobalUserPage
	'wgGlobalUserPageAPIUrl' => [
		'default' => 'https://login.miraheze.org/w/api.php',
	],
	'wgGlobalUserPageDBname' => [
		'default' => 'loginwiki',
	],

	//HideSection
	'wgHideSectionImages' => [
		'default' => false,
		'cikansaiwiki' => [
			'show' => 'https://static.miraheze.org/cikansaiwiki/4/43/HideSectionDOWN.png',
			'hide' => 'https://static.miraheze.org/cikansaiwiki/b/bd/HideSectionUP.png',
			'location' => 'end'
		],
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
		'default' => [],
		'+nonciclopediawiki' => [
			'dlm',
			'olb',
			'tlh',
			'zombie',
		],
		'+hispanowiki' => [
			'w',
			'v',
			'n',
			'u',
			'd',
			'c',
			'commons',
		],
		'+ucroniaswiki' => [
			'w',
			'h',
			'alt',
		],
	],

	// Imports
	'wgImportSources' => [
		'default' => [
			'meta',
			'templatewiki',
		],
		'+incubatorwiki' => [
			'wmincubator',
			'wikiaincubatorplus',
		],
		'+zhdelwiki' => [
			'wikipedia',
			'zhwikipedia',
		],
	],

	// Job Queue
	'wgJobRunRate' => [
		'default' => 0,
	],

	// Kartographer
	'wgKartographerWikivoyageMode' => [
		'default' => false,
	 ],
	'wgKartographerUseMarkerStyle' => [
		'default' => false,
	 ],

	// Language
	'wgLanguageCode' => [ // Hardcode "en"
		'default' => 'en',
	],

	// License
	'wgRightsIcon' => [
		'default' => 'https://meta.miraheze.org/w/resources/assets/licenses/cc-by-sa.png',
		'jadtechwiki' => "https://$wmgUploadHostname/jadtechwiki/d/d8/CopyrightIcon.png",
		'revitwiki' => "https://$wmgUploadHostname/revitwiki/d/d8/All_Rights_Reserved.png",
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

	// Links?
	'+wgUrlProtocols' => [
		'default' => [],
		// file protocol only allowed on private wikis
		'bchwiki' => [ "file://" ],
		'gzewiki' => [ "file://" ],
		'kaiwiki' => [ "file://" ],
	],

	// Mail
	'wgEnableEmail' => [
		'default' => true,
	],
	// When changing the default,
	// also updated ManageWiki.php ("Moderation Email") with the new default.
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
			'categorytree',
			'cite',
			'citethispage',
			'darkmode',
			'globaluserpage',
			'mobilefrontend',
		],
	],
	'wgManageWikiCDBDirectory' => [
		'default' => '/srv/mediawiki/w/cache/managewiki',
	],
	'wgManageWikiNamespacesExtraContentModels' => [
		'default' => [
			'Scribunto' => 'Scribunto',
		],
	],
	'wgManageWikiPermissionsAdditionalAddGroups' => [
		'default' => [],
		'rf1botwiki' => [
			'bureaucrat' => [
				'Repo_Maintainer',
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
		'+cyclonepediawiki' => [
			'bureaucrat' => [
				'bureaucrat' => true,
			],
			'extendedconfirmed' => [
				'extendedconfirmed' => true,
			],
			'sysop' => [
				'extendedconfirmed' => true,
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
		'+nenawikiwiki' => [
			'editor' => [
				'edit-content-pages' => true,
				'edit-talkpage' => true,
			],
			'nenamembers' => [
				'edit-talkpage' => true,
			],
			'sysop' => [
				'edit-admin-pages' => true,
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
		'+quircwiki' => [
			'QuIRC_Staff' => [
				'editstaffprotected' => true,
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
		'+rf1botwiki' => [
			'Repo_Maintainer' => [
				'editrepos' => true,
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
		'+yeoksawiki' => [
			'sysop' => [
				'project-edit' => true,
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
				'editincidents',
				'editothersprofiles-private',
				'flow-suppress',
				'globalblock',
				'globalblock-exempt',
				'globalgroupmembership',
				'globalgrouppermissions',
				'hideuser',
				'interwiki',
				'managewiki-restricted',
				'managewiki-editdefault',
				'moderation-checkuser',
				'mwoauthmanageconsumer',
				'mwoauthmanagemygrants',
				'mwoauthsuppress',
				'mwoauthviewprivate',
				'mwoauthviewsuppressed',
				'oathauth-disable-for-user',
				'oathauth-view-log',
				'renameuser',
				'requestwiki',
				'siteadmin',
				'stopforumspam',
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
	'wgManageWikiNamespacesAdditional' => [
		'default' => [
			// Core config
			'wgExtraSignatureNamespaces' => [
				'name' => 'Enable "Signature" button on the edit toolbar under both main and talk pages.',
				'main' => true,
				'talk' => false,
				'blacklisted' => [],
				'vestyle' => true,
				'overridedefault' => [],
			],
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

	'wgMinervaEnableSiteNotice' => [
		'default' => true,
	],

	// miraheze specific config
	'wgServicesRepo' => [
		'default' => '/srv/services/services',
	],

	'wgMirahezeServicesExtensions' => [
		'default' => [ 'VisualEditor', 'Flow' ],
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
	// Disable in ManageWiki to require all edits, even those by admins, to be approved
	'egApprovedRevsAutomaticApprovals' => [
		'default' => true,
	],

	// MobileFrontend
	'wmgMFAutodetectMobileView' => [
		'default' => false,
	],
	'wgMFDefaultSkinClass' => [
		'default' => 'SkinMinerva',
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
		'alwikiwiki' => [
			'Main Page',
		],
	],
	// Math
	'wgMathValidModes' => [
		'default' => [ 'mathml' ],
	],
	// Namespaces
	'wgMetaNamespace' => [
		'default' => null,
	],
	'wgMetaNamespaceTalk' => [
		'default' => null,
	],

	// OATHAuth
	'wgOATHAuthDatabase' => [
		'default' => 'mhglobal',
	],

	// OAuth
	'wgMWOAuthCentralWiki' => [
		'default' => 'metawiki',
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
		'ssptopwiki' => [
			'read-only' => [
				'edit' => true,
			],
		],
	],
	'wgImplicitGroups' => [
		'default' => [ '*', 'user', 'autoconfirmed' ],
		'bitcoindebateswiki' => [ '*', 'user', 'autoconfirmed', 'emailconfirmed' ],
	],

	// Password policy
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
	'wgRCMaxAge' => [
		'default' => 180 * 24 * 3600,
	],
	'wgRCLinkDays' => [
		'defualt' => [ 1, 3, 7, 14, 30 ],
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
	'+wgRestrictionLevels' => [
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
		'+cyclonepediawiki' => [
			'bureaucrat',
			'extendedconfirmed',
		],
		'+dpwiki' => [
			'bureaucrat',
			'respected',
		],
		'+hypopediawiki' => [
			'bureaucrat',
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
		'+quircwiki' => [
			'editstaffprotected',
		],
		'+rf1botwiki' => [
			'editrepos',
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
		'+testwiki' => [
			'bureaucrat',
			'consul',
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
		'+vnenderbotwiki' => [
			'template',
			'extendedconfirmed',
			'owner'
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
	// Robot policy
	'wgNamespaceRobotPolicies' => [
		'default' => [],
		'taswinwiki' => [
			'NS_TEMPLATE' => 'noindex,nofollow',
		],
		'horizonwiki' => [
			'NS_MAIN' => 'index,follow'
		],
		'hispanowiki' => [
			'NS_TEMPLATE' => 'noindex,nofollow',
			'NS_GUÍA' => 'noindex,nofollow',
			'NS_WIKIPEDIA' => 'noindex,nofollow',
			'NS_PROPUESTA' => 'noindex,nofollow',
			'NS_NOTICIA' => 'noindex,nofollow',
		],
		'ucroniaswiki' => [
			'NS_TEMPLATE' => 'noindex,nofollow',
			'NS_ANEXO' => 'index,follow',
		],
	],

	// Referrer Policy
	'wgReferrerPolicy' => [
		'default' => [ 'origin-when-cross-origin', 'origin-when-crossorigin', 'origin' ],
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
	//
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
		'default' => 'https://$lang.miraheze.org',
	],
	'wgShowHostnames' => [
		'default' => true,
	],
	'wgUsePathInfo' => [
		'default' => true,
	],

	// SiteNotice
	'wgDismissableSiteNoticeForAnons' => [
		'default' => true,
	],

	// SocialProfile
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
		'uncyclopedia2wiki' => [
			'edit' => 50,
			'vote' => 10,
			'comment' => 0,
			'comment_plus' => 40,
			'comment_ignored' => -10,
			'opinions_created' => 0,
			'opinions_pub' => 10,
			'referral_complete' => 0,
			'friend' => 100,
			'foe' => 0,
			'gift_rec' => 25,
			'gift_sent' => 10,
			'points_winner_weekly' => 0,
			'points_winner_monthly' => 0,
			'user_image' => 1000,
			'poll_vote' => 10,
			'quiz_points' => 50,
			'quiz_created' => 20,
		],
	],
	'wgFriendingEnabled' => [
		'default' => true,
		'allthetropeswiki' => false,
	],

	// Statistics
	'wgArticleCountMethod' => [
		'default' => 'link', // To update it, you will need to run the maintenance/updateArticleCount.php script
		'fourleafficswiki' => 'any',
		'gfiwiki' => 'any',
		'hispanowiki' => 'any',
		'hrfwiki2' => 'any',
		'ildrilwiki' => 'any',
		'lothuialethwiki' => 'any',
		'nonciclopediawiki' => 'any',
		'simswiki' => 'any',
		'ucroniaswiki' => 'any',
	],

	// Squid (aka Varnish)
	// Deprecated (1.33)
	'wgUseSquid' => [
		'default' => true,
	],
	'wgSquidServers' => [
		'default' => [
			'128.199.139.216:81', // cp3
			'51.77.107.210:81', // cp6
			'51.89.160.142:81', // cp7
			'51.161.32.127:81', // cp8
		],
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
			'51.161.32.127:81', // cp8
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
	'wgFavicon' => [
		'default' => '/favicon.ico',
	],
	'wgLogo' => [
		'default' => "https://$wmgUploadHostname/metawiki/3/35/Miraheze_Logo.svg",
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

	// Translate
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
	],

	// UniversalLanguageSelector
	'wgULSAnonCanChangeLanguage' => [
		'default' => false,
	],

	// UrlShortener
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
			'www\.thesimswiki\.com',
			'nonciclopedia\.org',
		],
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

	// Protect site config
	'wgProtectSiteLimit' => [
		'default' => '1 week',
	],
	'wgProtectSiteDefaultTimeout' => [
		'default' => '1 hour',
	],

	// WebChat config
	'wmgWebChatServer' => [
		'default' => false,
	],
	'wmgWebChatChannel' => [
		'default' => false,
	],
	'wmgWebChatClient' => [
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

	// WikiDiscover
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

	// Uncategorised
	'wgRandomGameDisplay' => [
		'default' => [
			'random_picturegame' => false,
			'random_poll' => false,
			'random_quiz' => false,
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
$wmgDeleteDatabaseList = file( "/srv/mediawiki/dblist/deleted.dblist" );

// ManageWiki settings
require_once __DIR__ . "/ManageWikiExtensions.php";
require_once __DIR__ . "/ManageWikiSettings.php";

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

if ( php_sapi_name() == 'cli' ) {
	// Only do this if using cli
	foreach ( $wmgDeleteDatabaseList as $wikiLine ) {
		$wgLocalDatabases[] = $wikiLine;
	}
}

$middleMobile = false;

// TODO: Convert this so that we use the url to find the wikiname,
// will lead to performance increase as we won't need to foreach.
foreach ( $wgConf->settings['wgServer'] as $name => $val ) {
	$mobileDomain = isset( $wgConf->settings['wgMobileUrlTemplate'][$name] ) ?
		$wgConf->settings['wgMobileUrlTemplate'][$name] : false;
	if ( $val === 'https://' . $wmgHostname || $mobileDomain === $wmgHostname ) {
		$wgDBname = $name;
		// There is an issue where setting it staticly (e.g *.m.*) would not generate
		// a mobile link. Workaround this by using %h0.m.%h1.%h2.
		if ( $mobileDomain && preg_match( '/^(.+)\.m\.(.+)$/', $mobileDomain, $matches ) ) {
			$middleMobile = '%h0.m.%h1.%h2';
		}
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

$wgUploadPath = "https://static.miraheze.org/$wgDBname";
$wgUploadDirectory = "/mnt/mediawiki-static/$wgDBname";

$wgConf->wikis = $wgLocalDatabases;
$wgConf->extractAllGlobals( $wgDBname );

if ( preg_match( '/^(.*)\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgMobileUrlTemplate = '%h0.m.miraheze.org';
} elseif ( preg_match( '/^(.*)\.m\.miraheze\.org$/', $wmgHostname, $matches ) ) {
	$wgMobileUrlTemplate = '%h0.m.miraheze.org';
}

if ( $middleMobile ) {
	$wgMobileUrlTemplate = $middleMobile;
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

// Placeholder for DB migrations
/*
if ( $wgDBname === 'openhatchwiki' ) {
	$wgReadOnly = 'Miraheze is conducting a database migration.';
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter2';
	function onSiteNoticeAfter2( &$siteNotice, $skin ) {
			$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze will be performing database maintenance on this wiki from 11:10 UTC until approximately 11:30 UTC today. During this maintenance time this wiki will be put in read-only mode. Please save your edits before 11:10 UTC!</td>
			</tr></tbody></table>
EOF;
		return true;
	}
}
}*/


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
if ( $wgDBname !== 'commonswiki' && $wgMirahezeCommons ) {
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared-commons',
		'directory' => '/mnt/mediawiki-static/commonswiki',
		'url' => 'https://static.miraheze.org/commonswiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => 'commonswiki',
		'descBaseUrl' => 'https://commons.miraheze.org/wiki/File:',
	];
}

// Servers accessible by non cache proxies should not have squid/cdn config enabled
if ( !preg_match( "/^mw[0-9]*/", wfHostname() ) ||
     !preg_match( "/^lizardfs6*/", wfHostname() ) ) {
	$wgUseSquid = false;
	$wgUseCdn = false;
}

// When using ?forceprofile=1, a profile can be found as an HTML comment
// Disabled on production hosts because it seems to be causing performance issues (how ironic)
if (
	isset( $_GET['forceprofile'] )
	&& $_GET['forceprofile'] == 1
	&& wfHostname() === 'test1.miraheze.org'
) {
        $wgProfiler['class'] = 'ProfilerXhprof';
        $wgProfiler['output'] = [ 'ProfilerOutputText' ];
        $wgProfiler['visible'] = false;

	// Prevent cache (better be safe than sorry)
        $wgUseSquid = false;
}

// Define last to avoid all dependencies
require_once "/srv/mediawiki/config/LocalWiki.php";

// Define last - Extension message files for loading extensions
if ( !defined( 'MW_NO_EXTENSION_MESSAGES' ) ) {
	require_once "/srv/mediawiki/config/ExtensionMessageFiles.php";
}

if ( PHP_SAPI !== 'cli' ) {
	$host = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '';
	switch ( $host ) {
		case 'jobrunner1.miraheze.org':
			$limit = 1200;
			break;
		default:
			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
				$limit = 110;
			} else {
				$limit = 60;
			}
	}

	set_time_limit( $limit );
}
