<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 4/2/18
 * Time: 11:40 AM
 */

namespace Modularization\Core\Factories;


use Modularization\Core\Components\TranslationComponent;
use Modularization\Helpers\CRUDPath;

class TranslationFactory
{
    private $component;

    public function __construct(TranslationComponent $component)
    {
        $this->component = $component;
    }

    public function produce($database, $material, $path = '')
    {
        $source = fopen(CRUDPath::outTransTable($database), "w");
        fwrite($source, $material);
    }

    public function building($database)
    {
        $material = $this->component->building($database);
        $this->produce($database, $material);
    }
}