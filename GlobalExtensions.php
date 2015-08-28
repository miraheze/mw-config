<?php
require_once( "$IP/extensions/AbuseFilter/AbuseFilter.php" );
require_once( "$IP/extensions/AntiSpoof/AntiSpoof.php" );
require_once( "$IP/extensions/CategoryTree/CategoryTree.php" );
require_once( "$IP/extensions/CentralAuth/CentralAuth.php" );
require_once( "$IP/extensions/ConfirmEdit/ConfirmEdit.php" );
require_once( "$IP/extensions/GlobalBlocking/GlobalBlocking.php" );
require_once( "$IP/extensions/Math/Math.php" );
require_once( "$IP/extensions/MobileFrontend/MobileFrontend.php" );
require_once( "$IP/extensions/OAuth/OAuth.php" );
require_once( "$IP/extensions/SiteMatrix/SiteMatrix.php" );
require_once( "$IP/extensions/Timeline/Timeline.php" );
require_once( "$IP/extensions/UrlShortener/UrlShortener.php" );
wfLoadExtension( 'CheckUser' );
wfLoadExtension( 'Cite' );
wfLoadExtension( 'CiteThisPage' );
wfLoadExtension( 'ConfirmEdit/ReCaptchaNoCaptcha' );
wfLoadExtension( 'Disambiguator' );
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'Interwiki' );
wfLoadExtension( 'MassMessage' );
wfLoadExtension( 'MirahezeMagic' );
wfLoadExtension( 'Nuke' );
wfLoadExtension( 'Renameuser' );
wfLoadExtension( 'TitleBlacklist' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'SpamBlacklist' );

require_once( "$IP/extensions/GlobalCssJs/GlobalCssJs.php" );
$wgGlobalCssJsConfig = array(
	'wiki' => 'metawiki',
	'source' => 'metawiki',
);
$wgResourceLoaderSources['metawiki'] = array(
	'apiScript' => '//meta.miraheze.org/w/api.php',
	'loadScript' => '//meta.miraheze.org/w/load.php',
);
