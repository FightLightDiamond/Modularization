<?php
/**
 * Created by PhpStorm.
 * Date: 8/3/19
 * Time: 12:25 PM
 */

namespace Modularization\src\Core\Components\Tests\Feature;


use Modularization\Core\Components\BaseComponent;
use Modularization\Http\Facades\DBFa;
use Modularization\Helpers\DecoHelper;

class FeatureTestComponent extends BaseComponent
{
    private function getSource()
    {
        return $this->getTestPatch('/Feature/Test.txt');
    }

    private function buildTableName($table)
    {
        $this->working(DecoHelper::TABLE, $table);
    }

    private function buildParams($table)
    {
        $fields = DBFa::getFillable($table);
        $params = '[ ';

        foreach ($fields as $field) {
            $params .= "'$field' => rand(1, 9), ";
        }

        $params .= ' ]';

        $this->working(DecoHelper::PARAMS, $params);
    }

    protected $model;

    protected function buildModel($namespace)
    {
        if(!$namespace) {
            $namespace = "App\\";
        }

        $class = $this->class;
        $this->model = "\\{$namespace}Models\\$class";
        $this->working(DecoHelper::MODEL, $this->model);
    }

    public function building($input)
    {
        $this->source = file_get_contents($this->getSource());

        $table = $input['table'];
        $namespace = $input['namespace'];
        $route = $input['route'];

        $this->buildNameSpace($namespace);

        $this->buildClassName($table);
        $this->buildTableName($table);
        $this->buildRoute($route);
        $this->buildParams($table);
        $this->buildModel($namespace);

        return $this->source;
    }
}