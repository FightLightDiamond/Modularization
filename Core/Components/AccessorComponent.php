<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/4/2016
 * Time: 8:19 AM
 */

namespace Modularization\Core\Components;


use Modularization\Facades\DBFa;
use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\BuildPath;

class AccessorComponent
{
    protected $accessor;

    public function buildAccessor($field)
    {
        foreach ($field as $column) {
            $this->accessor .= $this->accessor($column);
        }
        return $this->accessor;
    }

    private function accessor($column)
    {
        $content = file_get_contents(BuildPath::inAccessor());
        $content = str_replace(DecoHelper::COLUMN, studly_case($column), $content);
        return str_replace(DecoHelper::NAME, ($column), $content);
    }

    public function building($table)
    {
        $field = DBFa::getField($table);
        return $this->buildAccessor($field);
    }
}