<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:59 PM
 */

namespace Modularization\Core\Factories;

use Modularization\Core\Components\RepositoryComponent;
use Modularization\Helpers\BuildPath;

class RepositoryFactory implements _Interface
{
    protected $component;

    public function __construct(RepositoryComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Repositories'))) {
            try {
                mkdir(base_path($path . '/Repositories'));
            } catch (\Exception $exception) {
                dump($exception);
            }

        }
        $fileForm = fopen(BuildPath::outRepository($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function building($table, $nameSpace = 'App', $path = 'app')
    {
        $material = $this->component->building($table, $nameSpace);
        $this->produce($table, $material, $path);
    }
}