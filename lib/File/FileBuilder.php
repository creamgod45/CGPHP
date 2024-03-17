<?php

namespace File;

use Utils\Utils;
use Exception;
use Nette\Utils\DateTime;
use Type\Array\CGArray;

class FileBuilder
{
    private Utils $Utils;
    private FileBase $fileBase;

    public function __construct()
    {
        $this->Utils = new Utils();
    }

    public function add($FilePath, $UID = null)
    {
        if (file_exists($FilePath)) {
            $FileNameWithExtensionArray = new CGArray($this->Utils->exp("/", $FilePath));
            $PathName = $FileNameWithExtensionArray->getLast();
            $tarray = (new CGArray($this->Utils->exp(".", $FileNameWithExtensionArray->getLast())));
            $FileExtension = $tarray->getLast();
            $FileName = $tarray->getFrist();
            try {
                $fileMIMEType = FileUtils::getFileMIMEType($FilePath);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            try {
                $this->fileBase = new FileBase(
                    md5($this->Utils->uid()),
                    $this->Utils->filecode($FilePath),
                    $FileName,
                    $FileExtension,
                    filesize($FilePath),
                    $FilePath,
                    $PathName,
                    $fileMIMEType,
                    $this->Utils->getInstanceAddress(true) . "/file/" . md5($this->Utils->uid()),
                    $UID,
                    time(),
                    DateTime::from(time())
                );
            } catch (Exception $e) {
                $this->Utils->v($e);
            }
        }
        return $this;
    }

    /**
     * @return FileBase
     */
    public function build()
    {
        return $this->fileBase;
    }
}