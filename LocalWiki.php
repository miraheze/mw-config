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
	case 'acuralegendwiki':
		/* The following code block is a [modification] of [Extension:IndentSections]
		 * and is licensed under the [MIT License].
		 *
		 * [modification]: https://issue-tracker.miraheze.org/T12969
		 * [Extension:IndentSections]: https://www.mediawiki.org/wiki/Extension:IndentSections
		 * [MIT License]: https://opensource.org/licenses/mit-license.php
		 */
		$wgHooks['BeforePageDisplay'][] = 'fnIndentSectionsBeforePageDisplay';

		function fnIndentSectionsBeforePageDisplay( $out, $skin ) {
			$text = $out->getHTML();

			for ( $i = 6; $i >= 1; $i -= 1 ) {
				$pattern = sprintf( '/(<h%d>\s*?<span class="(?:editsection|mw-headline)".+?<\/h%d>)(.*?)(?=(<h[1-%d]>|\Z))/ms', $i, $i, $i );
				// $pattern = sprintf( '/(<a[^>]+><\/a><h%d>\s*?<span class="(?:editsection|mw-headline)">.*?<\/h%d>)(.*?)(?=(<a[^>]+><\/a><h[1-%d]>|\Z))/ms', $i, $i, $i );
				$text2 = preg_replace( $pattern, '$1<blockquote style="margin:0px 0px 0px 1.5em">$2</blockquote>', $text );
				if ( $text2 !== null ) {
					$text = $text2;
				}
			}

			$out->clearHTML();
			$out->addHTML( $text );
			return true;
		}

		break;
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
			'url' => 'https://static.wikitide.net/gpcommonswiki',
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
	case 'gui7814sgtafanonwiki':
		$wgDplSettings['maxCategoryCount'] = 1000;
		$wgDplSettings['maxResultCount'] = 1000;

		break;
	case 'hommwiki':
		// T12565: This is a workaround for an upstream bug, please remove when the bug fix is merged
		$wgEnabledAudioTranscodeSet = [];

		// T12565: This is a code crime to make the workaround for said upstream bug work, I apologize for my sins.
		// Yes, [[mw:Manual:Extension.json/Schema#ExtensionFunctions]] states that "extension functions cannot
		// be used to programmatically update configuration variables or register hooks", but this brings results and
		// the alternative is reflection, so it could be worse.
		$wgExtensionFunctions[] = static function () {
			global $wgEnabledAudioTranscodeSet;
			$wgEnabledAudioTranscodeSet = [];
		};

		break;
	case 'houkai2ndwiki':
		$wgSpecialPages['Analytics'] = DisabledSpecialPage::getCallback( 'Analytics', 'MatomoAnalytics-disabled' );
		$wgPageImagesScores['position'] = [ 100, -100, -100, -100 ];
		break;
	case 'kagagawiki':
		$uwCcAvailableLanguages = [
			'an', 'ar', 'az', 'be', 'bg', 'bn', 'ca', 'cs', 'da', 'de', 'el',
			'en', 'eo', 'es', 'et', 'eu', 'fa', 'fi', 'fr', 'fy', 'ga',
			'gl', 'hi', 'hr', 'hu', 'id', 'is', 'it', 'ja', 'ko', 'lt',
			'lv', 'ms', 'nl', 'no', 'pl', 'pt', 'pt-br', 'ro', 'ru', 'sk',
			'sl', 'sr-latn', 'sv', 'tr', 'uk', 'zh-hans', 'zh-hant'
		];
		$wgUploadWizardConfig = [
			'campaignExpensiveStatsEnabled' => false,
			'flickrApiKey' => $wmgUploadWizardFlickrApiKey,
			'debug' => false,
			'altUploadForm' => 'Special:Upload',
			'feedbackLink' => false,
			'alternativeUploadToolsPage' => false,
			'enableFormData' => true,
			'enableMultipleFiles' => true,
			'enableMultiFileSelect' => true,
			'uwLanguages' => [
				'ja' => '日本語',
				'en' => 'English',
			],
			'licenses' => [
				'cc-by-sa-4.0' => [
					'msg' => 'mwe-upwiz-license-cc-by-sa-4.0-text',
					'msgExplain' => 'mwe-upwiz-source-ownwork-cc-by-sa-4.0-explain',
					'icons' => [ 'cc-by', 'cc-sa' ],
					'url' => '//creativecommons.org/licenses/by-sa/4.0/',
					'languageCodePrefix' => 'deed.',
					'availableLanguages' => $uwCcAvailableLanguages
				],
				'cc-zero' => [
					'msg' => 'mwe-upwiz-license-cc-zero-text',
					'msgExplain' => 'mwe-upwiz-source-ownwork-cc-zero-explain',
					'icons' => [ 'cc-zero' ],
					'url' => '//creativecommons.org/publicdomain/zero/1.0/',
					'languageCodePrefix' => 'deed.',
					'availableLanguages' => $uwCcAvailableLanguages
				],
				'rs-inc' => [
					'msg' => 'mwe-upwiz-license-rs-inc-text',
					'msgExplain' => 'mwe-upwiz-license-rs-inc-explain',
					'templates' => [ 'rs-inc' ],
					'url' => '//rightsstatements.org/page/InC/1.0/',
				],
				'rs-und' => [
					'msg' => 'mwe-upwiz-license-rs-und-text',
					'msgExplain' => 'mwe-upwiz-license-rs-und-explain',
					'templates' => [ 'rs-und' ],
					'url' => '//rightsstatements.org/page/UND/1.0/',
				],
			],
			'licensing' => [
				'ownWork' => [
					'type' => 'or',
					'template' => 'self',
					'defaults' => 'cc-by-sa-4.0',
					'licenses' => [
						'cc-by-sa-4.0',
						'cc-zero',
						'rs-inc',
						'rs-und',
					],
				],
				'thirdParty' => [
					'type' => 'or',
					'defaults' => 'cc-by-sa-4.0',
					'licenseGroups' => [
						[
							'head' => 'mwe-upwiz-license-cc-head',
							'subhead' => 'mwe-upwiz-license-cc-subhead',
							'licenses' => [
								'cc-by-sa-4.0',
								'cc-zero',
								'rs-inc',
								'rs-und',
							],
						],
					],
				],
			],
			'templateOptions' => [],
		];
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
		// UploadWizard configurations
		$wgUploadWizardConfig = [
			'tutorial' => [
				'skip' => false,
				'template' => 'WLHMN_UW.svg',
				'width' => 900,
			],
			'altUploadForm' => 'Special:Upload',
			'enableFormData' => true,
			'trackingCategory' => [
				'all' => 'Tập tin được tải lên bằng trải nghiệm Trình thuật sĩ',
				'campaign' => 'Tập tin được tải lên thuộc chủ đề $1'
			],
			'uwLanguages' => [
				'vi' => 'Tiếng Việt',
				'en' => 'English'
			],
			'licenses' => [
				'cc-by-sa-4.0' => [
					'msg' => 'mwe-upwiz-license-cc-by-sa-4.0-text',
					'msgExplain' => 'mwe-upwiz-source-ownwork-cc-by-sa-4.0-explain',
					'icons' => [ 'cc-by', 'cc-sa' ],
					'url' => '//creativecommons.org/licenses/by-sa/4.0/',
					'languageCodePrefix' => 'deed.',
					'availableLanguages' => 'en'
				],
				'cc-zero' => [
					'msg' => 'mwe-upwiz-license-cc-zero-text',
					'msgExplain' => 'mwe-upwiz-source-ownwork-cc-zero-explain',
					'icons' => [ 'cc-zero' ],
					'url' => '//creativecommons.org/publicdomain/zero/1.0/',
					'languageCodePrefix' => 'deed.',
					'availableLanguages' => 'en'
				],
				'snxyz' => [
					'msg' => 'mwe-upwiz-license-snxyz',
					'msgExplain' => 'mwe-upwiz-license-snxyz-explain',
					'url' => '//songngu.xyz/',
					'template' => 'SNXYZ',
					'languageCodePrefix' => 'licenses.',
					'availableLanguages' => 'vi'
				],
				'lhmn' => [
					'msg' => 'mwe-upwiz-license-lhmn',
					'msgExplain' => 'mwe-upwiz-license-lhmn-explain',
					'url' => '//go.lophocmatngu.wiki/',
					'template' => 'LHMN',
					'languageCodePrefix' => 'licenses.',
					'availableLanguages' => 'vi'
				]
			],
			'licensing' => [
				'defaultType' => 'thirdParty',
				'ownWorkDefault' => 'choice',
				'ownWork' => [
					'type' => 'or',
					'template' => 'self',
					'licenses' => [
						'snxyz',
						'cc-zero',
						'cc-by-4.0',
						'cc-by-sa-4.0',
					]
				],
				'thirdParty' => [
					'type' => 'or',
					'licenseGroups' => [
						[
							'head' => 'mwe-upwiz-license-lhmn-head',
							'defaults' => [ 'lhmn' ],
							'licenses' => [ 'lhmn' ]
						],
						[
							'head' => 'mwe-upwiz-license-cc-head',
							'subhead' => 'mwe-upwiz-license-cc-subhead',
							'licenses' => [
								'cc-zero',
								'cc-by-4.0',
								'cc-by-sa-4.0',
							]
						],
						[
							'head' => 'mwe-upwiz-license-other-head',
							'special' => 'custom',
							'defaults' => [ 'custom' ],
							'licenses' => [ 'custom' ],
						],
					]
				]
			]
		];

		// SocialProfile/UserStats configurations
		if ( $wi->isExtensionActive( 'SocialProfile' ) ) {
			require_once "$IP/extensions/SocialProfile/UserStats/EditCount.php";

			// User level definitions
			$wgUserLevels = [
				'Lớp lá' => 0,
				'Mầm non' => 1200,
				'Lớp 1' => 5000,
				'Lớp 2' => 10000,
				'Lớp 3' => 20000,
				'Lớp 4' => 35000,
				'Lớp 5' => 50000,
				'Lớp 6' => 75000,
				'Lớp 7' => 100000,
				'Lớp 8' => 150000,
				'Lớp 9' => 250000,
				'Lớp 10' => 350000,
				'Lớp 11' => 500000,
				'Lớp 12' => 650000,
				'Đại học' => 800000,
				'Cao học' => 1000000
			];
		}
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
				'SenderName' => 'Beta account creation request (via Meta)',
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
			'IncidentReporting',
			'RequestSSL',
		] );

		/*
		$wgFeaturedFeeds['test'] = [
			'page' => 'feedtest',
			'title' => 'feedtest-title',
			'short-title' => 'feedtest-short-title',
			'description' => 'feedtest-description',
			'entryName' => 'feedtest-entryname',
		];
		*/

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
			'svg' => "https://static.wikitide.net/picrosswiki/0/0a/Pikuw.svg",
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
		$wgCargoAllowedSQLFunctions[] = 'NATURAL_SORT_KEY';

		$wgJsonConfigs['Tabular.JsonConfig']['remote'] = [
			'url' => 'https://commons.wikimedia.org/w/api.php'
		];
		$wgJsonConfigs['Map.JsonConfig']['remote'] = [
			'url' => 'https://commons.wikimedia.org/w/api.php'
		];

		$wgHooks['SkinAddFooterLinks'][] = 'onSkinAddFooterLinks';

		function onSkinAddFooterLinks( Skin $skin, string $key, array &$footerlinks ) {
			if ( $key === 'info' && $skin->getSkinName() !== 'citizen' ) {
				$footerlinks['tagline'] = $skin->msg( 'citizen-footer-tagline' )->parse();
			}
		}

		break;
	case 'roguetown2ewiki':
		$wgMinervaNightMode['base'] = true;
		$wgVectorNightMode['logged_in'] = true;
		$wgVectorNightMode['logged_out'] = true;

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
	case 'testwikibeta':
		$wgUserLevels = [
			'Recruit' => 0,
			'Apprentice' => 1200,
			'Private' => 1750,
			'Corporal' => 2500,
			'Sergeant' => 5000,
			'Gunnery Sergeant' => 10000,
			'Lieutenant' => 20000,
			'Captain' => 35000,
			'Major' => 50000,
			'Lieutenant Commander' => 75000,
			'Commander' => 100000,
			'Colonel' => 150000,
			'Brigadier' => 250000,
			'Brigadier General' => 350000,
			'Major General' => 500000,
			'Lieutenant General' => 650000,
			'General' => 800000,
			'General of the Army' => 1000000,
		];
		break;
	case 'tuscriaturaswiki':
		$wgHooks['AfterFinalPageOutput'][] = 'onAfterFinalPageOutput';

		function onAfterFinalPageOutput( $output ) {
			$title = $output->getTitle();
			if ( $title === null || $title->getNamespace() < 3000 ) {
				return true;
			}

			$subjectNamespace = $title->getNamespace();
			if ( $subjectNamespace % 2 === 1 ) {
				$subjectNamespace--;
			}

			$logoTitle = Title::makeTitle( $subjectNamespace, 'Portada' );
			$logoLink = $logoTitle->getLinkUrl();

			// The output format is effectively "\$1{$logoLink}\$2"
			$regexes = [
				'Apex' => '/(<div id="p-logo"><a style="[^"]+" href=")[^"]+(")/',
				'erudite' => '/(<a href=")[^"]+(" title="[^"]+" rel="home">)/',
				'minerva' => '/(<div class="branding-box">\s*<a href=")[^"]+(")/',
				'timeless' => '/(<a class="mw-wiki-logo [\w\-]+" href=")[^"]+(")/',
				'tweeki' => '/(<a href=")[^"]+(" class="navbar-brand">)/',
				'vector' => '/(<a class="mw-wiki-logo" href=")[^"]+(")/',
				'vector-2022' => '/(<a href=")[^"]+(" class="mw-logo")/',
			];
			$regex = $regexes[$output->getSkin()->getSkinName()] ?? null;
			if ( $regex === null ) {
				return true;
			}

			$html = ob_get_clean();
			$html = preg_replace_callback( $regex, static function ( $matches ) use ( $logoLink ) {
				$note = '<!-- Link modified by Miraheze in LocalWiki.php -->';
				return $note . $matches[1] . htmlspecialchars( $logoLink, ENT_QUOTES ) . $matches[2];
			}, $html, 1 ) ?? $html;

			ob_start();
			echo $html;
			return true;
		}

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
