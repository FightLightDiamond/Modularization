<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 7/23/2018
 * Time: 9:02 PM
 */

namespace Modularization\Core\Factories\Routers;

use Modularization\Core\Components\RouterComponent;

class RouterFactory
{
    protected $component;
    private $nameSpace, $path, $material;

    public function __construct(RouterComponent $component)
    {
        $this->component = $component;
    }

    public function produce()
    {
        $fileForm = fopen($this->getSource(), "w");
        fwrite($fileForm, $this->material);
    }

    public function building($nameSpace = 'App', $path = 'app')
    {
        $this->nameSpace = $nameSpace;
        $this->path = $path;
        if (!file_exists($this->getSource())) {
            $this->material = $this->component->building($nameSpace);
            $this->produce();
        }
    }

    private function getSource()
    {
        if (!is_dir(base_path("{$this->path}/routers"))) {
            try {
                mkdir(base_path("{$this->path}/routers"));
            } catch (\Exception $exception) {
                dump($exception);
            }
        }
        return base_path("{$this->path}/routers/web.php");
    }
}