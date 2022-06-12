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
			<table style="width: 100% !important;">
			<tbody><tr>
			<td style="font-size: 120%; border-left: 4px solid #180F67; background-color: #F7F6FF; padding: 10px 15px;"><div style="padding-top:0.3em; padding-bottom:0.1em;"><div data-nosnippet><div class="floatleft"><img alt="Information" src="https://upload.wikimedia.org/wikipedia/commons/c/ca/OOjs_UI_icon_info.svg" decoding="async" width="50" height="50"></div> Miraheze will be upgrading to the latest version of MediaWiki, MediaWiki 1.38, on Wednesday, 15 June 2022 from <b><u>20:00 UTC</u></b> to approximately 22:00 UTC. During this time, you won't be able to make changes to your wiki. Please make sure to save any edits at least 5 minutes before the upgrade begins.</div></div>
			</td></tr>
			</tbody></table>
		EOF;
	}

// }

// Specific wiki SiteNotice
/* if ( $wi->isAnyOfExtensionsActive( 'AddThis', 'FancyBoxThumbs', 'Foreground', 'GettingStarted', 'HeaderFooter', 'MagicNumberedHeadings', 'Pivot' ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table style="width: 100% !important;">
			<tbody><tr>
			<td style="font-size: 120%; border-left: 4px solid #67440F; background-color: #FFF2F6; padding: 10px 15px;"><div style="padding-top:0.3em; padding-bottom:0.1em;"><div data-nosnippet><div class="floatleft"><img alt="Advisory" src="https://upload.wikimedia.org/wikipedia/commons/8/8c/OOjs_UI_icon_markup.svg" decoding="async" width="50" height="50"></div> In preparation for this upgrade, we will be removing the following extensions and skins on 12 June, 2022: <a href="https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:AddThis" title="AddThis" target="_blank">AddThis</a>, <a href="https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:FancyBoxThumbs" title="FancyBoxThumbs" target="_blank">FancyBoxThumbs</a>, <a href="https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Foreground" title="Foreground" target="_blank">Foreground</a>, <a href="https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:GettingStarted" title="GettingStarted" target="_blank">GettingStarted</a>, <a href="https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:Header_Footer" title="Header Footer" target="_blank">Header Footer</a>, <a href="https://www.mediawiki.org/wiki/Special:MyLanguage/Extension:MagicNumberedHeadings" title="MagicNumberedHeadings" target="_blank">MagicNumberedHeadings</a>, and <a href="https://www.mediawiki.org/wiki/Special:MyLanguage/Skin:Pivot" title="Pivot" target="_blank">Pivot</a>. Note that for some of the preceding listed extensions, there will be forthcoming suitable replacement extensions added.</div>
			<div style="text-align:center;"><a href="https://meta.miraheze.org/wiki/Special:MyLanguage/MediaWiki/1.38" title="MediaWiki 1.38"><span class="mw-ui-button mw-ui-progressive mw-ui-small">Click here to learn more about the upgrade!</span></a></div></div>
			</td></tr>
			</tbody></table>
		EOF;
	}
} */
