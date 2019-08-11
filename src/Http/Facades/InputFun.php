<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 8/23/2016
 * Time: 4:08 PM
 */

namespace Modularization\Http\Facades;


class InputFun
{
    public function normalization($request)
    {
        return $this->loopNormalization($request->all());
    }

    public function loopNormalization($input)
    {
        foreach ($input as $k => $v) {
            if (is_string($v)) {
                $input[$k] = trim($v);
                if ($input[$k] === '') {
                    unset($input[$k]);
                }
            } elseif (is_array($v)) {
                $input[$k] = $this->loopNormalization($v);
            }
        }
        return $input;
    }

    public function runInput($input)
    {
        foreach ($input as $key => $val) {
            $this->{$key}($val);
        }
    }
}