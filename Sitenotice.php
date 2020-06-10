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
	'atbwwiki',
	'autowikinlwiki',
	'blueoathwiki',
	'chesswiki',
	'chesswiki',
	'chesswiki',
	'commonsensewikiwiki',
	'confraternitewiki',
	'connexuswiki',
	'cptvirajwiki',
	'csydeswiki',
	'cutywikiwiki',
	'cutywikiwiki',
	'cyannewiki',
	'dgwhawiki',
	'digital02wiki',
	'dungeonsanddaddieswiki',
	'dungeonsanddaddieswiki',
	'ebrilondwiki',
	'educationpediyawiki',
	'educationpediyawiki',
	'educationpediyawiki',
	'educationpediyawiki',
	'elmetaversewiki',
	'eurekapediawiki',
	'fabulousfanfictionwiki',
	'fbghostitawiki',
	'feralworthwikiwiki',
	'flagswiki',
	'flagswiki',
	'flardwiki',
	'fortressblastwiki',
	'gmcwiki',
	'gmcwiki',
	'gslcforumwiki',
	'gspbeogradwikiwiki',
	'hamropediawiki',
	'heliohostwiki',
	'hibernuswiki',
	'historiawikiwiki',
	'historyworldwiki',
	'historyworldwiki',
	'hololivewiki',
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
	'madnesscombatwiki',
	'mccmwiki',
	'mcpkwiki',
	'megrezdevwiki',
	'megrezdevwiki',
	'megrezdevwiki',
	'megrezwiki',
	'mikekilitterboxwiki',
	'mikekiwiki',
	'mikekiwiki',
	'mikekiwiki',
	'mikekiwiki',
	'mikekiwiki',
	'mikekiwiki',
	'moviepediawiki',
	'moviepediawiki',
	'moviepediawiki',
	'moxiaozhenwikiwiki',
	'mrjaroslavikwiki',
	'namulivewiki',
	'npbwikiwiki',
	'nynthidbwiki',
	'olegcinemawiki',
	'olegcinemawiki',
	'oneirowiki',
	'onlyonewiki',
	'onlyonewiki',
	'onlyonewiki',
	'osaindexwiki',
	'patriamwiki',
	'physiosciencewiki',
	'pillareternalwiki',
	'playlifegamewiki',
	'questiowiki',
	'radisworldwiki',
	'radisworldwiki',
	'ranchstorywiki',
	'raspidewiki',
	'raspidewiki',
	'robocupfhwswiki',
	'sagan4alphawiki',
	'senetywiki',
	'shiropediawiki',
	'shiropediawiki',
	'stockcarracingwiki',
	'svlphysikrostockwiki',
	'tbpcaawiki',
	'thegirlfriendssagawiki',
	'tolbiamcwiki',
	'tpowwiki',
	'tpowwiki',
	'tundracorpwiki',
	'twilightsignalwiki',
	'twitchwiki',
	'typedesignwiki',
	'uaschoolswikiwiki',
	'uaschoolswikiwiki',
	'uaschoolswikiwiki',
	'umipediawiki',
	'unicodesubsetswiki',
	'uniwikiwiki',
	'uniwikiwiki',
	'vituzzuwiki',
	'warshipswiki',
	'westerwynwiki',
	'widestreetsmapsanddrawingswiki',
	'wikihezewiki',
	'wikihezewiki',
	'wikilexiconwiki',
	'wikilexiconwiki',
	'wikiloucowiki',
	'wikiloucowiki',
	'wikiloucowiki',
	'wikisaiwiki',
	'wikitestwiki',
	'wikitestwiki',
	'wikitheoswiki',
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
			<td>Due to a renaming of some permissions upstream, it is possible that during past months users holding rights on the wiki may have had access to private AbuseFilter logs. This has now been reverted. They would have had access to IPs and other data when registered users triggerd an abuse filter.</td>
			</tr></tbody></table>
EOF;
		return true;
	}
}
