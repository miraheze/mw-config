<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 36;

// Write your SiteNotice below.  Comment out this section to disable.
if ( $wmgSearchType ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze will perform maintenance related to the search functionality of this wiki at 22:40 UTC. The maintenance will take about 30 minutes. During this maintenance window you may not be able to use the search box.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
