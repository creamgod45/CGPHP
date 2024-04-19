<?php

namespace Server;

class POST
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
        if (empty($this->key)) return $_POST;
        if ($this->ignore_key_missing) {
            if (@!empty($_POST[$this->key])) {
                return $_POST[$this->key];
            }
            return null;
        } else {
            return $_POST[$this->key];
        }
        return false;
    }

    public function isEmpty(): bool
    {
        @$var = $this->Get();
        return empty($var);
    }

    public function Set($value = ''): void
    {
        $_POST[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_POST[$this->key]);
    }
}
