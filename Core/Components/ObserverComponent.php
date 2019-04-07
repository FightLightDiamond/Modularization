<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 4/30/17
 * Time: 12:57 AM
 */

namespace Modularization\Core\Components;


use Modularization\Facades\DBFa;
use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\CRUDPath;

class ObserverComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents(CRUDPath::inObserver());
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

    public function building($table)
    {
        $this->buildClassName($table);
        $this->buildDependency($table);
        return $this->source;
    }
}