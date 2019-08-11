<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Modularization\Core\Factories;

class BaseFactory
{
    protected $sortPath = '/Http/Services/API/';
    protected $auth = 'API';

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

    protected function makeFolder($path)
    {
        if (!is_dir(base_path($path . $this->sortPath))) {
            try {
                mkdir(base_path($path . $this->sortPath));
            } catch (\Exception $exception) {
                logger($path . $this->sortPath);
            }
        }
    }
}