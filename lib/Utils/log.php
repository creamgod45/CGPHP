<?php

namespace Utils;

use JetBrains\PhpStorm\Deprecated;
use Nette\Utils\FileSystem as fs;

#[Deprecated(
    reason: '套件已經不實用!! API過舊'
)]
/**
 * 本地、資料庫用途紀錄模型
 */
class log
{

    private $Utils;
    private $logHeader = []; // memory runtime source ip device type data
    private $logs = [];

    public function __construct()
    {
        $this->Utils = new Utils();
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function savelogsdb($Type, $Data, $Source, $IP, $Device)
    {
        $sql = "INSERT INTO `zfcr_log`( `Type`, `Data`, `Source`, `IP`, `Device`, `create_time`)";
        $arr = [
            ["VALUES ("],
            $Type,
            $Data,
            $Source,
            $IP,
            $Device,
            $this->Utils->timestamp(time()),
            [")"],
        ];
        return $this->Utils->mquery(['run', $sql, $arr]);
    }

    /**
     * [-1] : 檔案存在
     * [-2] : 檔案寫入失敗
     * @param $Type
     * @param $Data
     * @param $Source
     * @param $IP
     * @param $Device
     */
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function savelogsfile($Source, $PATH = "log")
    {
        $filename = PATH . "/" . $PATH . "/" . time() . "_" . $Source . ".log";
        if (!file_exists($filename)) {
            try {
                fs::write($filename, $this->toString());
                if (!empty(fs::read($filename))) {
                    return true;
                }
            } catch (RuntimeException $e) {
                return -2;
            }
        }
        return -1;
    }

    /**
     * @param bool $line
     * @return string
     */
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function toString(bool $line = true)
    {
        $str = "";
        foreach ($this->logHeader as $key => $value) {
            if ($line) {
                $str .= $key . " : " . $value . "\n";
            } else {
                $str .= $key . " : " . $value;
            }
        }
        foreach ($this->logs as $value) {
            if ($line) {
                $str .= "[" . $value[0] . "] " . $value[1] . " : " . $value[2] . "\n";
            } else {
                $str .= "[" . $value[0] . "] " . $value[1] . " : " . $value[2];
            }
        }
        return $str;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function getLogsWithMemberUUID($UUID, $option = "*")
    {
        $sql = "SELECT $option FROM `zfcr_log`";
        $arr = [
            ["WHERE `Type` = '0' && `Data` = "],
            $UUID
        ];
        return $this->Utils->mquery(['list', $sql, $arr]);
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function getlogsdb($ID, $option = "*")
    {
        $sql = "SELECT $option FROM `zfcr_log`";
        $arr = [
            ["WHERE `ID` = "],
            $ID
        ];
        return $this->Utils->mquery(['get', $sql, $arr]);
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function getlogsfile($filename)
    {
        if (!file_exists($filename)) {
            try {
                return fs::read($filename);
            } catch (RuntimeException $e) {
                return -2;
            }
        }
        return -1;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @return array
     */
    public function getLogs()
    {
        return $this->logs;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @param array $logs
     */
    public function setLogs(array $logs)
    {
        $this->logs = $logs;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function addLog($time, $type, $log)
    {
        $this->logs [] = [$time, $type, $log];
    }
}
