<?php

use Utils\HTML;

/**
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Auth\MemberManager $MemberManager
 * @var Server\Request\ApplicationLayer $ApplicationLayer
 */

$title = "首頁";
$assets = [
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
            "href" => $Utils->resources("scss/@Home.css"),
            "rel" => "stylesheet",
            "type" => "text/css"
        ]
    ]),
];
$content = "@Home.php";
$footer = "";
$script = "";
$menu = true;
include_once "templates/layout.php";
