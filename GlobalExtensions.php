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
	'EventBus',
	'EventLogging',
	'EventStreamConfig',
	'GlobalCssJs',
	'GlobalNewFiles',
	'ImportDump',
	'InterwikiDispatcher',
	'IPInfo',
	'LoginNotify',
	'ManageWiki',
	'MatomoAnalytics',
	'MediaModeration',
	'MirahezeMagic',
	'MobileDetect',
	'Nuke',
	'OATHAuth',
	'OAuth',
	'ParserFunctions',
	'ParserMigration',
	// 'QuickInstantCommons',
	'RottenLinks',
	'Scribunto',
	// 'SecureLinkFixer',
	'SpamBlacklist',
	// 'StopForumSpam',
	'TitleBlacklist',
	'TorBlock',
	'WikiDiscover',
	'WikiEditor',
	'cldr',
] );

if ( $wi->version < 1.46 ) {
	wfLoadExtension( 'WebAuthn' );
}

wfLoadExtension( 'Parsoid', "$IP/vendor/wikimedia/parsoid/extension.json" );
