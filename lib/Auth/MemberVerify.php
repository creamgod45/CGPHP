<?php

namespace Auth;

trait MemberVerify
{
    public static function login(Member $member, $password): bool
    {
        if ($member->isInitialized()) {
            $password1 = $member->getPassword();
            return password_verify($password, $password1);
        }
        return false;
    }
}