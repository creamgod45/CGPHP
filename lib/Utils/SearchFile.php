<?php

namespace Utils;

use Nette\Utils\FileSystem as FS;
use Nette\Utils\Finder;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

// filename time type
class SearchFile
{
    private $AES;

    private $utils;

    private $data;
    private $total;

    public function __construct()
    {
        $this->utils = new utils();
        $this->AES = new AES();
        if (!file_exists('cache.bin')) {
            FS::write('cache.bin', '');
        }
        if (!file_exists('cache2.bin')) {
            FS::write('cache2.bin', '');
        } else {
            $this->total = (int)FS::read("cache2.bin");
        }
    }

    public function isFilesArrayDiff()
    {
        $temp = new SearchFile();
        $searchFile = $this->getCache()->getData();
        $data = $temp->scanFiles()->getCache()->getData();
        $diff = false;
        foreach ($data as $index => $datum) {
            foreach ($datum as $key => $val) {
                if ($val !== $searchFile[$index][$key]) {
                    $diff = true;
                    break 2;
                }
            }
        }
        unset($temp);
        if (!$diff) {
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getCache()
    {
        $read = FS::read('cache.bin');

        try {
            $this->data = Json::decode($this->AES->prepareReadMode($read), Json::FORCE_ARRAY | Json::ESCAPE_UNICODE);
        } catch (JsonException $e) {
        }
        $this->total = count($this->data);
        return $this;
    }

    public function scanFiles()
    {
        $arr = [];
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('gallery-images')) as $Path) {
            if ($Path->isDir()) continue;
            if (basename($Path) === 'index.php') continue;

            $string_dot_array = explode('.', $Path);
            $filesize = filesize($Path);
            $filetime = filectime($Path);
            $FileName = basename($Path);
            $PathName = str_replace($FileName, '', $Path);
            $str = explode('_', $FileName);
            @$FileNameNoSub = explode('.', $str[1]);
            $FileNameFake = base64_decode($FileNameNoSub[0]);
            if (base64_decode($FileNameNoSub[0])) {
                $FileNameFake = base64_decode($FileNameNoSub[0]);
            } else {
                $FileNameFake = $FileName;
            }

            $filetype = $this->getFileMIMEType($Path);

            $arr[] = [
                'time' => $this->utils->timestamp($filetime),
                'filename' => $FileName,
                'real_filename' => $FileNameFake,
                'real_filename1' => $FileNameFake,
                'type' => $filetype
            ];
        }
        $this->data = $arr;
        $this->total = count($arr);
        return $this;
    }

    function getFileMIMEType(string $Path = ''): string
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $MIMEType = finfo_file($finfo, $Path);
        finfo_close($finfo);
        return $MIMEType;
    }

    public function isFilesTotalChanged()
    {
        $i = 0;
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('gallery-images')) as $Path) {
            if ($Path->isDir()) continue;
            if (basename($Path) === 'index.php') continue;
            $i++;
        }

        $total = $this->getTotal();

        return $i !== $total;
    }

    public function getTotal()
    {
        $this->total = (int)FS::read('cache2.bin');
        return $this->total;
    }

    public function searchFiles($file_to_search = '', $dir = '.')
    {
        if (Finder::findFiles($file_to_search)->from($dir) === null) {
            return false;
        }
        return Finder::findFiles($file_to_search)->from($dir);
    }

    public function saveCache()
    {
        try {
            $prepareWriteMode = $this->AES->prepareWriteMode(Json::encode($this->data, Json::ESCAPE_UNICODE));
        } catch (JsonException $e) {
        }
        FS::write('cache.bin', $prepareWriteMode);
        return $this;
    }

    public function saveTotal()
    {
        FS::write('cache2.bin', $this->total);
        return $this;
    }


}