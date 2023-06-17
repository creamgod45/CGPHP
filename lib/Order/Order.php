<?php

namespace Order;

use RuntimeException;

class Order
{
    public $OrderNumber;
    public $CustomerNumber;
    public $WaiterName;
    public $CustomerCount;
    public $TableNumber;

    /**
     * 資料庫引入
     * @param $OrderNumber
     * @param $CustomerNumber
     * @param $WaiterName
     * @param $CustomerCount
     * @param $TableNumber
     */
    public function __construct($OrderNumber, $CustomerNumber, $WaiterName, $CustomerCount, $TableNumber)
    {
        $this->OrderNumber = $OrderNumber;
        $this->CustomerNumber = $CustomerNumber;
        $this->WaiterName = $WaiterName;
        $this->CustomerCount = $CustomerCount;
        $this->TableNumber = $TableNumber;
    }

    /**
     * @return false|Customers|null
     */
    public function getCustomers()
    {
        return OrderManager::getCustomers(OrderManager::$ENUM_Customers_CustomersNumber, $this->CustomerNumber);
    }


    /**
     * @return false|OrderDetails|null
     */
    public function getOrderDetails()
    {
        return OrderManager::getOrderDetails(OrderManager::$ENUM_OrderDetails_OrderNumber, $this->OrderNumber);
    }

    /**
     * @return false|Employees|null
     */
    public function getEmployees()
    {
        return OrderManager::getEmployees(OrderManager::$ENUM_Employees_EmployeeName, $this->WaiterName);
    }

    /**
     * @return false|Seats|null
     */
    public function getSeat()
    {
        return OrderManager::getSeat(OrderManager::$ENUM_Seat_seat_id, $this->TableNumber);
    }

    /**
     * @return false|TransactionRecords|null
     */
    public function getTransactionRecords(){
        return OrderManager::getTransactionRecords(OrderManager::$ENUM_TransactionRecords_OrderNumber, $this->OrderNumber);
    }
}