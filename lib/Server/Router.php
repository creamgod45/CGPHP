<?php

namespace Server;

class Router
{
    public function __construct()
    {
    }

    public function getLayer($layer){
        $url = $_SERVER['REQUEST_URI'];
        $REQUEST = explode('/', $url);
        if ($layer === null) {
            return $REQUEST;
        }
        if (empty($REQUEST[$layer])) {
            return '';
        }
        return $REQUEST[$layer];
    }
}