<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 7/23/2018
 * Time: 8:46 PM
 */

namespace Modularization\Core\Factories;


use Modularization\Core\Components\ServiceProviderComponent;

class ServiceProviderFactory
{
    protected $component;
    private $nameSpace, $path, $material;

    public function __construct(ServiceProviderComponent $component)
    {
        $this->component = $component;
    }

    private function produce()
    {
        $fileForm = fopen($this->outFile(), "w");
        fwrite($fileForm, $this->material);
    }

    public function building($nameSpace = 'App', $path = 'app', $prefix = '')
    {
        if (!is_dir(base_path($path))) {
            try {
                mkdir(base_path($path));
            } catch (\Exception $exception) {
                dump($exception->getMessage());
            }
        }
        $this->nameSpace = $nameSpace;
        $this->path = $path;
        if (!file_exists($this->outFile())) {
            $this->material = $this->component->building($nameSpace, $prefix);
            $this->produce();
        }
    }

    private function outFile()
    {
        return base_path($this->path . '/' . $this->nameSpace . 'ServiceProvider.php');
    }
}