<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 2:28 PM
 */

namespace Modularization\Controllers\Group;


use Illuminate\Http\Request;
use Modularization\Core\Factories\Http\Controllers\APICtrlFactory;
use Modularization\Core\Factories\Http\Resources\ResourceFactory;
use Modularization\Core\Factories\Routers\RouteAPIFactory;

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

    public function produce($inputFix)
    {
        $inputFix = $this->fix($inputFix);

        $this->APICtrlFactory->building($inputFix);
        $this->resourceFactory->building($inputFix);
        $this->routeAPIFactory->building($inputFix['namespace'], $inputFix['path']);
        $this->extraRender($inputFix);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $inputFix = $this->fix($input);
        $table = $inputFix['table'];
        $this->produce($inputFix);
        $moduleContent = $this->buildRoute($inputFix['namespace']) . "\n\n" . $this->buildMessage($table);

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