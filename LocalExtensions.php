<?php

// Set up extensions for use on wikis that are not global
if ( $wmgUseAdminLinks ) {
	require_once( "$IP/extensions/AdminLinks/AdminLinks.php" );
}

if ( $wmgUseBabel ) {
	require_once( "$IP/extensions/Babel/Babel.php" );
	require_once( "$IP/extensions/cldr/cldr.php" );
}

if ( $wmgUseCharInsert ) {
	require_once( "$IP/extensions/CharInsert/CharInsert.php" );
}

if ( $wmgUseCollapsibleVector ) {
	wfLoadExtension( 'CollapsibleVector' );
}

if ( $wmgUseCreateWiki ) {
	require_once( "$IP/extensions/CreateWiki/CreateWiki.php" );
	$wgCreateWikiSQLfiles = $wmgCreateWikiSQLfiles;
}

if ( $wmgUseDynamicPageList ) {
	require_once( "$IP/extensions/DynamicPageList/DynamicPageList.php" );
}

if ( $wmgUseEchoThanks ) {
	require_once( "$IP/extensions/Echo/Echo.php" );
	require_once( "$IP/extensions/Thanks/Thanks.php" );
}

if ( $wmgUseFlow ) {
	require_once( "$IP/extensions/Flow/Flow.php" );
	$wgGroupPermissions['bureaucrat']['flow-create-board'] = true;
	$wgFlowOccupyNamespaces = $wmgFlowOccupyNamespaces;

	$wgVirtualRestConfig['modules']['parsoid'] = array(
	  'url' => 'http://parsoid1.miraheze.org:8142',
	  'prefix' => $wgDBname,
	);
}

if ( $wmgUseFeaturedFeeds) {
	require_once( "$IP/extensions/FeaturedFeeds/FeaturedFeeds.php" );
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

if ( $wmgUseMsPackage ) {
	require_once( "$IP/extensions/MsUpload/MsUpload.php" );
	require_once( "$IP/extensions/MsLinks/MsLinks.php" );
	require_once( "$IP/extensions/MsCatSelect/MsCatSelect.php" );
}

if ( $wmgUseMsUpload ) {
	require_once( "$IP/extensions/MsUpload/MsUpload.php" );
}

if ( $wmgUseMultiUpload ) {
	require_once( "$IP/extensions/MultiUpload/MultiUpload.php" );
}

if ( $wmgUseMobileFrontend ) {
	require_once( "$IP/extensions/MobileFrontend/MobileFrontend.php" );
}

if ( $wmgUsePopups ) {
        require_once( "$IP/extensions/PageImages/PageImages.php" );
        require_once( "$IP/extensions/Popups/Popups.php" );
        require_once( "$IP/extensions/TextExtracts/TextExtracts.php" );
}

if ( $wmgUseScribunto ) {
	require_once( "$IP/extensions/Scribunto/Scribunto.php" );
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

if ( $wmgUseVectorBeta ) {
	wfLoadExtension( 'VectorBeta' );
}

if ( $wmgUseVisualEditor ) {
	require_once( "$IP/extensions/VisualEditor/VisualEditor.php" );

	$wgVirtualRestConfig['modules']['parsoid'] = array(
	  'url' => 'http://parsoid1.miraheze.org:8142',
	  'prefix' => $wgDBname,
	);

	$wgDefaultUserOptions['visualeditor-enable'] = 1;
	
	// Load TemplateData
	wfLoadExtension( 'TemplateData' );
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

if ( $wmgUseYouTube ) {
	require_once( "$IP/extensions/YouTube/YouTube.php" );
}

// Permission variables
if ( $wmgDisableAnonEditing ) {
	$wgGroupPermissions['*']['edit'] = false;
	$wgGroupPermissions['*']['createpage'] = false;
}
