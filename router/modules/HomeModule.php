<?php
namespace modules;
use I18N\ELanguageCode;
use I18N\I18N;
use Utils\Module;

class HomeModule extends defaultModule implements Module
{
    public static function viewImagesInclude($var, I18N $i18N):string
    {
        if (
            $i18N->getLanguageCode()===ELanguageCode::zh_TW ||
            $i18N->getLanguageCode()===ELanguageCode::zh_MO ||
            $i18N->getLanguageCode()===ELanguageCode::zh_HK ||
            $i18N->getLanguageCode()===ELanguageCode::zh_SG ||
            $i18N->getLanguageCode()===ELanguageCode::zh_CN
        ) {
            return $var;
        }else{
            return base64_encode($var);
        }
    }
}
