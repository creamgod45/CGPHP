<?php

namespace Type\String;

interface CGStringInterface
{
    public function Split(String $Prefix = '');

    public function Append(String $String = '');

    public function Prepend(String $String = '');

    public function Chunk(Int $Length = 1);

    public function length();

    public function toLowerCase();

    public function toUpperCase();

    public function IndexOf(String $Sting = '');

    public function StartIndexOf(String $Sting = '', Int $Index = 0);

    public function CharAt(Int $Index = 0);

    public function SubString(Int $Index = 0);

    public function SubStringIndexEnd(Int $Start=0, Int $End=0);

    public function Replace(String $OldString='', String $NewString='');

    public function concat(Mixed $mixed);

    public function trim();

    public function getString();

    public function setString(string|CGStringInterface $string);

    public function Equals(string|CGStringInterface $String);

    public function toString();
}