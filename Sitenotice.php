<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 50;

// Write your SiteNotice below.  Comment out this section to disable.
if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td style="font-size:125%">If you experence login issues, please delete your cookies. If you persist to have issues, please go to Special:UserLogout and then re-delete the cookies and try and login again. If you continue to still have issues please let us know at <a href="https://meta.miraheze.org/wiki/Community_noticeboard">Community noticeboard</A></td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
