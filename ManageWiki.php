<?php

/**
 * ManageWiki extension are added using the variable below.
 *
 * name: the displayed name of the setting on Special:ManageWikiExtensions.
 * linkPage: full url for an information page for the extension.
 * var: the relevant var that enables the extension.
 * conflicts: string of extensions that cause this extension to not work.
 * requires: a text entry of which extension is required for this setting to work.
 * restricted: boolean - requires managewiki-restricted to change.
 *
 * Extensions can provide installation steps as well for extensions.
 */
$wgManageWikiExtensions = [
		'3d' => [
			'name' => '3D',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:3D',
			'var' => 'wmgUse3D',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'addthis' => [
			'name' => 'AddThis',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:AddThis',
			'var' => 'wmgUseAddThis',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'htmlmetaadntitle' => [
			'name' => 'HTML Meta and Title',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Add_HTML_Meta_and_Title',
			'var' => 'wmgUseAddHTMLMetaAndTitle',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'adminlinks' => [
			'name' => 'AdminLinks',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Admin_Links',
			'var' => 'wmgUseAdminLinks',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'adminlinks',
						],
					],
				],
			],
		],
		'ajaxpoll' => [
			'name' => 'AJAX Poll',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:AJAXPoll',
			'var' => 'wmgUseAJAXPoll',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'ajaxpoll_info' => "$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_info.sql",
					'ajaxpoll_vote' => "$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_vote.sql"
				],
			],
		],
		'apex' => [
			'name' => 'Apex (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Apex',
			'var' => 'wmgUseApex',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'approvedrevs' => [
			'name' => 'Approved Revs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Approved_Revs',
			'var' => 'wmgUseApprovedRevs',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'approved_revs' => "$IP/extensions/ApprovedRevs/sql/ApprovedRevs.sql"
				],
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'viewapprover',
							'approverevisions',
						],
					],
					'*' => [
						'permissions' => [
							'viewlinktolatest',
						],
					],
				],
			],
		],
		'articlefeedbackv5' => [
			'name' => 'Article Feedback Tool V5',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ArticleFeedbackv5',
			'var' => 'wmgUseArticleFeedbackv5',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'*' => [
						'permissions' => [
							'aft-reader',
						],
					],
					'autoconfirmed' => [
						'permissions' => [
							'aft-reader',
							'aft-member',
							'aft-editor',
						],
					],
					'confirmed' => [
						'permissions' => [
							'aft-reader',
							'aft-member',
							'aft-editor',
						],
					],
					'reviewer' => [
						'permissions' => [
							'aft-reader',
							'aft-member',
							'aft-editor',
							'aft-monitor',
						],
					],
					'rollbacker' => [
						'permissions' => [
							'aft-reader',
							'aft-member',
							'aft-editor',
							'aft-monitor',
						],
					],
					'sysop' => [
						'permissions' => [
							'aft-reader',
							'aft-member',
							'aft-editor',
							'aft-monitor',
							'aft-administrator',
						],
					],
					'user' => [
						'permissions' => [
							'aft-reader',
							'aft-member',
						],
					],
				],
				'sql' => [
					'aft_feedback' => "$IP/extensions/ArticleFeedbackv5/sql/ArticleFeedbackv5.sql"
				],
			],
		],
		'articleratings' => [
			'name' => 'Article Ratings',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ArticleRatings',
			'var' => 'wmgUseArticleRatings',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [		
 					'reviewer' => [		
 						'permissions' => [		
 							'change-rating',		
 						],		
 					],		
 				],
				'sql' => [
					'ratings' => "$IP/extensions/ArticleRatings/ratings.sql"
				],
			],
		],
		'articletocategory2' => [
			'name' => 'Article To Category 2',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ArticleToCategory2',
			'var' => 'wmgUseArticleToCategory2',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'authorprotect' => [
			'name' => 'Author Protect',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:AuthorProtect',
			'var' => 'wmgUseAuthorProtect',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'author',
						],
					],
					'user' => [
						'permissions' => [
							'authorprotect',
						],
					],
				],
			],
		],
		'autocreatecategorypages' => [
			'name' => 'Auto Create Category Pages',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:AutoCreateCategoryPages',
			'var' => 'wmgUseAutoCreateCategoryPages',
			'conflicts' => false,
			'requires' => false,
			'restricted' => true,
		],
		'babel' => [
			'name' => 'Babel',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Babel',
			'var' => 'wmgUseBabel',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'blogpage' => [
			'name' => 'Blog Page',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:BlogPage',
			'var' => 'wmgUseBlogPage',
			'conflicts' => false,
			'requires' => 'socialprofile',
			'restricted' => false,
			'install' => [
				'permissions' => [
					'user' => [
						'permissions' => [
							'createblogpost',
						],
					],
				],
			],
		],
		'capiunto' => [
			'name' => 'Capiunto',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Capiunto',
			'var' => 'wmgUseCapiunto',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'cargo' => [
			'name' => 'Cargo',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Cargo',
			'var' => 'wmgUseCargo',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'cargo_tables' => "$IP/extensions/Cargo/sql/Cargo.sql"
				],
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'recreatecargodata',
							'deletecargodata',
						],
					],
				],
			],
		],
		'charinsert' => [
			'name' => 'CharInsert',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CharInsert',
			'var' => 'wmgUseCharInsert',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'cite' => [
			'name' => 'Cite',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Cite',
			'var' => 'wmgUseCite',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'citethispage' => [
			'name' => 'CiteThisPage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CiteThisPage',
			'var' => 'wmgUseCiteThisPage',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'citoid' => [
			'name' => 'Citoid',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Citoid',
			'var' => 'wmgUseCitoid',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'codeeditor' => [
			'name' => 'CodeEditor',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CodeEditor',
			'var' => 'wmgUseCodeEditor',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'codemirror' => [
			'name' => 'CodeMirror',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CodeMirror',
			'var' => 'wmgUseCodeMirror',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'collapsiblevector' => [
			'name' => 'Collapsible Vector',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CollapsibleVector',
			'var' => 'wmgUseCollapsibleVector',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'collection' => [
			'name' => 'Collection (PDF)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Collection',
			'var' => 'wmgUseCollection',
			'conflicts' => false,
			'requires' => 'electronpdfservice',
			'restricted' => true,
		],
		'comments' => [
			'name' => 'Comments',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Comments',
			'var' => 'wmgUseComments',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'Comments' => "$IP/extensions/Comments/sql/comments.sql",
					'Comments_block' => "$IP/extensions/Comments/sql/comments_block.sql",
					'Comments_Vote' => "$IP/extensions/Comments/sql/comments_vote.sql",
				],
				'permissions' => [
					'*' => [
						'permissions' => [
							'comment',
						],
					],
					'autoconfirmed' => [
						'permissions' => [
							'commentlinks',
						],
					],
					'comentadmin' => [
						'permissions' => [
							'commentadmin',
						],
					],
					'sysop' => [
						'permissions' => [
							'commentadmin',
						],
					],
				],
			],
		],
		'contributionscores' => [
			'name' => 'ContributionScores',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ContributionScores',
			'var' => 'wmgUseContributionScores',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'createpage' => [
			'name' => 'CreatePage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CreatePage',
			'var' => 'wmgUseCreatePage',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'createredirect' => [
			'name' => 'CreateRedirect',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CreateRedirect',
			'var' => 'wmgUseCreateRedirect',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'crossreference' => [
			'name' => 'CrossReference',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CrossReference',
			'var' => 'wmgUseCrossReference',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'css' => [
			'name' => 'CSS',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CSS',
			'var' => 'wmgUseCSS',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'darkvector' => [
			'name' => 'DarkVector (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:DarkVector',
			'var' => 'wmgUseDarkVector',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'description2' => [
			'name' => 'Description2',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Description2',
			'var' => 'wmgUseDescription2',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'disambiguator' => [
			'name' => 'Disambiguator',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Disambiguator',
			'var' => 'wmgUseDisambiguator',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'dplforum' => [
			'name' => 'DPLForum',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DPLforum',
			'var' => 'wmgUseDPLForum',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'dummyfandoommainpagetags' => [
			'name' => 'DummyFandoomMainpageTags',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DummyFandoomMainpageTags',
			'var' => 'wmgUseDummyFandoomMainpageTags',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'duplicator' => [
			'name' => 'Duplicator',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Duplicator',
			'var' => 'wmgUseDuplicator',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'user' => [
						'permissions' => [
							'duplicate',
						],
					],
				],
			],
		],
		'dusktodawn' => [
			'name' => 'DuskToDawn (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:DuskToDawn',
			'var' => 'wmgUseDuskToDawn',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'dynamicpagelist' => [
			'name' => 'DynamicPageList',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DynamicPageList_(Wikimedia)',
			'var' => 'wmgUseDynamicPageList',
			'conflicts' => 'dynamicpagelist3',
			'requires' => false,
			'restricted' => false,
		],
		'dynamicpagelist3' => [
			'name' => 'DynamicPageList3',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DynamicPageList3',
			'var' => 'wmgUseDynamicPageList3',
			'conflicts' => 'dynamicpagelist',
			'requires' => false,
			'restricted' => false,
		],
		'editcount' => [
			'name' => 'EditCount',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Editcount',
			'var' => 'wmgUseEditcount',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'educationprogram' => [
			'name' => 'Education Program',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:EducationProgram',
			'var' => 'wmgUseEducationProgram',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'ep_students' => "$IP/extensions/EducationProgram/sql/EducationProgram.sql"
				],
			],
		],
		'electronpdfservice' => [
			'name' => 'Electron PDF Service',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ElectronPdfService',
			'var' => 'wmgUseElectronPDFService',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'erudite' => [
			'name' => 'Erudite (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Erudite',
			'var' => 'wmgUseErudite',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'eventlogging' => [
			'name' => 'EventLogging',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:EventLogging',
			'var' => 'wmgUseEventLogging',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'fancyboxthumbs' => [
			'name' => 'Fancy Box Thumbs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:FancyBoxThumbs',
			'var' => 'wmgUseFancyBoxThumbs',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'flaggedrevs' => [
			'name' => 'FlaggedRevs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:FlaggedRevs',
			'var' => 'wmgUseFlaggedRevs',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'flaggedpages' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedpage_pending' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedrevs' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedtemplates' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedimages' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedpage_config' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedrevs_tracking' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedrevs_promote' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
					'flaggedrevs_statistics' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/FlaggedRevs.sql",
				],
				'permissions' => [
					'editor' => [
						'permissions' => [
							'review',
							'autoreview',
							'autoconfirmed',
							'editsemiprotected',
							'unreviewedpages',
						],
					],
					'reviewer' => [
						'permissions' => [
							'validate',
							'review',
							'autoreview',
							'autoconfirmed',
							'editsemiprotected',
							'unreviewedpages',
						],
					],
					'sysop' => [
						'permissions' => [
							'autoreview',
							'stablesettings',
							'movestable',
						],
						'addgroups' => [
							'editor',
							'autoreview',
						],
						'removegroups' => [
							'editor',
							'autoreview',
						],
					],
					'autoreview' => [
						'permissions' => [
							'autoreview',
						],
					],
					'bot' => [
						'permissions' => [
							'autoreview',
						],
					],
				],
			],
		],
		'flow' => [
			'name' => 'Flow',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:StructuredDiscussions',
			'var' => 'wmgUseFlow',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'help' => 'Will start working 10-20 mins after enabling.',
			'install' => [
				'sql' => [
					'flow_revision' => "$IP/extensions/Flow/flow.sql"
				],
				'permissions' => [
					'*' => [
						'permissions' => [
							'flow-hide',
						],
					],
					'user' => [
						'permissions' => [
							'flow-lock',
						],
					],
					'sysop' => [
						'permissions' => [
							'flow-lock',
							'flow-delete',
							'flow-edit-post',
						],
					],
					'oversight' => [
						'permissions' => [
							'flow-suppress',
						],
					],
					'flow-bot' => [
						'permissions' => [
							'flow-create-board',
						],
					],
				],
			],
		],
		'foreground' => [
			'name' => 'Foreground (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Foreground',
			'var' => 'wmgUseForeground',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'gadgets' => [
			'name' => 'Gadgets',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Gadgets',
			'var' => 'wmgUseGadgets',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'gamepress' => [
			'name' => 'Gamespress (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Gamepress',
			'var' => 'wmgUseGamepress',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'genealogy' => [
			'name' => 'Genealogy',
			'linkPage' => 'https://www.mediawiki.org/wiki/Extension:Genealogy',
			'var' => 'wmgUseGenealogy',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'geocrumbs' => [
			'name' => 'GeoCrumbs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GeoCrumbs',
			'var' => 'wmgUseGeoCrumbs',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'geodata' => [
			'name' => 'GeoData',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GeoData',
			'var' => 'wmgUseGeoData',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'geo_tags' => "$IP/extensions/GeoData/sql/db-backed.sql"
				],
			],
		],
		'gettingstarted' => [
			'name' => 'GettingStarted',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GettingStarted',
			'var' => 'wmgUseGettingStarted',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'graph' => [
			'name' => 'Graph',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Graph',
			'var' => 'wmgUseGraph',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'groupssidebar' => [
			'name' => 'GroupsSidebar',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GroupsSidebar',
			'var' => 'wmgUseGroupsSidebar',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'guidedtour' => [
			'name' => 'GuidedTour',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GuidedTour',
			'var' => 'wmgUseGuidedTour',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'hawelcome' => [
			'name' => 'HAWelcome',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:HAWelcome',
			'var' => 'wmgUseHAWelcome',
			'conflicts' => 'flow',
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'bot' => [
						'permissions' => [
							'welcomeexempt',
						],
					],
					'sysop' => [
						'permissions' => [
							'welcomeexempt',
						],
					],
					'bureaucrat' => [
						'permissions' => [
							'welcomeexempt',
						],
					],
				],
			],
		],
		'headertabs' => [
			'name' => 'HeaderTabs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:HeaderTabs',
			'var' => 'wmgUseHeaderTabs',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'hidesection' => [
			'name' => 'HideSection',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:HideSection',
			'var' => 'wmgUseHideSection',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'highlightlinksincategory' => [
			'name' => 'HighlightLinksInCategory',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Highlight_Links_in_Category',
			'var' => 'wmgUseHighlightLinksInCategory',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'imagemap' => [
			'name' => 'ImageMap',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ImageMap',
			'var' => 'wmgUseImageMap',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'imagerating' => [
			'name' => 'ImageRating',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ImageRating',
			'var' => 'wmgUseImageRating',
			'conflicts' => false,
			'requires' => 'voteny',
			'restricted' => false,
			'install' => [
				'permissions' => [
					'user' => [
						'permissions' => [
							'rateimage',
						],
					],
				],
			],
		],
		'inputbox' => [
			'name' => 'InputBox',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:InputBox',
			'var' => 'wmgUseInputBox',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'javascriptslideshow' => [
			'name' => 'Javascript Slidehow',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:JavascriptSlideshow',
			'var' => 'wmgUseJavascriptSlideshow',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'josa' => [
			'name' => 'Josa',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Josa',
			'var' => 'wmgUseJosa',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'jsbreadcrumbs' => [
			'name' => 'JS BreadCrumbs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:JSBreadCrumbs',
			'var' => 'wmgUseJSBreadCrumbs',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'kartographer' => [
			'name' => 'Kartographer',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Kartographer',
			'var' => 'wmgUseKartographer',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'labeledsectiontransclusion' => [
			'name' => 'LabeledSectionTransclusion',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:LabeledSectionTransclusion',
			'var' => 'wmgUseLabeledSectionTransclusion',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'liberty' => [
			'name' => 'Liberty (Skin)',
			'linkPage' => 'https://github.com/librewiki/liberty-skin',
			'var' => 'wmgUseLiberty',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'linktarget' => [
			'name' => 'LinkTarget',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:LinkTarget',
			'var' => 'wmgUseLinkTarget',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'linktitles' => [
			'name' => 'LinkTitles',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:LinkTitles',
			'var' => 'wmgUseLinkTitles',
			'conflicts' => false,
			'requires' => false,
			'restricted' => true,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'linktitles-batch',
						],
					],
				],
			],
		],
		'listings' => [
			'name' => 'Listings',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Listings',
			'var' => 'wmgUseListings',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'loopscombo' => [
			'name' => 'Loops',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Loops',
			'var' => 'wmgUseLoopsCombo',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'magicnocache' => [
			'name' => 'MagicNoCache',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MagicNoCache',
			'var' => 'wmgUseMagicNoCache',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'maps' => [
			'name' => 'Maps',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Maps',
			'var' => 'wmgUseMaps',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'masseditregex' => [
			'name' => 'MassEditRegex',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MassEditRegex',
			'var' => 'wmgUseMassEditRegex',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'masseditregex',
						],
					],
				],
			],
		],
		'massmessage' => [
			'name' => 'MassMessage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MassMessage',
			'var' => 'wmgUseMassMessage',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'massmessage',
						],
					],
				],
			],
		],
		'math' => [
			'name' => 'Math',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Math',
			'var' => 'wmgUseMath',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'mathlatexml' => "$IP/extensions/Math/db/mathlatexml.mysql.sql",
					'mathoid' => "$IP/extensions/Math/db/mathoid.mysql.sql"
				],
			],
		],
		'mediawikichat' => [
			'name' => 'MediaWikiChat',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MediaWikiChat',
			'var' => 'wmgUseMediaWikiChat',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'chat' => "$IP/extensions/MediaWikiChat/sql/chat.sql",
					'chat_users' => "$IP/extensions/MediaWikiChat/sql/chat_users.sql"
				],
				'permissions' => [
					'chatmod' => [
						'permissions' => [
							'chat',
							'modchat',
						],
						'addgroups' => [
							'blockedfromchat',
						],
						'removegroups' => [
							'blockedfromchat',
						],
					],
					'user' => [
						'permissions' => [
							'chat',
						],
					],
					'sysop' => [
						'permissions' => [
							'chat',
							'modchat',
						],
						'addgroups' => [
							'chatmod',
							'blockedfromchat',
						],
						'removegroups' => [
							'chatmod',
							'blockedfromchat',
						],
					],
				],
			],
		],
		'metrolook' => [
			'name' => 'Metrolook (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Metrolook',
			'var' => 'wmgUseMetrolook',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'modernskylight' => [
			'name' => 'ModernSkylight (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Modern_Skylight',
			'var' => 'wmgUseModernSkylight',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'mscalendar' => [
			'name' => 'MsCalendar',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MsCalendar',
			'var' => 'wmgUseMSCalendar',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'mscal_content' => "$IP/MsCalendar/MsCalendar.sql"
				],
			],
		],
		'msupload' => [
			'name' => 'MsUpload',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MsUpload',
			'var' => 'wmgUseMsUpload',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'multimediaviewer' => [
			'name' => 'Multimedia Viewer',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MultimediaViewer',
			'var' => 'wmgUseMultimediaViewer',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'multiboilerplate' => [
			'name' => 'MultiBoilerplate',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MultiBoilerplate',
			'var' => 'wmgUseMultiBoilerplate',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'newestpages' => [
			'name' => 'NewestPages',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NewestPages',
			'var' => 'wmgUseNewestPages',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'news' => [
			'name' => 'News',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:News',
			'var' => 'wmgUseNews',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'newsignuppage' => [
			'name' => 'New Signup Page',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NewSignupPage',
			'var' => 'wmgUseNewSignupPage',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'newsletter' => [
			'name' => 'Newsletter',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Newsletter',
			'var' => 'wmgUseNewsletter',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'nl_issues' => "$IP/extensions/Newsletter/sql/nl_issues.sql",
					'nl_newsletters' => "$IP/extensions/Newsletter/sql/nl_newsletters.sql",
					'nl_publishers' => "$IP/extensions/Newsletter/sql/nl_publishers.sql",
					'nl_subscriptions' => "$IP/extensions/Newsletter/sql/nl_subscriptions.sql"
				],
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'newsletter-create',
							'newsletter-delete',
							'newsletter-manage',
							'newsletter-restore',
						],
					],
				],
			],
		],
		'newusermessage' => [
			'name' => 'New User Message',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NewUserMessage',
			'var' => 'wmgUseNewUserMessage',
			'conflicts' => 'flow',
			'requires' => false,
			'restricted' => false,
		],
		'newusernotif' => [
			'name' => 'New User Nofifications',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NewUserNotif',
			'var' => 'wmgUseNewUserNotif',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'notitle' => [
			'name' => 'NoTitle',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NoTitle',
			'var' => 'wmgUseNoTitle',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'nukedpl' => [
			'name' => 'NukeDPL',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NukeDPL',
			'var' => 'wmgUseNukeDPL',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'nukedpl',
						],
					],
				],
			],
		],
		'nostalgia' => [
			'name' => 'Nostalgia (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Nostalgia',
			'var' => 'wmgUseNostalgia',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'opengraphmeta' => [
			'name' => 'OpenGraphMeta',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:OpenGraphMeta',
			'var' => 'wmgUseOpenGraphMeta',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'pagedtiffhandler' => [
			'name' => 'PagedTiffHandler',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PagedTiffHandler',
			'var' => 'wmgUsePagedTiffHandler',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'pageforms' => [
			'name' => 'Page Forms',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PageForms',
			'var' => 'wmgUsePageForms',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'*' => [
						'permissions' => [
							'viewedittab',
						],
					],
					'sysop' => [
						'permissions' => [
							'editrestrictedfields',
						],
					],
					'user' => [
						'permissions' => [
							'createclass',
							'multipageedit',
						],
					],
				],
			],
		],
		'pagenotice' => [
			'name' => 'Page Notice',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PageNotice',
			'var' => 'wmgUsePageNotice',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'pagetriage' => [
			'name' => 'Page Triage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PageTriage',
			'var' => 'wmgUsePageTriage',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'pagetriage_tags' => "$IP/extensions/PageTriage/sql/PageTriageTags.sql",
					'pagetriage_page_tags' => "$IP/extensions/PageTriage/sql/PageTriagePageTags.sql",
					'pagetriage_page' => "$IP/extensions/PageTriage/sql/PageTriagePage.sql",
					'pagetriage_log' => "$IP/extensions/PageTriage/sql/PageTriageLog.sql"
				],
			],
		],
		'pdfbook' => [
			'name' => 'PDFBook',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PdfBook',
			'var' => 'wmgUsePdfBook',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'pdfembed' => [
			'name' => 'PDF Embed',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PDFEmbed',
			'var' => 'wmgUsePDFEmbed',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'embed_pdf',
						],
					],
				],
			],
		],
		'pdfhandler' => [
			'name' => 'PDF Handler',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PDFHandler',
			'var' => 'wmgUsePDFHandler',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'pipeescape' => [
			'name' => 'Pipe Escape',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PipeEscape',
			'var' => 'wmgUsePipeEscape',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'pivot' => [
			'name' => 'Pivot (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Pivot',
			'var' => 'wmgUsePivot',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'poem' => [
			'name' => 'Poem',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Poem',
			'var' => 'wmgUsePoem',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'popups' => [
			'name' => 'Popups',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Popups',
			'var' => 'wmgUsePopups',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'poll' => [
			'name' => 'Poll',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Poll',
			'var' => 'wmgUsePoll',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'poll' => "$IP/extensions/Poll/archives/Poll.sql",
					'poll_answer' => "$IP/extensions/Poll/archives/Poll-answer.sql",
					'poll_start_log' => "$IP/extensions/Poll/archives/Poll-start-log.sql"
				],
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'poll-admin',
						],
					],
					'autoconfirmed' => [
						'permissions' => [
							'poll-create',
							'poll-vote',
						],
					],
					'*' => [
						'permissions' => [
							'poll-score',
						],
					],
				],
			],
		],
		'pollny' => [
			'name' => 'PollNY',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PollNY',
			'var' => 'wmgUsePollNY',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'poll_question' => "$IP/extensions/PollNY/sql/poll.sql"
				],
				'permissions' => [
					'*' => [
						'permissions' => [
							'pollny-vote',
						],
					],
					'sysop' => [
						'permissions' => [
							'polladmin',
						],
					],
				],
			],
		],
		'portableinfobox' => [
			'name' => 'PortableInfobox',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PortableInfobox',
			'var' => 'wmgUsePortableInfobox',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'proofreadpages' => [
			'name' => 'Proofread Pages',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ProofreadPage',
			'var' => 'wmgUseProofreadPage',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'pr_index' => "$IP/extensions/ProofreadPage/sql/ProofreadIndex.sql"
				],
				'permissions' => [
					'user' => [
						'permissions' => [
							'pagequality',
						],
					],
					'sysop' => [
						'permissions' => [
							'pagequality-admin',
						],
					],
				],
			],
		],
		'protectsite' => [
			'name' => 'Protect Site',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ProtectSite',
			'var' => 'wmgUseProtectSite',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'bureaucrat' => [
						'permissions' => [
							'protectsite',
						],
					],
				],
			],
		],
		'purge' => [
			'name' => 'Purge',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Purge',
			'var' => 'wmgUsePurge',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'quiz' => [
			'name' => 'Quiz',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Quiz',
			'var' => 'wmgUseQuiz',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'quizgame' => [
			'name' => 'Quiz Game (SocialProfile)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:QuizGame',
			'var' => 'wmgUseQuizGame',
			'conflicts' => false,
			'requires' => 'socialprofile',
			'restricted' => false,
			'install' => [
				'sql' => [
					'quizgame_answers' => "$IP/extensions/QuizGame/sql/quizgame_answers.sql",
					'quizgame_choice' => "$IP/extensions/QuizGame/sql/quizgame_choice.sql",
					'quizgame_questions' => "$IP/extensions/QuizGame/sql/quizgame_questions.sql",
					'quizgame_user_view' => "$IP/extensions/QuizGame/sql/quizgame_user_view.sql"
				],
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'quizadmin',
						],
					],
				],
			],
		],
		'randomgameunit' => [
			'name' => 'RandomGameUnit (SocialProfile)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RandomGameUnit',
			'var' => 'wmgUseRandomGameUnit',
			'conflicts' => false,
			'requires' => 'socialprofile',
			'restricted' => false,
		],
		'randomimage' => [
			'name' => 'RandomImage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RandomImage',
			'var' => 'wmgUseRandomImage',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'randomselection' => [
			'name' => 'RandomSelection',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RandomSelection',
			'var' => 'wmgUseRandomSelection',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'refreshed' => [
			'name' => 'Refreshed (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Refreshed',
			'var' => 'wmgUseRefreshed',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'relatedarticles' => [
			'name' => 'Related Articles',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RelatedArticles',
			'var' => 'wmgUseRelatedArticles',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'replacetext' => [
			'name' => 'Replace Text',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ReplaceText',
			'var' => 'wmgUseReplaceText',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'replacetext',
						],
					],
				],
			],
		],
		'revisionslider' => [
			'name' => 'RevisionSlider',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RevisionSlider',
			'var' => 'wmgUseRevisionSlider',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'rss' => [
			'name' => 'RSS',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RSS',
			'var' => 'wmgUseRSS',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'sandboxlink' => [
			'name' => 'Sandbox Link',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SandboxLink',
			'var' => 'wmgUseSandboxLink',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'score' => [
			'name' => 'Score',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Score',
			'var' => 'wmgUseScore',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'scratchblocks' => [
			'name' => 'ScratchBlocks',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ScratchBlocks',
			'var' => 'wmgUseScratchBlocks',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'simplechanges' => [
			'name' => 'Simple Changes',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SimpleChanges',
			'var' => 'wmgUseSimpleChanges',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'simpletooltip' => [
			'name' => 'Simple Tooltip',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SimpleTooltip',
			'var' => 'wmgUseSimpleTooltip',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'sitescout' => [
			'name' => 'SiteScout',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SiteScout',
			'var' => 'wmgUseSiteScout',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'socialprofile' => [
			'name' => 'SocialProfile',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SocialProfile',
			'var' => 'wmgUseSocialProfile',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'user_profile' => "$IP/extensions/SocialProfile/UserProfile/sql/user_profile.sql",
					'user_fields_privacy' => "$IP/extensions/SocialProfile/UserProfile/sql/user_fields_privacy.sql",
					'user_system_messages' => "$IP/extensions/SocialProfile/UserStats/sql/user_system_messages.sql",
					'user_points_monthly' => "$IP/extensions/SocialProfile/UserStats/sql/user_points_monthly.sql",
					'user_points_archive' => "$IP/extensions/SocialProfile/UserStats/sql/user_points_archive.sql",
					'user_points_weekly' => "$IP/extensions/SocialProfile/UserStats/sql/user_points_weekly.sql",
					'user_stats' => "$IP/extensions/SocialProfile/UserStats/sql/user_stats.sql",
					'user_system_gift' => "$IP/extensions/SocialProfile/SystemGifts/sql/user_system_gift.sql",
					'system_gift' => "$IP/extensions/SocialProfile/SystemGifts/sql/system_gift.sql",
					'user_relationship' => "$IP/extensions/SocialProfile/UserRelationship/sql/user_relationship.sql",
					'user_relationship_request' => "$IP/extensions/SocialProfile/UserRelationship/sql/user_relationship_request.sql",
					'user_gift' => "$IP/extensions/SocialProfile/UserGifts/sql/user_gift.sql",
					'gift' => "$IP/extensions/SocialProfile/UserGifts/sql/gift.sql",
					'user_board' => "$IP/extensions/SocialProfile/UserBoard/sql/user_board.sql"
				],
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'awardsmanage',
							'giftadmin',
							'avatarremove',
							'editothersprofiles',
						],
					],
				],
			],
		],
		'spoilers' => [
			'name' => 'Spoilers',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Spoilers',
			'var' => 'wmgUseSpoilers',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'subpagefun' => [
			'name' => 'SubPageFun',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Subpage_Fun',
			'var' => 'wmgUseSubpageFun',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'subpagelist3' => [
			'name' => 'SubPageList3',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SubPageList3',
			'var' => 'wmgUseSubPageList3',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'tabscombination' => [
			'name' => 'TabsCombination (Tabber + Tabs)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Tabs',
			'var' => 'wmgUseTabsCombination',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'templatesandbox' => [
			'name' => 'Template Sandbox',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TemplateSandbox',
			'var' => 'wmgUseTemplateSandbox',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'templatestyles' => [
			'name' => 'Template Styles',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TemplateStyles',
			'var' => 'wmgUseTemplateStyles',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'templatewizard' => [
			'name' => 'Template Wizard',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TemplateWizard',
			'var' => 'wmgUseTemplateWizard',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'theme' => [
			'name' => 'Theme',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Theme',
			'var' => 'wmgUseTheme',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'thanks' => [
			'name' => 'Thanks',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Thanks',
			'var' => 'wmgUseThanks',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'timedmediahandler' => [
			'name' => 'TimedMediaHandler',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TimedMediaHandler',
			'var' => 'wmgUseTimedMediaHandler',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'transcode' => "$IP/extensions/TimedMediaHandler/TimedMediaHandler.sql"
				],
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'transcode-reset',
							'transcode-status',
						],
					],
					'autoconfirmed' => [
						'permissions' => [
							'transcode-reset',
						],
					],
				],
			],
		],
		'timeline' => [
			'name' => 'Timeline',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Timeline',
			'var' => 'wmgUseTimeline',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'titlekey' => [
			'name' => 'TitleKey',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TitleKey',
			'var' => 'wmgUseTitleKey',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'titlekey' => "$IP/extensions/TitleKey/titlekey.sql"
				],
			],
		],
		'toctree' => [
			'name' => 'TOC Tree',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TocTree',
			'var' => 'wmgUseTocTree',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'translate' => [
			'name' => 'Translate',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Translate',
			'var' => 'wmgUseTranslate',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'*' => [
						'permissions' => [
							'translate',
						],
					],
					'sysop' => [
						'permissions' => [
							'pagetranslation',
							'translate-import',
							'translate-manage',
						],
					],
					'user' => [
						'permissions' => [
							'translate-review',
						],
					],
				],
			],
		],
		'tweeki' => [
			'name' => 'Tweeki (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Tweeki',
			'var' => 'wmgUseTweeki',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'section' => 'skins',
		],
		'twocolconflict' => [
			'name' => 'TwoColConflict',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TwoColConflict',
			'var' => 'wmgUseTwoColConflict',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'universallanguageselector' => [
			'name' => 'UniversalLanguageSelector',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UniversalLanguageSelector',
			'var' => 'wmgUseUniversalLanguageSelector',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'uploadslink' => [
			'name' => 'UploadsLink',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UploadsLink',
			'var' => 'wmgUseUploadsLink',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'urlgetparameters' => [
			'name' => 'UrlGetParamters',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UrlGetParameters',
			'var' => 'wmgUseUrlGetParameters',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'userwelcome' => [
			'name' => 'UserWelcome',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UserWelcome',
			'var' => 'wmgUseUserWelcome',
			'conflicts' => false,
			'requires' => 'socialprofile',
			'restricted' => false,
		],
		'variables' => [
			'name' => 'Variable',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Variables',
			'var' => 'wmgUseVariables',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'voteny' => [
			'name' => 'VoteNY',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:VoteNY',
			'var' => 'wmgUseVoteNY',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'Vote' => "$IP/extensions/VoteNY/sql/vote.mysql"
				],
				'permissions' => [
					'user' => [
						'permissions' => [
							'voteny',
						],
					],
				],
			],
		],
		'visualeditor' => [
			'name' => 'VisualEditor',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:VisualEditor',
			'var' => 'wmgUseVisualEditor',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'help' => 'Will start working 10-20 mins after enabling.',
		],
		'widgets' => [
			'name' => 'Widgets',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Widgets',
			'var' => 'wmgUseWidgets',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'editwidgets',
						],
					],
				],
			],
		],
		'wikibaserepository' => [
			'name' => 'Wikibase (Repository)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Wikibase',
			'var' => 'wmgUseWikibaseRepository',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'wb_terms' => "$IP/extensions/Wikibase/repo/sql/Wikibase.sql",
					'wb_changes' => "$IP/extensions/Wikibase/repo/sql/changes.sql",
					'wb_changes_dispatch' => "$IP/extensions/Wikibase/repo/sql/changes_dispatch.sql",
					'wb_changes_subscription' => "$IP/extensions/Wikibase/repo/sql/changes_subscription.sql",
					'wb_property_info' => "$IP/extensions/Wikibase/repo/sql/wb_property_info.sql"
				],
			],
		],
		'wikidatapagebanner' => [
			'name' => 'WikidataPageBanner',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikidataPageBanner',
			'var' => 'wmgUseWikidataPageBanner',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'wikiforum' => [
			'name' => 'WikiForum',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikiForum',
			'var' => 'wmgUseWikiForum',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'wikiforum_forums' => "$IP/extensions/WikiForum/sql/wikiforum.sql"
				],
				'permissions' => [
					'bureaucrat' => [
						'addgroups' => [
							'forumadmin',
						],
						'removegroups' => [
							'forumadmin',
						],
					],
					'forumadmin' => [
						'permissions' => [
							'wikiforum-admin',
							'wikiforum-moderator',
						],
					],
					'sysop' => [
						'permissions' => [
							'wikiforum-admin',
							'wikiforum-moderator',
						],
					],
				],
			],
		],
		'wikilove' => [
			'name' => 'WikiLove',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikiLove',
			'var' => 'wmgUseWikiLove',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
			'install' => [
				'sql' => [
					'wikilove_log' => "$IP/extensions/WikiLove/patches/WikiLoveLog.sql"
				],
			],
		],
		'wikiseo' => [
			'name' => 'WikiSEO',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikiSEO',
			'var' => 'wmgUseWikiSeo',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'wikitextloggedinout' => [
			'name' => 'WikiText Logged In Out',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikiTextLoggedInOut',
			'var' => 'wmgUseWikiTextLoggedInOut',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
		'wikimediaincubator' => [
			'name' => 'WikimediaIncubator',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikimediaIncubator',
			'var' => 'wmgUseWikimediaIncubator',
			'conflicts' => false,
			'requires' => false, // Configuation Change in LocalSettings.php, request this extension on phabricator
			'restricted' => true,
		],
		'youtube' => [
			'name' => 'YouTube',
			'linkPage' => 'https://github.com/miraheze/YouTube',
			'var' => 'wmgUseYouTube',
			'conflicts' => false,
			'requires' => false,
			'restricted' => false,
		],
];

/**
 * ManageWiki settings are added using the variable below.
 *
 * Type can be either: check, list, list-multi, matrix, text, url or wikipage.
 *
 * check: adds a checkbox.
 * list: adds a list of options (requires: options which is an array in form of display => internal value).
 * list-multi: see above, just that multiple can be selected.
 * matrix: adds an array of "columns" and "rows". Columns are the top array and rows will be the values.
 * text: adds a single line text entry.
 * url: adds a single line text entry which requires a full URL.
 * wikipage: add a textbox which will return an autocomplete drop-down list of wikipages. Returns standardised MediaWiki pages.
 *
 * Other variables that are required are name and requires.
 *
 * name: the displayed name of the setting on Special:ManageWiki.
 * requires: a text entry of which extension is required for this setting to work.
 * overridedefault: a string/array override default when no existing value exist.
 * restricted: boolean - requires managewiki-restricted to change.
 * help: string providing help information for the setting.
 * section: string name of groupings for settings.
 */
$wgManageWikiSettings = [
	// General
	'wgAllowSlowParserFunctions' => [
		'name' => 'Allow slow parser functions',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => null,
		'help' => false,
	],
	'wgAppleTouchIcon' => [
			'name' => 'Apple Touch Icon',
			'requires' => false,
			'restricted' => false,
			'type' => 'text',
			'overridedefault' => null,
			'help' => 'Format example: //static.miraheze.org/metawiki//3/35/Miraheze_Logo.svg',
	],
	'wgDefaultSkin' => [
		'name' => 'Default Skin',
		'requires' => false,
		'restricted' => false,
		'type' => 'list',
		'options' => [
			'CologneBlue' => 'cologneblue',
			'Modern' => 'modern',
			'MonoBook' => 'monobook',
			'Timeless' => 'timeless',
			'Vector' => 'vector',
		],
		'overridedefault' => 'vector',
		'help' => false,
	],
	'wgFavicon' => [
		'name' => 'Favicon',
		'requires' => false,
		'restricted' => false,
		'type' => 'text',
		'overridedefault' => null,
		'help' => 'Format example: //static.miraheze.org/metawiki//3/35/Miraheze_Logo.svg',
	],
	'wgLocaltimezone' => [
		'name' => 'Timezone',
		'requires' => false,
		'restricted' => false,
		'type' => 'timezone',
		'overridedefault' => 'UTC',
		'help' => false,
	],
	'wgLogo' => [
		'name' => 'Logo',
		'requires' => false,
		'restricted' => false,
		'type' => 'text',
		'overridedefault' => null,
		'help' => 'The logo should be smaller than 135x135 in order for it to display properly. Format example: //static.miraheze.org/metawiki//3/35/Miraheze_Logo.svg',
	],
	'wgPFEnableStringFunctions' => [
		'name' => 'Enable string function functionality',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => null,
		'help' => false,
	],
	'wgServer' => [
		'name' => 'Custom Domain',
		'requires' => false,
		'restricted' => true,
		'type' => 'text',
		'overridedefault' => null,
		'help' => 'This sets your custom domain. Otherwise it defaults to subdomain.miraheze.org.',
	],
	'wgMobileUrlTemplate' => [
		'name' => 'Mobile Url',
		'requires' => false,
		'restricted' => true,
		'type' => 'text',
		'overridedefault' => '',
		'help' => 'This sets your mobile url. Defaults to <domain>.',
	],
	'wgVisualEditorEnableWikitext' => [
		'name' => 'Enable VisualEditor Wikitext mode',
		'requires' => 'visualeditor',
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => null,
		'help' => false,
	],
	'wmgWikiLicense' => [
		'name' => 'Content License',
		'requires' => false,
		'restricted' => false,
		'type' => 'list',
		'options' => [
			'All Rights Reserved' => 'arr',
			'Creative Commons BY 4.0' => 'cc-by',
			'Creative Commons BY-NC 4.0' => 'cc-by-nc',
			'Creative Commons BY-ND 4.0' => 'cc-by-nd',
			'Creative Commons BY-SA 4.0' => 'cc-by-sa',
			'Creative Commons BY-SA 2.0 Korea' => 'cc-by-sa-2-0-kr',
			'Creative Commons BY-SA-NC 4.0' => 'cc-by-sa-nc',
			'Creative Commons BY-NC-ND 4.0' => 'cc-by-nc-nd',
			'Public Domain' => 'cc-pd',
			'No license provided' => 'empty',
		],
		'overridedefault' => 'cc-by-sa',
		'help' => false,
	],

	// Media/File
	'wgEnableUploads' => [
		'name' => 'Enable File Uploads',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => true,
		'section' => 'media',
		'help' => 'Allow images and other files to be uploaded through the wiki.',
	],
	'wgAllowCopyUploads' => [
		'name' => 'Enable File Uploads Through URL',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => false,
		'section' => 'media',
		'help' => 'Allow uploads from URLs as well as local files.',
	],
	'wgCopyUploadsFromSpecialUpload' => [
		'name' => 'Enable File Uploads Through URL on Special:Upload',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => false,
		'section' => 'media',
		'help' => 'Add an interface to Special:Upload to enable uploading from URLs.',
	],
	'wgUseInstantCommons' => [
		'name' => 'Enable Wikimedia Commons Files',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => true,
		'section' => 'media',
		'help' => 'i.e. the use of Wikimedia Commons as a shared repository.',
	],
	'wgShowArchiveThumbnails' => [
		'name' => 'Show Old Thumbnails On Description Page',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => true,
		'section' => 'media',
		'help' => 'Whether to show thumbnails for old images on the image description page.',
	],
	'wgMediaViewerIsInBeta' => [
		'name' => 'Enable Media Viewer Beta Mode',
		'requires' => 'multimediaviewer',
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => null,
		'section' => 'media',
		'help' => false,
	],
	'wgPopupsBetaFeature' => [
		'name' => 'Enable Popups Beta Mode',
		'requires' => 'popups',
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => null,
		'section' => 'media',
		'help' => false,
	],
	'wmgSiteNoticeOptOut' => [
		'name' => 'Opt out of global Miraheze notices',
		'requires' => false,
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => false,
		'help' => 'Opts your wiki out of global Miraheze notices, only showing important notices.',
	],
	'wgULSAnonCanChangeLanguage' => [
		'name' => 'Allow anonymous users to change language',
		'requires' => 'universallanguageselector',
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => false,
		'help' => '',
	],
	'wmgVisualEditorEnableDefault' => [
		'name' => 'Make VisualEditor the default editor for all',
		'requires' => 'visualeditor',
		'restricted' => false,
		'type' => 'check',
		'overridedefault' => true,
		'help' => '',
	],
	'wgPageLanguageUseDB' => [
		'name' => 'Enable per page language',
		'restricted' => false,
		'requires' => false,
		'type' => 'check',
		'overridedefault' => false,
		'help' => 'Allows to change the page language for MediaWiki pages.',
	],
	'wmgAllowEntityImport' => [
		'name' => 'Allow Entity Import (Wikibase)',
		'restricted' => false,
		'requires' => 'wikibaserepository',
		'type' => 'check',
		'overridedefault' => false,
		'help' => 'Allow importing entities via Special:Import and importDump.php.',
	],
	'wmgEnableEntitySearchUI' => [
		'name' => 'Enable Entity Search UI (Wikibase)',
		'restricted' => false,
		'requires' => 'wikibaserepository',
		'type' => 'check',
		'overridedefault' => true,
		'help' => 'To determine if entity search UI should be enabled or not.',
	],
	'wgPageCreationLog' => [
		'name' => 'Page Creation Log',
		'restricted' => false,
		'requires' => false,
		'type' => 'check',
		'overridedefault' => true,
		'help' => 'Whether to maintain a log of new page creations, which can be viewed at Special:Log/create.',
	],
];
