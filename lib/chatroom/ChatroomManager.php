<?php

namespace chatroom;

use I18N\ELanguageText;
use I18N\I18N;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use RuntimeException;
use Utils\Connection;

class ChatroomManager
{
    private static \Nette\Database\Connection $conn;
    private static bool $loaded = false;

    public function __construct($load = true)
    {
        if ($load) {
            self::init();
        }
    }

    private static function init()
    {
        self::setLoaded(true);
        self::$conn = Connection::conn();
    }

    /**
     * @param bool $loaded
     */
    private static function setLoaded(bool $loaded): void
    {
        self::$loaded = $loaded;
    }

    /**
     * @return bool
     */
    private static function isLoaded(): bool
    {
        return self::$loaded;
    }

    /**
     * @param Chatroom $c
     * @return bool
     */
    public static function addChatroom(Chatroom $c): bool
    {
        self::firstConditionInit();
        $chatroom = self::getChatroom(ChatroomNameField::CID, $c->getCID(), "true");
        if ($chatroom === null) {
            self::$conn->query("INSERT INTO `cgphp_chatroom` ?", [ChatroomNameField::CID->value => $c->getCID(), ChatroomNameField::members->value => $c->getMemberstoJson(), ChatroomNameField::status->value => $c->getStatus()->value, ChatroomNameField::createAt->value => $c->getCreateAt()]);
            return true;
        }
        return false;
    }

    /**
     * @return void
     */
    private static function firstConditionInit(): void
    {
        if (!self::isLoaded()) self::init();
    }


    public static function coverMembers($a)
    {
        if (empty($a)) return [];
        try {
            return Json::decode($a, Json::FORCE_ARRAY);
        } catch (JsonException $e) {
            return null;
        }
    }

    private static function getI18N(): I18N
    {
        return new I18N();
    }


    /**
     * @param string|ChatroomNameField $e
     * @param $e_value
     * @param bool $enable
     * @return Chatroom|null
     */
    public static function getChatroom(string|ChatroomNameField $e, $e_value): ?Chatroom
    {
        self::firstConditionInit();
        $r = match ($e) {
            ChatroomNameField::CID->value, ChatroomNameField::CID => self::$conn->fetch("SELECT * FROM `cgphp_chatroom` WHERE `CID` = ?", $e_value),
            ChatroomNameField::ID->value, ChatroomNameField::ID => self::$conn->fetch("SELECT * FROM `cgphp_chatroom` WHERE `ID` = ?", $e_value),
            default => throw new RuntimeException(self::getI18N()
                ->getLanguage(
                    ELanguageText::ChatroomManger_getChatroom_1,
                    true
                )
                    ->Replace("%CLASS%", __CLASS__)
                    ->Replace("%FUNCTION%", __FUNCTION__)
                    ->Replace("%ChatroomNameField_e_value%", $e->value)
                    ->Replace("%e_value%", $e_value)
                    ->toString()
                ),
        };
        if ($r === null) return null;
        $m = self::coverMembers($r->members);
        $arr=[];
        foreach ($m as $item) {
            $arr [] = new ChatroomMember($item);
        }
        return new Chatroom((int)$r->ID, (string)$r->CID, $arr, ChatroomStatus::from($r->status), $r->createAt, $r->updateAt, true);
    }

    /**
     * @param string|ChatroomStatus $status
     * @return Chatroom[]
     */
    public static function getChatrooms(ChatroomStatus|string $status="true"){
        self::firstConditionInit();
        $r = self::$conn->fetchAll("SELECT * FROM `cgphp_chatroom` WHERE `status` = ?", $status);
        $arr=[];
        if(count($r)>0){
            foreach ($r as $rr) {
                $m = self::coverMembers($rr->members);
                $t=[];
                foreach ($m as $item) {
                    $t [] = new ChatroomMember($item);
                }
                $arr[]=new Chatroom((int)$rr->ID, (string)$rr->CID, $t, ChatroomStatus::from($rr->status), $rr->createAt, $rr->updateAt, true);
            }
        }
        return $arr;
    }

    /**
     * @param string|ChatroomNameField $e
     * @param $e_value
     * @param $array array
     * @return void
     * @throws RuntimeException
     */
    public static function editChatroom(string|ChatroomNameField $e, $e_value, array $array): void
    {
        self::firstConditionInit();
        switch ($e) {
            case ChatroomNameField::CID->value:
            case ChatroomNameField::CID:
                self::$conn->query("UPDATE `cgphp_chatroom` SET", $array, "WHERE `CID` = ?", $e_value);
                break;
            case ChatroomNameField::ID->value:
            case ChatroomNameField::ID:
                self::$conn->query("UPDATE `cgphp_chatroom` SET", $array, "WHERE `ID` = ?", $e_value);
                break;
            default:
                throw new RuntimeException(self::getI18N()->
                    getLanguage(
                        ELanguageText::ChatroomManger_editChatroom_1,
                        true)
                        ->Replace("%CLASS%", __CLASS__)
                        ->Replace("%FUNCTION%", __FUNCTION__)
                        ->Replace("%ChatroomNameField_e_value%", $e->value)
                        ->Replace("%e_value%", $e_value)
                        ->Replace("%var_export_array_to_string%", var_export($array, true))
                        ->toString()
                );
                break;
        }
        // %CLASS%#%FUNCTION%(%ChatroomNameField_e_value%, %e_value%, %var_export_array_to_string%) NOT VALID %ChatroomNameField_e_value% value
        //__CLASS__ . "#" . __FUNCTION__ . "(" . $e->value . ", $e_value, " . var_export($array, true) . ") NOT VALID $e->value value"
    }

    /**
     * @param string|ChatroomNameField $e
     * @param $e_value
     * @return void
     * @throws RuntimeException
     */
    public static function removeChatroom($e, $e_value)
    {
        self::firstConditionInit();
        switch ($e) {
            case ChatroomNameField::CID->value:
            case ChatroomNameField::CID:
                self::$conn->query("DELETE FROM `cgphp_chatroom` WHERE `CID` = ?", $e_value);
                break;
            case ChatroomNameField::ID->value:
            case ChatroomNameField::ID:
                self::$conn->query("DELETE FROM `cgphp_chatroom` WHERE `ID` = ?", $e_value);
                break;
            default:
                throw new RuntimeException(__CLASS__ . "#" . __FUNCTION__ . "(" . $e->value . ", $e_value) NOT VALID $e->value value");
                break;
        }
    }

    public static function addChatMessage(ChatMessages $c): bool
    {
        self::firstConditionInit();
        $chatroom = self::getChatMessage($c->getCID(), $c->getID());
        if ($chatroom === null) {
            self::$conn->query("INSERT INTO `cgphp_chatmessages` ?", [
                ChatMessagesNameField::CID->value => $c->getCID(),
                ChatMessagesNameField::UID->value => $c->getUID(),
                ChatMessagesNameField::fileID->value => $c->getFileID(),
                ChatMessagesNameField::text->value => $c->getText(),
                ChatMessagesNameField::enable->value => $c->isEnable(),
                ChatMessagesNameField::creatAt->value => $c->getCreatAt()
            ]);
            return true;
        }
        return false;
    }

    /**
     * @param $Chatroom_CID
     * @param $ChatMessages_ID
     * @return ChatMessages|null
     */
    public static function getChatMessage($Chatroom_CID, $ChatMessages_ID): ?ChatMessages
    {
        self::firstConditionInit();
        $r = self::$conn->fetch("select * from `cgphp_chatmessages` WHERE `CID` = ? AND `ID` = ?", $Chatroom_CID, $ChatMessages_ID);
        if (empty($r)) return null;
        return new ChatMessages((int)$r->ID, (string)$r->CID, (string)$r->UID, (string)$r->fileID, (string)$r->text, (bool)$r->enable, (int)$r->creatAt, $r->updateAt,);
    }

    /**
     * @param $Chatroom_CID
     * @param string $enable
     * @return int
     */
    public static function countChatMessages($Chatroom_CID, string $enable = "true"): int
    {
        self::firstConditionInit();
        $r = self::$conn->fetch("SELECT COUNT(*) FROM `cgphp_chatmessages` WHERE `CID` = ? AND `enable` = ?",$Chatroom_CID,$enable);
        return $r["COUNT(*)"];
    }

    /**
     * @param $Chatroom_CID
     * @param string $enable
     * @return ChatMessages[]
     */
    public static function getChatMessages($Chatroom_CID, string $enable = "true"): array
    {
        self::firstConditionInit();
        $rr = self::$conn->fetchAll("SELECT * FROM `cgphp_chatmessages` WHERE `CID` = ? and `enable` = ?", $Chatroom_CID, (string)$enable);
        if (empty($rr)) return [];
        $arr = [];
        foreach ($rr as $r) {
            $arr [] = new ChatMessages((int)$r->ID, (string)$r->CID, (string)$r->UID , (string)$r->fileID, (string)$r->text, (bool)$r->enable, (int)$r->creatAt, $r->updateAt);
        }
        return $arr;
    }

    /**
     * @param $Chatroom_CID
     * @param int $ID
     * @param string $enable
     * @return array
     */
    public static function getChatMessagesBiggerID($Chatroom_CID, int $ID,string $enable = "true"): array
    {
        self::firstConditionInit();
        $rr = self::$conn->fetchAll("SELECT * FROM `cgphp_chatmessages` WHERE `CID` = ? AND `enable` = ? AND ID < ?", $Chatroom_CID, (string)$enable, $ID);
        if (empty($rr)) return [];
        $arr = [];
        foreach ($rr as $r) {
            $arr [] = new ChatMessages((int)$r->ID, (string)$r->CID, (string)$r->UID , (string)$r->fileID, (string)$r->text, (bool)$r->enable, (int)$r->creatAt, $r->updateAt);
        }
        return $arr;
    }
    /**
     * @param $Chatroom_CID
     * @param string $enable
     * @param int $limit
     * @return ChatMessages[]|null
     */
    public static function getChatMessages1($Chatroom_CID, $enable = "true", int $limit=50)
    {
        self::firstConditionInit();
        $chatMessages = self::getChatMessages($Chatroom_CID, $enable);
        if(count($chatMessages) > 50){
            $count = count($chatMessages) - $limit;
        }else{
            $count=0;
        }
        $rr = self::$conn->fetchAll("SELECT * FROM `cgphp_chatmessages` WHERE `CID` = ? and `enable` = ? LIMIT ? OFFSET ?", $Chatroom_CID, (string)$enable, $limit, $count);
        if (empty($rr)) return [];
        $arr = [];
        foreach ($rr as $r) {
            $arr [] = new ChatMessages((int)$r->ID, (string)$r->CID, (string)$r->UID , (string)$r->fileID, (string)$r->text, (bool)$r->enable, (int)$r->creatAt, $r->updateAt);
        }
        return $arr;
    }

    /**
     * @param $Chatroom_CID
     * @param $ChatMessages_ID
     * @return void
     */
    public static function removeChatMessages($Chatroom_CID, $ChatMessages_ID)
    {
        self::firstConditionInit();
        self::$conn->query("DELETE FROM `cgphp_chatmessages` WHERE `CID` = ? AND `ID` = ?", $Chatroom_CID, $ChatMessages_ID);
    }

    /**
     * @param $Chatroom_CID
     * @param $ChatMessages_ID
     * @return void
     */
    public static function toggleChatMessages($Chatroom_CID, $ChatMessages_ID)
    {
        self::firstConditionInit();
        $chatMessages = self::getChatMessage($Chatroom_CID, $ChatMessages_ID);
        self::editChatMessages($Chatroom_CID, $ChatMessages_ID, [ChatMessagesNameField::enable->value => (string)!$chatMessages->isEnable()]);
    }

    /**
     * @param $Chatroom_CID
     * @param $ChatMessages_ID
     * @param $array
     * @return void
     */
    public static function editChatMessages($Chatroom_CID, $ChatMessages_ID, $array)
    {
        self::firstConditionInit();
        self::$conn->query("UPDATE `cgphp_chatmessages` SET ", $array, "WHERE `CID` = ? AND `ID` = ?", $Chatroom_CID, $ChatMessages_ID);
    }
}
