<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 10/20/18
 * Time: 11:46 PM
 */

namespace Modularization\Http\Facades;


class FileFun
{
    public function getFile($path, $tail = "zip")
    {
        $files = [];
        foreach (glob($path . '/*') as $dir) {
            if (!is_dir($dir) && $this->checkTail($dir, $tail)) {
                $files[] = $this->getFileName($dir, '/');
            }
        }
        rsort($files);
        return $files;
    }

    public function checkTail($file, $tail)
    {
        $arrays = explode('.', $file);
        $is = array_pop($arrays);
        if ($tail === $is) {
            return true;
        }
        return false;
    }

    public function getFileName($file, $char = '/')
    {
        $arrays = explode($char, $file);
        return array_pop($arrays);
    }
}