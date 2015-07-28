<?php
require_once( "$IP/extensions/AbuseFilter/AbuseFilter.php" );
require_once( "$IP/extensions/CentralAuth/CentralAuth.php" );
require_once( "$IP/extensions/CreateWiki/CreateWiki.php" );
wfLoadExtension( 'CheckUser' );
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'MassMessage' );
wfLoadExtension( 'Nuke' );
wfLoadExtension( 'TitleBlacklist' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'SpamBlacklist' );
