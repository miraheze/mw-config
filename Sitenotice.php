<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 41;

// Write your SiteNotice below.  Comment out this section to disable.

$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze will be migrating to the new infrastructure, this time with differences and a longer maintenance window.
			We will be doing the larger wikis on March 6th 2020 (Friday) starting from 7pm UTC and lasting till 11PM UTC. Other wikis will be done on March 8, 2020 - 13:00 until 23:00 UTC.
			Wikis will be up the entire time (read only). You can see if one of your wikis is counted as large at <a href="https://meta.miraheze.org/wiki/User:Paladox/Migration_2020-03-06_list">large wikis migration list</a>.</td>
			</tr></tbody></table>
EOF;

	return true;
}
