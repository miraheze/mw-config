# Contributing to Miraheze MediaWiki Configurations

Welcome, and thank you for participating in the operations of Miraheze!

Below is an example snippets from the LocalSettings, and we'll cover important stuff to keep site running (and puppet not breaking itself).

```php
    'wmgUseJosa' => array(
        'default' => false,
        'extloadwiki' => true,
        'reviwiki' => true,
    ),
```

# Alphabetical orders

Only exception for this is `default`, which will be always at the top.

# Tabs vs Spaces

We use Tabs on this repository.

# When dealing with VisualEditor/Flow requests

VisualEditor and Flow extension requests requires parsoid, dependency for the two extensions. Please file a pull requests along with the pull requests on the mw-config.