<?php

namespace I18N;

use Type\String\CGString;

enum ELanguageText
{
    // Hello World
    case HelloWorld;
    // ChatroomManger getChatroom Throw new RuntimeException
    case ChatroomManger_getChatroom_1;
    // ChatroomManger editChatroom Throw new RuntimeException
    case ChatroomManger_editChatroom_1;
    case RouterTemplatesHomePage_1_Title;
    case RouterTemplatesHomePage_2_Description;
    case RouterTemplatesHomePage_3_IWantToContinueToSee;
    case RouterTemplatesHomePage_4;
    case RouterTemplatesHomePage_5_View;
    case RouterTemplatesHomePage_6;
    case RouterTemplatesHomePage_7HelloWorld;
    case RouterTemplatesHomePage_8;
    case RouterTemplatesHomePage_9;
    case RouterTemplatesHomePage_10;
    case RouterTemplatesHomePage_11;
    case RouterTemplatesHomePage_12;
    case af_ZA;     // 南非荷兰语（南非）
    case am_ET;     // 阿姆哈拉语（埃塞俄比亚）
    case ar_EG;     // 阿拉伯语（埃及）
    case ar_SA;     // 阿拉伯语（沙特阿拉伯）
    case as_IN;     // 阿萨姆语（印度）
    case ay_BO;     // 艾马拉语（玻利维亚）
    case az_AZ;     // 阿塞拜疆语（阿塞拜疆）
    case ba_RU;     // 巴什基尔语（俄罗斯）
    case be_BY;     // 白俄罗斯语（白俄罗斯）
    case bg_BG;     // 保加利亚语（保加利亚）
    case bn_IN;     // 孟加拉语（印度）
    case bs_BA;     // 波斯尼亚语（波斯尼亚和黑塞哥维那）
    case cr_CA;     // 克里语（加拿大）
    case cs_CZ;     // 捷克语（捷克共和国）
    case cy_GB;     // 威尔士语（英国）
    case da_DK;     // 丹麦语（丹麦）
    case de_CH;     // 高地德语（瑞士）
    case de_DE;     // 德语（德国）
    case dv_MV;     // 迪维希语（马尔代夫）
    case dz_BT;     // 宗卡语（不丹）
    case el_GR;     // 希腊语（希腊）
    case en_AU;     // 英语（澳大利亚）
    case en_GB;     // 英语（英国）
    case en_US;     // 美国英语
    case es_ES;     // 西班牙语（西班牙）
    case es_MX;     // 西班牙语（墨西哥）
    case et_EE;     // 爱沙尼亚语（爱沙尼亚）
    case fa_IR;     // 波斯语（伊朗）
    case fi_FI;     // 芬兰语（芬兰）
    case fil_PH;     // 菲律宾语（菲律宾）
    case fj_FJ;     // 斐济语（斐济）
    case fo_FO;     // 法罗语（法罗群岛）
    case fr_BE;     // 法语（比利时）
    case fr_CA;     // 法语（加拿大）
    case fr_FR;     // 法语（法国）
    case ga_IE;     // 爱尔兰语（爱尔兰）
    case gd_GB;     // 苏格兰盖尔语（英国）
    case gil_KI;     // 吉尔伯特语（基里巴斯）
    case gu_IN;     // 古吉拉特语（印度）
    case ha_NG;     // 豪萨语（尼日利亚）
    case he_IL;     // 希伯来语（以色列）
    case hi_IN;     // 印地语（印度）
    case hr_HR;     // 克罗地亚语（克罗地亚）
    case hu_HU;     // 匈牙利语（匈牙利）
    case hy_AM;     // 亚美尼亚语（亚美尼亚）
    case ibb_NG;     // 伊比比奥语（尼日利亚）
    case id_ID;     // 印尼语（印尼）
    case ig_NG;     // 伊博语（尼日利亚）
    case is_IS;     // 冰岛语（冰岛）
    case it_IT;     // 意大利语（意大利）
    case iu_CA;     // 因纽特语（加拿大）
    case ja_JP;     // 日语（日本）
    case ka_GE;     // 格鲁吉亚语（格鲁吉亚）
    case kk_KZ;     // 哈萨克语（哈萨克斯坦）
    case km_KH;     // 高棉语（柬埔寨）
    case kn_IN;     // 卡纳达语（印度）
    case ko_KP;     // 朝鲜语（北朝鲜）
    case ko_KR;     // 韩语（韩国）
    case ku_TR;     // 库尔德语（土耳其）
    case kw_GB;     // 康沃尔语（英国）
    case ky_KG;     // 吉尔吉斯语（吉尔吉斯斯坦）
    case ln_CD;     // 林加拉语（刚果民主共和国）
    case lo_LA;     // 老挝语（老挝）
    case lt_LT;     // 立陶宛语（立陶宛）
    case lv_LV;     // 拉脱维亚语（拉脱维亚）
    case mg_MG;     // 马达加斯加语（马达加斯加）
    case mh_MH;     // 马绍尔语（马绍尔群岛）
    case mi_NZ;     // 毛利语（新西兰）
    case mk_MK;     // 马其顿语（北马其顿）
    case ml_IN;     // 马拉雅拉姆语（印度）
    case mn_MN;     // 蒙古语（蒙古）
    case mn_Mong_CN;// 蒙古语（蒙古脚本，中国）
    case mr_IN;     // 马拉地语（印度）
    case ms_MY;     // 马来语（马来西亚）
    case mt_MT;     // 马耳他语（马耳他）
    case my_MM;     // 缅甸语（缅甸）
    case na_NR;     // 瑙鲁语（瑙鲁）
    case ne_NP;     // 尼泊尔语（尼泊尔）
    case nl_NL;     // 荷兰语（荷兰）
    case no_NO;     // 挪威语（挪威）
    case ny_MW;     // 齐切瓦语（马拉维）
    case oj_CA;     // 奥吉布瓦语（加拿大）
    case or_IN;     // 奥里亚语（印度）
    case pa_Arab_PK;// 旁遮普语（阿拉伯脚本，巴基斯坦）
    case pa_IN;     // 旁遮普语（印度）
    case pl_PL;     // 波兰语（波兰）
    case ps_AF;     // 普什图语（阿富汗）
    case pt_BR;     // 葡萄牙语（巴西）
    case pt_PT;     // 葡萄牙语（葡萄牙）
    case qu_PE;     // 克丘亚语（秘鲁）
    case ro_RO;     // 罗马尼亚语（罗马尼亚）
    case ru_RU;     // 俄语（俄罗斯）
    case rw_RW;     // 卢旺达语（卢旺达）
    case sa_IN;     // 梵语（印度）
    case sd_Deva_IN;// 信德语（天城脚本，印度）
    case sd_PK;     // 信德语（巴基斯坦）
    case si_LK;     // 僧伽罗语（斯里兰卡）
    case sk_SK;     // 斯洛伐克语（斯洛伐克）
    case sl_SI;     // 斯洛文尼亚语（斯洛文尼亚）
    case sm_WS;     // 萨摩亚语（萨摩亚）
    case sn_ZW;     // 修纳语（津巴布韦）
    case so_DJ;     // 索马里语（吉布提）
    case so_SO;     // 索马里语（索马里）
    case sq_AL;     // 阿尔巴尼亚语（阿尔巴尼亚）
    case sr_RS;     // 塞尔维亚语（塞尔维亚）
    case ss_SZ;     // 斯瓦蒂语（斯威士兰）
    case st_ZA;     // 南部索托语（南非）
    case sv_SE;     // 瑞典语（瑞典）
    case sw_KE;     // 斯瓦希里语（肯尼亚）
    case syr_SY;     // 叙利亚语（叙利亚）
    case ta_IN;     // 泰米尔语（印度）
    case te_IN;     // 泰卢固语（印度）
    case tg_TJ;     // 塔吉克语（塔吉克斯坦）
    case th_TH;     // 泰语（泰国）
    case ti_ER;     // 提格利尼亚语（厄立特里亚）
    case ti_ET;     // 提格利尼亚语（埃塞俄比亚）
    case tj_TJ;     // 塔吉克语（塔吉克斯坦）
    case tk_TM;     // 土库曼语（土库曼斯坦）
    case tl_PH;     // 他加禄语（菲律宾）
    case tn_BW;     // 茨瓦纳语（博茨瓦纳）
    case to_TO;     // 汤加语（汤加）
    case tr_TR;     // 土耳其语（土耳其）
    case tt_RU;     // 鞑靼语（俄罗斯）
    case tum_MW;     // 图姆布卡语（马拉维）
    case ty_PF;     // 塔希提语（法属波利尼西亚）
    case udm_RU;     // 乌德穆尔特语（俄罗斯）
    case ug_CN;     // 维吾尔语（中国）
    case uk_UA;     // 乌克兰语（乌克兰）
    case ur_PK;     // 乌尔都语（巴基斯坦）
    case uz_UZ;     // 乌兹别克语（乌兹别克斯坦）
    case ve_ZA;     // 文达语（南非）
    case vi_VN;     // 越南语（越南）
    case xh_ZA;     // 科萨语（南非）
    case yo_NG;     // 约鲁巴语（尼日利亚）
    case zh_CN;     // 中国大陆简体中文
    case zh_TW;     // 繁体中文（台湾）
    case zh_HK;     // 繁体中文（香港）
    case zh_SG;     // 繁体中文（新加坡）
    case zh_MO;     // 繁体中文（新加坡）
    case zu_ZA;     // 祖鲁语（南非）

    public static function isVaild(string $name):bool
    {
        foreach (ELanguageText::cases() as $case) {
            if ((new CGString($case->name))->toUpperCase()->toString() === (new CGString($name))->toUpperCase()->toString()) {
                return true;
            }
        }
        return false;
    }

    public static function valueof(string $name): ?ELanguageText
    {
        foreach (ELanguageText::cases() as $case) {
            if ((new CGString($case->name))->toUpperCase()->toString() === (new CGString($name))->toUpperCase()->toString()) {
                return $case;
            }
        }
        return null;
    }
}
