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
			<td style="font-size:125%">Miraheze will be doing some maintenace on our file storage. During this process images may be unavailable and you will not be able to upload images. Maintenance will last for 30 minutes and start at 20:00 UTC time on Thursday 20th.</td>
			</tr></tbody></table>
		EOF;
	}
}

// Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
// or Google will use the sitenotice for their search result snippet.
// Specific wiki sitenotice
/*
if ( $wgDiscordIncomingWebhookUrl || $wgSlackIncomingWebhookUrl ) {
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Unfortunately, between 3 January 2021 and 28 April 2021, Discord & Slack Webhook URLs were available via the MediaWiki API due to <a href="https://github.com/miraheze/ManageWiki/security/advisories/GHSA-jmc9-rv2f-g8vv">GHSA-jmc9-rv2f-g8vv</a>. We advise you to consider resetting and replacing your Discord or Slack webhook via Special:ManageWiki/settings.</td>
			</tr></tbody></table></div>
EOF;
		return true;
	}
}
*/
