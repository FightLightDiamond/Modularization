<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 1/19/18
 * Time: 5:29 PM
 */

namespace Modularization\Core\Components\Http\ViewComposers;

use Modularization\Core\Components\BaseComponent;

class ViewComposerComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    private function getSource()
    {
        return $this->getViewPath( '/form/update.html');
    }
}