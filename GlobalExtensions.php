<?php

wfLoadExtensions( [
	'AbuseFilter',
	'AntiSpoof',
	'BetaFeatures',
	'CentralNotice',
	'CheckUser',
	'CreateWiki',
	'CookieWarning',
	'ConfirmEdit',
	'ConfirmEdit/hCaptcha',
	'DataDump',
	'DiscordNotifications',
	'DismissableSiteNotice',
	'Echo',
	// Required by CentralNotice
	'EventLogging',
	'GlobalCssJs',
	'GlobalNewFiles',
	'ImportDump',
	'Interwiki',
	'InterwikiDispatcher',
	'IPInfo',
	'LoginNotify',
	'ManageWiki',
	'MatomoAnalytics',
	'MessageCachePerformance',
	'MirahezeMagic',
	'MobileDetect',
	'NativeSvgHandler',
	'Nuke',
	'OATHAuth',
	'OAuth',
	'ParserFunctions',
	'QuickInstantCommons',
	// 'ReportIncident',
	'RottenLinks',
	'Scribunto',
	// 'SecureLinkFixer',
	'SpamBlacklist',
	// 'StopForumSpam',
	'TitleBlacklist',
	'TorBlock',
	'WebAuthn',
	'WikiDiscover',
	'WikiEditor',
	'cldr',
] );

if ( $wi->version >= 1.41 ) {
	wfLoadExtension( 'ParserMigration' );
}

wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );
