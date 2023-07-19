<?php

namespace File;

class FileManager
{

    public function __construct()
    {
        $this->init();
    }

    public static function init(){}
    public static function getFileBase(string $fileID){}
    public static function getFileBases(){}

    public static function addFileBaseClass(FileBase $fileBase){}
    public static function addFileBase(string $fileID, string $fileCode, string $fileName, string $fileExtension, int $fileSize, string $path, string $pathName, string $MIME, string $URL, ?string $UID, int $creatAt){}

    /**
     * @param FileBase[] $fileBases
     * @return void
     */
    public static function addFileBases(array $fileBases): void
    {
        foreach ($fileBases as $fileBase) {
            self::addFileBaseClass($fileBase);
        }
    }
    public static function delFileBase(string $fileID){}
    public static function updateFileBase(){}
}