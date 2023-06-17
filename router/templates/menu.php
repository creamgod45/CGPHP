<div class="menu">
    <a href="<?= $Utils->getInstanceAddress(true) ?>">
        <img src="https://wadventure.blaetoan.cyou/img/favicon.ico" width="48px" height="48px" alt="LOGO 圖片">
    </a>
    <a href="<?= $Utils->getInstanceAddress(true) ?>" class="menu-item">
        <div class="icon"><i class="fa-solid fa-house"></i></div>
        <div class="name">首頁</div>
    </a>
    <a href="<?= $Utils->getInstanceAddress(true) ?>/player.php" class="menu-item">
        <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
        <div class="name">玩家查詢</div>
    </a>
    <a href="<?= $Utils->getInstanceAddress(true) ?>/online.php" class="menu-item">
        <div class="icon"><i class="fa-solid fa-globe"></i></div>
        <div class="name">線上服務</div>
    </a>
    <a href="<?= $Utils->getInstanceAddress(true) ?>/rank.php" class="menu-item">
        <div class="icon"><i class="fa-solid fa-ranking-star"></i></div>
        <div class="name">貢獻排行</div>
    </a>
    <a href="https://wadventure.blaetoan.cyou/" class="menu-item">
        <div class="icon"><i class="fa-brands fa-wikipedia-w"></i></div>
        <div class="name">維基</div>
    </a>
    <?php

    use Server\Request\SESSION;
    use Type\Array\CGArray;

    if (!@(new CGArray((new SESSION("member", true))->Get()))->IsEmpty()) {
        ?>
        <div class="border"></div>
        <a class="menu-item">
            <div class="icon"><i class="fa-solid fa-hammer"></i></div>
            <div class="name">管理</div>
        </a>
        <a class="menu-item">
            <div class="icon"><i class="fa-solid fa-right-from-bracket"></i></div>
            <div class="name">登出</div>
        </a>
    <?php }
    ?>
</div>