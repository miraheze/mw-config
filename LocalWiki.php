<?php

// Per-wiki settings that are incompatible with LocalSettings.php

if ( $wgDBname === 'erislywiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

	function onBeforePageDisplay( OutputPage $out ) {
		$out->addMeta( 'PreMiD_Presence', 'Erisly' );
	}
}

if ( $wgDBname === 'libertygamewiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

	function onBeforePageDisplay( OutputPage $out ) {
		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' );
	}
}

if ( $wgDBname === 'metawiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

	function onBeforePageDisplay( OutputPage $out ) {
		$out->addMeta( 'description', 'Miraheze is an open source project that offers free MediaWiki hosting, for everyone. Request your free wiki today!' );
		$out->addMeta( 'revisit-after', '2 days' );
		$out->addMeta( 'keywords', 'miraheze, free, wiki hosting, mediawiki, mediawiki hosting, open source, hosting' );
	}

	$wgHooks['SkinBuildSidebar'][] = 'onSkinBuildSidebar';

	function onSkinBuildSidebar( $skin, &$bar ) {
		$bar['miraheze-sidebar-donate'][] = [
			'text' => $skin->msg( 'miraheze-donate' ),
			'href' => '/wiki/Special:MyLanguage/Donate',
			'title' => $skin->msg( 'miraheze-donate' ),
			'id' => 'n-donate',
		];
	}
}

if ( $wgDBname === 'newusopediawiki' ) {
	$wgFilterLogTypes['comments'] = false;
}

if ( $wgDBname === 'pokemundowiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

	function onBeforePageDisplay( OutputPage $out ) {
		$out->addLink( [ 'rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com' ] );
		$out->addLink( [ 'rel' => 'stylesheet', 'href' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' ] );
	}
}

if ( in_array( $wgDBname, [ 'polandballwikisongcontestwiki', 'polandsmallswiki', 'ballmediawiki', 'polandballfanonwiki', 'partyballwiki', '402611wiki' ] ) ) {
	$wgForeignFileRepos[] = [
		'class' => 'ForeignDBViaLBRepo',
		'name' => 'shared-polcomwiki',
		'directory' => '/mnt/mediawiki-static/polcomwiki',
		'url' => 'https://static.miraheze.org/polcomwiki',
		'hashLevels' => $wgHashedSharedUploadDirectory ? 2 : 0,
		'fetchDescription' => true,
		'descriptionCacheExpiry' => 86400 * 7,
		'thumbScriptUrl' => false,
		'transformVia404' => !$wgGenerateThumbnailOnParse,
		'hasSharedCache' => false,
		'wiki' => 'polcomwiki',
		'descBaseUrl' => 'https://commons.ballmedia.org/wiki/File:',
	];
}

if ( $wgDBname === 'snapwikiwiki' ) {
	$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

	function onBeforePageDisplay( OutputPage $out ) {
		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
	}
}

if ( $wgDBname === 'traceprojectwikiwiki' ) {
	$wgDplSettings['allowUnlimitedCategories'] = true;
	$wgDplSettings['allowUnlimitedResults'] = true;
}

if ( $wgDBname === 'vgportdbwiki' ) {
	$wgDplSettings['allowUnlimitedCategories'] = true;
	$wgDplSettings['allowUnlimitedResults'] = true;
}
