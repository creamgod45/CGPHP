<?php

namespace Type\Array;

interface CGArrayInterface
{
    public function Add($Mixed);

    public function AddCallBack($Mixed);

    public function Remove($Index);

    public function RemoveCallBack($Index);

    public function IsEmpty();

    public function IndexOf($Value);

    public function Get($Index);

    public function Size();

    public function Contains($Mixed);

    public function getArray();

    public function setArray(array $array);

    public function toArray();

    public function toPath();

    public function array_resort(array $array, int $offset = -1, int $k = 0);
}