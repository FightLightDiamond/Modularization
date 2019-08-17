<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 10/23/18
 * Time: 2:18 PM
 */

namespace Modularization\Http\Facades;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OpensslFun implements OpensslInterface
{
    private $config;
    private $keys;
    private $privateKey;
    private $publicKeyDetail;
    private $publicKey;

    public function __construct($digestAlg = "rsa", $privateKeyBits = 2048, $privateKeyType = OPENSSL_KEYTYPE_RSA)
    {
        $this->config = array(
            "digest_alg" => $digestAlg,
            "private_key_bits" => $privateKeyBits,
            "private_key_type" => $privateKeyType,
        );
    }

    public function createKeys()
    {
        $this->keys = openssl_pkey_new($this->config);
    }

    public function getKeys()
    {
        if (empty($this->keys)) {
            $this->createKeys();
        }

        return $this->keys;
    }

    public function getPrivateKey()
    {
        if (empty($this->privateKey)) {
            if (empty($this->keys)) {
                $this->createKeys();
            }
            openssl_pkey_export($this->keys, $this->privateKey);
        }

        return $this->privateKey;
    }

    public function getPublicKeyDetail()
    {
        if (empty($this->publicKeyDetail)) {
            $this->publicKeyDetail = openssl_pkey_get_details($this->keys);
        }
        return $this->publicKeyDetail;
    }

    public function getPublicKey()
    {
        if (empty($this->publicKey)) {
            if(empty($this->publicKeyDetail)) {
                $this->getPublicKeyDetail();
            }
            $this->publicKey = $this->publicKeyDetail["key"];
        }

        return $this->publicKey;
    }

    public function encrypt($data, $publicKey)
    {
        openssl_public_encrypt($data, $encrypted, $publicKey);

        return $encrypted;
    }

    public function decrypt($encrypted, $privateKey)
    {
        openssl_private_decrypt($encrypted, $decrypted, $privateKey);

        return $decrypted;
    }

    public function setKey($input)
    {
        $rsa = new OpensslFun();

        $input['private_key'] = $rsa->getPrivateKey();
        $input['public_key'] = $rsa->getPublicKey();

        return $input;
    }

    public function saveKeyFiles($path)
    {
        try {
            mkdir(storage_path($path));
        } catch (\Exception $exception) {}

        $rsa = new OpensslFun();

        $privateKey = $rsa->getPrivateKey();
        $publicKey = $rsa->getPublicKey();

        $source = fopen(storage_path("$path/private.key"), "w");
        fwrite($source, $privateKey);
        $source = fopen(storage_path("$path/public.key"), "w");
        fwrite($source, $publicKey);
    }

    public function getPrivateKeyFile($path)
    {
        return File::get(storage_path("$path/private.key"));
    }

    public function getPublicKeyFile($path)
    {
        return File::get(storage_path("$path/public.key"));

        Auth::logoutOtherDevices($password);
    }

}