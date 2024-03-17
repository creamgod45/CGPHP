<?php

namespace Shop;

use Nette\Utils\DateTime;
use Type\Array\CGArray;

class Shop
{
    private int $ID;
    private string $ShopID;
    private string $name;
    private string $enable;
    private bool $opening;
    private string $address;

    private string $phone;
    /**
     * 建構後建立
     * @var Statistics
     */
    private Statistics $turnover;
    private int $creatAt;
    /**
     * 建構後建立
     * @var DateTime
     */
    private DateTime $updateAt;
    private bool $init;

    public function __construct()
    {
        $this->init = false;
    }

    /**
     * @return int
     */
    public function getID(): int
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getShopID(): string
    {
        return $this->ShopID;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEnable(): string
    {
        return $this->enable;
    }

    /**
     * @param string $enable
     */
    public function setEnable(string $enable): void
    {
        $this->enable = $enable;
    }

    /**
     * @return bool
     */
    public function isOpening(): bool
    {
        return $this->opening;
    }

    public function formatOpening($trueTextPrefix=null, $falseTextPrefix=null){
        if($this->opening){
            return $trueTextPrefix."開店中";
        }
        return $falseTextPrefix."關店";
    }

    /**
     * @param bool $opening
     */
    public function setOpening(bool $opening): void
    {
        $this->opening = $opening;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    } // 開店中

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return Statistics
     */
    public function getTurnover(): Statistics
    {
        return $this->turnover;
    }

    /**
     * @param Statistics $turnover
     */
    public function setTurnover(Statistics $turnover): void
    {
        $this->turnover = $turnover;
    }

    /**
     * @return int
     */
    public function getCreatAt(): int
    {
        return $this->creatAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): DateTime
    {
        return $this->updateAt;
    }

    public function hasInit(): bool
    {
        return $this->init;
    }


    /**
     * @param int $ID
     * @param string $ShopID
     * @param string $name
     * @param string $enable
     * @param bool $opening
     * @param string $address
     * @param string $phone
     * @param Statistics $turnover
     * @param int $creatAt
     * @param DateTime $updateAt
     */
    public function setShop(int $ID, string $ShopID, string $name, string $enable, bool $opening, string $address, string $phone, Statistics $turnover, int $creatAt, DateTime $updateAt)
    {
        $this->ID = $ID;
        $this->ShopID = $ShopID;
        $this->name = $name;
        $this->enable = $enable;
        $this->opening = $opening;
        $this->address = $address;
        $this->phone = $phone;
        $this->turnover = $turnover;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
        $this->init = true;
        return $this;
    }


    /**
     * @param int $ID
     * @param string $ShopID
     * @param string $name
     * @param string $enable
     * @param bool $opening
     * @param string $address
     * @param string $phone
     * @param int $creatAt
     * @param DateTime $updateAt
     */
    public function setShop2(int $ID, string $ShopID, string $name, string $enable, bool $opening, string $address, string $phone, int $creatAt, DateTime $updateAt)
    {
        $this->ID = $ID;
        $this->ShopID = $ShopID;
        $this->name = $name;
        $this->enable = $enable;
        $this->opening = $opening;
        $this->address = $address;
        $this->phone = $phone;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
        $this->init = true;
        return $this;
    }

    public function __serialize()
    {
        return serialize($this);
    }

    /**
     * @param $data
     * @return void
     */
    public function __unserialize($data): void
    {
        /**
         * @var Shop $d
         */
        $d = unserialize($data);
        $this->setShop1($d);
    }

    public function setShop1(Shop $s)
    {
        $this->ID = $s->ID;
        $this->ShopID = $s->ShopID;
        $this->name = $s->name;
        $this->enable = $s->enable;
        $this->opening = $s->opening;
        $this->address = $s->address;
        $this->phone = $s->phone;
        $this->turnover = $s->turnover;
        $this->creatAt = $s->creatAt;
        $this->updateAt = $s->updateAt;
        $this->init = $s->init;
        return $this;
    }
}
