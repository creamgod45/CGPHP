<?php

namespace Utils;

date_default_timezone_set("Asia/Taipei");

if (f1(true, true)[0] === "https://") {
    include_once "/home/vulsdril/chat.zeitfrei.tw/PATH.php";
} else {
    include_once "C:/xampp/htdocs/PATH.php";
}

require_once "utils.php";
require_once "AES.php";

use JetBrains\PhpStorm\Deprecated;

#[Deprecated(
    reason: '套件已經不實用!! API過舊'
)]
class API
{
    public $UUID;
    public $Utils;
    public $AES;
    public $httpVersion = "HTTP/1.1"; // Discord_register
    private $APIName; // Device IP Header More
    private $APIINFO;

    public function __construct($APIName = "", $APIINFO = [])
    {
        $this->Utils = new Utils();
        $this->AES = new AES("AES_API", -1);
        $this->APIName = $APIName;
        $this->APIINFO = $APIINFO;
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function json_build_response($code, $result, $nocode = false): bool|string
    {
        $this->setHttpHeaders("application/json", $code);
        if ($nocode) {
            $data = ["result" => $result];
            return json_encode($data, JSON_UNESCAPED_UNICODE);

        }
        if (!empty($code) && !empty($result)) {
            $data = ["code" => $code, "message" => $this->getHttpStatusMessage($code)];
            $data = array_merge($data, $result);
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if ($code) {
            $data = ["code" => $code, "message" => $this->getHttpStatusMessage($code)];
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if (empty($result)) {
            $data = ["code" => 204, "message" => $this->getHttpStatusMessage(204)];
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function setHttpHeaders($contentType, $statusCode): void
    {

        $statusMessage = $this->getHttpStatusMessage($statusCode);

        header($this->httpVersion . " " . $statusCode . " " . $statusMessage);
        header("Content-Type:" . $contentType);
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function getHttpStatusMessage($statusCode)
    {
        if ($statusCode === null) return;
        $httpStatus = array(
            3 => "Data source empty",
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported');
        return @($httpStatus[$statusCode]) ?: $httpStatus[500];
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @return mixed|string
     */
    public function getAPIName(): mixed
    {
        return $this->APIName;
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @param mixed|string $APIName
     */
    public function setAPIName(mixed $APIName): void
    {
        $this->APIName = $APIName;
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @return mixed
     */
    public function getAPIINFO()
    {
        return $this->APIINFO;
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @param mixed $APIINFO
     */
    public function setAPIINFO($APIINFO): void
    {
        $this->APIINFO = $APIINFO;
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function isExpiredAPIRequest($apikey, $result = false)
    {
        $sql = "SELECT `expired_time`,`OutData` FROM `zfcr_api`";
        $arr = [
            [" WHERE `apikey` = "],
            $apikey
        ];

        $r = $this->Utils->mquery(['get', $sql, $arr]);
        if ($r["expired_time"] > time()) {
            if ($result) {
                return $r;
            } else {
                return true;
            }
        }
        return false;
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function getAPIRequest($access_token, $option = "*")
    {
        $sql = "SELECT $option FROM `zfcr_api`";
        $arr = [
            [" WHERE `access_token` = "],
            $access_token
        ];
        $r = $this->Utils->mquery(['get', $sql, $arr]);
        return $r;
    }

    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    public function addAPIRequest($input = [])
    {
        list($a, $b, $c, $d, $e, $f) = $input;
        $b = $this->Utils->jsone($b);
        $sql = "INSERT INTO `zfcr_api`(
                       `access_token`, 
                       `apikey`,
                       `Name`, 
                       `IP`, 
                       `Device`,
                       `UserAgent`,
                       `InData`,
                       `OutData`,
                       `expired_time`,
                       `register_time`)";
        $arr = [
            [" VALUES ("],
            $a,
            $f,
            $this->APIName,
            $this->APIINFO[0],
            $this->APIINFO[1],
            $this->APIINFO[2],
            $b,
            $c,
            $d,
            $e,
            [")"]
        ];

        $r = $this->Utils->mquery(['run', $sql, $arr]);
        if ($r) {
            return true;
        }
        return false;
    }
}
