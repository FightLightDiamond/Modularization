<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 5/13/19
 * Time: 6:10 PM
 */

namespace Modularization\Facades;

define('AES_256_CBC', 'aes-256-cbc');

class AES_Encryption
{
    private $iv;
    public function __construct()
    {
        $this->iv = 'iH84aMMOeP8CJ+wn';
//        dump(strlen($this->iv));
//        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));

        dump($this->iv, strlen($this->iv));
//        $this->iv = env('APP_KEY', 'Gz31yW0LlDtzktk7CUz4TE8tyv68QQ+mBo6gZXZVr1s=');
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