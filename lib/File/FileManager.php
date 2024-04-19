<?php

namespace File;

use Utils\Utils;
use Nette\Database\Connection;

class FileManager
{
    private static Connection $conn;
    private static bool $loaded = false;

    public function __construct()
    {
        $this->init();
    }

    public static function init()
    {
        self::setLoaded(true);
        self::$conn = \Utils\Connection::conn();
    }

    /**
     * @param bool $loaded
     */
    private static function setLoaded(bool $loaded): void
    {
        self::$loaded = $loaded;
    }

    /**
     * @return bool
     */
    private static function isLoaded(): bool
    {
        return self::$loaded;
    }

    /**
     * @return void
     */
    private static function firstConditionInit(): void
    {
        if (!self::isLoaded()) self::init();
    }


    /**
     * @param string $fileID
     * @return false|FileBase|null
     */
    public static function getFileBase(string $fileID)
    {
        self::firstConditionInit();
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
        self::firstConditionInit();
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
        self::firstConditionInit();
    }

    /**
     * @param FileBase[] $fileBases
     * @return void
     */
    public static function addFileBases(array $fileBases): void
    {
        self::firstConditionInit();
        foreach ($fileBases as $fileBase) {
            self::addFileBaseClass($fileBase);
        }
    }

    public static function addFileBaseClass(FileBase $fileBase)
    {
        self::firstConditionInit();
    }

    public static function delFileBase(string $fileID)
    {
        self::firstConditionInit();
        $string = "DELETE FROM `cgphp_filebase` WHERE `fileID` = ?";
        return self::$conn->query($string, $fileID);
    }
}
