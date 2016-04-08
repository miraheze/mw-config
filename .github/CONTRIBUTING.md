# Contributing to the Miraheze MediaWiki configuration

So, you want to contribute to our MediaWiki configuration? That's nice, welcome! In this small documentation thing we'll cover the most important stuff to prevent the site from breaking, and general guidelines.

Below is an example snippet from our LocalSettings.php:

```php
    'wmgUseJosa' => array(
        'default' => false,
        'extloadwiki' => true,
        'reviwiki' => true,
    ),
```

We use tabs with indent size 8 - if you use the GitHub editor this styling will be automatically applied.

# Alphabetical order

As you can see in our example snippet, values are alphabetically sorted based on the wiki name. The only exception is the 'default' value, which should be always above all others.

# Configuration dependencies

Sometimes, a configuration change requires more work than just a simple pull request. If an extension needs additional configuration before enabling, this should be noted above the associated wmgUseX block.

# Questions?

Running the site is a serious business. We'll comment on your pull request(s) where needed. Please do not hesitate to ask questions!