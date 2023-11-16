<?php

namespace Server;

class FILES
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
        if (empty($this->key)) return $_FILES;
        if ($this->ignore_key_missing) {
            if (@!empty($_FILES[$this->key])) {
                return $_FILES[$this->key];
            }
            return null;
        } else {
            return $_FILES[$this->key];
        }
        return false;
    }

    public function Set($value = ''): void
    {
        $_FILES[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_FILES[$this->key]);
    }
}