<?php

namespace Auth;

use Nette\Database\Connection;
use Nette\Database\ResultSet;
use Nette\Database\Row;
use RuntimeException;
use Utils\Utils;

class MemberManager
{
    use MemberVerify;

    public static int $ENUM_USE_UID = 0;
    public static int $ENUM_USE_ID = 1;
    public static int $ENUM_USE_USERNAME = 2;
    public static string $ENUM_UPDATE_PASSWORD = 'password';
    public static string $ENUM_UPDATE_EMAIL = 'email';
    public static string $ENUM_UPDATE_ADMINISTRATOR = 'administrator';
    public static string $ENUM_UPDATE_ENABLE = 'enable';


    private static Connection $conn;

    private static Utils $Utils;

    public function __construct()
    {
        self::$Utils = new Utils();
        self::init();
    }

    public static function init(){
        self::$conn = new Connection('mysql:host=127.0.0.1;dbname=vvrzmwkq_home', 'vvrzmwkq_home', 'PoinfE}7f,0l');
        self::$conn->connect();
    }

    /**
     * 新增會員
     * @param $uid
     * @param $username
     * @param $password
     * @param $administrator
     * @param $enable
     * @param $createdAt
     * @return ResultSet
     */
    public static function addMember($uid, $username, $password, $email, $administrator, $enable, $createdAt): ResultSet
    {
        return self::$conn->query("INSERT INTO `cgphp_member` ?", [
            'uid' => $uid,
            'username' => $username,
            'password' => self::$Utils->passwd_encode($password),
            'email' => $email,
            'administrator' => $administrator,
            'enable' => $enable,
            'createAt' => $createdAt
        ]);
    }

    /**
     * 取得所有成員數量
     * @return int
     */
    public static function getAllMembersCount(): int
    {
        return count(self::getAllMembers());
    }

    /**
     * 取得所有成員
     * @return Member[] Returns an array of Member objects
     */
    public static function getAllMembers(): array
    {
        $array = [];
        $all = self::$conn->fetchAll('SELECT id FROM `cgphp_member`');
        foreach ($all as $member) {
            $array [$member->id] = self::getMember(self::$ENUM_USE_ID, $member->id);
        }
        return $array;
    }

    /**
     * 取得會員
     * @param $ENUM_USE
     * @param $value
     * @return Member|false
     * @throws RuntimeException
     */
    public static function getMember($ENUM_USE, $value)
    {
        switch ($ENUM_USE) {
            case self::$ENUM_USE_ID:
                $string = 'SELECT * FROM `cgphp_member` WHERE id = ?';
                break;
            case self::$ENUM_USE_UID:
                $string = 'SELECT * FROM `cgphp_member` WHERE uid = ?';
                break;
            case self::$ENUM_USE_USERNAME:
                $string = 'SELECT * FROM `cgphp_member` WHERE username = ?';
                break;
            default:
                return throw new RuntimeException('NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return new Member();
        if ($row->count() > 0)
            return new Member($row);
        else
            return new Member();
    }

    /**
     * 更新會員
     * @param $ENUM_USE
     * @param $USE_value
     * @param $update
     * @return ResultSet
     * @throws RuntimeException
     */
    public static function updateMember($ENUM_USE, $USE_value, $update)
    {
        return match ($ENUM_USE) {
            self::$ENUM_USE_ID => self::$conn->query('UPDATE `cgphp_member` SET', $update, 'WHERE id = ?', $USE_value),
            self::$ENUM_USE_UID => self::$conn->query('UPDATE `cgphp_member` SET', $update, 'WHERE uid = ?', $USE_value),
            self::$ENUM_USE_USERNAME => self::$conn->query('UPDATE `cgphp_member` SET', $update, 'WHERE username = ?', $USE_value),
            default => throw new RuntimeException('NOT SELECTED ENUM USE VALUE'),
        };
    }

    /**
     * 刪除會員
     * @param $ENUM_USE
     * @param $value
     * @return Row|null
     * @throws RuntimeException
     */
    public static function removeMember($ENUM_USE, $value): ?Row
    {
        return match ($ENUM_USE) {
            self::$ENUM_USE_ID => self::$conn->fetch('DELETE FROM `cgphp_member` WHERE id = ?', $value),
            self::$ENUM_USE_UID => self::$conn->fetch('DELETE FROM `cgphp_member` WHERE uid = ?', $value),
            self::$ENUM_USE_USERNAME => self::$conn->fetch('DELETE FROM `cgphp_member` WHERE username = ?', $value),
            default => throw new RuntimeException('NOT SELECTED ENUM VALUE'),
        };
    }
}