<?php
/**
 * Created by cuongpm/modularization.
 * Date: 8/3/19
 * Time: 12:25 PM
 */

namespace Cuongpm\Modularization\src\Core\Components\Tests\Feature;


use Cuongpm\Modularization\Core\Components\BaseComponent;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Helpers\DecoHelper;
use Cuongpm\Modularization\Http\Facades\FormatFa;

class FeatureTestComponent extends BaseComponent
{
    private function getSource($auth)
    {
        return $this->getTestPatch("/Feature/{$auth}/Test.txt");
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
        if (!$namespace) {
            $namespace = "App\\";
        }

        $class = $this->class;

        $this->model = FormatFa::mixUri([
            "", $namespace, 'Models', $class
        ], '\\');

        $this->working(DecoHelper::MODEL, $this->model);
    }

    public function building($input, $auth = 'API')
    {
        $this->source = file_get_contents($this->getSource($auth));

        $table = $input['table'];
        $namespace = $input['namespace'];
        $route = $input['route'];

        if ($namespace === 'App\\') {
            $this->buildNameSpace('');
        } else {
            $this->buildNameSpace($namespace);
        }

        $this->buildClassName($table);
        $this->buildTableName($table);
        $this->buildRoute($route);
        $this->buildParams($table);
        $this->buildModel($namespace);

        return $this->source;
    }
}
