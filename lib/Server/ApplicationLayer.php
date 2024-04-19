<?php

namespace Server;

class ApplicationLayer
{
    public bool $cancelled;
    public array $handleList = array();

    public function __construct()
    {
        $this->cancelled = false;
    }

    public function getHandleList()
    {
        return $this->handleList;
    }

    public function run(): bool
    {
        if (empty($this->handleList)) {
            return true;
        }
        foreach ($this->handleList as $value) {
            if (!$value) {
                $this->cancelled = true;
                return false;
            }
        }
        return true;
    }

    public function register($Name, $object, $override = false): bool
    {
        if (!$override && empty($this->handleList[$Name])) {
            $this->handleList[$Name] = $object;
            return true;
        }
        return false;
    }

    public function unregister($Name): bool
    {
        if (isset($this->handleList[$Name])) {
            unset($this->handleList[$Name]);
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isCancelled(): bool
    {
        return $this->cancelled;
    }
}