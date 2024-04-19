<?php

namespace Type\String;

use chatroom\ChatMessages;
use chatroom\Chatroom;
use ReflectionClass;
use Type\Array\CGArray;

enum ClassAccess: string
{
    case pub = "public";
    case pri = "private";
    case pro = "protected";
}

class Stringable
{
    private object $classname;
    private array $array = [];

    public function __construct($classname)
    {
        $this->classname=$classname;
        if (is_object($classname)) {
            try {
                $reflectionClass = new ReflectionClass($classname);
                foreach ($reflectionClass->getProperties() as $property) {
                    $access = "";
                    if($property->isPrivate()) {
                        $access= ClassAccess::pri;
                    }
                    if($property->isPublic()) {
                        $access= ClassAccess::pub;
                    }
                    if($property->isProtected()) {
                        $access= ClassAccess::pro;
                    }
                    $r=null;
                    $r = $property->getValue();
                    $this->addParameter($property->getName(), $r, $access);
                }
                foreach ($reflectionClass->getMethods() as $method) {
                    $access = "";
                    if($method->isPrivate()) {
                        $access= ClassAccess::pri;
                    }
                    if($method->isPublic()) {
                        $access= ClassAccess::pub;
                    }
                    if($method->isProtected()) {
                        $access= ClassAccess::pro;
                    }
                    $this->addMethod($method->getName(),$access);
                }
            } catch (\ReflectionException $e) {
            }
        }
    }

    public function addParameter($name, $value, ClassAccess $access = ClassAccess::pub)
    {
        $r=null;
        if($value instanceof CGArray){
            $r= var_export($value->toArray(),true);
        }elseif($value instanceof Chatroom){
            $r = var_export($value->toArray(),true);
        }elseif($value instanceof ChatMessages){
            $r = var_export($value->toArray(),true);
        }elseif (is_object($value)){
            $r=serialize($value);
        }elseif(is_array($value)){
            $r=var_export($value,true);
        }else{
            $r=$value;
        }
        $this->array[] = ["var",$access->value, $name, $r];
    }

    public function addMethod($name, ClassAccess $access = ClassAccess::pub)
    {
        $this->array[] = ["fun",$access->value,$name];
    }

    public function toString($var=0){
        $r = $this->classname::class."{".PHP_EOL;
        foreach ($this->array as $k=>$v) {
            if($var===0 || $var===2){
                if($v[0]==="var"){
                    $r .= "  ".$v[1]." $".$v[2]." ".$v[3].",".PHP_EOL;
                }
            }
            if($var===1 || $var===2){
                if($v[0]==="fun" && count($this->array) >= $k){
                    $r .= "  ".$v[1]." ".$v[2]."(),".PHP_EOL;
                }
            }
        }
        $r.="}";
        return $r;
    }
    public function __toString(): string
    {
        return "Stringable{array:".var_export($this->array, true)."}";
    }
}
