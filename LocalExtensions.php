<?php

// Set up extensions for use on wikis that are not global
if ( $wmgUse3D ) {
	wfLoadExtension( '3D' );
}

if ( $wmgUseAddThis ) {
	wfLoadExtension( 'AddThis' );
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
	
	$wgApexLogo = [
		'1x' => $wgLogo,
		'2x' => $wgLogo,
	];
}

if ( $wmgUseApprovedRevs ) {
	wfLoadExtension( 'ApprovedRevs' );
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

if ( $wmgUseCite ) {
	wfLoadExtension( 'Cite' );
}

if ( $wmgUseCiteThisPage ) {
	wfLoadExtension( 'CiteThisPage' );
}

if ( $wmgUseCitoid ) {
	wfLoadExtension( 'Citoid' );
}

if ( $wmgUseCleanChanges ) {
	wfLoadExtension( 'CleanChanges' );
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
	wfLoadExtensions( [
		'Collection',
		'ElectronPdfService',
	] );
}

if ( $wmgUseCommentbox ) {
	wfLoadExtension( 'Commentbox' );
}

if ( $wmgUseCommentStreams ) {
	wfLoadExtension( 'CommentStreams' );
}

if ( $wmgUseComments ) {
	wfLoadExtension( 'Comments' );
}

if ( $wmgUseCommonsMetadata ) {
	wfLoadExtension( 'CommonsMetadata' );
}

if ( $wmgUseContactPage ) {
	wfLoadExtension( 'ContactPage' );
}

if ( $wmgUseContributionScores ) {
	wfLoadExtension( 'ContributionScores' );
}

if ( $wmgUseCosmos ){
	wfLoadSkin( 'Cosmos' );
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
}

if ( $wmgUseDarkMode ) {
	wfLoadExtension( 'DarkMode' );
}

if ( $wmgUseDataTransfer ) {
	wfLoadExtension( 'DataTransfer' );
}

if ( $wmgUseDeleteUserPages ) {
	wfLoadExtension( 'DeleteUserPages' );
}

if ( $wmgUseDescription2 ) {
	wfLoadExtension( 'Description2' );
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

if ( $wmgUseDisqusTag ) {
	wfLoadExtension( 'DisqusTag' );
}

if ( $wmgUseDuskToDawn ) {
	wfLoadSkin( 'DuskToDawn' );
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

if ( $wmgUseEditNotify ) {
	wfLoadExtension( 'EditNotify' );
}

if ( $wmgUseEditSubpages ) {
	wfLoadExtension( 'EditSubpages' );
}

if ( $wmgUseErudite ) {
	wfLoadSkin( 'erudite' );
}

if ( $wmgUseFancyBoxThumbs ) {
	require_once "$IP/extensions/FancyBoxThumbs/FancyBoxThumbs.php";
}

if ( $wmgUseFemiwiki ) {
	wfLoadSkin( 'Femiwiki' );
}

if ( $wmgUseFlaggedRevs ) {
	wfLoadExtension( 'FlaggedRevs' );
}

if ( $wmgUseFlow ) {
	wfLoadExtension( 'Flow' );
}

if ( $wmgUseForcePreview) {
	wfLoadExtension( 'ForcePreview' );
}

if ( $wmgUseForeground ) {
	wfLoadSkin( 'foreground' );
}

if ( $wmgUseFontAwesome ) {
	wfLoadExtension( 'FontAwesome' );
}

if ( $wmgUseGadgets ) {
	wfLoadExtension( 'Gadgets' );
}

if ( $wmgUseGamepress ) {
	wfLoadSkin( 'Gamepress' );
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

if ( $wmgUseGeoGebra ) {
	wfLoadExtension( 'GeoGebra' );
}

if ( $wmgUseGettingStarted ) {
	wfLoadExtension( 'GettingStarted' );
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
	wfLoadExtension( 'GroupsSidebar' );
}

if ( $wmgUseGuidedTour ) {
	wfLoadExtension( 'GuidedTour' );
}

if ( $wmgUseHasSomeColours ) {
	wfLoadSkin( 'HasSomeColours' );
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
	wfLoadExtension( 'LdapAuthentication' );
	
	$wgAuthManagerAutoConfig['primaryauth'] += [	
		LdapPrimaryAuthenticationProvider::class => [	
			'class' => LdapPrimaryAuthenticationProvider::class,	
			'args' => [ [	
				'authoritative' => true, // don't allow local non-LDAP accounts	
			] ],	
			'sort' => 50, // must be smaller than local pw provider	
		],	
	];
}

if ( $wmgUseLiberty ) {
	wfLoadSkin( 'liberty' );
}

if ( $wmgUseLingo ) {
	wfLoadExtension( 'Lingo' );
}

if ( $wmgUseLinkSuggest ) {
	wfLoadExtension( 'LinkSuggest' );
}

if ( $wmgUseLinkTarget ) {
	wfLoadExtension ( 'LinkTarget' );
}

if ( $wmgUseLinkTitles ) {
	wfLoadExtension( 'LinkTitles' );
}

if ( $wmgUseLinter ) {
	wfLoadExtension( 'Linter' );
}

if ( $wmgUseListings ) {
	wfLoadExtension( 'Listings' );
}

if ( $wmgUseLogoFunctions ) {
	wfLoadExtension( 'LogoFunctions' );
}

if ( $wmgUseLoopsCombo ) {
	wfLoadExtension( 'Loops' );
}

if ( $wmgUseMagicNoCache ) {
	wfLoadExtension( 'MagicNoCache' );
}

if ( $wmgUseMaps ) {
	wfLoadExtension( 'Maps' );
}

if ( $wmgUseMask ) {
	wfLoadSkin( 'Mask' );
}

if ( $wmgUseMassEditRegex ) {
	wfLoadExtension( 'MassEditRegex' );
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

if ( $wmgUseMedik ) {
	wfLoadSkin( 'Medik' );
}

if ( $wmgUseMermaid ) {
	wfLoadExtension( 'Mermaid' );
}

if ( $wmgUseMetrolook ) {
	wfLoadSkin( 'Metrolook' );
}

if ( $wmgUseMinervaNeue ) {
	wfLoadSkin( 'MinervaNeue' );
}

if ( $wmgUseMobileFrontend ) {
	wfLoadExtension( 'MobileFrontend' );
}

if ( $wmgUseMobileTabsPlugin ) {
	wfLoadExtension( 'MobileTabsPlugin' );
}

if ( $wmgUseModeration ) {
	wfLoadExtension( 'Moderation' );
}

if ( $wmgUseModernSkylight ) {
	wfLoadSkin( 'ModernSkylight' );
}

if ( $wmgUseMsCalendar ) {
	wfLoadExtension( 'MsCalendar' );
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
}

if ( $wmgUseNewUserMessage ) {
	wfLoadExtension( 'NewUserMessage' );
}

if ( $wmgUseNewUserNotif ) {
	wfLoadExtension( 'NewUserNotif' );
}

if ( $wmgUseNimbus ){
	wfLoadSkin( 'Nimbus' );
}

if ( $wmgUseNostalgia ) {
	wfLoadSkin( 'Nostalgia' );
}

if ( $wmgUseNoTitle ) {
	wfLoadExtension( 'NoTitle' );
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

if ( $wmgUsePageImages ) {
	wfLoadExtension( 'PageImages' );
}

if ( $wmgUsePageNotice ) {
	wfLoadExtension( 'PageNotice' );
}

if ( $wmgUsePageTriage ) {
	wfLoadExtension( 'PageTriage' );
}

if ( $wmgUsePdfBook ) {
	wfLoadExtension( 'PdfBook' );
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
	wfLoadExtension( 'Popups' );
	
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
}

if ( $wmgUseProtectSite ) {
	wfLoadExtension( 'ProtectSite' );
}

if ( $wmgUseProtectionIndicator ) {
	wfLoadExtension( 'ProtectionIndicator' );
}

if ( $wmgUsePurge ) {
	wfLoadExtension( 'Purge' );
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
}

if ( $wmgUseRelatedArticles ) {
	wfLoadExtension( 'RelatedArticles' );
}

if ( $wmgUseReplaceText ) {
	wfLoadExtension( 'ReplaceText' );
}

if ( $wmgUseReport ) {
	wfLoadExtension( 'Report' );
}

if ( $wmgUseRevisionSlider ) {
	wfLoadExtension( 'RevisionSlider' );
}

if ( $wmgUseRightFunctions ) {
	require_once "$IP/extensions/RightFunctions/RightFunctions.php";
}

if ( $wmgUseRSS ) {
	wfLoadExtension( 'RSS' );
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

if ( $wmgUseUrlShortener ) {
	wfLoadExtension( 'UrlShortener' );
}

if ( $wmgUseShortDescription ) {
	wfLoadExtension( 'ShortDescription' );
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
}

if ( $wmgUseSnapProjectEmbed ) {
	wfLoadExtension( 'SnapProjectEmbed' );
}

if ( $wmgUseSoftRedirector ) {
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
	wfLoadExtensions( [
		'Tabber',
		'Tabs',
	] );
}

if ( $wmgUseTemplateData ) {
	wfLoadExtension( 'TemplateData' );
}
	
if ( $wmgUseTemplateSandbox ) {
	wfLoadExtension( 'TemplateSandbox' );
}

if ( $wmgUseTemplateStyles ) {
	wfLoadExtension( 'TemplateStyles' );
}

if ( $wmgUseTemplateWizard ) {
	wfLoadExtension( 'TemplateWizard' );
}

if ( $wmgUseTextExtracts ) {
	wfLoadExtension( 'TextExtracts' );
}

if ( $wmgUseTranslate ) {
	wfLoadExtension( 'Translate' );
}

if ( $wmgUseTranslationNotifications ) {
	wfLoadExtension( 'TranslationNotifications' );
}

if ( $wmgUseTreeAndMenu ) {
	wfLoadExtension( 'TreeAndMenu' );
}

if ( $wmgUseTruglass) {
	wfLoadSkin( 'Truglass' );
}

if ( $wmgUseThanks ) {
	wfLoadExtension( 'Thanks' );
}

if ( $wmgUseTheme ) {
	wfLoadExtension( 'Theme' );
}

if ( $wmgUseTimedMediaHandler ) {
	wfLoadExtension( 'TimedMediaHandler' );
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
}

if ( $wmgUseTwitterTag ) {
	wfLoadExtension( 'TwitterTag' );
}

if ( $wmgUseTwoColConflict ) {
	wfLoadExtension( 'TwoColConflict' );
}

if ( $wmgUseUniversalLanguageSelector ) {
	wfLoadExtension( 'UniversalLanguageSelector' );
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
	wfLoadExtension( 'SocialProfile/UserWelcome' );
}

if ( $wmgUseValidator ) {
	require_once( "$IP/extensions/Validator/Validator.php" );
}

if ( $wmgUseVariables ) {
	wfLoadExtension( 'Variables' );
}

if ( $wmgUseVariablesLua ) {
	wfLoadExtension( 'VariablesLua' );
}

if ( $wmgUseVEForAll ) {
	wfLoadExtension( 'VEForAll' );
}

if ( $wmgUseVideo ) {
	wfLoadExtension( 'Video' );
}

if ( $wmgUseVisualEditor ) {
	wfLoadExtension( 'VisualEditor' );
	
	if ( $wmgVisualEditorEnableDefault ) {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 1;
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-editor'] = "visualeditor";
	} else {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 0;
	}
}

if ( $wmgUseVoteNY ) {
	wfLoadExtension( 'VoteNY' );
}

if ( $wmgUseWebChat ) {
	wfLoadExtension( 'WebChat' );
}

if ( $wmgUseWikiCategoryTagCloud ) {
	wfLoadExtension( 'WikiCategoryTagCloud' );
}

if ( $wmgUseWikidataPageBanner ) {
	wfLoadExtension( 'WikidataPageBanner' );
}

if ( $wmgUseWikibaseClient ) {
	require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
}

if ( $wmgUseWikibaseLexeme ) {
	wfLoadExtension( 'WikibaseLexeme' );
}

if ( $wmgUseWikibaseQualityConstraints ) {
	wfLoadExtension( 'WikibaseQualityConstraints' );
}

if ( $wmgUseWikibaseRepository ) {
	require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
}

if ( $wmgUseWikibaseRepository || $wmgUseWikibaseClient ) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once "/srv/mediawiki/config/Wikibase.php";
}

if ( $wmgUseWikiForum ) {
	wfLoadExtension( 'WikiForum' );
}

if ( $wmgUsewikihiero ) {
	wfLoadExtension( 'wikihiero' );
}

if ( $wmgUseWikiLove ) {
	wfLoadExtension( 'WikiLove' );
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

// If Flow, VisualEditor, or Linter is used, use the Parsoid php extension
if ( $wmgUseFlow || $wmgUseVisualEditor || $wmgUseLinter ) {
	wfLoadExtension( "Parsoid", "$IP/vendor/wikimedia/parsoid/extension.json" );
}
