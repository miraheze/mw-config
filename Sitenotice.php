<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 56;

/* if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%">We are aware of issues where some wikis are unable to upload files, or are experiencing issues in thumbnail rendering. We are trying to resolve this as fast as we can, but we don't currently have an estimated time as to when this will be resolved. We apologise for the inconvenience this may cause, and thank you for your patience.</td>
			</tr></tbody></table>
		EOF;
	}
} */


// Specific wiki sitenotice
if ( $wgDiscordIncomingWebhookUrl || $wgSlackIncomingWebhookUrl ) {
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Unfortunately, Between 3 January 2021 and 28 April 2021, Discord & Slack Webhook URLs were available via the MediaWiki API due to <a href="https://github.com/miraheze/ManageWiki/security/advisories/GHSA-jmc9-rv2f-g8vv">GHSA-jmc9-rv2f-g8vv</a>. We advise you to consider resetting and replacing your Discord or Slack webhook via Special:ManageWiki/settings.</td>
			</tr></tbody></table>
EOF;
		return true;
	}
}

