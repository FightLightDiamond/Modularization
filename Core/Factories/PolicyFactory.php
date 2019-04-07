<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:35 PM
 */

namespace Modularization\Core\Factories;

use Dompdf\Exception;
use Modularization\Core\Components\PolicyComponent;
use Modularization\Helpers\BuildPath;

class PolicyFactory implements _Interface
{
    protected $component;

    public function __construct(PolicyComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Policies'))) {
            try {
                mkdir(base_path($path . '/Policies'));
            } catch (Exception $exception) {
                dump($exception);
            }

        }
        $fileForm = fopen(BuildPath::outPolicy($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function building($table, $nameSpace = 'App', $path = 'app')
    {
        $material = $this->component->building($table, $nameSpace = 'App');
        $this->produce($table, $material, $path = 'app');
    }
}