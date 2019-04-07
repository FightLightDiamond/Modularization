<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 6:18 PM
 */

namespace Modularization\Controllers;

use App\Http\Controllers\Controller;
use Modularization\Core\Factories\CtrlFactory;
use Modularization\Core\Factories\FormFactory;
use Modularization\Core\Factories\InterfaceFactory;
use Modularization\Core\Factories\ModelFactory;
use Modularization\Core\Factories\PolicyFactory;
use Modularization\Core\Factories\RepositoryFactory;
use Modularization\Core\Factories\RequestFactory;
use Illuminate\Http\Request;
use Modularization\Core\Factories\RouterFactory;
use Modularization\Core\Factories\ServiceProviderFactory;
use Modularization\Facades\DBFa;

class MagicController extends Controller
{
    protected $formFactory, $ctrlFactory, $interfaceFactory, $repositoryFactory, $modelFactory,
        $requestFactory, $policyFactory, $serviceProviderFactory, $routerFactory;

    public function __construct(
        FormFactory $formFactory,
        CtrlFactory $ctrlFactory,
        InterfaceFactory $interfaceFactory,
        RepositoryFactory $repositoryFactory,
        ModelFactory $modelFactory,
        RequestFactory $requestFactory,
        PolicyFactory $policyFactory,
        ServiceProviderFactory $serviceProviderFactory,
        RouterFactory $routerFactory
    )
    {
        $this->formFactory = $formFactory;
        $this->ctrlFactory = $ctrlFactory;
        $this->interfaceFactory = $interfaceFactory;
        $this->repositoryFactory = $repositoryFactory;
        $this->modelFactory = $modelFactory;
        $this->requestFactory = $requestFactory;
        $this->policyFactory = $policyFactory;
        $this->serviceProviderFactory = $serviceProviderFactory;
        $this->routerFactory = $routerFactory;
    }

    public function produce($table = 'users')
    {
        $this->formFactory->building($table);
        $this->ctrlFactory->building($table);
        $this->interfaceFactory->building($table);
        $this->repositoryFactory->building($table);
        $this->modelFactory->building($table);
        $this->requestFactory->building(str_singular($table));
        $this->policyFactory->building($table);
    }

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
        return view('mod::module.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $prefix = $input['prefix'];
        $input = $this->fix($input);
        $table = $input['table'];
        $namespace = $input['namespace'];
        $path = $input['path'];

        $this->formFactory->building($input);
        $this->ctrlFactory->building($input);
        $this->interfaceFactory->building($table, $namespace, $path);
        $this->repositoryFactory->building($table, $namespace, $path);
        $this->modelFactory->building($table, $namespace, $path);
        $this->requestFactory->building(str_singular($table), $namespace, $path);
        $this->policyFactory->building($table, $namespace, $path);
        $this->serviceProviderFactory->building($namespace, $path, $prefix);
        $this->routerFactory->building($namespace, $path);

        $mgs = $this->buildMessage($table);
        $menu = $this->buildMenu($table, $namespace);
        session()->flash('success', $mgs);
        session()->flash('global', $menu);
        return redirect()->back()->withInput($request->all());;
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