<?php

use Nette\Database\Connection;

class Member
{
    protected int $id;
    protected string $uid;
    protected string $username;
    protected string $password;
    protected bool $administrator;
    protected bool $enable;
    protected string $createdAt;
    protected string $updatedAt;

    public int $ENUM_USE_UID = 0;
    public int $ENUM_USE_ID = 1;

    private $conn;

    public function __construct()
    {
        //$database = new Connection($dsn, $user, $password);
        $conn = new Connection("CGInventory", "root", "");

        $conn->connect();
    }

    public function AddMember($id, $username, $password, $administrator, $enable, $createdAt)
    {

    }

    public function RemoveMember($ENUM, $value)
    {
        switch ($ENUM){
            case $this->ENUM_USE_ID:
                break;
            case $this->ENUM_USE_UID:
                break;
            default:
                return "NOT SELECTED ENUM VALUE";
                break;
        }
    }
}

