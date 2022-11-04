<?php

namespace Server\Request;

class SESSION
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
        if($this->ignore_key_missing){
            if(@!empty($_SESSION[$this->key])){
                return $_SESSION[$this->key];
            }
        }else{
            return $_SESSION[$this->key];
        }
        return false;
    }

    public function Set($value = ''): void
    {
        $_SESSION[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_SESSION[$this->key]);
    }
}