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

**Note:** anything set to the `$wgConf->settings` array anywhere else outside of LocalSettings.php will not be extracted to globals and thus unless you don't need them to, should be avoided.
This is due to caching for the SiteConfiguration settings, which improves performance, but this is the trade-off for it.

If you would like to add configuration options or extensions/skins to ManageWiki:
* First add the config to LocalSettings.php, like above. However unlike above you would not add the wiki overrides.
* Follow the other examples from either ManageWikiSettings.php or ManageWikiNamespaces.php to add configuration variables to the appropriate module of ManageWiki. For ManageWikiSettings.php, make sure they are in the appropriate section.
* Make sure that the `'overridedefault'` set in ManageWikiSettings.php or ManageWikiNamespaces.php match that of the default set via LocalSettings.php.
* To add extensions to ManageWikiExtensions.php:
  * First make sure the extension is added for Miraheze in the [mediawiki-repos.yaml file](https://github.com/miraheze/mediawiki-repos/blob/main/mediawiki-repos.yaml) in the miraheze/mediawiki-repos repository.
  * Follow the current examples on ManageWikiExtensions.php to add new extensions to that file.
  * Add any necessary configuration variables to LocalSettings.php, LocalWiki.php, ManageWikiSettings.php, or ManageWikiNamespaces.php. Add to whichever is most appropriate.
  * If an extension requires configuration to be set only when the extension is enabled on the wiki, add the `ext-<ExtensionName>` tag to LocalSettings.php, as you would wiki databases or `default`.
   * Note: the `<ExtensionName>` is the value from the `'name'` field of ManageWikiExtensions.php, without any whitespaces
* Make sure to look at the comment at the top of ManageWikiSettings.php, ManageWikiNamespaces.php, or ManageWikiExtensions.php for additional documentation.

We use tabs with indent size 8 - if you use the GitHub editor this styling will be automatically applied.

Please note that wiki identifiers are formed by the name of the wiki followed by `wiki` string, for instance, `'examplewiki'` is the identifier for `example.miraheze.org`. `examplewikiwiki` would be the identifier for `examplewiki.miraheze.org`.

# Alphabetical order

* LocalSettings.php wiki override values should be alphabetically sorted based on the wiki name. There are only two exceptions to this:
  * The `'default'` value, which should be always above all others.
  * The `ext-<ExtensionName>` values should have their own alphabetical order below all wiki database overrides.

# Questions?

Running the site is a serious business. We'll comment on your pull request(s) where needed. Please do not hesitate to ask questions!
