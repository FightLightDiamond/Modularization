<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 7/23/2018
 * Time: 8:47 PM
 */

namespace Modularization\Core\Components;

use Modularization\Helpers\CRUDPath;

class ServiceProviderComponent  extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents( CRUDPath::viewPath() . '/mvc/ServiceProvider.php');
    }

    protected function buildPrefix($prefix)
    {
        $this->working('_prefix_', "'$prefix'");
    }

    public function building($nameSpace, $prefix = '')
    {
        dump($prefix);
        $this->buildNameSpace($nameSpace);
        $this->buildPrefix($prefix);
        return $this->source;
    }
}