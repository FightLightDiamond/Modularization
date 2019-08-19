<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Modularization\Core\Factories;

use Modularization\Http\Facades\FormatFa;

class BaseFactory
{
    protected $sortPath;
    protected $auth;
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

    public function produce($material, $path)
    {
        $pathOut = $this->getSource($path);
        echo ($pathOut) . "\n";
        $fileForm = fopen($pathOut, "w");
        fwrite($fileForm, $material);
    }

    protected function getSource($path)
    {
        return $this->buildUri($path);
    }

    protected function buildUri($path)
    {
        $path = FormatFa::mixUri([$path, $this->sortPath, $this->auth]);
        $path = FormatFa::standardUri($path);

        $segments = [$path, FormatFa::formatAppName($this->table) . $this->fileName];
        $uri = FormatFa::mixUri($segments);

        return base_path($uri);
    }
}