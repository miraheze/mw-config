<?php

$wgExtensionFunctions[] = 'loadSemantics';
function loadSemantics() {
	enableSemantics( $wi->server, true );
}
// $smwgUpgradeKey = 'smw:2022-04-18';
$smwgPageSpecialProperties = [
	'_MDAT',
	'_MIME',
	'_MEDIA',
	'_ATTCH_LINK',
];
