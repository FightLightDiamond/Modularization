<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/2/2016
 * Time: 9:14 AM
 */

namespace Modularization\Core\Components;


use Modularization\Helpers\DecoHelper;

class BaseComponent
{
    protected $source;

    public function getViewPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/resources') . $path;
    }

    public function getCtrlPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Http/Controllers') . $path;
    }

    public function getRequestPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Http/Requests') . $path;
    }

    public function getViewComposerPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Http/ViewComposers') . $path;
    }

    public function getServicePath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Http/Services') . $path;
    }

    public function getRepositoryPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Http/Repositories') . $path;
    }

    public function getModelPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Models') . $path;
    }

    public function getTestPatch($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Tests') . $path;
    }

    public function getConstPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/const') . $path;
    }

    public function getObserverPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Observers') . $path;
    }

    public function getPolicyPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Policies') . $path;
    }

    public function getServiceProviderPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/') . $path;
    }

    public function getRouterPath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/routes') . $path;
    }

    public function getResourcePath($path) {
        return dirname(dirname(dirname(__DIR__))) . ('/decorators/Http/Resources') . $path;
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

    protected $class;

    protected function buildClassName($table, $tail = '')
    {
        $this->class = str_singular(ucfirst(camel_case($table)));
        $this->working(DecoHelper::CLASSES,  $this->class . $tail);
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