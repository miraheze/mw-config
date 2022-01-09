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
			<td style="font-size:125%"><div data-nosnippet>Miraheze will be migrating to newer and faster servers soon. <b>Migration will begin at 22:45 UTC on 14 January, 2022</b> and all wikis will be set to read-only for about 30 minutes. Please save your edits 5-10 minutes before! Images uploads will also be disabled at 19:45 UTC, and all new wiki creations will be paused beginning at 22:15 UTC. For more information, click <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Things_to_note_for_the_upcoming_migration_and_downtime_notice">here</a>.</div></td>
			</tr></tbody></table>
		EOF;
	}

// }

# Specific wiki SiteNotice
if ( $wgUseCategoryBrowser ?? true ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
				<td style="font-size:125%">MediaWiki developers are considering removing <a href="https://www.mediawiki.org/wiki/Manual:$wgUseCategoryBrowser">Category Browser ($wgUseCategoryBrowser)</a>. <b>Miraheze is requesting your feedback on this so we can forward it to MediaWiki developers!</b> Let us know what you think <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Request_for_Feedback:_Removal_of_$wgUseCategoryBrowser_in_MediaWiki_1.38">here</a>.</td>
				</tr></tbody></table></div>
		EOF;
	}
} 
