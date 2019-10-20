<?php

namespace Modularization\Console\Commands;

use Illuminate\Console\Command;

class RenderRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'render:route {controller=""}';

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
        $controller = ucfirst($this->argument('controller'));
        $except =
            [
                '__construct',
                'middleware',
                'getMiddleware',
                'callAction',
                'missingMethod',
                '__call',
                'authorize',
                'authorizeForUser',
                'authorizeResource',
                'dispatchNow',
                'validateWith',
                'validate',
                'validateWithBag',
            ];

        $this->render($controller, $except);
    }

    private function render($controller, $except)
    {
        $class_methods = get_class_methods(app("\App\Http\Controllers\\" . $controller . 'Controller'));
        $content = "<?php \n";
        $prefix = str_replace("\\-", '/', kebab_case($controller));
        $content .= "Route::group(['prefix'=> '" .$prefix. "'], function () {\n";
        $routeName = str_replace('/', ".", $prefix);
        $fileName = str_replace('/', "-", $prefix);

        foreach ($class_methods as $method_name) {
            if (!in_array($method_name, $except)) {
                $content .= "   Route::get('" . kebab_case($method_name) . "', '" . $controller . "Controller@" . $method_name . "')->name('" . $routeName . "." . $method_name . "');\n";
            }
        }

        echo $content .= "});";
        $myfile = fopen(base_path('routes/' . $fileName . '.php'), "w");
        fwrite($myfile, $content);
    }
}
