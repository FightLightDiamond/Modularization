<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/2/2016
 * Time: 9:14 AM
 */

namespace Modularization\Core\Components;


use Modularization\Helpers\CRUDPath;
use Modularization\Helpers\DecoHelper;

class BaseComponent
{
    protected $source;

    public function getSourceUpdate($input)
    {
        return (CRUDPath::viewPath() . '/form/update/' . $input . '.html');
    }

    public function getSourceCreate($input)
    {
        return (CRUDPath::viewPath() . '/form/create/' . $input . '.html');
    }

    public function getSourceIndex()
    {
        return (CRUDPath::viewPath() . '/form/index.html');
    }

    public function getSourceTable()
    {
        return (CRUDPath::viewPath() . '/form/table.html');
    }

    public function replace($string, $data, $source)
    {
        $content = file_get_contents($source);
        return str_replace($string, $data, $content);
    }

    protected function buildTable($table)
    {
        $this->working(DecoHelper::TABLE, $table);
    }

    protected function buildName($table)
    {
        $this->working(DecoHelper::NAME, ucfirst(str_singular($table)));
    }

    protected function buildClassName($table, $tail = '')
    {
        $this->working(DecoHelper::CLASSES, str_singular(ucfirst(camel_case($table))) . $tail);
    }

    protected function buildNameSpace($namespace = 'App')
    {
        $this->working(DecoHelper::namespace, $namespace);
    }

    protected function buildRoute($route)
    {
        $this->working(DecoHelper::ROUTE, $route);
    }

    protected function buildView($table, $prefix)
    {
        $view = $prefix . str_singular(kebab_case(camel_case($table)));
        $this->working(DecoHelper::VIEW, $view);
    }

    protected function buildVariable($table)
    {
        $this->working(DecoHelper::VARIABLE, str_singular(camel_case($table)));
    }

    protected function buildVariables($table)
    {
        $this->working(DecoHelper::VARIABLES, camel_case($table));
    }

    protected function working($changed, $material)
    {
        $this->source = str_replace($changed, $material, $this->source);
    }
}