<?php

header( 'Content-Type: text/html; charset=utf-8' );
header( 'Cache-Control: s-maxage=2678400, max-age=2678400' );

$path = $_SERVER['REQUEST_URI'];
$encUrl = htmlspecialchars( $path );

if ( preg_match( '/(%2f)/i', $path, $matches )
	|| preg_match( '/^\/(?:upload|style|wiki|w|extensions)\/(.*)/i', $path, $matches )
) {
	// "/w/Foo" -> "/wiki/Foo"
	$target = '/wiki/' . $matches[1];
} else {
	// "/Foo" -> "/wiki/Foo"
	$target = '/wiki' . $path;
}
$encTarget = htmlspecialchars( $target );

$outputHtml = <<<END
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Wiki not Found">
		<title>Wiki not Found</title>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
		<style>
			/* Error Page Inline Styles */
			body {
				padding-top: 20px;
			}
			/* Layout */
			.jumbotron {
				font-size: 21px;
				font-weight: 200;
				line-height: 2.1428571435;
				color: inherit;
				padding: 10px 0px;
			}
			/* Everything but the jumbotron gets side spacing for mobile-first views */
			.masthead, .body-content {
				padding-left: 15px;
				padding-right: 15px;
			}
			/* Main marketing message and sign up button */
			.jumbotron {
				text-align: center;
				background-color: transparent;
			}
			.jumbotron .btn {
				font-size: 21px;
				padding: 14px 24px;
			}
			/* Colors */
			.green {color:#5cb85c;}
			.orange {color:#f0ad4e;}
			.red {color:#d9534f;}
		</style>
	</head>
	<div class="container">
		<!-- Jumbotron -->
		<div class="jumbotron">
			<h1><img src="https://static.miraheze.org/metawiki/3/35/Miraheze_Logo.svg" alt="Miraheze Logo">Page not found</h1>
			<p><em>$encUrl</em></p>
			<p>We could not find the above page on our servers.</p>
			<p><b>Did you mean: <a href="$encTarget">$encTarget</a></b></p>
			<p style="clear:both;">Alternatively, you can visit the <a href="/">Main Page</a> or read <a href="https://en.wikipedia.org/wiki/HTTP_404" title="Wikipedia: HTTP 404">more information</a> about this type of error.</p>
		</div>
	</div>
</html>
END;

print $outputHtml;
