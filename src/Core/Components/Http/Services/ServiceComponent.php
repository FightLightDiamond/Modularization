<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 4/15/19
 * Time: 1:12 PM
 */

namespace Modularization\Core\Components\Http\Services;

use Modularization\Core\Components\BaseComponent;

class ServiceComponent extends BaseComponent
{

    public function __construct()
    {
        $this->source = file_get_contents($this->inService());
    }

    public function building($input)
    {
        $this->buildNameSpace($input['namespace']);
        $this->buildClassName($input['table']);
        $this->buildTable($input['table']);
        $this->buildVariable($input['table']);
        $this->buildView($input['table'], $input['prefix']);
        $this->buildVariables($input['table']);
        $this->buildRoute($input['route']);
        return $this->source;
    }

    public function inService()
    {
        return ($this->getServicePath('/service.txt'));
    }
}