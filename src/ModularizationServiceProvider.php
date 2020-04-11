<?php

namespace Cuongpm\Modularization;

use Cuongpm\Modularization\Console\Commands\Modules\ProjectModuleCommand;
use Cuongpm\Modularization\Console\Commands\Modules\ModelModuleCommand;
use Cuongpm\Modularization\Console\Commands\Modules\RepositoryModuleCommand;
use Cuongpm\Modularization\Console\Commands\Modules\RequestModuleCommand;
use Cuongpm\Modularization\Console\Commands\Modules\ServiceModuleCommand;
use Cuongpm\Modularization\Console\Commands\Tables\TableName;
use Cuongpm\Modularization\Console\Commands\ConstDBCommand;
use Cuongpm\Modularization\Console\Commands\Files\FileChange;
use Cuongpm\Modularization\Console\Commands\Files\FileRemove;
use Cuongpm\Modularization\Console\Commands\Files\FileRename;
use Cuongpm\Modularization\Console\Commands\RenderRoute;
use Cuongpm\Modularization\Console\Commands\Tables\TableColumn;
use Cuongpm\Modularization\Console\Commands\Tables\TableData;
use Cuongpm\Modularization\Console\Commands\Modules\TestModuleCommand;
use Cuongpm\Modularization\Console\Commands\TransDBCommand;
use Cuongpm\Modularization\Http\Facades\CheckFun;
use Cuongpm\Modularization\Http\Facades\CurlFun;
use Cuongpm\Modularization\Http\Facades\DBFun;
use Cuongpm\Modularization\Http\Facades\FileFun;
use Cuongpm\Modularization\Http\Facades\FormatFun;
use Cuongpm\Modularization\Http\Facades\InputFun;

use Illuminate\Support\ServiceProvider;
use Uploader\Facades\UploadFun;
use Uploader\Providers\UploadServiceProvider;

class Cuongpm\ModularizationServiceProvider extends ServiceProvider
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

//        $this->publishes([
//            __DIR__ . '/../resources/views/vendor/layouts/alerts/confirm.blade.php' => resource_path('/views/layouts/alerts/confirm.blade.php'),
//            __DIR__ . '/../resources/views/vendor/layouts/alerts/error.blade.php' => resource_path('/views/layouts/alerts/error.blade.php'),
//            __DIR__ . '/../resources/views/vendor/layouts/alerts/errors.blade.php' => resource_path('/views/layouts/alerts/errors.blade.php'),
//            __DIR__ . '/../resources/views/vendor/layouts/alerts/global.blade.php' => resource_path('/views/layouts/alerts/global.blade.php'),
//            __DIR__ . '/../resources/views/vendor/layouts/alerts/index.blade.php' => resource_path('/views/layouts/alerts/index.blade.php'),
//            __DIR__ . '/../resources/views/vendor/layouts/alerts/message.blade.php' => resource_path('/views/layouts/alerts/message.blade.php'),
//            __DIR__ . '/../resources/views/vendor/layouts/alerts/success.blade.php' => resource_path('/views/layouts/alerts/success.blade.php'),
//        ], 'modularization');

        $this->publishes([
            __DIR__ . '/../config/modularization.php' => config_path('modularization.php'),
        ], 'modularization');

        $this->mergeConfigFrom(__DIR__ . '/../config/modularization.php', 'modularization');

        if ($this->app->runningInConsole()) {
            $this->commands([
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
