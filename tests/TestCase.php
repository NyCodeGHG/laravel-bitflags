<?php

namespace AwStudio\Bitflags\Tests;

use AwStudio\Bitflags\BitflagsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            BitflagsServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
        ]);

        include_once __DIR__.'/TestSupport/create_test_models_table.php';

        (new \CreateTestModelsTable)->up();
    }
}
