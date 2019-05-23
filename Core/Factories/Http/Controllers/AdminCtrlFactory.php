<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 2:25 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;

use Modularization\Core\Components\Http\Controllers\AdminCtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Facades\FormatFa;

class AdminCtrlFactory implements _Interface
{
    protected $component;

    public function __construct(AdminCtrlComponent $component)
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
            mkdir(base_path($path . '/Http/Controllers/Admin'));
        } catch (\Exception $exception) {
            dump($exception);
        }

        return base_path($path . '/Http/Controllers/Admin/' . FormatFa::formatAppName($table) . 'Controller.php');
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }
}