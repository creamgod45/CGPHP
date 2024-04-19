<?php

namespace Utils;

use Nette\Database\Connection as con;

class Connection
{
    /**
     * @return con
     */
    public static function conn()
    {
        //$conn = new con('mysql:host=127.0.0.1;dbname=gmnyvebe_cgphp01', 'gmnyvebe_cgphp01', 'FT;u;H}3j@D!');
        $conn = new con('mysql:host=127.0.0.1;dbname=vvrzmwkq_home', 'root', '');
        $conn->connect();
        return $conn;
    }
}
