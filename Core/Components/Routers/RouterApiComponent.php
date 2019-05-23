<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/8/19
 * Time: 10:43 AM
 */

namespace Modularization\Core\Components\Routers;


use Modularization\Core\Components\BaseComponent;

class RouterApiComponent  extends BaseComponent
{
    public function building($nameSpace)
    {
        $this->source = file_get_contents( $this->getRouterPath( '/api.txt'));
        $this->buildNameSpace($nameSpace);
        return $this->source;
    }
}