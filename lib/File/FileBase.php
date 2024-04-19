<?php

namespace File;

use Nette\Utils\DateTime;

class FileBase
{
    use FileUtilsTrait;

    /**
     * File 唯一辨識碼
     * @var string
     */
    public string $fileID = '';
    /**
     * 檔案時間編碼
     * @var string
     */
    public string $fileCode = '';
    /**
     * 檔案名稱
     * @var string
     */
    public string $fileName;
    /**
     * 檔案名稱不包含副檔名
     * @var string
     */
    public string $fileExtension = '';
    /**
     * 檔案大小
     * @var int
     */
    public int $fileSize = 0;
    /**
     * 存放位置的完整路徑包含檔案名稱
     * $Path = $PathName + $FileName
     * @var string
     */
    public string $path = '';
    /**
     * 存放的路徑位置
     * @var string
     */
    public string $pathName = '';
    /**
     * 檔案 MIME 類型
     * @var array
     */
    public string $MIME = '';
    /**
     * 檔案 MIME 類型
     * @var string
     */
    public string $URL = "";
    /**
     * 會員上傳紀錄 UID
     * @var string|null
     */
    public ?string $UID = null;

    public int $creatAt;
    public DateTime $updateAt;

    /**
     * @param string $fileID
     * @param string $fileCode
     * @param string $fileName
     * @param string $fileExtension
     * @param int $fileSize
     * @param string $path
     * @param string $pathName
     * @param array|string $MIME
     * @param string $URL
     * @param string|null $UID
     * @param int $creatAt
     * @param DateTime $updateAt
     */
    public function __construct(string $fileID, string $fileCode, string $fileName, string $fileExtension, int $fileSize, string $path, string $pathName, string $MIME, string $URL, ?string $UID, int $creatAt, DateTime $updateAt)
    {
        $this->fileID = $fileID;
        $this->fileCode = $fileCode;
        $this->fileName = $fileName;
        $this->fileExtension = $fileExtension;
        $this->fileSize = $fileSize;
        $this->path = $path;
        $this->pathName = $pathName;
        $this->MIME = $MIME;
        $this->URL = $URL;
        $this->UID = $UID;
        $this->creatAt = $creatAt;
        $this->updateAt = $updateAt;
    }

    public function override(FileBase $fileBase): void
    {
        $this->fileID = $fileBase->fileID;
        $this->fileCode = $fileBase->fileCode;
        $this->fileName = $fileBase->fileName;
        $this->fileExtension = $fileBase->fileExtension;
        $this->fileSize = $fileBase->fileSize;
        $this->path = $fileBase->path;
        $this->pathName = $fileBase->pathName;
        $this->MIME = $fileBase->MIME;
        $this->URL = $fileBase->URL;
        $this->UID = $fileBase->UID;
        $this->creatAt = $fileBase->creatAt;
        $this->updateAt = $fileBase->updateAt;
    }

    public function isMemberFile(): bool
    {
        if ($this->UID === null) {
            return false;
        }
        if (empty($this->UID)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getFileID(): string
    {
        return $this->fileID;
    }

    /**
     * @return string
     */
    public function getFileCode(): string
    {
        return $this->fileCode;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getPathName(): string
    {
        return $this->pathName;
    }

    /**
     * @return string
     */
    public function getMIME(): string
    {
        return $this->MIME;
    }

    /**
     * @return string
     */
    public function getURL(): string
    {
        return $this->URL;
    }

    /**
     * @return string|null
     */
    public function getUID(): ?string
    {
        return $this->UID;
    }

    /**
     * @return int
     */
    public function getCreatAt(): int
    {
        return $this->creatAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdateAt(): DateTime
    {
        return $this->updateAt;
    }

}