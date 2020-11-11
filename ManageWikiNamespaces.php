<?php

$wgManageWikiNamespacesAdditional => [
	'wgExtraSignatureNamespaces' => [
		'name' => 'Enable "Signature" button on the edit toolbar under both main and talk pages.',
		'type' => 'check',
		'from' => 'mediawiki',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => [],
	],
	'wgCapitalLinkOverrides' => [
		'name' => 'Force the first letter of links to capitals. Overrides $wgCapitalLinks for this namespace.',
		'type' => 'vestyle',
		'from' => 'mediawiki',
		'main' => true,
		'talk' => false,
		'blacklisted' => [
			2,
			8,
		],
		'overridedefault' => [],
	],
];
