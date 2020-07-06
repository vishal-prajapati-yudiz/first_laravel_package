<?php

namespace Spatie\Skeleton;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Skeleton\Commands\SkeletonCommand;
use Spatie\Skeleton\Http\Controllers\ContactusController;

class SkeletonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/path/to/assets' => public_path('vendor/courier'),
            ], 'public');

            $this->publishes([
                __DIR__.'/../config/skeleton.php' => config_path('skeleton.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/skeleton'),
            ], 'views');

            if (! class_exists('CreatePackageTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_skeleton_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_skeleton_table.php'),
                ], 'migrations');
            }

            $this->commands([
                SkeletonCommand::class,
            ]);
        }

        //Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'skeleton');
        
        //Routes
        Route::macro('skeleton', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/', [ContactusController::class, 'index'])->name('contactus');
                Route::post('/contactus/email', [ContactusController::class,'checkEmail'])->name('user.contactus.email');
                Route::post('/contactus/contact', [ContactusController::class,'checkContact'])->name('user.contactus.contact');
                Route::post('/contactus/store', [ContactusController::class, 'store'])->name('contactus.save');
            });
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/skeleton.php', 'skeleton');
    }
}
