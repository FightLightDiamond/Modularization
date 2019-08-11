<?php

namespace Modularization\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modularization\Core\Factories\Http\Requests\RequestFactory;

/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 12:43 PM
 */
class RequestController extends Controller
{
    protected $factory;

    public function __construct(RequestFactory $factory)
    {
        $this->factory = $factory;
    }

    public function produce($table = 'users')
    {
        $this->factory->building($table);
    }

    public function show($table = 'users')
    {
        echo $patch = $this->factory->getSource($table);
        echo '<pre>';
        echo file_get_contents($patch);
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view('Policy/' . $table);
        }
        return abort(404, 'Views not found');
    }
}