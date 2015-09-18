<?php

if ( !in_array( $wgDBname, $wgLocalDatabases ) ) {
    header( "HTTP/1.0 404 Not Found" );
    echo <<<EOF
    <center><h1>404 Wiki Not Found</h1></center>
<center>You can request your own wiki, follow the steps <a href="https://meta.miraheze.org/wiki/Special:RequestWiki">here</a>!</center>
    <hr>
    <center>nginx - MediaWiki</center>
EOF;
    die( 1 );
}
