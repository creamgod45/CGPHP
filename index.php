<?php
// Global config environments
// Reset class autoload bug :: not rebuild class
/* @only_devloper_use */
ob_start();
ini_set('session.gc_maxlifetime', 1);
include_once 'PATH.php';
$prefix = "";
$layer = 1;

// Router
function router($layer)
{
    $url = $_SERVER['REQUEST_URI'];
    $REQUEST = explode('/', $url);
    if ($layer === null) {
        return $REQUEST;
    }
    if (empty($REQUEST[$layer])) {
        return '';
    }
    return $REQUEST[$layer];
}

if (router(1) !== 'cron') {
    session_start();
}
date_default_timezone_set('Asia/Taipei');
header('X-Frame-Options: SAMEORIGIN');                          // Filter iframe only samedomain
header("Content-Security-Policy: frame-ancestors 'self';");     // CSP Protect only self
header('X-Content-Type-Options: nosniff');
header("X-XSS-Protection: 1; mode=block");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Feature-Policy: camera 'none'; geolocation 'none'");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
header("X-Download-Options: noopen");
header("X-Redirect-By: MyServer");

// include_once module
require_once 'vendor/autoload.php';
require_once 'autoload.php';

// Use list
use Auth\UniqueVisiterID;
use I18N\I18N;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use Server\ApplicationLayer;
use Server\Request;
use Tracy\Debugger;
use Utils\Utils;

// Set global variable
$debug = null;
$expire_message = null;
try {
    if (router(1) !== 'api') {
        Debugger::enable();
    }
    $Config = require "config.php";
    $i18N = new I18N(limitMode: [
        \I18N\ELanguageCode::zh_CN,
        \I18N\ELanguageCode::zh_TW,
        \I18N\ELanguageCode::en_US,
        \I18N\ELanguageCode::en_GB,
    ]);
    $Utils = new Utils();
    $Request = new Request();
    $ApplicationLayer = new ApplicationLayer();
    $storage = new FileStorage('temp');
    $globalcache = new Cache($storage, "globalcache");
    $uniqueVisiterID = new UniqueVisiterID();
} catch (Exception $e) {
    $debug = $e;
    var_dump($debug);
}

include_once 'mode.php'; // Website mode controller

//Middle Layout
$routers = true;
include_once "routers.php";

/* @Debug @only_devloper_use */
if (@!empty($Config)) $Utils->pinv($Config, 'Config');
if (@!empty($debug)) $Utils->pinv($debug, 'debug');
if (@!empty($i18N)) $Utils->pinv($i18N, 'i18N');
if (@!empty(router(null))) $Utils->pinv(router(null), 'router');
if (@!empty($expire_message)) $Utils->pinv($expire_message, 'expire');
if (@!empty(headers_list())) $Utils->pinv(headers_list(), 'HTTP Headers list');
if (@!empty($Request->SESSION())) $Utils->pinv($Request->SESSION(), '_SESSION');
if (@!empty($Request->COOKIE())) $Utils->pinv($Request->COOKIE()->Get(), '_COOKIE');
if (@!empty($Request->POST())) $Utils->pinv($Request->POST(), '_POST');
if (@!empty($Request->GET())) $Utils->pinv($Request->GET(), '_GET');
if (@!empty($Request->Request())) $Utils->pinv($Request->Request(), '_REQUEST');
if (@!empty($Request->FILES())) $Utils->pinv($Request->FILES(), '_FILES');
ob_end_flush();
session_write_close();
