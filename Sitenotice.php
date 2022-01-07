<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 66;

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
			<td style="font-size:125%"><div data-nosnippet>We will be migrating to newer and faster servers. <b>Migration will begin at 22:45 UTC on 14 January, 2022<b> and all wikis will be set to read-only for about 30 minutes. Please save your edits 5-10 minutes before! Images uploads will also be disabled at 19:45 UTC. For more information, click <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Things_to_note_for_the_upcoming_migration_and_downtime_notice">here</a>.</div></td>
			</tr></tbody></table>
		EOF;
	}

// }

# Specific wiki SiteNotice
/* if ( $wmgUseComments ?? false ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
				<td style="font-size:125%">Due to extreme performance issues with the "commentlist" API module, it has been disabled. As a result, Comments may not load while it is disabled. We apologize for the inconvience and are working upstream to fix the issue and reenable Comments as soon as possible. Please see <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Comments_disabled">this Meta post</a> for more information.</td>
				</tr></tbody></table></div>
		EOF;
	}
} */
