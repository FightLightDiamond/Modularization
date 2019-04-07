<?php
/**
 * Created by PhpStorm.
 * User: e
 * Date: 4/12/17
 * Time: 3:00 PM
 */

namespace Modularization\Core\Factories;

use Modularization\Core\Components\AccessorComponent;
use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\CRUDPath;
use Modularization\Helpers\BuildPath;

class AccessorFactory
{
    protected $component;

    public function __construct(AccessorComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material)
    {
        $fileForm = fopen(BuildPath::outAccessor($table), "w");
        fwrite($fileForm, $material);
    }

    public function building($table)
    {
        $material = $this->component->building($table);
        $this->produce($table, $material);
    }
}