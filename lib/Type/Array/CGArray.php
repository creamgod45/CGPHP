<?php

namespace Type\Array;

require_once 'lib/Type/Array/CGArrayInterface.php';
require_once 'lib/Type/Array/CGPathInterface.php';
require_once 'lib/Type/Array/CGPath.php';

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
        return $arr;
    }

    public function getValues()
    {
        $arr = [];
        foreach ($this->array as $value) {
            $arr[] = $value;
        }
        return $arr;
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
        return new CGArray($this->array);
    }

    public function Remove($Index): void
    {
        array_splice($this->array, $Index, 1);
    }

    public function RemoveCallBack($Index): CGArray
    {
        array_splice($this->array, $Index, 1);
        return new CGArray($this->array);
    }

    public function IsEmpty(): bool
    {
        return empty($this->array);
    }

    public function IndexOf($Value): bool|int|string
    {
        return array_search($Value, $this->array, true);
    }

    public function Get($Index)
    {
        // TODO: Implement get() method.
        return $this->array[$Index];
    }

    public function Size(): int
    {
        // TODO: Implement size() method.
        return count($this->array);
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