<?php

if ( !in_array( $wgDBname, $wgLocalDatabases ) && !$wgCommandLineMode ) {
    header( "HTTP/1.0 404 Not Found" );
    $requestURL = htmlspecialchars( $_SERVER['REQUEST_URI'] );
    date_default_timezone_set( 'UTC' ); // Set to UTC +0
    $fullTimestamp = date( 'Y-m-d H:i:s' );
    echo <<<EOF
    <html>
        <head>
            <style type="text/css">
                html, body {
                    height: 100%;
                    margin: 0;
                    padding: 0;
                    font-family: sans-serif;
                }
                html {
                    font-size: 100%;
                }
                body {
                    background-color: hsl(0, 0%, 96%);
                }
                h1, h2 {
                    margin-bottom: .6em !important;
                }
                h1 {
                    font-size: 188%;
                }
                h1, h2, h3, h4, h5, h6 {
                    color: hsl(0, 0%, 0%);
                    background: none;
                    font-weight: normal;
                    margin: 0;
                    overflow: hidden;
                    padding-top: .5em;
                    padding-bottom: .17em;
                    border-bottom: 1px solid hsl(0, 0%, 67%);
                }
                p {
                    margin: .4em 0 .5em 0;
                }
            </style>
        </head>
        <body>
            <div style="text-align: center;">
                <h1>404 Wiki Not Found</h1>
                <p>The wiki you wanted to visit does not exist. Please be sure you typed the URL correctly.</p>
                <p>You can find all of our existing wikis <a href="https://meta.miraheze.org/wiki/Special:SiteMatrix">here</a>.</p>
                <p>If you think there's a technical problem, please contact the system administrators and provide the following details:</p>
                <p style="align:center;">
                    <table style="font-style: italic; font-size: 14px;" align="center">
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
            <div style="float: right; padding-right: 1em;">
                <a href="https://meta.miraheze.org/wiki/Miraheze">
                    <img src="https://static.miraheze.org/metawiki/7/7e/Powered_by_Miraheze.png" alt="Powered by Miraheze" />
                </a>
            </div>
        </body>
    </html>
EOF;
    die( 1 );
} elseif ( !in_array( $wgDBname, $wgLocalDatabases ) && $wgCommandLineMode ) {
    // $wgDBname will always be set to a string, even if the --wiki parameter was not passed to a script.
    echo "The wiki database '$wgDBname' was not found." . PHP_EOL;
}
