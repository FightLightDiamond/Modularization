<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:02 PM
 */

namespace Cuongpm\Modularization\Core\Components\Policies;

use Illuminate\Support\Arr;
use Cuongpm\Modularization\Core\Components\BaseComponent;
use Cuongpm\Modularization\Helpers\DecoHelper;

class PolicyComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    public function buildName($table)
    {
        $this->working(DecoHelper::NAME, Str::singular($table));
    }

    public function building($table, $namespace = 'app')
    {
        $this->buildNameSpace($namespace);
        $this->buildName($table);
        $this->buildClassName($table);
        $this->buildTable($table);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getPolicyPath('/policy.txt');
    }
}
