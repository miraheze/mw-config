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
if ( !$wmgSiteNoticeOptOut && $wi->wikiDBClusters[$wgDBname] === 'c4' ?? null ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td style="font-size:125%">Miraheze is planning to do emergency database maintenance at 20:20 UTC. The maintenance should only last 20 minutes.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
