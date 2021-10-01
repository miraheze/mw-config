# Contributing to the Miraheze MediaWiki configuration

So, you want to contribute to our MediaWiki configuration? That's nice, welcome! In this small documentation thing we'll cover the most important stuff to prevent the site from breaking, and general guidelines.

Below is an example of what configuration variables added to our LocalSettings.php file would look like:

```php
 	// Example
 	'wgExampleConfig' => [
 		'default' => false,
 		'examplewiki' => true,
 	],
```

If you would like to add configuration options or extensions/skins to ManageWiki:
* First add the config to LocalSettings.php, like above. However unlike above you would not add the wiki overrides.
* Follow the other examples from either ManageWikiSettings.php or ManageWikiNamespaces.php to add configuration variables to the appropriate module of ManageWiki. For ManageWikiSettings.php, make sure they are in the appropriate section.
* Make sure that the `'overridedefault'` set in ManageWikiSettings.php or ManageWikiNamespaces.php match that of the default set via LocalSettings.php.
* To add extensions to ManageWikiExtensions.php:
  * First make sure the extension submodule is installed on Miraheze in the miraheze/mediawiki repository. See https://meta.miraheze.org/wiki/Tech:Adding_a_new_extension for more information on this and the below documentation.
  * Follow the current examples on ManageWikiExtensions.php to add new extensions to that file.
  * Update LocalSettings.php to add `wmgUseExtension` configuration to it. These should always default to `false`, unless the extension should only be disabled on select wikis, in that event it would default to `true` and a wiki override would be set to disable it on the individual wiki.
  * Update LocalExtensions.php to add the `wfLoadExtension`, `wfLoadSkin`, or `require_once` to it. Always use `wfLoad(Extension/Skin)` if extension/skin.json exists, otherwise use `require_once` when it doesn't. If loading multiple extensions at once, you would use `wfLoadExtensions( [ 'example1', 'example2' ] );` Configuration variables that should only be set when extension is enabled, and is incompatible with LocalSettings.php format can be added here inside the `if` block. Follow the other examples.
  * Update extension-list. Only needed if the extension or skin has an i18n directory. Add the path to the entry point file (extension/skin.json or the PHP entry point, that require_once would link to in LocalExtensions.php). Order alphabetically.
  * Add any necessary configuration variables to LocalSettings.php, LocalWiki.php, ManageWikiSettings.php, or ManageWikiNamespaces.php. Add to whichever is most appropriate.
  * If an extension requires configuration to be set only when the extension is enabled on the wiki, add the `wmgUseExtension` variable to LocalSettings.php, as you would wiki databases or `default`.
* Make sure to look at the comment at the top of ManageWikiSettings.php, ManageWikiNamespaces.php, or ManageWikiExtensions.php for additional documentation.

We use tabs with indent size 8 - if you use the GitHub editor this styling will be automatically applied.

Please note that wiki identifiers are formed by the name of the wiki followed by `wiki` string, for instance, `'examplewiki'` is the identifier for `example.miraheze.org`. `examplewikiwiki` would be the identifier for `examplewiki.miraheze.org`.

# Alphabetical order

* LocalSettings.php wiki override values should be alphabetically sorted based on the wiki name. There are only two exceptions to this:
  * The `'default'` value, which should be always above all others.
  * The `wmgUseExtension` values should have their own alphabetical order below all wiki database overrides.

# Questions?

Running the site is a serious business. We'll comment on your pull request(s) where needed. Please do not hesitate to ask questions!
