<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/13/19
 * Time: 6:10 PM
 */

namespace Modularization\Http\Facades;

define('AES_256_CBC', 'aes-256-cbc');

class AES_Encryption
{
    private $iv;

    public function __construct()
    {
        $this->iv = 'iH84aMMOeP8CJ+wn';
    }

    public function encryption($data, $encryption_key)
    {
        return openssl_encrypt($data, AES_256_CBC, $encryption_key, 0, $this->iv);
    }

    public function decryption($encrypted, $encryption_key)
    {
        $encrypted = $encrypted . ':' . base64_encode($this->iv);
        $parts = explode(':', $encrypted);

        return openssl_decrypt($parts[0], AES_256_CBC, $encryption_key, 0, base64_decode($parts[1]));
    }
}