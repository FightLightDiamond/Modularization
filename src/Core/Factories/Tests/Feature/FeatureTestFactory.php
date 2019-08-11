<?php
/**
 * Created by cuongpm/modularization.
 * Date: 8/3/19
 * Time: 3:26 PM
 */

namespace Modularization\src\Core\Factories\Tests\Feature;


use Modularization\Core\Factories\BaseFactory;
use Modularization\Http\Facades\FormatFa;
use Modularization\src\Core\Components\Tests\Feature\FeatureTestComponent;

class FeatureTestFactory extends BaseFactory
{
    protected $component;

    public function __construct(FeatureTestComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function getSource($table, $path)
    {
        if($path !== "tests/Feature/")
        {
            if (!is_dir(base_path($path . '/Tests'))) {
                mkdir(base_path($path . '/Tests'));
            }

            if (!is_dir(base_path($path . '/Tests/Feature/'))) {
                mkdir(base_path($path . '/Tests/Feature/'));
            }

            $path .= '/Tests/Feature/';
        }

        $this->makeFolder($path);

        return base_path($path . FormatFa::formatAppName($table) . 'Test.php');
    }

    public function building($input)
    {
        $table = $input['table'];
        $path = $input['path'];

        $material = $this->component->building($input);
        $this->produce($table, $material, $path);
    }
}