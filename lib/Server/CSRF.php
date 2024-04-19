<?php

namespace Server;

use Auth\UniqueVisiterID;
use Auth\UserStorage;
use Nette\Caching\Storages\FileStorage;

class CSRF
{
    public string $key;
    private $us;

    public function __construct($Key)
    {
        $this->key = $Key;
        $storage = new FileStorage('temp');
        $this->us = new UserStorage($storage, (new UniqueVisiterID())->getKey());
        if (!$this->us->hasData("CSRF_" . $this->key)) {
            $this->us->save("CSRF_" . $this->key, md5(uniqid("CSRF_")));
        }
    }

    public function getValue()
    {
        return $this->us->get("CSRF_" . $this->key);
    }

    public function equal($object): bool
    {
        return $this->us->get("CSRF_" . $this->key) === $object;
    }

    public function  remove(){
        $this->us->remove("CSRF_" . $this->key);
    }

    public function reset(): CSRF
    {
        $this->us->save("CSRF_" . $this->key, md5(uniqid("CSRF_")));
        return $this;
    }

}