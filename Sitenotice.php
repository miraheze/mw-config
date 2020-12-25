<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 52;

/* if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td style="font-size:125%">Following the emergency maintenance on 22nd December and the removal of <a href="https://mediawiki.org/wiki/Extension:Widgets">Widgets</a>. Miraheze has released a <a href="https://meta.miraheze.org/wiki/23-12-2020_Security_Disclosure">Security Disclosure</a>. Apologies for any inconvenience.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
} */
