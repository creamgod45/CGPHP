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
$bb->addAsset($bb->css("@Home.css",[], csstype::css));
$bb->addAsset($bb->js("js/@Home.js",[]));
$bb->builder($Config,$Utils,$Request,$ApplicationLayer,$storage,$globalcache,$uniqueVisiterID);