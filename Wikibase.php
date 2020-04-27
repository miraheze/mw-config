<?php
$wgWBRepoSettings['entityNamespaces']['item'] = 860;
$wgWBRepoSettings['entityNamespaces']['property'] = 862;
$wgWBRepoSettings['sharedCacheKeyPrefix'] = $wgDBname . ':WBL/' . rawurlencode( WBL_VERSION );
$wgWBRepoSettings['allowEntityImport'] = false;
$wgWBRepoSettings['enableEntitySearchUI'] = true;
$wgWBRepoSettings['siteLinkGroups'] = [
	'miraheze'
];
$wgWBRepoSettings['specialSiteLinkGroups'] = [];

$wgWBClientSettings['repoUrl'] = 'https://' . $wi->hostname;
$wgWBClientSettings['repoDatabase'] = $wi->dbname;
$wgWBClientSettings['changesDatabase'] = $wi->dbname;
$wgWBClientSettings['siteGroup'] = 'miraheze';
$wgWBClientSettings['repoNamespaces'] = [
	'wikibase-item' => 'Item',
	'wikibase-property' => 'Property'
];
