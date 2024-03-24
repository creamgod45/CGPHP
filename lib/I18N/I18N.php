<?php

namespace I18N;

use Nette\Utils\FileSystem;
use Symfony\Component\Yaml\Yaml;
use Type\Array\CGArray;
use Type\String\CGString;
use Utils\Utils;

// https://www.iana.org/assignments/language-subtag-registry/language-subtag-registry

class I18N implements II18N
{
    private ELanguageCode $languageCode;
    private array $languageTextList = [];

    public function __construct(?ELanguageCode $languageCode = null, $CompileMode= false)
    {
        $this->buildFirstLanguageFile($CompileMode);
        if ($languageCode !== null) {
            // 選擇語系
            $this->setLanguageCode($languageCode);
        } else {
            // 預設模式
        }
        $this->buildMissingLanguageDictionary();
        //$exploreDirectory = Utils::exploreDirectory('lib\I18N\languages', false, true, true, filterPathName: true);
        //Utils::v($exploreDirectory);
    }

    public function buildMissingLanguageDictionary(): void
    {
        $this->buildLanguageMap();
        foreach (ELanguageCode::cases() as $case) {
            if (!file_exists("lib/I18N/languages/" . $case->name . ".yml")) {
                Utils::pinv("1");
                $dump = Yaml::dump($this->languageTextList);
                FileSystem::write("lib/I18N/languages/" . $case->name . ".yml", $dump);
                continue;
            }
            $languageYaml = $this->yamlController("lib/I18N/languages/" . $case->name . ".yml");
            //Utils::pinv($languageYaml, "before: ".$case->name);
            $change=0;
            $cgkeys = new CGArray($languageYaml);
            foreach (ELanguageText::cases() as $c) {
                if (!$cgkeys->hasKey($c->name)) {
                    $languageYaml[$c->name]=$this->languageTextList[$c->name];
                    $change++;
                }
            }
            //Utils::pinv($languageYaml, "after: ".$case->name);
            if($change>0){
                Utils::pinv($change, "2");
                $dump = Yaml::dump($languageYaml);
                FileSystem::write("lib/I18N/languages/" . $case->name . ".yml", $dump);
            }
        }
    }

    public function buildFirstLanguageFile($CompileMode): void
    {
        if (file_exists("I18N.lock") && !$CompileMode) return;
        FileSystem::write("I18N.lock", time() . ": build I18N");
        $this->buildLanguageMap();
        $dump = Yaml::dump($this->languageTextList);
        foreach (ELanguageCode::cases() as $case) {
            FileSystem::write("lib/I18N/languages/" . $case->name . ".yml", $dump);
        }
    }

    public function buildLanguageMap(): void
    {
        $this->languageCodeDictionaryBuilder();
        $this->setLanguage(ELanguageText::HelloWorld, "Hello World!!");
        $this->setLanguage(ELanguageText::ChatroomManger_getChatroom_1, "%CLASS%#%FUNCTION%(%ChatroomNameField_e_value%, %e_value%) NOT VALID %ChatroomNameField_e_value% value");
        $this->setLanguage(ELanguageText::ChatroomManger_editChatroom_1, "%CLASS%#%FUNCTION%(%ChatroomNameField_e_value%, %e_value%, %var_export_array_to_string%) NOT VALID %ChatroomNameField_e_value% value");
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_1_Title,
            "CGPHP Website Example");
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_2_Description,
            "A framework integrating a large number of practical functions");
        // 一個集成大量的實用功能的框架
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_3_IWantToContinueToSee,
            "I want to continue to see");
        // 我想繼續看看
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_4,
            "Automatically generate copyright protection information, please see the wiki for source code details");
        // 自動生成版權保護資訊，原始碼詳情請看維基
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_5_View,
            "View");
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_6,
            "Functional integration for lazy people. Website mode and environment settings still retain the most original PHP functions.");
        // 懶人的功能集成。網站模式、環境設定、依然保留最原始的PHP功能。
        //
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_7,
            "The convenient CGPath CGArray CGString, like the selector class of Java's architecture, can be easily converted to type.");
        //方便使用的CGPath CGArray CGString，如同像是Java的架構的選擇器類別，能夠輕鬆轉換型別。
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_8,
            "BootBuilder simplifies the complex architecture of the previous generation!!");
        //BootBuilder 簡化了上一代複雜的架構!!
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_9,
            "Solve the coverage vulnerability of SESSION, use a self-made storage system and encrypt protection");
        //解決SESSION的覆蓋漏洞，使用自製的儲存系統並且加密保護
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_10,
            "Use the self-made website file storage system FileBase, adding file management and database storage.");
        //使用自製網站檔案儲存系統 FileBase，加入了檔案管理、資料庫儲存。
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_11,
            "With an open architecture, the development structure can be extended at will according to personal needs, but you still have to pay attention to issues regarding information security!!");
        //開放性架構，可以依照個人需求隨意延伸開發結構，但還是得注意關於資安的問題喔!!
        $this->setLanguage(ELanguageText::RouterTemplatesHomePage_12,
            "I18N's built-in introduction to international localized language functions is perfectly compatible. I18N->buildLanguageMap() sets the language, and new I18N(null, true) can enter the build language mode.");
        //I18N 內建引入國際本地化語言功能完美相容 I18N->buildLanguageMap() 設定語言，new I18N(null, true) 即可進入編制語系模式。
    }

    public function languageCodeDictionaryBuilder(): void
    {
        $this->setLanguage(ELanguageText::af_ZA, "Afrikaans (South Africa)");
        $this->setLanguage(ELanguageText::am_ET, "Amharic (Ethiopia)");
        $this->setLanguage(ELanguageText::ar_EG, "Arabic (Egyptian)");
        $this->setLanguage(ELanguageText::ar_SA, "Arabic (Saudi Arabia)");
        $this->setLanguage(ELanguageText::as_IN, "Assamese (India)");
        $this->setLanguage(ELanguageText::ay_BO, "Aymara (Bolivia)");
        $this->setLanguage(ELanguageText::az_AZ, "Azerbaijani (Azerbaijan)");
        $this->setLanguage(ELanguageText::ba_RU, "Bashkir (Russian)");
        $this->setLanguage(ELanguageText::be_BY, "Belarusian (Belarus)");
        $this->setLanguage(ELanguageText::bg_BG, "Bulgarian (Bulgarian)");
        $this->setLanguage(ELanguageText::bn_IN, "Bengali (India)");
        $this->setLanguage(ELanguageText::bs_BA, "Bosnian (Bosnia and Herzegovina)");
        $this->setLanguage(ELanguageText::cr_CA, "Cree (Canada)");
        $this->setLanguage(ELanguageText::cs_CZ, "Czech (Czech Republic)");
        $this->setLanguage(ELanguageText::cy_GB, "Welsh (UK)");
        $this->setLanguage(ELanguageText::da_DK, "Danish (Denmark)");
        $this->setLanguage(ELanguageText::de_CH, "High German (Switzerland)");
        $this->setLanguage(ELanguageText::de_DE, "German (Germany)");
        $this->setLanguage(ELanguageText::dv_MV, "Dhivehi (Maldives)");
        $this->setLanguage(ELanguageText::dz_BT, "Dzongkha (Bhutan)");
        $this->setLanguage(ELanguageText::el_GR, "Greek (Greece)");
        $this->setLanguage(ELanguageText::en_AU, "English (Australia)");
        $this->setLanguage(ELanguageText::en_GB, "English (UK)");
        $this->setLanguage(ELanguageText::en_US, "United States English");
        $this->setLanguage(ELanguageText::es_ES, "Spanish (Spain)");
        $this->setLanguage(ELanguageText::es_MX, "Spanish (Mexico)");
        $this->setLanguage(ELanguageText::et_EE, "Estonian (Estonia)");
        $this->setLanguage(ELanguageText::fa_IR, "Persian (Iran)");
        $this->setLanguage(ELanguageText::fi_FI, "Finnish (Finland)");
        $this->setLanguage(ELanguageText::fil_PH, "Tagalog (Philippines)");
        $this->setLanguage(ELanguageText::fj_FJ, "Fijian (Fiji)");
        $this->setLanguage(ELanguageText::fo_FO, "Faroe (Faroe Islands)");
        $this->setLanguage(ELanguageText::fr_BE, "French (Belgium)");
        $this->setLanguage(ELanguageText::fr_CA, "French (Canada)");
        $this->setLanguage(ELanguageText::fr_FR, "French (France)");
        $this->setLanguage(ELanguageText::ga_IE, "Irish (Ireland)");
        $this->setLanguage(ELanguageText::gd_GB, "Scottish Gaelic (UK)");
        $this->setLanguage(ELanguageText::gil_KI, "Gibbert (Giribati)");
        $this->setLanguage(ELanguageText::gu_IN, "Gujarati (India)");
        $this->setLanguage(ELanguageText::ha_NG, "Hausa (Nigeria)");
        $this->setLanguage(ELanguageText::he_IL, "Hebrew (Israel)");
        $this->setLanguage(ELanguageText::hi_IN, "Hindi (India)");
        $this->setLanguage(ELanguageText::hr_HR, "Croatian (Croatia)");
        $this->setLanguage(ELanguageText::hu_HU, "Hungarian (Hungary)");
        $this->setLanguage(ELanguageText::hy_AM, "Armenian (Armenian)");
        $this->setLanguage(ELanguageText::ibb_NG, "Ibibio (Nigeria)");
        $this->setLanguage(ELanguageText::id_ID, "Bahasa Indonesia (Indonesia)");
        $this->setLanguage(ELanguageText::ig_NG, "Igbo (Nigeria)");
        $this->setLanguage(ELanguageText::is_IS, "Icelandic (Iceland)");
        $this->setLanguage(ELanguageText::it_IT, "Italian (Italian)");
        $this->setLanguage(ELanguageText::iu_CA, "Inuktitut (Canada)");
        $this->setLanguage(ELanguageText::ja_JP, "Japanese (Japan)");
        $this->setLanguage(ELanguageText::ka_GE, "Georgian (Georgia)");
        $this->setLanguage(ELanguageText::kk_KZ, "Kazakh (Kazakh)");
        $this->setLanguage(ELanguageText::km_KH, "Khmer (Cambodia)");
        $this->setLanguage(ELanguageText::kn_IN, "Kannada (India)");
        $this->setLanguage(ELanguageText::ko_KP, "Korean (North Korea)");
        $this->setLanguage(ELanguageText::ko_KR, "Korean (South Korea)");
        $this->setLanguage(ELanguageText::ku_TR, "Kurdish (Türkiye)");
        $this->setLanguage(ELanguageText::kw_GB, "Cornish (UK)");
        $this->setLanguage(ELanguageText::ky_KG, "Kyrgyz (Kyrgyz)");
        $this->setLanguage(ELanguageText::ln_CD, "Lingala (Democratic Republic of Congo)");
        $this->setLanguage(ELanguageText::lo_LA, "Lao language (Laos)");
        $this->setLanguage(ELanguageText::lt_LT, "Lithuanian (Lithuania)");
        $this->setLanguage(ELanguageText::lv_LV, "Latvian (Latvian)");
        $this->setLanguage(ELanguageText::mg_MG, "Malagasy (Madagascar)");
        $this->setLanguage(ELanguageText::mh_MH, "Marshallese (Marshall Islands)");
        $this->setLanguage(ELanguageText::mi_NZ, "Maori (New Zealand)");
        $this->setLanguage(ELanguageText::mk_MK, "Macedonian (North Macedonia)");
        $this->setLanguage(ELanguageText::ml_IN, "Malayalam (India)");
        $this->setLanguage(ELanguageText::mn_MN, "Mongolian (Mongolia)");
        $this->setLanguage(ELanguageText::mn_Mong_CN, "Mongolian (Mongolian script, China)");
        $this->setLanguage(ELanguageText::mr_IN, "Marathi (India)");
        $this->setLanguage(ELanguageText::ms_MY, "Malay (Malaysia)");
        $this->setLanguage(ELanguageText::mt_MT, "Maltese (Malta)");
        $this->setLanguage(ELanguageText::my_MM, "Burmese (Myanmar)");
        $this->setLanguage(ELanguageText::na_NR, "Nauru (Nauru)");
        $this->setLanguage(ELanguageText::ne_NP, "Nepali (Nepal)");
        $this->setLanguage(ELanguageText::nl_NL, "Dutch (Netherlands)");
        $this->setLanguage(ELanguageText::no_NO, "Norwegian (Norway)");
        $this->setLanguage(ELanguageText::ny_MW, "Chichewa (Malawi)");
        $this->setLanguage(ELanguageText::oj_CA, "Ojibway (Canada)");
        $this->setLanguage(ELanguageText::or_IN, "Oriya (India)");
        $this->setLanguage(ELanguageText::pa_Arab_PK, "Punjabi (Arabic script, Pakistan)");
        $this->setLanguage(ELanguageText::pa_IN, "Punjabi (India)");
        $this->setLanguage(ELanguageText::pl_PL, "Polish (Polish)");
        $this->setLanguage(ELanguageText::ps_AF, "Pashto (Afghanistan)");
        $this->setLanguage(ELanguageText::pt_BR, "Portuguese (Brazil)");
        $this->setLanguage(ELanguageText::pt_PT, "Portuguese (Portugal)");
        $this->setLanguage(ELanguageText::qu_PE, "Quechua (Peru)");
        $this->setLanguage(ELanguageText::ro_RO, "Romanian (Romania)");
        $this->setLanguage(ELanguageText::ru_RU, "Russian (Russia)");
        $this->setLanguage(ELanguageText::rw_RW, "Rwanda (Rwanda)");
        $this->setLanguage(ELanguageText::sa_IN, "Sanskrit (India)");
        $this->setLanguage(ELanguageText::sd_Deva_IN, "Sindhi (Devava, India)");
        $this->setLanguage(ELanguageText::sd_PK, "Sindhi (Pakistan)");
        $this->setLanguage(ELanguageText::si_LK, "Sinhala (Sri Lanka)");
        $this->setLanguage(ELanguageText::sk_SK, "Slovak (Slovakia)");
        $this->setLanguage(ELanguageText::sl_SI, "Slovenian (Slovenia)");
        $this->setLanguage(ELanguageText::sm_WS, "Samoan (Samoan)");
        $this->setLanguage(ELanguageText::sn_ZW, "Shona (Zimbawi)");
        $this->setLanguage(ELanguageText::so_DJ, "Somali (Djibouti)");
        $this->setLanguage(ELanguageText::so_SO, "Somali (Somalia)");
        $this->setLanguage(ELanguageText::sq_AL, "Albanian (Albania)");
        $this->setLanguage(ELanguageText::sr_RS, "Serbian (Serbia)");
        $this->setLanguage(ELanguageText::ss_SZ, "Swati (Swaziland)");
        $this->setLanguage(ELanguageText::st_ZA, "Southern Sotho (South Africa)");
        $this->setLanguage(ELanguageText::sv_SE, "Swedish (Sweden)");
        $this->setLanguage(ELanguageText::sw_KE, "Swahili (Kenya)");
        $this->setLanguage(ELanguageText::syr_SY, "Syriac (Syria)");
        $this->setLanguage(ELanguageText::ta_IN, "Tamil (India)");
        $this->setLanguage(ELanguageText::te_IN, "Telugu (India)");
        $this->setLanguage(ELanguageText::tg_TJ, "Tajik (Tajikistan)");
        $this->setLanguage(ELanguageText::th_TH, "Thai (Thailand)");
        $this->setLanguage(ELanguageText::ti_ER, "Tigrinya (Eritrea)");
        $this->setLanguage(ELanguageText::ti_ET, "Tigrinya (Ethiopia)");
        $this->setLanguage(ELanguageText::tj_TJ, "Tajik (Tajikistan)");
        $this->setLanguage(ELanguageText::tk_TM, "Turkmen (Turkmenistan)");
        $this->setLanguage(ELanguageText::tl_PH, "Tagalog (Philippines)");
        $this->setLanguage(ELanguageText::tn_BW, "Tswana (Botswana)");
        $this->setLanguage(ELanguageText::to_TO, "Tongan (Tongan)");
        $this->setLanguage(ELanguageText::tr_TR, "Turkish (Türkiye)");
        $this->setLanguage(ELanguageText::tt_RU, "Tatar (Russian)");
        $this->setLanguage(ELanguageText::tum_MW, "Tumbuka (Malawi)");
        $this->setLanguage(ELanguageText::ty_PF, "Tahiti (French Polynesia)");
        $this->setLanguage(ELanguageText::udm_RU, "Udmurt (Russian)");
        $this->setLanguage(ELanguageText::ug_CN, "Uyghur (China)");
        $this->setLanguage(ELanguageText::uk_UA, "Ukrainian (Ukraine)");
        $this->setLanguage(ELanguageText::ur_PK, "Urdu (Pakistan)");
        $this->setLanguage(ELanguageText::uz_UZ, "Uzbek (Uzbek)");
        $this->setLanguage(ELanguageText::ve_ZA, "Venda (South Africa)");
        $this->setLanguage(ELanguageText::vi_VN, "Vietnamese (Vietnam)");
        $this->setLanguage(ELanguageText::xh_ZA, "Xhosa (South Africa)");
        $this->setLanguage(ELanguageText::yo_NG, "Yoruba (Nigeria)");
        $this->setLanguage(ELanguageText::zh_CN, "Mainland China Simplified Chinese");
        $this->setLanguage(ELanguageText::zh_TW, "Traditional Chinese (Taiwan)");
        $this->setLanguage(ELanguageText::zh_HK, "Traditional Chinese (Hong Kong)");
        $this->setLanguage(ELanguageText::zh_SG, "Traditional Chinese (Singapore)");
        $this->setLanguage(ELanguageText::zh_MO, "Traditional Chinese (Singapore)");
        $this->setLanguage(ELanguageText::zu_ZA, "Zulu (South Africa)");
    }

    public function setLanguage(ELanguageText $elanguageText, string $value): void
    {
        $this->languageTextList[$elanguageText->name] = $value;
    }

    /**
     * @return ELanguageCode
     */
    public function getLanguageCode(): ELanguageCode
    {
        return $this->languageCode;
    }

    /**
     * @param ELanguageCode $languageCode
     * @return void
     */
    public function setLanguageCode(ELanguageCode $languageCode): void
    {
        $this->languageCode = $languageCode;
        $this->reSelectLanguageFile();
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
     * @return I18N
     */
    public function setLanguageTextList(array $languageTextList): I18N
    {
        $this->languageTextList = $languageTextList;
        return $this;
    }

    /**
     * @param ELanguageText $elanguageText
     * @param bool $toCGString
     * @return mixed|CGString|null
     */
    public function getLanguage(ELanguageText $elanguageText, bool $toCGString = false)
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
