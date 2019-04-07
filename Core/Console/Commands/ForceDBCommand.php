<?php
/**
 * Created by PhpStorm.
 * User: thinking
 * Date: 8/20/17
 * Time: 11:25 AM
 */

namespace Modularization\Core\Console\Commands;

use Modularization\Core\Factories\CtrlFactory;
use Modularization\Core\Factories\FormFactory;
use Modularization\Core\Factories\InterfaceFactory;
use Modularization\Core\Factories\ModelFactory;
use Modularization\Core\Factories\PolicyFactory;
use Modularization\Core\Factories\RepositoryFactory;
use Modularization\Core\Factories\RequestFactory;
use Illuminate\Console\Command;

class ForceDBCommand extends Command
{

    protected $signature = 'render:template {table="users"}';
    protected $formFactory, $ctrlFactory, $interfaceFactory, $repositoryFactory, $modelFactory,
        $requestFactory, $requestUFactory, $policyFactory;

    public function __construct(FormFactory $formFactory,
                                CtrlFactory $ctrlFactory,
                                InterfaceFactory $interfaceFactory,
                                RepositoryFactory $repositoryFactory,
                                ModelFactory $modelFactory,
                                RequestFactory $requestFactory,
                                RequestFactory $requestUFactory,
                                PolicyFactory $policyFactory)
    {
        parent::__construct();
        $this->formFactory = $formFactory;
        $this->ctrlFactory = $ctrlFactory;
        $this->interfaceFactory = $interfaceFactory;
        $this->repositoryFactory = $repositoryFactory;
        $this->modelFactory = $modelFactory;
        $this->requestFactory = $requestFactory;
        $this->requestUFactory = $requestUFactory;
        $this->policyFactory = $policyFactory;
    }

    public function handle()
    {
        $table = $this->argument('table');

        $this->buildAll($table);

    }

    private function buildAll($table)
    {
        $this->formFactory->building($table);
        $this->ctrlFactory->building($table);
        $this->interfaceFactory->building($table);
        $this->repositoryFactory->building($table);
        $this->modelFactory->building($table);
        $this->requestFactory->building(str_singular($table) . 'Create');
        $this->requestUFactory->building(str_singular($table) . 'Update');
        $this->policyFactory->building($table);
    }
}