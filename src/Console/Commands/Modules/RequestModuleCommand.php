<?php

namespace Cuongpm\Modularization\Console\Commands\Modules;

use Illuminate\Console\Command;
use Cuongpm\Modularization\Core\Factories\Http\Repositories\InterfaceFactory;
use Cuongpm\Modularization\Core\Factories\Http\Requests\RequestFactory;
use Cuongpm\Modularization\Http\Facades\DBFa;

class RequestModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:request {table?} {--namespace=App\}  {--path=app/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $requestFactory;
    protected $interfaceFactory;

    public function __construct(InterfaceFactory $interfaceFactory, RequestFactory $requestFactory)
    {
        parent::__construct();

        $this->interfaceFactory = $interfaceFactory;
        $this->requestFactory = $requestFactory;
    }

    public function handle()
    {
        $table = $this->argument('table') ?? '*';
        $namespace = $this->option('namespace') . "\\";
        $path = $this->option('path');

        if($table === '*') {
            $tables = DBFa::table($dbName = NULL);
        } else {
            $tables = [$table];
        }

        foreach ($tables as $table) {
            $this->interfaceFactory->building($table, $namespace, $path);
            $this->requestFactory->building($table, $namespace, $path);
        }
    }
}
