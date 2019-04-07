<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:02 PM
 */

namespace Modularization\Core\Components;


use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\BuildPath;

class PolicyComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents(BuildPath::inPolicy());
    }

    public function buildName($table)
    {
        $this->working(DecoHelper::NAME, str_singular($table));
    }

    public function building($table, $nameSpace = 'app')
    {
        $this->buildNameSpace($nameSpace);
        $this->buildName($table);
        $this->buildClassName($table);
        $this->buildTable($table);
        return $this->source;
    }
}