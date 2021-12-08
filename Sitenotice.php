<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 62;

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
			<td style="font-size:125%"><div data-nosnippet>Miraheze has upgraded to MediaWiki 1.37.0. If you encounter any technical issues, please create a <a href="https://phabricator.miraheze.org" target="_blank">Phabricator</a> task or join our <a href="https://miraheze.org/discord" target="_blank">Discord server</a>.</div></td>
			</tr></tbody></table>
		EOF;
	}
}
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
