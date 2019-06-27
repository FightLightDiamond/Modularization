<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;


use Modularization\Core\Components\Http\Controllers\ApiCtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Facades\FormatFa;

class ApiCtrlFactory implements _Interface
{
    protected $component;

    public function __construct(ApiCtrlComponent $component)
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
            dump($exception->getMessage());
        }
        try {
            mkdir(base_path($path . '/Http/Controllers'));
        } catch (\Exception $exception) {
            dump($exception->getMessage());
        }
        try {
            mkdir(base_path($path . '/Http/Controllers/API'));
        } catch (\Exception $exception) {
            dump($exception->getMessage());
        }

        return base_path($path . '/Http/Controllers/API/' . FormatFa::formatAppName($table) . 'ApiController.php');
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }
}
