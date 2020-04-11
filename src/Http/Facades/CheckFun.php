<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 1/12/18
 * Time: 2:35 PM
 */

namespace Cuongpm\Modularization\Http\Facades;


class CheckFun
{
    function html($string)
    {
        $start = strpos($string, '<');
        $end = strrpos($string, '>', $start);
        $len = strlen($string);
        if ($end !== false) {
            $string = str($string, $start);
        } else {
            $string = str($string, $start, $len - $start);
        }
        libxml_use_internal_errors(true);
        libxml_clear_errors();
        simplexml_load_string($string);
        return count(libxml_get_errors()) == 0;
    }
}
