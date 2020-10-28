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
				<td style="font-size:125%">Miraheze has upgraded to the latest version of MediaWiki (1.35)! However, if you experience any issues, please do let us know on <a href="https://phabricator.miraheze.org/">Phabricator<a></a>.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
