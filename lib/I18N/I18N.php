<?php

namespace I18N;

use Nette\Utils\FileSystem;
use Symfony\Component\Yaml\Yaml;
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
            $this->languageCode = $languageCode;

        } else {
            // 預設模式
        }
        //$exploreDirectory = Utils::exploreDirectory('lib\I18N\languages', false, true, true, filterPathName: true);
        //Utils::v($exploreDirectory);
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
        $lang = $this->yamlController("lib/I18N/languages/" . $this->languageCode->name . ".yml");
        $this->setLanguageTextList($lang);
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
