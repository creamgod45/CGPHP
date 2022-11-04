<?php

namespace Utils;

require_once "utils.php";

class HTML
{

    private $utils;

    /**
     * Init Module Loader
     */
    public function __construct()
    {
        $this->utils = new utils();
    }

    // 調度員 (dispatcher) 方法
    public function html_ViewDispatcher($type, $data, $tagname = "script"): string
    {
        $html = [];
        switch ($type) {
            case "table.member":
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
                break;
            case "table":
                $row = $data;
                foreach ($row as $value) {
                    $tmp = [];
                    foreach ($value as $itemk => $itemv) {
                        if ($itemk === "expire" || $itemk === "expired_time" || $itemk === "registertime" || $itemk === "updatetime") {
                            $tempclass = "";
                            if ($itemv == "-1") {
                                $tempv = "不限制時間";
                            } else {
                                $tempclass = "moment";
                                $tempv = $this->utils->timestamp($itemv);
                            }
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "b",
                                        "config" => [
                                            "class" => $tempclass,
                                            "config.close" => true,
                                        ],
                                        "body" => $tempv,
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "enable") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getTruetoString((bool)$itemv),
                            ];
                        } else {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $itemv,
                            ];
                        }
                    }
                    $html [] = [
                        "tagname" => "tr",
                        "config" => [
                            "class" => "table-secondary",
                            "config.close" => true,
                        ],
                        "body" => $tmp,
                    ];
                }
                break;
            case "table.log":
                $row = $data;
                foreach ($row as $value) {
                    $tmp = [];
                    foreach ($value as $itemk => $itemv) {
                        if ($itemk === "expire" || $itemk === "registertime" || $itemk === "updatetime") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "b",
                                        "config" => [
                                            "class" => "moment",
                                            "config.close" => true,
                                        ],
                                        "body" => $this->utils->timestamp($itemv),
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "Source") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getSource($itemv),
                            ];
                        } else {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $itemv,
                            ];
                        }
                    }
                    $html [] = [
                        "tagname" => "tr",
                        "config" => [
                            "class" => "table-secondary",
                            "config.close" => true,
                        ],
                        "body" => $tmp,
                    ];
                }
                break;
            case "table.chatrooms":
                $row = $data;
                foreach ($row as $value) {
                    $tmp = [];
                    foreach ($value as $itemk => $itemv) {
                        if ($itemk === "expire" || $itemk === "register_time") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "b",
                                        "config" => [
                                            "class" => "moment",
                                            "config.close" => true,
                                        ],
                                        "body" => $this->utils->timestamp($itemv),
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "ChatRoomID") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "a",
                                        "config" => [
                                            "href" => "/cms/ChatRoom.php/$itemv",
                                            "config.close" => true,
                                        ],
                                        "body" => $itemv
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "ChatConfig") {
                            $arr = $this->utils->jsond($itemv);
                            $str = "<ul><li>聊天室：" . "</li><ul>";
                            $str .= "<li>標題：" . $arr["config"]["title"] . "</li>";
                            $str .= "<li>副標題：" . $arr["config"]["subtitle"] . "</li>";
                            $str .= "<li>允許上傳檔案類型：" . $arr["config"]["property"]["file_type"] . "</li>";
                            $str .= "<li>訊息延遲：" . $arr["config"]["property"]["chat_delay"] . "</li>";
                            $str .= "</ul></ul>";
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $str,
                            ];
                        } elseif ($itemk === "enable") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getTruetoString($itemv),
                            ];
                        } elseif ($itemk === "privacy") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getprivacy($itemv),
                            ];
                        } else {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $itemv,
                            ];
                        }
                    }
                    $html [] = [
                        "tagname" => "tr",
                        "config" => [
                            "class" => "table-secondary",
                            "config.close" => true,
                        ],
                        "body" => $tmp,
                    ];
                }
                break;
            case "table.crusers":
                $row = $data;
                foreach ($row as $value) {
                    $tmp = [];
                    $UUID = $value["UUID"];
                    foreach ($value as $itemk => $itemv) {
                        if ($itemk === "expired_time" || $itemk === "create_time") {
                            $tempclass = "";
                            if ($itemv == "-1") {
                                $tempv = "不限制時間";
                            } else {
                                $tempclass = "moment2";
                                $tempv = $this->utils->timestamp($itemv);
                            }
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "b",
                                        "config" => [
                                            "class" => $tempclass,
                                            "config.close" => true,
                                        ],
                                        "body" => $tempv,
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "alert") {
                            if (empty($itemv)) {
                                $itemv = "無警告紀錄";
                            }
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $itemv,
                            ];
                        } elseif ($itemk === "update_time") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "b",
                                        "config" => [
                                            "class" => "moment2",
                                            "config.close" => true,
                                        ],
                                        "body" => $itemv,
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "enable" || $itemk === "ban" || $itemk === "moderator") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getTruetoString($itemv),
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
                                            "href" => "/cms/ChatRoom.php/" . $this->utils->router(3) . "/$UUID",
                                            "config.close" => true,
                                        ],
                                        "body" => $UUID,
                                    ]
                                ],
                            ];
                        } else {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $itemv,
                            ];
                        }
                    }
                    $html [] = [
                        "tagname" => "tr",
                        "config" => [
                            "class" => "table-secondary",
                            "config.close" => true,
                        ],
                        "body" => $tmp,
                    ];
                }
                break;
            case "table.commit":
                $row = $data;
                foreach ($row as $value) {
                    $tmp = [];
                    foreach ($value as $itemk => $itemv) {
                        if ($itemk === "expire" || $itemk === "updatetime" || $itemk === "registertime") {
                            $tempclass = "";
                            if ($itemv === "-1") {
                                $tempv = "不限制時間";
                            } else {
                                $tempclass = "moment";
                                $tempv = $this->utils->timestamp($itemv);
                            }
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => [
                                    [
                                        "tagname" => "b",
                                        "config" => [
                                            "class" => "moment2",
                                            "config.close" => true,
                                        ],
                                        "body" => $tempv,
                                    ]
                                ],
                            ];
                        } elseif ($itemk === "enable") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $this->utils->getTruetoString((bool)$itemv),
                            ];
                        } elseif ($itemk === "UID") {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => "<a href='/cms/ChatRoom.php/commit/".$this->utils->router(3)."/".$value["ID"]."'>".$itemv."</a>",
                            ];
                        } elseif ($itemk === 'content') {
                            if (mb_strlen($itemv) > 15) {
                                $itemv = str_split($itemv, 15)[0] . '...';
                            }
                            $tmp[] = [
                                'tagname' => 'th',
                                'config' => [
                                    'config.close' => true,
                                ],
                                'body' => $itemv,
                            ];
                        } elseif ($itemk === 'File') {
                            if($itemv!=="false"){
                                $FST = new FileStorageTable();
                                $VTR = new VTReport();
                                $fstitem = $FST->getFSTtoDataBase('FileID', $itemv);
                                $tmp[] = [
                                    'tagname' => 'th',
                                    'config' => [
                                        'config.close' => true,
                                    ],
                                    'body' => '
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-title="
                                    檔案名稱：'.$fstitem["FileName"].'<br>
                                    檔案大小：'.$this->utils->convertByte((int)$fstitem['Sizes']).'<br>
                                    檔案類型：[MIME：'.$fstitem["FileExtension"].']/[副檔名：'.$fstitem["MIME"].']<br>
                                    檔案路徑：'.$fstitem["Path"].'<br>
                                    病毒報告：'. $VTR->getVTReport('FileID', $itemv)['URL'].'">懸停在我身上</a>
                                    ',
                                ];
                            }else{
                                $tmp[] = [
                                    'tagname' => 'th',
                                    'config' => [
                                        'config.close' => true,
                                    ],
                                    'body' => '無檔案夾帶',
                                ];
                            }
                        } else {
                            $tmp[] = [
                                "tagname" => "th",
                                "config" => [
                                    "config.close" => true,
                                ],
                                "body" => $itemv,
                            ];
                        }
                    }
                    $html [] = [
                        "tagname" => "tr",
                        "config" => [
                            "class" => "table-secondary",
                            "config.close" => true,
                        ],
                        "body" => $tmp,
                    ];
                }
                break;
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
            foreach ($config as $key => $value) {
                $code .= " " . $key . "=\"$value\"";
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
