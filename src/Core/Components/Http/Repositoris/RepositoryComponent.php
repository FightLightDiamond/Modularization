<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:02 PM
 */

namespace Modularization\Core\Components\Http\Repositories;


use Modularization\Core\Components\BaseComponent;

class RepositoryComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    public function building($table, $namespace)
    {
        $this->buildNameSpace($namespace);
        $this->buildClassName($table);
        $this->buildVariable($table);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getRepositoryPath('/repository.txt');
    }
}