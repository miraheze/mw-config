<?php

$settings['wgContactConfig'] = [
	'apellidosmurcianoswiki' => [
		'default' => [
			'RecipientUser' => 'Lorenzolaxmonzon',
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Miraheze No Reply',
			'RequireDetails' => true,
			'IncludeIP' => false, // No privy
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => []
		]
	],
	'ayrshirewiki' => [
		'default' => [
			'RecipientUser' => 'Gordonuk',
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Miraheze No Reply',
			'RequireDetails' => true,
			'IncludeIP' => false, // No privy
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => []
		]
	],
	'cdcwiki' => [
		'default' => [
			'RecipientUser' => 'NonstickRon',
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Miraheze No Reply',
			'RequireDetails' => true,
			'IncludeIP' => false, // Lets not do this ever for privacy (unless offical forms)
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => []
		]
	],
	'christipediawiki' => [
		'default' => [
			'RecipientUser' => 'Kees Langeveld',
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Miraheze No Reply',
			'RequireDetails' => true,
			'IncludeIP' => false, // No privy
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => []
		]
	],
	'fablabesdswiki' => [
		'default'=> [
			'RecipientUser' => 'Contact COOP FabLab ESDS',
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Ne pas répondre FabLab ESDS',
			'RequireDetails' => true,
			'IncludeIP' => false, // No privy
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [
				'TitreArticleDemande' => [
					'label' => 'Titre de l\'article demandé (si c\'est la cas)',
					'type' => 'text',
					'required' => false,  // Either "true" or "false" as required
				],
			],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => []
		]
	],
	'guiaslocaiswiki' => [
		'default' => [
			'RecipientUser' => 'Eduaddad',
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Miraheze No Reply',
			'RequireDetails' => true,
			'IncludeIP' => false, // No privy
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => []
		]
	],
	'qboxnextwiki' => [
		'default' => [
			'RecipientUser' => 'A KLERK',
			'SenderEmail' => $wgPasswordSender,
			'SenderName' => 'Miraheze No Reply',
			'RequireDetails' => true,
			'IncludeIP' => false,
			'MustBeLoggedIn' => false,
			'AdditionalFields' => [
				'Text' => [
					'label-message' => 'emailmessage',
					'type' => 'textarea',
					'rows' => 20,
					'required' => true,
				]
			],
			'DisplayFormat' => 'table',
			'RLModules' => [],
			'RLStyleModules' => []
		]
	]
];
