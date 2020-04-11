<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:34 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Http\Controllers;

use Cuongpm\Modularization\Core\Components\Http\Controllers\CtrlComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;
use Cuongpm\Modularization\Core\Factories\BaseFactory;
use Cuongpm\Modularization\Http\Facades\FormatFa;

class CtrlFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Controllers/API';
    protected $fileName = 'APIController.php';

    public function __construct(CtrlComponent $component)
    {
        $this->component = $component;
    }

    public function building($input)
    {
        $this->table = $input['table'];
        $material = $this->component->building($input);
        $this->produce($material, $input['path']);
    }
}
