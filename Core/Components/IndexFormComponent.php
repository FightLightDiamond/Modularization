<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/23/17
 * Time: 3:33 PM
 */

namespace Modularization\Core\Components;


use Modularization\Helpers\DecoHelper;

class IndexFormComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSourceIndex());
    }

    protected function buildVar($table)
    {
        $this->working(DecoHelper::VARIABLE, str_singular(camel_case($table)));
    }

    protected function buildVars($table)
    {
        $this->working(DecoHelper::VARIABLES, (camel_case($table)));
    }

    protected function buildExtend()
    {
        $this->working(DecoHelper::EXTENDS, config('modularization.extends'));
    }

    protected function buildContent()
    {
        $this->working(DecoHelper::CONTENT, config('modularization.content'));
    }

    public function building($input)
    {
        $this->buildNameSpace($input['namespace']);
        $this->buildContent();
        $this->buildExtend();
        $this->buildTable($input['table']);
        $this->buildRoute($input['route']);
        $this->buildView($input['table'], $input['prefix']);
        $this->buildVar($input['table']);
        $this->buildVars($input['table']);
        return $this->source;
    }
}