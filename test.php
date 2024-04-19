<?php
date_default_timezone_set('Asia/Taipei');
include_once 'PATH.php';
require_once 'vendor/autoload.php';
require_once 'autoload.php';
\Tracy\Debugger::enable();

$language = \Nette\Utils\FileSystem::read("lib/I18N/language.txt");
$strings="<?php // paste to lib/I18N/I18N.php \I18N\I18N::buildLanguageMap".PHP_EOL;
$strings2="// paste to lib/I18N/ELanguageCode.php inside cases".PHP_EOL;
$explode = explode("/",$language);
$format= '$this->setLanguage(ELanguageText::%name%, "%value%");'.PHP_EOL;
$format2= 'case %name%; // %value%'.PHP_EOL;
foreach ($explode as $item) {
    $trim = trim($item);
    $str_replace = str_replace("-", "_", $trim);
    $explode1 = explode(":", $str_replace);
    $strings.=str_replace("%name%",trim($explode1[0]),str_replace("%value%",trim($explode1[1]),$format));
    $strings2.=str_replace("%name%",trim($explode1[0]),str_replace("%value%",trim($explode1[1]),$format2));
}

\Nette\Utils\FileSystem::write("lib/I18N/language.php", $strings);
\Nette\Utils\FileSystem::write("lib/I18N/language2.php", $strings2);

