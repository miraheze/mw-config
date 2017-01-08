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

if ( $wgDBname == 'ayrshirewiki' ) {
	$wgContactConfig['default'] = array(
		'RecipientUser' => 'Gordonuk',
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

if ( $wgDBname == 'deltaquadtestwiki' ) {
	$wgContactConfig['default'] = array(
		'RecipientUser' => 'DeltaQuad',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Miraheze No Reply',
		'RequireDetails' => true,
		'IncludeIP' => false,
		'AdditionalFields' => array(),
		'DisplayFormat' => 'table',
		'RLModules' => array(),
		'RLStyleModules' => array(),
	);
}

if ( $wgDBname == 'fablabesdswiki' ) {
	$wgContactConfig['default'] = array(
		'RecipientUser' => 'Contact COOP FabLab ESDS',
		'SenderEmail' => $wgPasswordSender,
		'SenderName' => 'Ne pas répondre FabLab ESDS',
		'RequireDetails' => true,
		'IncludeIP' => false, // No privy
		'AdditionalFields' => array(
			'TitreArticleDemande' => array(
				'label' => 'Titre de l\'article demandé (si c\'est la cas)',
				'type' => 'text',
				'required' => false,  // Either "true" or "false" as required
			),
		),
		'DisplayFormat' => 'table',
		'RLModules' => array(),
		'RLStyleModules' => array(),
	);
}
