<?php

namespace Server\File;

use Nette\Utils\FileSystem;

class FilesWrapper
{
    private $pointer;
    /**
     * @var FileStructure[] $array
     */
    private array $array=[];

    public function __construct($fileArray)
    {
        $this->init($fileArray);
    }

    public function init($fileArray): void
    {
        if(empty($fileArray)) return;
        $keys=["name", "full_path", "type", "tmp_name", "error", "size"];
        //var_dump($fileArray);
        //FileSystem::write("log/".time()."_filelog.json", json_encode($fileArray, JSON_PRETTY_PRINT| JSON_UNESCAPED_UNICODE));
        $a = count($fileArray[$keys[0]]);
        for ($j = 0; $j < $a; $j++) {
            $name = $fileArray[$keys[0]][$j];
            $full_path = $fileArray[$keys[1]][$j];
            $type = $fileArray[$keys[2]][$j];
            $tmp_name = $fileArray[$keys[3]][$j];
            $error = $fileArray[$keys[4]][$j];
            $size = $fileArray[$keys[5]][$j];
            $this->array [] = new FileStructure($name, $full_path, $type, $tmp_name, $error, $size);
        }
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }
    public function hasNext(){}
    public function getItem(){}
}
