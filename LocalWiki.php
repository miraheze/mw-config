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
	case 'genshinimpactwiki':
		$wgHooks[ 'HtmlPageLinkRendererEnd' ][] = 'onHtmlPageLinkRendererEnd';
		$wgHooks[ 'PersonalUrls' ][] = 'onPersonalUrls';
		$wgHooks[ 'BeforePageDisplay' ][] = 'onBeforePageDisplay';

		function onHtmlPageLinkRendererEnd(
			$linkRenderer,
			$target,
			$isKnown,
			&$text,
			&$attribs,
			&$ret
		) {
			if ( $isKnown ) {
				return true;
			}

			if ( $target->isExternal() ) {
				return true;
			}

			$attribs['rel'] = 'nofollow';

			return true;
		}
		
		function onPersonalUrls( array &$personal_urls, Title $title, SkinTemplate $skin ) {
			$personal_urls[ 'preferences' ] = [
				'text' => 'Preferences',
				'href' => 'https://genshinimpact.miraheze.org/wiki/Genshin_Impact_Wiki:Preferences'
			];
		}

                function onBeforePageDisplay( OutputPage $out, Skin $skin ) { 
                    $style = "
                    /***
                     getting too annoying
                    sorry miraheze, i appreciate you but this just has to go
                    ***/
                    #siteNotice {
                    display: none;
                    }
                    
                    /***************
                    fix text, background color, contrast, sizing, etc. in our custom dark mode theme
                    ****************/
                    body,
                    html {
                    color: #fff;
                    }
                    
                    .cosmos-header .wds-dropdown__content,
                    .cosmos-header .wds-dropdown__content > * {
                    background: #000;
                    color: #fff;
                    }
                    
                    #p-cosmos-navigation a {
                    color: #fff;
                    }
                    
                    .cosmos-header .wds-dropdown__content:hover,
                    .wds-tabs__tab > a:hover {
                    color: #9393f6;
                    }
		    
                    .cosmos-footerLinks-list li a {
                    color: #9393f6;
                    }
                    
                    .wvui-typeahead-search__suggestions__footer__text {
                    color: #000;
                    }
                    
                    .editOptions,
                    .editCheckboxes,
                    .editOptions .oo-ui-fieldLayout-body .oo-ui-labelElement-label {
                    color: #fff !important;
                    }
                    
                    .pi-section-navigation .pi-section-tab,
                    .pi-media-collection .pi-tab-link {
                    background: #2e2f32;
                    border: 0;
                    }
                    
                    .navpopup {
                    background: #2e2f32;
                    box-shadow: none;
                    color: #fff;
                    }
                    
                    .popupData {
                    /* broken spacing and other things, seems useless, no need to keep it */
                    display: none;
                    }

                    #mw-content {
                    background: #000;
                    }
                    
                    /* popups, dialogs, modals */
                    
                    .cosmos-modal-content,
                    #create-page-dialog__title {
                    background: #1a1a1a;
                    }
                    
                    .wds-dialog__content,
                    .wds-dialog__title {
                    color: #fff;
                    }
                    
                    /**************
                     remove the placeholder image from the search bar at the top of the page and then increase the search suggestion text size, the placeholder image is weird and shows up on plenty of results that do have images
                    **************/
                    
                    .wvui-typeahead-suggestion__text {
                    padding: 1%;
                    }
                    
                    .wvui-typeahead-suggestion__thumbnail-placeholder {
                    display: none;
                    }
                    
                    /******/
                    
                    /* blank div with an empty ul */
                    
                    .create-page-dialog__proposals {
                    display: none;
                    }
                    
                    /******* useless toolbar entries *******/
                    #t-recentchangeslinked {
                    display: none;
                    }
                    
                    #ca-copy-link {
                    /* easy link is not helpful */
                    display: none;
                    }
                    
                    #t-word-count {
                    /* nobody needs a word count */
                    display: none;
                    }
                    
                    #t-info {
                    /* page information is useless trivia */
                    display: none;
                    }
                    
                    #t-print {
                    /* nobody is going to print anything on this site and from what i can tell the firefox print dialogue works fine */
                    display: none;
                    }
                    
                    /*** make the toolbar look nicer ***/
                    #cosmos-toolbar {
                    border-radius: 5px;
                    border: 1px solid #eee;
                    background: #1a1d23;
                    box-shadow: none;
                    }
                    ";

                    if( $out->getPageTitle() == 'Log in' || $out->getPageTitle() == 'Create account' ) {
                        $out->addInlineStyle( $style );
                    }
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
		];

		$wgTranslateTranslationServices['Google'] = [
			'url' => 'https://translation.googleapis.com/language/translate/v2',
			'key' => $wmgTranslateGoogleTranslateMetaKey,
			'timeout' => 3,
			'type' => 'google',
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
	case '402611wiki':
	case 'ballmediawiki':
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
	case 'traceprojectwikiwiki':
	case 'vgportdbwiki':
		$wgDplSettings['allowUnlimitedCategories'] = true;
		$wgDplSettings['allowUnlimitedResults'] = true;

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
}
