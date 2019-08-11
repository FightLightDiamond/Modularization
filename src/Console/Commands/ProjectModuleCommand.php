<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modularization\Core\Components\Http\Controllers\APICtrlComponent;
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
use Modularization\Core\Factories\ServiceProviderFactory;
use Modularization\Http\Facades\DBFa;

class BuildProjectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:project';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $namespace = 'App';
        $path = 'app';

        app(RouteAPIFactory::class)->building('App', 'app');

        $tables = DBFa::table();

        foreach ($tables as $table) {
            $input = $this->fix($table);

            app(APICtrlFactory::class)->building($input);
            app(ResourceFactory::class)->building($input);
            app(RequestFactory::class)->building($table);
            app(APICtrlComponent::class)->building($input);
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(InterfaceFactory::class)->building($table, $namespace, $path);
            app(ModelFactory::class)->building($table, $namespace, $path);
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(PolicyFactory::class)->building($table, $namespace, $path);
            app(RouterFactory::class)->building($namespace, $path);
            app(ServiceFactory::class)->building($input);

            $this->buildMessage($table);
        }
    }

    private function fix($table)
    {
        $path = 'app';
        $input['path'] = $path;
        $input['table'] = $table;
        $input['prefix'] = '';
        $input['namespace'] = 'App';
        $input['route'] = kebab_case(camel_case(($table)));
        $input['viewFolder'] = kebab_case(camel_case(str_singular($table)));
        return $input;
    }

    private function buildMessage($table)
    {
        $name = ucfirst(camel_case(str_singular($table)));
        $route = kebab_case(camel_case(($table)));
        $this->routeMsg .= "Route::resource('{$route}' , '{$name}APIController'); \n";
        $this->repositoryMsg .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
    }
}