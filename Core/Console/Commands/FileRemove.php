<?php

namespace Modularization\Core\Console\Commands;

use Illuminate\Console\Command;

class FileRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:remove';

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
        foreach(glob('resources/views/*') as $dir)
        {
            if (is_dir($dir))
            {
                foreach(glob($dir.'/*') as $file)
                {
                    echo "Filename: " . $file . "\n";
                    if(strpos($file.'', 'show.blade')!== false || strpos($file.'', 'show_fields.blade') !== false)
                    {
                        unlink($file.'');
                    }
                }
            }
        }
    }
}
