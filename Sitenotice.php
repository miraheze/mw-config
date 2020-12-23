<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 52;

if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td style="font-size:125%">Following last night's emergency maintenance and the removal of [[:mediawikiwiki:Extension:Widgets|Widgets]]. Miraheze has released a [[:m:23-12-2020 Security Disclosure|Security Disclosure]]. Apologies for any inconvenience.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
