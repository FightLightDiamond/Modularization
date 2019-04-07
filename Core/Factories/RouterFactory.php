<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 7/23/2018
 * Time: 9:02 PM
 */

namespace Modularization\Core\Factories;

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
        $fileForm = fopen($this->outFile(), "w");
        fwrite($fileForm, $this->material);
    }

    public function building($nameSpace = 'App', $path = 'app')
    {
        $this->nameSpace = $nameSpace;
        $this->path = $path;
        if (!file_exists($this->outFile())) {
            $this->material = $this->component->building($nameSpace);
            $this->produce();
        }
    }

    private function outFile()
    {
        return base_path("{$this->path}/router.php");
    }
}