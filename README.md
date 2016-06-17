# Silex 2 MongoDb Provider
[![Build Status](https://travis-ci.org/Sander-Toonen/silex2-mongodb-provider.svg?branch=master)](https://travis-ci.org/Sander-Toonen/silex2-mongodb-provider)
[![Coverage Status](https://coveralls.io/repos/github/Sander-Toonen/silex2-mongodb-provider/badge.svg?branch=master)](https://coveralls.io/github/Sander-Toonen/silex2-mongodb-provider?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/57641b6e0735400045bbf9b0/badge.svg)](https://www.versioneye.com/user/projects/57641b6e0735400045bbf9b0)
[![StyleCI](https://styleci.io/repos/61393876/shield)](https://styleci.io/repos/61393876)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/14be2be5-56e7-457d-9a1a-fcba3b0ae445/mini.png)](https://insight.sensiolabs.com/projects/14be2be5-56e7-457d-9a1a-fcba3b0ae445)
[![Latest Stable Version](https://poser.pugx.org/xatoo/silex2-mongodb-provider/v/stable)](https://packagist.org/packages/xatoo/silex2-mongodb-provider)
[![Total Downloads](https://poser.pugx.org/xatoo/silex2-mongodb-provider/downloads)](https://packagist.org/packages/xatoo/silex2-mongodb-provider)
[![License](https://poser.pugx.org/xatoo/silex2-mongodb-provider/license)](https://packagist.org/packages/xatoo/silex2-mongodb-provider)

[MongoDB](http://mongodb.org/) service provider for the [Silex 2](http://silex.sensiolabs.org/) framework. Tested with PHP7 and the [MongoDB library](http://mongodb.github.io/mongo-php-library/).

## Requirements

 * PHP 5.6 or PHP 7
 * PHP [MongoDB driver](http://php.net/manual/en/set.mongodb.php)
 * [MongoDB PHP Library](http://mongodb.github.io/mongo-php-library/)

## Installation

Add the required entry for this library to your ```composer.json```.
```json
{
    "require": {
        "xatoo/silex2-mongodb-provider": "*"
    }
}
```
and run ```composer install``` (or ```update```) to download all files.

## Usage

### Service registration
``` {.php}
$app->register(new MongoDBServiceProvider, [
    'mongodb.configuration' => [
        'default' => [
            'server' => "mongodb://localhost:27017",
            'options' => ["connect" => true]
        ]
    ],
]);
```

###  Connections retrieving
``` {.php}
$connections = $app['mongodb'];
$defaultConnection = $connections['default'];
```

###  Creating a mongo connection via the factory
```php
$mongoFactory = $app['mongodb.factory'];
$customConnection = $mongoFactory("mongodb://localhost:27017", ["connect" => true]);
```

## Copyright

* Sander Toonen <s.toonen@gmail.com>
