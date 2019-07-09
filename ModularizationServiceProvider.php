<?php

namespace Modularization;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;
use Modularization\Console\Commands\TableName;
use Modularization\Core\Console\Commands\ConstDBCommand;
use Modularization\Core\Console\Commands\FileChange;
use Modularization\Core\Console\Commands\FileRemove;
use Modularization\Core\Console\Commands\FileRename;
use Modularization\Core\Console\Commands\ForceDBCommand;
use Modularization\Core\Console\Commands\RenderRoute;
use Modularization\Core\Console\Commands\TableColumn;
use Modularization\Core\Console\Commands\TableData;
use Modularization\Core\Console\Commands\TransDBCommand;
use Modularization\Facades\CheckFun;
use Modularization\Facades\CurlFun;
use Modularization\Facades\DBFun;
use Modularization\Facades\FileFun;
use Modularization\Facades\FormatFun;
use Modularization\Facades\InputFun;

use Illuminate\Support\ServiceProvider;
use Uploader\Facades\UploadFun;
use Uploader\Providers\UploadServiceProvider;

class ModularizationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'mod');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->publishes([
            __DIR__ . '/config/modularization.php' => config_path('modularization.php'),
            __DIR__ . '/views/vendor/layouts/alerts/confirm.blade.php' => resource_path('/views/layouts/alerts/confirm.blade.php'),
            __DIR__ . '/views/vendor/layouts/alerts/error.blade.php' => resource_path('/views/layouts/alerts/error.blade.php'),
            __DIR__ . '/views/vendor/layouts/alerts/errors.blade.php' => resource_path('/views/layouts/alerts/errors.blade.php'),
            __DIR__ . '/views/vendor/layouts/alerts/global.blade.php' => resource_path('/views/layouts/alerts/global.blade.php'),
            __DIR__ . '/views/vendor/layouts/alerts/index.blade.php' => resource_path('/views/layouts/alerts/index.blade.php'),
            __DIR__ . '/views/vendor/layouts/alerts/message.blade.php' => resource_path('/views/layouts/alerts/message.blade.php'),
            __DIR__ . '/views/vendor/layouts/alerts/success.blade.php' => resource_path('/views/layouts/alerts/success.blade.php'),
        ], 'modularization');

        $this->publishes([
            __DIR__ . '/config/modularization.php' => config_path('modularization.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ForceDBCommand::class,
                ConstDBCommand::class,
                FileRemove::class,
                FileChange::class,
                TableColumn::class,
                TableData::class,
                TableName::class,
                RenderRoute::class,
                FileRename::class,
                TransDBCommand::class,
            ]);
        }

        $this->app->singleton(Factory::class, function ($app){
            $faker = $app->make(Generator::class);
            $factories_path = __DIR__ . '/database/factories';
            return Factory::construct($faker, $factories_path);
        });

        view()->share('asset_url', config('app.asset_url'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CheckFa', CheckFun::class);
        $this->app->bind('CurlFa', CurlFun::class);
        $this->app->bind('DBFa', DBFun::class);
        $this->app->bind('FileFa', FileFun::class);
        $this->app->bind('FormatFa', FormatFun::class);
        $this->app->bind('InputFa', InputFun::class);
        $this->app->bind('UploadFa', UploadFun::class);

        $this->app->register(UploadServiceProvider::class);
    }
}
