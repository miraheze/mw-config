<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 46;

// Write your SiteNotice below.  Comment out this section to disable.

/*$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze needs to perform emergency maintenance on one of its database clusters. To do that, one of the servers must be restarted. Maintenance is scheduled between July 8, 20:45 UTC and 21:15 UTC. Please save your edits before 20:45 UTC!</td>
			</tr></tbody></table>
EOF;

	return true;
}*/

 if ( isset( $wi->config->settings['wgLBFactoryConf']['default']['sectionsByDB'][$wgDBname] ) &&
     $wi->config->settings['wgLBFactoryConf']['default']['sectionsByDB'][$wgDBname] === 'c1' ) {
 	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
 	function onSiteNoticeAfter( &$siteNotice, $skin ) {
 		global $wmgSiteNoticeOptOut, $snImportant;

 		$siteNotice .= <<<EOF
 				<table class="wikitable" style="text-align:center;"><tbody><tr>
 				<td>Miraheze plans to do Database maintenance at 21:00 UTC time. It is expected to last 6 hours, during this time your wiki may turn into read only mode.</td>
 				</tr></tbody></table>
 EOF;

 		return true;
 	}
 }
