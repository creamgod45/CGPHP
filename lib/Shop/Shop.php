<?php

namespace Shop;

use Nette\Utils\DateTime;
use Utils\Utils;

class Shop
{
    public string $ShopID = "";
    public string $name = "預設";
    public string $description = "無";
    public ShopItemManager $items;
    public string $owner = "系統";
    public ShopInvoiceList $invoiceList;
    public bool $enable = true;
    public int $creatAt;
    public DateTime $updateAt;

    /**
     * @param string $ShopID
     * @param string $name
     * @param string $description
     * @param ShopItemManager $items
     * @param string $owner
     * @param ShopInvoiceList $invoiceList
     * @param bool $enable
     * @param int $creatAt
     * @param DateTime $updateAt
     */
    public function __construct(string $ShopID, string $name, string $description, string $owner, bool $enable, int $creatAt, DateTime $updateAt)
    {
        $this->ShopID = $ShopID;
        $this->name = $name;
        $this->description = $description;
        $this->owner = $owner;
        $this->enable = $enable;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
    }

    /**
     * @return string
     */
    public function getShopID(): string
    {
        return $this->ShopID;
    }

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
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


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return ShopItemManager
     */
    public function getItems(): ShopItemManager
    {
        return $this->items;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @return ShopInvoiceList
     */
    public function getInvoiceList(): ShopInvoiceList
    {
        return $this->invoiceList;
    }

    /**
     * @param Shop $shop
     * @return void
     */
    public function overrideClass(Shop $shop, bool $FullOverride = true): void
    {
        if ($FullOverride) {
            $this->ShopID = $shop->ShopID;
        } else {
            $this->ShopID = md5((new Utils())->uid());
        }
        $this->name = $shop->name;
        $this->description = $shop->description;
        $this->items = $shop->items;
        $this->owner = $shop->owner;
        $this->invoiceList = $shop->invoiceList;
        $this->enable = $shop->enable;
        $this->creatAt = $shop->creatAt;
        $this->updateAt = $shop->updateAt;
    }
}