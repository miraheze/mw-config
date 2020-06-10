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
	'autowikinlwiki',
	'blueoathwiki',
	'commonsensewikiwiki',
	'confraternitewiki',
	'connexuswiki',
	'cptvirajwiki',
	'csydeswiki',
	'cyannewiki',
	'dgwhawiki',
	'digital02wiki',
	'ebrilondwiki',
	'elmetaversewiki',
	'eurekapediawiki',
	'fabulousfanfictionwiki',
	'fbghostitawiki',
	'feralworthwikiwiki',
	'flardwiki',
	'fortressblastwiki',
	'gslcforumwiki',
	'gspbeogradwikiwiki',
	'hamropediawiki',
	'heliohostwiki',
	'hibernuswiki',
	'historiawikiwiki',
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
	'mccmwiki',
	'mcpkwiki',
	'megrezwiki',
	'mikekilitterboxwiki',
	'moxiaozhenwikiwiki',
	'mrjaroslavikwiki',
	'namulivewiki',
	'npbwikiwiki',
	'nynthidbwiki',
	'oneirowiki',
	'osaindexwiki',
	'patriamwiki',
	'physiosciencewiki',
	'pillareternalwiki',
	'playlifegamewiki',
	'questiowiki',
	'ranchstorywiki',
	'robocupfhwswiki',
	'sagan4alphawiki',
	'senetywiki',
	'stockcarracingwiki',
	'svlphysikrostockwiki',
	'tbpcaawiki',
	'thegirlfriendssagawiki',
	'tolbiamcwiki',
	'tundracorpwiki',
	'twilightsignalwiki',
	'twitchwiki',
	'typedesignwiki',
	'umipediawiki',
	'unicodesubsetswiki',
	'vituzzuwiki',
	'warshipswiki',
	'westerwynwiki',
	'widestreetsmapsanddrawingswiki',
	'wikisaiwiki',
	'worldtrainwikiwiki',
	'x3270wiki',
	'yowwiki',
	'zhdelwiki',
	'zhinawikiwiki',
	'archiopediawiki',
	'astanuwiki',
	'astralwikiwiki',
	'autowikinlwiki',
	'blueoathwiki',
	'commonsensewikiwiki',
	'confraternitewiki',
	'connexuswiki',
	'cptvirajwiki',
	'csydeswiki',
	'cyannewiki',
	'dgwhawiki',
	'digital02wiki',
	'ebrilondwiki',
	'elmetaversewiki',
	'eurekapediawiki',
	'fabulousfanfictionwiki',
	'fbghostitawiki',
	'feralworthwikiwiki',
	'flardwiki',
	'fortressblastwiki',
	'gslcforumwiki',
	'gspbeogradwikiwiki',
	'hamropediawiki',
	'heliohostwiki',
	'hibernuswiki',
	'historiawikiwiki',
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
	'mccmwiki',
	'mcpkwiki',
	'megrezwiki',
	'mikekilitterboxwiki',
	'moxiaozhenwikiwiki',
	'mrjaroslavikwiki',
	'namulivewiki',
	'npbwikiwiki',
	'nynthidbwiki',
	'oneirowiki',
	'osaindexwiki',
	'patriamwiki',
	'physiosciencewiki',
	'pillareternalwiki',
	'playlifegamewiki',
	'questiowiki',
	'ranchstorywiki',
	'robocupfhwswiki',
	'sagan4alphawiki',
	'senetywiki',
	'stockcarracingwiki',
	'svlphysikrostockwiki',
	'tbpcaawiki',
	'thegirlfriendssagawiki',
	'tolbiamcwiki',
	'tundracorpwiki',
	'twilightsignalwiki',
	'twitchwiki',
	'typedesignwiki',
	'umipediawiki',
	'unicodesubsetswiki',
	'vituzzuwiki',
	'warshipswiki',
	'westerwynwiki',
	'widestreetsmapsanddrawingswiki',
	'wikisaiwiki',
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
			<td>Due to a renaming of some permissions upstream, it is possible that during past months users holding rights on the wiki may have had access to private AbuseFilter logs. This has now been reverted. They would have had access to IPs and other data when registered users triggerd an abuse filter.</td>
			</tr></tbody></table>
EOF;
		return true;
	}
}
