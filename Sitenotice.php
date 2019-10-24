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

/* $wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze will be doing Server maintenance at 20:15 UTC. Please save your edit's at least 5 minutes before. we apologize for the inconvenience and short notice.</td>
			</tr></tbody></table>
EOF;

	return true;
}*/
