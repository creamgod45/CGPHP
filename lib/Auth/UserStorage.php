<?php

namespace Auth;

use Nette\Caching\Cache;
use Throwable;
use Utils\AES2;
use Utils\Utils;

class UserStorage
{
    private $storage;
    private $namespace="";
    private $cache;
    public function __construct($storage, $key)
    {
        $this->namespace=$key;
        $this->cache = new Cache($storage, $key);
        $this->storage = $storage;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasData($key){
        try {
            $value = $this->cache->load($key);
            if(empty($value)) return false;
        } catch (Throwable $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function remove($key){
        $this->cache->remove($key);
    }

    public function save($key, $value, $dep=[Cache::Expire => '10 minutes']){
        $AES2 = new AES2($this->namespace);
        $c = $AES2->prepareWriteMode($value);
        $this->cache->save($key, $c,$dep);
    }

    public function get($key){
        $value = $this->cache->load($key);
        $AES2 = new AES2($this->namespace);
        $c = $AES2->prepareReadMode($value);
        return $c;
    }
}