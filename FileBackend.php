<?php

$wgFileBackends[] = [
    'class'              => 'SwiftFileBackend',
    'name'               => $wgDBname,
    'wikiId'             => $wmgPrivateUpload ? "private-$wgDBname" : $wgDBname,
    'lockManager'        => 'nullLockManager',
    'swiftAuthUrl'       => 'http://127.0.0.1:8080/auth',
    'swiftStorageUrl'    => 'http://127.0.0.1:8080/v1/AUTH_admin',
    'swiftUser'          => 'admin:admin',
    'swiftKey'           => 'admin',
    'swiftTempUrlKey'    => 'mirahezeTest',                                                 
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
    'readUsers'           => [ 'admin:admin' ],
    'writeUsers'          => [ 'admin:admin' ],
    //'secureReadUsers'     => [ 'admin:admin' ],
    //'secureWriteUsers'    => [ 'admin:admin' ]
];

$private = $wmgPrivateUpload ? "https://" . $wmgHostname . "/w/img_auth.php" : $wgUploadPath;

$wgLocalFileRepo = [
    'class' => 'LocalRepo',
    'name' => 'local',
    'backend' => $wgDBname,
    'directory' => $wgUploadDirectory,
    'scriptDirUrl' => $wgScriptPath,
    'url' => $wgUploadBaseUrl ? $wgUploadBaseUrl . $wgUploadPath : $private,
    'hashLevels' => $wgHashedUploadDirectory ? 2 : 0,
    'thumbScriptUrl' => $wgThumbnailScriptPath,
    'transformVia404' => !$wgGenerateThumbnailOnParse,
    'deletedDir' => $wgDeletedDirectory,
    'deletedHashLevels' => $wgHashedUploadDirectory ? 3 : 0,
    'thumbDir' => "$wgUploadDirectory/thumb",
    'isPrivate' => $wmgPrivateUpload,
    'zones' =>  [
        'public'  =>  [
            'container' =>  'mw',
        ],
        'thumb'   =>  [
            'container' =>  'mw',
            'directory' => 'thumb',
        ],
        'temp'    =>  [
            'container' =>  'mw',
            'directory' => 'temp',
        ],
        'deleted' =>  [
            'container' =>  'mw',
            'directory' => 'deleted',
        ],
        'archive' =>  [
            'container' =>  'mw',
            'directory' => 'archive',
        ],
        'awards' =>  [
            'container' =>  'mw',
            'directory' => 'awards',
        ],
        'avatars' =>  [
            'container' =>  'mw',
            'directory' => 'avatars',
        ],
        'lockdir' =>  [
            'container' =>  'mw',
            'directory' => 'lockdir',
        ],
        'timeline' =>  [
            'container' =>  'mw',
            'directory' => 'timeline',
        ],
        'math' =>  [
            'container' =>  'mw',
            'directory' => 'math',
        ],
        'transcoded' =>  [
            'container' =>  'mw',
            'directory' => 'transcoded',
        ],
    ],
];
