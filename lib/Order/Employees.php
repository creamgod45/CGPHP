<?php

namespace Order;

class Employees
{
    public $EmployeeName;
    public $ContactPhone;
    public $JobTitle;
    public $Salary;

    /**
     * 資料庫引入
     * @param $EmployeeName
     * @param $ContactPhone
     * @param $JobTitle
     * @param $Salary
     */
    public function __construct($EmployeeName, $ContactPhone, $JobTitle, $Salary)
    {
        $this->EmployeeName = $EmployeeName;
        $this->ContactPhone = $ContactPhone;
        $this->JobTitle = $JobTitle;
        $this->Salary = $Salary;
    }

}