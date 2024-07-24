<?php

use MediaWiki\Actions\ActionEntryPoint;
use MediaWiki\Linker\Linker;
use MediaWiki\Output\OutputPage;
use MediaWiki\Request\WebRequest;
use MediaWiki\SpecialPage\DisabledSpecialPage;
use MediaWiki\Title\Title;
use MediaWiki\User\User;

// Per-wiki settings that are incompatible with LocalSettings.php
switch ( $wi->dbname ) {
	case 'aieseattlewiki':
		$wgUploadWizardConfig = [
			'campaignExpensiveStatsEnabled' => false,
			'flickrApiKey' => $wmgUploadWizardFlickrApiKey,
			'tutorial' => [
				'skip' => true,
			],
			'licensing' => [
				'ownWorkDefault' => 'own',
				'ownWork' => [
					'type' => 'or',
					'template' => 'licensing',
					'licenses' => 'generic',
				],
			],
		];

		break;
	case 'arquivopkmnwiki':
		$wgJsonConfigs['Map.JsonConfig']['isLocal'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['isLocal'] = true;

		$wgJsonConfigs['Map.JsonConfig']['license'] = 'CC0-1.0';
		$wgJsonConfigs['Tabular.JsonConfig']['license'] = 'CC0-1.0';

		$wgJsonConfigs['Map.JsonConfig']['store'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['store'] = true;

		break;
	case 'commonswiki':
		$wgJsonConfigs['Map.JsonConfig']['store'] = true;
		$wgJsonConfigs['Tabular.JsonConfig']['store'] = true;

		break;
	case 'comprehensibleinputwiki':
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
	case 'dlfmwiki':
		$wgHooks['TranslatePostInitGroups'][] = static function ( &$list, &$deps, &$autoload ) {
			$id = 'local-sys-msg';
			$mg = new WikiMessageGroup( $id, 'local-messages' );
			$mg->setLabel( 'Local System Messagss' );
			$mg->setDescription( 'Messages used specially on this wiki.' );
			$list[$id] = $mg;
			return true;
		};

		break;
	case 'dmlwikiwiki':
		$wgHooks['SpecialPage_initList'][] = 'onSpecialPage_initList';

		function onSpecialPage_initList( &$specialPages ) {
			unset( $specialPages['Export'] );

			return true;
		}

		break;
	case 'dragonquestxwiki':
		$wgPopupsConf['contentPreviews'] = [
			'image' => true,
			'description' => false,
		];

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
	case 'furrnationswiki':
		$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
			'url' => 'https://commons.wikimedia.org/w/api.php'
		];
		$wgJsonConfigs['Map.JsonConfig']['remote'] = [
			'url' => 'https://commons.wikimedia.org/w/api.php'
		];
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
	case 'lhmnwiki':
		$wgUploadWizardConfig = [
			'campaignExpensiveStatsEnabled' => false,
			'tutorial' => [
				'skip' => false,
			],
			'altUploadForm' => 'Special:Upload',
			'enableFormData' => true,
			'autoAdd' => [
				'wikitext' => [
					'Tập tin này được tải lên bằng Trình thuật sĩ.'
				],
				'categories' => [
					 'Tập tin được tải lên bằng trải nghiệm Trình thuật sĩ'
				],
			],
			'uwLanguages' => [
				'vi' => 'Tiếng Việt',
				'en' => 'English'
			],
			'licenses' => [
				'lhmn' => [
					'msg' => 'mwe-upwiz-license-lhmn',
					'url' => '//facebook.com/lophocmatngu',
				],
				'snxyz' => [
					'msg' => 'mwe-upwiz-license-snxyz',
					'url' => '//songngu.xyz/License',
				]
			],
			'licensing' => [
				'defaultType' => 'ownwork',
				'ownWorkDefault' => 'choice',
				'thirdParty' => [
					'type' => 'or',
					'licenseGroups' => [
						[
							'head' => 'mwe-upwiz-license-lhmn-head',
							'subhead' => 'mwe-upwiz-license-lhmn-subhead',
							'licenses' => [
								'lhmn'
							],
							'template' => 'LHMN'
						],
						[
							'head' => 'mwe-upwiz-license-snxyz-head',
							'subhead' => 'mwe-upwiz-license-snxyz-subhead',
							'licenses' => [
								'snxyz'
							],
							'template' => 'SNXYZ'
						],
						[
							'head' => 'mwe-upwiz-license-cc-head',
							'subhead' => 'mwe-upwiz-license-cc-subhead',
							'licenses' => [
								'cc-zero',
								'cc-by-4.0',
								'cc-by-3.0',
								'cc-by-2.5',
								'cc-by-sa-4.0',
								'cc-by-sa-3.0',
								'cc-by-sa-2.5'
							]
						],
						[
							'head' => 'mwe-upwiz-license-custom-head',
							'special' => 'custom',
							'licenses' => [ 'custom' ]
						]
					]
				]
			]
		];

		break;
	case 'libertygamewiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' );
		}

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
				'IncludeIP' => true,
				'MustBeLoggedIn' => false,
				'AdditionalFields' => [
					'SelectIssue' => [
						'label-message' => 'contactpage-requestaccount-selectissue',
						'type' => 'radio',
						'options-messages' => [
							'contactpage-requestaccount-selectissue-abusefilterissue' => 'abusefilter',
							'contactpage-requestaccount-selectissue-recaptchaissues' => 'captcha',
							'contactpage-requestaccount-selectissue-globalblock' => 'globalblock',
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
					'SelectGlobalBlockIssue' => [
						'label-message' => 'contactpage-requestaccount-describeglobalblockissue',
						'type' => 'radio',
						'hide-if' => [
							'!==',
							'SelectIssue',
							'globalblock'
						],
						'options-messages' => [
							'contactpage-requestaccount-describeglobalblockissue-crosswikiabuse' => 'crosswikiabuse',
							'contactpage-requestaccount-describeglobalblockissue-crosswikispam' => 'crosswikispam',
							'contactpage-requestaccount-describeglobalblockissue-crosswikivandalism' => 'crosswikivandalism',
							'contactpage-requestaccount-describeglobalblockissue-lta' => 'lta',
							'contactpage-requestaccount-describeglobalblockissue-nopp' => 'webhostorproxy',
							'contactpage-requestaccount-describeglobalblockissue-ts' => 'trustandsafetyblock',
							'version-other' => 'other',
						],
						'help-message' => 'contactpage-requestaccount-describeglobalblockissue-help',
						'required' => true,
					],
					'OtherGlobalBlockIssue' => [
						'label-message' => 'contactpage-requestaccount-describeglobalblockissue-otherissue',
						'type' => 'text',
						'hide-if' => [
							'!==',
							'SelectGlobalBlockIssue',
							'other'
						],
						'help-message' => 'contactpage-requestaccount-describeglobalblockissue-otherissue',
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
			'requestbetaaccount' => [
				'RecipientUser' => 'Miraheze Operations',
				'SenderName' => 'Mirabeta account creation request (via Meta)',
				'RequireDetails' => true,
				'MustBeLoggedIn' => true,
				'AdditionalFields' => [
					'SelectUsername' => [
						'label-message' => 'contactpage-requestbetaaccount-selectusername',
						'type' => 'text',
						'maxlength' => 50,
						'help-message' => 'contactpage-requestbetaaccount-selectusername-help',
						'required' => true,
					],
					'RequestReason' => [
						'label-message' => 'contactpage-requestbetaaccount-requestreason',
						'type' => 'textarea',
						'help-message' => 'contactpage-requestaccount-requestreason-help',
						'required' => true,
					],
				],
				'DisplayFormat' => 'table',
			],
		];

		$wgTranslateTranslationServices['Google'] = [
			'url' => 'https://translation.googleapis.com/language/translate/v2',
			'key' => $wmgTranslateGoogleTranslateMetaKey,
			'timeout' => 3,
			'type' => 'google',
		];

		wfLoadExtensions( [
			'GlobalWatchlist',
			'IncidentReporting',
			'RequestSSL',
			'SecurePoll',
		] );

		break;
	case 'metawikibeta':
		wfLoadExtensions( [
			'GlobalWatchlist',
			'RequestSSL',
		] );

		$wgFeaturedFeeds['test'] = [
			'page' => 'feedtest',
			'title' => 'feedtest-title',
			'feedtest-description',
			'entryName' => 'feedtest-entryname',
		];

		break;
	case 'metzowiki':
		$wgDplSettings['allowUnlimitedCategories'] = true;
		$wgDplSettings['allowUnlimitedResults'] = true;

		break;
	case 'newusopediawiki':
		$wgFilterLogTypes['comments'] = false;

		break;
	case 'nycsubwaywiki':
		unset( $wgGroupPermissions['interwiki-admin'] );
		unset( $wgGroupPermissions['no-ipinfo'] );

		break;
	case 'persistwiki':
		$wgDplSettings['maxCategoryCount'] = 10;

		break;
	case 'picrosswiki':
		$wgLogos = [
			'svg' => "https://static.miraheze.org/picrosswiki/0/0a/Pikuw.svg",
		];
		break;
	case 'pokemundowiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addLink( [ 'rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com' ] );
			$out->addLink( [ 'rel' => 'stylesheet', 'href' => 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' ] );
		}

		break;
	case 'paneidoversewiki':
		$wgHooks['AdminLinks'][] = 'onAdminLinks';

		function onAdminLinks( &$adminLinksTree ) {
			$general = $adminLinksTree->getSection( wfMessage( 'adminlinks_general' )->text() );
			$generalRow = $general->getRow( 'main' );
			$generalRow->addItem( ALItem::newFromSpecialPage( 'TimeMachine' ) );
			$generalRow->addItem( ALItem::newFromSpecialPage( 'ArticlesHome' ) );
			$generalRow->addItem( ALItem::newFromSpecialPage( 'EditWatchlist' ) );
			$generalRow->addItem( ALItem::newFromSpecialPage( 'GlobalPreferences' ) );
			$generalRow->addItem( ALItem::newFromSpecialPage( 'Upload' ) );
			$generalRow->addItem( ALItem::newFromEditLink( 'Common.js', 'Edit JS file' ) );
			$generalRow->addItem( ALItem::newFromPage( 'Draft:Portal', 'Draft portal' ) );

			$users = $adminLinksTree->getSection( wfMessage( 'adminlinks_users' )->text() );
			$usersRow = $users->getRow( 'main' );
			$usersRow->addItem( ALItem::newFromSpecialPage( 'BlockUser' ) );

			$browseAndSearch = $adminLinksTree->getSection( wfMessage( 'adminlinks_browsesearch' )->text() );
			$browseAndSearchRow = $browseAndSearch->getRow( 'main' );
			$browseAndSearchRow->addItem( ALItem::newFromSpecialPage( 'UnusedFiles' ) );
		}

		break;
	case 'polandballruwiki':
		$wgHooks['BeforeInitialize'][] = 'onBeforeInitialize';

		function onBeforeInitialize( Title &$title, $unused, OutputPage $output, User $user, WebRequest $request, ActionEntryPoint $mediaWikiEntryPoint ) {
			if ( $title && $title->getNamespace() === 201 ) {
				$newTitle = Title::newFromText( $title->getText(), 3 );
				if ( $newTitle ) {
					$output->redirect( $newTitle->getFullURL() );
				}
			}
		}

		break;
	case 'rainversewiki':
		$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
			'url' => 'https://commons.wikimedia.org/w/api.php'
		];
		$wgJsonConfigs['Map.JsonConfig']['remote'] = [
			'url' => 'https://commons.wikimedia.org/w/api.php'
		];
		break;
	case 'sagan4wiki':
	case 'sagan4betawiki':
	case 'sagan4alphawiki':
		$wgCargoAllowedSQLFunctions[] = 'RAND';
		break;
	case 'snapwikiwiki':
		$wgHooks['BeforePageDisplay'][] = 'onBeforePageDisplay';

		function onBeforePageDisplay( OutputPage $out ) {
			$out->addMeta( 'viewport', 'width=device-width, initial-scale=1' );
		}

		break;
	case 'spacewiki':
		$wgExtraNamespaces += [
			NS_TALK => 'talk',
			NS_USER => 'user',
			NS_USER_TALK => 'user-talk',
			NS_FILE => 'file',
			NS_FILE_TALK => 'file-talk',
			NS_MEDIAWIKI => 'mediawiki',
			NS_MEDIAWIKI_TALK => 'mediawiki-talk',
			NS_TEMPLATE => 'template',
			NS_TEMPLATE_TALK => 'template-talk',
			NS_HELP => 'guide',
			NS_HELP_TALK => 'guide-talk',
			NS_CATEGORY => 'category',
			NS_CATEGORY_TALK => 'category-talk'
		];
		break;
	case 'srewiki':
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
	case 'traceprojectwikiwiki':
	case 'vgportdbwiki':
		$wgDplSettings['allowUnlimitedCategories'] = true;
		$wgDplSettings['allowUnlimitedResults'] = true;

		break;
	case 'whentheycrywiki':
		$wgGalleryOptions['imageWidth'] = 200;
		$wgGalleryOptions['imageHeight'] = 200;

		break;
	case 'wonderingstarswiki':
		$wgPivotFeatures = [
			'showActionsForAnon' => false,
			'fixedNavBar' => true,
			'usePivotTabs' => true,
			'showRecentChangesUnderTools' => false,
		];
		break;
	case 'worldboxwiki':
		$wgSpecialPages['Analytics'] = DisabledSpecialPage::getCallback( 'Analytics', 'MatomoAnalytics-disabled' );

		break;
	case 'genshinimpactwiki':
		$wgSpecialPages['Analytics'] = DisabledSpecialPage::getCallback( 'Analytics', 'MatomoAnalytics-disabled' );
		$wgMatomoAnalyticsDisableJS = true;
		$wgMatomoAnalyticsDisableCookie = true;

		$wgHooks['HtmlPageLinkRendererEnd'][] = 'onHtmlPageLinkRendererEnd';

		function onHtmlPageLinkRendererEnd(
			$linkRenderer,
			$target,
			$isKnown,
			&$text,
			&$attribs,
			&$ret
		) {
			if ( $isKnown || $target->isExternal() ) {
				return true;
			}

			$attribs['rel'] = 'nofollow';

			return true;
		}

		break;
}
