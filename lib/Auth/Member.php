<?php

namespace Auth;


use Exception;
use Nette\Utils\DateTime;
use Permission\PermissionManager;

class Member
{
    protected int $id;
    protected string $uid;

    protected MemberType $type;
    protected string $phone;
    protected string $password;
    protected string $email;
    protected bool $administrator;
    protected bool $enable;
    protected string $createdAt;
    protected DateTime $updatedAt;
    protected PermissionManager $permissionManager;
    private bool $isInitialized = false;

    public function __construct($list = [])
    {
        if (!empty($list)) {
            [$this->id, $this->uid, $type, $this->phone, $this->password, $this->email, $this->enable, $this->administrator, $this->createdAt, $this->updatedAt] = $list;
            $this->isInitialized = true;
            $this->type = MemberType::from($type);
        }
    }

    public function override(Member $member)
    {
        $this->id = $member->id;
        $this->uid = $member->uid;
        $this->type = $member->type;
        $this->phone = $member->phone;
        $this->password = $member->password;
        $this->email = $member->email;
        $this->administrator = $member->administrator;
        $this->enable = $member->enable;
        $this->createdAt = $member->createdAt;
        $this->updatedAt = $member->updatedAt;
        $this->isInitialized = $member->isInitialized;
        $this->permissionManager = $member->permissionManager;
        return $this;
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "uid" => $this->uid,
            "type" => $this->type,
            "phone" => $this->phone,
            "password" => $this->password,
            "email" => $this->email,
            "administrator" => $this->administrator,
            "enable" => $this->enable,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt->getTimestamp(),
            "isInitialized" => $this->isInitialized,
            "Permissions" => $this->permissionManager,
        ];
    }

    public function setArray($array = [])
    {
        if (empty($array)) return $this;
        $this->id = $array["id"];
        $this->uid = $array["uid"];
        $this->type = $array["type"];
        $this->phone = $array["phone"];
        $this->password = $array["password"];
        $this->email = $array["email"];
        $this->administrator = $array["administrator"];
        $this->enable = $array["enable"];
        $this->createdAt = $array["createdAt"];
        try {
            $this->updatedAt = DateTime::from($array["updatedAt"]);
        } catch (Exception $e) {
        }
        $this->isInitialized = $array["isInitialized"];
        $this->permissionManager = $array["Permissions"];
        return $this;
    }

    public function serialize()
    {
        return serialize($this);
    }

    public function unserialize(string $data)
    {
        /**
         * @var Member $object
         */
        $object = unserialize($data);
        $this->override($object);
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return MemberType
     */
    public function getType(): MemberType
    {
        return $this->type;
    }

    /**
     * @param MemberType $type
     */
    public function setType(MemberType $type): void
    {
        $this->type = $type;
    }
    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param bool $administrator
     */
    public function setAdministrator(bool $administrator): void
    {
        $this->administrator = $administrator;
    }

    /**
     * @param bool $enable
     */
    public function setEnable(bool $enable): void
    {
        $this->enable = $enable;
    }

    /**
     * @param bool $isInitialized
     */
    public function setIsInitialized(bool $isInitialized): void
    {
        $this->isInitialized = $isInitialized;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function isAdministrator(): bool
    {
        return $this->administrator;
    }

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return bool
     */
    public function isInitialized(): bool
    {
        return $this->isInitialized;
    }

    /**
     * @return PermissionManager
     */
    public function getPermissionManager(): PermissionManager
    {
        return $this->permissionManager;
    }

    /**
     * @param PermissionManager $permissionManager
     */
    public function setPermissionManager(PermissionManager $permissionManager): void
    {
        $this->permissionManager = $permissionManager;
    }

    public function updateMemberData(): Member
    {
        $member = MemberManager::getMember(MemberNameField::UID, $this->getUid());
        $this->override($member);
        return $this;
    }
}

