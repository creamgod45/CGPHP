<?php
if (!function_exists('f1')) {
    function f1($onlyHostName = false, $return_array = false)
    {
        if ((isset($_SERVER['HTTPS']) &&
                ($_SERVER['HTTPS'] === 'on' || $_SERVER['HTTPS'] == 1)) ||
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
            return $protocol . $_SERVER['HTTP_HOST'];
        }

        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}

function setWorkingDirectory($directory)
{
    if (is_dir($directory)) {
        // 尝试改变当前工作目录
        if (chdir($directory)) {
            return true;
        } else {
            return false;
        }
    } else {
        return null;
    }
}

if (f1(true, true)[0] === 'https://') {
    if (!defined('PATH')) {
        define('PATH', '/home/vulsdril/chat.zeitfrei.tw');
    }
} else {
    if (!defined('PATH')) {
        define('PATH', 'C:/xampp/htdocs');
    }
}
