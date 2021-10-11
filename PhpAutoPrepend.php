<?php

function wfSetupProfiler() {
	global $wmgProfiler;
	$wmgProfiler = [];

	/**
	 * When using ?forceprofile=1, a profile can be found as an HTML comment
	 * Disabled on production hosts because it seems to be causing performance issues (how ironic)
	 */
	$forceprofile = $_GET['forceprofile'] ?? 0;
	if ( ( $forceprofile == 1 || PHP_SAPI === 'cli' ) && extension_loaded( 'tideways_xhprof' ) ) {
		$xhprofFlags = TIDEWAYS_XHPROF_FLAGS_CPU | TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_NO_BUILTINS;
		tideways_xhprof_enable( $xhprofFlags );

		$wmgProfiler = [
			'class' => 'ProfilerXhprof',
			'flags' => $xhprofFlags,
			'output' => 'text',
		];
	}
}

function wfSetTimeLimit() {
	// Configure PHP request timeouts.
	if ( PHP_SAPI === 'cli' ) {
		set_time_limit( 0 );
	} elseif ( ( $_SERVER['HTTP_HOST'] ?? '' ) === 'mwtask1.miraheze.org' ) {
		set_time_limit( 1200 );
	} elseif ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
		set_time_limit( 200 );
	} else {
		set_time_limit( 60 );
	}
}

wfSetupProfiler();
wfSetTimeLimit();
