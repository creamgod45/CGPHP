<?php

namespace Permission;

use Type\Array\CGArray;
use Utils\Utils;

class PermissionManager
{
    public CGArray $permissions;

    public function __construct()
    {
        $this->permissions = new CGArray();
    }


    public function PermissionTree(Permission $permission)
    {
        $permissions = $permission->getSubPermission();
        foreach ($permissions as $k => $p) {
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
            } else {
                //有子
                self::PermissionRecursion($permission, $permissions[$k]);
            }
        }
        return $permission;
    }

    public function PermissionRecursion(Permission &$parent, Permission &$self): void
    {
        $self->setName($parent->getName() . "_" . $self->getName());
        if (empty($self->getPage()))
            $self->setPage($parent->getPage());
        if (empty($self->getDescription()))
            $self->setDescription($parent->getDescription());
        if (empty($self->isAdminBydefault()))
            $self->setAdminBydefault($parent->isAdminBydefault());
        if (!empty($self->getSubPermission())) {
            foreach ($self->getSubPermission() as $key => $item) {
                self::PermissionRecursion($self, $self->subPermission[$key]);
            }
        }
    }

    public function addPermission(Permission $permission)
    {
        $this->permissions->Add($permission);
    }

    public function removePermission(Permission $permission)
    {
    }


    public function hasPermission(string $permission)
    {
        /**
         * @var Permission[] $plist
         */
        $plist = $this->permissions->toArray();
        foreach ($plist as $p1) {
            //(new Utils())->v($p1->getName());
            if( $p1->getName() === $permission){
                return true;
            }elseif($this->checkPermissionRecursively($p1, $permission) !== null){
                return true;
            }
        }
        return false;
    }

    /**
     * @param Permission $permission
     * @param string $permissionName
     * @return boolean
     */
    private function checkPermissionRecursively(Permission $permission, string $permissionName)
    {
        if($permission->getName() === $permissionName) return true;
        foreach ($permission->getSubPermission() as $item) {
            //(new Utils())->v($item->getName());
            if($item->getName()===$permissionName){
                return true;
            }
            $a = $this->checkPermissionRecursively($item, $permissionName);
            if($a) return $a;
        }
        return null;
    }

    public function getPermissions($toArray=false)
    {
        if($toArray)
            return $this->permissions->toArray();
        else
            return $this->permissions;
    }

    public function getPermission(string $Permission)
    {

    }
}