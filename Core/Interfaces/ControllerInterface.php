<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/4/2016
 * Time: 4:55 PM
 */

namespace Modularization\Interfaces;


interface ControllerInterface
{
    public function produce($table = 'users');
}