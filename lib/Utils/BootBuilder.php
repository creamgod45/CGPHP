<?php

namespace Utils;

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
    private string $script = 'const $jq = jQuery.noConflict();';
    /**
     * @var bool
     */
    private bool $menu = true;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     */
    public function setAssets(array $assets): void
    {
        $this->assets = $assets;
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
     */
    public function setContentFile(string $contentFile): void
    {
        $this->contentFile = $contentFile;
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
     */
    public function setFooter(string $footer): void
    {
        $this->footer = $footer;
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
     */
    public function setScript(string $script): void
    {
        $this->script = $script;
    }

    /**
     * @return bool
     */
    public function isMenu(): bool
    {
        return $this->menu;
    }

    /**
     * @param bool $menu
     */
    public function setMenu(bool $menu): void
    {
        $this->menu = $menu;
    }

    public function googlefont()
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
    }

    /**
     * @param $obj CGArray|array|string 新增素材
     * @return void
     */
    public function addAsset($obj)
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
    }

    public function animate_css()
    {
        $this->addAsset($this->css("animate.css", [], csstype::css));
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

    public function jquery()
    {
        $this->addAsset($this->js("js/jquery.3.7.0.js", []));
    }

    public function js($path, $attrs)
    {
        $o = (new Htmlv2("script"))
            ->newLine(true)
            ->close(true)
            ->attr("src", (new Utils)->resources($path));
        foreach ($attrs as $attr) {
            $o->attr($attr[0], $attr[1]);
        }
        return $o->build();
    }

    public function fontawesome()
    {
        $this->addAsset($this->css("all.css", [], csstype::css));
        $this->addAsset($this->js("js/all.js", []));
    }

    public function loadimgjs()
    {
        $this->addAsset($this->js("js/loadimg.js", []));
    }

    public function lightbox_js()
    {
        $this->addAsset($this->js("js/lightbox.min.js", []));
    }

    public function moment_js()
    {
        $this->addAsset($this->js("js/moment.min.js", []));
    }

    public function bootstrap()
    {
        $this->addAsset($this->js("https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js", []));
        $this->addAsset($this->css("bootstrap.min.css", [], csstype::css));
        $this->addAsset($this->js("js/bootstrap.min.js", []));
    }

    public function initialize_css()
    {
        $this->addAsset($this->css("initialize.css", [], csstype::css));
    }

    public function corejs()
    {
        $this->addAsset($this->js("js/core.js", []));
    }

    public function menu(){
        $this->addAsset($this->css("menu.css", [], csstype::scss));
    }

    /**
     * @return void
     */
    public function builder($Config,$Utils,$Request,$ApplicationLayer,$storage,$cache,$uniqueVisiterID)
    {
        $routers = true;
        $title = $this->title;
        $assets = $this->assets;
        $content = $this->contentFile;
        $footer = $this->footer;
        $script = $this->script;
        $menu = $this->menu;
        include_once "router/templates/layout.php";
    }
}

enum csstype: string
{
    case css = "css";
    case scss = "scss";
    case sass = "sass";
    case null = "null";
}