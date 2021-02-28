<?php
/**
 * Additional settings to add to ManageWikiNamespaces are added using the variable below.
 *
 * name: the displayed name of the setting on Special:ManageWiki/namespaces.
 * from: a text entry of which extension is required for this setting to work. If added by MediaWiki or a 'global' extension, use 'mediawiki'.
 * type: configuration type. See below for available options.
 * main: true or false. If false, this config will not appear for main namespaces.
 * talk: true or false. If false, this config will not appear for talk namespaces.
 * blacklisted: array of namespace ids to blacklist the config from.
 * overridedefault: override default when no existing value exist. Can be a boolean, string, or array.
 * overridedefault[$namespace_id => $val]: namespace specific overrides. Also required a default key. See below.
 * overridedefault['default' => $val]: required when using namespace specific overrides. Sets a default for all other namespaces, which is not using the overrides set.
 * help: string providing help information for the setting.
 * requires: an array, string, or integer. See below for available types that can be used here.
 *
 * 'type' can be one of:
 *
 * check: adds a checkbox. Format: $var[] = $namespace_id;
 * text: adds a single line text entry. Format: [$var][$namespace_id] = $val;
 * vestyle: adds a checkbox. Format: [$var][$namespace_id] = true;
 *
 * 'requires' can be one of:
 *
 * activeusers: max integer amount of active users a wiki may have in order to be able to modify this setting.
 * articles: max integer amount of articles a wiki may have in order to be able to modify this setting.
 * extensions: array of extensions that must be enabled in order to modify this setting. Different from 'from'. Only use if requires more then one extension.
 * pages: max integer amount of pages a wiki may have in order to be able to modify this setting.
 * permissions: array of permissions a user must have to be able to modify this setting. Regardless of this value, a user must always have the managewiki permission.
 * visibility: an array. See below for available options.
 *
 * 'visibility' can be one of:
 *
 * state: a string. Can be either 'private' or 'public'. If set to 'private' this setting will only be visible on private wikis. If set to 'public' it will only be visible on public wikis.
 * permissions: an array. Set to an array of permissions required for the setting to be visible.
 */

$wgManageWikiNamespacesAdditional = [
	'wgExtraSignatureNamespaces' => [
		'name' => 'Extra Signature Namespaces',
		'from' => 'mediawiki',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => 'Enable "Signature" button on the edit toolbar under both main and talk pages.',
		'requires' => [],
	],
	'wgCapitalLinkOverrides' => [
		'name' => 'Capital Link Overrides',
		'from' => 'mediawiki',
		'type' => 'vestyle',
		'main' => true,
		'talk' => false,
		'blacklisted' => [
			2,
			8,
		],
		'overridedefault' => false,
		'help' => 'Force the first letter of links to capitals. Overrides $wgCapitalLinks for this namespace. Warning: This may break your existing wiki links.',
		'requires' => [],
	],
	'wgNoFollowNsExceptions' => [
		'name' => 'No Follow NS Exceptions',
		'from' => 'mediawiki',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => 'Enable if the rel="nofollow" attribute should not be used for external links in this namespace, even if $wgNoFollowLinks is enabled.',
		'requires' => [],
	],
	'egApprovedRevsEnabledNamespaces' => [
		'name' => 'Approved Revs Enabled Namespaces',
		'from' => 'approvedrevs',
		'type' => 'vestyle',
		'main' => true,
		'talk' => true,
		'blacklisted' => [
			8,
			9,
			14,
			15,
		],
		'overridedefault' => true,
		'help' => 'Enable ApprovedRevs in this namespace?',
		'requires' => [],
	],
	'wgWPBNamespaces' => [
		'name' => 'Wikidata Page Banner Namespaces',
		'from' => 'wikidatapagebanner',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => 'Enable WikidataPageBanner in this namespace?',
		'requires' => [],
	],
	'wgCommentStreamsAllowedNamespaces' => [
		'name' => 'Comment Streams Allowed Namespaces',
		'from' => 'commentstreams',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => null,
		'help' => 'Can comments appear in this namespace?',
		'requires' => [],
	],
	'wgFlaggedRevsNamespaces' => [
		'name' => 'Flagged Revs Namespaces',
		'from' => 'flaggedrevs',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [ 8 ],
		'overridedefault' => false,
		'help' => 'Enable FlaggedRevs in this namespace?',
		'requires' => [],
	],
	'wgVisualEditorAvailableNamespaces' => [
		'name' => 'Visual Editor Available Namespaces',
		'from' => 'visualeditor',
		'type' => 'vestyle',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => 'Enable VisualEditor in this namespace?',
		'requires' => [],
	],
	'wgNamespacesToPostIn' => [
		'name' => 'Mass Messages - Namespaces To Post In',
		'from' => 'massmessage',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => 'Can MassMessage post messages in this namespace?',
		'requires' => [],
	],
	'wgTemplateSandboxEditNamespaces' => [
		'name' => 'Template Sandbox Edit Namespaces',
		'from' => 'templatesandbox',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => 'Can TemplateSandbox be used in this namespace?',
		'requires' => [],
	],
	'wgARENamespaces' => [
		'name' => 'Article Ratings Namespaces',
		'from' => 'articleratings',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => array_merge(
			array_fill_keys( $wgContentNamespaces, true ),
			[ 'default' => false ]
		),
		'help' => 'Enable Article Ratings in this namespace',
		'requires' => [],
	],
	'wgPreloaderSource' => [
		'name' => 'Preloader Source',
		'from' => 'preloader',
		'type' => 'text',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => [
			0 => 'Template:Boilerplate',
			'default' => false,
		],
		'help' => 'Name of the page (including page\'s namespace) to use as the source for Preloader in this namespace.',
		'requires' => [],
	],
];
