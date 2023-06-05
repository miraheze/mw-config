<?php

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

$smwgMainCacheType = 'memcached-mem-2';

if ( !class_exists( SMW\Setup::class ) ) {
	require_once "$IP/extensions/SemanticMediaWiki/src/MediaWiki/HookDispatcherAwareTrait.php";
	require_once "$IP/extensions/SemanticMediaWiki/src/Setup.php";
}

if ( $wgDBname === 'constantnoblewiki' ) {
	array_push( $smwgPageSpecialProperties, '_CDAT' );

	$smwgNamespacesWithSemanticLinks = [
		NS_MAIN => true,
		NS_TALK => false,
		NS_USER => true,
		NS_USER_TALK => false,
		NS_PROJECT => true,
		NS_PROJECT_TALK => false,
		NS_FILE => true,
		NS_FILE_TALK => false,
		NS_MEDIAWIKI => true,
		NS_MEDIAWIKI_TALK => false,
		NS_TEMPLATE => true,
		NS_TEMPLATE_TALK => false,
		NS_HELP => true,
		NS_HELP_TALK => false,
		NS_CATEGORY => true,
		NS_CATEGORY_TALK => false,
		3008 => true,
		3009 => false,
		3012 => true,
		3013 => false,
		3018 => true,
		3019 => false,
		3020 => true,
		3021 => false,
		3022 => true,
		3023 => false,
		3024 => true,
		3025 => false,
		3026 => true,
		3027 => false,
		3032 => true,
		3033 => false,
		3034 => true,
		3035 => false,
		3036 => true,
		3037 => false,
		3040 => true,
		3041 => false,
		3044 => true,
		3045 => false,
		3050 => true,
		3051 => false,
	];

	$smwgQMaxInlineLimit = 750;
}
