<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 4/30/17
 * Time: 12:56 AM
 */

namespace Modularization\Core\Factories;


use Modularization\Core\Components\ObserverComponent;
use Modularization\Helpers\CRUDPath;

class ObserverFactory implements _Interface
{
    private $component;

    public function __construct(ObserverComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Observers'))) {
            mkdir(base_path($path . '\Observers'));
        }
        $fileForm = fopen(CRUDPath::outObServer($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function building($table, $nameSpace = 'App', $path = 'app')
    {
        $material = $this->component->building($table, $nameSpace);
        $this->produce($table, $material, $path);
    }
}