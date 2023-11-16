<?php


namespace Utils;

/**
 * DID 字典資料模型
 */
class DID
{
    private $utils;
    private $DID;
    private $DIDV;
    private $expire;

    public function __construct($DID = "", $expire = 86400, $init = true)
    {
        $this->utils = new utils();
        if ($init) {
            $this->init($DID, $expire);
        }
    }

    private function init($DID, $expire): void
    {
        $r = $this->getDataDictionary($DID);
        if ($r) {
            $obj = $this->getDataDictionary($DID);
            $this->DID = $DID;
            $this->DIDV = $obj["value"];
            $this->expire = $obj["expired_time"];
        } else {
            $r = $this->addDataDictionary($DID, $expire);
            if ($r) {
                $obj = $this->getDataDictionary($DID);
                $this->DID = $DID;
                $this->DIDV = $obj["value"];
                $this->expire = $obj["expired_time"];
            }
        }
    }

    public function getDataDictionary($DID)
    {
        if (empty($DID)) {
            return false;
        }
        $sql = "SELECT `value`,`expired_time` FROM `zfcr_datadictionary`";
        $arr = [
            ["WHERE `DID` = "],
            $DID
        ];
        $r = $this->utils->mquery(["get", $sql, $arr]);
        if ($r) {
            return $r;
        }
        return false;
    }

    public function addDataDictionary($DID, $expire = 86400)
    {
        if (empty($DID)) {
            return false;
        }
        $value = md5(uniqid('', true));
        $sql = "INSERT INTO `zfcr_datadictionary`(`DID`, `value`,`expired_time`)";
        $arr = [
            ["VALUES ("],
            $DID,
            $value,
            time() + $expire,
            [")"]
        ];
        $r = $this->utils->mquery(["run", $sql, $arr]);
        if ($r) {
            return $DID;
        }
        return false;
    }

    public function isDataDictionary($DID)
    {
        $r = $this->getDataDictionary($DID);
        if (!empty($r)) {
            return true;
        }
        return false;
    }

    public function setDataDictionary($DID, $post_arr = [])
    {
        if (empty($post_arr)) {
            return false;
        }

        $post_key = [];
        $post_value = [];
        // 限制修改 $key 存入 過濾 未改變 的資料列
        foreach ($post_arr as $key => $value) {
            switch ($key) {
                case "value":
                case "expired_time":
                    if (is_numeric($value)) {
                        $value = (int)$value;
                    }
                    $post_key [] = $key;
                    $post_value [] = $value;
                    continue 2;
            }
        }

        $sql = "UPDATE `zfcr_datadictionary`";
        $arr = [
            [$this->utils->MQUERY_SET, $post_key, $post_value],
            ["WHERE `DID` = "],
            $DID
        ];

        $r = $this->utils->mquery(["run", $sql, $arr]);
        if ($r) {
            return $r;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getDID()
    {
        return $this->DID;
    }

    /**
     * @param $DID
     */
    public function setDID($DID): void
    {
        $this->DID = $DID;
    }

    /**
     * @return mixed
     */
    public function getDIDV()
    {
        return $this->DIDV;
    }

    /**
     * @return mixed
     */
    public function getExpire(): mixed
    {
        return $this->expire;
    }

    /**
     * @param mixed $expire
     */
    public function setExpire(mixed $expire): void
    {
        $this->expire = $expire;
    }
}