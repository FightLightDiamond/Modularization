<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/2/2016
 * Time: 9:32 AM
 */

namespace Modularization\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Modularization\Core\Factories\Views\FormFactory;

class FormController extends Controller
{
    protected $factory;

    public function __construct(FormFactory $factory)
    {
        $this->factory = $factory;
    }

    public function produce($table = 'users')
    {
        $this->factory->building($table);
        return $this->view($table . '.create');
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view($table);
        }
        return abort(404, 'Views not found');
    }
}