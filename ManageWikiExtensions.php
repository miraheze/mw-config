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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:3D',
			'var' => 'wmgUse3D',
			'conflicts' => false,
			'requires' => [],
		],
		'addthis' => [
			'name' => 'AddThis',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AddThis',
			'var' => 'wmgUseAddThis',
			'conflicts' => false,
			'requires' => [],
		],
		'htmlmetaadntitle' => [
			'name' => 'HTML Meta and Title',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Add_HTML_Meta_and_Title',
			'var' => 'wmgUseAddHTMLMetaAndTitle',
			'conflicts' => false,
			'requires' => [],
		],
		'adminlinks' => [
			'name' => 'AdminLinks',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Admin_Links',
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
		'advancedsearch' => [
			'name' => 'AdvancedSearch',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AdvancedSearch',
			'var' => 'wmgUseAdvancedSearch',
			'conflicts' => false,
			'requires' => [],
		],
		'ajaxpoll' => [
			'name' => 'AJAX Poll',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AJAXPoll',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Apex',
			'var' => 'wmgUseApex',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'approvedrevs' => [
			'name' => 'Approved Revs',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Approved_Revs',
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
		'arrays' => [
			'name' => 'Arrays',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Arrays',
			'var' => 'wmgUseArrays',
			'conflicts' => false,
			'requires' => [],
		],
		'articleratings' => [
			'name' => 'Article Ratings',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ArticleRatings',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ArticleToCategory2',
			'var' => 'wmgUseArticleToCategory2',
			'conflicts' => false,
			'requires' => [],
		],
		'authorprotect' => [
			'name' => 'Author Protect',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AuthorProtect',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AutoCreateCategoryPages',
			'var' => 'wmgUseAutoCreateCategoryPages',
			'conflicts' => false,
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
		],
		'autocreatepages' => [
			'name' => 'Auto Create Pages',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AutoCreatePage',
			'var' => 'wmgUseAutoCreatePage',
			'conflicts' => false,
			'requires' => [],
		],
		'babel' => [
			'name' => 'Babel',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Babel',
			'var' => 'wmgUseBabel',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'babel' => "$IP/extensions/Babel/babel.sql"
				],
			],
		],
		'blogpage' => [
			'name' => 'Blog Page',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:BlogPage',
			'var' => 'wmgUseBlogPage',
			'conflicts' => 'simpleblogpage',
			'requires' => [
				'extensions' => [
					'comments',
					'pollny',
					'socialprofile',
					'voteny',
				],
			],
			'install' => [
				'namespaces' => [
					'Blog' => [
						'id' => 500,
						'searchable' => 1,
						'subpages' => 0,
						'protection' => 'edit',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
					'Blog_talk' => [
						'id' => 501,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
				],
				'permissions' => [
					'user' => [
						'permissions' => [
							'createblogpost',
						],
					],
				],
			],
		],
		'Bootstrap' => [
			'name' => 'Bootstrap',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Bootstrap',
			'var' => 'wmgUseBootstrap',
			'conflicts' => false,
			'requires' => [],
		],
		'calendar-wikivoyage' => [
			'name' => 'Calendar-Wikivoyage',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Calendar-Wikivoyage',
			'var' => 'wmgUseCalendarWikivoyage',
			'conflicts' => false,
			'requires' => [],
		],
		'capiunto' => [
			'name' => 'Capiunto',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Capiunto',
			'var' => 'wmgUseCapiunto',
			'conflicts' => false,
			'requires' => [],
		],
		'cargo' => [
			'name' => 'Cargo',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Cargo',
			'var' => 'wmgUseCargo',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'cargo_tables' => "$IP/extensions/Cargo/sql/Cargo.sql"
				],
				'permissions' => [
					'*' => [
						'permissions' => [
							'runcargoqueries',
						],
					],
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategorySortHeaders',
			'var' => 'wmgUseCategorySortHeaders',
			'conflicts' => false,
			'requires' => [],
			'install' => [],
		],
		'categorytree' => [
			'name' => 'CategoryTree',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategoryTree',
			'var' => 'wmgUseCategoryTree',
			'conflicts' => false,
			'requires' => [],
			'install' => [],
		],
		'charinsert' => [
			'name' => 'CharInsert',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CharInsert',
			'var' => 'wmgUseCharInsert',
			'conflicts' => false,
			'requires' => [],
		],
		'cite' => [
			'name' => 'Cite',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Cite',
			'var' => 'wmgUseCite',
			'conflicts' => false,
			'requires' => [],
		],
		'citethispage' => [
			'name' => 'CiteThisPage',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CiteThisPage',
			'var' => 'wmgUseCiteThisPage',
			'conflicts' => false,
			'requires' => [],
		],
		'citizen' => [
			'name' => 'Citizen (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Citizen',
			'var' => 'wmgUseCitizen',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'citoid' => [
			'name' => 'Citoid',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Citoid',
			'var' => 'wmgUseCitoid',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'cite',
					'visualeditor',
				],
			],
		],
		'cleanchanges' => [
			'name' => 'CleanChanges',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CleanChanges',
			'var' => 'wmgUseCleanChanges',
			'conflicts' => false,
			'requires' => [],
		],
		'codeeditor' => [
			'name' => 'CodeEditor',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CodeEditor',
			'var' => 'wmgUseCodeEditor',
			'conflicts' => false,
			'requires' => [],
		],
		'codemirror' => [
			'name' => 'CodeMirror',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CodeMirror',
			'var' => 'wmgUseCodeMirror',
			'conflicts' => false,
			'requires' => [],
		],
		'collapsiblevector' => [
			'name' => 'Collapsible Vector',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CollapsibleVector',
			'var' => 'wmgUseCollapsibleVector',
			'conflicts' => false,
			'requires' => [],
		],
		'collection' => [
			'name' => 'Collection + Electron (PDF)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Collection',
			'var' => 'wmgUseCollection',
			'conflicts' => false,
			'requires' => [],
		],
		'commentstreams' => [
			'name' => 'CommentStreams',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CommentStreams',
			'var' => 'wmgUseCommentStreams',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'commentData' => "$IP/extensions/CommentStreams/sql/commentData.sql",
					'votes' => "$IP/extensions/CommentStreams/sql/votes.sql",
					'watch' => "$IP/extensions/CommentStreams/sql/watch.sql",
				],
			],
		],
		'comments' => [
			'name' => 'Comments',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Comments',
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
					'commentadmin' => [
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
		'commonsmetadata' => [
			'name' => 'CommonsMetadata',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CommonsMetadata',
			'var' => 'wmgUseCommonsMetadata',
			'conflicts' => false,
			'requires' => [],
		],
		'contributionscores' => [
			'name' => 'ContributionScores',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ContributionScores',
			'var' => 'wmgUseContributionScores',
			'conflicts' => false,
			'requires' => [],
		],
		'cosmos' => [
			'name' => 'Cosmos (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Cosmos',
			'var' => 'wmgUseCosmos',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'createpage' => [
			'name' => 'CreatePage',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreatePage',
			'var' => 'wmgUseCreatePage',
			'conflicts' => false,
			'requires' => [],
		],
		'createpageuw' => [
			'name' => 'CreatePageUw',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreatePageUw',
			'var' => 'wmgUseCreatePageUw',
			'conflicts' => false,
			'requires' => [],
		],
		'createredirect' => [
			'name' => 'CreateRedirect',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreateRedirect',
			'var' => 'wmgUseCreateRedirect',
			'conflicts' => false,
			'requires' => [],
		],
		'css' => [
			'name' => 'CSS',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CSS',
			'var' => 'wmgUseCSS',
			'conflicts' => false,
			'requires' => [],
		],
		'datatransfer' => [
			'name' => 'DataTransfer',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DataTransfer',
			'var' => 'wmgUseDataTransfer',
			'conflicts' => false,
			'requires' => [],
		],
		'darkmode' => [
			'name' => 'DarkMode',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DarkMode',
			'var' => 'wmgUseDarkMode',
			'conflicts' => false,
			'requires' => [],
		],
		'deleteuserpages' => [
			'name' => 'DeleteUserPages',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DeleteUserPages',
			'var' => 'wmgUseDeleteUserPages',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'permissions' => [
					'user' => [
						'permissions' => [
							'delete-rootuserpages',
							'delete-usersubpages'
						],
					],
				],
			],
		],
		'description2' => [
			'name' => 'Description2',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Description2',
			'var' => 'wmgUseDescription2',
			'conflicts' => false,
			'requires' => [],
		],
		'disambiguator' => [
			'name' => 'Disambiguator',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Disambiguator',
			'var' => 'wmgUseDisambiguator',
			'conflicts' => false,
			'requires' => [],
		],
		'displaytitle' => [
			'name' => 'DisplayTitle',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DisplayTitle',
			'var' => 'wmgUseDisplayTitle',
			'conflicts' => false,
			'requires' => [],
		],
		'dplforum' => [
			'name' => 'DPLForum',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DPLforum',
			'var' => 'wmgUseDPLForum',
			'conflicts' => false,
			'requires' => [],
		],
		'dummyfandoommainpagetags' => [
			'name' => 'DummyFandoomMainpageTags',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DummyFandoomMainpageTags',
			'var' => 'wmgUseDummyFandoomMainpageTags',
			'conflicts' => false,
			'requires' => [],
		],
		'disqustag' => [
			'name' => 'DisqusTag',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DisqusTag',
			'var' => 'wmgUseDisqusTag',
			'conflicts' => false,
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
		],
		'dusktodawn' => [
			'name' => 'DuskToDawn (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:DuskToDawn',
			'var' => 'wmgUseDuskToDawn',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'dynamicpagelist' => [
			'name' => 'DynamicPageList',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicPageList_(Wikimedia)',
			'var' => 'wmgUseDynamicPageList',
			'conflicts' => 'dynamicpagelist3',
			'requires' => [],
		],
		'dynamicpagelist3' => [
			'name' => 'DynamicPageList3',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicPageList3',
			'var' => 'wmgUseDynamicPageList3',
			'conflicts' => 'dynamicpagelist',
			'requires' => [],
		],
		'dynamicsidebar' => [
			'name' => 'DynamicSidebar',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicSidebar',
			'var' => 'wmgUseDynamicSidebar',
			'conflicts' => false,
			'requires' => [],
		],
		'editcount' => [
			'name' => 'EditCount',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Editcount',
			'var' => 'wmgUseEditcount',
			'conflicts' => false,
			'requires' => [],
		],
		'editsubpages' => [
			'name' => 'Edit Subpages',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:EditSubpages',
			'var' => 'wmgUseEditSubpages',
			'conflicts' => false,
			'requires' => [],
			'install' => [],
		],
		'erudite' => [
			'name' => 'Erudite (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Erudite',
			'var' => 'wmgUseErudite',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'fancyboxthumbs' => [
			'name' => 'Fancy Box Thumbs',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:FancyBoxThumbs',
			'var' => 'wmgUseFancyBoxThumbs',
			'conflicts' => false,
			'requires' => [],
		],
		'femiwiki' => [
			'name' => 'Femiwiki (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Femiwiki',
			'var' => 'wmgUseFemiwiki',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'flaggedrevs' => [
			'name' => 'FlaggedRevs',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:FlaggedRevs',
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
			'name' => 'Flow (StructuredDiscussions)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:StructuredDiscussions',
			'var' => 'wmgUseFlow',
			'conflicts' => false,
			'requires' => [],
			'help' => 'Will start working 10-20 mins after enabling.',
			'install' => [
				'sql' => [
					'flow_revision' => "$IP/extensions/Flow/flow.sql"
				],
				'namespaces' => [
					'Topic' => [
						'id' => 2600,
						'searchable' => 1,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'flow-board',
						'additional' => []
					],
					'Topic_talk' => [
						'id' => 2601,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
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
				'mwscript' => [
 					"$IP/extensions/Flow/maintenance/FlowCreateTemplates.php" => [],
				],
			],
		],
		'foreground' => [
			'name' => 'Foreground (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Foreground',
			'var' => 'wmgUseForeground',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'forcepreview' => [
			'name' => 'ForcePreview',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ForcePreview',
			'var' => 'wmgUseForcePreview',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'permissions' => [
					'user' => [
						'permissions' => [
							'forcepreviewexempt',
						],
					],
				],
			],
		],
		'fontawesome' => [
			'name' => 'FontAwesome',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:FontAwesome',
			'var' => 'wmgUseFontAwesome',
			'conflicts' => false,
			'requires' => [],
		],
		'gadgets' => [
			'name' => 'Gadgets',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Gadgets',
			'var' => 'wmgUseGadgets',
			'conflicts' => false,
			'requires' => [],
		],
		'gamepress' => [
			'name' => 'Gamespress (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Gamepress',
			'var' => 'wmgUseGamepress',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'genealogy' => [
			'name' => 'Genealogy',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Genealogy',
			'var' => 'wmgUseGenealogy',
			'conflicts' => false,
			'requires' => [],
		],
		'geocrumbs' => [
			'name' => 'GeoCrumbs',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GeoCrumbs',
			'var' => 'wmgUseGeoCrumbs',
			'conflicts' => false,
			'requires' => [],
		],
		'geodata' => [
			'name' => 'GeoData',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GeoData',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GettingStarted',
			'var' => 'wmgUseGettingStarted',
			'conflicts' => false,
			'requires' => [],
		],
		'globaluserpage' => [
			'name' => 'GlobalUserPage',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GlobalUserPage',
			'var' => 'wmgUseGlobalUserPage',
			'conflicts' => false,
			'requires' => [],
		],
		'googledocs4mw' => [
			'name' => 'GoogleDocs4MW',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GoogleDocs4MW',
			'var' => 'wmgUseGoogleDocs4MW',
			'conflicts' => false,
			'requires' => [],
		],
		'graph' => [
			'name' => 'Graph',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Graph',
			'var' => 'wmgUseGraph',
			'conflicts' => false,
			'requires' => [],
		],
		'groupssidebar' => [
			'name' => 'GroupsSidebar',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GroupsSidebar',
			'var' => 'wmgUseGroupsSidebar',
			'conflicts' => false,
			'requires' => [],
		],
		'guidedtour' => [
			'name' => 'GuidedTour',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GuidedTour',
			'var' => 'wmgUseGuidedTour',
			'conflicts' => false,
			'requires' => [],
		],
		'hawelcome' => [
			'name' => 'HAWelcome',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HAWelcome',
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
		'headerfooter' => [
			'name' => 'HeaderFooter',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HeaderFooter',
			'var' => 'wmgUseHeaderFooter',
			'conflicts' => false,
			'requires' => [],
		],
		'headertabs' => [
			'name' => 'HeaderTabs',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HeaderTabs',
			'var' => 'wmgUseHeaderTabs',
			'conflicts' => false,
			'requires' => [],
		],
		'hidesection' => [
			'name' => 'HideSection',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HideSection',
			'var' => 'wmgUseHideSection',
			'conflicts' => false,
			'requires' => [],
		],
		'highlightlinksincategory' => [
			'name' => 'HighlightLinksInCategory',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Highlight_Links_in_Category',
			'var' => 'wmgUseHighlightLinksInCategory',
			'conflicts' => false,
			'requires' => [],
		],
		'imagemap' => [
			'name' => 'ImageMap',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ImageMap',
			'var' => 'wmgUseImageMap',
			'conflicts' => false,
			'requires' => [],
		],
		'imagerating' => [
			'name' => 'ImageRating',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ImageRating',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:InputBox',
			'var' => 'wmgUseInputBox',
			'conflicts' => false,
			'requires' => [],
		],
		'javascriptslideshow' => [
			'name' => 'Javascript Slideshow',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JavascriptSlideshow',
			'var' => 'wmgUseJavascriptSlideshow',
			'conflicts' => false,
			'requires' => [],
		],
		'josa' => [
			'name' => 'Josa',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Josa',
			'var' => 'wmgUseJosa',
			'conflicts' => false,
			'requires' => [],
		],
		'jsbreadcrumbs' => [
			'name' => 'JS BreadCrumbs',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JSBreadCrumbs',
			'var' => 'wmgUseJSBreadCrumbs',
			'conflicts' => false,
			'requires' => [],
		],
		'jscalendar' => [
			'name' => 'JsCalendar',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JsCalendar',
			'var' => 'wmgUseJsCalendar',
			'conflicts' => false,
			'requires' => [],
		],
		'jsonconfig' => [
			'name' => 'JsonConfig',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JsonConfig',
			'var' => 'wmgUseJsonConfig',
			'conflicts' => false,
			'requires' => [],
		],
		'kartographer' => [
			'name' => 'Kartographer',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Kartographer',
			'var' => 'wmgUseKartographer',
			'conflicts' => false,
			'requires' => [],
		],
		'labeledsectiontransclusion' => [
			'name' => 'LabeledSectionTransclusion',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LabeledSectionTransclusion',
			'var' => 'wmgUseLabeledSectionTransclusion',
			'conflicts' => false,
			'requires' => [],
		],
		'languageselector' => [
			'name' => 'LanguageSelector',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LanguageSelector',
			'var' => 'wmgUseLanguageSelector',
			'conflicts' => false,
			'requires' => [],
		],
		'lastmodified' => [
			'name' => 'Last Modified',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LastModified',
			'var' => 'wmgUseLastModified',
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
		'lingo' => [
			'name' => 'Lingo',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Lingo',
			'var' => 'wmgUseLingo',
			'conflicts' => false,
			'requires' => [],
		],
		'linksuggest' => [
			'name' => 'LinkSuggest',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkSuggest',
			'var' => 'wmgUseLinkSuggest',
			'conflicts' => false,
			'requires' => [],
		],
		'linktarget' => [
			'name' => 'LinkTarget',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkTarget',
			'var' => 'wmgUseLinkTarget',
			'conflicts' => false,
			'requires' => [],
		],
		'linktitles' => [
			'name' => 'LinkTitles',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkTitles',
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
		'linter' => [
			'name' => 'Linter',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Linter',
			'var' => 'wmgUseLinter',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'linter' => "$IP/extensions/Linter/sql/linter.sql"
				],
			],
		],
		'listings' => [
			'name' => 'Listings',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Listings',
			'var' => 'wmgUseListings',
			'conflicts' => false,
			'requires' => [],
		],
		'loopscombo' => [
			'name' => 'Loops',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Loops',
			'var' => 'wmgUseLoopsCombo',
			'conflicts' => false,
			'requires' => [],
		],
		'magicnocache' => [
			'name' => 'MagicNoCache',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MagicNoCache',
			'var' => 'wmgUseMagicNoCache',
			'conflicts' => false,
			'requires' => [],
		],
		'maps' => [
			'name' => 'Maps',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Maps',
			'var' => 'wmgUseMaps',
			'conflicts' => false,
			'requires' => [],
		],
		'mask' => [
			'name' => 'Mask (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Mask',
			'var' => 'wmgUseMask',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'masseditregex' => [
			'name' => 'MassEditRegex',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MassEditRegex',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MassMessage',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Math',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MediaWikiChat',
			'var' => 'wmgUseMediaWikiChat',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'chat' => "$IP/extensions/MediaWikiChat/sql/chat.sql",
					'chat_users' => "$IP/extensions/MediaWikiChat/sql/chat_users.sql"
				],
				'permissions' => [
					'blockedfromchat' => [
						'permissions' => [
							'viewmyprivateinfo',
						],
					],
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
		'medik' => [
			'name' => 'Medik (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Medik',
			'var' => 'wmgUseMedik',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'mermaid' => [
			'name' => 'Mermaid',
			'linkPage' => 'https://www.mediawiki.org/wiki/Extension:Mermaid',
			'var' => 'wmgUseMermaid',
			'conflicts' => false,
			'requires' => [],
		],
		'metrolook' => [
			'name' => 'Metrolook (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Metrolook',
			'var' => 'wmgUseMetrolook',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'mobilefrontend' => [
			'name' => 'MobileFrontend',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MobileFrontend',
			'var' => 'wmgUseMobileFrontend',
			'conflicts' => false,
			'requires' => [],
		],
		'mobiletabsplugin' => [
			'name' => 'MobileTabsPlugin',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MobileTabsPlugin',
			'var' => 'wmgUseMobileTabsPlugin',
			'conflicts' => false,
			'requires' => [],
		],
		'moderation' => [
			'name' => 'Moderation',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Moderation',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Modern_Skylight',
			'var' => 'wmgUseModernSkylight',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'mscalendar' => [
			'name' => 'MsCalendar',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsCalendar',
			'var' => 'wmgUseMSCalendar',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'mscal_content' => "$IP/extensions/MsCalendar/sql/MsCalendar.sql"
				],
			],
		],
		'mscatselect' => [
			'name' => 'MsCatSelect',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsCatSelect',
			'var' => 'wmgUseMsCatSelect',
			'conflicts' => false,
			'requires' => [],
		],
		'mslinks' => [
			'name' => 'MsLinks',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsLinks',
			'var' => 'wmgUseMsLinks',
			'conflicts' => false,
			'requires' => [],
		],
		'msupload' => [
			'name' => 'MsUpload',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsUpload',
			'var' => 'wmgUseMsUpload',
			'conflicts' => false,
			'requires' => [],
		],
		'multimediaviewer' => [
			'name' => 'Multimedia Viewer',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MultimediaViewer',
			'var' => 'wmgUseMultimediaViewer',
			'conflicts' => false,
			'requires' => [],
		],
		'multiboilerplate' => [
			'name' => 'MultiBoilerplate',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MultiBoilerplate',
			'var' => 'wmgUseMultiBoilerplate',
			'conflicts' => false,
			'requires' => [],
		],
		'myvariables' => [
			'name' => 'MyVariables',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MyVariables',
			'var' => 'wmgUseMyVariables',
			'conflicts' => false,
			'requires' => [],
		],
		'newestpages' => [
			'name' => 'NewestPages',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewestPages',
			'var' => 'wmgUseNewestPages',
			'conflicts' => false,
			'requires' => [],
		],
		'newsignuppage' => [
			'name' => 'New Signup Page',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewSignupPage',
			'var' => 'wmgUseNewSignupPage',
			'conflicts' => false,
			'requires' => [],
		],
		'newsletter' => [
			'name' => 'Newsletter',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Newsletter',
			'var' => 'wmgUseNewsletter',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'namespaces' => [
					'Newsletter' => [
						'id' => 5500,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => 'newsletter-manage',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'NewsletterContent',
						'additional' => []
					],
					'Newsletter_talk' => [
						'id' => 5501,
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
							'newsletter-create',
							'newsletter-delete',
							'newsletter-manage',
							'newsletter-restore',
						],
					],
				],
				'sql' => [
					'nl_issues' => "$IP/extensions/Newsletter/sql/nl_issues.sql",
					'nl_newsletters' => "$IP/extensions/Newsletter/sql/nl_newsletters.sql",
					'nl_publishers' => "$IP/extensions/Newsletter/sql/nl_publishers.sql",
					'nl_subscriptions' => "$IP/extensions/Newsletter/sql/nl_subscriptions.sql"
				],
			],
		],
		'newusermessage' => [
			'name' => 'New User Message',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewUserMessage',
			'var' => 'wmgUseNewUserMessage',
			'conflicts' => 'flow',
			'requires' => [],
		],
		'newusernotif' => [
			'name' => 'New User Email Notification',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewUserNotif',
			'var' => 'wmgUseNewUserNotif',
			'conflicts' => false,
			'requires' => [],
		],
		'notitle' => [
			'name' => 'NoTitle',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NoTitle',
			'var' => 'wmgUseNoTitle',
			'conflicts' => false,
			'requires' => [],
		],
		'nukedpl' => [
			'name' => 'NukeDPL',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NukeDPL',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NumberedHeadings',
			'var' => 'wmgUseNumberedHeadings',
			'conflicts' => false,
			'requires' => [],
		],
		'nostalgia' => [
			'name' => 'Nostalgia (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Nostalgia',
			'var' => 'wmgUseNostalgia',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'opengraphmeta' => [
			'name' => 'OpenGraphMeta',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:OpenGraphMeta',
			'var' => 'wmgUseOpenGraphMeta',
			'conflicts' => false,
			'requires' => [],
		],
		'orphanedtalkpages' => [
			'name' => 'OrphanedTalkPages',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:OrphanedTalkPages',
			'var' => 'wmgUseOrphanedTalkPages',
			'conflicts' => false,
			'requires' => [],
		],
		'pagedisqus' => [
			'name' => 'PageDisqus',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageDisqus',
			'var' => 'wmgUsePageDisqus',
			'conflicts' => false,
			'requires' => [
				'permissions' => [
					'managewiki-restricted',
				],
			],
		],
		'pagedtiffhandler' => [
			'name' => 'PagedTiffHandler',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PagedTiffHandler',
			'var' => 'wmgUsePagedTiffHandler',
			'conflicts' => false,
			'requires' => [],
		],
		'pageforms' => [
			'name' => 'Page Forms',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageForms',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageNotice',
			'var' => 'wmgUsePageNotice',
			'conflicts' => false,
			'requires' => [],
		],
		'pagetriage' => [
			'name' => 'Page Triage',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageTriage',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PDFEmbed',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PDFHandler',
			'var' => 'wmgUsePDFHandler',
			'conflicts' => false,
			'requires' => [],
		],
		'pipeescape' => [
			'name' => 'Pipe Escape',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PipeEscape',
			'var' => 'wmgUsePipeEscape',
			'conflicts' => false,
			'requires' => [],
		],
		'pivot' => [
			'name' => 'Pivot (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Pivot',
			'var' => 'wmgUsePivot',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'poem' => [
			'name' => 'Poem',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Poem',
			'var' => 'wmgUsePoem',
			'conflicts' => false,
			'requires' => [],
		],
		'popups' => [
			'name' => 'Popups',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Popups',
			'var' => 'wmgUsePopups',
			'conflicts' => false,
			'requires' => [],
		],
		'pollny' => [
			'name' => 'PollNY',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PollNY',
			'var' => 'wmgUsePollNY',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'socialprofile',
				],
			],
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PortableInfobox',
			'var' => 'wmgUsePortableInfobox',
			'conflicts' => false,
			'requires' => [],
		],
		'preloader' => [
			'name' => 'Preloader',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Preloader',
			'var' => 'wmgUsePreloader',
			'conflicts' => false,
			'install' => [],
			'requires' => [],
		],
		'proofreadpages' => [
			'name' => 'Proofread Pages',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ProofreadPage',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ProtectSite',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Purge',
			'var' => 'wmgUsePurge',
			'conflicts' => false,
			'requires' => [],
		],
		'quiz' => [
			'name' => 'Quiz',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Quiz',
			'var' => 'wmgUseQuiz',
			'conflicts' => false,
			'requires' => [],
		],
		'quizgame' => [
			'name' => 'Quiz Game (SocialProfile)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:QuizGame',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RandomGameUnit',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RandomImage',
			'var' => 'wmgUseRandomImage',
			'conflicts' => false,
			'requires' => [],
		],
		'randomselection' => [
			'name' => 'RandomSelection',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RandomSelection',
			'var' => 'wmgUseRandomSelection',
			'conflicts' => false,
			'requires' => [],
		],
		'refreshed' => [
			'name' => 'Refreshed (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Refreshed',
			'var' => 'wmgUseRefreshed',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'regexfunctions' => [
			'name' => 'RegexFunctions',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RegexFunctions',
			'var' => 'wmgUseRegexFunctions',
			'conflicts' => false,
			'requires' => [],
		],
		'relatedarticles' => [
			'name' => 'Related Articles',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RelatedArticles',
			'var' => 'wmgUseRelatedArticles',
			'conflicts' => false,
			'requires' => [],
		],
		'replacetext' => [
			'name' => 'Replace Text',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ReplaceText',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RevisionSlider',
			'var' => 'wmgUseRevisionSlider',
			'conflicts' => false,
			'requires' => [],
		],
		'rightfunctions' => [
			'name' => 'RightFunctions',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RightFunctions',
			'var' => 'wmgUseRightFunctions',
			'conflicts' => false,
			'requires' => [],
		],
		'rss' => [
			'name' => 'RSS',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RSS',
			'var' => 'wmgUseRSS',
			'conflicts' => false,
			'requires' => [],
		],
		'sandboxlink' => [
			'name' => 'Sandbox Link',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SandboxLink',
			'var' => 'wmgUseSandboxLink',
			'conflicts' => false,
			'requires' => [],
		],
		'score' => [
			'name' => 'Score (Disabled -- See T5863)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Score',
			'var' => 'wmgUseScore',
			'conflicts' => false,
			'requires' => [
				'permissions' => [
					'managewiki-restricted', // T5863
				],
			],
		],
		'scratchblocks' => [
			'name' => 'ScratchBlocks',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ScratchBlocks',
			'var' => 'wmgUseScratchBlocks',
			'conflicts' => false,
			'requires' => [],
		],
		'simpleblogpage' => [
			'name' => 'SimpleBlogPage',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleBlogPage',
			'var' => 'wmgUseSimpleBlogPage',
			'conflicts' => 'blogpage',
			'requires' => [],
			'install' => [
				'namespaces' => [
					'Blog' => [
						'id' => 500,
						'searchable' => 1,
						'subpages' => 1,
						'protection' => 'edit',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
					'Blog_talk' => [
						'id' => 501,
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
					'user' => [
						'permissions' => [
							'createblogpost',
						],
					],
				],
			],
		],
		'simplechanges' => [
			'name' => 'Simple Changes',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleChanges',
			'var' => 'wmgUseSimpleChanges',
			'conflicts' => false,
			'requires' => [],
		],
		'simpletooltip' => [
			'name' => 'Simple Tooltip',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleTooltip',
			'var' => 'wmgUseSimpleTooltip',
			'conflicts' => false,
			'requires' => [],
		],
		'slacknotifications' => [
			'name' => 'SlackNotifications',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SlackNotifications',
			'var' => 'wmgUseSlackNotifications',
			'conflicts' => false,
			'requires' => [
					'permissions' => [
						'managewiki-restricted',
				],
			],
		],
		'softredirector' => [
			'name' => 'SoftRedirector',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SoftRedirector',
			'var' => 'wmgUseSoftRedirector',
			'conflicts' => false,
			'requires' => [],
		 ],
		'socialprofile' => [
			'name' => 'SocialProfile',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SocialProfile',
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
							'avatarremove',
							'editothersprofiles'
						],
					],
				],
			],
		],
		'spoilers' => [
			'name' => 'Spoilers',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Spoilers',
			'var' => 'wmgUseSpoilers',
			'conflicts' => false,
			'requires' => [],
		],
		'spritesheet' => [
			'name' => 'SpriteSheet',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SpriteSheet',
			'var' => 'wmgUseSpriteSheet',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'spritename' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritename.sql",
					'spritename_rev' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritename_rev.sql",
					'spritesheet' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritesheet.sql",
					'spritesheet_rev' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritesheet_rev.sql"

				],
			],
		],
		'stopforumspam' => [
			'name' => 'StopForumSpam',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:StopForumSpam',
			'var' => 'wmgUseStopForumSpam',
			'conflicts' => false,
			'requires' => [],
		],
		'subpagefun' => [
			'name' => 'SubPageFun',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Subpage_Fun',
			'var' => 'wmgUseSubpageFun',
			'conflicts' => false,
			'requires' => [],
		],
		'subpagelist3' => [
			'name' => 'SubPageList3',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SubPageList3',
			'var' => 'wmgUseSubPageList3',
			'conflicts' => false,
			'requires' => [],
		],
		'syntaxhighlight_geshi' => [
			'name' => 'SyntaxHighlight_GeSHi',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SyntaxHighlight_GeSHi',
			'var' => 'wmgUseSyntaxHighlightGeSHi',
			'conflicts' => false,
			'requires' => [],
		],
		'tabscombination' => [
			'name' => 'TabsCombination (Tabber + Tabs)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Tabs',
			'var' => 'wmgUseTabsCombination',
			'conflicts' => false,
			'requires' => [],
		],
		'templatedata' => [
			'name' => 'Template Data',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateData',
			'var' => 'wmgUseTemplateData',
			'conflicts' => false,
			'requires' => [],
		],
		'templatesandbox' => [
			'name' => 'Template Sandbox',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateSandbox',
			'var' => 'wmgUseTemplateSandbox',
			'conflicts' => false,
			'requires' => [],
		],
		'templatestyles' => [
			'name' => 'Template Styles',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateStyles',
			'var' => 'wmgUseTemplateStyles',
			'conflicts' => false,
			'requires' => [],
		],
		'templatewizard' => [
			'name' => 'Template Wizard',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateWizard',
			'var' => 'wmgUseTemplateWizard',
			'conflicts' => false,
			'requires' => [],
		],
		'textextracts' => [
			'name' => 'TextExtracts',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TextExtracts',
			'var' => 'wmgUseTextExtracts',
			'conflicts' => false,
			'requires' => [],
		],
		'theme' => [
			'name' => 'Theme',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Theme',
			'var' => 'wmgUseTheme',
			'conflicts' => false,
			'requires' => [],
		],
		'thanks' => [
			'name' => 'Thanks',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Thanks',
			'var' => 'wmgUseThanks',
			'conflicts' => false,
			'requires' => [],
		],
		'timedmediahandler' => [
			'name' => 'TimedMediaHandler',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TimedMediaHandler',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Timeline',
			'var' => 'wmgUseTimeline',
			'conflicts' => false,
			'requires' => [],
		],
		'titlekey' => [
			'name' => 'TitleKey',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TitleKey',
			'var' => 'wmgUseTitleKey',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'titlekey' => "$IP/extensions/TitleKey/sql/titlekey.sql"
				],
			],
		],
		'toctree' => [
			'name' => 'TOC Tree',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TocTree',
			'var' => 'wmgUseTocTree',
			'conflicts' => false,
			'requires' => [],
		],
		'translate' => [
			'name' => 'Translate',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Translate',
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
				'sql' => [
					'revtag' => "$IP/extensions/Translate/sql/revtag.sql",
					'translate_groupreviews' => "$IP/extensions/Translate/sql/translate_groupreviews.sql",
					'translate_groupstats' => "$IP/extensions/Translate/sql/translate_groupstats.sql",
					'translate_messageindex' => "$IP/extensions/Translate/sql/translate_messageindex.sql",
					'translate_metadata' => "$IP/extensions/Translate/sql/translate_metadata.sql",
					'translate_reviews' => "$IP/extensions/Translate/sql/translate_reviews.sql",
					'translate_sections' => "$IP/extensions/Translate/sql/translate_sections.sql",
					'translate_stash' => "$IP/extensions/Translate/sql/translate_stash.sql",
					'translate_tms' => "$IP/extensions/Translate/sql/translate_tm.sql",
				],
			],
		],
		'translationnotifications' => [
			'name' => 'TranslationNotifications',
			'linkPage' => 'https://www.mediawiki.org/wiki/Extension:TranslationNotifications',
			'var' => 'wmgUseTranslationNotifications',
			'conflicts' => false,
			'install' => [
				'permissions' => [
					'sysop' => [
						'permissions' => [
							'translate-manage',
						],
					],
				],
			],
			'requires' => [
				'extensions' => [
					'massmessage',
					'translate',
				],
			],
		],
		'treeandmenu' => [
			'name' => 'TreeAndMenu',
			'linkPage' => 'https://www.mediawiki.org/wiki/Extension:TreeAndMenu',
			'var' => 'wmgUseTreeAndMenu',
			'conflicts' => false,
			'requires' => [],
		],
		'truglass' => [
			'name' => 'Truglass (Skin)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Truglass',
			'var' => 'wmgUseTruglass',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'tweeki' => [
			'name' => 'Tweeki (Skin) - Note: Causes mobile view not to work!',
			'linkPage' => 'https://www.mediawiki.org/wiki/Skin:Tweeki',
			'var' => 'wmgUseTweeki',
			'conflicts' => false,
			'requires' => [],
			'section' => 'skins',
		],
		'twittertag' => [
			'name' => 'TwitterTag',
			'linkPage' => 'https://www.mediawiki.org/wiki/Extension:TwitterTag',
			'var' => 'wmgUseTwitterTag',
			'conflicts' => false,
			'requires' => [],
		],
		'twocolconflict' => [
			'name' => 'TwoColConflict',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TwoColConflict',
			'var' => 'wmgUseTwoColConflict',
			'conflicts' => false,
			'requires' => [],
		],
		'universallanguageselector' => [
			'name' => 'UniversalLanguageSelector',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UniversalLanguageSelector',
			'var' => 'wmgUseUniversalLanguageSelector',
			'conflicts' => false,
			'requires' => [],
		],
		'uploadslink' => [
			'name' => 'UploadsLink',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UploadsLink',
			'var' => 'wmgUseUploadsLink',
			'conflicts' => false,
			'requires' => [],
		],
		'urlgetparameters' => [
			'name' => 'UrlGetParamters',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UrlGetParameters',
			'var' => 'wmgUseUrlGetParameters',
			'conflicts' => false,
			'requires' => [],
		],
		'userfunctions' => [
			'name' => 'UserFunctions',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UserFunctions',
			'var' => 'wmgUseUserFunctions',
			'conflicts' => false,
			'requires' => [],
		],
		'userwelcome' => [
			'name' => 'UserWelcome',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UserWelcome',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Variables',
			'var' => 'wmgUseVariables',
			'conflicts' => false,
			'requires' => [],
		],
		'veforall' => [
			'name' => 'VEForAll',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VEForAll',
			'var' => 'wmgUseVEForAll',
			'conflicts' => false,
			'requires' => [
				'extensions' => [
					'visualeditor',
				],
			],
		],
		'voteny' => [
			'name' => 'VoteNY',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VoteNY',
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
		'video' => [
			'name' => 'Video',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Video',
			'var' => 'wmgUseVideo',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'oldvideo' => "$IP/extensions/Video/sql/oldvideo.sql",
					'video' => "$IP/extensions/Video/sql/video.sql",
				],
				'permissions' => [
					'user' => [
						'permissions' => [
							'addvideo',
						],
					],
				],
				'namespaces' => [
					'Video' => [
						'id' => 400,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => 'addvideo',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
					'Video_talk' => [
						'id' => 401,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
				],
			],
		],
		'visualeditor' => [
			'name' => 'VisualEditor',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VisualEditor',
			'var' => 'wmgUseVisualEditor',
			'conflicts' => false,
			'requires' => [],
			'help' => 'Will start working 10-20 mins after enabling.',
		],
		'webchat' => [
			'name' => 'WebChat',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WebChat',
			'var' => 'wmgUseWebChat',
			'conflicts' => false,
			'requires' => [],
		],
		'widgets' => [
			'name' => 'Widgets',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Widgets',
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
		'wikibaseclient' => [
			'name' => 'Wikibase (Client)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase',
			'var' => 'wmgUseWikibaseClient',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'wbc_entity_usage' => "$IP/extensions/Wikibase/client/sql/entity_usage.sql",
					'wb_terms' => "$IP/extensions/Wikibase/repo/sql/Wikibase.sql",
					'wb_changes' => "$IP/extensions/Wikibase/repo/sql/changes.sql",
					'wb_changes_dispatch' => "$IP/extensions/Wikibase/repo/sql/changes_dispatch.sql",
					'wb_changes_subscription' => "$IP/extensions/Wikibase/repo/sql/changes_subscription.sql",
					'wb_property_info' => "$IP/extensions/Wikibase/repo/sql/wb_property_info.sql"
				],
				'mwscript' => [
						"$IP/extensions/MirahezeMagic/maintenance/populateWikibaseSitesTable.php" => [],
				],
			],
		],
		'wikibaserepository' => [
			'name' => 'Wikibase (Repository)',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase',
			'var' => 'wmgUseWikibaseRepository',
			'conflicts' => false,
			'requires' => [],
			'install' => [
				'sql' => [
					'wb_changes' => "$IP/extensions/Wikibase/repo/sql/changes.sql",
					'wb_changes_dispatch' => "$IP/extensions/Wikibase/repo/sql/changes_dispatch.sql",
					'wb_changes_subscription' => "$IP/extensions/Wikibase/repo/sql/changes_subscription.sql",
					'wbt_item_terms' => "$IP/extensions/Wikibase/repo/sql/AddNormalizedTermsTablesDDL.sql",
					'wb_terms' => "$IP/extensions/Wikibase/repo/sql/Wikibase.sql",
					'wbt_term_in_lang' => "$IP/extensions/Wikibase/repo/sql/AddNormalizedTermsTablesDDL.sql",
					'wbt_text_in_lang' => "$IP/extensions/Wikibase/repo/sql/AddNormalizedTermsTablesDDL.sql",
					'wbt_text' => "$IP/extensions/Wikibase/repo/sql/AddNormalizedTermsTablesDDL.sql",
					'wbt_type' => "$IP/extensions/Wikibase/repo/sql/AddNormalizedTermsTablesDDL.sql",
					'wb_property_info' => "$IP/extensions/Wikibase/repo/sql/wb_property_info.sql",
					'wbt_property_terms' => "$IP/extensions/Wikibase/repo/sql/AddNormalizedTermsTablesDDL.sql",
				],
				'namespaces' => [
					'Item' => [
						'id' => 860,
						'searchable' => 1,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
					'Item_talk' => [
						'id' => 861,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
					'Property' => [
						'id' => 862,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					],
					'Property_talk' => [
						'id' => 863,
						'searchable' => 0,
						'subpages' => 0,
						'protection' => '',
						'content' => 0,
						'aliases' => [],
						'contentmodel' => 'wikitext',
						'additional' => []
					]
				],
				'settings' => [
					'wmgWikibaseRepoUrl' => 'https://' . $wi->hostname,
					'wmgWikibaseItemNamespaceID' => 860,
					'wmgWikibasePropertyNamespaceID' => 862
				]
			],
			'remove' => [
				'settings' => [
					'wmgWikibaseRepoUrl' => 'https://wikidata.org',
					'wmgWikibaseItemNamespaceID' => 0,
					'wmgWikibasePropertyNamespaceID' => 120
				]
			]
		],
		'wikicategorytagcloud' => [
			'name' => 'WikiCategoryTagCloud',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiCategoryTagCloud',
			'var' => 'wmgUseWikiCategoryTagCloud',
			'conflicts' => false,
			'requires' => [],
		],
		'wikidatapagebanner' => [
			'name' => 'WikidataPageBanner',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikidataPageBanner',
			'var' => 'wmgUseWikidataPageBanner',
			'conflicts' => false,
			'requires' => [],
		],
		'wikiforum' => [
			'name' => 'WikiForum',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiForum',
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
		'wikihiero' => [
			'name' => 'WikiHiero',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiHiero',
			'var' => 'wmgUsewikihiero',
			'conflicts' => false,
			'requires' => [],
		],
		'wikilove' => [
			'name' => 'WikiLove',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiLove',
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
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiSEO',
			'var' => 'wmgUseWikiSeo',
			'conflicts' => false,
			'requires' => [],
		],
		'wikitextloggedinout' => [
			'name' => 'WikiText Logged In Out',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiTextLoggedInOut',
			'var' => 'wmgUseWikiTextLoggedInOut',
			'conflicts' => false,
			'requires' => [],
		],
		'wikimediaincubator' => [
			'name' => 'WikimediaIncubator',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikimediaIncubator',
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
