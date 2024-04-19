<?php

namespace File;


use Exception;

class FileUtils
{
    public static function getFileType(string $Path = "")
    {
        $MIME = self::getFileMIMEType($Path);
        //if ($item === 'file') {
        switch ($MIME) {
            case 'application/zip':
            case 'application/vnd.rar':
            case 'application/x-7z-compressed':
            case 'application/gzip':
            case 'application/java-archive':
            case 'application/octet-stream':
            case 'application/x-tar':
            case 'application/x-bzip':
            case 'application/x-bzip2':
            case 'application/ogg':
                return FileType::File;
            case 'image/avif':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/png':
            case 'image/svg+xml':
            case 'image/webp':
            case 'image/bmp':
            case 'image/apng':
                return FileType::Image;
            case 'video/ogg':
            case 'video/mp4':
            case 'video/webm':
                return FileType::Video;
            case 'audio/aacp':
            case 'audio/mpeg':
            case 'audio/ogg':
            case 'audio/webm':
            case 'audio/wav':
            case 'audio/aac':
                return FileType::Sound;
            default:
                return FileType::Other;
        }
    }

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