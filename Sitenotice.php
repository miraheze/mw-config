<?php

$wgNoticeProject = 'all';
if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 81;

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
			<table style="width: 100%;">
				<tbody><tr><td style="font-size: 120%; border-left: 4px solid #ff1e00; background-color: #ff5200cf; padding: 10px 15px; color: whitesmoke;">
					<div data-nosnippet style="padding-top:0.3em; padding-bottom:0.1em;">
						<div class="floatleft"><img alt="Miraheze Logo" src="https://upload.wikimedia.org/wikipedia/commons/b/b7/Miraheze-Logo.svg" decoding="async" width="50" height="50"></div>
						<div style="padding-bottom: 15px; font-size: 13pt; font-weight: bold;">
							Miraheze will be upgrading to the latest version of MediaWiki (1.39) on Saturday, 21 January 2023 from <b><u>22:00 UTC</u></b> to approximately 01:00 UTC on Sunday, 22 January 2023. During this time, you will not be able to save changes to your wiki. Please make sure to save any edits at least 5 minutes before the upgrade begins.
						</div>

						<!-- <span id="sitenotice-learnmore-button" class="oo-ui-widget oo-ui-widget-enabled oo-ui-buttonElement oo-ui-buttonElement-framed oo-ui-iconElement oo-ui-labelElement oo-ui-buttonWidget">
							<a class="oo-ui-buttonElement-button" role="button" tabindex="0" href="...">
								<span class="oo-ui-iconElement-icon oo-ui-icon-notice"></span>
								<span class="oo-ui-labelElement-label">{$skin->msg( 'miraheze-sitenotice-learnmore' )->escaped()}</span>
								<span class="oo-ui-indicatorElement-indicator oo-ui-indicatorElement-noIndicator"></span>
							</a>
						</span> -->
					</div>
				</td></tr></tbody>
			</table>
		EOF;
	}

// }

// Specific wiki SiteNotice
/* if ( !preg_match( '/^([0-9]|a|b|c|d|e|f|g|h|i|j|k|l|m|n|o|q)/', $wgDBname ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'wfConditionalSiteNotice';

	function wfConditionalSiteNotice( &$siteNotice, $skin ) {
		$skin->getOutput()->enableOOUI();
		$skin->getOutput()->addInlineStyle(
			'.mw-dismissable-notice .mw-dismissable-notice-body { margin: unset; }' .
			'.skin-cosmos #sitenotice-learnmore-button { margin-left: 50px; }'
		);

		$siteNotice .= <<<EOF
			<table style="width: 100%;">
				<tbody><tr><td style="font-size: 120%; border-left: 4px solid #ff1e00; background-color: #ff5200cf; padding: 10px 15px; color: whitesmoke;">
					<div data-nosnippet style="padding-top:0.3em; padding-bottom:0.1em;">
						<div class="floatleft"><img alt="Miraheze Logo" src="https://upload.wikimedia.org/wikipedia/commons/b/b7/Miraheze-Logo.svg" decoding="async" width="50" height="50"></div>
						<div style="padding-bottom: 15px; font-size: 13pt; font-weight: bold;">
							This wiki has been migrated to our new file storage software (Swift). If files appear missing for this wiki, please let us know by <a href="https://phabricator.miraheze.org/maniphest/task/edit/form/1">creating a task on Phabricator</a>. Thank you.
						</div>

						<span id="sitenotice-learnmore-button" class="oo-ui-widget oo-ui-widget-enabled oo-ui-buttonElement oo-ui-buttonElement-framed oo-ui-iconElement oo-ui-labelElement oo-ui-buttonWidget">
							<a class="oo-ui-buttonElement-button" role="button" tabindex="0" href="https://meta.miraheze.org/wiki/Community_noticeboard#Note_from_SRE_Regarding_the_Swift_Migration">
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
