<?php
$wgObjectCaches['redis'] = array(
    'class'             => 'RedisBagOStuff',
    'servers'           => array( '185.52.1.76:6379' ),
    'password'          => $wmgRedisPassword,
);

$wgMainCacheType = 'redis';
$wgSessionCacheType = 'redis';

$wgMessageCacheType = 'redis';
$wgParserCacheType = 'redis';
$wgLanguageConverterCacheType = 'redis';
