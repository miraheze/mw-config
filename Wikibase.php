<?php
call_user_func( function() {
        global $wgContentHandlerUseDB, $wgExtraNamespaces, $wgWBRepoSettings;
        global $wgDBname, $wgNamespacesToBeSearchedDefault;

        $wgContentHandlerUseDB = true;

        $baseNs = 860;

        // Define custom namespaces. Use these exact constant names.
        define( 'WB_NS_ITEM', $baseNs );
        define( 'WB_NS_ITEM_TALK', $baseNs + 1 );
        define( 'WB_NS_PROPERTY', $baseNs + 2 );
        define( 'WB_NS_PROPERTY_TALK', $baseNs + 3 );

        $wgExtraNamespaces[WB_NS_ITEM] = 'Item';
        $wgExtraNamespaces[WB_NS_ITEM_TALK] = 'Item_talk';
        $wgExtraNamespaces[WB_NS_PROPERTY] = 'Property';
        $wgExtraNamespaces[WB_NS_PROPERTY_TALK] = 'Property_talk';

        $wgWBRepoSettings['entityNamespaces'][CONTENT_MODEL_WIKIBASE_ITEM] = WB_NS_ITEM;
        $wgWBRepoSettings['entityNamespaces'][CONTENT_MODEL_WIKIBASE_PROPERTY] = WB_NS_PROPERTY;

        $wgWBRepoSettings['sharedCacheKeyPrefix'] = $wgDBname . ':WBL/' . rawurlencode( WBL_VERSION );

        $wgNamespacesToBeSearchedDefault[WB_NS_ITEM] = true;

        $wgWBRepoSettings['siteLinkGroups'] = array(
                'wikipedia',
                'wikinews',
                'wikiquote',
                'wikisource',
                'wikivoyage',
                'special'
        );

        $wgWBRepoSettings['specialSiteLinkGroups'] = array( 'commons', 'wikidata' );
} );
