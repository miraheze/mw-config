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
	case 'gratisdatawiki':
		$wgHooks['overridePageMetaTags'][] = 'onOverridePageMetaTags';
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';
		// The title of wikibase entities will be the label, if available, or else the entity id (e.g. 'Q42').
		function onOverridePageMetaTags( OutputPage $outputPage ) {
			$meta = $this->getOutput()->getProperty( 'wikibase-meta-tags' );
			// This would remove description, social media tags, or any search engine optimization for diffs
			if ( $this->isDiff() ) {
				if ( isset( $meta['title'] ) ) {
					$this->setDiffPageTitle( $outputPage, $meta['title'] );
				}
			}
			
			if ( isset( $meta['title'] ) ) {
				$this->setHTMLTitle( $outputPage, $meta['title'] );
				$outputPage->addMeta( 'og:title', $meta['title'] );
			}
			
			if ( isset( $meta['description'] ) ) {
				$outputPage->addMeta( 'description', $meta['description'] );
				$outputPage->addMeta( 'og:description', $meta['description'] );
				
				if ( isset( $meta['title'] ) ) {
					$outputPage->addMeta( 'og:type', 'summary' );
				}
			}
		}
				
		function onBeforePageDisplay( OutputPage $out ) {
			$out->addMeta( 'og:image:width', '1200' );
		}
		
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
	case 'metawiki':
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
			'class' => '\MediaWiki\Extension\QuickInstantCommons\Repo',
			'name' => 'shared-polcomwiki',
			'directory' => $wgUploadDirectory,
			'apibase' => 'https://polcom.miraheze.org/w/api.php',
			'hashLevels' => 2,
			'thumbUrl' => false,
			'fetchDescription' => true,
			'descriptionCacheExpiry' => 43200,
			'transformVia404' => true,
			'abbrvThreshold' => 255,
			'apiMetadataExpiry' => 86400,
			'disabledMediaHandlers' => [ TiffHandler::class ],
		];

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
