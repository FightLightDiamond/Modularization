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
        $this->sortPath .= $auth;

        return $this;
    }

    public function produce($material, $path)
    {
        $pathOut = $this->getSource($path);
//        dd($pathOut);
        $fileForm = fopen($pathOut, "w");
        fwrite($fileForm, $material);
    }

    protected function getSource($path)
    {
        return $this->buildUri($path);
    }

    protected function buildUri($path)
    {
//        dd($path);
        $path = FormatFa::mixUri([$path, $this->sortPath]);

        $segments = [$path, FormatFa::formatAppName($this->table) . $this->fileName];
        $uri = FormatFa::mixUri($segments);

        return base_path($uri);
    }
}