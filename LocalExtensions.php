<?php
if ( $wmgUseCentralAuth ) {
	wfLoadExtension( 'CentralAuth' );
}

if ( $wmgUseChameleon ) {
	wfLoadExtension( 'Bootstrap' );
}

if ( $wmgUseCollection ) {
	wfLoadExtension( 'ElectronPdfService' );
}

if ( $wgMirahezeCommons && !$cwPrivate ) {
	wfLoadExtension( 'GlobalUsage' );
}

if ( $wmgUseGlobalWatchlist ) {
	wfLoadExtension( 'GlobalWatchlist' );
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

if ( $wmgUseMultimediaViewer ) {
	if ( $wmgUse3D ) {
		$wgMediaViewerExtensions['stl'] = 'mmv.3d';
	}
}

if ( $wmgUsePopups ) {
	if ( $wmgShowPopupsByDefault ) {
		$wgPopupsHideOptInOnPreferencesPage = true;
		$wgPopupsOptInDefaultState = '1';
		$wgPopupsOptInStateForNewAccounts = '1';
		$wgPopupsReferencePreviewsBetaFeature = false;
	}
}

if ( $wmgUseSocialProfile ) {
	require_once "$IP/extensions/SocialProfile/SocialProfile.php";
}

if ( $wmgUseVisualEditor ) {
	if ( $wmgVisualEditorEnableDefault ) {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 1;
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-editor'] = 'visualeditor';
	} else {
		$wi->config->settings['+wmgDefaultUserOptions']['default']['visualeditor-enable'] = 0;
	}
}

if ( $wmgUseWikibaseRepository || $wmgUseWikibaseClient ) {
	// Includes Wikibase Configuration. There is a global and per-wiki system here.
	require_once '/srv/mediawiki/config/Wikibase.php';
}

// If Flow, VisualEditor, or Linter is used, use the Parsoid php extension
if ( $wmgUseFlow || $wmgUseVisualEditor || $wmgUseLinter ) {
	wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );
}
