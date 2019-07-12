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
				<td>Miraheze is doing some ElasticSearch maintenance. During this time searching may not work. We apologise for any inconvenience caused by this.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
