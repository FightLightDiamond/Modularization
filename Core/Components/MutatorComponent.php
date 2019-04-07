<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/2/2016
 * Time: 9:13 AM
 */

namespace Modularization\Core\Components;


use Modularization\Facades\DBFa;
use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\CRUDPath;
use Modularization\Helpers\BuildPath;

class MutatorComponent extends BaseComponent
{
    protected $mutator;

    public function buildMutator($field)
    {
        foreach ($field as $column) {
            $this->mutator .= $this->mutator($column);
        }
        return $this->mutator;
    }

    private function mutator($column)
    {
        $content = file_get_contents(BuildPath::inMutator());
        $content = str_replace(DecoHelper::COLUMN, studly_case($column), $content);
        return str_replace(DecoHelper::NAME, ($column), $content);
    }

    public function building($table, $nameSpace = 'App')
    {
        $field = DBFa::getField($table);
        return $this->buildMutator($field);
    }
}