<?php

namespace Shop;

class ShopManager
{
    public function __construct()
    {
        $this->init();
    }

    public function init(){}
    public static function getShop($ShopID){}
    public static function getShops(){}
    public static function addShop(){}
    public static function delShop($ShopID){}
    public static function updateShop($ShopID){}
    public static function toggleShop($ShopID){}
}