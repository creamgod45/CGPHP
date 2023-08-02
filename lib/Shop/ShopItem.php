<?php

namespace Shop;

use Nette\Utils\DateTime;
use Type\Array\CGArray;
use Utils\Utils;

class ShopItem
{
    public string $ItemID = "";
    public string $ShopID;
    public string $name = "";
    public string $description = "無";
    public CoinType $CoinType;
    public string $IMAGE_URL = "";
    public float $price = 0.0;
    public int $amount = 0;
    public int $maxamount=0;
    public int $purchases_num = 0;
    public int $creatAt;
    public DateTime $updateAt;

    /**
     * @param string $ItemID
     * @param string $ShopID
     * @param string $name
     * @param string $description
     * @param CoinType $CoinType
     * @param string $IMAGE_URL
     * @param float $price
     * @param int $amount
     * @param int $maxamount
     * @param int $purchases_num
     * @param int $creatAt
     * @param DateTime $updateAt
     */
    public function __construct(string $ItemID, string $ShopID, string $name, string $description, CoinType $CoinType, string $IMAGE_URL, float $price, int $amount, int $maxamount, int $purchases_num, int $creatAt, DateTime $updateAt)
    {
        $this->ItemID = $ItemID;
        $this->ShopID = $ShopID;
        $this->name = $name;
        $this->description = $description;
        $this->CoinType = $CoinType;
        $this->IMAGE_URL = $IMAGE_URL;
        $this->price = $price;
        $this->amount = $amount;
        $this->maxamount = $maxamount;
        $this->purchases_num = $purchases_num;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
    }


    /**
     * @return string
     */
    public function getIMAGEURL(): string
    {
        if(empty($this->IMAGE_URL)) return (new Utils())->getInstanceAddress(true)."/assets/images/shop.png";
        return $this->IMAGE_URL;
    }

    /**
     * @return CoinType
     */
    public function getCoinType(): CoinType
    {
        return $this->CoinType;
    }

    /**
     * @return string
     */
    public function getItemID(): string
    {
        return $this->ItemID;
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
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    public function formatPrice(){
        return number_format($this->price, 2);
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getPurchasesNum(): int
    {
        return $this->purchases_num;
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

    public function overrideClass(ShopItem $shopItem, bool $FullOverride = true)
    {
        if ($FullOverride) {
            $this->ItemID = $shopItem->ItemID;
        } else {
            $this->ItemID = md5((new Utils())->uid());
        }
        $this->ShopID = $shopItem->ShopID;
        $this->name = $shopItem->name;
        $this->description = $shopItem->description;
        $this->CoinType = $shopItem->CoinType;
        $this->price = $shopItem->price;
        $this->amount = $shopItem->amount;
        $this->purchases_num = $shopItem->purchases_num;
        $this->creatAt = $shopItem->creatAt;
        $this->updateAt = $shopItem->updateAt;
    }

    /**
     * @return string
     */
    public function getShopID(): string
    {
        return $this->ShopID;
    }

    public function toArray(){
        $CGArray = new CGArray([]);
        $CGArray->Set("ItemID", $this->ItemID);
        $CGArray->Set("ShopID", $this->ShopID);
        $CGArray->Set("name", $this->name);
        $CGArray->Set("description", $this->description);
        $CGArray->Set("CoinType", $this->CoinType->value);
        $CGArray->Set("IMAGE_URL", $this->getIMAGEURL());
        $CGArray->Set("price", $this->price);
        $CGArray->Set("amount", $this->amount);
        $CGArray->Set("maxamount", $this->maxamount);
        $CGArray->Set("purchases_num", $this->purchases_num);
        $CGArray->Set("creatAt", $this->creatAt);
        $CGArray->Set("updateAt", $this->updateAt->getTimestamp());
        return $CGArray->toArray();
    }
}