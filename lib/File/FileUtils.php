<?php

namespace File;


use Exception;

class FileUtils
{
    /**
     * 取得檔案 MIME 類型
     * @param string $Path
     * @return string
     * @throws Exception
     */
    public static function getFileMIMEType(string $Path = ""): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (!$finfo) {
            throw new Exception("FileInfo Class Failed", 400);
        }

        $MIMEType = finfo_file($finfo, $Path);
        finfo_close($finfo);
        return $MIMEType;
    }
}