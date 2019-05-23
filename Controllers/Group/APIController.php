<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 2:28 PM
 */

namespace Modularization\Controllers\Group;


use Illuminate\Http\Request;
use Modularization\Core\Components\Http\Controllers\ApiCtrlComponent;
use Modularization\Core\Factories\Http\Controllers\ApiCtrlFactory;
use Modularization\Core\Factories\Http\Resources\ResourceFactory;
use Modularization\Core\Factories\Routers\RouteApiFactory;
use Modularization\Core\Factories\ServiceProviderFactory;

class APIController extends RenderController
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
        $input = $this->fix($input);

        $this->ApiCtrlFactory->building($input);
        $this->resourceFactory->building($input);
        $this->routeApiFactory->building($input['namespace'], $input['path']);
        $this->extraRender($input);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input = $this->fix($input);
        $table = $input['table'];
        $this->produce($input);
        $mgs = $this->buildRoute($input['namespace']) . $this->buildMessage($table);
        session()->flash('success', $mgs);

        return redirect()->back()->withInput($request->all());
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
}