<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 30;

// Write your SiteNotice below.  Comment out this section to disable.
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>If you use a *.miraheze.org domain you can ignore this. If you use a custom domain then please read on. Due to a fault on our side a private key associated with your custom domain may have been compromised. This private key allows users to intercept any traffic related to your wiki which could result in compromised user accounts.</td>
			</tr></tbody></table>
EOF;
	return true;
}
