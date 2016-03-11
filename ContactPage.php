<?php

if ( $wgDBname == 'extloadwiki' ) {
	// Test form on extloadwiki - this is *not* as complicated as they get
	$wgContactConfig['extloadtest'] = array(
		'RecipientUser' => 'Extloadwiki',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // Lets not do this ever for privacy (unless offical forms)
		'AdditionalFields' => array(),
		'DisplayFormat' => 'table',
		'RLModules' => array(),
		'RLStyleModules' => array(),
	);
}

if ( $wgDBname == 'christipediawiki' ) {
	$wgContactConfig['default'] = array(
		'RecipientUser' => 'Kees Langeveld',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
		'AdditionalFields' => array(),
		'DisplayFormat' => 'table',
		'RLModules' => array(),
		'RLStyleModules' => array(),
	);
}
