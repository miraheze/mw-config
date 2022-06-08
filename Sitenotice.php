<?php

if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgConf->settings['wgNoticeProject']['default'] = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 69;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

// Global SiteNotice
// if ( !$wmgSiteNoticeOptOut ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter'; // show to all users

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>Miraheze will be upgrading to the latest version of MediaWiki (1.38) on Wednesday, 15 June 2022 from <b><u>20:00 UTC</b></u> to approximately 22:00 UTC. During this time, you will not be able to save changes to your wiki. Please make sure to save any edits at least 5 minutes before the upgrade begins.</div></td>
			</tr></tbody></table>
		EOF;
	}

// }

// Specific wiki SiteNotice
if ( $wi->isAnyOfExtensionsActive( 'AddThis', 'FancyBoxThumbs', 'Foreground', 'GettingStarted', 'HeaderFooter', 'MagicNumberedHeadings', 'Pivot' ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'disabledExtensionsSiteNotice';

	function disabledExtensionsSiteNotice( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td style="font-size:125%"><div data-nosnippet>In preparation for this upgrade, we will be removing the following extensions and skins on 12 June 2022: <a href="https://www.mediawiki.org/wiki/Extension:AddThis" target="_blank">AddThis</a>, <a href="https://www.mediawiki.org/wiki/Extension:FancyBoxThumbs" target="_blank">FancyBoxThumbs</a>, <a href="https://www.mediawiki.org/wiki/Extension:Foreground" target="_blank">Foreground</a>, <a href="https://www.mediawiki.org/wiki/Extension:GettingStarted" target="_blank">GettingStarted</a>, <a href="https://www.mediawiki.org/wiki/Extension:Header_Footer" target="_blank">Header Footer</a>, <a href="https://www.mediawiki.org/wiki/Extension:MagicNumberedHeadings" target="_blank">MagicNumberedHeadings</a>, and <a href="https://www.mediawiki.org/wiki/Skin:Pivot" target="_blank">Pivot</a>. Note that for some of the preceding listed extensions, there will be forthcoming suitable replacement extensions added. You can learn more about this and what else to expect with the 1.38 upgrade <a href="https://meta.miraheze.org/wiki/Special:MyLanguage/MediaWiki/1.38" target="_blank">here</a>.</div></td>
			</tr></tbody></table>
		EOF;
	}
}
