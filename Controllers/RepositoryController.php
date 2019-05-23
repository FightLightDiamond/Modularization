<?php

namespace Modularization\Controllers;

use App\Http\Controllers\Controller;
use Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Illuminate\View\View;

/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 12:42 PM
 */
class RepositoryController extends Controller
{
    protected $factory;

    public function __construct(RepositoryFactory $factory)
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
            return view('Repositories/' . $table);
        }
        return abort(404, 'Views not found');
    }
}