<?php

$wgNoticeProject = 'all';
if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 91;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

// Global SiteNotice
// if ( !$wmgSiteNoticeOptOut ) {
/*
 $wgHooks['SiteNoticeAfter'][] = 'wfGlobalSiteNotice';

function wfGlobalSiteNotice( &$siteNotice, $skin ) {
	$skin->getOutput()->enableOOUI();
	$skin->getOutput()->addInlineStyle(
		'.mw-dismissable-notice .mw-dismissable-notice-body { margin: unset; }' .
		'.skin-cosmos #sitenotice-learnmore-button { margin-left: 50px; }'
	);

	$siteNotice .= <<<EOF
		<table style="width: 100%; font-size: 120%; border-left: 4px solid #fc3; background-color: #d5fdf4; border-left-color: #00af89; padding: 10px 15px; color: black !imporant;">
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
								On March 5th, 2025 from 18:45 until 20:45 UTC we will be performing maintenance on our servers. During this time we expect intermittent outages of all services, so we highly recommend saving your edits before then.
							</div>
						</td>
					</tr>
				</div>
			</tbody>
		</table>
	EOF;
}
*/

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

// Meta Tech NS sitenotice
/* if ( $wgDBname === 'metawiki' ) {
	$wgHooks['SiteNoticeAfter'][] = 'wfMetaSiteNotice';

	function wfMetaSiteNotice( &$siteNotice, $skin ) {
		$title = $skin->getTitle();
		if ( $title->getNamespace() !== 1600 ) {
			return;
		}

		$skin->getOutput()->enableOOUI();
		$skin->getOutput()->addInlineStyle(
		'.mw-dismissable-notice .mw-dismissable-notice-body { margin: unset; }' .
		'.skin-cosmos #sitenotice-learnmore-button { margin-left: 50px; }'
		);
		$siteNotice .= <<<EOF
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="border-left: 4px solid #fc3; background-color: #fef6e7; padding: 10px 15px;">
					<div style="padding-top: 0.3em; padding-bottom: 0.1em; font-size: 100%;">
						<img alt="OOjs UI icon web-progressive" src="https://upload.wikimedia.org/wikipedia/commons/9/9e/OOjs_UI_icon_web-progressive.svg" decoding="async" width="35" height="35" style="float: left; margin-right: 10px;">
						<div style="font-weight: bold;">Vacancy</div>
						SRE is looking for Software Engineers to join our MediaWiki Team to develop code to improve the user experience of Miraheze users, build tools that allow communities to grow, and tools that support our valuable volunteers in managing a dynamic and active global community. If you think this could be you, please do have a look at the <a href="https://meta.miraheze.org/wiki/Miraheze_Vacancies#Software_Engineer_(Developer)_(MediaWiki)">the Vacancies page</a> which includes more information.
					</div> <br /> Other vacancies are also available on that page.
				</td>
			</tr>
			<tr>
				<td style="height: 10px;"></td>
			</tr>
		</tbody>
	</table>
EOF;
	}
} */
