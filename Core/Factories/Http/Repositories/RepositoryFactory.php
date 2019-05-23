<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:59 PM
 */

namespace Modularization\Core\Factories\Http\Repositories;

use Modularization\Core\Components\Http\Repositories\RepositoryComponent;
use Modularization\Core\Factories\_Interface;
use Modularization\Facades\FormatFa;

class RepositoryFactory implements _Interface
{
    protected $component;
    private $sortPath = '/Http/Repositories/';

    public function __construct(RepositoryComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Http'))) {
            try {
                mkdir(base_path($path . '/Http'));
            } catch (\Exception $exception) {
                dd($exception);
            }
        }
        if (!is_dir(base_path($path . $this->sortPath))) {
            try {
                mkdir(base_path($path . $this->sortPath));
            } catch (\Exception $exception) {
                dump($exception);
            }
        }
        return base_path($path . $this->sortPath . FormatFa::formatAppName($table) . 'RepositoryEloquent.php');
    }

    public function building($table, $nameSpace = 'App', $path = 'app')
    {
        $material = $this->component->building($table, $nameSpace);
        $this->produce($table, $material, $path);
    }
}