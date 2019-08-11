<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 10:54 AM
 */

namespace Modularization\Core\Factories\Routers;


use Modularization\Core\Components\Routers\RouterAPIComponent;

class RouteAPIFactory
{
    protected $component;
    private $namespace, $path, $material;

    public function __construct(RouterAPIComponent $component)
    {
        $this->component = $component;
    }

    public function produce()
    {
        $fileForm = fopen($this->getSource(), "w");
        fwrite($fileForm, $this->material);
    }

    public function building($namespace = 'App', $path = 'app')
    {
        $this->nameSpace = $namespace;
        $this->path = $path;
        if (!file_exists($this->getSource())) {
            $this->material = $this->component->building($namespace);
            $this->produce();
        }
    }

    private function getSource()
    {
        if (!is_dir(base_path("{$this->path}/routers"))) {
            try {
                mkdir(base_path("{$this->path}/routers"));
            } catch (\Exception $exception) {
                dump($exception->getMessage());
            }
        }
        return base_path("{$this->path}/routers/api.php");
    }
}