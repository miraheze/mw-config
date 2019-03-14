<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 34;

// Write your SiteNotice below.  Comment out this section to disable.
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant, $wgDBname;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze is currently low on storage for uploads. Because of this most upload attempts will fail. We apologize for this.</td>
			</tr></tbody></table>
EOF;

	if ( $wgDBname === 'allthetropeswiki' ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze is currently performing maintenance that might affect the search functionality on this wiki. We are sorry for the inconvenience.</td>
			</tr></tbody></table>
EOF;
	}

	return true;
}
