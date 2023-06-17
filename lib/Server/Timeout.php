<?php

namespace Server\Request;

class Timeout
{
    public string $key;

    public function __construct($key, $expired = 10)
    {
        $this->key = $key;
        if (@empty($_SESSION["TO_" . $this->key]))
            $_SESSION["TO_" . $this->key] = time() + $expired;
    }

    public function getTimeout()
    {
        return $_SESSION["TO_" . $this->key];
    }

    public function isTimeout()
    {
        if (@empty($_SESSION["TO_" . $this->key])) return false;
        return $_SESSION["TO_" . $this->key] < time();
    }

    public function addTimeout($expired = 10)
    {
        $_SESSION["TO_" . $this->key] = time() + $expired;
    }

}