<?php

require_once "$IP/extensions/MobileDetect/MobileDetect.php";

if ( $wi->dbname !== 'ldapwikiwiki' ) {
	wfLoadExtensions( [
		'CentralAuth',
		'GlobalPreferences',
		'GlobalBlocking',
	] );
}

wfLoadExtensions( [
	'AbuseFilter',
	'AntiSpoof',
	'BetaFeatures',
	'CentralNotice',
	'CheckUser',
	'CreateWiki',
	'CookieWarning',
	'ConfirmEdit',
	'DataDump',
	'DiscordNotifications',
	'DismissableSiteNotice',
	'Echo',
	// Required by CentralNotice
	'EventLogging',
	// Required by EventLogging
	'EventStreamConfig',
	'GlobalCssJs',
	'GlobalNewFiles',
	'ImportDump',
	'IncidentReporting',
	'Interwiki',
	'LoginNotify',
	'ManageWiki',
	'MatomoAnalytics',
	'MirahezeMagic',
	'MirahezeMagic/ReCaptchaNoCaptcha',
	'NativeSvgHandler',
	'Nuke',
	'OATHAuth',
	'OAuth',
	'ParserFunctions',
	'QuickInstantCommons',
	'RemovePII',
	'Renameuser',
	'RottenLinks',
	'Scribunto',
	'SecureLinkFixer',
	'SpamBlacklist',
	'TitleBlacklist',
	'TorBlock',
	'WikiDiscover',
	'WikiEditor',
	'cldr',
] );
