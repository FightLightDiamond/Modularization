<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/4/2016
 * Time: 8:19 AM
 */

namespace Cuongpm\Modularization\Core\Components\Models;


use Cuongpm\Modularization\Core\Components\BaseComponent;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Helpers\DecoHelper;

class AccessorComponent extends BaseComponent
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
        $content = file_get_contents($this->getSource());
        $content = str_replace(DecoHelper::COLUMN, studly_case($column), $content);
        return str_replace(DecoHelper::NAME, ($column), $content);
    }

    public function building($table)
    {
        $field = DBFa::getField($table);
        return $this->buildAccessor($field);
    }

    private function getSource()
    {
        return $this->getViewPath('/models/accessor.txt');
    }
}
