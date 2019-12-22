<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 40;

// Write your SiteNotice below.  Comment out this section to disable.

$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze will be upgrading to MediaWiki 1.34 at 21:40 UTC! The upgrade will last 30 minutes. Please save your edits 5 minutes before.</td>
			</tr></tbody></table>
EOF;

	return true;
}
