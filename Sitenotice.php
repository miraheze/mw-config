<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 58;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

# Global SiteNotice
if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Miraheze is planning file storage maintenance between 20:00 and 21:00 UTC on Tuesday 19th. During this process the file storage server will be read only so you will not be able to upload any images. We apologise for any inconvenience caused by this.</div></td>
			</tr></tbody></table>
		EOF;
	}
}

# Specific wiki SiteNotice
/* if ( $wgDiscordIncomingWebhookUrl || $wgSlackIncomingWebhookUrl ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Unfortunately, between 3 January 2021 and 28 April 2021, Discord & Slack Webhook URLs were available via the MediaWiki API due to <a href="https://github.com/miraheze/ManageWiki/security/advisories/GHSA-jmc9-rv2f-g8vv">GHSA-jmc9-rv2f-g8vv</a>. We advise you to consider resetting and replacing your Discord or Slack webhook via Special:ManageWiki/settings.</td>
				</tr></tbody></table></div>
		EOF;
	}
} */
