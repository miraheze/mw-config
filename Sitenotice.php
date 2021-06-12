<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}


# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 57;

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
			<td style="font-size:125%"><div data-nosnippet>Miraheze plans to upgrade to the latest version of MediaWiki (1.36) on Saturday (12 June, 2021) from 19:00 UTC time to approximately 21:00 UTC. Editing wikis will not be possible during this time. Please make sure to save your edits 5 minutes before the upgrade begins.</div></td>
			</tr></tbody></table>
		EOF;
	}
} 

# Specific wiki SiteNotice
 if ( $wmgUseDiscussionTools ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<div data-nosnippet><table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Unfortunately, Miraheze has had to temporarily disable the DiscussionTools extension due to it causing an error with MediaWiki 1.36 - A fix has been submitted for review, and the extension will be re-enabled ASAP.</td>
				</tr></tbody></table></div>
		EOF;
	}
} 
