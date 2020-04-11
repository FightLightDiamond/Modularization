<?php

namespace Cuongpm\Modularization\Http\Controllers;

use Cuongpm\Modularization\Core\Factories\Constants\ConstantFactory;

/**
 * Created by cuongpm/modularization.
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
        echo $patch = $this->outConstant($database);
        echo '<pre>';
        echo file_get_contents($patch);
    }


    public function outConstant($table)
    {
        return base_path('Constants/' . $table . 'db.php');
    }

}
