<?php

require_once '/srv/mediawiki/w/extensions/SemanticMediaWiki/includes/GlobalFunctions.php';
require_once '/srv/mediawiki/w/extensions/SemanticMediaWiki/includes/SemanticMediaWiki.php';
require_once '/srv/mediawiki/w/extensions/SemanticMediaWiki/src/ConfigPreloader.php';

wfLoadExtension( 'SemanticMediaWiki' );
enableSemantics( 'semantic-mediawiki.betaheze.org' );
