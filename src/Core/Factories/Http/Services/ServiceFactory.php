<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 * Time: 1:26 PM
 */

namespace Modularization\Core\Factories\Http\Services;

use Modularization\Core\Components\Http\Services\ServiceComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Core\Factories\BaseFactory;
use Modularization\Http\Facades\FormatFa;
class ServiceFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Services/API/';

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
        $material = $this->component->building($input, $this->auth);
        $this->produce($input['table'], $material, $input['path']);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Http/Services'))) {
            try {
                mkdir(base_path($path . '/Http/Services'));
            } catch (\Exception $exception) {
                logger($path . '/Http/Services');
            }
        }

        $this->makeFolder($path);

        return base_path($path . $this->sortPath . FormatFa::formatAppName($table) . 'Service.php');
    }
}