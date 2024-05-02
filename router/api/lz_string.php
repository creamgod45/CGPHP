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

use Utils\Utilsv2;

$startTime = microtime(true);

if($Request->Request('a', true)->Get() !== null){
    $a = $Request->Request('a', true)->Get();
    $Request->HEADER()->JSON_FILE();
    $decodeContext = Utilsv2::decodeContext($a);

    // 結束時間
    $endTime = microtime(true);
    // 計算總運行時間
    $elapsedTime = $endTime - $startTime;
    echo json_encode(['raw'=>$decodeContext, 'elapsedTime'=>($elapsedTime*1000)."ms"]);
}
