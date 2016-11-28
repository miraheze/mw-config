<?php
require_once( "$IP/extensions/Echo/Echo.php" );
require_once( "$IP/extensions/NativeSvgHandler/NativeSvgHandler.php" );
require_once( "$IP/extensions/Scribunto/Scribunto.php" );
wfLoadExtensions( [
	'AbuseFilter',
	'AntiSpoof',
	'Babel',
	'CentralAuth',
	'CheckUser',
	'Cite',
	'CiteThisPage',
	'CodeEditor',
	'ConfirmEdit',
	'ConfirmEdit/ReCaptchaNoCaptcha',
	'Disambiguator',
	'Gadgets',
	'GlobalBlocking',
	'GlobalCssJs',
	'InputBox',
	'Interwiki',
	'LocalisationUpdate',
	'ManageWiki',
	'MassMessage',
	'Math',
	'MirahezeMagic',
	'Nuke',
	'OATHAuth',
	'OAuth',
	'ParserFunctions',
	'Poem',
	'Renameuser',
	'SiteMatrix',
	'Timeline',
	'Thanks',
	'TitleBlacklist',
	'WikiEditor',
	'cldr'
] );
