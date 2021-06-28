<?php
/**
 * ManageWiki extensions and skins are added using the variable below.
 *
 * name: the displayed name of the setting on Special:ManageWikiExtensions.
 * linkPage: full url for an information page for the extension.
 * var: the relevant var that enables the extension.
 * conflicts: string of extensions that cause this extension to not work.
 * requires: an array. See below for available options.
 * install: an array. See below for available options.
 * remove: an array. See install for available options.
 * section: string name of groupings for extension.
 *
 * 'requires' can be one of:
 *
 * activeusers: max integer amount of active users a wiki may have in order to enable this extension.
 * articles: max integer amount of articles a wiki may have in order to enable this extension.
 * extensions: array of other extensions that must be enabled in order to enable this extension.
 * pages: max integer amount of pages a wiki may have in order to enable this extension.
 * permissions: array of permissions a user must have to be able to enable this extension. Regardless of this value, a user must always have the managewiki permission.
 * visibility['state']: can be either 'private' or 'public'. If set to 'private' this extension can only be enabled on private wikis. If set to 'public' it can only be enabled on public wikis.
 *
 * 'install'/'remove' can be one of:
 *
 * files: array, mapped to location => source.
 * mwscript: array, mapped to script path => array of options.
 * namespaces: array of which namespaces and namespace data to install with extension; 'remove' only needs namespace ID.
 * permissions: array of which permissions to install with extension.
 * settings: array of ManageWikiSettings to modify when the extension is enabled, mapped variable => value.
 * sql: array of sql files to install with extension, mapped table name => sql file path.
 */

$wgManageWikiExtensions = [
	// API
	'gettingstarted' => [
		'name' => 'GettingStarted',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GettingStarted',
		'var' => 'wmgUseGettingStarted',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'guidedtour',
			],
		],
		'section' => 'api',
	],
	'pageimages' => [
		'name' => 'Page Images',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageImages',
		'var' => 'wmgUsePageImages',
		'conflicts' => false,
		'requires' => [],
		'section' => 'api',
	],
	'shortdescription' => [
		'name' => 'ShortDescription',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ShortDescription',
		'var' => 'wmgUseShortDescription',
		'conflicts' => false,
		'requires' => [],
		'section' => 'api',
	],

	// Editors
	'codeeditor' => [
		'name' => 'CodeEditor',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CodeEditor',
		'var' => 'wmgUseCodeEditor',
		'conflicts' => false,
		'requires' => [],
		'section' => 'editors',
	],
	'codemirror' => [
		'name' => 'CodeMirror',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CodeMirror',
		'var' => 'wmgUseCodeMirror',
		'conflicts' => false,
		'requires' => [],
		'section' => 'editors',
	],
	'visualeditor' => [
		'name' => 'VisualEditor',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VisualEditor',
		'var' => 'wmgUseVisualEditor',
		'conflicts' => false,
		'requires' => [],
		'section' => 'editors',
	],

	// Media handlers
	'3d' => [
		'name' => '3D',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:3D',
		'var' => 'wmgUse3D',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'settings' => [
				'wgFileExtensions' => array_merge( $wgFileExtensions, [ 'stl' ] ),
			],
		],
		'section' => 'mediahandlers',
	],
	'pagedtiffhandler' => [
		'name' => 'PagedTiffHandler',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PagedTiffHandler',
		'var' => 'wmgUsePagedTiffHandler',
		'conflicts' => false,
		'requires' => [],
		'section' => 'mediahandlers',
	],
	'pdfhandler' => [
		'name' => 'Pdf Handler',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PdfHandler',
		'var' => 'wmgUsePdfHandler',
		'conflicts' => false,
		'requires' => [],
		'section' => 'mediahandlers',
	],
	'timedmediahandler' => [
		'name' => 'TimedMediaHandler',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TimedMediaHandler',
		'var' => 'wmgUseTimedMediaHandler',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'transcode' => "$IP/extensions/TimedMediaHandler/sql/tables-generated.sql"
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
		'section' => 'mediahandlers',
	],

	// Parser hooks
	'htmlmetaadntitle' => [
		'name' => 'Add HTML Meta and Title',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Add_HTML_Meta_and_Title',
		'var' => 'wmgUseAddHTMLMetaAndTitle',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
	],
	'arrays' => [
		'name' => 'Arrays',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Arrays',
		'var' => 'wmgUseArrays',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'babel' => [
		'name' => 'Babel',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Babel',
		'var' => 'wmgUseBabel',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'babel' => "$IP/extensions/Babel/sql/tables-generated.sql"
			],
		],
		'section' => 'parserhooks',
	],
	'calendar-wikivoyage' => [
		'name' => 'Calendar-Wikivoyage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Calendar-Wikivoyage',
		'var' => 'wmgUseCalendarWikivoyage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
	],
	'categorytree' => [
		'name' => 'CategoryTree',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategoryTree',
		'var' => 'wmgUseCategoryTree',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'parserhooks',
	],
	'charinsert' => [
		'name' => 'CharInsert',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CharInsert',
		'var' => 'wmgUseCharInsert',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'cite' => [
		'name' => 'Cite',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Cite',
		'var' => 'wmgUseCite',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'commentstreams' => [
		'name' => 'CommentStreams',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CommentStreams',
		'var' => 'wmgUseCommentStreams',
		'conflicts' => 'moderation',
		'requires' => [],
		'install' => [
			'sql' => [
				'commentData' => "$IP/extensions/CommentStreams/sql/commentData.sql",
				'votes' => "$IP/extensions/CommentStreams/sql/votes.sql",
				'watch' => "$IP/extensions/CommentStreams/sql/watch.sql",
			],
		],
		'section' => 'parserhooks',
	],
	'comments' => [
		'name' => 'Comments',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Comments',
		'var' => 'wmgUseComments',
		'conflicts' => 'protectionindicator',
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
		'section' => 'parserhooks',
	],
	'countdownclock' => [
		'name' => 'CountDownClock',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CountDownClock',
		'var' => 'wmgUseCountDownClock',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'createpage' => [
		'name' => 'Create Page',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Create_Page',
		'var' => 'wmgUseCreatePage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'css' => [
		'name' => 'CSS',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CSS',
		'var' => 'wmgUseCSS',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'displaytitle' => [
		'name' => 'Display Title',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Display_Title',
		'var' => 'wmgUseDisplayTitle',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'dplforum' => [
		'name' => 'DPLForum',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DPLforum',
		'var' => 'wmgUseDPLForum',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'dummyfandoommainpagetags' => [
		'name' => 'DummyFandoomMainpageTags',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DummyFandoomMainpageTags',
		'var' => 'wmgUseDummyFandoomMainpageTags',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'dynamicpagelist' => [
		'name' => 'DynamicPageList',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicPageList_(Wikimedia)',
		'var' => 'wmgUseDynamicPageList',
		'conflicts' => 'dynamicpagelist3',
		'requires' => [],
		'section' => 'parserhooks',
	],
	'dynamicpagelist3' => [
		'name' => 'DynamicPageList3',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicPageList3',
		'var' => 'wmgUseDynamicPageList3',
		'conflicts' => 'dynamicpagelist',
		'requires' => [],
		'install' => [
			'mwscript' => [
				"$IP/extensions/DynamicPageList3/maintenance/createTemplate.php" => [],
			],
		],
		'section' => 'parserhooks',
	],
	'timeline' => [
		'name' => 'EasyTimeline',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:EasyTimeline',
		'var' => 'wmgUseTimeline',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'genealogy' => [
		'name' => 'Genealogy',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Genealogy',
		'var' => 'wmgUseGenealogy',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'geocrumbs' => [
		'name' => 'GeoCrumbs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GeoCrumbs',
		'var' => 'wmgUseGeoCrumbs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'geogebra' => [
		'name' => 'GeoGebra',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GeoGebra',
		'var' => 'wmgUseGeoGebra',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'googledocs4mw' => [
		'name' => 'GoogleDocs4MW',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GoogleDocs4MW',
		'var' => 'wmgUseGoogleDocs4MW',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'graph' => [
		'name' => 'Graph',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Graph',
		'var' => 'wmgUseGraph',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'jsonconfig',
				'codeeditor',
			],
		],
		'section' => 'parserhooks',
	],
	'groupssidebar' => [
		'name' => 'GroupsSidebar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GroupsSidebar',
		'var' => 'wmgUseGroupsSidebar',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'headertabs' => [
		'name' => 'Header Tabs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Header_Tabs',
		'var' => 'wmgUseHeaderTabs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'imagemap' => [
		'name' => 'ImageMap',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ImageMap',
		'var' => 'wmgUseImageMap',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'inputbox' => [
		'name' => 'InputBox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:InputBox',
		'var' => 'wmgUseInputBox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'javascriptslideshow' => [
		'name' => 'Javascript Slideshow',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JavascriptSlideshow',
		'var' => 'wmgUseJavascriptSlideshow',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'josa' => [
		'name' => 'Josa',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Josa',
		'var' => 'wmgUseJosa',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'jscalendar' => [
		'name' => 'JsCalendar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JsCalendar',
		'var' => 'wmgUseJsCalendar',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'kartographer' => [
		'name' => 'Kartographer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Kartographer',
		'var' => 'wmgUseKartographer',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'jsonconfig',
			],
		],
		'section' => 'parserhooks',
	],
	'labeledsectiontransclusion' => [
		'name' => 'Labeled Section Transclusion',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Labeled_Section_Transclusion',
		'var' => 'wmgUseLabeledSectionTransclusion',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'lingo' => [
		'name' => 'Lingo',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Lingo',
		'var' => 'wmgUseLingo',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
	],
	'listings' => [
		'name' => 'Listings',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Listings',
		'var' => 'wmgUseListings',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'logofunctions' => [
		'name' => 'LogoFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LogoFunctions',
		'var' => 'wmgUseLogoFunctions',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'loopscombo' => [
		'name' => 'Loops',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Loops',
		'var' => 'wmgUseLoopsCombo',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'magicnocache' => [
		'name' => 'MagicNoCache',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MagicNoCache',
		'var' => 'wmgUseMagicNoCache',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'maps' => [
		'name' => 'Maps',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Maps',
		'var' => 'wmgUseMaps',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'namespaces' => [
				'GeoJson' => [
					'id' => 420,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 1,
					'aliases' => [],
					'contentmodel' => 'GeoJson',
					'additional' => []
				],
				'GeoJson_talk' => [
					'id' => 421,
					'searchable' => 0,
					'subpages' => 1,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
			],
		],
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
	],
	'mermaid' => [
		'name' => 'Mermaid',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Mermaid',
		'var' => 'wmgUseMermaid',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'mscalendar' => [
		'name' => 'MsCalendar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsCalendar',
		'var' => 'wmgUseMsCalendar',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'mscal_content' => "$IP/extensions/MsCalendar/sql/MsCalendar.sql"
			],
		],
		'section' => 'parserhooks',
	],
	'mscatselect' => [
		'name' => 'MsCatSelect',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsCatSelect',
		'var' => 'wmgUseMsCatSelect',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'mslinks' => [
		'name' => 'MsLinks',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsLinks',
		'var' => 'wmgUseMsLinks',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'msupload' => [
		'name' => 'MsUpload',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsUpload',
		'var' => 'wmgUseMsUpload',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'myvariables' => [
		'name' => 'MyVariables',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MyVariables',
		'var' => 'wmgUseMyVariables',
		'conflicts' => 'approvedrevs',
		'requires' => [],
		'section' => 'parserhooks',
	],
	'notitle' => [
		'name' => 'NoTitle',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NoTitle',
		'var' => 'wmgUseNoTitle',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'numberedheadings' => [
		'name' => 'NumberedHeadings',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NumberedHeadings',
		'var' => 'wmgUseNumberedHeadings',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'opengraphmeta' => [
		'name' => 'OpenGraphMeta',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:OpenGraphMeta',
		'var' => 'wmgUseOpenGraphMeta',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'pdfbook' => [
		'name' => 'PdfBook',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PdfBook',
		'var' => 'wmgUsePdfBook',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
	],
	'pipeescape' => [
		'name' => 'Pipe Escape',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Pipe_Escape',
		'var' => 'wmgUsePipeEscape',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'poem' => [
		'name' => 'Poem',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Poem',
		'var' => 'wmgUsePoem',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'portableinfobox' => [
		'name' => 'PortableInfobox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PortableInfobox',
		'var' => 'wmgUsePortableInfobox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'preloader' => [
		'name' => 'Preloader',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Preloader',
		'var' => 'wmgUsePreloader',
		'conflicts' => false,
		'install' => [],
		'requires' => [],
		'section' => 'parserhooks',
	],
	'quiz' => [
		'name' => 'Quiz',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Quiz',
		'var' => 'wmgUseQuiz',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
	],
	'randomimage' => [
		'name' => 'RandomImage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RandomImage',
		'var' => 'wmgUseRandomImage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'randomselection' => [
		'name' => 'RandomSelection',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RandomSelection',
		'var' => 'wmgUseRandomSelection',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'regexfunctions' => [
		'name' => 'RegexFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RegexFunctions',
		'var' => 'wmgUseRegexFunctions',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'rightfunctions' => [
		'name' => 'RightFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RightFunctions',
		'var' => 'wmgUseRightFunctions',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'rss' => [
		'name' => 'RSS',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RSS',
		'var' => 'wmgUseRSS',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'score' => [
		'name' => 'Score (Disabled -- See T5863)',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Score',
		'var' => 'wmgUseScore',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'section' => 'parserhooks',
	],
	'scratchblocks' => [
		'name' => 'ScratchBlocks4',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ScratchBlocks',
		'var' => 'wmgUseScratchBlocks',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'simpletooltip' => [
		'name' => 'Simple Tooltip',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleTooltip',
		'var' => 'wmgUseSimpleTooltip',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'snapprojectembed' => [
		'name' => 'Snap! Project Embed',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SnapProjectEmbed',
		'var' => 'wmgUseSnapProjectEmbed',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'spoilers' => [
		'name' => 'Spoilers',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Spoilers',
		'var' => 'wmgUseSpoilers',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'subpagefun' => [
		'name' => 'SubPageFun',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Subpage_Fun',
		'var' => 'wmgUseSubpageFun',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'subpagelist3' => [
		'name' => 'SubPageList3',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SubPageList3',
		'var' => 'wmgUseSubPageList3',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'syntaxhighlight_geshi' => [
		'name' => 'SyntaxHighlight',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SyntaxHighlight',
		'var' => 'wmgUseSyntaxHighlightGeSHi',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'tabber' => [
		'name' => 'Tabber',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Tabber',
		'var' => 'wmgUseTabber',
		'conflicts' => 'tabberneue',
		'requires' => [],
		'section' => 'parserhooks',
	],
	'tabberneue' => [
		'name' => 'TabberNeue',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TabberNeue',
		'var' => 'wmgUseTabberNeue',
		'conflicts' => 'tabber',
		'requires' => [],
		'section' => 'parserhooks',
	],
	'tabs' => [
		'name' => 'Tabs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Tabs',
		'var' => 'wmgUseTabs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'templatedata' => [
		'name' => 'Template Data',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateData',
		'var' => 'wmgUseTemplateData',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'templatestyles' => [
		'name' => 'Template Styles',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateStyles',
		'var' => 'wmgUseTemplateStyles',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'toctree' => [
		'name' => 'TOC Tree',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TocTree',
		'var' => 'wmgUseTocTree',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'treeandmenu' => [
		'name' => 'TreeAndMenu',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TreeAndMenu',
		'var' => 'wmgUseTreeAndMenu',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'twittertag' => [
		'name' => 'TwitterTag',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TwitterTag',
		'var' => 'wmgUseTwitterTag',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'urlgetparameters' => [
		'name' => 'UrlGetParameters',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UrlGetParameters',
		'var' => 'wmgUseUrlGetParameters',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'userfunctions' => [
		'name' => 'UserFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UserFunctions',
		'var' => 'wmgUseUserFunctions',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
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
		'section' => 'parserhooks',
	],
	'wikicategorytagcloud' => [
		'name' => 'WikiCategoryTagCloud',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiCategoryTagCloud',
		'var' => 'wmgUseWikiCategoryTagCloud',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'wikihiero' => [
		'name' => 'WikiHiero',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiHiero',
		'var' => 'wmgUsewikihiero',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'wikiseo' => [
		'name' => 'WikiSEO',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiSEO',
		'var' => 'wmgUseWikiSeo',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'wikitextloggedinout' => [
		'name' => 'WikiText Logged In Out',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiTextLoggedInOut',
		'var' => 'wmgUseWikiTextLoggedInOut',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'youtube' => [
		'name' => 'YouTube',
		'linkPage' => 'https://github.com/miraheze/YouTube',
		'var' => 'wmgUseYouTube',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],

	// Spam prevention
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
		'section' => 'antispam',
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
		'section' => 'antispam',
	],
	'stopforumspam' => [
		'name' => 'StopForumSpam',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:StopForumSpam',
		'var' => 'wmgUseStopForumSpam',
		'conflicts' => false,
		'requires' => [],
		'section' => 'antispam',
	],

	// Special pages
	'adminlinks' => [
		'name' => 'Admin Links',
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
		'section' => 'specialpages',
	],
	'citethispage' => [
		'name' => 'CiteThisPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CiteThisPage',
		'var' => 'wmgUseCiteThisPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'collection' => [
		'name' => 'Collection + Electron (PDF)',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Collection',
		'var' => 'wmgUseCollection',
		'conflicts' => false,
		'requires' => [
			'visibility' => [
				'state' => 'public',
			],
		],
		'section' => 'specialpages',
	],
	'contactpage' => [
		'name' => 'ContactPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ContactPage',
		'var' => 'wmgUseContactPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'contributionscores' => [
		'name' => 'Contribution Scores',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Contribution_Scores',
		'var' => 'wmgUseContributionScores',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'createpageuw' => [
		'name' => 'CreatePageUw',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreatePageUw',
		'var' => 'wmgUseCreatePageUw',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'createredirect' => [
		'name' => 'CreateRedirect',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreateRedirect',
		'var' => 'wmgUseCreateRedirect',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'datatransfer' => [
		'name' => 'Data Transfer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Data_Transfer',
		'var' => 'wmgUseDataTransfer',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
		'install' => [
			'permissions' => [
				'sysop' => [
					'permissions' => [
						'datatransferimport',
					]
				]
			],
		],
	],
	'editcount' => [
		'name' => 'EditCount',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Editcount',
		'var' => 'wmgUseEditcount',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
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
		'section' => 'specialpages',
	],
	'googlenewssitemap' => [
		'name' => 'GoogleNewsSitemap',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GoogleNewsSitemap',
		'var' => 'wmgUseGoogleNewsSitemap',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
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
		'section' => 'specialpages',
	],
	'linter' => [
		'name' => 'Linter',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Linter',
		'var' => 'wmgUseLinter',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'linter' => "$IP/extensions/Linter/sql/tables-generated.sql"
			],
		],
		'section' => 'specialpages',
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
		'section' => 'specialpages',
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
		'section' => 'specialpages',
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
		'section' => 'specialpages',
	],
	'newestpages' => [
		'name' => 'Newest Pages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Newest_Pages',
		'var' => 'wmgUseNewestPages',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
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
		'section' => 'specialpages',
	],
	'orphanedtalkpages' => [
		'name' => 'OrphanedTalkPages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:OrphanedTalkPages',
		'var' => 'wmgUseOrphanedTalkPages',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'pageforms' => [
		'name' => 'Page Forms',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Page_Forms',
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
		'section' => 'specialpages',
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
		'section' => 'specialpages',
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
		'section' => 'specialpages',
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
		'section' => 'specialpages',
	],
	'replacetext' => [
		'name' => 'Replace Text',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Replace_Text',
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
		'section' => 'specialpages',
	],
	'report' => [
		'name' => 'Report',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Report',
		'var' => 'wmgUseReport',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'report_reports' => "$IP/extensions/Report/sql/table.sql",
			],
			'permissions' => [
				'user' => [
					'permissions' => [
						'report',
					],
				],
				'sysop' => [
					'permissions' => [
						'handle-reports',
					],
				],
			],
		],
		'section' => 'specialpages',
	],
	'simplechanges' => [
		'name' => 'Simple Changes',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleChanges',
		'var' => 'wmgUseSimpleChanges',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'templatesandbox' => [
		'name' => 'Template Sandbox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateSandbox',
		'var' => 'wmgUseTemplateSandbox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'timemachine' => [
		'name' => 'TimeMachine',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TimeMachine',
		'var' => 'wmgUseTimeMachine',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'translate' => [
		'name' => 'Translate',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Translate',
		'var' => 'wmgUseTranslate',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'universallanguageselector',
			],
		],
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
						'translate-messagereview',
					],
				],
			],
			'sql' => [
				'revtag' => "$IP/extensions/Translate/sql/revtag.sql",
				'translate_cache' => "$IP/extensions/Translate/sql/translate_cache.sql",
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
		'section' => 'specialpages',
	],
	'translationnotifications' => [
		'name' => 'TranslationNotifications',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TranslationNotifications',
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
		'section' => 'specialpages',
	],
	'urlshortener' => [
		'name' => 'UrlShortener',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UrlShortener',
		'var' => 'wmgUseUrlShortener',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'permissions' => [
				'sysop' => [
					'permissions' => [
						'urlshortener-create-url',
						'urlshortener-manage-url',
						'urlshortener-view-log',
					],
				],
			],
		],
		'section' => 'specialpages',
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
		'section' => 'specialpages',
	],
	'webchat' => [
		'name' => 'WebChat',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WebChat',
		'var' => 'wmgUseWebChat',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],

	// Skins
	'apex' => [
		'name' => 'Apex',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Apex',
		'var' => 'wmgUseApex',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'bluesky' => [
		'name' => 'BlueSky',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:BlueSky',
		'var' => 'wmgUseBlueSky',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'chameleon' => [
		'name' => 'Chameleon',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Chameleon',
		'var' => 'wmgUseChameleon',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'citizen' => [
		'name' => 'Citizen',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Citizen',
		'var' => 'wmgUseCitizen',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'cosmos' => [
		'name' => 'Cosmos',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Cosmos',
		'var' => 'wmgUseCosmos',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'dusktodawn' => [
		'name' => 'DuskToDawn',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:DuskToDawn',
		'var' => 'wmgUseDuskToDawn',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'erudite' => [
		'name' => 'Erudite',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Erudite',
		'var' => 'wmgUseErudite',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'femiwiki' => [
		'name' => 'Femiwiki',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Femiwiki',
		'var' => 'wmgUseFemiwiki',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'foreground' => [
		'name' => 'Foreground',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Foreground',
		'var' => 'wmgUseForeground',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'gamepress' => [
		'name' => 'Gamepress',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Gamepress',
		'var' => 'wmgUseGamepress',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'hassomecolours' => [
		'name' => 'HasSomeColours',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:HasSomeColours',
		'var' => 'wmgUseHasSomeColours',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'liberty' => [
		'name' => 'Liberty',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Liberty',
		'var' => 'wmgUseLiberty',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'mask' => [
		'name' => 'Mask',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Mask',
		'var' => 'wmgUseMask',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'medik' => [
		'name' => 'Medik',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Medik',
		'var' => 'wmgUseMedik',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'metrolook' => [
		'name' => 'Metrolook',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Metrolook',
		'var' => 'wmgUseMetrolook',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'minervaneue' => [
		'name' => 'MinervaNeue',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Minerva_Neue',
		'var' => 'wmgUseMinervaNeue',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'monaco' => [
		'name' => 'Monaco',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Monaco',
		'var' => 'wmgUseMonaco',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'nimbus' => [
		'name' => 'Nimbus',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Nimbus',
		'var' => 'wmgUseNimbus',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'nostalgia' => [
		'name' => 'Nostalgia',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Nostalgia',
		'var' => 'wmgUseNostalgia',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'pivot' => [
		'name' => 'Pivot',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Pivot',
		'var' => 'wmgUsePivot',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'refreshed' => [
		'name' => 'Refreshed',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Refreshed',
		'var' => 'wmgUseRefreshed',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'snapwikiskin' => [
		'name' => 'Snap!',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Snap!_Wiki_Skin',
		'var' => 'wmgUseSnapWikiSkin',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'truglass' => [
		'name' => 'Truglass',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Truglass',
		'var' => 'wmgUseTruglass',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'tweeki' => [
		'name' => 'Tweeki',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Tweeki',
		'var' => 'wmgUseTweeki',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],

	// Other
	'addthis' => [
		'name' => 'AddThis',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AddThis',
		'var' => 'wmgUseAddThis',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'advancedsearch' => [
		'name' => 'AdvancedSearch',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AdvancedSearch',
		'var' => 'wmgUseAdvancedSearch',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
	],
	'articletocategory2' => [
		'name' => 'Article To Category 2',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ArticleToCategory2',
		'var' => 'wmgUseArticleToCategory2',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'autocreatecategorypages' => [
		'name' => 'Auto Create Category Pages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Auto_Create_Category_Pages',
		'var' => 'wmgUseAutoCreateCategoryPages',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'section' => 'other',
	],
	'autocreatepages' => [
		'name' => 'Auto Create Pages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AutoCreatePage',
		'var' => 'wmgUseAutoCreatePage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
	],
	'capiunto' => [
		'name' => 'Capiunto',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Capiunto',
		'var' => 'wmgUseCapiunto',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'categorysortheaders' => [
		'name' => 'CategorySortHeaders',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategorySortHeaders',
		'var' => 'wmgUseCategorySortHeaders',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'other',
	],
	'citoid' => [
		'name' => 'Citoid',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Citoid',
		'var' => 'wmgUseCitoid',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'cite',
				'visualeditor',
			],
			'visibility' => [
				'state' => 'public',
			],
		],
		'section' => 'other',
	],
	'cleanchanges' => [
		'name' => 'CleanChanges',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CleanChanges',
		'var' => 'wmgUseCleanChanges',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'collapsiblevector' => [
		'name' => 'Collapsible Vector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CollapsibleVector',
		'var' => 'wmgUseCollapsibleVector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'commentbox' => [
		'name' => 'Commentbox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Commentbox',
		'var' => 'wmgUseCommentbox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'commonsmetadata' => [
		'name' => 'CommonsMetadata',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CommonsMetadata',
		'var' => 'wmgUseCommonsMetadata',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'darkmode' => [
		'name' => 'DarkMode',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DarkMode',
		'var' => 'wmgUseDarkMode',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'deleteuserpages' => [
		'name' => 'DeleteUserPages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DeleteUserPages',
		'var' => 'wmgUseDeleteUserPages',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'other',
	],
	'description2' => [
		'name' => 'Description2',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Description2',
		'var' => 'wmgUseDescription2',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'disambiguator' => [
		'name' => 'Disambiguator',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Disambiguator',
		'var' => 'wmgUseDisambiguator',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'discussiontools' => [
		'name' => 'DiscussionTools',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DiscussionTools',
		'var' => 'wmgUseDiscussionTools',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'linter',
				'visualeditor',
			],
		],
		'section' => 'other',
	],
	'dynamicsidebar' => [
		'name' => 'DynamicSidebar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicSidebar',
		'var' => 'wmgUseDynamicSidebar',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'editnotify' => [
		'name' => 'EditNotify',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:EditNotify',
		'var' => 'wmgUseEditNotify',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'editsubpages' => [
		'name' => 'Edit Subpages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:EditSubpages',
		'var' => 'wmgUseEditSubpages',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'other',
	],
	'fancyboxthumbs' => [
		'name' => 'Fancy Box Thumbs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:FancyBoxThumbs',
		'var' => 'wmgUseFancyBoxThumbs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
	],
	'fontawesome' => [
		'name' => 'FontAwesome',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:FontAwesome',
		'var' => 'wmgUseFontAwesome',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'gadgets' => [
		'name' => 'Gadgets',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Gadgets',
		'var' => 'wmgUseGadgets',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
	],
	'globaluserpage' => [
		'name' => 'GlobalUserPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GlobalUserPage',
		'var' => 'wmgUseGlobalUserPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'guidedtour' => [
		'name' => 'GuidedTour',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GuidedTour',
		'var' => 'wmgUseGuidedTour',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'hawelcome' => [
		'name' => 'HAWelcome',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HAWelcome',
		'var' => 'wmgUseHAWelcome',
		'conflicts' => false,
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
		'section' => 'other',
	],
	'headerfooter' => [
		'name' => 'Header Footer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Header_Footer',
		'var' => 'wmgUseHeaderFooter',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'hidesection' => [
		'name' => 'HideSection',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HideSection',
		'var' => 'wmgUseHideSection',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'highlightlinksincategory' => [
		'name' => 'Highlight Links In Category',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Highlight_Links_in_Category',
		'var' => 'wmgUseHighlightLinksInCategory',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'jsbreadcrumbs' => [
		'name' => 'JS BreadCrumbs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JSBreadCrumbs',
		'var' => 'wmgUseJSBreadCrumbs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'jsonconfig' => [
		'name' => 'JsonConfig',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JsonConfig',
		'var' => 'wmgUseJsonConfig',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'languageselector' => [
		'name' => 'LanguageSelector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LanguageSelector',
		'var' => 'wmgUseLanguageSelector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'lastmodified' => [
		'name' => 'Last Modified',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LastModified',
		'var' => 'wmgUseLastModified',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'linksuggest' => [
		'name' => 'LinkSuggest',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkSuggest',
		'var' => 'wmgUseLinkSuggest',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'linktarget' => [
		'name' => 'LinkTarget',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkTarget',
		'var' => 'wmgUseLinkTarget',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'mobilefrontend' => [
		'name' => 'MobileFrontend',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MobileFrontend',
		'var' => 'wmgUseMobileFrontend',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'minervaneue',
			],
		],
		'section' => 'other',
	],
	'mobiletabsplugin' => [
		'name' => 'MobileTabsPlugin',
		'linkPage' => 'https://github.com/fuerthwiki/MobileTabsPlugin',
		'var' => 'wmgUseMobileTabsPlugin',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'multimediaviewer' => [
		'name' => 'Multimedia Viewer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MultimediaViewer',
		'var' => 'wmgUseMultimediaViewer',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'multiboilerplate' => [
		'name' => 'MultiBoilerplate',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MultiBoilerplate',
		'var' => 'wmgUseMultiBoilerplate',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'newsignuppage' => [
		'name' => 'New Signup Page',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewSignupPage',
		'var' => 'wmgUseNewSignupPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
	],
	'newusermessage' => [
		'name' => 'New User Message',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewUserMessage',
		'var' => 'wmgUseNewUserMessage',
		'conflicts' => 'flow',
		'requires' => [],
		'section' => 'other',
	],
	'newusernotif' => [
		'name' => 'New User Email Notification',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:New_User_Email_Notification',
		'var' => 'wmgUseNewUserNotif',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'pageassessments' => [
		'name' => 'PageAssessments',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageAssessments',
		'var' => 'wmgUsePageAssessments',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'page_assessments' => "$IP/extensions/PageAssessments/db/addReviewsTable.sql",
				'page_assessments_projects' => "$IP/extensions/PageAssessments/db/addProjectsTable.sql"
			],
		],
		'section' => 'other',
	],
	'pagenotice' => [
		'name' => 'Page Notice',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageNotice',
		'var' => 'wmgUsePageNotice',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'twocolconflict' => [
		'name' => 'Paragraph-based Edit Conflict Interface',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Paragraph-based_Edit_Conflict_Interface',
		'var' => 'wmgUseTwoColConflict',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'popups' => [
		'name' => 'Popups',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Popups',
		'var' => 'wmgUsePopups',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'pageimages',
				'textextracts',
			],
		],
		'section' => 'other',
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
		'section' => 'other',
	],
	'proofreadpages' => [
		'name' => 'Proofread Page',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Proofread_Page',
		'var' => 'wmgUseProofreadPage',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'pr_index' => "$IP/extensions/ProofreadPage/sql/tables-generated.sql"
			],
			'namespaces' => [
				'Page' => [
					'id' => 250,
					'searchable' => 1,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'proofread-page',
					'additional' => []
				],
				'Page_talk' => [
					'id' => 251,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Index' => [
					'id' => 252,
					'searchable' => 1,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'proofread-index',
					'additional' => []
				],
				'Index_talk' => [
					'id' => 253,
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
		'section' => 'other',
	],
	'protectionindicator' => [
		'name' => 'ProtectionIndicator',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ProtectionIndicator',
		'var' => 'wmgUseProtectionIndicator',
		'conflicts' => 'comments',
		'install' => [],
		'requires' => [],
		'section' => 'other',
	],
	'purge' => [
		'name' => 'Purge',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Purge',
		'var' => 'wmgUsePurge',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'permissions' => [
				'user' => [
					'permissions' => [
						'purge',
					],
				],
			],
		],
		'section' => 'other',
	],
	'relatedarticles' => [
		'name' => 'Related Articles',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RelatedArticles',
		'var' => 'wmgUseRelatedArticles',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'revisionslider' => [
		'name' => 'RevisionSlider',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RevisionSlider',
		'var' => 'wmgUseRevisionSlider',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'sandboxlink' => [
		'name' => 'Sandbox Link',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SandboxLink',
		'var' => 'wmgUseSandboxLink',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'simpleblogpage' => [
		'name' => 'SimpleBlogPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleBlogPage',
		'var' => 'wmgUseSimpleBlogPage',
		'conflicts' => 'blogpage',
		'requires' => [],
		'install' => [
			'namespaces' => [
				'User_blog' => [
					'id' => 502,
					'searchable' => 1,
					'subpages' => 1,
					'protection' => 'edit',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'User_blog_talk' => [
					'id' => 503,
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
		'section' => 'other',
	],
	'slacknotifications' => [
		'name' => 'SlackNotifications',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SlackNotifications',
		'var' => 'wmgUseSlackNotifications',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'softredirector' => [
		'name' => 'SoftRedirector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SoftRedirector',
		'var' => 'wmgUseSoftRedirector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
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
		'section' => 'other',
	],
	'flow' => [
		'name' => 'StructuredDiscussions (Flow)',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:StructuredDiscussions',
		'var' => 'wmgUseFlow',
		'conflicts' => false,
		'requires' => [],
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
		'section' => 'other',
	],
	'templatewizard' => [
		'name' => 'Template Wizard',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateWizard',
		'var' => 'wmgUseTemplateWizard',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'templatedata',
			],
		],
		'section' => 'other',
	],
	'textextracts' => [
		'name' => 'TextExtracts',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TextExtracts',
		'var' => 'wmgUseTextExtracts',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'theme' => [
		'name' => 'Theme',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Theme',
		'var' => 'wmgUseTheme',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'thanks' => [
		'name' => 'Thanks',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Thanks',
		'var' => 'wmgUseThanks',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
	],
	'universallanguageselector' => [
		'name' => 'UniversalLanguageSelector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UniversalLanguageSelector',
		'var' => 'wmgUseUniversalLanguageSelector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'uploadslink' => [
		'name' => 'UploadsLink',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UploadsLink',
		'var' => 'wmgUseUploadsLink',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'userpageeditprotection' => [
		'name' => 'UserPageEditProtection',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UserPageEditProtection',
		'var' => 'wmgUseUserPageEditProtection',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'permissions' => [
				'sysop' => [
					'permissions' => [
						'editalluserpages',
					],
				],
			],
		],
		'section' => 'other',
	],
	'variables' => [
		'name' => 'Variables',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Variables',
		'var' => 'wmgUseVariables',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'variableslua' => [
		'name' => 'VariablesLua',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VariablesLua',
		'var' => 'wmgUseVariablesLua',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'variables',
			],
		],
		'section' => 'other',
	],
	'veforall' => [
		'name' => 'VEForAll',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VEForAll',
		'var' => 'wmgUseVEForAll',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				[ 'commentstreams', 'pageforms' ],
				'visualeditor',
			],
		],
		'section' => 'other',
	],
	'wikibaseclient' => [
		'name' => 'Wikibase (Client)',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase_Client',
		'var' => 'wmgUseWikibaseClient',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'wbc_entity_usage' => "$IP/extensions/Wikibase/client/sql/mysql/entity_usage.sql",
				'wb_items_per_site' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_items_per_site.sql",
				'wb_id_counters' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_id_counters.sql",
				'wb_changes' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes.sql",
				'wb_changes_dispatch' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes_dispatch.sql",
				'wb_changes_subscription' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes_subscription.sql",
				'wb_property_info' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_property_info.sql"
			],
			'mwscript' => [
					"$IP/extensions/MirahezeMagic/maintenance/populateWikibaseSitesTable.php" => [],
			],
		],
		'section' => 'other',
	],
	'wikibaserepository' => [
		'name' => 'Wikibase (Repository)',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase_Repository',
		'var' => 'wmgUseWikibaseRepository',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'wb_changes' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes.sql",
				'wb_changes_dispatch' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes_dispatch.sql",
				'wb_changes_subscription' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes_subscription.sql",
				'wb_items_per_site' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_items_per_site.sql",
				'wb_id_counters' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_id_counters.sql",
				'wbt_item_terms' => "$IP/extensions/Wikibase/repo/sql/mysql/term_store.sql",
				'wbt_term_in_lang' => "$IP/extensions/Wikibase/repo/sql/mysql/term_store.sql",
				'wbt_text_in_lang' => "$IP/extensions/Wikibase/repo/sql/mysql/term_store.sql",
				'wbt_text' => "$IP/extensions/Wikibase/repo/sql/mysql/term_store.sql",
				'wbt_type' => "$IP/extensions/Wikibase/repo/sql/mysql/term_store.sql",
				'wb_property_info' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_property_info.sql",
				'wbt_property_terms' => "$IP/extensions/Wikibase/repo/sql/mysql/term_store.sql",
			],
			'permissions' => [
				'*' => [
					'permissions' => [
						'item-term',
						'property-term',
						'item-merge',
						'item-redirect',
						'property-create',
					],
				],
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
		],
		'section' => 'other',
	],
	'wikibaselexeme' => [
		'name' => 'WikibaseLexeme',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikibaseLexeme',
		'var' => 'wmgUseWikibaseLexeme',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'wikibaserepository',
				'universallanguageselector',
			],	
		],
		'section' => 'other',
	],
	'wikibaselocalmedia' => [
		'name' => 'WikibaseLocalMedia',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase_Local_Media',
		'var' => 'wmgUseWikibaseLocalMedia',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'wikibaserepository',
			],	
		],
		'section' => 'other',
	],
	'wikibasequalityconstraints' => [
		'name' => 'WikibaseQualityConstraints',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikibaseQualityConstraints',
		'var' => 'wmgUseWikibaseQualityConstraints',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'wikibaserepository',
			],	
		],
		'install' => [
			'sql' => [
				'wbqc_constraints' => "$IP/extensions/WikibaseQualityConstraints/sql/mysql/tables-generated.sql",
			],
		],
		'section' => 'other',
	],
	'wikidatapagebanner' => [
		'name' => 'WikidataPageBanner',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikidataPageBanner',
		'var' => 'wmgUseWikidataPageBanner',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
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
		'section' => 'other',
	],
	'wikilove' => [
		'name' => 'WikiLove',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiLove',
		'var' => 'wmgUseWikiLove',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'wikilove_log' => "$IP/extensions/WikiLove/patches/tables-generated.sql"
			],
		],
		'section' => 'other',
	],
	'wikimediaincubator' => [
		'name' => 'WikimediaIncubator',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikimediaIncubator',
		'var' => 'wmgUseWikimediaIncubator',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'section' => 'other',
	],
];
