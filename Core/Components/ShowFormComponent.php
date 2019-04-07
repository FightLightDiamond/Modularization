<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/23/17
 * Time: 3:33 PM
 */

namespace Modularization\Core\Components;

use Modularization\Facades\DBFa;
use Modularization\Helpers\CRUDPath;
use Modularization\Helpers\DecoHelper;

class ShowFormComponent extends BaseComponent
{
    protected $hidden = ['id'];
    protected $password = ['password'];
    protected $file = ['avatar', 'image'];
    protected $dateTimePicker = ['birthday', 'publish_time'];
    protected $radio = ['sex', 'gender'];

    public function __construct()
    {
        $this->source = file_get_contents(CRUDPath::inShowForm());
    }

    public function buildFields($table)
    {
        $packet = '';
        foreach (DBFa::getDataTypes($table) as $column => $type) {
            $packet .= '<tr>';
            $packet .= "<th>{{__('label.{$column}')}}</th>\n";
            $variable = '$' . str_singular($table);
            $packet .= "<td>{!! $variable->$column !!}</td>\n";
            $packet .='</tr>';
        }
        $this->working(DecoHelper::SHOW, $packet);
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
        $this->buildExtend();
        $this->buildContent();
        $this->buildFields($input['table']);
        $this->buildRoute($input['route']);
        $this->buildFields($input['table']);
        $this->buildVariable($input['table']);
        $this->buildVariables($input['table']);
        $this->buildName($input['table']);
        $this->buildTable($input['table']);
        return $this->source;
    }
}