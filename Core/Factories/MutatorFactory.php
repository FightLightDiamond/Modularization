<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Modularization\Core\Factories;

use Modularization\Core\Components\MutatorComponent;
use Modularization\Helpers\BuildPath;

class MutatorFactory implements _Interface
{
    protected $component, $packet;

    public function __construct(MutatorComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Models'))) {
            mkdir(base_path($path . '\Models'));
        }
        $fileForm = fopen(BuildPath::outMutator($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function building($table, $nameSpace = 'App', $path = 'app')
    {
        $material = $this->component->building($table, $nameSpace);
        $this->produce($table, $material);
    }
}