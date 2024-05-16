<?php

/**
 * ManageWiki extensions and skins are added using the variable below.
 *
 * name: MUST match the name in extension.json, skin.json, or $wgExtensionCredits.
 * displayname: the plain text display name, or a localised message key to be displayed.
 * linkPage: full url for an information page for the extension.
 * description: the plain text description, or a localised message key to be displayed.
 * help: additional help information for the extension.
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
	'pageimages' => [
		'name' => 'PageImages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageImages',
		'conflicts' => false,
		'requires' => [],
		'section' => 'api',
	],
	'shortdescription' => [
		'name' => 'ShortDescription',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ShortDescription',
		'conflicts' => false,
		'requires' => [],
		'section' => 'api',
	],

	// Editors
	'codeeditor' => [
		'name' => 'CodeEditor',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CodeEditor',
		'conflicts' => false,
		'requires' => [],
		'section' => 'editors',
	],
	'codemirror' => [
		'name' => 'CodeMirror',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CodeMirror',
		'conflicts' => false,
		'requires' => [],
		'section' => 'editors',
	],
	'visualeditor' => [
		'name' => 'VisualEditor',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VisualEditor',
		'conflicts' => false,
		'requires' => [],
		'section' => 'editors',
	],

	// Media handlers
	'3d' => [
		'name' => '3d',
		'displayname' => '3D',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:3D',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'settings' => [
				'wgFileExtensions' => array_merge( $wi->getSettingValue( 'wgFileExtensions' ), [ 'stl' ] ),
			],
		],
		'section' => 'mediahandlers',
	],
	'embedvideo' => [
		'name' => 'EmbedVideo',
		'linkPage' => 'https://github.com/StarCitizenWiki/mediawiki-extensions-EmbedVideo',
		'conflicts' => false,
		'requires' => [],
		'section' => 'mediahandlers',
	],
	'pagedtiffhandler' => [
		'name' => 'PagedTiffHandler',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PagedTiffHandler',
		'conflicts' => false,
		'requires' => [],
		'section' => 'mediahandlers',
	],
	'mediaspoiler' => [
		'name' => 'MediaSpoiler',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MediaSpoiler',
		'conflicts' => false,
		'requires' => [],
		'section' => 'mediahandlers',
	],
	'pdfhandler' => [
		'name' => 'PDF Handler',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PdfHandler',
		'conflicts' => false,
		'requires' => [],
		'section' => 'mediahandlers',
	],
	'simplebatchupload' => [
		'name' => 'SimpleBatchUpload',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleBatchUpload',
		'conflicts' => false,
		'requires' => [],
		'section' => 'mediahandlers',
	],
	'timedmediahandler' => [
		'name' => 'TimedMediaHandler',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TimedMediaHandler',
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
	'uploadwizard' => [
		'name' => 'Upload Wizard',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UploadWizard',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'uw_campaigns' => "$IP/extensions/UploadWizard/sql/mysql/tables-generated.sql",
			],
			'namespaces' => [
				'Campaign' => [
					'id' => 460,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => 'upwizcampaigns',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'Campaign',
					'additional' => []
				],
				'Campaign_talk' => [
					'id' => 461,
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
				'sysop' => [
					'addgroups' => [
						'upwizcampeditors',
					],
					'removegroups' => [
						'upwizcampeditors',
					],
					'permissions' => [
						'upwizcampaigns',
						'mass-upload',
					],
				],
				'upwizcampeditors' => [
					'permissions' => [
						'upwizcampaigns',
					],
				],
			],
		],
		'section' => 'mediahandlers',
	],

	// Parser hooks
	'ajaxpoll' => [
		'name' => 'AJAX Poll',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AJAXPoll',
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
	'arrays' => [
		'name' => 'Arrays',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Arrays',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'babel' => [
		'name' => 'Babel',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Babel',
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
		'name' => 'Calendar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Calendar-Wikivoyage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'cargo' => [
		'name' => 'Cargo',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Cargo',
		'help' => 'Stewards: it is recommended to not enable this extension on wikis with more than <b>50,000</b> pages. This includes all pages, <b>not</b> only content pages. Please use discretion.',
		'conflicts' => 'semanticmediawiki',
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'install' => [
			'mwscript' => [
				"$IP/extensions/MirahezeMagic/maintenance/createCargoDB.php" => [],
			],
			'sql' => [
				'cargo_tables' => "$IP/extensions/Cargo/sql/Cargo.sql",
				'cargo_backlinks' => "$IP/extensions/Cargo/sql/cargo_backlinks.sql"
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
	'categorytests' => [
		'name' => 'Category Tests',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategoryTests',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'parserhooks',
	],
	'categorytree' => [
		'name' => 'CategoryTree',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategoryTree',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'parserhooks',
	],
	'charinsert' => [
		'name' => 'CharInsert',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CharInsert',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'cite' => [
		'name' => 'Cite',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Cite',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'commentstreams' => [
		'name' => 'CommentStreams',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CommentStreams',
		'conflicts' => 'moderation',
		'requires' => [],
		'install' => [
			'sql' => [
				'cs_comments' => "$IP/extensions/CommentStreams/sql/mysql/cs_comments.sql",
				'cs_replies' => "$IP/extensions/CommentStreams/sql/mysql/cs_replies.sql",
				'cs_votes' => "$IP/extensions/CommentStreams/sql/mysql/cs_votes.sql",
				'cs_watchlist' => "$IP/extensions/CommentStreams/sql/mysql/cs_watchlist.sql",
			],
			'permissions' => [
				'user' => [
					'permissions' => [
						'cs-comment',
					],
				],
				'csmoderator' => [
					'permissions' => [
						'cs-moderator-delete',
					],
				],
				'bureaucrat' => [
					'addgroups' => [
						'csmoderator',
					],
					'removegroups' => [
						'csmoderator',
					],
				],
			],
		],
		'section' => 'parserhooks',
	],
	'comments' => [
		'name' => 'Comments',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Comments',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'createpage' => [
		'name' => 'Create Page',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Create_Page',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'css' => [
		'name' => 'CSS',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CSS',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'displaytitle' => [
		'name' => 'DisplayTitle',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Display_Title',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'dplforum' => [
		'name' => 'DPLforum',
		'displayname' => 'DPLForum',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DPLforum',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'drafts' => [
		'name' => 'Drafts',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Drafts',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'drafts' => "$IP/extensions/Drafts/sql/Drafts.sql",
			],
		],
		'section' => 'parserhooks',
	],
	'dummyfandoommainpagetags' => [
		'name' => 'DummyFandoomMainpageTags',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DummyFandoomMainpageTags',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'dynamicpagelist' => [
		'name' => 'DynamicPageList',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicPageList_(Wikimedia)',
		'conflicts' => 'dynamicpagelist3',
		'requires' => [],
		'section' => 'parserhooks',
	],
	'dynamicpagelist3' => [
		'name' => 'DynamicPageList3',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicPageList3',
		'conflicts' => 'dynamicpagelist',
		'requires' => [],
		'install' => [
			'mwscript' => [
				"$IP/extensions/DynamicPageList3/maintenance/createTemplate.php" => [],
				"$IP/extensions/DynamicPageList3/maintenance/createView.php" => [],
			],
		],
		'section' => 'parserhooks',
	],
	'embedspotify' => [
		'name' => 'EmbedSpotify',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:EmbedSpotify',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'timeline' => [
		'name' => 'EasyTimeline',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:EasyTimeline',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'genealogy' => [
		'name' => 'Genealogy',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Genealogy',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'geocrumbs' => [
		'name' => 'GeoCrumbs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GeoCrumbs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'geogebra' => [
		'name' => 'GeoGebra',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GeoGebra',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'googledocs4mw' => [
		'name' => 'GoogleDocs4MW',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GoogleDocs4MW',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'graph' => [
		'name' => 'Graph',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Graph',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'jsonconfig',
				'codeeditor',
			],
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'help' => 'This extension has been globally disabled. See <a href="https://issue-tracker.miraheze.org/T10756">T10756</a> for details.',
		'section' => 'parserhooks',
	],
	'groupssidebar' => [
		'name' => 'GroupsSidebar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GroupsSidebar',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'headertabs' => [
		'name' => 'Header Tabs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Header_Tabs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'imagemap' => [
		'name' => 'ImageMap',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ImageMap',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'inputbox' => [
		'name' => 'InputBox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:InputBox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'javascriptslideshow' => [
		'name' => 'Javascript Slideshow',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JavascriptSlideshow',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'josa' => [
		'name' => 'Josa',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Josa',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'jscalendar' => [
		'name' => 'JsCalendar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JsCalendar',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'kartographer' => [
		'name' => 'Kartographer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Kartographer',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'jsonconfig',
			],
		],
		'section' => 'parserhooks',
	],
	'labeledsectiontransclusion' => [
		'name' => 'LabeledSectionTransclusion',
		'displayname' => 'Labeled Section Transclusion',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Labeled_Section_Transclusion',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'lingo' => [
		'name' => 'Lingo',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Lingo',
		'description' => 'Provides hover-over tool tips on pages from words defined on a wiki page',
		'conflicts' => 'newsletter',
		'requires' => [],
		'section' => 'parserhooks',
	],
	'linktitles' => [
		'name' => 'LinkTitles',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkTitles',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'logofunctions' => [
		'name' => 'LogoFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LogoFunctions',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'loopscombo' => [
		'name' => 'Loops',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Loops',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'magicnocache' => [
		'name' => 'MagicNoCache',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MagicNoCache',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'maps' => [
		'name' => 'Maps',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Maps',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'namespaces' => [
				'GeoJson' => [
					'id' => 420,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
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
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'mathlatexml' => "$IP/extensions/Math/sql/mysql/mathlatexml.sql",
				'mathoid' => "$IP/extensions/Math/sql/mysql/mathoid.sql"
			],
		],
		'section' => 'parserhooks',
	],
	'mermaid' => [
		'name' => 'Mermaid',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Mermaid',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'mintydocs' => [
		'name' => 'MintyDocs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MintyDocs',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'parserhooks',
	],
	'mscalendar' => [
		'name' => 'MsCalendar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsCalendar',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'mslinks' => [
		'name' => 'MsLinks',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsLinks',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'msupload' => [
		'name' => 'MsUpload',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MsUpload',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'myvariables' => [
		'name' => 'MyVariables',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MyVariables',
		'conflicts' => 'approvedrevs',
		'requires' => [],
		'section' => 'parserhooks',
	],
	'namespacepreload' => [
		'name' => 'NamespacePreload',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NamespacePreload',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'notitle' => [
		'name' => 'NoTitle',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NoTitle',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'opengraphmeta' => [
		'name' => 'OpenGraphMeta',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:OpenGraphMeta',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'oredict' => [
		'name' => 'OreDict',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:OreDict',
		'conflicts' => false,
		'install' => [
			'sql' => [
				'ext_oredict_items' => "$IP/extensions/OreDict/install/sql/ext_oredict_items.sql"
			],
		],
		'requires' => [],
		'section' => 'parserhooks',
	],
	'pdfembed' => [
		'name' => 'PDFEmbed',
		'displayname' => 'PDF Embed',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PDFEmbed',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'poem' => [
		'name' => 'Poem',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Poem',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'portableinfobox' => [
		'name' => 'Portable Infobox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PortableInfobox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'preloader' => [
		'name' => 'Preloader',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Preloader',
		'conflicts' => false,
		'install' => [],
		'requires' => [],
		'section' => 'parserhooks',
	],
	'quiz' => [
		'name' => 'Quiz',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Quiz',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'randomgameunit' => [
		'name' => 'RandomGameUnit',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RandomGameUnit',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'randomselection' => [
		'name' => 'RandomSelection',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RandomSelection',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'regexfunctions' => [
		'name' => 'RegexFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RegexFunctions',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'help' => 'This extension has been globally disabled. See <a href="https://issue-tracker.miraheze.org/T10882">T10882</a> for details.',
		'section' => 'parserhooks',
	],
	'rightfunctions' => [
		'name' => 'RightFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RightFunctions',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'rss' => [
		'name' => 'RSS feed',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RSS',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'sanecase' => [
		'name' => 'SaneCase',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SaneCase',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'score' => [
		'name' => 'Score',
		'displayname' => 'Score (Disabled -- See T5863)',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Score',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'screenplay' => [
		'name' => 'Screenplay',
		'linkPage' => 'https://mediawiki.org/wiki/Extension:Screenplay',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks'
	],
	'simpletooltip' => [
		'name' => 'SimpleTooltip',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleTooltip',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'skinperpage' => [
		'name' => 'Skin per page',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SkinPerPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'snapblocks' => [
		'name' => 'Snapblocks',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Snapblocks',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'snapprojectembed' => [
		'name' => 'Snap! Project Embed',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SnapProjectEmbed',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'spoilers' => [
		'name' => 'Spoilers',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Spoilers',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'subpagefun' => [
		'name' => 'Subpage Fun',
		'displayname' => 'SubPageFun',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Subpage_Fun',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'subpagelist3' => [
		'name' => 'Subpage List 3',
		'displayname' => 'SubPageList3',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SubPageList3',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'syntaxhighlight_geshi' => [
		'name' => 'SyntaxHighlight',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SyntaxHighlight',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'tabberneue' => [
		'name' => 'TabberNeue',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TabberNeue',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'tabs' => [
		'name' => 'Tabs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Tabs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'templatedata' => [
		'name' => 'TemplateData',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateData',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'templatestyles' => [
		'name' => 'TemplateStyles',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateStyles',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'templatestylesextender' => [
		'name' => 'TemplateStylesExtender',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateStylesExtender',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'templatestyles',
			],
		],
		'section' => 'parserhooks',
	],
	'tilesheets' => [
		'name' => 'Tilesheets',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Tilesheets',
		'conflicts' => false,
		'install' => [
			'sql' => [
				'ext_tilesheet_images' => "$IP/extensions/Tilesheets/install/sql/ext_tilesheet_images.sql",
				'ext_tilesheet_items' => "$IP/extensions/Tilesheets/install/sql/ext_tilesheet_items.sql",
				'ext_tilesheet_languages' => "$IP/extensions/Tilesheets/install/sql/ext_tilesheet_languages.sql",
				'ext_tilesheet_tilelinks' => "$IP/extensions/Tilesheets/install/sql/ext_tilesheet_tilelinks.sql"
			],
		],
		'requires' => [
			'extensions' => [
				'oredict',
			],
		],
		'section' => 'parserhooks',
	],
	'toctree' => [
		'name' => 'TocTree',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TocTree',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'treeandmenu' => [
		'name' => 'TreeAndMenu',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TreeAndMenu',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'twittertag' => [
		'name' => 'Twitter Tag',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TwitterTag',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'urlgetparameters' => [
		'name' => 'UrlGetParameters',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UrlGetParameters',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'userfunctions' => [
		'name' => 'UserFunctions',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UserFunctions',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'userwelcome' => [
		'name' => 'UserWelcome',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UserWelcome',
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
		'name' => 'Wiki Category Tag Cloud',
		'displayname' => 'WikiCategoryTagCloud',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiCategoryTagCloud',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'wikihiero' => [
		'name' => 'WikiHiero',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiHiero',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'wikiseo' => [
		'name' => 'WikiSEO',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiSEO',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'wikitextloggedinout' => [
		'name' => 'WikiTextLoggedInOut',
		'displayname' => 'WikiText Logged In Out',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiTextLoggedInOut',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],
	'youtube' => [
		'name' => 'YouTube',
		'linkPage' => 'https://github.com/miraheze/YouTube',
		'conflicts' => false,
		'requires' => [],
		'section' => 'parserhooks',
	],

	// Spam prevention
	'approvedrevs' => [
		'name' => 'Approved Revs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Approved_Revs',
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
		'section' => 'antispam',
	],
	'authorprotect' => [
		'name' => 'AuthorProtect',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AuthorProtect',
		'conflicts' => 'lockauthor',
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
	'lockauthor' => [
		'name' => 'LockAuthor',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LockAuthor',
		'conflicts' => 'authorprotect',
		'requires' => [],
		'install' => [
			'permissions' => [
				'sysop' => [
					'permissions' => [
						'editall',
					],
				],
			],
		],
		'section' => 'antispam',
	],
	'moderation' => [
		'name' => 'Moderation',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Moderation',
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

	// Special pages
	'adminlinks' => [
		'name' => 'Admin Links',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Admin_Links',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'contactpage' => [
		'name' => 'ContactPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ContactPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'contributionscores' => [
		'name' => 'ContributionScores',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Contribution_Scores',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'createdpageslist' => [
		'name' => 'CreatedPagesList',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreatedPagesList',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'createdpageslist' => "$IP/extensions/CreatedPagesList/sql/patch-createdpageslist.sql",
			],
			'mwscript' => [
				"$IP/extensions/CreatedPagesList/maintenance/recalculateTable.php" => [],
			],
		],
		'section' => 'specialpages',
	],
	'createpageuw' => [
		'name' => 'CreatePageUw',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreatePageUw',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'createredirect' => [
		'name' => 'CreateRedirect',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CreateRedirect',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'datatransfer' => [
		'name' => 'Data Transfer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Data_Transfer',
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
		'name' => 'Editcount',
		'displayname' => 'EditCount',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Editcount',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'flaggedrevs' => [
		'name' => 'FlaggedRevs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:FlaggedRevs',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'flaggedpages' => "$IP/extensions/FlaggedRevs/backend/schema/mysql/tables-generated.sql",
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
						'review',
						'unreviewedpages',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'growthexperiments' => [
		'name' => 'GrowthExperiments',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GrowthExperiments',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'visualeditor',
			],
		],
		'install' => [
			'sql' => [
				'growthexperiments_link_recommendations' => "$IP/extensions/GrowthExperiments/sql/mysql/growthexperiments_link_recommendations.sql",
				'growthexperiments_link_submissions' => "$IP/extensions/GrowthExperiments/sql/mysql/growthexperiments_link_submissions.sql",
				'growthexperiments_mentee_data' => "$IP/extensions/GrowthExperiments/sql/mysql/growthexperiments_mentee_data.sql",
				'growthexperiments_mentor_mentee' => "$IP/extensions/GrowthExperiments/sql/mysql/growthexperiments_mentor_mentee.sql",
				'growthexperiments_user_impact' => "$IP/extensions/GrowthExperiments/sql/mysql/growthexperiments_user_impact.sql"
			],
			'permissions' => [
				'sysop' => [
					'permissions' => [
						'setmentor',
					],
				],
			],
		],
		'section' => 'specialpages',
	],
	'hitcounters' => [
		'name' => 'HitCounters',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HitCounters',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'help' => 'This extension has been globally disabled. See <a href="https://issue-tracker.miraheze.org/T10883">T10883</a> for details.',
		'install' => [
			'sql' => [
				'hit_counter' => "$IP/extensions/HitCounters/sql/page_counter.sql",
				'hit_counter_extension' => "$IP/extensions/HitCounters/sql/hit_counter_extension.sql",
			],
		],
		'section' => 'specialpages',
	],
	'imagerating' => [
		'name' => 'ImageRating',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ImageRating',
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
	'nearbypages' => [
		'name' => 'NearbyPages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NearbyPages',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'mediawikichat' => [
		'name' => 'MediaWikiChat',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MediaWikiChat',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'nukedpl' => [
		'name' => 'NukeDPL',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NukeDPL',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				[
					'dynamicpagelist',
					'dynamicpagelist3',
				],
			],
		],
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'pageforms' => [
		'name' => 'PageForms',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Page_Forms',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'namespaces' => [
				'Form' => [
					'id' => 106,
					'searchable' => 1,
					'subpages' => 1,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Form_talk' => [
					'id' => 107,
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
	'pageschemas' => [
		'name' => 'Page Schemas',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Page_Schemas',
		'conflicts' => 'semanticmediawiki',
		'requires' => [],
		'install' => [
			'permissions' => [
				'sysop' => [
					'permissions' => [
						'generatepages',
					],
				],
			],
		],
		'section' => 'specialpages',
	],
	'pagetriage' => [
		'name' => 'PageTriage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageTriage',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'pagetriage_tags' => "$IP/extensions/PageTriage/sql/mysql/tables-generated.sql",
			],
		],
		'section' => 'specialpages',
	],
	'protectsite' => [
		'name' => 'Protect Site',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ProtectSite',
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
		'name' => 'QuizGame',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:QuizGame',
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
	'semanticdrilldown' => [
			'name' => 'SemanticDrilldown',
			'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Semantic_Drilldown',
			'conflicts' => false,
			'requires' => [
					'extensions' => [
						'semanticmediawiki',
					],
			],
			'section' => 'specialpages',
		],
	'simplechanges' => [
		'name' => 'SimpleChanges',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleChanges',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'templatesandbox' => [
		'name' => 'TemplateSandbox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateSandbox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'timemachine' => [
		'name' => 'TimeMachine',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TimeMachine',
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],
	'translate' => [
		'name' => 'Translate',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Translate',
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
				'revtag' => "$IP/extensions/Translate/sql/mysql/revtag.sql",
				'translate_cache' => "$IP/extensions/Translate/sql/mysql/translate_cache.sql",
				'translate_groupreviews' => "$IP/extensions/Translate/sql/mysql/translate_groupreviews.sql",
				'translate_groupstats' => "$IP/extensions/Translate/sql/mysql/translate_groupstats.sql",
				'translate_messageindex' => "$IP/extensions/Translate/sql/mysql/translate_messageindex.sql",
				'translate_metadata' => "$IP/extensions/Translate/sql/mysql/translate_metadata.sql",
				'translate_reviews' => "$IP/extensions/Translate/sql/mysql/translate_reviews.sql",
				'translate_sections' => "$IP/extensions/Translate/sql/mysql/translate_sections.sql",
				'translate_stash' => "$IP/extensions/Translate/sql/mysql/translate_stash.sql",
				'translate_tms' => "$IP/extensions/Translate/sql/mysql/translate_tm.sql",
				'translate_translatable_bundles' => "$IP/extensions/Translate/sql/mysql/translate_translatable_bundles.sql",
			],
		],
		'section' => 'specialpages',
	],
	'translationnotifications' => [
		'name' => 'TranslationNotifications',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TranslationNotifications',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'specialpages',
	],

	// Other
	'advancedsearch' => [
		'name' => 'AdvancedSearch',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AdvancedSearch',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'cirrussearch',
			],
		],
		'section' => 'other',
	],
	'articlecreationworkflow' => [
		'name' => 'ArticleCreationWorkflow',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ArticleCreationWorkflow',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'permissions' => [
				'*' => [
					'permissions' => [
						'createpagemainns',
					],
				],
				'autoconfirmed' => [
					'permissions' => [
						'createpagemainns',
					],
				],
				'user' => [
					'permissions' => [
						'createpagemainns',
					],
				],
			],
		],
		'section' => 'other',
	],
	'articleplaceholder' => [
		'name' => 'ArticlePlaceholder',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ArticlePlaceholder',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'wikibaseclient',
			],
		],
		'install' => [],
		'section' => 'other',
	],
	'articleratings' => [
		'name' => 'ArticleRating',
		'displayname' => 'ArticleRatings',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ArticleRatings',
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
		'name' => 'ArticleToCategory2',
		'displayname' => 'Article To Category 2',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ArticleToCategory2',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'autocreatecategorypages' => [
		'name' => 'AutoCreateCategoryPages',
		'displayname' => 'Auto Create Category Pages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Auto_Create_Category_Pages',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'section' => 'other',
	],
	'autocreatepages' => [
		'name' => 'AutoCreatePage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AutoCreatePage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'blogpage' => [
		'name' => 'BlogPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:BlogPage',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'categoryexplorer' => [
		'name' => 'CategoryExplorer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategoryExplorer',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'categorysortheaders' => [
		'name' => 'CategorySortHeaders',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CategorySortHeaders',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'other',
	],
	'cirrussearch' => [
		'name' => 'CirrusSearch',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CirrusSearch',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'install' => [
			'mwscript' => [
				"$IP/extensions/CirrusSearch/maintenance/UpdateSearchIndexConfig.php" => [],
				"$IP/extensions/CirrusSearch/maintenance/ForceSearchIndex.php" => [
					'skipLinks' => false,
					'indexOnSkip' => false,
					'repeat-with' => [
						'skipParse' => false,
					],
				],
			],
		],
		'section' => 'other',
	],
	'cleanchanges' => [
		'name' => 'Clean Changes',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CleanChanges',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'collapsiblevector' => [
		'name' => 'CollapsibleVector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CollapsibleVector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'commentbox' => [
		'name' => 'Commentbox',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Commentbox',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'commonsmetadata' => [
		'name' => 'CommonsMetadata',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:CommonsMetadata',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'darkmode' => [
		'name' => 'DarkMode',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DarkMode',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'deleteuserpages' => [
		'name' => 'DeleteUserPages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DeleteUserPages',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'other',
	],
	'description2' => [
		'name' => 'Description2',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Description2',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'disambiguator' => [
		'name' => 'Disambiguator',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Disambiguator',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'discussiontools' => [
		'name' => 'DiscussionTools',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DiscussionTools',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'linter',
				'visualeditor',
			],
		],
		'install' => [
			'sql' => [
				'discussiontools_items' => "$IP/extensions/DiscussionTools/sql/mysql/discussiontools_persistent.sql",
				'discussiontools_subscription' => "$IP/extensions/DiscussionTools/sql/mysql/discussiontools_subscription.sql",
			],
		],
		'section' => 'other',
	],
	'dynamicsidebar' => [
		'name' => 'DynamicSidebar',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:DynamicSidebar',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'editsubpages' => [
		'name' => 'EditSubpages',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:EditSubpages',
		'conflicts' => false,
		'requires' => [],
		'install' => [],
		'section' => 'other',
	],
	'externaldata' => [
		'name' => 'External Data',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:External_Data',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'install' => [
			'sql' => [
				'ed_url_cache' => "$IP/extensions/ExternalData/sql/ExternalData.sql"
			],
		],
		'section' => 'other',
	],
	'flexdiagrams' => [
		'name' => 'Flex Diagrams',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Flex_Diagrams',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'namespaces' => [
				'BPMN' => [
					'id' => 740,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'flexdiagrams-bpmn',
					'additional' => []
				],
				'BPMN_talk' => [
					'id' => 741,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Gantt' => [
					'id' => 742,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'flexdiagrams-gantt',
					'additional' => []
				],
				'Gantt_talk' => [
					'id' => 743,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Mermaid' => [
					'id' => 744,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'flexdiagrams-mermaid',
					'additional' => []
				],
				'Mermaid_talk' => [
					'id' => 745,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Drawio' => [
					'id' => 746,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'flexdiagrams-drawio',
					'additional' => []
				],
				'Drawio_talk' => [
					'id' => 747,
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
		'section' => 'other',
	],
	'forcepreview' => [
		'name' => 'ForcePreview',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ForcePreview',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'gadgets' => [
		'name' => 'Gadgets',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Gadgets',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'geodata' => [
		'name' => 'GeoData',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GeoData',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'geo_tags' => "$IP/extensions/GeoData/sql/mysql/tables-generated.sql"
			],
		],
		'section' => 'other',
	],
	'globaluserpage' => [
		'name' => 'GlobalUserPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GlobalUserPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'guidedtour' => [
		'name' => 'GuidedTour',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GuidedTour',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'hawelcome' => [
		'name' => 'Highly Automated Welcome Tool',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HAWelcome',
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
	'hidesection' => [
		'name' => 'HideSection',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:HideSection',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'highlightlinksincategory' => [
		'name' => 'Highlight Links in Category',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Highlight_Links_in_Category',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'interwikisorting' => [
		'name' => 'InterwikiSorting',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:InterwikiSorting',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'wikibaseclient',
			],
		],
		'section' => 'other',
	],
	'jsbreadcrumbs' => [
		'name' => 'JSBreadCrumbs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JSBreadCrumbs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'jsonconfig' => [
		'name' => 'JsonConfig',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:JsonConfig',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'languageselector' => [
		'name' => 'Language Selector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LanguageSelector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'lastmodified' => [
		'name' => 'LastModified',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LastModified',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'linksuggest' => [
		'name' => 'LinkSuggest',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkSuggest',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'linktarget' => [
		'name' => 'LinkTarget',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:LinkTarget',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'mobilefrontend' => [
		'name' => 'MobileFrontend',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MobileFrontend',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'multimediaviewer' => [
		'name' => 'MultimediaViewer',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MultimediaViewer',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'multiboilerplate' => [
		'name' => 'MultiBoilerplate',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MultiBoilerplate',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'newsignuppage' => [
		'name' => 'New Signup Page',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewSignupPage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'newsletter' => [
		'name' => 'Newsletter',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Newsletter',
		'conflicts' => 'lingo',
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
				'nl_newsletters' => "$IP/extensions/Newsletter/sql/mysql/tables-generated.sql",
			],
		],
		'section' => 'other',
	],
	'newusermessage' => [
		'name' => 'NewUserMessage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:NewUserMessage',
		'conflicts' => 'flow',
		'requires' => [],
		'section' => 'other',
	],
	'newusernotif' => [
		'name' => 'New User Email Notification',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:New_User_Email_Notification',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'pageassessments' => [
		'name' => 'PageAssessments',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageAssessments',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'page_assessments_projects' => "$IP/extensions/PageAssessments/db/mysql/tables-generated.sql"
			],
		],
		'section' => 'other',
	],
	'pagenotice' => [
		'name' => 'PageNotice',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageNotice',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'pageproperties' => [
		'name' => 'PageProperties',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageProperties',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'twocolconflict' => [
		'name' => 'TwoColConflict',
		'displayname' => 'Paragraph-based Edit Conflict Interface',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Paragraph-based_Edit_Conflict_Interface',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'pagelanguage' => [
		'name' => 'Page Language',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PageLanguage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'perpagelanguage' => [
		'name' => 'PerPageLanguage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PerPageLanguage',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'settings' => [
				'wgPageLanguageUseDB' => true,
			],
		],
		'section' => 'other',
	],
	'popups' => [
		'name' => 'Popups',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Popups',
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
		'name' => 'ProofreadPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Proofread_Page',
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
	'propertysuggester' => [
		'name' => 'PropertySuggester',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PropertySuggester',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'wikibaserepository',
			],
		],
		'install' => [
			'sql' => [
				'wbs_propertypairs' => "$IP/extensions/PropertySuggester/sql/mysql/tables-generated.sql"
			],
		],
		'section' => 'other',
	],
	'protectionindicator' => [
		'name' => 'ProtectionIndicator',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:ProtectionIndicator',
		'conflicts' => 'comments',
		'install' => [],
		'requires' => [],
		'section' => 'other',
	],
	'purge' => [
		'name' => 'Purge',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Purge',
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
	'pwa' => [
		'name' => 'PWA',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:PWA',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'ratepage' => [
		'name' => 'RatePage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RatePage',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'ratepage_contest' => "$IP/extensions/RatePage/sql/create-table--ratepage-contest.sql",
				'ratepage_vote' => "$IP/extensions/RatePage/sql/create-table--ratepage-vote.sql"
			],
			'permissions' => [
				'*' => [
					'permissions' => [
						'ratepage-vote',
						'ratepage-contests-view-list',
					],
				],
				'sysop' => [
					'permissions' => [
						'ratepage-contests-view-details',
						'ratepage-contests-edit',
					],
				],
				'bureaucrat' => [
					'permissions' => [
						'ratepage-contests-clear',
					],
				],
			],
		],
		'section' => 'other',
	],
	'relatedarticles' => [
		'name' => 'RelatedArticles',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RelatedArticles',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'realme' => [
		'name' => 'RealMe',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RealMe',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'removeredlinks' => [
		'name' => 'RemoveRedlinks',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RemoveRedlinks',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'revisionslider' => [
		'name' => 'RevisionSlider',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:RevisionSlider',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'sandboxlink' => [
		'name' => 'SandboxLink',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SandboxLink',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'share' => [
		'name' => 'Share',
		'linkPage' => 'https://github.com/AgentIsai/Share',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'permissions' => [
				'*' => [
					'permissions' => [
						'viewsharelinks',
					],
				],
				'user' => [
					'permissions' => [
						'viewsharelinks',
					],
				],
			],
		],
		'section' => 'other',
	],
	'simpleblogpage' => [
		'name' => 'SimpleBlogPage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SimpleBlogPage',
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
	'softredirector' => [
		'name' => 'SoftRedirector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SoftRedirector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'socialprofile' => [
		'name' => 'SocialProfile',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SocialProfile',
		'description' => 'socialprofile-desc',
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
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'spritename' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritename.sql",
				'spritename_rev' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritename_rev.sql",
				'spritesheet' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritesheet.sql",
				'spritesheet_rev' => "$IP/extensions/SpriteSheet/install/sql/spritesheet_table_spritesheet_rev.sql"

			],
			'permissions' => [
				'autoconfirmed' => [
					'permissions' => [
						'edit_sprites',
					],
				],
				'sysop' => [
					'permissions' => [
						'spritesheet_rollback',
					],
				],
			],
		],
		'section' => 'other',
	],
	'standarddialogs' => [
		'name' => 'StandardDialogs',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:StandardDialogs',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
		'install' => [
			'sql' => [
				'mws_title_index' => "$IP/extensions/OOJSPlus/vendor/mwstake/mediawiki-component-commonwebapis/sql/mws_title_index.sql",
				'mws_user_index' => "$IP/extensions/OOJSPlus/vendor/mwstake/mediawiki-component-commonwebapis/sql/mws_user_index.sql",
			],
		],
	],
	'flow' => [
		'name' => 'Flow',
		'displayname' => 'StructuredDiscussions (Flow)',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:StructuredDiscussions',
		'conflicts' => false,
		'help' => 'Deprecated by WMF, who recommends DiscussionTools instead.',
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'install' => [
			'sql' => [
				'flow_revision' => "$IP/extensions/Flow/sql/mysql/tables-generated.sql"
			],
			'namespaces' => [
				'Topic' => [
					'id' => 2600,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'flow-board',
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
	'semanticmediawiki' => [
		'name' => 'SemanticMediaWiki',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:SemanticMediaWiki',
		'help' => '<br/> Permanently "experimental" and may be removed with little to no prior notice. WARNING: Disabling this extension after it\'s already been enabled will clear all SemanticMediaWiki database tables as well. <br/><b>Note: <a href="https://meta.miraheze.org/wiki/Special:MyLanguage/Stewards" target="_blank">Stewards</a>, please ensure that a member of the <a href="https://meta.miraheze.org/wiki/Special:MyLanguage/Tech:SRE_Volunteers" target="_blank">Site Reliability Engineering</a> team is available and not mobile in order to run <a href="https://meta.miraheze.org/wiki/Tech:Semantic_MediaWiki" target="_blank">a series of commands</a> on mwtask181 after enabling this.</b>',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'install' => [
			'mwscript' => [
				"$IP/extensions/SemanticMediaWiki/maintenance/setupStore.php" => [],
			],
			'namespaces' => [
				'Property' => [
					'id' => 102,
					'searchable' => 1,
					'subpages' => 0,
					'protection' => '',
					'content' => 1,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Property_talk' => [
					'id' => 103,
					'searchable' => 0,
					'subpages' => 1,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Concept' => [
					'id' => 108,
					'searchable' => 1,
					'subpages' => 0,
					'protection' => '',
					'content' => 1,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Concept_talk' => [
					'id' => 109,
					'searchable' => 0,
					'subpages' => 1,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'smw/schema' => [
					'id' => 112,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'smw/schema',
					'additional' => []
				],
				'smw/schema_talk' => [
					'id' => 113,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Rule' => [
					'id' => 114,
					'searchable' => 0,
					'subpages' => 0,
					'protection' => '',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'wikitext',
					'additional' => []
				],
				'Rule_talk' => [
					'id' => 115,
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
				'smwcurator' => [
					'permissions' => [
						'smw-schemaedit',
						'smw-pageedit',
						'smw-viewentityassociatedrevisionmismatch',
						'smw-vieweditpageinfo',
					],
				],
				'smweditor' => [
					'permissions' => [
						'smw-vieweditpageinfo',
					],
				],
				'user' => [
					'permissions' => [
						'smw-vieweditpageinfo',
					],
				],
			],
		],
		'remove' => [
			'mwscript' => [
				"$IP/extensions/SemanticMediaWiki/maintenance/setupStore.php" => [
					'delete' => false,
					'nochecks' => false,
				],
			],
		],
		'section' => 'other',
	],
	'semanticformsselect' => [
		'name' => 'Semantic Forms Select',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Semantic_Forms_Select',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'pageforms',
				'semanticmediawiki',
			],
		],
		'section' => 'other',
	],
	'semanticscribunto' => [
		'name' => 'SemanticScribunto',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Semantic_Scribunto',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'semanticmediawiki',
			],
		],
		'section' => 'other',
	],
	'structurednavigation' => [
		'name' => 'StructuredNavigation',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:StructuredNavigation',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'namespaces' => [
				'Navigation' => [
					'id' => 2940,
					'searchable' => 1,
					'subpages' => 1,
					'protection' => 'structurednav-edit',
					'content' => 0,
					'aliases' => [],
					'contentmodel' => 'StructuredNavigation',
					'additional' => []
				],
				'Navigation_talk' => [
					'id' => 2941,
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
						'structurednav-create',
						'structurednav-edit',
					],
				],
			],
		],
		'section' => 'other',
	],
	'templatewizard' => [
		'name' => 'TemplateWizard',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TemplateWizard',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'theme' => [
		'name' => 'Theme',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Theme',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'thanks' => [
		'name' => 'Thanks',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Thanks',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'titlekey' => [
		'name' => 'TitleKey',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:TitleKey',
		'conflicts' => false,
		'requires' => [],
		'install' => [
			'sql' => [
				'titlekey' => "$IP/extensions/TitleKey/sql/titlekey.sql"
			],
			'mwscript' => [
				"$IP/extensions/TitleKey/maintenance/rebuildTitleKeys.php" => []
			],
		],
		'section' => 'other',
	],
	'universallanguageselector' => [
		'name' => 'UniversalLanguageSelector',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UniversalLanguageSelector',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'unlinkedwikibase' => [
		'name' => 'UnlinkedWikibase',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UnlinkedWikibase',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'uploadslink' => [
		'name' => 'UploadsLink',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UploadsLink',
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'userpageeditprotection' => [
		'name' => 'UserPageEditProtection',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:UserPageEditProtection',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'variableslua' => [
		'name' => 'VariablesLua',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:VariablesLua',
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
		'name' => 'WikibaseClient',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase_Client',
		'conflicts' => 'semanticmediawiki',
		'requires' => [],
		'install' => [
			'sql' => [
				'wbc_entity_usage' => "$IP/extensions/Wikibase/client/sql/mysql/entity_usage.sql",
				'wb_items_per_site' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_items_per_site.sql",
				'wb_id_counters' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_id_counters.sql",
				'wb_changes' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes.sql",
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
		'name' => 'WikibaseRepository',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase_Repository',
		'conflicts' => 'semanticmediawiki',
		'requires' => [],
		'install' => [
			'sql' => [
				'wb_changes' => "$IP/extensions/Wikibase/repo/sql/mysql/wb_changes.sql",
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
				'wmgWikibaseRepoUrl' => $wi->server,
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
	'wikibaseedtf' => [
		'name' => 'Wikibase EDTF',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase_EDTF',
		'conflicts' => false,
		'requires' => [
			'extensions' => [
				'wikibaserepository',
			],
		],
		'section' => 'other',
	],
	'wikibaselexeme' => [
		'name' => 'WikibaseLexeme',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikibaseLexeme',
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
		'name' => 'Wikibase Local Media',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Wikibase_Local_Media',
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
		'conflicts' => false,
		'requires' => [],
		'section' => 'other',
	],
	'wikiforum' => [
		'name' => 'WikiForum',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikiForum',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'help' => 'This extension has been globally disabled. See <a href="https://issue-tracker.miraheze.org/T10871">T10871</a> for details.',
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
		'name' => 'Wikimedia Incubator',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:WikimediaIncubator',
		'conflicts' => false,
		'requires' => [
			'permissions' => [
				'managewiki-restricted',
			],
		],
		'section' => 'other',
	],

	// Skins
	'anisa' => [
		'name' => 'Anisa',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Anisa',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'apex' => [
		'name' => 'Apex',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Apex',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'bluesky' => [
		'name' => 'BlueSky',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:BlueSky',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'chameleon' => [
		'name' => 'chameleon',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Chameleon',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'citizen' => [
		'name' => 'Citizen',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Citizen',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'cosmos' => [
		'name' => 'Cosmos',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Cosmos',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'dusktodawn' => [
		'name' => 'Dusk To Dawn',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:DuskToDawn',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'erudite' => [
		'name' => 'Erudite',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Erudite',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'evelution' => [
		'name' => 'Evelution',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Evelution',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'femiwiki' => [
		'name' => 'Femiwiki',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Femiwiki',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'foreground' => [
		'name' => 'Foreground',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Foreground',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'gamepress' => [
		'name' => 'Gamepress',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Gamepress',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'hassomecolours' => [
		'name' => 'HasSomeColours',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:HasSomeColours',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'mask' => [
		'name' => 'Mask',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Mask',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'medik' => [
		'name' => 'Medik',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Medik',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'metrolook' => [
		'name' => 'Metrolook',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Metrolook',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'minervaneue' => [
		'name' => 'MinervaNeue',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Minerva_Neue',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'mirage' => [
		'name' => 'Mirage',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Mirage',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'monaco' => [
		'name' => 'Monaco',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Monaco',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'nimbus' => [
		'name' => 'Nimbus',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Nimbus',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'nostalgia' => [
		'name' => 'Nostalgia',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Nostalgia',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'pivot' => [
		'name' => 'Pivot',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Pivot',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'refreshed' => [
		'name' => 'Refreshed',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Refreshed',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'snapwikiskin' => [
		'name' => 'Snap! Wiki Skin',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Snap!_Wiki_Skin',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'splash' => [
		'name' => 'Splash',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Splash',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'truglass' => [
		'name' => 'Truglass',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Truglass',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'tweeki' => [
		'name' => 'Tweeki',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Tweeki',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
	'wmau' => [
		'name' => 'WMAU',
		'linkPage' => 'https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:WMAU',
		'conflicts' => false,
		'requires' => [],
		'section' => 'skins',
	],
];
