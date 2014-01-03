Unofficial NitradoAPI
=====================


This is a PHP 5.3 library for the unofficial Nitrado.net gameserver API. This API is normally used for the Smartphone Applications.

**Note:** There is no support for this library from nitrado.net. Use at your own risk.

**Note 2:** This library currently only supports the product "Gameserver".

Recommends
---------

* PHP 5.3 or higher
* An nitrado.net User Account
* Composer.phar ;)

Installation
------------

Edit the composer.json and execute composer.phar update
```
{
    "require": {
        "BirknerAlex/NitradoApi": "dev-master",
    }
}
```

Examples
--------

**Using the API**
```
<?php

use at\Tyrola\Nitrado\Api\NitradoApi;

require_once "vendor/autoload.php"; //Composer autoloader

$nitrado = new NitradoApi("username", "yourPassword");

//Your api calls....

```
