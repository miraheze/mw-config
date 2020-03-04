<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 41;

// Write your SiteNotice below.  Comment out this section to disable.

$list = [
	'buswiki',
	'pathofexilewiki',
	'tmewiki',
	'vsrecommendedgameswiki',
	'animatedfeetwiki',
	'crappygameswiki',
	'anglishwiki',
	'trollpastawiki',
	'poserdazfreebieswiki',
	'nltramswiki',
	'beidipediawiki',
	'nilamwikiubzx217c40wiki',
	'bluepageswiki',
	'awfulmovieswiki',
	'uncyclopediawiki',
	'tolololpediawiki',
	'platprojectwiki',
	'trollpastawikiwiki',
	'ansaikuropediawiki',
	'pluspiwiki',
	'csydeswiki',
	'atrociousyoutuberswiki',
	'anterrawiki',
	'jayuvandalwiki',
	'ciptamediawiki',
	'bpwiki',
	'terribletvshowswiki',
	'osaindexwiki',
	'newusopediawiki',
	'mc2wiki',
	'jawp2chwiki',
	'sumroletaericwiki',
	'sidemwiki',
	'ranchstorywiki',
	'maiasongcontestwiki',
	'awesomegameswiki',
	'animebathswiki',
	'americangirldollswiki',
	'schattenvonskeloswiki',
	's23wiki',
	'libertygamewiki',
	'healthyfandomsandandhatedomwiki',
	'gyaanipediawiki',
	'bigforestwiki',
	'2b2twiki',
	'simswiki',
	'frikipediawiki',
	'uncyclomirrorwiki',
	'baobabarchiveswiki',
	'zhdelwiki',
	'allthetropeswiki',
	'nonciclopediawiki',
	'toxicfandomsandhatedomswiki',
	'nonsensopediawiki',
];

if ( in_array( $wgDBname, $list ) {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze is intending to move this wiki to new infrastructure on Friday, March 6th 2020. You will still be able to read but won’t be able to edit between the times of 19:00 UTC and 23:00 UTC.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
} else {
	$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter';
	function onSiteNoticeAfter( &$siteNotice, $skin ) {
		global $wmgSiteNoticeOptOut, $snImportant;

		$siteNotice .= <<<EOF
				<table class="wikitable" style="text-align:center;"><tbody><tr>
				<td>Miraheze is intending to move this wiki to new infrastructure on Sunday, March 8th 2020. You will still be able to read but won’t be able to edit between the times of 13:00 UTC and 23:00 UTC.</td>
				</tr></tbody></table>
EOF;

		return true;
	}
}
