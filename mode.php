<?php

/**
 * @var \Type\Array\CGArray $Config
 * @var \Utils\Utils $Utils
 * @var \Server\Request $Request
 * @var \Server\ApplicationLayer $ApplicationLayer
 * @var \Nette\Caching\Storages\FileStorage $storage
 * @var \Nette\Caching\Cache $cache
 * @var \Auth\UniqueVisiterID $uniqueVisiterID
 */
require_once 'vendor/autoload.php';
require_once 'autoload.php';

use Auth\Member;
use Auth\UserStorage;
use Nette\Utils\FileSystem as fs;
use Nette\Utils\Json;


$mode = fs::read('mode');


$us = new UserStorage($storage, $uniqueVisiterID->getKey());
if ($us->hasData("member")) {
    try {
        $member = $us->get("member");
        if ($member->isInitialized() && $member->isEnable()) {
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
    } catch (\Nette\Utils\JsonException $e) {
        echo $e->getMessage();
    }
} elseif ($mode === 'maintenance') {
    die('<h1>[維護模式]將在維護完成後開放網站系統');
} elseif ($mode === 'protect') {
    die('<h1>[保護模式]已受到網路攻擊，將在修復完成後開放網站系統');
} elseif ($mode === 'disable' || $mode !== 'enable') {
    die('<h1>[關閉模式]所有頁面無法瀏覽且不在服務!!');
}
