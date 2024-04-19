<?php

namespace Server;

class GET
{
    public string $key;
    public bool $ignore_key_missing;

    public function __construct($key = '', $ignore_key_missing = false)
    {
        $this->key = $key;
        $this->ignore_key_missing = $ignore_key_missing;
    }

    public function Get($filter=true)
    {
        if (empty($this->key)) return $_GET;
        if ($this->ignore_key_missing) {
            if (@!empty($_GET[$this->key])) {
                if($filter)
                    return htmlentities($_GET[$this->key]);
                else
                    return $_GET[$this->key];
            }
            return null;
        } else {
            if($filter)
                return htmlentities($_GET[$this->key]);
            else
                return $_GET[$this->key];
        }
        return false;
    }

    public function Set($value = ''): void
    {
        $_GET[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_GET[$this->key]);
    }
}