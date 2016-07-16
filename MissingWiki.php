<?php

if ( !in_array( $wgDBname, $wgLocalDatabases ) && !$wgCommandLineMode ) {
    header( "HTTP/1.0 404 Not Found" );
    $requestURL = htmlspecialchars( $_SERVER['REQUEST_URI'] );
    date_default_timezone_set( 'UTC' ); // Set to UTC +0
    $fullTimestamp = date( 'Y-m-d H:i:s' );
    echo <<<EOF
    <html>
      <head>
        <title>404</title>
        <style>
          @import url(https://fonts.googleapis.com/css?family=Lato:400,700italic);
    
          body {
            background-color: #ecf0f1;
            font-family: 'Lato', sans-serif;
            margin: 0;
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none;   /* Chrome/Safari/Opera */
            -khtml-user-select: none;    /* Konqueror */
            -moz-user-select: none;      /* Firefox */
            -ms-user-select: none;       /* Internet Explorer/Edge */
            user-select: none;           /* Non-prefixed version, currently not supported by any browser */
          }
    
          h3 {
            font-size: 500%;
            margin: 0;
            padding-top: 17vh;
          }
    
          h4 {
            margin: 0;
            padding-bottom: 17vh;
            text-transform: uppercase;
          }
    
          section:first-of-type {
            background-color: #3498db;
            color: #ecf0f1;
            min-height: 50vh;
            text-align: center;
          }
    
          section {
            color: #34495e;
            text-align: center;
            text-transform: uppercase;
          }
    
          table {
            padding-bottom: 17vh;
          }
    
          .padding {
            padding-top: 17vh;
            padding-bottom: 15px;
          }
        </style>
      </head>
      <body>
        <section>
          <h3>404</h3>
          <h4>Wiki Not Found</h4>
        </section>
        <section>
          <h4 class="padding">The wiki you requested could not be found. <br />If you think there's a technical problem, please contact the system administrators.</h4>
          <table align="center">
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
        </section>
      </body>
    </html>
EOF;
    die( 1 );
} elseif ( !in_array( $wgDBname, $wgLocalDatabases ) && $wgCommandLineMode ) {
    // $wgDBname will always be set to a string, even if the --wiki parameter was not passed to a script.
    echo "The wiki database '$wgDBname' was not found." . PHP_EOL;
}
