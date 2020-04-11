<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Cuongpm\Modularization\Core\Factories;

use Cuongpm\Modularization\Http\Facades\FormatFa;

class BaseFactory
{
    protected $sortPath;
    protected $auth = 'API';
    protected $table;
    protected $fileName;

    public function setPath($sortPath)
    {
        $this->sortPath = $sortPath;
        return $this;
    }

    public function setAuth($auth)
    {
        $this->auth = $auth;
        return $this;
    }

    public function produce($material, $path, $auth = true)
    {
        $pathOut = $this->getSource($path, $auth);
        echo ($pathOut) . "\n";
        $fileForm = fopen($pathOut, "w");
        fwrite($fileForm, $material);
    }


    protected function getSource($path, $auth)
    {
        $segments = [$path, $this->sortPath];

        if($auth) {
            array_push($segments, $this->auth);
        }

        $path = FormatFa::mixUri($segments);
        $path = FormatFa::standardUri($path);
        $segments = [$path, FormatFa::formatAppName($this->table) . $this->fileName];
        $uri = FormatFa::mixUri($segments);

        return base_path($uri);
    }
}
