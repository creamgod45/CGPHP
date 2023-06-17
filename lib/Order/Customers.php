<?php

namespace Order;

class Customers
{
    public $CustomerNumber;
    public $CustomerName;
    public $PhoneNumber;

    /**
     * 資料庫引入
     * @param $CustomerNumber
     * @param $CustomerName
     * @param $PhoneNumber
     */
    public function __construct($CustomerNumber, $CustomerName, $PhoneNumber)
    {
        $this->CustomerNumber = $CustomerNumber;
        $this->CustomerName = $CustomerName;
        $this->PhoneNumber = $PhoneNumber;
    }
}