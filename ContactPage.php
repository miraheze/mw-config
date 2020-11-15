<?php

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
