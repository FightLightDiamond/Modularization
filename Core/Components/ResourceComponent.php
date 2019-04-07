<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/25/18
 * Time: 5:55 PM
 */

namespace Modularization\Core\Components;


use Modularization\Helpers\BuildPath;

class ResourceComponent extends BaseComponent
{
    public function __construct()
    {
        $inPath = BuildPath::inResource();
        $this->source = file_get_contents($inPath);
    }

    public function building($input)
    {
        $this->buildNameSpace($input['namespace']);
        $this->buildClassName($input['table']);
        return $this->source;
    }
}