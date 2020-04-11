<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 6:18 PM
 */

namespace Cuongpm\Modularization\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Core\Factories\Http\Controllers\CtrlFactory;
use Cuongpm\Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Cuongpm\Modularization\Core\Factories\Http\Requests\RequestFactory;
use Cuongpm\Modularization\Core\Factories\Models\ModelFactory;
use Cuongpm\Modularization\Core\Factories\Polices\PolicyFactory;
use Cuongpm\Modularization\Core\Factories\Http\Repositories\InterfaceFactory;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Cuongpm\Modularization\Core\Factories\Routers\RouterFactory;
use Cuongpm\Modularization\Core\Factories\ServiceProviderFactory;
use Cuongpm\Modularization\Core\Factories\Http\Services\ServiceFactory;
use Cuongpm\Modularization\Core\Factories\Views\FormFactory;
use Cuongpm\Modularization\Http\Facades\DBFa;

class MagicController extends Controller
{
    public function create()
    {
        $tables = DBFa::table();
        $name = \request('name');

        if($name) {
            foreach ($tables as $k => $table) {
                if (strpos($table, $name) === false) {
                    unset($tables[$k]);
                }
            }
        }

        $options = [
            'controller', 'model', 'repository', 'view', 'request', 'policy', 'service', 'route', 'provider', 'test'
        ];
        $optionAPIs = [
            'controller', 'model', 'repository', 'resource', 'request', 'policy', 'service', 'route', 'provider', 'test'
        ];

        return view('mod::module.create', compact('tables', 'options', 'optionAPIs'));
    }

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
        if($request->view) {
            app(FormFactory::class)->building($input);
        }
        if($request->controller) {
            app(CtrlFactory::class)->building($input);
        }
        if($request->repository) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(InterfaceFactory::class)->building($table, $namespace, $path);
        }
        if($request->model) {
            app(ModelFactory::class)->building($table, $namespace, $path);
        }
        if($request->request) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
        }
        if($request->policy) {
            app(PolicyFactory::class)->building($table, $namespace, $path);
        }
        if($request->route) {
            app(RouterFactory::class)->building($namespace, $path);
        }
        if($request->service) {
            app(ServiceFactory::class)->building($input);
        }

        $mgs = $this->buildMessage($table);
        $menu = $this->buildMenu($table, $namespace);
        session()->flash('success', $mgs);
        session()->flash('global', $menu);

        return redirect()->back()->withInput($request->all());;
    }

    private function buildMessage($table)
    {
        $name = Str::ucfirst(Str::camel(Str::singular($table)));
        $route = Str::kebab(Str::camel(($table)));
        $mgs = "Route::resource('{$route}' , '{$name}Controller'); \n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
        return $mgs;
    }

    public function buildMenu($table, $namespace)
    {
        $name = (Str::camel(($table)));
        $route = Str::kebab(Str::camel(($table)));

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

    private function fix($input)
    {
        $input['table'] = isset($input['table']) ? $input['table'] : 'user_id';
        $input['path'] = isset($input['path']) ? $input['path'] : 'app';
        $input['namespace'] = isset($input['namespace']) ? $input['namespace'] : 'App\\';
        $input['prefix'] = isset($input['prefix']) ? $input['prefix'] . '::' : '';
        $input['route'] = Str::kebab(Str::camel(($input['table'])));
        $input['viewFolder'] = Str::kebab(Str::camel(Str::singular($input['table'])));

        return $input;
    }
}
