<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 59;

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
			<td style="font-size:125%"><div data-nosnippet>Miraheze is planning file storage maintenance between 20:00 and 21:00 UTC on Tuesday, 19 October. During this process the file storage server will be read only so you will not be able to upload any images. We apologise for any inconvenience caused by this.</div></td>
			</tr></tbody></table>
		EOF;
	}
}

# Specific wiki SiteNotice
if ( $wmgUseCitoid ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze Site Reliability Engineering is proposing the removal of the Citoid extension, in order to decommission two servers that the extension requires. Please see <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Request_for_feedback_on_disabling_Citoid_and_Collection">the discussion</a> to voice your opinion on the matter.</td>
				</tr></tbody></table></div>
		EOF;
	}
}
