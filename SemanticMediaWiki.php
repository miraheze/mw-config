<?php

$wgExtensionFunctions[] = 'loadSemantics';
function loadSemantics() {
	enableSemantics( $wi->server, true );
}

$smwgPageSpecialProperties = [
	'_MDAT',
	'_MIME',
	'_MEDIA',
	'_ATTCH_LINK',
];
