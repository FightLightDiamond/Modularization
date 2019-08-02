<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 2:28 PM
 */

namespace Modularization\Controllers\Group;


use Illuminate\Http\Request;
use Modularization\Core\Components\Http\Controllers\APICtrlComponent;
use Modularization\Core\Factories\Http\Controllers\APICtrlFactory;
use Modularization\Core\Factories\Http\Resources\ResourceFactory;
use Modularization\Core\Factories\Routers\RouteAPIFactory;
use Modularization\Core\Factories\ServiceProviderFactory;

class APIController extends RenderController
{
    private $APICtrlFactory, $resourceFactory, $routeAPIFactory;

    public function __construct(
        APICtrlFactory $APICtrlFactory,
        ResourceFactory $resourceFactory,
        RouteAPIFactory $routeAPIFactory
    )
    {
        $this->APICtrlFactory = $APICtrlFactory;
        $this->resourceFactory = $resourceFactory;
        $this->routeAPIFactory = $routeAPIFactory;
    }

    public function produce($input)
    {
        $input = $this->fix($input);

        $this->APICtrlFactory->building($input);
        $this->resourceFactory->building($input);
        $this->routeAPIFactory->building($input['namespace'], $input['path']);
        $this->extraRender($input);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input = $this->fix($input);
        $table = $input['table'];
        $this->produce($input);
        $moduleContent = $this->buildRoute($input['namespace']) . "\n\n" . $this->buildMessage($table);

        session()->flash('moduleContent', $moduleContent);

        return redirect()->back()->withInput($input);
    }

    private function buildMessage($table)
    {
        $name = ucfirst(camel_case(str_singular($table)));
        $route = kebab_case(camel_case(($table)));
        $mgs = "Route::resource('{$route}', '{$name}APIController'); \n\n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
        return $mgs;
    }

    private function buildRoute($namespace) {
        return
            "Route::name('api.')
                ->namespace('{$namespace}\Http\Controllers\API')
                ->prefix('api')
                ->middleware(['api'])
                ->group( function () {
                    
                });";
    }
}