<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:35 PM
 */

namespace Modularization\Core\Factories\Polices;

use Modularization\Core\Components\Policies\PolicyComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;
use Modularization\Http\Facades\FormatFa;

class PolicyFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Policies/';
    protected $table = 'Policy.php';

    public function __construct(PolicyComponent $component)
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