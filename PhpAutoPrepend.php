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
			'running' => true,
			'output' => 'text',
		];
	}
	$host = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] ?? '';
	if ( $host = 'mw8.miraheze.org' ) {
		$xhprofFlags = TIDEWAYS_XHPROF_FLAGS_CPU | TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_NO_BUILTINS;
		tideways_xhprof_enable( $xhprofFlags );

		$wmgProfiler = [
			'class' => 'ProfilerXhprof',
			'flags' => $xhprofFlags,
			'running' => true,
			'output' => 'ProfilerOutputDump',
			'outputDir' => '/srv/mediawiki/cache/profile'
		];
	}
}

wfSetupProfiler();
