<?php

// Per-wiki settings that are incompatible with LocalSettings.php
switch ( $wi->dbname ) {
	case 'betawiki':
		wfLoadExtension( 'GlobalWatchlist' );

		break;
	case 'constantnoblewiki':
		$wgDplSettings['maxResultCount'] = 2500;

		break;
	case 'dmlwikiwiki':
		$wgHooks['SpecialPage_initList'][] = 'onSpecialPage_initList';

		function onSpecialPage_initList( &$specialPages ) {
			unset( $specialPages['Export'] );

			return true;
		}

		break;
	case 'famedatawiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addMeta( 'og:image:width', '1200' );
		}

		break;
	case 'gpcommonswiki':
		$wgJsonConfigs['Map.JsonConfig']['store'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['store'] = true;

		break;
	case 'gratispaideiawiki':
		$wgForeignFileRepos[] = [
			'class' => ForeignDBViaLBRepo::class,
			'name' => 'shared-gpcommonswiki',
			'directory' => '/mnt/mediawiki-static/gpcommonswiki',
			'url' => 'https://static.miraheze.org/gpcommonswiki',
			'hashLevels' => 2,
			'thumbScriptUrl' => false,
			'transformVia404' => !$wgGenerateThumbnailOnParse,
			'hasSharedCache' => false,
			'fetchDescription' => true,
			'descriptionCacheExpiry' => 86400 * 7,
			'wiki' => 'gpcommonswiki',
			'descBaseUrl' => 'https://gpcommons.miraheze.org/wiki/File:',
			'scriptDirUrl' => 'https://gpcommons.miraheze.org/w',
		];

		break;
	case 'ldapwikiwiki':
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

		break;
	case 'libertygamewiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' );
		}

		break;
	case 'loginwiki':
		wfLoadExtension( 'GlobalWatchlist' );

		break;
	case 'newusopediawiki':
		$wgFilterLogTypes['comments'] = false;

		break;
	case 'pokemundowiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addLink( [ 'rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com' ] );
			$out->addLink( [ 'rel' => 'stylesheet', 'href' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' ] );
		}

		break;
	case '402611wiki':
	case 'ballmediawiki':
	case 'partyballwiki':
	case 'polandballfanonwiki':
	case 'polandballwikisongcontestwiki':
	case 'polandsmallswiki':
		$wgForeignFileRepos[] = [
			'class' => ForeignDBViaLBRepo::class,
			'name' => 'shared-polcomwiki',
			'directory' => '/mnt/mediawiki-static/polcomwiki',
			'url' => 'https://static.miraheze.org/polcomwiki',
			'hashLevels' => 2,
			'thumbScriptUrl' => false,
			'transformVia404' => !$wgGenerateThumbnailOnParse,
			'hasSharedCache' => false,
			'fetchDescription' => true,
			'descriptionCacheExpiry' => 86400 * 7,
			'wiki' => 'polcomwiki',
			'descBaseUrl' => 'https://polcom.miraheze.org/wiki/File:',
			'scriptDirUrl' => 'https://polcom.miraheze.org/w',
		];

		break;
	case 'polandballruwiki':
		$wgHooks['InitializeArticleMaybeRedirect'][] = 'onInitializeArticleMaybeRedirect';

		function onInitializeArticleMaybeRedirect( $title, $request, &$ignoreRedirect, &$target, $article ) {
			if ( $title && $title->getNamespace() === 201 ) {
				$newTitle = Title::newFromText( $title->getText(), 3 );
				if ( $newTitle ) {
					$target = $newTitle;
				}
			}
		}

		break;
	case 'snapwikiwiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
		}

		break;
	case 'traceprojectwikiwiki':
	case 'vgportdbwiki':
		$wgDplSettings['allowUnlimitedCategories'] = true;
		$wgDplSettings['allowUnlimitedResults'] = true;

		break;
}
