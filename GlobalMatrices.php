<?php

// Skins
if ( $wmgSkinMatrix ) {
	$mhSM = $wmgSkinMatrix;
	if ( $mhSM['apex'] ) {
		wfLoadSkin( 'apex' );
	}
	if ( $mhSM['dusktodawn'] ) {
		wfLoadSkin( 'DuskToDawn' );
	}
	if ( $mhSM['erudite'] ) {
		wfLoadSkin( 'erudite' );
	}
	if ( $mhSM['foreground'] ) {
		wfLoadSkin( 'foreground' );
	}
	if ( $mhSM['metrolook'] ) {
		wfLoadSkin( 'Metrolook' );
	}
	if ( $mhSM['monaco'] ) {
		require_once( "$IP/skins/Monaco/monaco.php" );
	}
	if ( $mhSM['nostalgia'] ) {
		wfLoadSkin( 'Nostalgia' );
	}
	if ( $mhSM['refreshed'] ) {
		wfLoadSkin( 'Refreshed' );
	}
}

// Editing
if ( $wmgEditingMatrix ) {
        $mhEM = $wmgEditingMatrix;
        if ( $mhEM['anon'] ) {
                $wgGroupPermissions['*']['edit'] = false;
                $wgGroupPermissions['*']['createpage'] = false;
        }

        if ( $mhEM['user'] ) {
                $wgGroupPermissions['user']['edit'] = false;
                $wgGroupPermissions['user']['createpage'] = false;
        }

        if ( $mhEM['editor'] ) {
                $wgGroupPermissions['editor']['edit'] = true;
                $wgGroupPermissions['editor']['createpage'] = true;
                $wgAddGroups['sysop'][] = 'editor';
                $wgRemoveGroups['sysop'][] = 'editor';
        }

        if ( $mhEM['sysop'] ) {
                $wgGroupPermissions['sysop']['edit'] = true;
                $wgGroupPermissions['sysop']['createpage'] = true;
        }
}
