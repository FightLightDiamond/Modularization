<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:34 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;

use Modularization\Core\Components\Http\Controllers\CtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;
use Modularization\Http\Facades\FormatFa;

class CtrlFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Controllers/API';
    protected $table = 'APIController.php';

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