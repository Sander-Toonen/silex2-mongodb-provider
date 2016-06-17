# Silex 2 MongoDb Provider
[![Build Status](https://travis-ci.org/Sander-Toonen/silex2-mongodb-provider.svg?branch=master)](https://travis-ci.org/Sander-Toonen/silex2-mongodb-provider) [![Coverage Status](https://coveralls.io/repos/github/Sander-Toonen/silex2-mongodb-provider/badge.svg?branch=master)](https://coveralls.io/github/Sander-Toonen/silex2-mongodb-provider?branch=master) [![Dependency Status](https://www.versioneye.com/user/projects/57641b6e0735400045bbf9b0/badge.svg)](https://www.versioneye.com/user/projects/57641b6e0735400045bbf9b0) [![StyleCI](https://styleci.io/repos/61384671/shield)](https://styleci.io/repos/61384671)

[MongoDB](http://mongodb.org/) service provider for the [Silex 2](http://silex.sensiolabs.org/) framework. Based on the Silex 1 service provider created by [Moriony](https://github.com/moriony). Tested with PHP7 and the [MongoDB library](http://mongodb.github.io/mongo-php-library/).

## Install via composer

Add in your ```composer.json``` the require entry for this library.
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
```php
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
```php
$connections = $app['mongodb'];
$defaultConnection = $connections['default'];
```

###  Creating mongo connection via factory
```php
$mongoFactory = $app['mongodb.factory'];
$customConnection = $mongoFactory("mongodb://localhost:27017", ["connect" => true]);
```
