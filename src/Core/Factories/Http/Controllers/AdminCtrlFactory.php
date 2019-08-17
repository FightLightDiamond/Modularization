<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 2:25 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;

use Modularization\Core\Components\Http\Controllers\AdminCtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;

class AdminCtrlFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Controllers/Admin';
    protected $table = 'AdminController.php';

    public function __construct(AdminCtrlComponent $component)
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