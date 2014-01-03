Unofficial NitradoAPI
=====================

This is a PHP 5.3 library for the unofficial Nitrado.net gameserver API. This API is normally used for the smartphone apps.

**Note:** There is no support for this library from nitrado.net. Use at your own risk.

**Note 2:** This library currently only supports the product type "Gameserver".

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

**All Methods for every product type**

* getId()
* getDeleteDate()
* setEndDate()
* getProduct()
* getType()

**All Methods for the "Gameserver" product type**

* getCpuUsage()
* getCurrentMap()
* getCurrentPlayers()
* getIp()
* getMaxPlayers()
* getServerName()
* getStatus()
* doRestart()
* doStop()
* doStart()


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

**Get a list with all services**
```
<?php

// see "Using the API"
$nitrado->getServiceIds(); //array with service ids

```

**Getting a specific Service object by service id**
```
<?php

// see "Using the API"
$service = $nitrado->getService($id); //Service object

```

**Restart a Gameserver**
```
<?php

// see "Using the API"
$service = $nitrado->getService($id); //Service object

$service->doRestart(); //bool

```