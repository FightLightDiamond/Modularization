<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 8/23/2016
 * Time: 4:08 PM
 */

namespace Modularization\Http\Facades;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FormatFun
{
    public function indexPaginate($k, $data)
    {
        return ($data->currentPage() - 1) * $data->perPage() + $k + 1;
    }

    public function removeChar($content, $char = ' ')
    {
        $i = true;

        while ($i) {
            strpos($content, $char);
            $content = str_replace(' ', '', $content);
        }

        return $content;
    }

    public function dateTime($data, $format = 'd-m-Y')
    {
        return date_format(date_create($data), $format);
    }

    public function slug($str)
    {
        return str_slug($this->vn_str_filter($str));
    }

    function vn_str_filter($str)
    {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    public static function getPlainText($input, $length)
    {
        $input = str_replace(array("\r\n", "\r"), "\n", strip_tags($input));
        $lines = explode("\n", $input);
        $newLines = array();

        foreach ($lines as $i => $line) {
            if (!empty($line)) {
                $newLines[] = trim($line);
            }
        }
        $input = implode($newLines);
        return htmlentities(substr($input, 0, $length), ENT_COMPAT, 'UTF-8');
    }

    public function formatNameFile($name)
    {
        $arrayElement = explode('.', $name);
        $type = array_pop($arrayElement);
        return str_random(8) . uniqid() . '.' . $type;
    }

    public function reFileName($file)
    {
        $fileName = $file->getClientOriginalName();
        $arrayName = explode('.', $fileName);
        $tail = array_pop($arrayName);
        return str_random(8) . uniqid() . '.' . $tail;
    }

    public function formatAppName($name)
    {
        return Str::ucfirst(Str::camel(Str::singular($name)));
    }

    function convertToHoursMins($time, $format = '%02d hours %02d minutes')
    {
        if ($time < 1) {
            return $time;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        if ($hours == 0) {
            return sprintf('%02d minutes', $minutes);
        }
        return sprintf($format, $hours, $minutes);
    }

    function singleArray($arr)
    {
        $newArray = [];

        foreach ($arr as $key) {
            if (is_array($key)) {
                $array = $this->singleArray($key);
                foreach ($array as $k) {
                    $newArray[] = $k;
                }
            } else {
                $newArray[] = $key;
            }
        }

        return $newArray;
    }

    public function oneSpace($str)
    {
        return preg_replace('!\s+!', ' ', $str);
    }

    /*
     * URI
     */
    public function elementUris($path)
    {
        $path = ltrim($path, "/");
        $path = rtrim($path, "/");

        while (strpos("//", $path)) {
            $path = str_replace("//", "/", $path);
        }

        $paths = explode("/", $path);

        return $paths;
    }

    public function makeFolder($paths)
    {
        $uri = "";

        foreach ($paths as $path) {
            $uri .= "{$path}/";
            $realUri = base_path($uri);

            if (!is_dir($realUri)) {
                mkdir($realUri);
            }
        }

        return $uri;
    }

    public function mixUri($segments, $char = '/')
    {
        foreach ($segments as $i => $segment) {
            $segments[$i] = rtrim(ltrim($segment, $char), $char);
        }

        return implode($char, $segments);
    }

    public function standardUri($path)
    {
        $paths = $this->elementUris($path);
        return $this->makeFolder($paths);
    }

    public function formatBase64($image, $with = 100, $height = 100, $tail = 'png')
    {
        $img = Image::make($image);
        $img->resize($with, $height);

        return "data:image/png;base64," . base64_encode($img->stream($tail));
    }
}
