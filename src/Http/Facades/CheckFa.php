<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 1/12/18
 * Time: 2:35 PM
 */

namespace Modularization\Http\Facades;


use Illuminate\Support\Facades\Facade;

class CheckFa extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'CheckFa';
    }
}