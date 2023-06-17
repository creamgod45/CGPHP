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

// include_once module
require_once 'vendor/autoload.php';
require_once 'autoload.php';

// Use list
use Auth\MemberManager;
use Server\Request;
use Server\Request\ApplicationLayer;
use Tracy\Debugger;
use Utils\Utils;

// Set global variable
$debug = null;
$expire_message = null;
try {
    if (router(1) !== 'api') {
        Debugger::enable();
    }
    $Utils = new Utils();
    $Request = new Request();
    $ApplicationLayer = new ApplicationLayer();
    $MemberManager = new MemberManager();
} catch (Exception $e) {
    $debug = $e;
    var_dump($debug);
}
include_once 'mode.php'; // Website mode controller

//Authentication Layout
if (!$ApplicationLayer->run()) exit();

//Middle Layout
$routers = true;
include_once "routers.php";

/* @Debug @only_devloper_use */
if (@!empty($debug)) $Utils->pinv($debug, 'debug');
if (@!empty(router(null))) $Utils->pinv(router(null), 'router');
if (@!empty($expire_message)) $Utils->pinv($expire_message, 'expire');
if (@!empty(headers_list())) $Utils->pinv(headers_list(), 'HTTP Headers list');
if (@!empty($Utils->session())) $Utils->pinv($Utils->session(), '_SESSION');
if (@!empty($Utils->post())) $Utils->pinv($Utils->post(), '_POST');
if (@!empty($Utils->get())) $Utils->pinv($Utils->get(), '_GET');
if (@!empty($Utils->request())) $Utils->pinv($Utils->request(), '_REQUEST');
if (@!empty($Utils->files())) $Utils->pinv($Utils->files(), '_FILES');
ob_end_flush();
session_write_close();
