<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 7/23/2018
 * Time: 9:01 PM
 */

namespace Modularization\Core\Components;

use Modularization\Helpers\CRUDPath;

class RouterComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents( CRUDPath::viewPath() . '/mvc/router.php');
    }

    public function building($nameSpace)
    {
        $this->buildNameSpace($nameSpace);
        return $this->source;
    }
}