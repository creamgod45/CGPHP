<?php

namespace Permission;

use Type\Array\CGArray;
use Type\String\CGString;

class PermissionManager
{

    /**
     * @var Permission[] $permissions
     */
    public array $permissions = [];

    public function __construct()
    {

    }

    /**
     * Auth\MemberType\AdministratorPermission
     *  permissions: array
     *      0 => Permission\Permission
     *           page: 'profile'
     *           name: 'member_page_profile_permissions'
     *           description: '會員個人資料操作權限組別'
     *           adminBydefault: false
     *           subPermission: array
     *                          0 => Permission\Permission
     *                               page: 'profile'
     *                               name: 'member_page_profile_permissions_view'
     *                               description: '觀看頁面權限'
     *                               adminBydefault: false
     *                               subPermission: array
     *                                              0 => Permission\Permission
     *                                                   page: 'profile'
     *                                                   name: 'member_page_profile_permissions_view_page_1'
     *                                                   description: '玩家資料'
     *                                                   adminBydefault: false
     *                                                   subPermission: array (0)
     *                                              1 => Permission\Permission
     *                                              2 => Permission\Permission
     *                                              3 => Permission\Permission
     */


    public function PermissTreeParser(Permission $permission){
        $arr = [];
        $permissions = [];
        $this->PermissionTree($permission, $permissions);
        /**
         * @var Permission[] $permissions
         */
        foreach ($permissions as $p) {
            $p->setSubPermission([]);
            $arr [$p->getName()] = $p;
        }
        return $arr;
    }

    /**
     * @param Permission $permission
     * @param Permission[] $refArray
     * @return Permission
     */
    public function PermissionTree(Permission $permission,array &$refArray=[])
    {
        $tarr = [];
        $tarr [$permission->getName()] = $permission;
        $permissions = $permission->getSubPermission();
        foreach ($permissions as $k => $p) {
            //(new Utils())->v($p);
            if (empty($p->getSubPermission())) {
                //無子
                $p->setName($permission->getName() . "_" . $p->getName());
                if (empty($p->getPage()))
                    $p->setPage($permission->getPage());
                if (empty($p->getDescription()))
                    $p->setPage($permission->getDescription());
                if (empty($p->isAdminBydefault()))
                    $p->setPage($permission->isAdminBydefault());
                $permissions[$k] = $p;
                $tarr [] = $p;
            } else {
                //有子
                $r = self::PermissionTreeRecursion($permission, $permissions[$k]);
                foreach ($r as $a) {
                    $tarr [] = $a;
                }
            }
        }
        $refArray = $tarr;
        return $permission;
    }

    public function PermissionTreeRecursion(Permission &$parent, Permission &$self)
    {
        $tarr = [];
        $self->setName($parent->getName() . "_" . $self->getName());
        if (empty($self->getPage()))
            $self->setPage($parent->getPage());
        if (empty($self->getDescription()))
            $self->setDescription($parent->getDescription());
        if (empty($self->isAdminBydefault()))
            $self->setAdminBydefault($parent->isAdminBydefault());
        if (!empty($self->getSubPermission())) {
            foreach ($self->getSubPermission() as $key => $item) {
                //(new Utils())->v($item);
                $r = self::PermissionTreeRecursion($self, $self->subPermission[$key]);
                foreach ($r as $a) {
                    $tarr [] = $a;
                }
            }
        }
        $tarr [] = $self;
        return $tarr;
    }

    public function addPermission(Permission $permission)
    {
        $this->permissions [$permission->getName()] = $permission;
    }

    public function addPermissions(array $ps){
        foreach ($ps as $key=> $permission) {
             $this->permissions[$key]=$permission;
        }
    }

    public function removePermission(string $p)
    {
        if($this->hasPermission($p)){
            $tarr = [];
            foreach ($this->permissions as $key => $permission) {
                $CGString = new CGString($permission->getName());
                if(!$CGString->StartWith($p)){
                    $tarr [$key] = $permission;
                }
            }
            $this->permissions = $tarr;
        }
    }

    public function removePermissions(string ... $permissions): void
    {
        foreach ($permissions as $item) {
            $this->removePermission($item);
        }
    }
    public function removePermissionsArray(array $permissions): void
    {
        foreach ($permissions as $item) {
            $this->removePermission($item);
        }
    }


    public function hasPermission(string $permission)
    {
        $CGArray = new CGArray($this->permissions);
        if($CGArray->hasKey("admin")){
            return true;
        }
        if($CGArray->hasKey($permission)){
            return true;
        }
        return false;
    }

    /**
     * @param array|CGArray $arr
     * @return bool
     */
    public function hasPermissions($arr)
    {
        if ($arr instanceof CGArray) {
            $arr = $arr->toArray();
        }
        $r = true;
        foreach ($arr as $item) {
            $r = $r && $this->hasPermission($item);
        }
        return $r;
    }

    /**
     * @param string ...$str
     * @return bool
     */
    public function hasPermissions2(string ...$str){
        $r = true;
        foreach ($str as $item) {
            $r = $r && $this->hasPermission($item);
        }
        return $r;
    }

    public function getPermissions()
    {

        return $this->permissions;
    }

    public function getPermission(string $Permission)
    {

    }
}
