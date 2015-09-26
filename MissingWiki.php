<?php

if ( !in_array( $wgDBname, $wgLocalDatabases ) ) {
    header( "HTTP/1.0 404 Not Found" );
    $requestURL = htmlspecialchars( $_SERVER['REQUEST_URI'] );
    date_default_timezone_set( 'UTC' ); // Set to UTC +0
    $fullTimestamp = date( "Y-m-d H:i:s" );
    echo <<<EOF
    <html>
        <head>
            <link rel="stylesheet" href="//meta.miraheze.org/w/load.php?modules=mediawiki.skinning.interface%7Cskins.vector.styles&amp;only=styles&amp;skin=vector&amp;*">
        </head>
        <body>
            <div style="text-align: center;">
                <h1>404 Wiki Not Found</h1>
                <p>The wiki you wanted to visit does not exist. Please be sure you typed the URL correctly.</p>
                <p>If you think there's a technical problem, please provide the system administrators with the following details:</p>
                <p style="font-size:14px;align:center;">
                    <table style="font-style:italic;" align="center">
                        <tbody>
                            <tr>
                                <td>Host: {$_SERVER['HTTP_HOST']}</td>
                                <td>Visitor IP: {$_SERVER['REMOTE_ADDR']}</td>
                            </tr>
                            <tr>
                                <td>Request URL: {$requestURL}</td>
                                <td>Timestamp: {$fullTimestamp}</td>
                            </tr>
                        </tbody>
                    </table>
                </p> 
            </div>
            <div style="float:right;padding-right:1em;">
                <a href="https://meta.miraheze.org/wiki/Miraheze">
                    <img src="https://static.miraheze.org/metawiki/7/7e/Powered_by_Miraheze.png" alt="Powered by Miraheze" />
                </a>
            </div>
        </body>
    </html>
EOF;
    die( 1 );
}
