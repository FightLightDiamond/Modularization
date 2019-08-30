<?php

namespace Modularization\Console\Commands\Files;

use Illuminate\Console\Command;

class FileRename extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:rename {folder=""} {tail=blade.php}' ;

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
    private $tail;
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
        $this->tail = $this->argument('tail');
        $folder = $this->argument('folder');
        foreach (glob('resources/views/' . $folder . '/*') as $dir) {
            $this->done($dir);
        }
        return;
    }

    function done($dir)
    {
        echo "Filename: " . $dir . "\n";
        if (is_dir($dir)) {
            foreach (glob($dir . '/*') as $file) {
                echo "Filename: " . $file . "\n";
                if (!is_dir($file)) {
                    $this->renames($file);
                } else {
                    $this->done($file);
                }
            }
        } else {
            $this->renames($dir);
        }
    }

    public function renames($file)
    {
        $names = explode('.', $file);
        $newName = $names[0] . '.' . $this->tail;
        rename($file, $newName);
    }

    public function formats($file)
    {
        $names = explode('.', $file);
        $newName = $names[0] . '.' . $this->tail;
        rename($file, $newName);
    }
}
