<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Http\Resources;


use Cuongpm\Modularization\Core\Components\Http\Resources\ResourceComponent;
use Cuongpm\Modularization\Core\Factories\BaseFactory;
use Cuongpm\Modularization\src\Core\Components\Http\Resources\ResourceCollectionComponent;

class ResourceFactory extends BaseFactory
{
    protected $component;
    protected $collectionComponent;

    protected $auth = 'API';
    protected $sortPath = '/Http/Resources/';
    protected $fileName = 'Resource.php';

    public function __construct(ResourceComponent $component, ResourceCollectionComponent $collectionComponent)
    {
        $this->component = $component;
        $this->collectionComponent = $collectionComponent;
    }

    public function building($input)
    {
        $this->table = $input['table'];

        $material = $this->component->building($input, $this->auth);
        $this->produce($material, $input['path']);

        $this->fileName = 'ResourceCollection.php';
        $material = $this->collectionComponent->building($input, $this->auth);
        $this->produce($material, $input['path']);
    }
}
