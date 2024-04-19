<?php

namespace Type\Array;

class HashMap
{
    private $map;

    public function __construct()
    {
        $this->map = array();
    }

    public function put($key, $value)
    {
        $this->map[$key] = $value;
    }

    public function get($key)
    {
        return isset($this->map[$key]) ? $this->map[$key] : null;
    }

    public function remove($key)
    {
        if (isset($this->map[$key])) {
            unset($this->map[$key]);
        }
    }

    public function containsKey($key)
    {
        return isset($this->map[$key]);
    }

    public function keys()
    {
        return array_keys($this->map);
    }

    public function values()
    {
        return array_values($this->map);
    }

    public function forEach($callback)
    {
        foreach ($this->map as $key => $value) {
            $callback($key, $value);
        }
    }
}

//// 创建一个 HashMap 对象
//$cityMap = new HashMap();
//
//// 添加城市数据到 HashMap
//$cityMap->put("NYC", "New York City");
//$cityMap->put("LA", "Los Angeles");
//$cityMap->put("SF", "San Francisco");
//
//// 遍历 HashMap 中的键值对
//$cityMap->forEach(function ($key, $value) {
//    echo "City: " . $value . " (Key: " . $key . ")<br>";
//});