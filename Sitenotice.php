<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 37;

// Write your SiteNotice below.  Comment out this section to disable.
if ( $wgDBname === 'allthetropeswiki' || $wgDBname === 'buswiki' || $wgDBname === 'isvwiki' || $wgDBname === 'metawiki' || $wgDBname === 'nonsensopediawiki' || $wgDBname === 'pointmanwiki' || $wgDBname === 'test1wiki' ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze will be updating ElasticSearch (the search index used by this wiki) on Tuesday, 9th July at 1am UTC time.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
