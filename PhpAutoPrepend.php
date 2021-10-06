<?php

function wfSetupProfiler() {
	$forceprofile = $_GET['forceprofile'] ?? 0;

	if ( ( $forceprofile == 1 || PHP_SAPI === 'cli' ) && extension_loaded( 'tideways_xhprof' ) ) {
		$xhprofFlags = TIDEWAYS_XHPROF_FLAGS_CPU | TIDEWAYS_XHPROF_FLAGS_MEMORY | TIDEWAYS_XHPROF_FLAGS_NO_BUILTINS;
		tideways_xhprof_enable( $xhprofFlags );
	}
}

wfSetupProfiler();
