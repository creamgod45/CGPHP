<?php

namespace Order;

class Inventory
{
    public $MaterialName;
    public $StockQuantity;

    /**
     * 資料庫引入
     * @param $MaterialName
     * @param $StockQuantity
     */
    public function __construct($MaterialName, $StockQuantity)
    {
        $this->MaterialName = $MaterialName;
        $this->StockQuantity = $StockQuantity;
    }

}