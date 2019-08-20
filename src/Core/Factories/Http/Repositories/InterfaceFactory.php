<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/26/17
 * Time: 3:33 PM
 */

namespace Modularization\Core\Factories\Http\Repositories;


use Modularization\Core\Components\Http\Repositories\InterfaceComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;

class InterfaceFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Repositories/';
    protected $fileName = 'Repository.php';

    public function __construct(InterfaceComponent $component)
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