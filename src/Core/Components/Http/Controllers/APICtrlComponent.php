<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/25/18
 * Time: 5:55 PM
 */

namespace Modularization\Core\Components\Http\Controllers;


use Modularization\Core\Components\BaseComponent;

class APICtrlComponent extends  BaseComponent
{
    public function building($input)
    {
        $inPath = $this->getSource();
        $this->source = file_get_contents($inPath);

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
        return $this->getCtrlPath('/API/APICtrlController.txt');
    }
}