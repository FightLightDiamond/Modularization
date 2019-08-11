<?php

namespace Modularization\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class TableColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:column {table} {name=""}';

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
        $table = $this->argument('table');
        $name = $this->argument('name');
        $columns = Schema::getColumnListing($table);
        if ($name == '""') {
            foreach ($columns as $column) {
                echo $column . "\n";
            }
        } else {
            foreach ($columns as $column) {
                if (strpos($column, $name) !== false) {
                    echo $column . "\n";
                }
            }
        }
    }
}
