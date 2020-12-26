<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 55;

// if ( !$wmgSiteNoticeOptOut ) {
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;
	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%">Miraheze has updated the recent <a href="https://meta.miraheze.org/wiki/23-12-2020_Security_Disclosure">Security Disclosure</a> to strongly advise ALL users immediately reset their passwords and 2FA tokens for Miraheze Wikis.</td>
			</tr></tbody></table>
EOF;
// }
