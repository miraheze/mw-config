<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
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
 if ( $wmgUseLiberty ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>The Liberty skin will be removed on Sunday 5 December 2021 in preparation for the upcoming upgrade to MediaWiki 1.37 due to lack of compatibility with new MediaWiki version. Please see <CN link> for more information.</td>
				</tr></tbody></table></div>
		EOF;
	}
} 
