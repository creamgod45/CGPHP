<?php

namespace Utils;

use FilesystemIterator;
use IteratorIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RuntimeException;
use Type\String\CGString;

/**
 *
 * Example usage:
 * $r = Utils::timeStamp(1709049600);
 * var_dump($r);
 *
 * @access public
 * @version 3.0.0
 * @author creamgod45 <fuyin1054@gmail.com>
 * @package Utils
 * @since 8.1
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
    public static function timeStamp($time = null, string $format = 'Y-m-d H:i:s'): bool|string
    {
        if (empty($time)) {
            $time = time();
        }

        return date($format, $time);
    }

    /**
     * 取得有格式的時間字串(如果得到-1時會回傳不限時間)
     * etc
     * return (-1)=> 不限時間
     *        (1709049600)=> 2024-02-28 0:0:0
     * @param $time
     * @param string $format
     * @return string
     */
    public static function timeStamp2($time = null, string $format = 'Y-m-d H:i:s'): string
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
     *
     * @param $data
     * @param $default
     * @return mixed|null
     */
    public static function default($data, $default = null)
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
    public static function v($mixed): bool
    {
        dump($mixed);
        return true;
    }

    /**
     * 獲取檔案更改時間
     * @param string $filename
     * @return false|int
     */
    public static function filecode(string $filename)
    {
        return filemtime($filename);
    }

    /**
     * 前往指定網頁
     * [0] => 秒數
     * [1] => 地址
     *
     * @param array $array
     * @return Boolean
     */
    public static function goto_page(array $array): bool
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
     * @param array $array
     * @return Boolean
     */
    public static function result(bool $boolean, array $array): bool
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
    public static function router(int $layer = 1): string
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
    public static function resources(string $path): string
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/assets/' . $path;
    }

    /**
     * 網站資源索引
     *
     * @param String $path
     * @return String
     */
    public static function website_path(string $path): string
    {
        return '//' . $_SERVER['HTTP_HOST'] . '/' . $path;
    }

    /**
     * 改變檔案執行的目錄環境
     * @param $directory
     * @return bool|null
     */
    public static function setWorkingDirectory($directory)
    {
        if (is_dir($directory)) {
            // 尝试改变当前工作目录
            if (chdir($directory)) {
                return true;
            } else {
                return false;
            }
        } else {
            return null;
        }
    }

    /**
     * 取 $quantity 個 亂數且不重複
     *
     * @param Integer $min
     * @param Integer $max
     * @param Integer $quantity
     * @return array
     */
    public static function random_not_repeat(int $min = 1, int $max = 100, int $quantity = 5): array
    {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

    /**
     * @param int $length
     * @return string
     */
    public static function Get_eng_randoom(int $length = 10): string
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
    public static function GetIP(): string
    {
        if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $cip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } else if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
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

    public static function get_browser($user_agent)
    {
        // Make case-insensitive.
        $t = strtolower($user_agent);

        // If the string *starts* with the string, strpos returns 0 (i.e., FALSE). Do a ghetto hack and start with a space.
        // "[strpos()] may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE."
        //     http://php.net/manual/en/function.strpos.php
        $t = " " . $t;

        // Humans / Regular Users
        if (strpos($t, 'opera') || strpos($t, 'opr/')) return 'Opera'; elseif (strpos($t, 'edge')) return 'Edge';
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
        elseif (strpos($t, 'crawler') || strpos($t, 'api') || strpos($t, 'spider') || strpos($t, 'http') || strpos($t, 'bot') || strpos($t, 'archive') || strpos($t, 'info') || strpos($t, 'data')) return '[Bot] Other';

        return "NULL";
    }

    /**
     * @return string
     */
    public static function GetDevice(): ?string
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
            $os_array = array('/windows nt 10/i' => 'Windows 10', '/windows nt 6.3/i' => 'Windows 8.1', '/windows nt 6.2/i' => 'Windows 8', '/windows nt 6.1/i' => 'Windows 7', '/windows nt 6.0/i' => 'Windows Vista', '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', '/windows nt 5.1/i' => 'Windows XP', '/windows xp/i' => 'Windows XP', '/windows nt 5.0/i' => 'Windows 2000', '/windows me/i' => 'Windows ME', '/win98/i' => 'Windows 98', '/win95/i' => 'Windows 95', '/win16/i' => 'Windows 3.11', '/macintosh|mac os x/i' => 'Mac OS X', '/mac_powerpc/i' => 'Mac OS 9', '/linux/i' => 'Linux', '/ubuntu/i' => 'Ubuntu', '/iphone/i' => 'iPhone', '/ipod/i' => 'iPod', '/ipad/i' => 'iPad', '/android/i' => 'Android', '/blackberry/i' => 'BlackBerry', '/webos/i' => 'Mobile',);

            foreach ($os_array as $regex => $value) {
                if (preg_match($regex, $user_agent)) {
                    $os_platform = $value;
                }
            }

            return $os_platform;
        }
    }

    /**
     * 釘選物件
     *
     * @param Mixed $mixed
     * @param string $string
     * @return Boolean
     */
    public static function pinv($mixed, string $string = "Default"): bool
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
    public static function m(string $string): string
    {
        return md5($string);
    }

    public static function rrmdir($dir): void
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object !== "." && $object !== "..") {
                    if (filetype($dir . "/" . $object) === "dir") {
                        self::rrmdir($dir . "/" . $object);
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
    public static function uid($prefix = ''): string
    {
        return uniqid($prefix, true);
    }

    /**
     * 密碼加密
     *
     * @param String $password
     * @return String
     */
    public static function passwd_encode(string $password): string
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
    public static function passwd_decode(string $password, string $hash): ?bool
    {
        if (password_verify($password, $hash)) {
            return true;
        }

        return false;
    }

    public static function callWebsite($URL)
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

    public static function jsone(array $arr)
    {
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }

    public static function jsond(string $str)
    {
        return json_decode($str, true);
    }

    public static function getCpuUsage()
    {
        $proc = getrusage();
        $e = $proc['ru_stime.tv_sec'] + ($proc['ru_stime.tv_usec'] * 1E-6);
        $t = round($proc['ru_stime.tv_sec'] + ($proc['ru_stime.tv_usec'] * 1E-6)) - $e;
        return $t;
    }

    public static function getMemoryUsage()
    {
        return self::convertByte(memory_get_usage(true));
    }

    public static function convertByte($size)
    {
        $unit = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    /**
     * 字串特徵分解
     *
     * @param String $prefix
     * @param String $string
     * @return array
     */
    public static function exp(string $prefix, string $string): array
    {
        return explode($prefix, $string);
    }

    public static function getInstanceAddress($onlyHostName = false, $return_array = false)
    {
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
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

    /**
     * @param string $d
     * @return bool
     */
    public static function BooleanParse(string $d): bool
    {
        if ($d === "true") {
            return true;
        }
        return false;
    }

    /**
     * @param $path
     * @param bool $CGString
     * @param bool $deep
     * @param bool $fileOnly
     * @param bool $hideFileSearchable
     * @param array $filterFileExtension
     * @param int $filterSizeLimit
     * @param array $filterMIMEType
     * @param bool $filterPathName
     * @return array|CGString[]
     */
    public static function exploreDirectory($path, bool $CGString = false, bool $deep = false, bool $fileOnly = false, bool $hideFileSearchable = true, array $filterFileExtension = [], int $filterSizeLimit = -1, array $filterMIMEType = [], bool $filterPathName= false): array
    {
        $originFilePath="";
        $results = [];
        $directoryOptions = FilesystemIterator::SKIP_DOTS; // Always skip "." and ".."

        $dirIterator = new RecursiveDirectoryIterator($path, $directoryOptions);

        if ($deep) {
            $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);
        } else {
            $iterator = new IteratorIterator($dirIterator);
        }

        foreach ($iterator as $item) {
            if($originFilePath===""){
                $originFilePath=(new CGString($item->getPathname()))->Replace($item->getFilename())->toString();
            }
            $fileName = $item->getFilename();

            // Skip hidden files if required
            if ($hideFileSearchable && $fileName[0] === '.') {
                continue;
            }

            // File-only filter
            if ($fileOnly && !$item->isFile()) {
                continue;
            }

            // File extension filter
            $filePath = $item->getPathname();
            $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            if (!empty($filterFileExtension) && !in_array($fileExtension, $filterFileExtension)) {
                continue;
            }

            // File size filter
            $fileSize = $item->getSize();
            if ($filterSizeLimit !== -1 && $fileSize > $filterSizeLimit) {
                continue;
            }

            // MIME type filter
            if (!empty($filterMIMEType)) {
                $fileMIMEType = mime_content_type($filePath);
                if (!in_array($fileMIMEType, $filterMIMEType)) {
                    continue;
                }
            }

            $nowfilepath = (new CGString($filePath))->Replace($fileName)->toString();

            if($filterPathName && $nowfilepath === $originFilePath){
                if($CGString){
                    $results[] = new CGString($fileName);
                }else {
                    $results[] = $fileName;
                }
            }else{
                if($filterPathName) {
                    if($CGString){
                        $results[] = (new CGString($filePath))->Replace($originFilePath);
                    }else {
                        $results[] = (new CGString($filePath))->Replace($originFilePath)->toString();
                    }
                }else{
                    if($CGString){
                        $results[] = new CGString($filePath);
                    }else {
                        $results[] = $filePath;
                    }
                }
            }
        }

        return $results;
    }


}
