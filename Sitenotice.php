<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 61;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

# Global SiteNotice
// if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Miraheze will be upgrading to the latest version of MediaWiki (1.37) on Tuesday 7 December 2021 from <b><u>17:00 UTC</b></u> to approximately 20:00 UTC. During this time, you will not be able to edit your wiki. Please make sure to save any edits 5 minutes before the upgrade begins.  </div></td>
			</tr></tbody></table>
		EOF;
	}
// }
/*
# Specific wiki SiteNotice
 if ( $wmgUseLiberty ?? false ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
				<td style="font-size:125%">The Liberty skin will be removed on Sunday 5 December 2021 in preparation for the upcoming upgrade to MediaWiki 1.37 due to lack of compatibility with new MediaWiki version. Please see <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Removal_of_the_Liberty_skin">this post</a> for more information.</td>
				</tr></tbody></table></div>
		EOF;
	}
 }*/
