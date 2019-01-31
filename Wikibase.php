<?php
call_user_func( function () {
		global $wgContentHandlerUseDB, $wgExtraNamespaces, $wgWBRepoSettings,
		$wgDBname, $wgNamespacesToBeSearchedDefault, $wmgAllowEntityImport,
		$wmgEnableEntitySearchUI;

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

		$wgWBRepoSettings['entityNamespaces']['item'] = WB_NS_ITEM;
		$wgWBRepoSettings['entityNamespaces']['property'] = WB_NS_PROPERTY;

		$wgWBRepoSettings['sharedCacheKeyPrefix'] = $wgDBname . ':WBL/' . rawurlencode( WBL_VERSION );

		$wgWBRepoSettings['allowEntityImport'] = $wmgAllowEntityImport;

		$wgWBRepoSettings['enableEntitySearchUI'] = $wmgEnableEntitySearchUI;

		$wgNamespacesToBeSearchedDefault[WB_NS_ITEM] = true;

		$wgWBRepoSettings['siteLinkGroups'] = [
				'miraheze',
		];

		$wgWBRepoSettings['specialSiteLinkGroups'] = [];
} );
