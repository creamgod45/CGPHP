<?php
/**
 * @var CGArray $Config
 * @var Utils $Utils
 * @var Request $Request
 * @var ApplicationLayer $ApplicationLayer
 * @var FileStorage $storage
 * @var Cache $cache
 * @var UniqueVisiterID $uniqueVisiterID
 * @var bool $routers
 */

use Auth\Member;
use Auth\UniqueVisiterID;
use Auth\UserStorage;
use Nette\Caching\Cache;
use Nette\Caching\Storages\FileStorage;
use Nette\Utils\Json;
use Server\ApplicationLayer;
use Server\Request;
use Type\Array\CGArray;
use Utils\Utils;

if (@!$routers) exit();

$us = new UserStorage($storage, $uniqueVisiterID->getKey());
?>
<div class="menu container rounded-bottom-4 d-lg-flex d-sm-none d-none">
    <?= rand_commit($Config) ?>
    <a href="<?= (new Utils)->getInstanceAddress(true) ?>">
        <img src="https://wadventure.blaetoan.cyou/img/favicon.ico" width="48px" height="48px" alt="LOGO 圖片">
    </a>
    <?= rand_commit($Config) ?>
    <a href="<?= (new Utils)->getInstanceAddress(true) ?>" class="menu-item">
        <div class="icon"><i class="fa-solid fa-house"></i></div>
        <div class="name">首頁</div>
    </a>
    <?= rand_commit($Config) ?>
    <a href="<?= (new Utils)->getInstanceAddress(true) ?>/player.php" class="menu-item">
        <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
        <div class="name">玩家查詢</div>
    </a>
    <?= rand_commit($Config) ?>
    <a href="<?= (new Utils)->getInstanceAddress(true) ?>/online.php" class="menu-item">
        <div class="icon"><i class="fa-solid fa-globe"></i></div>
        <div class="name">線上服務</div>
    </a>
    <?= rand_commit($Config) ?>
    <a href="<?= (new Utils)->getInstanceAddress(true) ?>/rank.php" class="menu-item">
        <div class="icon"><i class="fa-solid fa-ranking-star"></i></div>
        <div class="name">排行榜</div>
    </a>
    <?= rand_commit($Config) ?>
    <a href="<?= (new Utils)->getInstanceAddress(true) ?>/shop.php" class="menu-item">
        <div class="icon"><i class="fa-solid fa-store"></i></div>
        <div class="name">線上商店</div>
    </a>
    <?= rand_commit($Config) ?>
    <a href="https://wadventure.blaetoan.cyou/" class="menu-item">
        <div class="icon"><i class="fa-brands fa-wikipedia-w"></i></div>
        <div class="name">維基</div>
    </a>
    <?= rand_commit($Config) ?>
    <?php
    if ($us->hasData("member")) {
        try {
            $member = $us->get("member");
            if ($member->isInitialized() && $member->isEnable()) {
                ?>
                <?= rand_commit($Config) ?>
                <div class="border"></div>
                <a href="<?= (new Utils)->getInstanceAddress(true) ?>/profile.php" class="menu-item" href="/profile.php">
                    <div class="icon"><i class="fa-solid fa-hammer"></i></div>
                    <div class="name">個人資料</div>
                </a>
                <?= rand_commit($Config) ?>
                <a href="<?= (new Utils)->getInstanceAddress(true) ?>/logout.php" class="menu-item">
                    <div class="icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                    <div class="name">登出</div>
                </a>
                <?= rand_commit($Config) ?>
                <?php
            }
        } catch (\Nette\Utils\JsonException $e) {
            echo $e->getMessage();
        }
    } else { ?>
        <div class="border"></div>
        <a href="/login.php" class="menu-item">
            <div class="icon"><i class="fa-solid fa-right-to-bracket"></i></div>
            <div class="name">登入</div>
        </a>
        <?= rand_commit($Config) ?>
    <?php } ?>
</div>
<script>
    $jq(() => {
        $jq('.menu2-panel').slideUp(500);
        $jq(".menu2-toggle").click(function () {
            $jq('.menu2-panel').slideDown(500).css({"visibility": "unset"});
        });
        $jq("#menu2-off").click(function () {
            $jq('.menu2-panel').slideUp(500);
            setTimeout(() => {
                $jq('.menu2-panel').css({"visibility": "hidden"});
            }, 400);
        });
        $jq('.menu2-panel').slideUp(500).css({"visibility": "hidden"});
    });
</script>
<div class="menu2-toggle d-lg-none d-sm-flex position-fixed vstack rounded-end-4">
    <a class="item mt-2 d-flex rounded-pill btn btn-primary" href="javascript:void(0)">
        <div class="icon">
            <i class="fa-solid fa-bars"></i>
            <div class="show-text rounded-1">開啟選單</div>
        </div>
    </a>
    <?= rand_commit($Config) ?>
</div>
<div class="menu2-panel d-lg-none d-sm-flex position-fixed vstack rounded-end-4" style="visibility: hidden">
    <a class="item mt-2 mb-2 d-flex rounded-pill btn btn-primary" id="menu2-off">
        <div class="icon">
            <i class="fa-solid fa-x"></i>
            <div class="show-text rounded-1">關閉選單</div>
        </div>
    </a>
    <?= rand_commit($Config) ?>
    <a class="logo" href="<?= (new Utils)->getInstanceAddress(true) ?>">
        <img class="rounded-circle" src="https://wadventure.blaetoan.cyou/img/favicon.ico" width="48px" height="48px"
             alt="LOGO 圖片">
    </a>
    <?= rand_commit($Config) ?>
    <a class="item mt-2 d-flex rounded-pill btn btn-primary" href="<?= (new Utils)->getInstanceAddress(true) ?>">
        <div class="icon">
            <i class="fa-solid fa-house"></i>
            <div class="show-text rounded-1">首頁</div>
        </div>
    </a>
    <?= rand_commit($Config) ?>
    <a class="item mt-2 d-flex rounded-pill btn btn-primary"
       href="<?= (new Utils)->getInstanceAddress(true) ?>/player.php">
        <div class="icon">
            <i class="fa-solid fa-magnifying-glass"></i>
            <div class="show-text rounded-1">玩家查詢</div>
        </div>
    </a>
    <?= rand_commit($Config) ?>
    <a class="item mt-2 d-flex rounded-pill btn btn-primary"
       href="<?= (new Utils)->getInstanceAddress(true) ?>/online.php">
        <div class="icon">
            <i class="fa-solid fa-globe"></i>
            <div class="show-text rounded-1">線上服務</div>
        </div>
    </a>
    <?= rand_commit($Config) ?>
    <a class="item mt-2 d-flex rounded-pill btn btn-primary"
       href="<?= (new Utils)->getInstanceAddress(true) ?>/rank.php">
        <div class="icon">
            <i class="fa-solid fa-ranking-star"></i>
            <div class="show-text rounded-1">排行榜</div>
        </div>
    </a>
    <?= rand_commit($Config) ?>
    <a class="item mt-2 d-flex rounded-pill btn btn-primary"
       href="<?= (new Utils)->getInstanceAddress(true) ?>/shop.php">
        <div class="icon">
            <i class="fa-solid fa-store"></i>
            <div class="show-text rounded-1">線上商店</div>
        </div>
    </a>
    <?php
    if ($us->hasData("member")) {
        try {
            $member = $us->get("member");
            if ($member->isInitialized() && $member->isEnable()) {
                ?>
                <?= rand_commit($Config) ?>
                <div class="border mt-2 rounded-pill"></div>
                <a class="item mt-2 d-flex rounded-pill btn btn-primary"
                   href="<?= (new Utils)->getInstanceAddress(true) ?>/profile.php">
                    <div class="icon">
                        <i class="fa-solid fa-hammer"></i>
                        <div class="show-text rounded-1">個人資料</div>
                    </div>
                </a>
                <?= rand_commit($Config) ?>
                <a class="item mt-2 d-flex rounded-pill btn btn-primary"
                   href="<?= (new Utils)->getInstanceAddress(true) ?>/logout.php">
                    <div class="icon">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <div class="show-text rounded-1">登出</div>
                    </div>
                </a>
                <?php
            }
        } catch (\Nette\Utils\JsonException $e) {
            echo $e->getMessage();
        }
    } else { ?>
        <div class="border mt-2 rounded-pill"></div>
        <?= rand_commit($Config) ?>
        <a class="item mt-2 d-flex rounded-pill btn btn-primary"
           href="<?= (new Utils)->getInstanceAddress(true) ?>/login.php">
            <div class="icon">
                <i class="fa-solid fa-right-to-bracket"></i>
                <div class="show-text rounded-1">登入</div>
            </div>
        </a>
    <?php }
    ?>
</div>