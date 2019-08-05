<?php
/**
 * Created by PhpStorm.
 * Date: 8/3/19
 * Time: 3:26 PM
 */

namespace Modularization\src\Core\Factories\Tests\Feature;


use Modularization\Facades\FormatFa;
use Modularization\src\Core\Components\Tests\Feature\FeatureTestComponent;

class FeatureTestFactory
{
    protected $component;

    public function __construct(FeatureTestComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        $fileForm = fopen($this->getSource(camel_case($table), $path), "w");
        fwrite($fileForm, $material);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Tests'))) {
            mkdir(base_path($path . '/Tests'));
        }

        if (!is_dir(base_path($path . '/Tests/Feature'))) {
            mkdir(base_path($path . '/Tests/Feature'));
        }

        return base_path($path . '/Tests/Feature/' . FormatFa::formatAppName($table) . 'Test.php');
    }

    public function building($input)
    {
        $table = $input['table'];
        $path = $input['path'];

        $material = $this->component->building($input);
        $this->produce($table, $material, $path);
    }
}