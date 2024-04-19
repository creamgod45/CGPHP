<?php
/**
 * @var Type\Array\CGArray $Config
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Server\ApplicationLayer $ApplicationLayer
 * @var Nette\Caching\Storages\FileStorage $storage
 * @var Nette\Caching\Cache $globalcache
 * @var Auth\UniqueVisiterID $uniqueVisiterID
 * @var \I18N\I18N $i18N
 * @var \modules\HomeModule $module
 * @var bool $routers
 */
if (@!$routers) exit();

use Utils\ConfigKeyField;
use Utils\Utils;
use Type\Array\CGArray;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php

    /**
     * @var CGArray $Config
     */

    function rand_commit($Config)
    {
        $random_number = rand(0, 100) / 100;
        if ($random_number < 0.7) {
return "<!-- 產生 ".(new Utils)->Get_eng_randoom(rand(0, 100))." by CGPHP Framework ".(new Utils)->Get_eng_randoom(rand(0, 100))." 專案名稱: ".$Config->Get(ConfigKeyField::Name->value)."".(new Utils)->Get_eng_randoom(rand(0, 100))." 版本: ".$Config->Get(ConfigKeyField::Version->value)." ".(new Utils)->Get_eng_randoom(rand(0, 100))." 作者: ".$Config->Get(ConfigKeyField::Auther->value)." ".(new Utils)->Get_eng_randoom(rand(0, 100))." ".(new Utils)->Get_eng_randoom(rand(0, 100))." -->";
        }
    }

echo rand_commit($Config);
    if (!empty($assets)) {
        foreach ($assets as $asset) {
            echo rand_commit($Config).$asset.rand_commit($Config).PHP_EOL;
        }
    } ?>

    <title><?= @$title ?></title>
    <?php
echo rand_commit($Config);
    if (@!empty($script)) { ?>
        <script><?= @$script ?></script>
    <?php } ?>
</head>
<body>
<?php if (@$menu) {
echo rand_commit($Config);
    include_once "menu.php";
}
include_once @$content;
echo rand_commit($Config); ?>
</body>
<?= @$footer ?>
</html>
<?php
echo rand_commit($Config); ?>
