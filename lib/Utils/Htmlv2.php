<?php

namespace Utils;

use Type\Array\CGArray;

class Htmlv2 extends HTML
{
    private HTML $HTML;
    private string $html = "";
    private CGArray $array;
    private mixed $newline = "";


    public function __construct($tag)
    {
        $this->array = new CGArray([]);
        $this->HTML = new HTML();
        $this->tagname($tag);
        return $this;
    }

    public function tagname($tag)
    {
        $this->getarray()->Set("tagname", $tag);
        return $this;
    }

    private function getarray()
    {
        return $this->array;
    }

    public function load($array)
    {
        $this->getarray()->setArray($array);
        return $this;
    }

    public function body($mixed)
    {
        @$body = $this->getarray()->getArray()["body"];
        if (@!empty($body)) {
            if (is_array($body)) {
                $arr = $body;
                foreach ($mixed as $key => $value) {
                    $arr[] = $value;
                }
                $this->getarray()->Set("body", $arr);
            } else {
                if (is_array($mixed)) {
                    $mixed [] = $this->HTML()->html_Builder([
                        "tagname" => "span",
                        "config" => [
                            "config.colse" => true,
                        ],
                        "body" => $body
                    ]);
                    $this->getarray()->Set("body", $mixed);
                } else {
                    $this->getarray()->Set("body", $body .= $mixed);
                }
            }
        } else {
            $this->getarray()->Set("body", $mixed);
        }
        return $this;
    }

    private function HTML(): HTML
    {
        return $this->HTML;
    }

    public function close($bool)
    {
        @$config = $this->getarray()->getArray()["config"];
        if (@!empty($config)) {
            $config ["config.close"] = $bool;
            $this->getarray()->Set("config", $config);
        } else {
            $this->getarray()->Set("config", ["config.close" => $bool]);
        }
        return $this;
    }

    public function attr(string $name, $value)
    {
        if($name==="") return $this;
        @$config = $this->getarray()->getArray()["config"];
        if (@!empty($config)) {
            if (is_array($value)) {

                foreach ($value as $i => $v) {
                    $config[$name][] = $v;
                }
            } else {
                if (!isset($config[$name])) {
                    $config[$name] = $value;
                } elseif (is_string($config[$name])) {
                    $temp = $config[$name];
                    $config[$name] = [];
                    $config[$name][] = $temp;
                    $config[$name][] = $value;
                } else {
                    $config[$name][] = $value;
                }
            }
            $this->getarray()->Set("config", $config);
        } else {
            $this->getarray()->Set("config", [$name => $value]);
        }
        return $this;
    }

    public function newLine(bool $bool)
    {
        if ($bool)
            $this->newline = PHP_EOL;
        else
            $this->newline = "";
        return $this;
    }

    public function build()
    {
        return $this->HTML->html_Builder($this->array->toArray()) . $this->newline;
    }
}
