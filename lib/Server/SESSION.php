<?php

namespace Server;

class SESSION
{
    public string $key;
    public bool $ignore_key_missing;

    public function __construct($key = '', $ignore_key_missing = false)
    {
        $this->key = $key;
        $this->ignore_key_missing = $ignore_key_missing;
    }

    /**
     * @return array|false|mixed
     */
    public function Get()
    {
        if (empty($this->key)) return $_SESSION;
        if ($this->ignore_key_missing) {
            if (@!empty($_SESSION[$this->key])) {
                return $_SESSION[$this->key];
            }
        } else {
            return $_SESSION[$this->key];
        }
        return false;
    }

    public function Set($value = '')
    {
        $_SESSION[$this->key] = $value;
        return $this;
    }

    public function Remove()
    {
        if (@!empty($_SESSION[$this->key]))
            unset($_SESSION[$this->key]);
        return $this;
    }
}