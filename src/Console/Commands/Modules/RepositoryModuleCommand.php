<?php

namespace Modularization\Console\Commands\Modules;

use Illuminate\Console\Command;
use Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Modularization\Http\Facades\DBFa;

class RepositoryModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:repository {table?} {--namespace=App\}  {--path=app/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $repositoryFactory;

    public function __construct(RepositoryFactory $repositoryFactory)
    {
        parent::__construct();

        $this->repositoryFactory = $repositoryFactory;
    }

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

        $input = compact('table', 'namespace', 'path');

        foreach ($tables as $table) {
            $input['table'] = $table;
            $this->repositoryFactory->building($input);
        }
    }
}
