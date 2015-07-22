<?php
require_once( "$IP/extensions/AbuseFilter/AbuseFilter.php" );
require_once( "$IP/extensions/CentralAuth/CentralAuth.php" );
wfLoadExtension( 'CheckUser' );
wfLoadExtension( 'TitleBlacklist' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'SpamBlacklist' );
