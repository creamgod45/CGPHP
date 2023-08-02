<?php

/**
 * @var Utils $Utils
 * @var \Server\Request $Request
 */
require_once 'vendor/autoload.php';
require_once 'autoload.php';

use Auth\Member;
use Nette\Utils\FileSystem as fs;
use Utils\Utils;


$mode = fs::read('mode');


$member_unserialize = $Request->SESSION('member', true)->Get();
if(!is_bool($member_unserialize)){
    $member = new Member();
    $member->setArray($member_unserialize);

    if($mode !== 'enable' && $member->isAdministrator()){
        echo "<h5>目前你已經繞過這個模式系統，因為你是管理員。</h5>";
        if ($mode === 'maintenance') {
            echo('<p>[維護模式]將在維護完成後開放網站系統</p>');
        }
        if ($mode === 'protect') {
            echo('<p>[保護模式]已受到網路攻擊，將在修復完成後開放網站系統</p>');
        }
        if ($mode === 'disable' || $mode !== 'enable') {

            echo('<p>[關閉模式]所有頁面無法瀏覽且不在服務!!</p>');
        }
    }
}


if ($mode === 'maintenance') {
    die('<h1>[維護模式]將在維護完成後開放網站系統');
}
if ($mode === 'protect') {
    die('<h1>[保護模式]已受到網路攻擊，將在修復完成後開放網站系統');
}
if ($mode === 'disable' || $mode !== 'enable') {
    die('<h1>[關閉模式]所有頁面無法瀏覽且不在服務!!');
}
