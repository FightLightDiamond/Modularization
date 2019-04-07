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

class RepositoryComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents(BuildPath::inRepository());
    }

    public function building($table, $nameSpace)
    {
        $this->buildNameSpace($nameSpace);
        $this->buildClassName($table);
        $this->buildVariable($table);
        return $this->source;
    }
}