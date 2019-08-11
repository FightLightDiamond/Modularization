<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/23/17
 * Time: 3:32 PM
 */

namespace Modularization\Core\Components\Views;


use Modularization\Core\Components\BaseComponent;
use Modularization\Http\Facades\DBFa;
use Modularization\Helpers\DecoHelper;

class UpdateFormComponent extends BaseComponent
{
    protected $hidden = ['id'];
    protected $password = ['password'];
    protected $file = ['avatar', 'image'];
    protected $dateTimePicker = ['birthday', 'publish_time'];
    protected $radio = ['sex', 'gender'];

    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    private function getSource()
    {
        return $this->getViewPath('/form/update.html');
    }

    public function setField($column, $type)
    {
        return $this->$type($column, $type);
    }

    private function getSourceUpdate($input)
    {
        return $this->getViewPath('/form/update/' . $input . '.html');
    }

    public function string($column)
    {
        if (in_array($column, $this->file)) {
            $content = file_get_contents($this->getSourceUpdate('file'));
        } else {
            $content = file_get_contents($this->getSourceUpdate('string'));
        }
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function decimal($column)
    {
        $content = file_get_contents($this->getSourceUpdate('text'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function float($column)
    {
        $content = file_get_contents($this->getSourceUpdate('text'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function text($column)
    {
        $content = file_get_contents($this->getSourceUpdate('text'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function tinyinteger($column)
    {
        $content = file_get_contents($this->getSourceUpdate('number'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function integer($column)
    {
        $content = file_get_contents($this->getSourceUpdate('number'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function bigint($column)
    {
        $content = file_get_contents($this->getSourceUpdate('number'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function datetime($column)
    {
        $content = file_get_contents($this->getSourceUpdate('datetime'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function date($column)
    {
        $content = file_get_contents($this->getSourceUpdate('date'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function boolean($column)
    {
        $content = file_get_contents($this->getSourceUpdate('boolean'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function buildFields($table)
    {
        $packet = '';
        foreach (DBFa::getDataTypes($table) as $column => $type) {
            $packet .= $this->setField($column, $type);
        }
        $this->working(DecoHelper::FIELD, $packet);
    }

    protected function buildExtend()
    {
        $this->working(DecoHelper::EXTENDS, config('modularization.extends'));
    }

    protected function buildContent()
    {
        $this->working(DecoHelper::CONTENT, config('modularization.content'));
    }

    public function building($input)
    {
        $this->buildNameSpace($input['namespace']);
        $this->buildContent();
        $this->buildExtend();
        $this->buildFields($input['table']);
        $this->buildRoute($input['route']);
        $this->buildVariable($input['table']);
        $this->buildTable($input['table']);
        return $this->source;
    }
}