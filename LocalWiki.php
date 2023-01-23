<?php

// Per-wiki settings that are incompatible with LocalSettings.php
switch ( $wi->dbname ) {
	case 'arquivopkmnwiki':
		$wgJsonConfigs['Map.JsonConfig']['isLocal'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['isLocal'] = true;

		$wgJsonConfigs['Map.JsonConfig']['license'] = 'CC0-1.0';
		$wgJsonConfigs['Tabular.JsonConfig']['license'] = 'CC0-1.0';

		$wgJsonConfigs['Map.JsonConfig']['store'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['store'] = true;

		break;
	case 'betawiki':
		wfLoadExtension( 'GlobalWatchlist' );

		break;
	case 'commonswiki':
		$wgJsonConfigs['Map.JsonConfig']['store'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['store'] = true;

		break;
	case 'comprehensiblewiki':
		$wgExternalDataSources['*']['min cache seconds'] = 0;

		break;
	case 'constantnoblewiki':
		$wgDplSettings['maxResultCount'] = 2500;

		break;
	case 'datawikiwiki':
		$wgHooks['SkinAddFooterLinks'][] = 'onSkinAddFooterLinks';

		function onSkinAddFooterLinks( Skin $skin, string $key, array &$footerItems ) {
			if ( $key === 'places' ) {
				$footerItems['github'] = Linker::makeExternalLink( 'https://github.com/Datawiki-online', 'GitHub' );
			}
		}

		break;
	case 'dmlwikiwiki':
		$wgHooks['SpecialPage_initList'][] = 'onSpecialPage_initList';

		function onSpecialPage_initList( &$specialPages ) {
			unset( $specialPages['Export'] );

			return true;
		}

		break;
	case 'dragontamerwiki':
		$wgDplSettings['maxCategoryCount'] = 7;

		break;
	case 'famedatawiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addMeta( 'og:image:width', '1200' );
		}

		break;
	case 'gpcommonswiki':
		$wgJsonConfigs['Map.JsonConfig']['isLocal'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['isLocal'] = true;

		$wgJsonConfigs['Map.JsonConfig']['license'] = 'CC0-1.0';
		$wgJsonConfigs['Tabular.JsonConfig']['license'] = 'CC0-1.0';

		$wgJsonConfigs['Map.JsonConfig']['store'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['store'] = true;

		break;
	case 'gratisdatawiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $outputPage ) {
			$outputPage->addMeta( 'og:image:width', '1200' );

			$meta = $outputPage->getProperty( 'wikibase-meta-tags' );
			if ( isset( $meta['title'] ) ) {
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

		$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
			'url' => 'https://gpcommons.miraheze.org/w/api.php'
		];
		$wgJsonConfigs['Map.JsonConfig']['remote'] = [
			'url' => 'https://gpcommons.miraheze.org/w/api.php'
		];

		break;
	case 'gratispaideiawiki':
		$wgForeignFileRepos[] = [
			'class' => ForeignDBViaLBRepo::class,
			'name' => 'shared-gpcommonswiki',
			'backend' => 'miraheze-swift',
			'url' => 'https://static.miraheze.org/gpcommonswiki',
			'hashLevels' => 2,
			'thumbScriptUrl' => false,
			'transformVia404' => true,
			'hasSharedCache' => true,
			'descBaseUrl' => 'https://gpcommons.miraheze.org/wiki/File:',
			'scriptDirUrl' => 'https://gpcommons.miraheze.org/w',
			'fetchDescription' => true,
			'descriptionCacheExpiry' => 86400 * 7,
			'wiki' => 'gpcommonswiki',
			'initialCapital' => true,
			'zones' => [
				'public' => [
					'container' => 'local-public',
				],
				'thumb' => [
					'container' => 'local-thumb',
				],
				'temp' => [
					'container' => 'local-temp',
				],
				'deleted' => [
					'container' => 'local-deleted',
				],
			],
			'abbrvThreshold' => 160
		];

		$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
			'url' => 'https://gpcommons.miraheze.org/w/api.php'
		];

		$wgJsonConfigs['Map.JsonConfig']['remote'] = [
			'url' => 'https://gpcommons.miraheze.org/w/api.php'
		];

		break;
	case 'houkai2ndwiki':
		$wgSpecialPages['Analytics'] = DisabledSpecialPage::getCallback( 'Analytics', 'MatomoAnalytics-disabled' );
		$wgPageImagesScores['position'] = [ 100, -100, -100, -100 ];

		break;
	case 'ldapwikiwiki':
		wfLoadExtension( 'LdapAuthentication' );

		$wgAuthManagerAutoConfig['primaryauth'] += [
			LdapPrimaryAuthenticationProvider::class => [
				'class' => LdapPrimaryAuthenticationProvider::class,
				'args' => [ [
					// don't allow local non-LDAP accounts
					'authoritative' => true,
				] ],
				// must be smaller than local pw provider
				'sort' => 50,
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
		$wgContactConfig = [
			'default' => [
				'RecipientUser' => null,
				'SenderName' => 'Contact Form on ' . $wgSitename,
				'RequireDetails' => false,
				'IncludeIP' => false,
				'MustBeLoggedIn' => false,
			],
			'requestaccount' => [
				'RecipientUser' => 'Miraheze CVT',
				'SenderName' => 'Account Creation Request Form via Meta',
				'RequireDetails' => true,
				'IncludeIP' => false,
				'MustBeLoggedIn' => false,
				'AdditionalFields' => [
					'SelectIssue' => [
						'label-message' => 'contactpage-requestaccount-selectissue',
						'type' => 'radio',
						'options-messages' => [
							'contactpage-requestaccount-selectissue-abusefilterissue' => 'abusefilter',
							'contactpage-requestaccount-selectissue-recaptchaissues' => 'captcha',
							'version-other' => 'other',
						],
						'help-message' => 'contactpage-requestaccount-selectissue-help',
						'required' => true,
					],
					'DescribeIssue' => [
						'label-message' => 'contactpage-requestaccount-describeissue',
						'type' => 'text',
						'hide-if' => [
							'!==',
							'SelectIssue',
							'other'
						],
						'help-message' => 'contactpage-requestaccount-describeissue-help',
						'required' => true,
					],
					'SelectUsername' => [
						'label-message' => 'contactpage-requestaccount-selectusername',
						'type' => 'text',
						'maxlength' => 50,
						'help-message' => 'contactpage-requestaccount-selectusername-help',
						'required' => true,
					],
					'OtherDetails' => [
						'label-message' => 'contactpage-requestaccount-otherdetails',
						'type' => 'textarea',
						'help-message' => 'contactpage-requestaccount-otherdetails-help',
						'required' => false,
					],
				],
				'DisplayFormat' => 'raw',
			],
		];
		break;
	case 'newusopediawiki':
		$wgFilterLogTypes['comments'] = false;

		break;
	case 'persistwiki':
		$wgDplSettings['maxCategoryCount'] = 10;

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
	case 'readerswhoknowwiki':
		$wgHooks['AdminLinks'] = 'onAdminLinks';
		function onAdminLinks( &$adminLinksTree ) {
			$general = $adminLinksTree->getSection( wfMessage( 'adminlinks_general' )->text() );
			$generalRow = $general->getRow( 'main' );
			$generalRow->addItem( ALItem::newFromEditLink( 'Common.js', 'Edit JS file' ) );
			$generalRow->addItem( ALItem::newFromSpecialPage( 'TimeMachine' ) );
		}

		break;
	case 'polandballfanonwiki':
	case 'polandballwikisongcontestwiki':
	case 'polandsmallswiki':
		$wgForeignFileRepos[] = [
			'class' => ForeignDBViaLBRepo::class,
			'name' => 'shared-polcomwiki',
			'backend' => 'miraheze-swift',
			'url' => 'https://static.miraheze.org/polcomwiki',
			'hashLevels' => 2,
			'thumbScriptUrl' => false,
			'transformVia404' => true,
			'hasSharedCache' => true,
			'descBaseUrl' => 'https://polcom.miraheze.org/wiki/File:',
			'scriptDirUrl' => 'https://polcom.miraheze.org/w',
			'fetchDescription' => true,
			'descriptionCacheExpiry' => 86400 * 7,
			'wiki' => 'polcomwiki',
			'initialCapital' => true,
			'zones' => [
				'public' => [
					'container' => 'local-public',
				],
				'thumb' => [
					'container' => 'local-thumb',
				],
				'temp' => [
					'container' => 'local-temp',
				],
				'deleted' => [
					'container' => 'local-deleted',
				],
			],
			'abbrvThreshold' => 160
		];

		break;
	case 'polandballruwiki':
		$wgHooks['BeforeInitialize'][] = 'onBeforeInitialize';

		function onBeforeInitialize( Title &$title, $unused, OutputPage $output, User $user, WebRequest $request, MediaWiki $mediaWiki ) {
			if ( $title && $title->getNamespace() === 201 ) {
				$newTitle = Title::newFromText( $title->getText(), 3 );
				if ( $newTitle ) {
					$output->redirect( $newTitle->getFullURL() );
				}
			}
		}

		break;
	case 'sagan4wiki':
	case 'sagan4alphawiki':
		$wgCargoAllowedSQLFunctions[] = 'RAND';
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
	case 'worldboxwiki':
		$wgSpecialPages['Analytics'] = DisabledSpecialPage::getCallback( 'Analytics', 'MatomoAnalytics-disabled' );

		break;
}
