<?php

namespace Server;

class Router
{
    /**
     * @var null|int $layer
     */
    private ?int $layer = null;

    public function __construct($layer = null)
    {
        $this->layer = $layer;
    }

    /**
     * @return string|array|null
     */
    public function getLayer()
    {
        $url = $_SERVER['REQUEST_URI'];
        $REQUEST = explode('/', $url);
        if ($this->layer === null) {
            return $REQUEST;
        }
        if (empty($REQUEST[$this->layer])) {
            return null;
        }
        return $REQUEST[$this->layer];
    }
}
