<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:03 PM
 */

namespace Modularization\Core\Components\Http\Requests;

use Modularization\Core\Components\BaseComponent;
use Modularization\Facades\DBFa;
use Modularization\Helpers\DecoHelper;

class RequestComponent extends BaseComponent
{
    private $fields;

    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
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

    public function buildMessage()
    {
        $this->working(DecoHelper::MESSAGE, '');
    }

    public function building($table, $action, $nameSpace = 'App')
    {
        $this->buildNameSpace($nameSpace);
        $this->buildRule($table);
        $this->buildMessage();
        $this->buildClassName(str_singular($table) . $action);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getRequestPath( '/request.txt');
    }
}