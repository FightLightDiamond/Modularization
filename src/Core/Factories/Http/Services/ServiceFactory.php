<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 * Time: 1:26 PM
 */

namespace Modularization\Core\Factories\Http\Services;

use Modularization\Core\Components\Http\Services\ServiceComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;

class ServiceFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $auth = 'API';
    protected $sortPath = 'Http/Services';
    protected $fileName = 'Service.php';

    public function __construct(ServiceComponent $component)
    {
        $this->component = $component;
    }

    public function building($input)
    {
        $this->table = $input['table'];
        $material = $this->component->building($input, $this->auth);
        $this->produce($material, $input['path']);
    }
}