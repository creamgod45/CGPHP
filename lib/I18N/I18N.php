<?php

namespace I18N;

use JetBrains\PhpStorm\Deprecated;
use Nette\Utils\FileSystem;
use Symfony\Component\Yaml\Yaml;
use Type\Array\CGArray;
use Type\String\CGString;

// https://www.iana.org/assignments/language-subtag-registry/language-subtag-registry

class I18N
{
    /**
     * @var ELanguageCode $languageCode 現在語系
     */
    private ELanguageCode $languageCode;

    /**
     * @var array $languageTextList 語言儲存容器
     */
    private array $languageTextList = [];

    /**
     * @var ELanguageCode[] $ELanguageCodeList 限制編譯編譯的語言選項
     */
    private array $ELanguageCodeList=[];

    /**
     * @param ELanguageCode|null $languageCode 設定現在語言狀態並且讀取語言檔案並覆蓋 Set the current language status and read the language file and overwrite it
     * @param bool $CompileMode 直接編譯模式(忽略沒有編譯過的詞條) Direct compilation mode (ignoring uncompiled entries)
     * @param ELanguageCode[] $limitMode 允許編譯的語言 Languages that allow compilation
     */
    public function __construct(?ELanguageCode $languageCode = ELanguageCode::en_US, bool $CompileMode= false, array $limitMode=[])
    {
        $this->ELanguageCodeList=$limitMode;
        $this->buildFirstLanguageFile($CompileMode, $limitMode);
        if ($languageCode !== null) {
            // 選擇語系
            $this->setLanguageCode($languageCode);
        }
        $this->buildMissingLanguageDictionary($limitMode);
    }

    /**
     * @return ELanguageCode[]
     */
    public function getELanguageCodeList(): array
    {
        return $this->ELanguageCodeList;
    }

    /**
     * @param ELanguageCode[] $ELanguageCodeList
     * @return I18N
     */
    public function setELanguageCodeList(array $ELanguageCodeList): I18N
    {
        $this->ELanguageCodeList = $ELanguageCodeList;
        return $this;
    }

    /**
     * @param ELanguageCode[] $limitMode
     * @return void
     */
    public function buildMissingLanguageDictionary(array $limitMode=[]): void
    {
        $this->buildLanguageMap();
        if(!empty($limitMode)){
            $this->extracted($limitMode);
        }else{
            $this->extracted(ELanguageCode::cases());
        }
    }

    /**
     * @param $CompileMode
     * @param ELanguageCode[] $limitMode
     * @return void
     */
    public function buildFirstLanguageFile($CompileMode,array $limitMode=[]): void
    {
        if (file_exists("I18N.lock") && !$CompileMode) return;
        FileSystem::write("I18N.lock", time() . ": build I18N");
        $this->buildLanguageMap();
        $listtext=[];
        foreach ($this->languageTextList as $item) {
            $listtext [] = $item[0];
        }
        $dump = Yaml::dump($listtext);
        if(!empty($limitMode)){
            foreach ($limitMode as $case) {
                FileSystem::write("lib/I18N/languages/" . $case->name . ".yml", $dump);
            }
        }else{
            foreach (ELanguageCode::cases() as $case) {
                FileSystem::write("lib/I18N/languages/" . $case->name . ".yml", $dump);
            }
        }
    }

    public function buildCustomizedMap()
    {
        new DictionaryMap($this);
    }

    public function buildLanguageMap(): void
    {
        $this->languageCodeDictionaryBuilder();
        $this->buildCustomizedMap();
    }

    public function languageCodeDictionaryBuilder(): void
    {
        $this->setLanguagev2(ELanguageText::af_ZA, "Afrikaans (South Africa)");
        $this->setLanguagev2(ELanguageText::am_ET, "Amharic (Ethiopia)");
        $this->setLanguagev2(ELanguageText::ar_EG, "Arabic (Egyptian)");
        $this->setLanguagev2(ELanguageText::ar_SA, "Arabic (Saudi Arabia)");
        $this->setLanguagev2(ELanguageText::as_IN, "Assamese (India)");
        $this->setLanguagev2(ELanguageText::ay_BO, "Aymara (Bolivia)");
        $this->setLanguagev2(ELanguageText::az_AZ, "Azerbaijani (Azerbaijan)");
        $this->setLanguagev2(ELanguageText::ba_RU, "Bashkir (Russian)");
        $this->setLanguagev2(ELanguageText::be_BY, "Belarusian (Belarus)");
        $this->setLanguagev2(ELanguageText::bg_BG, "Bulgarian (Bulgarian)");
        $this->setLanguagev2(ELanguageText::bn_IN, "Bengali (India)");
        $this->setLanguagev2(ELanguageText::bs_BA, "Bosnian (Bosnia and Herzegovina)");
        $this->setLanguagev2(ELanguageText::cr_CA, "Cree (Canada)");
        $this->setLanguagev2(ELanguageText::cs_CZ, "Czech (Czech Republic)");
        $this->setLanguagev2(ELanguageText::cy_GB, "Welsh (UK)");
        $this->setLanguagev2(ELanguageText::da_DK, "Danish (Denmark)");
        $this->setLanguagev2(ELanguageText::de_CH, "High German (Switzerland)");
        $this->setLanguagev2(ELanguageText::de_DE, "German (Germany)");
        $this->setLanguagev2(ELanguageText::dv_MV, "Dhivehi (Maldives)");
        $this->setLanguagev2(ELanguageText::dz_BT, "Dzongkha (Bhutan)");
        $this->setLanguagev2(ELanguageText::el_GR, "Greek (Greece)");
        $this->setLanguagev2(ELanguageText::en_AU, "English (Australia)");
        $this->setLanguagev2(ELanguageText::en_GB, "English (UK)");
        $this->setLanguagev2(ELanguageText::en_US, "English (US)");
        $this->setLanguagev2(ELanguageText::es_ES, "Spanish (Spain)");
        $this->setLanguagev2(ELanguageText::es_MX, "Spanish (Mexico)");
        $this->setLanguagev2(ELanguageText::et_EE, "Estonian (Estonia)");
        $this->setLanguagev2(ELanguageText::fa_IR, "Persian (Iran)");
        $this->setLanguagev2(ELanguageText::fi_FI, "Finnish (Finland)");
        $this->setLanguagev2(ELanguageText::fil_PH, "Tagalog (Philippines)");
        $this->setLanguagev2(ELanguageText::fj_FJ, "Fijian (Fiji)");
        $this->setLanguagev2(ELanguageText::fo_FO, "Faroe (Faroe Islands)");
        $this->setLanguagev2(ELanguageText::fr_BE, "French (Belgium)");
        $this->setLanguagev2(ELanguageText::fr_CA, "French (Canada)");
        $this->setLanguagev2(ELanguageText::fr_FR, "French (France)");
        $this->setLanguagev2(ELanguageText::ga_IE, "Irish (Ireland)");
        $this->setLanguagev2(ELanguageText::gd_GB, "Scottish Gaelic (UK)");
        $this->setLanguagev2(ELanguageText::gil_KI, "Gibbert (Giribati)");
        $this->setLanguagev2(ELanguageText::gu_IN, "Gujarati (India)");
        $this->setLanguagev2(ELanguageText::ha_NG, "Hausa (Nigeria)");
        $this->setLanguagev2(ELanguageText::he_IL, "Hebrew (Israel)");
        $this->setLanguagev2(ELanguageText::hi_IN, "Hindi (India)");
        $this->setLanguagev2(ELanguageText::hr_HR, "Croatian (Croatia)");
        $this->setLanguagev2(ELanguageText::hu_HU, "Hungarian (Hungary)");
        $this->setLanguagev2(ELanguageText::hy_AM, "Armenian (Armenian)");
        $this->setLanguagev2(ELanguageText::ibb_NG, "Ibibio (Nigeria)");
        $this->setLanguagev2(ELanguageText::id_ID, "Bahasa Indonesia (Indonesia)");
        $this->setLanguagev2(ELanguageText::ig_NG, "Igbo (Nigeria)");
        $this->setLanguagev2(ELanguageText::is_IS, "Icelandic (Iceland)");
        $this->setLanguagev2(ELanguageText::it_IT, "Italian (Italian)");
        $this->setLanguagev2(ELanguageText::iu_CA, "Inuktitut (Canada)");
        $this->setLanguagev2(ELanguageText::ja_JP, "Japanese (Japan)");
        $this->setLanguagev2(ELanguageText::ka_GE, "Georgian (Georgia)");
        $this->setLanguagev2(ELanguageText::kk_KZ, "Kazakh (Kazakh)");
        $this->setLanguagev2(ELanguageText::km_KH, "Khmer (Cambodia)");
        $this->setLanguagev2(ELanguageText::kn_IN, "Kannada (India)");
        $this->setLanguagev2(ELanguageText::ko_KP, "Korean (North Korea)");
        $this->setLanguagev2(ELanguageText::ko_KR, "Korean (South Korea)");
        $this->setLanguagev2(ELanguageText::ku_TR, "Kurdish (Türkiye)");
        $this->setLanguagev2(ELanguageText::kw_GB, "Cornish (UK)");
        $this->setLanguagev2(ELanguageText::ky_KG, "Kyrgyz (Kyrgyz)");
        $this->setLanguagev2(ELanguageText::ln_CD, "Lingala (Democratic Republic of Congo)");
        $this->setLanguagev2(ELanguageText::lo_LA, "Lao language (Laos)");
        $this->setLanguagev2(ELanguageText::lt_LT, "Lithuanian (Lithuania)");
        $this->setLanguagev2(ELanguageText::lv_LV, "Latvian (Latvian)");
        $this->setLanguagev2(ELanguageText::mg_MG, "Malagasy (Madagascar)");
        $this->setLanguagev2(ELanguageText::mh_MH, "Marshallese (Marshall Islands)");
        $this->setLanguagev2(ELanguageText::mi_NZ, "Maori (New Zealand)");
        $this->setLanguagev2(ELanguageText::mk_MK, "Macedonian (North Macedonia)");
        $this->setLanguagev2(ELanguageText::ml_IN, "Malayalam (India)");
        $this->setLanguagev2(ELanguageText::mn_MN, "Mongolian (Mongolia)");
        $this->setLanguagev2(ELanguageText::mn_Mong_CN, "Mongolian (Mongolian script, China)");
        $this->setLanguagev2(ELanguageText::mr_IN, "Marathi (India)");
        $this->setLanguagev2(ELanguageText::ms_MY, "Malay (Malaysia)");
        $this->setLanguagev2(ELanguageText::mt_MT, "Maltese (Malta)");
        $this->setLanguagev2(ELanguageText::my_MM, "Burmese (Myanmar)");
        $this->setLanguagev2(ELanguageText::na_NR, "Nauru (Nauru)");
        $this->setLanguagev2(ELanguageText::ne_NP, "Nepali (Nepal)");
        $this->setLanguagev2(ELanguageText::nl_NL, "Dutch (Netherlands)");
        $this->setLanguagev2(ELanguageText::no_NO, "Norwegian (Norway)");
        $this->setLanguagev2(ELanguageText::ny_MW, "Chichewa (Malawi)");
        $this->setLanguagev2(ELanguageText::oj_CA, "Ojibway (Canada)");
        $this->setLanguagev2(ELanguageText::or_IN, "Oriya (India)");
        $this->setLanguagev2(ELanguageText::pa_Arab_PK, "Punjabi (Arabic script, Pakistan)");
        $this->setLanguagev2(ELanguageText::pa_IN, "Punjabi (India)");
        $this->setLanguagev2(ELanguageText::pl_PL, "Polish (Polish)");
        $this->setLanguagev2(ELanguageText::ps_AF, "Pashto (Afghanistan)");
        $this->setLanguagev2(ELanguageText::pt_BR, "Portuguese (Brazil)");
        $this->setLanguagev2(ELanguageText::pt_PT, "Portuguese (Portugal)");
        $this->setLanguagev2(ELanguageText::qu_PE, "Quechua (Peru)");
        $this->setLanguagev2(ELanguageText::ro_RO, "Romanian (Romania)");
        $this->setLanguagev2(ELanguageText::ru_RU, "Russian (Russia)");
        $this->setLanguagev2(ELanguageText::rw_RW, "Rwanda (Rwanda)");
        $this->setLanguagev2(ELanguageText::sa_IN, "Sanskrit (India)");
        $this->setLanguagev2(ELanguageText::sd_Deva_IN, "Sindhi (Devava, India)");
        $this->setLanguagev2(ELanguageText::sd_PK, "Sindhi (Pakistan)");
        $this->setLanguagev2(ELanguageText::si_LK, "Sinhala (Sri Lanka)");
        $this->setLanguagev2(ELanguageText::sk_SK, "Slovak (Slovakia)");
        $this->setLanguagev2(ELanguageText::sl_SI, "Slovenian (Slovenia)");
        $this->setLanguagev2(ELanguageText::sm_WS, "Samoan (Samoan)");
        $this->setLanguagev2(ELanguageText::sn_ZW, "Shona (Zimbawi)");
        $this->setLanguagev2(ELanguageText::so_DJ, "Somali (Djibouti)");
        $this->setLanguagev2(ELanguageText::so_SO, "Somali (Somalia)");
        $this->setLanguagev2(ELanguageText::sq_AL, "Albanian (Albania)");
        $this->setLanguagev2(ELanguageText::sr_RS, "Serbian (Serbia)");
        $this->setLanguagev2(ELanguageText::ss_SZ, "Swati (Swaziland)");
        $this->setLanguagev2(ELanguageText::st_ZA, "Southern Sotho (South Africa)");
        $this->setLanguagev2(ELanguageText::sv_SE, "Swedish (Sweden)");
        $this->setLanguagev2(ELanguageText::sw_KE, "Swahili (Kenya)");
        $this->setLanguagev2(ELanguageText::syr_SY, "Syriac (Syria)");
        $this->setLanguagev2(ELanguageText::ta_IN, "Tamil (India)");
        $this->setLanguagev2(ELanguageText::te_IN, "Telugu (India)");
        $this->setLanguagev2(ELanguageText::tg_TJ, "Tajik (Tajikistan)");
        $this->setLanguagev2(ELanguageText::th_TH, "Thai (Thailand)");
        $this->setLanguagev2(ELanguageText::ti_ER, "Tigrinya (Eritrea)");
        $this->setLanguagev2(ELanguageText::ti_ET, "Tigrinya (Ethiopia)");
        $this->setLanguagev2(ELanguageText::tj_TJ, "Tajik (Tajikistan)");
        $this->setLanguagev2(ELanguageText::tk_TM, "Turkmen (Turkmenistan)");
        $this->setLanguagev2(ELanguageText::tl_PH, "Tagalog (Philippines)");
        $this->setLanguagev2(ELanguageText::tn_BW, "Tswana (Botswana)");
        $this->setLanguagev2(ELanguageText::to_TO, "Tongan (Tongan)");
        $this->setLanguagev2(ELanguageText::tr_TR, "Turkish (Türkiye)");
        $this->setLanguagev2(ELanguageText::tt_RU, "Tatar (Russian)");
        $this->setLanguagev2(ELanguageText::tum_MW, "Tumbuka (Malawi)");
        $this->setLanguagev2(ELanguageText::ty_PF, "Tahiti (French Polynesia)");
        $this->setLanguagev2(ELanguageText::udm_RU, "Udmurt (Russian)");
        $this->setLanguagev2(ELanguageText::ug_CN, "Uyghur (China)");
        $this->setLanguagev2(ELanguageText::uk_UA, "Ukrainian (Ukraine)");
        $this->setLanguagev2(ELanguageText::ur_PK, "Urdu (Pakistan)");
        $this->setLanguagev2(ELanguageText::uz_UZ, "Uzbek (Uzbek)");
        $this->setLanguagev2(ELanguageText::ve_ZA, "Venda (South Africa)");
        $this->setLanguagev2(ELanguageText::vi_VN, "Vietnamese (Vietnam)");
        $this->setLanguagev2(ELanguageText::xh_ZA, "Xhosa (South Africa)");
        $this->setLanguagev2(ELanguageText::yo_NG, "Yoruba (Nigeria)");
        $this->setLanguagev2(ELanguageText::zh_CN, "Simplified Chinese (China)");
        $this->setLanguagev2(ELanguageText::zh_TW, "Traditional Chinese (Taiwan)");
        $this->setLanguagev2(ELanguageText::zh_HK, "Traditional Chinese (Hong Kong)");
        $this->setLanguagev2(ELanguageText::zh_SG, "Traditional Chinese (Singapore)");
        $this->setLanguagev2(ELanguageText::zh_MO, "Traditional Chinese (Singapore)");
        $this->setLanguagev2(ELanguageText::zu_ZA, "Zulu (South Africa)");
    }

    /**
     * @param ELanguageText $elanguageText
     * @param string $value
     * @return $this
     * @deprecated 1.0.0(2024/04/19) 實現新的實作介面 {@see I18N::setLanguagev2()}
     */
    #[Deprecated(replacement: '%class%->setLanguagev2(%parametersList%)')]
    public function setLanguage(ELanguageText $elanguageText, string $value): static
    {
        $this->languageTextList[$elanguageText->name] = $value;
        return $this;
    }

    public function setLanguagev2(ELanguageText $elanguageText, string $value, bool $forceChangeValue=false){
        $this->languageTextList[$elanguageText->name] = [$value, $forceChangeValue];
        return $this;
    }

    /**
     * @return ELanguageCode
     */
    public function getLanguageCode(): ELanguageCode
    {
        return $this->languageCode;
    }


    public function setLanguageCode(ELanguageCode $languageCode): static
    {
        $this->languageCode = $languageCode;
        $this->reSelectLanguageFile();
        return $this;
    }

    /**
     * @param ELanguageCode[] $ELanguageCodeList
     * @return void
     */
    private function extracted(array $ELanguageCodeList): void
    {
        foreach ($ELanguageCodeList as $case) {
            if (!file_exists("lib/I18N/languages/" . $case->name . ".yml")) {
                //Utils::pinv("1");
                $listtext=[];
                foreach ($this->languageTextList as $item) {
                    $listtext [] = $item[0];
                }
                $dump = Yaml::dump($listtext);
                FileSystem::write("lib/I18N/languages/" . $case->name . ".yml", $dump);
                continue;
            }
            $languageYaml = $this->yamlController("lib/I18N/languages/" . $case->name . ".yml");
            //Utils::pinv($languageYaml, "before: ".$case->name);
            $change = 0;
            $cgkeys = new CGArray($languageYaml);
            //debugbar()->info($this->languageTextList);
            foreach ($this->languageTextList as $key => $c) {
                if (is_array($c)) {
                    if (!$cgkeys->hasKey($key) || $this->languageTextList[$key][1]) {
                        $languageYaml[$key] = $this->languageTextList[$key][0];
                        $change++;
                    }
                }
            }
            //Utils::pinv($languageYaml, "after: ".$case->name);
            if ($change > 0) {
                //Utils::pinv($change, "2");
                $dump = Yaml::dump($languageYaml);
                FileSystem::write("lib/I18N/languages/" . $case->name . ".yml", $dump);
            }
        }
    }

    private function reSelectLanguageFile(): void
    {
        if (file_exists("lib/I18N/languages/" . $this->languageCode->name . ".yml")) {
            $lang = $this->yamlController("lib/I18N/languages/" . $this->languageCode->name . ".yml");
            $this->setLanguageTextList($lang);
        }
    }

    /**
     * @param $filename
     * @param int $flag
     * @return mixed
     */
    public function yamlController($filename, int $flag = 0): mixed
    {
        return Yaml::parseFile($filename, $flag);
    }

    /**
     * @return array
     */
    public function getLanguageTextList(): array
    {
        return $this->languageTextList;
    }


    /**
     * @param array $languageTextList
     * @return $this
     */
    public function setLanguageTextList(array $languageTextList): static
    {
        $this->languageTextList = $languageTextList;
        return $this;
    }

    /**
     * @param ELanguageText $elanguageText
     * @param bool $toCGString
     * @return mixed|CGString|null
     */
    public function getLanguage(ELanguageText $elanguageText, bool $toCGString = false): mixed
    {
        if (empty($this->languageTextList)) return null;
        if (empty($this->languageTextList[$elanguageText->name])) return null;
        if ($toCGString) {
            return new CGString($this->languageTextList[$elanguageText->name]);
        } else {
            return $this->languageTextList[$elanguageText->name];
        }
    }


}
