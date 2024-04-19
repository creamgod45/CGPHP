<?php

namespace Shop;

use Nette\Utils\DateTime;

class Statistics
{
    private array $nodes=[];
    private string $title="";
    private string $descrtion="";
    private int $creatAt;
    private DateTime $updateAt;
    public function addNode($classname, ...$val)
    {
        $r = new $classname(...$val);
        $nodes [] = $r;
        return $r;
    }

}
