<?php

namespace Server;

class SERVER
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
        if (empty($this->key)) return $_SERVER;
        if ($this->ignore_key_missing) {
            if (@!empty($_SERVER[$this->key])) {
                return $_SERVER[$this->key];
            }
        } else {
            return $_SERVER[$this->key];
        }
        return false;
    }

    public function Set($value = ''): void
    {
        $_SERVER[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_SERVER[$this->key]);
    }
}