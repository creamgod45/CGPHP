<?php

namespace Shop;

use Nette\Database\Row;
use Nette\Neon\Exception;
use Nette\Utils\DateTime;
use Utils\Utils;

class ShopManager
{
    private static bool $loaded = false;

    public function __construct($load = true)
    {
        if ($load) {
            self::init();
        }
    }

    private static \Nette\Database\Connection $conn;

    private static function init()
    {
        self::setLoaded(true);
        self::$conn = \Utils\Connection::conn();
    }

    /**
     * @param bool $loaded
     */
    private static function setLoaded(bool $loaded): void
    {
        self::$loaded = $loaded;
    }

    public static function getInvoice($InvoiceID)
    {
    }

    public static function getInvoiceList($ShopID)
    {
    }

    public static function addInvoice()
    {
    }

    public static function delInvoice($InvoiceID)
    {
    }

    public static function updateInvoice($InvoiceID)
    {
    }

    public static function toggleInvoice($InvoiceID)
    {
    }

    /**
     * @param ShopNameField|string $e
     * @param $condition
     * @param $enable
     * @return bool
     * @throws Exception
     */
    public static function toggleShop($e, $condition, $enable): bool
    {
        if (self::isLoaded()) self::init();
        switch ($e) {
            case ShopNameField::ShopID:
                $string = "UPDATE `cgphp_shop` SET `enable` = ? WHERE `ShopID` = ?";
                $row = self::$conn->query($string, $enable, $condition);
                return $row->getRowCount();
            case ShopNameField::ID:
                $string = "UPDATE `cgphp_shop` SET `enable` = ? WHERE `ID` = ?";
                $row = self::$conn->query($string, $enable, $condition);
                return $row->getRowCount();
            default:
                throw new Exception("NOT SELECTED VALID ShopNameField ENUM");
        }
    }

    /**
     * @param $ItemID
     * @return false|ShopItem|null
     */
    public static function getShopItem($ShopId,$ItemID)
    {
        if (self::isLoaded()) self::init();
        $string = "SELECT * FROM `cgphp_shopitem` WHERE `ItemID` = ? and `ShopID` = ?";
        $row = self::$conn->fetch($string, $ItemID, $ShopId);
        if ($row === null) return null;
        if ($row->count() > 0) {
            return (new ShopItem())->setShopItem(
                (int)$row->ID,
                (string)$row->ShopID,
                (string)$row->ItemID,
                (string)$row->name,
                (string)$row->description,
                (string)$row->IMAGE_URL,
                (float)$row->price,
                (int)$row->amount,
                (int)$row->maxamount,
                (int)$row->purchases_num,
                (int)$row->creatAt,
                $row->updateAt
            );
        }    return false;
    }

    /**
     * @return ShopItem[]
     */
    public static function getShopItems($ShopID)
    {
        if (self::isLoaded()) self::init();
        $string = 'SELECT * FROM `cgphp_shopitem` WHERE `ShopID` = ?';
        $row = self::$conn->fetchAll($string, $ShopID);
        $array = [];
        $k = 0;
        foreach ($row as $shopitem) {
            $array[$k] = (new ShopItem())->setShopItem(
                (int)$shopitem->ID,
                (string)$shopitem->ShopID,
                (string)$shopitem->ItemID,
                (string)$shopitem->name,
                (string)$shopitem->description,
                (string)$shopitem->IMAGE_URL,
                (float)$shopitem->price,
                (int)$shopitem->amount,
                (int)$shopitem->maxamount,
                (int)$shopitem->purchases_num,
                (int)$shopitem->creatAt,
                $shopitem->updateAt
            );
            $k++;
        }
        return $array;
    }

    public static function addShopItem(string $ShopID,string $ItemID, string $name, string $description, float $price, int $amount, int $maxamount, int $purchases_num, int $creatAt)
    {
        if (self::isLoaded()) self::init();
        return self::$conn->query("INSERT INTO `cgphp_shopitem` ?", [
            'ShopID' => $ShopID,
            'ItemID' => $ItemID,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'amount' => $amount,
            'maxamount' => $maxamount,
            'purchases_num' => $purchases_num,
            'creatAt' => $creatAt,
        ]);
    }

    public static function delShopItem($ItemID, $ShopID)
    {
        if (self::isLoaded()) self::init();
        $r = self::$conn->query("DELETE FROM `cgphp_shopitem` WHERE `ItemID` = ? and `ShopID` = ?", $ItemID, $ShopID);
        return $r->getRowCount();
    }

    public static function updateShopItem()
    {
    }

    public static function toggleShopItem()
    {
    }


    /**
     * @return bool
     */
    public static function isLoaded(): bool
    {
        return !self::$loaded;
    }


    /**
     * @param $enable
     * @return array|Shop[]
     */
    public static function getShops($enable=false){
        if (self::isLoaded()) self::init();
        /**
         * @var Row[] $rows
         */
        $rows = self::$conn->fetchAll("SELECT * FROM `cgphp_shop` WHERE `enable` = ?", $enable);
        $arr = [];
        foreach ($rows as $rawshop) {
            $arr [$rawshop->ShopID] = (new Shop())->setShop2(
                $rawshop->ID,
                $rawshop->ShopID,
                $rawshop->name,
                Utils::BooleanParse($rawshop->enable),
                Utils::BooleanParse($rawshop->opening),
                $rawshop->address,
                $rawshop->phone,
                $rawshop->creatAt,
                $rawshop->updateAt,
            );
        }
        return $arr;
    }

    /**
     * @param string|ShopNameField $e
     * @param $ShopID
     * @return Shop|void|null
     * @throws Exception
     */
    public static function getShop(string|ShopNameField $e, $ShopID){
        if (self::isLoaded()) self::init();
        switch ($e){
            case ShopNameField::ShopID:
                $row = self::$conn->fetch("SELECT * FROM `cgphp_shop` WHERE `ShopID` = ?", $ShopID);
                if($row===null) return null;
                if($row->count()>0)
                    return (new Shop())->setShop2(
                        $row->ID,
                        $row->ShopID,
                        $row->name,
                        Utils::BooleanParse($row->enable),
                        Utils::BooleanParse($row->opening),
                        $row->address,
                        $row->phone,
                        $row->creatAt,
                        $row->updateAt,
                    );
                break;
            default:
                throw new Exception("NOT SELECTED VALID ShopNameField ENUM");
                break;
        }
    }

    public static function addShop(Shop $s)
    {
        if (self::isLoaded()) self::init();
        self::addShop1(
            $s->getShopID(),
            $s->getName(),
            $s->getEnable(),
            $s->isOpening(),
            $s->getAddress(),
            $s->getPhone(),
            $s->getCreatAt(),
        );
    }

    public static function addShop1(string $ShopID, string $name, string $enable, string $opening, string $address, string $phone, int $creatAt)
    {
        if (self::isLoaded()) self::init();
        self::$conn->query("INSERT INTO `cgphp_shop` ?", [
            ShopNameField::ShopID->value => $ShopID,
            ShopNameField::name->value => $name,
            ShopNameField::enable->value => $enable,
            ShopNameField::opening->value => $opening,
            ShopNameField::address->value => $address,
            ShopNameField::phone->value => $phone,
            ShopNameField::creatAt->value => $creatAt,
        ]);
    }
}
