<?php

define( 'MW_NO_SESSION', 1 );
define( 'MW_ENTRY_POINT', 'robots' );

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );

use MediaWiki\Content\TextContent;
use MediaWiki\MediaWikiServices;
use MediaWiki\Title\Title;

$page = MediaWikiServices::getInstance()
	->getWikiPageFactory()
	->newFromTitle( Title::newFromText( 'Mediawiki:robots.txt' ) );

header( 'Content-Type: text/plain; charset=utf-8' );
header( 'Vary: X-Subdomain' );

$robotsfile = '/srv/mediawiki/config/robots.txt';
$robots = fopen( $robotsfile, 'rb' );
$robotsfilestats = fstat( $robots );
$mtime = $robotsfilestats['mtime'];
$extratext = '';

header( 'Cache-Control: s-maxage=3600, must-revalidate, max-age=0' );

$dontIndex = "User-agent: *\nDisallow: /\n";

if ( $page->exists() ) {
	$content = $page->getContent();
	$extratext = ( $content instanceof TextContent ) ? $content->getText() : '';
	// Take last modified timestamp of page into account
	$mtime = max( $mtime, wfTimestamp( TS_UNIX, $page->getTouched() ) );
} elseif ( php_uname( 'n' ) === 'test151' ) {
	echo $dontIndex;
}

$lastmod = gmdate( 'D, j M Y H:i:s', $mtime ) . ' GMT';
header( "Last-modified: $lastmod" );

fpassthru( $robots );

echo "#\n#\n#----------------------------------------------------------#\n#\n#\n#\n";
# Dynamic sitemap url
echo "# Dynamic sitemap url" . "\r\n";
echo "Sitemap: {$wgServer}/sitemap.xml" . "\r\n\n";

echo "#\n#\n#----------------------------------------------------------#\n#\n#\n#\n";
echo $extratext;
