<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Modularization\Core\Factories\Http\Resources;


use Modularization\Core\Components\Http\Resources\ResourceComponent;
use Modularization\Core\Factories\BaseFactory;

class ResourceFactory extends BaseFactory
{
    protected $component;
    protected $sortPath = '/Http/Resources/';
    protected $fileName = 'Resource.php';

    public function __construct(ResourceComponent $component)
    {
        $this->component = $component;
    }

    public function building($input)
    {
        $this->table = $input['table'];
        $material = $this->component->building($input, $this->auth);
        $this->produce($material, $input['path']);
    }
}