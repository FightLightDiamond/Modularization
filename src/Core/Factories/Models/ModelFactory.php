<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:25 AM
 */

namespace Modularization\Core\Factories\Models;

use Modularization\Core\Components\Models\ModelComponent;
use Modularization\Http\Facades\FormatFa;

class ModelFactory
{
    protected $component;

    public function __construct(ModelComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Models'))) {
            mkdir(base_path($path . '/Models'));
        }

        return base_path($path . '/Models/' . FormatFa::formatAppName($table) . '.php');
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $material = $this->component->building($table, $namespace);
        $this->produce($table, $material, $path);
    }
}