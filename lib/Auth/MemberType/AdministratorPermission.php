<?php

namespace Auth\MemberType;

use Permission\Permission;
use Permission\PermissionManager;
use Type\Array\CGArray;

class AdministratorPermission extends PermissionManager
{
    public CGArray $permissions;

    public function __construct()
    {
        parent::__construct();
        $p1 = new Permission("profile", "member_page_profile_permissions", "會員個人資料操作權限組別", [
            new Permission("", "view", "觀看頁面權限", [
                new Permission("", "page_1", "玩家資料"),
                new Permission("", "page_2", "背包內容"),
                new Permission("", "page_3", "成就進度"),
                new Permission("", "page_4", "戰鬥通行證"),
            ]),
            new Permission("", "edit", "編輯個人資料權限", [
                new Permission("", "page_1", "玩家資料"),
                new Permission("", "page_2", "背包內容"),
                new Permission("", "page_3", "成就進度"),
                new Permission("", "page_4", "戰鬥通行證"),
            ]),
        ]);
        $this->addPermission($this->PermissionTree($p1));
        //(new Utils())->pinv($this->getPermissions(), "getPermissions");
        //(new Utils())->pinv($this->hasPermission("member_page_profile_permissions_edit_page_5"), "hasPermission");
    }
}