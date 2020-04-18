<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:35 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Polices;

use Cuongpm\Modularization\Core\Components\Policies\PolicyComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;
use Cuongpm\Modularization\Core\Factories\BaseFactory;
use Cuongpm\Modularization\Http\Facades\FormatFa;

class PolicyFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Policies/';
    protected $fileName = 'Policy.php';

    public function __construct(PolicyComponent $component)
    {
        $this->component = $component;
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $this->table = $table;
        $material = $this->component->building($table, $namespace);
        $this->produce($material, $path, false);
    }
}
