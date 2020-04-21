<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 44;

// Write your SiteNotice below.  Comment out this section to disable.

$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze plans to do Database mainteance on Tuesday 21st of April 2020 at 22:00 UTC time</td>
			<td>Due to a recent change, some users may experience login issues, to correct them please follow the steps outlined at <a href="https://meta.miraheze.org/m/4FU">https://meta.miraheze.org/m/4FU</a>.</td>
			</tr></tbody></table>
EOF;

		return true;
}

