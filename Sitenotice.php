<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 39;

// Write your SiteNotice below.  Comment out this section to disable.
$val = [
	'allthetropeswiki',
	'buswiki',
	'isvwiki',
	'metawiki',
	'nonsensopediawiki',
	'pointmanwiki',
	'test1wiki',
];

if ( in_array( $wgDBname, $val ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze will be doing ElasticSearch maintenance at 21:30 UTC to 22:30 UTC. During this period, searching may not work.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
