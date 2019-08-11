<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:59 PM
 */

namespace Modularization\Core\Factories\Http\Requests;


use Modularization\Core\Components\Http\Requests\RequestComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Http\Facades\FormatFa;

class RequestFactory implements _Interface
{
    protected $componentCreate, $componentUpdate;

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

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Http/Requests'))) {
            mkdir(base_path($path . '/Http/Requests'));
        }
        return base_path($path . '/Http/Requests/' . FormatFa::formatAppName($table) . 'Request.php');
    }

    public function building($table, $namespace = 'App', $path = 'app')
    {
        $material = $this->componentCreate->building($table, 'Create', $namespace);
        $class = str_singular($table);
        $this->produce($class . 'Create', $material, $path);
        $material = $this->componentUpdate->building($table, 'Update', $namespace);
        $this->produce($class . 'Update', $material, $path);
    }
}