<?php
/**
 * Additional settings to add to ManageWikiNamespaces are added using the variable below.
 *
 * name: the displayed name of the setting on Special:ManageWiki/namespaces.
 * from: a text entry of which extension is required for this setting to work. If added by MediaWiki or a 'global' extension, use 'mediawiki'.
 * type: configuration type. See below for available options.
 * main: true or false. If false, this config will not appear for main namespaces.
 * talk: true or false. If false, this config will not appear for talk namespaces.
 * constant: optional parameter. True or false. If true, the format will be $var = $val. Used for configuration options that don't apply to specific namespace(s). Doesn't work with the 'check' or 'vestyle' types.
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
 * vestyle: adds a checkbox. Format: [$var][$namespace_id] = true;
 * 
 * [$var][$namespace_id] = $val format:
 * database: adds a textbox with input validation, verifying that its value is a valid database name.
 * float: adds a textbox with float validation (requires: minfloat and maxfloat which are minimum and maximum float values).
 * integer: adds a textbox with integer validation (requires: minint and maxint which are minimum and maximum integer values).
 * language: adds a dropdown for language selection (all which are known to MediaWiki).
 * list: adds a list of options (requires: options which is an array in form of display => internal value).
 * list-multi: see above, just that multiple can be selected.
 * list-multi-bool: see above, just outputs are $this => $bool.
 * matrix: adds an array of "columns" and "rows". Columns are the top array and rows will be the values.
 * namespace: adds dropdown to select one namespace.
 * namespaces: see above, except multiple namespaces.
 * preferences: adds a drop down selection box for selecting multiple user preferences.
 * skin: adds a drop down selection box for selecting a single enabled skin.
 * skins: adds a drop down selection box for selecting multiple enabled skins.
 * text: adds a single line text entry.
 * timezone: adds a dropdown for timezone selection.
 * url: adds a single line text entry which requires a full URL.
 * user: adds an autocomplete text box to select a single user on the wiki.
 * users: see above, except multiple users.
 * usergroups: adds a drop down selection box for selecting multiple user groups.
 * userrights: adds a drop down selection box for selecting multiple user rights.
 * wikipage: add a textbox which will return an autocomplete drop-down list of wikipages. Returns standardised MediaWiki pages.
 * wikipages: see above, except multiple wikipages.
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
	'wgMetaNamespace' => [
		'name' => 'What should the main namespace name for the project namespace be?',
		'from' => 'mediawiki',
		'type' => 'text',
		'main' => true,
		'talk' => false,
		'constant' => true,
		'blacklisted' => array_diff( array_keys( $wgExtraNamespaces ), [ NS_PROJECT ] ),
		'overridedefault' => str_replace( ' ', '_', $wgSitename ),
		'help' => 'Also be sure to update <code>$wgMetaNamespaceTalk</code>.',
		'requires' => [],
	],
	'wgMetaNamespaceTalk' => [
		'name' => 'What should the talk namespace name for the project namespace be?',
		'from' => 'mediawiki',
		'type' => 'text',
		'main' => false,
		'talk' => true,
		'constant' => true,
		'blacklisted' => array_diff( array_keys( $wgExtraNamespaces ), [ NS_PROJECT_TALK ] ),
		'overridedefault' => str_replace( ' ', '_', "{$wgSitename}_talk" ),
		'help' => 'Also be sure to update <code>$wgMetaNamespace</code>.',
		'requires' => [],
	],
	'wgExtraSignatureNamespaces' => [
		'name' => 'Enable "Signature" button on the edit toolbar under both main and talk pages?',
		'from' => 'mediawiki',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => '',
		'requires' => [],
	],
	'wgCapitalLinkOverrides' => [
		'name' => 'Force the first letter of links to capitals.',
		'from' => 'mediawiki',
		'type' => 'vestyle',
		'main' => true,
		'talk' => false,
		'blacklisted' => [
			2,
			8,
		],
		'overridedefault' => false,
		'help' => 'Overrides <code>$wgCapitalLinks</code> for this namespace. Warning: This may break your existing wiki links.',
		'requires' => [],
	],
	'wgNoFollowNsExceptions' => [
		'name' => 'Enable if the rel="nofollow" attribute should not be used for external links in this namespace, even if $wgNoFollowLinks is enabled.',
		'from' => 'mediawiki',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => '',
		'requires' => [],
	],
	'egApprovedRevsEnabledNamespaces' => [
		'name' => 'Enable ApprovedRevs in this namespace?',
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
		'help' => '',
		'requires' => [],
	],
	'wgWPBNamespaces' => [
		'name' => 'Enable WikidataPageBanner in this namespace?',
		'from' => 'wikidatapagebanner',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => '',
		'requires' => [],
	],
	'wgCommentStreamsAllowedNamespaces' => [
		'name' => 'Can comments appear in this namespace?',
		'from' => 'commentstreams',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => '',
		'requires' => [],
	],
	'wgFlaggedRevsNamespaces' => [
		'name' => 'Enable FlaggedRevs in this namespace?',
		'from' => 'flaggedrevs',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [ 8 ],
		'overridedefault' => false,
		'help' => '',
		'requires' => [],
	],
	'wgVisualEditorAvailableNamespaces' => [
		'name' => 'Enable VisualEditor in this namespace?',
		'from' => 'visualeditor',
		'type' => 'vestyle',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => [
			NS_CATEGORY => true,
			NS_FILE => true,
			NS_MAIN => true,
			NS_USER => true,
			'default' => false,
		],
		'help' => '',
		'requires' => [],
	],
	'wgNamespacesToPostIn' => [
		'name' => 'Can MassMessage post messages in this namespace?',
		'from' => 'massmessage',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => '',
		'requires' => [],
	],
	'wgTemplateSandboxEditNamespaces' => [
		'name' => 'Can TemplateSandbox be used in this namespace?',
		'from' => 'templatesandbox',
		'type' => 'check',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'overridedefault' => false,
		'help' => '',
		'requires' => [],
	],
	'wgARENamespaces' => [
		'name' => 'Enable Article Ratings in this namespace?',
		'from' => 'articleratings',
		'type' => 'check',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => array_merge(
			array_fill_keys( $wgContentNamespaces, true ),
			[ 'default' => false ]
		),
		'help' => '',
		'requires' => [],
	],
	'wgPreloaderSource' => [
		'name' => 'Name of the page (including page\'s namespace) to use as the source for Preloader in this namespace.',
		'from' => 'preloader',
		'type' => 'text',
		'main' => true,
		'talk' => false,
		'blacklisted' => [],
		'overridedefault' => [
			0 => 'Template:Boilerplate',
			'default' => false,
		],
		'help' => '',
		'requires' => [],
	],
	'wgNamespaceRobotPolicies' => [
		'name' => 'What should the robot policy for this namespace be?',
		'from' => 'mediawiki',
		'type' => 'list',
		'main' => true,
		'talk' => true,
		'blacklisted' => [],
		'options' => [
			'index,follow' => 'index,follow',
			'noindex,nofollow' => 'noindex,nofollow',
			'index,nofollow' => 'index,nofollow',
		],
		'overridedefault' => $wgDefaultRobotPolicy,
		'help' => 'Overrides <code>$wgDefaultRobotPolicy</code> for this namespace.',
		'requires' => [],
	],
];
