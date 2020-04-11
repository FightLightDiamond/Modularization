<?php

namespace Cuongpm\Modularization\Console\Commands\Modules;

use Illuminate\Console\Command;
use Cuongpm\Modularization\Core\Factories\Models\ModelFactory;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\src\Helpers\BuildInput;

class ModelModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:model {table?} {--namespace=App\}  {--path=app/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $modelFactory;

    public function __construct(ModelFactory $modelFactory)
    {
        parent::__construct();

        $this->modelFactory = $modelFactory;
    }

    public function handle()
    {
        $table = $this->argument('table') ?? '*';
        $namespace = $this->option('namespace') ."\\";
        $path = $this->option('path');

        if($table === '*') {
            $tables = DBFa::table($dbName = NULL);
        } else {
            $tables = [$table];
        }

        foreach ($tables as $table) {
            $this->modelFactory->building($table, $namespace, $path);
        }
    }
}
