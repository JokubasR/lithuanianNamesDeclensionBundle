LithuanianNamesDeclensionBundle
==================

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
{{ getInflected("Jokūbas") }}
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


Original library author
-----
Dainius Kaupaitis, 2011