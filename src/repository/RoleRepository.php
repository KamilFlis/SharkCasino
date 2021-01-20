<?php

require_once "Repository.php";
require_once __DIR__."/../models/Role.php";

class RoleRepository extends Repository {

    public function getRolePerms($role_id) {
        $statement = $this->database->connect()->prepare("
            SELECT p.description 
            FROM role_permission rp 
            JOIN permissions p on rp.permission_id = p.id
            WHERE rp.role_id = :role_id;
        ");

        $statement->execute([":role_id" => $role_id]);

        $role = new Role();

        $permissions = [];
        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $permissions[$row["description"]] = true;
        }

        $role->setPermissions($permissions);
        return $role;
    }

    public function getRolesForUser($userId) {
        $statement = $this->database->connect()->prepare("
                SELECT t1.role_id, t2.name 
                FROM user_role t1 
                JOIN roles t2 ON t1.role_id = t2.id
                WHERE t1.user_id = :user_id;
        ");

        $roles = [];
        $statement->execute([":user_id" => $userId]);
        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $roles[$row["name"]] = $this->getRolePerms($row["role_id"]);
        }
        return $roles;
    }

    public function assignDefaultRole($userId) {
        $statement = $this->database->connect()->prepare("
                INSERT INTO user_role(user_id, role_id) VALUES(:user_id, 2);
        ");

        $statement->execute([":user_id" => $userId]);
    }
}