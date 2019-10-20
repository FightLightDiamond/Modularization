<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/30/17
 * Time: 12:57 AM
 */

namespace Modularization\Core\Components\Observers;


use Modularization\Core\Components\BaseComponent;
use Modularization\Helpers\DecoHelper;

class ObserverComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
        $this->buildNameSpace();
    }

    private function buildDependency($table)
    {
        $table = str_singular($table);
        $variable = '$' . $table;
        $model = ucfirst($table);
        $dependency = $model . ' ' . $variable;
        $this->working(DecoHelper::DEPENDENCY, $dependency);
    }

    public function building($table, $namespace = 'app')
    {
        $this->buildClassName($table);
        $this->buildDependency($table);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getObserverPath('/observer.txt');
    }
}