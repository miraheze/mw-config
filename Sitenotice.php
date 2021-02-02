<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 56;

// if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%">Miraheze is in the process of migrating its' technical infrastructure to <a href="https://www.ovhcloud.com/en-gb/bare-metal/advance/adv-2/" target="_blank">new, upgraded, and improved servers</a>, as a result file uploads have been disabled on all wikis while this migration takes place. We understand the disruption this causes, and anticipate being able to re-enable file uploads as soon as possible. Thank you for your patience.</td>
			</tr></tbody></table>
		EOF;
	}
// }
