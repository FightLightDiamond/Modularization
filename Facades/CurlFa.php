<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 4/28/17
 * Time: 6:01 PM
 */

namespace Modularization\Facades;

use Illuminate\Support\Facades\Facade;

class CurlFa extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'CurlFa';
    }
}