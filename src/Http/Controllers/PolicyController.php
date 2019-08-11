<?php

namespace Modularization\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modularization\Core\Factories\Polices\PolicyFactory;

/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 12:45 PM
 */
class PolicyController extends Controller
{
    protected $factory;

    public function __construct(PolicyFactory $factory)
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