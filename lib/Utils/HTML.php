<?php

namespace Utils;

class HTML
{
    // 調度員 (dispatcher) 方法
    public function html_ViewDispatcher($type, $data, $tagname = "script"): string
    {
        $html = [];
        switch ($type) {
            /*case "table.member":
                $row = $data;
                foreach ($row as $key => $value) {
                    $tmp = [];
                    foreach ($value as $itemk => $itemv) {
                        if ($itemk === "type") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getMemberType($itemv),
                            ];
                        } elseif ($itemk === "expired_time" || $itemk === "create_time") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "style" => "min-width:100px",
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "p",
                                        "config" => [
                                            "class" => "moment",
                                            "config.close" => true,
                                        ],
                                        "body" => $this->utils->timestamp((int)$itemv)
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "update_time") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "style" => "min-width:100px",
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "p",
                                        "config" => [
                                            "class" => "moment",
                                            "config.close" => true,
                                        ],
                                        "body" => $itemv
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "avatar") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "a",
                                        "config" => [
                                            "style" => "word-break: keep-all;display: flex;cursor: pointer;",
                                            "tabindex" => "0",
                                            "loading" => "lazy",
                                            "class" => "popover-instance",
                                            "data-bs-container" => "body",
                                            "data-bs-toggle" => "popover",
                                            "data-bs-placement" => "right",
                                            "data-bs-trigger" => "focus",
                                            "data-bs-content" => "<img width='128px' height='auto' src='$itemv' alt='使用者圖片'>",
                                            "config.close" => true,
                                        ],
                                        "body" => "<p><i class='fa-solid fa-image'></i></p>&nbsp;點我查看"
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "UUID") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "a",
                                        "config" => [
                                            "href" => "/cms/Member.php/$itemv",
                                            "title" => "點我前往編輯這個資料",
                                            "config.close" => true,
                                        ],
                                        "body" => $itemv,
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "username" || $itemk === "email" || $itemk === "discord_id" || $itemk === "ip") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "div",
                                        "config" => [
                                            "style" => "display:flex;",
                                            "config.close" => true,
                                        ],
                                        "body" => [
                                            [
                                                "tagname" => "script",
                                                "config" => [
                                                    "config.close" => true,
                                                ],
                                                "body" => "
                                            $(document).ready(function () {
                                                $('#" . $key . $itemk . "').click(function(){
                                                    $('#" . $key . $itemk . "v').attr('type','text');
                                                });
                                            });
                                        ",
                                            ],
                                            [
                                                "tagname" => "button",
                                                "config" => [
                                                    "id" => $key . $itemk,
                                                    "class" => "btn btn-info btn-sm",
                                                    "style" => "word-break: keep-all;display: flex;height:100%;",
                                                    "title" => "點擊查看",
                                                    "config.close" => true,
                                                ],
                                                "body" => "<p style='margin-bottom:unset;'><i class='fa-solid fa-eye'></i></p>&nbsp;點擊查看",
                                            ],
                                            [
                                                "tagname" => "input",
                                                "config" => [
                                                    "id" => $key . $itemk . "v",
                                                    "type" => "hidden",
                                                    "value" => $itemv,
                                                    "config.close" => false,
                                                ],
                                                "body" => "",
                                            ]
                                        ],
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "enable" || $itemk === "administrator") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getTruetoString($itemv),
                            ];
                        } else {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "style" => "width:100%",
                                    "config.close" => true,
                                ],
                                "body" => $itemv,
                            ];
                        }
                    }
                    $html [] = [
                        "tagname" => "tr",
                        "config" => [
                            "style" => "word-break: keep-all;",
                            "class" => "table-secondary",
                            "config.close" => true,
                        ],
                        "body" => $tmp,
                    ];
                }
                break;*/
            default:
                break;
        }
        return $this->html_Builder([
            "tagname" => $tagname,
            "config" => [
                "config.close" => true,
            ],
            "body" => $html,
        ]);
    }

    /** @noinspection TypeUnsafeComparisonInspection */
    public function html_Builder(array $array = []): string
    {
        // 初始化
        $code = "";
        @$tagname = $array["tagname"];
        @$config = $array["config"];
        @$close = $config["config.close"];
        @$body = $array["body"];
        unset($config["config.close"]); // reset config

        // 開始處理
        if (!empty($tagname)) {
            $code .= "<";
        }

        // 標籤名稱
        if (!empty($tagname)) {
            $code .= $tagname;
        }

        // 標籤設定
        if (!empty($tagname)) {
            if (is_array($config))
                foreach ($config as $key => $value) {
                    if ($key === "class" && is_array($value)) {
                        $code .= " " . $key . "=\"";
                        foreach ($value as $i => $v) {
                            if (count($value) - 1 === $i)
                                $code .= $v;
                            else
                                $code .= $v . " ";
                        }
                        $code .= "\"";
                    } else{
                        $code .= " "
                            . $key
                            . "=\"$value\"";}
                }
        }
        // 一列式標籤
        if ($close === false) {
            // 標籤結尾
            if (!empty($tagname)) {
                $code .= "/>";
            }

        } else {
            if (!empty($tagname)) {
                $code .= ">";
            }

            // 標籤遞迴
            if (!empty($body)) {
                if (is_array($body)) {
                    // 子陣列處理
                    if (@$body["type"] != "") {
                        // 調度員 (dispatcher) 處理
                        if (empty($tagname)) {
                            $code .= $this->html_ViewDispatcher($body["type"], $body["data"]);
                        } else {
                            $code .= $this->html_ViewDispatcher($body["type"], $body["data"], $tagname);
                        }
                    } else {
                        // 循環結構
                        foreach ($body as $iValue) {
                            $code .= $this->html_Builder($iValue);
                        }
                    }
                } elseif (is_string($body) || is_numeric($body)) {
                    // 內容處理
                    if ($close === true) {
                        $code .= $body;
                    }
                }
            }
            // 標籤結尾
            if ($close === true) {
                $code .= "</" . $tagname . ">";
            }
        }
        return $code;
    }
}
