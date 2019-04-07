<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:03 PM
 */

namespace Modularization\Core\Components;

use Modularization\Facades\DBFa;
use Modularization\Helpers\DecoHelper;
use Modularization\Helpers\BuildPath;

class RequestComponent extends BaseComponent
{
    private $fields;

    public function __construct()
    {
//        $this->source = file_get_contents(BuildPath::inRequest());
    }

    public function buildRule($table)
    {
        $this->fields = DBFa::getFillable($table);
        $rules = '';
        foreach ($this->fields as $field) {
            $rules .= "'{$field}' => 'required',\n";
        }
        $this->working(DecoHelper::RULE, $rules);
    }

    public function buildMessage($table)
    {
        $this->working(DecoHelper::MESSAGE, '');
    }

    public function building($table, $action, $nameSpace = 'App')
    {
        $this->source = file_get_contents(BuildPath::inRequest());
        $this->buildNameSpace($nameSpace);
        $this->buildRule($table);
        $this->buildMessage($table);
        $this->buildClassName($table . $action);
        return $this->source;
    }
}