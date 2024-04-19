<?php

namespace Utils;

use Exception;
use JetBrains\PhpStorm\Deprecated;
use Nette\Utils\FileSystem;
use Server;
use Type\Array\CGArray;
use Type\String\CGString;
#[Deprecated(
    reason: '套件已經不實用!! API過舊'
)]
class Parser
{
    protected static array $MagicTagList = [];
    private static Utils $Utils;
    protected array $ParserLinkList = [];
    protected string $string;
    private array $var = [];

    function __construct($s)
    {
        self::$Utils = new Utils();
        $this->string = $s;
        $this->init();
        $this->scanMagicTag();
        $this->ParseMagicTag();
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function init()
    {

    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function scanMagicTag()
    {
        $CGString = new CGString($this->string);
        $CGArray = $CGString->whileIndexOf("@");
        self::$MagicTagList = $CGArray->toArray();
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function ParseMagicTag()
    {
        foreach ($this->getAllMagicTags() as $key => $index) {
            $substr = substr($this->string, $index);
            // 將 $substr 字串以逗號為分隔符轉換為陣列
            $var = explode(';', $substr);
            if (count($var) >= 1) {
                $method = $var[0];
                $CGArray = new CGArray($var);
                $CGArray->RemoveCallBack(0)->resort();
                if ($method === "@var")
                    $CGArray = new CGArray([$CGArray->Get(0)]);
                try {
                    $this->MethodScript($method, ...$CGArray->toArray());
                } catch (Exception $e) {
                    self::$Utils->pinv($e);
                }
                //var_dump(["method" => $method, "path" => $CGArray]);
            }
        }
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     *
     * @return array
     */
    function getAllMagicTags()
    {
        return self::$MagicTagList;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @throws Exception
     */
    function MethodScript($method, ...$value)
    {
        if (empty($value)) return false;
        if (empty($method)) return false;
        switch ($method) {
            case "@include":
                $this->includer($value[0]);
                break;
            case '@include_parse':
                $read = FileSystem::read(PATH . $value[0]);
                $parser = new Parser($read);
                $parser->scanMagicTag();
                $parser->ParseMagicTag();

                $this->ParserLinkList[] = $parser;
                $this->import($parser);
                break;
            case "@placeholder":
                break;
            case "@setvar":
                (new Server\SESSION("Parser." . $value[0], true))->Set($value[1]);
                break;
            case "@var":
                $this->placeHolder("@var;" . $value[0] . ";", (new Server\SESSION("Parser." . $value[0], true))->Get());
                break;
            case "@string":
                echo $this->string;
                break;
        }
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * 掃描到 @include 時將會自動加載元素
     * @param $method
     * @return void
     */
    function includer($path)
    {
        include_once PATH . $path;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function import(Parser $p)
    {
        $this->setvar($p->getvar());
        $this->setstring($p->getstring());
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function getvar()
    {
        return $this->var;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function setvar($arr)
    {
        $this->var[] = $arr;
        return $this;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function getstring()
    {
        return $this->string;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function setstring($str)
    {
        $this->string .= $str;
        return $this;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function placeHolder($placeholder, $value)
    {
        $this->string = str_replace($placeholder, $value, $this->string);
        return $this;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function getParserLinkList()
    {
        return $this->ParserLinkList;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function setParserLinkList($arr)
    {
        $this->ParserLinkList[] = $arr;
        return $this;
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function showVar()
    {
        var_dump($this->var);
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function hasParserLinkList()
    {
        return !empty($this->ParserLinkList);
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    /**
     * @param int $index
     * @return false|Parser
     */
    function getParserLinkListItem(int $index)
    {
        if (!isset($this->ParserLinkList[$index])) {
            return false;
        }
        $var = $this->ParserLinkList[$index];
        if (@!empty($var)) {
            return $var;
        }
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function getParserLinkListSize()
    {
        return count($this->ParserLinkList);
    }
    #[Deprecated(
        reason: '套件已經不實用!! API過舊'
    )]
    function debug()
    {
        return [$this->var, $this->string, $this->ParserLinkList];
    }
}
