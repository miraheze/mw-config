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

/* $wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Due to a recent change, some users may experience login issues, to correct them please follow the steps outlined at <a href="https://meta.miraheze.org/m/4FU">https://meta.miraheze.org/m/4FU</a>.</td>
			</tr></tbody></table>
EOF;

		return true;
}
*/

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
$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
function onSiteNoticeAfter( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Due to a missed blacklist of some permissions, it is possible that during past months users holding rights on the wiki may have had access to private AbuseFilter logs. This has now been correct. They would have had access to IPs when registered users triggerd an abuse filter.</td>
			</tr></tbody></table>
EOF;
		return true;
	}
}
