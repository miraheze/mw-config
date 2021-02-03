<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 56;

if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%">We are aware of issues where some wikis are unable to upload files, or are experiencing issues in thumbnail rendering. We are trying to resolve this as fast as we can, but we don't currently have an estimated time as to when this will be resolved. We apologise for the inconvenience this may cause, and thank you for your patience.</td>
			</tr></tbody></table>
		EOF;
	}
}
