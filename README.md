LithuanianNamesDeclensionBundle
==================
[![Build Status](https://travis-ci.org/JokubasR/lithuanianNamesDeclensionBundle.svg)](https://travis-ci.org/JokubasR/lithuanianNamesDeclensionBundle)

The **LithuanianNamesDeclensionBundle** bundle allows you to inflect Lithuanian names from nominative case to any other.


Installation
------------

Require the `jokubasr/lithuanian-names-declension` package in your composer.json and update
your dependencies.

    $ composer require jokubasr/lithuanian-names-declension

Register the bundle in `app/AppKernel.php`:

```php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new JokubasR\Bundle\LithuanianNamesDeclensionBundle\JokubasRLithuanianNamesDeclensionBundle(),
    );
}
```

Usage
-----

You can use declension service either by injecting it or using it in your twig templates.

```php
<?php
use \JokubasR\Bundle\LithuanianNamesDeclensionBundle\Service\Declension;

// ...

/** @var Declension $declension */
$declension = $this->container->get('jokubasr.lithuanian_names_declension.declension');
$inflected = $declension->getInflected("Jokūbas", Declension::CASE_DATIVE);
```

```twig
{{ "Jokūbas"|ablative }}
{{ "Jokūbas"|inflect("ablative") }}
{{ "Jokūbas"|case('ablative') }}

{{ getVocative("Jokūbas") }}
{{ getInflected("Jokūbas") }} {# vocative is the default case #}
{{ getInflected("Jokūbas", "ablative") }}
```

Available twig filters:
* **inflect**- accepts case as a parameter (genitive, dative, accusative, ablative, locative, vocative)
* **case**- alias to inflect
* **genitive**
* **dative**
* **accusative**
* **ablative**
* **locative**
* **vocative**

Available twig functions:
* **getInflected** - accepts case as a second parameter (genitive, dative, accusative, ablative, locative, vocative)
* **getGenitive**
* **getDative**
* **getAccusative**
* **getAblative**
* **getLocative**
* **getVocative**

Author
-----
Jokūbas Ramanauskas

Original library author
-----
Dainius Kaupaitis, 2011

Contributors
-----
...
