<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 4/2/18
 * Time: 11:40 AM
 */

namespace Modularization\Core\Components\Views;

use Modularization\Core\Components\BaseComponent;
use Modularization\Http\Facades\DBFa;
use Modularization\Helpers\DecoHelper;

class TranslationComponent extends BaseComponent
{


    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    private function getSource()
    {
        return $this->getViewPath( '/trans/table.txt');
    }

    public function build($data, $decorator)
    {
        $str = "";
        foreach ($data as $key => $value) {
            $str .= '  \'' . $value . '\' => \'' . title_case(str_replace('_', ' ', str_before($value, '_id'))) . '\'' . ",\n";
        }
        $this->working($decorator, trim($str));
    }

    public function building($database)
    {
        $tables = DBFa::table($database);
        $this->build($tables, DecoHelper::TABLE);
        $columns = DBFa::getColumnSort($tables);
        $this->build($columns, DecoHelper::COLUMN);
        return $this->source;
    }
}