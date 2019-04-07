<?php

namespace Modularization\Controllers;

use App\Http\Controllers\Controller;
use Modularization\Core\Factories\CtrlFactory;
use Modularization\Helpers\CRUDPath;
use Modularization\Helpers\BuildPath;
use Illuminate\View\View;

/**
 * Created by PhpStorm.
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
        return $this->show($table);
    }

    public function show($table = 'users')
    {
        echo $patch = BuildPath::outController($table);
        echo '<pre>';
        echo file_get_contents($patch);
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view('Controllers/' . $table);
        }
        return abort(404, 'Views not found');
    }
}