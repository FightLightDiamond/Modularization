<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:34 PM
 */

namespace Modularization\Core\Factories;


use Modularization\Core\Components\CtrlComponent;
use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\BuildPath;

class CtrlFactory implements _Interface
{
    protected $component;

    public function __construct(CtrlComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path)
    {
        if (!is_dir(base_path($path . '/Http/Controllers'))) {
            try {
                mkdir(base_path($path . '/Http'));
            } catch (\Exception $exception) {
                dump($exception);
            }
            try {
                mkdir(base_path($path . '/Http/Controllers'));
            } catch (\Exception $exception) {
                dump($exception);
            }
        }
        $fileForm = fopen(BuildPath::outController($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function building($input)
    {
        $material = $this->component->building($input);
        $this->produce($input['table'], $material, $input['path']);
    }
}