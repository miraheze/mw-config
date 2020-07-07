<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wi->config->settings['wgNoticeProject']['default'] = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 44;

// Write your SiteNotice below.  Comment out this section to disable.

/*$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Miraheze will be doing database maintenance at 23:00 UTC time. The maintenance will last 1 hour and you may find that the wiki inaccessible or read only during this time. Please save your edits 5 minutes before.</td>
			</tr></tbody></table>
EOF;

	return true;
}*/
/*
$snWikis = [
	'archiopediawiki',
	'astanuwiki',
	'astralwikiwiki',
	'atbwwiki',
	'autowikinlwiki',
	'blueoathwiki',
	'chesswiki',
	'commonsensewikiwiki',
	'confraternitewiki',
	'connexuswiki',
	'cptvirajwiki',
	'csydeswiki',
	'cutywikiwiki',
	'cyannewiki',
	'dgwhawiki',
	'digital02wiki',
	'dungeonsanddaddieswiki',
	'ebrilondwiki',
	'educationpediyawiki',
	'elmetaversewiki',
	'eurekapediawiki',
	'fabulousfanfictionwiki',
	'fbghostitawiki',
	'feralworthwikiwiki',
	'flagswiki',
	'flardwiki',
	'fortressblastwiki',
	'gmcwiki',
	'gslcforumwiki',
	'gspbeogradwikiwiki',
	'hamropediawiki',
	'heliohostwiki',
	'hibernuswiki',
	'historiawikiwiki',
	'historyworldwiki',
	'hololivewiki',
	'hp2020wiki',
	'hypercanewiki',
	'interhippiewiki',
	'investigacionesjsaawiki',
	'javahurricanewiki',
	'labwarewikiwiki',
	'lamptronwiki',
	'lettersfromthewastelandwiki',
	'linexwiki',
	'loliconwiki',
	'lowtechwikiwiki',
	'madnesscombatwiki',
	'mccmwiki',
	'mcpkwiki',
	'megrezdevwiki',
	'megrezwiki',
	'mikekilitterboxwiki',
	'mikekiwiki',
	'moviepediawiki',
	'moxiaozhenwikiwiki',
	'mrjaroslavikwiki',
	'namulivewiki',
	'npbwikiwiki',
	'nynthidbwiki',
	'olegcinemawiki',
	'oneirowiki',
	'onlyonewiki',
	'osaindexwiki',
	'patriamwiki',
	'physiosciencewiki',
	'pillareternalwiki',
	'playlifegamewiki',
	'questiowiki',
	'radisworldwiki',
	'ranchstorywiki',
	'raspidewiki',
	'robocupfhwswiki',
	'sagan4alphawiki',
	'senetywiki',
	'shiropediawiki',
	'stockcarracingwiki',
	'svlphysikrostockwiki',
	'tbpcaawiki',
	'thegirlfriendssagawiki',
	'tolbiamcwiki',
	'tpowwiki',
	'tundracorpwiki',
	'twilightsignalwiki',
	'twitchwiki',
	'typedesignwiki',
	'uaschoolswikiwiki',
	'umipediawiki',
	'unicodesubsetswiki',
	'uniwikiwiki',
	'vituzzuwiki',
	'warshipswiki',
	'westerwynwiki',
	'widestreetsmapsanddrawingswiki',
	'wikihezewiki',
	'wikilexiconwiki',
	'wikiloucowiki',
	'wikisaiwiki',
	'wikitestwiki',
	'wikitheoswiki',
	'worldtrainwikiwiki',
	'x3270wiki',
	'yowwiki',
	'zhdelwiki',
	'zhinawikiwiki'
];
// Specific wiki sitenotices
if ( in_array( $wgDBname, $snWikis ) ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter2';
	function onSiteNoticeAfter2( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Due to a permission being missed to be blacklisted, it is possible that during past months users holding rights on the wiki may have had access to private AbuseFilter logs. This has now been corrected. They would have had access to IPs when registered users triggerd an abuse filter. See <a href="https://meta.miraheze.org/wiki/2020-06-11_Security_Disclosure">Security Disclosure</a>.</td>
				</tr></tbody></table>
EOF;
			return true;
	}
}
*/

$db = $wgLBFactoryConf['sectionsByDB'][$wgDBname];
if ( isset( $db ) && $db == 'c4' ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter3';
	function onSiteNoticeAfter3( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze plans to do database maintenance at 10pm UTC time. Please save your edits at least 5 minutes before. The maintenance will last 5 minutes.</td>
				</tr></tbody></table>
EOF;
			return true;
	}
}
