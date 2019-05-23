<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:35 PM
 */

namespace Modularization\Core\Factories\Polices;

use Modularization\Core\Components\Policies\PolicyComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Facades\FormatFa;

class PolicyFactory implements _Interface
{
    protected $component;

    public function __construct(PolicyComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Policies'))) {
            try {
                mkdir(base_path($path . '/Policies'));
            } catch (\Exception $exception) {
                dump($exception);
            }
        }
        return base_path($path . '/Policies/' . FormatFa::formatAppName($table) . 'Policy.php');
    }

    public function building($table, $nameSpace = 'App', $path = 'app')
    {
        $material = $this->component->building($table, $nameSpace);
        $this->produce($table, $material, $path);
    }
}