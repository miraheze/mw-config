<?php

 if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 56;

//if ( !$wmgSiteNoticeOptOut ) {
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;
	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%">Miraheze is in the process of migrating its technical infrastructure, so it file uploads will be temporarily disabled on all Miraheze customer wikis until further notice. We apologize for any inconvenience. Thank you</td>
			</tr></tbody></table>
EOF;
}
