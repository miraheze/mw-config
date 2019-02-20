<?php

// Set up extensions for use on wikis that are not global
if ( $wmgUse3D ) {
	wfLoadExtension( '3D' );

	$wg3dProcessor = [
		'/usr/bin/xvfb-run', '-a', '-s', '-ac -screen 0 1280x1024x24' ,'/srv/3d2png/3d2png.js'
	];

	$wgTrustedMediaFormats[] = 'application/sla';
	$wgFileExtensions[] = 'stl';
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

if ( $wmgUseAJAXPoll ) {
	wfLoadExtension( 'AJAXPoll' );
}

if ( $wmgUseApex ) {
	wfLoadSkin( 'apex' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Apex'] = 'apex';
}

if ( $wmgUseApprovedRevs ) {
	wfLoadExtension( 'ApprovedRevs' );

	$wgAvailableRights[] = 'approverevisions';
	$wgAvailableRights[] = 'viewlinktolatest';
	$wgAvailableRights[] = 'viewapprover';
}

if ( $wmgUseArticleFeedbackv5 ) {
	wfLoadExtension( 'ArticleFeedbackv5' );
}

if ( $wmgUseArticleRatings ) {
	wfLoadExtension( 'ArticleRatings' );
}

if ( $wmgUseArticleToCategory2 ) {
	wfLoadExtension( 'ArticleToCategory2' );
}

if ( $wmgUseAuthorProtect ) {
	wfLoadExtension( 'AuthorProtect' );
}

if ( $wmgUseAutoCreateCategoryPages ) {
	wfLoadExtension( 'AutoCreateCategoryPages' );
}

if ( $wmgUseBabel ) {
	wfLoadExtension( 'Babel' );
}

if ( $wmgUseBlogPage ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
	wfLoadExtension( 'BlogPage' );
	$wgBlogPageDisplay['comments_of_day'] = false;
}

if ( $wmgUseMSCalendar ) {
	wfLoadExtension( 'MsCalendar' );
}

if ( $wmgUseCargo ) {
	wfLoadExtension( 'Cargo' );
	$wgCargoDBname = 'cargodb';
	$wgCargoDBtype = $wgDBtype;
	$wgCargoDBserver = "81.4.109.166";
	$wgCargoDBuser = $wgDBuser;
	$wgCargoDBpassword = $wgDBpassword;
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

if ( $wmgUseCite ) {
	wfLoadExtension( 'Cite' );
}

if ( $wmgUseCiteThisPage ) {
	wfLoadExtension( 'CiteThisPage' );
}

if ( $wmgUseCitoid ) {
	wfLoadExtension( 'Citoid' );

	$wgCitoidServiceUrl = "https://{$wmgHostname}/api/rest_";
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
	require_once "$IP/extensions/Collection/Collection.php";

	$wgCommunityCollectionNamespace = NS_PROJECT;

	$wgCollectionMWServeURL = 'https://ocg-lb.miraheze.org';

	$wgCollectionPODPartners = false;

	wfLoadExtension( 'ElectronPdfService' );
}

if ( $wmgUseComments ) {
	wfLoadExtension( 'Comments' );
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

if ( $wmgUseCreatePage ) {
	require_once "$IP/extensions/CreatePage/CreatePage.php";
}

if ( $wmgUseCreateRedirect ) {
	wfLoadExtension( 'CreateRedirect' );
}

if ( $wmgUseCrossReference ) {
	require_once "$IP/extensions/CrossReference/CrossReference.php";
}

if ( $wmgUseCSS ) {
	wfLoadExtension( 'CSS' );
}

if ( $wmgUseCustomHeader ) {
	wfLoadExtension( 'CustomHeader' );
}

if ( $wmgUseDarkVector ) {
	wfLoadSkin( 'DarkVector' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['DarkVector'] = 'darkvector';
}

if ( $wmgUseDescription2 ) {
	wfLoadExtension( 'Description2' );

	$wgEnableMetaDescriptionFunctions = true;
}

if ( $wmgUseDisambiguator ) {
	wfLoadExtension( 'Disambiguator' );
}

if ( $wmgUseDismissableSiteNotice ) {
	wfLoadExtension( 'DismissableSiteNotice' );
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

if ( $wmgUseDuplicator ) {
	require_once "$IP/extensions/Duplicator/Duplicator.php";
}

if ( $wmgUseDynamicPageList ) {
	wfLoadExtension( 'DynamicPageList' );
}

if ( $wmgUseDynamicPageList3 ) {
	wfLoadExtension( 'DynamicPageList3' );
}

if ( $wmgUseEditcount ) {
	wfLoadExtension( 'Editcount' );
}

if ( $wmgUseEditSubpages ) {
	wfLoadExtension( 'EditSubpages' );
}

if ( $wmgUseEducationProgram ) {
	wfLoadExtension( 'EducationProgram' );
}

if ( $wmgUseElectronPdfService ) {
	wfLoadExtension( 'ElectronPdfService' );
}

if ( $wmgUseErudite ) {
	wfLoadSkin( 'erudite' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Erudite'] = 'erudite';
}

if ( $wmgUseEventLogging ) {
	wfLoadExtension( 'EventLogging' );
	$wgEventLoggingBaseUri = 'http://localhost:8080/event.gif';
	$wgEventLoggingFile = '$wmgLogDir/debuglogs/events.log';
}

if ( $wmgUseFancyBoxThumbs ) {
	require_once "$IP/extensions/FancyBoxThumbs/FancyBoxThumbs.php";
}

if ( $wmgUseFlaggedRevs ) {
	require_once "$IP/extensions/FlaggedRevs/FlaggedRevs.php";

	$wgFlaggedRevsNamespaces = $wmgFlaggedRevsNamespaces;
	$wgFlaggedRevsProtection = $wmgFlaggedRevsProtection;
	$wgFlaggedRevsTags = $wmgFlaggedRevsTags;
	$wgFlaggedRevsTagsRestrictions = $wmgFlaggedRevsTagsRestrictions;
	$wgFlaggedRevsTagsAuto = $wmgFlaggedRevsTagsAuto;
	$wgFlaggedRevsAutopromote = $wmgFlaggedRevsAutopromote;
	$wgFlaggedRevsAutoReview = $wmgFlaggedRevsAutoReview;
	$wgFlaggedRevsRestrictionLevels = $wmgFlaggedRevsRestrictionLevels;
	$wgSimpleFlaggedRevsUI = $wmgSimpleFlaggedRevsUI;
	$wgFlaggedRevsLowProfile = $wmgFlaggedRevsLowProfile;
}

if ( $wmgUseFlow ) {
	wfLoadExtension( 'Flow' );

	$wgVirtualRestConfig['modules']['parsoid'] = [
		'url' => 'https://parsoid-lb.miraheze.org:443',
		'prefix' => $wgDBname,
		'forwardCookies' => true,
	];
}

if ( $wmgFlowDefaultNamespaces && $wmgUseFlow ) {
	$wgNamespaceContentModels = [
		NS_TALK => 'flow-board',
		NS_USER_TALK => 'flow-board',
		NS_PROJECT_TALK => 'flow-board',
		NS_FILE_TALK => 'flow-board',
		NS_MEDIAWIKI_TALK => 'flow-board',
		NS_TEMPLATE_TALK => 'flow-board',
		NS_HELP_TALK => 'flow-board',
		NS_CATEGORY_TALK => 'flow-board',
	] + $wgNamespaceContentModels;
}

if ( $wmgUseFeaturedFeeds ) {
	wfLoadExtension( 'FeaturedFeeds' );
}

if ( $wmgUseForeground ) {
	wfLoadSkin( 'foreground' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Foreground'] = 'foreground';
}

if ( $wmgUseGadgets ) {
	wfLoadExtension( 'Gadgets' );
}

if ( $wmgUseGamepress ) {
	wfLoadSkin( 'Gamepress' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Gamepress'] = 'gamepress';
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
	wfLoadExtension( 'EventLogging' );
	wfLoadExtension( 'GuidedTour' );
	$wgEventLoggingBaseUri = 'http://localhost:8080/event.gif';
	$wgEventLoggingFile = '$wmgLogDir/debuglogs/events.log';
}

if ( $wmgUseGlobalUserPage ) {
	wfLoadExtension( 'GlobalUserPage' );
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
	require_once "$IP/extensions/JavascriptSlideshow/JavascriptSlideshow.php";
}

if ( $wmgUseJosa ) {
	wfLoadExtension( 'Josa' );
}

if ( $wmgUseJSBreadCrumbs ) {
	wfLoadExtension( 'JSBreadCrumbs' );
}

if ( $wmgUseKartographer ) {
	wfLoadExtension( 'Kartographer' );
}

if ( $wmgUseLabeledSectionTransclusion ) {
	wfLoadExtension( 'LabeledSectionTransclusion' );
}

if ( $wmgUseLiberty ) {
	wfLoadSkin( 'liberty' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Liberty'] = 'liberty';
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

if ( $wmgUseListings ) {
	wfLoadExtension( 'Listings' );
}

if ( $wmgUseLoopsCombo ) {
	require_once "$IP/extensions/Variables/Variables.php";
	require_once "$IP/extensions/Loops/Loops.php";
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

if ( $wmgUseMassEditRegex ) {
	require_once "$IP/extensions/MassEditRegex/MassEditRegex.php";
}

if ( $wmgUseMassMessage ) {
	wfLoadExtension( 'MassMessage' );
}

if ( $wmgUseMath ) {
	wfLoadExtension( 'Math' );
}

if ( $wmgUseMediaWikiChat ) {
	wfLoadExtension( 'MediaWikiChat' );
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

	$wgHooks['EnterMobileMode'][] = function () {
		global $wgIncludeLegacyJavaScript;

		// Disable loading of legacy wikibits in the mobile web experience
		$wgIncludeLegacyJavaScript = false;

		return true;
	};

	$wgManageWikiSettings['wgDefaultSkin']['options']['MinervaNeue'] = 'minerva';
}

if ( $wmgUseModeration ) {
	wfLoadExtension( 'Moderation' );
}

if ( $wmgUseModernSkylight ) {
	wfLoadSkin( 'ModernSkylight' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['ModernSkylight'] = 'modernskylight';
}

if ( $wmgUseMsPackage ) {
	wfLoadExtension( 'MsUpload' );
	wfLoadExtension( 'MsLinks' );
	wfLoadExtension( 'MsCatSelect' );
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

if ( $wmgUseNewestPages ) {
	wfLoadExtension( 'NewestPages' );
}

if ( $wmgUseNews ) {
	require_once "$IP/extensions/News/News.php";
}

if ( $wmgUseNewSignupPage ) {
	wfLoadExtension( 'NewSignupPage' );
}

if ( $wmgUseNewsletter ) {
	wfLoadExtension( 'Newsletter' );
}

if ( $wmgUseNewUserMessage ) {
	wfLoadExtension( 'NewUserMessage' );
}

if ( $wmgUseNewUserNotif ) {
	require_once "$IP/extensions/NewUserNotif/NewUserNotif.php";
}

if ( $wmgUseNostalgia ) {
	wfLoadSkin( 'Nostalgia' );

	$wgManageWikiSettings['wgDefaultSkin']['options']['Nostalgia'] = 'nostalgia';
}

if ( $wmgUseNoTitle ) {
	wfLoadExtension( 'NoTitle' );
	$wgRestrictDisplayTitle = false;
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

if ( $wmgUsePagedTiffHandler ) {
	wfLoadExtension( 'PagedTiffHandler' );
}

if ( $wmgUsePageForms ) {
	wfLoadExtension( 'PageForms' );
}

if ( $wmgUsePageNotice ) {
	require_once "$IP/extensions/PageNotice/PageNotice.php";
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

if ( $wmgUsePoll ) {
	require_once "$IP/extensions/Poll/Poll.php";
}

if ( $wmgUsePollNY ) {
	wfLoadExtension( 'PollNY' );
}

if ( $wmgUsePortableInfobox ) {
	wfLoadExtension( 'PortableInfobox' );
}

if ( $wmgUsePopups ) {
	wfLoadExtension( 'PageImages' );
	wfLoadExtension( 'Popups' );
	wfLoadExtension( 'TextExtracts' );
}

if ( $wmgUseProofreadPage ) {
	wfLoadExtension( 'ProofreadPage' );

	$wgExtraNamespaces[NS_PROOFREAD_PAGE] = 'Page';
	$wgExtraNamespaces[NS_PROOFREAD_PAGE_TALK] = 'Page_talk';
	$wgExtraNamespaces[NS_PROOFREAD_INDEX] = 'Index';
	$wgExtraNamespaces[NS_PROOFREAD_INDEX_TALK] = 'Index_talk';
	$wgProofreadPageNamespaceIds = [
		'index' => NS_PROOFREAD_INDEX,
		'page' => NS_PROOFREAD_PAGE
	];
}

if ( $wmgUseProtectSite ) {
	wfLoadExtension( 'ProtectSite' );
}

if ( $wmgUsePurge ) {
	require_once "$IP/extensions/Purge/Purge.php";

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

if ( $wmgUseSimpleChanges ) {
	wfLoadExtension( 'SimpleChanges' );
}

if ( $wmgUseShortURL ) {
	wfLoadExtension( 'UrlShortener' );
}

if ( $wmgUseSimpleTooltip ) {
	require_once "$IP/extensions/SimpleTooltip/SimpleTooltip.php";
}

if ( $wmgUseSiteScout ) {
	wfLoadExtension( 'SiteScout' );
}

if ( $wmgUseSocialProfile ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
}

if ( $wmgUseSpoilers ) {
	wfLoadExtension( 'Spoilers' );
}

if ( $wmgUseSubpageFun ) {
	require_once "$IP/extensions/SubpageFun/SubpageFun.php";
}

if ( $wmgUseSubPageList3 ) {
	wfLoadExtension( 'SubPageList3' );
}

if ( $wmgUseTabsCombination ) {
	wfLoadExtension( 'Tabber' );

	wfLoadExtension( 'Tabs' );
}

if ( $wmgUseTemplateSandbox ) {
	wfLoadExtension( 'TemplateSandbox' );
}

if ( $wmgUseTemplateStyles ) {
	wfLoadExtension( 'TemplateStyles' );
}

if ( $wmgUseTranslate ) {
	wfLoadExtension( 'UniversalLanguageSelector' );
	require_once "$IP/extensions/Translate/Translate.php";
	$wgTranslateBlacklist = $wmgTranslateBlacklist;
	$wgTranslateTranslationServices = $wmgTranslateTranslationServices;
	$wgTranslateDocumentationLanguageCode = $wmgTranslateDocumentationLanguageCode;
	require_once "/srv/mediawiki/config/TranslateConfigHack.php";
	$wgULSGeoService = false;
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

if ( $wmgUseUserWelcome ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
	wfLoadExtension( 'SocialProfile/UserWelcome' );
}

if ( $wmgUseVariables ) {
	require_once "$IP/extensions/Variables/Variables.php";
}

if ( $wmgUseVisualEditor ) {
	wfLoadExtension( 'VisualEditor' );

	$wgVirtualRestConfig['modules']['parsoid'] = [
		'url' => 'https://parsoid-lb.miraheze.org:443',
		'prefix' => $wgDBname,
		'forwardCookies' => true,
	];

	if ( $wmgVisualEditorEnableDefault ) {
		$wgDefaultUserOptions['visualeditor-enable'] = 1;
		$wgDefaultUserOptions['visualeditor-editor'] = "visualeditor";
	} else {
		$wgDefaultUserOptions['visualeditor-enable'] = 0;
	}

	$wgVisualEditorAvailableNamespaces = $wmgVisualEditorAvailableNamespaces;

	// Load TemplateData
	wfLoadExtension( 'TemplateData' );
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

if ( $wmgUseWikidataPageBanner ) {
	wfLoadExtension( 'WikidataPageBanner' );
}

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
