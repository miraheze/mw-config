<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wgNoticeProject = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 60;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

# Global SiteNotice
/*if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Miraheze is currently doing file storage maintenance right now. You won't be able to upload any files or make any changes until 21:00 UTC time. We apologise for any inconvenience caused by this.</div></td>
			</tr></tbody></table>
		EOF;
	}
}*/

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
