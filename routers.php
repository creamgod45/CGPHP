<?php
/**
 * @var Utils\Utils $Utils
 * @var bool $routers
 */

if (@!$routers) exit();

switch (router(1)) {
    case 'api':
        switch (router(2)) {
            case "player.php":
                include_once "router/api/player.php";
                break;
        }
        break;
    case 'player.php':
        include_once "router/@player.php";
        break;
    case 'online.php':
        include_once "router/@online.php";
        break;
    case 'rank.php':
        include_once "router/@rank.php";
        break;
    case 'index.php':
        include_once "router/@Home.php";
        break;
    default:
        $Utils->goto_page([0, '/index.php']);
        break;
}