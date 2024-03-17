<?php
/**
 * @var \Type\Array\CGArray $Config
 * @var \Utils\Utils $Utils
 * @var \Server\Request $Request
 * @var \Server\ApplicationLayer $ApplicationLayer
 * @var \Nette\Caching\Storages\FileStorage $storage
 * @var \Nette\Caching\Cache $globalcache
 * @var \Auth\UniqueVisiterID $uniqueVisiterID
 * @var bool $routers
 */
if (@!$routers) exit();

use Auth\UserStorage;
use Utils\BootBuilder;
use Utils\csstype;

$bb = new BootBuilder();
$bb->setTitle("首頁");
$bb->setContentFile("@Home.php");
$bb->bootstrap();
$bb->fontawesome();
$bb->initialize_css();
$bb->menu();
$bb->setMenu(true);
$us = new UserStorage($storage, $uniqueVisiterID->getKey());
if($us->hasData("member")){
    $timeout = $Request->Timeout("MemberDataUpdate", 60);
    if($timeout->isTimeout()){
        $timeout->addTimeout(60);
        $memberclass = $us->get("member");
        if ($memberclass instanceof \Auth\Member) {
            $memberclass->updateMemberData();
        }
    }
    $bb->setMember($us->get("member"));
    $bb->hasPermission(function ($if, $params){
        if($if){
            if ($params instanceof BootBuilder) {
                $utils = new \Utils\Utils();
                $utils::pinv("permission test pass");
            }
        }elseif($if===null){
            $utils = new \Utils\Utils();
            $utils::pinv("null member");
        }else{
            $utils = new \Utils\Utils();
            $utils::pinv("false");
        }
    }, $bb, "admin");
}
$bb->addAsset($bb->css("@Home.css",[], csstype::css));
$bb->addAsset($bb->js("js/@Home.js",[]));
$bb->builder($Config,$Utils,$Request,$ApplicationLayer,$storage,$globalcache,$uniqueVisiterID);
