<?php

namespace Shop;

use Nette\Database\Connection;

class ShopItemManager
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

    /**
     * @param $ItemID
     * @return false|ShopItem|null
     */
    public static function getShopItem($ItemID)
    {
        $string="SELECT * FROM `cgphp_shopitem` WHERE `ItemID` = ?";
        $row = self::$conn->fetch($string, $ItemID);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new ShopItem(
                (string)$row->ItemID,
                (string)$row->ShopID,
                (string)$row->name,
                (string)$row->description,
                CoinType::from($row->CoinType),
                (string)$row->IMAGE_URL,
                (float)$row->price,
                (int)$row->amount,
                (int)$row->maxamount,
                (int)$row->purchases_num,
                (int)$row->creatAt,
                $row->updateAt
            );
        else
            return false;
    }

    /**
     * @return ShopItem[]
     */
    public static function getShopItems($ShopID)
    {
        $string = 'SELECT * FROM `cgphp_shopitem` WHERE `ShopID` = ?';
        $row = self::$conn->fetchAll($string, $ShopID);
        $array = [];
        $k = 0;
        foreach ($row as $shopitem) {
            $array[$k] = new ShopItem(
                (string)$shopitem->ItemID,
                (string)$shopitem->ShopID,
                (string)$shopitem->name,
                (string)$shopitem->description,
                CoinType::from($shopitem->CoinType),
                (string)$shopitem->IMAGE_URL,
                (float)$shopitem->price,
                (int)$shopitem->amount,
                (int)$shopitem->maxamount,
                (int)$shopitem->purchases_num,
                (int)$shopitem->creatAt,
                $shopitem->updateAt,
            );
            $k++;
        }
        return $array;
    }

    public static function addShopItem(string $ItemID, string $ShopID, string $name, string $description, CoinType $CoinType, float $price, int $amount, int $maxamount, int $purchases_num, int $creatAt)
    {
        return self::$conn->query("INSERT INTO `cgphp_shopitem` ?", [
            'ItemID' => $ItemID,
            'ShopID' => $ShopID,
            'name' => $name,
            'description' => $description,
            'CoinType' => $CoinType,
            'price' => $price,
            'amount' => $amount,
            'maxamount' => $maxamount,
            'purchases_num' => $purchases_num,
            'creatAt' => $creatAt,
        ]);
    }

    public static function delShopItem()
    {
    }

    public static function updateShopItem()
    {
    }

    public static function toggleShopItem()
    {
    }
}