<?php

// Set up extensions for use on wikis that are not global
if ( $wmgUseAddHTMLMetaAndTitle ) {
	require_once( "$IP/extensions/AddHTMLMetaAndTitle/Add_HTML_Meta_and_Title.php" );
}

if ( $wmgUseAdminLinks ) {
	require_once( "$IP/extensions/AdminLinks/AdminLinks.php" );
}

if ( $wmgUseAJAXPoll ) {
	wfLoadExtension( 'AJAXPoll' );
	// Hiding information is not the wiki way
	$wgGroupPermissions['*']['ajaxpoll-view-results'] = true;
	$wgGroupPermissions['*']['ajaxpoll-view-results-before-vote'] = true;
}

if ( $wmgUseBabel ) {
	require_once( "$IP/extensions/Babel/Babel.php" );
	require_once( "$IP/extensions/cldr/cldr.php" );
}

if ( $wmgUseBetaFeatures ) {
	wfLoadExtension( 'BetaFeatures' );
}

if ( $wmgUseBlogPage ) {
	require_once( "$IP/extensions/SocialProfile/SocialProfile.php" );
	require_once( "$IP/extensions/BlogPage/Blog.php" );
}

if ( $wmgUseMSCalendar ) {
	require_once( "$IP/extensions/MSCalendar/MSCalendar.php" );
}

if ( $wmgUseCategoryTree ) {
	require_once( "$IP/extensions/CategoryTree/CategoryTree.php" );
}

if ( $wmgUseCharInsert ) {
	require_once( "$IP/extensions/CharInsert/CharInsert.php" );
}

if ( $wmgUseContactPage) {
	require_once( "$IP/extensions/ContactPage/ContactPage.php" );

	// Contact Page is a fairly complex (well long) extension to configure.
	// All config should be in the file below on a wikidb basis.
	require_once( "/srv/mediawiki/config/ContactPage.php" );
}

if ( $wmgUseCollapsibleVector ) {
	wfLoadExtension( 'CollapsibleVector' );
}

if ( $wmgUseComments ) {
	wfLoadExtension( 'Comments' );
}

if ( $wmgUseCreateWiki ) {
	require_once( "$IP/extensions/CreateWiki/CreateWiki.php" );
	$wgCreateWikiSQLfiles = $wmgCreateWikiSQLfiles;
}

if ( $wmgUseCSS ) {
	require_once( "$IP/extensions/CSS/CSS.php" );
}

if ( $wmgUseDynamicPageList ) {
	require_once( "$IP/extensions/DynamicPageList/DynamicPageList.php" );
}

if ( $wmgUseEditcount ) {
    wfLoadExtension( 'Editcount' );
}

if ( $wmgUseEchoThanks ) {
	require_once( "$IP/extensions/Echo/Echo.php" );
	require_once( "$IP/extensions/Thanks/Thanks.php" );
}

if ( $wmgUseFlow ) {
	require_once( "$IP/extensions/Flow/Flow.php" );
	$wgGroupPermissions['bureaucrat']['flow-create-board'] = true;

	$wgVirtualRestConfig['modules']['parsoid'] = array(
		'url' => 'https://parsoid1.miraheze.org:443',
		'prefix' => $wgDBname,
	);
}

if ( $wmgFlowDefaultNamespaces ) {
	$wgNamespaceContentModels = array(
		NS_TALK => CONTENT_MODEL_FLOW_BOARD,
		NS_USER_TALK => CONTENT_MODEL_FLOW_BOARD,
		NS_PROJECT_TALK => CONTENT_MODEL_FLOW_BOARD,
		NS_FILE_TALK => CONTENT_MODEL_FLOW_BOARD,
		NS_MEDIAWIKI_TALK => CONTENT_MODEL_FLOW_BOARD,
		NS_TEMPLATE_TALK => CONTENT_MODEL_FLOW_BOARD,
		NS_HELP_TALK => CONTENT_MODEL_FLOW_BOARD,
		NS_CATEGORY_TALK => CONTENT_MODEL_FLOW_BOARD,
	) + $wgNamespaceContentModels;
}

if ( $wmgUseFeaturedFeeds ) {
	require_once( "$IP/extensions/FeaturedFeeds/FeaturedFeeds.php" );
}

if ( $wmgUseForeground ) {
	require_once( "$IP/skins/foreground/foreground.php" );
}

if ( $wmgUseHeaderTabs ) {
	require_once "$IP/extensions/HeaderTabs/HeaderTabs.php";
	if ( $wgDBname == 'extloadwiki' ) {
		// load LC despite SectionHide's strong objections
		unset( $htUseHistory );
	}
}

if ( $wmgUseHighlightLinksInCategory ) {
	wfLoadExtension( 'HighlightLinksInCategory' );
}

if ( $wmgUseImageMap ) {
	wfLoadExtension( 'ImageMap' );
}

if ( $wmgUseInputBox ) {
	wfLoadExtension( 'InputBox' );
}

if ( $wmgUseJosa ) {
	require_once( "$IP/extensions/Josa/Josa.php" );
}

if ( $wmgUseLoopsCombo ) {
	require_once( "$IP/extensions/Variables/Variables.php" );
	require_once( "$IP/extensions/Loops/Loops.php");
}

if ( $wmgUseMetrolook ) {
	wfLoadSkin( 'Metrolook' );
}

if ( $wmgUseMobileFrontend ) {
	require_once( "$IP/extensions/MobileFrontend/MobileFrontend.php" );
}

if ( $wmgUseMonaco ) {
	require_once( "$IP/skins/Monaco/monaco.php" );
}

if ( $wmgUseMsPackage ) {
	require_once( "$IP/extensions/MsUpload/MsUpload.php" );
	require_once( "$IP/extensions/MsLinks/MsLinks.php" );
	require_once( "$IP/extensions/MsCatSelect/MsCatSelect.php" );
}

if ( $wmgUseMsUpload ) {
	require_once( "$IP/extensions/MsUpload/MsUpload.php" );
}

if ( $wmgUseMultimediaViewer ) {
	require_once( "$IP/extensions/MultimediaViewer/MultimediaViewer.php" );
}

if ( $wmgUseMultiBoilerplate ) {
	wfLoadExtension( 'MultiBoilerplate' );
	$wgMultiBoilerplateDisplaySpecialPage = true;
	$wgMultiBoilerplateOptions = false;
}

if ( $wmgUseNativeSvgHandler ) {
	require_once( "$IP/extensions/NativeSvgHandler/NativeSvgHandler.php" );
}

if ( $wmgUseNewestPages ) {
	require_once( "$IP/extensions/NewestPages/NewestPages.php" );
}

if ( $wmgUseNewUserMessage ) {
	require_once( "$IP/extensions/NewUserMessage/NewUserMessage.php" );
}

if ( $wmgUseNoTitle ) {
	require_once( "$IP/extensions/NoTitle/NoTitle.php" );
	$wgRestrictDisplayTitle = false;
}

if ( $wmgUsePageNotice ) {
	require_once( "$IP/extensions/PageNotice/PageNotice.php" );
}

if ( $wmgUsePageTriage ) {
	require_once( "$IP/extensions/PageTriage/PageTriage.php" );
}

if ( $wmgUsePoll ) {
	require_once( "$IP/extensions/Poll/Poll.php" );
}

if ( $wmgUsePopups ) {
	require_once( "$IP/extensions/PageImages/PageImages.php" );
	require_once( "$IP/extensions/Popups/Popups.php" );
	require_once( "$IP/extensions/TextExtracts/TextExtracts.php" );
}

if ( $wmgUseRandomSelection ) {
	require_once( "$IP/extensions/RandomSelection/RandomSelection.php" );
}

if ( $wmgUseSandboxLink ) {
	require_once( "$IP/extensions/SandboxLink/SandboxLink.php" );
}

if ( $wmgUseScratchBlocks ) {
	wfLoadExtension( "ScratchBlocks" );
}

if ( $wmgUseScribunto ) {
	require_once( "$IP/extensions/Scribunto/Scribunto.php" );

    if ( $wmgUseSyntaxHighlight ) {
        $wgScribuntoUseGeSHi = true;
    }
    if ( $wmgUseWikiEditor ) {
        $wgScribuntoUseCodeEditor = true;
    }
}

if ( $wmgUseSectionHide ) {
	require_once( "$IP/extensions/SectionHide/SectionHide.php" );
}

if ( $wmgUseSimpleTooltip ) {
	require_once( "$IP/extensions/SimpleTooltip/SimpleTooltip.php" );
}

if ( $wmgUseSocialProfile ) {
	require_once( "$IP/extensions/SocialProfile/SocialProfile.php" );
}

if ( $wmgUseSubpageFun ) {
	require_once( "$IP/extensions/SubpageFun/SubpageFun.php" );
}

if ( $wmgUseSyntaxHighlight ) {
	wfLoadExtension( 'SyntaxHighlight_GeSHi' );
}

if ( $wmgUseTabsCombination ) {
	require_once( "$IP/extensions/Tabber/Tabber.php" );
	require_once( "$IP/extensions/Tabs/Tabs.php" );
}

if ( $wmgUseTranslate ) {
	require_once( "$IP/extensions/UniversalLanguageSelector/UniversalLanguageSelector.php" );
	require_once( "$IP/extensions/Translate/Translate.php" );
	$wgGroupPermissions['sysop']['pagetranslation'] = true;
	$wgGroupPermissions['sysop']['translate-import'] = true;
	$wgGroupPermissions['sysop']['translate-manage'] = true;
	$wgGroupPermissions['*']['translate'] = true;
	$wgGroupPermissions['user']['translate-messagereview'] = true;
	$wgGroupPermissions['translate-proofr']['translate-messagereview'] = false;
	$wgAddGroups['translate-proofr'] = false;
	// unset this unused group already
	unset( $wgGroupPermissions['translate-proofr'] );
	$wgTranslateBlacklist = $wmgTranslateBlacklist;
	$wgTranslateTranslationServices = $wmgTranslateTranslationServices;
	require_once( "/srv/mediawiki/config/TranslateConfigHack.php" );
}

if ( $wmgUseTimedMediaHandler ) {
	require_once( "$IP/extensions/MwEmbedSupport/MwEmbedSupport.php" );
	require_once( "$IP/extensions/TimedMediaHandler/TimedMediaHandler.php" );
	$wgFFmpeg2theoraLocation = '/usr/bin/ffmpeg2theora';
}

if ( $wmgUseTitleKey ) {
	require_once( "$IP/extensions/TitleKey/TitleKey.php" );
}

if ( $wmgUseVariables ) {
	require_once( "$IP/extensions/Variables/Variables.php" );
}

if ( $wmgUseVisualEditor ) {
	require_once( "$IP/extensions/VisualEditor/VisualEditor.php" );

	$wgVirtualRestConfig['modules']['parsoid'] = array(
		'url' => 'https://parsoid1.miraheze.org:443',
		'prefix' => $wgDBname,
	);


	if ( $wmgVisualEditorEnableDefault ) {
		$wgDefaultUserOptions['visualeditor-enable'] = 1;
	} else {
		$wgDefaultUserOptions['visualeditor-enable'] = 0;
	}

	$wgVisualEditorAvailableNamespaces = $wmgVisualEditorAvailableNamespaces;

	// Load TemplateData
	wfLoadExtension( 'TemplateData' );
}

if ( $wmgUseVoteNY ) {
	require_once( "$IP/extensions/VoteNY/VoteNY.php" );
}

if ( $wmgUseWebChat ) {
	require_once( "$IP/extensions/WebChat/WebChat.php" );
	$wgWebChatClient = $wmgWebChatClient;
	$wgWebChatServer = $wmgWebChatServer;
	$wgWebChatChannel = $wmgWebChatChannel;
}

if ( $wmgUseWikiEditor ) {
	wfLoadExtension( 'WikiEditor' );
	wfLoadExtension( 'CodeEditor' );
	$wgDefaultUserOptions['usebetatoolbar'] = 1;
	$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
	$wgCodeEditorEnableCore = true;
}

if ( $wmgUseWikiForum ) {
	require_once( "$IP/extensions/WikiForum/WikiForum.php" );
}

if ( $wmgUseWikiLove ) {
	require_once( "$IP/extensions/WikiLove/WikiLove.php" );
}

if ( $wmgUseYouTube ) {
	require_once( "$IP/extensions/YouTube/YouTube.php" );
}

// Permission variables
if ( $wmgEditingMatrix ) {
	$mhEM = $wmgEditingMatrix;
	if ( $mhEM['anon'] ) {
		$wgGroupPermissions['*']['edit'] = false;
		$wgGroupPermissions['*']['createpage'] = false;
	}

	if ( $mhEM['user'] ) {
		$wgGroupPermissions['user']['edit'] = false;
		$wgGroupPermissions['user']['createpage'] = false;
	}

	if ( $mhEM['editor'] ) {
		$wgGroupPermissions['editor']['edit'] = true;
		$wgGroupPermissions['editor']['createpage'] = true;
		$wgAddGroups['sysop'][] = 'editor';
		$wgRemoveGroups['sysop'][] = 'editor';
	}

	if ( $mhEM['sysop'] ) {
		$wgGroupPermissions['sysop']['edit'] = true;
		$wgGroupPermissions['sysop']['createpage'] = true;
	}
}
