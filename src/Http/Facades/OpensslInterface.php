<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 10/23/18
 * Time: 2:40 PM
 */

namespace Cuongpm\Modularization\Http\Facades;


interface OpensslInterface
{
    public function __construct($digestAlg = "rsa", $privateKeyBits = "512", $privateKeyType = OPENSSL_KEYTYPE_RSA);

    public function createKeys();

    public function getKeys();

    public function getPrivateKey();

    public function getPublicKeyDetail();

    public function getPublicKey();

    public function encrypt($data, $publicKey);

    public function decrypt($encrypted, $privateKey);
}
