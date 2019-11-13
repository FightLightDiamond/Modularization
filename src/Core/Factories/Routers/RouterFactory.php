<?php
/**
 * Created by cuongpm/modularization.
 * User: CPM
 * Date: 7/23/2018
 * Time: 9:02 PM
 */

namespace Modularization\Core\Factories\Routers;

use Modularization\Core\Components\RouterComponent;

class RouterFactory
{
    protected $component;
    private $namespace, $path, $material;

    public function __construct(RouterComponent $component)
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
        return base_path("{$this->path}/routers/web.php");
    }
}
