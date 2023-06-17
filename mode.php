<?php

/**
 * @var \Utils\Utils $Utils
 */
require_once 'vendor/autoload.php';

use Nette\Utils\FileSystem as fs;

$mode = fs::read('mode');
@$member = $Utils->session('member');

if ($mode === 'maintenance') {
    die('<h1>[維護模式]將在維護完成後開放網站系統');
}
if ($mode === 'protect') {
    die('<h1>[保護模式]已受到網路攻擊，將在修復完成後開放網站系統');
}
if ($mode === 'disable' || $mode !== 'enable') {
    die('<h1>[關閉模式]所有頁面無法瀏覽且不在服務!!');
}