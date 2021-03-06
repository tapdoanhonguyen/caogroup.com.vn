<?php

//include(ROOT_PATH . DS . 'Crypt/RSA.php');
namespace NukeViet\Alepay\Utils;
use NukeViet\Alepay\Crypt\Crypt_RSA;
class AlepayUtils {

    function encryptData($data, $publicKey) {
		//print_r(CRYPT_RSA_ENCRYPTION_PKCS1);die;
        $rsa = new Crypt_RSA();
		//print_r($publicKey);die;
        $rsa->loadKey($publicKey); // public key
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $output = $rsa->encrypt($data);
        return base64_encode($output);
    }

    function decryptData($data, $publicKey) {
        $rsa = new Crypt_RSA();
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $ciphertext = base64_decode($data);
        $rsa->loadKey($publicKey); // public key
        $output = $rsa->decrypt($ciphertext);
        // $output = $rsa->decrypt($data);
        return $output;
    }

    function decryptCallbackData($data, $publicKey) {
        $decoded = base64_decode($data);
        return $this->decryptData($decoded, $publicKey);
    }

}
