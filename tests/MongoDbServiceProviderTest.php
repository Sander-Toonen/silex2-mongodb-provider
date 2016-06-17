<?php

namespace Xatoo\Silex\tests;

use Pimple\Container;
use Silex\Application;
use Xatoo\Silex\ServiceProvider\MongoDbServiceProvider;

class MongoDbServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    protected $app;

    protected $mongoClass;

    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new MongoDbServiceProvider(), [
            'mongodb.connections' => [
                'default' => [
                    'server' => 'mongodb://localhost:27017',
                    'options' => ['connect' => false],
                ],
            ],
        ]);
        $this->mongoClass = '\MongoDB\Client';
    }

    public function testConnectionProvider()
    {
        $this->assertInstanceOf($this->mongoClass, $this->app['mongodb']['default']);
    }

    public function testFactory()
    {
        $factory = $this->app['mongodb.factory'];
        $connection = $factory('mongodb://localhost:27017', ['connect' => false]);
        $this->assertInstanceOf($this->mongoClass, $connection);
    }

    public function testConnection()
    {
        if (!extension_loaded('mongodb')) {
            $this->markTestSkipped('mongodb extension is not installed');
        }

        $app = new Container();
        $app->register(new MongoDbServiceProvider());
        $mongodb = $app['mongodb']['default'];
        $database = $mongodb->selectDatabase('xatoo-silex2-mongodb-provider');
        $collection = $database->selectCollection('test');
        $document = ['foo' => 'bar'];
        $result = $collection->insertOne($document);
        $this->assertInstanceOf('\MongoDB\InsertOneResult', $result);
        $this->assertArrayHasKey('_id', $document);
        $database->dropCollection('test');
    }
}
