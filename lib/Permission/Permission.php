<?php

namespace Permission;

use Order\Utils;

class Permission
{
    protected string $page = "";
    protected string $name = "";
    protected string $description = "";
    protected bool $adminBydefault = false;
    /**
     * @var Permission[] $subPermission
     */
    public array $subPermission = [];

    /**
     * @param string $page
     * @param string $name
     * @param string $description
     * @param bool $adminBydefault
     * @param Permission[] $subPermission
     */
    public function __construct(string $page, string $name, string $description="", array $subPermission=[], bool $adminBydefault=false)
    {
        $this->page = $page;
        $this->name = $name;
        $this->description = $description;
        $this->adminBydefault = $adminBydefault;
        $this->subPermission = $subPermission;
    }

    /**
     * @return array
     */
    public function getSubPermission(): array
    {
        return $this->subPermission;
    }

    /**
     * @param array $subPermission
     */
    public function setSubPermission(array $subPermission): void
    {
        $this->subPermission = $subPermission;
    }

    /**
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * @param string $page
     */
    public function setPage(string $page): void
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isAdminBydefault(): bool
    {
        return $this->adminBydefault;
    }

    /**
     * @param bool $adminBydefault
     */
    public function setAdminBydefault(bool $adminBydefault): void
    {
        $this->adminBydefault = $adminBydefault;
    }
}