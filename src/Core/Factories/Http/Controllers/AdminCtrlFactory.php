<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 2:25 PM
 */

namespace Modularization\Core\Factories\Http\Controllers;

use Modularization\Core\Components\Http\Controllers\AdminCtrlComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Http\Facades\FormatFa;

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
            logger($exception->getMessage());
        }
        try {
            mkdir(base_path($path . '/Http/Controllers'));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
        }
        try {
            mkdir(base_path($path . '/Http/Controllers/Admin'));
        } catch (\Exception $exception) {
            logger($exception->getMessage());
        }

        return base_path($path . '/Http/Controllers/Admin/' . FormatFa::formatAppName($table) . 'Controller.php');
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }
}