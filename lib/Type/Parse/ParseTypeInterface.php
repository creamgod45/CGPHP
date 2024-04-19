<?php

namespace Type\Parse;

interface ParseTypeInterface
{
    public function toString();

    public function toCGString();

    public function toArray();

    public function toCGArray();

    public function toPath();

    public function toCGPath();

    public function toBoolean();

    public function toJSON();

    public function toObject();

    public function toInteger();

    public function toMap();
}