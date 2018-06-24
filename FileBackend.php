<?php

$wgFileBackends[] = [
    'class'              => 'SwiftFileBackend',
    'name'               => $wgDBname,
    'lockManager'        => 'nullLockManager',
    'swiftAuthUrl'       => 'http://127.0.0.1:8080/auth',
    'swiftStorageUrl'    => 'http://127.0.0.1:8080/v1/AUTH_admin',
    'swiftUser'          => 'admin:admin',
    'swiftKey'           => 'admin',
    'swiftTempUrlKey'    => 'mirahezeTest',
    'shardViaHashLevels' => [
        'local-public'
            => [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
        'local-thumb'
            => [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
        'local-temp'
            => [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
        'local-transcoded'
            => [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ],
        'local-deleted'
            => [ 'levels' => 2, 'base' => 16, 'repeat' => 1 ]
    ],
    'parallelize'        => 'implicit',
    'cacheAuthInfo'      => true,
    // When used by FileBackendMultiWrite, read from this cluster if it's the local one
    'readAffinity'       => true,
    'readUsers'           => [ 'admin:admin' ],
    'writeUsers'          => [ 'admin:admin' ],
    //'secureReadUsers'     => [ 'admin:admin' ],
    //'secureWriteUsers'    => [ 'admin:admin' ]
];

$wgLocalFileRepo = [
    'class' => 'LocalRepo',
    'name' => 'local',
    //'backend' => 'mw',
    'backend' => $wgDBname,
    'directory' => $wgUploadDirectory,
    'scriptDirUrl' => $wgScriptPath,
    'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $wgUploadPath,
    'hashLevels' => $wgHashedUploadDirectory ? 2 : 0,
    'thumbScriptUrl' => $wgThumbnailScriptPath,
    'transformVia404' => !$wgGenerateThumbnailOnParse,
    'deletedDir' => $wgDeletedDirectory,
    'deletedHashLevels' => $wgHashedUploadDirectory ? 3 : 0,
    'thumbDir' => "$wgUploadDirectory/thumb",
    'zones'             =>  [
            'public'  =>  [ 'container' =>  'mw', ],
            'thumb'   =>  [ 'container' =>  'mw', ],
            'temp'    =>  [ 'container' =>  'mw', ],
            'deleted' =>  [ 'container' =>  'mw' ],
    ],
];
