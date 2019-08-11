<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 1/31/18
 * Time: 9:17 AM
 */

namespace Modularization\Console\Commands;


use Illuminate\Console\Command;
use Modularization\Core\Factories\Constants\ConstantFactory;

class ConstDBCommand extends Command
{
    protected $signature = 'render:const';
    private $factory;

    public function __construct(ConstantFactory $factory)
    {
        parent::__construct();
        $this->factory = $factory;
    }

    public function handle()
    {
        $this->factory->building(NULL);
    }
}