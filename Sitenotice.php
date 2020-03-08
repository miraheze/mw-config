<?php

if ( $wmgSiteNoticeOptOut ) {
	// only show important notices when optout
	$wgNoticeProject = 'optout';
}

// Global SiteNotice
// Increment this version number whenever you change the site notice
// and don't comment it out
$wgMajorSiteNoticeID = 42;

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

$wgHooks['SiteNoticeAfter'][] = 'onSiteNoticeAfter2';
function onSiteNoticeAfter2( &$siteNotice, $skin ) {
	global $wmgSiteNoticeOptOut, $snImportant;

	$siteNotice .= <<<EOF
			<table class="wikitable" style="text-align:center;"><tbody><tr>
			<td>Maintenance will be performed on the database servers. As such, the wikis are unavailable between 16:30 and 16:45 UTC. Please save your edits <b>before</b> 16:30 UTC!</td>
			</tr></tbody></table>
EOF;

	return true;
}

if ( !in_array( $wgDBname, $list ) ) {
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
