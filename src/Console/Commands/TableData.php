<?php

namespace Modularization\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TableData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:data {name} {page=0}';

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
        try {
            $data = DB::table($this->argument('name'))
                ->skip($this->argument('page') * 10)
                ->take(10)
                ->orderBy('id', 'DESC')
                //->select($this->argument('select'))
                ->get()->toArray();
            print_r($data);
        } catch (\Exception $e) {
            echo "Tables don't or column exits \n";
        }

    }
}
