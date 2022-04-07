<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 67;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

# Global SiteNotice
if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Miraheze will be doing database maintenance on the 7th of April 2022 at 21:00 UTC time. We apologise for any inconvenience caused, this is emergency maintenance.</div></td>
			</tr></tbody></table>
		EOF;
	}

 }

# Specific wiki SiteNotice
/* if ( $wgUseCategoryBrowser ?? false ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>MediaWiki developers are considering removing <a href="https://www.mediawiki.org/wiki/Manual:&#36;wgUseCategoryBrowser">Category Browser (&#36;wgUseCategoryBrowser)</a>. <b>Miraheze is requesting your feedback on this so we can forward it to MediaWiki developers!</b> Let us know what you think <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Request_for_Feedback:_Removal_of_$wgUseCategoryBrowser_in_MediaWiki_1.38">here</a>.</div></td>
			</tr></tbody></table>
		EOF;
	}
} */
