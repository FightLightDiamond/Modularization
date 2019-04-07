<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/25/18
 * Time: 5:55 PM
 */

namespace Modularization\Core\Components;


use Modularization\Helpers\BuildPath;

class ApiCtrlComponent extends  BaseComponent
{
    public function __construct()
    {
        $inPath = BuildPath::inControllerApi();
        $this->source = file_get_contents($inPath);
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
}