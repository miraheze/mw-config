<?php

wfLoadExtension( 'SemanticMediaWiki' );

$wgExtensionFunctions[] = 'loadSemantics';

function loadSemantics() {
	enableSemantics( 'semantic-mediawiki.betaheze.org' );
}
