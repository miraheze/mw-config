<?php

$containerPrefix = $wmgPrivateUploads ? 'prefix' : 'public';
$wgFileBackends[] = [
	'class'              => 'SwiftFileBackend',
	'name'               => 'miraheze-swift',
	// This is the prefix for the container that it starts with.
	'wikiId'             => "miraheze-$wgDBname-$containerPrefix",
	'lockManager'        => 'nullLockManager',
	'swiftAuthUrl'       => 'https://swift-lb.miraheze.org/auth',
	'swiftStorageUrl'    => 'https://swift-lb.miraheze.org/v1/AUTH_mw',
	'swiftUser'          => 'mw:media',
	'swiftKey'           => $wmgSwiftPassword,
	'shardViaHashLevels' => [
		'public'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'thumb'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'temp'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'transcoded'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
		'deleted'
			=> [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
	],
	'parallelize'        => 'implicit',
	'cacheAuthInfo'      => true,
	'readAffinity'       => true,
	'readUsers'           => [ 'mw:media' ],
	'writeUsers'          => [ 'mw:media' ],
	'connTimeout'         => 10,
	'reqTimeout'          => 900,
];

// Add -ImportDump suffix.
$importDumpContainer = $wgImportDumpCentralWiki ? "ImportDump-$wgImportDumpCentralWiki" : 'ImportDump';

$wgLocalFileRepo = [
	'class' => 'LocalRepo',
	'name' => 'local',
	'backend' => 'miraheze-swift',
	'scriptDirUrl' => $wgScriptPath,
	'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
	'hashLevels' => $wgHashedUploadDirectory ? 2 : 0,
	'thumbScriptUrl' => $wgThumbnailScriptPath,
	'transformVia404' => !$wgGenerateThumbnailOnParse,
	'deletedDir' => $wgDeletedDirectory,
	'deletedHashLevels' => $wgHashedUploadDirectory ? 3 : 0,
	'isPrivate' => $wmgPrivateUploads,
	'zones' => [
		'ImportDump' => [
			'container' => $importDumpContainer,
			'directory' => 'ImportDump',
		],
	],
];
