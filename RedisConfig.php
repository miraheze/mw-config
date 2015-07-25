<?php
/* $wgObjectCaches['redis'] = array(
    'class'             => 'RedisBagOStuff',
    'servers'           => array( '185.52.1.76:6379' ),
    'password'          => $wmgRedisPassword,
); */

$wgMainCacheType = CACHE_DB;
// $wgSessionCacheType = 'redis';

# Disabled because they make the wiki not faster, but slower --SPF
// $wgMessageCacheType = 'redis';
// $wgParserCacheType = 'redis';
// $wgLanguageConverterCacheType = 'redis';
