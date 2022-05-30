<?php

$smwgUpgradeKey = 'smw:2022-04-15';

$smwgNamespacesWithSemanticLinks = [
	NS_MAIN => true,
	NS_TALK => false,
	NS_USER => true,
	NS_USER_TALK => false,
	NS_PROJECT => true,
	NS_PROJECT_TALK => false,
	NS_FILE => true,
	NS_FILE_TALK => false,
	NS_MEDIAWIKI => false,
	NS_MEDIAWIKI_TALK => false,
	NS_TEMPLATE => false,
	NS_TEMPLATE_TALK => false,
	NS_HELP => true,
	NS_HELP_TALK => false,
	NS_CATEGORY => true,
	NS_CATEGORY_TALK => false,
];

$smwgPageSpecialProperties = [
	'_MDAT',
	'_MIME',
	'_MEDIA',
	'_ATTCH_LINK',
];

if ( !class_exists( SMW\Setup::class ) ) {
	require_once "$IP/extensions/SemanticMediaWiki/src/MediaWiki/HookDispatcherAwareTrait.php";
	require_once "$IP/extensions/SemanticMediaWiki/src/Setup.php";
}
