<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/23/17
 * Time: 3:33 PM
 */

namespace Modularization\Core\Components\Views;


use Modularization\Core\Components\BaseComponent;
use Modularization\Helpers\DecoHelper;

class IndexFormComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    private function getSource()
    {
        return ($this->getViewPath('/form/index.html'));
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

        $this->buildVariable($input['table']);
        $this->buildVariables($input['table']);

        return $this->source;
    }
}