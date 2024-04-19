<?php

namespace Server;

class COOKIE
{
    public string $key;
    public bool $ignore_key_missing;

    public function __construct($key = '', $ignore_key_missing = false)
    {
        $this->key = $key;
        $this->ignore_key_missing = $ignore_key_missing;
    }

    public function Get()
    {
        if (empty($this->key)) return $_COOKIE;
        if ($this->ignore_key_missing) {
            if (@!empty($_COOKIE[$this->key])) {
                return $_COOKIE[$this->key];
            }
            return null;
        } else {
            return $_COOKIE[$this->key];
        }
        return false;
    }

    public function Set($value = ''): void
    {
        $_COOKIE[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_COOKIE[$this->key]);
    }
}