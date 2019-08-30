<?php

namespace Modularization\Console\Commands\Files;

use Illuminate\Console\Command;

class FileChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'file:change {folder=""} {type=0}';

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

    private $repeats = [
        '"{{asset(\'\')}}/' => "\"{{asset('')}}",
        '"css' => "\"{{asset('')}}/css",
        '"img' => "\"{{asset('')}}/img",
        '"js' => "\"{{asset('')}}/js",
    ];

    private function geLayouts()
    {
        return [
            resource_path('views/change/sidebar.blade.php') => "@include('neon.layouts.sidebar')"
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $folder = $this->argument('folder');
        $type = $this->argument('folder');
        if ($type == 1) {
            foreach (glob($folder . '/*') as $dir) {
                $this->doing($dir);
            }
        } else if ($type == 2) {
            foreach (glob($folder . '/*') as $dir) {
                $this->going($dir);
            }
        } else {
            foreach (glob($folder . '/*') as $dir) {
                $this->doing($dir);
                $this->going($dir);
            }
        }
    }

    function doing($dir)
    {
        echo "Filename: " . $dir . "\n";
        if (is_dir($dir)) {
            foreach (glob($dir . '/*') as $file) {
                echo "Filename: " . $file . "\n";
                if (!is_dir($file)) {
                    $this->change($file);
                } else {
                    $this->doing($file);
                }
            }
        } else {
            $this->change($dir);
        }
    }

    function change($file)
    {
        $content = file_get_contents($file);
        foreach ($this->repeats as $search => $repeat) {
            $content = str_replace($search, $repeat, $content);
        }
        $fileForm = fopen($file, "w");
        fwrite($fileForm, $content);
    }

    function going($dir)
    {
        echo "Filename: " . $dir . "\n";
        if (is_dir($dir)) {
            foreach (glob($dir . '/*') as $file) {
                echo "Filename: " . $file . "\n";
                if (!is_dir($file)) {
                    $this->repeat($file);
                } else {
                    $this->going($file);
                }
            }
        } else {
            $this->repeat($dir);
        }
    }

    public function repeat($file)
    {
        $content = file_get_contents($file);
        foreach ($this->geLayouts() as $layout => $replace) {
            $decorator = file_get_contents($layout);
            $content = str_replace($decorator, $replace, $content);
        }
        $fileForm = fopen($file, "w");
        fwrite($fileForm, $content);
    }
}
