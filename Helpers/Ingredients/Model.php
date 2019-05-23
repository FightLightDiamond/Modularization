<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 4/26/17
 * Time: 8:33 AM
 */

namespace Modularization\Ingredients;

use Modularization\Helpers\DecoHelper;

class Model
{
    const CONSTANT = 'const ' . DecoHelper::CONST_NAME . ' = ' . DecoHelper::CONST_VALUE . ';';
}