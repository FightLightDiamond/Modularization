<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/26/17
 * Time: 3:33 PM
 */

namespace Modularization\Core\Factories;


use Modularization\Core\Components\InterfaceComponent;
use Modularization\Helpers\BuildPath;

class InterfaceFactory implements _Interface
{
    protected $component;

    public function __construct(InterfaceComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Repositories'))) {
            try {
                mkdir(base_path($path . '/Repositories'));
            } catch (\Exception $exception) {
                dump($exception);
            }
        }
        $fileForm = fopen(BuildPath::outInterface($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function building($table, $nameSpace = 'App', $path = 'app')
    {
        $material = $this->component->building($table, $nameSpace);
        $this->produce($table, $material, $path);
    }
}