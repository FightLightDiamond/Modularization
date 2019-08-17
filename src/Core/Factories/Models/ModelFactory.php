<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:25 AM
 */

namespace Modularization\Core\Factories\Models;

use Modularization\Core\Components\Models\ModelComponent;
use Modularization\Core\Factories\BaseFactory;
use Modularization\Http\Facades\FormatFa;

class ModelFactory extends BaseFactory
{
    protected $component;
    protected $sortPath = 'Models/';
    protected $fileName = '.php';

    public function __construct(ModelComponent $component)
    {
        $this->component = $component;
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $this->table = $table;
        $material = $this->component->building($table, $namespace);
        $this->produce($material, $path);
    }
}