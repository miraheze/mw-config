<?php

// Set up extensions for use on wikis that are not global
if ( $wmgUse3D ?? false ) {
	wfLoadExtension( '3D' );
}

if ( $wmgUseAddThis ?? false ) {
	wfLoadExtension( 'AddThis' );
}

if ( $wmgUseAddHTMLMetaAndTitle ?? false ) {
	wfLoadExtension( 'AddHTMLMetaAndTitle' );
}

if ( $wmgUseAdminLinks ?? false ) {
	wfLoadExtension( 'AdminLinks' );
}

if ( $wmgUseAdvancedSearch ?? false ) {
	wfLoadExtension( 'AdvancedSearch' );
}

if ( $wmgUseAJAXPoll ?? false ) {
	wfLoadExtension( 'AJAXPoll' );
}

if ( $wmgUseApex ?? false ) {
	wfLoadSkin( 'apex' );
	
	$wgApexLogo = [
		'1x' => $wgLogo,
		'2x' => $wgLogo,
	];
}

if ( $wmgUseApprovedRevs ?? false ) {
	wfLoadExtension( 'ApprovedRevs' );
}

if ( $wmgUseArrays ?? false ) {
	wfLoadExtension( 'Arrays' );
}

if ( $wmgUseArticleRatings ?? false ) {
	wfLoadExtension( 'ArticleRatings' );
}

if ( $wmgUseArticleToCategory2 ?? false ) {
	wfLoadExtension( 'ArticleToCategory2' );
}

if ( $wmgUseAuthorProtect ?? false ) {
	wfLoadExtension( 'AuthorProtect' );
}

if ( $wmgUseAutoCreateCategoryPages ?? false ) {
	wfLoadExtension( 'AutoCreateCategoryPages' );
}

if ( $wmgUseAutoCreatePage ?? false ) {
	wfLoadExtension( 'AutoCreatePage' );
}

if ( $wmgUseBabel ?? false ) {
	wfLoadExtension( 'Babel' );
}

if ( $wmgUseBlogPage ?? false ) {
	wfLoadExtension( 'BlogPage' );
}

if ( $wmgUseCentralAuth ) {
	wfLoadExtension( 'CentralAuth' );
}

if ( $wmgUseCargo ?? false ) {
	wfLoadExtension( 'Cargo' );
}

if ( $wmgUseCategorySortHeaders ?? false ) {
	require_once "$IP/extensions/CategorySortHeaders/CategorySortHeaders.php";
}

if ( $wmgUseCategoryTree ?? false ) {
	wfLoadExtension( 'CategoryTree' );
}

if ( $wmgUseCapiunto ?? false ) {
	wfLoadExtension( 'Capiunto' );
}

if ( $wmgUseCharInsert ?? false ) {
	wfLoadExtension( 'CharInsert' );
}

if ( $wmgUseCite ?? false ) {
	wfLoadExtension( 'Cite' );
}

if ( $wmgUseCiteThisPage ?? false ) {
	wfLoadExtension( 'CiteThisPage' );
}

if ( $wmgUseCitoid ?? false ) {
	wfLoadExtension( 'Citoid' );
}

if ( $wmgUseCleanChanges ?? false ) {
	wfLoadExtension( 'CleanChanges' );
}

if ( $wmgUseCodeEditor ?? false ) {
	wfLoadExtension( 'CodeEditor' );
}

if ( $wmgUseCodeMirror ?? false ) {
	wfLoadExtension( 'CodeMirror' );
}

if ( $wmgUseCollapsibleVector ?? false ) {
	wfLoadExtension( 'CollapsibleVector' );
}

if ( $wmgUseCollection ?? false ) {
	wfLoadExtensions( [
		'Collection',
		'ElectronPdfService',
	] );
}

if ( $wmgUseCommentbox ?? false ) {
	wfLoadExtension( 'Commentbox' );
}

if ( $wmgUseCommentStreams ?? false ) {
	wfLoadExtension( 'CommentStreams' );
}

if ( $wmgUseComments ?? false ) {
	wfLoadExtension( 'Comments' );
}

if ( $wmgUseCommonsMetadata ?? false ) {
	wfLoadExtension( 'CommonsMetadata' );
}

if ( $wmgUseContactPage ?? false ) {
	wfLoadExtension( 'ContactPage' );
}

if ( $wmgUseContributionScores ?? false ) {
	wfLoadExtension( 'ContributionScores' );
}

if ( $wmgUseCosmos ?? false ) {
	wfLoadSkin( 'Cosmos' );
}

if ( $wmgUseCreatePage ?? false ) {
	require_once "$IP/extensions/CreatePage/CreatePage.php";
}
if ( $wmgUseCreatePageUw ?? false ) {
	wfLoadExtension( 'CreatePageUw' );
}
if ( $wmgUseCreateRedirect ?? false ) {
	wfLoadExtension( 'CreateRedirect' );
}

if ( $wmgUseCSS ?? false ) {
	wfLoadExtension( 'CSS' );
}

if ( $wmgUseCalendarWikivoyage ?? false ) {
	wfLoadExtension( 'Calendar' );
}

if ( $wmgUseCitizen ?? false ) {
	wfLoadSkin( 'Citizen' );
}

if ( $wmgUseDarkMode ?? false ) {
	wfLoadExtension( 'DarkMode' );
}

if ( $wmgUseDataTransfer ?? false ) {
	wfLoadExtension( 'DataTransfer' );
}

if ( $wmgUseDeleteUserPages ?? false ) {
	wfLoadExtension( 'DeleteUserPages' );
}

if ( $wmgUseDescription2 ?? false ) {
	wfLoadExtension( 'Description2' );
}

if ( $wmgUseDisambiguator ?? false ) {
	wfLoadExtension( 'Disambiguator' );
}

if ( $wmgUseDiscussionTools ?? false ) {
	wfLoadExtension( 'DiscussionTools' );
}

if ( $wmgUseDisplayTitle ?? false ) {
	wfLoadExtension( 'DisplayTitle' );
}

if ( $wmgUseDisqusTag ?? false ) {
	wfLoadExtension( 'DisqusTag' );
}

if ( $wmgUseDuskToDawn ?? false ) {
	wfLoadSkin( 'DuskToDawn' );
}

if ( $wmgUseDPLForum ?? false ) {
	wfLoadExtension( 'DPLForum' );
}

if ( $wmgUseDummyFandoomMainpageTags ?? false ) {
	wfLoadExtension( 'DummyFandoomMainpageTags' );
}

if ( $wmgUseDynamicPageList ?? false ) {
	wfLoadExtension( 'DynamicPageList' );
}

if ( $wmgUseDynamicPageList3 ?? false ) {
	wfLoadExtension( 'DynamicPageList3' );
}

if ( $wmgUseDynamicSidebar ?? false ) {
	wfLoadExtension( 'DynamicSidebar' );
}

if ( $wmgUseEditcount ?? false ) {
	wfLoadExtension( 'Editcount' );
}

if ( $wmgUseEditNotify ?? false ) {
	wfLoadExtension( 'EditNotify' );
}

if ( $wmgUseEditSubpages ?? false ) {
	wfLoadExtension( 'EditSubpages' );
}

if ( $wmgUseErudite ?? false ) {
	wfLoadSkin( 'erudite' );
}

if ( $wmgUseFancyBoxThumbs ?? false ) {
	wfLoadExtension( 'FancyBoxThumbs' );
}

if ( $wmgUseFemiwiki ?? false ) {
	wfLoadSkin( 'Femiwiki' );
}

if ( $wmgUseFlaggedRevs ?? false ) {
	wfLoadExtension( 'FlaggedRevs' );
}

if ( $wmgUseFlow ?? false ) {
	wfLoadExtension( 'Flow' );
}

if ( $wmgUseForcePreview?? false ) {
	wfLoadExtension( 'ForcePreview' );
}

if ( $wmgUseForeground ?? false ) {
	wfLoadSkin( 'foreground' );
}

if ( $wmgUseFontAwesome ?? false ) {
	wfLoadExtension( 'FontAwesome' );
}

if ( $wmgUseGadgets ?? false ) {
	wfLoadExtension( 'Gadgets' );
}

if ( $wmgUseGamepress ?? false ) {
	wfLoadSkin( 'Gamepress' );
}

if ( $wmgUseGenealogy ?? false ) {
	wfLoadExtension( 'Genealogy' );
}

if ( $wmgUseGeoCrumbs ?? false ) {
	wfLoadExtension( 'GeoCrumbs' );
}

if ( $wmgUseGeoData ?? false ) {
	wfLoadExtension( 'GeoData' );
}

if ( $wmgUseGeoGebra ?? false ) {
	wfLoadExtension( 'GeoGebra' );
}

if ( $wmgUseGettingStarted ?? false ) {
	wfLoadExtension( 'GettingStarted' );
}

if ( $wgMirahezeCommons && !$cwPrivate ?? false ) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wmgUseGlobalUserPage ?? false ) {
	wfLoadExtension( 'GlobalUserPage' );
}

if ( $wmgUseGoogleDocs4MW ?? false ) {
	wfLoadExtension( 'GoogleDocs4MW' );
}

if ( $wmgUseGoogleNewsSitemap ?? false ) {
	wfLoadExtension( 'GoogleNewsSitemap' );
}

if ( $wmgUseGraph ?? false ) {
	wfLoadExtension( 'Graph' );
}

if ( $wmgUseGroupsSidebar ?? false ) {
	wfLoadExtension( 'GroupsSidebar' );
}

if ( $wmgUseGuidedTour ?? false ) {
	wfLoadExtension( 'GuidedTour' );
}

if ( $wmgUseHasSomeColours ?? false ) {
	wfLoadSkin( 'HasSomeColours' );
}

if ( $wmgUseHAWelcome ?? false ) {
	wfLoadExtension( 'HAWelcome' );
}

if ( $wmgUseHeaderFooter ?? false ) {
	wfLoadExtension( 'HeaderFooter' );
}

if ( $wmgUseHeaderTabs ?? false ) {
	wfLoadExtension( 'HeaderTabs' );
}

if ( $wmgUseHideSection ?? false ) {
	wfLoadExtension( 'HideSection' );
}

if ( $wmgUseHighlightLinksInCategory ?? false ) {
	wfLoadExtension( 'HighlightLinksInCategory' );
}

if ( $wmgUseImageMap ?? false ) {
	wfLoadExtension( 'ImageMap' );
}

if ( $wmgUseImageRating ?? false ) {
	wfLoadExtension( 'ImageRating' );
}

if ( $wmgUseInputBox ?? false ) {
	wfLoadExtension( 'InputBox' );
}

if ( $wmgUseJavascriptSlideshow ?? false ) {
	wfLoadExtension( 'JavascriptSlideshow' );
}

if ( $wmgUseJosa ?? false ) {
	wfLoadExtension( 'Josa' );
}

if ( $wmgUseJSBreadCrumbs ?? false ) {
	wfLoadExtension( 'JSBreadCrumbs' );
}

if ( $wmgUseJsCalendar ?? false ) {
	wfLoadExtension( 'JsCalendar' );
}

if ( $wmgUseJsonConfig ?? false ) {
	wfLoadExtension( 'JsonConfig' );
}

if ( $wmgUseKartographer ?? false ) {
	wfLoadExtension( 'Kartographer' );
}

if ( $wmgUseLabeledSectionTransclusion ?? false ) {
	wfLoadExtension( 'LabeledSectionTransclusion' );
}

if ( $wmgUseLanguageSelector ?? false ) {
	require_once "$IP/extensions/LanguageSelector/LanguageSelector.php";
}

if ( $wmgUseLastModified ?? false ) {
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

if ( $wmgUseLiberty ?? false ) {
	wfLoadSkin( 'liberty' );
}

if ( $wmgUseLingo ?? false ) {
	wfLoadExtension( 'Lingo' );
}

if ( $wmgUseLinkSuggest ?? false ) {
	wfLoadExtension( 'LinkSuggest' );
}

if ( $wmgUseLinkTarget ?? false ) {
	wfLoadExtension ( 'LinkTarget' );
}

if ( $wmgUseLinkTitles ?? false ) {
	wfLoadExtension( 'LinkTitles' );
}

if ( $wmgUseLinter ?? false ) {
	wfLoadExtension( 'Linter' );
}

if ( $wmgUseListings ?? false ) {
	wfLoadExtension( 'Listings' );
}

if ( $wmgUseLogoFunctions ?? false ) {
	wfLoadExtension( 'LogoFunctions' );
}

if ( $wmgUseLoopsCombo ?? false ) {
	wfLoadExtension( 'Loops' );
}

if ( $wmgUseMagicNoCache ?? false ) {
	wfLoadExtension( 'MagicNoCache' );
}

if ( $wmgUseMaps ?? false ) {
	wfLoadExtension( 'Maps' );
}

if ( $wmgUseMask ?? false ) {
	wfLoadSkin( 'Mask' );
}

if ( $wmgUseMassEditRegex ?? false ) {
	wfLoadExtension( 'MassEditRegex' );
}

if ( $wmgUseMassMessage ?? false ) {
	wfLoadExtension( 'MassMessage' );
}

if ( $wmgUseMath ?? false ) {
	wfLoadExtension( 'Math' );
}

if ( $wmgUseMediaWikiChat ?? false ) {
	wfLoadExtension( 'MediaWikiChat' );
}

if ( $wmgUseMedik ?? false ) {
	wfLoadSkin( 'Medik' );
}

if ( $wmgUseMermaid ?? false ) {
	wfLoadExtension( 'Mermaid' );
}

if ( $wmgUseMetrolook ?? false ) {
	wfLoadSkin( 'Metrolook' );
}

if ( $wmgUseMinervaNeue ?? false ) {
	wfLoadSkin( 'MinervaNeue' );
}

if ( $wmgUseMobileFrontend ?? false ) {
	wfLoadExtension( 'MobileFrontend' );
}

if ( $wmgUseMobileTabsPlugin ?? false ) {
	wfLoadExtension( 'MobileTabsPlugin' );
}

if ( $wmgUseModeration ?? false ) {
	wfLoadExtension( 'Moderation' );
}

if ( $wmgUseModernSkylight ?? false ) {
	wfLoadSkin( 'ModernSkylight' );
}

if ( $wmgUseMsCalendar ?? false ) {
	wfLoadExtension( 'MsCalendar' );
}

if ( $wmgUseMsCatSelect ?? false ) {
	wfLoadExtension( 'MsCatSelect' );
}

if ( $wmgUseMsLinks ?? false ) {
	wfLoadExtension( 'MsLinks' );
}

if ( $wmgUseMsUpload ?? false ) {
	wfLoadExtension( 'MsUpload' );
}

if ( $wmgUseMultimediaViewer ?? false ) {
	wfLoadExtension( 'MultimediaViewer' );
	
	if ( $wmgUse3D ?? false ) {
		$wgMediaViewerExtensions['stl'] = 'mmv.3d';
	}
}

if ( $wmgUseMultiBoilerplate ?? false ) {
	wfLoadExtension( 'MultiBoilerplate' );
}

if ( $wmgUseMyVariables ?? false ) {
	wfLoadExtension( 'MyVariables' );
}

if ( $wmgUseNewestPages ?? false ) {
	wfLoadExtension( 'NewestPages' );
}

if ( $wmgUseNewSignupPage ?? false ) {
	wfLoadExtension( 'NewSignupPage' );
}

if ( $wmgUseNewsletter ?? false ) {
	wfLoadExtension( 'Newsletter' );
}

if ( $wmgUseNewUserMessage ?? false ) {
	wfLoadExtension( 'NewUserMessage' );
}

if ( $wmgUseNewUserNotif ?? false ) {
	require_once "$IP/extensions/NewUserNotif/NewUserNotif.php";
}

if ( $wmgUseNimbus ?? false ) {
	wfLoadSkin( 'Nimbus' );
}

if ( $wmgUseNostalgia ?? false ) {
	wfLoadSkin( 'Nostalgia' );
}

if ( $wmgUseNoTitle ?? false ) {
	wfLoadExtension( 'NoTitle' );
}

if ( $wmgUseNukeDPL ?? false ) {
	wfLoadExtension( 'NukeDPL' );
}

if ( $wmgUseNumberedHeadings ?? false ) {
	wfLoadExtension( 'NumberedHeadings' );
}

if ( $wmgUseOpenGraphMeta ?? false ) {
	wfLoadExtension( 'OpenGraphMeta' );
}

if ( $wmgUseOrphanedTalkPages ?? false ) {
	wfLoadExtension( 'OrphanedTalkPages' );
}

if ( $wmgUsePageAssessments ?? false ) {
	wfLoadExtension( 'PageAssessments' );
}

if ( $wmgUsePageDisqus ?? false ) {
	wfLoadExtension( 'PageDisqus' );
}

if ( $wmgUsePagedTiffHandler ?? false ) {
	wfLoadExtension( 'PagedTiffHandler' );
}

if ( $wmgUsePageForms ?? false ) {
	wfLoadExtension( 'PageForms' );
}

if ( $wmgUsePageImages ?? false ) {
	wfLoadExtension( 'PageImages' );
}

if ( $wmgUsePageNotice ?? false ) {
	wfLoadExtension( 'PageNotice' );
}

if ( $wmgUsePageTriage ?? false ) {
	wfLoadExtension( 'PageTriage' );
}

if ( $wmgUsePdfBook ?? false ) {
	wfLoadExtension( 'PdfBook' );
}

if ( $wmgUsePDFEmbed ?? false ) {
	wfLoadExtension( 'PDFEmbed' );
}

if ( $wmgUsePdfHandler ?? false ) {
	wfLoadExtension( 'PdfHandler' );
}

if ( $wmgUsePipeEscape ?? false ) {
	require_once "$IP/extensions/PipeEscape/PipeEscape.php";
}

if ( $wmgUsePivot ?? false ) {
	wfLoadSkin( 'pivot' );
}

if ( $wmgUsePoem ?? false ) {
	wfLoadExtension( 'Poem' );
}

if ( $wmgUsePollNY ?? false ) {
	wfLoadExtension( 'PollNY' );
}

if ( $wmgUsePortableInfobox ?? false ) {
	wfLoadExtension( 'PortableInfobox' );
}

if ( $wmgUsePopups ?? false ) {
	wfLoadExtension( 'Popups' );
	
	if ( $wmgShowPopupsByDefault ?? false ) {
		$wgPopupsHideOptInOnPreferencesPage = true;
		$wgPopupsOptInDefaultState = '1';
		$wgPopupsOptInStateForNewAccounts = '1';
		$wgPopupsReferencePreviewsBetaFeature = false;
	}
}

if ( $wmgUsePreloader ?? false ) {
	wfLoadExtension( 'Preloader' );
}

if ( $wmgUseProofreadPage ?? false ) {
	wfLoadExtension( 'ProofreadPage' );
}

if ( $wmgUseProtectSite ?? false ) {
	wfLoadExtension( 'ProtectSite' );
}

if ( $wmgUseProtectionIndicator ?? false ) {
	wfLoadExtension( 'ProtectionIndicator' );
}

if ( $wmgUsePurge ?? false ) {
	wfLoadExtension( 'Purge' );
}

if ( $wmgUseQuiz ?? false ) {
	wfLoadExtension( 'Quiz' );
}

if ( $wmgUseQuizGame ?? false ) {
	wfLoadExtension( 'QuizGame' );
}

if ( $wmgUseRandomGameUnit ?? false ) {
	wfLoadExtension( 'RandomGameUnit' );
}

if ( $wmgUseRandomImage ?? false ) {
	wfLoadExtension( 'RandomImage' );
}

if ( $wmgUseRandomSelection ?? false ) {
	wfLoadExtension( 'RandomSelection' );
}

if ( $wmgUseRefreshed ?? false ) {
	wfLoadSkin( 'Refreshed' );
}

if ( $wmgUseRelatedArticles ?? false ) {
	wfLoadExtension( 'RelatedArticles' );
}

if ( $wmgUseReplaceText ?? false ) {
	wfLoadExtension( 'ReplaceText' );
}

if ( $wmgUseReport ?? false ) {
	wfLoadExtension( 'Report' );
}

if ( $wmgUseRevisionSlider ?? false ) {
	wfLoadExtension( 'RevisionSlider' );
}

if ( $wmgUseRightFunctions ?? false ) {
	require_once "$IP/extensions/RightFunctions/RightFunctions.php";
}

if ( $wmgUseRSS ?? false ) {
	wfLoadExtension( 'RSS' );
}

if ( $wmgUseSandboxLink ?? false ) {
	wfLoadExtension( 'SandboxLink' );
}

if ( $wmgUseScratchBlocks ?? false ) {
	wfLoadExtension( 'mw-ScratchBlocks4' );
}

if ( $wmgUseScore ?? false ) {
	wfLoadExtension( 'Score' );
}

if ( $wmgUseUrlShortener ?? false ) {
	wfLoadExtension( 'UrlShortener' );
}

if ( $wmgUseShortDescription ?? false ) {
	wfLoadExtension( 'ShortDescription' );
}

if ( $wmgUseSimpleBlogPage ?? false ) {
	wfLoadExtension( 'SimpleBlogPage' );
}

if ( $wmgUseSimpleChanges ?? false ) {
	wfLoadExtension( 'SimpleChanges' );
}

if ( $wmgUseSimpleTooltip ?? false ) {
	wfLoadExtension( 'SimpleTooltip' );
}

if ( $wmgUseSlackNotifications ?? false ) {
	wfLoadExtension( 'SlackNotifications' );
}

if ( $wmgUseSnapProjectEmbed ?? false ) {
	wfLoadExtension( 'SnapProjectEmbed' );
}

if ( $wmgUseSoftRedirector ?? false ) {
	wfLoadExtension( 'SoftRedirector' );
}

if ( $wmgUseSocialProfile ?? false ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
}

if ( $wmgUseSpoilers ?? false ) {
	wfLoadExtension( 'Spoilers' );
}

if ( $wmgUseSpriteSheet ?? false ) {
	wfLoadExtension( 'SpriteSheet' );
}

if ( $wmgUseStopForumSpam ?? false ) {
	wfLoadExtension( 'StopForumSpam' );
}

if ( $wmgUseSubpageFun ?? false ) {
	wfLoadExtension( 'SubpageFun' );
}

if ( $wmgUseSubPageList3 ?? false ) {
	wfLoadExtension( 'SubPageList3' );
}

if ( $wmgUseSyntaxHighlightGeSHi ?? false ) {
	wfLoadExtension( 'SyntaxHighlight_GeSHi' );
}

if ( $wmgUseTabsCombination ?? false ) {
	wfLoadExtensions( [
		'Tabber',
		'Tabs',
	] );
}

if ( $wmgUseTemplateData ?? false ) {
	wfLoadExtension( 'TemplateData' );
}
	
if ( $wmgUseTemplateSandbox ?? false ) {
	wfLoadExtension( 'TemplateSandbox' );
}

if ( $wmgUseTemplateStyles ?? false ) {
	wfLoadExtension( 'TemplateStyles' );
}

if ( $wmgUseTemplateWizard ?? false ) {
	wfLoadExtension( 'TemplateWizard' );
}

if ( $wmgUseTextExtracts ?? false ) {
	wfLoadExtension( 'TextExtracts' );
}

if ( $wmgUseTranslate ?? false ) {
	wfLoadExtension( 'Translate' );
}

if ( $wmgUseTranslationNotifications ?? false ) {
	wfLoadExtension( 'TranslationNotifications' );
}

if ( $wmgUseTreeAndMenu ?? false ) {
	wfLoadExtension( 'TreeAndMenu' );
}

if ( $wmgUseTruglass?? false ) {
	wfLoadSkin( 'Truglass' );
}

if ( $wmgUseThanks ?? false ) {
	wfLoadExtension( 'Thanks' );
}

if ( $wmgUseTheme ?? false ) {
	wfLoadExtension( 'Theme' );
}

if ( $wmgUseTimedMediaHandler ?? false ) {
	wfLoadExtension( 'TimedMediaHandler' );
}

if ( $wmgUseTimeline ?? false ) {
	wfLoadExtension( 'Timeline' );
}

if ( $wmgUseTimeMachine ?? false ) {
	wfLoadExtension( 'TimeMachine' );
}

if ( $wmgUseTitleKey ?? false ) {
	wfLoadExtension( 'TitleKey' );
}

if ( $wmgUseTocTree ?? false ) {
	wfLoadExtension( 'TocTree' );
}

if ( $wmgUseTweeki ?? false ) {
	wfLoadSkin( 'Tweeki' );
}

if ( $wmgUseTwitterTag ?? false ) {
	wfLoadExtension( 'TwitterTag' );
}

if ( $wmgUseTwoColConflict ?? false ) {
	wfLoadExtension( 'TwoColConflict' );
}

if ( $wmgUseUniversalLanguageSelector ?? false ) {
	wfLoadExtension( 'UniversalLanguageSelector' );
}

if ( $wmgUseUploadsLink ?? false ) {
	wfLoadExtension( 'UploadsLink' );
}

if ( $wmgUseUrlGetParameters ?? false ) {
	require_once "$IP/extensions/UrlGetParameters/UrlGetParameters.php";
}

if ( $wmgUseUserFunctions ?? false ) {
	require_once "$IP/extensions/UserFunctions/UserFunctions.php";
}

if ( $wmgUseUserWelcome ?? false ) {
	wfLoadExtension( 'SocialProfile/UserWelcome' );
}

if ( $wmgUseVariables ?? false ) {
	wfLoadExtension( 'Variables' );
}

if ( $wmgUseVariablesLua ?? false ) {
	wfLoadExtension( 'VariablesLua' );
}

if ( $wmgUseVEForAll ?? false ) {
	wfLoadExtension( 'VEForAll' );
}

if ( $wmgUseVideo ?? false ) {
	wfLoadExtension( 'Video' );
}

if ( $wmgUseVisualEditor ?? false ) {
	wfLoadExtension( 'VisualEditor' );
	
	if ( $wmgVisualEditorEnableDefault ?? false ) {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 1;
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-editor'] = 'visualeditor';
	} else {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 0;
	}
}

if ( $wmgUseVoteNY ?? false ) {
	wfLoadExtension( 'VoteNY' );
}

if ( $wmgUseWebChat ?? false ) {
	wfLoadExtension( 'WebChat' );
}

if ( $wmgUseWikiCategoryTagCloud ?? false ) {
	wfLoadExtension( 'WikiCategoryTagCloud' );
}

if ( $wmgUseWikidataPageBanner ?? false ) {
	wfLoadExtension( 'WikidataPageBanner' );
}

if ( $wmgUseWikibaseClient ?? false ) {
	require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
}

if ( $wmgUseWikibaseLexeme ?? false ) {
	wfLoadExtension( 'WikibaseLexeme' );
}

if ( $wmgUseWikibaseQualityConstraints ?? false ) {
	wfLoadExtension( 'WikibaseQualityConstraints' );
}

if ( $wmgUseWikibaseRepository ?? false ) {
	require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
}

if ( $wmgUseWikibaseRepository ?? false || $wmgUseWikibaseClient ?? false ) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once "/srv/mediawiki/config/Wikibase.php";
}

if ( $wmgUseWikiForum ?? false ) {
	wfLoadExtension( 'WikiForum' );
}

if ( $wmgUsewikihiero ?? false ) {
	wfLoadExtension( 'wikihiero' );
}

if ( $wmgUseWikiLove ?? false ) {
	wfLoadExtension( 'WikiLove' );
}

if ( $wmgUseWikimediaIncubator ?? false ) {
	wfLoadExtension( 'WikimediaIncubator' );
}

if ( $wmgUseWikiSeo ?? false ) {
	wfLoadExtension( 'WikiSEO' );
}

if ( $wmgUseWikiTextLoggedInOut ?? false ) {
	wfLoadExtension( 'WikiTextLoggedInOut' );
}

if ( $wmgUseYouTube ?? false ) {
	wfLoadExtension( 'YouTube' );
}

if ( $wmgUseRegexFunctions ?? false ) {
	wfLoadExtension( 'RegexFunctions' );
}

// If Flow, VisualEditor, or Linter is used, use the Parsoid php extension
if ( $wmgUseFlow ?? false || $wmgUseVisualEditor ?? false || $wmgUseLinter ?? false ) {
	wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );
}
