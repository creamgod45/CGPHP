<?php

namespace Server;

use Server\Request\COOKIE;
use Server\Request\CSRF;
use Server\Request\ENV;
use Server\Request\FILES;
use Server\Request\GET;
use Server\Request\HEADER;
use Server\Request\POST;
use Server\Request\RequestInterface;
use Server\Request\SERVER;
use Server\Request\SESSION;
use Server\Request\Timeout;

require_once 'RequestInterface.php';
require_once 'GET.php';
require_once 'POST.php';
require_once 'SERVER.php';
require_once 'SESSION.php';
require_once 'COOKIE.php';
require_once 'FILES.php';
require_once "HEADER.php";

class Request implements RequestInterface
{

    public function Request(string $key = '', bool $ignore_key_missing = false): Request_internal
    {
        return new Request_internal($key, $ignore_key_missing);
    }
    public function GET(string $key = '', bool $ignore_key_missing = false): GET
    {
        return new GET($key, $ignore_key_missing);
    }

    public function POST(string $key = '', bool $ignore_key_missing = false): POST
    {
        return new POST($key, $ignore_key_missing);
    }

    public function HEADERS(string $key = '', bool $ignore_key_missing = false): array
    {
        return headers_list();
    }

    public function HEADER(): HEADER
    {
        return new HEADER();
    }

    public function SESSION(string $key = '', bool $ignore_key_missing = false): bool|SESSION
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return false;
        }
        return new SESSION($key, $ignore_key_missing);
    }

    public function COOKIE(string $key = '', bool $ignore_key_missing = false): COOKIE|bool
    {
        return new COOKIE($key, $ignore_key_missing);
    }

    public function SERVER(string $key = '', bool $ignore_key_missing = false): SERVER|bool
    {
        return new SERVER($key, $ignore_key_missing);
    }

    public function ENV(string $key = '', bool $ignore_key_missing = false): ENV|bool
    {
        return new ENV($key, $ignore_key_missing);
    }

    public function FILES(string $key = '', bool $ignore_key_missing = false): FILES|bool
    {
        return new FILES($key, $ignore_key_missing);
    }

    public function Redirect(string $URL = '', int $Seconds = 0): void
    {
        header('refresh:' . $Seconds . ';url="' . $URL . '"');
    }

    public function getInstanceAddress($Suffix = '', $onlyHostName = false, $return_array = false): array|string
    {
        if ((isset($_SERVER['HTTPS']) &&
                ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] === 1)) ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        if ($return_array) {
            return [$protocol, $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']];
        }
        if ($onlyHostName) {
            return $protocol . $_SERVER['HTTP_HOST'] . $Suffix;
        }

        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $Suffix;
    }

    /**
     * @param string $Key
     * @return bool|CSRF
     */
    public function CSRF(string $Key = "")
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return false;
        }
        return new CSRF($Key);
    }

    public function Timeout(string $Key = "")
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return false;
        }
        return new Timeout($Key);
    }


}

class Request_internal{

    public string $key;
    public bool $ignore_key_missing;

    public function __construct($key = '', $ignore_key_missing = false)
    {
        $this->key = $key;
        $this->ignore_key_missing = $ignore_key_missing;
    }

    public function Get()
    {
        if (empty($this->key)) return $_REQUEST;
        if ($this->ignore_key_missing) {
            if (@!empty($_REQUEST[$this->key])) {
                return $_REQUEST[$this->key];
            }
            return null;
        } else {
            return $_REQUEST[$this->key];
        }
        return false;
    }

    public function Set($value = ''): void
    {
        $_REQUEST[$this->key] = $value;
    }

    public function Remove(): void
    {
        unset($_REQUEST[$this->key]);
    }
}
