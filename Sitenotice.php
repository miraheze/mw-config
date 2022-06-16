<?php

if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgConf->settings['wgNoticeProject']['default'] = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 71;

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
			<td style="font-size: 120%; border-left: 4px solid #67440F; background-color: #FFF2F6; padding: 10px 15px; color: black;"><div style="padding-top:0.3em; padding-bottom:0.1em;"><div data-nosnippet><div class="floatleft"><img alt="MediaWiki 1.38" src="https://upload.wikimedia.org/wikipedia/commons/8/8c/MediaWiki-2020-large-icon.svg" decoding="async" width="50" height="50"></div> Miraheze has upgraded to MediaWiki 1.38. If you notice any bugs, please report them on <a href="https://meta.miraheze.org/wiki/Phabricator">Phabricator</a>, <a href="https://meta.miraheze.org/wiki/Discord">Discord</a>, or <a href="https://meta.miraheze.org/wiki/IRC">IRC</a>.</div></div>
			</td></tr>
			</tbody></table>
		EOF;
	}

// }

$wgHooks['SiteNoticeAfter'][] = 'onVectorNoticeAfter';

function onVectorNoticeAfter( &$siteNotice, $skin ) {
	$siteNotice .= <<<EOF
		<table style="width: 100% !important;">
		<tbody><tr>
		<td style="font-size: 120%; border-left: 4px solid #67440F; background-color: #FFF2F6; padding: 10px 15px;"><div style="padding-top:0.3em; padding-bottom:0.1em;"><div data-nosnippet><div class="floatleft"><img alt="Advisory" src="https://upload.wikimedia.org/wikipedia/commons/c/ca/OOjs_UI_icon_info.svg" decoding="async" width="50" height="50"></div>MediaWiki 1.38 intoduced new changes to Vector which includes a new design. If you wish to revert to go back to Legacy Vector, go to Special:Preferences and select Legacy Vector. To rollback your wiki, go to Special:ManageWiki/settings -> Styling -> Default skin and set the default skin to Legacy Vector.</div></div> 
		<div style="text-align:center;"><a href="https://meta.miraheze.org/wiki/Special:MyLanguage/MediaWiki/1.38" title="MediaWiki 1.38"><span class="mw-ui-button mw-ui-progressive mw-ui-small">Click here to learn more about the upgrade!</span></a></div></div>
		</td></tr>
		</tbody></table>
	EOF;
}

// Specific wiki SiteNotice
/* if ( $wi->isAnyOfExtensionsActive( 'Vector' ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';

	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		$siteNotice .= <<<EOF
			<table style="width: 100% !important;">
			<tbody><tr>
			<td style="font-size: 120%; border-left: 4px solid #67440F; background-color: #FFF2F6; padding: 10px 15px;"><div style="padding-top:0.3em; padding-bottom:0.1em;"><div data-nosnippet><div class="floatleft"><img alt="Advisory" src="https://upload.wikimedia.org/wikipedia/commons/c/ca/OOjs_UI_icon_info.svg" decoding="async" width="50" height="50"></div>MediaWiki 1.38 intoduced new changes to Vector which includes a new design. If you wish to revert to go back to Legacy Vector, go to Special:Preferences and select Legacy Vector. To rollback your wiki, go to Special:ManageWiki/settings -> Styling -> Default skin and set the default skin to Legacy Vector.</div></div> 
			<div style="text-align:center;"><a href="https://meta.miraheze.org/wiki/Special:MyLanguage/MediaWiki/1.38" title="MediaWiki 1.38"><span class="mw-ui-button mw-ui-progressive mw-ui-small">Click here to learn more about the upgrade!</span></a></div></div>
			</td></tr>
			</tbody></table>
		EOF;
	}
} */
