<?php
# TODO Remove this hack!

$wgSpecialPages['PageTranslation'] = 'SpecialPageTranslation';
$wgSpecialPageGroups['PageTranslation'] = 'pagetools';
$wgSpecialPages['PageTranslationDeletePage'] = 'SpecialPageTranslationDeletePage';
$wgSpecialPageGroups['PageTranslationDeletePage'] = 'pagetools';
$wgAvailableRights[] = 'pagetranslation';
$wgSpecialPages['PageMigration'] = 'SpecialPageMigration';
$wgSpecialPageGroups['PageMigration'] = 'wiki';
$wgSpecialPages['PagePreparation'] = 'SpecialPagePreparation';
$wgSpecialPageGroups['PagePreparation'] = 'wiki';
$wgLogTypes[] = 'pagetranslation';
$wgLogActionsHandlers['pagetranslation/mark'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/unmark'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/moveok'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/movenok'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/deletelok'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/deletefok'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/deletelnok'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/deletefnok'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/encourage'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/discourage'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/prioritylanguages'] =
	'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/associate'] = 'PageTranslationLogFormatter';
$wgLogActionsHandlers['pagetranslation/dissociate'] = 'PageTranslationLogFormatter';
global $wgJobClasses;
$wgJobClasses['TranslateRenderJob'] = 'TranslateRenderJob';
$wgJobClasses['RenderJob'] = 'TranslateRenderJob';
$wgJobClasses['TranslateMoveJob'] = 'TranslateMoveJob';
$wgJobClasses['MoveJob'] = 'TranslateMoveJob';
$wgJobClasses['TranslateDeleteJob'] = 'TranslateDeleteJob';
$wgJobClasses['DeleteJob'] = 'TranslateDeleteJob';
// Namespaces
// Define constants for more readable core
if ( !defined( 'NS_TRANSLATIONS' ) ) {
	define( 'NS_TRANSLATIONS', $wgPageTranslationNamespace );
	define( 'NS_TRANSLATIONS_TALK', $wgPageTranslationNamespace + 1 );
}
$wgNamespacesWithSubpages[NS_TRANSLATIONS] = true;
$wgNamespacesWithSubpages[NS_TRANSLATIONS_TALK] = true;
// Standard protection and register it for filtering
$wgNamespaceProtection[NS_TRANSLATIONS] = array( 'translate' );
$wgTranslateMessageNamespaces[] = NS_TRANSLATIONS;
/// Page translation hooks
/// @todo Register our css, is there a better place for this?
$wgHooks['OutputPageBeforeHTML'][] = 'PageTranslationHooks::injectCss';
// Add transver tags and update translation target pages
$wgHooks['PageContentSaveComplete'][] = 'PageTranslationHooks::onSectionSave';
// Check syntax for \<translate>
$wgHooks['PageContentSave'][] = 'PageTranslationHooks::tpSyntaxCheck';
$wgHooks['EditFilterMergedContent'][] =
	'PageTranslationHooks::tpSyntaxCheckForEditContent';
// Add transtag to page props for discovery
$wgHooks['PageContentSaveComplete'][] = 'PageTranslationHooks::addTranstag';
$wgHooks['RevisionInsertComplete'][] =
	'PageTranslationHooks::updateTranstagOnNullRevisions';
// Register \<languages/>
$wgHooks['ParserFirstCallInit'][] = 'TranslateHooks::setupParserHooks';
// Strip \<translate> tags etc. from source pages when rendering
$wgHooks['ParserBeforeStrip'][] = 'PageTranslationHooks::renderTagPage';
// Set the page content language
$wgHooks['PageContentLanguage'][] = 'PageTranslationHooks::onPageContentLanguage';
// Prevent editing of unknown pages in Translations namespace
$wgHooks['getUserPermissionsErrorsExpensive'][] =
	'PageTranslationHooks::preventUnknownTranslations';
// Prevent editing of translation in restricted languages
$wgHooks['getUserPermissionsErrorsExpensive'][] =
	'PageTranslationHooks::preventRestrictedTranslations';
// Prevent editing of translation pages directly
$wgHooks['getUserPermissionsErrorsExpensive'][] =
	'PageTranslationHooks::preventDirectEditing';
// Prevent patroling of translation pages
$wgHooks['getUserPermissionsErrors'][] =
	'PageTranslationHooks::preventPatrolling';
// Our custom header for translation pages
$wgHooks['ArticleViewHeader'][] = 'PageTranslationHooks::translatablePageHeader';
// Custom move page that can move all the associated pages too
$wgHooks['SpecialPage_initList'][] = 'PageTranslationHooks::replaceMovePage';
// Locking during page moves
$wgHooks['getUserPermissionsErrorsExpensive'][] =
	'PageTranslationHooks::lockedPagesCheck';
// Disable action=delete
$wgHooks['ArticleConfirmDelete'][] = 'PageTranslationHooks::disableDelete';
// Replace subpage logic behavior
$wgHooks['SkinSubPageSubtitle'][] = 'PageTranslationHooks::replaceSubtitle';
// Show page source code when export tab is opened
$wgHooks['SpecialTranslate::executeTask'][] = 'PageTranslationHooks::sourceExport';
// Replaced edit tab with translation tab for translation pages
$wgHooks['SkinTemplateNavigation'][] = 'PageTranslationHooks::translateTab';
// Update translated page when translation unit is moved
$wgHooks['TitleMoveComplete'][] = 'PageTranslationHooks::onMoveTranslationUnits';
