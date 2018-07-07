<?php
require_once( "$IP/extensions/NativeSvgHandler/NativeSvgHandler.php" );
require_once( "$IP/extensions/Scribunto/Scribunto.php" );
wfLoadExtensions( [
	'AbuseFilter',
	'AntiSpoof',
	'Babel',
	'BetaFeatures',
	'CentralAuth',
	'CentralNotice',
	'CheckUser',
	'Cite',
	'CiteThisPage',
	'CreateWiki',
	'CodeEditor',
	'CookieWarning',
	'ConfirmEdit',
	'ConfirmEdit/ReCaptchaNoCaptcha',
	'Disambiguator',
	'Echo',
	'Gadgets',
	'GlobalBlocking',
	'GlobalCssJs',
	'GlobalPreferences',
	'GlobalUserPage',
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
	'Timeline',
	'Thanks',
	'TitleBlacklist',
	'TorBlock',
	'WikiDiscover',
	'WikiEditor',
	'cldr'
] );

$wgTimelineFileBackend = 'miraheze-swift';

$wgMathFileBackend = 'miraheze-swift';
