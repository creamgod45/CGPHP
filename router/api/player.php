<?php

/**
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Auth\MemberManager $MemberManager
 * @var Server\Request\ApplicationLayer $ApplicationLayer
 **/

if ($Request->POST('a', true)->Get() &&
    $Request->CSRF("@player")->equal($Request->POST('b', true)->Get()) &&
    $Request->Timeout("@player")->isTimeout())
{
    $Request->CSRF("@player")->reset();
    $playername = $Request->POST('a', true)->Get();
    $Request->HEADER()->JSON_FILE();
    $Request->Timeout("@player")->addTimeout(10);
    echo json_encode(["error" => "", 'b' => $Request->CSRF("@player")->getValue()]);
    ?>
    <?php
} else {
    echo json_encode(['error' => "冷卻中.... 約 " . abs(time() - $Request->Timeout("@player")->getTimeout()) . " 秒。", "cooldown" => $Request->Timeout("@player")->getTimeout()]);
}
?>
