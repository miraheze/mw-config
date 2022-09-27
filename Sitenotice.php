<?php

$wgNoticeProject = 'all';
if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 75;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

// Global SiteNotice
/* if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'wfGlobalSiteNotice';

	function wfGlobalSiteNotice( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table style="width: 100% !important;">
			<tbody><tr>
			<td style="font-size: 120%; border-left: 4px solid #67440F; background-color: #FFF2F6; padding: 10px 15px; color: black;"><div style="padding-top:0.3em; padding-bottom:0.1em;"><div data-nosnippet><div class="floatleft"><img alt="Miraheze Logo" src="https://upload.wikimedia.org/wikipedia/commons/b/b7/Miraheze-Logo.svg" decoding="async" width="50" height="50"></div> Miraheze is performing server maintenance at this moment until 21:00 UTC. During this period, wikis may be intermittently inaccessible. Thank you for your understanding</div></div>
			</td></tr>
			</tbody></table>
		EOF;
	}
} */

// Specific wiki SiteNotice
if ( $wi->isExtensionActive( 'WikiForum' ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'wfConditionalSiteNotice';

	function wfConditionalSiteNotice( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Due to a security vulnerability, WikiForum has been temporarily disabled on all wikis. </div></td>
			</tr></tbody></table>
		EOF;
	}
}
