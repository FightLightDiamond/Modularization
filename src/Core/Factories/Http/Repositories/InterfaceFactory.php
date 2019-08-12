<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/26/17
 * Time: 3:33 PM
 */

namespace Modularization\Core\Factories\Http\Repositories;


use Modularization\Core\Components\Http\Repositories\InterfaceComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Http\Facades\FormatFa;

class InterfaceFactory implements _Interface
{
    protected $component;
    private $sortPath = '/Http/Repositories/';

    public function __construct(InterfaceComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }


    private function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Http/Repositories'))) {
            try {
                mkdir(base_path($path . '/Http/Repositories'));
            } catch (\Exception $exception) {
                logger($exception->getMessage());
            }
        }

        if (!is_dir(base_path($path . $this->sortPath))) {
            try {
                mkdir(base_path($path . $this->sortPath));
            } catch (\Exception $exception) {
                logger($exception->getMessage());
            }
        }

        return base_path($path . $this->sortPath . FormatFa::formatAppName($table) . 'Repository.php');
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $material = $this->component->building($table, $namespace);
        $this->produce($table, $material, $path);
    }
}