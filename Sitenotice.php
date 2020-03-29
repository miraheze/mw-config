<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 43;

// Write your SiteNotice below.  Comment out this section to disable.

/*$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze is doing maintenance on DB at 20:00 UTC. This will last until approximately 02:00 UTC. During this time your wiki may be in read only mode. Please save edits 5 minutes before. We apologise that we are doing another migration, but it is necessary in order to reduce the recent slow loading times.</td>
			</tr></tbody></table>
EOF;

		return true;
}*/
