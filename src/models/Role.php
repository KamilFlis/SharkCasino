<?php


class Role {

    protected $permissions;

    public function __construct() {
        $this->permissions = array();
    }

    public function getPermissions(): array {
        return $this->permissions;
    }

    public function setPermissions(array $permissions): void {
        $this->permissions = $permissions;
    }

    public function hasPermission($permission): bool {
        return isset($this->permissions[$permission]);
    }

}