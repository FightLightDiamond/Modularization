<?php

namespace Modularization;

use Modularization\Console\Commands\ProjectModuleCommand;
use Modularization\Console\Commands\ModelModuleCommand;
use Modularization\Console\Commands\RepositoryModuleCommand;
use Modularization\Console\Commands\RequestModuleCommand;
use Modularization\Console\Commands\ServiceModuleCommand;
use Modularization\Console\Commands\TableName;
use Modularization\Console\Commands\ConstDBCommand;
use Modularization\Console\Commands\FileChange;
use Modularization\Console\Commands\FileRemove;
use Modularization\Console\Commands\FileRename;
use Modularization\Console\Commands\ForceDBCommand;
use Modularization\Console\Commands\RenderRoute;
use Modularization\Console\Commands\TableColumn;
use Modularization\Console\Commands\TableData;
use Modularization\Console\Commands\TestModuleCommand;
use Modularization\Console\Commands\TransDBCommand;
use Modularization\Http\Facades\CheckFun;
use Modularization\Http\Facades\CurlFun;
use Modularization\Http\Facades\DBFun;
use Modularization\Http\Facades\FileFun;
use Modularization\Http\Facades\FormatFun;
use Modularization\Http\Facades\InputFun;

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
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mod');
        $this->loadRoutesFrom(__DIR__ . '/../routers/web.php');

        $this->publishes([
            __DIR__ . '/../resources/views/vendor/layouts/alerts/confirm.blade.php' => resource_path('/views/layouts/alerts/confirm.blade.php'),
            __DIR__ . '/../resources/views/vendor/layouts/alerts/error.blade.php' => resource_path('/views/layouts/alerts/error.blade.php'),
            __DIR__ . '/../resources/views/vendor/layouts/alerts/errors.blade.php' => resource_path('/views/layouts/alerts/errors.blade.php'),
            __DIR__ . '/../resources/views/vendor/layouts/alerts/global.blade.php' => resource_path('/views/layouts/alerts/global.blade.php'),
            __DIR__ . '/../resources/views/vendor/layouts/alerts/index.blade.php' => resource_path('/views/layouts/alerts/index.blade.php'),
            __DIR__ . '/../resources/views/vendor/layouts/alerts/message.blade.php' => resource_path('/views/layouts/alerts/message.blade.php'),
            __DIR__ . '/../resources/views/vendor/layouts/alerts/success.blade.php' => resource_path('/views/layouts/alerts/success.blade.php'),
        ], 'modularization');

        $this->publishes([
            __DIR__ . '/../config/modularization.php' => config_path('modularization.php'),
        ], 'modularization');

        $this->mergeConfigFrom(__DIR__ . '/../config/modularization.php', 'modularization');

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

                ModelModuleCommand::class,
                ProjectModuleCommand::class,
                RepositoryModuleCommand::class,
                RequestModuleCommand::class,
                ServiceModuleCommand::class,
                TestModuleCommand::class,
            ]);
        }
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
