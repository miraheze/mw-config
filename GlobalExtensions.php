<?php

require_once "$IP/extensions/MobileDetect/MobileDetect.php";

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
	'GlobalBlocking',
	'GlobalCssJs',
	'GlobalNewFiles',
	'GlobalPreferences',
	'IncidentReporting',
	'Interwiki',
	'LoginNotify',
	'ManageWiki',
	'MatomoAnalytics',
	'MirahezeMagic',
	'MirahezeMagic/ReCaptchaNoCaptcha',
	'Nuke',
	'OATHAuth',
	'OAuth',
	'ParserFunctions',
	'RemovePII',
	'Renameuser',
	'RottenLinks',
	'Scribunto',
	'SecureLinkFixer',
	'SpamBlacklist',
	'TitleBlacklist',
	'TorBlock',
	'UserMerge',
	'WikiDiscover',
	'WikiEditor',
	'cldr'
] );
