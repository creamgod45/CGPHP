<?php

namespace Server;

class ENV
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
        if ($this->ignore_key_missing) {
            if (@!empty($_ENV[$this->key])) {
                return $_ENV[$this->key];
            }
            return null;
        } else {
            return $_ENV[$this->key];
        }
        return false;
    }

    public function Set($value = ''): void
    {
        $_ENV[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_ENV[$this->key]);
    }
}