<?php

namespace Shop;

use Auth\Member;
use Nette\Utils\DateTime;
use Utils\Utils;

class ShopCoupon
{
    public string $CouponID = "";
    public string $Code = "";
    public string $name = "";
    public string $description = "";
    public DiscountedType $discountedType;
    public float $discountedPrice = 0.0;
    /**
     * @var Member[]
     */
    public array $allowUsers = [];
    /**
     * @var ShopItem[]
     */
    public array $allowItems = [];
    public float $minPrice = 0.0;
    public float $maxPrice = 0.0;
    public bool $enable = true;
    public int $creatAt;
    public DateTime $updateAt;

    /**
     * @param string $CouponID
     * @param string $Code
     * @param string $name
     * @param string $description
     * @param DiscountedType $discountedType
     * @param float $discountedPrice
     * @param Member[] $allowUsers
     * @param ShopItem[] $allowItems
     * @param float $minPrice
     * @param float $maxPrice
     * @param bool $enable
     * @param int $creatAt
     * @param DateTime $updateAt
     */
    public function __construct(string $CouponID, string $Code, string $name, string $description, DiscountedType $discountedType, float $discountedPrice, array $allowUsers, array $allowItems, float $minPrice, float $maxPrice, bool $enable, int $creatAt, DateTime $updateAt)
    {
        $this->CouponID = $CouponID;
        $this->Code = $Code;
        $this->name = $name;
        $this->description = $description;
        $this->discountedType = $discountedType;
        $this->discountedPrice = $discountedPrice;
        $this->allowUsers = $allowUsers;
        $this->allowItems = $allowItems;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->enable = $enable;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
    }

    /**
     * @return string
     */
    public function getCouponID(): string
    {
        return $this->CouponID;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->Code;
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
    public function getDiscountedPrice(): float
    {
        return $this->discountedPrice;
    }

    /**
     * @return array
     */
    public function getAllowUsers(): array
    {
        return $this->allowUsers;
    }

    /**
     * @return array
     */
    public function getAllowItems(): array
    {
        return $this->allowItems;
    }

    /**
     * @return float
     */
    public function getMinPrice(): float
    {
        return $this->minPrice;
    }

    /**
     * @return float
     */
    public function getMaxPrice(): float
    {
        return $this->maxPrice;
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

    public function override(ShopCoupon $shopCoupon, bool $FullOverride = true)
    {
        if ($FullOverride) {
            $this->ItemID = $shopCoupon->CouponID;
        } else {
            $this->CouponID = md5((new Utils())->uid());
        }
        $this->Code = $shopCoupon->Code;
        $this->name = $shopCoupon->name;
        $this->description = $shopCoupon->description;
        $this->discountedPrice = $shopCoupon->discountedPrice;
        $this->allowUsers = $shopCoupon->allowUsers;
        $this->allowItems = $shopCoupon->allowItems;
        $this->minPrice = $shopCoupon->minPrice;
        $this->maxPrice = $shopCoupon->maxPrice;
        $this->enable = $shopCoupon->enable;
        $this->creatAt = $shopCoupon->creatAt;
        $this->updateAt = $shopCoupon->updateAt;
    }
}