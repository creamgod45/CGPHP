<?php

namespace Server\Request;

class CSRF
{
    public string $key;

    public function __construct($Key)
    {
        $this->key = $Key;
        if (@empty($_SESSION["CSRF_" . $this->key])) {
            $_SESSION["CSRF_" . $this->key] = md5(uniqid("CSRF_"));
        }
        return $this;
    }

    public function getValue()
    {
        return $_SESSION["CSRF_" . $this->key];
    }

    public function equal($string): bool
    {
        return $_SESSION["CSRF_" . $this->key] === $string;
    }


    public function reset(): CSRF
    {
        $_SESSION["CSRF_" . $this->key] = md5(uniqid("CSRF_"));
        return $this;
    }

}