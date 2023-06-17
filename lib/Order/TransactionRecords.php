<?php

namespace Order;

class TransactionRecords
{
    public $OrderNumber;
    public $OrderTime;
    public $TotalPrice;

    /**
     * @param $OrderNumber
     * @param $OrderTime
     * @param $TotalPrice
     */
    public function __construct($OrderNumber, $OrderTime, $TotalPrice)
    {
        $this->OrderNumber = $OrderNumber;
        $this->OrderTime = $OrderTime;
        $this->TotalPrice = $TotalPrice;
    }

}