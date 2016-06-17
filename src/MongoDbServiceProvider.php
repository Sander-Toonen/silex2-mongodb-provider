<?php

namespace Xatoo\Silex\ServiceProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * MongoDb service provider.
 *
 * @author Sander Toonen <s.toonen@gmail.com>
 */
class MongoDbServiceProvider implements ServiceProviderInterface
{
    const MONGODB = 'mongodb';
    const MONGODB_CONNECTIONS = 'mongodb.connections';
    const MONGODB_FACTORY = 'mongodb.factory';

    /**
     * Registers services on the given container.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        // Configured connections
        $container[self::MONGODB_CONNECTIONS] = [
            'default' => [
                'server' => 'mongodb://localhost:27017',
                'options' => ['connect' => true],
            ],
        ];

        // Factory for creating new connections
        $container[self::MONGODB_FACTORY] = $container->protect(function ($server = 'mongodb://localhost:27017', array $options = ['connect' => true]) {
            return new \MongoDB\Client($server, $options);
        });

        // All MongoDb connections
        $container[self::MONGODB] = function ($container) {
            $connections = new Container();
            foreach ($container[MongoDbServiceProvider::MONGODB_CONNECTIONS] as $name => $options) {
                $connections[$name] = function () use ($options, $container) {
                    return $container[MongoDbServiceProvider::MONGODB_FACTORY]($options['server'], $options['options']);
                };
            }

            return $connections;
        };
    }
}
