<?php
/**
 * @var \Type\Array\CGArray $Config
 * @var \Utils\Utils $Utils
 * @var \Server\Request $Request
 * @var \Server\ApplicationLayer $ApplicationLayer
 * @var \Nette\Caching\Storages\FileStorage $storage
 * @var \Nette\Caching\Cache $globalcache
 * @var \Auth\UniqueVisiterID $uniqueVisiterID
 * @var \I18N\I18N $i18N
 * @var bool $routers
 */
if (@!$routers) exit();

use Auth\UserStorage;
use I18N\ELanguageCode;
use modules\HomeModule;
use Utils\BootBuilder;
use Utils\csstype;

$bb = new BootBuilder();
$i18N->setLanguageCode(ELanguageCode::valueof(\Utils\Utils::default(router(2), "en_US")));
$bb->setTitle("首頁")
    ->setModule(new HomeModule())
    ->setContentFile("@Home.php")
    ->bootstrap()
    ->fontawesome()
    ->lz_string()
    ->initialize_css()
    ->menu()
    ->setMenu(true);
$us = new UserStorage($storage, $uniqueVisiterID->getKey());
if($us->hasData("member")){
    $timeout = $Request->Timeout("MemberDataUpdate", 60);
    if($timeout->isTimeout()){
        $timeout->addTimeout(60);
        $memberclass = $us->get("member");
        if ($memberclass instanceof \Auth\Member) {
            $memberclass->updateMemberData();
            $bb->setMember($memberclass);
        }
    }
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
$bb->addAsset($bb->css("@Home.css",[], csstype::css))
    ->addAsset($bb->js("js/@Home.js",[]))
    ->builder($Config,$Utils,$Request,$ApplicationLayer,$storage,$globalcache,$uniqueVisiterID, $i18N);
