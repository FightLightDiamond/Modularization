<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:59 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Http\Requests;


use Cuongpm\Modularization\Core\Components\Http\Requests\RequestComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;
use Cuongpm\Modularization\Core\Factories\BaseFactory;
use Cuongpm\Modularization\Http\Facades\FormatFa;
use Cuongpm\Modularization\src\Helpers\BuildInput;

class RequestFactory extends BaseFactory implements _Interface
{
    protected $componentCreate, $componentUpdate;
    protected $auth = 'API';
    protected $sortPath = '/Http/Requests/';
    protected $fileName = 'Request.php';

    public function __construct(RequestComponent $componentCreate, RequestComponent $componentUpdate )
    {
        $this->componentCreate = $componentCreate;
        $this->componentUpdate = $componentUpdate;
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $class = BuildInput::classe($table);

        $material = $this->componentCreate->building($table,'Create', $namespace, $this->auth);
        $this->table = $class . 'Create';
        $this->produce($material, $path);

        $material = $this->componentUpdate->building($table,'Update', $namespace, $this->auth);
        $this->table = $class . 'Update';
        $this->produce($material, $path);
    }
}
