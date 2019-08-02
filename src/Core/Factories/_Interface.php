<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/4/2016
 * Time: 8:23 AM
 */

namespace Modularization\Core\Factories;


interface _Interface
{
    public function produce($table, $material, $path);

    public function building($input);
}