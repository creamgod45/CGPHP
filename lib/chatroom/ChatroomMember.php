<?php

namespace chatroom;

use Auth\Member;
use Auth\MemberManager;
use Auth\MemberNameField;

class ChatroomMember
{
    private ?Member $member=null;
    private string $uid;

    public function __construct(string $uid)
    {
        $this->uid=$uid;
        $r = MemberManager::getMember(MemberNameField::UID, $uid);
        if($r->isInitialized()){
            $this->member = $r;
        }
    }

    /**
     * @return Member
     */
    public function getMember(): Member
    {
        return $this->member;
    }

    public function isNull(): bool
    {
        return $this->getMember()===null;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return __CLASS__."{member:".$this->member::class.", uid: $this->uid};";
    }
}
