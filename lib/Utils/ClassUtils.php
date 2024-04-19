<?php

namespace Utils;

class ClassUtils
{
    public static function varName($v): array
    {
        $trace = debug_backtrace();
        $vLine = file(__FILE__);
        $fLine = $vLine[$trace[0]['line'] - 1];
        preg_match("#\\$(\w+)#", $fLine, $match);
        return $match;
    }
}
