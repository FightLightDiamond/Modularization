<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 10:44 AM
 */

namespace Modularization\Core\Components\Routers;


use Modularization\Core\Components\BaseComponent;

class RouterAdminComponent extends BaseComponent
{
    public function building($namespace)
    {
        $this->source = file_get_contents( $this->getRouterPath( '/admin.txt'));
        $this->buildNameSpace($namespace);
        return $this->source;
    }
}