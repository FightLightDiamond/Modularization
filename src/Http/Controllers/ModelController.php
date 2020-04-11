<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:32 AM
 */

namespace Cuongpm\Modularization\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Cuongpm\Modularization\Core\Factories\Models\ModelFactory;

class ModelController extends Controller
{
    protected $factory;

    public function __construct(ModelFactory $factory)
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
            return view('Models/' . $table);
        }
        return abort(404, 'Views not found');
    }
}
