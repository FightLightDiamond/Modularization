<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/23/17
 * Time: 3:32 PM
 */

namespace Modularization\Core\Components;


use Modularization\Facades\DBFa;
use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\CRUDPath;

class CreateFormComponent extends BaseComponent
{
    protected $hidden = ['id'];
    protected $password = ['password'];
    protected $file = ['avatar', 'image'];
    protected $dateTimePicker = ['birthday', 'publish_time'];
    protected $radio = ['sex', 'gender'];

    public function __construct()
    {
        $this->source = file_get_contents(CRUDPath::inCreateForm());
    }

    public function setField($column, $type)
    {
        try {
            return $this->$type($column, $type);
        } catch (\Exception $e) {
            return $this->text($column);
        }
    }

    public function string($column)
    {
        if (in_array($column, $this->file)) {
            $content = file_get_contents($this->getSourceCreate('file'));
        } else {
            $content = file_get_contents($this->getSourceCreate('string'));
        }
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function decimal($column)
    {
        $content = file_get_contents($this->getSourceCreate('text'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }


    public function float($column)
    {
        $content = file_get_contents($this->getSourceCreate('text'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function text($column)
    {
        $content = file_get_contents($this->getSourceCreate('text'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function integer($column)
    {
        $content = file_get_contents($this->getSourceCreate('number'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function bigint($column)
    {
        $content = file_get_contents($this->getSourceCreate('number'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function datetime($column)
    {
        $content = file_get_contents($this->getSourceCreate('datetime'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function date($column)
    {
        $content = file_get_contents($this->getSourceCreate('date'));
        return str_replace(DecoHelper::COLUMN, $column, $content);
    }

    public function boolean($column)
    {
        $content = file_get_contents($this->getSourceCreate('boolean'));
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
        $this->buildRoute($input['route']);
        $this->buildNameSpace($input['namespace']);
        $this->buildExtend();
        $this->buildContent();
        $this->buildFields($input['table']);
        $this->buildTable($input['table']);
        $this->buildView($input['table'], $input['prefix']);
        return $this->source;
    }
}