<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/4/2016
 * Time: 4:49 PM
 */

namespace Modularization\Controllers;

use App\Http\Controllers\Controller;
use Modularization\Core\Factories\AccessorFactory;
use Modularization\Helpers\BuildPath;
use Illuminate\Support\Facades\View;

class AccessorController extends Controller
{
    protected $factory;

    public function __construct(AccessorFactory $factory)
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
        echo BuildPath::outAccessor($table);
        echo '<pre>';
        echo file_get_contents(BuildPath::outAccessor($table));
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view('models.accessor-' . $table);
        }
        return abort(404, 'Views not found');
    }
}