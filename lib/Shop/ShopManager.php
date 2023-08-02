<?php

namespace Shop;

use Nette\Database\Connection;

class ShopManager
{
    private static Connection $conn;

    public function __construct()
    {
        $this->init();
    }

    public static function init()
    {
        self::$conn = new Connection('mysql:host=127.0.0.1;dbname=', '', '');
        self::$conn->connect();
    }

    public static function getShop($ShopID)
    {
        $string="SELECT * FROM `cgphp_shop` WHERE `ShopID` = ?";
        $row = self::$conn->fetch($string, $ShopID);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new Shop(
                (string)$row->ShopID,
                (string)$row->name,
                (string)$row->description,
                (string)$row->owner,
                (bool)$row->enable,
                (int)$row->creatAt,
                $row->updateAt
            );
        else
            return false;
    }

    public static function getShops()
    {
        $string = 'SELECT * FROM `cgphp_shop`';
        $row = self::$conn->fetchAll($string);
        $array = [];
        $k = 0;
        foreach ($row as $shop) {
            $array[$k] = new Shop(
                (string)$shop->ShopID,
                (string)$shop->name,
                (string)$shop->description,
                (string)$shop->owner,
                (bool)$shop->enable,
                (int)$shop->creatAt,
                $shop->updateAt
            );
            $k++;
        }
        return $array;
    }

    public static function addShop(string $ShopID, string $name, string $description, string $owner, bool $enable, int $creatAt)
    {
        return self::$conn->query("INSERT INTO `cgphp_shop` ?", [
            'ShopID' => $ShopID,
            'name' => $name,
            'description' => $description,
            'owner' => $owner,
            'enable' => $enable,
            'creatAt' => $creatAt
        ]);
    }

    public static function delShop($ShopID)
    {
    }

    public static function updateShop($ShopID)
    {
    }

    public static function toggleShop($ShopID)
    {
    }
}