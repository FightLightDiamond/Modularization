<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 7/23/2018
 * Time: 8:47 PM
 */

namespace Modularization\Core\Components;


class ServiceProviderComponent  extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents( $this->getServiceProviderPath( '/ServiceProvider.txt'));
    }

    protected function buildPrefix($prefix)
    {
        $this->working('_prefix_', "'$prefix'");
    }

    public function building($namespace, $prefix = '')
    {
        $this->buildNameSpace($namespace);
        $this->buildPrefix($prefix);
        return $this->source;
    }
}