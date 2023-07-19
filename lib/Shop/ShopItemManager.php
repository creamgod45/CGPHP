<?php

namespace Shop;

use Nette\Database\Connection;
use Nette\Utils\DateTime;

class ShopItemManager
{
    private static Connection $conn;
    public function __construct()
    {
        $this->init();
    }

    public static function init(){
        self::$conn = new Connection('mysql:host=127.0.0.1;dbname=vvrzmwkq_home', 'vvrzmwkq_home', 'PoinfE}7f,0l');
        self::$conn->connect();
    }
    public static function getShopItem(){}

    /**
     * @return ShopItem[]
     */
    public static function getShopItems(){
        $string = 'SELECT * FROM `cgphp_shopitem`';
        $row = self::$conn->fetchAll($string);
        $array = [];
        $k=0;
        foreach ($row as $shopitem) {
            $array[$k] = new ShopItem(
                (string)$shopitem->ItemID,
                (string)$shopitem->name,
                (string)$shopitem->description,
                CoinType::from($shopitem->CoinType),
                (string)$shopitem->IMAGE_URL,
                (float)$shopitem->price,
                (int)$shopitem->amount,
                (int)$shopitem->purchases_num,
                (int)$shopitem->creatAt,
                $shopitem->updateAt,
            );
            $k++;
        }
        return $array;
    }
    public static function addShopItem(string $ItemID, string $name, string $description, CoinType $CoinType, float $price, int $amount, int $purchases_num, int $creatAt){
        return self::$conn->query("INSERT INTO `cgphp_shopitem` ?", [
            'ItemID' => $ItemID,
            'name' => $name,
            'description' => $description,
            'CoinType' => $CoinType,
            'price' => $price,
            'amount' => $amount,
            'purchases_num' => $purchases_num,
            'creatAt' => $creatAt,
        ]);
    }
    public static function delShopItem(){}
    public static function updateShopItem(){}
    public static function toggleShopItem(){}
}