<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 2:28 PM
 */

namespace Modularization\Http\Controllers\Group;


use Illuminate\Http\Request;
use Modularization\Core\Factories\Http\Controllers\CtrlFactory;
use Modularization\Core\Factories\ServiceProviderFactory;

class FrontendController extends RenderController
{
    public function store(Request $request)
    {
        $input = $request->all();
        $prefix = $input['prefix'];
        $input = $this->fix($input);
        $table = $input['table'];
        $namespace = $input['namespace'];
        $path = $input['path'];

        if($request->provider) {
            app(ServiceProviderFactory::class)->building($namespace, $path, $prefix);
        }
        if($request->controller) {
            app(CtrlFactory::class)->building($input);
        }

        $mgs = $this->buildMessage($table);
        $menu = $this->buildMenu($table, $namespace);
        session()->flash('success', $mgs);
        session()->flash('global', $menu);
        return redirect()->back()->withInput($request->all());
    }

    private function buildMessage($table)
    {
        $name = ucfirst(camel_case(str_singular($table)));
        $route = kebab_case(camel_case(($table)));
        $mgs = "Route::resource('{$route}' , '{$name}Controller'); \n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
        return $mgs;
    }

    public function buildMenu($table, $namespace)
    {
        $name = (camel_case(($table)));
        $route = kebab_case(camel_case(($table)));

        return "<li class=\"has-sub root-level\" id=\"{$namespace}Menu\">
            <a>
                <i class=\"fa fa-file\"></i>
                <span class=\"title\">{{__('menu.{$namespace}')}}</span>
            </a>
            <ul>
                <li  id=\"{$name}Menu\">
                    <a href=\"{{route('{$route}.index')}}\">
                        <span class=\"title\">{{__('table.{$table}')}}</span>
                    </a>
                </li>
            </ul>
        </li>";
    }
}