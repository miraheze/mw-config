<?php

use MediaWiki\Auth\LocalPasswordPrimaryAuthenticationProvider;
use MediaWiki\Extension\ConfirmEdit\Store\CaptchaCacheStore;
use MediaWiki\Html\Html;
use MediaWiki\SpecialPage\SpecialPage;
use Miraheze\MirahezeMagic\MirahezeIRCRCFeedFormatter;

$wgHooks['CreateWikiDataFactoryBuilder'][] = 'MirahezeFunctions::onCreateWikiDataFactoryBuilder';
$wgHooks['CreateWikiGenerateDatabaseLists'][] = 'MirahezeFunctions::onGenerateDatabaseLists';
$wgHooks['ManageWikiCoreAddFormFields'][] = 'MirahezeFunctions::onManageWikiCoreAddFormFields';
$wgHooks['ManageWikiCoreFormSubmission'][] = 'MirahezeFunctions::onManageWikiCoreFormSubmission';
$wgHooks['MediaWikiServices'][] = 'MirahezeFunctions::onMediaWikiServices';
$wgHooks['BeforePageDisplay'][] = static function ( &$out, &$skin ) {
	if ( $out->getTitle()->isSpecialPage() ) {
		$out->setRobotPolicy( 'noindex,nofollow' );
	}
	return true;
};

if ( $wmgMirahezeContactPageFooter && $wi->isExtensionActive( 'ContactPage' ) ) {
	$wgHooks['SkinAddFooterLinks'][] = static function ( Skin $skin, string $key, array &$footerlinks ) {
		if ( $key === 'places' ) {
			$footerlinks['contact'] = Html::element( 'a',
				[
					'href' => htmlspecialchars( SpecialPage::getTitleFor( 'Contact' )->getFullURL() ),
					'rel' => 'noreferrer noopener',
				],
				$skin->msg( 'contactpage-label' )->text()
			);
		}
	};
}

// Extensions
if ( $wi->dbname !== 'ldapwikiwiki' && $wi->dbname !== 'srewiki' ) {
	wfLoadExtensions( [
		'CentralAuth',
		'GlobalPreferences',
		'GlobalBlocking',
		'RemovePII',
	] );

	// Only allow users with global accounts to login
	$wgCentralAuthStrict = true;

	$wgCentralAuthAutoLoginWikis = $wmgCentralAuthAutoLoginWikis;

	if ( isset( $wgAuthManagerAutoConfig['primaryauth'][LocalPasswordPrimaryAuthenticationProvider::class] ) ) {
		$wgAuthManagerAutoConfig['primaryauth'][LocalPasswordPrimaryAuthenticationProvider::class]['args'][0]['loginOnly'] = true;
	}

	$wgPasswordConfig['null'] = [ 'class' => InvalidPassword::class ];

	$wgLoginNotifyUseCentralId = true;
}

if ( $wi->isExtensionActive( 'chameleon' ) ) {
	wfLoadExtension( 'Bootstrap' );
}

if ( $wi->isExtensionActive( 'CirrusSearch' ) ) {
	wfLoadExtension( 'Elastica' );
	$wgCirrusSearchClusters = [
		'default' => [
			[
				'host' => 'opensearch-mw.wikitide.net',
				'port' => 443,
				'transport' => 'Elastica\Transport\Https',
			],
		],
	];

	if ( $wi->isExtensionActive( 'RelatedArticles' ) ) {
		$wgRelatedArticlesUseCirrusSearch = true;
	}
}

if ( $wi->isExtensionActive( 'StandardDialogs' ) ) {
	wfLoadExtension( 'OOJSPlus' );
}

if ( $wgMirahezeCommons && !$cwPrivate ) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wi->isExtensionActive( 'InterwikiSorting' ) ) {
	$wgInterwikiSortingInterwikiSortOrders = include __DIR__ . '/InterwikiSortOrders.php';
}

if ( $wi->isAllOfExtensionsActive( '3d', 'MultimediaViewer' ) ) {
	$wgMediaViewerExtensions['stl'] = 'mmv.3d';
}

if ( $wi->isExtensionActive( 'Phonos' ) ) {
	$wgPhonosFileBackend = 'miraheze-swift';
}

if ( $wi->isExtensionActive( 'Popups' ) ) {
	if ( $wmgShowPopupsByDefault ) {
		$wgPopupsHideOptInOnPreferencesPage = true;
		$wgPopupsOptInDefaultState = '1';
		$wgPopupsOptInStateForNewAccounts = '1';
		$wgPopupsReferencePreviewsBetaFeature = false;
	}
}

if ( $wi->isExtensionActive( 'SemanticMediaWiki' ) ) {
	require_once '/srv/mediawiki/config/SemanticMediaWiki.php';
}

if ( $wi->isExtensionActive( 'SocialProfile' ) ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";

	$wgSocialProfileFileBackend = 'miraheze-swift';
}

if ( $wi->isExtensionActive( 'UserProfileV2' ) ) {
	$wgUserProfileV2Backend = 'miraheze-swift';
}

if ( $wi->isExtensionActive( 'VisualEditor' ) ) {
	$wgUseRestbaseVRS = false;
	$wgVisualEditorDefaultParsoidClient = 'direct';
	if ( $wmgVisualEditorEnableDefault ) {
		$wgDefaultUserOptions['visualeditor-enable'] = 1;
		$wgDefaultUserOptions['visualeditor-editor'] = 'visualeditor';
	} else {
		$wgDefaultUserOptions['visualeditor-enable'] = 0;
	}
}

if ( $wi->isAnyOfExtensionsActive( 'WikibaseClient', 'WikibaseRepository' ) ) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once '/srv/mediawiki/config/Wikibase.php';
}

$wgVirtualRestConfig = [
	'modules' => [
		'parsoid' => [
			'url' => 'https://mw-lb.wikitide.net/w/rest.php',
			'domain' => $wi->server,
			'prefix' => $wi->dbname,
			'forwardCookies' => (bool)$cwPrivate,
			'restbaseCompat' => false,
		],
	],
	'global' => [
		'domain' => $wgCanonicalServer,
		'timeout' => 360,
		'forwardCookies' => false,
		'HTTPProxy' => null,
	],
];

if ( $wi->isExtensionActive( 'Flow' ) ) {
	$wgFlowParsoidURL = 'https://mw-lb.wikitide.net/w/rest.php';
	$wgFlowParsoidPrefix = $wi->dbname;
	$wgFlowParsoidTimeout = 50;
	$wgFlowParsoidForwardCookies = (bool)$cwPrivate;
}

/**
 * Increase the time that entries are kept in the stash when Moderation is enabled
 * so that they are not deleted by cleanupUploadStash.php before they have
 * a chance to be approved. See T13115 for more details
 */
if ( $wi->isExtensionActive( 'Moderation' ) ) {
	// 2 weeks should be sufficient time
	$wgUploadStashMaxAge = 2 * 7 * 24 * 3600;
}

// Article paths
$articlePath = str_replace( '$1', '', $wgArticlePath );

$wgDiscordNotificationWikiUrl = $wi->server . $articlePath;
$wgDiscordNotificationWikiUrlEnding = '';
$wgDiscordNotificationWikiUrlEndingDeleteArticle = '?action=delete';
$wgDiscordNotificationWikiUrlEndingDiff = '?diff=prev&oldid=';
$wgDiscordNotificationWikiUrlEndingEditArticle = '?action=edit';
$wgDiscordNotificationWikiUrlEndingHistory = '?action=history';
$wgDiscordNotificationWikiUrlEndingUserRights = 'Special:UserRights?user=';

/** TODO:
 * Add to ManageWiki (core)
 * Add rewrites to decode.php and index.php
 */
$wgActionPaths['view'] = $wgArticlePath;

// ?action=raw is not supported by this
// according to documentation
$actions = [
	'delete',
	'edit',
	'history',
	'info',
	'markpatrolled',
	'protect',
	'purge',
	'render',
	'revert',
	'rollback',
	'submit',
	'unprotect',
	'unwatch',
	'watch',
];

foreach ( $actions as $action ) {
	$wgActionPaths[$action] = $wgArticlePath . '?action=' . $action;
}

if ( ( $wgMirahezeActionPathsFormat ?? 'default' ) !== 'default' ) {
	switch ( $wgMirahezeActionPathsFormat ) {
		case 'specialpages':
			$wgActionPaths['edit'] = $articlePath . 'Special:EditPage/$1';
			$wgActionPaths['submit'] = $wgActionPaths['edit'];
			$wgActionPaths['delete'] = $articlePath . 'Special:DeletePage/$1';
			$wgActionPaths['protect'] = $articlePath . 'Special:ProtectPage/$1';
			$wgActionPaths['unprotect'] = $wgActionPaths['protect'];
			$wgActionPaths['history'] = $articlePath . 'Special:PageHistory/$1';
			$wgActionPaths['info'] = $articlePath . 'Special:PageInfo/$1';
			break;
		case '$1/action':
		case 'action/$1':
			foreach ( $actions as $action ) {
				$wgActionPaths[$action] = $articlePath . str_replace( 'action', $action, $wgMirahezeActionPathsFormat );
			}

			break;
	}
}

// Don't need globals here
unset( $actions, $articlePath );

$wgAllowedCorsHeaders[] = 'X-WikiTide-Debug';

// Closed Wikis
if ( $cwClosed ) {
	$wgRevokePermissions = [
		'*' => [
			'block' => true,
			'createaccount' => true,
			'delete' => true,
			'edit' => true,
			'protect' => true,
			'import' => true,
			'upload' => true,
			'undelete' => true,
		],
	];

	if ( $wi->isExtensionActive( 'Comments' ) ) {
		$wgRevokePermissions['*']['comment'] = true;
	}
}

// Public Wikis
if ( !$cwPrivate ) {
	$wgRCFeeds['irc'] = [
		'formatter' => MirahezeIRCRCFeedFormatter::class,
		'uri' => 'udp://10.0.17.143:5070',
		'add_interwiki_prefix' => false,
		'omit_bots' => true,
	];

	$wgDiscordIncomingWebhookUrl = $wmgGlobalDiscordWebhookUrl;
	$wgDiscordExperimentalWebhook = $wmgDiscordExperimentalWebhook;
}

// Dynamic cookie settings dependant on $wgServer
foreach ( $wi->getAllowedDomains() as $domain ) {
	if ( preg_match( '/' . preg_quote( $domain ) . '$/', $wi->server ) ) {
		$wgCentralAuthCookieDomain = '.' . $domain;
		$wgMFStopRedirectCookieHost = '.' . $domain;
		break;
	} else {
		$wgCentralAuthCookieDomain = '';
		if ( $wi->isExtensionActive( 'MobileFrontend' ) ) {
			$host = parse_url( $wi->server, PHP_URL_HOST );
			$wgMFStopRedirectCookieHost = $host !== false ? $host : null;

			// Don't need a global here
			unset( $host );
		}
	}
}

// DataDump
$wgDataDumpFileBackend = 'miraheze-swift';

$wgDataDump = [
	'xml' => [
		'file_ending' => '.xml.gz',
		'useBackendTempStore' => true,
		'generate' => [
			'type' => 'mwscript',
			'script' => "$IP/maintenance/dumpBackup.php",
			'options' => [
				'--full',
				'--logs',
				'--uploads',
				'--output',
				'gzip:/tmp/${filename}',
			],
			'arguments' => [
				'--namespaces'
			],
		],
		'limit' => 1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'generate-dump',
			'delete' => 'delete-dump',
		],
		'htmlform' => [
			'name' => 'namespaceselect',
			'type' => 'namespaceselect',
			'exists' => true,
			'noArgsValue' => 'all',
			'hide-if' => [ '!==', 'generatedumptype', 'xml' ],
			'label-message' => 'datadump-namespaceselect-label'
		],
	],
	'image' => [
		'file_ending' => '.tar.gz',
		'useBackendTempStore' => true,
		'logFailedExitCodeComments' => [
			75 => 'The dump is too large. Please contact a member of the Technology team to assist with generating this dump.',
		],
		'generate' => [
			'type' => 'mwscript',
			'script' => "$IP/extensions/MirahezeMagic/maintenance/swiftDump.php",
			'options' => [
				'--filename',
				'${filename}'
			],
		],
		'limit' => 1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'managewiki-restricted',
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
];

if ( $wi->isExtensionActive( 'Flow' ) ) {
	$wgDataDump['flow'] = [
		'file_ending' => '.xml.gz',
		'useBackendTempStore' => true,
		'generate' => [
			'type' => 'mwscript',
			'script' => "$IP/extensions/Flow/maintenance/dumpBackup.php",
			'options' => [
				'--full',
				'--output',
				'gzip:/tmp/${filename}',
			],
		],
		'limit' => 1,
		'permissions' => [
			'view' => 'view-dump',
			'generate' => 'generate-dump',
			'delete' => 'delete-dump',
		],
	];
}

// ContactPage configuration
if ( $wi->isExtensionActive( 'ContactPage' ) ) {
	$wgContactConfig = [
		'default' => [
			'RecipientUser' => $wmgContactPageRecipientUser ?? null,
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Contact Form on ' . $wgSitename,
			'RequireDetails' => true,
			// Should never be set to true
			'IncludeIP' => false,
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
	];
}

// UploadWizard configuration
if ( $wi->isExtensionActive( 'UploadWizard' ) ) {
	$wgUploadWizardConfig = [
		'campaignExpensiveStatsEnabled' => false,
		'flickrApiKey' => $wmgUploadWizardFlickrApiKey,
	];
}

// FeaturedFeeds configuration

if ( $wi->isExtensionActive( 'FeaturedFeeds' ) ) {
	if ( $wmgMirahezeFeaturedFeedsInUserLanguage ) {
		$wgFeaturedFeedsDefaults['inUserLanguage'] = true;
	} else {
		$wgFeaturedFeedsDefaults['inUserLanguage'] = false;
	}
}

if ( $wi->isExtensionActive( 'Score' ) ) {
	$wgScoreFileBackend = 'miraheze-swift';
}

if ( $wi->isExtensionActive( 'EasyTimeline' ) ) {
	$wgTimelineFileBackend = 'miraheze-swift';
}

if ( !$wi->isExtensionActive( 'wikiseo' ) ) {
	$wgSkinMetaTags = [ 'og:title', 'og:type' ];
}

// $wgFooterIcons
if ( (bool)$wmgWikiapiaryFooterPageName ) {
	$wgFooterIcons['poweredby']['wikiapiary'] = [
		'src' => 'https://static.wikitide.net/commonswiki/b/b4/Monitored_by_WikiApiary.png',
		'url' => 'https://wikiapiary.com/wiki/' . str_replace( ' ', '_', $wmgWikiapiaryFooterPageName ),
		'alt' => 'Monitored by WikiApiary'
	];
}

// $wgForeignFileRepos
if ( $wmgEnableSharedUploads && $wmgSharedUploadDBname && in_array( $wmgSharedUploadDBname, $wgLocalDatabases ) ) {
	if ( !$wmgSharedUploadBaseUrl || $wmgSharedUploadBaseUrl === $wmgSharedUploadDBname ) {
		$wmgSharedUploadSubdomain = substr( $wmgSharedUploadDBname, 0, -4 );

		$wmgSharedUploadBaseUrl = "{$wmgSharedUploadSubdomain}.miraheze.org";
	}

	$wgForeignFileRepos[] = [
		'class' => ForeignDBViaLBRepo::class,
		'name' => "shared-{$wmgSharedUploadDBname}",
		'backend' => 'miraheze-swift',
		'url' => "https://static.wikitide.net/{$wmgSharedUploadDBname}",
		'hashLevels' => 2,
		'thumbScriptUrl' => false,
		'transformVia404' => true,
		'hasSharedCache' => true,
		'descBaseUrl' => "https://{$wmgSharedUploadBaseUrl}/wiki/File:",
		'scriptDirUrl' => "https://{$wmgSharedUploadBaseUrl}/w",
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => $wmgSharedUploadDBname,
		'initialCapital' => true,
		'zones' => [
			'public' => [
				'container' => 'local-public',
			],
			'thumb' => [
				'container' => 'local-thumb',
			],
			'temp' => [
				'container' => 'local-temp',
			],
			'deleted' => [
				'container' => 'local-deleted',
			],
		],
		'abbrvThreshold' => 160
	];
}

// Miraheze Commons
if ( $wgDBname !== 'commonswiki' && $wgMirahezeCommons && strpos( wfHostname(), 'test' ) === false ) {
	$wgForeignFileRepos[] = [
		'class' => ForeignDBViaLBRepo::class,
		'name' => 'mirahezecommons',
		'backend' => 'miraheze-swift',
		'url' => 'https://static.wikitide.net/commonswiki',
		'hashLevels' => 2,
		'thumbScriptUrl' => false,
		'transformVia404' => true,
		'hasSharedCache' => true,
		'descBaseUrl' => 'https://commons.miraheze.org/wiki/File:',
		'scriptDirUrl' => 'https://commons.miraheze.org/w',
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'wiki' => 'commonswiki',
		'initialCapital' => true,
		'zones' => [
			'public' => [
				'container' => 'local-public',
			],
			'thumb' => [
				'container' => 'local-thumb',
			],
			'temp' => [
				'container' => 'local-temp',
			],
			'deleted' => [
				'container' => 'local-deleted',
			],
		],
		'abbrvThreshold' => 160
	];
}

// $wgLogos
$wgLogos = [
	'1x' => $wgLogo,
];

$wgApexLogo = [
	'1x' => $wgLogos['1x'],
	'2x' => $wgLogos['1x'],
];

if ( $wgIcon ) {
	$wgLogos['icon'] = $wgIcon;
}

if ( $wgWordmark ) {
	$wgLogos['wordmark'] = [
		'src' => $wgWordmark,
		'width' => $wgWordmarkWidth,
		'height' => $wgWordmarkHeight,
	];
}

// $wgUrlShortenerAllowedDomains
$wgUrlShortenerAllowedDomains = [
	'(.*\.)?miraheze\.org',
	'(.*\.)?wikitide\.org',
];

if ( preg_match( '/(mirabeta|nexttide)\.org$/', $wi->server ) ) {
	$wgUrlShortenerAllowedDomains = [
		'(.*\.)?mirabeta\.org',
		'(.*\.)?nexttide\.org',
	];
	$wgParserMigrationEnableQueryString = true;
}

if ( !preg_match( '/(miraheze|mirabeta|nexttide|wikitide)\.org$/', $wi->server ) ) {
	$wgUrlShortenerAllowedDomains = array_merge(
		$wgUrlShortenerAllowedDomains,
		[ preg_quote( str_replace( 'https://', '', $wi->server ) ) ]
	);
}

// JsonConfig
if ( $wi->isExtensionActive( 'JsonConfig' ) ) {
	$wgJsonConfigs = [
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
	];

	if ( $wgDBname !== 'commonswiki' ) {
		$wgJsonConfigs['Map.JsonConfig']['remote'] = [
			'url' => 'https://commons.miraheze.org/w/api.php'
		];

		$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
			'url' => 'https://commons.miraheze.org/w/api.php'
		];
	}
}

if ( $wi->isExtensionActive( 'TimedMediaHandler' ) ) {
	// The default $wgEnabledTranscodeSet will include WebM VP9 flat file
	// transcodes from 240p to 2160p. Leave them enabled site-wide.
	//
	// Also enable a single WebM VP8 flat file for backwards compatibility.
	$wgEnabledTranscodeSet['360p.webm'] = true;

	// Temporarilly disable 1440p and 2160p transcodes:
	// they're very slow to generate and we need to tune
	$wgEnabledTranscodeSet['1440p.vp9.webm'] = false;
	$wgEnabledTranscodeSet['2160p.vp9.webm'] = false;

	// 4GB
	$wgTranscodeBackgroundMemoryLimit = 4 * 1024 * 1024;

	// This allows using 2x the threads for VP9 encoding, but will
	// fail if running a too-old ffmpeg version.
	$wgFFmpegVP9RowMT = true;

	// VP9 encoding benefits from more threads; up to 4 for HD or
	// 8 when using row-based multithreading.
	//
	// Note compression of second pass is "spiky", alternating between
	// single-threaded and multithreaded portions, so you can somewhat
	// overcommit process threads per CPU thread.
	$wgFFmpegThreads = 4;

	// HD transcodes of full-length films/docs/conference vids can
	// take several hours, and sometimes over 12. Bump up from default
	// 8 hour limit to 16 to avoid wasting the time we've already spent
	// when breaking these off.
	// Then double that for VP9, which is more intense on the CPU.
	$wgTranscodeBackgroundTimeLimit = 32 * 3600;

	// ffmpeg tends to use about 175% CPU when dual-threaded, so hits
	// say an 8-hour ulimit in 4-6 hours. This tends to cut
	// off very large files at very high resolution just before
	// they finish, wasting a lot of time.
	// Pad it back out so we don't waste that CPU time with a fail!
	$wgTranscodeBackgroundTimeLimit *= $wgFFmpegThreads;
}

// Vector
$vectorVersion = $wgDefaultSkin === 'vector-2022' ? '2' : '1';
$wgVectorDefaultSkinVersionForExistingAccounts = $vectorVersion;

// Don't need a global here
unset( $vectorVersion );

// Licensing variables

$version = $wi->version;

// Alpha is only available on the test server,
// use beta (or stable if there currently is no beta)
// for foreign metawiki links if the version is alpha.
if ( $wi->version === MirahezeFunctions::MEDIAWIKI_VERSIONS['alpha'] ) {
	$version = MirahezeFunctions::MEDIAWIKI_VERSIONS['beta'] ??
		MirahezeFunctions::MEDIAWIKI_VERSIONS['stable'];
}

$beta = preg_match( '/^(.*)\.(mirabeta|nexttide)\.org$/', $wi->server );
$mirahost = $beta ? 'mirabeta' : 'miraheze';

/**
 * Default values.
 * We can not set these in LocalSettings.php, to prevent them
 * from causing absolute overrides.
 */
$wgRightsIcon = "https://meta.{$mirahost}.org/{$version}/resources/assets/licenses/cc-by-sa.png";
$wgRightsText = 'Creative Commons Attribution Share Alike';
$wgRightsUrl = 'https://creativecommons.org/licenses/by-sa/4.0/';

/**
 * Override values from ManageWiki.
 * If set in LocalSettings.php, this will be overridden
 * by wiki values there, due to caching forcing SiteConfiguration
 * values to be absolute overrides. This is however how licensing should
 * be forced. LocalSettings.php values should take priority, which they do.
 */
switch ( $wmgWikiLicense ) {
	case 'arr':
		$wgRightsIcon = 'https://static.wikitide.net/commonswiki/6/67/License_icon-copyright-88x31.svg';
		$wgRightsText = 'All Rights Reserved';
		$wgRightsUrl = false;
		break;
	case 'cc-by':
		$wgRightsIcon = 'https://meta.miraheze.org/' . $version . '/resources/assets/licenses/cc-by.png';
		$wgRightsText = 'Creative Commons Attribution 4.0 International (CC BY 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by/4.0';
		break;
	case 'cc-by-nc':
		$wgRightsIcon = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc.png';
		$wgRightsText = 'Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nc/4.0/';
		break;
	case 'cc-by-nd':
		$wgRightsIcon = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nd.png';
		$wgRightsText = 'Creative Commons Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nd/4.0/';
		break;
	case 'cc-by-sa':
		$wgRightsText = 'Creative Commons Attribution-ShareAlike 4.0 International (CC BY-SA 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-sa/4.0/';
		break;
	case 'cc-by-sa-2-0-kr':
		$wgRightsText = 'Creative Commons BY-SA 2.0 Korea';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-sa/2.0/kr';
		break;
	case 'cc-by-sa-nc':
		$wgRightsIcon = 'https://meta.miraheze.org/' . $version . '/resources/assets/licenses/cc-by-nc-sa.png';
		$wgRightsText = 'Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nc-sa/4.0/';
		break;
	case 'cc-by-nc-nd':
		$wgRightsIcon = 'https://mirrors.creativecommons.org/presskit/buttons/88x31/png/by-nc-nd.png';
		$wgRightsText = 'Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0)';
		$wgRightsUrl = 'https://creativecommons.org/licenses/by-nc-nd/4.0/';
		break;
	case 'cc-pd':
		$wgRightsIcon = 'https://meta.miraheze.org/' . $version . '/resources/assets/licenses/cc-0.png';
		$wgRightsText = 'CC0 Public Domain';
		$wgRightsUrl = 'https://creativecommons.org/publicdomain/zero/1.0/';
		break;
	case 'gpl-v3':
		$wgRightsIcon = 'https://www.gnu.org/graphics/gplv3-or-later.png';
		$wgRightsText = 'GPLv3';
		$wgRightsUrl = 'https://www.gnu.org/licenses/gpl-3.0-standalone.html';
		break;
	case 'gfdl':
		$wgRightsIcon = 'https://www.gnu.org/graphics/gfdl-logo-tiny.png';
		$wgRightsText = 'GNU Free Document License 1.3';
		$wgRightsUrl = 'https://www.gnu.org/licenses/fdl-1.3.en.html';
		break;
	case 'empty':
		break;
}

// Don't need a global here
unset( $version );

/**
 * Make sure it works to override the footer icon
 * for other overrides in LocalSettings.php.
 */
if ( $wgConf->get( 'wgRightsIcon', $wi->dbname ) ) {
	$wgFooterIcons['copyright']['copyright'] = [
		'url' => $wgConf->get( 'wgRightsUrl', $wi->dbname ),
		'src' => $wgConf->get( 'wgRightsIcon', $wi->dbname ),
		'alt' => $wgConf->get( 'wgRightsText', $wi->dbname ),
	];
}

// Kilobytes
$wgMaxShellFileSize = 512 * 1024;
$wgMaxShellMemory = 1024 * 1024;

// 50 seconds
$wgMaxShellTime = 50;

$wgShellCgroup = '/sys/fs/cgroup/memory/mediawiki/job';

$mwTask = strpos( wfHostname(), 'mwtask' ) === 0;
if ( $mwTask ) {
	if ( strpos( $_SERVER['HTTP_HOST'] ?? '', 'videoscaler.' ) === 0 ) {
		$wgMaxShellWallClockTime = 86400;
	} elseif ( strpos( $_SERVER['HTTP_HOST'] ?? '', 'jobrunner-high.' ) === 0 ) {
		$wgMaxShellWallClockTime = 259200;
	} else {
		$wgMaxShellWallClockTime = 60;
	}
} else {
	$wgMaxShellWallClockTime = 60;
}

$wgJobRunRate = 0;
$wgJobBackoffThrottling['htmlCacheUpdate'] = 50;

$wgJobTypesExcludedFromDefaultQueue[] = 'webVideoTranscode';
$wgJobTypesExcludedFromDefaultQueue[] = 'webVideoTranscodePrioritized';

$wgSVGConverters['rsvg'] = '$path/rsvg-convert -w $width -h $height -o $output $input';

// We need all thumbs to be regenerated
$wgThumbnailEpoch = 20230715011058;

// Scribunto
/** 50MB */
$wgScribuntoEngineConf['luasandbox']['memoryLimit'] = 50 * 1024 * 1024;
$wgScribuntoEngineConf['luasandbox']['cpuLimit'] = 10;

// For Scribunto / wgCodeEditorEnableCore
$wgULSNoImeSelectors[] = '.ace_editor textarea';

$wgMaxMsgCacheEntrySize = 1024;

$wgPoolCounterConf = [
	'ArticleView' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 15,
		'workers' => 2,
		'maxqueue' => 100,
		'fastStale' => true,
	],
	'CirrusSearch-Search' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 15,
		'workers' => 200,
		'maxqueue' => 200,
	],
	// Software tries to recognize sources of external automation, such as GAE,
	// AWS, browser automation, etc. and give them a separate pool so they
	// can cap out without interfering with interactive users.
	'CirrusSearch-Automated' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 15,
		'workers' => 30,
		'maxqueue' => 35,
	],
	// Super common and mostly fast
	'CirrusSearch-Prefix' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 15,
		'workers' => 32,
		'maxqueue' => 40,
	],
	// Super common and mostly fast, replaces Prefix (eventually)
	'CirrusSearch-Completion' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 15,
		'workers' => 432,
		'maxqueue' => 450,
	],
	// Pool counter for expensive full text searches such as regex
	// and deepcat.
	'CirrusSearch-ExpensiveFullText' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 60,
		'workers' => 10,
		'maxqueue' => 15,
	],
	// These should be very very fast
	'CirrusSearch-NamespaceLookup' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 5,
		'workers' => 100,
		'maxqueue' => 120,
	],
	// These are very expensive and incredibly common.
	'CirrusSearch-MoreLike' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 5,
		'workers' => 150,
		'maxqueue' => 175,
	],
	'FileRender' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 8,
		'workers' => 2,
		'maxqueue' => 100,
	],
	'FileRenderExpensive' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 8,
		'workers' => 2,
		'slots' => 8,
		'maxqueue' => 100,
	],
	'SpecialContributions' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 15,
		'workers' => 2,
		'maxqueue' => 25,
	],
	'TranslateFetchTranslators' => [
		'class' => 'PoolCounter_Client',
		'timeout' => 8,
		'workers' => 1,
		'slots' => 16,
		'maxqueue' => 20,
	],
];

$wgPoolCountClientConf = [
	'servers' => [ $beta ? '10.0.15.118:7531' : '10.0.15.142:7531' ],
	'timeout' => 0.5,
	'connect_timeout' => 0.01
];

// Mathoid
$mathoidHosts = [
	'http://10.0.15.150:10044',
	'http://10.0.16.157:10044',
	'http://10.0.17.144:10044',
	'http://10.0.18.106:10044',
];

$wgMathMathMLUrl = $beta ?
	'http://10.0.15.118:10044' :
	$mathoidHosts[array_rand( $mathoidHosts )];
$wgMathSvgRenderer = 'mathoid';
$wgMathUseInternalRestbasePath = false;

// ConfirmEdit (hCaptcha)
// Needed as the server uses ipv4 only.
$wgHCaptchaProxy = 'http://bastion.wikitide.net:8080';
$wgCaptchaStorageClass = CaptchaCacheStore::class;
$wgCaptchaRegexes[] = '/<a +href/i';

// 12 MB
$wgAPIMaxResultSize = 12582912;

$wgReferrerPolicy = $cwPrivate ?
	'no-referrer' :
	[ 'origin-when-cross-origin', 'origin' ];

$wgHTTPImportTimeout = 50;

// Notifications
$wgNotifyTypeAvailabilityByCategory['login-success']['web'] = false;
