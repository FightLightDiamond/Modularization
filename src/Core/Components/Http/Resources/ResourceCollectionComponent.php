<?php
/**
 * Created by PhpStorm.
 * Date: 8/29/19
 * Time: 11:21 PM
 */

namespace Cuongpm\Modularization\Core\Components\Http\Resources;


use Cuongpm\Modularization\Core\Components\BaseComponent;

class ResourceCollectionComponent extends BaseComponent
{
    public function building($input, $auth = 'API')
    {
        $inPath = $this->getSource($auth);
        $this->source = file_get_contents($inPath);

        $this->buildNameSpace($input['namespace']);
        $this->buildClassName($input['table']);

        return $this->source;
    }

    private function getSource($auth)
    {
        return $this->getResourcePath("/{$auth}/ResourceCollection.txt");
    }
}
