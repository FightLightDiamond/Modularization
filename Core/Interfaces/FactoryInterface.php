<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/4/2016
 * Time: 4:55 PM
 */

namespace Modularization\Interfaces;

interface FactoryInterface
{
    public function produce($table, $material);

    public function building($table);
}