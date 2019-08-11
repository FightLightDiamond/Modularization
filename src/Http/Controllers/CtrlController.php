<?php

namespace Modularization\Http\Controllers;

use App\Http\Controllers\Controller;
use Modularization\Core\Factories\Http\Controllers\CtrlFactory;
use Illuminate\View\View;

/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 12:43 PM
 */
class CtrlController extends Controller
{
    protected $factory;

    public function __construct(CtrlFactory $factory)
    {
        $this->factory = $factory;
    }

    public function produce($table = 'users')
    {
        $this->factory->building($table);
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view('Controllers/' . $table);
        }
        return abort(404, 'Views not found');
    }
}