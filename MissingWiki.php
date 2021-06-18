<?php

if ( !$wgCommandLineMode ) {
	http_response_code( 404 );
	$requestURL = htmlspecialchars( $_SERVER['REQUEST_URI'] );
	date_default_timezone_set( 'UTC' ); // Set to UTC +0
	$fullTimestamp = date( 'Y-m-d H:i:s' );

	echo <<<EOF
		<!DOCTYPE html>
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
					<h1><img src="https://static.miraheze.org/metawiki/3/35/Miraheze_Logo.svg" alt="Miraheze Logo">404 Wiki not Found</h1>
					<p class="lead">We couldn't find the wiki you were looking for on our servers.</p>
					<p>
						<a href="https://meta.miraheze.org/wiki/Special:MyLanguage/Miraheze" class="btn btn-lg btn-outline-success" role="button">Take me to Miraheze Meta</a>
					</p>
				</div>
			</div>
			<div class="container">
				<div class="body-content">
					<div style="text-align:center;">
						<h2>What can I do?</h2>
						<p class="lead">If you're a wiki visitor:</p>
						<p>This wiki does not exist on our servers. You can browse wikis on our network <a href="https://meta.miraheze.org/wiki/Special:WikiDiscover">here</a> or <a href="https://archive.org/search.php?query=miraheze">view archive.org archives</a>.</p>
						<p class="lead">If you're the wiki bureaucrat:</p>
						<p>If this is a problem, please <a href="https://meta.miraheze.org/wiki/Special:MyLanguage/Help_center">contact us</a>.</p>
					</div>
				</div>
			</div>
		</html>
	EOF;

	die( 1 );
} else {
	// $wgDBname will always be set to a string, even if the --wiki parameter was not passed to a script.
	echo "The wiki database '{$wgDBname}' was not found." . PHP_EOL;
}
