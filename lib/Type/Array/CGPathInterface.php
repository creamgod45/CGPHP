<?php

namespace Type\Array;

interface CGPathInterface
{
    public function getPath($Path, $Default);

    public function setPath($Path, $Value);

    public function delPath($Path);
}