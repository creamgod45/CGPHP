<?php

namespace Type\String;

use Type\Array\CGArray;

class CGString implements CGStringInterface
{
    protected string $string;

    public function __construct(string $string = '')
    {
        $this->string = $string;
    }

    public function isJson(): bool
    {
        @json_decode($this->string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function isEmpty(): bool
    {
        return empty($this->string);
    }

    public function Split(string $Prefix = ""): CGArray
    {
        if ($Prefix === "") {
            return new CGArray([]);
        }
        return new CGArray(explode($Prefix, $this->string));
    }

    public function Append(string $String = ""): CGString
    {
        $this->string = $String . $this->string;
        return new CGString($this->string);
    }

    public function length(): int
    {
        return mb_strlen($this->string);
    }

    public function toLowerCase(): CGString
    {
        $this->string = strtolower($this->string);
        return new CGString(strtolower($this->string));
    }

    public function toUpperCase(): CGString
    {
        $this->string = strtoupper($this->string);
        return new CGString(strtoupper($this->string));
    }

    public function StartWith($prefix): bool
    {
        return str_starts_with($this->string, $prefix);
    }

    public function IndexOf(string $Sting = ''): bool|int
    {
        return strpos($this->string, $Sting);
    }

    public function StartIndexOf(string $Sting = '', int $Index = 0): bool|int
    {
        return strpos($this->string, $Sting, $Index);
    }

    /**
     * 連續搜索 關鍵字位置
     * @param $search
     * @param $offset
     * @return false|CGArray
     */
    public function whileIndexOf($search = '@', $offset = 0)
    {
        if (empty($search)) return false;
        $positions = array();

        while (($pos = strpos($this->string, $search, $offset)) !== false) {
            $positions[] = $pos;
            $offset = $pos + 1;
        }

        return new CGArray($positions);
    }

    public function CharAt(int $Index = 0): CGString
    {
        return new CGString($this->Chunk()[$Index]);
    }

    public function Chunk(int $Length = 1): CGArray
    {
        return new CGArray(mb_str_split($this->string, $Length));
    }

    public function SubString(int $Index = 0): CGString
    {
        $this->string = substr($this->string, $Index);
        return new CGString(substr($this->string, $Index));
    }

    public function SubStringIndexEnd(int $Start = 0, int $End = 0): CGString
    {
        $this->string = substr($this->string, $Start, $End);
        return new CGString(substr($this->string, $Start, $End));
    }

    public function concat($mixed): CGString
    {
        if (is_array($mixed)) {
            $this->Prepend($this->arr_r($mixed));
        } else {
            $this->Prepend($mixed);
        }
        return new CGString($this->string);
    }

    public function Prepend(string $String = ''): CGString
    {
        $this->string .= $String;
        return new CGString($this->string);
    }

    private function arr_r($v): string
    {
        $string = '';
        foreach ($v as $key => $val) {
            if (is_array($val)) {
                $string .= $this->arr_r($val);
            } elseif ($key === count($v) - 1) {
                $string .= $key . " => " . $val;
            } else {
                $string .= $key . ' => ' . $val . ',';
            }
        }
        return $string;
    }

    public function trim(): CGString
    {
        return $this->Replace(" ");
    }

    public function Replace(string $OldString = '', string $NewString = ''): CGString
    {
        $this->string = str_replace($OldString, $NewString, $this->string);
        return new CGString(str_replace($OldString, $NewString, $this->string));
    }

    public function getString(): CGStringInterface|string
    {
        return new CGString($this->string);
    }

    public function setString(string|CGStringInterface $string): CGString
    {
        $this->string = $string;
        return new CGString($this->string);
    }

    public function Equals(CGStringInterface|string $String): bool
    {
        return $this->string === $String->toString();
    }

    public function toString(): string
    {
        return $this->string;
    }
}
