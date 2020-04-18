<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Cuongpm\Modularization\Core\Factories\Views;

use Cuongpm\Modularization\Core\Components\Views\CreateFormComponent;
use Cuongpm\Modularization\Core\Components\Views\IndexFormComponent;
use Cuongpm\Modularization\Core\Components\Views\ShowFormComponent;
use Cuongpm\Modularization\Core\Components\Views\TableFormComponent;
use Cuongpm\Modularization\Core\Components\Views\UpdateFormComponent;

/**
 * Class FormFactory
 * Đối tượng form được sản xuất tại đây
 * Nơi sản xuất các thành phần component
 * Các
 * @package Cuongpm\Modularization\Core\Factories
 */
class FormFactory
{
    protected $component, $packet;

    private $creating, $updating, $showing, $indexing, $tabling;

    public function __construct(
        CreateFormComponent $creating,
        UpdateFormComponent $updating,
        ShowFormComponent $showing,
        TableFormComponent $tabling,
        IndexFormComponent $indexing
    )
    {
        $this->creating = $creating;
        $this->updating = $updating;
        $this->showing = $showing;
        $this->tabling = $tabling;
        $this->indexing = $indexing;
    }

    private $path = 'app';


    private function getSourceCreateForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/create.blade.php');
    }

    private function outTableForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/table.blade.php');
    }

    static function outIndexForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/index.blade.php');
    }


    static function outUpdateForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/update.blade.php');
    }

    static function outShowForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/show.blade.php');
    }

    private function buildCreate($input)
    {
        $material = $this->creating->building($input);
        $fileForm = fopen($this->getSourceCreateForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildTable($input)
    {
        $material = $this->tabling->building($input);
        $fileForm = fopen($this->outTableForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildIndex($input)
    {
        $material = $this->indexing->building($input);
        $fileForm = fopen($this->outIndexForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildUpdate($input)
    {
        $material = $this->updating->building($input);
        $fileForm = fopen($this->outUpdateForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildShow($input)
    {
        $material = $this->showing->building($input);
        $fileForm = fopen($this->outShowForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    public function building($input)
    {
        $this->checkPath($input);
        $this->buildCreate($input);
        $this->buildShow($input);
        $this->buildUpdate($input);
        $this->buildTable($input);
        $this->buildIndex($input);
    }

    private function checkPath($input)
    {
        $path = $input['path'];
        try {
            mkdir(base_path($path), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage(), 500) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources'), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage(), 500) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources/views'), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage(), 500) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources/views/' . $input['viewFolder']), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage(), 500) . '</br>';
        }
        $this->path = $path . '/resources/views';
    }
}
