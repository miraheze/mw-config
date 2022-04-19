<?php

$wgExtensionFunctions[] = 'loadSemantics';
function loadSemantics() {
	global $smwgUpgradeKey;
	$smwgUpgradeKey = 'smw:2022-04-18';
	enableSemantics( $wi->server, true );
}
// $smwgUpgradeKey = 'smw:2022-04-18';
$smwgPageSpecialProperties = [
	'_MDAT',
	'_MIME',
	'_MEDIA',
	'_ATTCH_LINK',
];
