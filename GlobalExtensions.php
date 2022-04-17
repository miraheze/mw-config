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
	'GlobalCssJs',
	'GlobalNewFiles',
	'IncidentReporting',
	'Interwiki',
	'LocalisationUpdate',
	'LoginNotify',
	'ManageWiki',
	'MatomoAnalytics',
	'MirahezeMagic',
	'MirahezeMagic/ReCaptchaNoCaptcha',
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
	'cldr'
] );
