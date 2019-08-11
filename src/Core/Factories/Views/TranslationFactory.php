<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 4/2/18
 * Time: 11:40 AM
 */

namespace Modularization\Core\Factories\Views;

use Modularization\Core\Components\Views\TranslationComponent;

class TranslationFactory
{
    private $component;

    public function __construct(TranslationComponent $component)
    {
        $this->component = $component;
    }

    private function outTransTable()
    {
        return base_path('/Constants/table.php');
    }

    public function produce($database, $material, $path = '')
    {
        $source = fopen($this->outTransTable($database), "w");
        fwrite($source, $material);
    }

    public function building($database)
    {
        $material = $this->component->building($database);
        $this->produce($database, $material);
    }
}