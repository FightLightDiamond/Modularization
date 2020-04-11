<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/26/17
 * Time: 3:16 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Constants;

use Cuongpm\Modularization\Core\Components\Constants\ConstantComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;

class ConstantFactory implements _Interface
{
    private $component;

    public function __construct(ConstantComponent $component)
    {
        $this->component = $component;
    }

    public function produce($database, $material, $path = '')
    {
        $source = fopen($this->outConstant($database), "w");
        fwrite($source, $material);
    }

    public function building($database)
    {
        $material = $this->component->building($database);
        $this->produce($database, $material);
    }


    static function outConstant($table)
    {
        return base_path('Constants/' . $table . 'db.php');
    }
}
