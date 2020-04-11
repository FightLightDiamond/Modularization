<?php

namespace Cuongpm\Modularization\Console\Commands\Tables;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TableName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:name {name=""}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tables = DB::select('SHOW TABLES');

        $database = 'Tables_in_' . env('DB_DATABASE');
        $filter = $this->argument('name');

        if ($filter == '""') {
            foreach ($tables as $table) {
                echo $table->$database . "\n";
            }
        } else {
            foreach ($tables as $table) {
                $tableName = $table->$database;
                if (strpos($tableName, $filter) !== false) {
                    echo $tableName . "\n";
                }
            }
        }
    }
}
