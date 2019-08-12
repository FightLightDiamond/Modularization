<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;


use Modularization\Core\Components\Http\Controllers\APICtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Http\Facades\FormatFa;

class APICtrlFactory implements _Interface
{
    protected $component;

    public function __construct(APICtrlComponent $component)
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
            logger(base_path($path . '/Http/Controllers'));
        }

        try {
            mkdir(base_path($path . '/Http/Controllers'));
        } catch (\Exception $exception) {
            logger(base_path($path . '/Http/Controllers'));
        }

        try {
            mkdir(base_path($path . '/Http/Controllers/API'));
        } catch (\Exception $exception) {
            logger(base_path($path . '/Http/Controllers/API'));
        }

        return base_path($path . '/Http/Controllers/API/' . FormatFa::formatAppName($table) . 'APIController.php');
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }
}
