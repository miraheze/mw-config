<?php

define( 'MW_NO_SESSION', 1 );
define( 'MW_ENTRY_POINT', 'robots' );

require_once '/srv/mediawiki/config/initialise/MirahezeFunctions.php';
require MirahezeFunctions::getMediaWiki( 'includes/WebStart.php' );

use MediaWiki\Content\TextContent;
use MediaWiki\MediaWikiServices;
use MediaWiki\SpecialPage\SpecialPage;
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

// Localized special page paths
$specialPagePath = SpecialPage::getTitleFor( 'DOESNOTEXIST' )->getLocalURL();
$specialPrefix = substr( $specialPagePath, 0, strpos( $specialPagePath, 'DOESNOTEXIST' ) );
while ( true ) {
	$line = fgets( $robots );
	if ( $line === false ) {
		break;
	}
	if ( strpos( $line, 'REPLACEME_SPECIAL' ) !== false ) {
		// Some robots.txt parsers don't like the percent-encoded form
		$prefix2 = rawurldecode( $specialPrefix );
		if ( $specialPrefix === $prefix2 ) {
			$prefixes = [ $specialPrefix ];
		} else {
			$prefixes = [ $specialPrefix, $prefix2 ];
		}

		foreach ( $prefixes as $prefix ) {
			echo "Disallow: $prefix\n";
			// Handle the other URL pattern in case article root changes
			if ( str_starts_with( $prefix, '/wiki/' ) ) {
				$newPrefix = str_replace( '/wiki/', '/', $prefix );
			} else {
				$newPrefix = '/wiki' . $prefix;
			}
			echo "Disallow: $newPrefix\n";
		}
	} else {
		echo $line;
	}
}

echo "#\n#\n#----------------------------------------------------------#\n#\n#\n#\n";
# Dynamic sitemap url
echo "# Dynamic sitemap url" . "\r\n";
echo "Sitemap: {$wgServer}/sitemap.xml" . "\r\n\n";

echo "#\n#\n#----------------------------------------------------------#\n#\n#\n#\n";
echo $extratext;
