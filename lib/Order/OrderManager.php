<?php

namespace Order;

use Nette\Database\Connection;
use Nette\Database\ResultSet;
use RuntimeException;

class OrderManager
{
    public static $ENUM_Order_OrderNumber = 0;
    public static $ENUM_Order_CustomerNumber = 1;
    public static $ENUM_Order_TableNumber = 2;
    public static $ENUM_Customers_CustomersNumber = 3;
    public static $ENUM_OrderDetails_OrderNumber = 4;
    public static $ENUM_Employees_EmployeeName = 5;
    public static $ENUM_Seat_seat_id = 6;
    public static $ENUM_TransactionRecords_OrderNumber = 7;
    public static $ENUM_Inventory_MaterialName = 8;
    public static $ENUM_Inventory_StockQuantity = 9;

    private static Connection $conn;

    public function __construct()
    {
        self::$conn = new Connection('mysql:host=127.0.0.1;dbname=topicdb', 'root', '12345678');
        self::$conn->connect();
    }

    private static function varName($v)
    {
        $trace = debug_backtrace();
        $vLine = file(__FILE__);
        $fLine = $vLine[$trace[0]['line'] - 1];
        preg_match("#\\$(\w+)#", $fLine, $match);
        print_r($match);
    }

    public static function addOrder($OrderNumber, $CustomerNumber, $WaiterName, $CustomerCount, $TableNumber): ResultSet
    {
        return self::$conn->query("INSERT INTO `orders` ?", [
            'OrderNumber' => $OrderNumber,
            'CustomerNumber' => $CustomerNumber,
            'WaiterName' => $WaiterName,
            'CustomerCount' => $CustomerCount,
            'TableNumber' => $TableNumber
        ]);
    }

    /**
     * 取得訂單資訊
     * 返回變數說明:
     *  false 查詢無資料
     *  Order 建構 Order 類別
     *  null $ENUM_Type 沒有選擇或是錯誤填入參數
     * @param $ENUM_Type
     * @param $value
     * @return false|Order|null
     * @throws RuntimeException
     */
    public static function getOrder($ENUM_Type, $value)
    {
        switch ($ENUM_Type) {
            case self::$ENUM_Order_OrderNumber:
                $string = 'SELECT * FROM orders WHERE `OrderNumber` = ?';
                break;
            case self::$ENUM_Order_CustomerNumber:
                $string = 'SELECT * FROM orders WHERE `CustomerNumber` = ?';
                break;
            case self::$ENUM_Order_TableNumber:
                $string = 'SELECT * FROM orders WHERE `TableNumber` = ?';
                break;
            default:
                return throw new RuntimeException('OrderManager#getOrder(' . self::varName($ENUM_Type) . ', ' . $value . '): NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new Order($row->OrderNumber, $row->CustomerNumber, $row->WaiterName, $row->CustomerCount, $row->TableNumber);
        else
            return false;
    }

    public static function addCustomers(int $CustomerNumber, string $CustomerName, $PhoneNumber): ResultSet
    {
        return self::$conn->query("INSERT INTO `customers` ?", [
            'CustomerNumber' => $CustomerNumber,
            'CustomerName' => $CustomerName,
            'PhoneNumber' => $PhoneNumber
        ]);
    }


    public static function getCustomers($ENUM_Type, $value)
    {
        switch ($ENUM_Type) {
            case self::$ENUM_Customers_CustomersNumber:
                $string = 'SELECT * FROM customers WHERE `CustomerNumber` = ?';
                break;
            default:
                return throw new RuntimeException('OrderManager#getCustomers(' . self::varName($ENUM_Type) . ', ' . $value . '): NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new Customers($row->CustomerNumber, $row->CustomerName, $row->PhoneNumber);
        else
            return false;
    }

    public static function addOrderDetails($OrderNumber, $IngredientName, $Quantity)
    {
        return self::$conn->query("INSERT INTO `orderdetails` ?", [
            'OrderNumber' => $OrderNumber,
            'IngredientName' => $IngredientName,
            'Quantity' => $Quantity
        ]);
    }

    public static function getOrderDetails($ENUM_Type, $value)
    {
        switch ($ENUM_Type) {
            case self::$ENUM_OrderDetails_OrderNumber:
                $string = 'SELECT * FROM orderdetails WHERE `OrderNumber` = ?';
                break;
            default:
                return throw new RuntimeException('OrderManager#getOrderDetails(' . self::varName($ENUM_Type) . ', ' . $value . '): NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new OrderDetails($row->OrderNumber, $row->IngredientName, $row->Quantity);
        else
            return false;
    }

    public static function addEmployees($EmployeeName, $ContactPhone, $JobTitle, $Salary)
    {
        return self::$conn->query("INSERT INTO `employees` ?", [
            'EmployeeName' => $EmployeeName,
            'ContactPhone' => $ContactPhone,
            'JobTitle' => $JobTitle,
            'Salary' => $Salary,
        ]);
    }

    public static function getEmployees($ENUM_Type, $value)
    {
        switch ($ENUM_Type) {
            case self::$ENUM_Employees_EmployeeName:
                $string = 'SELECT * FROM employees WHERE `EmployeeName` = ?';
                break;
            default:
                return throw new RuntimeException('OrderManager#getEmployees(' . self::varName($ENUM_Type) . ', ' . $value . '): NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new Employees($row->EmployeeName, $row->ContactPhone, $row->JobTitle, $row->Salary);
        else
            return false;
    }

    public static function addSeat($seat_id, $table_size, $floor_number, $dining_time_minutes)
    {
        return self::$conn->query("INSERT INTO `seats` ?", [
            'seat_id' => $seat_id,
            'table_size' => $table_size,
            'floor_number' => $floor_number,
            'dining_time_minutes' => $dining_time_minutes,
        ]);
    }

    public static function getSeat($ENUM_Type, ...$value)
    {
        switch ($ENUM_Type) {
            case self::$ENUM_Seat_seat_id:
                $string = 'SELECT * FROM seats WHERE `seat_id` = ?';
                break;
            default:
                return throw new RuntimeException('OrderManager#getSeat(' . self::varName($ENUM_Type) . ', ' . $value . '): NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new Seats($row->seat_id, $row->table_size, $row->floor_number, $row->dining_time_minutes);
        else
            return false;
    }

    public static function addInventory($MaterialName, $StockQuantity)
    {
        return self::$conn->query("INSERT INTO `inventory` ?", [
            'MaterialName' => $MaterialName,
            'StockQuantity' => $StockQuantity
        ]);
    }

    public static function getInventory($ENUM_Type, ...$value)
    {
        switch ($ENUM_Type) {
            case self::$ENUM_Inventory_MaterialName:
                $string = 'SELECT * FROM inventory WHERE `MaterialName` = ?';
                break;
            case self::$ENUM_Inventory_StockQuantity:
                $string = 'SELECT * FROM inventory WHERE `StockQuantity` = ?';
                break;
            default:
                return throw new RuntimeException('OrderManager#getInventory(' . self::varName($ENUM_Type) . ', ' . $value . '): NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new Inventory($row->MaterialName, $row->StockQuantity);
        else
            return false;
    }

    public static function addTransactionRecords($OrderNumber, $OrderTime, $TotalPrice)
    {
        return self::$conn->query("INSERT INTO `transactionrecords` ?", [
            'OrderNumber' => $OrderNumber,
            'OrderTime' => $OrderTime,
            'TotalPrice' => $TotalPrice,
        ]);
    }

    public static function getTransactionRecords($ENUM_Type, $value)
    {
        switch ($ENUM_Type) {
            case self::$ENUM_TransactionRecords_OrderNumber:
                $string = 'SELECT * FROM transactionrecords WHERE `OrderNumber` = ?';
                break;
            default:
                return throw new RuntimeException('OrderManager#getInventory(' . self::varName($ENUM_Type) . ', ' . $value . '): NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return null;
        if ($row->count() > 0)
            return new TransactionRecords($row->OrderNumber, $row->OrderTime, $row->TotalPrice);
        else
            return false;
    }
}