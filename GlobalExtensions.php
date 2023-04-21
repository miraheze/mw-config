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
	// Required by EventLogging
	'EventStreamConfig',
	'GlobalCssJs',
	'GlobalNewFiles',
	'ImportDump',
	'IncidentReporting',
	'Interwiki',
	'IPInfo',
	'LoginNotify',
	'ManageWiki',
	'MatomoAnalytics',
	'MirahezeMagic',
	'MobileDetect',
	'NativeSvgHandler',
	'NewSignupPage',
	'Nuke',
	'OATHAuth',
	'OAuth',
	'ParserFunctions',
	'QuickInstantCommons',
	'Renameuser',
	'RottenLinks',
	'Scribunto',
	// 'SecureLinkFixer',
	'SpamBlacklist',
	'StopForumSpam',
	'TitleBlacklist',
	'TorBlock',
	'WebAuthn',
	'WikiDiscover',
	'WikiEditor',
	'cldr',
] );
