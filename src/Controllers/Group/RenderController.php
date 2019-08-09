<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 2:29 PM
 */

namespace Modularization\Controllers\Group;

use App\Http\Controllers\Controller;
use Modularization\Core\Factories\Http\Repositories\InterfaceFactory;
use Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Modularization\Core\Factories\Http\Requests\RequestFactory;
use Modularization\Core\Factories\Http\Services\ServiceFactory;
use Modularization\Core\Factories\Models\ModelFactory;
use Modularization\Core\Factories\Polices\PolicyFactory;
use Modularization\Core\Factories\Routers\RouterFactory;
use Modularization\Core\Factories\ServiceProviderFactory;
use Modularization\Facades\DBFa;
use Modularization\src\Core\Factories\Tests\Feature\FeatureTestFactory;

class RenderController extends Controller
{
    public function create()
    {
        $tables = DBFa::table();
        $name = \request('name');

        if ($name) {
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

    public function extraRender($input)
    {
        $prefix = $input['prefix'];
        $table = $input['table'];
        $namespace = $input['namespace'];
        $path = $input['path'];

        if(request()->provider && request()->provider !== 'App') {
            app(ServiceProviderFactory::class)->building($namespace, $path, $prefix);
        }
        if(request()->repository) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(InterfaceFactory::class)->building($table, $namespace, $path);
        }
        if(request()->model) {
            app(ModelFactory::class)->building($table, $namespace, $path);
        }
        if(request()->request) {
            app(RequestFactory::class)->building($table, $namespace, $path);
        }
        if(request()->policy) {
            app(PolicyFactory::class)->building($table, $namespace, $path);
        }
        if(request()->route && request()->provider !== 'App') {
            app(RouterFactory::class)->building($namespace, $path);
        }
        if(request()->service) {
            app(ServiceFactory::class)->building($input);
        }
        if(request()->test)
        {
            app(FeatureTestFactory::class)->building($input);
        }
    }

    public function fix($input)
    {
        $path = $input['path'];

        try {
            mkdir(base_path($path));
        } catch (\Exception $exception) {
            dump($exception->getMessage());
        }

        $input['table'] = isset($input['table']) ? $input['table'] : 'user_id';
        $input['path'] = isset($input['path']) ? $input['path'] : 'app';
        $input['namespace'] = isset($input['namespace']) ? $input['namespace'] : 'App';
        $input['prefix'] = isset($input['prefix']) ? $input['prefix'] . '::' : '';
        $input['route'] = kebab_case(camel_case(($input['table'])));
        $input['viewFolder'] = kebab_case(camel_case(str_singular($input['table'])));

        return $input;
    }

}