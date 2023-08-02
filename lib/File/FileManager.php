<?php

namespace File;

use Nette\Database\Connection;
use Utils\Utils;

class FileManager
{
    private static Connection $conn;

    public function __construct()
    {
        $this->init();
    }

    public static function init()
    {
        self::$conn = new Connection('mysql:host=127.0.0.1;dbname=', '', '');
        self::$conn->connect();
    }

    /**
     * @param string $fileID
     * @return false|FileBase|null
     */
    public static function getFileBase(string $fileID)
    {
        $string = 'SELECT * FROM `cgphp_filebase` WHERE `fileID` = ?';
        $row = self::$conn->fetch($string, $fileID);
        if ($row === null)
            return null;
        if ($row->count() > 0) {
            $uid = (new Utils())->default($row->UID, null);
            return new FileBase(
                $row->fileID,
                $row->filecode,
                $row->fileName,
                $row->fileExtension,
                $row->fileSize,
                $row->path,
                $row->pathName,
                $row->MIME,
                $row->URL,
                $uid,
                $row->creatAt,
                $row->updateAt
            );
        } else return false;
    }

    /**
     * @return FileBase[]
     */
    public static function getFileBases()
    {
        $string = 'SELECT * FROM `cgphp_filebase`';
        $rows = self::$conn->fetchAll($string);
        $array = [];
        $k = 0;
        foreach ($rows as $row) {
            $uid = (new Utils())->default($row->UID, null);
            $array[$k++] = new FileBase(
                $row->fileID,
                $row->filecode,
                $row->fileName,
                $row->fileExtension,
                $row->fileSize,
                $row->path,
                $row->pathName,
                $row->MIME,
                $row->URL,
                $uid,
                $row->creatAt,
                $row->updateAt
            );
        }
        return $array;
    }

    public static function addFileBase(string $fileID, string $fileCode, string $fileName, string $fileExtension, int $fileSize, string $path, string $pathName, string $MIME, string $URL, ?string $UID, int $creatAt)
    {
    }

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

    public static function addFileBaseClass(FileBase $fileBase)
    {
    }

    public static function delFileBase(string $fileID)
    {
        $string = "DELETE FROM `cgphp_filebase` WHERE `fileID` = ?";
        return self::$conn->query($string, $fileID);
    }
}