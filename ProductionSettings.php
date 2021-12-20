/**
 * ProductionSettings.php for Miraheze.
 */

// AbuseFilter
$wgAbuseFilterCentralDB = 'metawiki';

// BotPasswords
$wgBotPasswordsDatabase = 'mhglobal';

// CentralNotice
$wgCentralSelectedBannerDispatcher = 'https://meta.miraheze.org/w/index.php/Special:BannerLoader';
$wgCentralBannerRecorder = 'https://meta.miraheze.org/w/index.php/Special:RecordImpression';
$wgCentralDBname = 'metawiki';
$wgCentralHost = 'https://meta.miraheze.org';

// CheckUser
$wgCheckUserGBtoollink['centralDB'] = 'metawiki';

// Echo
$wgEchoSharedTrackingCluster = 'echo';
$wgEchoSharedTrackingDB = 'metawiki';

// GlobalBlocking
$wgGlobalBlockingDatabase = 'mhglobal';

// GlobalCssJS
$wgGlobalCssJsConfig['source'] = 'metawiki';
$wgGlobalCssJsConfig['wiki'] = 'metawiki';

// GlobalUserPage
$wgGlobalUserPageAPIUrl = 'https://login.miraheze.org/w/api.php';
$wgGlobalUserPageDBname = 'loginwiki';

// Interwiki
$wgInterwikiCentralDB = 'metawiki';

// OAuth
$wgMWOAuthCentralWiki = 'metawiki';

// UrlShortner
$wgUrlShortenerDBName = 'metawiki';

// Logging
$wgDeprecationReleaseLimit = '1.34'
