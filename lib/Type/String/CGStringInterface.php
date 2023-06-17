<?php

namespace Type\String;

interface CGStringInterface
{
    public function Split(string $Prefix = '');

    public function Append(string $String = '');

    public function Prepend(string $String = '');

    public function Chunk(int $Length = 1);

    public function length();

    public function toLowerCase();

    public function toUpperCase();

    public function IndexOf(string $Sting = '');

    public function StartIndexOf(string $Sting = '', int $Index = 0);

    public function CharAt(int $Index = 0);

    public function SubString(int $Index = 0);

    public function SubStringIndexEnd(int $Start = 0, int $End = 0);

    public function Replace(string $OldString = '', string $NewString = '');

    public function concat(Mixed $mixed);

    public function trim();

    public function getString();

    public function setString(string|CGStringInterface $string);

    public function Equals(string|CGStringInterface $String);

    public function toString();
}