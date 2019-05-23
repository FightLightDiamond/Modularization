<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/25/18
 * Time: 5:55 PM
 */

namespace Modularization\Core\Components\Http\Resources;


use Modularization\Core\Components\BaseComponent;

class ResourceComponent extends BaseComponent
{
    public function __construct()
    {
        $inPath = $this->getSource();
        $this->source = file_get_contents($inPath);
    }

    public function building($input)
    {
        $this->buildNameSpace($input['namespace']);
        $this->buildClassName($input['table']);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getResourcePath('/Resource.txt');
    }
}