<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 10:44 AM
 */

namespace Modularization\Core\Components\Routers;


use Modularization\Core\Components\BaseComponent;

class RouterAdminComponent extends BaseComponent
{
    public function building($nameSpace)
    {
        $this->source = file_get_contents( $this->getRouterPath( '/admin.txt'));
        $this->buildNameSpace($nameSpace);
        return $this->source;
    }
}