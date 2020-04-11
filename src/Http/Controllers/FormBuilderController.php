<?php

namespace Cuongpm\Modularization\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Core\Factories\FormBuilderFactory;
use Cuongpm\Modularization\Interfaces\ControllerInterface;
use Illuminate\Support\Facades\View;

/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/18/17
 * Time: 3:45 PM
 */
class FormBuilderController extends Controller implements ControllerInterface
{
    private $factory;

    public function __construct(FormBuilderFactory $factory)
    {
        $this->factory = $factory;
    }

    public function produce($table = 'users')
    {
        // TODO: Implement produce() method.
        $this->factory->building($table);
        $this->show($table);
    }

    private function outNgFormBuilder($table, $path = 'app')
    {
        return base_path('tsc/form/' . $table . '.ts');
    }


    public function show($table = 'users')
    {
        echo resource_path($this->outNgFormBuilder($table));
        echo '<pre>';
        echo file_get_contents($this->outNgFormBuilder($table));
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view($table);
        }
        return abort(404, 'Views not found');
    }

}
