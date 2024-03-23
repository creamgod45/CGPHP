# CGPHP Framework

## 資訊

- 作者: CreamGod45
- 版本: v1.5.0
- 類型: 測試版本(Beta)

# 幫助

### 安裝包

安裝錯誤時請自行加入，忽略的包命令

> composer install

### config.php

設定基本網站資訊利於產生，版權程式碼。

```php
<?php

require "autoload.php";

use Type\Array\CGArray;
use Utils\ConfigKeyField;

$CGArray = new CGArray();
$CGArray->Set(ConfigKeyField::Name->value, "CGPHP 網站");
$CGArray->Set(ConfigKeyField::Description->value, "CGPHP");
$CGArray->Set(ConfigKeyField::Version->value, "1.12.0");
$CGArray->Set(ConfigKeyField::Auther->value, "creamgod45");

return $CGArray;
```

#### 使用方式
可以被覆蓋，所以請小心使用。
```php
/**
 * @var CGArray $Config
 */
$Config->Get(ConfigKeyField::Name->value);
```

### 新增路由
編輯 `routers.php` 固定把頁面載入器放置在 `/router` 資料夾，確保統一性設定保護檔案也好設定。
```php
case '路由名稱':
    include_once "router/{檔案名稱}";
    break;
```
接下來新增檔案在 `/router` 檔案名稱為你上面的{檔案名稱}提示字。

接下來編輯 `/router/{檔案名稱}.php`
新版本，可以直接把自己的素材直接寫入 BootBuilder 方法快速加載網頁素材
```php
/**
 * @var Type\Array\CGArray $Config
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Server\ApplicationLayer $ApplicationLayer
 * @var Nette\Caching\Storages\FileStorage $storage
 * @var Nette\Caching\Cache $globalcache
 * @var Auth\UniqueVisiterID $uniqueVisiterID
 * @var I18N\I18N $i18N
 * @var bool $routers
 */
$bb = new BootBuilder();
// 自動讀取網頁使用者想要的語言
$i18N->setLanguageCode(ELanguageCode::valueof($Utils::default(router(2), "en_US")));
$bb->setTitle("首頁") // 設定頁面標題
    ->setModule(new HomeModule()) // 設定模組化存放區 (用於乾淨分離前端與後端)
    ->setContentFile("@Home.php") // 引入的檔案名稱
    ->bootstrap() // 引入的套件庫 可以自行新增
    ->fontawesome() // 引入的套件庫 可以自行新增
    ->initialize_css() // 引入的套件庫 可以自行新增
    ->menu() // 引入內建菜單系統
    ->setMenu(true); // 設定菜單系統顯示狀態
$us = new UserStorage($storage, $uniqueVisiterID->getKey()); // 使用者空間資料
if($us->hasData("member")){ 
    $timeout = $Request->Timeout("MemberDataUpdate", 60); // 定期更新資料
    if($timeout->isTimeout()){
        $timeout->addTimeout(60);
        $memberclass = $us->get("member");
        if ($memberclass instanceof \Auth\Member) {
            $memberclass->updateMemberData(); // 更新用戶資料
            $bb->setMember($memberclass);
        }
    }
    // 檢查是否有權限
    $bb->hasPermission(function ($if, $params){
        if($if){
            if ($params instanceof BootBuilder) {
                $utils = new \Utils\Utils();
                $utils::pinv("permission test pass");
            }
        }elseif($if===null){
            $utils = new \Utils\Utils();
            $utils::pinv("null member");
        }else{
            $utils = new \Utils\Utils();
            $utils::pinv("false");
        }
    }, $bb, "admin");
}
$bb->addAsset($bb->css("@Home.css",[], csstype::css)) // 引入自製的庫
    ->addAsset($bb->js("js/@Home.js",[])) // 引入自製的庫
    ->builder($Config,$Utils,$Request,$ApplicationLayer,$storage,$globalcache,$uniqueVisiterID, $i18N); // 建置頁面
```
舊版本
```php
<?php

use Utils\Htmlv2;

/**
 * @var Type\Array\CGArray $Config
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Server\ApplicationLayer $ApplicationLayer
 * @var Nette\Caching\Storages\FileStorage $storage
 * @var Nette\Caching\Cache $globalcache
 * @var Auth\UniqueVisiterID $uniqueVisiterID
 * @var I18N\I18N $i18N
 * @var bool $routers
 */
// 設定頁面標題 [非必要]
$title = "{頁面標題}";
// 引入外部資源。 [非必要]
$assets = [
    (new Htmlv2("link"))
        ->newLine(true)
        ->close(false)
        ->attr("href", $Utils->resources("css/lightbox.min.css"))
        ->attr("type", "text/css")
        ->attr("rel", "stylesheet")
        ->build(),
    (new Htmlv2("script"))
        ->newLine(true)
        ->close(true)
        ->attr("src", $Utils->resources("js/all.js"))
        ->build(),
];
//設定引入的檔案必要，這個的用途為讓排版與程式碼加載用程式碼隔離，以便於撰寫程式碼。 [必要]
$content = "{檔案名稱1}.php";
//在 </body> 與 </html> 中間插入的字符段，依照你的需求可以自由添加。 [非必要]
$footer = "";
//預加載時插入的 js 程式碼。 [非必要]
$script = "";
//載入畫面時，是否加載 router/templates/menu.php 全域選單顯示。 [非必要]
$menu = true;
include_once "templates/layout.php"; ?>
```

接下來 新增檔案 `router/templates/{檔案名稱1}.php`， 注意此處的{檔案名稱1}為上面程式碼所要求的名稱，請確保與程式碼相同。

編輯 `router/templates/{檔案名稱1}.php`
```php
<?php
/**
 * 這裡的區域是給予編輯器認知基本預定義變數。
 * @var Type\Array\CGArray $Config
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Server\ApplicationLayer $ApplicationLayer
 * @var Nette\Caching\Storages\FileStorage $storage
 * @var Nette\Caching\Cache $globalcache
 * @var Auth\UniqueVisiterID $uniqueVisiterID
 * @var I18N\I18N $i18N
 * @var bool $routers
 */

// 你可以自行定義特殊的選單顯示位置 前提是上級的檔案的 setMenu(false) 或 不設定 然後直接使用
include_once "menu.php";
?>

<!-- 下面的地方可以開始寫網站了，注意這裡開始就不用在建立基本的 head、body、html ，因為上面的操作已經綁你快速建立一個頁面，且幫你自動載入文件了。 -->
<div>
    Hello World!!
    當要使用 I18N時，預設英文
    <?= $i18N->getLanguage(\I18N\ELanguageText::RouterTemplatesHomePage_12) ?><br>
    設定後:
    <?php
        $i18N->setLanguageCode(\I18N\ELanguageCode::zh_TW);
        echo $i18N->getLanguage(\I18N\ELanguageText::RouterTemplatesHomePage_12) 
    ?>
</div>
```

接下來直接上傳FTP、XAMPP，預覽 http://127.0.0.1/路由名稱 就可以看到剛剛寫的頁面了。

# 更新日誌
- 20240324
    - 大改版此更新請注意，所有檔案並且備份
    - 新增 I18N
    - 修改眾多類別從新編寫改善
- 20231117
    - 大改版此更新請注意，所有檔案並且備份
    - 更新 lib/Server
    - 更新 lib/Auth
    - 更新 lib/Utils
    - 更新 lib/Shop
    - 更新 lib/File
    - 更新 lib/Type
- 20230806
    - 更新 CGArray
