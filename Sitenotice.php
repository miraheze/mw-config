<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 40;

// Write your SiteNotice below.  Comment out this section to disable.

$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>This is very important! If you have performed an action (edited/created a page, uploaded content, created an account, etc. basically everything that's not reading) between 14:45 UTC and 16:30 UTC at 2020-02-15, you can't see those anymore.</td>
			<td>For (most) public wikis, we are able to find edits, but for private wikis we cannot do that. If you have edited/uploaded during this time period something, regardless of whether the wiki is public or private, please contact us as soon as possible using our procedure. It can be found at https://phabricator.miraheze.org/maniphest/task/edit/form/15/.</td>
			<td>Regarding the migration issues, system administrators are working on fixing remnants of the rollback. All wikis can be read and edited without issues now.</td>
			<td>Miraheze would like to apologise again, due to the huge complexity of this migration, things went wrong (not only technical wise but also communication wise). We are focussing on restoring full functionality, that is our highest priority now. A post-mortem is in the works and will be provided when ready</td>
			</tr></tbody></table>
EOF;

	return true;
}
