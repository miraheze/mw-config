<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 42;

// Write your SiteNotice below.  Comment out this section to disable.

$list = [
	'nonciclopediawiki',
	'toxicfandomsandhatedomswiki',
	'nonsensopediawiki',
];

if ( in_array( $wgDBname, $list ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze is performing emergency server maintenance. This wiki will be read-only until approximately 00:30 UTC.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
} else {
		$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>The maintenance window for the migration is over. Miraheze is sorry for the issues that popped up after the migration.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
