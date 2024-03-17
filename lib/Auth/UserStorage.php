<?php

namespace Auth;

use Exception;
use Nette\Caching\Cache;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use Throwable;
use Type\Array\CGArray;
use Type\String\CGString;
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

    /**
     * @throws Throwable
     * @throws JsonException
     */
    public function getKeys($detail=false){
        if($detail){
            $load = $this->cache->load("UserStorage:keys");
            if (empty($load)) {
                return [];
            }$AES2 = new AES2($this->namespace);
            $json = $AES2->prepareReadMode($load);
            $arr = Json::decode($json, Json::FORCE_ARRAY);
            $tarr = [];
            foreach ($arr as $item) {
                @$tarr [$item] = $this->get($item);
            }
            return $tarr;
        }else{
            $load = $this->cache->load("UserStorage:keys");
            if (empty($load)) {
                return [];
            }
            $AES2 = new AES2($this->namespace);
            $json = $AES2->prepareReadMode($load);
            return Json::decode($json, Json::FORCE_ARRAY);
        }
    }

    public function remove($key){
        $keys = new CGArray($this->getKeys());
        if ($keys->Contains($key)) {
            $keys->Delete($key);
            $this->save("UserStorage:keys", Json::encode($keys));
        }
        $this->cache->remove($key);
    }

    public function removeAll(){
        $keys = $this->getKeys();
        foreach ($keys as $key){
            $this->remove($key);
        }
    }

    public function save($key, $value){
        $AES2 = new AES2($this->namespace);
        $currentTimestamp = time();
        $nextDayTimestamp = strtotime('tomorrow', $currentTimestamp);
        if(is_array($value)){
            try {
                $c = $AES2->prepareWriteMode(Json::encode($value, Json::ESCAPE_UNICODE));
            } catch (JsonException $e) {
                echo ($e->getMessage());
            }
            $this->cache->save($key, $c, [Cache::Expire => $nextDayTimestamp]);
            try {
                $keys = $this->getKeys();
                $CGArray = new CGArray($keys);
                if (!$CGArray->Contains($key)) {
                    $CGArray->Add($key);
                }
                $keys = $CGArray->toArray();
                $this->cache->save("UserStorage:keys", $AES2->prepareWriteMode(Json::encode($keys, Json::ESCAPE_UNICODE)));
            } catch (JsonException|Throwable $e) {
                echo ($e->getMessage());
            }
        }elseif(is_object($value)){
            $c = $AES2->prepareWriteMode(serialize($value));
            $this->cache->save($key, $c, [Cache::Expire => $nextDayTimestamp]);
            try {
                $keys = $this->getKeys();
                $CGArray = new CGArray($keys);
                if (!$CGArray->Contains($key)) {
                    $CGArray->Add($key);
                }
                $keys = $CGArray->toArray();
                $this->cache->save("UserStorage:keys", $AES2->prepareWriteMode(Json::encode($keys, Json::ESCAPE_UNICODE)));
            } catch (JsonException|Throwable $e) {
                echo ($e->getMessage());
            }
        }else {
            $c = $AES2->prepareWriteMode($value);
            $this->cache->save($key, $c, [Cache::Expire => $nextDayTimestamp]);
            try {
                $keys = $this->getKeys();
                $CGArray = new CGArray($keys);
                if (!$CGArray->Contains($key)) {
                    $CGArray->Add($key);
                }
                $keys = $CGArray->toArray();
                $this->cache->save("UserStorage:keys", $AES2->prepareWriteMode(Json::encode($keys, Json::ESCAPE_UNICODE)));
            } catch (JsonException|Throwable $e) {
                echo($e->getMessage());
            }
        }
    }

    /**
     * @param $key
     * @return false|mixed|string|null
     */
    public function get($key){
        try {
            $value = $this->cache->load($key);
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
        $AES2 = new AES2($this->namespace);
        if($value === null) {
            return false;
        }
        $o = $AES2->prepareReadMode($value);
        //(new Utils())->pinv($o);
        @$condition = unserialize($AES2->prepareReadMode($value));
        if($condition!==false && is_object($condition)){
            return $condition;
        }elseif((new CGString($o))->isJson()){
            try {
                return Json::decode($o, Json::FORCE_ARRAY);
            } catch (JsonException $e) {
                echo $e->getMessage();
            }
        }else{
            return $o;
        }
        return null;
    }

    public function getOrDefault($key, $default){
        $var = $this->get($key);
        if(empty($var))
            return $default;
        else
            return $var;
    }
}
