<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:14 AM
 */

namespace Cuongpm\Modularization\Core\Components;

use Illuminate\Support\Str;
use Cuongpm\Modularization\Helpers\DecoHelper;

class BaseComponent
{
    protected $source;

    private function getPath()
    {
        return dirname(dirname(dirname(__DIR__))) . ('/resources/materials/');
    }

    public function getViewPath($path) {
        return $this->getPath() . 'resources' . $path;
    }

    public function getCtrlPath($path) {
        return $this->getPath() . ('Http/Controllers') . $path;
    }

    public function getRequestPath($path) {
        return $this->getPath() . ('Http/Requests') . $path;
    }

    public function getViewComposerPath($path) {
        return $this->getPath() . ('Http/ViewComposers') . $path;
    }

    public function getServicePath($path) {
        return $this->getPath() . ('Http/Services') . $path;
    }

    public function getRepositoryPath($path) {
        return $this->getPath() . ('Http/Repositories') . $path;
    }

    public function getModelPath($path) {
        return $this->getPath() . ('Models') . $path;
    }

    public function getTestPatch($path) {
        return $this->getPath() . ('Tests') . $path;
    }

    public function getConstPath($path) {
        return $this->getPath() . ('const') . $path;
    }

    public function getObserverPath($path) {
        return $this->getPath() . ('Observers') . $path;
    }

    public function getPolicyPath($path) {
        return $this->getPath() . ('Policies') . $path;
    }

    public function getServiceProviderPath($path) {
        return $this->getPath() . $path;
    }

    public function getRouterPath($path) {
        return $this->getPath() . ('routes') . $path;
    }

    public function getResourcePath($path) {
        return $this->getPath() . ('Http/Resources') . $path;
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
        $this->working(DecoHelper::NAME, Str::ucfirst(Str::singular($table)));
    }

    protected $class;

    protected function buildClassName($table, $tail = '')
    {
        $this->class = Str::singular(Str::ucfirst(Str::camel($table)));
        $this->working(DecoHelper::CLASSES,  $this->class . $tail);
    }

    protected function buildNameSpace($namespace = 'App\\')
    {
        $this->working(DecoHelper::namespace, $namespace);
    }

    protected function buildRoute($route)
    {
        $this->working(DecoHelper::ROUTE, $route);
    }

    protected function buildView($table, $prefix)
    {
        $view = $prefix . Str::singular(Str::kebab(Str::camel($table)));
        $this->working(DecoHelper::VIEW, $view);
    }

    protected function buildVariable($table)
    {
        $this->working(DecoHelper::VARIABLE, Str::singular(Str::camel($table)));
    }

    protected function buildVariables($table)
    {
        $this->working(DecoHelper::VARIABLES, Str::camel($table));
    }

    protected function working($changed, $material)
    {
        $this->source = str_replace($changed, $material, $this->source);
    }
}
