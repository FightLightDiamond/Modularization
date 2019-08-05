<?php

namespace Modularization\Facades;

/**
 * Created by PhpStorm.
 * User: cuong
 * Date: 10/13/16
 * Time: 9:47 PM
 */
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DBFun
{
    protected $db, $tables;
    protected $exceptFillable = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $exceptField = ['password', 'remember_token', 'creator', 'updater', 'code', 'user_id'];

    public function getColumn($table)
    {
        return Schema::getColumnListing($table);
    }

    public function table($dbName = NULL)
    {
        if ($dbName == NULL) {
            $dbName = config('database.connections.mysql.database');
        }
        $dbTables = DB::select('SHOW TABLES');
        $database = 'Tables_in_' . $dbName;
        foreach ($dbTables as $table) {
            $this->tables[] = $table->$database;
        }
        return $this->tables;
    }

    public function seed($dbName = NULL)
    {
        ini_set('memory_limit', '-1');
        $tableExcept = [ROLES_TB, ROLE_USER_TB, ROLE_PERMISSION_TB, ROLES_TB, 'user_id', PROBE_LOGS_TB];
        if ($dbName == NULL) {
            $dbName = env('DB_DATABASE');
        }
        $dbTables = DB::select('SHOW TABLES');
        $database = 'Tables_in_' . $dbName;
        foreach ($dbTables as $table) {
            $table = $table->$database;
            if (!in_array($table, $tableExcept)) {
                $data = [];
                $tables = Schema::getColumnListing($table);
                foreach ($tables as $column) {
                    $dataType = Schema::getColumnType($table, $column);
                    if ($column !== ID_COL && $column !== CREATED_AT_COL && $column !== UPDATED_AT_COL
                        && $dataType !== 'datetime' && $dataType !== 'date' && $dataType !== 'time') {
                        $data[$column] = rand(1, 99);
                    }
                }
                try {
                    DB::table($table)->insert($data);
                } catch (\Exception $exception) {
                    print_r($exception->getMessage() . '<br>');
                }
            }
        }
        echo 'Success';
    }

    public function seedTables($tables)
    {
        is_array($tables) ?: $tables = [$tables];
        foreach ($tables as $table) {
            $data = [];
            foreach (Schema::getColumnListing($table) as $column) {
                $dataType = Schema::getColumnType($table, $column);
                if ($column !== ID_COL && $column !== CREATED_AT_COL && $column !== UPDATED_AT_COL
                    && $dataType !== 'datetime' && $dataType !== 'date' && $dataType !== 'time') {
                    $data[$column] = rand(1, 9);
                }
            }
            DB::table($table)->insert($data);
        }
    }

    public function getColumnSort($tables)
    {
        $columns = [];
        foreach ($tables as $table) {
            $columns = array_merge($columns, $this->getColumn($table));
        }
        $columns = array_unique($columns);
        sort($columns);
        return $columns;
    }

    public function getFillable($table)
    {
        return array_diff($this->getColumn($table), $this->exceptFillable);
    }

    public function getField($table)
    {
        return array_diff($this->getFillable($table), $this->exceptField);
    }

    public function getDataTypes($table)
    {
        $dataTypes = [];
        foreach ($this->getField($table) as $column) {
            $dataTypes[$column] = Schema::getColumnType($table, $column);
        }
        return ($dataTypes);
    }

    public function produceFillable($table)
    {
        return "['" . implode("', '", $this->getFillable($table)) . "']";
    }

    public function buildFillable($fillable)
    {
        return "['" . implode("', '", $fillable) . "']";
    }
}
