<?php

namespace Spatie\Skeleton\Tests;

use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Skeleton\SkeletonServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/database/factories');

        /** in routes of application */
        Route::skeleton('my-package-routes');
    }
  
    protected function getPackageProviders($app)
    {
        return [
            SkeletonServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        
        include_once __DIR__.'/../database/migrations/create_skeleton_table.php.stub';
        (new \CreateSkeletonTable())->up();
    }
}
