<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:59 PM
 */

namespace Modularization\Core\Factories\Http\Requests;


use Modularization\Core\Components\Http\Requests\RequestComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;
use Modularization\Http\Facades\FormatFa;
use Modularization\src\Helpers\BuildInput;

class RequestFactory extends BaseFactory implements _Interface
{
    protected $componentCreate, $componentUpdate;
    protected $sortPath = '/Http/Requests/API/';

    public function __construct(RequestComponent $componentCreate, RequestComponent $componentUpdate )
    {
        $this->componentCreate = $componentCreate;
        $this->componentUpdate = $componentUpdate;
    }

    public function produce($table, $material, $path = 'app')
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    protected function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Http/Requests'))) {
            mkdir(base_path($path . '/Http/Requests'));
        }

        $this->makeFolder($path);

        return base_path($path . $this->sortPath . FormatFa::formatAppName($table) . 'Request.php');
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $material = $this->componentCreate->building($table, 'Create', $namespace, $this->auth);
        $class = BuildInput::classe($table);
        $this->produce($class . 'Create', $material, $path);
        $material = $this->componentUpdate->building($table, 'Update', $namespace, $this->auth);
        $this->produce($class . 'Update', $material, $path);
    }
}