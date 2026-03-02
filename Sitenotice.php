<?php

$wgNoticeProject = 'all';
if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 93;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

// Global SiteNotice
// if ( !$wmgSiteNoticeOptOut ) {

$wgHooks['SiteNoticeAfter'][] = 'wfGlobalSiteNotice';

function wfGlobalSiteNotice( &$siteNotice, $skin ) {
	$skin->getOutput()->enableOOUI();
	$skin->getOutput()->addInlineStyle(
		'.mw-dismissable-notice .mw-dismissable-notice-body { margin: unset; }' .
		'.skin-cosmos #sitenotice-learnmore-button { margin-left: 50px; }'
	);

	$siteNotice .= <<<EOF
		<table style="width: 100%; font-size: 120%; border-left: 4px solid #fc3; background-color: #d5fdf4; border-left-color: #00af89; padding: 10px 15px; color: black !important;">
			<tbody>
				<div data-nosnippet style="padding-top:0.3em; padding-bottom:0.1em;">
					<tr>
						<td rowspan=2><div style="float: left;"><img alt="Server maintenance" src="https://upload.wikimedia.org/wikipedia/commons/e/e1/OOjs_UI_icon_desktop.svg" decoding="async" width="40" height="40"></div></td>
						<td>
							<div style="font-weight: bold; color: black;">
								Server maintenance
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div style="padding-bottom: 15px; font-size: 13pt; color: black;">
								Miraheze will be performing upgrades on cloud servers on March 5, 2026 from 20:00 to March 6 03:00 UTC. During this time Miraheze will be completely unavailable. We apologize for the inconvenience and thank you for your understanding.
							</div>
						</td>
					</tr>
				</div>
			</tbody>
		</table>
	EOF;
}

// }

// Specific wiki SiteNotice
/* if ( $wi->isExtensionActive( 'Graph' ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'wfConditionalSiteNotice';

	function wfConditionalSiteNotice( &$siteNotice, $skin ) {
		$skin->getOutput()->enableOOUI();
		$skin->getOutput()->addInlineStyle(
			'.mw-dismissable-notice .mw-dismissable-notice-body { margin: unset; }' .
			'.skin-cosmos #sitenotice-learnmore-button { margin-left: 50px; }'
		);

		$siteNotice .= <<<EOF
			<table style="width: 100%;">
				<tbody><tr><td style="font-size: 120%; border-left: 4px solid #67440F; background-color: #FFF2F6; padding: 10px 15px; color: black;">
					<div data-nosnippet style="padding-top:0.3em; padding-bottom:0.1em;">
						<div class="floatleft"><img alt="Miraheze Logo" src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Font_Awesome_5_solid_bug.svg" decoding="async" width="50" height="50"></div>
						<div style="padding-bottom: 15px; font-size: 13pt; font-weight: bold;">
							 Graph has been permanently discontinued due to a severe security issue.
						</div>

						<span id="sitenotice-learnmore-button" class="oo-ui-widget oo-ui-widget-enabled oo-ui-buttonElement oo-ui-buttonElement-framed oo-ui-iconElement oo-ui-labelElement oo-ui-buttonWidget">
							<a class="oo-ui-buttonElement-button" role="button" tabindex="0" href="https://meta.miraheze.org/wiki/Tech:SRE_noticeboard#Graph_disabled">
								<span class="oo-ui-iconElement-icon oo-ui-icon-notice"></span>
								<span class="oo-ui-labelElement-label">{$skin->msg( 'miraheze-sitenotice-learnmore' )->escaped()}</span>
								<span class="oo-ui-indicatorElement-indicator oo-ui-indicatorElement-noIndicator"></span>
							</a>
						</span>
					</div>
				</td></tr></tbody>
			</table>
		EOF;
	}
} */
/*
// LE Domain sitenotice
$LEWikis = [
	"archivesofhavnorwiki",
	"anomalyzonewikiwiki",
	"baharnawiki",
	"baligawiki",
	"balloonfightwiki",
	"tfoswiki",
	"binrayarchiveswiki",
	"blackmagicwiki",
	"boneswordwiki",
	"clinithequewiki",
	"decimatedrivewiki",
	"echoeswiki",
	"ekumenwiki",
	"evilgeniuswiki",
	"exmormonwiki",
	"fairytailwiki",
	"corsiwiki",
	"fanojowiki",
	"farthestfrontierwiki",
	"ff8wiki",
	"hellowhirledwiki",
	"empireinflameswiki",
	"iceriawiki",
	"wandelenwiki",
	"lotrminecraftmodwiki",
	"lotrruwiki",
	"magistrowiki",
	"maxcapacitywiki",
	"mockgovernmentswiki",
	"occhygienewikiwiki",
	"osrwikiwiki",
	"partopediawiki",
	"pso2ngswiki",
	"psychoengineeringwiki",
	"raidrushwiki",
	"removededmsongswiki",
	"richterianwiki",
	"rodzinkaplwiki",
	"sptwikiwiki",
	"thegreatwarwiki",
	"transgenderwiki",
	"vilexiawiki",
	"voecwiki",
	"uavolunteerresourceswiki",
	"weavefarerswiki",
	"wikicawiki",
	"momawiki",
	"wizardiawiki",
	"wonderfuleverydaywiki",
	"worldlesswiki",
	"yepediawiki",
];
if ( in_array( $wgDBname, $LEWikis, true ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'wfLESiteNotice';

	function wfLESiteNotice( &$siteNotice, $skin ) {
		$title = $skin->getTitle();

		$skin->getOutput()->enableOOUI();
		$skin->getOutput()->addInlineStyle(
		'.mw-dismissable-notice .mw-dismissable-notice-body { margin: unset; }' .
		'.skin-cosmos #sitenotice-learnmore-button { margin-left: 50px; }'
		);
		$siteNotice .= <<<EOF
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="border-left: 4px solid #000000; background-color: #ea9999; padding: 10px 15px;">
					<div style="padding-top: 0.3em; padding-bottom: 0.1em; font-size: 100%;">
						<img alt="OOjs UI icon web-progressive" src="https://upload.wikimedia.org/wikipedia/commons/3/3c/OOjs_UI_icon_notice.svg" decoding="async" width="35" height="35" style="float: left; margin-right: 10px;">
						<div style="font-weight: bold;">Custom domain</div>
						The custom domain for this wiki is currently using our DNS service which is actively being phased out, so that we may route all traffic through Cloudflare. This is an alert that unless the domain owner follows the instructions <a href="https://issue-tracker.miraheze.org/T13309">here,</a> the domain will be removed without further notice, and the wiki will revert to its original miraheze.org subdomain.
					</div>
				</td>
			</tr>
			<tr>
				<td style="height: 10px;"></td>
			</tr>
		</tbody>
	</table>
EOF;
	}
}
unset( $LEWikis );
*/
