<?php

/**
 * ManageWiki extensions and skins are added using the variable below.
 *
 * name: the displayed name of the setting on Special:ManageWikiExtensions.
 * linkPage: full url for an information page for the extension.
 * var: the relevant var that enables the extension.
 * conflicts: string of extensions that cause this extension to not work.
 * requires: a text entry of which extension is required for this setting to work.
 * restricted: boolean - requires managewiki-restricted to change.
 *
 * Extensions can provide installation steps as well for extensions, this includes skins.
 */
$wgManageWikiExtensions = [
		'3d' => [
			'name' => '3D',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:3D',
			'var' => 'wmgUse3D',
			'conflicts' => false,
			'requires' => [],
		],
		'addthis' => [
			'name' => 'AddThis',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:AddThis',
			'var' => 'wmgUseAddThis',
			'conflicts' => false,
			'requires' => [],
		],
		'htmlmetaadntitle' => [
			'name' => 'HTML Meta and Title',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Add_HTML_Meta_and_Title',
			'var' => 'wmgUseAddHTMLMetaAndTitle',
			'conflicts' => false,
			'requires' => [],
		],
		'adminlinks' => [
			'name' => 'AdminLinks',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Admin_Links',
			'var' => 'wmgUseAdminLinks',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
			'install' => [
				'sql' => [
					'ajaxpoll_info' => "$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_info.sql",
					'ajaxpoll_vote' => "$IP/extensions/AJAXPoll/sql/create-table--ajaxpoll_vote.sql"
				],
				'permissions' => [
					'user' => [
						'permissions' => [
							'ajaxpoll-vote',
							'ajaxpoll-view-results',
						],
					],
				],
			],
		],
		'apex' => [
			'name' => 'Apex (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Apex',
			'var' => 'wmgUseApex',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'approvedrevs' => [
			'name' => 'Approved Revs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Approved_Revs',
			'var' => 'wmgUseApprovedRevs',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'approved_revs_files' => "$IP/extensions/ApprovedRevs/sql/ApprovedFiles.sql",
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
			'requires' => [],
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
			'requires' => [],
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
			'requires' => [],
		],
		'authorprotect' => [
			'name' => 'Author Protect',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:AuthorProtect',
			'var' => 'wmgUseAuthorProtect',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
		],
		'babel' => [
			'name' => 'Babel',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Babel',
			'var' => 'wmgUseBabel',
			'conflicts' => false,
			'requires' => [],
		],
		'blogpage' => [
			'name' => 'Blog Page',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:BlogPage',
			'var' => 'wmgUseBlogPage',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'comments',
					'socialprofile',
					'voteny',
				],
			],
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
			'requires' => [],
		],
		'cargo' => [
			'name' => 'Cargo',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Cargo',
			'var' => 'wmgUseCargo',
			'conflicts' => false,
			'requires' => [],
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
		'categorysortheaders' => [
			'name' => 'CategorySortHeaders',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CategorySortHeaders',
			'var' => 'wmgUseCategorySortHeaders',
			'conflicts' => false,
			'requires' => [],
			'install' => [],
		],
		'categorytree' => [
			'name' => 'CategoryTree',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CategoryTree',
			'var' => 'wmgUseCategoryTree',
			'conflicts' => false,
			'requires' => [],
			'install' => [],
		],
		'charinsert' => [
			'name' => 'CharInsert',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CharInsert',
			'var' => 'wmgUseCharInsert',
			'conflicts' => false,
			'requires' => [],
		],
		'cite' => [
			'name' => 'Cite',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Cite',
			'var' => 'wmgUseCite',
			'conflicts' => false,
			'requires' => [],
		],
		'citethispage' => [
			'name' => 'CiteThisPage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CiteThisPage',
			'var' => 'wmgUseCiteThisPage',
			'conflicts' => false,
			'requires' => [],
		],
		'cirrussearch' => [
			'name' => 'CirrusSearch',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CirrusSearch',
			'var' => 'wmgUseCirrusSearch',
			'conflicts' => false,
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
		],
		'codeeditor' => [
			'name' => 'CodeEditor',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CodeEditor',
			'var' => 'wmgUseCodeEditor',
			'conflicts' => false,
			'requires' => [],
		],
		'codemirror' => [
			'name' => 'CodeMirror',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CodeMirror',
			'var' => 'wmgUseCodeMirror',
			'conflicts' => false,
			'requires' => [],
		],
		'collapsiblevector' => [
			'name' => 'Collapsible Vector',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CollapsibleVector',
			'var' => 'wmgUseCollapsibleVector',
			'conflicts' => false,
			'requires' => [],
		],
		'collection' => [
			'name' => 'Collection (PDF)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Collection',
			'var' => 'wmgUseCollection',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'electronpdfservice',
				],
			],
		],
		'comments' => [
			'name' => 'Comments',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Comments',
			'var' => 'wmgUseComments',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'createpage' => [
			'name' => 'CreatePage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CreatePage',
			'var' => 'wmgUseCreatePage',
			'conflicts' => false,
			'requires' => [],
		],
		'createredirect' => [
			'name' => 'CreateRedirect',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CreateRedirect',
			'var' => 'wmgUseCreateRedirect',
			'conflicts' => false,
			'requires' => [],
		],
		'crossreference' => [
			'name' => 'CrossReference',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CrossReference',
			'var' => 'wmgUseCrossReference',
			'conflicts' => false,
			'requires' => [],
		],
		'css' => [
			'name' => 'CSS',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:CSS',
			'var' => 'wmgUseCSS',
			'conflicts' => false,
			'requires' => [],
		],
		'darkvector' => [
			'name' => 'DarkVector (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:DarkVector',
			'var' => 'wmgUseDarkVector',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'description2' => [
			'name' => 'Description2',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Description2',
			'var' => 'wmgUseDescription2',
			'conflicts' => false,
			'requires' => [],
		],
		'disambiguator' => [
			'name' => 'Disambiguator',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Disambiguator',
			'var' => 'wmgUseDisambiguator',
			'conflicts' => false,
			'requires' => [],
		],
		'displaytitle' => [
			'name' => 'DisplayTitle',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DisplayTitle',
			'var' => 'wmgUseDisplayTitle',
			'conflicts' => false,
			'requires' => [],
		],
		'dplforum' => [
			'name' => 'DPLForum',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DPLforum',
			'var' => 'wmgUseDPLForum',
			'conflicts' => false,
			'requires' => [],
		],
		'dummyfandoommainpagetags' => [
			'name' => 'DummyFandoomMainpageTags',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DummyFandoomMainpageTags',
			'var' => 'wmgUseDummyFandoomMainpageTags',
			'conflicts' => false,
			'requires' => [],
		],
		'duplicator' => [
			'name' => 'Duplicator',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Duplicator',
			'var' => 'wmgUseDuplicator',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
			'section' => 'skins',
		],
		'dynamicpagelist' => [
			'name' => 'DynamicPageList',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DynamicPageList_(Wikimedia)',
			'var' => 'wmgUseDynamicPageList',
			'conflicts' => 'dynamicpagelist3',
			'requires' => [],
		],
		'dynamicpagelist3' => [
			'name' => 'DynamicPageList3',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:DynamicPageList3',
			'var' => 'wmgUseDynamicPageList3',
			'conflicts' => 'dynamicpagelist',
			'requires' => [],
		],
		'editcount' => [
			'name' => 'EditCount',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Editcount',
			'var' => 'wmgUseEditcount',
			'conflicts' => false,
			'requires' => [],
		],
		'editsubpages' => [
			'name' => 'Edit Subpages',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:EditSubpages',
			'var' => 'wmgUseEditSubpages',
			'conflicts' => false,
			'requires' => [],
			'install' => [],
		],
		'educationprogram' => [
			'name' => 'Education Program',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:EducationProgram',
			'var' => 'wmgUseEducationProgram',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'erudite' => [
			'name' => 'Erudite (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Erudite',
			'var' => 'wmgUseErudite',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'eventlogging' => [
			'name' => 'EventLogging',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:EventLogging',
			'var' => 'wmgUseEventLogging',
			'conflicts' => false,
			'requires' => [],
		],
		'fancyboxthumbs' => [
			'name' => 'Fancy Box Thumbs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:FancyBoxThumbs',
			'var' => 'wmgUseFancyBoxThumbs',
			'conflicts' => false,
			'requires' => [],
		],
		'flaggedrevs' => [
			'name' => 'FlaggedRevs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:FlaggedRevs',
			'var' => 'wmgUseFlaggedRevs',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
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
			'requires' => [],
			'section' => 'skins',
		],
		'gadgets' => [
			'name' => 'Gadgets',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Gadgets',
			'var' => 'wmgUseGadgets',
			'conflicts' => false,
			'requires' => [],
		],
		'gamepress' => [
			'name' => 'Gamespress (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Gamepress',
			'var' => 'wmgUseGamepress',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'genealogy' => [
			'name' => 'Genealogy',
			'linkPage' => 'https://www.mediawiki.org/wiki/Extension:Genealogy',
			'var' => 'wmgUseGenealogy',
			'conflicts' => false,
			'requires' => [],
		],
		'geocrumbs' => [
			'name' => 'GeoCrumbs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GeoCrumbs',
			'var' => 'wmgUseGeoCrumbs',
			'conflicts' => false,
			'requires' => [],
		],
		'geodata' => [
			'name' => 'GeoData',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GeoData',
			'var' => 'wmgUseGeoData',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'globaluserpage' => [
			'name' => 'GlobalUserPage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GlobalUserPage',
			'var' => 'wmgUseGlobalUserPage',
			'conflicts' => false,
			'requires' => [],
		],
		'graph' => [
			'name' => 'Graph',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Graph',
			'var' => 'wmgUseGraph',
			'conflicts' => false,
			'requires' => [],
		],
		'groupssidebar' => [
			'name' => 'GroupsSidebar',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GroupsSidebar',
			'var' => 'wmgUseGroupsSidebar',
			'conflicts' => false,
			'requires' => [],
		],
		'guidedtour' => [
			'name' => 'GuidedTour',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:GuidedTour',
			'var' => 'wmgUseGuidedTour',
			'conflicts' => false,
			'requires' => [],
		],
		'hawelcome' => [
			'name' => 'HAWelcome',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:HAWelcome',
			'var' => 'wmgUseHAWelcome',
			'conflicts' => 'flow',
			'requires' => [],
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
			'requires' => [],
		],
		'hidesection' => [
			'name' => 'HideSection',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:HideSection',
			'var' => 'wmgUseHideSection',
			'conflicts' => false,
			'requires' => [],
		],
		'highlightlinksincategory' => [
			'name' => 'HighlightLinksInCategory',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Highlight_Links_in_Category',
			'var' => 'wmgUseHighlightLinksInCategory',
			'conflicts' => false,
			'requires' => [],
		],
		'imagemap' => [
			'name' => 'ImageMap',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ImageMap',
			'var' => 'wmgUseImageMap',
			'conflicts' => false,
			'requires' => [],
		],
		'imagerating' => [
			'name' => 'ImageRating',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ImageRating',
			'var' => 'wmgUseImageRating',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'voteny',
				],
			],
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
			'requires' => [],
		],
		'javascriptslideshow' => [
			'name' => 'Javascript Slidehow',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:JavascriptSlideshow',
			'var' => 'wmgUseJavascriptSlideshow',
			'conflicts' => false,
			'requires' => [],
		],
		'josa' => [
			'name' => 'Josa',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Josa',
			'var' => 'wmgUseJosa',
			'conflicts' => false,
			'requires' => [],
		],
		'jsbreadcrumbs' => [
			'name' => 'JS BreadCrumbs',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:JSBreadCrumbs',
			'var' => 'wmgUseJSBreadCrumbs',
			'conflicts' => false,
			'requires' => [],
		],
		'kartographer' => [
			'name' => 'Kartographer',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Kartographer',
			'var' => 'wmgUseKartographer',
			'conflicts' => false,
			'requires' => [],
		],
		'labeledsectiontransclusion' => [
			'name' => 'LabeledSectionTransclusion',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:LabeledSectionTransclusion',
			'var' => 'wmgUseLabeledSectionTransclusion',
			'conflicts' => false,
			'requires' => [],
		],
		'liberty' => [
			'name' => 'Liberty (Skin)',
			'linkPage' => 'https://github.com/librewiki/liberty-skin',
			'var' => 'wmgUseLiberty',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'linksuggest' => [
			'name' => 'LinkSuggest',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:LinkSuggest',
			'var' => 'wmgUseLinkSuggest',
			'conflicts' => false,
			'requires' => [],
		],
		'linktarget' => [
			'name' => 'LinkTarget',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:LinkTarget',
			'var' => 'wmgUseLinkTarget',
			'conflicts' => false,
			'requires' => [],
		],
		'linktitles' => [
			'name' => 'LinkTitles',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:LinkTitles',
			'var' => 'wmgUseLinkTitles',
			'conflicts' => false,
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
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
			'requires' => [],
		],
		'loopscombo' => [
			'name' => 'Loops',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Loops',
			'var' => 'wmgUseLoopsCombo',
			'conflicts' => false,
			'requires' => [],
		],
		'magicnocache' => [
			'name' => 'MagicNoCache',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MagicNoCache',
			'var' => 'wmgUseMagicNoCache',
			'conflicts' => false,
			'requires' => [],
		],
		'maps' => [
			'name' => 'Maps',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Maps',
			'var' => 'wmgUseMaps',
			'conflicts' => false,
			'requires' => [],
		],
		'mask' => [
			'name' => 'Mask (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Mask',
			'var' => 'wmgUseMask',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'masseditregex' => [
			'name' => 'MassEditRegex',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MassEditRegex',
			'var' => 'wmgUseMassEditRegex',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
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
			'requires' => [],
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
			'requires' => [],
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
			'requires' => [],
			'section' => 'skins',
		],
		'mobilefrontend' => [
			'name' => 'MobileFrontend',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MobileFrontend',
			'var' => 'wmgUseMobileFrontend',
			'conflicts' => false,
			'requires' => [],
		],
		'moderation' => [
			'name' => 'Moderation',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Moderation',
			'var' => 'wmgUseModeration',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'moderation' => "$IP/extensions/Moderation/sql/patch-moderation.sql",
					'moderation_block' => "$IP/extensions/Moderation/sql/patch-moderation_block.sql"
				],
				'permissions' => [
					'automoderated' => [
						'permissions' => [
							'skip-moderation',
							'skip-move-moderation',
						],
					],
					'bot' => [
						'permissions' => [
							'skip-moderation',
							'skip-move-moderation',
						],
					],
					'moderator' => [
						'permissions' => [
							'moderation',
						],
					],
					'sysop' => [
						'addgroups' => [
							'automoderated',
							'moderator',
						],
						'removegroups' => [
							'automoderated',
							'moderator',
						],
						'permissions' => [
							'skip-moderation',
							'skip-move-moderation',
							'moderation',
						],
					],
				],
			],
		],
		'modernskylight' => [
			'name' => 'ModernSkylight (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Modern_Skylight',
			'var' => 'wmgUseModernSkylight',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'mscalendar' => [
			'name' => 'MsCalendar',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MsCalendar',
			'var' => 'wmgUseMSCalendar',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'mscal_content' => "$IP/extensions/MsCalendar/MsCalendar.sql"
				],
			],
		],
		'mscatselect' => [
			'name' => 'MsCatSelect',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MsCatSelect',
			'var' => 'wmgUseMsCatSelect',
			'conflicts' => false,
			'requires' => [],
		],
		'mslinks' => [
			'name' => 'MsLinks',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MsLinks',
			'var' => 'wmgUseMsLinks',
			'conflicts' => false,
			'requires' => [],
		],
		'msupload' => [
			'name' => 'MsUpload',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MsUpload',
			'var' => 'wmgUseMsUpload',
			'conflicts' => false,
			'requires' => [],
		],
		'multimediaviewer' => [
			'name' => 'Multimedia Viewer',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MultimediaViewer',
			'var' => 'wmgUseMultimediaViewer',
			'conflicts' => false,
			'requires' => [],
		],
		'multiboilerplate' => [
			'name' => 'MultiBoilerplate',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:MultiBoilerplate',
			'var' => 'wmgUseMultiBoilerplate',
			'conflicts' => false,
			'requires' => [],
		],
		'newestpages' => [
			'name' => 'NewestPages',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NewestPages',
			'var' => 'wmgUseNewestPages',
			'conflicts' => false,
			'requires' => [],
		],
		'news' => [
			'name' => 'News',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:News',
			'var' => 'wmgUseNews',
			'conflicts' => false,
			'requires' => [],
		],
		'newsignuppage' => [
			'name' => 'New Signup Page',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NewSignupPage',
			'var' => 'wmgUseNewSignupPage',
			'conflicts' => false,
			'requires' => [],
		],
		'newsletter' => [
			'name' => 'Newsletter',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Newsletter',
			'var' => 'wmgUseNewsletter',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'newusernotif' => [
			'name' => 'New User Email Notification',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NewUserNotif',
			'var' => 'wmgUseNewUserNotif',
			'conflicts' => false,
			'requires' => [],
		],
		'notitle' => [
			'name' => 'NoTitle',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NoTitle',
			'var' => 'wmgUseNoTitle',
			'conflicts' => false,
			'requires' => [],
		],
		'nukedpl' => [
			'name' => 'NukeDPL',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:NukeDPL',
			'var' => 'wmgUseNukeDPL',
			'conflicts' => false,
			'requires' => [],
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
		'numberedheadings' => [
			'name' => 'NumberedHeadings',
			'linkPage' => 'https://mediawiki.org/wiki/NumberedHeadings',
			'var' => 'wmgUseNumberedHeadings',
			'conflicts' => false,
			'requires' => [],
		],
		'nostalgia' => [
			'name' => 'Nostalgia (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Nostalgia',
			'var' => 'wmgUseNostalgia',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'opengraphmeta' => [
			'name' => 'OpenGraphMeta',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:OpenGraphMeta',
			'var' => 'wmgUseOpenGraphMeta',
			'conflicts' => false,
			'requires' => [],
		],
		'pagedtiffhandler' => [
			'name' => 'PagedTiffHandler',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PagedTiffHandler',
			'var' => 'wmgUsePagedTiffHandler',
			'conflicts' => false,
			'requires' => [],
		],
		'pageforms' => [
			'name' => 'Page Forms',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PageForms',
			'var' => 'wmgUsePageForms',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'pagetriage' => [
			'name' => 'Page Triage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PageTriage',
			'var' => 'wmgUsePageTriage',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'pagetriage_tags' => "$IP/extensions/PageTriage/sql/PageTriageTags.sql",
					'pagetriage_page_tags' => "$IP/extensions/PageTriage/sql/PageTriagePageTags.sql",
					'pagetriage_page' => "$IP/extensions/PageTriage/sql/PageTriagePage.sql",
					'pagetriage_log' => "$IP/extensions/PageTriage/sql/PageTriageLog.sql"
				],
			],
		],
		'pdfembed' => [
			'name' => 'PDF Embed',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PDFEmbed',
			'var' => 'wmgUsePDFEmbed',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'pipeescape' => [
			'name' => 'Pipe Escape',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:PipeEscape',
			'var' => 'wmgUsePipeEscape',
			'conflicts' => false,
			'requires' => [],
		],
		'pivot' => [
			'name' => 'Pivot (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Pivot',
			'var' => 'wmgUsePivot',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'poem' => [
			'name' => 'Poem',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Poem',
			'var' => 'wmgUsePoem',
			'conflicts' => false,
			'requires' => [],
		],
		'popups' => [
			'name' => 'Popups',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Popups',
			'var' => 'wmgUsePopups',
			'conflicts' => false,
			'requires' => [],
		],
		'poll' => [
			'name' => 'Poll',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Poll',
			'var' => 'wmgUsePoll',
			'conflicts' => 'pollny',
			'requires' => [],
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
			'conflicts' => 'poll',
			'requires' => [],
			'install' => [
				'sql' => [
					'poll_choice' => "$IP/extensions/PollNY/sql/poll_choice.sql",
					'poll_question' => "$IP/extensions/PollNY/sql/poll_question.sql",
					'poll_user_vote' => "$IP/extensions/PollNY/sql/poll_user_vote.sql",
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
			'requires' => [],
		],
		'proofreadpages' => [
			'name' => 'Proofread Pages',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ProofreadPage',
			'var' => 'wmgUseProofreadPage',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
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
			'requires' => [],
		],
		'quiz' => [
			'name' => 'Quiz',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Quiz',
			'var' => 'wmgUseQuiz',
			'conflicts' => false,
			'requires' => [],
		],
		'quizgame' => [
			'name' => 'Quiz Game (SocialProfile)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:QuizGame',
			'var' => 'wmgUseQuizGame',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'socialprofile',
				],
			],
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
			'requires' => [
				'extensions' => [
					'socialprofile',
				],
			],
		],
		'randomimage' => [
			'name' => 'RandomImage',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RandomImage',
			'var' => 'wmgUseRandomImage',
			'conflicts' => false,
			'requires' => [],
		],
		'randomselection' => [
			'name' => 'RandomSelection',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RandomSelection',
			'var' => 'wmgUseRandomSelection',
			'conflicts' => false,
			'requires' => [],
		],
		'refreshed' => [
			'name' => 'Refreshed (Skin)',
			'linkPage' => 'https://mediawiki.org/wiki/Skin:Refreshed',
			'var' => 'wmgUseRefreshed',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'relatedarticles' => [
			'name' => 'Related Articles',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RelatedArticles',
			'var' => 'wmgUseRelatedArticles',
			'conflicts' => false,
			'requires' => [],
		],
		'replacetext' => [
			'name' => 'Replace Text',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ReplaceText',
			'var' => 'wmgUseReplaceText',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'rss' => [
			'name' => 'RSS',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:RSS',
			'var' => 'wmgUseRSS',
			'conflicts' => false,
			'requires' => [],
		],
		'sandboxlink' => [
			'name' => 'Sandbox Link',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SandboxLink',
			'var' => 'wmgUseSandboxLink',
			'conflicts' => false,
			'requires' => [],
		],
		'score' => [
			'name' => 'Score',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Score',
			'var' => 'wmgUseScore',
			'conflicts' => false,
			'requires' => [],
		],
		'scratchblocks' => [
			'name' => 'ScratchBlocks',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:ScratchBlocks',
			'var' => 'wmgUseScratchBlocks',
			'conflicts' => false,
			'requires' => [],
		],
		'simplechanges' => [
			'name' => 'Simple Changes',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SimpleChanges',
			'var' => 'wmgUseSimpleChanges',
			'conflicts' => false,
			'requires' => [],
		],
		'simpletooltip' => [
			'name' => 'Simple Tooltip',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SimpleTooltip',
			'var' => 'wmgUseSimpleTooltip',
			'conflicts' => false,
			'requires' => [],
		],
		'sitescout' => [
			'name' => 'SiteScout',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SiteScout',
			'var' => 'wmgUseSiteScout',
			'conflicts' => false,
			'requires' => [],
		],
		'socialprofile' => [
			'name' => 'SocialProfile',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SocialProfile',
			'var' => 'wmgUseSocialProfile',
			'conflicts' => false,
			'requires' => [],
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
							'avatarremove'
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
			'requires' => [],
		],
		'subpagefun' => [
			'name' => 'SubPageFun',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Subpage_Fun',
			'var' => 'wmgUseSubpageFun',
			'conflicts' => false,
			'requires' => [],
		],
		'subpagelist3' => [
			'name' => 'SubPageList3',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:SubPageList3',
			'var' => 'wmgUseSubPageList3',
			'conflicts' => false,
			'requires' => [],
		],
		'tabscombination' => [
			'name' => 'TabsCombination (Tabber + Tabs)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Tabs',
			'var' => 'wmgUseTabsCombination',
			'conflicts' => false,
			'requires' => [],
		],
		'templatesandbox' => [
			'name' => 'Template Sandbox',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TemplateSandbox',
			'var' => 'wmgUseTemplateSandbox',
			'conflicts' => false,
			'requires' => [],
		],
		'templatestyles' => [
			'name' => 'Template Styles',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TemplateStyles',
			'var' => 'wmgUseTemplateStyles',
			'conflicts' => false,
			'requires' => [],
		],
		'templatewizard' => [
			'name' => 'Template Wizard',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TemplateWizard',
			'var' => 'wmgUseTemplateWizard',
			'conflicts' => false,
			'requires' => [],
		],
		'theme' => [
			'name' => 'Theme',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Theme',
			'var' => 'wmgUseTheme',
			'conflicts' => false,
			'requires' => [],
		],
		'thanks' => [
			'name' => 'Thanks',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Thanks',
			'var' => 'wmgUseThanks',
			'conflicts' => false,
			'requires' => [],
		],
		'timedmediahandler' => [
			'name' => 'TimedMediaHandler',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TimedMediaHandler',
			'var' => 'wmgUseTimedMediaHandler',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'transcode' => "$IP/extensions/TimedMediaHandler/sql/TimedMediaHandler.sql"
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
			'requires' => [],
		],
		'titlekey' => [
			'name' => 'TitleKey',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TitleKey',
			'var' => 'wmgUseTitleKey',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
		],
		'translate' => [
			'name' => 'Translate',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Translate',
			'var' => 'wmgUseTranslate',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
			'section' => 'skins',
		],
		'twocolconflict' => [
			'name' => 'TwoColConflict',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:TwoColConflict',
			'var' => 'wmgUseTwoColConflict',
			'conflicts' => false,
			'requires' => [],
		],
		'universallanguageselector' => [
			'name' => 'UniversalLanguageSelector',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UniversalLanguageSelector',
			'var' => 'wmgUseUniversalLanguageSelector',
			'conflicts' => false,
			'requires' => [],
		],
		'uploadslink' => [
			'name' => 'UploadsLink',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UploadsLink',
			'var' => 'wmgUseUploadsLink',
			'conflicts' => false,
			'requires' => [],
		],
		'urlgetparameters' => [
			'name' => 'UrlGetParamters',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UrlGetParameters',
			'var' => 'wmgUseUrlGetParameters',
			'conflicts' => false,
			'requires' => [],
		],
		'userwelcome' => [
			'name' => 'UserWelcome',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:UserWelcome',
			'var' => 'wmgUseUserWelcome',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'socialprofile',
				],
			],
		],
		'variables' => [
			'name' => 'Variable',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Variables',
			'var' => 'wmgUseVariables',
			'conflicts' => false,
			'requires' => [],
		],
		'voteny' => [
			'name' => 'VoteNY',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:VoteNY',
			'var' => 'wmgUseVoteNY',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
			'help' => 'Will start working 10-20 mins after enabling.',
		],
		'webchat' => [
			'name' => 'WebChat',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WebChat',
			'var' => 'wmgUseWebChat',
			'conflicts' => false,
			'requires' => [],
		],
		'widgets' => [
			'name' => 'Widgets',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Widgets',
			'var' => 'wmgUseWidgets',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'namespaces' => [
					'Widget' => [
						'id' => 274,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => 'editwidgets',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
					'Widget_talk' => [
						'id' => 275,
						'searchable' => 0,
						'subpages' => 1,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
				],
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
			'requires' => [],
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
		'wikibaseclient' => [
			'name' => 'Wikibase (Client)',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:Wikibase',
			'var' => 'wmgUseWikibaseClient',
			'conflicts' => false,
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
			'install' => [
				'sql' => [
					'wbc_entity_usage' => "$IP/extensions/Wikibase/client/sql/entity_usage.sql",
				],
			],
		],
		'wikicategorytagcloud' => [
			'name' => 'WikiCategoryTagCloud',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikiCategoryTagCloud',
			'var' => 'wmgUseWikiCategoryTagCloud',
			'conflicts' => false,
			'requires' => [],
		],
		'wikidatapagebanner' => [
			'name' => 'WikidataPageBanner',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikidataPageBanner',
			'var' => 'wmgUseWikidataPageBanner',
			'conflicts' => false,
			'requires' => [],
		],
		'wikiforum' => [
			'name' => 'WikiForum',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikiForum',
			'var' => 'wmgUseWikiForum',
			'conflicts' => false,
			'requires' => [],
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
			'requires' => [],
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
			'requires' => [],
		],
		'wikitextloggedinout' => [
			'name' => 'WikiText Logged In Out',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikiTextLoggedInOut',
			'var' => 'wmgUseWikiTextLoggedInOut',
			'conflicts' => false,
			'requires' => [],
		],
		'wikimediaincubator' => [
			'name' => 'WikimediaIncubator',
			'linkPage' => 'https://mediawiki.org/wiki/Extension:WikimediaIncubator',
			'var' => 'wmgUseWikimediaIncubator',
			'conflicts' => false,
			// Configuation Change in LocalSettings.php, request this extension on phabricator
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
		],
		'youtube' => [
			'name' => 'YouTube',
			'linkPage' => 'https://github.com/miraheze/YouTube',
			'var' => 'wmgUseYouTube',
			'conflicts' => false,
			'requires' => [],
		],
];
