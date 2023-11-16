<?php

namespace Utils;

use http\Exception\RuntimeException;

/**
 * Plugins module
 * @package lib
 */
class Utils
{
    /**
     * 取得有格式的時間字串
     *
     * @param null $time
     * @param String $format
     * @return false|string
     */
    public function timestamp($time = null, string $format = 'Y-m-d H:i:s')
    {
        if (empty($time)) {
            $time = time();
        }

        return date($format, $time);
    }

    public function timestamp_string($time = null, string $format = 'Y-m-d H:i:s')
    {
        if (empty($time)) {
            $time = time();
        }
        if ($time == -1) {
            return "不限時間";
        }

        return date($format, $time);
    }

    /**
     * SESSION 方法
     *
     * @param String $string
     * @return Mixed
     */
    public function session(string $string = "")
    {
        if (@$string === "") {
            return $_SESSION;
        }

        return $_SESSION[$string];
    }

    /**
     * Set $classlist container
     *
     * @param array $classlist
     */
    public function setClasslist(array $classlist)
    {
        $this->set_session(["ClassList", $classlist]);
    }

    /**
     * 設定 SESSION 方法
     *
     * @param Array $array
     * @return Boolean
     */
    public function set_session(array $array): bool
    {
        $_SESSION[$array[0]] = $array[1];
        return true;
    }

    public function default($data, $default = null)
    {
        if (@empty($data) || $data === null) {
            return $default;
        }

        return $data;
    }

    /**
     * 檢視導向之物件狀態
     *
     * @param Mixed $mixed
     * @return Boolean
     */
    public function v($mixed): bool
    {
        dump($mixed);
        return true;
    }

    /**
     * 獲取檔案更改時間
     * @param string $filename
     * @return false|int
     */
    public function filecode(string $filename)
    {
        return filemtime($filename);
    }

    /**
     * 字串過濾器
     * @param $method
     * @param $value
     * @return bool|string|string[]
     */
    public function filter($method, $value)
    {
        switch ($method) {
            case 'int':
                $value = intval($value);
                if ($value === 0) return true;
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    return true;
                }
            case 'token':
                return filter_var($value, FILTER_SANITIZE_STRING);
            case 'UUID':
                if (preg_match("/[.0-9a-f]+/i", $value)) {
                    return true;
                }

                return false;
            case 'chat':
                $text = str_replace(array("<script>", "</script>", "<style>", "</style>", "<html>", "</html>", "<body>", "</body>", "<?=", "?>", "</"), '', $value);
                $text = htmlspecialchars($text);
                $text = htmlentities($text, ENT_QUOTES | ENT_IGNORE, "UTF-8");
                $text = preg_replace("~(?:[\p{M}])([\p{M}])+?~uis", "", $text);
                return $text;
            case 'email':
                if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return true;
                }

                return false;
            case 'ChatRoomID':
                /**
                 * 英文開頭
                 * a~z 0~9 _^#$@!%&*-
                 * 1~20 位數
                 */
                // url:https://stackoverflow.com/questions/18562664/regular-expression-for-username-with-a-z0-9-3-20
                if (preg_match("/^[a-z][a-z0-9_^#$@!%&*-]{1,20}$/i", $value)) {
                    return true;
                }

                return false;
            case 'username':
                /**
                 * 英文開頭
                 * a~z 0~9 _^#$@!%&*-
                 * 20~255 位數
                 */
                // url:https://stackoverflow.com/questions/18562664/regular-expression-for-username-with-a-z0-9-3-20
                if (preg_match("/^[a-z][a-z0-9_^#$@!%&*-]{1,255}$/i", $value)) {
                    return true;
                }

                return false;
            case 'nickname':
                /**
                 * 大於等於 2 個字 到 20 個字
                 * 中文 英文 數字
                 */
                if (preg_match('/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]{2,20}+$/u', $value)) {
                    return true;
                }
                $r = [];
                $num = 0;
                $r [] = strpos($value, "來福");
                $r [] = strpos($value, "系統");
                $r [] = strpos($value, "ray");
                $r [] = strpos($value, "管理員");
                $r [] = strpos($value, "Ray");
                $r [] = strpos($value, "𝗭𝗲𝗶𝘁𝗙𝗿𝗲𝗶");
                $r [] = strpos($value, "版主");
                $r [] = strpos($value, "版主");
                foreach ($r as $item) {
                    if (is_numeric($item)) {
                        $num++;
                    }
                }
                if ($num > 0) return false;
                return true;
                break;
            case 'password':
                /**
                 * a~z 0~9 _^#$@!%&*-
                 * 8~255 位數
                 */
                if (preg_match("/^[a-z0-9_^#$@!%&*-]{8,255}$/i", $value)) {
                    return true;
                }

                return false;
            case 'discord_id':
                if (filter_var($value, FILTER_VALIDATE_INT)) {
                    return true;
                }

                return false;
            case 'url':
                if (filter_var($value, FILTER_VALIDATE_URL)) {
                    return true;
                }

                return false;
            case 'avatar':
                $num = 0;
                $arr = explode("/", $value);

                if ($arr[2] === "i.imgur.com") {
                    $num++;
                } else if ($arr[2] === "cdn.discordapp.com" && $arr[3] === "avatars") {
                    $num++;
                }

                if (filter_var($value, FILTER_VALIDATE_URL)) {
                    $num++;
                }
                if ($num === 2) return true;
                return false;
            case 'ip':
                if (filter_var($value, FILTER_VALIDATE_IP)) {
                    return true;
                }

                return false;
            case 'boolstring':
                if ($value === "true" || $value === "false") return true;
                return false;
                break;
            case 'privacy':
                if ($value === "public" || $value === "private" || $value === "protected") return true;
                return false;
                break;
            default:
                return false;
        }
    }

    public function rmheader()
    {
        header_remove("connection");
        header_remove("content-length");
        header_remove("content-type");
        header_remove("date");
        header_remove("keep-alive");
        header_remove("server");
        header_remove("x-powered-by");
    }

    /**
     * 陣列轉字串
     * @param Array $array
     * @return String
     *
     * input:
     * {
     *         [0] => [
     *             [0]=>0,
     *             [1]=>1
     *         ],
     *         [1] => [
     *             [0]=>2,
     *             [1]=>3,
     *             [2]=>4
     *         ]
     * }
     *
     * output:
     * /0:1/2:3:4
     *
     */
    public function array_decode(array $array): string
    {
        $string = "";
        for ($i = 0; $i <= count($array) - 1; $i++) {
            if ($i !== 0) {
                $string .= '/';
            }
            for ($y = 0; $y <= count($array[$i]) - 1; $y++) {
                if ($y === count($array[$i]) - 1) {
                    $string .= $array[$i][$y];
                } else {
                    $string .= $array[$i][$y] . ':';
                }
            }
        }
        return $string;
    }

    /**
     * 字串轉陣列
     *
     * input:
     * /0:1/2:3:4
     *
     * output:
     * {
     *         [0] => [
     *             [0]=>0,
     *             [1]=>1
     *         ],
     *         [1] => [
     *             [0]=>2,
     *             [1]=>3,
     *             [2]=>4
     *         ]
     * }
     *
     * @param String $string
     * @return Array
     */
    public function array_encode(string $string): array
    {
        $array = [];
        $b = explode('/', $string);
        for ($i = 0; $i <= count($b) - 1; $i++) {
            $d = [];
            $c = explode(':', $b[$i]);
            for ($y = 0; $y <= count($c) - 1; $y++) {
                $d[$y] = $c[$y];
            }
            $array[$i] = $d;
        }

        return $array;
    }

    /**
     * HTML 顯示警告訊息
     *
     * @param String $string
     * @return Boolean
     */
    public function html_alert_text(string $string): bool
    {
        echo "<h1>$string</h1>";
        return true;
    }

    /**
     * HTML 顯示警告訊息(回傳)
     *
     * @param String $string
     * @return String
     */
    public function html_alert_texts(string $string): string
    {
        return "<h1>$string</h1>";
    }

    /**
     * 前往指定網頁
     * [0] => 秒數
     * [1] => 地址
     *
     * @param Array $array
     * @return Boolean
     */
    public function goto_page(array $array): bool
    {
        header('refresh:' . $array[0] . ';url="' . $array[1] . '"');
        return true;
    }

    /**
     * 回應式
     *
     * $array
     * [0] => 如果 $boolean 為 true 顯示文字
     * [1] => 如果 $boolean 為 false 顯示文字
     * [2] => 秒數
     * [3] => 地址
     *
     * @param Boolean $boolean
     * @param Array $array
     * @return Boolean
     */
    public function result(bool $boolean, array $array): bool
    {
        if ($boolean) {
            echo "<h1>$array[0]</h1>";
        } else {
            echo "<h1>$array[1]</h1>";
        }
        header('refresh:' . $array[2] . ';url="' . $array[3] . '"');
        return true;
    }

    /**
     * 網站路由
     *
     * @param Integer $layer
     * @return String
     */
    public function router(int $layer = 1): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $REQUEST = explode("/", $url);
        if (empty($REQUEST[$layer])) return "";
        return $REQUEST[$layer];
    }

    /**
     * 網站財產資源索引
     *
     * @param String $path
     * @return String
     */
    public function resources(string $path): string
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/assets/' . $path;
    }

    /**
     * 網站資源索引
     *
     * @param String $path
     * @return String
     */
    public function website_path(string $path): string
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/' . $path;
    }

    /**
     * 取 $quantity 個 亂數且不重複
     *
     * @param Integer $min
     * @param Integer $max
     * @param Integer $quantity
     * @return array
     */
    public function random_not_repeat(int $min = 1, int $max = 100, int $quantity = 5): array
    {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

    /**
     * @param int $length
     * @return string
     */
    public function Get_eng_randoom(int $length = 10): string
    {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = random_int(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    /**
     * IP 位置
     *
     * @return string
     */
    public function GetIP(): string
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
            $cip = $_SERVER["REMOTE_ADDR"];
        } else {
            $cip = "無法取得IP位址！";
        }
        if ($cip === "::1") {
            $cip = '127.0.0.1';
        }
        return $cip;
    }

    public function get_browser($user_agent)
    {
        // Make case-insensitive.
        $t = strtolower($user_agent);

        // If the string *starts* with the string, strpos returns 0 (i.e., FALSE). Do a ghetto hack and start with a space.
        // "[strpos()] may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE."
        //     http://php.net/manual/en/function.strpos.php
        $t = " " . $t;

        // Humans / Regular Users
        if (strpos($t, 'opera') || strpos($t, 'opr/')) return 'Opera';
        elseif (strpos($t, 'edge')) return 'Edge';
        elseif (strpos($t, 'chrome')) return 'Chrome';
        elseif (strpos($t, 'safari')) return 'Safari';
        elseif (strpos($t, 'firefox')) return 'Firefox';

        // Search Engines
        elseif (strpos($t, 'google')) return '[Bot] Googlebot';
        elseif (strpos($t, 'bing')) return '[Bot] Bingbot';
        elseif (strpos($t, 'slurp')) return '[Bot] Yahoo! Slurp';
        elseif (strpos($t, 'duckduckgo')) return '[Bot] DuckDuckBot';
        elseif (strpos($t, 'baidu')) return '[Bot] Baidu';
        elseif (strpos($t, 'yandex')) return '[Bot] Yandex';
        elseif (strpos($t, 'sogou')) return '[Bot] Sogou';
        elseif (strpos($t, 'exabot')) return '[Bot] Exabot';
        elseif (strpos($t, 'msn')) return '[Bot] MSN';

        // Common Tools and Bots
        elseif (strpos($t, 'mj12bot')) return '[Bot] Majestic';
        elseif (strpos($t, 'ahrefs')) return '[Bot] Ahrefs';
        elseif (strpos($t, 'semrush')) return '[Bot] SEMRush';
        elseif (strpos($t, 'rogerbot') || strpos($t, 'dotbot')) return '[Bot] Moz or OpenSiteExplorer';
        elseif (strpos($t, 'frog') || strpos($t, 'screaming')) return '[Bot] Screaming Frog';

        // Miscellaneous
        elseif (strpos($t, 'facebook')) return '[Bot] Facebook';
        elseif (strpos($t, 'pinterest')) return '[Bot] Pinterest';

        // Check for strings commonly used in bot user agents
        elseif (strpos($t, 'crawler') || strpos($t, 'api') ||
            strpos($t, 'spider') || strpos($t, 'http') ||
            strpos($t, 'bot') || strpos($t, 'archive') ||
            strpos($t, 'info') || strpos($t, 'data')) return '[Bot] Other';

        return "NULL";
    }

    /**
     * @return string
     */
    public function GetDevice(): ?string
    {
        $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
        if (stripos($_SERVER['HTTP_USER_AGENT'], "Android") && stripos($_SERVER['HTTP_USER_AGENT'], "mobile")) {
            $Android = true;
        } else if (stripos($_SERVER['HTTP_USER_AGENT'], "Android")) {
            $Android = false;
            $AndroidTablet = true;
        } else {
            $Android = false;
            $AndroidTablet = false;
        }
        $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
        $BlackBerry = stripos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
        $RimTablet = stripos($_SERVER['HTTP_USER_AGENT'], "RIM Tablet");

        if ($iPod || $iPhone) {
            return 'iPhone';
        } else if ($iPad) {
            return 'iPad';
        } else if ($Android) {
            return 'Android';
        } else if ($AndroidTablet) {
            return 'AndroidTablet';
        } else if ($webOS) {
            return 'webOS';
        } else if ($BlackBerry) {
            return 'BlackBerry';
        } else if ($RimTablet) {
            return 'RimTablet';
        } else {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $os_platform = "Unknown OS Platform";
            $os_array = array(
                '/windows nt 10/i' => 'Windows 10',
                '/windows nt 6.3/i' => 'Windows 8.1',
                '/windows nt 6.2/i' => 'Windows 8',
                '/windows nt 6.1/i' => 'Windows 7',
                '/windows nt 6.0/i' => 'Windows Vista',
                '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
                '/windows nt 5.1/i' => 'Windows XP',
                '/windows xp/i' => 'Windows XP',
                '/windows nt 5.0/i' => 'Windows 2000',
                '/windows me/i' => 'Windows ME',
                '/win98/i' => 'Windows 98',
                '/win95/i' => 'Windows 95',
                '/win16/i' => 'Windows 3.11',
                '/macintosh|mac os x/i' => 'Mac OS X',
                '/mac_powerpc/i' => 'Mac OS 9',
                '/linux/i' => 'Linux',
                '/ubuntu/i' => 'Ubuntu',
                '/iphone/i' => 'iPhone',
                '/ipod/i' => 'iPod',
                '/ipad/i' => 'iPad',
                '/android/i' => 'Android',
                '/blackberry/i' => 'BlackBerry',
                '/webos/i' => 'Mobile',
            );

            foreach ($os_array as $regex => $value) {
                if (preg_match($regex, $user_agent)) {
                    $os_platform = $value;
                }
            }

            return $os_platform;
        }
    }

    /**
     * POST 方法
     *
     * @param String $string
     * @return Mixed
     */
    public function post(string $string = "")
    {
        if (@$string === "") {
            return $_POST;
        }

        return $_POST[$string];
    }

    /**
     * REQUEST 方法
     *
     * @param String $string
     * @return Mixed
     */
    public function request(string $string = "")
    {
        if (@$string === "") {
            return $_REQUEST;
        }

        return $_REQUEST[$string];
    }

    /**
     * GET 方法
     *
     * @param String $string
     * @return Mixed
     */
    public function get(string $string = "")
    {
        if (@$string === "") {
            return $_GET;
        }

        return $_GET[$string];
    }

    public function dsession(string $name = ""): void
    {
        unset($_SESSION[$name]);
    }

    public function cookie(string $string = "")
    {
        if (@$string === "") {
            return $_COOKIE;
        }

        return $_COOKIE[$string];
    }

    /**
     * FILES 方法
     *
     * @param String $string
     * @return Mixed
     */
    public function files(string $string = "")
    {
        if (@$string === "") {
            return $_FILES;
        }

        return $_FILES[$string];
    }

    /**
     * 設定 SESSION 方法
     *
     * @param Array $array
     * @return Boolean
     */
    public function set_cookie(array $array = [null, null, 0]): bool
    {
        setcookie($array[0], $array[1], ['samesite' => 'None', 'secure' => true, 'expires' => $array[2]]);
        return true;
    }

    /**
     * 釘選物件
     *
     * @param Mixed $mixed
     * @param string $string
     * @return Boolean
     */
    public function pinv($mixed, string $string = "Default"): bool
    {
        bdump($mixed, $string);
        return true;
    }

    /**
     * md5 訊息摘要演算法
     *
     * @param String $string
     * @return String
     */
    public function m(string $string): string
    {
        return md5($string);
    }

    /**
     * Array 搜尋數值差別
     *
     * @param Array $arr1
     * @param Array $arr2
     * @param boolean $result
     * @param boolean $notfoundmsg
     * @return array|bool
     */
    public function array_diffs(array $arr1, array $arr2, bool $result = false, bool $notfoundmsg = false)
    {
        $arr = [];
        foreach ($arr1 as $key => $value) {
            if (!empty($arr2[$key])) {
                if (@$arr1[$key] !== $arr2[$key]) {
                    $r = true;
                } else {
                    $r = false;
                }
                $arr[] = $r;
            }
            if ($notfoundmsg === true) {
                echo $key . " 未找相關指標名稱。<br>";
            }

        }
        //if($e>0) return false;
        if ($result === true) {
            return $arr;
        }
        return true;
    }

    /**
     * Array 由指標群組抽取特定指標
     *
     * *nametokey
     *  true:(JSON){"0":"1","1":"2","2":"3"}
     *  false:(JSON){"test1":"1","test2":"2","test3":"3"}
     *
     * *result
     *  true:(PHP)return array()
     *  false:(PHP)return boolean(true)
     *
     * @param Array $array
     * @param array|null $keyrows
     * @param boolean $nametokey
     * @param bool $result
     * @param bool $keyint
     * @return array|bool
     */
    public function array_splice_key(array &$array, array $keyrows = null, bool $nametokey = false, bool $result = false, bool $keyint = false)
    {
        $arr = [];
        if ($keyrows !== null && is_array($keyrows)) {
            if ($nametokey === true) {
                $int_arr = $this->array_keytovalue($array);
                foreach ($keyrows as $k => $v) {
                    if ($result === true) {
                        $arr[] = $array[$int_arr[$v]];
                    }
                    unset($array[$int_arr[$v]]);
                }
            } else {
                foreach ($array as $key => $value) {
                    for ($i = 0; $i <= count($keyrows) - 1; $i++) {
                        if ($key === $keyrows[$i]) {
                            if ($result === true) {
                                $arr[] = $array[$key];
                            }
                            unset($array[$key]);
                        }
                    }
                }
            }
            if ($keyint === true) {
                $array = $this->array_resort($array);
            }
            if ($result === true) {
                return $arr;
            }
            return true;
        }

        return false;
    }

    /**
     * Array 陣列指標名稱轉換為數字化指標名稱
     *
     * @param Array $array
     * @param Boolean $value
     * @param String $prefix
     * @return array|false
     */
    public function array_keytovalue(array $array, bool $value = false, string $prefix = ":")
    {
        $arr = [];
        $k = 0;
        if (is_array($array)) {
            foreach ($array as $key => $v) {
                if ($value === true) {
                    $arr[$k] = $key . $prefix . $v;
                } else {
                    $arr[$k] = $key;
                }
                $k++;
            }
            return $arr;
        }
        return false;
    }

    /**
     * Array 指標數值化排序
     *
     * @param Array $array
     * @param Int $offset
     * @param Int $k
     * @return array
     */
    public function array_resort(array $array, int $offset = -1, int $k = 0): array
    {
        $arr = [];
        foreach ($array as $key => $value) {
            if ($offset === (-1)) {
                $arr[$k] = $value;
                $k++;
            } else if ($k <= count($array) - $offset - 1) {
                $arr[$k] = $value;
                $k++;
            }
        }
        return $arr;
    }

    public function rrmdir($dir): void
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object !== "." && $object !== "..") {
                    if (filetype($dir . "/" . $object) === "dir") {
                        $this->rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }

                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    /**
     * 會員唯一辨識碼
     *
     * @return String
     */
    public function uid(): string
    {
        return uniqid('', true);
    }

    /**
     * 密碼加密
     *
     * @param String $password
     * @return String
     */
    public function passwd_encode(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * 密碼驗證
     *
     * @param String $password
     * @param String $hash
     * @return Boolean
     */
    public function passwd_decode(string $password, string $hash): ?bool
    {
        if (password_verify($password, $hash)) {
            return true;
        }

        return false;
    }

    public function callWebsite($URL)
    {
        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new RuntimeException('Error: ' . curl_error($ch), 400);
        }
        curl_close($ch);
        return $response;
    }

    public function jsone(array $arr)
    {
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }

    public function jsond(string $str)
    {
        return json_decode($str, true);
    }

    public function getCpuUsage()
    {
        $proc = getrusage();
        $e = $proc['ru_stime.tv_sec'] + ($proc['ru_stime.tv_usec'] * 1E-6);
        $t = round($proc['ru_stime.tv_sec'] + ($proc['ru_stime.tv_usec'] * 1E-6)) - $e;
        return $t;
    }

    public function getMemoryUsage()
    {
        return $this->convertByte(memory_get_usage(true));
    }

    public function convertByte($size)
    {
        $unit = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    /**
     * @param $member
     * @return string|void
     */
    public function getMemberType($type)
    {
        switch ($type) {
            case "0":
                return "普通帳號";
            case "1":
                return "API連接帳號";
            case "2":
                return "完全帳號";
        }
    }

    public function getSource($str)
    {
        $str1 = "";
        $arr = $this->exp(",", $str);
        foreach ($arr as $value) {
            $arr1 = $this->exp(":", $value);
            switch ($arr1[0]) {
                case "f":
                    $str1 .= "檔案名稱：" . $arr1[1] . "<br>";
                    break;
                case "l":
                    $str1 .= "行數：" . $arr1[1] . "<br>";
                    break;
                case "a":
                    $str1 .= "用途：" . $arr1[1] . "<br>";
                    break;
            }
        }
        return $str1;
    }

    /**
     * 字串特徵分解
     *
     * @param String $prefix
     * @param String $string
     * @return Array
     */
    public function exp(string $prefix, string $string): array
    {
        return explode($prefix, $string);
    }

    public function getTruetoString($bool, $text = false)
    {
        if (!$text) {
            if ($bool == "true") {
                return '<span class="badge rounded-pill bg-success">開啟</span>';
            } elseif ($bool == "false") {
                return '<span class="badge rounded-pill bg-danger">關閉</span>';
            } else {
                return '<span class="badge rounded-pill bg-warning text-dark">異常</span>';
            }
        } else {
            if ($bool == "true") {
                return '開啟';
            } elseif ($bool == "false") {
                return '關閉';
            } else {
                return '異常';
            }
        }
    }

    public function getprivacy($privacy)
    {
        switch ($privacy) {
            case "public":
                return "公開";
                break;
            case "private":
                return "私人";
                break;
            case "protected":
                return "受保護";
                break;
        }
    }

    public function getInstanceAddress($onlyHostName = false, $return_array = false)
    {
        if (isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        if ($return_array) {
            return [$protocol, $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']];
        }
        if ($onlyHostName) {
            return $protocol . $_SERVER['HTTP_HOST'];
        } else {
            return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
    }

}
