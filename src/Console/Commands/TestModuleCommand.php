<?php

namespace Modularization\Console\Commands;

use Illuminate\Console\Command;
use Modularization\Http\Facades\DBFa;
use Modularization\src\Core\Factories\Tests\Feature\FeatureTestFactory;
use Modularization\src\Helpers\BuildInput;

class TestResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:test {table} {--namespace="App"}  {--path="app"}';

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
        $namespace = $this->option('namespace');
        $path = $this->option('path');

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
                'route' => BuildInput::route($table)
            ];

            $this->featureTestFactory->building($input);
        }
    }
}
