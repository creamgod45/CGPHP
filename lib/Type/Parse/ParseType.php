<?php

namespace Type\Parse;

require_once "ParseTypeInterface.php";

use Type\Array\CGArray;
use Type\Array\CGPath;
use Type\String\CGString;

class ParseType implements ParseTypeInterface
{
    protected Mixed $mixed;

    public function __construct($Mixed)
    {
        $this->mixed = $Mixed;
    }

    public function toString()
    {
        return $this->mixed;
    }

    public function toCGString(): CGString
    {
        return new CGString($this->mixed);
    }

    public function toArray()
    {
        return $this->mixed;
    }

    public function toCGArray(): CGArray
    {
        return new CGArray($this->mixed);
    }

    public function toPath(): CGPath
    {
        return new CGPath($this->mixed);
    }

    public function toCGPath(): CGPath
    {
        return new CGPath($this->mixed);
    }

    public function toBoolean(): bool
    {
        return (boolean)$this->mixed;
    }

    public function toJSON()
    {
    }

    public function toObject()
    {
    }

    public function toInteger()
    {
    }

    public function toMap()
    {
    }
}
