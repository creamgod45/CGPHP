<?php

namespace Auth\MemberPermission;

use Permission\Permission;
use Permission\PermissionManager;
use Utils\Utils;

class AdministratorPermission extends PermissionManager
{
    public function __construct()
    {
        parent::__construct();
        $p1 =new Permission("profile", "member_page_profile_permissions", "會員個人資料操作權限組別", [
                new Permission("", "view", "觀看頁面權限", [
                    new Permission("", "page_1", "玩家資料", [
                        new Permission("", "page_1", "1"),
                        new Permission("", "page_2", "2"),
                        new Permission("", "page_3", "3"),
                        new Permission("", "page_4", "4"),
                    ]),
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
        $p2 = new Permission("", "admin", "管理員專屬權限");
        $this->addPermissions($this->PermissTreeParser($p1));
        $this->addPermission($p2);
        //(new Utils())->pinv($this->hasPermission("member_page_profile_permissions_edit_page_5"), "hasPermission");
    }
}
