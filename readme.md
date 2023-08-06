# CGPHP Framework

## 資訊

- 作者: CreamGod45
- 版本: v1.3.0
- 類型: 內部測試版本(Alpha)

# 幫助

### 安裝包

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
$CGArray->Set(ConfigKeyField::Version->value, "1.11.0");
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

```php
<?php

use Utils\Htmlv2;

/**
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Server\Request\ApplicationLayer $ApplicationLayer
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
 * @var array $Config
 * @var Utils\Utils $Utils
 * @var Server\Request $Request
 * @var Server\Request\ApplicationLayer $ApplicationLayer
 */
?>
<!-- 下面的地方可以開始寫網站了，注意這裡開始就不用在建立基本的 head、body、html ，因為上面的操作已經綁你快速建立一個頁面，且幫你自動載入文件了。 -->
<div>
    Hello World!!
</div>
```

接下來直接上傳FTP、XAMPP，預覽 http://127.0.0.1/路由名稱 就可以看到剛剛寫的頁面了。

# 更新日誌

- 20230806
    - 更新 CGArray


# TODO 

