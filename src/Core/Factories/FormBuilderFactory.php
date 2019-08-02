<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 4/18/17
 * Time: 3:52 PM
 */

namespace Modularization\Core\Factories;

use Modularization\Core\Components\FormBuilderComponent;
use Modularization\Interfaces\FactoryInterface;

class FormBuilderFactory implements FactoryInterface
{
    private $component;

    public function __construct(FormBuilderComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material)
    {
        $fileForm = fopen($this->getSource($table), "w");
        fwrite($fileForm, $material);
    }

    private function getSource($table, $path = 'app')
    {
        return base_path('tsc/form/' . $table . '.ts');
    }

    public function building($table)
    {
        $material = $this->component->building($table);
        $this->produce($table, $material);
    }
}