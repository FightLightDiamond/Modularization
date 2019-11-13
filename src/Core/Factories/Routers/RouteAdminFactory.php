<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 10:54 AM
 */

namespace Modularization\Core\Factories\Routers;


use Modularization\Core\Components\Routers\RouterAdminComponent;

class RouteAdminFactory
{
    protected $component;
    private $namespace, $path, $material;

    public function __construct(RouterAdminComponent $component)
    {
        $this->component = $component;
    }

    public function produce()
    {
        $fileForm = fopen($this->getSource(), "w");
        fwrite($fileForm, $this->material);
    }

    public function building($namespace = 'App\\', $path = 'app')
    {
        $this->namespace = $namespace;
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
                logger($exception);
            }
        }
        return base_path("{$this->path}/routers/admin.php");
    }
}
