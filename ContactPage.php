<?php

if ( $wgDBname == 'apellidosmurcianoswiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'Lorenzolaxmonzon',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
		'MustBeLoggedIn' => false,
		'AdditionalFields' => [],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}

if ( $wgDBname == 'ayrshirewiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'Gordonuk',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
		'MustBeLoggedIn' => false,
		'AdditionalFields' => [],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}

if ( $wgDBname == 'cdcwiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'NonstickRon',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // Lets not do this ever for privacy (unless offical forms)
		'MustBeLoggedIn' => false,
		'AdditionalFields' => [],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}

if ( $wgDBname == 'christipediawiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'Kees Langeveld',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
		'MustBeLoggedIn' => false,
		'AdditionalFields' => [],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}

if ( $wgDBname == 'guiaslocaiswiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'Eduaddad',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
		'MustBeLoggedIn' => false,
		'AdditionalFields' => [],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}
