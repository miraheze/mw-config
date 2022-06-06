<?php

if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgConf->settings['wgNoticeProject']['default'] = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 68;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

// Global SiteNotice
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

// Specific wiki SiteNotice
if ( $wi->isAnyOfExtensionsActive( 'AddThis', 'FancyBoxThumbs', 'Foreground', 'GettingStarted', 'MagicNumberedHeadings', 'Pivot' ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>In preparation for the MediaWiki 1.38.0 upgrade on Miraheze, we will be removing the following extensions and skins on 12 June 2022: AddThis, FancyBoxThumbs, Foreground, GettingStarted, MagicNumberedHeadings, and Pivot. Some extensions listed here will be given replacements. You can learn more about this and what else to expect with the 1.38 upgrade <a href="https://meta.miraheze.org/wiki/Special:MyLanguage/MediaWiki/1.38">here</a>. Please note that this is <b>not</b> a final upgrade notice, and we are still a couple of weeks away from upgrading. A final site notice will be givin one week prior to the upgrade.</div></td>
			</tr></tbody></table>
		EOF;
	}
}
