<?php

wfLoadExtension( 'SemanticMediaWiki' );

$wgHooks['MediaWikiServices'][] = 'enableSemantics';

function enableSemantics() {
	enableSemantics( 'semantic-mediawiki.betaheze.org' );
}
