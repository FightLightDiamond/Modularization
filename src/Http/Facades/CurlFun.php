<?php
/**
 * Created by cuongpm/modularization.
 * User: cuong
 * Date: 12/14/16
 * Time: 9:53 PM
 */

namespace Modularization\Http\Facades;

class CurlFun
{
    private $timeout = 10;

    public function getData($path)
    {
        $url = $path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $data = curl_exec($ch);
        $this->logError($ch);
        curl_close($ch);
        return $data;
    }

    public function postData($param, $url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, count($param));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        $data = curl_exec($ch);
        $this->logError($ch);
        curl_close($ch);
        return $data;
    }

    private function logError($ch)
    {
        $a = curl_errno($ch);
        curl_strerror($a);
    }

}