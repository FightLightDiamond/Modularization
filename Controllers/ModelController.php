<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/2/2016
 * Time: 9:32 AM
 */

namespace Modularization\Controllers;

use App\Http\Controllers\Controller;
use Modularization\Core\Factories\ModelFactory;
use Modularization\Helpers\BuildPath;
use Illuminate\Support\Facades\View;

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
        echo $patch = BuildPath::outModel($table);
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