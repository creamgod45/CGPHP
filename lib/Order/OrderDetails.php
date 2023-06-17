<?php

namespace Order;

class OrderDetails
{
    public $OrderNumber;
    public $IngredientName;
    public $Quantity;

    /**
     * 資料庫引入
     * @param $OrderNumber
     * @param $IngredientName
     * @param $Quantity
     */
    public function __construct($OrderNumber, $IngredientName, $Quantity)
    {
        $this->OrderNumber = $OrderNumber;
        $this->IngredientName = $IngredientName;
        $this->Quantity = $Quantity;
    }

    /**
     * @return false|Inventory|null
     */
    public function getInventory()
    {
        return OrderManager::getInventory(OrderManager::$ENUM_Inventory_MaterialName, $this->IngredientName);
    }
}