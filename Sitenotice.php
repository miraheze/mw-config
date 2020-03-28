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

if ( isset( $wgLBFactoryConf[$wgDBname] ) && ($wgLBFactoryConf[$wgDBname] != 'c4' || $wgLBFactoryConf[$wgDBname] != 'c5') ) {
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze is doing maintenance on db at 17:00 UTC. This will last till 22:00 UTC. During this time your wiki will be in read only. Please save edits 5 minutes before.</td>
			</tr></tbody></table>
EOF;

		return true;
}
}
