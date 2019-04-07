<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Modularization\Core\Factories;


use Modularization\Core\Components\ApiCtrlComponent;
use Modularization\Helpers\BuildPath;

class ApiCtrlFactory implements _Interface
{
    protected $component;

    public function __construct(ApiCtrlComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        try {
            mkdir(base_path($path . '/Http'));
        } catch (\Exception $exception) {
            dump($exception);
        }
        try {
            mkdir(base_path($path . '/Http/Controllers'));
        } catch (\Exception $exception) {
            dump($exception);
        }
        try {
            mkdir(base_path($path . '/Http/Controllers/Api'));
        } catch (\Exception $exception) {
            dump($exception);
        }
        $pathOut = BuildPath::outControllerApi($table, $path);
        $fileForm = fopen($pathOut, "w");
        fwrite($fileForm, $material);
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }
}
