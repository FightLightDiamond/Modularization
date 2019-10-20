<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 * Time: 1:12 PM
 */

namespace Modularization\Core\Components\Http\Services;

use Modularization\Core\Components\BaseComponent;

class ServiceComponent extends BaseComponent
{
    public function building($input, $auth = 'API')
    {
        $materialPath = $this->inService($auth);
        $this->source = file_get_contents($materialPath);

        $this->buildNameSpace($input['namespace']);
        $this->buildClassName($input['table']);
        $this->buildTable($input['table']);
        $this->buildVariable($input['table']);
        $this->buildView($input['table'], $input['prefix']);
        $this->buildVariables($input['table']);
        $this->buildRoute($input['route']);

        return $this->source;
    }

    public function inService($auth)
    {
        return $this->getServicePath("/{$auth}/service.txt");
    }
}