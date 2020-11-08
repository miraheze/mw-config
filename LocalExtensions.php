<?php

// Set up extensions for use on wikis that are not global
if ( $wmgUse3D ) {
	wfLoadExtension( '3D' );

	$wg3dProcessor = [
		'/usr/bin/xvfb-run', '-a', '-s', '-ac -screen 0 1280x1024x24' ,'/srv/3d2png/3d2png.js'
	];

	$wgManageWikiSettings['wgFileExtensions']['overridedefault'][] = 'stl';

	$wi->config->settings['wgFileExtensions']['default'][] = 'stl';

	$wi->config->settings['wgTrustedMediaFormats']['default'][] = 'application/sla';
}

if ( $wmgUseAddThis ) {
	wfLoadExtension( 'AddThis' );

	$wgAddThisHeader = false;
}

if ( $wmgUseAddHTMLMetaAndTitle ) {
	wfLoadExtension( 'AddHTMLMetaAndTitle' );
}

if ( $wmgUseAdminLinks ) {
	wfLoadExtension( 'AdminLinks' );
}

if ( $wmgUseAdvancedSearch ) {
	wfLoadExtension( 'AdvancedSearch' );
}

if ( $wmgUseAJAXPoll ) {
	wfLoadExtension( 'AJAXPoll' );
}

if ( $wmgUseApex ) {
	wfLoadSkin( 'apex' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Apex'] = 'apex';

	$wgApexLogo = [
		'1x' => $wgLogo,
		'2x' => $wgLogo,
	];
}

if ( $wmgUseApprovedRevs ) {
	wfLoadExtension( 'ApprovedRevs' );

	$wgAvailableRights[] = 'approverevisions';
	$wgAvailableRights[] = 'viewlinktolatest';
	$wgAvailableRights[] = 'viewapprover';

	$wi->config->settings['wgManageWikiNamespacesAdditional']['default']['egApprovedRevsEnabledNamespaces'] = [
		'name' => 'Enable ApprovedRevs in this namespace?',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'vestyle' => true,
		'overridedefault' => false
	];
}

if ( $wmgUseArrays ) {
	wfLoadExtension( 'Arrays' );
}

if ( $wmgUseArticleRatings ) {
	wfLoadExtension( 'ArticleRatings' );
}

if ( $wmgUseArticleToCategory2 ) {
	wfLoadExtension( 'ArticleToCategory2' );
}

if ( $wmgUseAuthorProtect ) {
	wfLoadExtension( 'AuthorProtect' );
	$wi->config->settings['wgRestrictionLevels']['default'][] = 'author';
}

if ( $wmgUseAutoCreateCategoryPages ) {
	wfLoadExtension( 'AutoCreateCategoryPages' );
}

if ( $wmgUseAutoCreatePage ) {
	require_once "$IP/extensions/AutoCreatePage/AutoCreatePage.php";
}

if ( $wmgUseBabel ) {
	wfLoadExtension( 'Babel' );
}

if ( $wmgUseBlogPage ) {
	wfLoadExtension( 'BlogPage' );
	$wgBlogPageDisplay['comments_of_day'] = false;
}

if ( $wmgUseMSCalendar ) {
	wfLoadExtension( 'MsCalendar' );
}

if ( $wmgUseCentralAuth ) {
	wfLoadExtension( 'CentralAuth' );
}

if ( $wmgUseCargo ) {
	wfLoadExtension( 'Cargo' );
}

if ( $wmgUseCategorySortHeaders ) {
	require_once "$IP/extensions/CategorySortHeaders/CategorySortHeaders.php";
}

if ( $wmgUseCategoryTree ) {
	wfLoadExtension( 'CategoryTree' );
}

if ( $wmgUseCapiunto ) {
	wfLoadExtension( 'Capiunto' );
}

if ( $wmgUseCharInsert ) {
	wfLoadExtension( 'CharInsert' );
}

if ( $wmgUseCirrusSearch ) {
	wfLoadExtensions( [
		'CirrusSearch',
		'Elastica',
	] );

	$wgCirrusSearchClusters = [
		'default' => [
			[
				'host' => 'es-lb.miraheze.org',
				'transport' => 'Https',
				'port' => '443',
			],
		],
	];

	$wgCirrusSearchAllowLeadingWildcard = false;
	$wgCirrusSearchQueryStringMaxDeterminizedStates = 500;
	$wgCirrusSearchSearchShardTimeout[ 'regex' ] = '15s';
	$wgCirrusSearchClientSideSearchTimeout[ 'regex' ] = 50;
	$wgCirrusSearchSearchShardTimeout[ 'default' ] = '10s';
	$wgCirrusSearchClientSideSearchTimeout[ 'default' ] = 40;
	$wgCirrusSearchReplicas = '0-0';
	$wgCirrusSearchDropDelayedJobsAfter = 60 * 60 * 2;
	$wgCirrusSearchConnectionAttempts = 3;
	$wgCirrusSearchMasterTimeout = '5m';

	$wgCirrusSearchShardCount = [ 'content' => 2, 'general' => 2, 'archive' => 2, 'titlesuggest' => 2 ];

	if ( $wmgSearchType ) {
		$wgSearchType = 'CirrusSearch';
	}

	if ( $wmgDisableSearchUpdate ) {
		$wgDisableSearchUpdate = true;
	} else {
		$wgDisableSearchUpdate = false;
	}
}

if ( $wmgUseCite ) {
	wfLoadExtension( 'Cite' );
}

if ( $wmgUseCiteThisPage ) {
	wfLoadExtension( 'CiteThisPage' );
}

if ( $wmgUseCitoid ) {
	wfLoadExtension( 'Citoid' );

	$wgCitoidFullRestbaseURL = "https://{$wi->hostname}/{$wi->hostname}/";
}

if ( $wmgUseCleanChanges ) {
	wfLoadExtension( 'CleanChanges' );
	$wi->config->settings['+wgDefaultUserOptions']['default']['usenewrc'] = 1;
}

if ( $wmgUseCodeEditor ) {
	wfLoadExtension( 'CodeEditor' );
}

if ( $wmgUseCodeMirror ) {
	wfLoadExtension( 'CodeMirror' );
}

if ( $wmgUseCollapsibleVector ) {
	wfLoadExtension( 'CollapsibleVector' );
}

if ( $wmgUseCollection ) {
	wfLoadExtension( 'Collection' );

	$wgCommunityCollectionNamespace = 5;

	$wgCollectionMWServeURL = 'https://ocg-lb.miraheze.org';

	$wgCollectionPODPartners = [];

	wfLoadExtension( 'ElectronPdfService' );
}

if ( $wmgUseCommentStreams ) {
	wfLoadExtension ( 'CommentStreams' );
	$wi->config->settings['wgManageWikiNamespacesAdditional']['default']['wgCommentStreamsAllowedNamespaces'] = [
		'name' => 'Can comments appear in this namespace?',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'vestyle' => false,
		'overridedefault' => null,
	];
}

if ( $wmgUseComments ) {
	wfLoadExtension( 'Comments' );
}

if ( $wmgUseCommonsMetadata ) {
	wfLoadExtension( 'CommonsMetadata' );
}

if ( $wmgUseContactPage ) {
	wfLoadExtension( 'ContactPage' );

	// Contact Page is a fairly complex (well long) extension to configure.
	// All config should be in the file below on a wikidb basis.
	require_once "/srv/mediawiki/config/ContactPage.php";
}

if ( $wmgUseContributionScores ) {
	require_once "$IP/extensions/ContributionScores/ContributionScores.php";
}

if ( $wmgUseCosmos ){
	wfLoadSkin( 'Cosmos' );
	$wgManageWikiSettings['wgDefaultSkin']['options']['Cosmos'] = 'cosmos';
}

if ( $wmgUseCreatePage ) {
	require_once "$IP/extensions/CreatePage/CreatePage.php";
}
if ( $wmgUseCreatePageUw ) {
	wfLoadExtension( 'CreatePageUw' );
}
if ( $wmgUseCreateRedirect ) {
	wfLoadExtension( 'CreateRedirect' );
}

if ( $wmgUseCSS ) {
	wfLoadExtension( 'CSS' );
}

if ( $wmgUseCalendarWikivoyage ) {
	wfLoadExtension( 'Calendar' );
}

if ( $wmgUseCitizen ) {
	wfLoadSkin( 'Citizen' );
	$wgManageWikiSettings['wgDefaultSkin']['options']['Citizen'] = 'citizen';
}

if ( $wmgUseDarkMode ) {
	wfLoadExtension( 'DarkMode' );
}

/**
 * This is a global extension, but we define the config here.
 */
if ( $wmgUseDataDump ) {
	wfLoadExtension( 'DataDump' );

	$wgDataDumpDirectory = "/mnt/mediawiki-static/private/dumps/{$wgDBname}/";

	$wgDataDump = [
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
					"gzip:{$wgDataDumpDirectory}" . '${filename}',
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
					"/mnt/mediawiki-static/{$wgDBname}/archive",
					'--exclude',
					"/mnt/mediawiki-static/{$wgDBname}/deleted",
					'--exclude',
					"/mnt/mediawiki-static/{$wgDBname}/lockdir",
					'--exclude',
					"/mnt/mediawiki-static/{$wgDBname}/temp",
					'--exclude',
					"/mnt/mediawiki-static/{$wgDBname}/thumb",
					'-zcvf',
					$wgDataDumpDirectory . '${filename}',
					"/mnt/mediawiki-static/{$wgDBname}/"
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
	];

	$wgAvailableRights[] = 'view-dump';
	$wgAvailableRights[] = 'generate-dump';
	$wgAvailableRights[] = 'delete-dump';
}

if ( $wmgUseDataTransfer ) {
	wfLoadExtension( 'DataTransfer' );
}

if ( $wmgUseDeleteUserPages ) {
	wfLoadExtension( 'DeleteUserPages' );
}

if ( $wmgUseDescription2 ) {
	wfLoadExtension( 'Description2' );

	$wgEnableMetaDescriptionFunctions = true;
}

if ( $wmgUseDisambiguator ) {
	wfLoadExtension( 'Disambiguator' );
}

if ( $wmgUseDiscussionTools ) {
	wfLoadExtension( 'DiscussionTools' );
}

if ( $wmgUseDisplayTitle ) {
	wfLoadExtension( 'DisplayTitle' );
}

if ( $wmgUseDismissableSiteNotice ) {
	wfLoadExtension( 'DismissableSiteNotice' );
}

if ( $wmgUseDisqusTag ) {
	wfLoadExtension( 'DisqusTag' );
}

if ( $wmgUseDuskToDawn ) {
	wfLoadSkin( 'DuskToDawn' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['DuskToDawn'] = 'dusktodawn';
}

if ( $wmgUseDonateBoxInSidebar ) {
	require_once "$IP/extensions/DonateBoxInSidebar/DonateBoxInSidebar.php";
}

if ( $wmgUseDPLForum ) {
	wfLoadExtension( 'DPLForum' );
}

if ( $wmgUseDummyFandoomMainpageTags ) {
	wfLoadExtension( 'DummyFandoomMainpageTags' );
}

if ( $wmgUseDynamicPageList ) {
	wfLoadExtension( 'DynamicPageList' );
}

if ( $wmgUseDynamicPageList3 ) {
	wfLoadExtension( 'DynamicPageList3' );
}

if ( $wmgUseDynamicSidebar ) {
	wfLoadExtension( 'DynamicSidebar' );
}

if ( $wmgUseEditcount ) {
	wfLoadExtension( 'Editcount' );
}

if ( $wmgUseEditSubpages ) {
	wfLoadExtension( 'EditSubpages' );
}

if ( $wmgUseErudite ) {
	wfLoadSkin( 'erudite' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Erudite'] = 'erudite';
}

if ( $wmgUseFancyBoxThumbs ) {
	require_once "$IP/extensions/FancyBoxThumbs/FancyBoxThumbs.php";
}

if ( $wmgUseFemiwiki ) {
	wfLoadSkin( 'Femiwiki' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Femiwiki'] = 'femiwiki';
}

if ( $wmgUseFlaggedRevs ) {
	wfLoadExtension( 'FlaggedRevs' );

	$wgFlaggedRevsProtection = $wmgFlaggedRevsProtection;
	$wgFlaggedRevsTags = $wmgFlaggedRevsTags;
	$wgFlaggedRevsTagsRestrictions = $wmgFlaggedRevsTagsRestrictions;
	$wgFlaggedRevsTagsAuto = $wmgFlaggedRevsTagsAuto;
	$wgFlaggedRevsAutopromote = $wmgFlaggedRevsAutopromote;
	$wgFlaggedRevsAutoReview = $wmgFlaggedRevsAutoReview;
	$wgFlaggedRevsRestrictionLevels = $wmgFlaggedRevsRestrictionLevels;
	$wgSimpleFlaggedRevsUI = $wmgSimpleFlaggedRevsUI;
	$wgFlaggedRevsLowProfile = $wmgFlaggedRevsLowProfile;

	$wi->config->settings['wgManageWikiNamespacesAdditional']['default']['wgFlaggedRevsNamespaces'] = [
		'name' => 'Enable FlaggedRevs in this namespace?',
		'main' => true,
		'talk' => false,
		'blacklisted' => [ 8 ],
		'vestyle' => false,
		'overridedefault' => false
	];
}

if ( $wmgUseFlow ) {
	wfLoadExtension( 'Flow' );

	$wgVirtualRestConfig['modules']['parsoid'] = [
		'url' => 'https://parsoid-lb.miraheze.org:443',
		'domain' => $wgServer,
		'prefix' => $wgDBname,
		'forwardCookies' => true,
		'restbaseCompat' => false,
	];

	$wi->config->settings['wgManageWikiPermissionsAdditionalRights']['default']['oversight']['flow-suppress'] = true;
	$wi->config->settings['wgManageWikiNamespacesExtraContentModels']['default']['Flow'] = 'flow-board';
}

if ( $wmgUseFeaturedFeeds ) {
	wfLoadExtension( 'FeaturedFeeds' );
}

if ( $wmgUseForcePreview) {
	wfLoadExtension( 'ForcePreview' );
}

if ( $wmgUseForeground ) {
	wfLoadSkin( 'foreground' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Foreground'] = 'foreground';
}

if ( $wmgUseFontAwesome ) {
	wfLoadExtension( 'FontAwesome' );
}

if ( $wmgUseGadgets ) {
	wfLoadExtension( 'Gadgets' );
}

if ( $wmgUseGamepress ) {
	wfLoadSkin( 'Gamepress' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Gamepress'] = 'gamepress';
	$wgManageWikiSettings['wgDefaultTheme']['options']['Blue (Gamepress only)'] = 'blue';
	$wgManageWikiSettings['wgDefaultTheme']['options']['Green (Gamepress only)'] = 'green';
	$wgManageWikiSettings['wgDefaultTheme']['options']['Orange (Gamepress only)'] = 'orange';
}

if ( $wmgUseGenealogy ) {
	wfLoadExtension( 'Genealogy' );
}

if ( $wmgUseGeoCrumbs ) {
	wfLoadExtension( 'GeoCrumbs' );
}

if ( $wmgUseGeoData ) {
	wfLoadExtension( 'GeoData' );
}

if ( $wmgUseGettingStarted ) {
	wfLoadExtension( 'GettingStarted' );

	// Required deps of GettingStarted
	wfLoadExtension( 'GuidedTour' );
}


if ( $wgMirahezeCommons && !$cwPrivate ) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wmgUseGlobalUserPage ) {
	wfLoadExtension( 'GlobalUserPage' );
}

if ( $wmgUseGoogleDocs4MW ) {
	wfLoadExtension( 'GoogleDocs4MW' );
}

if ( $wmgUseGoogleNewsSitemap ) {
	wfLoadExtension( 'GoogleNewsSitemap' );
}

if ( $wmgUseGraph ) {
	wfLoadExtension( 'Graph' );
}

if ( $wmgUseGroupsSidebar ) {
	require_once "$IP/extensions/GroupsSidebar/GroupsSidebar.php";
}

if ( $wmgUseGuidedTour ) {
	wfLoadExtension( 'GuidedTour' );
}

if ( $wmgUseHAWelcome ) {
	wfLoadExtension( 'HAWelcome' );
}

if ( $wmgUseHeaderFooter ) {
	wfLoadExtension( 'HeaderFooter' );
}

if ( $wmgUseHeaderTabs ) {
	wfLoadExtension( 'HeaderTabs' );
}

if ( $wmgUseHideSection ) {
	wfLoadExtension( 'HideSection' );
}

if ( $wmgUseHighlightLinksInCategory ) {
	wfLoadExtension( 'HighlightLinksInCategory' );
}

if ( $wmgUseImageMap ) {
	wfLoadExtension( 'ImageMap' );
}

if ( $wmgUseImageRating ) {
	wfLoadExtension( 'ImageRating' );
}

if ( $wmgUseInputBox ) {
	wfLoadExtension( 'InputBox' );
}

if ( $wmgUseJavascriptSlideshow ) {
	wfLoadExtension( 'JavascriptSlideshow' );
	// This config has been removed from 1.35, but this config
	// is checked within JavascriptSlideshow. So hack
	// around this by setting it.
	$wgHtml5 = true;
}

if ( $wmgUseJosa ) {
	wfLoadExtension( 'Josa' );
}

if ( $wmgUseJSBreadCrumbs ) {
	wfLoadExtension( 'JSBreadCrumbs' );
}

if ( $wmgUseJsCalendar ) {
	wfLoadExtension( 'JsCalendar' );
}

if ( $wmgUseJsonConfig ) {
	wfLoadExtension( 'JsonConfig' );
}

if ( $wmgUseKartographer ) {
	wfLoadExtension( 'Kartographer' );
}

if ( $wmgUseLabeledSectionTransclusion ) {
	wfLoadExtension( 'LabeledSectionTransclusion' );
}

if ( $wmgUseLanguageSelector ) {
	require_once "$IP/extensions/LanguageSelector/LanguageSelector.php";
}

if ( $wmgUseLastModified ) {
	require_once "$IP/extensions/LastModified/LastModified.php";
}

if ( $wmgUseLdap ) {
	require_once "$IP/extensions/LdapAuthentication/LdapAuthentication.php";

	$wgAuthManagerAutoConfig['primaryauth'] += [
		LdapPrimaryAuthenticationProvider::class => [
			'class' => LdapPrimaryAuthenticationProvider::class,
			'args' => [ [
				'authoritative' => true, // don't allow local non-LDAP accounts
			] ],
			'sort' => 50, // must be smaller than local pw provider
		],
	];
	$wgLDAPDomainNames = [ 'miraheze' ];
	$wgLDAPServerNames = [ 'miraheze' => 'ldap1.miraheze.org' ];
	$wgLDAPEncryptionType = [ 'miraheze' => 'ssl' ];


	$wgLDAPSearchAttributes = [ 'miraheze' => 'uid' ];
	$wgLDAPBaseDNs = [ 'miraheze' => 'dc=miraheze,dc=org' ];
	$wgLDAPUserBaseDNs = [ 'miraheze' => 'ou=people,dc=miraheze,dc=org' ];
	$wgLDAPProxyAgent = [ 'miraheze' => 'cn=write-user,dc=miraheze,dc=org' ];
	$wgLDAPProxyAgentPassword = [ 'miraheze' => $wmgLdapPassword ];
	$wgLDAPWriterDN = [ 'miraheze' => 'cn=write-user,dc=miraheze,dc=org' ];
	$wgLDAPWriterPassword = [ 'miraheze' => $wmgLdapPassword ];
	$wgLDAPWriteLocation = [ 'miraheze' => 'ou=people,dc=miraheze,dc=org' ];
	$wgLDAPAddLDAPUsers = [ 'miraheze' => true ];
	$wgLDAPUpdateLDAP = [ 'miraheze' => true ];
	$wgLDAPPasswordHash = [ 'miraheze' => 'ssha' ];
	// 'invaliddomain' is set to true so that mail password options
	// will be available on user creation and password mailing
	// Force strict mode. T218589
	// $wgLDAPMailPassword = [ 'labs' => true, 'invaliddomain' => true ];
	$wgLDAPPreferences = [
		'miraheze' => [
			'email' => 'mail',
			'realname' => 'givenName',
		]
	];
	$wgLDAPUseFetchedUsername = [ 'miraheze' => true ];
	$wgLDAPLowerCaseUsernameScheme = [ 'miraheze' => false, 'invaliddomain' => false ];
	$wgLDAPLowerCaseUsername = [ 'miraheze' => false, 'invaliddomain' => false ];

	$wgLDAPOptions = [ 'miraheze' => [ "LDAP_OPT_X_TLS_CACERTFILE" => '/etc/ssl/certs/Sectigo.crt' ] ];

	// $wgLDAPDebug = 5;
}

if ( $wmgUseLiberty ) {
	wfLoadSkin( 'liberty' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Liberty'] = 'liberty';
}

if ( $wmgUseLingo ) {
	wfLoadExtension( 'Lingo' );
}

if ( $wmgUseLinkSuggest ) {
	wfLoadExtension( 'LinkSuggest' );
}

if ( $wmgUseLinkTarget ) {
	require_once "$IP/extensions/LinkTarget/LinkTarget.php";
}

if ( $wmgUseLinkTitles ) {
	wfLoadExtension( 'LinkTitles' );
}

if ( $wmgUseLinter ) {
	wfLoadExtension( 'Linter' );
	
	$wgLinterSubmitterWhitelist = [
		'127.0.0.1' => true,
		'::1' => true,
		'51.89.160.132' => true,
		'2001:41d0:800:1056::7' => true,
		'51.89.160.141' => true,
		'2001:41d0:800:105a::9' => true,
	];
}

if ( $wmgUseListings ) {
	wfLoadExtension( 'Listings' );
}

if ( $wmgUseLoopsCombo ) {
	wfLoadExtension( 'Loops' );
}

if ( $wmgUseMagicNoCache ) {
	wfLoadExtension( 'MagicNoCache' );
}

if ( $wmgUseMaps ) {
	wfLoadExtension( 'Maps' );
	$egMapsDefaultService = 'openlayers';
	$egMapsDisableSmwIntegration = true;
	$egMapsGMaps3ApiKey = $wmgMapsGMaps3ApiKey;
}

if ( $wmgUseMask ) {
	wfLoadSkin( 'Mask' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Mask'] = 'mask';
}

if ( $wmgUseMassEditRegex ) {
	wfLoadExtension( 'MassEditRegex' );
}

if ( $wmgUseMassMessage ) {
	wfLoadExtension( 'MassMessage' );

	$wi->config->settings['wgManageWikiNamespacesAdditional']['default']['wgNamespacesToPostIn'] = [
		'name' => 'Can MassMessage post messages in this namespace?',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'vestyle' => false,
		'overridedefault' => false
	];
}

if ( $wmgUseMath ) {
	wfLoadExtension( 'Math' );
}

if ( $wmgUseMediaWikiChat ) {
	wfLoadExtension( 'MediaWikiChat' );
	$wi->config->settings['wgRevokePermissions']['default']['blockedfromchat']['chat'] = true;
}

if ( $wmgUseMedik ) {
	wfLoadSkin( 'Medik' );
	$wgManageWikiSettings['wgDefaultSkin']['options']['Medik'] = 'medik';
}

if ( $wmgUseMermaid ) {
	wfLoadExtension( 'Mermaid' );
}

if ( $wmgUseMetrolook ) {
	wfLoadSkin( 'Metrolook' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Metrolook'] = 'metrolook';
}

if ( $wmgUseMobileFrontend ) {
	wfLoadExtension( 'MobileFrontend' );
	wfLoadSkin( 'MinervaNeue' );

	$wgMFAutodetectMobileView = $wmgMFAutodetectMobileView;
	$wgMFMobileHeader = 'X-Subdomain';
	$wgMFNoindexPages = false;
	$wgMFStopRedirectCookieHost = $wi->hostname;

	$wgHooks['EnterMobileMode'][] = function () {
		global $wgIncludeLegacyJavaScript;

		// Disable loading of legacy wikibits in the mobile web experience
		$wgIncludeLegacyJavaScript = false;

		return true;
	};

	$wgManageWikiSettings['wgDefaultSkin']['options']['MinervaNeue'] = 'minerva';
}

if ( $wmgUseMobileTabsPlugin ) {
	wfLoadExtension( 'MobileTabsPlugin' );
}

if ( $wmgUseModeration ) {
	wfLoadExtension( 'Moderation' );
}

if ( $wmgUseModernSkylight ) {
	wfLoadSkin( 'ModernSkylight' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['ModernSkylight'] = 'modernskylight';
}

if ( $wmgUseMsCatSelect ) {
	wfLoadExtension( 'MsCatSelect' );
}

if ( $wmgUseMsLinks ) {
	wfLoadExtension( 'MsLinks' );
}

if ( $wmgUseMsUpload ) {
	wfLoadExtension( 'MsUpload' );
}

if ( $wmgUseMultimediaViewer ) {
	wfLoadExtension( 'MultimediaViewer' );

	if ( $wmgUse3D ) {
		$wgMediaViewerExtensions['stl'] = 'mmv.3d';
	}
}

if ( $wmgUseMultiBoilerplate ) {
	wfLoadExtension( 'MultiBoilerplate' );
	$wgMultiBoilerplateDisplaySpecialPage = true;
	$wgMultiBoilerplateOptions = false;
}

if ( $wmgUseMyVariables ) {
	wfLoadExtension( 'MyVariables' );
}

if ( $wmgUseNewestPages ) {
	wfLoadExtension( 'NewestPages' );
}

if ( $wmgUseNewSignupPage ) {
	wfLoadExtension( 'NewSignupPage' );
}

if ( $wmgUseNewsletter ) {
	wfLoadExtension( 'Newsletter' );
	
	$wi->config->settings['wgManageWikiNamespacesExtraContentModels']['default']['Newsletter'] = 'NewsletterContent';
}

if ( $wmgUseNewUserMessage ) {
	wfLoadExtension( 'NewUserMessage' );
}

if ( $wmgUseNewUserNotif ) {
	require_once "$IP/extensions/NewUserNotif/NewUserNotif.php";
}

if ( $wmgUseNimbus ){
	wfLoadSkin( 'Nimbus' );
	$wgManageWikiSettings['wgDefaultSkin']['options']['Nimbus'] = 'nimbus';
}

if ( $wmgUseNostalgia ) {
	wfLoadSkin( 'Nostalgia' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Nostalgia'] = 'nostalgia';
}

if ( $wmgUseNoTitle ) {
	wfLoadExtension( 'NoTitle' );
	$wi->config->settings['wgRestrictDisplayTitle']['default'] = false;
}

if ( $wmgUseNukeDPL ) {
	wfLoadExtension( 'NukeDPL' );
}

if ( $wmgUseNumberedHeadings ) {
	wfLoadExtension( 'NumberedHeadings' );
}

if ( $wmgUseOpenGraphMeta ) {
	wfLoadExtension( 'OpenGraphMeta' );
}

if ( $wmgUseOrphanedTalkPages ) {
	wfLoadExtension( 'OrphanedTalkPages' );
}

if ( $wmgUsePageDisqus ) {
	wfLoadExtension( 'PageDisqus' );
}

if ( $wmgUsePagedTiffHandler ) {
	wfLoadExtension( 'PagedTiffHandler' );
}

if ( $wmgUsePageForms ) {
	wfLoadExtension( 'PageForms' );
}

if ( $wmgUsePageNotice ) {
	wfLoadExtension( 'PageNotice' );
}

if ( $wmgUsePageTriage ) {
	wfLoadExtension( 'PageTriage' );
}

if ( $wmgUsePDFEmbed ) {
	wfLoadExtension( 'PDFEmbed' );
}

if ( $wmgUsePdfHandler ) {
	wfLoadExtension( 'PdfHandler' );
}

if ( $wmgUsePipeEscape ) {
	require_once "$IP/extensions/PipeEscape/PipeEscape.php";
}

if ( $wmgUsePivot ) {
	wfLoadSkin( 'pivot' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Pivot'] = 'pivot';
}

if ( $wmgUsePoem ) {
	wfLoadExtension( 'Poem' );
}

if ( $wmgUsePollNY ) {
	wfLoadExtension( 'PollNY' );
}

if ( $wmgUsePortableInfobox ) {
	wfLoadExtension( 'PortableInfobox' );
}

if ( $wmgUsePopups ) {
	wfLoadExtensions( [
		'TextExtracts',
		'PageImages',
		'Popups',
	] );
	
	if ( $wmgShowPopupsByDefault ) {
		$wgPopupsHideOptInOnPreferencesPage = true;
		$wgPopupsOptInDefaultState = '1';
		$wgPopupsOptInStateForNewAccounts = '1';
		$wgPopupsReferencePreviewsBetaFeature = false;
	}
}

if ( $wmgUsePreloader ) {
	wfLoadExtension( 'Preloader' );
}

if ( $wmgUseProofreadPage ) {
	wfLoadExtension( 'ProofreadPage' );

	$wgExtraNamespaces[250] = 'Page';
	$wgExtraNamespaces[251] = 'Page_talk';
	$wgExtraNamespaces[252] = 'Index';
	$wgExtraNamespaces[253] = 'Index_talk';
	$wgProofreadPageNamespaceIds = [
		'index' => 252,
		'page' => 250
	];
}

if ( $wmgUseProtectSite ) {
	wfLoadExtension( 'ProtectSite' );
}

if ( $wmgUsePurge ) {
	wfLoadExtension( 'Purge' );

	$wgAvailableRights[] = 'purge';
}

if ( $wmgUseQuiz ) {
	wfLoadExtension( 'Quiz' );
}

if ( $wmgUseQuizGame ) {
	wfLoadExtension( 'QuizGame' );
}

if ( $wmgUseRandomGameUnit ) {
	wfLoadExtension( 'RandomGameUnit' );
}

if ( $wmgUseRandomImage ) {
	wfLoadExtension( 'RandomImage' );
}

if ( $wmgUseRandomSelection ) {
	wfLoadExtension( 'RandomSelection' );
}

if ( $wmgUseRefreshed ) {
	wfLoadSkin( 'Refreshed' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Refreshed'] = 'refreshed';
}


if ( $wmgUseRelatedArticles ) {
	wfLoadExtension( 'RelatedArticles' );

	$wgRelatedArticlesUseCirrusSearch = false;
}

if ( $wmgUseReplaceText ) {
	wfLoadExtension( 'ReplaceText' );
}

if ( $wmgUseRevisionSlider ) {
	wfLoadExtension( 'RevisionSlider' );
}

if ( $wmgUseRightFunctions ) {
	require_once "$IP/extensions/RightFunctions/RightFunctions.php";
}

if ( $wmgUseRSS ) {
	wfLoadExtension( 'RSS' );
	$wgRSSUrlWhitelist = [ "*" ];
}

if ( $wmgUseSandboxLink ) {
	wfLoadExtension( 'SandboxLink' );
}

if ( $wmgUseScratchBlocks ) {
	wfLoadExtension( "ScratchBlocks" );
}

if ( $wmgUseScore ) {
	wfLoadExtension( 'Score' );
}

if ( $wmgUseShortURL ) {
	wfLoadExtension( 'UrlShortener' );
}

if ( $wmgUseSimpleBlogPage ) {
	require_once "$IP/extensions/SimpleBlogPage/SimpleBlogPage.php";
}

if ( $wmgUseSimpleChanges ) {
	wfLoadExtension( 'SimpleChanges' );
}

if ( $wmgUseSimpleTooltip ) {
	require_once "$IP/extensions/SimpleTooltip/SimpleTooltip.php";
}

if ( $wmgUseSlackNotifications ) {
	wfLoadExtension( 'SlackNotifications' );
	$wgSlackFromName = $wgSitename;
	$wgSlackNotificationWikiUrlEnding = 'index.php?title=';
	$wgSlackNotificationWikiUrl = $wgServer . '/w/';
	$wgSlackShowNewUserEmail = false;
	$wgSlackShowNewUserIP = false;
	$wgSlackIncomingWebhookUrl =
		$wmgWikiMirahezeSlackHooks[$wgDBname] ?? $wmgWikiMirahezeSlackHooks['default'];
}

if ( $wmgUseSoftRedirector) {
	wfLoadExtension( 'SoftRedirector' );
}

if ( $wmgUseSocialProfile ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
}

if ( $wmgUseSpoilers ) {
	wfLoadExtension( 'Spoilers' );
}

if ( $wmgUseSpriteSheet ) {
	wfLoadExtension( 'SpriteSheet' );
}

if ( $wmgUseStopForumSpam ) {
	wfLoadExtension( 'StopForumSpam' );
}

if ( $wmgUseSubpageFun ) {
	wfLoadExtension( 'SubpageFun' );
}

if ( $wmgUseSubPageList3 ) {
	wfLoadExtension( 'SubPageList3' );
}

if ( $wmgUseSyntaxHighlightGeSHi ) {
	wfLoadExtension( 'SyntaxHighlight_GeSHi' );
}

if ( $wmgUseTabsCombination ) {
	wfLoadExtension( 'Tabber' );

	wfLoadExtension( 'Tabs' );
}

if ( $wmgUseTemplateData ) {
        wfLoadExtension( 'TemplateData' );
}
	
if ( $wmgUseTemplateSandbox ) {
	wfLoadExtension( 'TemplateSandbox' );

	$wi->config->settings['wgManageWikiNamespacesAdditional']['default']['wgTemplateSandboxEditNamespaces'] = [
		'name' => 'Can TemplateSandbox be used in this namespace?',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'vestyle' => false,
		'overridedefault' => false
	];
}

if ( $wmgUseTemplateStyles ) {
	wfLoadExtension( 'TemplateStyles' );
}

if ( $wmgUseTemplateWizard ) {
	wfLoadExtension( 'TemplateWizard' );

        wfLoadExtension( 'TemplateData' );
}

if ( $wmgUseTextExtracts ) {
	wfLoadExtension( 'TextExtracts' );
}

if ( $wmgUseTranslate ) {
	wfLoadExtensions( [
		'UniversalLanguageSelector',
		'Translate',
	] );

	require_once "/srv/mediawiki/config/TranslateConfigHack.php";
	$wgULSGeoService = false;
}

if ( $wmgUseTranslationNotifications ) {
	wfLoadExtension( 'TranslationNotifications' );
}

if ( $wmgUseTreeAndMenu ) {
	wfLoadExtension( 'TreeAndMenu' );
}

if ( $wmgUseTruglass) {
	wfLoadSkin( 'Truglass' );
	
	$wgManageWikiSettings['wgDefaultSkin']['options']['Truglass'] = 'truglass';
}

if ( $wmgUseThanks ) {
	wfLoadExtension( 'Thanks' );
}

if ( $wmgUseTheme ) {
	wfLoadExtension( 'Theme' );
}

if ( $wmgUseTimedMediaHandler ) {
	wfLoadExtension( 'TimedMediaHandler' );
	$wgFFmpeg2theoraLocation = '/usr/bin/ffmpeg2theora';
}

if ( $wmgUseTimeline ) {
	wfLoadExtension( 'Timeline' );
}

if ( $wmgUseTimeMachine ) {
	wfLoadExtension( 'TimeMachine' );
}

if ( $wmgUseTitleKey ) {
	wfLoadExtension( 'TitleKey' );
}

if ( $wmgUseTocTree ) {
	wfLoadExtension( 'TocTree' );
}

if ( $wmgUseTweeki ) {
	wfLoadSkin( 'Tweeki' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Tweeki'] = 'tweeki';
}

if ( $wmgUseTwitterTag ) {
	wfLoadExtension( 'TwitterTag' );
}

if ( $wmgUseTwoColConflict ) {
	wfLoadExtension( 'TwoColConflict' );
}

if ( $wmgUseUniversalLanguageSelector ) {
	wfLoadExtension( 'UniversalLanguageSelector' );
	$wgULSGeoService = false;
}

if ( $wmgUseUploadsLink ) {
	wfLoadExtension( 'UploadsLink' );
}

if ( $wmgUseUrlGetParameters ) {
	require_once "$IP/extensions/UrlGetParameters/UrlGetParameters.php";
}

if ( $wmgUseUserFunctions ) {
	require_once "$IP/extensions/UserFunctions/UserFunctions.php";
}

if ( $wmgUseUserWelcome ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
	wfLoadExtension( 'SocialProfile/UserWelcome' );
}

if ( $wmgUseVariables ) {
	wfLoadExtension( 'Variables' );
}

if ( $wmgUseVEForAll ) {
	wfLoadExtension ( 'VEForAll' );
}

if ( $wmgUseVideo ) {
	wfLoadExtension ( 'Video' );
}

if ( $wmgUseVisualEditor ) {
	wfLoadExtensions( [
		'VisualEditor',
		'TemplateData',
	] );

	$wgVirtualRestConfig['modules']['parsoid'] = [
		'url' => 'https://parsoid-lb.miraheze.org:443',
		'domain' => $wgServer,
		'prefix' => $wgDBname,
		'forwardCookies' => true,
		'restbaseCompat' => false,
	];

	if ( $wmgVisualEditorEnableDefault ) {
		$wi->config->settings['+wgDefaultUserOptions']['default']['visualeditor-enable'] = 1;
		$wi->config->settings['+wgDefaultUserOptions']['default']['visualeditor-editor'] = "visualeditor";
	} else {
		$wi->config->settings['+wgDefaultUserOptions']['default']['visualeditor-enable'] = 0;
	}

	$wi->config->settings['wgManageWikiNamespacesAdditional']['default']['wgVisualEditorAvailableNamespaces'] = [
		'name' => 'Enable VisualEditor in this namespace?',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'vestyle' => true,
		'overridedefault' => false
	];
}

if ( $wmgUseVoteNY ) {
	wfLoadExtension( 'VoteNY' );
}

if ( $wmgUseWebChat ) {
	wfLoadExtension( 'WebChat' );
	$wgWebChatClient = $wmgWebChatClient;
	$wgWebChatServer = $wmgWebChatServer;
	$wgWebChatChannel = $wmgWebChatChannel;
	$wgWebChatClients['Mibbit']['url'] = 'https://embed.mibbit.com/index.html';

}

if ( $wmgUseWhoIsWatching ) {
	wfLoadExtension( 'WhoIsWatching' );
}

if ( $wmgUseWidgets ) {
	wfLoadExtension( 'Widgets' );
}

if ( $wmgUseWikiCategoryTagCloud ) {
	wfLoadExtension( 'WikiCategoryTagCloud' );
}

if ( $wmgUseWikidataPageBanner ) {
	wfLoadExtension( 'WikidataPageBanner' );

	$wi->config->settings['wgManageWikiNamespacesAdditional']['default']['wgWPBNamespaces'] = [
		'name' => 'Enable WikidataPageBanner in this namespace?',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'vestyle' => false,
		'overridedefault' => false
	];
}

$wgEnableWikibaseRepo = false;
$wgEnableWikibaseClient = false;

if ( $wmgUseWikibaseRepository ) {
	$wgEnableWikibaseRepo = true;
	require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
}

if ( $wmgUseWikibaseClient ) {
	$wgEnableWikibaseClient = true;
	require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
}

if ( $wmgUseWikibaseRepository || $wmgUseWikibaseClient ) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once "/srv/mediawiki/config/Wikibase.php";
}

if ( $wmgUseWikiForum ) {
	wfLoadExtension( 'WikiForum' );

	$wgAvailableRights[] = 'wikiforum-admin';
	$wgAvailableRights[] = 'wikiforum-moderator';
	$wgCaptchaTriggers['wikiforum'] = true;
}

if ( $wmgUsewikihiero ) {
	wfLoadExtension( 'wikihiero' );
}

if ( $wmgUseWikiLove ) {
	wfLoadExtension( 'WikiLove' );

	$wgWikiLoveGlobal = true;
}

if ( $wmgUseWikimediaIncubator ) {
	wfLoadExtension( 'WikimediaIncubator' );
}

if ( $wmgUseWikiSeo ) {
	wfLoadExtension( 'WikiSEO' );
}

if ( $wmgUseWikiTextLoggedInOut ) {
	wfLoadExtension( 'WikiTextLoggedInOut' );
}

if ( $wmgUseYouTube ) {
	wfLoadExtension( 'YouTube' );
}

if ( $wmgUseRegexFunctions ) {
	wfLoadExtension( 'RegexFunctions' );
}

