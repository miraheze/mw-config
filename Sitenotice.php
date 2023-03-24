<?php

$wgNoticeProject = 'all';
if ( $wmgSiteNoticeOptOut ) {
	// Only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Increment this version number whenever you change the site notice
$wgMajorSiteNoticeID = 82;

/**
 * Wrap your sitenotice with <div data-nosnippet>(sitenotice)</div>
 * or Google will use the sitenotice for their search result snippet.
 */

// Global SiteNotice
// if ( !$wmgSiteNoticeOptOut ) {
/*	$wgHooks['SiteNoticeAfter'][] = 'wfGlobalSiteNotice';

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
							Miraheze has upgraded to MediaWiki 1.39. If you notice any bugs, please report them on <a href="https://meta.miraheze.org/wiki/Phabricator">Phabricator</a>, <a href="https://miraheze.org/discord">Discord</a>, or <a href="https://meta.miraheze.org/wiki/IRC">IRC</a>.
						</div>

						<span id="sitenotice-learnmore-button" class="oo-ui-widget oo-ui-widget-enabled oo-ui-buttonElement oo-ui-buttonElement-framed oo-ui-iconElement oo-ui-labelElement oo-ui-buttonWidget">
							<a class="oo-ui-buttonElement-button" role="button" tabindex="0" href="https://meta.miraheze.org/wiki/Special:MyLanguage/MediaWiki/1.39">
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

// }
*/
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

// Meta Tech NS sitenotice
if ( $wgDBname === 'metawiki' ) {
$wgHooks['SiteNoticeAfter'][] = 'wfGlobalSiteNotice';

function wfGlobalSiteNotice( &$siteNotice, $skin ) {
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
                        <img alt="OOjs UI icon web-progressive" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/OOjs_UI_icon_web-progressive.svg/35px-OOjs_UI_icon_web-progressive.svg.png" decoding="async" width="35" height="35" style="float: left; margin-right: 10px;">
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
}
