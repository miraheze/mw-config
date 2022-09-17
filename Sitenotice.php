<?php

$wgNoticeProject = 'all';
if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 72;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

// Global SiteNotice
/* if ( !$wmgSiteNoticeOptOut ) {
	// show to all users
	$wgHooks['SiteNoticeAfter'][] = static function ( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table style="width: 100% !important;">
			<tbody><tr>
			<td style="font-size: 120%; border-left: 4px solid #67440F; background-color: #FFF2F6; padding: 10px 15px; color: black;"><div style="padding-top:0.3em; padding-bottom:0.1em;"><div data-nosnippet><div class="floatleft"><img alt="MediaWiki 1.38" src="https://upload.wikimedia.org/wikipedia/commons/8/8c/MediaWiki-2020-large-icon.svg" decoding="async" width="50" height="50"></div> Miraheze will be performing necessary database maintenace tomorrow (August 30th 2022) between 20:00-20:30 UTC. During this period wikis will be inaccessible for a period of up to 10 minutes while restarts are done.</div></div>
			</td></tr>
			</tbody></table>
		EOF;
	};
} */

// Specific wiki SiteNotice
if ( $wi->isExtensionActive( 'WikiForum' ) ) {
	$wgHooks['SiteNoticeAfter'][] = static function ( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Due to a security vulnerability, WikiForum has been temporarily disabled on all wikis. </div></td>
			</tr></tbody></table>
		EOF;
	};
} 
