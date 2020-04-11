<?php

namespace Cuongpm\Modularization\Http\Controllers;

use Cuongpm\Modularization\Core\Factories\Observers\ObserverFactory;
use Illuminate\Support\Facades\View;

/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/30/17
 * Time: 12:55 AM
 */
class ObserverController
{
    protected $factory;

    public function __construct(ObserverFactory $factory)
    {
        $this->factory = $factory;
    }

    public function produce($table = 'users')
    {
        $this->factory->building($table);;
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view('Models/' . $table);
        }
        return abort(404, 'Views not found');
    }
}
