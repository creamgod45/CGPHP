<?php

namespace Auth;

use Server\Request;
use Utils\Utils;

class UniqueVisiterID
{
    private $key = "";

    public function __construct()
    {
        $this->key = $this->detect();
    }

    public static function detect()
    {
        $utils = new Utils();
        $request = new Request();
        $a = [
            $utils->GetIP(),
            $utils->GetDevice(),
            $utils->get_browser($request->SERVER("HTTP_USER_AGENT", true)->Get()),
            $request->SERVER("SERVER_ADDR", true)->Get()
        ];
        $encode = implode(".", $a);
        return md5($encode);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}