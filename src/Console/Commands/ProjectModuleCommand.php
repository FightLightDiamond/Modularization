<?php

namespace Modularization\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modularization\Core\Components\Http\Controllers\APICtrlComponent;
use Modularization\Core\Factories\Http\Controllers\AdminCtrlFactory;
use Modularization\Core\Factories\Http\Controllers\APICtrlFactory;
use Modularization\Core\Factories\Http\Repositories\InterfaceFactory;
use Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Modularization\Core\Factories\Http\Requests\RequestFactory;
use Modularization\Core\Factories\Http\Resources\ResourceFactory;
use Modularization\Core\Factories\Http\Services\ServiceFactory;
use Modularization\Core\Factories\Models\ModelFactory;
use Modularization\Core\Factories\Polices\PolicyFactory;
use Modularization\Core\Factories\Routers\RouteAPIFactory;
use Modularization\Core\Factories\Routers\RouterFactory;
use Modularization\Http\Facades\DBFa;
use Modularization\src\Core\Factories\Tests\Feature\FeatureTestFactory;
use Modularization\src\Helpers\BuildInput;

class ProjectModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:project {table?} {--namespace=App}  {--path=app} {--seed=no}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $routeMsg = '';
    private $repositoryMsg = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function getBlackTable()
    {
        return config('modularization.black_tables');
    }

    protected $table, $tables, $namespace, $path, $seed;

    private function input()
    {
        $table = $this->argument('table') ?? '*';
        $this->tables = $this->getTables($table);

        $namespace = $this->option('namespace');
        $namespace = rtrim($namespace, "\\");
        $namespace .= "\\";
        $this->namespace = $namespace;

        $this->path = $this->option('path');
        $this->seed = $this->option('seed');

        $this->info("Table: {$table} ");
        $this->info("Namespace: {$namespace} ");
        $this->info("Path: {$this->path} ");
        $this->info("Seed: {$this->seed} ");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->input();

        $bar = $this->output->createProgressBar(count($this->tables) * 2);
        $bar->start();

        foreach ($this->tables as $table) {
            if (in_array($table, $this->getBlackTable())) {
                continue;
            }

            $input = $this->fix($table);
//            app(RouteAPIFactory::class)->building($namespace, $path);
//            app(RouterFactory::class)->building($namespace, $path);

            $this->HTTP($input, $table);
            $this->MRP($table);
            $this->admin($input);

            $input = $this->fixTestInput($input);

            app(FeatureTestFactory::class)->building($input);

            $class = BuildInput::classe($table);
            $bar->advance();

            if($this->seed === 'yes') {
                $this->runSeed($class);
            }

            $this->buildMessage($table);
            $bar->advance();
        }

        $bar->finish();
        $this->msg();
    }

    private function fixTestInput($input)
    {
        if ($input['path'] === 'app') {
            $input['path'] = '';
        }

        return $input;
    }

    private function getTables($table)
    {
        if ($table === '*') {
            $tables = DBFa::table();
        } else {
            $tables = [$table];
        }

        return $tables;
    }

    private function msg()
    {
        $this->info('');
        $this->line('Please copy to app/routes/api.php');
        $this->info($this->routeMsg);
        $this->line('Please copy to app/Provider/AppServiceProvider.php at function register()');
        $this->info($this->repositoryMsg);
    }

    private function HTTP($input, $table)
    {
        app(APICtrlFactory::class)->building($input);
        app(ResourceFactory::class)->building($input);
        app(RequestFactory::class)->building($table, $this->namespace, $this->path);
        app(ServiceFactory::class)->building($input);
    }

    private function MRP($table)
    {
        app(RepositoryFactory::class)->building($table, $this->namespace, $this->path);
        app(InterfaceFactory::class)->building($table, $this->namespace, $this->path);

        app(PolicyFactory::class)->building($table, $this->namespace, $this->path);

        app(ModelFactory::class)->building($table, $this->namespace, $this->path);
    }

    private function runSeed($class)
    {
        Artisan::call("make:seeder {$class}Seeder");
        Artisan::call("make:factory {$class}Factory --model={$class}");
    }

    private function admin($input)
    {
        $table = $input['table'];
        $namespace = $input['namespace'];
        $path = $input['path'];

        app(AdminCtrlFactory::class)->building($input);
        app(ServiceFactory::class)
            ->setAuth('Admin')
            ->building($input);

        app(RequestFactory::class)
            ->setAuth('Admin')
            ->building($table, $namespace, $path);

        app(ResourceFactory::class)
            ->setAuth('Admin')
            ->building($input);

        $input = $this->fixTestInput($input);

        app(FeatureTestFactory::class)
            ->setAuth('Admin')
            ->building($input);
    }
    
    private function fix($table)
    {
        $input['path'] = $this->path;
        $input['table'] = $table;
        $input['prefix'] = '';
        $input['namespace'] = $this->namespace;
        $input['route'] = BuildInput::route($table);
//        $input['viewFolder'] = kebab_case(camel_case(str_singular($table)));

        return $input;
    }

    private function buildMessage($table)
    {
        $name = BuildInput::classe($table);
        $route = BuildInput::route($table);
        $this->routeMsg .= "Route::resource('{$route}' , '{$name}APIController'); \n";
        $this->repositoryMsg .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
    }
}
