<?php

if ( !in_array( $wgDBname, $wgLocalDatabases ) ) {
    header( "HTTP/1.0 404 Not Found" );
    echo <<<EOF
<h1 style="text-align: center;"> 404 - Wiki Not Found </h1>
<p style="text-align: center;">If you were trying to access an existing wiki, please be sure you have typed the URL correctly.</p>
<p style="text-align: center;">If you&#39;d like to request a new wiki, you can follow the steps <a href="https://meta.miraheze.org/wiki/Special:RequestWiki">here</a> to do so.</p>
<hr>
<div><div style="float: left;"><p>nginx - MediaWiki</p></div><div style="float: right;"><img src="https://static.miraheze.org/metawiki/7/7e/Powered_by_Miraheze.png" alt="Hosted by Mirahese.org"></div></div>
EOF;
    die( 1 );
}
