<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php if (!empty($assets)) {
        echo implode(PHP_EOL, $assets);
    } ?>

    <title><?= @$title ?></title>
    <?php
    if (@!empty($script)) { ?>
        <script><?= @$script ?></script>
    <?php } ?>
</head>
<body>
<?php if (@$menu) {
    include_once "menu.php";
}
include_once @$content; ?>
</body>
<?= @$footer ?>
</html>