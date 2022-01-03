<?php

if ( $wmgSiteNoticeOptOut ) {
	# Only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

# Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 65;

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
			<td style="font-size:125%"><div data-nosnippet>We are aware of recent issues, including issues with pages loading extremely slowly, or returning 502 or 503 errors. Over the next few weeks we are migrating to new infrastructure, <a href="https://blog.miraheze.org/post/17/introducing_scsvg/">SCSVG</a>. This migration has exacerbated the already existing issues which has plagued Miraheze for quite some time. Once the migration is complete loading should improve drastically. We deeply apologise for all the inconvenience the undoubtedly causes.</div></td>
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
