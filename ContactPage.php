<?php

if ( $wgDBname == 'apellidosmurcianoswiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'Lorenzolaxmonzon',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
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
		'AdditionalFields' => [],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}

if ( $wgDBname == 'fablabesdswiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'Contact COOP FabLab ESDS',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Ne pas répondre FabLab ESDS',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
		'AdditionalFields' => [
			'TitreArticleDemande' => [
				'label' => 'Titre de l\'article demandé (si c\'est la cas)',
				'type' => 'text',
				'required' => false,  // Either "true" or "false" as required
			],
		],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}

if ( $wgDBname == 'qboxnextwiki' ) {
	$wgContactConfig['default'] = [
		'RecipientUser' => 'A KLERK',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false,
		'AdditionalFields' => [],
		'DisplayFormat' => 'table',
		'RLModules' => [],
		'RLStyleModules' => [],
	];
}
