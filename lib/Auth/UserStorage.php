<?php

namespace Auth;

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

    /**
     * @throws JsonException
     */
    public function save($key, $value){
        $AES2 = new AES2($this->namespace);
        if(is_array($value)){
            $c = $AES2->prepareWriteMode(Json::encode($value, Json::ESCAPE_UNICODE));
            $this->cache->save($key, $c, [Cache::Expire => '10 minutes']);
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
            $this->cache->save($key, $c, [Cache::Expire => '10 minutes']);
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
            $this->cache->save($key, $c, [Cache::Expire => '10 minutes']);
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
     * @throws Throwable
     * @throws JsonException
     */
    public function get($key){
        $value = $this->cache->load($key);
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
            return Json::decode($o, Json::FORCE_ARRAY);
        }else{
            return $o;
        }
    }
}