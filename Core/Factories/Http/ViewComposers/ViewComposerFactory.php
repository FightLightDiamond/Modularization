<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 1/19/18
 * Time: 5:34 PM
 */

namespace Modularization\Core\Factories\ViewComposers;


use Modularization\Core\Components\Http\ViewComposers\ViewComposerComponent;

class ViewComposerFactory
{
    protected $component;

    public function __construct(ViewComposerComponent $component)
    {
        $this->component = $component;
    }
}