<?php
require_once "$IP/extensions/MobileDetect/MobileDetect.php";

if ( version_compare( $wgVersion, '1.35', '>=' ) ) {
	// Required by EventLogging
	wfLoadExtension( 'EventStreamConfig' );
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
	'ConfirmEdit/ReCaptchaNoCaptcha',
	'Echo',
	// Required by CentralNotice
	'EventLogging',
	'GlobalBlocking',
	'GlobalCssJs',
	'GlobalPreferences',
	'IncidentReporting',
	'Interwiki',
	'LocalisationUpdate',
	'LoginNotify',
	'ManageWiki',
	'MatomoAnalytics',
	'MirahezeMagic',
	'Nuke',
	'OATHAuth',
	'OAuth',
	'ParserFunctions',
	'ParsoidBatchAPI',
	'Renameuser',
	// 'RottenLinks',
	'Scribunto',
	'SpamBlacklist',
	'TitleBlacklist',
	'TorBlock',
	'UserMerge',
	'WikiDiscover',
	'WikiEditor',
	'cldr'
] );
