<?php

// Open logs and set the syslog.ident to a sensible value on php-fpm
if ( PHP_SAPI === 'fpm-fcgi' ) {
	openlog( 'php7.3-fpm', LOG_ODELAY, LOG_DAEMON );
}

/**
 * Configure timeouts. These should be slightly less than the Apache timeouts,
 * so that the slightly more informative PHP error message is delivered to the
 * user, and so that we can verify that PHP timeouts actually exist (T97192).
 */
function mirahezeSetTimeLimit() {
	global $wmgTimeLimit;
	if ( PHP_SAPI === 'cli' ) {
		// The time limit should already be zero, and Maintenance.php should set it to zero
		$wmgTimeLimit = 0;
		return;
	}
	$host = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : '';
	switch ( $host ) {
		case 'jobrunner1.miraheze.org':
		case 'jobrunner2.miraheze.org':
			$wmgTimeLimit = 1200;
			break;

		default:
			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
				$wmgTimeLimit = 200;
			} else {
				$wmgTimeLimit = 60;
			}
	}

    set_time_limit( $wmgTimeLimit );
}

mirahezeSetTimeLimit();
