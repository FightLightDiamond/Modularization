<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Modularization\Core\Factories\Http\Resources;


use Modularization\Core\Components\Http\Resources\ResourceComponent;
use Modularization\Core\Factories\BaseFactory;
use Modularization\Http\Facades\FormatFa;

class ResourceFactory extends BaseFactory
{
    protected $component;
    protected $sortPath = '/Http/Resources/API/';

    public function __construct(ResourceComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        $pathOut = $this->getSource($table, $path);
        $fileForm = fopen($pathOut, "w");
        fwrite($fileForm, $material);
    }

    private function getSource($table, $path = 'app')
    {
        try {
            mkdir(base_path($path . '/Http'));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
        }

        try {
            mkdir(base_path($path . '/Http/Resources'));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
        }

        $this->makeFolder($path);

        return base_path($path . $this->sortPath . FormatFa::formatAppName($table) . 'Resource.php');
    }

    public function building($input)
    {
        $material = $this->component->building($input, $this->auth);
        $this->produce($input['table'], $material, $input['path']);
    }
}