<?php

$wgExtraNamespaces[WB_NS_ITEM] = 'Item';
$wgExtraNamespaces[WB_NS_ITEM_TALK] = 'Item_talk';
$wgExtraNamespaces[WB_NS_PROPERTY] = 'Property';
$wgExtraNamespaces[WB_NS_PROPERTY_TALK] = 'Property_talk';

$wgWBRepoSettings['idBlacklist'] = array(
	1,
);

$wgWBRepoSettings['entityNamespaces'] = array(
	'item' => WB_NS_ITEM,
	'property' => WB_NS_PROPERTY,
);

$wgNamespacesToBeSearchedDefault[WB_NS_ITEM] = true;
