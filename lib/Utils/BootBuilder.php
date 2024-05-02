<?php

namespace Utils;

use Auth\Member;
use modules\defaultModule;
use Type\Array\CGArray;

class BootBuilder
{
    /**
     * @var string 標題
     */
    private string $title = "";
    /**
     * @var array 引入資產、文件
     */
    private array $assets = [];
    /**
     * @var string 主要模板文件
     */
    private string $contentFile = "";
    /**
     * @var string 尾頁
     */
    private string $footer = "";
    /**
     * @var string js
     */
    private string $script = '';
    /**
     * @var mixed
     */
    private $menu = true;

    private Member $member;
    private Module $module;

    public function __construct()
    {
        $this->module = new defaultModule();
    }

    /**
     * @return Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * @param Member $member
     * @return BootBuilder
     */
    public function setMember(Member $member): BootBuilder
    {
        $this->member = $member;
        return $this;
    }

    /**
     * @param callable $if (true|false|null)
     * @param $params
     * @param string ...$permissions
     * @return BootBuilder
     */
    public function hasPermission(callable $if,$params,string ...$permissions):BootBuilder
    {
        if($this->member === false) {
            $if(null);
            return $this;
        }
        if($this->member === null) {
            $if(null);
            return $this;
        }
        if($this->member->getPermissionManager()->hasPermissions2(...$permissions)){
            $if(true);
        }else{
            $if(false);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return BootBuilder
     */
    public function setTitle(string $title): BootBuilder
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return array
     */
    public function getAssets(): array
    {
        return $this->assets;
    }

    /**
     * @param array $assets
     * @return BootBuilder
     */
    public function setAssets(array $assets): BootBuilder
    {
        $this->assets = $assets;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentFile(): string
    {
        return $this->contentFile;
    }

    /**
     * @param string $contentFile
     * @return BootBuilder
     */
    public function setContentFile(string $contentFile): BootBuilder
    {
        $this->contentFile = $contentFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * @param string $footer
     * @return BootBuilder
     */
    public function setFooter(string $footer): BootBuilder
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * @return string
     */
    public function getScript(): string
    {
        return $this->script;
    }

    /**
     * @param string $script
     * @return BootBuilder
     */
    public function setScript(string $script): BootBuilder
    {
        $this->script = $script;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMenu(): bool
    {
        return $this->menu;
    }

    /**
     * @param mixed $menu
     * @return BootBuilder
     */
    public function setMenu(mixed $menu): BootBuilder
    {
        $this->menu = $menu;
        return $this;
    }

    public function googlefont(): BootBuilder
    {
        $this->addAsset((new Htmlv2("link"))
            ->newLine(true)
            ->close(false)
            ->attr("href", "https://fonts.googleapis.com")
            ->attr("rel", "preconnect")
            ->build());
        $this->addAsset((new Htmlv2("link"))
            ->newLine(true)
            ->close(false)
            ->attr("href", "https://fonts.gstatic.com")
            ->attr("rel", "preconnect")
            ->attr("crossorigin", "")
            ->build());
        return $this;
    }

    public function lz_string()
    {
        $this->addAsset((new Htmlv2("script"))
            ->newLine(true)
            ->close(true)
            ->attr("src", "https://cdn.jsdelivr.net/npm/lz-string@1.5.0/libs/lz-string.min.js")
            ->build());
        return $this;
    }

    public function tailwind():BootBuilder
    {
        $this->addAsset((new Htmlv2("script"))
            ->newLine(true)
            ->close(true)
            ->attr("src", "https://cdn.tailwindcss.com")
            ->build());
        return $this;
    }

    /**
     * @param $obj CGArray|array|string 新增素材
     * @return void
     */
    public function addAsset($obj):BootBuilder
    {
        if ($obj instanceof CGArray) {
            foreach ($obj->toArray() as $item) {
                $this->assets[] = $item;
            }
        } elseif (is_array($obj)) {
            foreach ($obj as $item) {
                $this->assets[] = $item;
            }
        } elseif (is_string($obj)) {
            $this->assets[] = $obj;
        }
        return $this;
    }

    public function animate_css():BootBuilder
    {
        $this->addAsset($this->css("animate.css", [], csstype::css));
        return $this;
    }

    /**
     * @param string $path 檔案名稱
     * @param array $attrs 引入的屬性
     * @param csstype $csstype 快速選擇 path 前綴的資料夾名稱
     * @return string
     */
    public function css(string $path, array $attrs, csstype $csstype = csstype::null)
    {
        if ($csstype == csstype::css) {
            $path = "css/" . $path;
        } elseif ($csstype == csstype::scss) {
            $path = "scss/" . $path;
        } elseif ($csstype == csstype::sass) {
            $path = "sass/" . $path;
        }
        $o = (new Htmlv2("link"))
            ->newLine(true)
            ->close(false)
            ->attr("href", (new Utils)->resources($path))
            ->attr("type", "text/css")
            ->attr("rel", "stylesheet");
        foreach ($attrs as $attr) {
            $o->attr($attr[0], $attr[1]);
        }
        return $o->build();
    }

    public function jquery():BootBuilder
    {
        $this->addAsset($this->js("js/jquery.3.7.0.js", []));
        return $this;
    }

    public function video_js($string="zh-TW"): BootBuilder
    {
        $this->addAsset($this->css("video-js.min.css", [], csstype::css));
        $this->addAsset($this->css("vjs.qualityLevel.css", [], csstype::css));
        $this->addAsset($this->js("js/video.min.js", [], JSLoadMethod::null));
        $this->addAsset($this->js("js/videojs-contrib-quality-levels.min.js", [], JSLoadMethod::null));
        $this->addAsset($this->js("js/lang/$string.js", [], JSLoadMethod::null));
        $this->addAsset($this->js("js/videojs-builder.min.js", []));
        return $this;
    }

    public function js($path, $attrs, JSLoadMethod $JSLoadMethod = JSLoadMethod::null)
    {
        $o = (new Htmlv2("script"))
            ->newLine(true)
            ->close(true)
            ->attr($JSLoadMethod->value, "")
            ->attr("src", (new Utils)->resources($path));
        foreach ($attrs as $attr) {
            $o->attr($attr[0], $attr[1]);
        }
        return $o->build();
    }

    public function fontawesome(): BootBuilder
    {
        $this->addAsset($this->css("all.css", [], csstype::css));
        $this->addAsset($this->js("js/all.js", []));
        return $this;
    }

    public function loadimgjs(): BootBuilder
    {
        $this->addAsset($this->js("js/loadimg.js", []));
        return $this;
    }

    public function lightbox(): BootBuilder
    {
        $this->addAsset($this->css("lightbox.min.css", [], csstype::css));
        $this->addAsset($this->js("js/lightbox.min.js", []));
        return $this;
    }

    public function moment_js(): BootBuilder
    {
        $this->addAsset($this->js("js/moment.min.js", []));
        return $this;
    }

    public function bootstrap(): BootBuilder
    {
        $this->addAsset(
            (new Htmlv2("script"))
                ->close(true)
                ->newLine(true)
                ->attr("src", "https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js")
                ->build()
        );
        $this->addAsset($this->css("bootstrap.min.css", [], csstype::css));
        $this->addAsset($this->js("js/bootstrap.min.js", []));
        return $this;
    }

    public function initialize_css(): BootBuilder
    {
        $this->addAsset($this->css("initialize.css", [], csstype::scss));
        return $this;
    }

    public function corejs(): BootBuilder
    {
        $this->addAsset($this->js("js/core.js", []));
        return $this;
    }

    public function menu(): BootBuilder
    {
        $this->addAsset($this->css("menu.o.css", [], csstype::scss));
        return $this;
    }

    /**
     * @return void
     */
    public function builder($Config,$Utils,$Request,$ApplicationLayer,$storage,$globalcache,$uniqueVisiterID, $i18N)
    {
        $routers = true;
        $title = $this->title;
        $assets = $this->assets;
        $content = $this->contentFile;
        $footer = $this->footer;
        $script = $this->script;
        $menu = $this->menu;
        $module=$this->module;
        include_once "router/templates/layout.php";
        $Utils->pinv($this, "BootBuilder");
    }

    /**
     * @return Module
     */
    public function getModule(): Module
    {
        return $this->module;
    }

    /**
     * @param Module $module
     * @return BootBuilder
     */
    public function setModule(Module $module)
    {
        $this->module = $module;
        return $this;
    }
}

enum csstype: string
{
    case css = "css";
    case scss = "scss";
    case sass = "sass";
    case null = "null";
}

enum JSLoadMethod:string
{
    case async="async";
    case defer="defer";
    case null="";
}
