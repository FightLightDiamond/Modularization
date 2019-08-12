<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:55 PM
 */

namespace Modularization\Core\Components\Http\Resources;


use Modularization\Core\Components\BaseComponent;

class ResourceComponent extends BaseComponent
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
        return $this->getResourcePath("/{$auth}/Resource.txt");
    }
}