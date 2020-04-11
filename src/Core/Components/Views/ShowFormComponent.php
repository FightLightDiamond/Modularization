<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/23/17
 * Time: 3:33 PM
 */

namespace Cuongpm\Modularization\Core\Components\Views;

use Illuminate\Support\Arr;
use Cuongpm\Modularization\Core\Components\BaseComponent;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Helpers\DecoHelper;

class ShowFormComponent extends BaseComponent
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
        return $this->getViewPath('/form/show.html');
    }

    public function buildFields($table)
    {
        $packet = '';
        foreach (DBFa::getDataTypes($table) as $column => $type) {
            $packet .= '<tr>';
            $packet .= "<th>{{__('label.{$column}')}}</th>\n";
            $variable = '$' . Str::singular($table);
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
