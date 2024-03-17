<?php

namespace Shop;

use Utils\Utils;
use Nette\Utils\DateTime;

class ShopInvoice
{
    public string $ShopID = "";
    public string $InvoiceID = "";
    /**
     * @var ShopItem[]
     */
    public array $items = [];
    public CoinType $CoinType;
    public float $price = 0.0;
    public float $finalPrice = 0.0;
    public float $discount = 0.0;

    /**
     * @var ShopCoupon[]
     */
    public array $Coupons;
    public int $creatAt;
    public DateTime $updateAt;

    /**
     * @param string $ShopID
     * @param string $InvoiceID
     * @param ShopItem[] $items
     * @param CoinType $CoinType
     * @param float $price
     * @param float $finalPrice
     * @param float $discount
     * @param ShopCoupon[] $Coupons
     * @param int $creatAt
     * @param DateTime $updateAt
     */
    public function __construct(string $ShopID, string $InvoiceID, array $items, CoinType $CoinType, float $price, float $finalPrice, float $discount, array $Coupons, int $creatAt, DateTime $updateAt)
    {
        $this->ShopID = $ShopID;
        $this->InvoiceID = $InvoiceID;
        $this->items = $items;
        $this->CoinType = $CoinType;
        $this->price = $price;
        $this->finalPrice = $finalPrice;
        $this->discount = $discount;
        $this->Coupons = $Coupons;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
    }

    public function override(ShopInvoice $shopInvoice, bool $FullOverride = true)
    {
        if ($FullOverride) {
            $this->InvoiceID = $shopInvoice->InvoiceID;
        } else {
            $this->InvoiceID = md5((new Utils())->uid());
        }
        $this->ShopID = $shopInvoice->ShopID;
        $this->items = $shopInvoice->items;
        $this->CoinType = $shopInvoice->CoinType;
        $this->price = $shopInvoice->price;
        $this->finalPrice = $shopInvoice->finalPrice;
        $this->discount = $shopInvoice->discount;
        $this->Coupons = $shopInvoice->Coupons;
        $this->creatAt = $shopInvoice->creatAt;
        $this->updateAt = $shopInvoice->updateAt;
    }

    /**
     * @return string
     */
    public function getShopID(): string
    {
        return $this->ShopID;
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
    public function getInvoiceID(): string
    {
        return $this->InvoiceID;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getFinalPrice(): float
    {
        return $this->finalPrice;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @return ShopCoupon[]
     */
    public function getCoupons(): array
    {
        return $this->Coupons;
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
}