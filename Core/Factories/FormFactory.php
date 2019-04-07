<?php
/**
 * Created by PhpStorm.
 * User: cuongpm00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Modularization\Core\Factories;

use Modularization\Core\Components\CreateFormComponent;
use Modularization\Core\Components\IndexFormComponent;
use Modularization\Core\Components\ShowFormComponent;
use Modularization\Core\Components\TableFormComponent;
use Modularization\Core\Components\UpdateFormComponent;
use Modularization\Helpers\CRUDPath;

/**
 * Class FormFactory
 * Đối tượng form được sản xuất tại đây
 * Nơi sản xuất các thành phần component
 * Các
 * @package Modularization\Core\Factories
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

    private function buildCreate($input)
    {
        $material = $this->creating->building($input);
        $fileForm = fopen(CRUDPath::outCreateForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildTable($input)
    {
        $material = $this->tabling->building($input);
        $fileForm = fopen(CRUDPath::outTableForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildIndex($input)
    {
        $material = $this->indexing->building($input);
        $fileForm = fopen(CRUDPath::outIndexForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildUpdate($input)
    {
        $material = $this->updating->building($input);
        $fileForm = fopen(CRUDPath::outUpdateForm($input['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildShow($input)
    {
        $material = $this->showing->building($input);
        $fileForm = fopen(CRUDPath::outShowForm($input['viewFolder'], $this->path), "w");
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
            mkdir(base_path($path ), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources'), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources/views'),0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources/views/' . $input['viewFolder']),0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        $this->path = $path . '/resources/views';
    }
}