<?php

use Utils\HTML;

/**
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Auth\MemberManager $MemberManager
 * @var Server\Request\ApplicationLayer $ApplicationLayer
 */


var_dump($Request->Request('test', true)->Get());

$title = "首頁";
$assets = [
    "<script src=\"https://code.jquery.com/jquery-3.6.4.min.js\" integrity=\"sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=\" crossorigin=\"anonymous\"></script>",
    (new HTML())->html_Builder([
        "tagname" => "link",
        "config" => [
            "config.close" => false,
            "href" => $Utils->resources("css/all.css"),
            "rel" => "stylesheet",
            "type" => "text/css"
        ]
    ]),
    (new HTML())->html_Builder([
        "tagname" => "script",
        "config" => [
            "config.close" => true,
            "src" => $Utils->resources("js/all.js"),
        ]
    ]),
    (new HTML())->html_Builder([
        "tagname" => "script",
        "config" => [
            "config.close" => true,
            "src" => $Utils->resources("js/bootstrap.min.js"),
        ]
    ]),
    (new HTML())->html_Builder([
        "tagname" => "link",
        "config" => [
            "config.close" => false,
            "href" => $Utils->resources("css/bootstrap.min.css"),
            "rel" => "stylesheet",
            "type" => "text/css"
        ]
    ]),
    (new HTML())->html_Builder([
        "tagname" => "link",
        "config" => [
            "config.close" => false,
            "href" => $Utils->resources("scss/initialize.css"),
            "rel" => "stylesheet",
            "type" => "text/css"
        ]
    ]),
    (new HTML())->html_Builder([
        "tagname" => "link",
        "config" => [
            "config.close" => false,
            "href" => $Utils->resources("scss/menu.css"),
            "rel" => "stylesheet",
            "type" => "text/css"
        ]
    ]),
    (new HTML())->html_Builder([
        "tagname" => "link",
        "config" => [
            "config.close" => false,
            "href" => $Utils->resources("scss/@player.css"),
            "rel" => "stylesheet",
            "type" => "text/css"
        ]
    ]),
    (new HTML())->html_Builder([
        "tagname" => "script",
        "config" => [
            "config.close" => true,
            "src" => $Utils->resources("js/@player.js"),
        ]
    ]),
];
$content = "@player.php";
$footer = "";
$script = "var b=\"" . $Request->CSRF("@player")->getValue() . "\";";
$menu = true;
include_once "templates/layout.php"; ?>