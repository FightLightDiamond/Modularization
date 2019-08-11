<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:34 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;

use Modularization\Core\Components\Http\Controllers\CtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Http\Facades\FormatFa;

class CtrlFactory implements _Interface
{
    protected $component;

    public function __construct(CtrlComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    private function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Http/Controllers'))) {
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
        }

        return base_path($path . '/Http/Controllers/' . FormatFa::formatAppName($table) . 'Controller.php');
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }
}