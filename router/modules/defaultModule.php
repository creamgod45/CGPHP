<?php
namespace modules;
use I18N\ELanguageCode;
use I18N\ELanguageText;
use Utils\Htmlv2;
use Utils\Module;

class defaultModule implements Module
{
    // \Type\Array\CGArray $Config, \Utils\Utils $Utils,\Server\Request $Request, \Server\ApplicationLayer $ApplicationLayer, \Nette\Caching\Storages\FileStorage $storage, \Nette\Caching\Cache $globalcache, \Auth\UniqueVisiterID $uniqueVisiterID, \I18N\I18N $i18N, bool $routers
    public static function buildSelectLanguageBar(\I18N\I18N $i18N):string
    {
        $strings="";
        $ELanguageCodes = $i18N->getELanguageCodeList();
        foreach ($ELanguageCodes as $lang) {
            if($lang === $i18N->getLanguageCode()) continue;
            $strings .= (new Htmlv2("option"))
                ->close(true)
                ->newLine(true)
                ->attr("value", $lang->name)
                ->body($i18N->getLanguage(ELanguageText::valueof($lang->name)))
                ->build();
        }
        return $strings;
    }
}
