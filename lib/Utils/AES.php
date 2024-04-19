<?php

namespace Utils;

use LZCompressor\LZString as lz;

/**
 * AES 加密模型
 */
class AES
{
    private $Utils;
    private $DIDC;

    public function __construct($DID, $expire = 86400)
    {
        $this->Utils = new Utils();
        $this->DIDC = new DID($DID, $expire);
    }

    public function prepareWriteMode(string $value): string
    {
        $e = $this->encrypt($value);
        return lz::compressToBase64($e);
    }

    public function encrypt($value)
    {
        $crypto_strong = false;
        $key = $this->DIDC->getDIDV();
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'), $crypto_strong);
        $encrypted = openssl_encrypt($value, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    public function prepareReadMode(string $value): string
    {
        $d = lz::decompressFromBase64($value);
        return $this->decrypt($d);
    }

    public function decrypt($primitive)
    {
        $key = $this->DIDC->getDIDV();
        @[$encrypted_data, $iv] = explode('::', base64_decode($primitive), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }
}
