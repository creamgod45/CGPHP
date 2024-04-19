<?php

namespace Server;

use Auth\UniqueVisiterID;
use Auth\UserStorage;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;

class Timeout
{
    public string $key;

    private UserStorage $us;

    public function __construct($key, $expired = 10)
    {
        $this->key = $key;
        $storage = new FileStorage('temp');
        $this->us = new UserStorage($storage, (new UniqueVisiterID())->getKey());

        if (!$this->us->hasData("TO_" . $this->key)) {
            $this->us->save("TO_" . $this->key, time() + $expired);
        }
    }

    public function getTimeout()
    {
        return  $this->us->get("TO_" . $this->key);
    }

    public function isTimeout()
    {
        if ($this->us->hasData("TO_" . $this->key)) {
            return $this->us->get("TO_" . $this->key) < time();
        }
        return false;
    }

    public function addTimeout($expired = 10)
    {
        $this->us->save("TO_" . $this->key, time() + $expired);
    }

}
