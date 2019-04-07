<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/18/18
 * Time: 2:32 PM
 */

namespace Modularization\MultiInheritance;


trait ScopeTrait
{
    public function rangeFilter($query, $input, $range = ['from', 'to'], $field = 'created_at')
    {
        $field = "{$this->table}.{$field}";
        if (isset($input[$range[0]])) {
            $query->where($field, '>=', $input[$range[0]]);
        }
        if (isset($input[$range[1]])) {
            $query->where($field, '<=', $input[$range[1]]);
        }
    }
}