<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 2:23 PM
 */

namespace Modularization\Core\Components\Http\Controllers;


use Modularization\Core\Components\BaseComponent;

class AdminCtrlComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
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

    private function getSource()
    {
        return $this->getCtrlPath( '/Admin/controller.txt');
    }
}