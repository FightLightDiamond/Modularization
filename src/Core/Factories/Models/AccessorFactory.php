<?php
/**
 * Created by cuongpm/modularization.
 * User: e
 * Date: 4/12/17
 * Time: 3:00 PM
 */

namespace Modularization\Core\Factories\Models;

use Modularization\Core\Components\Models\AccessorComponent;
use Modularization\Http\Facades\FormatFa;

class AccessorFactory
{
    protected $component;

    public function __construct(AccessorComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material)
    {
        $fileForm = fopen($this->getSource($table), "w");
        fwrite($fileForm, $material);
    }

    static function getSource($table, $path = 'app')
    {
        return base_path($path . '/Models/' . FormatFa::formatAppName($table) . 'Accessor.php');
    }

    public function building($table)
    {
        $material = $this->component->building($table);
        $this->produce($table, $material);
    }
}