<?php

namespace Cuongpm\Modularization\Console\Commands\Modules;

use Illuminate\Console\Command;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Core\Factories\Tests\Feature\FeatureTestFactory;
use Cuongpm\Modularization\Helpers\BuildInput;

class TestModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:test {table?} {--namespace=}  {--path=} {--auth=API}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $featureTestFactory;

    public function __construct(FeatureTestFactory $featureTestFactory)
    {
        parent::__construct();

        $this->featureTestFactory = $featureTestFactory;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = $this->argument('table') ?? '*';
        $namespace = $this->option('namespace') . "\\";
        $path = $this->option('path');
        $auth = $this->option('auth');

        if($table === '*') {
            $tables = DBFa::table($dbName = NULL);
        } else {
            $tables = [$table];
        }

        foreach ($tables as $table) {
            $input = [
                'table' => $table,
                'namespace' => $namespace,
                'path' => $path,
                'route' => BuildInput::route($table),
            ];

            $this->featureTestFactory->setAuth($auth)->building($input);
        }
    }
}
