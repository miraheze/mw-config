<?php
require_once( "$IP/extensions/NativeSvgHandler/NativeSvgHandler.php" );
require_once( "$IP/extensions/Scribunto/Scribunto.php" );
wfLoadExtensions( [
	'AbuseFilter',
	'AntiSpoof',
	'Babel',
	'BetaFeatures',
	'CentralAuth',
	'CheckUser',
	'Cite',
	'CiteThisPage',
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
	'TorBlock',
	'WikiEditor',
	'cldr'
] );

// Geolocate here to determine to whom to show the cookie warning
$wgCookieWarningEnabled = true;
// Haha just kidding -- annoy everyone
