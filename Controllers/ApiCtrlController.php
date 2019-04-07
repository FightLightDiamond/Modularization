<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 10/20/18
 * Time: 9:42 AM
 */

namespace Modularization\Controllers;


use Illuminate\Http\Request;
use Modularization\Core\Factories\ApiCtrlFactory;
use Modularization\Core\Factories\ResourceFactory;

class ApiCtrlController
{
    private $ApiCtrlFactory, $resourceFactory;

    public function __construct(
        ApiCtrlFactory $ApiCtrlFactory,
        ResourceFactory $resourceFactory
    )
    {
        $this->ApiCtrlFactory = $ApiCtrlFactory;
        $this->resourceFactory = $resourceFactory;
    }

    public function produce($input)
    {
        $this->ApiCtrlFactory->building($input);
        $this->resourceFactory->building($input);
    }

    public function create()
    {
        return view('mod::render.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input = $this->fix($input);
        $table = $input['table'];
        $this->produce($input);
        $mgs = $this->buildMessage($table);
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

    private function fix($input)
    {
        $input['table'] = isset($input['table']) ? $input['table'] : USERS_TB;
        $input['path'] = isset($input['path']) ? $input['path'] : 'app';
        $input['namespace'] = isset($input['namespace']) ? $input['namespace'] : 'App';
        $input['prefix'] = isset($input['prefix']) ? $input['prefix'] . '::' : '';
        $input['route'] = kebab_case(camel_case(($input['table'])));
        $input['viewFolder'] = kebab_case(camel_case(str_singular($input['table'])));
        return $input;
    }
}