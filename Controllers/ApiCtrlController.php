<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 10/20/18
 * Time: 9:42 AM
 */

namespace Modularization\Controllers;


use Illuminate\Http\Request;
use Modularization\Core\Components\Http\Controllers\ApiCtrlComponent;
use Modularization\Core\Factories\Http\Controllers\ApiCtrlFactory;
use Modularization\Core\Factories\Http\Repositories\InterfaceFactory;
use Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Modularization\Core\Factories\Http\Resources\ResourceFactory;
use Modularization\Core\Factories\Http\Services\ServiceFactory;
use Modularization\Core\Factories\Models\ModelFactory;
use Modularization\Core\Factories\Polices\PolicyFactory;
use Modularization\Core\Factories\Routers\RouteApiFactory;
use Modularization\Core\Factories\Routers\RouterFactory;
use Modularization\Core\Factories\ServiceProviderFactory;


class ApiCtrlController
{
    private $ApiCtrlFactory, $resourceFactory, $routeApiFactory;

    public function __construct(
        ApiCtrlFactory $ApiCtrlFactory,
        ResourceFactory $resourceFactory,
        RouteApiFactory $routeApiFactory
    )
    {
        $this->ApiCtrlFactory = $ApiCtrlFactory;
        $this->resourceFactory = $resourceFactory;
        $this->routeApiFactory = $routeApiFactory;
    }

    public function produce($input)
    {
        $prefix = $input['prefix'];
        $input = $this->fix($input);
        $table = $input['table'];
        $namespace = $input['namespace'];
        $path = $input['path'];

        $this->ApiCtrlFactory->building($input);
        $this->resourceFactory->building($input);
        $this->routeApiFactory->building($input['namespace'], $input['path']);

        if(isset($input['provider'])) {
            app(ServiceProviderFactory::class)->building($namespace, $path, $prefix);
        }
        if(isset($input['controller'])) {
            app(ApiCtrlComponent::class)->building($input);
        }
        if(isset($input['repository'])) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(InterfaceFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['model'])) {
            app(ModelFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['request'])) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['policy'])) {
            app(PolicyFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['route'])) {
            app(RouterFactory::class)->building($namespace, $path);
        }
        if(isset($input['service'])) {
            app(ServiceFactory::class)->building($input);
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input = $this->fix($input);
        $table = $input['table'];

        $this->produce($input);
        $mgs = $this->buildRoute($input['namespace']) . $this->buildMessage($table);
        session()->flash('success', $mgs);

        return redirect()->back()->withInput($input);
    }

    private function buildMessage($table)
    {
        $name = ucfirst(camel_case(str_singular($table)));
        $route = kebab_case(camel_case(($table)));
        $mgs = "Route::resource('{$route}' , '{$name}ApiController'); \n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
        return $mgs;
    }

    private function buildRoute($namespace) {
        return "Route::name('api.')
            ->namespace('{$namespace}\Http\Controllers\API')
            ->prefix('api')
            ->middleware(['api'])
            ->group( function () {
                
            });";
    }

    private function fix($input)
    {
        $path = $input['path'];

        try {
            mkdir(base_path($path));
        } catch (\Exception $exception) {
            dump($exception->getMessage());
        }

        $input['table'] = isset($input['table']) ? $input['table'] : 'users';
        $input['path'] = isset($input['path']) ? $input['path'] : 'app';
        $input['namespace'] = isset($input['namespace']) ? $input['namespace'] : 'App';
        $input['prefix'] = isset($input['prefix']) ? $input['prefix'] . '::' : '';
        $input['route'] = kebab_case(camel_case(($input['table'])));
        $input['viewFolder'] = kebab_case(camel_case(str_singular($input['table'])));
        return $input;
    }
}