<?php

namespace Modularization\Controllers;

use Modularization\Core\Factories\ObserverFactory;
use Modularization\Helpers\CRUDPath;
use Illuminate\Support\Facades\View;

/**
 * Created by PhpStorm.
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
        $this->factory->building($table);
        $this->show($table);
    }

    public function show($table = 'users')
    {
        echo $patch = CRUDPath::outObServer($table);
        echo '<pre>';
        echo file_get_contents($patch);
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view('Models/' . $table);
        }
        return abort(404, 'Views not found');
    }
}