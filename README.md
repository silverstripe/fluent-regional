# SilverStripe Regional

An extension for Fluent that allows content to be split into regions, which are just locales with different semantics.

## Requirements
```json
"silverstripe/cms": "^3.1"
"tractorcow/silverstripe-fluent": "^3.4"
```
## Configuration

All of the configuration is done under Fluent, since that's the driving engine behind the regions.

The only additional setting needed is `region_labels`, which is used in the CMS.

```yml
---
Name: myregional
After: '#regionalfluent'
---
Fluent:
  default_locale: en_NZ
  locales:
    - en_GB
    - en_AU
    - en_NZ
  region_labels:
    en_AU: Australia
    en_GB: U.K.
    en_NZ: NZ
  aliases:
    en_NZ: nz
    en_AU: au
    en_GB: uk  
---
Name: ssfluenti18nconfig
After: '#fluenti18nconfig'
---
i18n:
  default_locale: en_NZ
```

The above configuration will result in the following outcomes:

* `/uk/blog/` shows the "U.K." version of the blog page
* `/au/blog/` shows the "Australia" version of the blog page
* `/nz/blog/` shows the "NZ" version of the blog page.
* `/blog/` shows the 'NZ' version of the blog page.
