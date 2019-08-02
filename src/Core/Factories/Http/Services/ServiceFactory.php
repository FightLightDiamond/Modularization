<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 4/15/19
 * Time: 1:26 PM
 */

namespace Modularization\Core\Factories\Http\Services;

use Modularization\Core\Components\Http\Services\ServiceComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Facades\FormatFa;
class ServiceFactory implements _Interface
{
    protected $component;
    private $sortPath = '/Http/Services/';

    public function __construct(ServiceComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Http'))) {
            try {
                mkdir(base_path($path . '/Http'));
            } catch (\Exception $exception) {
                dd($exception);
            }
        }
        if (!is_dir(base_path($path . $this->sortPath))) {
            try {
                mkdir(base_path($path . $this->sortPath));
            } catch (\Exception $exception) {
                dd($exception);
            }
        }
        return base_path($path . $this->sortPath . FormatFa::formatAppName($table) . 'Service.php');
    }
}