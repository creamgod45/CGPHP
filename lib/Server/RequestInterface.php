<?php

namespace Server;

interface RequestInterface
{
    public function GET(string $key = '', bool $ignore_key_missing = false);

    public function POST(string $key = '', bool $ignore_key_missing = false);

    public function HEADERS(string $key = '', bool $ignore_key_missing = false);

    public function HEADER();

    public function SESSION(string $key = '', bool $ignore_key_missing = false);

    public function COOKIE(string $key = '', bool $ignore_key_missing = false);

    public function SERVER(string $key = '', bool $ignore_key_missing = false);

    public function ENV(string $key = '', bool $ignore_key_missing = false);

    public function FILES(string $key = '', bool $ignore_key_missing = false);

    public function Redirect(string $URL = "", int $Seconds = 0);

    public function getInstanceAddress($Suffix = '', $onlyHostName = false, $return_array = false);
}