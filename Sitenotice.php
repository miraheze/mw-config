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
/* if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Miraheze will be migrating to newer and faster servers soon. <b>Migration will begin at 22:45 UTC on 14 January, 2022</b> and all wikis will be set to read-only for about 30 minutes. Please save your edits 5-10 minutes before! Images uploads will also be disabled at 19:45 UTC, and all new wiki creations will be paused beginning at 22:15 UTC. For more information, click <a href="https://meta.miraheze.org/wiki/Community_noticeboard#Things_to_note_for_the_upcoming_migration_and_downtime_notice">here</a>.</div></td>
			</tr></tbody></table>
		EOF;
	}

 } */

# Specific wiki SiteNotice
 if ( $cwClosed ?? true ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet><b>Bureaucrats, if you wiki was incorrectly closed</b>: Go to <a href="/wiki/Special:ManageWiki/core">Special:ManageWiki/core</a> and uncheck "Closed" to reopen it. Your wiki may have been closed due to a bug (which we are aware of and working to fix). Please attempt to reopen it yourself first before seeking further assistance.</div></td>
			</tr></tbody></table>
		EOF;
	}
}
