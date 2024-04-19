<?php

namespace Auth;

use Auth\MemberPermission\AdministratorPermission;
use Auth\MemberPermission\RiderPermission;
use Auth\MemberPermission\StorePermission;
use Nette\Database\Connection;
use Nette\Database\ResultSet;
use Nette\Database\Row;
use RuntimeException;
use Type\Array\CGArray;
use Utils\Utils;

class MemberManager
{
    use MemberVerify;

    public static int $ENUM_USE_UID = 0;
    public static int $ENUM_USE_ID = 1;
    public static int $ENUM_USE_USERNAME = 2;
    private static \Nette\Database\Connection $conn;
    private static bool $loaded = false;

    private static Utils $Utils;

    public function __construct($load = true)
    {
        self::$Utils = new Utils();
        if ($load) {
            self::init();
        }
    }

    private static function init()
    {
        self::setLoaded(true);
        self::$conn = \Utils\Connection::conn();
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
     * @return void
     */
    private static function firstConditionInit(): void
    {
        if (!self::isLoaded()) self::init();
    }

    public static function addMember($uid, $type, $phone, $password, $email, $administrator, $enable, $createdAt): ResultSet
    {
        self::firstConditionInit();
        return self::$conn->query("INSERT INTO `cgphp_member`", [
            MemberNameField::UID->value => $uid,
            MemberNameField::type->value => $type,
            MemberNameField::phone->value => $phone,
            MemberNameField::password->value => self::$Utils->passwd_encode($password),
            MemberNameField::email->value => $email,
            MemberNameField::administrator->value => $administrator,
            MemberNameField::enable->value => $enable,
            MemberNameField::createAt->value => $createdAt
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
        self::firstConditionInit();
        $array = [];
        $all = self::$conn->fetchAll('SELECT id FROM `cgphp_member`');
        foreach ($all as $member) {
            $array [$member->id] = self::getMember(self::$ENUM_USE_ID, $member->id);
        }
        return $array;
    }

    /**
     * 取得會員
     * @param MemberNameField|string $ENUM_USE
     * @param $value
     * @return Member|bool
     * @throws RuntimeException
     */
    public static function getMember($ENUM_USE, $value): Member|bool
    {
        self::firstConditionInit();
        switch ($ENUM_USE) {
            case MemberNameField::ID->value:
            case MemberNameField::ID:
                $string = 'SELECT * FROM `cgphp_member` WHERE ID = ?';
                break;
            case MemberNameField::UID->value:
            case MemberNameField::UID:
                $string = 'SELECT * FROM `cgphp_member` WHERE uid = ?';
                break;
            case MemberNameField::phone->value:
            case MemberNameField::phone:
                $string = 'SELECT * FROM `cgphp_member` WHERE phone = ?';
                break;
            default:
                return throw new RuntimeException('NOT SELECTED ENUM VALUE');
        }
        $row = self::$conn->fetch($string, $value);
        if ($row === null)
            return new Member();
        if ($row->count() > 0) {
            $m = new Member($row);
            if ($m->isAdministrator()) {
                $m->setPermissionManager(new AdministratorPermission());
            }else{
                if($m->getType() === MemberType::store)
                    $m->setPermissionManager(new StorePermission());
                else
                    $m->setPermissionManager(new RiderPermission());
            }
            return $m;
        }
        else
            return new Member();
    }

    public function hasPermission(Member $Member, string $permission){
        return $Member->getPermissionManager()->hasPermission($permission);
    }

    /**
     * @param Member $Member
     * @param string[] $Permissions
     * @return bool
     */
    public function hasPermissions(Member $Member, array $Permissions){
        $t = true;
        foreach ($Permissions as $permission) {
            $t = $t && $this->hasPermission($Member, $permission);
        }
        return $t;
    }

    /**
     * @param MemberNameField|string $e
     * @param $enable
     * @param $UID
     * @return void
     */
    public static function toggleMember($e,string $enable,string $UID){
        self::firstConditionInit();
        switch ($e){
            case MemberNameField::ID:
                self::$conn->query("UPDATE `cgphp_member` SET `enable`= ? WHERE `uid` = ?", $enable, $UID);
                break;
        }
    }

    /**
     * 更新會員
     * @param MemberNameField|string $e
     * @param $USE_value
     * @param $update
     * @return ResultSet
     * @throws RuntimeException
     */
    public static function updateMember($e, $USE_value, $update)
    {
        self::firstConditionInit();
        return match ($e) {
            MemberNameField::ID     => self::$conn->query('UPDATE `cgphp_member` SET', $update, 'WHERE id = ?', $USE_value),
            MemberNameField::UID    => self::$conn->query('UPDATE `cgphp_member` SET', $update, 'WHERE uid = ?', $USE_value),
            MemberNameField::phone  => self::$conn->query('UPDATE `cgphp_member` SET', $update, 'WHERE phone = ?', $USE_value),
            default => throw new RuntimeException('NOT SELECTED ENUM USE VALUE'),
        };
    }

    /**
     * 刪除會員
     * @param MemberNameField|string $e
     * @param $value
     * @return Row|null
     * @throws RuntimeException
     */
    public static function removeMember($e, $value): ?Row
    {
        self::firstConditionInit();
        return match ($e) {
            MemberNameField::ID    => self::$conn->fetch('DELETE FROM `cgphp_member` WHERE id = ?', $value),
            MemberNameField::UID   => self::$conn->fetch('DELETE FROM `cgphp_member` WHERE uid = ?', $value),
            MemberNameField::phone => self::$conn->fetch('DELETE FROM `cgphp_member` WHERE phone = ?', $value),
            default => throw new RuntimeException('NOT SELECTED ENUM VALUE'),
        };
    }
}
