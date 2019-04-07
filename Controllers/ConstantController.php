<?php

namespace Modularization\Controllers;

use Modularization\Core\Factories\ConstantFactory;
use Modularization\Helpers\CRUDPath;

/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 4/26/17
 * Time: 3:00 PM
 */
class ConstantController
{
    private $factory;

    public function __construct(ConstantFactory $factory)
    {
        $this->factory = $factory;
    }

    public function produce($database = NULL)
    {
        $this->factory->building($database);
        $this->show($database);
    }

    public function show($database)
    {
        echo $patch = CRUDPath::outConstant($database);
        echo '<pre>';
        echo file_get_contents($patch);
    }
}