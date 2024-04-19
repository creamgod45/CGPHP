<?php

namespace Type\Array;

use Utils\Utils;

class CGArray implements CGArrayInterface
{
    protected array $array = [];

    public function __construct($array = [])
    {
        if (empty($array)) return false;
        $this->array = $array;
    }

    public function getKeys()
    {
        $arr = [];
        foreach ($this->array as $key => $value) {
            $arr[] = $key;
        }
        $this->array = $arr;
        return $this;
    }

    public function getValues()
    {
        $arr = [];
        foreach ($this->array as $value) {
            $arr[] = $value;
        }
        $this->array = $arr;
        return $this;
    }

    /**
     * 搬移陣列中的參數至新的參數
     */
    public function shiftKeytoNewKey($oldKey, $newKey,bool $deleteold=true){
        if($this->IsEmpty()) return false;
        $this->Set($newKey, $this->Get($oldKey));
        if($deleteold){
            $this->Delete($oldKey, true);
        }
    }

    public function Merge($string = "")
    {
        if (!empty($string)) {
            return implode($string, $this->array);
        }
        return implode($this->array);
    }

    public function getLast()
    {
        return $this->array[$this->Size() - 1];
    }

    public function getLastObject(){
        $k = 0;
        foreach ($this->array as $i=> $item) {
            if(count($this->array) === $k){
                return $item;
            }
            $k++;
        }
        return null;
    }

    public function splitLastObjectFromNumber($number=1){
        $k = 0;
        $count = $this->count();
        foreach ($this->array as $key => $item) {
            if($k>=$count-$number){
                $this->Delete($key);
            }
            $k++;
        }
        return $this;
    }

    public function count(): int
    {
        return count($this->array);
    }

    public function splitFirstObjectFromNumber($number=1){
        $k = 0;
        foreach ($this->array as $key => $item) {
            if($k<=$number){
                $this->Delete($key);
            }
            $k++;
        }
        return $this;
    }

    public function Size(): int
    {
        // TODO: Implement size() method.
        return count($this->array);
    }

    public function getFrist()
    {
        return $this->array[0];
    }

    public function getFirstObject(){
        foreach ($this->array as $item) {
            return $item;
        }
        return null;
    }

    public function Add($Mixed): void
    {
        $this->array[] = $Mixed;
    }

    public function Set($key, $Mixed): void
    {
        $this->array[$key] = $Mixed;
    }

    public function AddCallBack($Mixed): CGArray
    {
        $this->array[] = $Mixed;
        return $this;
    }

    public function Delete($Key, $force=false){
        if($force){
            unset($this->array[$Key]);
        }else{
            if(empty($this->array[$Key])) return;
            unset($this->array[$Key]);
        }
        return $this;
    }

    public function Remove($Index): void
    {
        array_splice($this->array, $Index, 1);
    }

    public function RemoveCallBack($Index): CGArray
    {
        array_splice($this->array, $Index, 1);
        return $this;
    }

    public function IsEmpty(): bool
    {
        return empty($this->array);
    }

    public function IndexOf($Value): bool|int|string
    {
        return array_search($Value, $this->array, true);
    }

    /**
     * @param $Index
     * @return bool|CGArray
     */
    public function GetValuetoCGArray($Index): bool|CGArray
    {
        if(!is_array($this->array[$Index])) return false;
        return new CGArray($this->array[$Index]);
    }

    public function Get($Index)
    {
        // TODO: Implement get() method.
        return $this->array[$Index];
    }
    public function hasKey($key){
        if(@empty($this->Get($key))){
            return false;
        }
        return true;
    }

    public function Contains($Mixed): bool
    {
        return in_array($Mixed, $this->array, true);
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * @param array $array
     */
    public function setArray(array $array): void
    {
        $this->array = $array;
    }

    public function toArray(): array
    {

        return $this->array;
    }

    public function toPath(): CGPath
    {
        return new CGPath($this->array);
    }

    public function resort()
    {
        $this->array = $this->array_resort($this->array);
        return $this;
    }

    public function array_resort(array $array, int $offset = -1, int $k = 0): array
    {
        $arr = [];
        foreach ($array as $key => $value) {
            if ($offset === (-1)) {
                $arr[$k] = $value;
                $k++;
            } else if ($k <= count($array) - $offset - 1) {
                $arr[$k] = $value;
                $k++;
            }
        }
        return $arr;
    }

    public function array_decode(array $array): string
    {
        $string = '';
        for ($i = 0; $i <= count($array) - 1; $i++) {
            if ($i !== 0) {
                $string .= '/';
            }
            for ($y = 0; $y <= count($array[$i]) - 1; $y++) {
                if ($y === count($array[$i]) - 1) {
                    $string .= $array[$i][$y];
                } else {
                    $string .= $array[$i][$y] . ':';
                }
            }
        }
        return $string;
    }

    public function array_encode(string $string): array
    {
        $array = [];
        $b = explode('/', $string);
        for ($i = 0; $i <= count($b) - 1; $i++) {
            $d = [];
            $c = explode(':', $b[$i]);
            for ($y = 0; $y <= count($c) - 1; $y++) {
                $d[$y] = $c[$y];
            }
            $array[$i] = $d;
        }

        return $array;
    }

    public function array_diffs(array $arr1, array $arr2, bool $result = false, bool $notfoundmsg = false)
    {
        $arr = [];
        foreach ($arr1 as $key => $value) {
            if (!empty($arr2[$key])) {
                if (@$arr1[$key] !== $arr2[$key]) {
                    $r = true;
                } else {
                    $r = false;
                }
                $arr[] = $r;
            }
            if ($notfoundmsg === true) {
                echo $key . ' 未找相關指標名稱。<br>';
            }

        }
        //if($e>0) return false;
        if ($result === true) {
            return $arr;
        }
        return true;
    }

    public function array_splice_key(array &$array, array $keyrows = null, bool $nametokey = false, bool $result = false, bool $keyint = false)
    {
        $arr = [];
        if ($keyrows !== null && is_array($keyrows)) {
            if ($nametokey === true) {
                $int_arr = $this->array_keytovalue($array);
                foreach ($keyrows as $k => $v) {
                    if ($result === true) {
                        $arr[] = $array[$int_arr[$v]];
                    }
                    unset($array[$int_arr[$v]]);
                }
            } else {
                foreach ($array as $key => $value) {
                    for ($i = 0; $i <= count($keyrows) - 1; $i++) {
                        if ($key === $keyrows[$i]) {
                            if ($result === true) {
                                $arr[] = $array[$key];
                            }
                            unset($array[$key]);
                        }
                    }
                }
            }
            if ($keyint === true) {
                $array = $this->array_resort($array);
            }
            if ($result === true) {
                return $arr;
            }
            return true;
        }

        return false;
    }

    public function array_keytovalue(array $array, bool $value = false, string $prefix = ':')
    {
        $arr = [];
        $k = 0;
        if (is_array($array)) {
            foreach ($array as $key => $v) {
                if ($value === true) {
                    $arr[$k] = $key . $prefix . $v;
                } else {
                    $arr[$k] = $key;
                }
                $k++;
            }
            return $arr;
        }
        return false;
    }
}
