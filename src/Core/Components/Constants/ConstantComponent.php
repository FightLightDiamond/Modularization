<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/26/17
 * Time: 3:17 PM
 */

namespace Cuongpm\Modularization\Core\Components\Constants;

use Cuongpm\Modularization\Core\Components\BaseComponent;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Helpers\DecoHelper;

class ConstantComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    public function getSource()
    {
        return $this->getConstPath('/DBConst.txt');
    }

    public function getAllColumn($tables)
    {
        $columns = [];
        foreach ($tables as $table) {
            $columns = array_merge($columns, DBFa::getColumn($table));
        }
        $columns = array_unique($columns);
        sort($columns);
        return $columns;
    }

    public function buildColumn($columns)
    {
        $constants = '';
        $upper_columns = array_map('strtoupper', $columns);

        foreach ($columns as $key => $column) {
            $constants .= '  const ' . $upper_columns[$key] . '_COL = \'' . $column . '\'' . ";\n";
        }

        $this->working(DecoHelper::COLUMN, $constants);
    }

    public function buildTable($tables)
    {
        $constants = '';
        $upper = array_map('strtoupper', $tables);

        foreach ($tables as $key => $table) {
            $constants .= '  const ' . $upper[$key] . '_TB = \'' . $table . '\'' . ";\n";
        }

        $this->working(DecoHelper::TABLE, $constants);
    }

    public function building($database)
    {
        $tables = DBFa::table($database);
        $columns = $this->getAllColumn($tables);
        $this->buildTable($tables);
        $this->buildColumn($columns);

        return $this->source;
    }
}
