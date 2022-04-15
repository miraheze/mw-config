<?php

wfLoadExtension( 'SemanticMediaWiki' );

$wgHooks['MediaWikiServices'][] = 'loadSemantics';

function loadSemantics() {
	enableSemantics( 'semantic-mediawiki.betaheze.org' );
}
