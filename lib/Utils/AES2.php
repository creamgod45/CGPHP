<?php

namespace Utils;

use LZCompressor\LZString as lz;

/**
 * AES 加密模型
 */
class AES2
{
    private $namespace;

    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    public function prepareWriteMode(string $value): string
    {
        $e = $this->encrypt($value);
        return lz::compressToBase64($e);
    }

    public function encrypt($value)
    {
        $crypto_strong = false;
        $key = $this->namespace;
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
        $key = $this->namespace;
        @[$encrypted_data, $iv] = explode('::', base64_decode($primitive), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }
}
