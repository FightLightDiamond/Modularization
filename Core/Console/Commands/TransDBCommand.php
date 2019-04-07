<?php

namespace Modularization\Core\Console\Commands;

use Illuminate\Console\Command;
use Modularization\Core\Factories\TranslationFactory;

class TransDBCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'render:trans';
    private $factory;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(TranslationFactory $factory)
    {
        parent::__construct();
        $this->factory = $factory;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->factory->building(NULL);
    }
}
