<?php

namespace Auth;


class Member
{

    protected int $id;
    protected string $uid;
    protected string $username;
    protected string $password;
    protected string $email;
    protected bool $administrator;
    protected bool $enable;
    protected string $createdAt;
    protected \Nette\Utils\DateTime $updatedAt;
    private bool $isInitialized = false;

    public function __construct($list = [])
    {
        if (!empty($list)) {
            [$this->id, $this->uid, $this->username, $this->password, $this->email, $this->administrator, $this->enable, $this->createdAt, $this->updatedAt] = $list;
            $this->isInitialized = true;
        }
    }

    /**
     * @return bool
     */
    public function isInitialized(): bool
    {
        return $this->isInitialized;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->administrator;
    }

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /*public function toCGConverter(){
        $prev_function = debug_backtrace()[1]['function'];
        switch ($prev_function){
            case "getId":
            case "isAdministrator":
            case "isEnable":
                throw new RuntimeException('Unable to use converter!!');
            case 'getUsername':
                return new CGString($this->getUsername());
            case 'getEmail':
                return new CGString($this->getEmail());
            case 'getPassword':
                return new CGString($this->getPassword());
            case 'getCreatedAt':
                return new CGString($this->getCreatedAt());
        }
        return false;
    }*/
}

